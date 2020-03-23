<? 
defined('SYSPATH') or die('No direct script access.');
 
class Controller_Home extends Controller_Layout {
	function action_index(){
		$user = Auth::instance()->get_user();
		
		if(!$user || !Auth::instance()->logged_in('login')) {
			HTTP::redirect(URL::base().'register/logout');
		}
		else {
			if(Auth::instance()->logged_in('root')) {
				HTTP::redirect(URL::base().'admin');
			}
			elseif(Auth::instance()->logged_in('dinas')) {
				HTTP::redirect(URL::base().'dinas');
			}
			elseif(Auth::instance()->logged_in('struktural')) {
				HTTP::redirect(URL::base().'struktural');
			}	
		}
	}
}
?>