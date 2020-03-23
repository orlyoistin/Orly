<? defined('SYSPATH') or die('No direct access allowed.');

class Model_User extends ORM {
	protected $_has_many = array(
		'user_tokens' 	=> array('model' => 'user_token'),
		'roles'       	=> array('model' => 'role', 'through' => 'roles_users'),
		'transaksi'	  	=> array(),
		'note'			=> array(),
	);
	
	protected $_belongs_to = array(
		'jabatan'	=> array(),
		'skpd'		=> array(),
		'unit'		=> array(),
		'sotk'		=> array(),
	);

	public function rules()
	{
		return array(
			'username' => array(
				array('not_empty'),
				array('min_length', array(':value', 4)),
				array('regex', array(':value', '/^[-\pL\pN_.]++$/uD')),
				array(array($this, 'username_available'), array(':validation', ':field')),
			),
			'jabatan_id' => array(
				array('not_empty'),
			),
			'name' => array(
				array('not_empty'),
			),
			'skpd_id' => array(
				array('not_empty'),
			),
		);
	}
	
	public function filters() {
		return array(
			'password' => array(
				array(array(Auth::instance(), 'hash'))
			)
		);
	}

	public function labels() {
		return array(
			'username'      => 'username',
			'name'          => 'name',
			'nip'          	=> 'nip',
			'email'         => 'email',
			'skpd_id'		=> 'skpd_id',
			'password'      => 'password',
			'jabatan_id'		=> 'jabatan_id',
			'kode'			=> 'kode',
		);
	}

	public function complete_login() {
		if ($this->_loaded) {
			$this->logins = new Database_Expression('logins + 1');
			$this->last_login = time();
			$this->update();
		}
	}
	
	public function kode_available($kode) {
		if(isset($_POST['id'])) {
			$user = ORM::factory('User',$_POST['id']);
			if(ORM::factory('User')
				->where("kode","=",$kode)
				->where("kode","!=",$user->kode)
				->where("skpd_id","=",$user->skpd_id)
				->count_all()) {
				return FALSE;
			}
		}
		else {
			if(isset($_POST['skpd_id'])) {
				if(ORM::factory('User')->where("kode","=",$kode)->where("skpd_id","=",$_POST['skpd_id'])->count_all()) {
					return FALSE;
				}
			}
		}
	}


	public function username_available(Validation $validation, $field) {
		if ($this->unique_key_exists($validation[$field], 'username')) {
			$validation->error($field, 'username_available', array($validation[$field]));
		}
	}

	public function email_available(Validation $validation, $field) {
		if ($this->unique_key_exists($validation[$field], 'email')) {
			$validation->error($field, 'email_available', array($validation[$field]));
		}
	}

	public function unique_key_exists($value, $field = NULL) {
		if ($field === NULL) {
			$field = $this->unique_key($value);
		}

		return (bool) DB::select(array(DB::expr('COUNT(*)'), 'total_count'))
			->from($this->_table_name)
			->where($field, '=', $value)
			->where($this->_primary_key, '!=', $this->pk())
			->execute($this->_db)
			->get('total_count');
	}

	public function unique_key($value) {
		return Valid::email($value) ? 'email' : 'username';
	}

	public static function get_password_validation($values) {
		return Validation::factory($values)
			->rule('password', 'min_length', array(':value', 4))
			->rule('password_confirm', 'matches', array(':validation', ':field', 'password'));
	}

	public function create_user($values, $expected) {
		$extra_validation = Model_User::get_password_validation($values)
			->rule('password', 'not_empty');

		return $this->values($values, $expected)->create($extra_validation);
	}

	public function update_user($values, $expected = NULL) {
		if (empty($values['password'])) {
			unset($values['password'], $values['password_confirm']);
		}

		$extra_validation = Model_User::get_password_validation($values);
		return $this->values($values, $expected)->update($extra_validation);
	}
}