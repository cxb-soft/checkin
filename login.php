<?php
    class usrpasmg{
        
        function __construct(){
            $this -> db = mysqli_connect("localhost","check","wabadmin1","check");
        }
        function check_ps($username,$password){
            $this -> command = "select * from teacher_usr where username='$username'";
            $this -> result = mysqli_query($this -> db , $this -> command);
            $this -> result = mysqli_fetch_all($this -> result);
            if(empty($this -> result)){
                return "No_user";
            }
            else{
                $this -> corr_passwd = $this -> result[0][1];
                if($this -> corr_passwd == $password){
                    return $this -> result[0][2];
                }
                else{
                    return "password_incor";
                }
            }
        }
        
    }
    function is_pjax(){ 
      return array_key_exists('HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX']; 
    }
    if( is_pjax() ){
        //echo("Pjax");
        $username = $_POST['username'];
        $password = $_POST['password'];
        $class = $_POST['class'];
        $check_el = new usrpasmg;
        $result = $check_el -> check_ps($username,$password);
        //echo($result);
        if($result == "password_incor"){
            echo("<center><h2>密码错误</h2></center>");
            echo("<meta http-equiv=\"refresh\" content=\"1;url=./?class=$class\">");
        }
        else{
            if($result == "No_user"){
                echo("<center><h2>没有找到此用户</h2></center>");
                echo("<meta http-equiv=\"refresh\" content=\"1;url=./?class=$class\">");
            }
            else{
                
                session_start();
                $_SESSION['class'] = $result;
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                
                echo("<center><h2>登陆成功，即将跳转</h2></center>");
                echo("<meta http-equiv=\"refresh\" content=\"1;url=./admin/\">");
                /*echo("
                
                    <script>
                        $.pjax({
                            url : \"./admin/request_admin.php\",
                            container : \"#admin_page\"
                        })
                        document.addEventListener('pjax:complete', function () {
                          $('script[data-pjax], .pjax-reload script').each(function () {
                            $(this).parent().append($(this).remove());
                          });
                        });
                    </script>
                    
                
                ");*/
            }
        //echo("username : $username \npassword : $password");
        }
        
    }
    else{
        echo("没有使用正确的方式访问此页面");
        header("refresh:1;./index.php");
    }

?>