<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2018-06-14 13:22:03 --- EMERGENCY: Session_Exception [ 1 ]: Error reading session data. ~ SYSPATH/classes/Kohana/Session.php [ 324 ] in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Session.php:125
2018-06-14 13:22:03 --- DEBUG: #0 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Session.php(125): Kohana_Session->read(NULL)
#1 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/database/classes/Kohana/Session/Database.php(74): Kohana_Session->__construct(Array, NULL)
#2 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Session.php(54): Kohana_Session_Database->__construct(Array, NULL)
#3 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/auth/classes/Kohana/Auth.php(58): Kohana_Session::instance('database')
#4 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/auth/classes/Kohana/Auth.php(37): Kohana_Auth->__construct(Object(Config_Group))
#5 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Controller/Home.php(6): Kohana_Auth::instance()
#6 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Controller.php(84): Controller_Home->action_index()
#7 [internal function]: Kohana_Controller->execute()
#8 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Home))
#9 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#10 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#11 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/index.php(109): Kohana_Request->execute()
#12 {main} in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Session.php:125
2018-06-14 13:29:10 --- EMERGENCY: ErrorException [ 1 ]: Class 'Controller_Backend' not found ~ APPPATH/classes/Controller/Home.php [ 4 ] in file:line
2018-06-14 13:29:10 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2018-06-14 13:29:11 --- EMERGENCY: ErrorException [ 1 ]: Class 'Controller_Backend' not found ~ APPPATH/classes/Controller/Home.php [ 4 ] in file:line
2018-06-14 13:29:11 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2018-06-14 13:33:18 --- EMERGENCY: ErrorException [ 8 ]: Trying to get property of non-object ~ APPPATH/views/template/backend.php [ 138 ] in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/views/template/backend.php:138
2018-06-14 13:33:18 --- DEBUG: #0 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/views/template/backend.php(138): Kohana_Core::error_handler(8, 'Trying to get p...', '/Volumes/MacDat...', 138, Array)
#1 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/View.php(62): include('/Volumes/MacDat...')
#2 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/View.php(359): Kohana_View::capture('/Volumes/MacDat...', Array)
#3 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Controller/Template.php(44): Kohana_View->render()
#4 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Controller/Layout.php(39): Kohana_Controller_Template->after()
#5 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Controller.php(87): Controller_Layout->after()
#6 [internal function]: Kohana_Controller->execute()
#7 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Home))
#8 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#9 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#10 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/index.php(109): Kohana_Request->execute()
#11 {main} in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/views/template/backend.php:138
2018-06-14 13:33:20 --- EMERGENCY: ErrorException [ 8 ]: Trying to get property of non-object ~ APPPATH/views/template/backend.php [ 138 ] in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/views/template/backend.php:138
2018-06-14 13:33:20 --- DEBUG: #0 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/views/template/backend.php(138): Kohana_Core::error_handler(8, 'Trying to get p...', '/Volumes/MacDat...', 138, Array)
#1 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/View.php(62): include('/Volumes/MacDat...')
#2 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/View.php(359): Kohana_View::capture('/Volumes/MacDat...', Array)
#3 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Controller/Template.php(44): Kohana_View->render()
#4 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Controller/Layout.php(39): Kohana_Controller_Template->after()
#5 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Controller.php(87): Controller_Layout->after()
#6 [internal function]: Kohana_Controller->execute()
#7 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Home))
#8 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#9 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#10 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/index.php(109): Kohana_Request->execute()
#11 {main} in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/views/template/backend.php:138
2018-06-14 13:34:14 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: url ~ APPPATH/views/login.php [ 3 ] in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/views/login.php:3
2018-06-14 13:34:14 --- DEBUG: #0 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/views/login.php(3): Kohana_Core::error_handler(8, 'Undefined varia...', '/Volumes/MacDat...', 3, Array)
#1 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/View.php(62): include('/Volumes/MacDat...')
#2 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/View.php(359): Kohana_View::capture('/Volumes/MacDat...', Array)
#3 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/View.php(236): Kohana_View->render()
#4 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/views/template/front.php(31): Kohana_View->__toString()
#5 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/View.php(62): include('/Volumes/MacDat...')
#6 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/View.php(359): Kohana_View::capture('/Volumes/MacDat...', Array)
#7 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Controller/Template.php(44): Kohana_View->render()
#8 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Controller/Layout.php(39): Kohana_Controller_Template->after()
#9 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Controller.php(87): Controller_Layout->after()
#10 [internal function]: Kohana_Controller->execute()
#11 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Home))
#12 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#13 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#14 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/index.php(109): Kohana_Request->execute()
#15 {main} in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/views/login.php:3
2018-06-14 13:54:54 --- EMERGENCY: ErrorException [ 1 ]: Class 'Captcha' not found ~ APPPATH/views/login.php [ 24 ] in file:line
2018-06-14 13:54:54 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2018-06-14 13:56:17 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Kohana::config() ~ MODPATH/captcha/classes/Captcha.php [ 462 ] in file:line
2018-06-14 13:56:17 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2018-06-14 13:56:18 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Kohana::config() ~ MODPATH/captcha/classes/Captcha.php [ 462 ] in file:line
2018-06-14 13:56:18 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2018-06-14 14:02:29 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Kohana::config() ~ MODPATH/captcha/classes/Captcha.php [ 462 ] in file:line
2018-06-14 14:02:29 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2018-06-14 14:02:30 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Kohana::config() ~ MODPATH/captcha/classes/Captcha.php [ 462 ] in file:line
2018-06-14 14:02:30 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2018-06-14 14:05:02 --- EMERGENCY: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'captcha' at 'MODPATH/captcha' ~ SYSPATH/classes/Kohana/Core.php [ 579 ] in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/bootstrap.php:134
2018-06-14 14:05:02 --- DEBUG: #0 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/bootstrap.php(134): Kohana_Core::modules(Array)
#1 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/index.php(102): require('/Volumes/MacDat...')
#2 {main} in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/bootstrap.php:134
2018-06-14 14:05:03 --- EMERGENCY: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'captcha' at 'MODPATH/captcha' ~ SYSPATH/classes/Kohana/Core.php [ 579 ] in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/bootstrap.php:134
2018-06-14 14:05:03 --- DEBUG: #0 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/bootstrap.php(134): Kohana_Core::modules(Array)
#1 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/index.php(102): require('/Volumes/MacDat...')
#2 {main} in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/bootstrap.php:134
2018-06-14 14:05:08 --- EMERGENCY: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'captcha' at 'MODPATH/captcha' ~ SYSPATH/classes/Kohana/Core.php [ 579 ] in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/bootstrap.php:134
2018-06-14 14:05:08 --- DEBUG: #0 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/bootstrap.php(134): Kohana_Core::modules(Array)
#1 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/index.php(102): require('/Volumes/MacDat...')
#2 {main} in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/bootstrap.php:134
2018-06-14 14:05:31 --- EMERGENCY: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'pagination' at 'MODPATH/pagination' ~ SYSPATH/classes/Kohana/Core.php [ 579 ] in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/bootstrap.php:134
2018-06-14 14:05:31 --- DEBUG: #0 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/bootstrap.php(134): Kohana_Core::modules(Array)
#1 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/index.php(102): require('/Volumes/MacDat...')
#2 {main} in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/bootstrap.php:134
2018-06-14 14:05:32 --- EMERGENCY: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'pagination' at 'MODPATH/pagination' ~ SYSPATH/classes/Kohana/Core.php [ 579 ] in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/bootstrap.php:134
2018-06-14 14:05:32 --- DEBUG: #0 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/bootstrap.php(134): Kohana_Core::modules(Array)
#1 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/index.php(102): require('/Volumes/MacDat...')
#2 {main} in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/bootstrap.php:134
2018-06-14 14:05:46 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Kohana::config() ~ MODPATH/captcha/classes/Captcha.php [ 462 ] in file:line
2018-06-14 14:05:46 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2018-06-14 14:05:47 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Kohana::config() ~ MODPATH/captcha/classes/Captcha.php [ 462 ] in file:line
2018-06-14 14:05:47 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2018-06-14 14:12:04 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Kohana::config() ~ MODPATH/captcha/classes/Captcha.php [ 462 ] in file:line
2018-06-14 14:12:04 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2018-06-14 14:12:05 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Kohana::config() ~ MODPATH/captcha/classes/Captcha.php [ 462 ] in file:line
2018-06-14 14:12:05 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2018-06-14 14:15:42 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Kohana::config() ~ MODPATH/captcha/classes/Captcha.php [ 462 ] in file:line
2018-06-14 14:15:42 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2018-06-14 14:15:44 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Kohana::config() ~ MODPATH/captcha/classes/Captcha.php [ 462 ] in file:line
2018-06-14 14:15:44 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2018-06-14 14:15:44 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Kohana::config() ~ MODPATH/captcha/classes/Captcha.php [ 462 ] in file:line
2018-06-14 14:15:44 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2018-06-14 14:15:45 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Kohana::config() ~ MODPATH/captcha/classes/Captcha.php [ 462 ] in file:line
2018-06-14 14:15:45 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2018-06-14 14:15:45 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Kohana::config() ~ MODPATH/captcha/classes/Captcha.php [ 462 ] in file:line
2018-06-14 14:15:45 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2018-06-14 14:15:46 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Kohana::config() ~ MODPATH/captcha/classes/Captcha.php [ 462 ] in file:line
2018-06-14 14:15:46 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2018-06-14 14:15:46 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Kohana::config() ~ MODPATH/captcha/classes/Captcha.php [ 462 ] in file:line
2018-06-14 14:15:46 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2018-06-14 14:15:46 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Kohana::config() ~ MODPATH/captcha/classes/Captcha.php [ 462 ] in file:line
2018-06-14 14:15:46 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2018-06-14 14:16:34 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Request::instance() ~ MODPATH/captcha/classes/Captcha.php [ 480 ] in file:line
2018-06-14 14:16:34 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2018-06-14 14:16:36 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Request::instance() ~ MODPATH/captcha/classes/Captcha.php [ 480 ] in file:line
2018-06-14 14:16:36 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2018-06-14 14:17:09 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Request::instance() ~ MODPATH/captcha/classes/Captcha.php [ 480 ] in file:line
2018-06-14 14:17:09 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2018-06-14 14:17:27 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Request::instance() ~ MODPATH/captcha/classes/Captcha.php [ 480 ] in file:line
2018-06-14 14:17:27 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2018-06-14 14:17:28 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Request::instance() ~ MODPATH/captcha/classes/Captcha.php [ 480 ] in file:line
2018-06-14 14:17:28 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2018-06-14 14:17:33 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Request::instance() ~ MODPATH/captcha/classes/Captcha.php [ 480 ] in file:line
2018-06-14 14:17:33 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2018-06-14 14:22:23 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Request::instance() ~ MODPATH/captcha/classes/Captcha.php [ 480 ] in file:line
2018-06-14 14:22:23 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2018-06-14 14:22:24 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Request::instance() ~ MODPATH/captcha/classes/Captcha.php [ 480 ] in file:line
2018-06-14 14:22:24 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2018-06-14 14:22:26 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Request::instance() ~ MODPATH/captcha/classes/Captcha.php [ 480 ] in file:line
2018-06-14 14:22:26 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2018-06-14 14:22:28 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Request::instance() ~ MODPATH/captcha/classes/Captcha.php [ 480 ] in file:line
2018-06-14 14:22:28 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2018-06-14 14:24:44 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Request::instance() ~ MODPATH/captcha/classes/Captcha.php [ 479 ] in file:line
2018-06-14 14:24:44 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2018-06-14 14:24:45 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Request::instance() ~ MODPATH/captcha/classes/Captcha.php [ 479 ] in file:line
2018-06-14 14:24:45 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2018-06-14 14:25:17 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Request::instance() ~ MODPATH/captcha/classes/Captcha.php [ 479 ] in file:line
2018-06-14 14:25:17 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2018-06-14 14:25:18 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Request::instance() ~ MODPATH/captcha/classes/Captcha.php [ 479 ] in file:line
2018-06-14 14:25:18 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2018-06-14 14:25:40 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Request::instance() ~ MODPATH/captcha/classes/Captcha.php [ 479 ] in file:line
2018-06-14 14:25:40 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2018-06-14 14:26:22 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Request::response() ~ MODPATH/captcha/classes/Captcha.php [ 437 ] in file:line
2018-06-14 14:26:22 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2018-06-14 14:42:34 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Captcha_Basic::response() ~ MODPATH/captcha/classes/Captcha.php [ 442 ] in file:line
2018-06-14 14:42:34 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2018-06-14 14:42:36 --- EMERGENCY: ErrorException [ 1 ]: Call to undefined method Captcha_Basic::response() ~ MODPATH/captcha/classes/Captcha.php [ 442 ] in file:line
2018-06-14 14:42:36 --- DEBUG: #0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main} in file:line
2018-06-14 15:16:38 --- EMERGENCY: Session_Exception [ 1 ]: Error reading session data. ~ SYSPATH/classes/Kohana/Session.php [ 324 ] in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Session.php:125
2018-06-14 15:16:38 --- DEBUG: #0 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Session.php(125): Kohana_Session->read(NULL)
#1 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Session.php(54): Kohana_Session->__construct(NULL, NULL)
#2 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/captcha/classes/Captcha.php(162): Kohana_Session::instance()
#3 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/captcha/classes/Controller/Captcha.php(42): Captcha->update_response_session()
#4 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Controller.php(87): Controller_Captcha->after()
#5 [internal function]: Kohana_Controller->execute()
#6 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Captcha))
#7 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#8 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#9 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/index.php(109): Kohana_Request->execute()
#10 {main} in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Session.php:125
2018-06-14 15:16:41 --- EMERGENCY: Session_Exception [ 1 ]: Error reading session data. ~ SYSPATH/classes/Kohana/Session.php [ 324 ] in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Session.php:125
2018-06-14 15:16:41 --- DEBUG: #0 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Session.php(125): Kohana_Session->read(NULL)
#1 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Session.php(54): Kohana_Session->__construct(NULL, NULL)
#2 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/captcha/classes/Captcha.php(162): Kohana_Session::instance()
#3 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/captcha/classes/Controller/Captcha.php(42): Captcha->update_response_session()
#4 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Controller.php(87): Controller_Captcha->after()
#5 [internal function]: Kohana_Controller->execute()
#6 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Captcha))
#7 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#8 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#9 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/index.php(109): Kohana_Request->execute()
#10 {main} in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Session.php:125
2018-06-14 15:16:41 --- EMERGENCY: Session_Exception [ 1 ]: Error reading session data. ~ SYSPATH/classes/Kohana/Session.php [ 324 ] in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Session.php:125
2018-06-14 15:16:41 --- DEBUG: #0 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Session.php(125): Kohana_Session->read(NULL)
#1 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Session.php(54): Kohana_Session->__construct(NULL, NULL)
#2 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/captcha/classes/Captcha.php(162): Kohana_Session::instance()
#3 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/captcha/classes/Controller/Captcha.php(42): Captcha->update_response_session()
#4 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Controller.php(87): Controller_Captcha->after()
#5 [internal function]: Kohana_Controller->execute()
#6 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Captcha))
#7 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#8 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#9 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/index.php(109): Kohana_Request->execute()
#10 {main} in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Session.php:125
2018-06-14 15:16:42 --- EMERGENCY: Session_Exception [ 1 ]: Error reading session data. ~ SYSPATH/classes/Kohana/Session.php [ 324 ] in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Session.php:125
2018-06-14 15:16:42 --- DEBUG: #0 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Session.php(125): Kohana_Session->read(NULL)
#1 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Session.php(54): Kohana_Session->__construct(NULL, NULL)
#2 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/captcha/classes/Captcha.php(162): Kohana_Session::instance()
#3 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/captcha/classes/Controller/Captcha.php(42): Captcha->update_response_session()
#4 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Controller.php(87): Controller_Captcha->after()
#5 [internal function]: Kohana_Controller->execute()
#6 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Captcha))
#7 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#8 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#9 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/index.php(109): Kohana_Request->execute()
#10 {main} in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Session.php:125
2018-06-14 15:16:46 --- EMERGENCY: Session_Exception [ 1 ]: Error reading session data. ~ SYSPATH/classes/Kohana/Session.php [ 324 ] in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Session.php:125
2018-06-14 15:16:46 --- DEBUG: #0 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Session.php(125): Kohana_Session->read(NULL)
#1 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Session.php(54): Kohana_Session->__construct(NULL, NULL)
#2 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/auth/classes/Kohana/Auth.php(58): Kohana_Session::instance('native')
#3 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/modules/auth/classes/Kohana/Auth.php(37): Kohana_Auth->__construct(Object(Config_Group))
#4 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/application/classes/Controller/Register.php(16): Kohana_Auth::instance()
#5 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Controller.php(84): Controller_Register->action_login()
#6 [internal function]: Kohana_Controller->execute()
#7 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Register))
#8 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#9 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#10 /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/index.php(109): Kohana_Request->execute()
#11 {main} in /Volumes/MacData/Projects/www/arsip_dinamis_master_v3/system/classes/Kohana/Session.php:125