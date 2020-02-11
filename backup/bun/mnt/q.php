<?php
//*------------------------------------------------------------------
//* MySQL クエリ実行
//*
//*		Update:	2016/06/29	新規	Y.Nakamura
//*
//*		Copyright (c) FUJITSU LIMITED
//*------------------------------------------------------------------
//外部スクリプト読み込み
require_once "env.php";

	$msg		= "";
	$qstr		= "";
	$rs			= "";
	$excelout	= "";

	if ( isset($_POST['ExcelOut']) ) {
		$excelout = $_POST['ExcelOut'];
		if ( $excelout == "on" ) {
			header("Content-Type: application/vnd.ms-excel");
			header('Content-Disposition: attachment; filename="bun_data.xls"');
		}
	}

	if ( isset($_POST['QSTR']) ) {
//		$qstr = $_POST['QSTR'];
		$qstr = (string)filter_input(INPUT_POST, "QSTR");
		if ( $qstr <> "" ) {
			//* MySQLへ接続
			$conn = mysql_connect($envDbServer, $envDbUser, $envDbUserPass);
			if (!$conn) {
				//die('DBサーバへの接続が失敗しました。<br>'.mysql_error());
				$msg = "DBサーバへの接続が失敗しました。<br>".mysql_error();

			} else {
				mysql_set_charset('utf8', $conn);		//* クライアントの文字コード設定
				//* 処理するデータベースを選択
				if ( !(mysql_select_db($envDbName, $conn)) ){
				    //die('データベースの選択が失敗しました。<br>'.mysql_error());
					$msg = "データベースの選択が失敗しました。<br>".mysql_error();

				} else {
					//* クエリ実行
					$rs = mysql_query($qstr);
					if (!$rs) {
					    //die('データの抽出が失敗しました。<br>'.mysql_error());
						$msg = "クエリの実行が失敗しました。<br>".mysql_error();
					} else {
						$msg = "クエリを実行しました。<br>";
					}
				}
			}
			//* MySQLへの接続解除
			mysql_close($conn);
		}
	}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge;" charset="UTF-8">
<title>ひみつのクエリーマン</title>
<link rel="SHORTCUT ICON" href="q.ico">
</head>

<script Language="JavaScript">
function goOut(flg) {
	if ( flg == "xls" ) {
		document.F0.ExcelOut.value = "on";
	} else {
		document.F0.ExcelOut.value = "";
	}
	document.F0.submit();
}
</script>


<body>
	<form name=F0 method=post>
		<?php if ( $excelout != "on" ) { ?>
			<img src=q.jpg height=20 width=20> 
			<span style="font-size: 12pt; font-weight: bold;">ひみつのクエリーマン</span><br>
			<textarea name="QSTR" cols=120 rows=10 wrap=soft><?= $qstr ?></textarea><br>
			<input type=button value=" 実 行 " title="上で入力したクエリを実行します。" onclick="goOut('')">
			<input type=button value=" Excel に出力 " title="実行結果をExcelに出力します。" onclick="goOut('xls')">
			　<?= $msg ?>
			<input type=hidden name="ExcelOut" value="">
			<br>
		<?php } ?>


		<table style="border-collapse:collapse;" border=1>
		<?php
			if ( is_resource($rs) ) {
				$lct = 0;
				$style = "";

				$fct = mysql_num_fields($rs);				//* フィールド数を取得
				print('<tr style="background-color:lightsteelblue;">');
				print("<th>No.</th>");

				$i = 0;
				while ( $i < $fct ) {
					$fld = mysql_fetch_field( $rs, $i );	//* フィールド情報を取得
					print('<th>'.$fld->name.'</th>');
					++$i;
				}
				print("</tr>");

				while ($row = mysql_fetch_assoc($rs)) {		//* データ読み込み
					print('<tr>');
					$i = 0;
					print("<td style=\"background-color:lightsteelblue; text-align:right;\">".++$lct."</td>");

					while ( $i < $fct ) {
						$fld = mysql_fetch_field( $rs, $i );		//* フィールド情報を取得
						print("<td".$style.">".preg_replace("/\r\n|\r|\n/", "<br>", htmlentities($row[$fld->name], ENT_QUOTES, "UTF-8"))."</td>");
						++$i;
					}

					if ( $style == "" ) {
						$style = " style=\"background-color:lavender;\"";
					} else {
						$style = "";
					}
					print('</tr>');
				}
			}
		?>
		</table>
	</form>
</body>
</html>

<?php
//* MySQLへの接続解除
//mysql_close($conn);
?>
