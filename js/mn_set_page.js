<!--
/***********************************************************************
/*	＜総合文化展＞	mn_set_page.js
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
* SET_PAGE：ページ設定
*******************************************************/
function SET_PAGE(prm_cd1, prm_cd2) {
	var arr_pan = [];
	var str_pan = "";
	var str_src = "";
															//** 引数初期値設定
	if (prm_cd1 == null) prm_cd1 = "SET_DF";
	if (prm_cd2 == null) prm_cd2 = "LS_I01";
	//---------------------//
	// 遷移先ページ指定
	//---------------------//
	switch (prm_cd1) {
		//---------------------//
		// ■ 力作じまん
		//---------------------//
		case "SET_RI":
			switch (prm_cd2) {
				//---------------------//
				// ■ 大人の部
				//---------------------//
				case "LS_P01":
					arr_pan.splice(0, 0, "力作じまんの部", "大人の部", "絵画部門");
					str_src = "./main/page/ri_list_par.php";
					
					break;
				case "LS_P02":
					arr_pan.splice(0, 0, "力作じまんの部", "大人の部", "書道部門");
					str_src = "./main/page/ri_list_par.php";
					
					break;
				case "LS_P03":
					arr_pan.splice(0, 0, "力作じまんの部", "大人の部", "写真部門");
					str_src = "./main/page/ri_list_par.php";
					
					break;
				case "LS_P04":
					arr_pan.splice(0, 0, "力作じまんの部", "大人の部", "手芸・工芸部門");
					str_src = "./main/page/ri_list_par.php";
					
					break;
				//---------------------//
				// ■ 子供の部
				//---------------------//
				case "LS_C01":
					arr_pan.splice(0, 0, "力作じまんの部", "子供の部", "絵画部門");
					str_src = "./main/page/ri_list_chi.php";
					
					break;
				case "LS_C02":
					arr_pan.splice(0, 0, "力作じまんの部", "子供の部", "書道部門");
					str_src = "./main/page/ri_list_chi.php";
					
					break;
				default:
					break;
			}
			break;
		//---------------------//
		// ■ らくらくエントリー
		//---------------------//
		case "SET_RA":
			switch (prm_cd2) {
				case "LS_B01":
					arr_pan.splice(0, 0, "らくらくエントリーの部", "写真・イラスト部門");
					str_src = "./main/page/ra_list_img.php";
					
					break;
				case "LS_B02":
					arr_pan.splice(0, 0, "らくらくエントリーの部", "川柳・俳句・短歌部門");
					str_src = "./main/page/ra_list_pem.php";
					
					break;
				default:
					break;
			}
			break;
		//---------------------//
		// ■ その他
		//---------------------//
		case "SET_DF":
			switch (prm_cd2) {
				case "LS_I01":
					arr_pan.splice(0, 0, "投票方法");
					str_src = "./main/page/df_list_inf_help.php";
					
					break;
				case "LS_R01":
					arr_pan.splice(0, 0, "投票ランキング");
					str_src = "./main/page/df_list_inf_rank.php";
					
					break;
				default:
					break;
			}
			break;
		default:
			break;
	}
	//---------------------//
	// パン屑リスト設置
	//---------------------//
	for (var pan_ix1 = 0; pan_ix1 < arr_pan.length; pan_ix1++) {
		if (pan_ix1 == 0) {
			str_pan = "<span class=\"ml5 mr5\">■</span>" + arr_pan[pan_ix1];
		} else {
			str_pan += "<span class=\"ml5 mr5\">&gt;</span>" + arr_pan[pan_ix1];
		}
	}
	$(".headmenu p").html(str_pan);
	//---------------------//
	// 遷移：描画処理
	//---------------------//
	if (str_src != "") {
		Sub_SetConForm(prm_cd1, prm_cd2, str_src, 0, 1);
	}
	return;
}
/*******************************************************
* Sub_SetConForm：遷移：描画処理
*******************************************************/
function Sub_SetConForm(prm_cd1, prm_cd2, prm_src, prm_flg, prm_top) {
															//** パラメタ設定
	if (prm_flg == 0) {
		var str_src = prm_src;
		var str_prm = "PRM_CD1=" + prm_cd1 + "&PRM_CD2=" + prm_cd2 + "&PRM_SRC=" + prm_src;
	} else {
		var str_src = $("form[name='F1']").children("input[name='PRM_SRC']").val();
		var str_prm = $("form[name='F1']").serialize();
	}
															//** 先頭ジャンプ
	if (prm_top == 1) {
		location.hash = "TOP" ;
	}
	//---------------------//
	// 読込：遷移先ページ
	//---------------------//
	$.ajax({
		type   : "POST",
		url    : str_src,
		async  : true,
		cache  : false,
		data   : str_prm,
	}).done(function( data, textStatus, jqXHR ) {
		//---------------------//
		// 正常処理
		//---------------------//
		$("#contpostDrawing").html(data);
		//---------------------//
		// 挙動指定（PrettyPhoto）
		//---------------------//
		$("div.phofrm a[rel^='prettyPhoto']").prettyPhoto(
			{
				show_title		: true,						//** trueの場合、img要素のalt属性に指定した内容を写真の左上にタイトルして表示します。
				animation_speed	: "fast",					//** アニメーション速度[fast/normal/slow]
				deeplinking		: false,					//** ディープリンキング[true/false]
				overlay_gallery	: false						//** スライドギャラリー[true/false]
			}
		);
		//---------------------//
		// 挙動指定（検索/ソート）
		//---------------------//
		Sub_SetToolsCtrl();
		//---------------------//
		// 挙動指定（プレビュー）
		//---------------------//
		Sub_SetPreviewCtrl();
		//---------------------//
		// 挙動指定（投票）
		//---------------------//
		Sub_SetVoteCtrl();
		
	}).fail(function( jqXHR, textStatus, errorThrown ) {
		//---------------------//
		// 失敗処理
		//---------------------//
		alert("Error : " + errorThrown);
	});
	return;
}
/*******************************************************
* Sub_SetToolsCtrl：挙動指定（検索/ソート）
*******************************************************/
function Sub_SetToolsCtrl() {
	//---------------------//
	// クリック操作設定：検索ボタン
	//---------------------//
	$("input[id='SCH_BTN']").click(
		function(e) {
			Sub_SetConForm("", "", "", 1, 0);
		}
	);
	//---------------------//
	// クリック操作設定：整列項目
	//---------------------//
	$("select[id='SRT_ORD']").change(
		function(e) {
			Sub_SetConForm("", "", "", 1, 0);
		}
	);
	//---------------------//
	// クリック操作設定：昇降順序
	//---------------------//
	$("input[id='SRT_ASC']").click(
		function(e) {
			Sub_SetConForm("", "", "", 1, 0);
		}
	);
	return;
}
/*******************************************************
* Sub_SetPreviewCtrl：挙動指定（プレビュー）
*******************************************************/
function Sub_SetPreviewCtrl() {
	//---------------------//
	// 初期設定：筐体制御
	//---------------------//
	$(".modctrl input[name='PRE_FLG']:checked").each(
		function(e) {
			if ($(this).val() == "F") {
				$(".modview").fadeOut(200);
			} else {
				$(".modview").fadeIn(200);
			}
		}
	);
	//---------------------//
	// クリック操作設定：筐体制御
	//---------------------//
	$(".modctrl input[name='PRE_FLG']").click(
		function(e) {
			if ($(this).val() == "F") {
				$(".modview").fadeOut(200);
			} else {
				$(".modview").fadeIn(200);
			}
		}
	);
	//---------------------//
	// 初期設定：筐体状態
	//---------------------//
	$(".modview input[name='PRE_STT']").each(
		function(e) {
			if ($(this).val() == "A") {
				$(".modview button.mod_btn").addClass("active");
				$(".modcont").fadeIn(0);
			} else {
				$(".modview button.mod_btn").removeClass("active");
				$(".modcont").fadeOut(0);
			}
		}
	);
	//---------------------//
	// クリック操作設定：
	//---------------------//
	$(".modview button.mod_btn").click(
		function(e) {
			$(this).toggleClass("active");
			if ($(this).hasClass("active")) {
				$(".modview input[name='PRE_STT']").val("A");
				$(".modcont").fadeIn(0);
			} else {
				$(".modview input[name='PRE_STT']").val("N");
				$(".modcont").fadeOut(0);
			}
		}
	);
	//---------------------//
	// クリック操作設定：
	//---------------------//
	$(".modview button.mod_cls").click(
		function(e) {
			$(".modctrl input[name='PRE_FLG']").each(
				function(e) {
					if ($(this).val() == "F") {
						$(this).attr("checked", true);
					} else {
						$(this).attr("checked", false);
					}
				}
			);
			$(".modview").fadeOut(200);
		}
	);
	return;
}
/*******************************************************
* Sub_SetVoteCtrl：挙動指定（投票）
*******************************************************/
function Sub_SetVoteCtrl() {
	//---------------------//
	// 初期設定
	//---------------------//
	$(".gallery input[id^='VOT_VOT']").css(
		{ "opacity": "0" }
	).each(
		function(e) {
			if ($(this).attr("checked") == "checked") {
				$(".gallery label[for='" + $(this).attr("id") + "']").addClass("voteReady");
				$(".gallery label[for='" + $(this).attr("id") + "']").children("span.text").html("選択済");
				//--
				$(".gallery li[id='li_SetEdge" + $(this).val() + "']").addClass("setReady");
			} else {
				$(".gallery label[for='" + $(this).attr("id") + "']").removeClass("voteReady");
				$(".gallery label[for='" + $(this).attr("id") + "']").children("span.text").html("投票する");
				//--
				$(".gallery li[id='li_SetEdge" + $(this).val() + "']").removeClass("setReady");
			}
		}
	);
	//---------------------//
	// クリック操作設定
	//---------------------//
	$(".gallery input[id^='VOT_VOT']").click(
		function(e) {
			var str_stt = "";
			var str_msg = "";
			var str_htm = "";
			//---------------------//
			// セッション有無判定
			//---------------------//
			var rc_resu = Func_UserSsnJudge();
			str_stt = rc_resu["stt"];
			str_msg = rc_resu["msg"];
															//** ログイン済み
			if (str_stt == "OK") {
				//---------------------//
				// 投票処理の分岐｛取消する・投票する｝
				//---------------------//
				if ($("input[name='VOT_STC']").val() == $(this).val()) {
					var  vot_msg = "■ 取消確認 ■\n　この作品への投票を取り消しますか？";
					var  vot_flg = "DEL";
					var  vot_stc = "";
				} else {
					var  vot_msg = "■ 作品投票 ■\n　この作品に投票しますか？\n　カテゴリ内で最後に投票した１作品が有効となります。\n";
					var  vot_flg = "INS";
					var  vot_stc = $(this).val();
				}
				//---------------------//
				// 投票処理の実行
				//---------------------//
				if (confirm(vot_msg)) {
					var rc_resu = Func_PrcVote(vot_flg);
					str_stt = rc_resu["stt"];
					str_msg = rc_resu["msg"];
					str_htm = rc_resu["htm"];
															//** 取消・登録完了
					if (str_stt == "OK") {
						//---------------------//
						// 投票した作品IDのストック処理
						//---------------------//
						$("input[name='VOT_STC']").val(vot_stc);
						//---------------------//
						// 投票した作品IDのプレビュー処理
						//---------------------//
						if (str_htm == "") {
							$(".modview div.moddata").html("<p class=\"note\">選択済の作品はありません。<p>");
						} else {
							$(".modview div.moddata").html(str_htm);
						}
						$(".modview div.phofrm a[rel^='prettyPhoto']").prettyPhoto(
							{
								show_title		: true,
								animation_speed	: "fast",
								deeplinking		: false,
								overlay_gallery	: false
							}
						);
						//---------------------//
						// 投票ボタンの状態処理
						//---------------------//
						$(".gallery input[id^='VOT_VOT']").each(
							function(e) {
								if (vot_flg == "DEL") {
									$(this).attr("checked", false);
									$(".gallery label[for='" + $(this).attr("id") + "']").removeClass("voteReady");
									$(".gallery label[for='" + $(this).attr("id") + "']").children("span.text").html("投票する");
									//--
									$(".gallery li[id='li_SetEdge" + $(this).val() + "']").removeClass("setReady");
								} else {
									if ($(this).attr("checked") == "checked") {
										$(".gallery label[for='" + $(this).attr("id") + "']").addClass("voteReady");
										$(".gallery label[for='" + $(this).attr("id") + "']").children("span.text").html("選択済");
										//--
										$(".gallery li[id='li_SetEdge" + $(this).val() + "']").addClass("setReady");
									} else {
										$(".gallery label[for='" + $(this).attr("id") + "']").removeClass("voteReady");
										$(".gallery label[for='" + $(this).attr("id") + "']").children("span.text").html("投票する");
										//--
										$(".gallery li[id='li_SetEdge" + $(this).val() + "']").removeClass("setReady");
									}
								}
							}
						);
					} else {
						e.preventDefault();
					}
				} else {
					e.preventDefault();
				}
			} else {
				e.preventDefault();
			}
			if (str_msg != "") {
				alert(str_msg);
			}
		}
	);
	return;
}
/*******************************************************
* Func_PrcVote：投票：取消実行／登録処理
*******************************************************/
function Func_PrcVote(prm_typ) {
	var str_stt = "";
	var str_msg = "";
	var str_uid = "";
	var str_unm = "";
	var str_mod = "";
	var str_htm = "";
															//** パラメタ設定
	var str_prm = $("form[name='F1']").serialize();
	if (str_prm == "") {
		str_prm = "VOT_TYP=" + prm_typ;
	} else {
		str_prm = str_prm + "&VOT_TYP=" + prm_typ;
	}
	//---------------------//
	// 読込：投票処理ページ
	//---------------------//
	$.ajax({
		type   : "POST",
		url    : "./main/page/xml_Chk_VoteInp.php",
		async  : false,
		cache  : false,
		data   : str_prm,
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
	return { stt : str_stt, msg : str_msg, uid : str_uid, unm : str_unm, mod : str_mod, htm : str_htm };
}
//-->