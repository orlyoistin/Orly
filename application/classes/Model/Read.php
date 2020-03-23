<?
defined('SYSPATH') or die('No direct script access.');

class Model_Read extends ORM {
	protected $_has_many = array(
		'note'			=> array(),
	);
}
?>