<?
    
    class user {
        protected $login;
        protected $password;
        protected $role_id = 2;
        protected $is_login = FALSE;
        protected $is_activate = FALSE;
        
        function __construct() {
        	session_start();
        	if (isset($_SESSION['Login'])) {
        		if ($_SESSION['Login'] == 1) {
        			$this->is_login = TRUE;
        		}
        	}
        }
        
        public function setName ($name) {
            if(!isset($this->name)) {
                $this->name = $name;
            }
            return $this;
        }
        
        public function setLogin ($login) {
            if(!isset($this->login)) {
                $this->login = $login;
            }
            return $this;
        }
        
        public function setPassword ($password) {
            if(!isset($this->password)) {
                $this->password = $password;
            }
            return $this;
        }
        
        public function getName () {
            if(isset($this->name)) {
                return $this->name;
            } else {
                return FALSE;
            }
        }
        
        public function getLogin () {
            if(isset($this->login)) {
                return $this->login;
            } else {
                return FALSE;
            }
        }
        
        public function getRole () {
            if(isset($this->role_id)) {
                return $this->role_id;
            } else {
                return FALSE;
            }
        }
        
        public function log_in() {
        	if (isset($this->login) && isset($this->password)) {
        		global $db;
        		$arrayUser = $db->get_results('SELECT User_ID, Role_ID, User_Status FROM User WHERE User_Nick="'.$this->login.'" AND User_Password="'.$this->password.'" LIMIT 1',ARRAY_A);
        		if (isset($arrayUser)) {
        		
        			$_SESSION['Login'] = 1;
        			$_SESSION['Nick'] = $this->login;
        			$_SESSION['Password'] = $this->password;
        			$this->role_id = $arrayUser[0]['Role_ID'];
        			$this->is_login = TRUE;
        			
        			if($arrayUser[0]['User_Status'] == 1) {
        				$this->is_activate = TRUE;
        				$_SESSION['Activate'] = 1;
        			} else {
        				$this->is_activate = FALSE;
        				$_SESSION['Activate'] = 0;
        			}
        		}
        	}
        	return $this;
        }
        
        public function log_out() {
					unset($_SESSION['Login']);
					unset($_SESSION['Nick']);
					unset($_SESSION['Password']);
					unset($_SESSION['Activate']);
        }
        
        public function is_login() {
        	if ($this->is_login) {
        		return TRUE;
        	} else {
        		return FALSE;
        	}
        }
        
        public function is_activate() {
        	if ($this->is_activate) {
        		return TRUE;
        	} else {
        		return FALSE;
        	}
        }
        
    }
?>