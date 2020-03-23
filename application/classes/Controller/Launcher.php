<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Launcher extends Controller_Template
{
	public $template = 'template/home';
    public $auth_required = FALSE;
    public $secure_actions = FALSE;

	public function before() {
		parent::before();
		
		$action_name = Request::current()->action();
         if(($this->auth_required !== FALSE && Auth_ORM::instance()->logged_in($this->auth_required) === FALSE) || (is_array($this->secure_actions) && array_key_exists($action_name, $this->secure_actions) && Auth_ORM::instance()->logged_in($this->secure_actions[$action_name]) === FALSE)) {
			if(Auth::instance()->logged_in()) {
				HTTP::redirect('user/noaccess');
			}
			else {
				HTTP::redirect('admin');
			}
		}
		
		if ($this->auto_render)	{
			$this->template->title   = '';
			$this->template->content = '';		
			$this->template->styles = array();
			$this->template->scripts = array();   
		}
	}
	
	public function after() {
		if ($this->auto_render) {
			$styles		= array(URL::base().'assets/css/reset.css' => 'screen');
			$scripts   	= array(URL::base().'assets/js/jquery-2.0.3.min.js');
		
			$this->template->styles 	= array_merge($this->template->styles, $styles);
			$this->template->scripts 	= array_merge($this->template->scripts, $scripts);
		
		}
		parent::after();
	}
}
?>