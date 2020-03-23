<?
defined('SYSPATH') or die('No direct script access.');

class Model_Note extends ORM {
	protected $_belongs_to = array(
		'user'		=> array(),
		'disposisi'	=> array(),
		'read'		=> array(),
	);
	
	public function rules() {
		return array(
			'user_id' => array(
				array('not_empty'),
			),
			'disposisi_id' => array(
				array('not_empty'),
			),
			'read_id' => array(
				array('not_empty'),
			),					
			'id' => array(
				array('min_length', array(':value', 0)),
			),
			'delete' => array(
				array('min_length', array(':value', 0)),
			),
		);	
	}
	
	
	public function create_note($values,$field) {
		return $this->values($values, $field)->create();
	}

	public function update_note($values,$field) {
		return $this->values($values, $field)->update();
	}
}
?>