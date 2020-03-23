<?
defined('SYSPATH') or die('No direct script access.');

class Model_Jabatan extends ORM {
	protected $_has_many = array(
		'roles'     => array('model' => 'role', 'through' => 'roles_jabatans'),
		'user'		=> array(),
	);
	
	public function rules() {
		return array(
			'name' => array(
				array('not_empty'),
				array(array($this, 'name_available')),
			),		
			'id' => array(
				array('min_length', array(':value', 0)),
			),
			'delete' => array(
				array('min_length', array(':value', 0)),
			),
		);	
	}
	
	public function name_available($name) {
		if(ORM::factory('Jabatan')->where("name","=",$name)->count_all()) {
			return FALSE;
		}
	}
	
	public function create_jabatan($values,$field) {
		return $this->values($values, $field)->create();
	}

	public function update_jabatan($values,$field) {
		return $this->values($values, $field)->update();
	}
}
?>