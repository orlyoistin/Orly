<?
defined('SYSPATH') or die('No direct script access.');

class Model_Template extends ORM {
	public function rules() {
		return array(
			'name' => array(
				array('not_empty'),
			),
			'description' => array(
				array('not_empty'),
			),
		);
	}

	public function create_template($values,$field) {
		return $this->values($values, $field)->create();
	}	
	
	public function update_template($values,$field) {
		return $this->values($values, $field)->update();
	}
}
?>