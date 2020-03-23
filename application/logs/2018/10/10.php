<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2018-10-10 02:20:30 --- EMERGENCY: Database_Exception [ 1053 ]: Server shutdown in progress [ SELECT `sotk`.`id` AS `id`, `sotk`.`A_00` AS `A_00`, `sotk`.`A_01` AS `A_01`, `sotk`.`A_02` AS `A_02`, `sotk`.`A_03` AS `A_03`, `sotk`.`A_04` AS `A_04`, `sotk`.`A_05` AS `A_05`, `sotk`.`KOLOK` AS `KOLOK`, `sotk`.`NALOK` AS `NALOK`, `sotk`.`NALOKP` AS `NALOKP`, `sotk`.`NAJAB` AS `NAJAB`, `sotk`.`NAJABP` AS `NAJABP`, `sotk`.`ESEL` AS `ESEL`, `sotk`.`AKTIF` AS `AKTIF`, `sotk`.`ALAMAT` AS `ALAMAT`, `sotk`.`kode` AS `kode`, `sotk`.`skpd_id` AS `skpd_id`, `sotk`.`nip` AS `nip`, `sotk`.`eselon` AS `eselon`, `sotk`.`pejabat` AS `pejabat`, `sotk`.`level` AS `level`, `sotk`.`parent_id` AS `parent_id`, `sotk`.`masterbool_id` AS `masterbool_id`, `sotk`.`tipe` AS `tipe` FROM `sotks` AS `sotk` WHERE `sotk`.`skpd_id` = '2' ] ~ MODPATH/database/classes/Kohana/Database/MySQL.php [ 194 ] in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/database/classes/Kohana/Database/Query.php:251
2018-10-10 02:20:30 --- DEBUG: #0 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/database/classes/Kohana/Database/Query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `sotk`.`...', 'Model_Sotk', Array)
#1 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/orm/classes/Kohana/ORM.php(1063): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/orm/classes/Kohana/ORM.php(1004): Kohana_ORM->_load_result(true)
#3 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Controller/Admin/Update.php(11): Kohana_ORM->find_all()
#4 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Controller.php(84): Controller_Admin_Update->action_parent()
#5 [internal function]: Kohana_Controller->execute()
#6 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Update))
#7 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#8 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#9 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/index.php(109): Kohana_Request->execute()
#10 {main} in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/database/classes/Kohana/Database/Query.php:251
2018-10-10 02:20:30 --- EMERGENCY: Database_Exception [ 1053 ]: Server shutdown in progress [ UPDATE `sotks` SET `parent_id` = '775' WHERE `skpd_id` = '26' AND `level` = 5 ] ~ MODPATH/database/classes/Kohana/Database/MySQL.php [ 194 ] in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/database/classes/Kohana/Database/Query.php:251
2018-10-10 02:20:30 --- DEBUG: #0 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/database/classes/Kohana/Database/Query.php(251): Kohana_Database_MySQL->query(3, 'UPDATE `sotks` ...', false, Array)
#1 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Controller/Admin/Update.php(22): Kohana_Database_Query->execute()
#2 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Controller.php(84): Controller_Admin_Update->action_parent()
#3 [internal function]: Kohana_Controller->execute()
#4 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Update))
#5 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#7 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/index.php(109): Kohana_Request->execute()
#8 {main} in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/database/classes/Kohana/Database/Query.php:251
2018-10-10 02:20:30 --- EMERGENCY: Database_Exception [ 1053 ]: Server shutdown in progress [ UPDATE `sotks` SET `parent_id` = '513' WHERE `skpd_id` = '14' AND `level` = 5 ] ~ MODPATH/database/classes/Kohana/Database/MySQL.php [ 194 ] in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/database/classes/Kohana/Database/Query.php:251
2018-10-10 02:20:30 --- DEBUG: #0 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/database/classes/Kohana/Database/Query.php(251): Kohana_Database_MySQL->query(3, 'UPDATE `sotks` ...', false, Array)
#1 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Controller/Admin/Update.php(22): Kohana_Database_Query->execute()
#2 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Controller.php(84): Controller_Admin_Update->action_parent()
#3 [internal function]: Kohana_Controller->execute()
#4 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Update))
#5 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#7 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/index.php(109): Kohana_Request->execute()
#8 {main} in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/database/classes/Kohana/Database/Query.php:251
2018-10-10 02:20:30 --- EMERGENCY: Database_Exception [ 1053 ]: Server shutdown in progress [ UPDATE `sotks` SET `parent_id` = '1010' WHERE `skpd_id` = '8' AND `level` = 2 ] ~ MODPATH/database/classes/Kohana/Database/MySQL.php [ 194 ] in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/database/classes/Kohana/Database/Query.php:251
2018-10-10 02:20:30 --- DEBUG: #0 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/database/classes/Kohana/Database/Query.php(251): Kohana_Database_MySQL->query(3, 'UPDATE `sotks` ...', false, Array)
#1 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Controller/Admin/Update.php(22): Kohana_Database_Query->execute()
#2 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Controller.php(84): Controller_Admin_Update->action_parent()
#3 [internal function]: Kohana_Controller->execute()
#4 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Update))
#5 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#7 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/index.php(109): Kohana_Request->execute()
#8 {main} in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/database/classes/Kohana/Database/Query.php:251
2018-10-10 02:20:30 --- ERROR: ErrorException [ 2 ]: Error while sending QUERY packet. PID=4656 ~ MODPATH/database/classes/Kohana/Database/MySQL.php [ 186 ] in file:line
2018-10-10 02:20:30 --- ERROR: ErrorException [ 2 ]: Error while sending QUERY packet. PID=5075 ~ MODPATH/database/classes/Kohana/Database/MySQL.php [ 186 ] in file:line
2018-10-10 02:20:30 --- ERROR: ErrorException [ 2 ]: Error while sending QUERY packet. PID=4653 ~ MODPATH/database/classes/Kohana/Database/MySQL.php [ 186 ] in file:line
2018-10-10 02:20:30 --- ERROR: ErrorException [ 2 ]: Error while sending QUERY packet. PID=4654 ~ MODPATH/database/classes/Kohana/Database/MySQL.php [ 186 ] in file:line
2018-10-10 03:43:22 --- EMERGENCY: Kohana_Exception [ 0 ]: The name property does not exist in the Model_Sotk class ~ MODPATH/orm/classes/Kohana/ORM.php [ 687 ] in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/orm/classes/Kohana/ORM.php:603
2018-10-10 03:43:22 --- DEBUG: #0 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/orm/classes/Kohana/ORM.php(603): Kohana_ORM->get('name')
#1 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Controller/Dinas/Sotk.php(165): Kohana_ORM->__get('name')
#2 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Controller.php(84): Controller_Dinas_Sotk->action_data()
#3 [internal function]: Kohana_Controller->execute()
#4 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Dinas_Sotk))
#5 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#7 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/index.php(109): Kohana_Request->execute()
#8 {main} in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/orm/classes/Kohana/ORM.php:603
2018-10-10 03:43:37 --- EMERGENCY: Kohana_Exception [ 0 ]: The name property does not exist in the Model_Sotk class ~ MODPATH/orm/classes/Kohana/ORM.php [ 687 ] in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/orm/classes/Kohana/ORM.php:603
2018-10-10 03:43:37 --- DEBUG: #0 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/orm/classes/Kohana/ORM.php(603): Kohana_ORM->get('name')
#1 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Controller/Dinas/Sotk.php(165): Kohana_ORM->__get('name')
#2 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Controller.php(84): Controller_Dinas_Sotk->action_data()
#3 [internal function]: Kohana_Controller->execute()
#4 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Dinas_Sotk))
#5 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#7 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/index.php(109): Kohana_Request->execute()
#8 {main} in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/orm/classes/Kohana/ORM.php:603
2018-10-10 09:05:19 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: table ~ APPPATH/classes/Controller/Struktural/Disposisi.php [ 114 ] in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Controller/Struktural/Disposisi.php:114
2018-10-10 09:05:19 --- DEBUG: #0 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Controller/Struktural/Disposisi.php(114): Kohana_Core::error_handler(8, 'Undefined varia...', '/Volumes/MacDat...', 114, Array)
#1 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Controller.php(84): Controller_Struktural_Disposisi->action_save()
#2 [internal function]: Kohana_Controller->execute()
#3 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Struktural_Disposisi))
#4 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#6 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/index.php(109): Kohana_Request->execute()
#7 {main} in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Controller/Struktural/Disposisi.php:114
2018-10-10 09:05:28 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: table ~ APPPATH/classes/Controller/Struktural/Disposisi.php [ 114 ] in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Controller/Struktural/Disposisi.php:114
2018-10-10 09:05:28 --- DEBUG: #0 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Controller/Struktural/Disposisi.php(114): Kohana_Core::error_handler(8, 'Undefined varia...', '/Volumes/MacDat...', 114, Array)
#1 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Controller.php(84): Controller_Struktural_Disposisi->action_save()
#2 [internal function]: Kohana_Controller->execute()
#3 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Struktural_Disposisi))
#4 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#6 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/index.php(109): Kohana_Request->execute()
#7 {main} in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Controller/Struktural/Disposisi.php:114