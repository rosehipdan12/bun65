/***********************************************************************
/*	＜総合文化展＞	mn_com_script.js
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
* TRM_R: 右側の空白を削除した文字列を帰します。
*******************************************************/
function TRM_R(In_str) {
	len = In_str.length;
	while ( len > 0 & (In_str.substring(len -1,len) == " " | In_str.substring(len -2,len) == "  " )) {
		if(In_str.substring(len -1,len) == " ") {
			len--;
		} else {
			len -= 2;
		}
	}
	return In_str.substring(0,len);
}
