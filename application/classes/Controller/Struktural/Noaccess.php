<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Struktural_Noaccess extends Controller_Struktural_Backend { 
	function action_index(){
		$this->template->content = View::factory('noaccess');	
	} 
}
?>