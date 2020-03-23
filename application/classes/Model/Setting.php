<?
defined('SYSPATH') or die('No direct script access.');

class Model_Setting extends ORM {
	protected $_rules = array(
		'tahun' => array(
			'not_empty'  	=> NULL,
			'digit'      	=> array(TRUE),
			'exact_length'	=> array(4),
		),
	);
	
	public function update_setting($values,$field) {
		return $this->values($values, $field)->update();
	}
}
?>