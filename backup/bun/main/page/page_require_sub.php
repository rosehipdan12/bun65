<?php
/***********************************************************************
/*	＜総合文化展＞	page_require_sub.php
/*	
/*		概  要：外部スクリプト：ページ定義
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
//〓 処理宣言
//〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓〓
define("DF_MAX_RANK_TOP",	5			);										//* 任意：ランキング（TOP X）

$C2_DIV_ORD[0] = Array("TXT"=>"Ｒ＆Ｄ支部"				, "ORD"=>"0");
$C2_DIV_ORD[1] = Array("TXT"=>"小山支部"				, "ORD"=>"1");
$C2_DIV_ORD[2] = Array("TXT"=>"本社支部"				, "ORD"=>"2");
$C2_DIV_ORD[3] = Array("TXT"=>"ソフト・サービス支部"	, "ORD"=>"3");
$C2_DIV_ORD[4] = Array("TXT"=>"沼津支部"				, "ORD"=>"4");
$C2_DIV_ORD[5] = Array("TXT"=>"営業所西支部"			, "ORD"=>"5");

//*******************************************************************
//* Func_Load_sys_ini()：
//*------------------------------------------------------------------
//*  引数   ：$prm_sys    ＝設置データ配列
//*  戻り値 ：出力文字列(設定情報)
//*******************************************************************
function Func_Load_sys_ini($prm_sys) {
	$rtn_ini = null;
	//+----------------------
	//+ 戻り値
	//+----------------------
	switch ($prm_sys["CD1"]) {
		case "SET_RI":
			switch ($prm_sys["CD2"]) {
				case "LS_P01":
					$rtn_ini["HEAD"] = "力作じまんの部《大人の部》";
					$rtn_ini["DEPA"] = "絵画";
					$rtn_ini["THEM"] = "自由";
					$rtn_ini["KIND"] = "日本画、油絵、水彩画、水墨画、版画など";
					$rtn_ini["SIZE"] = "3 号以上 20 号以内 （額装あり、ガラスは不可）";
					$rtn_ini["ICON"] = "./images/icon/icon_paints.png";
					$rtn_ini["BGC1"] = "page_ri";
					$rtn_ini["STAT"] = "Load-Img";
					$rtn_ini["VOTE"] = "Load-On";
					//--
					$rtn_ini["WHER"] = " and A.`E_KBN_CODE` = 'RI' and A.`E_BM_CODE` = 'P01'";
					//--
					break;
				case "LS_P02":
					$rtn_ini["HEAD"] = "力作じまんの部《大人の部》";
					$rtn_ini["DEPA"] = "書道";
					$rtn_ini["THEM"] = "自由";
					$rtn_ini["KIND"] = "楷書、行書、草書 など";
					$rtn_ini["SIZE"] = "半紙以上 二六判以内（表装あり、額装は不可）";
					$rtn_ini["ICON"] = "./images/icon/icon_shodou.png";
					$rtn_ini["BGC1"] = "page_ri";
					$rtn_ini["STAT"] = "Load-Img";
					$rtn_ini["VOTE"] = "Load-On";
					//--
					$rtn_ini["WHER"] = " and A.`E_KBN_CODE` = 'RI' and A.`E_BM_CODE` = 'P02'";
					//--
					break;
				case "LS_P03":
					$rtn_ini["HEAD"] = "力作じまんの部《大人の部》";
					$rtn_ini["DEPA"] = "写真";
					$rtn_ini["THEM"] = "自由";
					$rtn_ini["KIND"] = "カラー・モノクロのプリント単写真";
					$rtn_ini["SIZE"] = "４ツ切り（254 ㎜×305 ㎜）以上全紙サイズ（435 ㎜×540 ㎜）以内\n（額装またはパネル・台紙に貼り付け必要。ガラスは不可）";
					$rtn_ini["ICON"] = "./images/icon/icon_camera.png";
					$rtn_ini["BGC1"] = "page_ri";
					$rtn_ini["STAT"] = "Load-Img";
					$rtn_ini["VOTE"] = "Load-On";
					//--
					$rtn_ini["WHER"] = " and A.`E_KBN_CODE` = 'RI' and A.`E_BM_CODE` = 'P03'";
					//--
					break;
				case "LS_P04":
					$rtn_ini["HEAD"] = "力作じまんの部《大人の部》";
					$rtn_ini["DEPA"] = "手芸・工芸";
					$rtn_ini["THEM"] = "自由";
					$rtn_ini["KIND"] = "パッチワーク、レザークラフト、きり絵、刺繍、編み物、人形、木彫・石彫（篆刻）、陶芸、模型 等。";
					$rtn_ini["SIZE"] = "展示平面図縦50 ㎝×横50 ㎝×高さ60 ㎝、重さ20 ㎏以内";
					$rtn_ini["ICON"] = "./images/icon/icon_hasami.png";
					$rtn_ini["BGC1"] = "page_ri";
					$rtn_ini["STAT"] = "Load-Img";
					$rtn_ini["VOTE"] = "Load-On";
					//--
					$rtn_ini["WHER"] = " and A.`E_KBN_CODE` = 'RI' and A.`E_BM_CODE` = 'P04'";
					//--
					break;
				case "LS_C01":
					$rtn_ini["HEAD"] = "力作じまんの部《子供の部》";
					$rtn_ini["DEPA"] = "絵画";
					$rtn_ini["THEM"] = "家族の似顔絵";
					$rtn_ini["KIND"] = "";
					$rtn_ini["SIZE"] = "A4 サイズの画用紙 （額装なし）";
					$rtn_ini["ICON"] = "./images/icon/icon_paints.png";
					$rtn_ini["BGC1"] = "page_ri";
					$rtn_ini["STAT"] = "Load-Img";
					$rtn_ini["VOTE"] = "Load-Off";								//※子供の部は，投票機能は不要※//
					//--
					$rtn_ini["WHER"] = " and A.`E_KBN_CODE` = 'RI' and A.`E_BM_CODE` = 'C01'";
					//--
					break;
				case "LS_C02":
					$rtn_ini["HEAD"] = "力作じまんの部《子供の部》";
					$rtn_ini["DEPA"] = "書道";
					$rtn_ini["THEM"] = "自由";
					$rtn_ini["KIND"] = "";
					$rtn_ini["SIZE"] = "半紙もしくは八ツ切（半切1/4 縦：約68cm×17.5cm）\n（表装あり、額装は不可）";
					$rtn_ini["ICON"] = "./images/icon/icon_shodou.png";
					$rtn_ini["BGC1"] = "page_ri";
					$rtn_ini["STAT"] = "Load-Img";
					$rtn_ini["VOTE"] = "Load-Off";								//※子供の部は，投票機能は不要※//
					//--
					$rtn_ini["WHER"] = " and A.`E_KBN_CODE` = 'RI' and A.`E_BM_CODE` = 'C02'";
					//--
					break;
			}
			break;
		case "SET_RA":
			switch ($prm_sys["CD2"]) {
				case "LS_B01":
					$rtn_ini["HEAD"] = "らくらくエントリーの部";
					$rtn_ini["DEPA"] = "写真・イラスト";
					$rtn_ini["THEM"] = "家庭/職場/地域(社会)において「笑顔・元気になれるモノ」「未来に伝えたいコト・未来に残したいモノ」";
					$rtn_ini["KIND"] = "";
					$rtn_ini["SIZE"] = "";
					$rtn_ini["ICON"] = "./images/icon/icon_images.png";
					$rtn_ini["BGC1"] = "page_ra";
					$rtn_ini["STAT"] = "Load-Img";
					$rtn_ini["VOTE"] = "Load-On";
					//--
					$rtn_ini["WHER"] = " and A.`E_KBN_CODE` = 'RA' and A.`E_BM_CODE` In ('B01', 'B02')";
					//--
					break;
				case "LS_B02":
					$rtn_ini["HEAD"] = "らくらくエントリーの部";
					$rtn_ini["DEPA"] = "川柳・俳句・短歌";
					$rtn_ini["THEM"] = "「絆・つながり」";
					$rtn_ini["KIND"] = "";
					$rtn_ini["SIZE"] = "";
					$rtn_ini["ICON"] = "./images/icon/icon_haijin.png";
					$rtn_ini["BGC1"] = "page_ra";
					$rtn_ini["STAT"] = "Load-Str";
					$rtn_ini["VOTE"] = "Load-On";
					//--
					$rtn_ini["WHER"] = " and A.`E_KBN_CODE` = 'RA' and A.`E_BM_CODE` In ('B03', 'B04', 'B05')";
					//--
					break;
			}
			break;
		case "SET_DF":
			switch ($prm_sys["CD2"]) {
				case "LS_I01":
					$rtn_ini["HEAD"] = "投票方法";
					$rtn_ini["BGC1"] = "page_ab";
					//--
					break;
				case "LS_R01":
					$rtn_ini["HEAD"] = "投票ランキング";
					$rtn_ini["BGC1"] = "page_rk";
					//--
					break;
			}
			break;
	}
	//+----------------------
	//+ 戻り値
	//+----------------------
	return $rtn_ini;
}
//*******************************************************************
//* Func_Load_SchTools()：検索ツールを呼び出します。
//*------------------------------------------------------------------
//*  引数   ：$prm_indent ＝インデント
//*         ：$prm_whe    ＝設置データ配列
//*         ：$prm_val    ＝Formデータ配列
//*  戻り値 ：出力文字列(html)
//*******************************************************************
function Func_Load_SchTools($prm_indent, $prm_whe, $prm_val, $prm_div) {
	$rtn_value = "";
	//+----------------------
	//+ 検索：支部名／氏名
	//+----------------------
	$arr["tfm"] = "";
	for ($int_ix1 = 0 ; $int_ix1 < count($prm_whe); $int_ix1++) {
		$arr["txt"] = $prm_whe[$int_ix1]["TXT"];
		$arr["key"] = $prm_whe[$int_ix1]["KEY"];
		//--
		if ($arr["key"] == "DIV") {
			$arr["tnm"] = "SCH_" . $arr["key"];
			$arr["tid"] = "SCH_" . $arr["key"];
			$arr["val"] = Func_SetEncDate($prm_val[$arr["key"]], "", "\n");
			//--
			$arr["sel"] = "<select name=\"" . $arr["tnm"] . "\" id=\"" . $arr["tid"] . "\" class=\"w130 mr10\"><option value=\"\"></option>";
			
			for ($int_ix2 = 0 ; $int_ix2 < count($prm_div); $int_ix2++) {
				if ($prm_div[$int_ix2] == $arr["val"]) {
					$arr["mrk"] = " selected";
				} else {
					$arr["mrk"] = "";
				}
				$arr["sel"] .= "<option value=\"" . Func_SetEncDate($prm_div[$int_ix2], "", "\n") . "\"" . $arr["mrk"] . ">" . Func_SetEncDate($prm_div[$int_ix2], "", "\n") . "</option>";
			}
			
			$arr["sel"] .= "</select>";
			//--
			$arr["tfm"] .= $arr["txt"] . "：<span class=\"pl5 pr5\">" . $arr["sel"] . "</span>";
		} else {
			$arr["tnm"] = "SCH_" . $arr["key"];
			$arr["tid"] = "SCH_" . $arr["key"];
			$arr["val"] = Func_SetEncDate($prm_val[$arr["key"]], "", "\n");
			//--
			$arr["inp"] = "<input type=\"text\" name=\"" . $arr["tnm"] . "\" id=\"" . $arr["tid"] . "\" value=\"" . $arr["val"] . "\" class=\"w110 mr10\">";
			//--
			$arr["tfm"] .= $arr["txt"] . "：<span class=\"pl5 pr5\">" . $arr["inp"] . "</span>";
		}
	}
	//+----------------------
	//+ 検索：ボタン
	//+----------------------
	$arr["bnm"] = "SCH_BTN";
	$arr["bid"] = "SCH_BTN";
	//--
	$arr["btn"] = "<input type=\"button\" name=\"" . $arr["bnm"] . "\" id=\"" . $arr["bid"] . "\" class=\"w70\" value=\"検索\">";
	//--
	$arr["bfm"] = "<span class=\"pl0 pr5\">" . $arr["btn"] . "</span>";
	//+----------------------
	//+ 配置処理
	//+----------------------
	$rtn_value .= Func_Con_Write($prm_indent, "<div class=\"sch_tools pb5\">"	);
	$rtn_value .= Func_Con_Write($prm_indent, "	" . $arr["tfm"]					);
	$rtn_value .= Func_Con_Write($prm_indent, "	" . $arr["bfm"]					);
	$rtn_value .= Func_Con_Write($prm_indent, "</div>"							);
	//+----------------------
	//+ 戻り値
	//+----------------------
	return $rtn_value;
}
//*******************************************************************
//* Func_Load_SrtTools()：並替ツールを呼び出します。
//*------------------------------------------------------------------
//*  引数   ：$prm_indent ＝インデント
//*         ：$prm_ord    ＝設置データ配列
//*         ：$prm_val    ＝Formデータ配列
//*  戻り値 ：出力文字列(html)
//*******************************************************************
function Func_Load_SrtTools($prm_indent, $prm_ord, $prm_val) {
	$rtn_value = "";
	//+----------------------
	//+ ソート：整列対象
	//+----------------------
	$arr["snm"] = "SRT_ORD";
	$arr["sid"] = "SRT_ORD";
	//--
	$arr["sfm"] = "";
	for ($int_ix1 = 0 ; $int_ix1 < count($prm_ord); $int_ix1++) {
		$arr["txt"] = $prm_ord[$int_ix1]["TXT"];
		$arr["key"] = $prm_ord[$int_ix1]["KEY"];
		//--
		if ($prm_val["ORD"] == $arr["key"]) {
			$arr["mrk"] = " selected";
		} else {
			$arr["mrk"] = "";
		}
		$arr["sfm"] .= "<option value=\"" . $arr["key"] . "\"" . $arr["mrk"] . ">" . $arr["txt"] . "</option>";
	}
	$arr["sfm"] = "<select name=\"" . $arr["snm"] . "\" id=\"" . $arr["sid"] . "\">" . $arr["sfm"] . "</select>";
	//+----------------------
	//+ ソート：昇降順序
	//+----------------------
	$arr["cnm"] = "SRT_ASC";
	$arr["cid"] = "SRT_ASC";
	//--
	if ($prm_val["ORD"] == "") {
		$arr["txt"] = "―[ ―― ]";
		$arr["mrk"] = " disabled";
	} else {
		if ($prm_val["ASC"] == "desc") {
			$arr["txt"] = "▼[ 降順 ]";
			$arr["mrk"] = " checked";
		} else {
			$arr["txt"] = "▲[ 昇順 ]";
			$arr["mrk"] = "";
		}
	}
	$arr["cfm"] = "<label for=\"" . $arr["cid"] . "\">"
				.	"<input type=\"checkbox\" name=\"" . $arr["cnm"] . "\" id=\"" . $arr["cid"] . "\" value=\"desc\"" . $arr["mrk"] . ">"
				.	"<span class=\"text\">" . $arr["txt"] . "</span>"
				. "</label>";
	//+----------------------
	//+ 配置処理
	//+----------------------
	$rtn_value .= Func_Con_Write($prm_indent, "<div class=\"srt_tools pb5\">"					);
	$rtn_value .= Func_Con_Write($prm_indent, "	整列順序："										);
	$rtn_value .= Func_Con_Write($prm_indent, "	<span class=\"pr5\">" . $arr["sfm"] . "</span>"	);
	$rtn_value .= Func_Con_Write($prm_indent, "	<span class=\"pr5\">" . $arr["cfm"] . "</span>"	);
	$rtn_value .= Func_Con_Write($prm_indent, "</div>"											);
	//+----------------------
	//+ 戻り値
	//+----------------------
	return $rtn_value;
}
//*******************************************************************
//* Func_Load_PreTools()：表示ツールを呼び出します。
//*------------------------------------------------------------------
//*  引数   ：$prm_indent ＝インデント
//*         ：$prm_pre    ＝設置データ配列
//*         ：$prm_val    ＝Formデータ配列
//*  戻り値 ：出力文字列(html)
//*******************************************************************
function Func_Load_PreTools($prm_indent, $prm_pre, $prm_val, $prm_dsp) {
	$rtn_value = "";
	//+----------------------
	//+ プレビュ：筐体制御
	//+----------------------
	$arr["pre"] = "";
	//--
	$pre_itm = array(	array("PRE_FLG", "PRE_FLG_T", "T", "ON" ),
						array("PRE_FLG", "PRE_FLG_F", "F", "OFF")	);
	if ($prm_val["FLG"] == "") {
		$arr["tmp"] = "T";
	} else {
		$arr["tmp"] = $prm_val["FLG"];
	}
	//--
	for ($int_ix1 = 0 ; $int_ix1 < count($pre_itm); $int_ix1++) {
		$arr["rnm"] = $pre_itm[$int_ix1][0];
		$arr["rid"] = $pre_itm[$int_ix1][1];
		$arr["val"] = $pre_itm[$int_ix1][2];
		$arr["txt"] = $pre_itm[$int_ix1][3];
		$arr["mrk"] = ($arr["tmp"] == $arr["val"]) ? " checked" : "";
		//--
		$arr["pre"] .= "<input type=\"radio\" name=\"" . $arr["rnm"] . "\" id=\"" . $arr["rid"] . "\" value=\"" . $arr["val"] . "\"" . $arr["mrk"] . ">"
					.	"<label for=\"" . $arr["rid"] . "\">" . $arr["txt"] . "</label>";
	}
	//+----------------------
	//+ プレビュ：筐体状態
	//+----------------------
	$arr["hnm"] = "PRE_STT";
	$arr["hid"] = "PRE_STT";
	//--
	if ($prm_val["STT"] == "A" || $prm_val["STT"] == "") {
		$arr["val"] = "A";
	} else {
		$arr["val"] = "N";
	}
	//--
	$arr["mod"] = "<input type=\"hidden\" name=\"" . $arr["hnm"] . "\" id=\"" . $arr["hid"] . "\" value=\"" . $arr["val"] . "\">";
	//+----------------------
	//+ 情報取得
	//+----------------------
	if ($prm_pre == null) {
		$arr["htm"] = "<p class=\"note\">選択済の作品はありません。</p>";
	} else {
		$arr["htm"] = Func_Load_Drawing($prm_indent + 5, "GrpPreview", $prm_pre, $prm_dsp["STAT"]);
	}
	//+----------------------
	//+ 配置処理
	//+----------------------
	$rtn_value .= Func_Con_Write($prm_indent, "<div class=\"modctrl\">"												);
	$rtn_value .= Func_Con_Write($prm_indent, "	" . $arr["pre"]														);
	$rtn_value .= Func_Con_Write($prm_indent, "</div>"																);
	//--
	$rtn_value .= Func_Con_Write($prm_indent, "<dl class=\"modview\">"												);
	$rtn_value .= Func_Con_Write($prm_indent, "	<dt class=\"modhead clearfix\">"									);
	$rtn_value .= Func_Con_Write($prm_indent, "		<div class=\"mr10 floatLeft bold\">"							);
	$rtn_value .= Func_Con_Write($prm_indent, "			選択済の作品"												);
	$rtn_value .= Func_Con_Write($prm_indent, "		</div>"															);
	$rtn_value .= Func_Con_Write($prm_indent, "		<div class=\"ml10 floatRight\">"								);
	$rtn_value .= Func_Con_Write($prm_indent, "			<button type=\"button\" class=\"mod_btn\">"					);
	$rtn_value .= Func_Con_Write($prm_indent, "				<img src=\"./images/icon/win_ic1.png\">"				);
	$rtn_value .= Func_Con_Write($prm_indent, "			</button>"													);
	$rtn_value .= Func_Con_Write($prm_indent, "			<button type=\"button\" class=\"mod_cls\">close</button>"	);
	$rtn_value .= Func_Con_Write($prm_indent, "		</div>"															);
	$rtn_value .= Func_Con_Write($prm_indent, "		" . $arr["mod"]													);
	$rtn_value .= Func_Con_Write($prm_indent, "	</dt>"																);
	$rtn_value .= Func_Con_Write($prm_indent, "	<dd class=\"modcont clearfix\">"									);
	$rtn_value .= Func_Con_Write($prm_indent, "		<div class=\"moddata\">"										);
	$rtn_value .= Func_Con_Write($prm_indent, "			" . $arr["htm"]												);
	$rtn_value .= Func_Con_Write($prm_indent, "		</div>"															);
	$rtn_value .= Func_Con_Write($prm_indent, "	</dd>"																);
	$rtn_value .= Func_Con_Write($prm_indent, "</dl>"																);
	//+----------------------
	//+ 戻り値
	//+----------------------
	return $rtn_value;
}
//*******************************************************************
//* Func_Load_Drawing()：作品を呼び出します。
//*------------------------------------------------------------------
//*  引数   ：$prm_indent ＝インデント
//*         ：$prm_group  ＝設置種別（グループ名）
//*         ：$prm_array  ＝設置データ配列
//*  戻り値 ：出力文字列(html)
//*******************************************************************
function Func_Load_Drawing($prm_indent, $prm_group, $prm_array, $prm_typ) {
	$rtn_value = "";
	//+----------------------
	//+ 情報取得
	//+----------------------
	switch ($prm_typ) {
		case "Load-Img":
			$rtn_value = Func_Load_DrawingImgFrame($prm_indent, $prm_group, $prm_array);
			break;
		case "Load-Str":
			$rtn_value = Func_Load_DrawingStrFrame($prm_indent, $prm_group, $prm_array);
			break;
	}
	//+----------------------
	//+ 戻り値
	//+----------------------
	return $rtn_value;
}
//*******************************************************************
//* Func_Load_DrawingImgFrame()：作品描画(写真などイメージ作品用)フレームを呼び出します。
//*------------------------------------------------------------------
//*  引数   ：$prm_indent ＝インデント
//*         ：$prm_group  ＝設置種別（グループ名）
//*         ：$prm_array  ＝設置データ配列
//*  戻り値 ：出力文字列(html)
//*******************************************************************
function Func_Load_DrawingImgFrame($prm_indent, $prm_group, $prm_array) {
	$rtn_value = "";
	//+----------------------
	//+ 情報取得
	//+----------------------
	if ($prm_array == null) {
		$arr["htm"] = "";
	} else {
		$val_cd1 = $prm_array["ent_cd1"];										//* 区分
		$val_cd2 = $prm_array["ent_cd2"];										//* 部門
		$val_fnm = $prm_array["ent_fnm"];										//* 作品：ファイル名
		$val_ttl = $prm_array["ent_ttl"];										//* 作品：タイトル
		$poster =2;
		//+----------------------
		//+ 加工処理
		//+----------------------
		$arr["video"]= ' 
		<video
  id="videoPlayer"
    class="video-js vjs-default-skin vjs-big-play-centered w160 h160"
    controls
	playsinline 
    preload="metadata"
    width="160"
    height="160" 
    data-setup={}
	poster="https://www.sample-videos.com/video123/mp4/240/big_buck_bunny_240p_30mb.mp4#t=4";
  >
    <source src="https://www.sample-videos.com/video123/mp4/240/big_buck_bunny_240p_30mb.mp4" type="video/mp4" />
  </video>';
	$arr["src"]="https://www.sample-videos.com/video123/mp4/240/big_buck_bunny_240p_30mb.mp4";
		//
		$arr["rel"] = ($prm_group == "") ? "prettyPhoto" : "prettyPhoto[" . $prm_group . "]";
		$arr["anc"] = DF_PHO_IMG_PATH . "/" . $val_cd1 . "_" . $val_cd2 . "/" . $val_fnm;
		$arr["img"] = DF_PHO_IMG_PATH . "/" . $val_cd1 . "_" . $val_cd2 . "/" . DF_PHO_THU_FOLD . "/" . DF_PHO_THU_HEAD . $val_fnm;
		$arr["alt"] = Func_SetEncDate($val_ttl, "&nbsp;", "&nbsp;");
		//--
		//$arr["htm"] = "<a href=\"" . $arr["anc"] . "\" rel=\"" . $arr["rel"] . "\"><img class=\"dra_img\" src=\"" . $arr["img"] . "\" alt=\"" . $arr["alt"] . "\" /></a>";
		$arr["htm"] = "<a onloadstart=\"playVideo(this)\" ondblclick=\"videoDb(this)\"  href=\"javascript:void(0);\" rel=\"" . $arr["rel"] . "\">" . $arr["video"] . "</a> ";
	}
	//+----------------------
	//+ 配置処理　※描画領域は、フレームサイズより40px縮小。｛40px：(背景IMG高[15px]＋余白[5px])×2組｝
	//+----------------------
	$rtn_value .= Func_Con_Write($prm_indent, "<div class=\"phofrm m0 p0\"><!-- drawing frame -->"									);
	$rtn_value .= Func_Con_Write($prm_indent, "	<table class=\"frm_tbl w200 h200\">"												);
	$rtn_value .= Func_Con_Write($prm_indent, "		<tr><td class=\"TL\"></td><td class=\"TC\"></td><td class=\"TR\"></td></tr>"	);
	$rtn_value .= Func_Con_Write($prm_indent, "		<tr>"																			);
	$rtn_value .= Func_Con_Write($prm_indent, "			<td class=\"SL\"></td>"														);
	$rtn_value .= Func_Con_Write($prm_indent, "			<td class=\"IA w170 h170\">"												);
	$rtn_value .= Func_Con_Write($prm_indent, "				" . $arr["htm"]															);
	$rtn_value .= Func_Con_Write($prm_indent, "			</td>"																		);
	$rtn_value .= Func_Con_Write($prm_indent, "			<td class=\"SR\"></td>"														);
	$rtn_value .= Func_Con_Write($prm_indent, "		</tr>"																			);
	$rtn_value .= Func_Con_Write($prm_indent, "		<tr><td class=\"BL\"></td><td class=\"BC\"></td><td class=\"BR\"></td></tr>"	);
	$rtn_value .= Func_Con_Write($prm_indent, "	</table>"																			);
	$rtn_value .= Func_Con_Write($prm_indent, "</div>"																				);
	//+----------------------
	//+ 戻り値
	//+----------------------
	return $rtn_value;
}
//*******************************************************************
//* Func_Load_DrawingStrFrame()：作品描画(俳句など文字列作品用)フレームを呼び出します。
//*------------------------------------------------------------------
//*  引数   ：$prm_indent ＝インデント
//*         ：$prm_group  ＝設置種別（グループ名）
//*         ：$prm_array  ＝設置データ配列
//*  戻り値 ：出力文字列(html)
//*******************************************************************
function Func_Load_DrawingStrFrame($prm_indent, $prm_group, $prm_array) {
	$rtn_value = "";
	//+----------------------
	//+ 情報取得
	//+----------------------
	if ($prm_array == null) {
		$arr["cnt"] = 0;
		$arr["str"] = "";
	} else {
		$val_pem = $prm_array["ent_pem"];										//* 作品：川柳／俳句／短歌
		//+----------------------
		//+ 加工処理：置換/分割/整形
		//+----------------------
																				//* 置換
		$val_pem = str_replace(array("\r\n", "\r", "\n", "\f", "\t", "\v", "　", " "), "#%s%p%l%i%t#", $val_pem);
																				//* 分割
		$tmp_pem = explode("#%s%p%l%i%t#", $val_pem);
																				//* 整形
		$stc_idx = 0;
		$stc_pem = "";
		
		for ($tmp_ix1 = 0 ; $tmp_ix1 < count($tmp_pem); $tmp_ix1++) {
			if (Func_NoDataJudge($tmp_pem[$tmp_ix1]) == false) {
																				//* 文字列[有]
				switch ($stc_idx) {
					case 0:
						$stc_pem .= $tmp_pem[$tmp_ix1];
						break;
					case 3:
						$stc_pem .= "\n" . $tmp_pem[$tmp_ix1];
						break;
					default:
						$stc_pem .= " " . $tmp_pem[$tmp_ix1];
						break;
				}
																				//* カウントUP
				++$stc_idx;
			}
		}
		$arr["cnt"] = $stc_idx;
		$arr["str"] = $stc_pem;
	}
	if ($arr["cnt"] <= 3) {
		$arr["htm"] = "<p class=\"dra_pem pem_ln1 pt10 pr5 pl5\">" . Func_SetEncDate($arr["str"], "&nbsp;", "<br>") . "</p>";
	} else {
		$arr["htm"] = "<p class=\"dra_pem pem_ln2 pt10 pr5 pl5\">" . Func_SetEncDate($arr["str"], "&nbsp;", "<br>") . "</p>";
	}
	//+----------------------
	//+ 配置処理　※描画領域は、フレームサイズより40px縮小。｛40px：(背景IMG高[15px]＋余白[5px])×2組｝
	//+----------------------
	$rtn_value .= Func_Con_Write($prm_indent, "<div class=\"phofrm m0 p0\"><!-- drawing frame -->"									);
	$rtn_value .= Func_Con_Write($prm_indent, "	<table class=\"frm_tbl w110 h350\">"												);
	$rtn_value .= Func_Con_Write($prm_indent, "		<tr><td class=\"TL\"></td><td class=\"TC\"></td><td class=\"TR\"></td></tr>"	);
	$rtn_value .= Func_Con_Write($prm_indent, "		<tr>"																			);
	$rtn_value .= Func_Con_Write($prm_indent, "			<td class=\"SL\"></td>"														);
	$rtn_value .= Func_Con_Write($prm_indent, "			<td class=\"IA p5\">"														);
	$rtn_value .= Func_Con_Write($prm_indent, "				" . $arr["htm"]															);
	$rtn_value .= Func_Con_Write($prm_indent, "			</td>"																		);
	$rtn_value .= Func_Con_Write($prm_indent, "			<td class=\"SR\"></td>"														);
	$rtn_value .= Func_Con_Write($prm_indent, "		</tr>"																			);
	$rtn_value .= Func_Con_Write($prm_indent, "		<tr><td class=\"BL\"></td><td class=\"BC\"></td><td class=\"BR\"></td></tr>"	);
	$rtn_value .= Func_Con_Write($prm_indent, "	</table>"																			);
	$rtn_value .= Func_Con_Write($prm_indent, "</div>"																				);
	//+----------------------
	//+ 戻り値
	//+----------------------
	return $rtn_value;
}

/***********************Test******************/

/**
function Func_Load_DrawingImgFrame($prm_indent, $prm_group, $prm_array) {
	$rtn_value = "";
	//+----------------------
	//+ 情報取得
	//+----------------------
	if ($prm_array == null) {
		$arr["htm"] = "";
	} else {
		$val_cd1 = $prm_array["ent_cd1"];										//* 区分
		$val_cd2 = $prm_array["ent_cd2"];										//* 部門
		$val_fnm = $prm_array["ent_fnm"];										//* 作品：ファイル名
		$val_ttl = $prm_array["ent_ttl"];										//* 作品：タイトル
		//+----------------------
		//+ 加工処理
		//+----------------------
		$arr["rel"] = ($prm_group == "") ? "prettyPhoto" : "prettyPhoto[" . $prm_group . "]";
		$arr["anc"] = DF_PHO_IMG_PATH . "/" . $val_cd1 . "_" . $val_cd2 . "/" . $val_fnm;
		$arr["img"] = DF_PHO_IMG_PATH . "/" . $val_cd1 . "_" . $val_cd2 . "/" . DF_PHO_THU_FOLD . "/" . DF_PHO_THU_HEAD . $val_fnm;
		$arr["alt"] = Func_SetEncDate($val_ttl, "&nbsp;", "&nbsp;");
		//--
		$arr["htm"] = "<a href=\"" . $arr["anc"] . "\" rel=\"" . $arr["rel"] . "\"><img class=\"dra_img\" src=\"" . $arr["img"] . "\" alt=\"" . $arr["alt"] . "\" /></a>";
		
	}
	//+----------------------
	//+ 配置処理　※描画領域は、フレームサイズより40px縮小。｛40px：(背景IMG高[15px]＋余白[5px])×2組｝
	//+----------------------
	$rtn_value .= Func_Con_Write($prm_indent, "<div class=\"phofrm m0 p0\"><!-- drawing frame -->"									);
	$rtn_value .= Func_Con_Write($prm_indent, "	<table class=\"frm_tbl w200 h200\">"												);
	$rtn_value .= Func_Con_Write($prm_indent, "		<tr><td class=\"TL\"></td><td class=\"TC\"></td><td class=\"TR\"></td></tr>"	);
	$rtn_value .= Func_Con_Write($prm_indent, "		<tr>"																			);
	$rtn_value .= Func_Con_Write($prm_indent, "			<td class=\"SL\"></td>"														);
	$rtn_value .= Func_Con_Write($prm_indent, "			<td class=\"IA w170 h170\">"												);
	$rtn_value .= Func_Con_Write($prm_indent, "				" . $arr["htm"]															);
	$rtn_value .= Func_Con_Write($prm_indent, "			</td>"																		);
	$rtn_value .= Func_Con_Write($prm_indent, "			<td class=\"SR\"></td>"														);
	$rtn_value .= Func_Con_Write($prm_indent, "		</tr>"																			);
	$rtn_value .= Func_Con_Write($prm_indent, "		<tr><td class=\"BL\"></td><td class=\"BC\"></td><td class=\"BR\"></td></tr>"	);
	$rtn_value .= Func_Con_Write($prm_indent, "	</table>"																			);
	$rtn_value .= Func_Con_Write($prm_indent, "</div>"																				);
	//+----------------------
	//+ 戻り値
	//+----------------------
	return $rtn_value;
}
**/
/*****************Test End************************/




/**************Get thumbnail***********************/

?>