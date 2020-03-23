<?
defined('SYSPATH') or die('No direct script access.');

class Controller_Mobile_Base extends Controller {	
	function action_index(){
		echo "SIGP-API";
	}
	
	function action_kab() {
        $this->auto_render = false;
        $opsi = $this->request->param('id');
		
		$postdata = file_get_contents("php://input");
		
		if (isset($postdata)) {
			$request = json_decode($postdata);
						
			$arrKab = array();
			$arrAgama = array();
			$arrGender = array();
			$arrPendidikan = array();
			$arrParty = array();
            $arrPilihan = array();
			$n_pilihan = 0;
			$batas_lahir = date("Y")-16;
			
			$kabs = ORM::factory('Wilayah')
				->where('parent','=','32676')
				->order_by('nama','ASC')
				->find_all();

			foreach($kabs as $kab) {
				$arrData = array(
					'id' => $kab->id,
					'nama' => $kab->nama
				);
				
				array_push($arrKab, $arrData);
            }
			
			if($opsi == "n") {	
				$masteragamas = ORM::factory('Masteragama')
					->order_by('id','ASC')
					->find_all();
					
				foreach($masteragamas as $masteragama) {
					$arrData = array(
						'id'=>$masteragama->id,
						'name'=>$masteragama->name
					);
					array_push($arrAgama, $arrData);
				}
				
				$mastergenders = ORM::factory('Mastergender')->find_all();
				foreach($mastergenders as $mastergender) {
					$arrData = array(
						'id'=>$mastergender->id,
						'name'=>$mastergender->name
					);
					array_push($arrGender, $arrData);
				}
				
				$masterpendidikans = ORM::factory('Masterpendidikan')->find_all();
				foreach($masterpendidikans as $masterpendidikan) {
					$arrData = array(
						'id'=>$masterpendidikan->id,
						'name'=>$masterpendidikan->name
					);
					array_push($arrPendidikan, $arrData);
				}
				
				$masterpartys = ORM::factory('Party')
					->order_by('akronim','ASC')
					->find_all();
					
				foreach($masterpartys as $masterparty) {
					$arrData = array(
						'id'=>$masterparty->id,
						'name'=>$masterparty->akronim
					);
					array_push($arrParty, $arrData);
				}
			}
            elseif($opsi == "p") {
                $pilihans = ORM::factory('Pilihan');

                $n_pilihan = $pilihans->reset(FALSE)->count_all();	
                $pilihans = $pilihans
                    ->order_by('id','ASC')
                    ->find_all();
                
                foreach($pilihans as $pilihan) {
                    $arrData = array(
                        'id' => $pilihan->id,
                        'nama' => $pilihan->name
                    );
                    
                    array_push($arrPilihan, $arrData);
                }
			}
			
			$arrResult = array(
				'status' => 1,
				'kabs' => $arrKab,
                'opsi' => array(
                    'pilihans' => array(
                        'data' => $arrPilihan, 
                        'n' => $n_pilihan
					),
					'masteragamas' => $arrAgama,
					'mastergenders' => $arrGender,
					'masterpendidikans' => $arrPendidikan,
					'masterpartys' => $arrParty,
					'tahun' => $batas_lahir
                )
			);
							
			echo json_encode($arrResult);		
		}
	}
	
	function action_kec() {
		$this->auto_render = false;		
		
		$postdata = file_get_contents("php://input");
		
		if (isset($postdata)) {
			$request = json_decode($postdata);
			$kab_id = $request->kab_id;
						
			$kecs = ORM::factory('Wilayah')
				->where('parent','=',$kab_id)
				->order_by('nama','ASC')
				->find_all();
			
			$arrData = array();
			
			foreach($kecs as $kec) {
				$arrKec = array(
					'id' => $kec->id,
					'nama' => $kec->nama
				);
				
				array_push($arrData, $arrKec);
			}
				
			$arrResults = array('kecs'=>$arrData);
				
			echo json_encode($arrResults);		
		}
	}
	
	function action_kel() {
		$this->auto_render = false;		
		
		$postdata = file_get_contents("php://input");
		
		if (isset($postdata)) {
			$request = json_decode($postdata);
			$kec_id = $request->kec_id;
						
			$kels = ORM::factory('Wilayah')
				->where('parent','=',$kec_id)
				->order_by('nama','ASC')
				->find_all();
			
			$arrData = array();
			
			foreach($kels as $kel) {
				$arrKel = array(
					'id' => $kel->id,
					'nama' => $kel->nama
				);
				
				array_push($arrData, $arrKel);
			}
				
			$arrResults = array('kels'=>$arrData);
				
			echo json_encode($arrResults);		
		}
	}
	
	function action_tps() {
		$this->auto_render = false;		
		
		$postdata = file_get_contents("php://input");
		
		if (isset($postdata)) {
			$request = json_decode($postdata);
			$kel_id = $request->kel_id;
			
			$viewtps = ORM::factory('Viewtps')
				->where('wilayah_id','=',$kel_id)
				->find();
			
			$jumlah_tps = $viewtps->jumlah_tps;
			
			$arrData = array();
			
			for($i=1;$i<=$jumlah_tps;$i++) {
				$arrTps = array(
					'tps' => $i
				);
				array_push($arrData, $arrTps);
			}
				
			$arrResults = array('mastertps'=>$arrData);
				
			echo json_encode($arrResults);		
		}
	}
}
?>
