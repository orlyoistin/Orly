<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Dinas_Base extends Controller_Dinas_Backend {
	public $auth_required = array('login');
	
	public function action_skpd() {
		$this->auto_render = false;
		
		$skpds = ORM::factory('Skpd')
			->where('id','=',Auth::instance()->get_user()->skpd_id)
			->order_by('name','ASC')
			->find_all();
			
		$vars = array();
		
		foreach($skpds as $skpd) {
			$vars[] = array($skpd->id, $skpd->name);
			/*if($skpd->sotk->count_all()) {
				$vars[] = array($skpd->id, $skpd->name);
			}*/
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
		/*else {
			$sotks = $sotks->find_all();
			foreach($sotks as $sotk) {
				$vars[] = array($sotk->id, $sotk->name);
			}			
		}*/
		
		echo json_encode($vars);
	}
}
?>