<?php

    function is_pjax(){ 
      return array_key_exists('HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX']; 
    }
    if( is_pjax() ){
        session_start();
        $class = $_SESSION['class'];
        $title = $_SESSION['title'];
        $name = $_SESSION['name'];
        echo <<<EOF
        <br><br>
        <center>
            <h2>你好，$name</h2>
        </center>
EOF;
    }

?>