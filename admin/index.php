<?php
    
    class admin_usr{
        function __construct(){
            $this -> db = mysqli_connect("数据库地址","数据库用户名","数据库密码","数据库名");
        }
        function get_info_by_username($username){
            $this -> command = "select * from `teacher_usr` where `username`='$username'";
            $this -> result = mysqli_fetch_all(mysqli_query($this -> db,$this -> command));
            if(empty($this)){
                return "No_user";
            }
            else{
                return $this -> result;
            }
        }
    }
    session_start();
    $usr_info = new admin_usr;
    $username = $_SESSION['username'];
    $info_usr = $usr_info -> get_info_by_username($username);
    $name = $info_usr[0][4];
    $sub = $info_usr[0][3];
    $_SESSION['sub'] = $sub;
    $_SESSION['name'] = $name;
    $title = $_SESSION['title'];
    $class = $_SESSION['class'];

?>



<html>
    <head>
        <title><?php echo($title) ?></title>
        <script data-pjax src="//cdnjs.loli.net/ajax/libs/mdui/0.4.3/js/mdui.min.js"></script>

        <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    	<link rel="stylesheet" href="//cdnjs.loli.net/ajax/libs/mdui/0.4.3/css/mdui.min.css">
    	<link rel="stylesheet" href="/node_modules/nprogress/nprogress.css">
    	<link rel="stylesheet" href="/all-a.css">
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
                        <a href="javascript:void(0)" onclick="go_index()" class="mdui-list-item">
                            <i class="mdui-list-item-icon mdui-icon material-icons">home</i>
                            <div class="mdui-list-item-content">
                                主页
                            </div>
                        </a>
                        <a href="javascript:void(0)" onclick="mg_check()" class="mdui-list-item">
                            <i class="mdui-list-item-icon mdui-icon material-icons"></i>
                            <div class="mdui-list-item-content">
                                管理check
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
        <div id="pjax-body">
            <br><br>
            <center>
                <h2>你好,<?php echo($name) ?></h2>
            </center>
        </div>
        <script src="/node_modules/jquery/dist/jquery.js"></script>
        <script src="/node_modules/jquery-pjax/jquery.pjax.js"></script>
        <script src="/node_modules/nprogress/nprogress.js"></script>
        <script>
        window.onbeforeunload = function(){
            return 0;
        }
            document.onkeydown = function(){
                if ( event.keyCode==116)
                {
                    event.keyCode = 0;
                    event.cancelBubble = true;
                    return false;
                }
            }
            //禁止右键弹出菜单
            document.oncontextmenu = function()
            {
                return false;
            }
        </script>
        <script>
            $(document).on('pjax:start', function() { NProgress.start(); });
            $(document).on('pjax:end',   function() { NProgress.done();  });
            
            
            function mg_check(){
                $.pjax({
                    url : "/admin/pages/mg_check.php",
                    container : "#pjax-body"
                })
            }
            function go_index(){
                
                $.pjax({
                    url : "/admin/pages/index.php",
                    type : "POST",
                    data : {},
                    container : "#pjax-body"
                })
            }
        </script>
    </body>
</html>
