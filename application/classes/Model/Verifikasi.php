<?
defined('SYSPATH') or die('No direct script access.');

class Model_Verifikasi extends ORM {
	protected $_belongs_to = array(
		'sotk'	=> array(),
		'surat'	=> array(),
	);
}
?>