<?php
header("Content-type: text/html; charset=utf-8");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
/***********************************************************************
 * /*    ＜総合文化展＞    htm_Set_NavForm.php
 * /*
 * /*        概  要：ナビメニュー関連
 * /*
 * /*        備  考：なし
 * /*
 * /*        Code By        2016/02/01    System Nicol Co.,Ltd    新規
 * /*
 * /*        Copyright (c) 2016 System Nicol Co.,Ltd All rights reserved.
 * /*---------------------------------------------------------------------*
 * /*    変数宣言：VB「Option Explicit」相当が無い為，ローカル変数を列挙。
 * /*    -------------------------------------------------------------------*
 * /*    ローカル変数：    $str_msg        ：エラー情報
 * /*                    $str_stt        ：エラー状態
 * /*                    $str_uid        ：ログインユーザID
 * /*                    $str_unm        ：ログインユーザ名
 * /*                    $str_mod        ：ログインモード
 * /*                    //--
 * /*                    $NowDate        ：日付
 * /*                    $NowTime        ：時刻
 * /**********************************************************************/
//セッション開始・再開
session_start();
//外部スクリプト読み込み
require_once "../com/require_set_env.php";
//+----------------------
//+ 初期値設定
//+----------------------
$str_msg = "";
$str_stt = "";
$str_uid = "";
$str_unm = "";
$str_mod = "";
//--
$NowDate = date("Y-m-d");
$NowTime = date("H:i:s");
//+----------------------
//+ セッション取得
//+----------------------
if (isset($_SESSION[DF_SSN_LOGIN_ID])) {
    $str_uid = RTrim($_SESSION[DF_SSN_LOGIN_ID]);
} else {
    $str_uid = "";
}
if (isset($_SESSION[DF_SSN_LOGIN_NM])) {
    $str_unm = RTrim($_SESSION[DF_SSN_LOGIN_NM]);
} else {
    $str_unm = "";
}
if (isset($_SESSION[DF_SSN_LOGIN_MD])) {
    $str_mod = RTrim($_SESSION[DF_SSN_LOGIN_MD]);
} else {
    $str_mod = "";
}
//+----------------------
//+ 出力処理
//+----------------------
?>
<xml_NavFormData>
    <reHtml>
        <!-- ******************TEST NAVBAR****************-->
        <script>
            function openNav() {
                //var navbar = document.getElementById("mySidenav");
                //navbar.style.width = "auto";
                //navbar.style.display="block";
            }

            function closeNav() {
                //var navbar = document.getElementById("mySidenav");
                //navbar.style.width = "0px";
                //navbar.style.display="none";
            }
            $(document).ready(function() {
                $("#openBtn").click(function(){
                    $("#mySidenav").css({"width": "250px"});
                });
                $("#closeBtn").click(function(){
                    $("#mySidenav").css({"width": "0px"});

                });
            });
        </script>


        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" id="closeBtn" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="javascript:void(0);"
               onClick="SET_PAGE(&#39;SET_DF&#39;, &#39;LS_I01&#39;)">&nbsp投票方法
            </a>


            <div>
                <button class="dropdown-btn">&nbspエキスパート部門
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-container">
                    <a href="javascript:void(0);"
                       onclick="SET_PAGE(&#39;SET_RI&#39;, &#39;LS_P01&#39;);">&nbsp絵画</a>
                    <a href="javascript:void(0);"
                       onclick="SET_PAGE(&#39;SET_RI&#39;, &#39;LS_P02&#39;);">&nbsp書道</a>
                    <a href="javascript:void(0);"
                       onclick="SET_PAGE(&#39;SET_RI&#39;, &#39;LS_P03&#39;);">&nbsp写真</a>
                    <a href="javascript:void(0);"
                       onclick="SET_PAGE(&#39;SET_RI&#39;, &#39;LS_P04&#39;);">&nbsp手芸・工芸</a>
                </div>
            </div>


            <div>
                <button class="dropdown-btn">&nbspエンジョイ部門
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-container">
                    <a href="javascript:void(0);"
                       onclick="SET_PAGE(&#39;SET_RI&#39;, &#39;LS_P01&#39;);">&nbsp写真</a>
                    <a href="javascript:void(0);"
                       onclick="SET_PAGE(&#39;SET_RI&#39;, &#39;LS_P02&#39;);">&nbsp絵画</a>
                    <a href="javascript:void(0);"
                       onclick="SET_PAGE(&#39;SET_RI&#39;, &#39;LS_P01&#39;);">&nbsp音楽</a>
                    <a href="javascript:void(0);"
                       onclick="SET_PAGE(&#39;SET_RI&#39;, &#39;LS_P01&#39;);">&nbsp動画</a>
                </div>
            </div>
<div>
    <button class="dropdown-btn">&nbspエンジョイ部門
        <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
        <a href="javascript:void(0);"
           onclick="SET_PAGE(&#39;SET_RI&#39;, &#39;LS_P01&#39;);">&nbsp写真</a>
        <a href="javascript:void(0);" class="an_anc"
           onclick="SET_PAGE(&#39;SET_RI&#39;, &#39;LS_P02&#39;);">&nbsp絵画</a>
        <a href="javascript:void(0);" class="an_anc"
           onclick="SET_PAGE(&#39;SET_RI&#39;, &#39;LS_P01&#39;);">&nbsp音楽</a>
        <a href="javascript:void(0);" class="an_anc"
           onclick="SET_PAGE(&#39;SET_RI&#39;, &#39;LS_P01&#39;);">&nbsp動画</a>
    </div>
</div>


            <a href="javascript:void(0);" class="an_anc"
               onclick="SET_PAGE(&#39;SET_DF&#39;, &#39;LS_R01&#39;);">投票ランキング</a>
        </div>
        <!-- ****************TEST NAVBAR END****************** -->
        <form name="F_NAV" method="post" autocomplete="off" accept-charset="utf-8">
            <span id="openBtn" style="font-size:30px;cursor:pointer" class="floatRight resButton" onclick="openNav()">&#9776;</span>

            <nav class="navbar navbar-default pt0 pb0">
                <ul class="navimenu" id="topNavBar">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    <li class="nv_tab top active">
                        <dl>
                            <dt class="nv_ttl"><a href="javascript:void(0);" class="an_anc"
                                                  onClick="SET_PAGE(&#39;SET_DF&#39;, &#39;LS_I01&#39;)">&nbsp;　投票方法　&nbsp;</a>
                            </dt>
                        </dl>
                    </li>
                    <li class="nv_tab ex">
                        <dl>
                            <dt class="nv_ttl"><a href="javascript:void(0);" class="an_tab">エキスパート部門</a></dt>
                            <dd class="nv_hid" style="display: none;">
                                <ul>
                                    <li class="nv_pan"><a href="javascript:void(0);" class="an_anc"
                                                          onclick="SET_PAGE(&#39;SET_RI&#39;, &#39;LS_P01&#39;);">絵画</a>
                                    </li>
                                    <li class="nv_pan"><a href="javascript:void(0);" class="an_anc"
                                                          onclick="SET_PAGE(&#39;SET_RI&#39;, &#39;LS_P02&#39;);">書道</a>
                                    </li>
                                    <li class="nv_pan"><a href="javascript:void(0);" class="an_anc"
                                                          onclick="SET_PAGE(&#39;SET_RI&#39;, &#39;LS_P03&#39;);">写真</a>
                                    </li>
                                    <li class="nv_pan"><a href="javascript:void(0);" class="an_anc"
                                                          onclick="SET_PAGE(&#39;SET_RI&#39;, &#39;LS_P04&#39;);">手芸・工芸</a>
                                    </li>
                                </ul>
                            </dd>
                        </dl>
                    </li>

                    <li class="nv_tab enj">
                        <dl>
                            <dt class="nv_ttl"><a href="javascript:void(0);" class="an_tab">エンジョイ部門</a></dt>
                            <dd class="nv_hid" style="display: none;">
                                <ul>
                                    <li class="nv_pan"><a href="javascript:void(0);" class="an_anc"
                                                          onclick="SET_PAGE(&#39;SET_RI&#39;, &#39;LS_P01&#39;);">写真</a>
                                    </li>
                                    <li class="nv_pan"><a href="javascript:void(0);" class="an_anc"
                                                          onclick="SET_PAGE(&#39;SET_RI&#39;, &#39;LS_P02&#39;);">絵画</a>
                                    </li>
                                    <li class="nv_pan"><a href="javascript:void(0);" class="an_anc"
                                                          onclick="SET_PAGE(&#39;SET_RI&#39;, &#39;LS_P01&#39;);">音楽</a>
                                    </li>
                                    <li class="nv_pan"><a href="javascript:void(0);" class="an_anc"
                                                          onclick="SET_PAGE(&#39;SET_RI&#39;, &#39;LS_P01&#39;);">動画</a>
                                    </li>
                                </ul>
                            </dd>
                        </dl>
                    </li>

                    <li class="nv_tab kids">
                        <dl>
                            <dt class="nv_ttl"><a href="javascript:void(0);" class="an_tab">キッズ部門</a></dt>
                            <dd class="nv_hid" style="display: none;">
                                <ul>
                                    <li class="nv_pan"><a href="javascript:void(0);" class="an_anc"
                                                          onclick="SET_PAGE(&#39;SET_RI&#39;, &#39;LS_P01&#39;);">絵</a>
                                    </li>
                                    <li class="nv_pan"><a href="javascript:void(0);" class="an_anc"
                                                          onclick="SET_PAGE(&#39;SET_RI&#39;, &#39;LS_P02&#39;);">書道</a>
                                    </li>
                                </ul>
                            </dd>
                        </dl>
                    </li>

                    <li class="nv_str mr10 bold"><span class="ml5 mr5">&nbsp;</span></li>
                    <li class="nv_tab rank">
                        <dl>
                            <dt class="nv_ttl"><a href="javascript:void(0);" class="an_anc"
                                                  onclick="SET_PAGE(&#39;SET_DF&#39;, &#39;LS_R01&#39;);">投票ランキング</a>
                            </dt>
                        </dl>
                    </li>
                </ul>
            </nav>
        </form>
        <script>
            /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
            var dropdown = document.getElementsByClassName("dropdown-btn");
            var i;

            for (i = 0; i < dropdown.length; i++) {
                dropdown[i].addEventListener("click", function () {
                    this.classList.toggle("active");
                    var dropdownContent = this.nextElementSibling;
                    if (dropdownContent.style.display === "block") {
                        dropdownContent.style.display = "none";
                    } else {
                        dropdownContent.style.display = "block";
                    }
                });
            }
        </script>
    </reHtml>
</xml_NavFormData>
