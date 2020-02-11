<?php
header("Content-type: text/html; charset=utf-8");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
/***********************************************************************
/*	＜総合文化展＞	htm_Set_LogForm.php
/*	
/*		概  要：ログイン関連
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
	$str_uid = "";
	$str_unm = "";
	$str_mod = "";
	$str_upw = "";
	//--
	$NowDate = date("Y-m-d");
	$NowTime = date("H:i:s");
	//+----------------------
	//+ フォーム取得｛構文：filter_input(int $type, string $variable_name [, int $filter = FILTER_DEFAULT [, mixed $options ]] )｝
	//+----------------------
	$str_uid = RTrim((string)filter_input(INPUT_POST, "HID_UID"));
	$str_unm = RTrim((string)filter_input(INPUT_POST, "HID_UNM"));
	$str_mod = RTrim((string)filter_input(INPUT_POST, "HID_MOD"));
	//+----------------------
	//+ 出力処理
	//+----------------------
?>
<xml_LogFormData>
	<reHtml>
		<form name="F_LOG" method="post" autocomplete="off" accept-charset="utf-8">
			<div id="LoginPage">
				<fieldset>
					<div class="cont">
						<h1>ログイン画面</h1>
						<div class="info">
							従業員番号を入力し、「組合員」もしくは「幹部社員・派遣社員等」のいずれかを
							選択してから 「　次へ　」 をクリックしてください。<br>
							（「幹部社員・派遣社員等」を選択された方は作品の閲覧のみとなります）<br>
						</div>
						<div  class="form" >						
						<div class="form-inline">
										<label for="LOG_INP_UID"><span class="label">Username</span>	
										<input class="form-control ml-2" type="text"   id="LOG_INP_UID" name="INP_UID" value="<?php echo Func_SetEncDate($str_uid, "", "\n"); ?>" maxlength="20">
										</label>									
										<label for="LOG_INP_UPW"><span class="label">Password</span>
										<input class="form-control ml-2" type="password"   id="LOG_INP_UPW" name="INP_UPW" maxlength="20"  value="<?php echo Func_SetEncDate($str_upw, "", "\n"); ?>">	
										</label>
	
										</div>
							<h6 class="pl5">組合員もしくは幹部社員・派遣社員等を選択</h6>
							<div class="dispTable pl15 pb5">
								<div class="custom-control custom-radio custom-control-inline">
										<input class="custom-control-input" type="radio"  id="LOG_INP_MD1" name="INP_MOD" value="1"<?php if ($str_mod == "1" || Func_NoDataJudge($str_mod) == true) { echo " checked"; } ?>>
									<label for="LOG_INP_MD1"  class="custom-control-label">
									組合員								
									</label>
								</div>
								<div class="custom-control custom-radio custom-control-inline">
									<input class="custom-control-input" type="radio"  id="LOG_INP_MD2" name="INP_MOD" value="0"<?php if ($str_mod == "0") { echo " checked"; } ?>>
									<label for="LOG_INP_MD2" class="custom-control-label">								
										幹部社員・派遣社員等
									</label>
								</div>
								<div class="dispTd w110 ">
									<input type="button"     id="LOG_INP_BTN" name="INP_BTN" class="w80" value="次へ" onClick="Click_LOGIN()">
								</div>
							</div>
						</div>
					</div>
				</fieldset>
			</div>
		</form>
	</reHtml>
</xml_LogFormData>
