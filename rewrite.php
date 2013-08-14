<?php

class url {

  public $url;
  public $urlStr;

  public function __construct() {
    if (isset($_GET['route'])):

      $del = strip_tags(strtolower($_GET['route']));
      $del = explode('/', $del);
      
      foreach ($del as $pattern) {
        if (!empty($pattern)):
          preg_match("$[a-zA-Z0-9_-]*$", $pattern, $res);
          $this->url .= "{$res[0]}/";
        endif;
      }

      if ($_GET['route'] != $this->url):
        redirect($this->url);
      else:
        $this->urlStr = $this->url;
        $this->url = explode('/', $this->urlStr);
        unset($_GET['route']);
      endif;
    
    endif;
  }

}

  function redirect($url = NULL){
      header("Location: ".__BASEURL__.''.$url);
      exit();
  }
  
  function getModule() {
    global $url;
    if (!empty($url->url[0])) {
    	return $url->url[0];
    } else {
    	return 'index';
    }
  }

  function getAction() {
    global $url;
    	if (!empty($url->url[1])) {
    		return $url->url[1];
    	} else {
    		return 'index';
    	}
  }
  
  function getID() {
    global $url;
    if (!empty($url->url[1])) {
    	return $url->url[2];
    } else {
    	return false;
    }
  }
  
  function send_404() {
  	require_once(__ABSPATH__.'/template/404.php');
  }
  
?>