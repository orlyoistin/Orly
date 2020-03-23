<?
defined('SYSPATH') or die('No direct script access.');

class Model_Media extends ORM {
	protected $_has_many = array(
		'masuk'			=> array(),
		'keluar'		=> array(),
		'inaktif'		=> array(),
	);
}
?>