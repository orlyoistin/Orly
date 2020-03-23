<?
defined('SYSPATH') or die('No direct script access.');

class Model_Instansi extends ORM {
	protected $_has_many = array(
		'inaktif'		=> array(),
	);
	
	protected $_belongs_to = array(
		'skpd'			=> array(),
		'masterbool'		=> array(),
	);
	
	public function rules() {
		return array(
			'kode' => array(
				array('not_empty'),
				array(array($this, 'kode_available')),
			),
			'name' => array(
				array('not_empty'),
			)
		);
	}
	
	public function kode_available($kode) {
		if(isset($_POST['id'])) {
			$instansi = ORM::factory('Instansi',$_POST['id']);
			if(ORM::factory('Instansi')
				->where("kode","=",$kode)
				->where("kode","!=",$instansi->kode)
				->where("skpd_id","=",$instansi->skpd_id)
				->count_all()) {
				return FALSE;
			}
		}
		else {
			if(ORM::factory('Instansi')->where("kode","=",$kode)->where("skpd_id","=",Auth::instance()->get_user()->skpd_id)->count_all()) {
				return FALSE;
			}
		}
	}
			
	public function create_instansi($values,$field) {
		return $this->values($values, $field)->create();
	}

	public function update_instansi($values,$field) {
		return $this->values($values, $field)->update();
	}
}
?>