<?php
header("Content-type: text/html; charset=utf-8");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
/***********************************************************************
/*	<?????>	htm_Set_LogForm.php
/*	
/*		?  ?:??????
/*
/*		?  ?:??
/*
/*		Code By		2016/02/01	System Nicol Co.,Ltd	??
/*
/*		Copyright (c) 2016 System Nicol Co.,Ltd All rights reserved.
/*---------------------------------------------------------------------*
/*	????:VB?Option Explicit???????,??????????
/*	-------------------------------------------------------------------*
/*	??????:	$str_msg		:?????
/*					$str_stt		:?????
/*					$str_uid		:???????ID
/*					$str_unm		:????????
/*					$str_mod		:???????
/*					//--
/*					$NowDate		:??
/*					$NowTime		:??
/**********************************************************************/
	//???????·??
	// session_start();

	//???????????
	require_once "../com/require_set_env.php";
	//+----------------------
	//+ ?????
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
	//+ ??????{??:filter_input(int $type, string $variable_name [, int $filter = FILTER_DEFAULT [, mixed $options ]] )}
	//+----------------------
	// $str_uid = RTrim((string)filter_input(INPUT_POST, "HID_UID"));
	// $str_unm = RTrim((string)filter_input(INPUT_POST, "HID_UNM"));
	// $str_mod = RTrim((string)filter_input(INPUT_POST, "HID_MOD"));
	
	
	//+----------------------
	//+ ????
	//+----------------------
?>
<xml_RegFormData>
	<reHtml>
		<form name="F_REG"  method="post" autocomplete="off" accept-charset="utf-8">
			<div id="RegisterPage">
				<fieldset>
					<div class="cont">
					
						<input type="button" id="REG_BTN" name="REG_BTN" class="btn btn-secondary btn-sm ml-1" value="BACK" onClick="Redirect_MAIN()">
						<div class="info">
							Choose CSV file
						</div>
						<div class="form" >								
					
							<div class="dispTable pl15 pb5">
								   <input type="file" name="INP_CSV" id="INP_CSV" accept=".csv">
							</div>
							<input type="button" id="REG_BTN" name="REG_BTN" class="form-control btn btn-success btn-sm " value="REGISTER" onClick="Click_REG()">		
						</div>
						</div>					
					</div>
				</fieldset>
			</div>
		</form>
	</reHtml>
</xml_RegFormData>
