<?
defined('SYSPATH') or die('No direct script access.');

class Model_Masuk extends ORM {
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
				array('not_empty'),
			),
			'tanggal_terima' => array(
				array('not_empty'),
			),
			'tanggal_surat' => array(
				array('not_empty'),
			),
			'nomor' => array(
				array('not_empty'),
				array(array($this, 'nomor_available')),
			),
			'urut' => array(
				array('not_empty'),
				array(array($this, 'urut_available')),
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
		);
	}
	
	public function nomor_available($nomor) {
		if(isset($_POST['id'])) {
			$masuk = ORM::factory('Masuk',$_POST['id']);
			$tahun_surat = substr($masuk->tanggal_surat,0,4);	
			if(ORM::factory('Masuk')
				->where("nomor","=",$nomor)
				->where("nomor","!=",$masuk->nomor)
				->where("dari","=",$masuk->dari)
				->where("name","=",$masuk->name)
				->where(DB::expr('YEAR("tanggal_surat")'),'=',$tahun_surat)
				->where("skpd_id","=",Auth::instance()->get_user()->skpd_id)
				->count_all()) {
				return FALSE;
			}
		}
		else {
			$tahun_surat = date("Y");
			if(isset($_POST['tanggal_surat'])) {
				$tahun_surat = substr($_POST['tanggal_surat'],0,4);	
			}
			if(ORM::factory('Masuk')
				->where("nomor","=",$nomor)
				->where(DB::expr('YEAR("tanggal_surat")'),'=',$tahun_surat)
				->where('skpd_id','=',Auth::instance()->get_user()->skpd_id)
				->count_all()) {
				return FALSE;
			}
		}
	}
	
	public function urut_available($urut) {
		if(isset($_POST['id'])) {
			$masuk = ORM::factory('Masuk',$_POST['id']);
			$tahun_surat = substr($masuk->tanggal_surat,0,4);	
			
			if(ORM::factory('Masuk')
				->where("urut","=",$urut)
				->where("urut","!=",$masuk->urut)
				->where(DB::expr('YEAR(tanggal_surat)'),'=',$tahun_surat)
				->where("skpd_id","=",Auth::instance()->get_user()->skpd_id)
				->count_all()) {
				return FALSE;
			}
		}
		else {
			$tahun_surat = date("Y");
			if(isset($_POST['tanggal_surat'])) {
				$tahun_surat = substr($_POST['tanggal_surat'],0,4);	
			}
			
			if(ORM::factory('Masuk')
				->where("urut","=",$urut)
				->where(DB::expr('YEAR(tanggal_surat)'),'=',$tahun_surat)
				->where('skpd_id','=',Auth::instance()->get_user()->skpd_id)
				->count_all()) {
				return FALSE;
			}
		}
	}
		
	public function create_masuk($values,$field) {
		return $this->values($values, $field)->create();
	}

	public function update_masuk($values,$field) {
		return $this->values($values, $field)->update();
	}
}
?>