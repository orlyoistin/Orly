<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2019-01-17 05:33:31 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: masterbool_list ~ APPPATH/views/dinas/user_form.php [ 143 ] in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/views/dinas/user_form.php:143
2019-01-17 05:33:31 --- DEBUG: #0 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/views/dinas/user_form.php(143): Kohana_Core::error_handler(8, 'Undefined varia...', '/Volumes/MacDat...', 143, Array)
#1 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/View.php(62): include('/Volumes/MacDat...')
#2 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/View.php(359): Kohana_View::capture('/Volumes/MacDat...', Array)
#3 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/View.php(236): Kohana_View->render()
#4 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/views/template/dinas.php(232): Kohana_View->__toString()
#5 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/View.php(62): include('/Volumes/MacDat...')
#6 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/View.php(359): Kohana_View::capture('/Volumes/MacDat...', Array)
#7 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Controller/Template.php(44): Kohana_View->render()
#8 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Controller/Dinas/Backend.php(39): Kohana_Controller_Template->after()
#9 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Controller.php(87): Controller_Dinas_Backend->after()
#10 [internal function]: Kohana_Controller->execute()
#11 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Dinas_User))
#12 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#13 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#14 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/index.php(109): Kohana_Request->execute()
#15 {main} in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/views/dinas/user_form.php:143