<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Dinas_Distribution extends Controller_Dinas_Backend {
	public $auth_required = array('login','dinas');
	
	public function action_new() {
		$this->auto_render = false;
		$id = $this->request->param('id');
				
		echo View::factory('dinas/distribution_form')									
			->bind('errors',$errors)
			->set('form',$this->getField('Distribution'))	
			->set('url',URL::base().'dinas/distribution/save')
			->set('masuk_id',$id)
			->set('title',"Distribution")
			->set('submit_value',"Tambah Data")
			->set('prioritas_list',$this->getList('Masterbool','prioritas'))
			->set('sotk_list',$this->getList('Sotk','name','',array(array('skpd_id','=',Auth::instance()->get_user()->skpd->id),array('level','IN',array(1,2)))));
	}
	
	public function action_save() {	
		$this->auto_render = false;
		
		try {
			$n = ORM::factory('Distribution')
				->where('masuk_id','=',$this->request->post('masuk_id'))
				->where('sotk_id','=',$this->request->post('sotk_id'))
				->count_all();
			
			$sotk_id = $this->request->post('sotk_id');
			
			if($n == 0) {	
				$masuk = ORM::factory('Masuk',$_POST['masuk_id']);
				
				$distribution = ORM::factory('Distribution');	
				$_POST['dari_name'] = "TU";
				$_POST['kepada_name'] = ORM::factory('Sotk',$this->request->post('sotk_id'))->name;
				$_POST['skpd_id'] = Auth::instance()->get_user()->skpd_id;
				$_POST['masterbool_id'] = 1;
				$_POST['created'] = date("Y-m-d H:i:s"); 
				$_POST['user_id'] = Auth::instance()->get_user()->id;
				$distribution->create_distribution($_POST,array_keys($this->getField('Distribution')));
				
				if($masuk->akses_sotk) {
					if(strpos($masuk->akses_sotk, "#".$sotk_id."#") === false) {
						$akses_sotk = $masuk->akses_sotk.$sotk_id."#";
					}
					else {
						$akses_sotk = $masuk->akses_sotk;
					}
				}
				else {
					$akses_sotk = "#".$masuk->akses_sotk."#";
				}
				
				DB::update('masuks')
					->set(array('akses_sotk' => $akses_sotk, 'sotk_id' => $sotk_id))
					->where('id','=',$this->request->post('masuk_id'))
					->execute();
			}
			else {
				$distribution = ORM::factory('Distribution')
				->where('masuk_id','=',$this->request->post('masuk_id'))
				->where('sotk_id','=',$this->request->post('sotk_id'))
				->find();
			}
			
			// PUSH		
			$user = ORM::factory('User')
				->where('sotk_id','=',$sotk_id)
				->where('masterbool_id','=',2)
				->find();
			
			if($user->onesignal_id) {	
				$setting = ORM::factory('Setting',1);
				
				$device_ids = array($user->onesignal_id);
				$data = array();
				$title = $setting->akronim." ".$setting->owner_short;
				$message = "Cek inbox anda";
				
				if($this->request->post('rekomendasi')) {
					$message .= "\n".$this->request->post('rekomendasi');
				}
				
				$response = Model::factory('Custom')->push($device_ids,$data,$title,$message);		
				$output = json_decode($response);
								
				if($output->recipients > 0) {
					DB::update('distributions')
						->set(array('message_id' => $output->id))
						->where('id','=',$distribution->id)
						->execute();
				}
			}
					
			echo "success";				
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');	
			$view = View::factory('dinas/distribution/form')
				->bind('errors',$errors)
				->set('form',$_POST)	
				->set('url',URL::base().'dinas/distribution/save')
				->set('masuk_id',$_POST['masuk_id'])
				->set('title',"Distribution")
				->set('submit_value',"Tambah Data")
				->set('prioritas_list',$this->getList('Masterbool','prioritas'))
				->set('sotk_list',$this->getList('Sotk','name','',array(array('skpd_id','=',Auth::instance()->get_user()->skpd->id),array('level','IN',array(1,2)))));

			echo $view;
		}
	}
}
?>