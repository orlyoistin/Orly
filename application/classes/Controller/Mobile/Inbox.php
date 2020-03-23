<?
defined('SYSPATH') or die('No direct script access.');

class Controller_Mobile_Inbox extends Controller {	
	function action_index(){
		echo "ESURAT-API";
	}
	
	function action_inbox() {
		$this->auto_render = false;	

		$error = 0;
		$item_per_page = 10;
		$total_data = 0;
		$total_page = 0;
		
		$postdata = file_get_contents("php://input");
		
		if (isset($postdata)) {
			$request = json_decode($postdata);
			
			$username = $request->username;
			$secret_key = $request->secret_key;
			$page = $request->page;
			
			/*$username = '196805171989081002';
			$page = 1;*/
			$offset = ($page - 1) * $item_per_page;

			$user = ORM::factory('User')
				->where('username','=',$username)
				->where('secret','=',$secret_key)
				->where('masterbool_id','=',2);
			
			$arrNote = array();	
			$level = 0;
			
			$n_user = $user->reset(FALSE)->count_all();

			if($n_user) {
				$user = $user->find();

				$sotk_id = $user->sotk_id;
				$level = $user->sotk->level;

				$viewnotes = ORM::factory('Viewnote')
					->where('status','=',1)
					->where('tujuan','=',$sotk_id);
				
				$total_data = $viewnotes->reset(FALSE)->count_all();
				$total_page = ceil($total_data / $item_per_page);

				if($total_data) {
					$viewnotes = $viewnotes
						->offset($offset)
						->limit($item_per_page)
						->order_by('prioritas','DESC')
						->find_all();
					
					foreach($viewnotes as $vn) {
						$arrData = array(
							'id' => $vn->id,
							'note' => $vn->note,
							'dari_name' => $vn->dari_name,
							'masuk_id' => $vn->masuk_id,
							'tanggal_surat' => $vn->tanggal_surat,
							'tanggal_terima' => $vn->tanggal_terima,
							'pengirim' => $vn->pengirim,
							'perihal' => $vn->perihal,
							'isi' => $vn->isi,
							'file' => $vn->file
						);
						
						array_push($arrNote,$arrData);
					}
				}
				else {
					$arrData = array('status'=>'invalid');
					array_push($arrNote,$arrData);
				}	
			}
			else {
				$arrData = array('status'=>'invalid');
				array_push($arrNote,$arrData);
			}

			$arrResults = array(
				'results' => $arrNote, 
				'level' => $level,
				'total_data' => $total_data,
				'total_page' => $total_page,
				'item_per_pages' => $item_per_page
			);
			
			echo json_encode($arrResults);			
		}
	}
	
	function action_read() {
		$this->auto_render = false;	
		$postdata = file_get_contents("php://input");	
			
		if (isset($postdata)) {
			$request = json_decode($postdata);
			
			$username = $request->username;
			$secret_key = $request->secret_key;
			$note_id = intval($request->note_id);
			
			$user = ORM::factory('User')
				->where('username','=',$username)
				->where('secret','=',$secret_key)
				->where('masterbool_id','=',2);
						
			$n_user = $user->reset(FALSE)->count_all();
			if($n_user) {
				$viewnote = ORM::factory('Viewnote',$note_id);
				
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
				
				$arrResults = array(
					'status' => 1,
				);	
			}
			else {
				$arrResults = array(
					'status' => 0,
				);
			}	
		}
		else {
			$arrResults = array(
				'status' => 0,
			);
		}

		echo json_encode($arrResults);
	}
	
	function action_pdf() {
		$this->auto_render = false;	
		$masuk_id = $this->request->param('id');
		$masuk = ORM::factory('Masuk',$masuk_id);
		
		$config	= Kohana::$config->load('configuration');
		$dir_doc = $config->get('config_dir_doc');
		$separator = Model::factory('Custom')->getSeparator();
		
		if(is_file($dir_doc.$separator.$masuk->file) && $masuk->file) {
			$file = $dir_doc.$separator.$masuk->file;
			$filename = $masuk->file;
			header('Content-type: application/pdf');
			header('Content-Disposition: inline; filename="'.$filename.'"');
			header('Content-Transfer-Encoding: binary');
			header('Content-Length: '.filesize($file));
			header('Accept-Ranges: bytes');
			@readfile($file);
		}	
	}
}
?>
