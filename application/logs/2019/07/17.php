<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2019-07-17 10:50:10 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: submit_value ~ APPPATH/views/dinas/instansi_form.php [ 35 ] in /home/arsipsemarangkot/public_html/application/views/dinas/instansi_form.php:35
2019-07-17 10:50:10 --- DEBUG: #0 /home/arsipsemarangkot/public_html/application/views/dinas/instansi_form.php(35): Kohana_Core::error_handler(8, 'Undefined varia...', '/home/arsipsema...', 35, Array)
#1 /home/arsipsemarangkot/public_html/system/classes/Kohana/View.php(62): include('/home/arsipsema...')
#2 /home/arsipsemarangkot/public_html/system/classes/Kohana/View.php(359): Kohana_View::capture('/home/arsipsema...', Array)
#3 /home/arsipsemarangkot/public_html/system/classes/Kohana/View.php(236): Kohana_View->render()
#4 /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/Instansi.php(60): Kohana_View->__toString()
#5 /home/arsipsemarangkot/public_html/system/classes/Kohana/Controller.php(84): Controller_Dinas_Instansi->action_save()
#6 [internal function]: Kohana_Controller->execute()
#7 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Dinas_Instansi))
#8 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#9 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#10 /home/arsipsemarangkot/public_html/index.php(109): Kohana_Request->execute()
#11 {main} in /home/arsipsemarangkot/public_html/application/views/dinas/instansi_form.php:35
2019-07-17 11:11:03 --- EMERGENCY: ErrorException [ 8 ]: Undefined index: image ~ APPPATH/classes/Controller/Dinas/User.php [ 49 ] in /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/User.php:49
2019-07-17 11:11:03 --- DEBUG: #0 /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/User.php(49): Kohana_Core::error_handler(8, 'Undefined index...', '/home/arsipsema...', 49, Array)
#1 /home/arsipsemarangkot/public_html/system/classes/Kohana/Controller.php(84): Controller_Dinas_User->action_create()
#2 [internal function]: Kohana_Controller->execute()
#3 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Dinas_User))
#4 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#6 /home/arsipsemarangkot/public_html/index.php(109): Kohana_Request->execute()
#7 {main} in /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/User.php:49
2019-07-17 11:11:15 --- EMERGENCY: ErrorException [ 8 ]: Undefined index: image ~ APPPATH/classes/Controller/Dinas/User.php [ 49 ] in /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/User.php:49
2019-07-17 11:11:15 --- DEBUG: #0 /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/User.php(49): Kohana_Core::error_handler(8, 'Undefined index...', '/home/arsipsema...', 49, Array)
#1 /home/arsipsemarangkot/public_html/system/classes/Kohana/Controller.php(84): Controller_Dinas_User->action_create()
#2 [internal function]: Kohana_Controller->execute()
#3 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Dinas_User))
#4 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#6 /home/arsipsemarangkot/public_html/index.php(109): Kohana_Request->execute()
#7 {main} in /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/User.php:49
2019-07-17 11:11:49 --- EMERGENCY: ErrorException [ 8 ]: Undefined index: image ~ APPPATH/classes/Controller/Dinas/User.php [ 49 ] in /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/User.php:49
2019-07-17 11:11:49 --- DEBUG: #0 /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/User.php(49): Kohana_Core::error_handler(8, 'Undefined index...', '/home/arsipsema...', 49, Array)
#1 /home/arsipsemarangkot/public_html/system/classes/Kohana/Controller.php(84): Controller_Dinas_User->action_create()
#2 [internal function]: Kohana_Controller->execute()
#3 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Dinas_User))
#4 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#6 /home/arsipsemarangkot/public_html/index.php(109): Kohana_Request->execute()
#7 {main} in /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/User.php:49
2019-07-17 11:49:11 --- EMERGENCY: Database_Exception [ 1054 ]: Unknown column 'keyword' in 'where clause' [ SELECT COUNT(`viewpemberkasan`.`id`) AS `records_found` FROM `viewpemberkasans` AS `viewpemberkasan` WHERE `skpd_id` = '51' AND `keyword` LIKE '%bintek%' ] ~ MODPATH/database/classes/Kohana/Database/MySQL.php [ 194 ] in /home/arsipsemarangkot/public_html/modules/database/classes/Kohana/Database/Query.php:251
2019-07-17 11:49:11 --- DEBUG: #0 /home/arsipsemarangkot/public_html/modules/database/classes/Kohana/Database/Query.php(251): Kohana_Database_MySQL->query(1, 'SELECT COUNT(`v...', false, Array)
#1 /home/arsipsemarangkot/public_html/modules/orm/classes/Kohana/ORM.php(1648): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/Berkas.php(84): Kohana_ORM->count_all()
#3 /home/arsipsemarangkot/public_html/system/classes/Kohana/Controller.php(84): Controller_Dinas_Berkas->action_data()
#4 [internal function]: Kohana_Controller->execute()
#5 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Dinas_Berkas))
#6 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#8 /home/arsipsemarangkot/public_html/index.php(109): Kohana_Request->execute()
#9 {main} in /home/arsipsemarangkot/public_html/modules/database/classes/Kohana/Database/Query.php:251
2019-07-17 11:49:59 --- EMERGENCY: Database_Exception [ 1054 ]: Unknown column 'keyword' in 'where clause' [ SELECT COUNT(`viewpemberkasan`.`id`) AS `records_found` FROM `viewpemberkasans` AS `viewpemberkasan` WHERE `skpd_id` = '51' AND `keyword` LIKE '%bintek%' ] ~ MODPATH/database/classes/Kohana/Database/MySQL.php [ 194 ] in /home/arsipsemarangkot/public_html/modules/database/classes/Kohana/Database/Query.php:251
2019-07-17 11:49:59 --- DEBUG: #0 /home/arsipsemarangkot/public_html/modules/database/classes/Kohana/Database/Query.php(251): Kohana_Database_MySQL->query(1, 'SELECT COUNT(`v...', false, Array)
#1 /home/arsipsemarangkot/public_html/modules/orm/classes/Kohana/ORM.php(1648): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/Berkas.php(84): Kohana_ORM->count_all()
#3 /home/arsipsemarangkot/public_html/system/classes/Kohana/Controller.php(84): Controller_Dinas_Berkas->action_data()
#4 [internal function]: Kohana_Controller->execute()
#5 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Dinas_Berkas))
#6 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#8 /home/arsipsemarangkot/public_html/index.php(109): Kohana_Request->execute()
#9 {main} in /home/arsipsemarangkot/public_html/modules/database/classes/Kohana/Database/Query.php:251
2019-07-17 11:49:59 --- EMERGENCY: Database_Exception [ 1054 ]: Unknown column 'keyword' in 'where clause' [ SELECT COUNT(`viewpemberkasan`.`id`) AS `records_found` FROM `viewpemberkasans` AS `viewpemberkasan` WHERE `skpd_id` = '51' AND `keyword` LIKE '%bintek%' ] ~ MODPATH/database/classes/Kohana/Database/MySQL.php [ 194 ] in /home/arsipsemarangkot/public_html/modules/database/classes/Kohana/Database/Query.php:251
2019-07-17 11:49:59 --- DEBUG: #0 /home/arsipsemarangkot/public_html/modules/database/classes/Kohana/Database/Query.php(251): Kohana_Database_MySQL->query(1, 'SELECT COUNT(`v...', false, Array)
#1 /home/arsipsemarangkot/public_html/modules/orm/classes/Kohana/ORM.php(1648): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/Berkas.php(84): Kohana_ORM->count_all()
#3 /home/arsipsemarangkot/public_html/system/classes/Kohana/Controller.php(84): Controller_Dinas_Berkas->action_data()
#4 [internal function]: Kohana_Controller->execute()
#5 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Dinas_Berkas))
#6 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#8 /home/arsipsemarangkot/public_html/index.php(109): Kohana_Request->execute()
#9 {main} in /home/arsipsemarangkot/public_html/modules/database/classes/Kohana/Database/Query.php:251
2019-07-17 11:49:59 --- EMERGENCY: Database_Exception [ 1054 ]: Unknown column 'keyword' in 'where clause' [ SELECT COUNT(`viewpemberkasan`.`id`) AS `records_found` FROM `viewpemberkasans` AS `viewpemberkasan` WHERE `skpd_id` = '51' AND `keyword` LIKE '%bintek%' ] ~ MODPATH/database/classes/Kohana/Database/MySQL.php [ 194 ] in /home/arsipsemarangkot/public_html/modules/database/classes/Kohana/Database/Query.php:251
2019-07-17 11:49:59 --- DEBUG: #0 /home/arsipsemarangkot/public_html/modules/database/classes/Kohana/Database/Query.php(251): Kohana_Database_MySQL->query(1, 'SELECT COUNT(`v...', false, Array)
#1 /home/arsipsemarangkot/public_html/modules/orm/classes/Kohana/ORM.php(1648): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/Berkas.php(84): Kohana_ORM->count_all()
#3 /home/arsipsemarangkot/public_html/system/classes/Kohana/Controller.php(84): Controller_Dinas_Berkas->action_data()
#4 [internal function]: Kohana_Controller->execute()
#5 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Dinas_Berkas))
#6 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#8 /home/arsipsemarangkot/public_html/index.php(109): Kohana_Request->execute()
#9 {main} in /home/arsipsemarangkot/public_html/modules/database/classes/Kohana/Database/Query.php:251
2019-07-17 11:49:59 --- EMERGENCY: Database_Exception [ 1054 ]: Unknown column 'keyword' in 'where clause' [ SELECT COUNT(`viewpemberkasan`.`id`) AS `records_found` FROM `viewpemberkasans` AS `viewpemberkasan` WHERE `skpd_id` = '51' AND `keyword` LIKE '%bintek%' ] ~ MODPATH/database/classes/Kohana/Database/MySQL.php [ 194 ] in /home/arsipsemarangkot/public_html/modules/database/classes/Kohana/Database/Query.php:251
2019-07-17 11:49:59 --- DEBUG: #0 /home/arsipsemarangkot/public_html/modules/database/classes/Kohana/Database/Query.php(251): Kohana_Database_MySQL->query(1, 'SELECT COUNT(`v...', false, Array)
#1 /home/arsipsemarangkot/public_html/modules/orm/classes/Kohana/ORM.php(1648): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/Berkas.php(84): Kohana_ORM->count_all()
#3 /home/arsipsemarangkot/public_html/system/classes/Kohana/Controller.php(84): Controller_Dinas_Berkas->action_data()
#4 [internal function]: Kohana_Controller->execute()
#5 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Dinas_Berkas))
#6 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#8 /home/arsipsemarangkot/public_html/index.php(109): Kohana_Request->execute()
#9 {main} in /home/arsipsemarangkot/public_html/modules/database/classes/Kohana/Database/Query.php:251
2019-07-17 11:49:59 --- EMERGENCY: Database_Exception [ 1054 ]: Unknown column 'keyword' in 'where clause' [ SELECT COUNT(`viewpemberkasan`.`id`) AS `records_found` FROM `viewpemberkasans` AS `viewpemberkasan` WHERE `skpd_id` = '51' AND `keyword` LIKE '%bintek%' ] ~ MODPATH/database/classes/Kohana/Database/MySQL.php [ 194 ] in /home/arsipsemarangkot/public_html/modules/database/classes/Kohana/Database/Query.php:251
2019-07-17 11:49:59 --- DEBUG: #0 /home/arsipsemarangkot/public_html/modules/database/classes/Kohana/Database/Query.php(251): Kohana_Database_MySQL->query(1, 'SELECT COUNT(`v...', false, Array)
#1 /home/arsipsemarangkot/public_html/modules/orm/classes/Kohana/ORM.php(1648): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/Berkas.php(84): Kohana_ORM->count_all()
#3 /home/arsipsemarangkot/public_html/system/classes/Kohana/Controller.php(84): Controller_Dinas_Berkas->action_data()
#4 [internal function]: Kohana_Controller->execute()
#5 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Dinas_Berkas))
#6 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#8 /home/arsipsemarangkot/public_html/index.php(109): Kohana_Request->execute()
#9 {main} in /home/arsipsemarangkot/public_html/modules/database/classes/Kohana/Database/Query.php:251
2019-07-17 11:50:00 --- EMERGENCY: Database_Exception [ 1054 ]: Unknown column 'keyword' in 'where clause' [ SELECT COUNT(`viewpemberkasan`.`id`) AS `records_found` FROM `viewpemberkasans` AS `viewpemberkasan` WHERE `skpd_id` = '51' AND `keyword` LIKE '%bintek%' ] ~ MODPATH/database/classes/Kohana/Database/MySQL.php [ 194 ] in /home/arsipsemarangkot/public_html/modules/database/classes/Kohana/Database/Query.php:251
2019-07-17 11:50:00 --- DEBUG: #0 /home/arsipsemarangkot/public_html/modules/database/classes/Kohana/Database/Query.php(251): Kohana_Database_MySQL->query(1, 'SELECT COUNT(`v...', false, Array)
#1 /home/arsipsemarangkot/public_html/modules/orm/classes/Kohana/ORM.php(1648): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/Berkas.php(84): Kohana_ORM->count_all()
#3 /home/arsipsemarangkot/public_html/system/classes/Kohana/Controller.php(84): Controller_Dinas_Berkas->action_data()
#4 [internal function]: Kohana_Controller->execute()
#5 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Dinas_Berkas))
#6 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#8 /home/arsipsemarangkot/public_html/index.php(109): Kohana_Request->execute()
#9 {main} in /home/arsipsemarangkot/public_html/modules/database/classes/Kohana/Database/Query.php:251
2019-07-17 11:51:07 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: submit_value ~ APPPATH/views/dinas/instansi_form.php [ 35 ] in /home/arsipsemarangkot/public_html/application/views/dinas/instansi_form.php:35
2019-07-17 11:51:07 --- DEBUG: #0 /home/arsipsemarangkot/public_html/application/views/dinas/instansi_form.php(35): Kohana_Core::error_handler(8, 'Undefined varia...', '/home/arsipsema...', 35, Array)
#1 /home/arsipsemarangkot/public_html/system/classes/Kohana/View.php(62): include('/home/arsipsema...')
#2 /home/arsipsemarangkot/public_html/system/classes/Kohana/View.php(359): Kohana_View::capture('/home/arsipsema...', Array)
#3 /home/arsipsemarangkot/public_html/system/classes/Kohana/View.php(236): Kohana_View->render()
#4 /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/Instansi.php(60): Kohana_View->__toString()
#5 /home/arsipsemarangkot/public_html/system/classes/Kohana/Controller.php(84): Controller_Dinas_Instansi->action_save()
#6 [internal function]: Kohana_Controller->execute()
#7 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Dinas_Instansi))
#8 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#9 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#10 /home/arsipsemarangkot/public_html/index.php(109): Kohana_Request->execute()
#11 {main} in /home/arsipsemarangkot/public_html/application/views/dinas/instansi_form.php:35
2019-07-17 11:51:14 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: inaktif ~ APPPATH/classes/Controller/Dinas/Inaktif.php [ 21 ] in /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/Inaktif.php:21
2019-07-17 11:51:14 --- DEBUG: #0 /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/Inaktif.php(21): Kohana_Core::error_handler(8, 'Undefined varia...', '/home/arsipsema...', 21, Array)
#1 /home/arsipsemarangkot/public_html/system/classes/Kohana/Controller.php(84): Controller_Dinas_Inaktif->action_new()
#2 [internal function]: Kohana_Controller->execute()
#3 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Dinas_Inaktif))
#4 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#6 /home/arsipsemarangkot/public_html/index.php(109): Kohana_Request->execute()
#7 {main} in /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/Inaktif.php:21
2019-07-17 11:51:21 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: inaktif ~ APPPATH/classes/Controller/Dinas/Inaktif.php [ 21 ] in /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/Inaktif.php:21
2019-07-17 11:51:21 --- DEBUG: #0 /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/Inaktif.php(21): Kohana_Core::error_handler(8, 'Undefined varia...', '/home/arsipsema...', 21, Array)
#1 /home/arsipsemarangkot/public_html/system/classes/Kohana/Controller.php(84): Controller_Dinas_Inaktif->action_new()
#2 [internal function]: Kohana_Controller->execute()
#3 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Dinas_Inaktif))
#4 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#6 /home/arsipsemarangkot/public_html/index.php(109): Kohana_Request->execute()
#7 {main} in /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/Inaktif.php:21
2019-07-17 11:51:35 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: inaktif ~ APPPATH/classes/Controller/Dinas/Inaktif.php [ 21 ] in /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/Inaktif.php:21
2019-07-17 11:51:35 --- DEBUG: #0 /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/Inaktif.php(21): Kohana_Core::error_handler(8, 'Undefined varia...', '/home/arsipsema...', 21, Array)
#1 /home/arsipsemarangkot/public_html/system/classes/Kohana/Controller.php(84): Controller_Dinas_Inaktif->action_new()
#2 [internal function]: Kohana_Controller->execute()
#3 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Dinas_Inaktif))
#4 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#6 /home/arsipsemarangkot/public_html/index.php(109): Kohana_Request->execute()
#7 {main} in /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/Inaktif.php:21
2019-07-17 11:52:19 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: submit_value ~ APPPATH/views/dinas/instansi_form.php [ 35 ] in /home/arsipsemarangkot/public_html/application/views/dinas/instansi_form.php:35
2019-07-17 11:52:19 --- DEBUG: #0 /home/arsipsemarangkot/public_html/application/views/dinas/instansi_form.php(35): Kohana_Core::error_handler(8, 'Undefined varia...', '/home/arsipsema...', 35, Array)
#1 /home/arsipsemarangkot/public_html/system/classes/Kohana/View.php(62): include('/home/arsipsema...')
#2 /home/arsipsemarangkot/public_html/system/classes/Kohana/View.php(359): Kohana_View::capture('/home/arsipsema...', Array)
#3 /home/arsipsemarangkot/public_html/system/classes/Kohana/View.php(236): Kohana_View->render()
#4 /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/Instansi.php(60): Kohana_View->__toString()
#5 /home/arsipsemarangkot/public_html/system/classes/Kohana/Controller.php(84): Controller_Dinas_Instansi->action_save()
#6 [internal function]: Kohana_Controller->execute()
#7 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Dinas_Instansi))
#8 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#9 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#10 /home/arsipsemarangkot/public_html/index.php(109): Kohana_Request->execute()
#11 {main} in /home/arsipsemarangkot/public_html/application/views/dinas/instansi_form.php:35
2019-07-17 11:52:19 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: submit_value ~ APPPATH/views/dinas/instansi_form.php [ 35 ] in /home/arsipsemarangkot/public_html/application/views/dinas/instansi_form.php:35
2019-07-17 11:52:19 --- DEBUG: #0 /home/arsipsemarangkot/public_html/application/views/dinas/instansi_form.php(35): Kohana_Core::error_handler(8, 'Undefined varia...', '/home/arsipsema...', 35, Array)
#1 /home/arsipsemarangkot/public_html/system/classes/Kohana/View.php(62): include('/home/arsipsema...')
#2 /home/arsipsemarangkot/public_html/system/classes/Kohana/View.php(359): Kohana_View::capture('/home/arsipsema...', Array)
#3 /home/arsipsemarangkot/public_html/system/classes/Kohana/View.php(236): Kohana_View->render()
#4 /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/Instansi.php(60): Kohana_View->__toString()
#5 /home/arsipsemarangkot/public_html/system/classes/Kohana/Controller.php(84): Controller_Dinas_Instansi->action_save()
#6 [internal function]: Kohana_Controller->execute()
#7 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Dinas_Instansi))
#8 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#9 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#10 /home/arsipsemarangkot/public_html/index.php(109): Kohana_Request->execute()
#11 {main} in /home/arsipsemarangkot/public_html/application/views/dinas/instansi_form.php:35
2019-07-17 11:58:09 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: inaktif ~ APPPATH/classes/Controller/Dinas/Inaktif.php [ 21 ] in /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/Inaktif.php:21
2019-07-17 11:58:09 --- DEBUG: #0 /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/Inaktif.php(21): Kohana_Core::error_handler(8, 'Undefined varia...', '/home/arsipsema...', 21, Array)
#1 /home/arsipsemarangkot/public_html/system/classes/Kohana/Controller.php(84): Controller_Dinas_Inaktif->action_new()
#2 [internal function]: Kohana_Controller->execute()
#3 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Dinas_Inaktif))
#4 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#6 /home/arsipsemarangkot/public_html/index.php(109): Kohana_Request->execute()
#7 {main} in /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/Inaktif.php:21
2019-07-17 11:58:12 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: inaktif ~ APPPATH/classes/Controller/Dinas/Inaktif.php [ 21 ] in /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/Inaktif.php:21
2019-07-17 11:58:12 --- DEBUG: #0 /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/Inaktif.php(21): Kohana_Core::error_handler(8, 'Undefined varia...', '/home/arsipsema...', 21, Array)
#1 /home/arsipsemarangkot/public_html/system/classes/Kohana/Controller.php(84): Controller_Dinas_Inaktif->action_new()
#2 [internal function]: Kohana_Controller->execute()
#3 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Dinas_Inaktif))
#4 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#6 /home/arsipsemarangkot/public_html/index.php(109): Kohana_Request->execute()
#7 {main} in /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/Inaktif.php:21
2019-07-17 11:58:19 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: inaktif ~ APPPATH/classes/Controller/Dinas/Inaktif.php [ 21 ] in /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/Inaktif.php:21
2019-07-17 11:58:19 --- DEBUG: #0 /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/Inaktif.php(21): Kohana_Core::error_handler(8, 'Undefined varia...', '/home/arsipsema...', 21, Array)
#1 /home/arsipsemarangkot/public_html/system/classes/Kohana/Controller.php(84): Controller_Dinas_Inaktif->action_new()
#2 [internal function]: Kohana_Controller->execute()
#3 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Dinas_Inaktif))
#4 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#6 /home/arsipsemarangkot/public_html/index.php(109): Kohana_Request->execute()
#7 {main} in /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/Inaktif.php:21