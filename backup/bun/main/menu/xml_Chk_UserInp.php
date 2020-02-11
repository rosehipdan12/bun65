<?php
header("Content-type: text/html; charset=utf-8");
header("Cache-Control: no-cache");
header("Pragma: no-cache");

/***********************************************************************
/*	＜総合文化展＞	xml_Chk_UserInp.php
/*	
/*		概  要：判定：ユーザーフォーム関連
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
/*					$str_flg		：ログイン操作フラグ｛login，logout｝
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
	$str_msg = "";
	$str_stt = "";
	$str_upw = "";
	$str_unm = "";
	$str_mod = "";
	$str_flg = "";

	$str_uid = "";
	//--
	$sql_str = "";
	$OBJ_Cnn = null;
	$OBJ_Rec = null;
	$OBJ_Row = null;
	//--
	$tmp_len = 0;
	$exi_flg = -1;
	//--
	$NowDate = date("Y-m-d");
	$NowTime = date("H:i:s");
	//+----------------------
	//+ オブジェクト生成
	//+----------------------
																		//* ＤＢ接続

	Sub_DB_Cnn($OBJ_Cnn, $str_msg, $str_stt);
	//+----------------------
	//+ フォーム取得｛構文：filter_input(int $type, string $variable_name [, int $filter = FILTER_DEFAULT [, mixed $options ]] )｝
	//+----------------------
	$str_uid = RTrim((string)filter_input(INPUT_POST, "PRM_UID"));
	$str_upw = RTrim((string)filter_input(INPUT_POST, "PRM_UPW"));
	$str_mod = RTrim((string)filter_input(INPUT_POST, "PRM_MOD"));
	$str_flg = RTrim((string)filter_input(INPUT_POST, "PRM_FLG"));
	
	//+----------------------
	//+ データ判定
	//+----------------------
	if ($str_msg == "" && $str_flg == "login") {
																		//* 判定：従業員番号(有無)
		if (Func_NoDataJudge($str_uid) == true) {
			$str_stt = "NG";
			$str_msg = "従業員番号を入力してください。";
		} else {
																				//* 判定：従業員番号(桁数)
			$tmp_len = strlen(mb_convert_encoding($str_uid, "SJIS", "UTF-8"));
			if($tmp_len > 20){
				$str_stt = "NG";
				$str_msg = "従業員番号は 20バイト以内で入力してください。[" . $tmp_len . "バイト]";
			} else {
																		//* 判定：従業員番号(半角英数字)
				if (preg_match("/^[a-zA-Z0-9]+$/", $str_uid) == false) {
					$str_stt = "NG";
					$str_msg = "従業員番号は半角英数字で入力してください。";
				}
			}
		}
	}

	// if ($str_msg == "" && $str_flg == "login") {
	// 																	//* 判定：判定(有無)
	// 	if (Func_NoDataJudge($str_uid) == true) {
	// 		//** 判定せず **//
	// 	} else {
	// 																	//* 判定：氏名(桁数)
	// 		$tmp_len = strlen(mb_convert_encoding($str_uid, "SJIS", "UTF-8"));
	// 		return;
	// 		if(strlen($str_uid) > 50){
	// 			$str_stt = "NG";
	// 			$str_msg = "氏名は 50バイト以内で入力してください。[" . $tmp_len . "バイト]";
	// 		}
	// 	}
	// }

	if ($str_msg == "" && $str_flg == "login") {
																		//* 判定：組合員モード(数値)
		if ($str_mod != "0" && $str_mod != "1") {
			$str_stt = "NG";
			$str_msg = "「組合員」もしくは「幹部社員・派遣社員等」を選択してください。";
		}
	}
	//********************************************************//
	//* メイン処理「ログイン」
	//********************************************************//
	if ($str_msg == "" && $str_flg == "login") {
		//+----------------------
		//+ 処理：利用者情報取得
		//+----------------------

		$sql_str = "Select *"
				.	" From `" . DF_SQL_ConnDBNm . "`.`m_user` KNS"
				.	" Where KNS.`UserID` = '" . mysqli_real_escape_string($OBJ_Cnn,$str_uid) . "'";
		$OBJ_Rec = mysqli_query($OBJ_Cnn, $sql_str);
		
		if ($OBJ_Rec == false) {
			$str_stt = "Err";
			$str_msg = "データ抽出に失敗しました。".$sql_str;
		} else {
			if (mysqli_num_rows($OBJ_Rec) < 1) {
				$exi_flg = 1;
			} else {
				$OBJ_Row = mysqli_fetch_assoc($OBJ_Rec);
				$str_upw_db = $OBJ_Row["Password"];
				$str_unm = $OBJ_Row["UserName"];
				$md5Str = md5($str_upw);
				if (strcmp($md5Str, $str_upw_db) == 0) {
					$exi_flg = 0;
				} else {
					$exi_flg = 1;
				}
				
			}
		}

		mysqli_free_result($OBJ_Rec);
		//+----------------------
		//+ 利用者情報追加
		//+----------------------
		if ($str_msg == "" && $exi_flg == 1) {
			// $sql_str = "Insert Into `" . DF_SQL_ConnDBNm . "`.`m_user`"
			// 		.	" Select"
			// 		.		" '" . mysqli_real_escape_string($OBJ_Cnn,$str_uid) . "'"	. " As `UserID`"		. ","
			// 		.		" '" . mysqli_real_escape_string($OBJ_Cnn,$str_unm) . "'"	. " As `UserName`"		. ","
			// 		.		" '" . mysqli_real_escape_string($OBJ_Cnn,$str_mod) . "'"	. " As `UnionMember`"	. ","
			// 		.		" '0'"											. " As `Admin`"			. ","
			// 		.		" Now()"										. " As `LastUpdate`"	. " ";
			// $OBJ_Rec = mysqli_query($OBJ_Cnn, $sql_str);
			// if ($OBJ_Rec == false) {
				$str_stt = "Err";
				$str_msg = "利用者情報取得に失敗しました。";
			// } else {
			// 	$str_stt = "OK";
			// }
		}
		//+----------------------
		//+ 利用者情報更新
		//+----------------------
		// if ($str_msg == "" && $exi_flg == 1) {
		// 	$sql_str = "Update `" . DF_SQL_ConnDBNm . "`.`m_user`"
		// 			.	" Set"
		// 			.		" `UserName`"		. " = '" . mysqli_real_escape_string($OBJ_Cnn,$str_unm) . "'"	. ","
		// 			.		" `UnionMember`"	. " = '" . mysqli_real_escape_string($OBJ_Cnn,$str_mod) . "'"	. ","
		// 			.		" `LastUpdate`"		. " = Now()"										. " "
		// 			.	" Where `UserID` = '" . mysqli_real_escape_string($OBJ_Cnn,$str_uid) . "'";
		// 	$OBJ_Rec = mysqli_query($OBJ_Cnn, $sql_str);
		// 	if ($OBJ_Rec == false) {
		// 		$str_stt = "Err";
		// 		$str_msg = "利用者情報取得に失敗しました。". $sql_str;
		// 	} else {
		// 		$str_stt = "OK";
		// 	}
		// }
																		//* セッション格納
		if ($str_msg == "") {
			$_SESSION[DF_SSN_LOGIN_ID] = $str_uid;
			$_SESSION[DF_SSN_LOGIN_NM] = $str_unm;
			$_SESSION[DF_SSN_LOGIN_MD] = $str_mod;
		}
	}
	//********************************************************//
	//* メイン処理「ログアウト」
	//********************************************************//
	if ($str_msg == "" && $str_flg == "logout") {
		$str_stt = "OK";
																		//* 初期化
		$str_uid = "";
		$str_unm = "";
		$str_mod = "";
																		//* セッション格納
		$_SESSION[DF_SSN_LOGIN_ID] = $str_uid;
		$_SESSION[DF_SSN_LOGIN_NM] = $str_unm;
		$_SESSION[DF_SSN_LOGIN_MD] = $str_mod;
	}

	if ($str_msg == "" && $str_flg == "register") {
		$str_stt = "REGISTER";
		$_SESSION[REGISTER_MODE] = "REGISTER";
	} else {
		$_SESSION[REGISTER_MODE] = "NO";
	}
	//+----------------------
	//+ オブジェクト解放
	//+----------------------
																		//* ＤＢ切断
	Sub_DB_Cut($OBJ_Cnn, $str_msg, $str_stt);
	//+----------------------
	//+ 出力処理
	//+----------------------
?>
<xml_UserInpData>
	<reData status="<?php echo Func_SetEncDate($str_stt, "", "\n"); ?>" message="<?php echo Func_SetEncDate($str_msg, "", "\n"); ?>" date="<?php echo $NowDate ?>" time="<?php echo $NowTime ?>">
		<uid><?php echo Func_SetEncDate($str_uid, "", "\n"); ?></uid>
		<unm><?php echo Func_SetEncDate($str_unm, "", "\n"); ?></unm>
		<upw><?php echo Func_SetEncDate($str_upw, "", "\n"); ?></upw>
		<mod><?php echo Func_SetEncDate($str_mod, "", "\n"); ?></mod>
	</reData>
	<reHtml></reHtml>
</xml_UserInpData>
