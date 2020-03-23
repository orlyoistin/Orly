<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Admin_Disposisi extends Controller_Admin_Backend {
	public $auth_required = array('login');
	
	public function action_index() {
		$id = $this->request->param('id');
		$masuk = ORM::factory('Masuk',$id);
		
		$disposisis = ORM::factory('Disposisi')
			->where('masuk_id','=',$id)
			->find_all();
		
		$distributions = ORM::factory('Distribution')
			->where('masuk_id','=',$id)
			->find_all();	
		
		$config = Kohana::$config->load('configuration');
		$dir = $config->get('config_dir_doc');
			
		$file = "<b><font color='red'>Copy Digital tidak tersedia</font></b>";
		if(is_file($dir.$this->getSeparator().$masuk->file)) {
			$file = "<a class='conbtn' data-fancybox-type='iframe' href='".URL::base()."assets/doc/".$masuk->file."'>".$masuk->file."</a>";
		}	
		
		$this->template->content = View::factory('admin/disposisi')			
			->bind('masuk',$masuk)
			->bind('disposisis',$disposisis)
			->bind('distributions',$distributions)
			->bind('file',$file);
	}
		
	public function action_reload() {
		$this->auto_render = false;
		
		$id = $this->request->param('id');
		$masuk = ORM::factory('Masuk',$id);
		
		$disposisis = ORM::factory('Disposisi')
			->where('masuk_id','=',$id)
			->find_all();
		
		$distributions = ORM::factory('Distribution')
			->where('masuk_id','=',$id)
			->find_all();	
		
		$config = Kohana::$config->load('configuration');
		$dir = $config->get('config_dir_doc');
			
		$file = "<b><font color='red'>Copy Digital tidak tersedia</font></b>";
		if(is_file($dir.$this->getSeparator().$masuk->file)) {
			$file = "<a class='conbtn' data-fancybox-type='iframe' href='".URL::base()."assets/doc/".$masuk->file."'>".$masuk->file."</a>";
		}	
		
		echo View::factory('admin/disposisi_reload')			
			->bind('masuk',$masuk)
			->bind('disposisis',$disposisis)
			->bind('distributions',$distributions)
			->bind('file',$file);	
	}
	
	public function action_new() {
		$this->auto_render = false;
		$id = $this->request->param('id');
				
		echo View::factory('admin/disposisi_form')									
			->bind('errors',$errors)
			->set('form',$this->getField('Disposisi'))	
			->set('url',URL::base().'admin/disposisi/save')
			->set('masuk_id',$id)
			->set('title',"Disposisi")
			->set('submit_value',"Tambah Data")
			->set('wakil_list',$this->getList('Wakil','name','1'))
			->set('sotk_list',$this->getList('Sotk','name','',array(array('skpd_id','=',Auth::instance()->get_user()->skpd->id))));
	}
	
	public function action_save() {	
		$this->auto_render = false;
		
		try {
			$disposisi = ORM::factory('Disposisi');
			$_POST['isi'] = nl2br($_POST['isi']);
			$_POST['dari'] = ORM::factory('Sotk',$_POST['dari_id'])->name;
			
			$kepada = "";
			if(isset($_POST['sotk'])) {
				foreach($_POST['sotk'] as $sotk) {
					$kepada .= ORM::factory('Sotk',$sotk)->name."<br>";
				}
			}

			$_POST['kepada'] = $kepada;
			$disposisi->create_disposisi($_POST,array_keys($this->getField('Disposisi')));
			
			// Update Tanggal Diteruskan Surat Masuk
			$masuk = ORM::factory('Masuk',$_POST['masuk_id']);
			if($masuk->tanggal_diteruskan == "0000-00-00") {
				DB::update('masuks')
					->set(array('tanggal_diteruskan' => $_POST['tanggal']))
					->where('id','=',$_POST['masuk_id'])
					->execute();
			}		
				
			echo "success";				
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');	
			$view = View::factory('admin/disposisi/form')
				->bind('errors',$errors)
				->set('form',$_POST)	
				->set('url',URL::base().'admin/disposisi/save')
				->set('masuk_id',$_POST['masuk_id'])
				->set('title',"Disposisi")
				->set('submit_value',"Tambah Data")
				->set('wakil_list',$this->getList('Wakil','name','1'))
				->set('sotk_list',$this->getList('Sotk','name','',array(array('skpd_id','=',Auth::instance()->get_user()->skpd->id))));

			echo $view;
		}
	}
	
	public function action_cetak() {
		$this->auto_render = false;
		$masuk_id = $this->request->param('id');
		
		$masuk = ORM::factory('Masuk',$masuk_id);
		$results = ORM::factory('Disposisi')->where('masuk_id','=',$masuk_id)->find_all();
		
		$tanggal_surat = new DateTime($masuk->tanggal_surat);
		$tanggal_diteruskan = new DateTime($masuk->tanggal_diteruskan);
		
		$view = View::factory('admin/disposisi_cetak')					
					->bind('results',$results)
					->set('masuk',$masuk)					
					->set('skpd',$masuk->name)
					->set('klasifikasi',$masuk->klasifikasi->kode." / ".$masuk->urut)
					->set('perihal',$masuk->perihal)
					->set('isi',$masuk->isi)
					->set('nomor',$masuk->nomor)
					->set('tanggal_surat',$tanggal_surat->format("d-m-Y"))
					->set('tanggal_diteruskan',$tanggal_diteruskan->format("d-m-Y"))
					->set('i',1);

		echo $view;
	}	
	
	public function action_note() {
		$note = ORM::factory('Note')
			->where('sotk_id','=',Auth::instance()->get_user()->sotk_id);

		$this->template->content = View::factory('admin/note')
			->bind('results', $results)
			->bind('page_links', $page_links)
			->bind('i', $i)
			->bind('url',$url)
			->bind('submit_value',$submit_value)
			->bind('num_rows',$count)
			->bind('skpd_list',$skpd_list)
			->bind('read_list',$read_list)
			->bind('title',$title);
			
		$count 	= $note->reset(FALSE)->count_all();
		$config	= Kohana::$config->load('arsip');
		
		$pagination = Pagination::factory(array(
			'total_items'    	=> $count,
			'items_per_page' 	=> $config->get('items_per_pages'),
			'auto_hide'			=> FALSE,
		));
				

		$results = ORM::factory('Note')
						->where('sotk_id','=',Auth::instance()->get_user()->sotk_id)
						->order_by('read_id','ASC')
						->order_by('tanggal','DESC')
						->limit($pagination->items_per_page)
						->offset($pagination->offset)
						->find_all();				
		
		$page_links		= $pagination->render();
		$i				= $pagination->offset+1;
		$url 			= URL::base()."disposisi/note?s=1";
		$title 			= "User Notes";
		$submit_value 	= "Cari";
		$skpd_list 		= $this->getList('Skpd','name','Pilih Dinas / SKPD');
		$read_list 		= $this->getList('read','read','Pilih Status');
	}
}
?>