<? 
defined('SYSPATH') or die('No direct script access.'); 

class Controller_Struktural_Notifikasi extends Controller_Struktural_Backend {
	function action_index(){
		$this->auto_render = false;
		$note = ORM::factory('Note')->where('user_id','=',Auth::instance()->get_user()->id)->where('read_id','=','1')->count_all();
		if($note) {
			echo "<img src='".URL::base()."assets/images/mail.gif'><div class='mail_text'><a href='".URL::base()."disposisi/note?s=1'>User Notes (".$note.")</a></div>";
		}
		else {
			echo "<img src='".URL::base()."assets/images/mail.png'><div class='mail_text'><a href='".URL::base()."disposisi/note?s=1'>User Notes (".$note.")</a></div>";
		}
	}
}  

?>