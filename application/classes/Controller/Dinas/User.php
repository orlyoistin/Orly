<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Dinas_User extends Controller_Dinas_Backend {
	public $auth_required = array('login','dinas');
			
	public function action_index() {
		$this->template->content = View::factory('dinas/user');
	}
	
	public function action_new() {
		$this->template->content = View::factory('dinas/user_form')
			->bind('errors',$error)
			->set('form',$this->getField('User'))										
			->set('url',URL::base().'dinas/user/create')
			->set('submit_value',"Tambah Data")
			->set('jabatan_list',$this->getList('Jabatan','name','',array(array('id','IN',array(2,4,5)))))
			->set('tu_list',$this->getList('Tu','name','Pilih TU','',array(array('name','ASC'))))
			->set('masterbool_list',$this->getList('Masterbool','name'));
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
	
		$this->template->content = View::factory('dinas/user_form')
			->bind('errors',$errors)
			->set('form',$form)
			->set('url',URL::base().'dinas/user/update/'.$id)
			->set('submit_value',"Update Data")
			->set('id',$id)
			->set('jabatan_list',$this->getList('Jabatan','name','',array(array('id','IN',array(2,4,5)))))
			->set('dir',$dir_user)
			->set('separator',$this->getSeparator())
			->set('masterbool_list',$this->getList('Masterbool','name'));
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
								
			$this->template->content = View::factory('dinas/user_form')
				->bind('errors', $errors)
				->bind('form', $_POST)
				->set('url',URL::base().'dinas/user/create')
				->set('submit_value',"Tambah Data")
				->set('jabatan_list',$this->getList('Jabatan','name','',array(array('id','IN',array(2,4,5)))))
				->set('masterbool_list',$this->getList('Masterbool','name'));
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
			$this->template->content = View::factory('dinas/user_form')
				->bind('errors', $errors)
				->bind('form', $_POST)
				->set('url',URL::base().'dinas/user/update/'.$id)
				->set('submit_value',"Update Data")
				->set('id',$id)
				->set('jabatan_list',$this->getList('Jabatan','name','',array(array('id','IN',array(2,4,5)))))
				->set('masterbool_list',$this->getList('Masterbool','name'));
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
	
		$view = View::factory('dinas/password_form')
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
		
			$view = View::factory('dinas/password_form')
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

		echo View::factory('dinas/user_search')
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
	
	public function action_data() {
		$this->auto_render = false;		
		
		$users = ORM::factory('Viewuser')
			->where('skpd_id','=',Auth::instance()->get_user()->skpd_id)
			->where('jabatan_id','>',1);
							
		$total_data = $users->reset(FALSE)->count_all();

		$users = $users
			->where('keyword','LIKE','%'.$_REQUEST['search']['value'].'%');
		
		$total_filtered = $users->reset(FALSE)->count_all();
		
		$users = $users
			->offset($_REQUEST['start'])
			->limit($_REQUEST['length'])
			->order_by('username','ASC')
			->find_all();
			
		$arrData = array();
		$i = 1;
		foreach($users as $user) {
			$arrData[] = array(
				$i + $_REQUEST['start'],
				"<a id='".$user->id."' href='".URL::base()."dinas/user/edit/".$user->id."'>".$user->username."</a>",
				$user->name,
				$user->skpd_name."<br><i>".$user->sotk_name."</i>",
				$user->jabatan_name,
				$user->kode,
			);
			
			$i++;
		}
		
		$json_data = array(
			"draw"            => intval($_REQUEST['draw'] ),    
			"recordsTotal"    => intval($total_data),  
			"recordsFiltered" => intval($total_filtered), 
			"data"            => $arrData
		);
		
		echo json_encode($json_data);
	}
}
?>