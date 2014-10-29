<?php
App::uses('TrainingAndPlacementAppModel', 'TrainingAndPlacement.Model');
/**
 * StudentResume Model
 *
 */
class StudentResume extends TrainingAndPlacementAppModel {

/**
 * Validation rules
 *
 * @var array
 */

	public $validate = [
		'student_id'		=> ['isUnique' => ['rule' => ['isUnique']]],
		'careerobjective' 	=> ['notEmpty' => ['rule' => ['notEmpty'],'rule' => ['isUnique'],'message' => 'Please try your own career objective']],
		'hobbies' 			=> ['notEmpty' => ['rule' => ['notEmpty']]],
		'strengths' 		=> ['notEmpty' => ['rule' => ['notEmpty']]],
		'os' 				=> ['notEmpty' => ['rule' => ['notEmpty']]],
		'techlanguages' 	=> ['notEmpty' => ['rule' => ['notEmpty']]],
		'db' 				=> ['uuid' 	   => ['rule' => ['notEmpty']]],
		'webtechnologies' 	=> ['notEmpty' => ['rule' => ['notEmpty']]],
		'nw_prog_tools' 	=> ['notEmpty' => ['rule' => ['notEmpty']]],
		'sw_prog_tools' 	=> ['notEmpty' => ['rule' => ['notEmpty']]],
		'interestedin' 		=> ['notEmpty' => ['rule' => ['notEmpty']]],
		'workshops' 		=> ['notEmpty' => ['rule' => ['notEmpty']]],
		'seminars' 			=> ['notEmpty' => ['rule' => ['notEmpty']]],
		'projectname' 		=> ['notEmpty' => ['rule' => ['notEmpty']]]
	];

	public $belongsTo = ['Student'];

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
* Import companycampus data using csv file
*
*/
    public function import($filename) {
        /** to avoid having to tweak the contents of
        * $data you should use your db field name as the heading name
        * eg: Post.id, Post.title, Post.description
        * set the filename to read CSV from
        */
        $filename = APP . 'uploads' . DS . 'StudentResume' . DS . $filename;
         
         
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
                    $data['StudentResume'][$head]=(isset($row[$k])) ? $row[$k] : '';
                }
            }
 
            // see if we have an id            
            $id = isset($data['StudentResume']['id']) ? $data['StudentResume']['id'] : 0;
 
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
