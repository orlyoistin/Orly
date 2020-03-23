<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Struktural_History extends Controller_Struktural_Backend {
	public $auth_required = array('login','struktural');
	
	public function action_index() {
		$this->auto_render = false;
		$id = $this->request->param('id');
		$masuks = ORM::factory('Masuk',$id);
		
		$notes = ORM::factory('Viewnote')
			->where('masuk_id','=',$id)
			->order_by('id','ASC')
			->find_all();
		
		/*$distributions = ORM::factory('Distribution')
			->where('masuk_id','=',$id)
			->order_by('tanggal','ASC')
			->order_by('id','ASC')
			->find_all();
		
		$disposisis = ORM::factory('Disposisi')
			->where('masuk_id','=',$id)
			->order_by('tanggal','ASC')
			->order_by('id','ASC')
			->find_all();	*/
			
		echo View::factory('struktural/history')			
			->bind('masuk',$masuks)
			->bind('notes',$notes);
			//->bind('distributions',$distributions)
			//->bind('disposisis',$disposisis)
			//->bind('file',$file);
	}
}
?>