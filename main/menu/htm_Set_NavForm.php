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
        <script>
            function myFunction() {
                var x = document.getElementById("topNavBar");
                if (x.className === "navimenu") {
                    x.className += " responsive";
                } else {
                    x.className = "topNavBar";
                }
            }
        </script>
        <form name="F_NAV" method="post" autocomplete="off" accept-charset="utf-8">
         <nav class="navbar navbar-default pt0">
                <ul class="navimenu" id="topNavBar">
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

    </reHtml>
</xml_NavFormData>
