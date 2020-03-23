<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2020-01-14 11:05:12 --- EMERGENCY: ErrorException [ 8 ]: Undefined variable: submit_value ~ APPPATH/views/dinas/instansi_form.php [ 35 ] in /home/arsipsemarangkot/public_html/application/views/dinas/instansi_form.php:35
2020-01-14 11:05:12 --- DEBUG: #0 /home/arsipsemarangkot/public_html/application/views/dinas/instansi_form.php(35): Kohana_Core::error_handler(8, 'Undefined varia...', '/home/arsipsema...', 35, Array)
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