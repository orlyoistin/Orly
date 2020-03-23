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
						$.fancybox.open(data);
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
						$.fancybox.open(data);
					}
				}
			});
			return false;
		});	
	});
	</script>
  </head>
  <body class="hold-transition skin-red sidebar-mini sidebar-collapse">
    <div class="wrapper">
      <header class="main-header">
        <a href="<? echo URL::base(); ?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><i class="fa fa-envelope-o fa-lg"></i></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><? echo $setting->akronim; ?></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
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
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-right">
                      <a href="<? echo URL::base()."register/logout"; ?>" class="btn btn-default btn-flat">Sign out</a>
                      <a data-fancybox data-type="ajax" data-src="<? echo URL::base()."dinas/user/password"; ?>" class="btn btn-default btn-flat">Change Password</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar !-->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less !-->
        <section class="sidebar">
         <!-- sidebar menu: : style can be found in sidebar.less !-->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li><a href="<? echo URL::base()."dinas"; ?>"><i class="fa fa-home"></i> <span>Home</span></a></li>
            <li><a href="<? echo URL::base()."dinas/masuk"; ?>"><i class="fa fa-inbox"></i> <span>Surat Masuk</span></a></li>
            <li><a href="<? echo URL::base()."dinas/keluar"; ?>"><i class="fa fa-send-o"></i> <span>Surat Keluar</span></a></li>            
            <li><a href="<? echo URL::base()."dinas/berkas"; ?>"><i class="fa fa-file-archive-o"></i> <span>Pemberkasan</span></a></li>
            <li><a href="<? echo URL::base()."dinas/instansi"; ?>"><i class="fa fa-archive"></i> <span>Arsip Inaktif</span></a></li>
            <li><a href="<? echo URL::base()."dinas/naskah"; ?>"><i class="fa fa-file-text-o"></i> <span>Naskah Dinas</span></a></li>
            
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-gears"></i> <span>Master</span> <i class="fa fa-angle-left pull-right"></i>
              </a>              
              <ul class="treeview-menu">              
                <li><a href="<? echo URL::base()."dinas/skpd"; ?>"><i class="fa fa-institution"></i> OPD</a></li>                
                <li><a href="<? echo URL::base()."dinas/user"; ?>"><i class="fa fa-user"></i> User</a></li>
              </ul>
            </li>  
          </ul>          
        </section>
        <!-- /.sidebar -->
      </aside>

      <div class="content-wrapper">
        <section class="content-header">
          <h1>
            Dashboard
            <small><? echo Auth::instance()->get_user()->jabatan->name; ?></small>
          </h1>
          <ol class="breadcrumb">
            <li><? echo date("d F Y"); ?></li>
          </ol>
        </section>

        <section class="content">
          <? echo $content; ?>          
        </section>
      </div>
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b><? echo $setting->akronim; ?></b>
        </div>
        <strong><? echo $setting->title." &copy; ".$setting->tahun; ?></strong>
      </footer>
    </div><!-- ./wrapper -->
  </body>
</html>
