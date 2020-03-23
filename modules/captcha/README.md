# Captcha module for Koseven

## Getting Started

Instantiate a captcha:

> $captcha = Captcha::instance();

Instantiate using your own config group (other than 'default'):

> $captcha = Captcha::instance('myconfig');

Render a captcha:

> $captcha->render();

or just:

> $captcha;

Validate the captcha:

> Captcha::valid($_POST['captcha']);

By default image-based captchas are rendered with HTML, the HTML is a very
simple `<img>` tag. If you want to handle your own rendering of the captcha
simply set the first parameter for render() to FALSE:

> $captcha->render(FALSE);

For the riddle style you must save the challenge at the end of your controller
action or in after().

> Captcha::instance()->update_response_session();

## Captcha Styles

* alpha
* basic
* black
* math
* riddle
* word
