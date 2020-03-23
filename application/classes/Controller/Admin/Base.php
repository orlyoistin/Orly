<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Admin_Base extends Controller_Admin_Backend {
	public $auth_required = array('login');
	
	public function action_skpd() {
		$this->auto_render = false;
		
		$skpds = ORM::factory('Skpd');
		
		if(Auth::instance()->get_user()->jabatan_id > 1) {
			$skpds = $skpds
				->where('id','=',Auth::instance()->get_user()->skpd_id);
		}
		
		$skpds = $skpds
			->order_by('name','ASC')
			->find_all();
			
		$vars = array();
		foreach($skpds as $skpd) {
			$vars[] = array($skpd->id, $skpd->name);
		}
		echo json_encode($vars);
	}

	public function action_sotk() {
		$this->auto_render = false;
		
		$skpd_id = 0;
		if(!empty($_GET['id'])) {
			$skpd_id = $_GET['id'];
		}
		
		$vars = array();
		$sotks = ORM::factory('Sotk');
		if($skpd_id>0) {
			$sotks = $sotks
				->where('skpd_id','=',$skpd_id)
				->find_all();
				
			foreach($sotks as $sotk) {
				$vars[] = array($sotk->id, $sotk->name);
			}			
		}
		else {
			$sotks = $sotks->find_all();
			foreach($sotks as $sotk) {
				$vars[] = array($sotk->id, $sotk->name);
			}			
		}
		
		echo json_encode($vars);
	}
	
	public function action_push() {
		$this->auto_render = false;
		$distribution_id = $this->request->param('id');
		$distribution = ORM::factory('Distribution',$distribution_id);
		$sotk_id = $distribution->sotk_id;
		
		$push_message = "<b>Perhatian!</b><br><br>";
		
		// PUSH		
		$user = ORM::factory('User')
			->where('sotk_id','=',$sotk_id)
			->where('masterbool_id','=',2)
			->find();
		
		if($user->onesignal_id) {	
			$setting = ORM::factory('Setting',1);
			
			$device_ids = array($user->onesignal_id);
			$data = array('eSurat' => 'eSurat');
			$title = $setting->akronim." ".$setting->owner_short;
			$message = "Cek inbox anda";
			
			$response = Model::factory('Custom')->push($device_ids,$data,$title,$message);		
			$output = json_decode($response);
							
			if($output->recipients > 0) {
				DB::update('distributions')
					->set(array('message_id' => $output->id))
					->where('id','=',$distribution_id)
					->execute();
			}
			
			$push_message .= "Anda telah mengirim Push Notification kepada :<br>".$distribution->kepada_name;
		}
		else {
			$push_message .= "Push Notification kepada <br><b>".$distribution->kepada_name."</b><br><font color='red'>gagal terkirim</font>";
		}
		
		echo $push_message;
	}
}
?>