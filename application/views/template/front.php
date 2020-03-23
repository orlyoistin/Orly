<? 
defined('SYSPATH') or die('No direct script access.'); 
$setting = ORM::factory('Setting',1);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><? echo $setting->akronim." ".$setting->owner_short; ?></title>

    <link rel="stylesheet" href="<? echo URL::base()."assets/creative/css/"; ?>bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="<? echo URL::base()."assets/creative/css/"; ?>creative.css" type="text/css">
</head>

<body>
    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <div class="header-title">
                	<div class="text-center">
	                	<img src="<? echo URL::base()."assets/images/logo.png"; ?>">                    
                	</div>
					<? echo $setting->title."<br>".$setting->owner; ?>
                </div>
                <hr>
             	<? echo $content; ?>
            </div>
        </div>
    </header>
</body>
</html>
