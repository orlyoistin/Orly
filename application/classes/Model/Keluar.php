<?
defined('SYSPATH') or die('No direct script access.');

class Model_Keluar extends ORM {
	protected $_belongs_to = array(
		'skpd'				=> array(),
		'klasifikasi'		=> array(),
		'unit'				=> array(),
		'guna'				=> array(),
		'media'				=> array(),
		'tingkat'			=> array(),
		'lampiran'			=> array(),
		'user'				=> array(),
		'sotk'				=> array(),		
	);

	public function rules() {
		return array(
			'skpd_id' => array(
				array('not_empty'),
			),
			'name' => array(
				array('min_length', array(':value', 0)),
			),
			'tanggal' => array(
				array('not_empty'),
			),
			'tanggal_surat' => array(
				array('not_empty'),
			),
			'urut' => array(
				array('not_empty'),
				array(array($this, 'urut_available')),
			),
			'nomor' => array(
				array('not_empty'),
				array(array($this, 'nomor_available')),
			),
			'perihal' => array(
				array('not_empty'),
			),
			'klasifikasi_id' => array(
				array('not_empty'),
			),
			'isi' => array(
				array('not_empty'),
			),
			'user_id' => array(
				array('not_empty'),
			),
			'skpd_id' => array(
				array('not_empty'),
			),			
		);
	}
	
	public function nomor_available($nomor) {
		if(isset($_POST['id'])) {
			$keluar = ORM::factory('Keluar',$_POST['id']);
			if(ORM::factory('Keluar')
				->where("nomor","=",$nomor)
				->where("nomor","!=",$keluar->nomor)
				->where('skpd_id','=',Auth::instance()->get_user()->skpd->id)
				->count_all()) {
				return FALSE;
			}
		}
		else {
			if(ORM::factory('Keluar')
				->where("nomor","=",$nomor)
				->where("skpd_id","=",Auth::instance()->get_user()->skpd->id)
				->count_all()) {
				return FALSE;
			}
		}
	}
	
	public function urut_available($urut) {
		if(isset($_POST['id'])) {
			$keluar = ORM::factory('Keluar',$_POST['id']);
			$tahun_surat = substr($keluar->tanggal_surat,0,4);
						
			if(ORM::factory('Keluar')
				->where('urut','=',$urut)
				->where('urut','!=',$keluar->urut)
				->where(DB::expr('YEAR(tanggal_surat)'),'=',$tahun_surat)
				->where('skpd_id','=',Auth::instance()->get_user()->skpd_id)				
				->count_all()) {
				return FALSE;
			}
		}
		else {
			if(ORM::factory('Keluar')->where("urut","=",$urut)->where('skpd_id','=',Auth::instance()->get_user()->skpd_id)->count_all()) {
				return FALSE;
			}
		}
	}
		
	public function create_keluar($values,$field) {
		return $this->values($values, $field)->create();
	}

	public function update_keluar($values,$field) {
		return $this->values($values, $field)->update();
	}
}
?>