<!--
/***********************************************************************
/*	＜総合文化展＞	mn_set_menu.js
/*	
/*		概  要：外部ファイル
/*
/*		備  考：なし
/*
/*		Code By		2016/02/01	System Nicol Co.,Ltd	新規
/*
/*		Copyright (c) 2016 System Nicol Co.,Ltd All rights reserved.
/**********************************************************************/

/*******************************************************
* SET_MENU：初期設定
*******************************************************/
function SET_MENU() {
	var str_stt = "";
	var str_msg = "";
	var str_uid = "";
	var str_unm = "";
	var str_mod = "";
	//---------------------//
	// セッション有無判定
	//---------------------//
	var rc_resu = Func_UserSsnJudge();
	str_stt = rc_resu["stt"];
	str_msg = rc_resu["msg"];
	str_uid = rc_resu["uid"];
	str_unm = rc_resu["unm"];
	str_mod = rc_resu["mod"];
															//** エラー処理
	if (str_stt != "Err") {
		//---------------------//
		// 設置：
		//---------------------//
		if (str_stt == "OK") {
															//** Stt-Form
			Sub_SetSttForm();
															//** Nav-Form
			Sub_SetNavForm();
															//** ログイン後ページ切替
			if (str_mod == "1") {
				SET_PAGE("SET_DF", "LS_I01");
			} else {
				SET_PAGE("SET_RI", "LS_P01");
			}
		} else {
															//** Stt-Form
			$(".headstat p").html("");
															//** Nav-Form
			$(".headnavi p").html("");
															//** Pan-Form
			$(".headmenu p").html("");
															//** Log-Form
			Sub_SetLogForm();
															//** Log-Focus
			$("#LOG_INP_UID").focus();
		}
	} else {
		alert(str_msg);
	}
	return;
}
/*******************************************************
* Func_UserSsnJudge：セッション判定
*******************************************************/
function Func_UserSsnJudge() {
	var str_stt = "";
	var str_msg = "";
	var str_uid = "";
	var str_unm = "";
	var str_mod = "";
	var str_htm = "";
	//---------------------//
	// 読込：セッション判定ページ
	//---------------------//
/*
	$.ajax({
		type   : "POST",
		url    : "./main/menu/xml_Chk_UserSsn.php",
		async  : false,
		cache  : false,
		data   : { },
	}).done(function( data, textStatus, jqXHR ) {
		//---------------------//
		// 正常処理
		//---------------------//
		$(data).find("reData").each(function() {
			str_stt = $(this).attr("status");
			str_msg = $(this).attr("message");
			str_uid = $(this).find("uid").text();
			str_unm = $(this).find("unm").text();
			str_mod = $(this).find("mod").text();
		});
		$(data).find("reHtml").each(function() {
			str_htm = $(this).html();
		});
	}).fail(function( jqXHR, textStatus, errorThrown ) {
		//---------------------//
		// 失敗処理
		//---------------------//
		alert("Error : " + errorThrown);
	});
*/
	return { stt : str_stt, msg : str_msg, uid : str_uid, unm : str_unm, mod : str_mod, htm : str_htm };
}
/*******************************************************
* Sub_SetSttForm：設置：Stt-Form
*******************************************************/
function Sub_SetSttForm() {
	var str_htm = "";
	//---------------------//
	// 読込：Stt-Form領域
	//---------------------//
/*
	$.ajax({
		type   : "POST",
		url    : "./main/menu/htm_Set_SttForm.php",
		async  : false,
		cache  : false,
		data   : { },
	}).done(function( data, textStatus, jqXHR ) {
		//---------------------//
		// 正常処理
		//---------------------//
		$(data).find("reHtml").each(function() {
			str_htm = $(this).html();
		});
		$(".headstat p").html(str_htm);
	}).fail(function( jqXHR, textStatus, errorThrown ) {
		//---------------------//
		// 失敗処理
		//---------------------//
		alert("Error : " + errorThrown);
	});
*/
	return;
}
/*******************************************************
* Sub_SetNavForm：設置：Nav-Form
*******************************************************/
function Sub_SetNavForm() {
	var str_htm = "";
	//---------------------//
	// 読込：Nav-Form領域
	//---------------------//
/*
	$.ajax({
		type   : "POST",
		url    : "./main/menu/htm_Set_NavForm.php",
		async  : false,
		cache  : false,
		data   : { },
	}).done(function( data, textStatus, jqXHR ) {
		//---------------------//
		// 正常処理
		//---------------------//
		$(data).find("reHtml").each(function() {
			str_htm = $(this).html();
		});
		$(".headnavi p").html(str_htm);
		//---------------------//
		// 挙動指定（検索/ソート）
		//---------------------//
		Sub_SetNaviCtrl();
	}).fail(function( jqXHR, textStatus, errorThrown ) {
		//---------------------//
		// 失敗処理
		//---------------------//
		alert("Error : " + errorThrown);
	});
*/
	return;
}
/*******************************************************
* Sub_SetLogForm：設置：Log-Form
*******************************************************/
function Sub_SetLogForm() {
	var str_htm = "";
	var str_prm = $("form[name='F1']").serialize();
	//---------------------//
	// 読込：Log-Form領域
	//---------------------//
/*
	$.ajax({
		type   : "POST",
		url    : "./main/menu/htm_Set_LogForm.php",
		async  : false,
		cache  : false,
		data   : str_prm,
	}).done(function( data, textStatus, jqXHR ) {
		//---------------------//
		// 正常処理
		//---------------------//
		$(data).find("reHtml").each(function() {
			str_htm = $(this).html();
		});
		$("#contpostDrawing").html(str_htm);
	}).fail(function( jqXHR, textStatus, errorThrown ) {
		//---------------------//
		// 失敗処理
		//---------------------//
		alert("Error : " + errorThrown);
	});
*/
	return;
}
/*******************************************************
* Sub_SetNaviCtrl：挙動指定（ナビ）
*******************************************************/
function Sub_SetNaviCtrl() {
	//---------------------//
	// 初期設定
	//---------------------//
															//** 全[li]の(active)除去
	$("ul.navimenu dd.nv_hid").hide();
															//** 最初の要素を選択
	$("ul.navimenu li.nv_tab:first").each(
		function(e) {
			$(this).children("dl").children("dd.nv_hid").each(
				function(e) {
					$(this).children("ul").children("li.nv_pan:first").addClass("active");
				}
			).show();
		}
	).addClass("active");
	//---------------------//
	// クリック操作設定
	//---------------------//
	$("ul.navimenu dt.nv_ttl > a").click(
		function() {
			//---------------------//
			// [tab]制御
			//---------------------//
															//** 全[li]の(active)除去
			$("ul.navimenu li.nv_tab").removeClass("active");
															//** 親[li]に(active)付与
			$(this).parent().parent().parent("li").addClass("active");
			//---------------------//
			// [hid]制御
			//---------------------//
															//** 全[dd.nv_hid]を非表示
			$("ul.navimenu dd.nv_hid").hide();
															//** 親[dd.nv_hid]の次[dd.nv_hid]を表示
			if ($(this).parent("dt.nv_ttl").next("dd.nv_hid")[0]) {
				$(this).parent("dt.nv_ttl").next("dd.nv_hid").show();
			} else {
				$("ul.navimenu li.nv_pan").removeClass("active");
			}
		}
	);
	//---------------------//
	// クリック操作設定
	//---------------------//
	$("ul.navimenu li.nv_pan > a").click(
		function() {
			$("ul.navimenu li.nv_pan").removeClass("active");
			$(this).parent("li").addClass("active");
		}
	);
	return;
}
/*******************************************************
* Click_LOGIN：操作：ログイン
*******************************************************/
function Click_LOGIN() {
	location.href = "./2_トップ.html";
	return;

	
	var str_stt = "";
	var str_msg = "";
	var str_uid = "";
	var str_unm = "";
	var str_mod = "";
	var inp_uid = $("form[name='F_LOG'] input[name='INP_UID']").val();
	var inp_unm = $("form[name='F_LOG'] input[name='INP_UNM']").val();
	var inp_mod = $("form[name='F_LOG'] input[name='INP_MOD']:checked").val();
	if (TRM_R(inp_uid) == "") {
		alert("従業員番号を入力してください。");
		$("#LOG_INP_UID").focus();
		$("#LOG_INP_UID").select();
		return;
	}
	var rc_resu = Func_UserInpJudge(inp_uid, inp_unm, inp_mod, "login");
	str_stt = rc_resu["stt"];
	str_msg = rc_resu["msg"];
	str_uid = rc_resu["uid"];
	str_unm = rc_resu["unm"];
	str_mod = rc_resu["mod"];
	//---------------------//
	// ページ再描画
	//---------------------//
	if (str_msg == "") {
		SET_MENU();
	} else {
		alert(str_msg);
	}
	return;
}
/*******************************************************
* Click_LOG_BTN：操作：ログアウト
*******************************************************/
function Click_LOGOUT() {
	var str_stt = "";
	var str_msg = "";
	var str_uid = "";
	var str_unm = "";
	var str_mod = "";
	
	if (!confirm("ログアウトしますか？")) {
		return;
	}
	var rc_resu = Func_UserInpJudge("", "", "", "logout");
	str_stt = rc_resu["stt"];
	str_msg = rc_resu["msg"];
	str_uid = rc_resu["uid"];
	str_unm = rc_resu["unm"];
	str_mod = rc_resu["mod"];
	//---------------------//
	// ページ再描画
	//---------------------//
	if (str_msg == "") {
		SET_MENU();
	} else {
		alert(str_msg);
	}
	return;
}
/*******************************************************
* Func_UserInpJudge：フォーム判定
*******************************************************/
function Func_UserInpJudge(prm_uid, prm_unm, prm_mod, prm_flg) {
	var str_stt = "";
	var str_msg = "";
	var str_uid = "";
	var str_unm = "";
	var str_mod = "";
	var str_htm = "";
	//---------------------//
	// 読込：フォーム判定ページ
	//---------------------//
/*
	$.ajax({
		type   : "POST",
		url    : "./main/menu/xml_Chk_UserInp.php",
		async  : false,
		cache  : false,
		data   : { PRM_UID : prm_uid, PRM_UNM : prm_unm, PRM_MOD : prm_mod, PRM_FLG : prm_flg },
	}).done(function( data, textStatus, jqXHR ) {
		//---------------------//
		// 正常処理
		//---------------------//
		$(data).find("reData").each(function() {
			str_stt = $(this).attr("status");
			str_msg = $(this).attr("message");
			str_uid = $(this).find("uid").text();
			str_unm = $(this).find("unm").text();
			str_mod = $(this).find("mod").text();
		});
		$(data).find("reHtml").each(function() {
			str_htm = $(this).html();
		});
	}).fail(function( jqXHR, textStatus, errorThrown ) {
		//---------------------//
		// 失敗処理
		//---------------------//
		alert("Error : " + errorThrown);
	});
*/
	return { stt : str_stt, msg: str_msg, uid : str_uid, unm : str_unm, mod : str_mod, htm : str_htm };
}
//-->