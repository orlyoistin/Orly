<? 
defined('SYSPATH') OR die('No direct access allowed.');

return array 
( 
	'kode' => array(
		'not_empty'  		=> 'Kode harus diisi',
		'kode_available'	=> 'Kode sudah terpakai',
		'exact_length'		=> 'Kode harus 8 digit numerik',
		'digit'				=> 'Kode harus 8 digit numerik',
	),
	'name' => array(
		'not_empty'  		=> 'Nama harus diisi',
		'name_available'	=> 'Nama sudah terpakai',
	),
); 