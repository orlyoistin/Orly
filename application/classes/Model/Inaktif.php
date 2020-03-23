<?
defined('SYSPATH') or die('No direct script access.');

class Model_Inaktif extends ORM {
	protected $_belongs_to = array(
		'skpd'				=> array(),
		'klasifikasi'		=> array(),
		'jenis'				=> array(),
		'guna'				=> array(),
		'media'			=> array(),
		'tingkat'			=> array(),
		'lampiran'			=> array(),
		'user'				=> array(),
		'instansi'			=> array(),
	);

	public function rules() {
		return array(
			'klasifikasi_id' => array(
				array('not_empty'),
			),
			'skpd_id' => array(
				array('min_length', array(':value', 0)),
			),
			'instansi_id' => array(
				array('not_empty'),
				array(array($this, 'instansi_available')),
			),
			'pelaksana' => array(
				array('not_empty'),
				array(array($this, 'pelaksana_available')),
			),
			'hasil' => array(
				array('not_empty'),
				array(array($this, 'hasil_available')),
			),			
			'isi' => array(
				array('not_empty'),
			),
			'bulan' => array(
				array('not_empty'),
			),
			'tahun' => array(
				array('not_empty'),
			),			
			/*'ra' => array(
				array('not_empty'),
			),
			'ri' => array(
				array('not_empty'),
			),
			'ta' => array(
				array('not_empty'),
			),
			'ti' => array(
				array('not_empty'),
			),
			'k' => array(
				array('not_empty'),
			),
			'delete' => array(
				array('min_length', array(':value', 0)),
			),
			'id' => array(
				array('min_length', array(':value', 0)),
			),*/
		);
	}
	
	public function hasil_available($hasil) {
		if(isset($_POST['id'])) {
			$inaktif = ORM::factory('Inaktif',$_POST['id']);
			if(ORM::factory('Inaktif')
				->where("hasil","=",$hasil)
				->where("hasil","!=",$inaktif->hasil)
				->where('instansi_id','=',$_POST['instansi_id'])
				->where('pelaksana','=',$_POST['pelaksana'])
				->count_all()) {
				return FALSE;
			}
		}
		else {
			if(ORM::factory('Inaktif')
				->where("hasil","=",$hasil)
				->where('instansi_id','=',$_POST['instansi_id'])
				->where('pelaksana','=',$_POST['pelaksana'])
				->count_all()) {
				return FALSE;
			}
		}
	}
	
	public function pelaksana_available($pelaksana) {
		if(isset($_POST['id'])) {
			$inaktif = ORM::factory('Inaktif',$_POST['id']);
			if(ORM::factory('Inaktif')
				->where('pelaksana','=',$pelaksana)
				->where('pelaksana','!=',$inaktif->pelaksana)
				->where("hasil","=",$_POST['hasil'])
				->where('instansi_id','=',$_POST['instansi_id'])				
				->count_all()) {
				return FALSE;
			}
		}
		else {
			if(ORM::factory('Inaktif')
				->where('pelaksana','=',$pelaksana)
				->where("hasil","=",$_POST['hasil'])
				->where('instansi_id','=',$_POST['instansi_id'])				
				->count_all()) {
				return FALSE;
			}
		}
	}
	
	public function instansi_available($instansi_id) {
		if(isset($_POST['id'])) {
			$inaktif = ORM::factory('Inaktif',$_POST['id']);
			if(ORM::factory('Inaktif')
				->where('instansi_id','=',$instansi_id)
				->where('instansi_id','!=',$inaktif->instansi_id)
				->where("hasil","=",$_POST['hasil'])
				->where('pelaksana','=',$_POST['pelaksana'])				
				->count_all()) {
				return FALSE;
			}
		}
		else {
			if(ORM::factory('Inaktif')
				->where('instansi_id','=',$instansi_id)
				->where("hasil","=",$_POST['hasil'])
				->where('pelaksana','=',$_POST['pelaksana'])				
				->count_all()) {
				return FALSE;
			}
		}
	}
		
	public function create_inaktif($values,$field) {
		return $this->values($values, $field)->create();
	}

	public function update_inaktif($values,$field) {
		return $this->values($values, $field)->update();
	}
}
?>