<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2020-01-23 14:17:38 --- EMERGENCY: ErrorException [ 8 ]: Undefined index: file ~ APPPATH/classes/Controller/Dinas/Inaktif.php [ 88 ] in /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/Inaktif.php:88
2020-01-23 14:17:38 --- DEBUG: #0 /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/Inaktif.php(88): Kohana_Core::error_handler(8, 'Undefined index...', '/home/arsipsema...', 88, Array)
#1 /home/arsipsemarangkot/public_html/system/classes/Kohana/Controller.php(84): Controller_Dinas_Inaktif->action_save()
#2 [internal function]: Kohana_Controller->execute()
#3 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client/Internal.php(97): ReflectionMethod->invoke(Object(Controller_Dinas_Inaktif))
#4 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request/Client.php(114): Kohana_Request_Client_Internal->execute_request(Object(Request), Object(Response))
#5 /home/arsipsemarangkot/public_html/system/classes/Kohana/Request.php(997): Kohana_Request_Client->execute(Object(Request))
#6 /home/arsipsemarangkot/public_html/index.php(109): Kohana_Request->execute()
#7 {main} in /home/arsipsemarangkot/public_html/application/classes/Controller/Dinas/Inaktif.php:88