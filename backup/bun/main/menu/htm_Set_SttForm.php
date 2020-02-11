<?php
header("Content-type: text/html; charset=utf-8");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
/***********************************************************************
/*	＜総合文化展＞	htm_Set_SttForm.php
/*	
/*		概  要：ステータス関連
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
/*					$str_uid		：ログインユーザID
/*					$str_unm		：ログインユーザ名
/*					$str_mod		：ログインモード
/*					//--
/*					$NowDate		：日付
/*					$NowTime		：時刻
/**********************************************************************/
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
	$str_adm = "";
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
	if (isset($_SESSION[DF_SSN_ADMIN])) {
		$str_adm = RTrim($_SESSION[DF_SSN_ADMIN]);
	} else {
		$str_adm = "";
	}
	//+----------------------
	//+ 出力処理
	//+----------------------
?>
<xml_SttFormData>
	<reHtml>
		<form name="F_STT" method="post" autocomplete="off" accept-charset="utf-8">
			<div class="row float-right">
					<div id="LOG_GRP_OUT" class="">
						<input type="button" id="LOG_BTN_OUT" class="w80 h26" value="ログアウト" onClick="Click_LOGOUT();">
					</div>
					<?php if ($str_adm == 1) {
					echo '<div id="REG_GRP" class="">
						<input type="button" id="REG_BTN" class="w80 h26" value="REGISTER" onClick="Redirect_REG();">
					</div>';
					};?>
		
			</div>
		</form>
	</reHtml>
</xml_SttFormData>
