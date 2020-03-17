<?php
    
    class new_check{
        function __construct(){
            $this -> db = mysqli_connect("数据库地址","数据库用户名","数据库密码","数据库名");
            $this -> date_now = date("Y-m-d");
        }
        function create_table($table_name,$checker,$class,$sub){
            $this -> command = "CREATE TABLE IF NOT EXISTS $table_name (
                                   name mediumtext NOT NULL, 
                                   class mediumtext NOT NULL, 
                                   xuehao mediumtext NOT NULL, 
                                   state mediumtext
                                ) ENGINE=InnoDB";
            mysqli_query($this -> db , $this -> command);
            $date_now = $this -> date_now;
            $this -> command = "insert into checks values('$checker','$date_now','$class','$sub','$table_name')";
            mysqli_query($this -> db , $this -> command);
        
        }
        function copy_new($table_name,$class){
            $this -> command = "select * from users where class='$class'";
            $this -> result = mysqli_query($this -> db , $this -> command);
            $this -> result = mysqli_fetch_all($this -> result);
            foreach($this -> result as $usr){
                $name = $usr[0];
                $class = $class;
                $xuehao = $usr[2];
                $state = " ";
                $this -> command = "insert into $table_name values('$name','$class','$xuehao','$state')";
                mysqli_query($this -> db, $this -> command);
            }
        }
    }
    
    if(isset($_POST['check_name_new'])){
        session_start();
        $checker = $_SESSION['username'];
        $sub = $_SESSION['sub'];
        $check_name_new = $_POST['check_name_new'];
        $class = $_POST['class'];
        $check = new new_check;
        $check -> create_table($check_name_new,$checker,$class,$sub);
        $check -> copy_new($check_name_new, $class);
    }

?>
