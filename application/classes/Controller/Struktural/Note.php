<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Struktural_Note extends Controller_Struktural_Backend {
	public $auth_required = array('login','struktural');
	
	public function action_index() {
		$status = $this->request->param("id");
		
		$title = "Inbox Timeline";
		if($status == 2) {
			$title = "Archive Timeline";
		}
		
		$this->template->content = View::factory('struktural/note')
			->set('status',$status)
			->set('title',$title);				
	}
		
	public function action_reload() {
		$this->auto_render = false;
		$status = $this->request->param("id");
		
		$notes = ORM::factory('Viewnote');
		
		if($status==3 || $status == "") {
			$notes 
				->where('tujuan','=',Auth::instance()->get_user()->sotk_id);
		}
		else {
			$notes 
				->where('tujuan','=',Auth::instance()->get_user()->sotk_id)
				->where('status','=',$status);			
		}
		
		$n = $notes->reset(FALSE)->count_all();
		
		$results = $notes
			->order_by('prioritas','DESC')
			->order_by('tanggal_terima','ASC')
			->find_all();		
		
		echo View::factory('struktural/note_reload')			
			->bind('results',$results)
			->set('n',$n);	
	}
	
	public function action_new() {
		$this->auto_render = false;
		$id = $this->request->param('id');
				
		echo View::factory('struktural/disposisi_form')									
			->bind('errors',$errors)
			->set('form',$this->getField('Disposisi'))	
			->set('url',URL::base().'dinas/disposisi/save')
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
				DB::update('masuks')->set(array('tanggal_diteruskan' => $_POST['tanggal']))->where('id','=',$_POST['masuk_id'])->execute();
			}				
			
			// Notifikasi
			if(isset($_POST['sotk'])) {
				foreach($_POST['sotk'] as $sotk) {
					DB::insert('notes', array('tanggal', 'sotk_id', 'disposisi_id', 'read_id'))
						->values(array(date("Y-m-d"),$sotk, $disposisi->id, '1'))->execute();
				}
			}			
			
			echo "success";				
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');	
			$view = View::factory('struktural/disposisi/form')
				->bind('errors',$errors)
				->set('form',$_POST)	
				->set('url',URL::base().'dinas/disposisi/save')
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
		
		$view = View::factory('struktural/disposisi_cetak')					
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

		$this->template->content = View::factory('struktural/note')
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
	
	public function action_ring() {
		$this->auto_render = false;
		$n_note = ORM::factory('Viewnote')
			->where('tujuan','=',Auth::instance()->get_user()->sotk_id)
			->where('status','=',1)
			->count_all();
		
		echo $n_note;	
	}
	
	public function action_read() {
		$this->auto_render = false;
		$jenis = $this->request->param("id");
		$data_id = $this->request->param("id2");
		
		if($jenis==1) {
			$table = "distributions";
		}
		elseif($jenis==2)  {
			$table = "disposisis";
		}
		
		if($data_id > 0) {
			DB::update($table)
				->set(array('masterbool_id' => 2))
				->where('id','=',$data_id)
				->execute();
		}
		
		echo "success";	
	}
	
	public function action_data() {
		$this->auto_render = false;		
		$status = $this->request->param("id");
		
		$notes = ORM::factory('Viewnote');
		
		if($status==3 || $status == "") {
			$notes
				->where('tujuan','=',Auth::instance()->get_user()->sotk_id);
		}
		else {
			$notes
				->where('tujuan','=',Auth::instance()->get_user()->sotk_id)
				->where('status','=',$status);			
		}
		
		$total_data = $notes->reset(FALSE)->count_all();
		
		$notes = $notes
			->where('keyword','LIKE','%'.$_REQUEST['search']['value'].'%');
		
		$total_filtered = $notes->reset(FALSE)->count_all();
			
		$notes = $notes
			->offset($_REQUEST['start'])
			->limit($_REQUEST['length'])
			->order_by('prioritas','DESC')
			->order_by('tanggal_terima','ASC')
			->find_all();
		
		$config	= Kohana::$config->load('configuration');
		$dir_doc = $config->get('config_dir_doc');	
		$separator = $this->getSeparator();
			
		$arrData = array();
		$i = 1;
		foreach($notes as $note) {
			$tanggal_terima = new DateTime($note->tanggal_terima);
			$tanggal_surat = new DateTime($note->tanggal_surat);
			$masuk = ORM::factory('Masuk',$note->masuk_id);
			$rekomendasi = "";
			
			$level_2 = "";				  
			if(Auth::instance()->get_user()->sotk->level == 2) {
				$level_2 = "<a data-fancybox data-type='ajax' class='btn btn-warning btn-xs' data-src='".URL::base().'struktural/distribution/new/'.$note->jenis.'/'.$note->data_id.'/'.$masuk->id."'>DISTRIBUSI</a>";
			}
			
			$attachment = "";
			if(is_file($dir_doc.$separator.$masuk->file) && $masuk->file) {
				$attachment = "<a data-fancybox data-type='iframe' class='btn btn-warning btn-xs' data-src='".URL::base().'assets/doc/'.$masuk->file."'>ATTACHMENT</a>";
			}

			$note_status = "";
			if($note->status == 2) {
				$note_status = 
				"<div class='timeline-footer pull-left'>
					<i class='fa fa-thumbs-up text-blue faa-vertical animated'></i> DOKUMEN INI SUDAH ANDA PROSES                                
				</div>";
			}
				 
			$arrData[] = array(
				"<ul class='timeline'>
					<li>
					  <i class='fa fa-envelope bg-blue'></i>
					  <div class='timeline-item'>
						<span class='time'><i class='glyphicon glyphicon-download-alt'></i> ".$tanggal_terima->format('d M Y')."</span>
						<span class='time'><i class='fa fa-envelope-o'></i> ".$tanggal_surat->format('d M Y')."</span>
						<h3 class='timeline-header'><a href='#'>".$masuk->perihal."</a><br> ".$masuk->nomor."</h3>
						<h5 class='timeline-header'>".$masuk->name."</h5>
						<div class='timeline-body'>". 
							$masuk->isi.$rekomendasi.
							"<br><br>".$attachment.
							"&nbsp;<a data-fancybox data-type='ajax' class='btn btn-info btn-xs' data-src='".URL::base().'struktural/history/index/'.$masuk->id."'>HISTORI</a> 
						</div>
						<div class='timeline-footer pull-right'>
						  ".$level_2."	
						  <a data-fancybox data-type='ajax' class='btn btn-primary btn-xs' data-src='".URL::base().'struktural/disposisi/new/'.$note->jenis.'/'.$note->data_id.'/'.$masuk->id."'>DISPOSISI</a>
						  <a class='btn btn-danger btn-xs read' jenis='".$note->jenis."' data_id='".$note->data_id."' table_id='note_table' href='".URL::base().'struktural/note/read/'.$note->jenis.'/'.$note->data_id."'>DIBACA</a>
						</div>
						".$note_status."
					  </div>
					</li>
				</ul>"
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