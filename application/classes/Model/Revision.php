<?
defined('SYSPATH') or die('No direct script access.');

class Model_Revision extends ORM {
	protected $_belongs_to = array(
		'naskah' => array(),
		'mastersurat' => array(),
	);
}
?>