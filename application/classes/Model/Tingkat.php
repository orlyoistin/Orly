<?
defined('SYSPATH') or die('No direct script access.');

class Model_Tingkat extends ORM {
	protected $_has_many = array(
		'aktif'			=> array(),
		'iaktif'		=> array(),
	);
}
?>