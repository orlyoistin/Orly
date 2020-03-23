<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Admin_Masuk extends Controller_Admin_Backend {
	public $auth_required = array('login');
	
	function action_index() {
		$this->template->content = View::factory('admin/masuk');
	}
		
	public function action_new() {		
		$this->template->content = View::factory('admin/masuk_form')
			->bind('errors',$error)
			->bind('form',$form)
			->set('submit_value',"Tambah Data")	
			->set('url',URL::base().'admin/masuk/save')
			->set('file','Copy Digital belum tersedia')
			->set('guna_list',$this->getList('Guna','name','Pilih Nilai Guna'))
			->set('media_list',$this->getList('Media','name','Pilih Media'))
			->set('tingkat_list',$this->getList('Tingkat','name','Pilih Tingkat Perkembangan'))
			->set('lampiran_list',$this->getList('Lampiran','name','Pilih Lampiran'))
			->set('skpd_list',$this->getList('Skpd','name','Pilih jika Pengirim dari SKPD',array(array('id','>',1)),array(array('name','ASC'))))
			->set('klasifikasi_list',$this->getList('Klasifikasi',array('kode'=>'0',' - '=>'0','name'=>'0'),'Pilih Klasifikasi','',array(array('kode','ASC'))))
			->set('sotk_list',$this->getList('Sotk','name','Pilih SOTK',array(array('skpd_id','=',Auth::instance()->get_user()->skpd_id))));
	}

	public function action_edit() {
		$id = $this->request->param('id');
		$masuk = ORM::factory('Masuk',$id);
		
		$form = array();
		$fields = ORM::factory('Masuk')->list_columns();
		foreach($fields as $field) {
			$column = $field['column_name'];
			$form[$field['column_name']] = strip_tags($masuk->$column);
		}
		
		$config = Kohana::$config->load('configuration');
		$dir = $config->get('config_dir_doc');
		
		$file = "<b><font color='red'>Copy Digital tidak tersedia</font></b>";
		if(is_file($dir.$this->getSeparator().$masuk->file)) {
			$file = "<a class='conbtn' data-fancybox-type='iframe' href='".URL::base()."assets/doc/".$masuk->file."'>".$masuk->file."</a>";
		}

		$this->template->content = View::factory('admin/masuk_form')			
			->bind('form',$form)
			->set('submit_value',"Update Data")	
			->set('url',URL::base().'admin/masuk/update/'.$id)
			->set('guna_list',$this->getList('Guna','name','Pilih Nilai Guna'))
			->set('media_list',$this->getList('Media','name','Pilih Media'))
			->set('tingkat_list',$this->getList('Tingkat','name','Pilih Tingkat Perkembangan'))
			->set('lampiran_list',$this->getList('Lampiran','name','Pilih Lampiran'))
			->set('skpd_list',$this->getList('Skpd','name','Pilih jika Pengirim dari SKPD',array(array('id','>',1)),array(array('name','ASC'))))
			->set('klasifikasi_list',$this->getList('Klasifikasi',array('kode'=>'0',' - '=>'0','name'=>'0'),'Pilih Klasifikasi','',array(array('kode','ASC'))))
			->set('sotk_list',$this->getList('Sotk','name','Pilih SOTK',array(array('skpd_id','=',Auth::instance()->get_user()->skpd_id))))
			->bind('file',$file)
			->set('id',$id);
	}
	
	public function action_save() {	
		try {		
			$masuk = ORM::factory('Masuk');
			
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
			
			$urut = 1;
			$n = $masuk->reset(FALSE)->count_all();
			if($n > 0) {
				$masuk = $masuk
					->where('skpd_id','=',Auth::instance()->get_user()->skpd_id)
					->order_by('id','DESC')
					->find();
				
				$urut = $masuk->urut + 1;	
			}
				
			$masuk->create_masuk($_POST, array_keys($this->getField('Masuk')));
			
			if($this->request->post('sotk_id')) {
				$arrField = array(
					'tanggal', 
					'masuk_id', 
					'skpd_id', 
					'sotk_id', 
					'rekomendasi', 
					'prioritas',
					'masterbool_id',
					'created', 
					'user_id'
				);
				
				$values = array(
					$this->request->post('tanggal_diteruskan'),
					$masuk->id,
					$masuk->skpd_id,
					$this->request->post('sotk_id'),
					$this->request->post('rekomendasi'),
					$this->request->post('prioritas'),
					1,
					date("Y-m-d"),
					Auth::instance()->get_user()->id
				);
				
				$q = DB::insert('distributions', $arrField)
					->values($values)
					->execute();
			}

			HTTP::redirect(URL::base()."admin/masuk");			
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');		
			
			$this->template->content = View::factory('admin/masuk_form')
				->bind('error', $errors)
				->bind('form', $_POST)
				->set('url',URL::base().'admin/masuk/save')
				->set('guna_list',$this->getList('Guna','name','Pilih Nilai Guna'))
				->set('media_list',$this->getList('Media','name','Pilih Media'))
				->set('tingkat_list',$this->getList('Tingkat','name','Pilih Tingkat Perkembangan'))
				->set('lampiran_list',$this->getList('Lampiran','name','Pilih Lampiran'))
				->set('skpd_list',$this->getList('Skpd','name','Pilih jika Pengirim dari SKPD',array(array('id','>',1)),array(array('name','ASC'))))
				->set('klasifikasi_list',$this->getList('Klasifikasi',array('kode'=>'0',' - '=>'0','name'=>'0'),'Pilih Klasifikasi','',array(array('kode','ASC'))))
				->set('sotk_list',$this->getList('Sotk','name','Pilih SOTK',array(array('skpd_id','=',Auth::instance()->get_user()->skpd_id))))
				->set('file','')
				->set('submit_value','Tambah Data');
		}
	}
	
	public function action_update() {	
		$id = $this->request->param('id');
		$masuk = ORM::factory('Masuk',$id);
		
		$config = Kohana::$config->load('configuration');
		$dir = $config->get('config_dir_doc');
		
		$file = "<b><font color='red'>Copy Digital tidak tersedia</font></b>";
		if(is_file($dir.$this->getSeparator().$masuk->file)) {
			$file = "<a class='conbtn'>".$masuk->file."</a>";
		}
			
		try {
			if(isset($_POST['delete'])) {
				if(is_file($dir.$this->getSeparator().$masuk->file)) {
					unlink($dir.$this->getSeparator().$masuk->file);				
				}
				$masuk->delete($id);				
			}
			else {
				$_POST['file'] = $masuk->file;	
				if($_FILES['file']['error'] == 0) {
					if(is_file($dir.$this->getSeparator().$masuk->file)) {
						unlink($dir.$this->getSeparator().$masuk->file);				
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

				$masuk->update_masuk($_POST, array_keys($this->getField('Masuk')));								
			}
			
			HTTP::redirect(URL::base()."admin/masuk");			
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');	

			$this->template->content = View::factory('admin/masuk_form')
				->bind('error', $errors)
				->bind('form', $_POST)
				->set('url',URL::base().'admin/masuk/update/'.$id)
				->set('guna_list',$this->getList('Guna','name','Pilih Nilai Guna'))
				->set('media_list',$this->getList('Media','name','Pilih Media'))
				->set('tingkat_list',$this->getList('Tingkat','name','Pilih Tingkat Perkembangan'))
				->set('lampiran_list',$this->getList('Lampiran','name','Pilih Lampiran'))
				->set('skpd_list',$this->getList('Skpd','name','Pilih jika Pengirim dari SKPD',array(array('id','>',1)),array(array('name','ASC'))))
				->set('klasifikasi_list',$this->getList('Klasifikasi',array('kode'=>'0',' - '=>'0','name'=>'0'),'Pilih Klasifikasi','',array(array('kode','ASC'))))
				->set('sotk_list',$this->getList('Sotk','name','Pilih SOTK',array(array('skpd_id','=',Auth::instance()->get_user()->skpd_id))))
				->bind('file',$file)
				->set('submit_value','Update Data')
				->set('id',$id);
		}
	}
	
	public function action_kk() {
		$this->auto_render = false;
		$id = $this->request->param('id');
		
		$masuk = ORM::factory('Masuk',$id);
		
		$x_unit = explode("#",$masuk->akses_sotk);
		
		
		echo View::factory('admin/masuk_kk')
			->bind('masuk',$masuk)
			->bind('unit',$unit);			
	}

	public function action_cetak() {
		$this->auto_render = false;
		
		$masuk = ORM::factory('Masuk')
			->where('skpd_id','=',Auth::instance()->get_user()->skpd_id);
			
		$arrFind = array('urut','tanggal_surat_start','skpd_id','sotk_id','dari','nomor','klasifikasi_id','name','unit_id','isi','guna_id','tingkat_id','media_id');
		$this->getSearch($masuk,$arrFind);

		$results = $masuk
			->order_by(DB::expr('CAST(urut AS SIGNED)'),'ASC')
			->find_all();
			
		$title = "DAFTAR SURAT MASUK";
		
		$view = View::factory('admin/masuk_cetak')
			->bind('results', $results)
			->bind('title',$title);

		echo $view;
	}
	
	public function get_file_extension($file_name) {
		return substr(strrchr($file_name,'.'),1);
	}
	
	public function action_search() {
		$this->auto_render = false;
		
		echo View::factory('admin/masuk_search')
			->set('url',URL::base().'admin/masuk')										
			->set('submit_value','Cari Data')
			->set('skpd_list',$this->getList('Skpd','name','Pilih SKPD'))
			->set('guna_list',$this->getList('Guna','name','Pilih Nilai Guna'))
			->set('media_list',$this->getList('Media','name','Pilih Media'))
			->set('tingkat_list',$this->getList('Tingkat','name','Pilih Tingkat Perkembangan'))
			->set('lampiran_list',$this->getList('Lampiran','name','Pilih Lampiran'))
			->set('klasifikasi_list',$this->getList('Klasifikasi',array('kode'=>'0',' - '=>'0','name'=>'0'),'Pilih Klasifikasi','',array(array('kode','ASC'))))										
			->set('sotk_list',$this->getList('Sotk','name','Pilih SOTK',array(array('skpd_id','=',Auth::instance()->get_user()->skpd_id))));
	}
	
	public function action_filter() {
		$this->auto_render = false;
		
		echo View::factory('admin/masuk_filter')
			->set('url',URL::base().'admin/masuk/cetak')										
			->set('submit_value','Cari Data')
			->set('guna_list',$this->getList('Guna','name','Pilih Nilai Guna'))
			->set('media_list',$this->getList('Media','name','Pilih Media'))
			->set('tingkat_list',$this->getList('Tingkat','name','Pilih Tingkat Perkembangan'))
			->set('lampiran_list',$this->getList('Lampiran','name','Pilih Lampiran'))
			->set('klasifikasi_list',$this->getList('Klasifikasi',array('kode'=>'0',' - '=>'0','name'=>'0'),'Pilih Klasifikasi','',array(array('kode','ASC'))))										
			->set('sotk_list',$this->getList('Sotk','name','Pilih SOTK',array(array('skpd_id','=',Auth::instance()->get_user()->skpd_id))));
	}
	
	public function action_data() {
		$this->auto_render = false;		
		
		$viewmasuks = ORM::factory('Viewmasuk');
		
		if(Auth::instance()->get_user()->jabatan_id == 2) {
			$viewmasuks = $viewmasuks
				->where('skpd_id','=',Auth::instance()->get_user()->skpd_id);
		}
		
		$total_data = $viewmasuks->reset(FALSE)->count_all();
		
		if($_REQUEST['search']['value']) {
			$viewmasuks = $viewmasuks
				->where('keyword','LIKE','%'.$_REQUEST['search']['value'].'%');
		}
		
		$total_filtered = $viewmasuks->reset(FALSE)->count_all();
		
		$viewmasuks = $viewmasuks
			->offset($_REQUEST['start'])
			->limit($_REQUEST['length'])
			->find_all();
		
		$config	= Kohana::$config->load('configuration');
		$dir_doc = $config->get('config_dir_doc');
			
		$arrData = array();
		$i = 1;
		foreach($viewmasuks as $viewmasuk) {
			$tanggal_terima = new DateTime($viewmasuk->tanggal_terima);
            $tanggal_surat = new DateTime($viewmasuk->tanggal_surat);
				
			$file = "";
			if(is_file($dir_doc.$this->getSeparator().$viewmasuk->file) && $viewmasuk->file) {
				$file = "<a class='conbtn btn btn-danger btn-xs' data-fancybox-type='iframe' href='".URL::base()."assets/doc/".$viewmasuk->file."' title='File'><i class='fa fa-file'></i></a>";
			}
				
			$arrData[] = array(
				$i + $_REQUEST['start'],
				"<a class='btn btn-primary btn-xs' href='".URL::base().'admin/disposisi/index/'.$viewmasuk->id."' title='Disposisi'><i class='fa fa-sort-amount-asc'></i></a>
			    <a target='_blank' class='btn btn-warning btn-xs' href='".URL::base().'admin/masuk/kk/'.$viewmasuk->id."' title='Kartu Kendali'><i class='fa fa-print'></i></a>&nbsp;".
			    $file,
				"<span class='fa fa-envelope-o' aria-hidden='true'></span> ".$tanggal_terima->format("d-m-Y")."<br>"."<span class='fa fa-envelope' aria-hidden='true'></span> ".$tanggal_surat->format("d-m-Y"),
				"<a id='".$viewmasuk->id."' href='".URL::base()."admin/masuk/edit/".$viewmasuk->id."'>".$viewmasuk->nomor."</a>",
				$viewmasuk->name,
				$viewmasuk->isi,
				$viewmasuk->kode
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