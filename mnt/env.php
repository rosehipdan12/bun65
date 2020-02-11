<?php
/***********************************************************************
/*	総合文化展
/*
/*		環境設定
/*
/**********************************************************************/

/*------------------------------------
* データベース環境
------------------------------------*/
switch ( "unyo" ){

	case "unyo":
		$envDbServer		= "localhost";		//* データベースサーバ名
		$envDbUser			= "root";		//* データベースユーザ
		//$envDbUserPass		= "FJ3kjc9tckjecth3";		//* データベースユーザのパスワード
		$envDbUserPass		= "";
		$envDbName			= "bun";			//* スキーマ名
		break;

	case "tfl200_demo":
		$envDbServer		= "localhost";
		$envDbUser			= "qis1";
		$envDbUserPass		= "xxxx";
		$envDbName			= "demo";
		break;

	default:
		$envDbServer		= "";
		$envDbUser			= "";
		$envDbUserPass		= "";
		$envDbName			= "";
		break;
}

/*------------------------------------
* ディレクトリ環境
------------------------------------*/
$envSakuhinFol		= "./uploads/";

/*------------------------------------
* 支部
------------------------------------*/
$envShibu	= array("Ｒ＆Ｄ支部",
					"小山支部",
					"本社支部",
					"ソフト・サービス支部",
					"沼津支部",
					"営業所西支部"
				)
?>