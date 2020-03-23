<?
defined('SYSPATH') or die('No direct script access.');

class Model_Status extends ORM {
	protected $_has_many = array(
		'instansi'			=> array(),
	);
}
?>