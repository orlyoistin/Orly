<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Dinas_Noaccess extends Controller_Dinas_Backend { 
	function action_index(){
		$this->template->content = View::factory('noaccess');	
	} 
}
?>