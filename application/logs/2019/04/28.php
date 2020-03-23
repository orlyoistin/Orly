<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2019-04-28 10:38:02 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: mastersurat_list ~ APPPATH/views/admin/naskah_form.php [ 96 ] in /home/arsipsemarangkot/public_html/application/views/admin/naskah_form.php:96
2019-04-28 10:38:02 --- DEBUG: #0 /home/arsipsemarangkot/public_html/application/views/admin/naskah_form.php(96): Kohana_Core::error_handler(8, 'Undefined varia...', '/home/arsipsema...', 96, Array)
#1 /home/arsipsemarangkot/public_html/system/classes/Kohana/View.php(62): include('/home/arsipsema...')
#2 /home/arsipsemarangkot/public_html/system/classes/Kohana/View.php(359): Kohana_View::capture('/home/arsipsema...', Array)
#3 /home/arsipsemarangkot/public_html/system/classes/Kohana/View.php(236): Kohana_View->render()
#4 /home/arsipsemarangkot/public_html/application/views/template/backend.php(233): Kohana_View->__toString()
#5 /home/arsipsemarangkot/public_html/system/classes/Kohana/View.php(62): include('/home/arsipsema...')
#6 /home/arsipsemarangkot/public_html/system/classes/Kohana/View.php(359): Kohana_View::capture('/home/arsipsema...', Array)
#7 /home/arsipsemarangkot/public_html/system/classes/Kohana/Controller/Template.php(44): Kohana_View->render()
#8 /home/arsipsemarangkot/public_html/application/classes/Controller/Admin/Backend.php(39): Kohana_Controller_Template->after()
#9 /home/arsipsemarangkot/public_html/system/classes/Kohana/Controller.php(87): Controller_Admin_Backend->after()
#10 [internal function]: Kohana_Controller->execute()
#11 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Naskah))
#12 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#13 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#14 /home/arsipsemarangkot/public_html/index.php(109): Kohana_Request->execute()
#15 {main} in /home/arsipsemarangkot/public_html/application/views/admin/naskah_form.php:96
2019-04-28 10:38:06 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: mastersurat_list ~ APPPATH/views/admin/naskah_form.php [ 96 ] in /home/arsipsemarangkot/public_html/application/views/admin/naskah_form.php:96
2019-04-28 10:38:06 --- DEBUG: #0 /home/arsipsemarangkot/public_html/application/views/admin/naskah_form.php(96): Kohana_Core::error_handler(8, 'Undefined varia...', '/home/arsipsema...', 96, Array)
#1 /home/arsipsemarangkot/public_html/system/classes/Kohana/View.php(62): include('/home/arsipsema...')
#2 /home/arsipsemarangkot/public_html/system/classes/Kohana/View.php(359): Kohana_View::capture('/home/arsipsema...', Array)
#3 /home/arsipsemarangkot/public_html/system/classes/Kohana/View.php(236): Kohana_View->render()
#4 /home/arsipsemarangkot/public_html/application/views/template/backend.php(233): Kohana_View->__toString()
#5 /home/arsipsemarangkot/public_html/system/classes/Kohana/View.php(62): include('/home/arsipsema...')
#6 /home/arsipsemarangkot/public_html/system/classes/Kohana/View.php(359): Kohana_View::capture('/home/arsipsema...', Array)
#7 /home/arsipsemarangkot/public_html/system/classes/Kohana/Controller/Template.php(44): Kohana_View->render()
#8 /home/arsipsemarangkot/public_html/application/classes/Controller/Admin/Backend.php(39): Kohana_Controller_Template->after()
#9 /home/arsipsemarangkot/public_html/system/classes/Kohana/Controller.php(87): Controller_Admin_Backend->after()
#10 [internal function]: Kohana_Controller->execute()
#11 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Naskah))
#12 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#13 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#14 /home/arsipsemarangkot/public_html/index.php(109): Kohana_Request->execute()
#15 {main} in /home/arsipsemarangkot/public_html/application/views/admin/naskah_form.php:96
2019-04-28 17:04:33 --- EMERGENCY: ErrorException [ 8 ]: Undefined index: skpd_id ~ APPPATH/classes/Controller/Admin/Skpd.php [ 89 ] in /home/arsipsemarangkot/public_html/application/classes/Controller/Admin/Skpd.php:89
2019-04-28 17:04:33 --- DEBUG: #0 /home/arsipsemarangkot/public_html/application/classes/Controller/Admin/Skpd.php(89): Kohana_Core::error_handler(8, 'Undefined index...', '/home/arsipsema...', 89, Array)
#1 /home/arsipsemarangkot/public_html/system/classes/Kohana/Controller.php(84): Controller_Admin_Skpd->action_update()
#2 [internal function]: Kohana_Controller->execute()
#3 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Skpd))
#4 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#6 /home/arsipsemarangkot/public_html/index.php(109): Kohana_Request->execute()
#7 {main} in /home/arsipsemarangkot/public_html/application/classes/Controller/Admin/Skpd.php:89
2019-04-28 17:06:24 --- EMERGENCY: ErrorException [ 8 ]: Undefined index: skpd_id ~ APPPATH/classes/Controller/Admin/Skpd.php [ 89 ] in /home/arsipsemarangkot/public_html/application/classes/Controller/Admin/Skpd.php:89
2019-04-28 17:06:24 --- DEBUG: #0 /home/arsipsemarangkot/public_html/application/classes/Controller/Admin/Skpd.php(89): Kohana_Core::error_handler(8, 'Undefined index...', '/home/arsipsema...', 89, Array)
#1 /home/arsipsemarangkot/public_html/system/classes/Kohana/Controller.php(84): Controller_Admin_Skpd->action_update()
#2 [internal function]: Kohana_Controller->execute()
#3 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Skpd))
#4 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#6 /home/arsipsemarangkot/public_html/index.php(109): Kohana_Request->execute()
#7 {main} in /home/arsipsemarangkot/public_html/application/classes/Controller/Admin/Skpd.php:89
2019-04-28 17:07:10 --- EMERGENCY: ErrorException [ 8 ]: Undefined index: skpd_id ~ APPPATH/classes/Controller/Admin/Skpd.php [ 89 ] in /home/arsipsemarangkot/public_html/application/classes/Controller/Admin/Skpd.php:89
2019-04-28 17:07:10 --- DEBUG: #0 /home/arsipsemarangkot/public_html/application/classes/Controller/Admin/Skpd.php(89): Kohana_Core::error_handler(8, 'Undefined index...', '/home/arsipsema...', 89, Array)
#1 /home/arsipsemarangkot/public_html/system/classes/Kohana/Controller.php(84): Controller_Admin_Skpd->action_update()
#2 [internal function]: Kohana_Controller->execute()
#3 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Skpd))
#4 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#6 /home/arsipsemarangkot/public_html/index.php(109): Kohana_Request->execute()
#7 {main} in /home/arsipsemarangkot/public_html/application/classes/Controller/Admin/Skpd.php:89
2019-04-28 17:07:15 --- EMERGENCY: ErrorException [ 8 ]: Undefined index: skpd_id ~ APPPATH/classes/Controller/Admin/Skpd.php [ 89 ] in /home/arsipsemarangkot/public_html/application/classes/Controller/Admin/Skpd.php:89
2019-04-28 17:07:15 --- DEBUG: #0 /home/arsipsemarangkot/public_html/application/classes/Controller/Admin/Skpd.php(89): Kohana_Core::error_handler(8, 'Undefined index...', '/home/arsipsema...', 89, Array)
#1 /home/arsipsemarangkot/public_html/system/classes/Kohana/Controller.php(84): Controller_Admin_Skpd->action_update()
#2 [internal function]: Kohana_Controller->execute()
#3 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Admin_Skpd))
#4 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#6 /home/arsipsemarangkot/public_html/index.php(109): Kohana_Request->execute()
#7 {main} in /home/arsipsemarangkot/public_html/application/classes/Controller/Admin/Skpd.php:89