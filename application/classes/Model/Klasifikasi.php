<?
defined('SYSPATH') or die('No direct script access.');

class Model_Klasifikasi extends ORM {
	protected $_has_many = array(
		'aktif'			=> array(),
		'inaktif'		=> array(),
	);

	protected $_belongs_to = array(
		'seri'			=> array(),
		'keterangan'	=> array(),
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
		);
	}
	
	public function kode_available($kode) {
		if(isset($_POST['id'])) {
			$klasifikasi = ORM::factory('Klasifikasi',$_POST['id']);
			if(ORM::factory('Klasifikasi')
				->where("kode","=",$kode)
				->where("kode","!=",$klasifikasi->kode)
				->count_all()) {
				return FALSE;
			}
		}
		else {
			if(ORM::factory('Klasifikasi')->where("kode","=",$kode)->count_all()) {
				return FALSE;
			}
		}
	}

	public function name_available($name) {
		if(isset($_POST['id'])) {
			$klasifikasi = ORM::factory('Klasifikasi',$_POST['id']);
			if(ORM::factory('Klasifikasi')
				->where("name","=",$name)
				->where("name","!=",$klasifikasi->name)
				->count_all()) {
				return FALSE;
			}
		}
		else {
			if(ORM::factory('Klasifikasi')->where("name","=",$name)->count_all()) {
				return FALSE;
			}
		}
	}	
		
	public function create_klasifikasi($values,$field) {
		return $this->values($values, $field)->create();
	}

	public function update_klasifikasi($values,$field) {
		return $this->values($values, $field)->update();
	}
}
?>