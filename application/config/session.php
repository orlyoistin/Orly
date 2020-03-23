<?php defined('SYSPATH') or die('No direct access allowed.');

return array(
      'cookie' => array(
          'name' => 'session_cookie',
          'encrypted' => TRUE,
          'lifetime' => 3600,
      ),
      'native' => array(
          'name' => 'session_native',
          'encrypted' => TRUE,
          'lifetime' => 3600,
      ),
      'database' => array(
          'name' => 'session_database',
		  'encrypted' => TRUE, 
          'group' => 'default',
          'table' => 'sessions',
		  'lifetime' => 3600,
      ),
  );
?>