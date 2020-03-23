<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Admin_Distribution extends Controller_Admin_Backend {
	public $auth_required = array('login');
	
	public function action_new() {
		$this->auto_render = false;
		$id = $this->request->param('id');
				
		echo View::factory('admin/distribution_form')									
			->bind('errors',$errors)
			->set('form',$this->getField('Distribution'))	
			->set('url',URL::base().'admin/distribution/save')
			->set('masuk_id',$id)
			->set('title',"Distribution")
			->set('submit_value',"Tambah Data")
			->set('prioritas_list',$this->getList('Masterbool','prioritas'))
			->set('sotk_list',$this->getList('Sotk','name','',array(array('skpd_id','=',Auth::instance()->get_user()->skpd->id),array('level','IN',array(1,2)))));
	}
	
	public function action_save() {	
		$this->auto_render = false;
		
		try {
			$masuk = ORM::factory('Masuk',$_POST['masuk_id']);
			
			$distribution = ORM::factory('Distribution');	
			$_POST['dari_name'] = "TU";
			$_POST['kepada_name'] = ORM::factory('Sotk',$this->request->post('sotk_id'))->name;
			$_POST['skpd_id'] = Auth::instance()->get_user()->skpd_id;
			$_POST['masterbool_id'] = 1;
			$_POST['created'] = date("Y-m-d H:i:s"); 
			$_POST['user_id'] = Auth::instance()->get_user()->id;
			$distribution->create_distribution($_POST,array_keys($this->getField('Distribution')));
			
			if (strpos($masuk->akses_sotk, "#".$this->request->post('sotk_id')."#") === false) {
				$akses_sotk = $masuk->akses_sotk."#".$distribution->sotk_id."#";
				
				DB::update('masuks')
					->set(array('akses_sotk' => $akses_sotk))
					->where('id','=',$_POST['masuk_id'])
					->execute();
			}
			
			// PUSH NOTIFICATIONS
			$user = ORM::factory('User')
				->where('sotk_id','=',$distribution->sotk_id);
			
			if($user->reset(FALSE)->count_all()) {
				$user = $user->find();
				
				$setting = ORM::factory('Setting',1);
				$device_id = $user->device_id;
				$title = $setting->akronim." ".$setting->owner_short;
				$message = "Cek inbox anda";
				
				if($device_id) {
					Model::factory('Custom')->push($device_id,$title,$message);
				}
			}
				
			echo "success";				
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');	
			$view = View::factory('admin/distribution/form')
				->bind('errors',$errors)
				->set('form',$_POST)	
				->set('url',URL::base().'admin/distribution/save')
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