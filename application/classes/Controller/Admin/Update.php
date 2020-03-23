<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Update extends Controller_Admin_Backend {
	public $auth_required = array('login','root');
			
	public function action_parent() {
		$skpds = ORM::factory('Skpd')
			->where('tipe','=',2)
			->find_all();
			
		foreach($skpds as $skpd) {
			$sotks = $skpd->sotk
				->where('level','<',4)
				->find_all();	
							
			foreach($sotks as $sotk) {			
				if($sotk->level == 1) {
					DB::update('sotks')
						->set(array('parent_id' => $sotk->id))
						->where('skpd_id','=',$sotk->skpd_id)
						->where('level','=', 2)
						->execute();	
				}
				elseif($sotk->level == 2) {
					if($skpd->tipe == 2) {
						DB::update('sotks')
							->set(array('parent_id' => $sotk->id))
							->where('skpd_id','=',$sotk->skpd_id)
							->where(DB::expr('LEFT(kode,5)'),'=',substr($sotk->kode,0,5))
							->where('level','=',3)
							->execute();
					}
					/*if($skpd->id < 43) {
						DB::update('sotks')
							->set(array('parent_id' => $sotk->id))
							->where('skpd_id','=',$sotk->skpd_id)
							->where(DB::expr('LEFT(kode,6)'),'=',substr($sotk->kode,0,6))
							->where('level','=',3)
							->execute();
					}
					else {
						DB::update('sotks')
							->set(array('parent_id' => $sotk->id))
							->where('skpd_id','=',$sotk->skpd_id)
							->where(DB::expr('LEFT(kode,7)'),'=',substr($sotk->kode,0,7))
							->where('level','=',3)
							->execute();
					}*/	
				}
				elseif($sotk->level == 3) {
					if($skpd->tipe == 2) {
						DB::update('sotks')
							->set(array('parent_id' => $sotk->id))
							->where('skpd_id','=',$sotk->skpd_id)
							->where(DB::expr('LEFT(kode,6)'),'=',substr($sotk->kode,0,6))
							->where('level','=',4)
							->execute();
					}
					/*if($skpd->id < 43) {
						DB::update('sotks')
							->set(array('parent_id' => $sotk->id))
							->where('skpd_id','=',$sotk->skpd_id)
							->where(DB::expr('LEFT(kode,6)'),'=',substr($sotk->kode,0,6))
							->where('level','=',4)
							->execute();
					}
					else {
						DB::update('sotks')
							->set(array('parent_id' => $sotk->id))
							->where('skpd_id','=',$sotk->skpd_id)
							->where(DB::expr('LEFT(kode,7)'),'=',substr($sotk->kode,0,7))
							->where('level','=',4)
							->execute();
						
					}*/
				}
			}
		}
	}
	
	public function action_user() {
		$this->auto_render = false;
	
		$skpds = ORM::factory('Skpd')
			->find_all();
			
		foreach($skpds as $skpd) {
			$model = ORM::factory('User');
			$model->values(array(
				'username' => $skpd->kode.'arsip',		   	
				'password' => '12345678',
				'password_confirm' => '12345678',			
				'name' => $skpd->name,
				'kode' => 'ADM'.$skpd->kode,
				'email' => 'admin@admin.com',
				'jabatan_id' => 2,
				'skpd_id' => $skpd->id,
			));
			$model->save();
			$model->add('roles', ORM::factory('Role')->where('name', '=', 'login')->find());
			$model->add('roles', ORM::factory('Role')->where('name', '=', 'dinas')->find());
		}
	}
	
	/*public function action_biro() {
		$arrBiro = array('020011','020012','020013','020021','020022','020023','020031','020032','020041','020042','020043','020044');
		
		foreach($arrBiro as $biro) {
			$skpd = ORM::factory('Skpd')
				->where('kode','=',$biro.'0000')
				->find();
			
			$sotks = ORM::factory('Sotk')
				->where('KOLOK','LIKE',$biro.'%')
				->find_all();	
			
			foreach($sotks as $sotk) {
				DB::update('sotks')
					->set(array('skpd_id' => $skpd->id))
					->where('id', '=', $sotk->id)
					->execute();
				
				if(substr($sotk->KOLOK,-4) == "0000") {
					$level = 1;
				}
				elseif(substr($sotk->KOLOK,-3) == "000" && substr($sotk->KOLOK,-4) != "0000") {
					$level = 2;
				}
				
				elseif(substr($sotk->KOLOK,-2) == "00" && substr($sotk->KOLOK,-3) != "000") {
					$level = 3;
				}
				
				DB::update('sotks')
					->set(array('LEVEL' => $level))
					->where('id', '=', $sotk->id)
					->execute();	
					
					
			}
		}
	}*/
}
?>