<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Admin_Inbox extends Controller_Admin_Backend {
	public $auth_required = array('login','admin');
	
	function action_index(){
		if(Auth::instance()->get_user()->sotk_id == 1) {
			$inbox = ORM::factory('Viewkepaladinas')
				->where('sotk_id','=',Auth::instance()->get_user()->sotk_id);
		}
		else {
			$inbox = ORM::factory('Viewinbox')
				->where('sotk_id','=',Auth::instance()->get_user()->sotk_id);
		}
											
		$count = $inbox->reset(FALSE)->count_all();
		
		$config = Kohana::$config->load('configuration');
		$pagination = Pagination::factory(array(
			'total_items'    	=> $count,
			'items_per_page' 	=> $config->get('items_per_pages'),
			'auto_hide'			=> FALSE,
		));
		
		$results = $inbox
			->limit($pagination->items_per_page)
			->offset($pagination->offset)
			->order_by('status_baca','ASC')
			->order_by('tanggal','DESC')
			->find_all();				
			
		$this->template->content = View::factory('admin/inbox')
			->set('results', $results)
			->set('page_links', $pagination->render('pagination/diggs'))
			->set('i', $pagination->offset+1)
			->set('url',URL::base().'admin/surat')
			->set('submit_value','Cari')
			->bind('num_rows',$count);
	}
}
?>