<?php
App::uses('TrainingAndPlacementAppModel', 'TrainingAndPlacement.Model');

/**
 * CompanyMaster Model
 *
*/
class CompanyMaster extends TrainingAndPlacementAppModel {

/**
* Display field
*
* @var string
*/
	public $displayField = 'name';

/**
* Validation rules
*
* @var array
*/
	public $validate = [
		'name'		=> ['notEmpty' => ['rule' => ['notEmpty'],'rule' => ['isUnique'],'message' => 'Enter company name','required' => true]],
		'profile'	=> ['notEmpty' => ['rule' => ['notEmpty'],'rule' => ['isUnique'],'message' => 'Type brief Company profile','required' => true]],
		'website'	=> ['notEmpty' => ['rule' => ['url'], 'rule' => ['isUnique'],'message' => 'Your Web url is invalid or already registered','required' => true,'url' => 'url']],
		'location'	=> ['notEmpty' => ['rule' => ['notEmpty'],'required' => true]],
		'category'	=> ['notEmpty' => ['rule' => ['notEmpty'],'required' => true]],
		'email'		=> ['notEmpty' => ['rule' => ['email'], 'rule' => ['isUnique'],'message' => 'Your email is invalid or already registered','required' => true]],
		'contactno' => ['notEmpty' => ['rule' => ['phone'], 'rule' => ['isUnique'],'message' => 'Your contact no. is invalid or already registered','required' => true]]
	];

/**
* hasMany associations
*
* @var array
*/
	public $hasMany = ['TrainingAndPlacement.CompanyCampus', 'TrainingAndPlacement.CompanyJob', 'TrainingAndPlacement.CompanyJobEligibility', 'TrainingAndPlacement.CompanyVisit'];

/**
* Check $_FILES[][name] length.
*
* @param (string) $filename - Uploaded file name.
*/
    public function check_file_uploaded_length ($filename) {
        return (bool) ((mb_strlen($filename,"UTF-8") > 225) ? true : false);
    }

/**
* Check $_FILES[][name]
*
* @param (string) $filename - Uploaded file name.
* @author Yousef Ismaeil Cliprz
*/
    public function check_file_uploaded_name ($filename) {
        (bool) ((preg_match("`^[-0-9A-Z_\.]+$`i",$filename)) ? true : false);
    }

/**
* Import companymaster data using csv file
*
*/
	public function import($filename) {
	    /** to avoid having to tweak the contents of
	    * $data you should use your db field name as the heading name
	    * eg: Post.id, Post.title, Post.description
	    * set the filename to read CSV from
	    */
	    $filename = TMP . 'uploads' . DS . 'CompanyMaster' . DS . $filename;
	     
	    // open the file
	    $handle = fopen($filename, "r");
	     
	    // read the 1st row as headings
	    $header = fgetcsv($handle);
	     
	    // create a message container
	    $return = array(
	        'messages' => array(),
	        'errors' => array(),
	    );
			$i=0;
			$error = null;
	    // read each data row in the file
	    while (($row = fgetcsv($handle)) !== FALSE) {
	        $i++;
	        $data = array();

	        // for each header field
	        foreach ($header as $k=>$head) {
	            // get the data field from Model.field
	            if (strpos($head,'.')!==false) {
	                $h = explode('.',$head);
	                $data[$h[0]][$h[1]]=(isset($row[$k])) ? $row[$k] : '';
	            }
	            // get the data field from field
	            else {
	                $data['CompanyMaster'][$head]=(isset($row[$k])) ? $row[$k] : '';
	            }
	        }

	        // see if we have an id            
	        $id = isset($data['CompanyMaster']['id']) ? $data['CompanyMaster']['id'] : 0;

	        // we have an id, so we update
	        if ($id) {
	            $this->id = $id;
	        }
	         
	        // or create a new record
	        else {
	            $this->create();
	        }
	         
	        // validate the row
	        $this->set($data);
	        if (!$this->validates()) {
	            //$this->setFlash(,'warning');
	            $return['errors'][] = __(sprintf('Post for Row %d failed to validate.',$i), true);
	        }

	        // save the row
	        if (!$error && !$this->save($data)) {
	            $return['errors'][] = __(sprintf('Post for Row %d failed to save.',$i), true);
	        }

	        // success message!
	        if (!$error) {
	            $return['messages'][] = __(sprintf('Post for Row %d was saved.',$i), true);
	        }
	    }
	     
	    // close the file
	    fclose($handle);
	     
	    // return the messages
	    return $return;
	}    
}
