<?php

App::uses('CakeSession', 'Model/Datasource');
App::uses('ModelBehavior', 'Model');

/**
 * WhoDidIt Behavior
 *
 * Handles creator_id, modifier_id fields for a given Model, if they exist in the Model DB table.
 * It's similar to the created, modified automagic, but it stores the id of the logged in user
 * in the models that have $actsAs = array('WhoDidIt').
 *
 * This is useful to track who created records, and the last user that has changed them.
 *
 * @link http://book.cakephp.org/2.0/en/models/saving-your-data.html#using-created-and-modified
 */
class WhoDidItBehavior extends ModelBehavior {

  /**
   * Default settings for a model that has this behavior attached.
   *
   * Setting force_modified to true will have the same effect as overriding the save method as
   * described in the code example for "Using created and modified" in the Cookbook.
   *
   * @var array
   * @link http://book.cakephp.org/2.0/en/models/saving-your-data.html#using-created-and-modified
   */
  protected $_defaults = array(
    'auth_session' => 'Auth', // Name of Auth session key
    'user_model' => 'User', // Name of the User model
    'creator_id_field' => 'creator_id', // Name of the "creator_id" field in the model
    'modifier_id_field' => 'modifier_id', // Name of the "modifier_id" field in the model
    'auto_bind' => true, // Automatically bind the model to the User model (default true)
    'force_modified' => true // Force update of the "modified" field even if not empty
  );

  /**
   * Initiate WhoDidIt Behavior.
   *
   * Checks if the configured fields are available in the model.
   * Also binds the User model as association for each available field.
   *
   * @param Model $Model The model.
   * @param array $config Behavior settings you would like to override.
   * @return void
   */
  public function setup(Model $Model, $config = array()) {
    $this->settings[$Model->alias] = array_merge($this->_defaults, (array)$config);

    $hasFieldCreatedBy = $Model->hasField($this->settings[$Model->alias]['creator_id_field']);
    $hasFieldModifiedBy = $Model->hasField($this->settings[$Model->alias]['modifier_id_field']);

    $this->settings[$Model->alias]['has_creator_id'] = $hasFieldCreatedBy;
    $this->settings[$Model->alias]['has_modifier_id'] = $hasFieldModifiedBy;

    // Handles model binding to the User model according to the auto_bind settings (default true).
    if ($this->settings[$Model->alias]['auto_bind']) {
      if ($hasFieldCreatedBy) {
        $commonBelongsTo = array(
          'CreatedBy' => array(
            'className' => $this->settings[$Model->alias]['user_model'],
            'foreignKey' => $this->settings[$Model->alias]['creator_id_field']));
        $Model->bindModel(array('belongsTo' => $commonBelongsTo), false);
      }

      if ($hasFieldModifiedBy) {
        $commonBelongsTo = array(
          'ModifiedBy' => array(
            'className' => $this->settings[$Model->alias]['user_model'],
            'foreignKey' => $this->settings[$Model->alias]['modifier_id_field']));
        $Model->bindModel(array('belongsTo' => $commonBelongsTo), false);
      }
    }
  }

  /**
   * Before save callback.
   *
   * Checks if at least one field is available.
   * Reads the current user id from the session.
   * If a user id is set it will fill...
   * ... the creator_id field only when creating a record
   * ... the modified by field only if it is not in the data array
   * or the "force_modified" setting is set to true.
   *
   * @param Model $Model The model using this behavior.
   * @return boolean True if the operation should continue, false if it should abort.
   */
  public function beforeSave(Model $Model, $options = array()) {
    if ($this->settings[$Model->alias]['has_creator_id'] || $this->settings[$Model->alias]['has_modifier_id']) {
      $AuthSession = $this->settings[$Model->alias]['auth_session'];
      $UserSession = $this->settings[$Model->alias]['user_model'];

      $userId = CakeSession::read($AuthSession . '.' . $UserSession . '.id');

      if ($userId) {
        $data = array();
        $modifiedByField = $this->settings[$Model->alias]['modifier_id_field'];

        if (!isset($Model->data[$Model->alias][$modifiedByField]) || $this->settings[$Model->alias]['force_modified']) {
          $data[$this->settings[$Model->alias]['modifier_id_field']] = $userId;
        } else {
          $pos = strpos($this->settings[$Model->alias]['modifier_id_field'], '_');
          $field = substr($this->settings[$Model->alias]['modifier_id_field'], 0, $pos);
          $data[$field] = false;
        }

        if (!$Model->exists()) {
          $data[$this->settings[$Model->alias]['creator_id_field']] = $userId;
        }
        if ($data) {
          $Model->set($data);
        }
      }
    }
    return true;
  }

}
