<?
defined('SYSPATH') or die('No direct script access.');

class Model_Naskah extends ORM {	
	protected $_belongs_to = array(
		'template'	=> array(),
		'source' => array(
			'model'	=> 'Sotk',
			'foreign_key'	=> 'dari',
		),
	);
	
	protected $_has_many = array(
		'revision'	=> array()	
	);
	
	public function rules() {
		return array(
			'nomor' => array(
				array('not_empty'),
			),
			'tanggal' => array(
				array('not_empty'),
			),
			'perihal' => array(
				array('not_empty'),
			),
			'description' => array(
				array('not_empty'),
			),
		);
	}

	public function create_naskah($values,$field) {
		return $this->values($values, $field)->create();
	}	
	
	public function update_naskah($values,$field) {
		return $this->values($values, $field)->update();
	}
}
?>