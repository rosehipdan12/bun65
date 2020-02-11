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
                            ○○○で配布された組合アカウント、または×××で配布された組合員アカウントでログインしてください。<br>
                            組合アカウントでログインした場合は閲覧のみ可能です。<br>
                            組合員アカウントでログインした場合、閲覧に加え投票が可能となります。<br>
						</div>

                        <div class="form dispTable">
                            <div class="dispTr">
                                <h2 class="dispTd">ID</h2>
                                <div class="pl5 pb10 dispTd">
                                    <label for="LOG_INP_UID">
                                        <input type="text" id="LOG_INP_UID" name="INP_UID" value=""
                                               maxlength="20">
                                    </label>
                                </div>
                            </div>
                            <div class="dispTr">
                                <h2 class="dispTd">パスワード</h2>
                                <div class="pl5 pb10 dispTd">
                                    <label for="LOG_INP_UID">
                                        <input type="password" id="LOG_INP_UPW" name="INP_UPW" value=""
                                               maxlength="20">
                                    </label>
                                </div>
                            </div>
                            <div class="dispTd">
                                &nbsp;
                            </div>
                            <div class="textRight dispTd">
                                <input type="button" id="LOG_INP_BTN" name="INP_BTN" class="w80" value="次へ"
                                       onclick="Click_LOGIN()">
                            </div>
                        </div>
					</div>
				</fieldset>
			</div>
		</form>
	</reHtml>
</xml_LogFormData>
