<?php
    class check_d{
        function __construct(){
            $this -> db = mysqli_connect("数据库地址","数据库用户名","数据库密码","数据库名");
        }
        function get_list_no($check_name){
            $this -> command = "select * from $check_name where state=' '";
            //echo($this -> command);
            $this -> result = mysqli_query($this -> db , $this -> command);
            $this -> result = mysqli_fetch_all($this -> result);
            return $this -> result;
        }
        function get_list_y($check_name){
            $this -> command = "select * from $check_name where state='y'";
            $this -> result = mysqli_fetch_all(mysqli_query($this -> db , $this -> command));
            return $this -> result;
        }
        function comfirm_check($usr_name,$check_name){
            $this -> command = "update $check_name set state='y' where name='$usr_name'";
            mysqli_query($this -> db, $this -> command);
        }
        function un_comfirm_check($usr_name,$check_name){
            $this -> command = "update $check_name set state=' ' where name='$usr_name'";
            mysqli_query($this -> db, $this -> command);
        }
    }


    function is_pjax(){ 
      return array_key_exists('HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX']; 
    }
    if( is_pjax() ){
        session_start();
        $class = $_SESSION['class'];
        $title = $_SESSION['title'];
        $check_name = $_SESSION['check_name'];
        $name = $_SESSION['name'];
        //$usr_name = $_POST['usr_name'];
        $check_l = new check_d;
        //$check_l -> comfirm_check($usr_name,$check_name);
        $checkd = $check_l -> get_list_y($check_name);
    }
    else{
        exit();
    }

?>
<center><h2>已完成</h2></center>
    <div class="mdui-table-fluid">
        <table class="mdui-table">
            <thead>
              <tr>
                <th>姓名</th>
                <th>状态</th>
              </tr>
            </thead>
            <tbody>
                <?php
                
                    foreach($checkd as $checkd_1){
                        
                        $usr_name = $checkd_1[0];
                        //$check_time = $checkd_1[1];
                        echo("<tr>");
                        echo("<td>$usr_name</td>");
                        //echo("<td>$check_time</td>");
                        echo("<td>
                        
                            <button class='mdui-btn mdui-ripple' onclick='uncomfirm_check(\"$usr_name\")'>标记未完成</button>
                        
                        </td>");
                        echo("</tr>");
                        
                    }
                ?>
            </tbody>
        </table>
    </div>
