<?php

    function is_pjax(){ 
      return array_key_exists('HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX']; 
    }
    
    if( is_pjax() ){
        session_start();
        $class = $_SESSION['class'];
        $title = $_SESSION['title'];
        require_once("index.php");
    }
    else{
        echo("<center><h2>不支持使用本方式访问该页面</h2></center>");
    }

?>