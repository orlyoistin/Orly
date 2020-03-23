<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2018-10-09 15:46:21 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: viewkasuses ~ APPPATH/classes/Controller/Dinas/Masuk.php [ 336 ] in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Controller/Dinas/Masuk.php:336
2018-10-09 15:46:21 --- DEBUG: #0 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Controller/Dinas/Masuk.php(336): Kohana_Core::error_handler(8, 'Undefined varia...', '/Volumes/MacDat...', 336, Array)
#1 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Controller.php(84): Controller_Dinas_Masuk->action_data()
#2 [internal function]: Kohana_Controller->execute()
#3 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Dinas_Masuk))
#4 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#6 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/index.php(109): Kohana_Request->execute()
#7 {main} in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Controller/Dinas/Masuk.php:336
2018-10-09 15:48:12 --- EMERGENCY: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ILIKE '%122%'' at line 1 [ SELECT COUNT(`viewmasuk`.`id`) AS `records_found` FROM `viewmasuks` AS `viewmasuk` WHERE `skpd_id` = '33' AND `nomor` ILIKE '%122%' ] ~ MODPATH/database/classes/Kohana/Database/MySQL.php [ 194 ] in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/database/classes/Kohana/Database/Query.php:251
2018-10-09 15:48:12 --- DEBUG: #0 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/database/classes/Kohana/Database/Query.php(251): Kohana_Database_MySQL->query(1, 'SELECT COUNT(`v...', false, Array)
#1 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/orm/classes/Kohana/ORM.php(1648): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Controller/Dinas/Masuk.php(345): Kohana_ORM->count_all()
#3 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Controller.php(84): Controller_Dinas_Masuk->action_data()
#4 [internal function]: Kohana_Controller->execute()
#5 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Dinas_Masuk))
#6 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#8 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/index.php(109): Kohana_Request->execute()
#9 {main} in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/database/classes/Kohana/Database/Query.php:251
2018-10-09 15:48:28 --- EMERGENCY: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ILIKE '%122%'' at line 1 [ SELECT COUNT(`viewmasuk`.`id`) AS `records_found` FROM `viewmasuks` AS `viewmasuk` WHERE `skpd_id` = '33' AND `nomor` ILIKE '%122%' ] ~ MODPATH/database/classes/Kohana/Database/MySQL.php [ 194 ] in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/database/classes/Kohana/Database/Query.php:251
2018-10-09 15:48:28 --- DEBUG: #0 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/database/classes/Kohana/Database/Query.php(251): Kohana_Database_MySQL->query(1, 'SELECT COUNT(`v...', false, Array)
#1 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/orm/classes/Kohana/ORM.php(1648): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Controller/Dinas/Masuk.php(345): Kohana_ORM->count_all()
#3 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Controller.php(84): Controller_Dinas_Masuk->action_data()
#4 [internal function]: Kohana_Controller->execute()
#5 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Dinas_Masuk))
#6 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#8 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/index.php(109): Kohana_Request->execute()
#9 {main} in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/database/classes/Kohana/Database/Query.php:251