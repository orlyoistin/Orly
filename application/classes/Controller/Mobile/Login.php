<?
defined('SYSPATH') or die('No direct script access.');

class Controller_Mobile_Login extends Controller {	
	function action_index(){
		echo "ESURAT-API";
	}
	
	public function action_login() {	
		$this->auto_render = false;	
		
		$postdata = file_get_contents("php://input");
		
		if (isset($postdata)) {
			$request = json_decode($postdata);
			$username = $request->username;
			$password = $request->password;
			$device_id = $request->device_id;
			$onesignal_id = $request->onesignal_id;
			
			$u = ORM::factory('User')
				->where('username','=',$username)
				->where('password','=',Auth::instance()->hash_password($password))
				->where('masterbool_id','=',2);
			
			$n = $u->reset(FALSE)->count_all();
		 
			if($n) {
				$u = $u->find();	
				$secret_key = sha1($device_id.$password.$username.date("Y-m-d H:i:s"));

				DB::update('users')
					->set(array('device_id' => $device_id, 'onesignal_id' => $onesignal_id, 'secret' => $secret_key))
					->where('username', '=', $username)
					->execute();
				
				$arrResponse = array(
					'status' => 'valid',
					'secret_key' => $secret_key,
					'level' => $u->sotk->level
				);
			}
			else {
				$arrResponse = array('status'=>'invalid');
			} 
		}
		else {
			$arrResponse = array('status'=>'invalid');
		}
		
		echo json_encode($arrResponse);
	}
	
	public function action_auth() {	
		$this->auto_render = false;	
	
		$postdata = file_get_contents("php://input");
		
		if (isset($postdata)) {
			$request = json_decode($postdata);
			$username = $request->username;
			$secret_key = $request->secret_key;
			
			$n_user = ORM::factory('User')
				->where('username','=',$username)
				->where('secret','=',$secret_key)
				->where('masterbool_id','=',2)
				->count_all();
							
			if($n_user > 0) {
				$arrResponse = array('status'=>'valid');
			}
			else {
				$arrResponse = array('status'=>'invalid');
			} 
		}
		else {
			$arrResponse = array('status'=>'invalid');
		}
		
		echo json_encode($arrResponse);
	}
	
	public function action_password() {	
		$this->auto_render = false;	
		
		$postdata = file_get_contents("php://input");
		
		if (isset($postdata)) {
			$request = json_decode($postdata);
			$username = $request->username;
			$secret_key = $request->secret_key;
			$password = $request->password;
			
			$n_user = ORM::factory('User')
				->where('username','=',$username)
				->where('secret','=',$secret_key)
				->where('masterbool_id','=',2)
				->count_all();
		 
			if($n_user) {
				$hash_password = Auth::instance()->hash_password($password);
				
				DB::update('users')
					->set(array('password' => $hash_password))
					->where('username', '=', $username)
					->execute();
						
				$arrResponse = array('status' => 1);
			}
			else {
				$arrResponse = array('status'=> 0);
			} 
		}
		else {
			$arrResponse = array('status'=> 0);
		}
		
		echo json_encode($arrResponse);
	}
}
?>
