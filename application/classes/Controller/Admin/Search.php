<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Admin_Search extends Controller_Admin_Backend {
	public $auth_required = array('login','search');
	
	private $form = array(
		'seri_id'		=> '',
		'kode' 			=> '',
		'name' 			=> '',
		'delete'		=> '',
		'id'			=> '',
	);

	function action_klasifikasi(){
		$this->auto_render = false;
			
		$arrSession = array('kode','name');
		
		if(isset($_GET['s'])) {
			if($_GET['s']) {
				foreach($arrSession as $var) {
					Session::instance()->delete($var);
				}
			}
		}
		
		$s_kode = Session::instance()->get('kode', NULL);
		$s_name = Session::instance()->get('name', NULL);
		
		if(isset($_POST)) {
			if(isset($_POST['reset'])) {
				foreach($arrSession as $var) {
					Session::instance()->delete($var);
				}
			}
			else {
				foreach($_POST as $key=>$var) {
					Session::instance()->set($key, $var);
				}
			}
		}
					
		$klasifikasi = ORM::factory('Klasifikasi');
		foreach($arrSession as $var) {
			if(Session::instance()->get($var, NULL)=="") {
				Session::instance()->delete($var);
			}
			else {
				$klasifikasi->where($var,"LIKE","%".Session::instance()->get($var, NULL)."%");
			}
		}
						
		$view = View::factory('admin/klasifikasi_search')
			->bind('results', $results)
			->bind('page_links', $page_links)
			->bind('no', $no)
			->bind('url',$url)
			->bind('submit_value',$submit_value)
			->bind('num_rows',$count)
			->bind('kode',$kode)
			->bind('name',$name)
			->bind('page',$page)
			->bind('page_list',$page_list);
			
		$count = $klasifikasi->reset(FALSE)->count_all();
		
		$config = Kohana::$config->load('configuration');
		$pagination = Pagination::factory(array(
			'total_items'    	=> $count,
			'items_per_page' 	=> $config->get('items_per_pages_search'),
			'auto_hide'			=> FALSE,
		));
		
		$offset 	= 0;
		$page		= 1;
		$page_list	= array();
		$n_page		= ceil($count/$config->get('items_per_pages_search'));
		
		for($i=1;$i<=$n_page;$i++) {
			$page_list[$i] = $i;
		}
		
		if($_POST) {
			if(isset($_POST['page'])) {
				if(isset($_POST['reset'])) {
					$page = 1;
				}
				else {
					if($s_kode != $_POST['kode'] || $s_name != $_POST['name']) {
						$_POST['page'] = 1;
					}
					$offset = (($_POST['page']*$pagination->items_per_page) - $pagination->items_per_page) + 0;
					$page 	= $_POST['page'];
				}
			}
		}
		
		$results = $klasifikasi->order_by('kode','ASC')->limit($pagination->items_per_page)->offset($offset)->find_all();
		
		$kode 			= Session::instance()->get('kode', NULL);
		$name 			= Session::instance()->get('name', NULL);
		$page_links 	= "";
		$no				= $offset + 1;
		$url 			= URL::base().'search/klasifikasi';
		$submit_value 	= "   Cari   ";
				
		echo $view;
	}

	function action_user(){
		$this->auto_render = false;
			
		$arrSession = array('kode','name');
		
		if(isset($_GET['s'])) {
			if($_GET['s']) {
				foreach($arrSession as $var) {
					Session::instance()->delete($var);
				}
			}
		}
		
		$s_kode = Session::instance()->get('kode', NULL);
		$s_name = Session::instance()->get('name', NULL);
		
		if(isset($_POST)) {
			if(isset($_POST['reset'])) {
				foreach($arrSession as $var) {
					Session::instance()->delete($var);
				}
			}
			else {
				foreach($_POST as $key=>$var) {
					Session::instance()->set($key, $var);
				}
			}
		}
					
		$user = ORM::factory('User')->where('skpd_id','=',Auth::instance()->get_user()->skpd->id);
		foreach($arrSession as $var) {
			if(Session::instance()->get($var, NULL)=="") {
				Session::instance()->delete($var);
			}
			else {
				$user->where($var,"LIKE","%".Session::instance()->get($var, NULL)."%");
			}
		}
						
		$view = View::factory('user_search')
			->bind('results', $results)
			->bind('page_links', $page_links)
			->bind('no', $no)
			->bind('url',$url)
			->bind('submit_value',$submit_value)
			->bind('num_rows',$count)
			->bind('kode',$kode)
			->bind('name',$name)
			->bind('page',$page)
			->bind('page_list',$page_list);
			
		$count = $user->reset(FALSE)->count_all();
		
		$config = Kohana::$config->load('configuration');
		$pagination = Pagination::factory(array(
			'total_items'    	=> $count,
			'items_per_page' 	=> $config->get('items_per_pages_search'),
			'auto_hide'			=> FALSE,
		));
		
		$offset 	= 0;
		$page		= 1;
		$page_list	= array();
		$n_page		= ceil($count/$config->get('items_per_pages_search'));
		
		for($i=1;$i<=$n_page;$i++) {
			$page_list[$i] = $i;
		}
		
		if($_POST) {
			if($_POST['page']) {
				if(isset($_POST['reset'])) {
					$page = 1;
				}
				else {
					if($s_kode != $_POST['kode'] || $s_name != $_POST['name']) {
						$_POST['page'] = 1;
					}
					$offset = (($_POST['page']*$pagination->items_per_page) - $pagination->items_per_page) + 0;
					$page 	= $_POST['page'];
				}
			}
		}
		
		$results = $user->order_by('kode','ASC')->limit($pagination->items_per_page)->offset($offset)->find_all();
		
		$kode 			= Session::instance()->get('kode', NULL);
		$name 			= Session::instance()->get('name', NULL);
		$page_links 	= "";
		$no				= $offset + 1;
		$url 			= URL::base().'search/user';
		$submit_value 	= "   Cari   ";
				
		echo $view;
	}	
	
	function action_instansi(){
		$this->auto_render = false;
			
		$arrSession = array('kode','name');
		
		if(isset($_GET['s'])) {
			if($_GET['s']) {
				foreach($arrSession as $var) {
					Session::instance()->delete($var);
				}
			}
		}
		
		$s_kode = Session::instance()->get('kode', NULL);
		$s_name = Session::instance()->get('name', NULL);
		
		if(isset($_POST)) {
			if(isset($_POST['reset'])) {
				foreach($arrSession as $var) {
					Session::instance()->delete($var);
				}
			}
			else {
				foreach($_POST as $key=>$var) {
					Session::instance()->set($key, $var);
				}
			}
		}
					
		$instansi = ORM::factory('Instansi')->where('skpd_id','=',Auth::instance()->get_user()->skpd->id);
		foreach($arrSession as $var) {
			if(Session::instance()->get($var, NULL)=="") {
				Session::instance()->delete($var);
			}
			else {
				$instansi->where($var,"LIKE","%".Session::instance()->get($var, NULL)."%");
			}
		}
						
		$view = View::factory('instansi_search')
			->bind('results', $results)
			->bind('page_links', $page_links)
			->bind('no', $no)
			->bind('url',$url)
			->bind('submit_value',$submit_value)
			->bind('num_rows',$count)
			->bind('kode',$kode)
			->bind('name',$name)
			->bind('page',$page)
			->bind('page_list',$page_list);
			
		$count = $instansi->reset(FALSE)->count_all();
		
		$config = Kohana::$config->load('configuration');
		$pagination = Pagination::factory(array(
			'total_items'    	=> $count,
			'items_per_page' 	=> $config->get('items_per_pages_search'),
			'auto_hide'			=> FALSE,
		));
		
		$offset 	= 0;
		$page		= 1;
		$page_list	= array();
		$n_page		= ceil($count/$config->get('items_per_pages_search'));
		
		for($i=1;$i<=$n_page;$i++) {
			$page_list[$i] = $i;
		}
		
		if($_POST) {
			if($_POST['page']) {
				if(isset($_POST['reset'])) {
					$page = 1;
				}
				else {
					if($s_kode != $_POST['kode'] || $s_name != $_POST['name']) {
						$_POST['page'] = 1;
					}
					$offset = (($_POST['page']*$pagination->items_per_page) - $pagination->items_per_page) + 0;
					$page 	= $_POST['page'];
				}
			}
		}
		
		$results = $instansi->order_by('kode','ASC')->limit($pagination->items_per_page)->offset($offset)->find_all();
		
		$kode 			= Session::instance()->get('kode', NULL);
		$name 			= Session::instance()->get('name', NULL);
		$page_links 	= "";
		$no				= $offset + 1;
		$url 			= URL::base().'search/instansi';
		$submit_value 	= "   Cari   ";
				
		echo $view;
	}
	
	function action_skpd(){
		$this->auto_render = false;
			
		$arrSession = array('kode','name');
		
		if(isset($_GET['s'])) {
			if($_GET['s']) {
				foreach($arrSession as $var) {
					Session::instance()->delete($var);
				}
			}
		}
		
		$s_kode = Session::instance()->get('kode', NULL);
		$s_name = Session::instance()->get('name', NULL);
		
		if(isset($_POST)) {
			if(isset($_POST['reset'])) {
				foreach($arrSession as $var) {
					Session::instance()->delete($var);
				}
			}
			else {
				foreach($_POST as $key=>$var) {
					Session::instance()->set($key, $var);
				}
			}
		}
					
		$skpd = ORM::factory('Skpd');
		foreach($arrSession as $var) {
			if(Session::instance()->get($var, NULL)=="") {
				Session::instance()->delete($var);
			}
			else {
				$skpd->where($var,"LIKE","%".Session::instance()->get($var, NULL)."%");
			}
		}
						
		$view = View::factory('admin/skpd_search')
			->bind('results', $results)
			->bind('page_links', $page_links)
			->bind('no', $no)
			->bind('url',$url)
			->bind('submit_value',$submit_value)
			->bind('num_rows',$count)
			->bind('kode',$kode)
			->bind('name',$name)
			->bind('page',$page)
			->bind('page_list',$page_list);
			
		$count = $skpd->reset(FALSE)->count_all();
		
		$config = Kohana::$config->load('configuration');
		$pagination = Pagination::factory(array(
			'total_items'    	=> $count,
			'items_per_page' 	=> $config->get('items_per_pages_search'),
			'auto_hide'			=> FALSE,
		));
		
		$offset 	= 0;
		$page		= 1;
		$page_list	= array();
		$n_page		= ceil($count/$config->get('items_per_pages_search'));
		
		for($i=1;$i<=$n_page;$i++) {
			$page_list[$i] = $i;
		}
		
		if($_POST) {
			if($_POST['page']) {
				if(isset($_POST['reset'])) {
					$page = 1;
				}
				else {
					if($s_kode != $_POST['kode'] || $s_name != $_POST['name']) {
						$_POST['page'] = 1;
					}
					$offset = (($_POST['page']*$pagination->items_per_page) - $pagination->items_per_page) + 0;
					$page 	= $_POST['page'];
				}
			}
		}
		
		$results = $skpd->order_by('kode','ASC')->limit($pagination->items_per_page)->offset($offset)->find_all();
		
		$kode 			= Session::instance()->get('kode', NULL);
		$name 			= Session::instance()->get('name', NULL);
		$page_links 	= "";
		$no				= $offset + 1;
		$url 			= URL::base().'search/skpd';
		$submit_value 	= "   Cari   ";
				
		echo $view;
	}
		
	function action_origin(){
		$this->auto_render = false;
			
		$arrSession = array('kode','name');
		
		if(isset($_GET['s'])) {
			if($_GET['s']) {
				foreach($arrSession as $var) {
					Session::instance()->delete($var);
				}
			}
		}
		
		$s_kode = Session::instance()->get('kode', NULL);
		$s_name = Session::instance()->get('name', NULL);
		
		if(isset($_POST)) {
			if(isset($_POST['reset'])) {
				foreach($arrSession as $var) {
					Session::instance()->delete($var);
				}
			}
			else {
				foreach($_POST as $key=>$var) {
					Session::instance()->set($key, $var);
				}
			}
		}
					
		$skpd = ORM::factory('Skpd');
		foreach($arrSession as $var) {
			if(Session::instance()->get($var, NULL)=="") {
				Session::instance()->delete($var);
			}
			else {
				$skpd->where($var,"LIKE","%".Session::instance()->get($var, NULL)."%");
			}
		}
						
		$view = View::factory('origin_search')
			->bind('results', $results)
			->bind('page_links', $page_links)
			->bind('no', $no)
			->bind('url',$url)
			->bind('submit_value',$submit_value)
			->bind('num_rows',$count)
			->bind('kode',$kode)
			->bind('name',$name)
			->bind('page',$page)
			->bind('page_list',$page_list);
			
		$count = $skpd->reset(FALSE)->count_all();
		
		$config = Kohana::$config->load('configuration');
		$pagination = Pagination::factory(array(
			'total_items'    	=> $count,
			'items_per_page' 	=> $config->get('items_per_pages_search'),
			'auto_hide'			=> FALSE,
		));
		
		$offset 	= 0;
		$page		= 1;
		$page_list	= array();
		$n_page		= ceil($count/$config->get('items_per_pages_search'));
		
		for($i=1;$i<=$n_page;$i++) {
			$page_list[$i] = $i;
		}
		
		if($_POST) {
			if($_POST['page']) {
				if(isset($_POST['reset'])) {
					$page = 1;
				}
				else {
					if($s_kode != $_POST['kode'] || $s_name != $_POST['name']) {
						$_POST['page'] = 1;
					}
					$offset = (($_POST['page']*$pagination->items_per_page) - $pagination->items_per_page) + 0;
					$page 	= $_POST['page'];
				}
			}
		}
		
		$results = $skpd->order_by('kode','ASC')->limit($pagination->items_per_page)->offset($offset)->find_all();
		
		$kode 			= Session::instance()->get('kode', NULL);
		$name 			= Session::instance()->get('name', NULL);
		$page_links 	= "";
		$no				= $offset + 1;
		$url 			= URL::base().'search/origin';
		$submit_value 	= "   Cari   ";
				
		echo $view;
	}
}
?>