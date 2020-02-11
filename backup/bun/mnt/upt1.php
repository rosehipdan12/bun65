<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登録</title>
<?php
/*************************************************************************
* 総合文化展
*
*	更新処理
*
*************************************************************************/

	//外部スクリプト読み込み
	require_once "env.php";

	$err_cnt = 0;
	$err_msg = "";

	$link = mysqli_connect($envDbServer, $envDbUser, $envDbUserPass);
	if (!$link) {
	//		die('接続失敗です。'.mysql_error());
		$err_msg = '接続失敗です。'.mysqli_connect_error();
		$err_cnt = $err_cnt + 1;
	}

	print('<p>接続に成功しました。</p>');

	$db_selected = mysqli_select_db($link, $envDbName);



	echo __FILE__ . '<br />';
	echo dirname(__FILE__) . '<br />';

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
	echo $ROWID."<br />";

	// 作品文字
	if(isset($_POST['TextArea1'])){
		$sakuhin = mysqli_real_escape_string($link, $_POST['TextArea1'] );
	} else {
		$sakuhin = "";
	}
	echo $sakuhin."<br />";

	// 作品コメント
	if(isset($_POST['TextArea2'])){
		$comment = mysqli_real_escape_string($link, $_POST['TextArea2'] );
	} else {
		$comment = "";
	}
	echo $comment."<br />";

	// 部門
	if(isset($_POST['Select1'])) {
		$BUMON = $_POST['Select1'];
	} else {
		$BUMON = "";
	}
	echo $BUMON."<br />";

	// 支部名
	if(isset($_POST['Text11'])){
		$SIBU = $_POST['Text11'];
	} else {
		$SIBU = "";
	}
	echo $SIBU."<br />";

	// 名前
	if(isset($_POST['Text12'])){
		$SIMEI = $_POST['Text12'];
	} else {
		$SIMEI = "";
	}
	echo $SIMEI."<br />";

	// 区分
	if(isset($_POST['kubun'])){
		$KUBUN = $_POST['kubun'];
	} else {
		$KUBUN = "";
	}
	echo $KUBUN."<br />";

	// ファイルパス
	if(isset($_POST['f_path'])){
		$F_PATH = $_POST['f_path'];
	} else {
		$F_PATH = "";
	}
	echo $F_PATH."<br />";

	// ファイル名
	if(isset($_POST['f_name'])){
		$F_NAME = $_POST['f_name'];
	} else {
		$F_NAME = "";
	}
	echo $F_NAME."<br />";

	// ファイル拡張子
	if(isset($_POST['f_type'])){
		$F_TYPE = $_POST['f_type'];
	} else {
		$F_TYPE = "";
	}
	echo $F_TYPE."<br />";

	// 作品タイトル
	if(isset($_POST['Text13'])){
		$S_TTL = mysqli_real_escape_string ($link, $_POST['Text13'] );
	} else {
		$S_TTL = "";
	}
	echo $S_TTL."<br />";

	// 縦サイズ
	if(isset($_POST['Text14']) && is_numeric($_POST['Text14'])){
		$H_SIZE = $_POST['Text14'];
	} else {
		$H_SIZE = "0";
	}
	echo $H_SIZE."<br />";

	// 横サイズ
	if(isset($_POST['Text15']) && is_numeric($_POST['Text15'])){
		$W_SIZE = $_POST['Text15'];
	} else {
		$W_SIZE = "0";
	}
	echo $W_SIZE."<br />";

	// 奥行きサイズ
	if(isset($_POST['Text16']) && is_numeric($_POST['Text16'])){
		$D_SIZE = $_POST['Text16'];
	} else {
		$D_SIZE = "0";
	}
	echo $D_SIZE."<br />";

	// 返送 郵便番号
	if(isset($_POST['Text17']) ) {		//&& is_numeric($_POST['Text17'])){
		$RB_NUM = $_POST['Text17'];
	} else {
		$RB_NUM = "";
	}
	echo $RB_NUM."<br />";

	// 返送 住所
	if(isset($_POST['Text18'])){
		$RB_ADD = $_POST['Text18'];
	} else {
		$RB_ADD = "";
	}
	echo $RB_ADD."<br />";

	// 返送先　電話番号
	if(isset($_POST['Text19'])){
		$R_TEL = $_POST['Text19'];
	} else {
		$R_TEL = "";
	}

	// 返送 名前
	if(isset($_POST['Text20'])){
		$RB_NAME = $_POST['Text20'];
	} else {
		$RB_NAME = "";
	}
	echo $RB_NAME."<br />";

	// 画像
	if (isset($_FILES['File1']['error']) && is_int($_FILES['File1']['error'])) {

		try {

			// $_FILES['File1']['error'] の値を確認
			switch ($_FILES['File1']['error']) {
				case UPLOAD_ERR_OK: // OK
					break;
				case UPLOAD_ERR_NO_FILE:   // ファイル未選択
//					throw new RuntimeException('ファイルが選択されていません');
					$f_flg = 1;
					break;
				case UPLOAD_ERR_INI_SIZE:  // php.ini定義の最大サイズ超過
				case UPLOAD_ERR_FORM_SIZE: // フォーム定義の最大サイズ超過
					throw new RuntimeException('ファイルサイズが大きすぎます');
				default:
					throw new RuntimeException('その他のエラーが発生しました');
			}

			// $_FILES['File1']['mime']の値はブラウザ側で偽装可能なので、MIMEタイプを自前でチェックする
			$type = @exif_imagetype($_FILES['File1']['tmp_name']);
//			echo $type;
//			if (!in_array($type, [IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG], true)) {
			if (!in_array($type, array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG), true)) {
				throw new RuntimeException('画像形式が未対応です');
			}

			// ファイルデータからSHA-1ハッシュを取ってファイル名を決定し、ファイルを保存する
			$f_nm =  sprintf('%s%s', sha1_file($_FILES['File1']['tmp_name']), image_type_to_extension($type));
			$path = sprintf('./uploads/%s%s', sha1_file($_FILES['File1']['tmp_name']), image_type_to_extension($type));
			$f_type = image_type_to_extension($type);
			if (!move_uploaded_file($_FILES['File1']['tmp_name'], $path)) {
				throw new RuntimeException('ファイル保存時にエラーが発生しました');
			}
			chmod($path, 0644);
			$F_PATH = dirname(__FILE__) . "/uploads/"; 
			$F_NAME = $f_nm;
			$F_TYPE = $f_type;
		} catch (RuntimeException $e) {
//			$msg_file = ['red', $e->getMessage()];
			$f_flg = 1;
		}
	}


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
		$err_msg = 'データベース選択失敗です。'.mysqli_connect_error();
		$err_cnt = $err_cnt + 1;
	}

	print('<p>'.$envDbName.'データベースを選択しました。</p>');

	// MySQLに対する処理

	mysqli_set_charset('utf8', $link);

	$sql = "UPDATE t_entryinfo SET E_KBN_CODE='$KUBUN', E_BM_CODE='$BUMON', E_DIV_NAME='$SIBU' ,E_USR_NAME='$SIMEI',E_INS_DATE=curdate(),E_TANKA_INFO='$sakuhin',E_COMMENT='" . $comment . "' ,E_TITLE='" . $S_TTL . "',E_SIZE_L=$H_SIZE,E_SIZE_B=$W_SIZE,E_SIZE_W=$D_SIZE ,E_R_ZIPCODE='$RB_NUM',E_R_Addr='$RB_ADD',E_R_TEL='$R_TEL',E_R_NAME='$RB_NAME',E_INV_FLG=0 WHERE E_ROWID=$ROWID;";

	echo $sql . "<br />";

	$result_flag = mysqli_query($link, $sql);

	if (!$result_flag) {
		//	die('UPDATEクエリーが失敗しました。'.mysql_error());
		$err_msg = 'UPDATEクエリーが失敗しました。'.mysqli_error($link);
		$err_cnt = $err_cnt + 1;
	}

	$r_no = $ROWID;
	$r_no = "00000". $r_no;
	echo $r_no . "<br />";

	$r_no = mb_substr($r_no, -5, 5, "UTF-8");
	echo $r_no . "<br />";


	if ($F_NAME !="") {

		//echo is_uploaded_file($_FILES["File1"]["tmp_name"])."<br />";
		echo $F_PATH . $F_NAME . "<br />";
		echo $F_PATH . "<br />";
		echo $F_NAME . "<br />";
		echo file_exists ($F_PATH . $F_NAME) . "<br />";

		if (file_exists ($F_PATH . $F_NAME)) {
			echo $envSakuhinFol . "<br />";

			if (!file_exists($envSakuhinFol)) {
				mkdir($envSakuhinFol);
			}
			$envSakuhinFol = $envSakuhinFol . $KUBUN . "_" . $BUMON . "/";
			echo $envSakuhinFol . "<br />";

			if (!file_exists($envSakuhinFol)) {
				mkdir($envSakuhinFol);
			}

			if (!file_exists($envSakuhinFol . "thumbnails/")) {
				mkdir($envSakuhinFol . "thumbnails/");
			}

			$sv_file_nm = "img" . $r_no . $F_TYPE;
			$sv_file_path = $envSakuhinFol . $sv_file_nm;
			echo $sv_file_nm . "<br />";
			echo $sv_file_path . "<br />";
			$thum_file_nm = $envSakuhinFol . "thumbnails/" . "min-img" . $r_no . $F_TYPE;
			echo $thum_file_nm . "<br />";
			if (copy($F_PATH . $F_NAME, $sv_file_path)) {
				chmod($sv_file_path, 0644);
				echo "[".$F_PATH . $F_NAME . "]をアップロードしました。";
				unlink($F_PATH . $F_NAME);
			} else {
				echo "ファイルをアップロードできません。";
			}
		} else {
			  echo "ファイルが選択されていません。";
		}


		// 必要ないと思いますが、もしうまくいかない場合書いてみてください
		// header('Content-type: image/jpeg');
		$type= $F_TYPE;

		// イメージサイズ取得
		list($width, $height) = getimagesize($sv_file_path);

		// サムネイル画像のサイズを指定
		list($new_width, $new_height) = getImageSizeForSmartResize(250, 250, $width, $height);

		// 新しい画像を生成
		if ($type === ".jpg" || $type === ".jpeg")
			$src = imagecreatefromjpeg($sv_file_path);
		elseif ($type === ".gif")
			$src = imagecreatefromgif($sv_file_path);
		else
			$src = imagecreatefrompng($sv_file_path);

		// 画像領域の作成
		$image = imagecreatetruecolor($new_width, $new_height);
		// exifデータ生成
		$exif = exif_read_data($sv_file_path);

		// サムネイル画像の生成
		imagecopyresampled($image, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

//		if(!empty($exif['Orientation'])){
//			switch ($exif['Orientation']) {
//				case 8:
//					$image = imagerotate($image, 90, 0);
//					break;
//				case 3:
//					$image = imagerotate($image, 180, 0);
//					break;
//				case 6:
//					$image = imagerotate($image, -90, 0);
//					break;
//			}
//		}

		if ($type === ".jpg" || $type === ".jpeg")	imagejpeg($image, $thum_file_nm);
		elseif ($type === ".gif")					imagegif($image, $thum_file_nm);
		else										imagepng($image, $thum_file_nm);

		chmod($thum_file_nm, 0644);

		imagedestroy($image);
		imagedestroy($src);

		$F_PATH = dirname(__FILE__) . $envSakuhinFol;
		$F_PATH = "";
		$F_NAME = $r_no . $F_TYPE;
		$F_NAME = $sv_file_nm;

		$sql = "update t_entryinfo set E_FILE_PATH='$F_PATH',E_FILE_NAME='$F_NAME' where E_ROWID='$r_no' ;";
		echo $sql . "<br />";

		$result_flag = mysqli_query($link, $sql);

		if (!$result_flag) {
			//	die('INSERTクエリーが失敗しました。'.mysql_error());
			$err_msg = 'INSERTクエリーが失敗しました。'.mysqli_error($link);
			$err_cnt = $err_cnt + 1;
		}

	} elseif ( ($_POST['svFile'] != "")  &&  ( $_POST['svBumon'] != $BUMON ) ) {	//* 部門変更時はファイルを移動
		$oldPath = $_POST['svFile'];
		$newPath = str_replace( $KUBUN . "_" . $_POST['svBumon'], $KUBUN . "_" . $BUMON, $oldPath );
		rename( $oldPath, $newPath );

		$oldPath = str_replace( "/img", "/thumbnails/min-img", $oldPath );
		$newPath = str_replace( "/img", "/thumbnails/min-img", $newPath );
		rename( $oldPath, $newPath );
	}

	$close_flag = mysqli_close($link);

	if ($close_flag){
		print('<p>切断に成功しました。</p>');
	}


	// dstの値から最適なサイズにリサイズ（縦横比を）
	function getImageSizeForSmartResize($dstWidth, $dstHeight, $srcWidth, $srcHeight){
		$factor = min(($dstWidth / $srcWidth), ($dstHeight / $srcHeight));
	   return array($factor * $srcWidth, $factor * $srcHeight);
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
	alert("変更が完了しました。");

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
