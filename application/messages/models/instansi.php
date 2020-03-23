<? 
defined('SYSPATH') OR die('No direct access allowed.');

return array 
( 
	'kode' => array(
		'not_empty'  		=> 'Kode Instansi harus diisi',
		'kode_available'	=> 'Kode Instansi sudah terpakai',
	),
	'name' => array(
		'not_empty'  		=> 'Nama harus diisi',
		'name_available'	=> 'Nama sudah terpakai',
	),
	'status_id' => array(
		'not_empty'  		=> 'Status harus dipilih',
	),
); 