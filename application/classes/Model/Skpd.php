<?
defined('SYSPATH') or die('No direct script access.');

class Model_Skpd extends ORM {
	protected $_has_many = array(
		'user'			=> array(),
		'masuk'			=> array(),
		'keluar'		=> array(),
		'inaktif'		=> array(),
		'instansi'		=> array(),
		'sotk'		=> array(),
	);
	
	public function rules() {
		return array(
			'name' => array(
				array('not_empty'),
				array(array($this, 'name_available')),
			),
		);
	}
	
	public function name_available($name) {
		if(isset($_POST['id'])) {
			$skpd = ORM::factory('Skpd',$_POST['id']);
			if(ORM::factory('Skpd')
				->where("name","=",$name)
				->where("name","!=",$skpd->name)
				->count_all()) {
				return FALSE;
			}
		}
		else {
			if(ORM::factory('Skpd')->where("name","=",$name)->count_all()) {
				return FALSE;
			}
		}
	}
		
	public function create_skpd($values,$field) {
		return $this->values($values, $field)->create();
	}

	public function update_skpd($values,$field) {
		return $this->values($values, $field)->update();
	}
}
?>