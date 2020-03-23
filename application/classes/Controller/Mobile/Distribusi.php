<?
defined('SYSPATH') or die('No direct script access.');

class Controller_Mobile_Distribusi extends Controller {	
	function action_index(){
		echo "ESURAT-API";
	}
	
	function action_new() {
		$this->auto_render = false;	
		$postdata = file_get_contents("php://input");
				
		if (isset($postdata)) {
			$request = json_decode($postdata);
			
			$username = $request->username;
			$secret_key = $request->secret_key;
								
			$user = ORM::factory('User')
				->where('username','=',$username)
				->where('secret','=',$secret_key)
				->where('masterbool_id','=',2);
			
			$n_user = $user->reset(FALSE)->count_all();
			
			$arrSotk = array();
			$arrPrioritas = array();
						
			if($n_user) {
				$user = $user->find();
				
				// SOTK
				$sotks = ORM::factory('Sotk')
					->where('level','=',1)
					->find_all();
				
				foreach($sotks as $s) {
					$arrData = array(
						'id' => $s->id,
						'name' => $s->name,
						'pejabat' => $s->pejabat
					);
					
					array_push($arrSotk, $arrData);
				}
				
				// PRIORITAS
				$masterbools = ORM::factory('Masterbool')
					->find_all();
				
				foreach($masterbools as $mb) {
					$arrData = array(
						'id' => $mb->id,
						'prioritas' => $mb->prioritas,
					);
					
					array_push($arrPrioritas, $arrData);
				} 
				
				$arrResult = array(
					'status' => 1,
					'level' => $user->sotk->level,
					'kepadas' => $arrSotk,
					'prioritasis' => $arrPrioritas,
				);
			}
			else {
				$arrResult = array(
					'status' => 0,
				);
			}
		}
		else {
			$arrResult = array(
				'status' => 0,
			);
		}
						
		echo json_encode($arrResult);	
	}
	
	function action_save() {
		$this->auto_render = false;	
		$postdata = file_get_contents("php://input");
		
		$arrField = array(
			'tanggal',
			'skpd_id',
			'masuk_id',
			'dari',
			'sotk_id',
			'dari_name',
			'kepada_name',
			'rekomendasi',
			'prioritas',
			'masterbool_id',
			'created',
			'user_id'
		);
				
		if (isset($postdata)) {
			$request = json_decode($postdata);
			
			$username = $request->username;
			$secret_key = $request->secret_key;
			$note_id = intval($request->note_id);
			$sotk_id = intval($request->kepada);
			$prioritas = intval($request->prioritas);
			$rekomendasi = $request->rekomendasi;
								
			$user = ORM::factory('User')
				->where('username','=',$username)
				->where('secret','=',$secret_key)
				->where('masterbool_id','=',2);
			
			$n_user = $user->reset(FALSE)->count_all();
						
			if($n_user) {
				$user = $user->find();
				
				$viewnote = ORM::factory('Viewnote',$note_id);
				$dari_name = ORM::factory('Sotk',$user->sotk_id)->name;		
				$kepada_name = ORM::factory('Sotk',$sotk_id)->name;
				
				$arrValue = array(
					"'".date("Y-m-d")."'",
					$user->skpd_id,
					$viewnote->masuk_id,
					$user->sotk_id,
					$sotk_id,
					"'".$dari_name."'",
					"'".$kepada_name."'",
					"'".$rekomendasi."'",
					1,
					$prioritas,
					"'".date("Y-m-d H:i:s")."'",
					$user->id
				);
				
				$value = "(".implode(",",$arrValue).")";								
				$field = implode(",",$arrField);	
					
				$sql = "INSERT INTO distributions (".$field.") VALUES ".$value;	
				list($distribution_id, $affected_rows) = DB::query(Database::INSERT, $sql)->execute();
				
				if($affected_rows > 0) {
					if($viewnote->jenis == 1) {
						$table = "distributions";
					}
					else {
						$table = "disposisis";
					}
				
					DB::update($table)
						->set(array('masterbool_id' => 2))
						->where('id','=',$viewnote->data_id)
						->execute();
									
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
						
						$response = Model::factory('Custom')->push($device_ids,$data,$title,$message);		
						$output = json_decode($response);
						
						if($output->recipients > 0) {
							DB::update('distributions')
								->set(array('message_id' => $output->id))
								->where('id','=',$distribution_id)
								->execute();
						}
					}	
				
					$arrResult = array(
						'status' => 1,
					);
				}
				else {
					$arrResult = array(
						'status' => 0,
					);
				}
			}
			else {
				$arrResult = array(
					'status' => 0,
				);
			}
		}
		else {
			$arrResult = array(
				'status' => 0,
			);
		}
						
		echo json_encode($arrResult);	
	}
}
?>
