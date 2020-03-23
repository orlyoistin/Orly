<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Dinas_Keluar extends Controller_Dinas_Backend {
	public $auth_required = array('login','dinas');
	
	function action_index(){		
		$this->template->content = View::factory('dinas/keluar');
	}
		
	public function action_new() {		
		$this->template->content = View::factory('dinas/keluar_form')
			->bind('errors',$error)
			->bind('form',$form)
			->set('submit_value',"Tambah Data")	
			->set('url',URL::base().'dinas/keluar/save')
			->set('file','Copy Digital belum tersedia')
			->set('guna_list',$this->getList('Guna','name','Pilih Nilai Guna'))
			->set('media_list',$this->getList('Media','name','Pilih Media'))
			->set('tingkat_list',$this->getList('Tingkat','name','Pilih Tingkat Perkembangan'))
			->set('lampiran_list',$this->getList('Lampiran','name','Pilih Lampiran'))
			->set('skpd_list',$this->getList('Skpd','name','Pilih jika Tujuan kepada SKPD',array(array('id','>',1)),array(array('name','ASC'))))
			->set('klasifikasi_list',$this->getList('Klasifikasi',array('kode'=>'0',' - '=>'0','name'=>'0'),'Pilih Klasifikasi','',array(array('kode','ASC'))))
			->set('sotk_list',$this->getList('Sotk','name','Pilih SOTK',array(array('skpd_id','=',Auth::instance()->get_user()->skpd_id))))
			->set('keterangan_list',$this->getList('Keterangan','name'));
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
			$file = "<a data-fancybox data-type='iframe' data-src='".URL::base()."assets/doc/".$keluar->file."'>".$keluar->file."</a>";
		}

		$this->template->content = View::factory('dinas/keluar_form')			
			->bind('form',$form)
			->set('submit_value',"Update Data")	
			->set('url',URL::base().'dinas/keluar/update/'.$id)
			->set('guna_list',$this->getList('Guna','name','Pilih Nilai Guna'))
			->set('media_list',$this->getList('Media','name','Pilih Media'))
			->set('tingkat_list',$this->getList('Tingkat','name','Pilih Tingkat Perkembangan'))
			->set('lampiran_list',$this->getList('Lampiran','name','Pilih Lampiran'))
			->set('skpd_list',$this->getList('Skpd','name','Pilih jika Pengirim kepada SKPD',array(array('id','>',1)),array(array('name','ASC'))))
			->set('klasifikasi_list',$this->getList('Klasifikasi',array('kode'=>'0',' - '=>'0','name'=>'0'),'Pilih Klasifikasi','',array(array('kode','ASC'))))
			->set('sotk_list',$this->getList('Sotk','name','Pilih SOTK',array(array('skpd_id','=',Auth::instance()->get_user()->skpd_id))))
			->bind('file',$file)
			->set('id',$id)
			->set('keterangan_list',$this->getList('Keterangan','name'));
	}
	
	public function action_save() {	
		try {		
			$keluar = ORM::factory('Keluar');
			
			$filename = "";
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
			$_POST['created'] = date("Y-m-d H:i:s");
			
			/*$urut = 1;
			$n = $keluar->reset(FALSE)->count_all();
			if($n > 0) {
				$c_keluar = ORM::factory('Keluar')
					->where('skpd_id','=',Auth::instance()->get_user()->skpd_id)
					->order_by('id','DESC')
					->find();
				
				$urut = $c_keluar->urut + 1;	
			}
			$_POST['urut'] = $urut;*/
				
			$keluar->create_keluar($_POST, array_keys($this->getField('Keluar')));
			
			HTTP::redirect(URL::base()."dinas/keluar");			
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');		
			
			$this->template->content = View::factory('dinas/keluar_form')
				->bind('error', $errors)
				->bind('form', $_POST)
				->set('url',URL::base().'dinas/keluar/save')
				->set('guna_list',$this->getList('Guna','name','Pilih Nilai Guna'))
				->set('media_list',$this->getList('Media','name','Pilih Media'))
				->set('tingkat_list',$this->getList('Tingkat','name','Pilih Tingkat Perkembangan'))
				->set('lampiran_list',$this->getList('Lampiran','name','Pilih Lampiran'))
				->set('skpd_list',$this->getList('Skpd','name','Pilih jika Pengirim kepada SKPD',array(array('id','>',1)),array(array('name','ASC'))))
				->set('klasifikasi_list',$this->getList('Klasifikasi',array('kode'=>'0',' - '=>'0','name'=>'0'),'Pilih Klasifikasi','',array(array('kode','ASC'))))
				->set('sotk_list',$this->getList('Sotk','name','Pilih SOTK',array(array('skpd_id','=',Auth::instance()->get_user()->skpd_id))))
				->set('file','')
				->set('submit_value','Tambah Data')
				->set('keterangan_list',$this->getList('Keterangan','name'));
		}
	}
	
	public function action_update() {	
		$id = $this->request->param('id');
		$keluar = ORM::factory('Keluar',$id);
		
		$config = Kohana::$config->load('configuration');
		$dir = $config->get('config_dir_doc');
		
		$file = "<b><font color='red'>Copy Digital tidak tersedia</font></b>";
		if(is_file($dir.$this->getSeparator().$keluar->file)) {
			$file = "<a data-fancybox data-type='iframe' data-src='".URL::base()."assets/doc/".$keluar->file."'>".$keluar->file."</a>";
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
			
			HTTP::redirect(URL::base()."dinas/keluar");			
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');	

			$this->template->content = View::factory('dinas/keluar_form')
				->bind('error', $errors)
				->bind('form', $_POST)
				->set('url',URL::base().'dinas/keluar/update/'.$id)
				->set('guna_list',$this->getList('Guna','name','Pilih Nilai Guna'))
				->set('media_list',$this->getList('Media','name','Pilih Media'))
				->set('tingkat_list',$this->getList('Tingkat','name','Pilih Tingkat Perkembangan'))
				->set('lampiran_list',$this->getList('Lampiran','name','Pilih Lampiran'))
				->set('skpd_list',$this->getList('Skpd','name','Pilih jika Pengirim kepada SKPD',array(array('id','>',1)),array(array('name','ASC'))))
				->set('klasifikasi_list',$this->getList('Klasifikasi',array('kode'=>'0',' - '=>'0','name'=>'0'),'Pilih Klasifikasi','',array(array('kode','ASC'))))
				->set('sotk_list',$this->getList('Sotk','name','Pilih SOTK',array(array('skpd_id','=',Auth::instance()->get_user()->skpd_id))))
				->bind('file',$file)
				->set('submit_value','Update Data')
				->set('keterangan_list',$this->getList('Keterangan','name'));
		}
	}
	
	public function action_kk() {
		$this->auto_render = false;
		$id = $this->request->param('id');
		
		$keluar = ORM::factory('Keluar',$id);
		echo View::factory('dinas/keluar_kk')
			->bind('keluar',$keluar);			
	}

	public function action_cetak() {
		$this->auto_render = false;
		
		$keluar = ORM::factory('Keluar')
			->where('skpd_id','=',Auth::instance()->get_user()->skpd_id);
			
		$arrFind = array('urut','tanggal_surat_start','skpd_id','kepada','nomor','klasifikasi_id','name','unit_id','isi','guna_id','tingkat_id','media_id');
		$this->getSearch($keluar,$arrFind);		
			
		$results = $keluar
			->order_by(DB::expr('CAST(urut AS SIGNED)'),'ASC')
			->order_by('id','ASC')
			->find_all();
			
		$title = "DAFTAR SURAT KELUAR";
		
		$view = View::factory('dinas/keluar_cetak')
			->bind('results', $results)
			->bind('title',$title);

		echo $view;
	}
	
	public function action_search() {
		$this->auto_render = false;
		
		echo View::factory('dinas/keluar_search')
			->set('url',URL::base().'dinas/keluar/cetak')										
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
		
		$viewkeluars = ORM::factory('Viewkeluar')
			->where('skpd_id','=',Auth::instance()->get_user()->skpd_id);
		
		$total_data = $viewkeluars->reset(FALSE)->count_all();
		
		$arrFind = array(
			'from_data' => array('tanggal_surat','>='),
			'to_data' => array('tanggal_surat','<='),
			'name_data' => array('name','LIKE'),
			'urut_data' => array('urut','='),
			'nomor_data' => array('nomor','LIKE'),
			'klasifikasi_id_data' => array('klasifikasi_id','='),
			'sotk_id_data' => array('sotk_id','='),
			'isi_data' => array('isi','LIKE'),
			'guna_id_data' => array('guna_id','='),
			'media_id_data' => array('media_id','='),
			'tingkat_id_data' => array('tingkat_id','=')
		);
		
		foreach($arrFind as $f=>$v) {
			if(isset($_POST[$f])) {
				if($_POST[$f]) {
					$value = $_POST[$f];
					if($v[1] == "LIKE") {
						$value = "%".$_POST[$f]."%";
					}
					$viewkeluars = $viewkeluars->where($v[0],$v[1],$value);
				}
			}
		}
		
		$columns = array( 
			2 => 'tanggal',
			3 => 'tanggal_surat',
			4 => 'urut',
			5 => 'nomor',
			6 => 'kepada',
			7 => 'isi'
		);
		
		foreach($columns as $key=>$field) {
			if($_REQUEST['columns'][$key]['search']['value'] != "") {		
				if($key < 5) {
					$viewkeluars = $viewkeluars
						->where($field,'=',$_REQUEST['columns'][$key]['search']['value']);
				}
				else {
					$viewkeluars = $viewkeluars
						->where($field,'LIKE','%'.$_REQUEST['columns'][$key]['search']['value'].'%');
				}
			}
		}
		
		$total_filtered = $viewkeluars->reset(FALSE)->count_all();
		
		$viewkeluars = $viewkeluars
			->offset($_REQUEST['start'])
			->limit($_REQUEST['length'])
			->order_by($columns[$_REQUEST['order'][0]['column']],$_REQUEST['order'][0]['dir'])
			->find_all();
		
		$config	= Kohana::$config->load('configuration');
		$dir_doc = $config->get('config_dir_doc');
			
		$arrData = array();
		$i = 1;
		foreach($viewkeluars as $viewkeluar) {
			$tanggal = new DateTime($viewkeluar->tanggal);
            $tanggal_surat = new DateTime($viewkeluar->tanggal_surat);
				
			$file = "";
			if(is_file($dir_doc.$this->getSeparator().$viewkeluar->file) && $viewkeluar->file) {
				$file = "<a data-fancybox data-type='iframe' class='btn btn-danger btn-xs' data-fancybox-type='iframe' data-src='".URL::base()."assets/doc/".$viewkeluar->file."' title='File'><i class='fa fa-file'></i></a>";
			}
				
			$arrData[] = array(
				$i + $_REQUEST['start'],
			    "<a target='_blank' class='btn btn-warning btn-xs' href='".URL::base().'dinas/keluar/kk/'.$viewkeluar->id."' title='Kartu Kendali'><i class='fa fa-print'></i></a>&nbsp;".
			    $file,
				$tanggal->format("d-m-Y"),
				$tanggal_surat->format("d-m-Y"),
				$viewkeluar->urut,
				"<a id='".$viewkeluar->id."' href='".URL::base()."dinas/keluar/edit/".$viewkeluar->id."'>".$viewkeluar->nomor."</a>",
				$viewkeluar->name,
				$viewkeluar->isi
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