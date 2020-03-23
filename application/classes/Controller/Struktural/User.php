<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Struktural_User extends Controller_Struktural_Backend {
	public $auth_required = array('login','struktural');
			
	public function action_index() {
		$user = ORM::factory('User')
			->where('skpd_id','=',Auth::instance()->get_user()->skpd_id);
			
		$arrFind = array('username','name','skpd_id','jabatan_id');
		$this->getSearch($user,$arrFind);

		$count = $user->reset(FALSE)->count_all();
		
		$config = Kohana::$config->load('configuration');
		$pagination = Pagination::factory(array(
			'total_items'    	=> $count,
			'items_per_page' 	=> $config->get('items_per_pages'),
			'auto_hide'			=> FALSE,
		));
		
		$results		= $user->limit($pagination->items_per_page)->offset($pagination->offset)->find_all();				
		$page_links 	= $pagination->render();
		$i				= $pagination->offset+1;
		$submit_value 	= "Cari";
		$jabatan_list 	= $this->getList('Jabatan','name','1');
		$page_links 	= $pagination->render('pagination/diggs');
		
		$this->template->content = View::factory('struktural/user')
			->bind('results', $results)
			->set('page_links', $pagination->render('pagination/diggs'))
			->bind('i', $i)
			->bind('url',$url)
			->bind('submit_value',$submit_value)
			->bind('num_rows',$count);
	}
	
	function action_reload() {
		$this->auto_render = false;
		
		$user = ORM::factory('User')
			->where('skpd_id','=',Auth::instance()->get_user()->skpd_id);
			
		$arrFind = array('username','name','skpd_id','jabatan_id');
		$this->getSearch($user,$arrFind);
				
		$count = $user->reset(FALSE)->count_all();
		
		$config = Kohana::$config->load('configuration');
		$pagination = Pagination::factory(array(
			'total_items'    	=> $count,
			'items_per_page' 	=> $config->get('items_per_pages'),
			'auto_hide'			=> FALSE,
		));
				
		$results 		= $user->limit($pagination->items_per_page)->offset($pagination->offset)->find_all();				
		$page_links 	= str_replace("reload","",$pagination->render('pagination/diggs'));
		$i				= $pagination->offset+1;
		$submit_value	= "Cari";
		
		$view = View::factory('struktural/user_reload')
			->bind('results', $results)
			->bind('page_links', $page_links)
			->bind('i', $i)
			->bind('url',$url)
			->bind('submit_value',$submit_value)
			->bind('num_rows',$count);
			
		echo $view;
		exit;
	}
	
	public function action_new() {
		$this->template->content = View::factory('struktural/user_form')
			->bind('errors',$error)
			->set('form',$this->getField('User'))										
			->set('url',URL::base().'dinas/user/create')
			->set('submit_value',"Tambah Data")
			->set('jabatan_list',$this->getList('Jabatan','name','',array(array('id','>',1))))
			->set('skpd_list',$this->getList('Skpd','name','',array(array('id','=',Auth::instance()->get_user()->skpd_id))))
			->set('sotk_list',$this->getList('Sotk','name','Pilih SOTK',array(array('skpd_id','=',Auth::instance()->get_user()->skpd_id))));
	}	
	
	public function action_edit() {
		$id = $this->request->param('id');		
		$user = ORM::factory('User',$id);
		
		$form = array();
		$fields = ORM::factory('User')->list_columns();
		foreach($fields as $field) {
			$column = $field['column_name'];
			$form[$field['column_name']] = $user->$column;
		}
		
		$config = Kohana::$config->load('configuration');
		$dir_user = $config->get('config_dir_user');
	
		$this->template->content = View::factory('struktural/user_form')
			->bind('errors',$errors)
			->set('form',$form)
			->set('url',URL::base().'dinas/user/update/'.$id)
			->set('submit_value',"Update Data")
			->set('id',$id)
			->set('jabatan_list',$this->getList('Jabatan','name','',array(array('id','>',1))))
			->set('skpd_list',$this->getList('Skpd','name','',array(array('id','=',Auth::instance()->get_user()->skpd_id))))
			->set('sotk_list',$this->getList('Sotk','name','Pilih SOTK',array(array('skpd_id','=',Auth::instance()->get_user()->skpd_id))))
			->set('dir',$dir_user)
			->set('separator',$this->getSeparator());
	}	

	public function action_create() {
		try {
			if($_FILES['image']['error'] == 0) {
				$config = Kohana::$config->load('configuration');
				$dir_user = $config->get('config_dir_user');		
				
				$filename = date("YmdHis").".jpg";
				$_POST['image'] = $filename;					
				
				$pic = Upload::save($_FILES['image'],$filename,$dir_user,0777);
				
				Image::factory($pic)
					->resize(120,'',Image::WIDTH)
					->save($dir_user.$this->getSeparator().$filename);	
			}				
			
			$user = ORM::factory('User')->create_user($_POST, array_keys($this->getField('User')));		
			
			$jabatan = ORM::factory('Jabatan',$_POST['jabatan_id']);
			$xrole = explode(",",$jabatan->role);	
			
			foreach($xrole as $role_user) {
				$user->add('roles', $role_user);
			}
			
			HTTP::redirect('dinas/user');
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');	
								
			$this->template->content = View::factory('struktural/user_form')
				->bind('errors', $errors)
				->bind('form', $_POST)
				->set('url',URL::base().'dinas/user/create')
				->set('submit_value',"Tambah Data")
				->set('jabatan_list',$this->getList('Jabatan','name','',array(array('id','>',1))))
				->set('skpd_list',$this->getList('Skpd','name','',array(array('id','=',Auth::instance()->get_user()->skpd_id))))
				->set('sotk_list',$this->getList('Sotk','name','Pilih SOTK',array(array('skpd_id','=',Auth::instance()->get_user()->skpd_id))));
		}
	}
	
	public function action_update() {
		$id = $this->request->param('id');
		$user = ORM::factory('User',$id);
		
		try {
			if(isset($_POST['delete'])) {
				$user->delete($id);
			}
			else {		
				if($_FILES['image']['error'] == 0) {
					$config = Kohana::$config->load('configuration');
					$dir_user = $config->get('config_dir_user');
					
					if(is_file($dir_user.$this->getSeparator().$user->image)) {
						unlink($dir_user.$this->getSeparator().$user->image);					
					}
					
					$config = Kohana::$config->load('configuration');
					$dir_user = $config->get('config_dir_user');		
					
					$filename = date("YmdHis").".jpg";
					$_POST['image'] = $filename;					
					
					$pic = Upload::save($_FILES['image'],$filename,$dir_user,0777);
					
					Image::factory($pic)
						->resize(120,'',Image::WIDTH)
						->save($dir_user.$this->getSeparator().$filename);	
				}				
					
				$user->update_user($_POST, array_keys($this->getField('User')));				
				
				$roles = ORM::factory('role')->find_all();
				foreach($roles as $role) {
					$user->remove('roles', ORM::factory('role')->where('id', '=', $role->id)->find());
				}
								
				$jabatan = ORM::factory('Jabatan',$_POST['jabatan_id']);
				$xrole = explode(",",$jabatan->role);	
				
				foreach($xrole as $role_user) {
					$user->add('roles', $role_user);
				}
			}
			
			HTTP::redirect('dinas/user');			
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');			
			$this->template->content = View::factory('struktural/user_form')
				->bind('errors', $errors)
				->bind('form', $_POST)
				->set('url',URL::base().'dinas/user/update/'.$id)
				->set('submit_value',"Update Data")
				->set('id',$id)
				->set('jabatan_list',$this->getList('Jabatan','name','',array(array('id','>',1))))
				->set('skpd_list',$this->getList('Skpd','name','',array(array('id','=',Auth::instance()->get_user()->skpd_id))))
				->set('sotk_list',$this->getList('Sotk','name','Pilih SOTK',array(array('skpd_id','=',Auth::instance()->get_user()->skpd_id))));
		}
	}	
	
	public function action_delete() {
		$this->auto_render = false;
		
		$id = $this->request->param('id');
		$user = ORM::factory('User',$id);		
		
		$config = Kohana::$config->load('configuration');
		$dir_user = $config->get('config_dir_user');		

		if(is_file($dir_user.$this->getSeparator().$user->image)) {
			unlink($dir_user.$this->getSeparator().$user->image);					
		}
		
		$user->image = "";
		$user->save();
		
		echo "success";		
	}
		
	public function action_password() {
		$this->auto_render = false;			
		$id = Auth::instance()->get_user()->id;
		
		$user = ORM::factory('User',$id);
		$form = array(
			'password'			=> '',
			'password_confirm' 	=> '',
			'id'				=> $id,
		);
	
		$view = View::factory('struktural/password_form')
			->bind('errors',$errors);
			
		$view->form 		= $form;
		$view->url 			= URL::base().'dinas/user/update_password';
		$view->submit_value = "Update Password";
		$view->title 		= "Change Password";			
		
		echo $view;
	}

	public function action_update_password() {
		$this->auto_render = false;
		
		$form = array(		
			'password' 			=> '',
		);	
		
		try {
			$id = Auth::instance()->get_user()->id;
			$user = ORM::factory('User',$id);
			$user->update_user($_POST, array_keys($form));
		
			echo "success";
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');	
			
			$user = ORM::factory('User',$id);
			$form = array(
				'password'			=> '',
				'password_confirm' 	=> '',
			);
		
			$view = View::factory('struktural/password_form')
				->bind('errors',$errors);
				
			$view->form 		= $form;
			$view->url 			= URL::base().'dinas/user/update_password';
			$view->submit_value = "Update Password";
			$view->title 		= "Change Password";			
			
			echo $view;	
		}
	}
	
	public function action_search() {
		$this->auto_render = false;

		echo View::factory('struktural/user_search')
			->set('url',URL::base().'dinas/user')										
			->set('submit_value','Cari Data');										
	}
	
	
	public function action_migrasi() {
		$this->auto_render = false;

		$users = ORM::factory('User')
			->where('id','>',1)
			->find_all();
		
		foreach($users as $user) {
			$_POST['id'] = $user->id;
			$_POST['username'] = $user->username;
			$_POST['password'] = $user->username."123";
			$_POST['password_confirm'] = $user->username."123";
			$_POST['kode'] = $user->kode;
			$_POST['email'] = $user->email;
			$_POST['skpd_id'] = $user->skpd_id;			
			$_POST['jabatan_id'] = 2;			
		
			$id = $user->id;
			$user = ORM::factory('User',$id);
			$user->update_user($_POST, array_keys($this->getField('User')));		
			
			$roles = ORM::factory('role')->find_all();
			foreach($roles as $role) {
				$user->remove('roles', ORM::factory('role')->where('id', '=', $role->id)->find());
			}
							
			$jabatan = ORM::factory('Jabatan',$user->jabatan_id);
			$xrole = explode(",",$jabatan->role);	
			
			foreach($xrole as $role_user) {
				$user->add('roles', $role_user);
			}
		}
	}
}
?>