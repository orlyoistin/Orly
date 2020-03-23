<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Struktural_Verifikasi extends Controller_Struktural_Backend {
	public $auth_required = array('login','admin');
	
	function action_index(){
		$verifikasi = ORM::factory('Viewverifikasi')
			->where('sotk_id','=',Auth::instance()->get_user()->sotk_id);
											
		$count = $verifikasi->reset(FALSE)->count_all();
		
		$config = Kohana::$config->load('configuration');
		$pagination = Pagination::factory(array(
			'total_items'    	=> $count,
			'items_per_page' 	=> $config->get('items_per_pages'),
			'auto_hide'			=> FALSE,
		));
		
		$results = $verifikasi
			->limit($pagination->items_per_page)
			->offset($pagination->offset)
			->order_by('tanggal','DESC')
			->find_all();				
			
		$this->template->content = View::factory('struktural/verifikasi')
			->set('results', $results)
			->set('page_links', $pagination->render('pagination/diggs'))
			->set('i', $pagination->offset+1)
			->set('url',URL::base().'dinas/surat')
			->set('submit_value','Cari')
			->bind('num_rows',$count);
	}
	
	public function action_edit() {
		$id = $this->request->param('id');

		$surat = ORM::factory('surat',$id);
		
		$form = array();
		$fields = ORM::factory('surat')->list_columns();
		foreach($fields as $field) {
			$column = $field['column_name'];
			$form[$field['column_name']] = $surat->$column;
		}
		$dari_id = $surat->dari;
		
		$arrKepada = array();
		$kepadas = $surat->kepada->find_all();
		foreach($kepadas as $kepada) {
			array_push($arrKepada,$kepada->sotk_id);
		}		
		$form['kepada'] = $arrKepada;
		
		$arrTembusan = array();
		$tembusans = $surat->tembusan->find_all();
		foreach($tembusans as $tembusan) {
			array_push($arrTembusan,$tembusan->sotk_id);
		}		
		$form['tembusan'] = $arrTembusan;
		
		$verifikasi = ORM::factory('Verifikasi')
			->where('surat_id','=',$id)
			->where('sotk_id','=',Auth::instance()->get_user()->sotk_id)
			->find();
			
		$form['bool_id'] = $verifikasi->status_verifikasi;	
	
		$this->template->content = View::factory('struktural/verifikasi_form')
			->bind('form',$form)
			->set('id',$id)
			->set('url',URL::base().'dinas/verifikasi/update/'.$id)
			->set('submit_value','Update Data')
			->set('template_list',$this->getList('Template','name','Pilih Template'))
			->set('parent_list',Model::factory('Custom')->parent())
			->set('dari_id',$dari_id)
			->set('bool_list',$this->getList('Bool','verifikasi'));										
	}
	
	public function action_update() {	
		$this->auto_render = false;
		$id = $this->request->param('id');
		
		try {
			DB::update('verifikasis')
				->set(array('status_verifikasi' => $_POST['bool_id']))
				->where('surat_id', '=', $id)
				->where('sotk_id','=',Auth::instance()->get_user()->sotk_id)
				->execute();
				
			if($_POST['bool_id'] == 2) {
				$sotk_user = ORM::factory('Sotk',Auth::instance()->get_user()->sotk_id);
				$sotk_parent = $sotk_user->parent_id;				
				$parent = ORM::factory('Sotk',$sotk_parent);
				
				if($parent->level > 0) {
					DB::insert('verifikasis', array('surat_id', 'sotk_id'))
						->values(array($id, $sotk_parent))
						->execute();
				}
			}
				
			HTTP::redirect(URL::base().'dinas/verifikasi');
		}
		catch (ORM_Validation_Exception $e) {
			$errors = $e->errors('models');		
			
			$this->template->content = View::factory('struktural/surat_form')
				->bind('form',$form)
				->set('id',$id)
				->set('url',URL::base().'dinas/surat/update/'.$id)
				->set('submit_value','Update Data')
				->set('template_list',$this->getList('Template','name','Pilih Template'))
				->set('parent_list',Model::factory('Custom')->parent());	
		}
	}	
	
	public function action_template() {	
		$this->auto_render = false;
		
		$template = ORM::factory('Template',$_POST['template_id']);
		echo $template->description;
	}
}
?>