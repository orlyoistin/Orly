<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Klasifikasi extends Controller_Admin_Backend {
	public $auth_required = array('login','root');
			
	public function action_index() {
		$klasifikasi = ORM::factory('Klasifikasi');
		$arrFind = array('kode','name','keterangan_id');
		$this->getSearch($klasifikasi,$arrFind);

		$count = $klasifikasi->reset(FALSE)->count_all();
		
		$config = Kohana::$config->load('configuration');
		$pagination = Pagination::factory(array(
			'total_items'    	=> $count,
			'items_per_page' 	=> $config->get('items_per_pages'),
			'auto_hide'			=> FALSE,
		));
		
		$results = $klasifikasi
			->limit($pagination->items_per_page)
			->offset($pagination->offset)
			->order_by('kode','ASC')
			->find_all();				
		
		$this->template->content = View::factory('admin/klasifikasi')
			->bind('results', $results)
			->set('page_links', $pagination->render('pagination/diggs'))
			->set('i', $pagination->offset+1)
			->bind('num_rows',$count)
			->set('url',URL::base().'admin/klasifikasi');
	}
	
	function action_reload() {
		$this->auto_render = false;		
		
		$klasifikasi = ORM::factory('Klasifikasi');
		$arrFind = array('kode','name','keterangan_id');
		$this->getSearch($klasifikasi,$arrFind);
		
		$count = $klasifikasi->reset(FALSE)->count_all();
		
		$config = Kohana::$config->load('configuration');
		$pagination = Pagination::factory(array(
			'total_items'    	=> $count,
			'items_per_page' 	=> $config->get('items_per_pages'),
			'auto_hide'			=> FALSE,
		));
				
		$results = $klasifikasi
			->limit($pagination->items_per_page)
			->offset($pagination->offset)
			->order_by('kode','ASC')
			->find_all();
							
		echo View::factory('admin/klasifikasi_reload')
			->bind('results', $results)
			->set('page_links', $pagination->render('pagination/diggs'))
			->set('i', $pagination->offset+1)
			->bind('num_rows',$count)
			->set('url',URL::base().'admin/klasifikasi');
	}
	
	public function action_new() {
		$this->auto_render = false;
		
		echo View::factory('admin/klasifikasi_form')
			->bind('errors',$error)
			->set('form',$this->getField('Klasifikasi'))										
			->set('url',URL::base().'admin/klasifikasi/create')
			->set('submit_value',"Tambah Data")
			->set('keterangan_list',$this->getList('Keterangan','name'));
	}
	
	
	public function action_edit() {
		$this->auto_render = false;
		$id = $this->request->param('id');
		
		$klasifikasi = ORM::factory('Klasifikasi',$id);
		
		$form = array();
		$fields = ORM::factory('Klasifikasi')->list_columns();
		foreach($fields as $field) {
			$column = $field['column_name'];
			$form[$field['column_name']] = $klasifikasi->$column;
		}
	
		echo View::factory('admin/klasifikasi_form')
			->bind('errors',$errors)
			->set('form',$form)
			->set('url',URL::base().'admin/klasifikasi/update/'.$id)
			->set('submit_value',"Update Data")
			->set('id',$id)
			->set('keterangan_list',$this->getList('Keterangan','name'));
	}	

	public function action_create() {
		$this->auto_render = false;
		try {
			$klasifikasi = ORM::factory('Klasifikasi')->create_klasifikasi($_POST, array_keys($this->getField('Klasifikasi')));		
			
			echo "success";
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');	
								
			echo View::factory('admin/klasifikasi_form')
				->bind('errors', $errors)
				->bind('form', $_POST)
				->set('url',URL::base().'admin/klasifikasi/create')
				->set('submit_value',"Tambah Data")
				->set('keterangan_list',$this->getList('Keterangan','name'));
		}
	}
	
	public function action_update() {
		$this->auto_render = false;
		$id = $this->request->param('id');
		$klasifikasi = ORM::factory('Klasifikasi',$id);
		
		try {
			if(isset($_POST['delete'])) {
				$klasifikasi->delete($id);
			}
			else {				
				$klasifikasi->update_klasifikasi($_POST, array_keys($this->getField('Klasifikasi')));								
			}
			
			echo "success";
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');			
			$view = View::factory('admin/klasifikasi_form')
				->bind('errors', $errors)
				->bind('form', $_POST)
				->set('url',URL::base().'admin/klasifikasi/update/'.$id)
				->set('submit_value',"Update Data")
				->set('id',$id)
				->set('keterangan_list',$this->getList('Keterangan','name'));
				
			echo $view;				
		}
	}
	
	public function action_search() {
		$this->auto_render = false;

		echo View::factory('admin/klasifikasi_search')
			->set('url',URL::base().'admin/klasifikasi')
			->set('keterangan_list',$this->getList('Keterangan','name','Pilih Retensi'));										
	}
	
	public function action_data() {
		$this->auto_render = false;		
		
		$klasifikasis = ORM::factory('Viewklasifikasi');				
		$total_data = $klasifikasis->reset(FALSE)->count_all();

		$klasifikasis = $klasifikasis
			->where('name','LIKE','%'.$_REQUEST['search']['value'].'%');
		
		$total_filtered = $klasifikasis->reset(FALSE)->count_all();
		
		$klasifikasis = $klasifikasis
			->offset($_REQUEST['start'])
			->limit($_REQUEST['length'])
			->order_by('kode','ASC')
			->find_all();
			
		$arrData = array();
		$i = 1;
		foreach($klasifikasis as $klasifikasi) {
			$arrData[] = array(
				$i + $_REQUEST['start'],
				"<a id='".$klasifikasi->id."' data-fancybox data-type='ajax' data-src='".URL::base()."admin/klasifikasi/edit/".$klasifikasi->id."'>".$klasifikasi->kode."</a>",
				$klasifikasi->name,
				$klasifikasi->aktif,
				$klasifikasi->inaktif,
				$klasifikasi->keterangan_name			
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