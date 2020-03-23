<? 
defined('SYSPATH') OR die('No direct access allowed.');

return array 
( 
	'jenis_id' => array(
		'not_empty'  		=> 'Jenis harus dipilih',
	),
	'instansi_id' => array(
		'not_empty'  		=> 'Dari / Kepada harus dipilih',
	),
	'tanggal' => array(
		'not_empty'  		=> 'Tanggal Terima harus diisi',
	),
	'tanggal_surat' => array(
		'not_empty'  		=> 'Tanggal Surat harus diisi',
	),
	'nomor' => array(
		'not_empty'  		=> 'Nomor harus diisi',
		'nomor_available'	=> 'Nomor sudah terpakai',
	),
	'unit_id' => array(
		'not_empty'  		=> 'Unit Pengolah harus dipilih',
	),
	'guna_id' => array(
		'not_empty'  		=> 'Nilai Guna harus dipilih',
	),
	'tingkat_id' => array(
		'not_empty'  		=> 'Tingkat Perkembangan harus dipilih',
	),
	'bentuk_id' => array(
		'not_empty'  		=> 'Media harus dipilih',
	),
	'lampiran_id' => array(
		'not_empty'  		=> 'Lampiran harus dipilih',
	),
	'jumlah' => array(
		'not_empty'  		=> 'Jumlah harus diisi',
	),
	'urut' => array(
		'not_empty'  		=> 'No Urut harus diisi',
	),
); 