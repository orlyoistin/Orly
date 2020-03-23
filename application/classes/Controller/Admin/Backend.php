<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Admin_Backend extends Controller_Template
{	
	public $template = 'template/backend';
    public $auth_required = FALSE;
    public $secure_actions = FALSE;

	public function before() {
		parent::before();
		
		$action_name = Request::current()->action();
         if(($this->auth_required !== FALSE && Auth_ORM::instance()->logged_in($this->auth_required) === FALSE) || (is_array($this->secure_actions) && array_key_exists($action_name, $this->secure_actions) && Auth_ORM::instance()->logged_in($this->secure_actions[$action_name]) === FALSE)) {
			if(Auth::instance()->logged_in()) {
				HTTP::redirect('register/logout');
			}
			else {
				HTTP::redirect('admin');
			}
		}
		
		if ($this->auto_render)	{
			$this->template->title   = '';
			$this->template->content = '';		
			$this->template->styles = array();
			$this->template->scripts = array();   
		}
	}
	
	public function after() {
		if ($this->auto_render) {
			$styles		= array();
			$scripts   	= array();
		
			$this->template->styles 	= array_merge($this->template->styles, $styles);
			$this->template->scripts 	= array_merge($this->template->scripts, $scripts);		
		}
		
		parent::after();
	}
	
	// Custom Function
	public function getField($table) {
		$form = array();
		$fields = ORM::factory($table)->list_columns();
		foreach($fields as $field) {
			$form[$field['column_name']] = "";
		}
		return $form;
	}
	
	public function getList($table,$field_name="",$option="",$condition="",$order="") {
		$data_list = array();
		
		if($option != "") {
			if($option == 1) {
				$data_list[''] = "Pilih ".ucwords($table);
			}
			else {
				$data_list[''] = $option;
			}
		}
		
		$datas = ORM::factory($table);
		
		if($condition) {
			foreach($condition as $val) {
				$datas = $datas->where($val[0],$val[1],$val[2]);
			}
		}
		if($order) {
			foreach($order as $val) {
				$datas = $datas->order_by($val[0],$val[1]);
			}
		}
		
		$arrField = array();
		$fields = ORM::factory($table)->list_columns();
		foreach($fields as $field) {
			array_push($arrField,$field['column_name']);	
		}
		
		$datas = $datas->find_all();
		foreach($datas as $data) {			
			if(is_array($field_name)) {
				$text_value = "";
				foreach($field_name as $key=>$val) {					
					if(in_array($key,$arrField)) {
						if($val > 0) {
							$text_value .= substr($data->$key,0,$val)."...";
						}
						else {
							$text_value .= $data->$key;
						}
					}
					else {
						$text_value .= $key;							
					} 
				}
				$data_list[$data->id] = $text_value;
			}
			else {
				$data_list[$data->id] = ucfirst($data->$field_name);
			}
		}
		return $data_list;
	}
	
	public function getSeparator() {
		$sys = strtoupper(PHP_OS);
	 
		if(substr($sys,0,3) == "WIN"){
			$separator = "\\";
		}
		else {
			$separator = "/";
		}
	 
		return $separator;
	}
    
	public function getBulan() {
        return array("1"=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
    }
	
	public function getSearch($orm_var, $arrFind) {
		$query = "";
		$main_table = substr_replace($orm_var->table_name(),"",-1);
		
		foreach($arrFind as $var) {
			if(isset($_REQUEST[$var])) {
				if($_REQUEST[$var] != "") {
					if(strpos($var, "_id")===false) {
						// Field tanpa _id
						if(strpos($var, "_")===false) {
							// Field tanpa _id dan tanpa _
							$query .= $orm_var->where($main_table.'.'.$var,"LIKE","%".$_REQUEST[$var]."%");
						}
						else {
							// Field tanpa _id dan dengan _
							if(strpos($var, "_start")===false) {								
								// Field tanpa _id, dengan _ tanpa start
								if(strpos($var, "join")===false) {
									if(strpos($var, "bool")===false) {
										// Field tanpa _id, dengan _ tanpa start tanpa bool
										$orm_var->where($main_table.'.'.$var,"LIKE","%".$_REQUEST[$var]."%");
									}
									else {
										// Field tanpa _id, dengan _ tanpa start dengan bool
										$xvar = explode("_",str_replace('_bool','',$var));									
										$orm_var
											->join($xvar[1].'s','INNER')
											->on($xvar[0].'.id','=',$xvar[1].'s.'.$xvar[0].'_id');
									}
								}
								else {
									if(strpos($var, "_join_primary")===false) {
										// Field tanpa _id, dengan _ tanpa start tanpa join_primary
										$xvar = explode("_",str_replace('_join','',$var));
										$orm_var
											->join($xvar[1].'s','INNER')
											->on($xvar[0].'.'.$xvar[1].'_id','=',$xvar[0].'s.id')
											->where($xvar[1].'s.'.$xvar[2],'LIKE','%'.$_REQUEST[$var].'%');
									}
									else {
										// Field tanpa _id, dengan _ tanpa start dengan join_primary
										$xvar = explode("_",str_replace('_join_primary','',$var));
										$orm_var
											->join($xvar[1].'s','INNER')
											->on($xvar[0].'.id','=',$xvar[1].'s.'.$xvar[0].'_id')
											->where($xvar[1].'s.'.$xvar[2].'_id','=',$_REQUEST[$var])
											->group_by($xvar[0].'.id');
									}
								}
							}
							else {
								// Field tanpa _id, dengan _ dengan start
								$orm_var
									->where(str_replace('_start','',$var),'>=',$_REQUEST[$var])
									->where(str_replace('_start','',$var),'<=',$_REQUEST[str_replace('start','end',$var)]);
							}
						}
					}
					else {					
						$query .= $orm_var->where($var,"=",$_REQUEST[$var]);
					}
				}
			}		
		}
        
		return $query;
    }
	
	public function getKeyword($arrFind) {
		$keyword = "";
		foreach($arrFind as $var) {
			if(isset($_REQUEST[$var])) {
				if($_REQUEST[$var] != "") {
					if(strpos($var, "_id")===false) {
						if(strpos($var, "_join_primary")===false) {							
							if(strpos($var, "_join")===false) {
								$keyword .= $_REQUEST[$var].", ";
							}
							else {
								$xvar = explode("_",str_replace('_join','',$var));
								$keyword .= ORM::factory(ucfirst($xvar[2]),$_REQUEST[$var])->name.", ";
							}
						}
						else {							
							$xvar = explode("_",str_replace('_join_primary','',$var));
							$keyword .= ORM::factory(ucfirst($xvar[2]),$_REQUEST[$var])->name.", ";
						}	
					}
					else {
						if(strpos($var, "_join_primary")===false) {							
							if(strpos($var, "_join")===false) {
								$xvar = explode("_",$var);
								$keyword .= ORM::factory(ucfirst($xvar[0]),$_REQUEST[$var])->name.", ";
							}
							else {
								$xvar = explode("_",str_replace('_join','',$var));
								$keyword .= ORM::factory(ucfirst($xvar[2]),$_REQUEST[$var])->name.", ";
							}
						}
						else {							
							$xvar = explode("_",str_replace('_join_primary','',$var));
							$keyword .= ORM::factory(ucfirst($xvar[2]),$_REQUEST[$var])->name.", ";
						}							
					}
				}
			}		
		}
        
		return substr_replace($keyword,"",-2);
    }
}
?>