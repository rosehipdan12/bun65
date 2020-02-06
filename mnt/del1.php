<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>削除</title>
<?php
/*************************************************************************
* 総合文化展
*
*	エントリー作品の削除
*
*************************************************************************/

//外部スクリプト読み込み
require_once "env.php";

	$err_cnt = 0;
	$err_msg = "";

	// 区分 
	if(isset($_POST['kubun'])) {
		$KUBUN = $_POST['kubun'];
	} else {
		$KUBUN = "RA";
	}

//	echo __FILE__ . '<br />';
//	echo dirname(__FILE__) . '<br />';

	// $mnt_flg 0:新規作成
	if(isset($_POST['mnt_flg']) && is_numeric($_POST['mnt_flg'])){
		$mnt_flg = $_POST['mnt_flg'] + 0;
	} else {
		$mnt_flg = 0;
	}
	echo "mnt_flg:".$mnt_flg."<br />";

	// 作品番号
	if(isset($_POST['rowid'])){
		$ROWID = $_POST['rowid'];
	} else {
		$ROWID = "";
	}

	if ($ROWID != "") {


		$link = mysqli_connect($envDbServer, $envDbUser, $envDbUserPass);
		if (!$link) {
	//		die('接続失敗です。'.mysql_error());
		$err_msg = '接続失敗です。'.mysqli_connect_error();
			$err_cnt = $err_cnt + 1;
		}

		print('<p>接続に成功しました。</p>');

		$db_selected = mysqli_select_db($link, $envDbName);
		if (!$db_selected){
			//	die('データベース選択失敗です。'.mysql_error());
			$err_msg = 'データベース選択失敗です。'.mysqli_error($link);
			$err_cnt = $err_cnt + 1;
		}

		print('<p>'.$envDbName.'データベースを選択しました。</p>');

		// MySQLに対する処理

		mysqli_set_charset('utf8', $link);

		$sql =	"update t_entryinfo set E_INV_FLG = 1 where E_ROWID=$ROWID;";

		echo $sql . "<br />";

		$result_flag = mysqli_query($link, $sql);

		if (!$result_flag) {
			//	die('UPDATEクエリーが失敗しました。'.mysql_error());
			$err_msg = 'INSERTクエリーが失敗しました。'.mysqli_error($link);
			$err_cnt = $err_cnt + 1;
		} else {
			$sql = "delete from t_vote where E_ROWID=$ROWID;";
			$result_flag = mysqli_query($link, $sql);
			echo $sql . "<br />";
		}

		$close_flag = mysqli_close($link);

		if ($close_flag){
		    print('<p>切断に成功しました。</p>');
		}
	} else {
		$err_msg = '削除処理が失敗しました。';
		$err_cnt = $err_cnt + 1;
	}

?>
</head>
<body>
<form method="post" enctype="multipart/form-data" name="form1">
<input type="hidden" name="mnt_flg" value="<?= $mnt_flg ?>" />
<input type="hidden" name="kubun" value="<?= $KUBUN ?>" />
</form>

<script src="./js/jquery-2.2.0.min.js"></script>
<script type="text/javascript">
$(function() {
<?php if ($err_cnt == 0) { ?>
	alert("削除が完了しました。");

	document.form1.mnt_flg.value = "0";
	document.form1.action = "./entry1.php";
	document.form1.target = "_top";
	document.form1.submit();
<?php } else { ?>
	alert("<?= $err_msg ?>");
<?php } ?>

});
</script>

</body>
</html>
