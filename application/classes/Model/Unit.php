<?
defined('SYSPATH') or die('No direct script access.');

class Model_Unit extends ORM {
	protected $_has_many = array(
		'masuk'			=> array(),
		'keluar'		=> array(),
		'inaktif'		=> array(),
		'user'			=> array(),
	);
	
	protected $_belongs_to = array(
		'skpd'			=> array(),
	);

	public function rules() {
		return array(
			'kode' => array(
				array('not_empty'),
				array(array($this, 'kode_available')),
			),
			'name' => array(
				array('not_empty'),
				array(array($this, 'name_available')),
			),
			'skpd_id' => array(
				array('not_empty'),
			),
			'delete' => array(
				array('min_length', array(':value', 0)),
			),
			'id' => array(
				array('min_length', array(':value', 0)),
			),
		);
	}
	
	public function kode_available($kode) {
		if($_POST['id']) {
			$unit = ORM::factory('Unit',$_POST['id']);
			if(ORM::factory('Unit')
				->where("kode","=",$kode)
				->where("kode","!=",$unit->kode)
				->where("skpd_id","=",$unit->skpd_id)
				->count_all()) {
				return FALSE;
			}
		}
		else {
			if(ORM::factory('Unit')->where("kode","=",$kode)->where("skpd_id","=",$_POST['skpd_id'])->count_all()) {
				return FALSE;
			}
		}
	}
	
	public function name_available($name) {
		if($_POST['id']) {
			$unit = ORM::factory('Unit',$_POST['id']);
			if(ORM::factory('Unit')
				->where("name","=",$name)
				->where("name","!=",$unit->name)
				->where("skpd_id","=",$unit->skpd_id)
				->count_all()) {
				return FALSE;
			}
		}
		else {
			if(ORM::factory('Unit')->where("name","=",$name)->where("skpd_id","=",$_POST['skpd_id'])->count_all()) {
				return FALSE;
			}
		}
	}
		
	public function create_unit($values,$field) {
		return $this->values($values, $field)->create();
	}

	public function update_unit($values,$field) {
		return $this->values($values, $field)->update();
	}
}
?>