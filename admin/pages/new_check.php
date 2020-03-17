<?php
    
    /*class new_check{
        function __construct(){
            $this -> db = mysqli_connect("","","","");
        }
    }*/
    
    function is_pjax(){ 
      return array_key_exists('HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX']; 
    }
    if( is_pjax() ){
        session_start();
        $class = $_SESSION['class'];
        $title = $_SESSION['title'];
        $name = $_SESSION['name'];
        
    }

?>

<div class="mdui-card">
    <div class="mdui-card-content">
        <center><h2>新建一个CHECK</h2></center>
        <div class="mdui-textfield mdui-textfield-floating-label">
          <label class="mdui-textfield-label">名称</label>
          <input class="mdui-textfield-input" type="text" id="new_check_name"/>
        </div>
        <center><button class="mdui-btn mdui-ripple" onclick="new_check_sub()">创建</button></center>
    </div>
</div>

<script>
    function new_check_sub(){
        var check_name_new = $("#new_check_name").val()
        console.log(check_name_new)
        $.ajax({
            url : "/admin/pages/new_check_sub.php",
            type : "post",
            data : { "check_name_new" : check_name_new , "class" : '<?php echo($class) ?>' }
        })
        $.pjax({
            url : "/admin/pages/mg_check.php",
            container : "#pjax-body"
        })
    }
</script>
