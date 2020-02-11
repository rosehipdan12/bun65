
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
	var str_adm = "";
	//---------------------//
	// セッション有無判定
	//---------------------//
	var rc_resu = Func_UserSsnJudge();
	str_stt = rc_resu["stt"];
	str_msg = rc_resu["msg"];
	str_uid = rc_resu["uid"];
	str_unm = rc_resu["unm"];
	str_mod = rc_resu["mod"];													//** エラー処理
	str_adm = rc_resu["adm"];
	
	
	if (str_stt != "Err") {
		
		// if (str_adm == "1"){
			// window.location.href = '../mnt/entry1.php';
		// }

		//---------------------//
		// 設置：
		//---------------------//
		if (str_stt == "REGISTER") {
			$(".headstat p").html("");
															//** Nav-Form
			$(".headnavi p").html("");
															//** Pan-Form
			$(".headmenu p").html("<span>■</span>REGISTER画面");

			Sub_SetRegForm();

		} else if (str_stt == "OK") {
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
			$(".headmenu p").html("<span>■</span>ログイン画面");
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
			str_adm = $(this).find("adm").text();
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
	return { stt : str_stt, msg : str_msg, uid : str_uid, unm : str_unm, mod : str_mod, htm : str_htm, adm : str_adm};
}
/*******************************************************
* Sub_SetSttForm：設置：Stt-Form
*******************************************************/
function Sub_SetSttForm() {
	var str_htm = "";
	//---------------------//
	// 読込：Stt-Form領域
	//---------------------//
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
	return;
}

/*******************************************************
* Sub_SetRegForm：設置：Reg-Form
*******************************************************/
function Sub_SetRegForm() {
	var str_htm = "";
	var str_prm = $("form[name='F1']").serialize();
	//---------------------//
	// 読込：Log-Form領域
	//---------------------//
	$.ajax({
		type   : "POST",
		url    : "./main/menu/htm_Set_RegForm.php",
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
	var str_stt = "";
	var str_msg = "";
	var str_unm = "";
	var str_mod = "";
	var str_upw = "";
	var inp_uid = $("form[name='F_LOG'] input[name='INP_UID']").val();
	var inp_upw = $("form[name='F_LOG'] input[name='INP_UPW']").val();
	var inp_mod = $("form[name='F_LOG'] input[name='INP_MOD']:checked").val();
	if (TRM_R(inp_uid) == "") {
		alert("Username cannot be null");
		$("#LOG_INP_UID").focus();
		$("#LOG_INP_UID").select();
		return;
	}

	if (TRM_R(inp_upw) == "") {
		alert("Password cannot be null");
		$("#LOG_INP_UPW").focus();
		$("#LOG_INP_UPW").select();
		return;
	}
	var rc_resu = Func_UserInpJudge(inp_uid, inp_mod, inp_upw, "login");
	
	str_stt = rc_resu["stt"];
	str_msg = rc_resu["msg"];
	str_unm = rc_resu["unm"];
	str_upw = rc_resu["upw"];
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
* Click_REG：操作：ログイン
*******************************************************/
function Click_REG() {
	var inp_csv = $("form[name='F_REG'] input[name='INP_CSV']").val();

	if (inp_csv == "") {
		alert("Please choose a csv file! ");
		return;
	}
	csv = $("form[name='F_REG'] input[name='INP_CSV']").prop('files')[0];
	var rc_resu = Func_UserImport(csv);

	str_msg = rc_resu["msg"];
	
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

function Redirect_REG() {
	var rc_resu = Func_UserInpJudge("", "", "", "register");

	str_msg = rc_resu["msg"];
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

function Redirect_MAIN() {
	var rc_resu = Func_UserInpJudge("", "", "", "main");

	str_msg = rc_resu["msg"];
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
	var str_unm = "";
	var str_mod = "";
	var str_upw = "";

	
	if (!confirm("ログアウトしますか？")) {
		return;
	}
	var rc_resu = Func_UserInpJudge("", "", "", "logout");
	str_stt = rc_resu["stt"];
	str_msg = rc_resu["msg"];
	str_unm = rc_resu["unm"];
	str_mod = rc_resu["mod"];
	str_upw = rc_resu["upw"];
	//---------------------//
	// ページ再描画
	//---------------------//
;	if (str_msg == "") {
		SET_MENU();
	} else {
		alert(str_msg);
	}
	return;
}
/*******************************************************
* Func_UserInpJudge：フォーム判定
*******************************************************/
function Func_UserInpJudge(prm_uid, prm_mod, prm_upw, prm_flg) {
	var str_stt = "";
	var str_msg = "";
	var str_uid = "";
	var str_mod = "";
	var str_htm = "";
	var str_upw = "";
	//---------------------//
	// 読込：フォーム判定ページ
	//---------------------//
	$.ajax({
		type   : "POST",
		url    : "./main/menu/xml_Chk_UserInp.php",
		async  : false,
		cache  : false,
		data   : { PRM_UID : prm_uid, PRM_MOD : prm_mod, PRM_UPW : prm_upw, PRM_FLG : prm_flg },
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
			str_upw = $(this).find("upw").text();
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
	return { stt : str_stt, msg: str_msg, uid : str_uid, upw : str_upw, mod : str_mod, htm : str_htm, unm : str_unm };
}

/*******************************************************
* Func_UserInpJudge：フォーム判定
*******************************************************/
function Func_UserImport(prm_csv) {
	var str_msg = "";
	csv = $("form[name='F_REG'] input[name='INP_CSV']").prop('files')[0];
	
	if (!(csv && csv.size < 104857600)) {
		str_msg = "File size exceeds 100MB!";
		return { msg: str_msg };
	}
	
	var fd = new FormData();
	fd.append('file', csv);
	
	//---------------------//
	// 読込：フォーム判定ページ
	//---------------------//
	$.ajax({
		type   : "POST",
		url    : "./main/menu/xml_Chk_UserReg.php",
		async  : false,
		cache  : false,
		processData: false, 
		contentType: false,
		data   : fd,
	}).done(function( data, textStatus, jqXHR ) {
		//---------------------//
		// 正常処理
		//---------------------//
		$(data).find("reData").each(function() {
			str_msg = $(this).attr("message");
		});
		$(data).find("reHtml").each(function() {
			str_htm = $(this).html();
		});
		
	}).fail(function( jqXHR, textStatus, errorThrown ) {
		//---------------------//
		// 失敗処理
		//---------------------//
		switch (jqXHR.status) {
			case 404:
					alert("Error : " + errorThrown);
					break;
			case 500:
					alert("Error : " + errorThrown);
					break;
	      default:
	        	alert("Error : File not found");
	    }
		
	});
	return { msg: str_msg };
}


/**********************************************************
Load navbar
*********************************************************/
function loadNavbar(){
  $('.dropdown a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
	console.log("Click");
    e.preventDefault();
  });
}

function showNav(prm_Btn){
	var nav = document.getElementById("topNavBar");

  // If the checkbox is checked, display the output text
  if (prm_Btn.checked == true){
    nav.style.display = "block";
  } else {
    nav.style.display = "none";
  }
}
  window.onload = function(){
	  var btn = document.getElementById("show-menu");
	  btn.checked=false;
  };


	


//-->