<?

    /**@author Jay_Silent  */
    
    define('__ABSPATH__',dirname(__FILE__));
    //define('__BASEURL__','http://localhost/katch/');
    define('__BASEURL__','http://10.0.1.5/katch/');
    
    define('DEBUG',TRUE);
    
    if(DEBUG){
        require_once(__ABSPATH__.'/include/debug.php');
    }
    
    require_once('rewrite.php');
    
    /** Создаем класс $url для валидации и получения модулей, контроллеров и индетификаторов */
    
    
    
    require_once(__ABSPATH__.'/include/db.php');
    
    $db = new ezSQL_mysql('root','root','katch','localhost');
    $db->query('SET NAMES utf8;');
    
    require_once(__ABSPATH__.'/include/user.php');
    require_once(__ABSPATH__.'/include/acl.php');

    $url = new url();
    $user = new user();
    
    if($user->is_login()):
    	$user->setLogin($_SESSION['Nick'])->setPassword($_SESSION['Password'])->log_in();
    endif;
    
    /** Проверка на доступ */
    $acl = new acl((int) $user->getRole());
    
    /** Подключаем шаблонизатор */
    require_once(__ABSPATH__.'/include/template.php');
    require_once(__ABSPATH__.'/include/form.php');
    
    if(!$acl->is_allow(getModule(),getAction())):
    	send_404();
    	exit;
    endif;
    
    /** Загружаем шаблон*/
    get_template(getModule());
?>