<?php
header("Content-type: text/html; charset=utf-8");
header("Cache-Control: no-cache");
header("Pragma: no-cache");

/***********************************************************************
/*	＜総合文化展＞	xml_Chk_UserSsn.php
/*	
/*		概  要：判定：ユーザーセッション関連
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
/*					$sql_str		：SQL文
/*					$OBJ_Cnn		：Connection オブジェクト
/*					$OBJ_Rec		：Recordset  オブジェクト
/*					$OBJ_Row		：Array      オブジェクト
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
	$str_reg = "";
	$str_msg = "";
	$str_stt = "";
	$str_uid = "";
	$str_adm = "";
	$str_unm = "";
	$str_mod = "";
	//--
	$sql_str = "";
	$OBJ_Cnn = null;
	$OBJ_Rec = null;
	$OBJ_Row = null;
	//--
	$NowDate = date("Y-m-d");
	$NowTime = date("H:i:s");
	//+----------------------
	//+ オブジェクト生成

	//+----------------------
																		//* ＤＢ接続
																		
			Sub_DB_Cnn($OBJ_Cnn, $str_msg, $str_stt);


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
	if (isset($_SESSION[REGISTER_MODE])) {
		$str_reg = RTrim($_SESSION[REGISTER_MODE]);
	} else {
		$str_reg = "";
	}
	
	if (isset($_SESSION[DF_SSN_ADMIN])) {
		$str_adm = RTrim($_SESSION[DF_SSN_ADMIN]);
	} else {
		$str_adm = "";
	}
	//+----------------------
	//+ データ判定
	//+----------------------
	if ($str_msg == "") {
		if (Func_NoDataJudge($str_uid) == true) {
			$str_stt = "NG";
			$str_msg = "ログインされていません。";
		}
	}
	//********************************************************//
	//* メイン処理
	//********************************************************//
	if ($str_msg == "") {
		//+----------------------
		//+ 処理：利用者情報取得
		//+----------------------
		$sql_str = "Select *"
				.	" From `" . DF_SQL_ConnDBNm . "`.`m_user` KNS"
				.	" Where KNS.`UserID` = '" . mysqli_real_escape_string($OBJ_Cnn, $str_uid) . "'";
		$OBJ_Rec = mysqli_query($OBJ_Cnn,$sql_str);
		if ($OBJ_Rec == false) {
			$str_stt = "Err";
			$str_msg = "データ抽出に失敗しました。";
		} else {
			if (mysqli_num_rows($OBJ_Rec) < 1) {
				$str_stt = "NG";
				$str_msg = "ログインされていません。";
																		//* セッション初期化
				$str_uid = "";
				$str_unm = "";
				$str_mod = "";
				$str_adm = "";
			} else {
				$str_stt = "OK";
																		//* レコードセット参照
				$OBJ_Row = mysqli_fetch_assoc($OBJ_Rec);
				$str_uid = $OBJ_Row["UserID"];
				$str_unm = $OBJ_Row["UserName"];
				$str_mod = $OBJ_Row["UnionMember"];
				$str_adm = $OBJ_Row["Admin"];
			}
			if ($str_reg == 'REGISTER') {
				$_SESSION[REGISTER_MODE] = $str_reg;
				$str_stt = 'REGISTER';
			}
																		//* セッション格納
			$_SESSION[DF_SSN_LOGIN_ID] = $str_uid;
			$_SESSION[DF_SSN_LOGIN_NM] = $str_unm;
			$_SESSION[DF_SSN_LOGIN_MD] = $str_mod;
			$_SESSION[DF_SSN_ADMIN] = $str_adm;
		}
		mysqli_free_result($OBJ_Rec);
	}

	
	//+----------------------
	//+ オブジェクト解放
	//+----------------------
																		//* ＤＢ切断
	Sub_DB_Cut($OBJ_Cnn, $str_msg, $str_stt);
?>
<xml_UserSsnData>
	<reData status="<?php echo Func_SetEncDate($str_stt, "", "\n"); ?>" 
		message="<?php echo Func_SetEncDate($str_msg, "", "\n"); ?>" date="<?php echo $NowDate ?>" time="<?php echo $NowTime ?>">
		<uid><?php echo Func_SetEncDate($str_uid, "", "\n"); ?></uid>
		<unm><?php echo Func_SetEncDate($str_unm, "", "\n"); ?></unm>
		<mod><?php echo Func_SetEncDate($str_mod, "", "\n"); ?></mod>
		<adm><?php echo Func_SetEncDate($str_adm, "", "\n"); ?></adm>
	</reData>
	<reHtml></reHtml>
</xml_UserSsnData>
