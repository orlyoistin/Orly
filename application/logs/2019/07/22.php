<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2019-07-22 11:55:45 --- EMERGENCY: Database_Exception [ 1054 ]: Unknown column 'keyword' in 'where clause' [ SELECT COUNT(`viewpemberkasan`.`id`) AS `records_found` FROM `viewpemberkasans` AS `viewpemberkasan` WHERE `skpd_id` = '67' AND `keyword` LIKE '%ASG%' ] ~ MODPATH/database/classes/Kohana/Database/MySQL.php [ 194 ] in /home/arsipsemarangkot/public_html/modules/database/classes/Kohana/Database/Query.php:251
2019-07-22 11:55:45 --- DEBUG: #0 /home/arsipsemarangkot/public_html/modules/database/classes/Kohana/Database/Query.php(251): Kohana_Database_MySQL->query(1, 'SELECT COUNT(`v...', false, Array)
#1 /home/arsipsemarangkot/public_html/modules/orm/classes/Kohana/ORM.php(1648): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/Berkas.php(84): Kohana_ORM->count_all()
#3 /home/arsipsemarangkot/public_html/system/classes/Kohana/Controller.php(84): Controller_Dinas_Berkas->action_data()
#4 [internal function]: Kohana_Controller->execute()
#5 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Dinas_Berkas))
#6 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#8 /home/arsipsemarangkot/public_html/index.php(109): Kohana_Request->execute()
#9 {main} in /home/arsipsemarangkot/public_html/modules/database/classes/Kohana/Database/Query.php:251
2019-07-22 11:57:20 --- EMERGENCY: Database_Exception [ 1054 ]: Unknown column 'keyword' in 'where clause' [ SELECT COUNT(`viewpemberkasan`.`id`) AS `records_found` FROM `viewpemberkasans` AS `viewpemberkasan` WHERE `skpd_id` = '67' AND `tanggal_surat` >= '2019-07-19' AND `keyword` LIKE '%ASG%' ] ~ MODPATH/database/classes/Kohana/Database/MySQL.php [ 194 ] in /home/arsipsemarangkot/public_html/modules/database/classes/Kohana/Database/Query.php:251
2019-07-22 11:57:20 --- DEBUG: #0 /home/arsipsemarangkot/public_html/modules/database/classes/Kohana/Database/Query.php(251): Kohana_Database_MySQL->query(1, 'SELECT COUNT(`v...', false, Array)
#1 /home/arsipsemarangkot/public_html/modules/orm/classes/Kohana/ORM.php(1648): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/Berkas.php(84): Kohana_ORM->count_all()
#3 /home/arsipsemarangkot/public_html/system/classes/Kohana/Controller.php(84): Controller_Dinas_Berkas->action_data()
#4 [internal function]: Kohana_Controller->execute()
#5 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Dinas_Berkas))
#6 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#7 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#8 /home/arsipsemarangkot/public_html/index.php(109): Kohana_Request->execute()
#9 {main} in /home/arsipsemarangkot/public_html/modules/database/classes/Kohana/Database/Query.php:251