<?
defined('SYSPATH') or die('No direct script access.');

class Controller_Mobile_Home extends Controller {	
	function action_index(){
		echo "ESURAT-API";
	}
	
	function action_home() {
		$this->auto_render = false;	
		$postdata = file_get_contents("php://input");
		
		$arrData = array();
		
		if (isset($postdata)) {
			$request = json_decode($postdata);
			
			$username = $request->username;
			$secret_key = $request->secret_key;
					
			$user = ORM::factory('User')
				->where('username','=',$username)
				->where('secret','=',$secret_key)
				->where('masterbool_id','=',2);
			
			$n_user = $user->reset(FALSE)->count_all();
			if($n_user) {
				$user = $user->find();
				
				$arrData = array(
					'status' => 1,
					'name' => $user->name
				);
			}
			else {
				$arrData = array(
					'status' => 0,
					'name' => ''
				);
			}
		}
		
		echo json_encode($arrData);
	}
}
?>
