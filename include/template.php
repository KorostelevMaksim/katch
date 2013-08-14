<?php

	function get_head() {
		echo "<title>".getModule()."</title>";
	}

  function get_header() {
    if(file_exists(__ABSPATH__.'/template/header.php'))
        require_once __ABSPATH__.'/template/header.php';
  }
  
  function get_footer() {
    if(file_exists(__ABSPATH__.'/template/footer.php'))
        require_once (__ABSPATH__.'/template/footer.php');
  }
  
  function get_sidebar() {
    if(file_exists(__ABSPATH__.'/template/sidebar.php'))
        require_once (__ABSPATH__.'/template/sidebar.php');
  }
  
  function get_template($module,$action = NULL) {
  	if (getAction() || !empty($action)):
  		if(file_exists(__ABSPATH__.'/template/'.$module.'/'.getAction().'.php')):
  		  require_once (__ABSPATH__.'/template/'.$module.'/'.getAction().'.php');
  		else:
  			if(getModule() == "index") {
					if(file_exists(__ABSPATH__.'/template/index.php')) {
					  require_once (__ABSPATH__.'/template/index.php');
					} else {
						send_404();  
					}
  			} else {
	  		  if(file_exists(__ABSPATH__.'/template/'.$module.'/index.php')) {
  		  	  require_once (__ABSPATH__.'/template/'.$module.'/index.php');
  		  	} else {
  		  	  send_404();  
  				}
	  		}
	  	endif;
  	else:
  		if(file_exists(__ABSPATH__.'/template/'.$module.'/index.php')) {
  		  require_once (__ABSPATH__.'/template/'.$module.'/index.php');
  		} else {
  		  require_once (__ABSPATH__.'/template/index.php');
  		}
  	endif;
    
  }


?>