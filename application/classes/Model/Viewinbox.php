<?
defined('SYSPATH') or die('No direct script access.');

class Model_Viewinbox extends ORM {	
	protected $_belongs_to = array(
		'surat'	=> array(),
		'sotk'	=> array(),
		'source' => array(
			'model'	=> 'Sotk',
			'foreign_key'	=> 'dari',
		),
	);
}
?>