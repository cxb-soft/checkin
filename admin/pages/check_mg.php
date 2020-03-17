<?php

    class check_m{
        function __construct(){
            $this -> db = mysqli_connect("数据库地址","数据库用户名","数据库密码","数据库名");
        }
        
        function list_check($username){
            $this -> command = "select * from `checks` where `checker`='$username'";
            $this -> result = mysqli_query($this -> db, $this -> command);
            $this -> result = mysqli_fetch_all($this -> result);
            //echo($this -> result);
            return $this -> result;
        }
    }

?>



<style>
    .beauty-mdui{
        padding-left: 5%;
        padding-right: 5%;
    }
</style>

<br><br>

    <?php
    
        session_start();
        $username = $_SESSION['username'];
        //echo($username);
        $check_ac = new check_m;
        $check_list = $check_ac -> list_check($username);
        //echo($check_list[0][0]);
        
    ?>
    <center><h2>管理你的CHECK</h2></center>
    
    <div class="beauty-mdui" id='pjax-change'>
        <center><button class="mdui-ripple mdui-btn" onclick="new_check('<?php echo($username); ?>')">创建CHECK</button></center>
        <div class="mdui-table-fluid">
          <table class="mdui-table">
            <thead>
              <tr>
                <th>名册</th>
                <th>创建日期</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
                <?php
                
                    foreach($check_list as $checks_l){
                        
                        $check_name = $checks_l[4];
                        $check_time = $checks_l[1];
                        echo("<tr>");
                        echo("<td>$check_name</td>");
                        echo("<td>$check_time</td>");
                        echo("<td>
                        
                            <button class='mdui-btn mdui-ripple' onclick='enter_check(\"$check_name\")'>进入</button>
                            <button class='mdui-btn mdui-ripple' onclick='delete_check(\"$check_name\")'>删除</button>
                        
                        </td>");
                        echo("</tr>");
                        
                    }
                
                ?>
              <!--<tr>
                <td>1</td>
                <td>Mark</td>
                <td>Otto</td>
              </tr>-->
            </tbody>
          </table>
        </div>
    </div>
    <script>
        function enter_check( check_name ){
            $.pjax({
                url : "/admin/pages/check_d.php",
                type : "post",
                data : {"check_name" : check_name},
                container : "#pjax-change"
            })
        }
        
        function new_check(username){
            $.pjax({
                url : "/admin/pages/new_check.php",
                type : "post",
                data : {"username" : username},
                container : "#pjax-change"
            })
        }
    </script>
