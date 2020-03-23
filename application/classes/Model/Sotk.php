<?
defined('SYSPATH') or die('No direct script access.');

class Model_Sotk extends ORM {
	public function rules() {
		return array(
			'name' => array(
				array('not_empty'),
			),
		);
	}

	public function create_sotk($values,$field) {
		return $this->values($values, $field)->create();
	}	
	
	public function update_sotk($values,$field) {
		return $this->values($values, $field)->update();
	}
}
?>