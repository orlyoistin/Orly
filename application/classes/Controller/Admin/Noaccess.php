<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Admin_Noaccess extends Controller_Admin_Backend { 
	function action_index(){
		$this->template->content = View::factory('noaccess');	
	} 
}
?>