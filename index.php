<?php
    
    class db_go{
        function __construct(){
            $this -> db = mysqli_connect("数据库地址" , "数据库用户" , "数据库密码" , "数据库名");
        }
        function selector_c($class){
            $this -> selector_command = "select * from titles where class='$class'";
            $this -> result = mysqli_query($this -> db , $this -> selector_command);
            $this -> result = mysqli_fetch_all($this -> result);
            return $this -> result;
        }
        function __destruct(){
            // echo("Hello");
        }
    }
    //$db = new db_go;
    if( isset($_GET['class']) ){
        $class = $_GET['class'];
        $db = new db_go;
        $reuslt = $db -> selector_c($class);
        if(empty($reuslt)){
            echo("<center><h2>没有找到此班级</h2></center>");
        }
        else{
            session_start();
            $title = $reuslt[0][1];
            $_SESSION['title'] = $title;
            $_SESSION['class'] = $class;
            //echo($title);
        }
    }
    else{
        exit();
    }

?>

<html>
    <head>
        <title><?php echo($title) ?></title>
        <script data-pjax src="//cdnjs.loli.net/ajax/libs/mdui/0.4.3/js/mdui.min.js"></script>

        <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    	<link rel="stylesheet" href="//cdnjs.loli.net/ajax/libs/mdui/0.4.3/css/mdui.min.css">
    	<link rel="stylesheet" href="all-a.css">
    	<link rel="stylesheet" href="/node_modules/nprogress/nprogress.css">
	</head>
	<style>

        header {
            display : block;
        }
        
    </style>
	<style>
	    .beauty_mdui{
	        padding-left: 5%;
	        padding-right: 5%;
	    };
	    .footer{
	        margin-bottom: 50px;
	    }
	</style>
	<body class="mdui-appbar-with-toolbar mdui-theme-primary-green mdui-theme-accent-pink mdui-loaded" background='https://www.toptal.com/designers/subtlepatterns/patterns/repeated-square.png' id="admin_page">
	    <div class="mdui-appbar">
    	    <header class="mdui-appbar mdui-appbar-fixed">
                <div class="mdui-toolbar mdui-color-theme">
                    <span class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white" mdui-drawer="{target: '#main-drawer'}">
                        <i class="mdui-icon material-icons">menu</i>
                    </span>
                    <a href="" class="mdui-typo-title"><?php echo($title) ?></a>
                </div>
            </header>
            <div class="mdui-drawer mdui-drawer-close" id="main-drawer">
                <div class="mdui-list" mdui-collapse="{accordion: true}" style="margin-bottom: 68px;">
                    <div class="mdui-list">
                        <a href="/?class=<?php echo($class) ?>" class="mdui-list-item">
                            <i class="mdui-list-item-icon mdui-icon material-icons">home</i>
                            <div class="mdui-list-item-content">
                                主页
                            </div>
                        </a>
                        <a href="./admin" class="mdui-list-item">
                            <i class="mdui-list-item-icon mdui-icon material-icons"></i>
                            <div class="mdui-list-item-content">
                                后台
                            </div>
                        </a>
                        <a href="./about.php" class="mdui-list-item">
                            <i class="mdui-list-item-icon mdui-icon material-icons">info_outline</i>
                            <div class="mdui-list-item-content">
                                关于
                            </div>
                        </a>
                    </div>
                    <div class="mdui-collapse-item ">
                        <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                            <i class="mdui-list-item-icon mdui-icon material-icons"></i>
                            <div class="mdui-list-item-content">
                                友链
                            </div>
                            <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
                        </div>
                        <div class="mdui-collapse-item-body mdui-list">
                            <a href="//soxft.cn" class="mdui-list-item mdui-ripple ">XUSOFT开发团队</a>
                            <a href="//cxbsoft.top" class="mdui-list-item mdui-ripple ">CXBSOFT</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <br><br><br>
            <div class="beauty_mdui">
                <div class="mdui-card">
                    
                    <div class="mdui-card-content" id="pjax-change">
                        
                        <center><h2>登录</h2></center>
                        <br>
                        <div class="mdui-textfield mdui-textfield-floating-label">
                          <label class="mdui-textfield-label">用户名</label>
                          <input class="mdui-textfield-input" id="username" type="text"/>
                        </div>
                        <div class="mdui-textfield mdui-textfield-floating-label">
                          <label class="mdui-textfield-label">密码</label>
                          <input class="mdui-textfield-input" id="passwd" type="password"/>
                        </div>
                        <center><button class="mdui-btn mdui-ripple" id="login_thing">登录</button></center>
                    </div>
                    
                </div>
            </div>
        </div>
        
    </body>
    <script src="/node_modules/jquery/dist/jquery.js"></script>
    <script src="/node_modules/jquery-pjax/jquery.pjax.js"></script>
    <script src="/node_modules/nprogress/nprogress.js"></script>
    <script>
        $(document).on('pjax:start', function() { NProgress.start(); });
        $(document).on('pjax:end',   function() { NProgress.done();  });
        $("#login_thing").click(function(){
            var username = $("#username").val()
            var password = $("#passwd").val()
            console.log(username)
            console.log(password)
            $.pjax({
                url : "./login.php",
                type : "POST",
                data : { "username" : username , "password" : password ,"class" : <?php echo($class) ?> },
                container : "#pjax-change"
            })
        })
        $(document).on('pjax:complete',function(){  //无论pjax的结果如何 超时与否 都触发
            
            $.getScript("//cdnjs.loli.net/ajax/libs/mdui/0.4.3/js/mdui.min.js");

        });
        
    </script>
</html>
