<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Admin_Backup extends Controller_Admin_Backend {
	public $auth_required = array('login','backup');
	
	public function action_index(){
		$url = URL::base().'backup/restore';
		$this->template->content = View::factory('backup')
			->bind('url', $url);
	}
	
	public function action_backup() {
		$this->auto_render = false;
		
		$str_query = "";
		$str_query .= "SET FOREIGN_KEY_CHECKS=0;"."<br><br>";
		
		$tables = DB::query(Database::SELECT,"SHOW TABLES")->execute();
		foreach($tables as $table) {
			$data = $table['Tables_in_mitk'];
			$sql = DB::query(Database::SELECT,"SHOW CREATE TABLE ".$data)->execute();
			foreach($sql as $row) {
				$str_query .= "DROP TABLE IF EXISTS ".$data.";"."<br>";
				$str_query .= $row['Create Table'].";"."<br><br>";
				
				$lines = DB::select()->from($data)->execute();				
				foreach($lines as $line) {
					$value = "";
					$str_query.="INSERT INTO ".$data." VALUES (";
					
					$fields = DB::query(Database::SELECT,"SHOW FIELDS FROM ".$data)->execute();
					foreach($fields as $field) {
						$f = $field['Field'];
						$value.="'".addslashes($line[$f])."',";
					}
					$value = substr_replace($value,"",-1);
					$str_query.=$value;
					$str_query.=");"."<br>";
				}
				$str_query.="<br>";
			}
		}
		
		$filename = "midb_".time().".sql";
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=".$filename);

		echo str_replace("<br>","\r\n",$str_query);
	}
	
	/*function action_restore() {		
		if($_FILES['sqlrestore']['tmp_name']) {
			$filename = "restore.sql";
			move_uploaded_file($_FILES['sqlrestore']['tmp_name'], URL::base().'sql/'.$filename);
			
			$config = Kohana::$config->load('database');
			$dbconfig = $config->get('default');
			$dbhost = $dbconfig['connection']['hostname'];
			$dbname = $dbconfig['connection']['database'];
			$dbuser = $dbconfig['connection']['username'];
			$dbpass = $dbconfig['connection']['password'];
			
			$command = DB_PATH.'mysql --host="'.$dbhost.'" --user="'.$dbuser.'" --password="'.$dbpass.'" '.$dbname.' < '.$filename;
			system($command, $result);
			unlink(URL::base().'sql/'.$filename);			
		}
		
		$this->redirect(URL::base().'backup');
	}*/
}
?>