<?php
header("Content-type: text/html; charset=utf-8");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
/***********************************************************************
/*	＜総合文化展＞	df_list_inf_about.php
/*	
/*		概  要：応募について
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
/*					//--
/*					$sys_ini		：区分コード／部門コード／ページパス
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
	//--
	$NowDate = date("Y-m-d");
	$NowTime = date("H:i:s");
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
		if ($sys_ini["CD1"] != "DF") {
			$str_stt = "NG";
			$str_msg = "パラメタ取得に失敗しました。";
		} else {
			if ($sys_ini["CD2"] != "I01") {
				$str_stt = "NG";
				$str_msg = "パラメタ取得に失敗しました。";
			}
		}
	}
?>
<form name="F1" method="post" autocomplete="off" accept-charset="utf-8">
	<div id="contpostPage" class="page_ab">
		<!-- ========================================================== -->
		<!-- Cont_Area：												-->
		<!-- ========================================================== -->
		<fieldset class="m10 pl20 pr20">
			<legend><h1>応募について</h1></legend>
			<dl>
				<dt class="headline">
					<h2>力作じまんの部《大人の部》</h2>
				</dt>
				<dd class="pl10">
					<dl>
						<dt class="head">
							<h3>絵画部門</h3>
						</dt>
						<dd class="pl10">
							<ul class="pl20 pb10">
								<li>
									<div class="dispTable">
										<div class="dispTd w40">テーマ</div><div class="dispTd w20">：</div>
										<div class="dispTd">
											なし
										</div>
									</div>
								</li>
								<li>
									<div class="dispTable">
										<div class="dispTd w40">種　類</div><div class="dispTd w20">：</div>
										<div class="dispTd">
											日本画、油絵、水彩画、水墨画、版画など
										</div>
									</div>
								</li>
								<li>
									<div class="dispTable">
										<div class="dispTd w40">サイズ</div><div class="dispTd w20">：</div>
										<div class="dispTd">
											3 号以上 20 号以内 （額装あり、ガラスは不可）
										</div>
									</div>
								</li>
							</ul>
						</dd>
						<dt class="head">
							<h3>書道部門</h3>
						</dt>
						<dd class="pl10">
							<ul class="pl20 pb10">
								<li>
									<div class="dispTable">
										<div class="dispTd w40">テーマ</div><div class="dispTd w20">：</div>
										<div class="dispTd">
											なし
										</div>
									</div>
								</li>
								<li>
									<div class="dispTable">
										<div class="dispTd w40">種　類</div><div class="dispTd w20">：</div>
										<div class="dispTd">
											楷書、行書、草書 など
										</div>
									</div>
								</li>
								<li>
									<div class="dispTable">
										<div class="dispTd w40">サイズ</div><div class="dispTd w20">：</div>
										<div class="dispTd">
											半紙以上 二六判以内（表装あり、額装は不可）
										</div>
									</div>
								</li>
							</ul>
						</dd>
						<dt class="head">
							<h3>写真部門</h3>
						</dt>
						<dd class="pl10">
							<ul class="pl20 pb10">
								<li>
									<div class="dispTable">
										<div class="dispTd w40">テーマ</div><div class="dispTd w20">：</div>
										<div class="dispTd">
											なし
										</div>
									</div>
								</li>
								<li>
									<div class="dispTable">
										<div class="dispTd w40">種　類</div><div class="dispTd w20">：</div>
										<div class="dispTd">
											カラー・モノクロのプリント単写真
										</div>
									</div>
								</li>
								<li>
									<div class="dispTable">
										<div class="dispTd w40">サイズ</div><div class="dispTd w20">：</div>
										<div class="dispTd">
											４ツ切り（254 ㎜×305 ㎜）以上全紙サイズ（435 ㎜×540 ㎜）以内<br>
										（額装またはパネル・台紙に貼り付け必要。ガラスは不可）
										</div>
									</div>
								</li>
							</ul>
						</dd>
						<dt class="head">
							<h3>手芸・工芸部門</h3>
						</dt>
						<dd class="pl10">
							<ul class="pl20 pb10">
								<li>
									<div class="dispTable">
										<div class="dispTd w40">テーマ</div><div class="dispTd w20">：</div>
										<div class="dispTd">
											なし
										</div>
									</div>
								</li>
								<li>
									<div class="dispTable">
										<div class="dispTd w40">種　類</div><div class="dispTd w20">：</div>
										<div class="dispTd">
											パッチワーク、レザークラフト、きり絵、刺繍、編み物、人形、木彫・石彫（篆刻）、陶芸、模型 等。
										</div>
									</div>
								</li>
								<li>
									<div class="dispTable">
										<div class="dispTd w40">サイズ</div><div class="dispTd w20">：</div>
										<div class="dispTd">
											展示平面図縦50 ㎝×横50 ㎝×高さ60 ㎝、重さ20 ㎏以内
										</div>
									</div>
								</li>
							</ul>
						</dd>
					</dl>
				</dd>
				<dt class="headline">
					<h2>力作じまんの部《子供の部》</h2>
				</dt>
				<dd class="pl10">
					<dl>
						<dt class="head">
							<h3>絵画部門</h3>
						</dt>
						<dd class="pl10">
							<ul class="pl20 pb10">
								<li>
									<div class="dispTable">
										<div class="dispTd w40">テーマ</div><div class="dispTd w20">：</div>
										<div class="dispTd">
											家族の似顔絵
										</div>
									</div>
								</li>
								<li>
									<div class="dispTable">
										<div class="dispTd w40">サイズ</div><div class="dispTd w20">：</div>
										<div class="dispTd">
											A4 サイズの画用紙 （額装なし）
										</div>
									</div>
								</li>
							</ul>
						</dd>
						<dt class="head">
							<h3>書道部門</h3>
						</dt>
						<dd class="pl10">
							<ul class="pl20 pb10">
								<li>
									<div class="dispTable">
										<div class="dispTd w40">テーマ</div><div class="dispTd w20">：</div>
										<div class="dispTd">
											なし
										</div>
									</div>
								</li>
								<li>
									<div class="dispTable">
										<div class="dispTd w40">サイズ</div><div class="dispTd w20">：</div>
										<div class="dispTd">
											半紙もしくは八ツ切（半切1/4 縦：約68cm×17.5cm）<br>
											（表装あり、額装は不可）
										</div>
									</div>
								</li>
							</ul>
						</dd>
					</dl>
				</dd>
				<dt class="headline">
					<h2>らくらくエントリーの部</h2>
				</dt>
				<dd class="pl10">
					<dl>
						<dt class="head">
							<h3>写真／イラスト部門</h3>
						</dt>
						<dd class="pl10">
							<ul class="pl20 pb10">
								<li>
									<div class="dispTable">
										<div class="dispTd w40">テーマ</div><div class="dispTd w20">：</div>
										<div class="dispTd">
											家庭/職場/地域(社会)において「笑顔・元気になれるモノ」「未来に伝えたいコト・未来に残したいモノ」
										</div>
									</div>
								</li>
								<li>
									<div class="dispTable">
										<div class="dispTd w40">種　類</div><div class="dispTd w20">：</div>
										<div class="dispTd">
											デジタルデータ（応募フォーマット）
										</div>
									</div>
								</li>
							</ul>
						</dd>
						<dt class="head">
							<h3>俳句／川柳／短歌部門</h3>
						</dt>
						<dd class="pl10">
							<ul class="pl20 pb10">
								<li>
									<div class="dispTable">
										<div class="dispTd w40">テーマ</div><div class="dispTd w20">：</div>
										<div class="dispTd">
											「絆・つながり」
										</div>
									</div>
								</li>
								<li>
									<div class="dispTable">
										<div class="dispTd w40">種　類</div><div class="dispTd w20">：</div>
										<div class="dispTd">
											デジタルデータ（応募フォーマット）
										</div>
									</div>
								</li>
							</ul>
						</dd>
					</dl>
				</dd>
			</dl>
		</fieldset>
	</div>
	<input type="hidden" name="HID_MSG" value="<?php echo Func_SetEncDate($str_msg, "", "\n"); ?>">
	<input type="hidden" name="HID_STT" value="<?php echo Func_SetEncDate($str_stt, "", "\n"); ?>">
	<!-- -->
	<input type="hidden" name="PRM_CD1" value="<?php echo Func_SetEncDate($sys_ini["CD1"], "", "\n"); ?>">
	<input type="hidden" name="PRM_CD2" value="<?php echo Func_SetEncDate($sys_ini["CD2"], "", "\n"); ?>">
	<input type="hidden" name="PRM_SRC" value="<?php echo Func_SetEncDate($sys_ini["SRC"], "", "\n"); ?>">
</form>
