<?php
header("Content-type: text/html; charset=utf-8");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
/***********************************************************************
/*	＜総合文化展＞	df_list_inf_rank.php
/*	
/*		概  要：投票ランキング
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
/*					$arr_ent		：作品配列
/*					$arr_div		：支部配列
/*					$vot_flg		：投票：処理フラグ
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
	$tab_ini = null;
	$tab_ix1 = 0;
	//--
	$arr_ent = null;
	$arr_div = null;
	$vot_flg = 0;
	//--
	$int_ix1 = 0;
	$int_rnk = 1;
	$int_tie = 0;
	$stc_cnt = null;
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
	$tab_ini[0][0] = Array("CD1"=>"SET_RI", "CD2"=>"LS_P01", "TAB_CTRL"=>"tabs", "TAB_STAT"=>"active", "TAB_MENU"=>"", "TAB_CONT"=>"");
	$tab_ini[0][1] = Array("CD1"=>"SET_RI", "CD2"=>"LS_P02", "TAB_CTRL"=>"tabs", "TAB_STAT"=>""      , "TAB_MENU"=>"", "TAB_CONT"=>"");
	$tab_ini[0][2] = Array("CD1"=>"SET_RI", "CD2"=>"LS_P03", "TAB_CTRL"=>"tabs", "TAB_STAT"=>""      , "TAB_MENU"=>"", "TAB_CONT"=>"");
	$tab_ini[0][3] = Array("CD1"=>"SET_RI", "CD2"=>"LS_P04", "TAB_CTRL"=>"tabs", "TAB_STAT"=>""      , "TAB_MENU"=>"", "TAB_CONT"=>"");
	//--                                                                                                               
	$tab_ini[1][0] = Array("CD1"=>"SET_RA", "CD2"=>"LS_B01", "TAB_CTRL"=>"tabs", "TAB_STAT"=>"active", "TAB_MENU"=>"", "TAB_CONT"=>"");
	$tab_ini[1][1] = Array("CD1"=>"SET_RA", "CD2"=>"LS_B02", "TAB_CTRL"=>"tabs", "TAB_STAT"=>""      , "TAB_MENU"=>"", "TAB_CONT"=>"");
	//--
	if (Func_NoDataJudge($str_msg) == true) {
		for ($tab_ix1 = 0 ; $tab_ix1 < count($tab_ini); $tab_ix1++) {
			//--
			for ($tab_ix2 = 0 ; $tab_ix2 < count($tab_ini[$tab_ix1]); $tab_ix2++) {
				//--
				$tmp_ini = Func_Load_sys_ini($tab_ini[$tab_ix1][$tab_ix2]);
				//+----------------------
				//+ Tabs-Menu：情報格納
				//+----------------------
				$tab_ini[$tab_ix1][$tab_ix2]["TAB_MENU"] = $tmp_ini["DEPA"];
				//+----------------------
				//+ Tabs-Cont：情報格納
				//+----------------------
				//〓-------------------〓
				//〓 構文実行 sprintf("xx[%s]xx[%s]xx", "dt1", "dt2");
				//〓-------------------〓
				$sql_str = "Select"
						.		" A.`E_ROWID`,"
						.		" A.`E_KBN_CODE`,"
						.		" A.`E_BM_CODE`,"
						.		" A.`E_DIV_NAME`,"
						.		" A.`E_USR_NAME`,"
						.		" A.`E_FILE_NAME`,"
						.		" A.`E_TITLE`,"
						.		" A.`E_TANKA_INFO`,"
						.		" Count(*) As `CNT`"
						.	" From `" . DF_SQL_ConnDBNm . "`.`t_entryinfo` A"
						.		" Inner Join `" . DF_SQL_ConnDBNm . "`.`t_vote` B"
						.			" On A.`E_ROWID` = B.`E_ROWID`"
						.	" Where A.`E_INV_FLG` = '0'" . $tmp_ini["WHER"]
						.	" Group By"
						.			" A.`E_ROWID`,"
						.			" A.`E_KBN_CODE`,"
						.			" A.`E_BM_CODE`,"
						.			" A.`E_DIV_NAME`,"
						.			" A.`E_USR_NAME`,"
						.			" A.`E_FILE_NAME`,"
						.			" A.`E_TITLE`,"
						.			" A.`E_TANKA_INFO`"
						.	" Order By `CNT` desc, A.`E_ROWID`";
				$OBJ_Rec = mysqli_query($OBJ_Cnn,$sql_str);
				if ($OBJ_Rec == false) {
					//+----------------------
					//+ 異常処理
					//+----------------------
					$tab_ini[$tab_ix1][$tab_ix2]["TAB_CONT"] = "<p class=\"ErrMsg p10 mr10\">作品データ抽出に失敗しました。</p>";
				} else {
					//+----------------------
					//+ 正常処理
					//+----------------------
					$arr_rnk = null;
					$rnk_ix1 = 0;
					$rnk_rnk = 1;
					$rnk_tie = 0;
					$rnk_stc = null;
					//--
					while ($OBJ_Row = mysqli_fetch_array($OBJ_Rec)) {
						if ($rnk_stc === $OBJ_Row["CNT"]) {
							$rnk_tie++;
						} else {
							$rnk_rnk += $rnk_tie;
							$rnk_tie = 1;
						}
						$rnk_stc = $OBJ_Row["CNT"];
						//--
						if ($rnk_rnk > DF_MAX_RANK_TOP) {
							break;
						 }
						//+----------------------
						//+ 各種情報を配列格納する
						//+----------------------
						$arr_rnk[$rnk_ix1]["kanrino"] = $OBJ_Row["E_ROWID"];			//* 作品ID(自動採番)
						$arr_rnk[$rnk_ix1]["ent_cd1"] = $OBJ_Row["E_KBN_CODE"];			//* 区分
						$arr_rnk[$rnk_ix1]["ent_cd2"] = $OBJ_Row["E_BM_CODE"];			//* 部門
						$arr_rnk[$rnk_ix1]["ent_div"] = $OBJ_Row["E_DIV_NAME"];			//* 作品：投稿者支部名
						$arr_rnk[$rnk_ix1]["ent_usr"] = $OBJ_Row["E_USR_NAME"];			//* 作品：投稿者名
						$arr_rnk[$rnk_ix1]["ent_fnm"] = $OBJ_Row["E_FILE_NAME"];		//* 作品：ファイル名
						$arr_rnk[$rnk_ix1]["ent_pem"] = $OBJ_Row["E_TANKA_INFO"];		//* 作品：俳句・短歌
						$arr_rnk[$rnk_ix1]["ent_ttl"] = $OBJ_Row["E_TITLE"];			//* 作品：タイトル
						$arr_rnk[$rnk_ix1]["vot_cnt"] = $OBJ_Row["CNT"];				//* 投票：件数
						$arr_rnk[$rnk_ix1]["vot_rnk"] = $rnk_rnk;						//* 投票：順位
																						//* カウントUP
						++$rnk_ix1;
					}
					mysqli_free_result($OBJ_Rec);
					//+----------------------
					//+ html生成
					//+----------------------
					$rnk_cnt = count($arr_rnk);
					$rnk_htm = "";
					
					if ($rnk_cnt < DF_MAX_RANK_TOP) {
						for ($rnk_ix1 = 0 ; $rnk_ix1 < DF_MAX_RANK_TOP; $rnk_ix1++) {
							if ($rnk_ix1 < $rnk_cnt) {
								$rnk_htm .= Func_Load_RankForm(6, "", $arr_rnk[$rnk_ix1], $tmp_ini["STAT"], $vot_flg);
							} else {
								$rnk_htm .= Func_Load_RankForm(6, "", null, $tmp_ini["STAT"], $vot_flg);
							}
						}
					} else {
						for ($rnk_ix1 = 0 ; $rnk_ix1 < $rnk_cnt; $rnk_ix1++) {
							$rnk_htm .= Func_Load_RankForm(6, "", $arr_rnk[$rnk_ix1], $tmp_ini["STAT"], $vot_flg);
						}
					}
					$tab_ini[$tab_ix1][$tab_ix2]["TAB_CONT"] = "<ul class=\"\">" . $rnk_htm . "</ul>";
				}
			}
		}
	}
	//+----------------------
	//+ オブジェクト解放
	//+----------------------
																				//* ＤＢ切断
	Sub_DB_Cut($OBJ_Cnn, $str_msg, $str_stt);
?>
<form name="F1" method="post" autocomplete="off" accept-charset="utf-8">
	<div id="contpostPage" class="<?php echo $dsp_ini["BGC1"]; ?>">
		<!-- ========================================================== -->
		<!-- Cont_Area：												-->
		<!-- ========================================================== -->
		<fieldset class="m10 pl20 pr20">
			<legend><h1>投票ランキング</h1></legend>
			<!-- ------------------------------------------------------ -->
			<div class="jump_menu">
				|
				<a href="#A_RI" class="jump_link">力作じまんの部《大人の部》</a>
				|
				<a href="#A_RA" class="jump_link">らくらくエントリーの部</a>
				|
			</div>
			<!-- ------------------------------------------------------ -->
			<a name="A_RI"></a>
			<dl>
				<dt class="headline">
					<h2><img src="./images/icon/icon_trophy.png">力作じまんの部《大人の部》</h2>
				</dt>
				<dd class="pl10">
<?php
	echo Func_Load_TabsForm(5, $tab_ini[0]);
?>
					<div class="textRight p5">
						<a href="#A_RI" class="jump_link">力作じまんの部《大人の部》TOPへ</a>
					</div>
				</dd>
			</dl>
			<!-- ------------------------------------------------------ -->
			<a name="A_RA"></a>
			<dl>
				<dt class="headline">
					<h2><img src="./images/icon/icon_trophy.png">らくらくエントリーの部</h2>
				</dt>
				<dd class="pl10">
<?php
	echo Func_Load_TabsForm(5, $tab_ini[1]);
?>
					<div class="textRight p5">
						<a href="#A_RA" class="jump_link">らくらくエントリーの部 TOPへ</a>
					</div>
				</dd>
			</dl>
			<!-- ------------------------------------------------------ -->
		</fieldset>
	</div>
	<script type="text/javascript" charset="utf-8">
	<!--
	$(function() {
		$("ul.rankmenu li.menu").click(
			function() {
				//"li"内の自身のIndexを取得する。
				var menu_idx = $(this).parent().children("li.menu").index(this);
				$(this).parent("ul.rankmenu").each(
					function() {
						$(">li.menu",this).removeClass("active").eq(menu_idx).addClass("active");
					}
				);
				$(this).parent().next().children("li.cont").hide().eq(menu_idx).show();
			}
		);
	});
	//-->
	</script>
	<input type="hidden" name="HID_MSG" value="<?php echo Func_SetEncDate($str_msg, "", "\n"); ?>">
	<input type="hidden" name="HID_STT" value="<?php echo Func_SetEncDate($str_stt, "", "\n"); ?>">
	<input type="hidden" name="HID_UID" value="<?php echo Func_SetEncDate($str_uid, "", "\n"); ?>">
	<input type="hidden" name="HID_UNM" value="<?php echo Func_SetEncDate($str_unm, "", "\n"); ?>">
	<input type="hidden" name="HID_MOD" value="<?php echo Func_SetEncDate($str_mod, "", "\n"); ?>">
	<!-- -->
	<input type="hidden" name="PRM_CD1" value="<?php echo Func_SetEncDate($sys_ini["CD1"], "", "\n"); ?>">
	<input type="hidden" name="PRM_CD2" value="<?php echo Func_SetEncDate($sys_ini["CD2"], "", "\n"); ?>">
	<input type="hidden" name="PRM_SRC" value="<?php echo Func_SetEncDate($sys_ini["SRC"], "", "\n"); ?>">
</form>
<?PHP
//*******************************************************************
//* Func_Load_TabsForm()：タブフレームを呼び出します。
//*------------------------------------------------------------------
//*  引数   ：$prm_indent ＝インデント
//*         ：$prm_array  ＝設置データ配列
//*  戻り値 ：出力文字列(html)
//*******************************************************************
function Func_Load_TabsForm($prm_indent, $prm_tab) {
	$tmp_htm = "";
	$tmp_css = "";
	//+----------------------
	//+ Tabs-Menu
	//+----------------------
	echo Func_Con_Write($prm_indent, "<ul class=\"rankmenu\">");
	//--
	for ($tab_ix1 = 0 ; $tab_ix1 < count($prm_tab); $tab_ix1++) {
		
		switch ($prm_tab[$tab_ix1]["TAB_CTRL"]) {
			case "memo":
				//+----------------------
				//+ Menu部：文字列表示
				//+----------------------
																				//* メニュー：出力
				$tmp_htm = $prm_tab[$tab_ix1]["TAB_MENU"];
																				//* メニュー：css
				$tmp_css = "text";
				
				echo Func_Con_Write($prm_indent + 1, "<li class=\"" . $tmp_css . "\">" . "■ " . $tmp_htm . "</li>");
				
				break;
			case "tabs":
				//+----------------------
				//+ Menu部：タブメニュー
				//+----------------------
																				//* メニュー：出力
				$tmp_htm = $prm_tab[$tab_ix1]["TAB_MENU"];
																				//* メニュー：css
				if ($prm_tab[$tab_ix1]["TAB_STAT"] == "active") {
					$tmp_css = "menu active";
				} else {
					$tmp_css = "menu";
				}
				echo Func_Con_Write($prm_indent + 1, "<li class=\"" . $tmp_css . "\">" . $tmp_htm . "</li>");
				
				break;
		}
	}
	//--
	echo Func_Con_Write($prm_indent, "</ul>");
	//+----------------------
	//+ Tabs-Cont
	//+----------------------
	echo Func_Con_Write($prm_indent, "<ul class=\"rankcont\">");
	//--
	for ($tab_ix1 = 0 ; $tab_ix1 < count($prm_tab); $tab_ix1++) {
		
		switch ($prm_tab[$tab_ix1]["TAB_CTRL"]) {
			case "memo":
				//+----------------------
				//+ Cont部：文字列表示
				//+----------------------
				//* ※ 出力なし ※
				
				break;
			case "tabs":
				//+----------------------
				//+ Cont部：タブボディー
				//+----------------------
																				//* ボディー：出力
				$tmp_htm = "<h3>"
						.		"◎ " . $prm_tab[$tab_ix1]["TAB_MENU"] . "部門 ‐ ランキング（TOP " . DF_MAX_RANK_TOP . "）"
						.	"</h3>"
						.	"<div class=\"p5\">"
						.		$prm_tab[$tab_ix1]["TAB_CONT"]
						.	"<div>";
																				//* ボディー：css
				if ($prm_tab[$tab_ix1]["TAB_STAT"] == "active") {
					$tmp_css = "cont active";
				} else {
					$tmp_css = "cont";
				}
				echo Func_Con_Write($prm_indent + 1, "<li class=\"" . $tmp_css . "\">" . $tmp_htm . "</li>");
				
				break;
		}
	}
	//--
	echo Func_Con_Write($prm_indent, "</ul>");
}
//*******************************************************************
//* Func_Load_RankForm()：描画フレームを呼び出します。
//*------------------------------------------------------------------
//*  引数   ：$prm_indent ＝インデント
//*         ：$prm_group  ＝設置種別（グループ名）
//*         ：$prm_array  ＝設置データ配列
//*  戻り値 ：出力文字列(html)
//*******************************************************************
function Func_Load_RankForm($prm_indent, $prm_group, $prm_array, $prm_typ, $prm_flg) {
	$rtn_value = "";
	//+----------------------
	//+ 情報取得
	//+----------------------
	if ($prm_array == null) {
		$arr["rnk"] = "---";
		$arr["cnt"] = "---";
		$arr["div"] = "---";
		$arr["usr"] = "---";
		//--
		$arr["css"] = "Noranked";
	} else {
		$kanrino = $prm_array["kanrino"];										//* 作品ID(自動採番)
		$val_div = $prm_array["ent_div"];										//* 作品：投稿者支部名
		$val_usr = $prm_array["ent_usr"];										//* 作品：投稿者名
		$val_rnk = $prm_array["vot_rnk"];										//* 投票：順位
		$val_cnt = $prm_array["vot_cnt"];										//* 投票：投票数
		//+----------------------
		//+ 加工処理
		//+----------------------
		$arr["div"] = Func_SetEncDate($val_div, "&nbsp;", "<br>");
		$arr["usr"] = Func_SetEncDate($val_usr, "&nbsp;", "<br>");
		$arr["rnk"] = Func_SetEncDate($val_rnk, "&nbsp;", "<br>");
		$arr["cnt"] = Func_SetEncDate($val_cnt, "&nbsp;", "<br>");
		//--
		switch ($prm_array["vot_rnk"]) {
			case 1:
				$arr["css"] = ($prm_flg == 1 ? "fixRank1" : "nowRank1");
				break;
			case 2:
				$arr["css"] = ($prm_flg == 1 ? "fixRank2" : "nowRank2");
				break;
			case 3:
				$arr["css"] = ($prm_flg == 1 ? "fixRank3" : "nowRank3");
				break;
			default:
				$arr["css"] = "Unranked";
				break;
		}
	}
	$arr["htm"] = Func_Load_Drawing($prm_indent + 3, $prm_group, $prm_array, $prm_typ);
	//+----------------------
	//+ 配置処理
	//+----------------------
	$rtn_value .= Func_Con_Write($prm_indent, "<li id=\"li_RnkEdge\" class=\"ranking\">"											);
	$rtn_value .= Func_Con_Write($prm_indent, "<table class=\"rnk_tbl\">"															);
	$rtn_value .= Func_Con_Write($prm_indent, "	<tr>"																				);
	$rtn_value .= Func_Con_Write($prm_indent, "		<th rowspan=\"1\" colspan=\"1\" class=\"" . $arr["css"] . " w80 textCenter\">"	);
	$rtn_value .= Func_Con_Write($prm_indent, "			" . $arr["rnk"] . "位<br>"													);
	$rtn_value .= Func_Con_Write($prm_indent, "			<span class=\"cnt\">(" . $arr["cnt"] . "票)<span>"							);
	$rtn_value .= Func_Con_Write($prm_indent, "		</th>"																			);
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