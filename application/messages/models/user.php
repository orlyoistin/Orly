<?php

return array(
	'username' => array(
        'not_empty' => 'Username harus diisi',
        'min_length' => 'Username minimal :param2 karakter',
        'username_available' => 'Username sudah terpakai',
    ),
	'name' => array(
		'not_empty' => 'Nama harus diisi',
	),
	'nip' => array(
		'not_empty' => 'NIP harus diisi',
		'exact_length'	=> 'NIP harus 18 karakter',
	),	
	'kode' => array(
		'not_empty' => 'Kode harus diisi',
		'kode_available' => 'Kode Pelaksana sudah terpakai',
	),
	'skpd_id' => array(
		'not_empty' => 'Dinas / SKPD harus diisi',
	),
	'jabatan_id' => array(
		'not_empty' => 'Jabatan harus dipilih',
		'digit'		=> 'Jabatan harus dipilih',
	),
);