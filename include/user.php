<?
    
    class user {
        protected $name;
        protected $password;
        
        public function setName ($name) {
            if(!isset($this->name)) {
                $this->name = $name;
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
        
        public function getPassword () {
            if(isset($this->password)) {
                return $this->password;
            } else {
                return FALSE;
            }
        }
        
    }
    
    $user = new user();
    
    $user->setName('John')->setPassword('123456');
    
    if($name = $user->getName()):
        echo $name;
    endif;
    
    if($password = $user->getPassword()):
        echo $password;
    endif;
    
    
    
?>