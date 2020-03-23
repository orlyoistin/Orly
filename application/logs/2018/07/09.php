<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2018-07-09 05:49:56 --- EMERGENCY: Kohana_Exception [ 0 ]: The dari property does not exist in the Model_Naskah class ~ MODPATH/orm/classes/Kohana/ORM.php [ 687 ] in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/orm/classes/Kohana/ORM.php:603
2018-07-09 05:49:56 --- DEBUG: #0 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/orm/classes/Kohana/ORM.php(603): Kohana_ORM->get('dari')
#1 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Controller/Dinas/Naskah.php(63): Kohana_ORM->__get('dari')
#2 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Controller.php(84): Controller_Dinas_Naskah->action_edit()
#3 [internal function]: Kohana_Controller->execute()
#4 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Dinas_Naskah))
#5 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#7 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/index.php(109): Kohana_Request->execute()
#8 {main} in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/orm/classes/Kohana/ORM.php:603
2018-07-09 21:05:05 --- EMERGENCY: Kohana_Exception [ 0 ]: Cannot create masuk model because it is already loaded. ~ MODPATH/orm/classes/Kohana/ORM.php [ 1297 ] in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Model/Masuk.php:78
2018-07-09 21:05:05 --- DEBUG: #0 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Model/Masuk.php(78): Kohana_ORM->create()
#1 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Controller/Dinas/Masuk.php(105): Model_Masuk->create_masuk(Array, Array)
#2 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Controller.php(84): Controller_Dinas_Masuk->action_save()
#3 [internal function]: Kohana_Controller->execute()
#4 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Dinas_Masuk))
#5 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#7 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/index.php(109): Kohana_Request->execute()
#8 {main} in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Model/Masuk.php:78
2018-07-09 21:05:45 --- EMERGENCY: Kohana_Exception [ 0 ]: Cannot create masuk model because it is already loaded. ~ MODPATH/orm/classes/Kohana/ORM.php [ 1297 ] in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Model/Masuk.php:78
2018-07-09 21:05:45 --- DEBUG: #0 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Model/Masuk.php(78): Kohana_ORM->create()
#1 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Controller/Dinas/Masuk.php(105): Model_Masuk->create_masuk(Array, Array)
#2 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Controller.php(84): Controller_Dinas_Masuk->action_save()
#3 [internal function]: Kohana_Controller->execute()
#4 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Dinas_Masuk))
#5 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#7 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/index.php(109): Kohana_Request->execute()
#8 {main} in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Model/Masuk.php:78
2018-07-09 21:05:49 --- EMERGENCY: Kohana_Exception [ 0 ]: Cannot create masuk model because it is already loaded. ~ MODPATH/orm/classes/Kohana/ORM.php [ 1297 ] in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Model/Masuk.php:78
2018-07-09 21:05:49 --- DEBUG: #0 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Model/Masuk.php(78): Kohana_ORM->create()
#1 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Controller/Dinas/Masuk.php(105): Model_Masuk->create_masuk(Array, Array)
#2 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Controller.php(84): Controller_Dinas_Masuk->action_save()
#3 [internal function]: Kohana_Controller->execute()
#4 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Dinas_Masuk))
#5 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#7 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/index.php(109): Kohana_Request->execute()
#8 {main} in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Model/Masuk.php:78
2018-07-09 21:06:33 --- EMERGENCY: Kohana_Exception [ 0 ]: Cannot create masuk model because it is already loaded. ~ MODPATH/orm/classes/Kohana/ORM.php [ 1297 ] in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Model/Masuk.php:78
2018-07-09 21:06:33 --- DEBUG: #0 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Model/Masuk.php(78): Kohana_ORM->create()
#1 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Controller/Dinas/Masuk.php(105): Model_Masuk->create_masuk(Array, Array)
#2 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Controller.php(84): Controller_Dinas_Masuk->action_save()
#3 [internal function]: Kohana_Controller->execute()
#4 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Dinas_Masuk))
#5 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#6 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#7 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/index.php(109): Kohana_Request->execute()
#8 {main} in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Model/Masuk.php:78