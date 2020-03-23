<?
defined('SYSPATH') or die('No direct script access.');

class Model_Seri extends ORM {
	protected $_has_many = array(
		'klasifikasi'			=> array(),
	);
	
	protected $_belongs_to = array(
		'keterangan' => array(),
	);
	
	public function rules() {
		return array(
			'name' => array(
				array('not_empty'),
				array(array($this, 'name_available')),
			),
			'aktif' => array(
				array('min_length', array(':value', 0)),
			),
			'inaktif' => array(
				array('min_length', array(':value', 0)),
			),
		);
	}
	
	public function name_available($name) {
		if($_POST['id']) {
			$seri = ORM::factory('Seri',$_POST['id']);
			if(ORM::factory('Seri')
				->where("name","=",$name)
				->where("name","!=",$seri->name)
				->count_all()) {
				
				return FALSE;
			}
		}
		else {
			if(ORM::factory('Seri')->where("name","=",$name)->count_all()) {
				return FALSE;
			}
		}
	}	
		
	public function create_seri($values,$field) {
		return $this->values($values, $field)->create();
	}

	public function update_seri($values,$field) {
		return $this->values($values, $field)->update();
	}
}
?>