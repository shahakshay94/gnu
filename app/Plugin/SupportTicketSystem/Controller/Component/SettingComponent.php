<?php

App::uses('Component', 'Controller');


class SettingComponent extends Component {

	public function paginatevalue() {
		$this->loadModel('Setting');
		$data = $this->Setting->find('first');
		$pagination_value = $data['Setting']['pagination_value'];
		return $pagination_value;
	}



}
