<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Api extends Controller_Layout {
	public function action_login() {	
		$this->auto_render = false;	
		
		if (isset($_SERVER['HTTP_ORIGIN'])) {
			header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
			header('Access-Control-Allow-Credentials: true');
			header('Access-Control-Max-Age: 86400');
		}
	 
		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') { 
			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
				header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
	 
			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
				header("Access-Control-Allow-Headers:{$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
	 
			exit(0);
		}
	
		$postdata = file_get_contents("php://input");
		if (isset($postdata)) {
			$request = json_decode($postdata);
			$username = $request->username;
			$password = $request->password;
			
			$u = ORM::factory('User')
				->where('username','=',$username)
				->where('password','=',Auth::instance()->hash_password($password));
			
			$n = $u->reset(FALSE)->count_all();
		 
			if($n) {
				$u = $u->find();	
				$arrResponse = array(
					'status'=>'valid',
					'sotk_id'=>$u->sotk_id,
					'level'=>$u->sotk->level,
					'hash'=>Auth::instance()->hash_password($password)
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
		
		if (isset($_SERVER['HTTP_ORIGIN'])) {
			header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
			header('Access-Control-Allow-Credentials: true');
			header('Access-Control-Max-Age: 86400');
		}
	 
		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') { 
			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
				header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
	 
			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
				header("Access-Control-Allow-Headers:{$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
	 
			exit(0);
		}
	
		$postdata = file_get_contents("php://input");
		if (isset($postdata)) {
			$request = json_decode($postdata);
			$username = $request->username;
			$hash = $request->hash;
			
			$user = ORM::factory('User')
				->where('username','=',$username)
				->find();
				
			$check_hash = md5($user->username.$user->password);			
			
			if($check_hash == $hash) {
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
	
	public function action_note() {
		$this->auto_render = false;
		
		if (isset($_SERVER['HTTP_ORIGIN'])) {
			header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
			header('Access-Control-Allow-Credentials: true');
			header('Access-Control-Max-Age: 86400');
		}
	 
		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') { 
			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
				header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
	 
			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
				header("Access-Control-Allow-Headers:{$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
	 
			exit(0);
		}
	
		$postdata = file_get_contents("php://input");
		if (isset($postdata)) {
			$request = json_decode($postdata);
			$sotk_id = $request->sotk_id;
		
			$viewnotes = ORM::factory('Viewnote')
				->where('tujuan','=',$sotk_id);
			
			$arrNote = array();
			
			$n = $viewnotes->reset(FALSE)->count_all();
			if($n) {
				$viewnotes = $viewnotes
					->where('status','=',1)
					->order_by('prioritas','DESC')
					->find_all();	
				
				foreach($viewnotes as $vn) {
					$arrData = array(
						'id'=>$vn->id,
						'note'=>$vn->note,
						'dari_name'=>$vn->dari_name,
						'masuk_id'=>$vn->masuk_id,
						'tanggal_surat'=>$vn->tanggal_surat,
						'tanggal_terima'=>$vn->tanggal_terima,
						'pengirim'=>$vn->pengirim,
						'perihal'=>$vn->perihal,
						'isi'=>$vn->isi,
						'file'=>$vn->file
					);
					
					array_push($arrNote,$arrData);	
				}
			}
			
			$arrResults = array('results'=>$arrNote);
			
			echo json_encode($arrResults);
		}
	}
	
	public function action_read() {
		$this->auto_render = false;
		
		if (isset($_SERVER['HTTP_ORIGIN'])) {
			header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
			header('Access-Control-Allow-Credentials: true');
			header('Access-Control-Max-Age: 86400');
		}
	 
		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') { 
			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
				header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
	 
			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
				header("Access-Control-Allow-Headers:{$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
	 
			exit(0);
		}
	
		$postdata = file_get_contents("php://input");
		if (isset($postdata)) {
			$request = json_decode($postdata);
			$note_id = $request->note_id;
		
			$viewnotes = ORM::factory('Viewnote',$note_id);
			$jenis = $viewnotes->jenis;
			
			if($jenis == 1) {
				$table = "distributions";
			}
			else {
				$table = "disposisis";
			}
			
			DB::update($table)
				->set(array('masterbool_id' => 2))
				->where('id', '=', $viewnotes->data_id)
				->execute();
			
			$arrResults = array('status'=>'valid');
			
			echo json_encode($arrResults);
		}
	}
	
	public function action_distribusi() {
		$this->auto_render = false;
		$state = $this->request->param('id');
		
		if (isset($_SERVER['HTTP_ORIGIN'])) {
			header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
			header('Access-Control-Allow-Credentials: true');
			header('Access-Control-Max-Age: 86400');
		}
	 
		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') { 
			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
				header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
	 
			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
				header("Access-Control-Allow-Headers:{$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
	 
			exit(0);
		}
		
		$postdata = file_get_contents("php://input");
		if (isset($postdata)) {
			if($state == "new") {
				$request = json_decode($postdata);
				$sotk_id = $request->sotk_id;
				$sotk = ORM::factory('Sotk',$sotk_id);
				$skpd_id = $sotk->skpd_id;
				
				$sotks = ORM::factory('Sotk')
					->where('skpd_id','=',$skpd_id)
					->where('level','>',$sotk->level)
					->find_all();
				
				$arrSotk = array();
				foreach($sotks as $sotk) {				
					$arrData = array(
						'id'=>$sotk->id,
						'name'=>$sotk->name
					);
					array_push($arrSotk, $arrData);
				}
				
				$arrPrioritas = array();
				$masterbools = ORM::factory('Masterbool')->find_all();
				foreach($masterbools as $masterbool) {
					$arrData = array(
						'id'=>$masterbool->id,
						'name'=>$masterbool->prioritas
					);
					array_push($arrPrioritas, $arrData);
				}
				
				$arrDistribusi = array(
					'kepada'=>$arrSotk,
					'prioritas'=>$arrPrioritas
				);
				
				echo json_encode($arrDistribusi);
			}
		}
	}
	
	public function action_list() {
		$sotk_id = $this->request->param('id');
		
		
		$arrList = array();
		$arrWakil = array();
		$wakils = ORM::factory('Wakil')->find_all();
		foreach($wakils as $id=>$wakil) {
			$arrWakil[$id] = $wakil->name;
		}
		array_push($arrList,$arrWakil);
		echo json_encode($arrList);
	}
	
	public function action_check() {
		$u = ORM::factory('User')
			->where('username','=','sekdisporapar')
			->where('password','=',Auth::instance()->hash_password('12345678'))
			->find();
		echo $u->sotk->level;	
	}
}
?>