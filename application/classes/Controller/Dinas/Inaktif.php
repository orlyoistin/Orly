<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Dinas_Inaktif extends Controller_Dinas_Backend {
	public $auth_required = array('login','dinas');
		
	function action_index(){		
		$instansi_id = $this->request->param("id");
		$instansi = ORM::factory('Instansi',$instansi_id);
		
		$this->template->content = View::factory('dinas/inaktif')
			->set('instansi',$instansi);
	}	
		
	public function action_new() {
		$id = $this->request->param('id');
		$instansi = ORM::factory('Instansi',$id);	
		
		$form['instansi_id'] = $id;
		
		if($instansi->masterbool_id > 1) {
			HTTP::redirect(URL::base().'dinas/inaktif/view/'.$inaktif->instansi_id);
		}
		else {			
			$this->template->content = View::factory('dinas/inaktif_form')
				->bind('errors',$error)
				->bind('form',$form)
				->set('url',URL::base().'dinas/inaktif/save')
				->set('klasifikasi_list',$this->getList('Klasifikasi',array('kode'=>'0',' - '=>'0','name'=>'0'),'Pilih Klasifikasi','',array(array('kode','ASC'))))
				->set('guna_list',$this->getList('Guna','name','Pilih Nilai Guna'))
				->set('media_list',$this->getList('Media','name','Pilih Media'))
				->set('tingkat_list',$this->getList('Tingkat','name','Pilih Tingkat Perkembangan'))
				->set('lampiran_list',$this->getList('Lampiran','name','Pilih Lampiran'))
				->set('bulan_list',$this->getList('Bulan','name','Pilih bulan'))
				->set('keterangan_list',$this->getList('Keterangan','name','Pilih Keterangan Retensi'))
				->set('file','Copy Digital belum tersedia')
				->set('submit_value','Tambah Data');
		}
	}

	public function action_edit() {
		$id = $this->request->param('id');
		$inaktif = ORM::factory('Inaktif',$id);
		
		$form = array();
		$fields = ORM::factory('Inaktif')->list_columns();
		foreach($fields as $field) {
			$column = $field['column_name'];
			$form[$field['column_name']] = strip_tags($inaktif->$column);
		}
		
		
		$instansi = ORM::factory('Instansi',$inaktif->instansi_id);
		if($instansi->masterbool_id > 1) {
			HTTP::redirect(URL::base().'inaktif/view/?instansi_id='.$inaktif->instansi_id);
		}
		else {
			$file = "NA";								
			if($inaktif->file) {
				$file = $inaktif->file;
			}
			
			$this->template->content = View::factory('dinas/inaktif_form')			
				->bind('errors',$error)
				->set('form',$form)
				->set('url',URL::base().'dinas/inaktif/update/'.$id)
				->set('klasifikasi_list',$this->getList('Klasifikasi',array('kode'=>'0',' - '=>'0','name'=>'0'),'Pilih Klasifikasi','',array(array('kode','ASC'))))
				->set('guna_list',$this->getList('Guna','name','Pilih Nilai Guna'))
				->set('media_list',$this->getList('Media','name','Pilih Media'))
				->set('tingkat_list',$this->getList('Tingkat','name','Pilih Tingkat Perkembangan'))
				->set('lampiran_list',$this->getList('Lampiran','name','Pilih Lampiran'))
				->set('bulan_list',$this->getList('Bulan','name','Pilih bulan'))
				->set('keterangan_list',$this->getList('Keterangan','name','Pilih Keterangan Retensi'))
				->set('file','Copy Digital belum tersedia')
				->set('submit_value','Update Data')
				->set('id',$id)
				->set('file',$file);			
		}
	}
	
	public function action_save() {	
		try {
			$config = Kohana::$config->load('configuration');
			$dir = $config->get('config_dir_doc');
			
			$inaktif = ORM::factory('Inaktif');
			
			$_POST['file'] = "";	
			if($_FILES['file']['error'] == 0) {
				$config = Kohana::$config->load('configuration');
				$dir = $config->get('config_dir_doc');

				$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
				$filename = date("YmdHis").".".$ext;
				$_POST['file'] = $filename;					
				
				Upload::save($_FILES['file'],$filename,$dir,0777);
			}
			
			$_POST['skpd_id'] = Auth::instance()->get_user()->skpd->id;
			$_POST['user_id'] = Auth::instance()->get_user()->id;
			$inaktif->create_inaktif($_POST, array_keys($this->getField('Inaktif')));
			
			HTTP::redirect(URL::base()."dinas/inaktif/index/".$inaktif->instansi_id);			
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');	
						
			$this->template->content = View::factory('dinas/inaktif_form')
				->bind('error', $errors)
				->bind('form', $_POST)
				->bind('id', $id)
				->set('url',URL::base().'dinas/inaktif/save')
				->set('klasifikasi_list',$this->getList('Klasifikasi',array('kode'=>'0',' - '=>'0','name'=>'0'),'Pilih Klasifikasi','',array(array('kode','ASC'))))
				->set('guna_list',$this->getList('Guna','name','Pilih Nilai Guna'))
				->set('media_list',$this->getList('Media','name','Pilih Media'))
				->set('tingkat_list',$this->getList('Tingkat','name','Pilih Tingkat Perkembangan'))
				->set('lampiran_list',$this->getList('Lampiran','name','Pilih Lampiran'))
				->set('bulan_list',$this->getList('Bulan','name','Pilih bulan'))
				->set('keterangan_list',$this->getList('Keterangan','name','Pilih Keterangan Retensi'))
				->set('file','Copy Digital belum tersedia')
				->set('submit_value','Tambah Data')
				->set('file','');
		}
	}
	
	public function action_update() {	
		$id = $this->request->param('id');
		$inaktif = ORM::factory('Inaktif',$id);
		
		try {
			$config = Kohana::$config->load('configuration');
			$dir = $config->get('config_dir_doc');
			
			if(isset($_POST['delete'])==1) {
				$inaktif->delete($id);
				if(is_file($dir.$this->getSeparator().$inaktif->file) && $inaktif->file) {
					unlink($dir.$this->getSeparator().$inaktif->file);				
				}
			}
			else {
				$filename = $inaktif->file;
				
				$_POST['file'] = $inaktif->file;	
				if($_FILES['file']['error'] == 0) {
					if(is_file($dir.$this->getSeparator().$inaktif->file)) {
						unlink($dir.$this->getSeparator().$inaktif->file);				
					}
					
					$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
					$filename = date("YmdHis").".".$ext;
					$_POST['file'] = $filename;					
					
					Upload::save($_FILES['file'],$filename,$dir,0777);
				}
				
				$_POST['file'] = $filename;
				$_POST['skpd_id'] = Auth::instance()->get_user()->skpd->id;
				$_POST['user_id'] = Auth::instance()->get_user()->id;
				$inaktif->update_inaktif($_POST, array_keys($this->getField('Inaktif')));
			}
			
			HTTP::redirect(URL::base()."dinas/inaktif/index/".$inaktif->instansi_id);			
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');	
			
			$this->template->content = View::factory('dinas/inaktif_form')
				->bind('error', $errors)
				->bind('form', $_POST)
				->set('url',URL::base().'dinas/inaktif/update/'.$id)
				->set('klasifikasi_list',$this->getList('Klasifikasi',array('kode'=>'0',' - '=>'0','name'=>'0'),'Pilih Klasifikasi','',array(array('kode','ASC'))))
				->set('guna_list',$this->getList('Guna','name','Pilih Nilai Guna'))
				->set('media_list',$this->getList('Media','name','Pilih Media'))
				->set('tingkat_list',$this->getList('Tingkat','name','Pilih Tingkat Perkembangan'))
				->set('lampiran_list',$this->getList('Lampiran','name','Pilih Lampiran'))
				->set('bulan_list',$this->getList('Bulan','name','Pilih bulan'))
				->set('keterangan_list',$this->getList('Keterangan','name','Pilih Keterangan Retensi'))
				->set('file','Copy Digital belum tersedia')
				->set('submit_value','Update Data')
				->set('id',$id)
				->set('file',$inaktif->file);
		}
	}
	
	public function action_kendali() {
		$this->auto_render = false;
		$id = $this->request->param('id');
		
		$view = View::factory('kendali')->bind('id',$id);			
		echo $view;
	}

	public function action_cetak() {
		$this->auto_render = false;
		$instansi_id = $this->request->param("id");		
		$instansi = ORM::factory('Instansi',$instansi_id);
		
		$inaktifs = ORM::factory('Viewinaktif')
			->where('instansi_id','=',$instansi->id);
		
		$arrFind	= array('bulan_start','tahun_start','klasifikasi_id','keterangan_id','isi','guna_id','tingkat_id','media_id');
		$this->getSearch($inaktifs,$arrFind);	
					
		$results = $inaktifs
			->order_by('klasifikasi_kode','ASC')
			->order_by('tahun','ASC')
			->order_by('bulan','ASC')
			->find_all();
									
		$view = View::factory('dinas/inaktif_cetak')
			->bind('results', $results)
			->bind('title',$title)
			->bind('instansi',$instansi);
				
		echo $view;
	}
				
	public function action_cari() {
		$this->template->content = View::factory('frm_cari')
			->bind('errors',$error)
			->bind('form',$form)
			->bind('url',$url)
			->bind('id',$id)
			->bind('jenis_id',$jenis_id)
			->bind('unit_list',$unit_list)
			->bind('klasifikasi_id',$klasifikasi_id)
			->bind('kode',$kode)
			->bind('masalah',$masalah)
			->bind('inaktif',$inaktif)
			->bind('inaktif',$inaktif)
			->bind('thn_inaktif',$thn_inaktif)
			->bind('thn_inaktif',$thn_inaktif)
			->bind('keterangan',$keterangan)
			->bind('guna_list',$guna_list)
			->bind('media_list',$media_list)
			->bind('tingkat_list',$tingkat_list)
			->bind('lampiran_list',$lampiran_list)
			->bind('title',$title)
			->bind('submit_value',$submit_value);
		
		$id					= "";		
		$klasifikasi_id 	= "";
		$kode 				= "";
		$masalah 			= "";
		$inaktif 				= "";
		$inaktif 			= "";
		$thn_inaktif 			= "";
		$thn_inaktif 		= "";
		$keterangan 		= "";
		
		$form 				= $this->form;
		$errors				= "";
		$url 				= URL::base().'inaktif/find';
		$title 				= "Cari Arsip inaktif";
		$submit_value	 	= "Cari Arsip inaktif";
		$unit_list 			= $this->getList('unit','name','Pilih Unit');
		$guna_list 			= $this->getList('Guna','name','Pilih Nilai Guna');
		$media_list 		= $this->getList('Media','name','Pilih Media');
		$tingkat_list 		= $this->getList('Tingkat','name','Pilih Tingkat Perkembangan');
		$lampiran_list 		= $this->getList('Lampiran','name','Pilih Lampiran');
	}
	
	function action_find(){					
		$inaktif = ORM::factory('Inaktif');
		
		foreach($arrSession as $var) {
			if(Session::instance()->get($var, NULL)=="") {
				Session::instance()->delete($var);
			}
			else {
				$inaktif->where($var,"LIKE","%".Session::instance()->get($var, NULL)."%");
			}
		}
						
		$this->template->content = View::factory('inaktif')
			->bind('results', $results)
			->bind('page_links', $page_links)
			->bind('i', $i)
			->bind('url',$url)
			->bind('submit_value',$submit_value)
			->bind('num_rows',$count)
			->bind('jenis_list',$jenis_list)
			->bind('instansi_list',$instansi_list)
			->bind('title',$title);
			
		$count = $inaktif->reset(FALSE)->count_all();
		
		$config = Kohana::$config->load('configuration');
		$pagination = Pagination::factory(array(
			'total_items'    	=> $count,
			'items_per_page' 	=> $config->get('items_per_pages'),
			'auto_hide'			=> FALSE,
		));
		
		$jenis = ORM::factory('jenis')->where('id','=',$_GET['jenis'])->find()->jenis;
		
		$results = $inaktif->order_by('tanggal','ASC')->limit($pagination->items_per_page)->offset($pagination->offset)->find_all();				
		$page_links = $pagination->render();
		$i=$pagination->offset+1;
		$url = URL::base().'inaktif';
		$title = "Manage Arsip inaktif ".$jenis;
		$submit_value = "Cari";
		$jenis_list = $this->getList('jenis','','Pilih Jenis');
		$instansi_list = $this->getList('instansi','name','Pilih Instansi');
	}
	
	public function action_search() {
		$this->auto_render = false;
		$id = $this->request->param('id');		
		
		$url = URL::base()."dinas/inaktif/view/".$id;
		$title ="Cari Arsip";
		$submit_value = "Tampilkan Data";
		$jabatan_list = $this->getList('Jabatan','name','1');
		$skpd_list = $this->getList('Skpd','name','1');
		
		$guna_list 			= $this->getList('Guna','name','Pilih Nilai Guna');
		$media_list 		= $this->getList('Media','name','Pilih Media');
		$tingkat_list 		= $this->getList('Tingkat','name','Pilih Tingkat Perkembangan');
		$bulan_list 		= $this->getList('Bulan','name','Pilih bulan');
		
		echo View::factory('dinas/inaktif_search')
			->bind('errors',$error)
			->bind('form',$form)
			->bind('url',$url)
			->bind('guna_list',$guna_list)
			->bind('media_list',$media_list)
			->bind('keterangan_list',$keterangan_list)
			->bind('tingkat_list',$tingkat_list)
			->bind('lampiran_list',$lampiran_list)
			->bind('bulan_list',$bulan_list)
			->bind('title',$title)
			->bind('submit_value',$submit_value)
			->set('klasifikasi_list',$this->getList('Klasifikasi',array('kode'=>'0',' - '=>'0','name'=>'0'),'Pilih Klasifikasi','',array(array('kode','ASC'))))
			->set('keterangan_list',$this->getList('Keterangan','name','Pilih Retensi'));
	}
	
	public function action_filter() {
		$this->auto_render = false;
		$id = $this->request->param('id');		
		
		$url = URL::base()."dinas/inaktif/cetak/".$id;
		$title ="Cetak";
		$submit_value = "Tampilkan Data";
		$jabatan_list = $this->getList('Jabatan','name','1');
		$skpd_list = $this->getList('Skpd','name','1');
		
		$guna_list 			= $this->getList('Guna','name','Pilih Nilai Guna');
		$media_list 		= $this->getList('Media','name','Pilih Media');
		$tingkat_list 		= $this->getList('Tingkat','name','Pilih Tingkat Perkembangan');
		$bulan_list 		= $this->getList('Bulan','name','Pilih bulan');
		
		echo View::factory('dinas/inaktif_filter')
			->bind('errors',$error)
			->bind('form',$form)
			->bind('url',$url)
			->bind('guna_list',$guna_list)
			->bind('media_list',$media_list)
			->bind('keterangan_list',$keterangan_list)
			->bind('tingkat_list',$tingkat_list)
			->bind('lampiran_list',$lampiran_list)
			->bind('bulan_list',$bulan_list)
			->bind('title',$title)
			->bind('submit_value',$submit_value)
			->set('klasifikasi_list',$this->getList('Klasifikasi',array('kode'=>'0',' - '=>'0','name'=>'0'),'Pilih Klasifikasi','',array(array('kode','ASC'))))
			->set('keterangan_list',$this->getList('Keterangan','name','Pilih Retensi'));
	}
	
	public function get_file_extension($file_name) {
		return substr(strrchr($file_name,'.'),1);
	}
	
	public function action_retensi() {
		$this->auto_render = false;
		
		$klasifikasi = ORM::factory('Klasifikasi',$_POST['klasifikasi_id']);
		$ta = $_POST['tahun'] + $klasifikasi->aktif;
		$ti = $_POST['tahun'] + $klasifikasi->aktif + $klasifikasi->inaktif;

		$arrData = array(
			'ra'=>$klasifikasi->aktif,
			'ri'=>$klasifikasi->inaktif,
			'ta'=>$ta,
			'ti'=>$ti,
			'k'=>$klasifikasi->keterangan_id,
		);
		
		echo stripslashes(json_encode($arrData));
	}
	
	public function action_data() {
		$this->auto_render = false;		
		$instansi_id = $this->request->param("id");
		
		$viewinaktifs = ORM::factory('Viewinaktif')
			->where('instansi_id','=',$instansi_id);
		
		$total_data = $viewinaktifs->reset(FALSE)->count_all();
		
		$arrFind = array(
			'name' => array('name','LIKE'),
			'kode' => array('kode','LIKE'),
			'skpd_id' => array('skpd_id','='),
			'masterbool_id' => array('masterbool_id','=')
		);
		
		foreach($arrFind as $f=>$v) {
			if(isset($_POST[$f])) {
				if($_POST[$f]) {
					$value = $_POST[$f];
					if($v[1] == "LIKE") {
						$value = "%".$_POST[$f]."%";
					}
					$viewinaktifs = $viewinaktifs->where($v[0],$v[1],$value);
				}
			}
		}
		
		if($_REQUEST['search']['value']) {
			$viewinaktifs = $viewinaktifs
				->where('keyword','LIKE','%'.$_REQUEST['search']['value'].'%');
		}
		
		$total_filtered = $viewinaktifs->reset(FALSE)->count_all();
		
		$viewinaktifs = $viewinaktifs
			->offset($_REQUEST['start'])
			->limit($_REQUEST['length'])
			->order_by('klasifikasi_kode','ASC')
			->order_by('tahun','ASC')
			->order_by('bulan','ASC')
			->find_all();
		
		$config	= Kohana::$config->load('configuration');
		$dir_doc = $config->get('config_dir_doc');
		
		$arrData = array();
		$i = 1;
		foreach($viewinaktifs as $viewinaktif) {  
        	$file = "";
            if(is_file($dir_doc.$this->getSeparator().$viewinaktif->file) && $viewinaktif->file) {
                $file = "<a class='btn btn-warning btn-xs' data-fancybox data-type='iframe' data-src='".URL::base()."assets/doc/".$viewinaktif->file."' title='File'> <i class='fa fa-file'></i> </a>";
            }	
            
            if($viewinaktif->masterbool_id == 1) {
                $view = "<a class='btn btn-success btn-xs' href='".URL::base()."dinas/inaktif/edit/".$viewinaktif->id."'><i class='fa fa-edit'></i></a> ";
            }
            else {
                $view = "<a class='btn btn-success btn-xs' href='#'><i class='fa fa-edit'></i></a> ";
            }
             
			$arrData[] = array(
				$i + $_REQUEST['start'],
                $view." ".$file,
				$viewinaktif->pelaksana,
                $viewinaktif->hasil,
                $viewinaktif->bulan." / ".$viewinaktif->tahun,
                $viewinaktif->instansi_name,
                $viewinaktif->isi,
				$viewinaktif->user_kode
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