<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Dinas_Berkas extends Controller_Dinas_Backend {
	public $auth_required = array('login','dinas');

	function action_index(){			
		$this->template->content = View::factory('dinas/berkas');
	}
	
	function action_cetak(){	
		$this->auto_render = false;	
		$viewpemberkasan = ORM::factory('Viewpemberkasan')
			->where('skpd_id','=',Auth::instance()->get_user()->skpd_id);
		
		if(!isset($_REQUEST['tanggal_surat_start'])) {
			$viewpemberkasan = $viewpemberkasan->where(DB::expr('YEAR(tanggal_surat)'),'=',date("Y"));
		}
			
		$arrFind = array('urut','tanggal_surat_start','skpd_id','nomor','klasifikasi_id','isi','tipe','keterangan_id');
		$this->getSearch($viewpemberkasan,$arrFind);
		
		$results = $viewpemberkasan
			->order_by('kode','ASC')
			->order_by('tanggal_surat','ASC')
			->order_by(DB::expr('CAST(urut AS SIGNED)'),'DESC')
			->find_all();				
		
		echo View::factory('dinas/berkas_cetak')
			->bind('results', $results);
	}
	
	public function action_search() {
		$this->auto_render = false;
		
		echo View::factory('dinas/berkas_search')
			->set('url',URL::base().'dinas/berkas/cetak')										
			->set('submit_value','Cari Data')
			->set('skpd_list',$this->getList('Skpd','name','Pilih SKPD'))
			->set('tipe_list',array(''=>'Pilih Tipe',1=>'Masuk',2=>'Keluar'))
			->set('keterangan_list',$this->getList('Keterangan','name','Pilih Keterangan Retensi'))
			->set('klasifikasi_list',$this->getList('Klasifikasi',array('kode'=>'0',' - '=>'0','name'=>'0'),'Pilih Klasifikasi','',array(array('kode','ASC'))))	;									
	}
	
	public function action_data() {
		$this->auto_render = false;		
		
		$viewpemberkasans = ORM::factory('Viewpemberkasan')
			->where('skpd_id','=',Auth::instance()->get_user()->skpd_id);
		
		$total_data = $viewpemberkasans->reset(FALSE)->count_all();
		
		$arrFind = array(
			'from' => array('tanggal_surat','>='),
			'to' => array('tanggal_surat','<='),
			'name' => array('name','LIKE'),
			'urut' => array('urut','='),
			'nomor' => array('nomor','LIKE'),
			'klasifikasi_id' => array('klasifikasi_id','='),
			'sotk_id' => array('sotk_id','='),
			'isi' => array('isi','LIKE'),
			'guna_id' => array('guna_id','='),
			'media_id' => array('media_id','='),
			'tingkat_id' => array('tingkat_id','='),
			'tipe' => array('tipe','=')
		);
		
		foreach($arrFind as $f=>$v) {
			if(isset($_POST[$f])) {
				if($_POST[$f]) {
					$value = $_POST[$f];
					if($v[1] == "LIKE") {
						$value = "%".$_POST[$f]."%";
					}
					$viewpemberkasans = $viewpemberkasans->where($v[0],$v[1],$value);
				}
			}
		}
		
		if($_REQUEST['search']['value']) {
			$viewpemberkasans = $viewpemberkasans
				->where('keyword','LIKE','%'.$_REQUEST['search']['value'].'%');
		}
		
		$total_filtered = $viewpemberkasans->reset(FALSE)->count_all();
		
		$viewpemberkasans = $viewpemberkasans
			->offset($_REQUEST['start'])
			->limit($_REQUEST['length'])
			->order_by('tanggal_surat','ASC')
			->find_all();
		
		$arrData = array();
		$i = 1;
		foreach($viewpemberkasans as $viewpemberkasan) {
			$tanggal_surat = new DateTime($viewpemberkasan->tanggal_surat);	
			
			if($viewpemberkasan->tipe > 1) {
				$keluar = ORM::factory('Keluar',$viewpemberkasan->id);
				$unit_pengolah = ORM::factory('Sotk',$keluar->sotk_id)->name;
			}
			else {
				$note = ORM::factory('Viewnote')
					->where('masuk_id','=',$viewpemberkasan->id);
					
				$n = $note->reset(FALSE)->count_all();
				
				$unit_pengolah = "TU";
				if($n) {
					$note = $note
						->order_by('id','DESC')
						->find();
				
					$unit_pengolah = ORM::factory('Sotk',$note->tujuan)->name;
				}
			}			
				
			$arrData[] = array(
				$i + $_REQUEST['start'],
				$viewpemberkasan->kode,
				$tanggal_surat->format("d-m-Y"),
				$viewpemberkasan->nomor,
				$viewpemberkasan->isi,
				$viewpemberkasan->tipe_name,
				$viewpemberkasan->tahun_aktif,
				$viewpemberkasan->tahun_inaktif,
				$viewpemberkasan->keterangan_kode,
				$unit_pengolah
			);
			
			$i++;
		}
		
		$json_data = array(
			"draw"            => intval($_REQUEST['draw'] ),    
			"recordsTotal"    => intval($total_data),  
			"recordsFiltered" => intval($total_filtered), 
			"data"            => $arrData
		);
		
		echo json_encode($json_data);
	}
}
?>