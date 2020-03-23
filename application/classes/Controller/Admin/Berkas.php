<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Admin_Berkas extends Controller_Admin_Backend {
	public $auth_required = array('login');
	
	function action_index(){		
		$viewpemberkasan = ORM::factory('Viewpemberkasan');
		
		if(!isset($_REQUEST['tanggal_surat_start'])) {
			$viewpemberkasan = $viewpemberkasan->where(DB::expr('YEAR(tanggal_surat)'),'=',date("Y"));
		}
			
		$arrFind = array('urut','tanggal_surat_start','skpd_id','nomor','klasifikasi_id','isi','tipe','keterangan_id');
		$this->getSearch($viewpemberkasan,$arrFind);
		
		$count 	= $viewpemberkasan->reset(FALSE)->count_all();
		$config	= Kohana::$config->load('arsip');
		
		$pagination = Pagination::factory(array(
			'total_items'    	=> $count,
			'items_per_page' 	=> 15,
			'auto_hide'			=> FALSE,
		));
				
		$results = $viewpemberkasan
			->order_by('kode','ASC')
			->order_by('tanggal_surat','ASC')
			->limit($pagination->items_per_page)
			->offset($pagination->offset)
			->find_all();				
		
		$page_links		= $pagination->render('pagination/diggs');
		$i				= $pagination->offset+1;
		$url 			= URL::base()."viewpemberkasan?s=1";
		$submit_value 	= "Cari";
		
		$this->template->content = View::factory('admin/berkas')
			->bind('results', $results)
			->bind('page_links', $page_links)
			->bind('i', $i)
			->bind('url',$url)
			->bind('submit_value',$submit_value)
			->bind('num_rows',$count)
			->set('keyword',$this->getKeyword($arrFind));
	}
	
	function action_cetak(){	
		$this->auto_render = false;	
		$viewpemberkasan = ORM::factory('Viewpemberkasan');
		
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
		
		echo View::factory('admin/berkas_cetak')
			->bind('results', $results);
	}
	
	public function action_search() {
		$this->auto_render = false;
		
		echo View::factory('admin/berkas_search')
			->set('url',URL::base().'admin/berkas')										
			->set('submit_value','Cari Data')
			->set('skpd_list',$this->getList('Skpd','name','Pilih SKPD'))
			->set('tipe_list',array(''=>'Pilih Tipe',1=>'Masuk',2=>'Keluar'))
			->set('keterangan_list',$this->getList('Keterangan','name','Pilih Keterangan Retensi'))
			->set('klasifikasi_list',$this->getList('Klasifikasi',array('kode'=>'0',' - '=>'0','name'=>'0'),'Pilih Klasifikasi','',array(array('kode','ASC'))))	;									
	}
	
	public function action_filter() {
		$this->auto_render = false;
		
		echo View::factory('admin/berkas_filter')
			->set('url',URL::base().'admin/berkas/cetak')										
			->set('submit_value','Cari Data')
			->set('skpd_list',$this->getList('Skpd','name','Pilih SKPD'))
			->set('tipe_list',array(''=>'Pilih Tipe',1=>'Masuk',2=>'Keluar'))
			->set('keterangan_list',$this->getList('Keterangan','name','Pilih Keterangan Retensi'))
			->set('klasifikasi_list',$this->getList('Klasifikasi',array('kode'=>'0',' - '=>'0','name'=>'0'),'Pilih Klasifikasi','',array(array('kode','ASC'))))	;									
	}
}
?>