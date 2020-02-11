<?php
header("Content-type: text/html; charset=utf-8");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
/***********************************************************************
/*	＜総合文化展＞	require_set_env.php
/*	
/*		概  要：外部スクリプト：環境定義
/*
/*		備  考：なし
/*
/*		Code By		2016/02/01	System Nicol Co.,Ltd	新規
/*
/*		Copyright (c) 2016 System Nicol Co.,Ltd All rights reserved.
/*---------------------------------------------------------------------*
/*	外部目的：require文とinclude文の使いわけ
/*			・require文：主にPHP 側のコードとして処理させる。
/*			・include文：主にHTML側のパーツとして出力させる。
/*			-----------------------------------------------------------*
/*			・require_once("外部ファイル名");
/*			・include("外部ファイル名");
/**********************************************************************/

//〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓
//〓 サーバ変数宣言／定数宣言
//〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓
//+------------------------------
//+ $_SERVER["REMOTE_HOST"]	：クライアントのホスト名
//+ $_SERVER["REMOTE_ADDR"]	：クライアントのIPアドレス
//+ $_SERVER["SERVER_NAME"]	：サーバーのホスト名
//+ $_SERVER["LOCAL_ADDR"]	：サーバーのIPアドレス
//+ $_SERVER["SCRIPT_NAME"]	：スクリプトのパス
//+ $_SERVER["REQUEST_URI"]	：スクリプトのパス
//+ $_SERVER["PHP_SELF"]	：スクリプトのパス
//+ $_SERVER["URL"]			：スクリプトのパス
//+------------------------------
//+ foreach($_SERVER as $server_key => $server_val){
//+   echo "・" . $server_key . "：" . $server_val . "<br>\n";
//+ }
//+------------------------------
$C1_srv_rem_addr = rtrim($_SERVER["REMOTE_ADDR"]);
$C1_srv_srv_name = rtrim($_SERVER["SERVER_NAME"]);
//〓---------------〓
//〓 SQL定義値宣言
//〓---------------〓
$sys_env_typ = 0;																//★★★ 動作環境切替｛0：運用, 1：開発, 2：デモ, 3：その他｝ ★★★
//--
switch ($sys_env_typ){
	case 0:																		//■ 環境タイプ[0]：運用環境
		$C1_SYS_NameHead = "";													//* システム：タイトル用の冠文字列
		$C1_SYS_Splitter = "env0";											//* システム：環境別の識別管理キー｛代入値は任意。一意(ユニーク)を想定。｝
		$C1_SQL_ConnHost = "localhost";											//* システム：MySQL 接続サーバー名
		$C1_SQL_ConnUser = "root";											//* システム：MySQL 接続サーバー名
		// $C1_SQL_ConnPass = "FJ3kjc9tckjecth3";
		$C1_SQL_ConnPass = "Aa23456@789";						//* システム：MySQL 接続パスワード
		// $C1_SQL_ConnPass = "password";											//* ????:MySQL ???????
		$C1_SQL_ConnDBNm = "bun";											//* システム：MySQL 接続ＤＢ
		break;
	case 1:																		//■ 環境タイプ[1]：開発環境
		$C1_SYS_NameHead = "[????]";
		$C1_SYS_Splitter = "??????????";
		$C1_SQL_ConnHost = "MySQL ???????";
		$C1_SQL_ConnUser = "MySQL ???????";
		$C1_SQL_ConnPass = "MySQL ???????";
		$C1_SQL_ConnDBNm = "MySQL ??DB";
		break;
	default:																	//■ 環境タイプ[x]：その他環境
		$C1_SYS_NameHead = "[????]";
		$C1_SYS_Splitter = "xxxxxxxx";
		$C1_SQL_ConnHost = "xxxxxxxx";
		$C1_SQL_ConnUser = "xxxxxxxx";
		$C1_SQL_ConnPass = "xxxxxxxx";
		$C1_SQL_ConnDBNm = "xxxxxxxx";
		break;
}
define("DF_SQL_ConnHost",	$C1_SQL_ConnHost);
define("DF_SQL_ConnUser",	$C1_SQL_ConnUser);
define("DF_SQL_ConnPass",	$C1_SQL_ConnPass);
define("DF_SQL_ConnDBNm",	$C1_SQL_ConnDBNm);

//+------------------------------
//+ システム情報	DF_STR_×××
//+------------------------------
define("DF_STR_SYS_NAME",	"総合文化展-2016-" . $C1_SYS_NameHead);
define("DF_STR_SYS_TITL",	"富士通労組単一組織結成65周年事業～総合文化展2016～");
define("DF_EN_COPYRIGHT",	"Copyright (C) 2016 FUJITSU");
define("DF_EN_RECOMMEND",	"確認済み環境：(OS)Windows 7 (Browser)Internet Explorer 11, Mozilla Firefox");

//+------------------------------
//+ 設定情報		DF_XXX_×××
//+------------------------------
define("DF_PHO_IMG_PATH",	"./photos"	);										//* 格納：格納パス
define("DF_PHO_THU_FOLD",	"thumbnails");										//* 格納：サムネイル‐フォルダ名
define("DF_PHO_THU_HEAD",	"min-"		);										//* 格納：サムネイル‐冠文字列
define("DF_DTM_VOTE_STA",	"2016/06/20");										//* 期間：投票開始
define("DF_DTM_VOTE_END",	"2020/07/18");										//* 期間：投票終了

//+------------------------------
//+ セッション名	DF_SSN_×××
//+------------------------------
define("DF_SSN_LOGIN_ID",	$C1_SYS_Splitter . "_bun_login_id");				//* ログイン：従業員番号
define("DF_SSN_LOGIN_NM",	$C1_SYS_Splitter . "_bun_login_nm");				//* ログイン：氏名
define("DF_SSN_LOGIN_MD",	$C1_SYS_Splitter . "_bun_login_md");				//* ログイン：モード

//+------------------------------
//+ クッキー名		DF_CKS_×××
//+------------------------------
define("DF_CKS_xxxxxxxx",	$C1_SYS_Splitter . "");

//+------------------------------
//+ ウインドウ名	DF_WIN_×××
//+------------------------------
define("DF_WIN_xxxxxxxx",	$C1_SYS_Splitter . "");

//+------------------------------
//+ フレーム名		DF_FRM_×××
//+------------------------------
define("DF_FRM_xxxxxxxx",	$C1_SYS_Splitter . "");

//〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓
//〓 変数宣言
//〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓

//+------------------------------
//+ その他			C1_XXX_×××
//+------------------------------
$C1_xxx_xxxxxxxx = "";

//〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓
//〓 処理宣言
//〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓

//*******************************************************************
//* Sub_DB_Cnn()：ＤＢ接続処理
//*------------------------------------------------------------------
//*  引数   ：&$prm_db_cnn ＝ 参照渡し：MySQLリンクID
//*         ：&$prm_message＝ 参照渡し：エラー情報
//*         ：&$prm_status ＝ 参照渡し：エラー状態
//*  戻り値 ：なし
//*******************************************************************
function Sub_DB_Cnn(&$prm_db_cnn, &$prm_message, &$prm_status) {
	// MySQL接続
	if ($prm_db_cnn = mysqli_connect(DF_SQL_ConnHost, DF_SQL_ConnUser, DF_SQL_ConnPass)) {
		
		mysqli_set_charset('utf8', $prm_db_cnn);
		
		if (mysqli_select_db($prm_db_cnn, DF_SQL_ConnDBNm)) {
			//【接続完了】
		} else {
			$prm_status  = "Err";
			$prm_message = "aAAa??????????";
		}
	} else {
		$prm_status  = "Err";
		$prm_message = "No connection?????".mysqli_connect(DF_SQL_ConnHost, DF_SQL_ConnUser, DF_SQL_ConnPass);
	}
}
//*******************************************************************
//* Sub_DB_Cut()：ＤＢ切断処理
//*------------------------------------------------------------------
//*  引数   ：&$prm_db_cnn ＝ 参照渡し：MySQLリンクID
//*         ：&$prm_message＝ 参照渡し：エラー情報
//*         ：&$prm_status ＝ 参照渡し：エラー状態
//*  戻り値 ：なし
//*******************************************************************
function Sub_DB_Cut(&$prm_db_cnn, &$prm_message, &$prm_status) {
	//* MySQL切断
	if ($prm_db_cnn) {
		if (mysqli_close($prm_db_cnn)) {
			//【切断完了】
		} else {
			$prm_status  = "Err";
			$prm_message = "ＤＢ切断に失敗しました。";
		}
	}
}
//*******************************************************************
//* Sub_Con_Write()：文字列とタブ・改行を出力します。
//*------------------------------------------------------------------
//*  引数   ：$prm_indent ＝インデント
//*         ：$prm_string ＝入力文字列
//*  戻り値 ：なし
//*******************************************************************
function Sub_Con_Write($prm_indent, $prm_string) {
	echo str_repeat("\t", $prm_indent) . $prm_string . "\n";
}
//*******************************************************************
//* Func_Con_Write()：文字列とタブ・改行を出力します。
//*------------------------------------------------------------------
//*  引数   ：$prm_indent ＝インデント
//*         ：$prm_string ＝入力文字列
//*  戻り値 ：出力文字列(タブ・改行を付与)
//*******************************************************************
function Func_Con_Write($prm_indent, $prm_string) {
	return str_repeat("\t", $prm_indent) . $prm_string . "\n";
}
//*******************************************************************
//* Func_NoDataJudge()：データ存在チェック
//*------------------------------------------------------------------
//*  引数   ：$prm_string ＝入力文字列
//*  戻り値 ：boolean｛true：データ無，false：データ有｝
//*******************************************************************
function Func_NoDataJudge($prm_string) {
	$rtn_value = true;
	//+----------------------
	//+ 空文字列か否かを判定
	//+----------------------
	if (is_null($prm_string) == true) {
		$rtn_value = true;
	} else {
		if (rtrim($prm_string) == "") {
			$rtn_value = true;
		} else {
			$rtn_value = false;
		}
	}
	//+----------------------
	//+ 戻り値
	//+----------------------
	return $rtn_value;
}
//*******************************************************************
//* Func_SetEncDate()：表示データをエンコードします。
//*------------------------------------------------------------------
//*  引数   ：$prm_string  ＝入力文字列
//*         ：$prm_empty   ＝代替文字列(エンプティ)
//*         ：$prm_newline ＝代替文字列(改行)
//*  戻り値 ：出力文字列(エンコード済み)
//*******************************************************************
function Func_SetEncDate($prm_string, $prm_empty, $prm_newline) {
	$rtn_value = "";
	//+----------------------
	//+ エンコード処理
	//+----------------------
	if (Func_NoDataJudge($prm_string) == true) {
		$rtn_value = $prm_empty;
	} else {
		//+------------------
		//+ htmlエンコード
		//+------------------
		$rtn_value = htmlentities($prm_string, ENT_QUOTES, "UTF-8");
		
		$rtn_value = str_replace(array("\r\n", "\r", "\n"), $prm_newline, $rtn_value);
	}
	//+----------------------
	//+ 戻り値
	//+----------------------
	
	return $rtn_value;
}


?>