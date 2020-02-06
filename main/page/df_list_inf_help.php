<?php
header("Content-type: text/html; charset=utf-8");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
/***********************************************************************
/*	＜総合文化展＞	df_list_inf_help.php
/*	
/*		概  要：投票方法
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
	$NowDate = date("Y-m-d");
	$NowTime = date("H:i:s");
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
	
?>
<div class="container">
<form name="F1" method="post" autocomplete="off" accept-charset="utf-8">



	<div id="contpostPage" class="<?php echo $dsp_ini["BGC1"]; ?>">
		<!-- ========================================================== -->
		<!-- Cont_Area：												-->
		<!-- ========================================================== -->
		<fieldset class="m10 pl20 pr20">
			<legend><h1>投票方法</h1></legend>
			<dl>
				<dt class="headline">
					<h2>応募作品を閲覧する</h3>
				</dt>
				<dd class=" ">
					<ul class="  helpInfo">
						<li>
							画面上部のエントリー部門「<img src="./images/help/h0_m_ri.png" align="middle" border="1" class="ml5 mr5" alt="力作じまんの部">」「<img src="./images/help/h0_m_ra.png" align="middle" border="1" class="ml5 mr5" alt="らくらくエントリーの部">」を選択すると、それぞれのカテゴリーが表示されます。<br>
							<div class="m10 ">
								<img src="./images/help/h0_menu.png" class="img-fluid" align="middle" alt="メニュー">
							</div>
						</li>
					</ul>
				</dd>
				<dt class="headline">
					<h2>応募作品に投票する</h3>
				</dt>
				<dd class=" ">
					<ul class="  helpInfo">
						<li>
							投票は、「力作じまんの部《大人の部》」と「らくらくエントリーの部」の各カテゴリーごとに一作品ずつ選択してください。<br>
							合計６作品を選んでください。<br>
							（ 「力作じまんの部《子どもの部》」の「絵画」と「書道」については、投票対象外となります ）<br>
							<div style="overflow-x:auto;">
								<table class="hlp_tbl">
									<tr>
										<th rowspan="6" colspan="1" >【投票対象】</th>
										<td rowspan="4" colspan="1" >力作じまんの部《大人の部》</td>
										<td rowspan="1" colspan="1" >絵画</td>
										<td rowspan="6" colspan="1" >カテゴリーごとに一作品を選択<br>（ 合計６作品に投票できます ）</td>
									</tr>
									<tr>
										<td rowspan="1" colspan="1" >書道</td>
									</tr>
									<tr>
										<td rowspan="1" colspan="1" >写真</td>
									</tr>
									<tr>
										<td rowspan="1" colspan="1" >手芸・工芸</td>
									</tr>
									<tr>
										<td rowspan="2" colspan="1" >らくらくエントリーの部</td>
										<td rowspan="1" colspan="1" >写真・イラスト</td>
									</tr>
									<tr>
										<td rowspan="1" colspan="1" >川柳・俳句・短歌</td>
									</tr>
									<tr>
										<th rowspan="2" colspan="1" >【投票対象外】</th>
										<td rowspan="2" colspan="1" >力作じまんの部《子供の部》</td>
										<td rowspan="1" colspan="1" >絵画</td>
										<td rowspan="2" colspan="1" >閲覧のみ</td>
									</tr>
									<tr>
										<td rowspan="1" colspan="1" >書道</td>
									</tr>
								</table>
							</div>
						</li>
						<li>
							各カテゴリーの応募作品をご覧いただき、最も気に入った作品の「<img src="./images/help/h1_v_b1.png" align="middle" class="ml5 mr5" alt="投票する">」ボタンをクリックしてください。<br>
							<div class=" pt10 pb10">
								<img  class="img-fluid"src="./images/help/h1_vote.png" align="middle" alt="投票方法">
							</div>
							「<img src="./images/help/h1_v_b1.png" class="img-fluid" align="middle" class="ml5 mr5" alt="投票する">」ボタンをクリックすると、ボタンが「<img src="./images/help/h1_v_b2.png" align="middle" class="ml5 mr5" alt="選択済">」に変わります。<br>
							「<img src="./images/help/h1_v_b2.png" class="img-fluid" align="middle" class="ml5 mr5" alt="選択済">」ボタンを再度クリックすると、投票選択が解除されます。<br>
							※ 最後に選択した作品が、投票作品になります。<br>
						</li>
					</ul>
				</dd>
				<dt class="headline">
					<h2>投票ランキングについて</h3>
				</dt>
				<dd class=" ">
					<ul class="  helpInfo">
						<li>
							画面上部の「<img src="./images/help/h2_m_rk.png" align="middle" border="1" class="ml5 mr5" alt="投票ランキング">」をクリックすると、各カテゴリーの上位５作品を確認できます。
							<div class="  ">
								<img  class="img-fluid" src="./images/help/h2_rank.png" align="middle" alt="メニュー">
							</div>

							各カテゴリーで最も得票数の多い作品（６作品）を、「組合員ベストセレクト賞」として表彰します。<br>
							（「力作じまんの部」は、展示会場での投票と合算します ）<br>
						</li>
					</ul>
				</dd>
			</dl>
			<p class="p10 test4">
				皆さんの投票をお待ちしています。
			</p>
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
</form>
</div>
