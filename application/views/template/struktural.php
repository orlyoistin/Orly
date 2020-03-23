<? defined('SYSPATH') or die('No direct script access.'); 

$setting = ORM::factory('Setting')->find();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><? echo $setting->akronim; ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<? echo URL::base(); ?>assets/AdminLTE-2.4.5/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<? echo URL::base(); ?>assets/AdminLTE-2.4.5/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<? echo URL::base(); ?>assets/AdminLTE-2.4.5/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<? echo URL::base(); ?>assets/AdminLTE-2.4.5/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<? echo URL::base(); ?>assets/AdminLTE-2.4.5/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<? echo URL::base(); ?>assets/AdminLTE-2.4.5/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="<? echo URL::base(); ?>assets/js/fancybox-master/dist/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="<? echo URL::base(); ?>assets/js/select2-4.0.1/dist/css/select2.css" type="text/css" />
    <link rel="stylesheet" href="<? echo URL::base(); ?>assets/js/jquery-ui-1.12.1/jquery-ui.min.css" type="text/css" />
    <link rel="stylesheet" href="<? echo URL::base(); ?>assets/AdminLTE-2.4.5/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="<? echo URL::base(); ?>assets/css/admin.css">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
	<script src="<? echo URL::base(); ?>assets/AdminLTE-2.4.5/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<? echo URL::base(); ?>assets/js/jquery-ui-1.12.1/jquery-ui.min.js"></script>

    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="<? echo URL::base(); ?>assets/AdminLTE-2.4.5/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<? echo URL::base(); ?>assets/AdminLTE-2.4.5/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script src="<? echo URL::base(); ?>assets/AdminLTE-2.4.5/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<? echo URL::base(); ?>assets/AdminLTE-2.4.5/bower_components/fastclick/lib/fastclick.js"></script>
    <script src="<? echo URL::base(); ?>assets/AdminLTE-2.4.5/dist/js/adminlte.min.js"></script>
    <script src="<? echo URL::base(); ?>assets/js/fancybox-master/dist/jquery.fancybox.min.js"></script>
    <script src="<? echo URL::base(); ?>assets/js/select2-4.0.1/dist/js/select2.min.js"></script>
    <script src="<? echo URL::base(); ?>assets/js/ckeditor/ckeditor.js"></script>
    <script src="<? echo URL::base(); ?>assets/js/jquery.jcombo.min.js"></script>
    <script src="<? echo URL::base(); ?>assets/AdminLTE-2.4.5/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="<? echo URL::base(); ?>assets/AdminLTE-2.4.5/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
       
    <script type="text/javascript">
	$(document).ready(function() {
		$('.conbtn').fancybox();
		
		$("a.upload_form").each(function(){
			var $a = $(this);
			$a.fancybox({
				type: 'iframe',
				afterClose:function () {
					var targetdata = $(".upload_form").attr('targetdata');
					$('#reload').load(targetdata);
				}
			});
		});
	
		$('body').on('submit', '.savedata', function (e) {
			e.preventDefault();
			var alamat = this.action;
			var table_id = $(this).attr('table_id');
			
			$.ajax({
				type	: "POST",
				cache	: false,
				url		: alamat,
				data	: $(this).serializeArray(),
				success: function(data) {
					if(data=="success") {
						$.fancybox.close();
						table.ajax.reload(null,false);
					}
					else {
						$.fancybox(data);
					}
				}
			});
			return false;
		});
		
		$('body').on('submit', '.saveload', function (e) {
			e.preventDefault();
			var alamat = this.action;
			var targetdata = $(this).attr('targetdata');
			
			$.ajax({
				type	: "POST",
				cache	: false,
				url		: alamat,
				data	: $(this).serializeArray(),
				success: function(data) {
					if(data=="success") {
						$('#reload').load('<? echo URL::base(); ?>' + targetdata);
						$.fancybox.close();
					}
					else {
						$.fancybox(data);
					}
				}
			});
			return false;
		});
		
		$('body').on('submit', '.save', function (e) {
			e.preventDefault();
			var alamat = this.action;
			var targetdata = $(this).attr('targetdata');
			$.ajax({
				type	: "POST",
				cache	: false,
				url		: alamat,
				data	: $(this).serializeArray(),
				success: function(data) {
					if(data=="success") {
						$.fancybox.close();
					}
					else {
						$.fancybox(data);
					}
				}
			});
			return false;
		});	
	});
	
	var audioElement = document.createElement('audio');
    audioElement.setAttribute('src', '<? echo URL::base()."assets/sound/alert.mp3"; ?>');
    audioElement.addEventListener('ended', function() {
        this.play();
    }, false);
	
	function ring(){
		$.ajax({
			type	: "POST",
			cache	: false,
			url		: '<? echo URL::base()."struktural/note/ring"; ?>',
			data	: $(this).serializeArray(),
			success: function(data) {
				if(data>0) {
					$('#note').html('<i class="fa fa-envelope-o faa-shake animated"></i>&nbsp;&nbsp;&nbsp;<span class="label label-primary">' + data + ' belum diproses</span>');
					audioElement.play();
				}
				else {
					$('#note').html('<i class="fa fa-envelope-o"></i>');
					audioElement.pause();
				}
			}
		});	
	}
	
	ring();
	setInterval(function(){
		this.ring();
	}, 10000);
	</script>
  </head>
  <!--body class="hold-transition skin-red sidebar-mini sidebar-collapse"!-->
  <body class="hold-transition skin-red sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <a href="<? echo URL::base(); ?>" class="logo">
          <span class="logo-mini"><i class="fa fa-envelope-o fa-lg"></i></span>
          <span class="logo-lg"><? echo $setting->akronim; ?></span>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown messages-menu">
                <a href="<? echo URL::base().'struktural/note/index/1'; ?>">
                  <div id="note"></div>
                </a>
              </li> 
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <?
				  if(Auth::instance()->get_user()->image != "") {
					  echo "<img src='".URL::base().'assets/user/'.Auth::instance()->get_user()->image."' class='user-image' alt='User Image'>";
				  }
				  else {
					  echo "<img src='".URL::base()."assets/images/no_photo.jpg' class='user-image' alt='User Image'>";
				  }
				  ?>
                  <span class="hidden-xs"><? echo strtoupper(Auth::instance()->get_user()->name); ?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="user-header">
                    <?
					if(Auth::instance()->get_user()->image != "") {
					  echo "<img src='".URL::base().'assets/user/'.Auth::instance()->get_user()->image."' class='img-thumbnail' alt='User Image'>";
					}
					else {
					  echo "<img src='".URL::base()."assets/images/no_photo.jpg' class='img-thumbnail' alt='User Image'>";
					}
					?> 
                    <p>
                      <? echo Auth::instance()->get_user()->name; ?>
                      <small><? echo Auth::instance()->get_user()->jabatan->name; ?></small>
                    </p>
                  </li>
                  <li class="user-footer">
                    <div class="pull-right">
                      <a href="<? echo URL::base()."register/logout"; ?>" class="btn btn-default btn-flat">Sign out</a>
                      <a data-fancybox data-type="ajax" data-src="<? echo URL::base()."struktural/user/password"; ?>" class="btn btn-default btn-flat">Change Password</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <aside class="main-sidebar">
        <section class="sidebar">
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li><a href="<? echo URL::base()."struktural"; ?>"><i class="fa fa-home"></i> <span>Home</span></a></li>
            <li><a href="<? echo URL::base()."struktural/note/index/1"; ?>"><i class="fa fa-clock-o"></i> <span>Belum Diproses</span></a></li>
            <li><a href="<? echo URL::base()."struktural/note/index/2"; ?>"><i class="fa fa-check-square-o"></i> <span>Sudah Diproses</span></a></li>
            <li><a href="<? echo URL::base()."struktural/naskah"; ?>"><i class="fa fa-file-text-o"></i> <span>Ajuan Surat</span></a></li>  
          </ul>          
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small><? echo Auth::instance()->get_user()->jabatan->name; ?></small>
          </h1>
          <ol class="breadcrumb">
            <li><? //echo date("d F Y"); ?></li>
          </ol>
        </section>     

        <!-- Main content -->
        <section class="content">
          <? echo $content; ?>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b><? echo $setting->akronim; ?></b>
        </div>
        <strong><? echo $setting->title." &copy; ".$setting->tahun; ?></strong>
      </footer>
    </div><!-- ./wrapper -->
  </body>
</html>
