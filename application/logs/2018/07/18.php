<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2018-07-18 07:57:49 --- EMERGENCY: ErrorException [ 8 ]: Undefined index: sotk_id ~ MODPATH/orm/classes/Kohana/ORM.php [ 633 ] in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/orm/classes/Kohana/ORM.php:633
2018-07-18 07:57:49 --- DEBUG: #0 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/orm/classes/Kohana/ORM.php(633): Kohana_Core::error_handler(8, 'Undefined index...', '/Volumes/MacDat...', 633, Array)
#1 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/orm/classes/Kohana/ORM.php(603): Kohana_ORM->get('sotk')
#2 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/views/dinas/disposisi_reload.php(52): Kohana_ORM->__get('sotk')
#3 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/View.php(62): include('/Volumes/MacDat...')
#4 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/View.php(359): Kohana_View::capture('/Volumes/MacDat...', Array)
#5 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/View.php(236): Kohana_View->render()
#6 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Controller/Dinas/Disposisi.php(59): Kohana_View->__toString()
#7 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Controller.php(84): Controller_Dinas_Disposisi->action_reload()
#8 [internal function]: Kohana_Controller->execute()
#9 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Dinas_Disposisi))
#10 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#11 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#12 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/index.php(109): Kohana_Request->execute()
#13 {main} in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/orm/classes/Kohana/ORM.php:633