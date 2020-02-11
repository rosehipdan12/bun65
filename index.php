<?php
header("Content-type: text/html; charset=utf-8");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
/***********************************************************************
/*	＜総合文化展＞	index.php
/*	
/*		概  要：システムＴＯＰページ
/*
/*		備  考：なし
/*
/*		Code By		2016/02/01	System Nicol Co.,Ltd	新規
/*
/*		Copyright (c) 2016 System Nicol Co.,Ltd All rights reserved.
/*---------------------------------------------------------------------*
/*	変数宣言：VB「Option Explicit」相当が無い為，ローカル変数を列挙。
/*	-------------------------------------------------------------------*
/*	ローカル変数：	$str_msg		：エラー情報
/*					$str_stt		：エラー状態
/*					//--
/*					$NowDate		：日付
/*					$NowTime		：時刻
/**********************************************************************/
	//セッション開始・再開
    ini_set("session.cookie_httponly", 1);
	session_start();
	//外部スクリプト読み込み
	require_once "./main/com/require_set_env.php";
	//+----------------------
	//+ 初期値設定
	//+----------------------
	$str_msg = "";
	$str_stt = "";
    $str_uid = "";
    if (isset($_SESSION[DF_SSN_LOGIN_ID])) {
        $str_uid = RTrim($_SESSION[DF_SSN_LOGIN_ID]);
    } else {
        $str_uid = "";
    }
	//--
	$NowDate = date("Y-m-d");
	$NowTime = date("H:i:s");
	//+----------------------
	//+ 出力処理
	//+----------------------
	

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html lang="ja">
<head>
<meta charset="utf-8">
<meta Http-Equiv="Content-Type"        Content="text/html; charset=utf-8">
<meta Http-Equiv="Content-Style-Type"  Content="text/css">
<meta Http-Equiv="Content-Script-Type" Content="text/javascript">
<meta Http-Equiv="X-UA-Compatible"     Content="IE=EmulateIE9">
<meta Http-Equiv="Pragma"              Content="no-cache">
<meta Http-Equiv="Cache-Control"       Content="no-cache">
<meta Http-Equiv="Expires"             Content="0">
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title><?php echo Func_SetEncDate(DF_STR_SYS_NAME, "&nbsp;", "&nbsp;"); ?></title>
<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">-->
<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">-->
<!--  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/v4-shims.css">-->

<link rel="stylesheet" type="text/css" charset="utf-8" href="./css/prettyPhoto.css" media="screen" />
<!--<link rel="stylesheet" type="text/css" charset="utf-8" href="./css/mn_parts.css" />-->
<!--<link rel="stylesheet" type="text/css" charset="utf-8" href="./css/mn_fixed.css" />-->
<!--<link rel="stylesheet" type="text/css" charset="utf-8" href="./css/mn_style.css" />-->

<link rel="stylesheet" type="text/css" charset="utf-8" href="./files/mn_parts.css" />
<link rel="stylesheet" type="text/css" charset="utf-8" href="./files/mn_fixed.css" />
<link rel="stylesheet" type="text/css" charset="utf-8" href="./files/mn_style.css" />


<!-- VIDEOJS-->
  <link href="https://vjs.zencdn.net/7.6.6/video-js.css" rel="stylesheet" />


<style type="text/css">
    input[type=password] {
        width:208px;
        height: 22px;
    }
    input[type=text] {
        /*width:210px;*/
    }
</style>
<noscript>JavaScriptがサポートされていません。</noscript>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://vjs.zencdn.net/7.6.6/video.js"></script>

    <script type="text/javascript" charset="utf-8" src="./js/jquery.prettyPhoto.js"></script>
    <script type="text/javascript" charset="utf-8" src="./js/mn_com_script.js"></script>
    <script type="text/javascript" charset="utf-8" src="./js/mn_set_menu.js"></script>
    <script type="text/javascript" charset="utf-8" src="./js/mn_set_page.js"></script>


<!--    <script type="text/javascript" charset="utf-8" src="./files/mn_com_script.js"></script>-->
<!--    <script type="text/javascript" charset="utf-8" src="./files/mn_set_menu.js"></script>-->
<!--    <script type="text/javascript" charset="utf-8" src="./files/mn_set_page.js"></script>-->

    <script type="text/javascript" charset="utf-8" src="./js/video-player.js"></script>


    <!-- VIDEOJS-->
    <script type="text/javascript" charset="utf-8">


        <!--
        $(document).ready( function() { ON_LOAD(); } );
        /*******************************************************
         * ON_LOAD：ロード処理
         *******************************************************/
        function ON_LOAD() {
            if (document.F999.MSG.value != "") {
                alert(document.F999.MSG.value);
            } else {
                SET_MENU();
            }
            return false;
        }

        //-->
    </script>
</head>

<body class="Fixed_body">
<!-- ========================================================== -->
<!-- Head_Area：Header											-->
<!-- ========================================================== -->
<div id="Head_Area" class="Fixed_Head">
	<div id="headstatBground">
		<div class="headstat pl20 pr20">
			<p></p>
		</div>
	</div>
	<div id="headmainBground">
		<div class="headmain pl20 pr20" >
			<h1>
				<a href="index.php" title="<?php echo Func_SetEncDate(DF_STR_SYS_NAME, "&nbsp;", "&nbsp;"); ?>"><?php echo Func_SetEncDate(DF_STR_SYS_TITL, "&nbsp;", "<br>"); ?></a>
			</h1>
		</div>
<!--        <div class="headevent">-->
<!--            全富士通労働組合連合会結成 50周年記念行事<br>-->
<!--            富士通労働組合単一組織結成 70周年記念事業-->
<!--        </div>-->
<!--        --><?php //if ($str_uid != "") {
//            echo '<div id="LOG_GRP_OUT" class="floatRight">
//            <input type="button" id="LOG_BTN_OUT" class="w80 h26" value="ログアウト" onClick="Click_LOGOUT();">
//        </div>';
//        };?>
	</div>
	<div id="headnaviBground" >
		<div class="headnavi pl20 pr20 " >
			<p></p>
		</div>
	</div>
    <div id="headmenuBground">
        <div class="headmenu pl20 pr20">
        </div>
    </div>
</div><!-- /Header -->

<!-- ========================================================== -->
<!-- Cont_Area：Contents										-->
<!-- ========================================================== -->
<div id="Cont_Area" class="Fixed_Cont"><a name="TOP"></a>


	<div id="contmainBground">
		<div class="contmain pl10 pr10">
			<div id="contpostDrawing"></div>
		</div>
        <div class="event">
            <p>全富士通労働組合連合会結成 50周年記念行事</p>
            <p>富士通労働組合単一組織結成 70周年記念事業</p>
        </div>
	</div>
</div><!-- /Contents -->

<!-- ========================================================== -->
<!-- Foot_Area：Footer											-->
<!-- ========================================================== -->
<div id="Foot_Area" class="Fixed_Foot">
	<div id="footmainBground">
		<div class="footmain pl20 pr20 clearfix">
			<p id="footmainLeft" class="floatLeft">

				<?php echo Func_SetEncDate(DF_EN_COPYRIGHT, "<br>", "&nbsp;"); ?>
				
			</p>
<!--			<p id="footmainSpec" class="floatLeft">-->
<!--				--><?php //echo Func_SetEncDate(DF_EN_RECOMMEND, "<br>", "&nbsp;"); ?>
<!--			</p>-->
			<p id="footmainRight" class="floatRight">
				<a href="#TOP"><img src="./files/tri_U_Red.png" height="12" width="12" alt="矢印">先頭へ戻る</a>
			</p>
		</div>
	</div>
</div><!-- /Footer -->
<form name="F999" method="post" autocomplete="off" accept-charset="utf-8">
	<input type="hidden" name="MSG" id="I_MSG" value="<?php echo Func_SetEncDate($str_msg, "", "\n"); ?>">
</form>



</body>

</html>
