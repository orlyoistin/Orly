<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Base extends Controller_Layout {
	public $auth_required = array('login');
	
	function action_skpd() {		
		$this->auto_render = false;
		
		if(isset($_POST['dari'])) {
			$skpd = ORM::factory('Skpd',$_POST['dari']);
		}
		else {
			$skpd = ORM::factory('Skpd',$_POST['kepada']);
		}
		
		echo strtoupper($skpd->name);
	}
	
	function action_klasifikasi() {		
		$this->auto_render = false;
		
		$arrReturn = array();
		$klasifikasis = ORM::factory('Klasifikasi')
			->where('name','LIKE','%'.$_GET['q'].'%')
			->or_where('kode','LIKE','%'.$_GET['q'].'%');
		
		if($klasifikasis->reset(FALSE)->count_all()) {
			$klasifikasis = $klasifikasis->find_all();			
			foreach($klasifikasis as $klasifikasi) {
				$arrReturn[] = array('id' => $klasifikasi->id, 'text' => $klasifikasi->name, 'kode' => $klasifikasi->kode);	
			}		
		}
		else {
			$arrReturn[] = array('id' => '', 'text' => 'Data tidak ditemukan');	
		}
		
		echo json_encode($arrReturn);
	}
	
	function action_jra() {		
		$this->auto_render = false;
		$klasifikasi = ORM::factory('Klasifikasi',$_POST['klasifikasi_id']);
		
		$arrData = array(
			'masalah'=>$klasifikasi->name,
			'ra'=>$klasifikasi->seri->aktif,
			'ri'=>$klasifikasi->seri->inaktif,
			'keterangan'=>$klasifikasi->seri->keterangan->kode
		);
		
		echo stripslashes(json_encode($arrData));		
	}
	
	function action_disposisi() {		
		$this->auto_render = false;
		
		$masterdisposisi = ORM::factory('Masterdisposisi',$_POST['masterdisposisi_id']);
		echo $masterdisposisi->uraian." ";
	}
}
?>