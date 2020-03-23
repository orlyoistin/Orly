<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Admin_Inaktif extends Controller_Admin_Backend {
	public $auth_required = array('login');
		
	function action_index(){		
		$this->template->content = View::factory('admin/instansi');
	}
	
	function action_reload() {
		$this->auto_render = false;
		
		$instansi = ORM::factory('Instansi');
			
		$arrFind = array('kode','name','skpd_id');
		$this->getSearch($instansi,$arrFind);
								
		$count = $instansi->reset(FALSE)->count_all();
		
		$config = Kohana::$config->load('configuration');
		$pagination = Pagination::factory(array(
			'total_items'    	=> $count,
			'items_per_page' 	=> $config->get('items_per_pages'),
			'auto_hide'			=> FALSE,
		));
				
		$results = $instansi
			->order_by('kode','ASC')
			->order_by('skpd_id','ASC')
			->limit($pagination->items_per_page)
			->offset($pagination->offset)
			->find_all();
							
		$page_links 	= str_replace("reload","",$pagination->render('pagination/diggs'));
		$i				= $pagination->offset+1;
		$submit_value	= "Cari";
		
		$view = View::factory('admin/instansi_reload')
			->bind('results', $results)
			->bind('page_links', $page_links)
			->bind('i', $i)
			->bind('url',$url)
			->bind('submit_value',$submit_value)
			->bind('num_rows',$count);
			
		echo $view;
		exit;
	}
	
	function action_view(){		
		$id = $this->request->param('id');
		$inaktif = ORM::factory('Inaktif')
			->where('instansi_id','=',$id);
		
		$arrFind = array('bulan_start','tahun_start','hasil','isi','keterangan_id','klasifikasi_id','guna_id','tingkat_id','media_id');
		$this->getSearch($inaktif,$arrFind);
								
		$count = $inaktif->reset(FALSE)->count_all();
		
		$config = Kohana::$config->load('configuration');
		$pagination = Pagination::factory(array(
			'total_items'    	=> $count,
			'items_per_page' 	=> $config->get('items_per_pages'),
			'auto_hide'			=> FALSE,
		));
				
		$results = $inaktif
			->order_by('klasifikasi_id','ASC')
			->order_by('tahun','ASC')
			->order_by('bulan','ASC')
			->limit($pagination->items_per_page)
			->offset($pagination->offset)
			->find_all();
										
		$config	= Kohana::$config->load('configuration');
		$dir_doc = $config->get('config_dir_doc');		
		
		$this->template->content = View::factory('admin/inaktif')
			->bind('results', $results)
			->set('page_links', str_replace("s=1&","",$pagination->render('pagination/diggs')))
			->set('i', $pagination->offset+1)
			->set('url',URL::base().'admin/inaktif/view/'.$id)
			->set('submit_value','Cari')
			->bind('num_rows',$count)
			->bind('instansi_id',$id)
			->set('separator',$this->getSeparator())
			->set('dir_doc',$dir_doc);
	}	
		
	public function action_new() {
		$id = $this->request->param('id');
		$instansi = ORM::factory('Instansi',$id);	
		
		$form['instansi_id'] = $id;
		
		if($instansi->status->id > 1) {
			HTTP::redirect(URL::base().'admin/inaktif/view/'.$inaktif->instansi_id);
		}
		else {			
			$this->template->content = View::factory('admin/inaktif_form')
				->bind('errors',$error)
				->bind('form',$form)
				->set('url',URL::base().'admin/inaktif/save')
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
		if($instansi->status->id > 1) {
			HTTP::redirect(URL::base().'inaktif/view/?instansi_id='.$inaktif->instansi_id);
		}
		else {
			$file = "NA";								
			if($inaktif->file) {
				$file = $inaktif->file;
			}
			
			$this->template->content = View::factory('admin/inaktif_form')			
				->bind('errors',$error)
				->set('form',$form)
				->set('url',URL::base().'admin/inaktif/update/'.$id)
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
			
			HTTP::redirect(URL::base()."admin/inaktif/view/".$_POST['instansi_id']);			
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');	
						
			$this->template->content = View::factory('admin/inaktif_form')
				->bind('error', $errors)
				->bind('form', $_POST)
				->bind('id', $id)
				->set('url',URL::base().'admin/inaktif/save')
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
			
			HTTP::redirect(URL::base()."admin/inaktif/view/".$_POST['instansi_id']);			
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');	
			
			$this->template->content = View::factory('admin/inaktif_form')
				->bind('error', $errors)
				->bind('form', $_POST)
				->set('url',URL::base().'admin/inaktif/update/'.$id)
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
		
		$inaktifs = ORM::factory('Inaktif')
			->where('instansi_id','=',$instansi->id);
		
		$arrFind	= array('bulan_start','tahun_start','klasifikasi_id','keterangan_id','isi','guna_id','tingkat_id','media_id');
		$this->getSearch($inaktifs,$arrFind);	
					
		$results = $inaktifs
			->order_by('klasifikasi_id','ASC')
			->order_by('tahun','ASC')
			->order_by('bulan','ASC')
			->find_all();
									
		$view = View::factory('admin/inaktif_cetak')
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
		
		$url = URL::base()."admin/inaktif/view/".$id;
		$title ="Cari Arsip";
		$submit_value = "Tampilkan Data";
		$jabatan_list = $this->getList('Jabatan','name','1');
		$skpd_list = $this->getList('Skpd','name','1');
		
		$guna_list 			= $this->getList('Guna','name','Pilih Nilai Guna');
		$media_list 		= $this->getList('Media','name','Pilih Media');
		$tingkat_list 		= $this->getList('Tingkat','name','Pilih Tingkat Perkembangan');
		$bulan_list 		= $this->getList('Bulan','name','Pilih bulan');
		
		echo View::factory('admin/inaktif_search')
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
		
		$url = URL::base()."admin/inaktif/cetak/".$id;
		$title ="Cetak";
		$submit_value = "Tampilkan Data";
		$jabatan_list = $this->getList('Jabatan','name','1');
		$skpd_list = $this->getList('Skpd','name','1');
		
		$guna_list 			= $this->getList('Guna','name','Pilih Nilai Guna');
		$media_list 		= $this->getList('Media','name','Pilih Media');
		$tingkat_list 		= $this->getList('Tingkat','name','Pilih Tingkat Perkembangan');
		$bulan_list 		= $this->getList('Bulan','name','Pilih bulan');
		
		echo View::factory('admin/inaktif_filter')
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
	
	/*public function action_migrasi() {	
		$this->auto_render = false;
		
		$field = array(
						'klasifikasi_id',
						'guna_id',
						'media_id',
						'tingkat_id',
						'lampiran_id',
						'instansi_id',
						'jumlah',
						'bulan',
						'tahun',
						'isi',
						'file',
						'pelaksana',
						'hasil',
						'user_id',
						'skpd_id',
						'ra',
						'ri',
						'ta',
						'ti',
						'k'
					);
		
		$limit = 10000;
		$offset = 10000;
		
		//$sekda = ORM::factory('Sekda')->find_all();
		$sekda = ORM::factory('Sekda')->limit($limit)->offset($offset)->find_all();
		foreach($sekda as $sk) {
			$klasifikasi = ORM::factory('Klasifikasi')->where('kode','=',$sk->Kode_Klasifikasi)->find()->id;
			
			if($sk->Nilai_Guna=="Keu") {
				$guna = "3";
			}
			elseif($sk->Nilai_Guna=="HUKUM") {
				$guna = "2";
			}
			else {
				$guna = "1";
			}
			
			DB::insert('inaktifs',$field)
							->values(array(
										$klasifikasi, 
										$guna, 
										'1', 
										'2',
										'1',
										'74',
										$sk->Jumlah,
										$sk->Bulan,
										$sk->Tahun,
										$sk->Isi_Ringkas,
										'',
										$sk->Kode_Pelaksana,
										$sk->No_Pelaksanaan,
										'54',
										'20',
										$sk->Retensi_Aktif,
										$sk->Retensi_Inaktif,
										$sk->Tahun+$sk->Retensi_Aktif,
										$sk->Tahun+$sk->Retensi_Aktif+$sk->Retensi_Inaktif,
										$sk->Retensi_JRA
							))->execute();
		}
	}*/	

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
		
		$viewinstansis = ORM::factory('Viewinstansi');
		
		if(Auth::instance()->get_user()->jabatan_id == 2) {
			$viewinstansis = $viewinstansis
				->where('skpd_id','=',Auth::instance()->get_user()->skpd_id);
		}
		
		$total_data = $viewinstansis->reset(FALSE)->count_all();

		$viewinstansis = $viewinstansis
			->where('keyword','LIKE','%'.$_REQUEST['search']['value'].'%');
		
		$total_filtered = $viewinstansis->reset(FALSE)->count_all();
		
		$viewinstansis = $viewinstansis
			->offset($_REQUEST['start'])
			->limit($_REQUEST['length'])
			->order_by('kode','ASC')
			->find_all();
			
		$arrData = array();
		$i = 1;
		foreach($viewinstansis as $viewinstansi) {				
			$arrData[] = array(
				$i + $_REQUEST['start'],
			    "<a target='_blank' class='btn btn-warning btn-xs' href='".URL::base().'admin/instansi/kk/'.$viewinstansi->id."' title='Kartu Kendali'><i class='fa fa-print'></i></a>&nbsp;",
			    $viewinstansi->kode,
				$viewinstansi->name,
				$viewinstansi->skpd_name,
				number_format($viewinstansi->n_arsip,0),
				$viewinstansi->status_inaktif
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