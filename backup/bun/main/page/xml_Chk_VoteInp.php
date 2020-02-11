<?php
header("Content-type: text/html; charset=utf-8");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
/***********************************************************************
/*	＜総合文化展＞	xml_Chk_VoteInp.php
/*	
/*		概  要：判定：投票フォーム関連
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
/*					$sys_ini		：区分コード／部門コード／ページパス
/*					$dsp_ini		：作品部門／作品テーマ／作品種類／作品サイズ
/*					//--
/*					$sql_str		：SQL文
/*					$OBJ_Cnn		：Connection オブジェクト
/*					$OBJ_Rec		：Recordset  オブジェクト
/*					$OBJ_Row		：Array      オブジェクト
/*					//--
/*					$arr_vot		：投票配列
/*					$vot_val		：投票ROWID／処理タイプ
/*					$str_htm		：html出力用変数
/*					//--
/*					$NowDate		：日付
/*					$NowTime		：時刻
/**********************************************************************/
	//セッション開始・再開
	session_start();
	//外部スクリプト読み込み
	require_once "../com/require_set_env.php";
	require_once "./page_require_sub.php";
	//+----------------------
	//+ 初期値設定
	//+----------------------
	$str_msg = "";
	$str_stt = "";
	$str_uid = "";
	$str_unm = "";
	$str_mod = "";
	//--
	$sys_ini = null;
	$dsp_ini = null;
	//--
	$sql_str = "";
	$OBJ_Cnn = null;
	$OBJ_Rec = null;
	$OBJ_Row = null;
	//--
	$arr_vot = null;
	$vot_val = null;
	$str_htm = "";
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
	//+----------------------
	//+ フォーム取得｛構文：filter_input(int $type, string $variable_name [, int $filter = FILTER_DEFAULT [, mixed $options ]] )｝
	//+----------------------
	$sys_ini["CD1"] = RTrim((string)filter_input(INPUT_POST, "PRM_CD1"));
	$sys_ini["CD2"] = RTrim((string)filter_input(INPUT_POST, "PRM_CD2"));
	$sys_ini["SRC"] = RTrim((string)filter_input(INPUT_POST, "PRM_SRC"));
																				//* パラメタ：投票用
	$vot_val["VOT"] = RTrim((string)filter_input(INPUT_POST, "VOT_VOT"));
	$vot_val["TYP"] = RTrim((string)filter_input(INPUT_POST, "VOT_TYP"));
	//+----------------------
	//+ データ判定
	//+----------------------
	if (Func_NoDataJudge($str_msg) == true) {
		if (Func_NoDataJudge($str_uid) == true) {
			$str_stt = "NG";
			$str_msg = "ログインされていません。";
		}
	}
	if (Func_NoDataJudge($str_msg) == true) {
		$dsp_ini = Func_Load_sys_ini($sys_ini);
		//--
		if ($dsp_ini == null) {
			$str_stt = "NG";
			$str_msg = "パラメタ取得に失敗しました。";
		}
	}
	if (Func_NoDataJudge($str_msg) == true) {

		if (Func_NoDataJudge($vot_val["VOT"]) == true || Func_NoDataJudge($vot_val["TYP"]) == true) {
			$str_stt = "NG";
			$str_msg = "投票状態取得に失敗しました。";
		}
	}
	//+----------------------
	//+ 期限判定
	//+----------------------
	if (Func_NoDataJudge($str_msg) == true) {
		if (((strtotime($NowDate) - strtotime(DF_DTM_VOTE_STA)) / (3600 * 24)) < 0) {
																				//* 範囲前
			$str_stt = "NG";
			$str_msg = "投票期間外のため、" . (($vot_val["TYP"] == "DEL") ? "投票を取消" : "作品に投票") . "できません。\n\n◆投票受付は開始されていません◆\n（受付期間 ： " . DF_DTM_VOTE_STA . " ～ " . DF_DTM_VOTE_END . "）";
		} else {
			if (((strtotime($NowDate) - strtotime(DF_DTM_VOTE_END)) / (3600 * 24)) > 0) {
																				//* 範囲後
				$str_stt = "NG";
				$str_msg = "投票期間外のため、" . (($vot_val["TYP"] == "DEL") ? "投票を取消" : "作品に投票") . "できません。\n\n◆受付は終了致しました。◆\n（受付期間 ： " . DF_DTM_VOTE_STA . " ～ " . DF_DTM_VOTE_END . "）";
			} else {
																				//* 範囲内
			}
		}
	}
	//********************************************************//
	//* メイン処理
	//********************************************************//
	//+----------------------
	//+ 投票処理／削除処理
	//+----------------------
	if (Func_NoDataJudge($str_msg) == true) {
		
		switch ($vot_val["TYP"]) {
			//+----------------------
			//+ 処理：投票削除
			//+----------------------
			case "DEL":
				$sql_str = "Delete A From `" . DF_SQL_ConnDBNm . "`.`t_vote` A"
						.	" Where A.`UserID` = '" . mysql_real_escape_string($str_uid) . "'"
						.		$dsp_ini["WHER"];
				$OBJ_Rec = mysql_query($sql_str, $OBJ_Cnn);
				if ($OBJ_Rec == false) {
					$str_stt = "Err";
					$str_msg = "投票データ削除に失敗しました。";
				} else {
					$str_stt = "OK";
				}
				break;
			//+----------------------
			//+ 処理：投票登録
			//+----------------------
			case "INS":
				$sql_str = "Delete A From `" . DF_SQL_ConnDBNm . "`.`t_vote` A"
						.	" Where A.`UserID` = '" . mysql_real_escape_string($str_uid) . "'"
						.		$dsp_ini["WHER"];
				$OBJ_Rec = mysql_query($sql_str, $OBJ_Cnn);
				if ($OBJ_Rec == false) {
					$str_stt = "Err";
					$str_msg = "投票データ削除に失敗しました。";
				} else {
					$sql_str = "Insert Into `" . DF_SQL_ConnDBNm . "`.`t_vote`"
							.	" Select"
							.			" A.`E_ROWID`"									. " As `E_ROWID`"		. ","
							.			" A.`E_KBN_CODE`"								. " As `E_KBN_CODE`"	. ","
							.			" A.`E_BM_CODE`"								. " As `E_BM_CODE`"		. ","
							.			" '" . mysql_real_escape_string($str_uid) . "'"	. " As `UserID`"		. ","
							.			" '0'"											. " As `VoteFlg`"		. ","
							.			" Now()"										. " As `VoteDate`"		. " "
							.		" From `" . DF_SQL_ConnDBNm . "`.`t_entryinfo` A"
							.		" Where A.`E_INV_FLG` = '0'" . $dsp_ini["WHER"]
							.			" and A.`E_ROWID` = '" . mysql_real_escape_string($vot_val["VOT"]) . "'";
					$OBJ_Rec = mysql_query($sql_str, $OBJ_Cnn);
					if ($OBJ_Rec == false) {
						$str_stt = "Err";
						$str_msg = "投票データ登録に失敗しました。";
					} else {
						$str_stt = "OK";
					}
				}
				break;
		}
	}
	//+----------------------
	//+ 作品プレビュー処理
	//+----------------------
	if (Func_NoDataJudge($str_msg) == true) {
		$sql_str = "Select"
				.		" A.*"
				.	" From `" . DF_SQL_ConnDBNm . "`.`t_entryinfo` A"
				.		" Inner Join `" . DF_SQL_ConnDBNm . "`.`t_vote` B"
				.			" On A.`E_ROWID` = B.`E_ROWID`"
				.			" and B.`UserID` = '" . mysql_real_escape_string($str_uid) . "'"
				.	" Where A.`E_INV_FLG` = '0'" . $dsp_ini["WHER"];
		$OBJ_Rec = mysql_query($sql_str, $OBJ_Cnn);
		if ($OBJ_Rec == false) {
			$str_stt = "Err";
			$str_msg = "作品プレビュー抽出に失敗しました。";
		} else {
			if (mysql_num_rows($OBJ_Rec) > 0) {
				$OBJ_Row = mysql_fetch_assoc($OBJ_Rec);
				//+----------------------
				//+ 各種情報を配列格納する
				//+----------------------
				$arr_vot["kanrino"] = $OBJ_Row["E_ROWID"];						//* 作品ID(自動採番)
				$arr_vot["ent_cd1"] = $OBJ_Row["E_KBN_CODE"];					//* 区分
				$arr_vot["ent_cd2"] = $OBJ_Row["E_BM_CODE"];					//* 部門
				$arr_vot["ent_fph"] = $OBJ_Row["E_FILE_PATH"];					//* 作品：ファイルパス名
				$arr_vot["ent_fnm"] = $OBJ_Row["E_FILE_NAME"];					//* 作品：ファイル名
				$arr_vot["ent_pem"] = $OBJ_Row["E_TANKA_INFO"];					//* 作品：俳句・短歌
				$arr_vot["ent_cmt"] = $OBJ_Row["E_COMMENT"];					//* 作品：コメント
				$arr_vot["ent_ttl"] = $OBJ_Row["E_TITLE"];						//* 作品：タイトル
				//--
				$str_htm = Func_Load_Drawing(0, "GrpPreview", $arr_vot, $dsp_ini["STAT"]);
			}
		}
		mysql_free_result($OBJ_Rec);
	}
	//+----------------------
	//+ オブジェクト解放
	//+----------------------
																		//* ＤＢ切断
	Sub_DB_Cut($OBJ_Cnn, $str_msg, $str_stt);
?>
<xml_VoteInpData>
	<reData status="<?php echo Func_SetEncDate($str_stt, "", "\n"); ?>" message="<?php echo Func_SetEncDate($str_msg, "", "\n"); ?>" date="<?php echo $NowDate ?>" time="<?php echo $NowTime ?>">
		<uid><?php echo Func_SetEncDate($str_uid, "", "\n"); ?></uid>
		<unm><?php echo Func_SetEncDate($str_unm, "", "\n"); ?></unm>
		<mod><?php echo Func_SetEncDate($str_mod, "", "\n"); ?></mod>
		<cd1><?php echo Func_SetEncDate($sys_ini["CD1"], "", "\n"); ?></cd1>
		<cd2><?php echo Func_SetEncDate($sys_ini["CD2"], "", "\n"); ?></cd2>
		<src><?php echo Func_SetEncDate($sys_ini["SRC"], "", "\n"); ?></src>
		<rid><?php echo Func_SetEncDate($vot_val["VOT"], "", "\n"); ?></rid>
		<typ><?php echo Func_SetEncDate($vot_val["TYP"], "", "\n"); ?></typ>
	</reData>
	<reHtml><?php echo $str_htm; ?></reHtml>
</xml_VoteInpData>
