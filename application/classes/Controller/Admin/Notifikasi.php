<? 
defined('SYSPATH') or die('No direct script access.'); 

class Controller_Admin_Notifikasi extends Controller_Admin_Backend {
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
	
	function action_push() {
		$this->auto_render = false;
		
		$to="fiVq5vVBz7c:APA91bG4Aha9CuSaN3lXLQEgsp9n_okKYLCFxuvYzCMQhuOB8y76-seuwNV7GsUIBB5HfAK8pVDgiWtKafYKgSRzaDCPNhRj9amjKbgDP8fqYVWBywdoZgW3Hv_gq6AeqzNBl0IIaksj";
		//$to="APA91bG4Aha9CuSaN3lXLQEgsp9n_okKYLCFxuvYzCMQhuOB8y76-seuwNV7GsUIBB5HfAK8pVDgiWtKafYKgSRzaDCPNhRj9amjKbgDP8fqYVWBywdoZgW3Hv_gq6AeqzNBl0IIaksj";
		$title="Push Notification Title";
		$message="Push Notification Message";
		$this->sendPush($to,$title,$message);
	}
	
	function sendPush($to,$title,$message) {
		$registrationIds = array($to);
		
		$msg = array(
			'message' => $message,
			'title' => $title,
			'vibrate' => 1,
			'sound' => 1
		);
		
		$fields = array(
			'registration_ids' => $registrationIds,
			'data' => $msg
		);
		
		$headers = array(
			'https://fcm.googleapis.com/fcm/send',
			//'Authorization:key=AIzaSyB_6tsNQv9tqm81IKMYeAjnjJNtW5idsSY',
			'Authorization:key=AIzaSyAW2P-_MXl0O0LYF-ffR-dqaXzcLx64zak',
			'Content-Type: application/json'
		);
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		curl_close( $ch );
		echo $result;
	}
}  
?>