<? 
defined('SYSPATH') or die('No direct script access.');
 
class Controller_Struktural_Home extends Controller_Struktural_Backend {
	function action_index(){
		$user = Auth::instance()->get_user();		
		if(!$user || !Auth::instance()->logged_in('login') || !Auth::instance()->logged_in('struktural') ) {
			HTTP::redirect(URL::base().'register/logout');
		}
		
		$this->template->content = View::factory('struktural/home');
	}
}
?>