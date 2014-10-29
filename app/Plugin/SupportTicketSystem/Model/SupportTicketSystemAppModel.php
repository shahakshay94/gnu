<?php

App::uses('AppModel', 'Model');

class SupportTicketSystemAppModel extends AppModel {

	public $actsAs = array('Containable','WhoDidIt');
	public $recursive = -1;

	/**
	 * Checks a record, if it is unique - depending on other fields in this table (transfered as array)
	 * example in model: 'rule' => array ('validateUnique', array('belongs_to_table_id','some_id','user_id')),
	 * if all keys (of the array transferred) match a record, return false, otherwise true
	 *
	 * @param array $fields Other fields to depend on
	 * TODO: add possibity of deep nested validation (User -> Comment -> CommentCategory: UNIQUE comment_id, Comment.user_id)
	 * @param array $options
	 * - requireDependentFields Require all dependent fields for the validation rule to return true
	 * @return boolean Success
	 */
	public function validateUnique($data, $fields = array(), $options = array()) {
		$id = (!empty($this->data[$this->alias][$this->primaryKey]) ? $this->data[$this->alias][$this->primaryKey] : 0);
		if (!$id && $this->id) {
			$id = $this->id;
		}

		foreach ($data as $key => $value) {
			$fieldName = $key;
			$fieldValue = $value;
			break;
		}

		$conditions = array(
			$this->alias . '.' . $fieldName => $fieldValue,
			$this->alias . '.id !=' => $id);

		// careful, if fields is not manually filled, the options will be the second param!!! big problem...
		$fields = (array)$fields;
		if (!array_key_exists('allowEmpty', $fields)) {
			foreach ($fields as $dependingField) {
				if (isset($this->data[$this->alias][$dependingField])) { // add ONLY if some content is transfered (check on that first!)
					$conditions[$this->alias . '.' . $dependingField] = $this->data[$this->alias][$dependingField];

				} elseif (isset($this->data['Validation'][$dependingField])) { // add ONLY if some content is transfered (check on that first!
					$conditions[$this->alias . '.' . $dependingField] = $this->data['Validation'][$dependingField];

				} elseif (!empty($id)) {
					// manual query! (only possible on edit)
					$res = $this->find('first', array('fields' => array($this->alias . '.' . $dependingField), 'conditions' => array($this->alias . '.id' => $id)));
					if (!empty($res)) {
						$conditions[$this->alias . '.' . $dependingField] = $res[$this->alias][$dependingField];
					}
				} else {
					if (!empty($options['requireDependentFields'])) {
						trigger_error('Required field ' . $dependingField . ' for validateUnique validation not present');
						return false;
					}
					return true;
				}
			}
		}

		$this->recursive = -1;
		if (count($conditions) > 2) {
			$this->recursive = 0;
		}
		$options = array('fields' => array($this->alias . '.' . $this->primaryKey), 'conditions' => $conditions);
		$res = $this->find('first', $options);
		return empty($res);
	}
}
