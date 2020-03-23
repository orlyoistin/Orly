<?
defined('SYSPATH') or die('No direct script access.');

class Model_Custom {
	function parent(){	
		$parent_list = array();
		$xsotk = explode("#",substr_replace(Model::factory('custom')->tree(0),"",-1));
		
		foreach($xsotk as $m) {
			$sotk = ORM::factory('Sotk',trim($m));
			$parent_list[$sotk->id] = str_repeat("&nbsp;",($sotk->level - 1)*5).$sotk->name;
		}
		return $parent_list;
	}
	
	function tree($parent_id) {
		$sotk1 = "";
		$n = ORM::factory('Sotk')->where('parent_id','=',$parent_id)->count_all();
		if($n>0) {
			$sotks = ORM::factory('Sotk')
				->where('parent_id','=',$parent_id)
				->find_all();
				
			foreach($sotks as $sotk) {				
				$sotk1 .= $sotk->id."#";
				$sotk1 .= $this->tree($sotk->id);
			}
		}
		return $sotk1;
	}
	
	function getTreeData($parent_id) {
		$data = "";
		$n = ORM::factory('Sotk')->where('parent_id','=',$parent_id)->count_all();
		if($n>0) {
			$sotks = ORM::factory('Sotk')
				->where('parent_id','=',$parent_id)
				->find_all();
				
			foreach($sotks as $sotk) {				
				$data .= $sotk->id.",";
				$data .= $this->getTreeData($sotk->id);
			}
		}
		return $data;
	}	
	
	function parent_skpd(){	
		$parent_list = array();
		$xsotk = explode("#",substr_replace(Model::factory('custom')->tree_skpd(Auth::instance()->get_user()->skpd_id,0),"",-1));
		
		$parent_list[] = "Pilih SOTK";
		foreach($xsotk as $m) {
			$sotk = ORM::factory('Sotk',trim($m));
			$parent_list[$sotk->id] = str_repeat("&nbsp;",$sotk->level*5).$sotk->name;
		}
		return $parent_list;
	}
	
	function parent_admin($skpd_id){	
		$parent_list = array();
		$xsotk = explode("#",substr_replace(Model::factory('custom')->tree_skpd($skpd_id,0),"",-1));
		
		$parent_list[] = "Root";
		foreach($xsotk as $m) {
			$sotk = ORM::factory('Sotk',trim($m));
			$parent_list[$sotk->id] = str_repeat("&nbsp;",$sotk->level*5).$sotk->name;
		}
		return $parent_list;
	}
	
	function tree_skpd($skpd_id, $parent_id) {
		$sotk_string = "";
		$n = ORM::factory('Sotk')
			->where('skpd_id','=',$skpd_id)
			->where('parent_id','=',$parent_id)
			->count_all();
			
		if($n) {
			$sotks = ORM::factory('Sotk')
				->where('skpd_id','=',$skpd_id)
				->where('parent_id','=',$parent_id)
				->find_all();
				
			foreach($sotks as $sotk) {				
				$sotk_string .= $sotk->id."#";
				$sotk_string .= $this->tree_skpd($skpd_id, $sotk->id);
			}
		}
		
		return $sotk_string;
	}
	
	public function getSeparator() {
		$sys = strtoupper(PHP_OS);
	 
		if(substr($sys,0,3) == "WIN"){
			$separator = "\\";
		}
		else {
			$separator = "/";
		}
	 
		return $separator;
	}
	
	public function getConfig() {
		$config	= Kohana::$config->load('configuration');
		return $config;
	}
	
	public function push($device_ids,$data,$title,$message) {
		$config = Kohana::$config->load('configuration');
		$app_id = $config->get('onesignal_app_id');
				
		$content = array(
			"en" => $message
		);

		$headings = array(
			"en" => $title
		);
		
		$fields = array(
			'app_id' => $app_id,
			'include_player_ids' => $device_ids,
			'data' => $data,
			'headings' => $headings,
			'contents' => $content
		);
		
		$header = array('Content-Type: application/json; charset=utf-8','Authorization: Basic NmQ5ZjgxOWUtNGJhNi00YzRlLTk2NjQtNjhkOTVhZTU1MmIw');
		
		$fields = json_encode($fields);
				
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);
		
		return $response;
	}
}
?>