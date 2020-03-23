<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Admin_Keluar extends Controller_Admin_Backend {
	public $auth_required = array('login');
	
	function action_index(){		
		$keluar = ORM::factory('Keluar');
		
		if(!isset($_REQUEST['tanggal_surat_start'])) {
			$keluar = $keluar->where(DB::expr('YEAR(tanggal_surat)'),'=',date("Y"));
		}
			
		$arrFind = array('urut','tanggal_surat_start','skpd_id','kepada','nomor','klasifikasi_id','name','unit_id','isi','guna_id','tingkat_id','media_id');
		$this->getSearch($keluar,$arrFind);
		
		$count 	= $keluar->reset(FALSE)->count_all();
		$config	= Kohana::$config->load('arsip');
		
		$pagination = Pagination::factory(array(
			'total_items'    	=> $count,
			'items_per_page' 	=> 15,
			'auto_hide'			=> FALSE,
		));
				
		$results = $keluar
			->order_by(DB::expr('CAST(urut AS SIGNED)'),'DESC')
			->limit($pagination->items_per_page)
			->offset($pagination->offset)
			->find_all();				
		
		$page_links		= $pagination->render('pagination/diggs');
		$i				= $pagination->offset+1;
		$url 			= URL::base()."keluar?s=1";
		$submit_value 	= "Cari";
		
		$config	= Kohana::$config->load('configuration');
		$dir_doc = $config->get('config_dir_doc');
		if(substr(strtoupper(PHP_OS),0,3) == "WIN"){
			$separator = "\\";
		}
		else {
			$separator = "/";
		}
		
		$this->template->content = View::factory('admin/keluar')
			->bind('results', $results)
			->bind('page_links', $page_links)
			->bind('i', $i)
			->bind('url',$url)
			->bind('submit_value',$submit_value)
			->bind('num_rows',$count)
			->set('separator',$this->getSeparator())
			->set('dir_doc',$dir_doc)			
			->set('keyword',$this->getKeyword($arrFind));
	}
		
	public function action_new() {		
		$this->template->content = View::factory('admin/keluar_form')
			->bind('errors',$error)
			->bind('form',$form)
			->set('submit_value',"Tambah Data")	
			->set('url',URL::base().'admin/keluar/save')
			->set('file','Copy Digital belum tersedia')
			->set('guna_list',$this->getList('Guna','name','Pilih Nilai Guna'))
			->set('media_list',$this->getList('Media','name','Pilih Media'))
			->set('tingkat_list',$this->getList('Tingkat','name','Pilih Tingkat Perkembangan'))
			->set('lampiran_list',$this->getList('Lampiran','name','Pilih Lampiran'))
			->set('skpd_list',$this->getList('Skpd','name','Pilih jika Pengirim kepada SKPD',array(array('id','>',1)),array(array('name','ASC'))))
			->set('klasifikasi_list',$this->getList('Klasifikasi',array('kode'=>'0',' - '=>'0','name'=>'0'),'Pilih Klasifikasi','',array(array('kode','ASC'))))
			->set('sotk_list',$this->getList('Sotk','name','Pilih SOTK',array(array('skpd_id','=',Auth::instance()->get_user()->skpd_id))));
	}

	public function action_edit() {
		$id = $this->request->param('id');
		$keluar = ORM::factory('Keluar',$id);
		
		$form = array();
		$fields = ORM::factory('Keluar')->list_columns();
		foreach($fields as $field) {
			$column = $field['column_name'];
			$form[$field['column_name']] = strip_tags($keluar->$column);
		}
		
		$config = Kohana::$config->load('configuration');
		$dir = $config->get('config_dir_doc');
		
		$file = "<b><font color='red'>Copy Digital tidak tersedia</font></b>";
		if(is_file($dir.$this->getSeparator().$keluar->file)) {
			$file = "<a class='conbtn'>".$keluar->file."</a>";
		}

		$this->template->content = View::factory('admin/keluar_form')			
			->bind('form',$form)
			->set('submit_value',"Update Data")	
			->set('url',URL::base().'admin/keluar/update/'.$id)
			->set('guna_list',$this->getList('Guna','name','Pilih Nilai Guna'))
			->set('media_list',$this->getList('Media','name','Pilih Media'))
			->set('tingkat_list',$this->getList('Tingkat','name','Pilih Tingkat Perkembangan'))
			->set('lampiran_list',$this->getList('Lampiran','name','Pilih Lampiran'))
			->set('skpd_list',$this->getList('Skpd','name','Pilih jika Pengirim kepada SKPD',array(array('id','>',1)),array(array('name','ASC'))))
			->set('klasifikasi_list',$this->getList('Klasifikasi',array('kode'=>'0',' - '=>'0','name'=>'0'),'Pilih Klasifikasi','',array(array('kode','ASC'))))
			->set('sotk_list',$this->getList('Sotk','name','Pilih SOTK',array(array('skpd_id','=',Auth::instance()->get_user()->skpd_id))))
			->bind('file',$file)
			->set('id',$id);
	}
	
	public function action_save() {	
		try {		
			$keluar = ORM::factory('Keluar');
			
			$_POST['file'] = "";	
			if($_FILES['file']['error'] == 0) {
				$config = Kohana::$config->load('configuration');
				$dir = $config->get('config_dir_doc');

				$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
				$filename = date("YmdHis").".".$ext;
				$_POST['file'] = $filename;					
				
				Upload::save($_FILES['file'],$filename,$dir,0777);
			}

			$_POST['isi'] = nl2br($_POST['isi']);				
			$_POST['skpd_id'] = Auth::instance()->get_user()->skpd_id;
			$_POST['user_id'] = Auth::instance()->get_user()->id;
			$_POST['updated'] = date("Y-m-d H:i:s");
				
			$keluar->create_keluar($_POST, array_keys($this->getField('Keluar')));

			HTTP::redirect(URL::base()."admin/keluar");			
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');		
			
			$this->template->content = View::factory('admin/keluar_form')
				->bind('error', $errors)
				->bind('form', $_POST)
				->set('url',URL::base().'admin/keluar/save')
				->set('guna_list',$this->getList('Guna','name','Pilih Nilai Guna'))
				->set('media_list',$this->getList('Media','name','Pilih Media'))
				->set('tingkat_list',$this->getList('Tingkat','name','Pilih Tingkat Perkembangan'))
				->set('lampiran_list',$this->getList('Lampiran','name','Pilih Lampiran'))
				->set('skpd_list',$this->getList('Skpd','name','Pilih jika Pengirim kepada SKPD',array(array('id','>',1)),array(array('name','ASC'))))
				->set('klasifikasi_list',$this->getList('Klasifikasi',array('kode'=>'0',' - '=>'0','name'=>'0'),'Pilih Klasifikasi','',array(array('kode','ASC'))))
				->set('sotk_list',$this->getList('Sotk','name','Pilih SOTK',array(array('skpd_id','=',Auth::instance()->get_user()->skpd_id))))
				->set('file','')
				->set('submit_value','Tambah Data');
		}
	}
	
	public function action_update() {	
		$id = $this->request->param('id');
		$keluar = ORM::factory('Keluar',$id);
		
		$config = Kohana::$config->load('configuration');
		$dir = $config->get('config_dir_doc');
		
		$file = "<b><font color='red'>Copy Digital tidak tersedia</font></b>";
		if(is_file($dir.$this->getSeparator().$keluar->file)) {
			$file = "<a class='conbtn'>".$keluar->file."</a>";
		}
			
		try {
			if(isset($_POST['delete'])) {
				if(is_file($dir.$this->getSeparator().$keluar->file)) {
					unlink($dir.$this->getSeparator().$keluar->file);				
				}
				$keluar->delete($id);				
			}
			else {
				$_POST['file'] = $keluar->file;	
				if($_FILES['file']['error'] == 0) {
					if(is_file($dir.$this->getSeparator().$keluar->file)) {
						unlink($dir.$this->getSeparator().$keluar->file);				
					}
					
					$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
					$filename = date("YmdHis").".".$ext;
					$_POST['file'] = $filename;					
					
					Upload::save($_FILES['file'],$filename,$dir,0777);
				}
				
				$_POST['isi'] = nl2br($_POST['isi']);				
				$_POST['skpd_id'] = Auth::instance()->get_user()->skpd_id;
				$_POST['user_id'] = Auth::instance()->get_user()->id;
				$_POST['updated'] = date("Y-m-d H:i:s");

				$keluar->update_keluar($_POST, array_keys($this->getField('Keluar')));								
			}
			
			HTTP::redirect(URL::base()."admin/keluar");			
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');	

			$this->template->content = View::factory('admin/keluar_form')
				->bind('error', $errors)
				->bind('form', $_POST)
				->set('url',URL::base().'admin/keluar/update/'.$id)
				->set('guna_list',$this->getList('Guna','name','Pilih Nilai Guna'))
				->set('media_list',$this->getList('Media','name','Pilih Media'))
				->set('tingkat_list',$this->getList('Tingkat','name','Pilih Tingkat Perkembangan'))
				->set('lampiran_list',$this->getList('Lampiran','name','Pilih Lampiran'))
				->set('skpd_list',$this->getList('Skpd','name','Pilih jika Pengirim kepada SKPD',array(array('id','>',1)),array(array('name','ASC'))))
				->set('klasifikasi_list',$this->getList('Klasifikasi',array('kode'=>'0',' - '=>'0','name'=>'0'),'Pilih Klasifikasi','',array(array('kode','ASC'))))
				->set('sotk_list',$this->getList('Sotk','name','Pilih SOTK',array(array('skpd_id','=',Auth::instance()->get_user()->skpd_id))))
				->bind('file',$file)
				->set('submit_value','Update Data');
		}
	}
	
	public function action_kk() {
		$this->auto_render = false;
		$id = $this->request->param('id');
		
		$keluar = ORM::factory('Keluar',$id);
		echo View::factory('admin/keluar_kk')
			->bind('keluar',$keluar);			
	}

	public function action_cetak() {
		$this->auto_render = false;
		
		$keluar = ORM::factory('Keluar')
			->where('skpd_id','=',Auth::instance()->get_user()->skpd_id);
			
		$arrFind = array('urut','tanggal_surat_start','skpd_id','kepada','nomor','klasifikasi_id','name','unit_id','isi','guna_id','tingkat_id','media_id');
		$this->getSearch($keluar,$arrFind);		
			
		$results = $keluar
			->order_by(DB::expr('CAST(urut AS SIGNED)'),'DESC')
			->find_all();
			
		$title = "DAFTAR SURAT KELUAR";
		
		$view = View::factory('admin/keluar_cetak')
			->bind('results', $results)
			->bind('title',$title);

		echo $view;
	}
	
	public function get_file_extension($file_name) {
		return substr(strrchr($file_name,'.'),1);
	}
	
	public function action_search() {
		$this->auto_render = false;
		
		echo View::factory('admin/keluar_search')
			->set('url',URL::base().'admin/keluar')										
			->set('submit_value','Cari Data')
			->set('skpd_list',$this->getList('Skpd','name','Pilih SKPD'))
			->set('guna_list',$this->getList('Guna','name','Pilih Nilai Guna'))
			->set('media_list',$this->getList('Media','name','Pilih Media'))
			->set('tingkat_list',$this->getList('Tingkat','name','Pilih Tingkat Perkembangan'))
			->set('lampiran_list',$this->getList('Lampiran','name','Pilih Lampiran'))
			->set('klasifikasi_list',$this->getList('Klasifikasi',array('kode'=>'0',' - '=>'0','name'=>'0'),'Pilih Klasifikasi','',array(array('kode','ASC'))));										
	}
	
	public function action_filter() {
		$this->auto_render = false;
		
		echo View::factory('admin/keluar_filter')
			->set('url',URL::base().'admin/keluar/cetak')										
			->set('submit_value','Cari Data')
			->set('guna_list',$this->getList('Guna','name','Pilih Nilai Guna'))
			->set('media_list',$this->getList('Media','name','Pilih Media'))
			->set('tingkat_list',$this->getList('Tingkat','name','Pilih Tingkat Perkembangan'))
			->set('lampiran_list',$this->getList('Lampiran','name','Pilih Lampiran'))
			->set('klasifikasi_list',$this->getList('Klasifikasi',array('kode'=>'0',' - '=>'0','name'=>'0'),'Pilih Klasifikasi','',array(array('kode','ASC'))));										
	}
	
	public function action_data() {
		$this->auto_render = false;		
		
		$viewkeluars = ORM::factory('Viewkeluar');
		
		if(Auth::instance()->get_user()->jabatan_id == 2) {
			$viewkeluars = $viewkeluars
				->where('skpd_id','=',Auth::instance()->get_user()->skpd_id);
		}
		
		$total_data = $viewkeluars->reset(FALSE)->count_all();

		$viewkeluars = $viewkeluars
			->where('keyword','LIKE','%'.$_REQUEST['search']['value'].'%');
		
		$total_filtered = $viewkeluars->reset(FALSE)->count_all();
		
		$viewkeluars = $viewkeluars
			->offset($_REQUEST['start'])
			->limit($_REQUEST['length'])
			->order_by('tanggal_surat','ASC')
			->find_all();
		
		$config	= Kohana::$config->load('configuration');
		$dir_doc = $config->get('config_dir_doc');
			
		$arrData = array();
		$i = 1;
		foreach($viewkeluars as $viewkeluar) {
            $tanggal_surat = new DateTime($viewkeluar->tanggal_surat);
				
			$file = "";
			if(is_file($dir_doc.$this->getSeparator().$viewkeluar->file) && $viewkeluar->file) {
				$file = "<a class='conbtn btn btn-danger btn-xs' data-fancybox-type='iframe' href='".URL::base()."assets/doc/".$viewkeluar->file."' title='File'><i class='fa fa-file'></i></a>";
			}
				
			$arrData[] = array(
				$i + $_REQUEST['start'],
			    "<a target='_blank' class='btn btn-warning btn-xs' href='".URL::base().'admin/keluar/kk/'.$viewkeluar->id."' title='Kartu Kendali'><i class='fa fa-print'></i></a>&nbsp;".
			    $file,
				$viewkeluar->urut,
				$tanggal_surat->format("d-m-Y"),
				"<a id='".$viewkeluar->id."' href='".URL::base()."admin/keluar/edit/".$viewkeluar->id."'>".$viewkeluar->nomor."</a>",
				$viewkeluar->name,
				$viewkeluar->isi,
				$viewkeluar->kode
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