<?
defined('SYSPATH') or die('No direct script access.');

class Model_Distribution extends ORM {
	protected $_belongs_to = array(
		'masuk'			=> array(),
		'skpd'				=> array(),
		'sotk'=>array(),
	);
	
	public function rules() {
		return array(
			'tanggal' => array(
				array('not_empty'),
			)			
		);
	}
		
	public function create_distribution($values,$field) {
		return $this->values($values, $field)->create();
	}

	public function update_distribution($values,$field) {
		return $this->values($values, $field)->update();
	}
}
?>