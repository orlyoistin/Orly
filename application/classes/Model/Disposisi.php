<?
defined('SYSPATH') or die('No direct script access.');

class Model_Disposisi extends ORM {
	protected $_belongs_to = array(
		'masuk'			=> array(),
	);
	
	protected $_has_many = array(
		'note'			=> array(),
	);

	public function rules() {
		return array(
			'tanggal' => array(
				array('not_empty'),
			),
			'isi' => array(
				array('not_empty'),
			),
			'dari' => array(
				array('not_empty'),
			),			
		);
	}
		
	public function create_disposisi($values,$field) {
		return $this->values($values, $field)->create();
	}

	public function update_disposisi($values,$field) {
		return $this->values($values, $field)->update();
	}
}
?>