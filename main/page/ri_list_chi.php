<?php
header("Content-type: text/html; charset=utf-8");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
/***********************************************************************
/*	＜総合文化展＞	ri_list_chi.php
/*	
/*		概  要：ギャラリー：力作じまんの部《子供の部》
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
/*					$sql_whe		：SQL文‐Where句
/*					$whe_～			：Where句処理関連
/*					$sql_ord		：SQL文‐Order句
/*					$ord_～			：Order句処理関連
/*					//--
/*					$arr_ent		：作品配列
/*					$arr_div		：支部配列
/*					$vot_flg		：投票：処理フラグ
/*					$vot_stc		：投票：作品IDストック
/*					$str_htm		：html出力用変数
/*					$str_cmt		：メッセージ／コメント情報
/*					//--
/*					$int_ix～		：作業変数
/*					$tmp_～			：作業変数
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
	$sql_whe = "";
	$whe_ini = null;
	//--
	$sql_ord = "";
	$ord_ini = null;
	//--
	$pre_ini = null;
	//--
	$sch_val = null;
	$srt_val = null;
	$pre_val = null;
	//--
	$arr_ent = null;
	$arr_div = null;
	$vot_flg = 0;
	$vot_stc = "";
	$str_htm = "";
	$str_cmt = "";
	//--
	$int_ix1 = 0;
	$int_ix2 = 0;
	$tmp_col = "";
	$tmp_txt = "";
	$tmp_key = "";
	$tmp_typ = "";
	$tmp_str = "";
	$tmp_dt1 = "";
	$tmp_dt2 = "";
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
																				//* パラメタ：検索用
	$sch_val["DIV"] = RTrim((string)filter_input(INPUT_POST, "SCH_DIV"));
	$sch_val["USR"] = RTrim((string)filter_input(INPUT_POST, "SCH_USR"));
																				//* パラメタ：ソート用
	$srt_val["ORD"] = RTrim((string)filter_input(INPUT_POST, "SRT_ORD"));
	$srt_val["ASC"] = RTrim((string)filter_input(INPUT_POST, "SRT_ASC"));
																				//* パラメタ：プレビュー用
	$pre_val["FLG"] = RTrim((string)filter_input(INPUT_POST, "PRE_FLG"));
	$pre_val["STT"] = RTrim((string)filter_input(INPUT_POST, "PRE_STT"));
	//+----------------------
	//+ データ判定
	//+----------------------
	if (Func_NoDataJudge($str_msg) == true) {
		$dsp_ini = Func_Load_sys_ini($sys_ini);
		//--
		if ($dsp_ini == null) {
			$str_stt = "NG";
			$str_msg = "パラメタ取得に失敗しました。";
		}
	}
	//+----------------------
	//+ 期限判定
	//+----------------------
	if (Func_NoDataJudge($str_msg) == true) {
		if (((strtotime($NowDate) - strtotime(DF_DTM_VOTE_STA)) / (3600 * 24)) < 0) {
																				//* 範囲前
			$vot_flg = -1;
		} else {
			if (((strtotime($NowDate) - strtotime(DF_DTM_VOTE_END)) / (3600 * 24)) > 0) {
																				//* 範囲後
				$vot_flg = 1;
			} else {
																				//* 範囲内
				$vot_flg = 0;
			}
		}
	}
	//********************************************************//
	//* メイン処理
	//********************************************************//
	if (Func_NoDataJudge($str_msg) == true) {
		//〓-------------------〓
		//〓 構文生成：条件
		//〓-------------------〓
		$whe_ini[0] = Array("TXT"=>"支部名　", "COL"=>"E_DIV_NAME", "KEY"=>"DIV", "TYP"=>"完全一致");
		$whe_ini[1] = Array("TXT"=>"氏名"    , "COL"=>"E_USR_NAME", "KEY"=>"USR", "TYP"=>"部分一致");
		$sql_whe = "";
		//--
		for ($int_ix1 = 0 ; $int_ix1 < count($whe_ini); $int_ix1++) {
			$tmp_col = $whe_ini[$int_ix1]["COL"];
			$tmp_key = $whe_ini[$int_ix1]["KEY"];
			$tmp_typ = $whe_ini[$int_ix1]["TYP"];
																				//* 構文生成
			switch ($tmp_typ) {
				case "完全一致":
					$tmp_dt1 = $sch_val[$tmp_key];
					if ($tmp_dt1 != "") {
						$tmp_dt1 = mysqli_real_escape_string($OBJ_Cnn, $tmp_dt1);			//* エスケープ：SQL文
						$sql_whe .= " and A.`" . $tmp_col . "` = '" . $tmp_dt1 . "'";
					}
					break;
				case "部分一致":
					$tmp_dt1 = str_replace("　", " ", $sch_val[$tmp_key]);
					$tmp_dt1 = trim(mb_ereg_replace("\s+", "\t", $tmp_dt1));
					$tmp_dt1 = explode("\t", $tmp_dt1);
					//--
					for ($int_ix2 = 0 ; $int_ix2 < count($tmp_dt1); $int_ix2++) {
						$tmp_dt2 = $tmp_dt1[$int_ix2];
																				//* 構文生成
						if ($tmp_dt2 != "") {
							$tmp_dt2 = mysqli_real_escape_string($OBJ_Cnn, $tmp_dt2);		//* エスケープ：SQL文
							$tmp_dt2 = str_replace("%", "\%", $tmp_dt2);		//* エスケープ：ワイルドカード
							$tmp_dt2 = str_replace("_", "\_", $tmp_dt2);		//* エスケープ：ワイルドカード
							//--
							$sql_whe .= " and A.`" . $tmp_col . "` Like '%" . $tmp_dt2 . "%'";
						}
					}
					break;
				default:
					break;
			}
		}
		$sql_whe = substr($sql_whe, 5);
		//--
		if ($sql_whe != "") {
			$sql_whe = " and (" . $sql_whe . ")";
		}
		//〓-------------------〓
		//〓 構文生成：ソート
		//〓-------------------〓
		$ord_ini[0] = Array("TXT"=>"ランダム表示", "COL"=>""          , "KEY"=>""   );
		$ord_ini[1] = Array("TXT"=>"支部順",       "COL"=>"E_DIV_NAME", "KEY"=>"DIV");
		$ord_ini[2] = Array("TXT"=>"氏名順",       "COL"=>"E_USR_NAME", "KEY"=>"USR");
		$sql_ord = "";
		//--
		for ($int_ix1 = 0 ; $int_ix1 < count($ord_ini); $int_ix1++) {
			$tmp_col = $ord_ini[$int_ix1]["COL"];
			$tmp_key = $ord_ini[$int_ix1]["KEY"];
																				//* 構文生成
			if ($tmp_key !="") {
				if ($srt_val["ORD"] == $tmp_key) {
					if ($srt_val["ASC"] == "desc") {
						$sql_ord .= "," . "A.`" . $tmp_col . "`" . " desc";
					} else {
						$sql_ord .= "," . "A.`" . $tmp_col . "`" . "";
					}
				}
			}
		}
		$sql_ord = substr($sql_ord, 1);
		//--
		if ($sql_ord != "") {
			$sql_ord = " Order By " . $sql_ord;
		} else {
			$sql_ord = " Order By Rand()";
		}
		//〓-------------------〓
		//〓 構文実行 sprintf("xx[%s]xx[%s]xx", "dt1", "dt2");
		//〓-------------------〓
		$sql_str = "Select"
				.		" A.*,"
				.		" Case When A.`E_ROWID` = B.`E_ROWID`"
				.			" Then '1'"
				.			" Else '0'"
				.			" End As `V_STATE`"
				.	" From `" . DF_SQL_ConnDBNm . "`.`t_entryinfo` A"
				.		" Left Outer Join `" . DF_SQL_ConnDBNm . "`.`t_vote` B"
				.			" On A.`E_ROWID` = B.`E_ROWID`"
				.			" and B.`UserID` = '" . mysqli_real_escape_string($OBJ_Cnn, $str_uid) . "'"
				.	" Where A.`E_INV_FLG` = '0'" . $dsp_ini["WHER"]
				.		$sql_whe
				.		$sql_ord;
		$OBJ_Rec = mysqli_query($OBJ_Cnn, $sql_str);
		if ($OBJ_Rec == false) {
			$str_stt = "Err";
			$str_msg = "作品データ抽出に失敗しました。";
		} else {
			$int_ix1 = 0;
			while ($OBJ_Row = mysqli_fetch_assoc($OBJ_Rec)) {
				//+----------------------
				//+ 各種情報を配列格納する
				//+----------------------
				$arr_ent[$int_ix1]["kanrino"] = $OBJ_Row["E_ROWID"];			//* 作品ID(自動採番)
				$arr_ent[$int_ix1]["ent_cd1"] = $OBJ_Row["E_KBN_CODE"];			//* 区分
				$arr_ent[$int_ix1]["ent_cd2"] = $OBJ_Row["E_BM_CODE"];			//* 部門
				$arr_ent[$int_ix1]["ent_div"] = $OBJ_Row["E_DIV_NAME"];			//* 作品：投稿者支部名
				$arr_ent[$int_ix1]["ent_usr"] = $OBJ_Row["E_USR_NAME"];			//* 作品：投稿者名
				$arr_ent[$int_ix1]["ent_dtm"] = $OBJ_Row["E_INS_DATE"];			//* 作品：投稿日
				$arr_ent[$int_ix1]["ent_fph"] = $OBJ_Row["E_FILE_PATH"];		//* 作品：ファイルパス名
				$arr_ent[$int_ix1]["ent_fnm"] = $OBJ_Row["E_FILE_NAME"];		//* 作品：ファイル名
				$arr_ent[$int_ix1]["ent_pem"] = $OBJ_Row["E_TANKA_INFO"];		//* 作品：俳句・短歌
				$arr_ent[$int_ix1]["ent_cmt"] = $OBJ_Row["E_COMMENT"];			//* 作品：コメント
				$arr_ent[$int_ix1]["ent_ttl"] = $OBJ_Row["E_TITLE"];			//* 作品：タイトル
				$arr_ent[$int_ix1]["siz_hei"] = $OBJ_Row["E_SIZE_L"];			//* 作品：サイズ_縦
				$arr_ent[$int_ix1]["siz_wid"] = $OBJ_Row["E_SIZE_B"];			//* 作品：サイズ_横
				$arr_ent[$int_ix1]["siz_dep"] = $OBJ_Row["E_SIZE_W"];			//* 作品：サイズ_幅
				$arr_ent[$int_ix1]["vot_stt"] = $OBJ_Row["V_STATE"];			//* 投票：状態
				$arr_ent[$int_ix1]["vot_flg"] = $vot_flg;						//* 投票：動作フラグ
																				//* カウントUP
				++$int_ix1;
			}
			if ($int_ix1 == 0) {
				$str_cmt = "対象となる作品情報がありません。";
			}
		}
		mysqli_free_result($OBJ_Rec);
	}
	//********************************************************//
	//* 支部データ抽出処理
	//********************************************************//
	if (Func_NoDataJudge($str_msg) == true) {
		//〓-------------------〓
		//〓 構文実行 sprintf("xx[%s]xx[%s]xx", "dt1", "dt2");
		//〓-------------------〓
		$sql_str = "Select"
				.		" A.`E_DIV_NAME`,"
				.		" Case A.`E_DIV_NAME`"
				.			" When '" . $C2_DIV_ORD[0]["TXT"] . "'" . " Then " . $C2_DIV_ORD[0]["ORD"]
				.			" When '" . $C2_DIV_ORD[1]["TXT"] . "'" . " Then " . $C2_DIV_ORD[1]["ORD"]
				.			" When '" . $C2_DIV_ORD[2]["TXT"] . "'" . " Then " . $C2_DIV_ORD[2]["ORD"]
				.			" When '" . $C2_DIV_ORD[3]["TXT"] . "'" . " Then " . $C2_DIV_ORD[3]["ORD"]
				.			" When '" . $C2_DIV_ORD[4]["TXT"] . "'" . " Then " . $C2_DIV_ORD[4]["ORD"]
				.			" When '" . $C2_DIV_ORD[5]["TXT"] . "'" . " Then " . $C2_DIV_ORD[5]["ORD"]
				.			" Else 99"
				.			" End"							. " As `OrderNo`"
				.	" From `" . DF_SQL_ConnDBNm . "`.`t_entryinfo` A"
				.	" Where A.`E_INV_FLG` = '0'" . $dsp_ini["WHER"]
				.	" Group By A.`E_DIV_NAME`"
				.	" Order By `OrderNo`, A.`E_DIV_NAME`";
		$OBJ_Rec = mysqli_query($OBJ_Cnn, $sql_str);
		if ($OBJ_Rec == false) {
			$str_stt = "Err";
			$str_msg = "支部データ抽出に失敗しました。";
		} else {
			$int_ix1 = 0;
			while ($OBJ_Row = mysqli_fetch_assoc($OBJ_Rec)) {
				//+----------------------
				//+ 支部情報を配列格納する
				//+----------------------
				$arr_div[$int_ix1] = $OBJ_Row["E_DIV_NAME"];					//* 作品：投稿者支部名
																				//* カウントUP
				++$int_ix1;
			}
		}
		mysqli_free_result($OBJ_Rec);
	}
	//********************************************************//
	//* プレビュー処理…※検索の影響を受けるためメインから分離
	//********************************************************//
	if (Func_NoDataJudge($str_msg) == true) {
		$sql_str = "Select"
				.		" A.*"
				.	" From `" . DF_SQL_ConnDBNm . "`.`t_entryinfo` A"
				.		" Inner Join `" . DF_SQL_ConnDBNm . "`.`t_vote` B"
				.			" On A.`E_ROWID` = B.`E_ROWID`"
				.			" and B.`UserID` = '" . mysqli_real_escape_string($OBJ_Cnn, $str_uid) . "'"
				.	" Where A.`E_INV_FLG` = '0'" . $dsp_ini["WHER"];
		$OBJ_Rec = mysqli_query($OBJ_Cnn, $sql_str);
		if ($OBJ_Rec == false) {
			$str_stt = "Err";
			$str_msg = "作品プレビュー抽出に失敗しました。";
		} else {
			if (mysqli_num_rows($OBJ_Rec) > 0) {
				$OBJ_Row = mysqli_fetch_assoc($OBJ_Rec);
				//+----------------------
				//+ 各種情報を配列格納する
				//+----------------------
				$pre_ini["kanrino"] = $OBJ_Row["E_ROWID"];						//* 作品ID(自動採番)
				$pre_ini["ent_cd1"] = $OBJ_Row["E_KBN_CODE"];					//* 区分
				$pre_ini["ent_cd2"] = $OBJ_Row["E_BM_CODE"];					//* 部門
				$pre_ini["ent_fph"] = $OBJ_Row["E_FILE_PATH"];					//* 作品：ファイルパス名
				$pre_ini["ent_fnm"] = $OBJ_Row["E_FILE_NAME"];					//* 作品：ファイル名
				$pre_ini["ent_pem"] = $OBJ_Row["E_TANKA_INFO"];					//* 作品：俳句・短歌
				$pre_ini["ent_cmt"] = $OBJ_Row["E_COMMENT"];					//* 作品：コメント
				$pre_ini["ent_ttl"] = $OBJ_Row["E_TITLE"];						//* 作品：タイトル
				//+----------------------
				//+ 投票作品IDを格納する
				//+----------------------
				$vot_stc = $pre_ini["kanrino"];
			}
		}
		mysqli_free_result($OBJ_Rec);
	}
	//+----------------------
	//+ オブジェクト解放
	//+----------------------
																				//* ＤＢ切断
	Sub_DB_Cut($OBJ_Cnn, $str_msg, $str_stt);
	//+----------------------
	//+ メッセージ
	//+----------------------
	if (Func_NoDataJudge($str_msg) == true) {
		$str_stt = "OK";
	}
?>
<form name="F1" method="post" autocomplete="off" accept-charset="utf-8">
	<div id="contpostPage" class="<?php echo $dsp_ini["BGC1"]; ?>">
		<!-- ========================================================== -->
		<!-- Cont_Area：												-->
		<!-- ========================================================== -->
		<fieldset class="m10 pl20 pr20">
			<legend><h1><?php echo Func_SetEncDate($dsp_ini["HEAD"], "", "<br>"); ?>&nbsp;『&nbsp;<?php echo Func_SetEncDate($dsp_ini["DEPA"] . "部門", "", "<br>"); ?>&nbsp;』</h1></legend>
			<dl>
				<dt class="headline">
					<h2><img src="<?php echo $dsp_ini["ICON"]; ?>">募集内容</h2>
				</dt>
				<dd class="pl10">
					<ul class="pl20 pb10">
						<li>
							<div class="dispTable">
								<div class="dispTd w40">テーマ</div><div class="dispTd w20">：</div>
								<div class="dispTd">
									<?php echo Func_SetEncDate($dsp_ini["THEM"], "", "<br>"); ?>
								</div>
							</div>
						</li>
						<li>
							<div class="dispTable">
								<div class="dispTd w40">サイズ</div><div class="dispTd w20">：</div>
								<div class="dispTd">
									<?php echo Func_SetEncDate($dsp_ini["SIZE"], "", "<br>"); ?>
								</div>
							</div>
						</li>
					</ul>
				</dd>
				<dt class="headline">
					<h2><img src="<?php echo $dsp_ini["ICON"]; ?>">作品ギャラリー</h2>
				</dt>
				<dd class="pl10">
<?PHP
	if (Func_NoDataJudge($str_msg) == false) {
		//+----------------------
		//+ 異常処理
		//+----------------------
		echo Func_Con_Write(5, "<div class=\"ErrMsg p10 mr10\">" . Func_SetEncDate($str_msg, "", "<br>") . "</div>");
	} else {
		//+----------------------
		//+ 正常処理
		//+----------------------
?>
					<ul class="pl20 pb10">
						<li>
							<div class="dispTable">
								<div class="dispTd w40">検　索</div><div class="dispTd w20">：</div>
								<div class="dispTd">
									<?PHP echo Func_Load_SchTools(9, $whe_ini, $sch_val, $arr_div); ?>
								</div>
							</div>
						</li>
						<li>
							<div class="dispTable">
								<div class="dispTd w40">並替え</div><div class="dispTd w20">：</div>
								<div class="dispTd">
									<?PHP echo Func_Load_SrtTools(9, $ord_ini, $srt_val); ?>
								</div>
<?PHP
		if ($dsp_ini["VOTE"] == "Load-On" && strval($str_mod) == "1") {
			echo Func_Con_Write(8, "<div class=\"dispTd w20\">　</div>");
			//--
			echo Func_Con_Write(8, "<div class=\"dispTd\">選択済の作品表示</div><div class=\"dispTd w20\">：</div>");
			echo Func_Con_Write(8, "<div class=\"dispTd\">");
			echo Func_Load_PreTools(9, $pre_ini, $pre_val, $dsp_ini);
			echo Func_Con_Write(8, "</div>");
		}
?>
							</div>
						</li>
					</ul>
					<hr>
<?PHP
		//+----------------------
		//+ ギャラリー
		//+----------------------
		if (Func_NoDataJudge($str_cmt) == false) {
																				//* 作品一覧：出力対象[無]
			echo Func_Con_Write(5, "<div class=\"MsgMsg p10 mr10\">" . Func_SetEncDate($str_cmt, "", "<br>") . "</div>");
		} else {
																				//* 作品一覧：出力対象[有]
			echo Func_Con_Write(5, "<ul class=\"gallery clearfix\"><!-- Group:Gallery -->");
			//--▼- - - - - - - - - - - - - -- - - - - - - - - - - - - - - -▼--
			for ($int_ix1 = 0 ; $int_ix1 < count($arr_ent); $int_ix1++) {
				echo Func_Load_SettingFrame(6, "GrpGallery", $arr_ent[$int_ix1], $dsp_ini, $str_mod);
			}
			//--▲- - - - - - - - - - - - - -- - - - - - - - - - - - - - - -▲--
			echo Func_Con_Write(5, "</ul><!-- /Group:Gallery -->");
		}
	}
?>
				</dd>
			</dl>
		</fieldset>
	</div>
	<input type="hidden" name="HID_MSG" value="<?php echo Func_SetEncDate($str_msg, "", "\n"); ?>">
	<input type="hidden" name="HID_STT" value="<?php echo Func_SetEncDate($str_stt, "", "\n"); ?>">
	<input type="hidden" name="HID_UID" value="<?php echo Func_SetEncDate($str_uid, "", "\n"); ?>">
	<input type="hidden" name="HID_UNM" value="<?php echo Func_SetEncDate($str_unm, "", "\n"); ?>">
	<input type="hidden" name="HID_MOD" value="<?php echo Func_SetEncDate($str_mod, "", "\n"); ?>">
	<!-- -->
	<input type="hidden" name="PRM_CD1" value="<?php echo Func_SetEncDate($sys_ini["CD1"], "", "\n"); ?>">
	<input type="hidden" name="PRM_CD2" value="<?php echo Func_SetEncDate($sys_ini["CD2"], "", "\n"); ?>">
	<input type="hidden" name="PRM_SRC" value="<?php echo Func_SetEncDate($sys_ini["SRC"], "", "\n"); ?>">
	<!-- -->
	<input type="hidden" name="VOT_STC" value="<?php echo Func_SetEncDate($vot_stc, "", "\n"); ?>">
</form>
<?PHP
//*******************************************************************
//* Func_Load_SettingFrame()：描画フレームを呼び出します。
//*------------------------------------------------------------------
//*  引数   ：$prm_indent ＝インデント
//*         ：$prm_group  ＝設置種別（グループ名）
//*         ：$prm_array  ＝設置データ配列
//*  戻り値 ：出力文字列(html)
//*******************************************************************
function Func_Load_SettingFrame($prm_indent, $prm_group, $prm_array, $prm_dsp, $prm_mod) {
	$rtn_value = "";
	//+----------------------
	//+ 情報取得
	//+----------------------
	if ($prm_array == null) {
		$arr["div"] = "";
		$arr["usr"] = "";
		$arr["ttl"] = "";
		$arr["cmt"] = "";
		$arr["siz"] = "";
		$arr["vot"] = "";
	} else {
		$kanrino = $prm_array["kanrino"];										//* 作品ID(自動採番)
		$val_div = $prm_array["ent_div"];										//* 作品：投稿者支部名
		$val_usr = $prm_array["ent_usr"];										//* 作品：投稿者名
		$val_ttl = $prm_array["ent_ttl"];										//* 作品：タイトル
		$val_cmt = $prm_array["ent_cmt"];										//* 作品：コメント
		$val_wid = $prm_array["siz_wid"];										//* 作品：サイズ_幅
		$val_dep = $prm_array["siz_dep"];										//* 作品：サイズ_奥
		$val_hei = $prm_array["siz_hei"];										//* 作品：サイズ_高
		$val_stt = $prm_array["vot_stt"];										//* 投票：状態
		$val_flg = $prm_array["vot_flg"];										//* 投票：動作フラグ
		//+----------------------
		//+ 加工処理
		//+----------------------
		$arr["div"] = Func_SetEncDate($val_div, "&nbsp;", "<br>");
		$arr["usr"] = Func_SetEncDate($val_usr, "&nbsp;", "<br>");
		$arr["ttl"] = Func_SetEncDate($val_ttl, "&nbsp;", "<br>");
		$arr["cmt"] = Func_SetEncDate($val_cmt, "&nbsp;", "<br>");
		//** サイズ連結 **//
		$arr["siz"] = "";
		if ($val_hei > 0) {
			$arr["siz"] .= " - H:" . $val_hei;
		}
		if ($val_wid > 0) {
			$arr["siz"] .= " - W:" . $val_wid;
		}
		if ($val_dep > 0) {
			$arr["siz"] .= " - D:" . $val_dep;
		}
		$arr["siz"] = substr($arr["siz"], 3);
		//** 投票ボタン **//
		$arr["rnm"] = "VOT_VOT";
		$arr["rid"] = "VOT_VOT" . $kanrino;
		$arr["val"] = $kanrino;
		$arr["mrk"] = ($val_stt == "1") ? " checked" : "";
		//--
		switch ($val_flg) {
			case -1:
				$arr["vot"] = "<p class=\"voteInf textCenter\">"
							. 	"（受付開始までお待ちください）"
							. "</p>"
							. "<p class=\"mt5 mr25 mb5 ml25\">"
							.	"<span class=\"voteBtn textCenter\">近日受付開始</span>"
							. "</p>"
							. "<p class=\"voteInf textCenter\">"
							. 	"受付期間：" . DF_DTM_VOTE_STA . " ～ " . DF_DTM_VOTE_END . ""
							. "</p>";
				break;
			case 1:
				$arr["vot"] = "<p class=\"voteInf textCenter\">"
							. 	"（受付は終了しました）"
							. "</p>"
							. "<p class=\"mt5 mr25 mb5 ml25\">"
							.	"<span class=\"voteBtn textCenter" . (($val_stt == "1") ? " voteReady" : "") . "\">" . (($val_stt == "1") ? "投票済み" : "受付終了") . "</span>"
							. "</p>"
							. "<p class=\"voteInf textCenter\">"
							. 	"受付期間：" . DF_DTM_VOTE_STA . " ～ " . DF_DTM_VOTE_END . ""
							. "</p>";
				break;
			default:
				$arr["vot"] = "<p class=\"voteInf textCenter\">"
							. 	"<!--（ログインすると投票できます）-->"
							. "</p>"
							. "<p class=\"mt5 mr25 mb5 ml25\">"
							.	"<label class=\"voteBtn textCenter\" for=\"" . $arr["rid"] . "\">"
							.		"<input type=\"radio\" name=\"" . $arr["rnm"] . "\" id=\"" . $arr["rid"] . "\" value=\"" . $arr["val"] . "\"" . $arr["mrk"] . ">"
							.		"<span class=\"text\"></span>"
							.	"</label>"
							. "</p>"
							. "<p class=\"voteInf textCenter\">"
							. 	"受付期間：" . DF_DTM_VOTE_STA . " ～ " . DF_DTM_VOTE_END . ""
							. "</p>";
				break;
		}
	}
	if ($prm_dsp["VOTE"] == "Load-On" && strval($prm_mod) == "1") {
		$arr["vfm"] = "<div class=\"phovot pt0 pr10 pb0 pl0\">"
					.	"<table class=\"vot_tbl w200 h90\">"
					.		"<tr>"
					.			"<td class=\"textLeft\">"
					.				"◎ この作品への投票はこちらから"
					.			"</td>"
					.		"</tr>"
					.		"<tr>"
					.			"<td class=\"textLeft\">"
					.				$arr["vot"]
					.			"</td>"
					.		"</tr>"
					.	"</table>"
					. "</div>";
	} else {
		$arr["vfm"] = "";
	}
	$arr["htm"] = Func_Load_Drawing($prm_indent + 3, $prm_group, $prm_array, $prm_dsp["STAT"]);
	//+----------------------
	//+ 配置処理
	//+----------------------
	$rtn_value .= Func_Con_Write($prm_indent, "<li id=\"li_SetEdge" . $kanrino . "\" class=\"setting\">"							);
	$rtn_value .= Func_Con_Write($prm_indent, "<table class=\"set_tbl\">"															);
	$rtn_value .= Func_Con_Write($prm_indent, "	<tr>"																				);
	$rtn_value .= Func_Con_Write($prm_indent, "		<td rowspan=\"1\" colspan=\"1\">"												);
	$rtn_value .= 										$arr["htm"];									//** 出力：作品フレーム **//
	$rtn_value .= Func_Con_Write($prm_indent, "		</td>"																			);
	$rtn_value .= Func_Con_Write($prm_indent, "		<td rowspan=\"1\" colspan=\"1\">"												);
	$rtn_value .= Func_Con_Write($prm_indent, "			<div class=\"pt10 pr10 pb0 pl0\">"											);
	$rtn_value .= Func_Con_Write($prm_indent, "				<table class=\"det_tbl\">"												);
	$rtn_value .= Func_Con_Write($prm_indent, "					<tr>"																);
	$rtn_value .= Func_Con_Write($prm_indent, "						<th class=\"textLeft\">"										);
	$rtn_value .= Func_Con_Write($prm_indent, "							■ 支部名"													);
	$rtn_value .= Func_Con_Write($prm_indent, "						</th>"															);
	$rtn_value .= Func_Con_Write($prm_indent, "					</tr>"																);
	$rtn_value .= Func_Con_Write($prm_indent, "					<tr>"																);
	$rtn_value .= Func_Con_Write($prm_indent, "						<td class=\"textLeft\">"										);
	$rtn_value .= Func_Con_Write($prm_indent, "							<div class=\"w190 h20 mb5 pt3 pl5 pb3 pr5 word_break\">"	);
	$rtn_value .= Func_Con_Write($prm_indent, "								" . $arr["div"]											);
	$rtn_value .= Func_Con_Write($prm_indent, "							</div>"														);
	$rtn_value .= Func_Con_Write($prm_indent, "						</td>"															);
	$rtn_value .= Func_Con_Write($prm_indent, "					</tr>"																);
	$rtn_value .= Func_Con_Write($prm_indent, "					<tr>"																);
	$rtn_value .= Func_Con_Write($prm_indent, "						<th class=\"textLeft\">"										);
	$rtn_value .= Func_Con_Write($prm_indent, "							■ 氏名"													);
	$rtn_value .= Func_Con_Write($prm_indent, "						</th>"															);
	$rtn_value .= Func_Con_Write($prm_indent, "					</tr>"																);
	$rtn_value .= Func_Con_Write($prm_indent, "					<tr>"																);
	$rtn_value .= Func_Con_Write($prm_indent, "						<td class=\"textLeft\">"										);
	$rtn_value .= Func_Con_Write($prm_indent, "							<div class=\"w190 h20 mb5 pt3 pl5 pb3 pr5 word_break\">"	);
	$rtn_value .= Func_Con_Write($prm_indent, "								" . $arr["usr"]											);
	$rtn_value .= Func_Con_Write($prm_indent, "							</div>"														);
	$rtn_value .= Func_Con_Write($prm_indent, "						</td>"															);
	$rtn_value .= Func_Con_Write($prm_indent, "					</tr>"																);
	$rtn_value .= Func_Con_Write($prm_indent, "				</table>"																);
	$rtn_value .= Func_Con_Write($prm_indent, "			</div>"																		);
	$rtn_value .= 										$arr["vfm"];									//** 出力：投票フレーム **//
	$rtn_value .= Func_Con_Write($prm_indent, "		</td>"																			);
	$rtn_value .= Func_Con_Write($prm_indent, "	</tr>"																				);
	$rtn_value .= Func_Con_Write($prm_indent, "	<tr><td rowspan=\"1\" colspan=\"2\"><hr></td></tr>"									);
	$rtn_value .= Func_Con_Write($prm_indent, "	<tr>"																				);
	$rtn_value .= Func_Con_Write($prm_indent, "		<td rowspan=\"1\" colspan=\"2\">"												);
	$rtn_value .= Func_Con_Write($prm_indent, "			<div class=\"pt0 pr10 pb5 pl10\">"											);
	$rtn_value .= Func_Con_Write($prm_indent, "				<table class=\"det_tbl\">"												);
	$rtn_value .= Func_Con_Write($prm_indent, "					<tr>"																);
	$rtn_value .= Func_Con_Write($prm_indent, "						<th class=\"textLeft\">"										);
	$rtn_value .= Func_Con_Write($prm_indent, "							■ 作品タイトル"											);
	$rtn_value .= Func_Con_Write($prm_indent, "						</th>"															);
	$rtn_value .= Func_Con_Write($prm_indent, "					</tr>"																);
	$rtn_value .= Func_Con_Write($prm_indent, "					<tr>"																);
	$rtn_value .= Func_Con_Write($prm_indent, "						<td class=\"textLeft\">"										);
	$rtn_value .= Func_Con_Write($prm_indent, "							<div class=\"w380 h20 mb5 pt3 pl5 pb3 pr5 word_break\">"	);
	$rtn_value .= Func_Con_Write($prm_indent, "								" . $arr["ttl"]											);
	$rtn_value .= Func_Con_Write($prm_indent, "							</div>"														);
	$rtn_value .= Func_Con_Write($prm_indent, "						</td>"															);
	$rtn_value .= Func_Con_Write($prm_indent, "					</tr>"																);
	$rtn_value .= Func_Con_Write($prm_indent, "					<tr>"																);
	$rtn_value .= Func_Con_Write($prm_indent, "						<th class=\"textLeft\">"										);
	$rtn_value .= Func_Con_Write($prm_indent, "							■ 作品サイズ（H:縦 - W:横 - D:奥）[cm]"					);
	$rtn_value .= Func_Con_Write($prm_indent, "						</th>"															);
	$rtn_value .= Func_Con_Write($prm_indent, "					</tr>"																);
	$rtn_value .= Func_Con_Write($prm_indent, "					<tr>"																);
	$rtn_value .= Func_Con_Write($prm_indent, "						<td class=\"textLeft\">"										);
	$rtn_value .= Func_Con_Write($prm_indent, "							<div class=\"w380 h20 mb5 pt3 pl5 pb3 pr5 word_break\">"	);
	$rtn_value .= Func_Con_Write($prm_indent, "								" . $arr["siz"]											);
	$rtn_value .= Func_Con_Write($prm_indent, "							</div>"														);
	$rtn_value .= Func_Con_Write($prm_indent, "						</td>"															);
	$rtn_value .= Func_Con_Write($prm_indent, "					</tr>"																);
	$rtn_value .= Func_Con_Write($prm_indent, "					<tr>"																);
	$rtn_value .= Func_Con_Write($prm_indent, "						<th class=\"textLeft\">"										);
	$rtn_value .= Func_Con_Write($prm_indent, "							■ 作品コメント"											);
	$rtn_value .= Func_Con_Write($prm_indent, "						</th>"															);
	$rtn_value .= Func_Con_Write($prm_indent, "					</tr>"																);
	$rtn_value .= Func_Con_Write($prm_indent, "					<tr>"																);
	$rtn_value .= Func_Con_Write($prm_indent, "						<td class=\"textLeft\">"										);
	$rtn_value .= Func_Con_Write($prm_indent, "							<div class=\"w380 h60 mb5 pt3 pl5 pb3 pr5 word_break\">"	);
	$rtn_value .= Func_Con_Write($prm_indent, "								" . $arr["cmt"]											);
	$rtn_value .= Func_Con_Write($prm_indent, "							</div>"														);
	$rtn_value .= Func_Con_Write($prm_indent, "						</td>"															);
	$rtn_value .= Func_Con_Write($prm_indent, "					</tr>"																);
	$rtn_value .= Func_Con_Write($prm_indent, "				</table>"																);
	$rtn_value .= Func_Con_Write($prm_indent, "			</div>"																		);
	$rtn_value .= Func_Con_Write($prm_indent, "		</td>"																			);
	$rtn_value .= Func_Con_Write($prm_indent, "	</tr>"																				);
	$rtn_value .= Func_Con_Write($prm_indent, "</table>"																			);
	$rtn_value .= Func_Con_Write($prm_indent, "</li>"																				);
	//+----------------------
	//+ 戻り値
	//+----------------------
	return $rtn_value;
}
?>