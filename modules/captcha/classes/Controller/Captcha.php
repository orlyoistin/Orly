<?php

/**
 * Outputs the dynamic Captcha resource.
 * Usage: Call the Captcha controller from a view, e.g.
 *        <img src="<?php echo URL::site('captcha') ?>" />
 *
 * @package		Captcha
 * @subpackage	Controller_Captcha
 * @author		Michael Lavers
 * @author		Kohana Team
 * @copyright	(c) 2008-2010 Kohana Team
 * @license		BSD-3-Clause
 */
class Controller_Captcha extends Controller {

	/**
	 * @var boolean Auto render template
	 **/
	public $auto_render = FALSE;

	/**
	 * Output the captcha challenge
	 *
	 * @param string $group Config group name
	 */
	public function action_index()
	{
		// Output the Captcha challenge resource (no html)
		// Pull the config group name from the URL
		$group = $this->request->param('group', 'default');

		$captcha = Captcha::instance($group);

		$this->response
			->headers($captcha->http_headers())
			->body($captcha->render(FALSE));
    }

	public function after()
	{
		Captcha::instance()->update_response_session();
	}

} // End Captcha_Controller
