<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Dinas_Masuk extends Controller_Dinas_Backend {
	public $auth_required = array('login','dinas');
	
	function action_index() {
		$this->template->content = View::factory('dinas/masuk');
	}
		
	public function action_new() {		
		$this->template->content = View::factory('dinas/masuk_form')
			->bind('errors',$error)
			->bind('form',$form)
			->set('submit_value',"Tambah Data")	
			->set('url',URL::base().'dinas/masuk/save')
			->set('file','Copy Digital belum tersedia')
			->set('guna_list',$this->getList('Guna','name','Pilih Nilai Guna'))
			->set('media_list',$this->getList('Media','name','Pilih Media'))
			->set('tingkat_list',$this->getList('Tingkat','name','Pilih Tingkat Perkembangan'))
			->set('lampiran_list',$this->getList('Lampiran','name','Pilih Lampiran'))
			->set('skpd_list',$this->getList('Skpd','name','Pilih jika Pengirim dari SKPD','',array(array('name','ASC'))))
			->set('klasifikasi_list',$this->getList('Klasifikasi',array('kode'=>'0',' - '=>'0','name'=>'0'),'Pilih Klasifikasi','',array(array('kode','ASC'))))
			->set('sotk_list',$this->getList('Sotk','name','Pilih SOTK',array(array('skpd_id','=',Auth::instance()->get_user()->skpd_id))))
			->set('keterangan_list',$this->getList('Keterangan','name'));
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
			$file = "<a data-fancybox data-type='iframe' data-src='".URL::base()."assets/doc/".$masuk->file."'>".$masuk->file."</a>";
		}

		$this->template->content = View::factory('dinas/masuk_form')			
			->bind('form',$form)
			->set('submit_value',"Update Data")	
			->set('url',URL::base().'dinas/masuk/update/'.$id)
			->set('guna_list',$this->getList('Guna','name','Pilih Nilai Guna'))
			->set('media_list',$this->getList('Media','name','Pilih Media'))
			->set('tingkat_list',$this->getList('Tingkat','name','Pilih Tingkat Perkembangan'))
			->set('lampiran_list',$this->getList('Lampiran','name','Pilih Lampiran'))
			->set('skpd_list',$this->getList('Skpd','name','Pilih jika Pengirim dari SKPD','',array(array('name','ASC'))))
			->set('klasifikasi_list',$this->getList('Klasifikasi',array('kode'=>'0',' - '=>'0','name'=>'0'),'Pilih Klasifikasi','',array(array('kode','ASC'))))
			->set('sotk_list',$this->getList('Sotk','name','Pilih SOTK',array(array('skpd_id','=',Auth::instance()->get_user()->skpd_id))))
			->bind('file',$file)
			->set('id',$id)
			->set('keterangan_list',$this->getList('Keterangan','name'));
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
			$_POST['created'] = date("Y-m-d H:i:s");
			$_POST['skpd_induk'] = Auth::instance()->get_user()->skpd_id;
			
			$klasifikasi = ORM::factory('Klasifikasi',$_POST['klasifikasi_id']);
			$tahun_surat = substr($_POST['tanggal_surat'],0,4);
			$_POST['retensi_aktif'] = $klasifikasi->aktif;
			$_POST['retensi_inaktif'] = $klasifikasi->inaktif;
			$_POST['tahun_aktif'] = $tahun_surat + $klasifikasi->aktif;
			$_POST['tahun_inaktif'] = $tahun_surat + $klasifikasi->aktif + $klasifikasi->inaktif;
			
			if($this->request->post('sotk_id')) {
				$_POST['akses_sotk'] = "#".$this->request->post('sotk_id')."#";
			}
			
			/*$urut = 1;
			$n = $masuk->reset(FALSE)->count_all();
			if($n > 0) {
				$c_masuk = ORM::factory('Masuk')
					->where('skpd_id','=',Auth::instance()->get_user()->skpd_id)
					->order_by('id','DESC')
					->find();
				
				$urut = $c_masuk->urut + 1;	
			}
			$_POST['urut'] = $urut;*/
				
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

			HTTP::redirect(URL::base()."dinas/masuk");			
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');		
			
			$this->template->content = View::factory('dinas/masuk_form')
				->bind('error', $errors)
				->bind('form', $_POST)
				->set('url',URL::base().'dinas/masuk/save')
				->set('guna_list',$this->getList('Guna','name','Pilih Nilai Guna'))
				->set('media_list',$this->getList('Media','name','Pilih Media'))
				->set('tingkat_list',$this->getList('Tingkat','name','Pilih Tingkat Perkembangan'))
				->set('lampiran_list',$this->getList('Lampiran','name','Pilih Lampiran'))
				->set('skpd_list',$this->getList('Skpd','name','Pilih jika Pengirim dari SKPD','',array(array('name','ASC'))))
				->set('klasifikasi_list',$this->getList('Klasifikasi',array('kode'=>'0',' - '=>'0','name'=>'0'),'Pilih Klasifikasi','',array(array('kode','ASC'))))
				->set('sotk_list',$this->getList('Sotk','name','Pilih SOTK',array(array('skpd_id','=',Auth::instance()->get_user()->skpd_id))))
				->set('file','')
				->set('submit_value','Tambah Data')
				->set('keterangan_list',$this->getList('Keterangan','name'));
		}
	}
	
	public function action_update() {	
		$id = $this->request->param('id');
		$masuk = ORM::factory('Masuk',$id);
		
		$config = Kohana::$config->load('configuration');
		$dir = $config->get('config_dir_doc');
		
		$file = "<b><font color='red'>Copy Digital tidak tersedia</font></b>";
		if(is_file($dir.$this->getSeparator().$masuk->file)) {
			$file = "<a data-fancybox data-type='iframe' data-src='".URL::base()."assets/doc/".$masuk->file."'>".$masuk->file."</a>";
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
				$_POST['skpd_induk'] = Auth::instance()->get_user()->skpd_id;
				
				$klasifikasi = ORM::factory('Klasifikasi',$_POST['klasifikasi_id']);
				$tahun_surat = substr($_POST['tanggal_surat'],0,4);
				$_POST['retensi_aktif'] = $klasifikasi->aktif;
				$_POST['retensi_inaktif'] = $klasifikasi->inaktif;
				$_POST['tahun_aktif'] = $tahun_surat + $klasifikasi->aktif;
				$_POST['tahun_inaktif'] = $tahun_surat + $klasifikasi->aktif + $klasifikasi->inaktif;

				$masuk->update_masuk($_POST, array_keys($this->getField('Masuk')));								
			}
			
			HTTP::redirect(URL::base()."dinas/masuk");			
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');	

			$this->template->content = View::factory('dinas/masuk_form')
				->bind('error', $errors)
				->bind('form', $_POST)
				->set('url',URL::base().'dinas/masuk/update/'.$id)
				->set('guna_list',$this->getList('Guna','name','Pilih Nilai Guna'))
				->set('media_list',$this->getList('Media','name','Pilih Media'))
				->set('tingkat_list',$this->getList('Tingkat','name','Pilih Tingkat Perkembangan'))
				->set('lampiran_list',$this->getList('Lampiran','name','Pilih Lampiran'))
				->set('skpd_list',$this->getList('Skpd','name','Pilih jika Pengirim dari SKPD','',array(array('name','ASC'))))
				->set('klasifikasi_list',$this->getList('Klasifikasi',array('kode'=>'0',' - '=>'0','name'=>'0'),'Pilih Klasifikasi','',array(array('kode','ASC'))))
				->set('sotk_list',$this->getList('Sotk','name','Pilih SOTK',array(array('skpd_id','=',Auth::instance()->get_user()->skpd_id))))
				->bind('file',$file)
				->set('submit_value','Update Data')
				->set('id',$id)
				->set('keterangan_list',$this->getList('Keterangan','name'));
		}
	}
	
	public function action_kk() {
		$this->auto_render = false;
		$id = $this->request->param('id');
		
		$masuk = ORM::factory('Masuk',$id);
		
		$x_unit = explode("#",$masuk->akses_sotk);
		
		
		echo View::factory('dinas/masuk_kk')
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
		
		$view = View::factory('dinas/masuk_cetak')
			->bind('results', $results)
			->bind('title',$title);

		echo $view;
	}
	
	public function action_search() {
		$this->auto_render = false;
		
		echo View::factory('dinas/masuk_search')
			->set('url',URL::base().'dinas/masuk/cetak')										
			->set('submit_value','Cari Data')
			->set('skpd_list',$this->getList('Skpd','name','Pilih SKPD'))
			->set('guna_list',$this->getList('Guna','name','Pilih Nilai Guna'))
			->set('media_list',$this->getList('Media','name','Pilih Media'))
			->set('tingkat_list',$this->getList('Tingkat','name','Pilih Tingkat Perkembangan'))
			->set('lampiran_list',$this->getList('Lampiran','name','Pilih Lampiran'))
			->set('klasifikasi_list',$this->getList('Klasifikasi',array('kode'=>'0',' - '=>'0','name'=>'0'),'Pilih Klasifikasi','',array(array('kode','ASC'))))										
			->set('sotk_list',$this->getList('Sotk','name','Pilih SOTK',array(array('skpd_id','=',Auth::instance()->get_user()->skpd_id))));
	}
	
	public function action_data() {
		$this->auto_render = false;		
		
		$viewmasuks = ORM::factory('Viewmasuk')
			->where('skpd_id','=',Auth::instance()->get_user()->skpd_id);
		
		$total_data = $viewmasuks->reset(FALSE)->count_all();
		
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
					$viewmasuks = $viewmasuks->where($v[0],$v[1],$value);
				}
			}
		}
		
		$columns = array( 
			2 => 'tanggal_terima',
			3 => 'tanggal_surat',
			4 => 'urut',
			5 => 'nomor',
			6 => 'name',
			7 => 'isi'
		);
		
		foreach($columns as $key=>$field) {
			if($_REQUEST['columns'][$key]['search']['value'] != "") {		
				if($key < 5) {
					$viewmasuks = $viewmasuks
						->where($field,'=',$_REQUEST['columns'][$key]['search']['value']);
				}
				else {
					$viewmasuks = $viewmasuks
						->where($field,'LIKE','%'.$_REQUEST['columns'][$key]['search']['value'].'%');
				}
			}
		}
		
		$total_filtered = $viewmasuks->reset(FALSE)->count_all();
		
		$viewmasuks = $viewmasuks
			->offset($_REQUEST['start'])
			->limit($_REQUEST['length'])
			->order_by($columns[$_REQUEST['order'][0]['column']],$_REQUEST['order'][0]['dir'])
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
				$file = "<a data-fancybox data-type='iframe' class='btn btn-danger btn-xs' data-src='".URL::base()."assets/doc/".$viewmasuk->file."' title='File'><i class='fa fa-file'></i></a>";
			}
				
			$arrData[] = array(
				$i + $_REQUEST['start'],
				"<a class='btn btn-primary btn-xs' href='".URL::base().'dinas/disposisi/index/'.$viewmasuk->id."' title='Disposisi'><i class='fa fa-sort-amount-asc'></i></a>
			    <a target='_blank' class='btn btn-warning btn-xs' href='".URL::base().'dinas/masuk/kk/'.$viewmasuk->id."' title='Kartu Kendali'><i class='fa fa-print'></i></a>&nbsp;".
			    $file,
				$tanggal_terima->format("d-m-Y"),
				$tanggal_surat->format("d-m-Y"),
				$viewmasuk->urut,
				"<a id='".$viewmasuk->id."' href='".URL::base()."dinas/masuk/edit/".$viewmasuk->id."'>".$viewmasuk->nomor."</a>",
				$viewmasuk->name,
				$viewmasuk->isi,
				$viewmasuk->status_surat
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