<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Struktural_Disposisi extends Controller_Struktural_Backend {
	public $auth_required = array('login','struktural');
	
	public function action_index() {
		echo "";
	}
	
	public function action_new() {
		$this->auto_render = false;
		$jenis = $this->request->param('id');
		$data_id = $this->request->param('id2');
		$masuk_id = $this->request->param('id3');
						
		echo View::factory('struktural/disposisi_form')									
			->bind('errors',$errors)
			->set('form',$this->getField('Disposisi'))	
			->set('url',URL::base().'struktural/disposisi/save')
			->set('jenis',$jenis)
			->set('data_id',$data_id)
			->set('masuk_id',$masuk_id)
			->set('target','struktural/note/reload/1')
			->set('title',"Disposisi")
			->set('submit_value',"Tambah Data")
			->set('prioritas_list',$this->getList('Masterbool','prioritas'))
			->set('wakil_list',$this->getList('Wakil','name','1'))
			->set('sotk_list',$this->getList('Sotk','name','',array(array('skpd_id','=',Auth::instance()->get_user()->skpd->id),array('id','!=',Auth::instance()->get_user()->sotk_id),array('level','>=',Auth::instance()->get_user()->sotk->level))))
			->set('masterdisposisi_list',$this->getList('Masterdisposisi','name','Pilih Disposisi'));
	}
	
	public function action_save() {	
		$this->auto_render = false;
		$jenis = $this->request->post("jenis");
		$data_id = $this->request->post("data_id");
		$masuk_id = $this->request->post("masuk_id");
		$setting = ORM::factory('Setting',1);
		$masuk = ORM::factory('Masuk',$masuk_id);
		
		try {
			$_POST['tanggal'] = date("Y-m-d");
			$_POST['skpd_id'] = Auth::instance()->get_user()->skpd_id;
			$_POST['masuk_id'] = $masuk_id;
			$_POST['dari'] = Auth::instance()->get_user()->sotk_id;
			$_POST['dari_name'] = ORM::factory('Sotk',Auth::instance()->get_user()->sotk_id)->name;
			$_POST['isi'] = nl2br($this->request->post('isi'));
			
			$_POST['created'] = date("Y-m-d H:i:s");
			$_POST['user_id'] = Auth::instance()->get_user()->id;
			$_POST['masterbool_id'] = 1;		
			
			$akses_sotk = $masuk->akses_sotk;	
			
			$arrField = array(
				'tanggal',
				'skpd_id',
				'masuk_id',
				'wakil_id',
				'dari',
				'kepada',
				'dari_name',
				'kepada_name',
				'isi',
				'masterdisposisi_id',
				'masterbool_id'	
			);
			
			if(isset($_POST['sotk'])) {
				foreach($_POST['sotk'] as $sotk) {
					$_POST['kepada'] = $sotk;
					$_POST['kepada_name'] = ORM::factory('Sotk',$sotk)->name;
					$akses_sotk .= $sotk."#";
					
					$disposisi = ORM::factory('Disposisi');
					$disposisi->create_disposisi($_POST,array_keys($this->getField('Disposisi')));				
					
					if (strpos($masuk->akses_sotk, "#".$this->request->post('sotk_id')."#") === false) {
						DB::update('masuks')
							->set(array('akses_sotk' => $akses_sotk))
							->where('id','=',$masuk_id)
							->execute();
					}
					
					// PUSH		
					$user = ORM::factory('User')
						->where('sotk_id','=',$sotk)
						->where('masterbool_id','=',2)
						->find();
					
					if($user->onesignal_id) {	
						$device_ids = array($user->onesignal_id);
						$data = array();
						$title = "eSurat Provinsi Jawa Tengah";
						$message = "Cek inbox anda";
						
						$response = Model::factory('Custom')->push($device_ids,$data,$title,$message);		
						$output = json_decode($response);
						
						if($output->recipients > 0) {
							DB::update('disposisis')
								->set(array('message_id' => $output->id))
								->where('id','=',$disposisi->id)
								->execute();
						}
					}
					
					if($jenis == 1) {
						$table = "distributions";
					}
					else {
						$table = "disposisi";
					}
					
					DB::update($table)
						->set(array('masterbool_id' => 2))
						->where('id','=',$data_id)
						->execute();		
				}			
			}				
			
			DB::update('disposisis')
				->set(array('masterbool_id' => 2))
				->where('id','=',$data_id)
				->execute();
			
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
				->set('prioritas_list',$this->getList('Masterbool','prioritas'))
				->set('wakil_list',$this->getList('Wakil','name','1'))
				->set('sotk_list',$this->getList('Sotk','name','',array(array('skpd_id','=',Auth::instance()->get_user()->skpd->id),array('id','!=',Auth::instance()->get_user()->sotk_id))))
				->set('masterdisposisi_list',$this->getList('Masterdisposisi','name','Pilih Disposisi'));

			echo $view;
		}
	}	
}
?>