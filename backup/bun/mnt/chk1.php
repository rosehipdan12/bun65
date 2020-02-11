<?php

$err_cnt = 0;

$f_path = "";
$f_nm = "";
$f_type = "";
/**********************************************************************/

/**************************************************************************/
// 区分
if (isset($_POST['kubun'])) {
    $KUBUN = $_POST['kubun'];
} else {
    $KUBUN = "RA";
}
echo $KUBUN . "<br />";

// $mnt_flg 0:新規作成

// $mnt_flg 0:新規作成
if (isset($_POST['mnt_flg']) && is_numeric($_POST['mnt_flg'])) {
    $mnt_flg = $_POST['mnt_flg'] + 0;
} else {
    $mnt_flg = 0;
}
echo "mnt_flg:" . $mnt_flg . "<br />";

// 作品番号
if (isset($_POST['rowid'])) {
    $ROWID = $_POST['rowid'];
} else {
    $ROWID = "";
}
echo "ROW " . $ROWID . "<br />";

// 作品文字
if (isset($_POST['TextArea1'])) {
    $sakuhin = $_POST['TextArea1'];
} else {
    $sakuhin = "";
}
echo "sakuhin " . $sakuhin . "<br />";

// 作品コメント
if (isset($_POST['TextArea2'])) {
    $comment = $_POST['TextArea2'];
} else {
    $comment = "";
}
echo "com " . $comment . "<br />";
/* //Timecode for thumbnail
	if(isset($_POST['TextArea21'])){
		$Timecode = $_POST['TextArea21'];
	} else {
		$Timecode = 0;
	}
	echo "Timecode  ".$Timecode."<br />";
 */
// 部門
if (isset($_POST['Select1'])) {
    $BUMON = $_POST['Select1'];
} else {
    $BUMON = "";
}
echo "Bumon " . $BUMON . "<br />";

// 支部名
if (isset($_POST['Text11'])) {
    $SIBU = $_POST['Text11'];
} else {
    $SIBU = "";
}
//	echo $SIBU."<br />";

// 名前
if (isset($_POST['Text12'])) {
    $SIMEI = $_POST['Text12'];
} else {
    $SIMEI = "";
}
echo $SIMEI . "<br />";

// 作品タイトル
if (isset($_POST['Text13'])) {
    $S_TTL = $_POST['Text13'];
} else {
    $S_TTL = "";
}
echo $S_TTL . "<br />";

// 作品サイズ縦
if (isset($_POST['Text14'])) {
    $S_TATE = $_POST['Text14'];
} else {
    $S_TATE = "0";
}
echo $S_TATE . "<br />";

// 作品サイズ横
if (isset($_POST['Text15'])) {
    $S_YOKO = $_POST['Text15'];
} else {
    $S_YOKO = "0";
}
echo $S_YOKO . "<br />";

// 作品サイズ幅
if (isset($_POST['Text16'])) {
    $S_HABA = $_POST['Text16'];
} else {
    $S_HABA = "0";
}
echo $S_HABA . "<br />";

// 返送先　郵便番号
if (isset($_POST['Text17'])) {
    $R_ZIPCODE = $_POST['Text17'];
} else {
    $R_ZIPCODE = "";
}
//	echo $R_ZIPCODE."<br />";

// 返送先　住所
if (isset($_POST['Text18'])) {
    $R_ADDR = $_POST['Text18'];
} else {
    $R_ADDR = "";
}
echo $R_ADDR . "<br />";

// 返送先　電話番号
if (isset($_POST['Text19'])) {
    $R_TEL = $_POST['Text19'];
} else {
    $R_TEL = "";
}
echo $R_TEL . "<br />";

// 返送先　宛先
if (isset($_POST['Text20'])) {
    $R_NAME = $_POST['Text20'];
} else {
    $R_NAME = "";
}
echo $R_NAME . "<br />";

//echo $_FILES['File1']['name']."<br />";
// 画像

//Log Create
function createLog($msg = "", $type = "DEBUG")
{
    $file = "/var/www/html/public/log/import_video_" . date('Ymd', time()) . ".log";
    $msg = '[' . date('Y-m-d h:m:s', time()) . '][' . $type . '] ' . $msg . "\r\n";
    $logged = error_log($msg, 3, $file);
    if ($logged) {
        return $file;
    } else {
        return "";
    }
}

//***************************************************************************
function generateThumnail($video = "", $image = "")
{
    $ffmpeg = '/var/www/html/public/mnt/ffmpeg/bin/ffmpeg.exe';
    //screenshot size
    $size = '160x160';
    //ffmpeg command
   // $cmd = "$ffmpeg -i $video -deinterlace -an -ss $Timecode -f mjpeg -t 1 -r 1 -y -s $size $image 2>&1";
   // $return = `$cmd`;
}

//***************************************************************************
//If user choose upload video
/**
 *[UPLOAD]
 *Upload VIDEO file
 */
$log_file = createLog('UPLOAD ['.$BUMON." - ".$_FILES['File1']['name'].']', 'DEBUG');

if ($BUMON == "B06") {
    if (isset($_FILES['File1']['error']) && is_int($_FILES['File1']['error'])) {

        try {

            // $_FILES['File1']['error'] の値を確認
            switch ($_FILES['File1']['error']) {
                case UPLOAD_ERR_OK: // OK
                    $log_file = createLog('Upload ERROR [' . $_FILES['File1']['error'] . ']', 'ERROR');
                    break;
                case UPLOAD_ERR_NO_FILE:   // ファイル未選択
                    $log_file = createLog('No File Input [' . $_FILES['File1']['error'] . ']', 'ERROR');

//					throw new RuntimeException('ファイルが選択されていません');
                    $f_flg = 1;
                    break;
                case UPLOAD_ERR_INI_SIZE:  // php.ini定義の最大サイズ超過
                    $log_file = createLog('File Size Error [' . $_FILES['File1']['error'] . ']', 'ERROR');
                case UPLOAD_ERR_FORM_SIZE: // フォーム定義の最大サイズ超過
                    $log_file = createLog('File Size Too Big [' . $_FILES['File1']['error'] . ']', 'ERROR');
                    throw new RuntimeException('ファイルサイズが大きすぎます');

                default:
                    $log_file = createLog('Reason undefined [' . $_FILES['File1']['error'] . ']', 'ERROR');
                    throw new RuntimeException('その他のエラーが発生しました');
            }

            $name = $_FILES['File1']['name'];
            $target_dir = "/var/www/html/public/mnt/uploads/";
            $target_file = $target_dir . $_FILES["File1"]["name"];
            // $_FILES['File1']['mime']の値はブラウザ側で偽装可能なので、MIMEタイプを自前でチェックする
            $type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            //echo "type ".$type;

            // Valid file extensions
            $extensions_arr = array("mp4", "avi", "3gp", "mov", "mpeg");

            //if (!in_array($type, [IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG], true)) {
            if (!in_array($type, $extensions_arr, true)) {
                $log_file = createLog('Wrong File Type (' . $type . ')', 'ERROR');
                throw new RuntimeException('画像形式が未対応です');
            }

            // ファイルデータからSHA-1ハッシュを取ってファイル名を決定し、ファイルを保存する
            $f_nm = $name;
            $path = $target_file;
            echo $path . " ";
            echo $f_nm;
            $f_type = $type;
            if (!move_uploaded_file($_FILES['File1']['tmp_name'], $path)) {
                $log_file = createLog('Error saving file: ' . $path, 'ERROR');
                throw new RuntimeException('ファイル保存時にエラーが発生しました');
            } else {
                $log_file = createLog('Upload Successful [' . $path . '] [' . $f_nm . '] [' . $type . ']', 'DEBUG');
            }
            chmod($path, 0666);
            //generateThumnail($path,"/var/www/html/public/mnt/uploads/Videos/Thumbnails"$name);

        } catch (RuntimeException $e) {
//			$msg_file = ['red', $e->getMessage()];
            $f_flg = 1;
        }

    }
} /**
 *[UPLOAD]
 *Upload AUDIO file
 */
elseif ($BUMON == "B07") {

    if (isset($_FILES['File1']['error']) && is_int($_FILES['File1']['error'])) {
        try {

            // $_FILES['File1']['error'] の値を確認
            switch ($_FILES['File1']['error']) {
                case UPLOAD_ERR_OK: // OK
                    $log_file = createLog('Upload ERROR [' . $_FILES['File1']['error'] . ']', 'ERROR');
                    break;
                case UPLOAD_ERR_NO_FILE:   // ファイル未選択
                    $log_file = createLog('No File Input [' . $_FILES['File1']['error'] . ']', 'ERROR');

//					throw new RuntimeException('ファイルが選択されていません');
                    $f_flg = 1;
                    break;
                case UPLOAD_ERR_INI_SIZE:  // php.ini定義の最大サイズ超過
                    $log_file = createLog('File Size Error [' . $_FILES['File1']['size'] . ']', 'ERROR');
                case UPLOAD_ERR_FORM_SIZE: // フォーム定義の最大サイズ超過
                    $log_file = createLog('File Size Too Big [' . $_FILES['File1']['size'] . ']', 'ERROR');
                    throw new RuntimeException('ファイルサイズが大きすぎます');

                default:
                    $log_file = createLog('Reason undefined [' . $_FILES['File1']['error'] . ']', 'ERROR');
                    throw new RuntimeException('その他のエラーが発生しました');
            }

            $name = $_FILES['File1']['name'];

            echo "name: " . $name . "<br />";
            $target_dir = "/var/www/html/public/mnt/uploads/";
            $target_file = $target_dir . $_FILES["File1"]["name"];
            // $_FILES['File1']['mime']の値はブラウザ側で偽装可能なので、MIMEタイプを自前でチェックする
            $type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            echo "type " . $type;

            // Valid file extensions
            $extensions_arr = array("mp3", "ogg", "flac");

            //if (!in_array($type, [IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG], true)) {
            if (!in_array($type, $extensions_arr, true)) {
                $log_file = createLog('Wrong File Type (' . $type . ')', 'ERROR');
                throw new RuntimeException('画像形式が未対応です');
            }

            // ファイルデータからSHA-1ハッシュを取ってファイル名を決定し、ファイルを保存する
            $f_nm = $name;
            $path = $target_file;
            echo $path . " ";
            echo $f_nm;
            $f_type = $type;
            if (!move_uploaded_file($_FILES['File1']['tmp_name'], $path)) {
                $log_file = createLog('Error saving file: ' . $path, 'ERROR');
                throw new RuntimeException('ファイル保存時にエラーが発生しました');
            } else {
                $log_file = createLog('Upload Successful [' . $path . '] [' . $f_nm . '] [' . $type . ']', 'DEBUG');
            }
            chmod($path, 0666);
            //generateThumnail($path,"/var/www/html/public/mnt/uploads/Videos/Thumbnails"$name);

        } catch (RuntimeException $e) {
//			$msg_file = ['red', $e->getMessage()];
            $f_flg = 1;
        }

    }
}
//UPLOAD IMAGE
//If user choose upload image
else {

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
            echo $type;
//			if (!in_array($type, [IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG], true)) {
            if (!in_array($type, array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG), true)) {
                throw new RuntimeException('画像形式が未対応です');
            }

            // ファイルデータからSHA-1ハッシュを取ってファイル名を決定し、ファイルを保存する
            $f_nm = sprintf('%s%s', sha1_file($_FILES['File1']['tmp_name']), image_type_to_extension($type));

            $path = sprintf('./uploads/Image/%s%s', sha1_file($_FILES['File1']['tmp_name']), image_type_to_extension($type));


            $f_type = image_type_to_extension($type);
            if (!move_uploaded_file($_FILES['File1']['tmp_name'], $path)) {

                throw new RuntimeException('ファイル保存時にエラーが発生しました');
            }
            chmod($path, 0666);


        } catch (RuntimeException $e) {
//			$msg_file = ['red', $e->getMessage()];
            $f_flg = 1;
        }

    }
}

if (($_FILES['File1']['error'] == UPLOAD_ERR_NO_FILE) && (trim($sakuhin) == "")) {
    echo "作品が登録されていません。";
    $msg = "作品が登録されていません。";
}

$f_path = dirname(__FILE__) . "/uploads/";
$reviewPath = "/mnt/uploads/" . $f_nm;
echo $reviewPath;

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <?php if ($KUBUN == "RA") { ?>
        <title>らくらくエントリーの部　登録用</title>
    <?php } else { ?>
        <title>力作じまんの部　登録用</title>
    <?php } ?>
    <!--CSSファイルのみ -->
    <link rel="stylesheet" href="./lightbox281/css/lightbox.css" type="text/css" media="screen"/>
    <style type="text/css">
        #test1 {
            display: inline;
            list-style: none;
        }

        #test1 div {
            float: left;
            display: block;
            vertical-align: middle;
            width: 110px;
        }
    </style>
</head>
<body>

<form method="post" enctype="multipart/form-data" name="form1">
    <?php if ($KUBUN == "RA") { ?>
        <h2>作品登録　『らくらくエントリーの部』</h2>
    <?php } else { ?>
        <h2>作品登録　『力作じまんの部』</h2>
    <?php } ?>
    <!-- ============================================================= -->
    <hr/>

    <table border="2">
        <!-- ============================================================= -->
        <?php if ($KUBUN == "RA") { ?>
            <tr>
                <th>作品：</th>
                <td>
                    <?php if (isset($f_flg) && trim($sakuhin) == "") { ?>
                        <span style="color:red;">作品が登録されていません</span>
                        <?php $err_cnt = $err_cnt + 1; ?>
                    <?php } else { ?>
                        <?php if (!isset($f_flg)) { ?>
                            <legend>画像ファイル</legend>
                            <a href="<?= $reviewPath ?>" rel="lightbox" title="my caption">
                                <?php if ($BUMON === "B06") { ?>
                                    <video id="videoPlayer"
                                           class="video-js vjs-default-skin vjs-big-play-centered w160 h160"
                                           controls
                                           preload="none"
                                           width="300"
                                           height="150"
                                           data-setup={}
                                    >
                                        <source src="<?= $reviewPath ?>" type="video/<?= $type ?>"/>
                                    </video>

                                <?php } elseif ($BUMON === "B07") { ?>
                                    <audio id="audio_example" class="video-js vjs-default-skin" controls
                                           preload="metadata"
                                           width="600" height="600" poster="/img/awesome-album-art.png" data-setup='{}'>
                                        <source src="<?= $reviewPath ?>" type='audio/mp3'/>
                                    </audio>
                                <?php } else { ?>
                                    <img id="imgTEMP" src="<?= $reviewPath ?>" width="150" height="112" alt="" border=0>
                                <?php } ?>
                            </a>
                            <br/>
                            <br/>
                        <?php } ?>
                        <?php if (trim($sakuhin) != "") { ?>
                            <legend>川柳・俳句・短歌作品</legend>
                            <textarea name="TextArea1" cols="50" rows="5" disabled><?= $sakuhin ?></textarea><br>
                        <?php } ?>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <th>部門：</th>
                <td>
                    <?php
                    switch ($BUMON) {
                        case 'B01':
                            $str_bumon = '写真';
                            break;
                        case 'B02':
                            $str_bumon = 'イラスト';
                            break;
                        case 'B03':
                            $str_bumon = '川柳';
                            break;
                        case 'B04':
                            $str_bumon = '俳句';
                            break;
                        case 'B05':
                            $str_bumon = '短歌';
                            break;
                        case 'B06':
                            $str_bumon = 'Video';
                            break;
                        case 'B07':
                            $str_bumon = 'Audio';
                            break;
                        default:
                            $BUMON = '';
                            $str_bumon = '---';
                    }
                    ?>
                    <?= $str_bumon ?>
                    <input type="hidden" name="Select1" value="<?= $BUMON ?>">
                </td>
            </tr>
            <tr>
                <th>作品コメント：</th>
                <td>
                    <textarea name="TextArea2" cols="50" rows="5" disabled><?php if (trim($comment) != "") {
                            echo htmlspecialchars($comment);
                        } ?></textarea><br>
                </td>
            </tr>
            <tr>
                <th>支部名：</th>
                <td>
                    <?php if (trim($SIBU) == "") { ?>
                        <span style="color:red;">支部名が登録されていません</span>
                        <?php $err_cnt = $err_cnt + 1; ?>
                    <?php } else { ?>
                        <?= htmlspecialchars($SIBU) ?>
                    <?php } ?>
                    <input name="Text11" type="hidden" value="<?= htmlspecialchars($SIBU) ?>"/>
                </td>
            </tr>
            <tr>
                <th>名前：</th>
                <td>
                    <?php if (trim($SIMEI) == "") { ?>
                        <span style="color:red;">名前が登録されていません</span>
                        <?php $err_cnt = $err_cnt + 1; ?>
                    <?php } else { ?>
                        <?= htmlspecialchars($SIMEI) ?>
                    <?php } ?>
                    <input name="Text12" type="hidden" value="<?= htmlspecialchars($SIMEI) ?>"/>
                </td>
            </tr>
            <input name="Text13" type="hidden" value=""/>
            <input name="Text14" type="hidden" value=""/>
            <input name="Text15" type="hidden" value=""/>
            <input name="Text16" type="hidden" value=""/>
            <input name="Text17" type="hidden" value=""/>
            <input name="Text18" type="hidden" value=""/>
            <input name="Text19" type="hidden" value=""/>
            <input name="Text20" type="hidden" value=""/>


            <!-- ============================================================= -->
        <?php } else { ?>
            <tr>
                <th>作品：</th>
                <td>
                    <?php if (isset($f_flg) && trim($sakuhin) == "") { ?>
                        <span style="color:red;">作品が登録されていません</span>
                        <?php $err_cnt = $err_cnt + 1; ?>
                    <?php } else { ?>
                        <?php if (!isset($f_flg)) { ?>
                            <legend>画像ファイル</legend>
                            <a href="<?= $reviewPath ?>" rel="lightbox" title="my caption">
                                <?php if ($BUMON === "B06") { ?>
                                    <video id="videoPlayer"
                                           class="video-js vjs-default-skin vjs-big-play-centered w160 h160"
                                           controls
                                           preload="none"
                                           width="300"
                                           height="150"
                                           data-setup={}
                                    >
                                        <source src="<?= $reviewPath ?>" type="video/<?= $type ?>"/>
                                    </video>

                                <?php } else { ?>

                                    <img id="imgTEMP" src="<?= $reviewPath ?>" width="150" height="112" alt="" border=0>
                                <?php } ?>
                            </a>
                            <br/>
                            <br/>
                        <?php } ?>
                        <?php if (trim($sakuhin) != "") { ?>
                            <legend>川柳・俳句・短歌作品</legend>
                            <textarea name="TextArea1" cols="50" rows="5" disabled><?= $sakuhin ?></textarea><br>
                        <?php } ?>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <th>部門：</th>
                <td>
                    <?php
                    switch ($BUMON) {
                        case 'P01':
                            $str_bumon = '絵画';
                            break;
                        case 'P02':
                            $str_bumon = '書道';
                            break;
                        case 'P03':
                            $str_bumon = '写真';
                            break;
                        case 'P04':
                            $str_bumon = '手芸・工芸';
                            break;
                        case 'C01':
                            $str_bumon = '絵画（子供の部）';
                            break;
                        case 'C02':
                            $str_bumon = '書道（子供の部）';
                            break;
                        default:
                            $BUMON = '';
                            $str_bumon = '---';
                    }
                    ?>
                    <?= $str_bumon ?>
                    <input type="hidden" name="Select1" value="<?= $BUMON ?>">
                </td>
            </tr>
            <tr>
                <th>作品タイトル：</th>
                <td>
                    <?php if (trim($S_TTL) == "") { ?>
                        <span style="color:red;">作品タイトルが登録されていません</span>
                        <?php $err_cnt = $err_cnt + 1; ?>
                    <?php } else { ?>
                        <?= htmlspecialchars($S_TTL) ?>
                        <input name="Text13" type="hidden" value="<?= htmlspecialchars($S_TTL) ?>"/>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <th>作品コメント：</th>
                <td>
                    <textarea name="TextArea2" cols="50" rows="5" disabled><?php if (trim($comment) != "") {
                            echo htmlspecialchars($comment);
                        } ?></textarea><br>
                </td>
            </tr>
            <tr>
                <th>支部名：</th>
                <td>
                    <?php if (trim($SIBU) == "") { ?>
                        <span style="color:red;">支部名が登録されていません</span>
                        <?php $err_cnt = $err_cnt + 1; ?>
                    <?php } else { ?>
                        <?= htmlspecialchars($SIBU) ?>
                        <input name="Text11" type="hidden" value="<?= htmlspecialchars($SIBU) ?>"/>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <th>名前：</th>
                <td>
                    <?php if (trim($SIMEI) == "") { ?>
                        <span style="color:red;">名前が登録されていません</span>
                        <?php $err_cnt = $err_cnt + 1; ?>
                    <?php } else { ?>
                        <?= htmlspecialchars($SIMEI) ?>
                    <?php } ?>
                    <input name="Text12" type="hidden" value="<?= htmlspecialchars($SIMEI) ?>"/>
                </td>
            </tr>
            <tr>
                <th>作品サイズ：</th>
                <td>
                    縦：
                    <?php if (preg_match('/^[0-9]*[.]*[0-9]*$/', $S_TATE)) { ?>
                        <?= htmlspecialchars($S_TATE) ?>　cm
                    <?php } else { ?>
                        <?= htmlspecialchars($S_TATE) ?>　cm
                        <span style="color:red;">　　作品サイズは、整数で登録してください。</span>
                        <?php $err_cnt = $err_cnt + 1; ?>
                    <?php } ?>
                    <input name="Text14" type="hidden" value="<?= $S_TATE ?>"/>
                    <br/>
                    横：
                    <?php if (preg_match('/^[0-9]*[.]*[0-9]*$/', $S_YOKO)) { ?>
                        <?= htmlspecialchars($S_YOKO) ?>　cm
                    <?php } else { ?>
                        <?= htmlspecialchars($S_YOKO) ?>　cm
                        <span style="color:red;">　　作品サイズは、整数で登録してください。</span>
                        <?php $err_cnt = $err_cnt + 1; ?>
                    <?php } ?>
                    <input name="Text15" type="hidden" value="<?= $S_YOKO ?>"/>
                    <br/>
                    幅・奥行き：
                    <?php if (preg_match('/^[0-9]*[.]*[0-9]*$/', $S_HABA)) { ?>
                        <?= htmlspecialchars($S_HABA) ?>　cm
                    <?php } else { ?>
                        <?= htmlspecialchars($S_HABA) ?>　cm
                        <span style="color:red;">　　作品サイズは、整数で登録してください。</span>
                        <?php $err_cnt = $err_cnt + 1; ?>
                    <?php } ?>
                    <input name="Text16" type="hidden" value="<?= $S_HABA ?>"/>
                    <br/>
                </td>
            </tr>
            <tr>
                <th rowspan="4">返送先：</th>
                <td>郵便番号:
                    <?php if (preg_match('/^[0-9]{3}-?[0-9]{4}$/', $R_ZIPCODE) || (RTrim($R_ZIPCODE) == "")) { ?>
                        <?= htmlspecialchars($R_ZIPCODE) ?>
                    <?php } else { ?>
                        <?= htmlspecialchars($R_ZIPCODE) ?>
                        <span style="color:red;">　　郵便番号は、xxx-xxxxで登録してください。</span>
                        <?php $err_cnt = $err_cnt + 1; ?>
                    <?php } ?>
                    <input name="Text17" type="hidden" value="<?= $R_ZIPCODE ?>"/>
                </td>
            </tr>
            <tr>
                <td>住所:
                    <?= htmlspecialchars($R_ADDR) ?>
                    <input name="Text18" type="hidden" value="<?= $R_ADDR ?>"/>
                </td>
            </tr>
            <tr>
                <td>電話番号:
                    <?php if (preg_match('/^[0-9]{2,4}-?[0-9]{2,4}-?[0-9]{3,4}$/', $R_TEL) || (RTRIM($R_TEL) == "")) { ?>
                        <?= htmlspecialchars($R_TEL) ?>
                    <?php } else { ?>
                        <?= htmlspecialchars($R_TEL) ?>
                        <span style="color:red;">　　電話番号を、正しく登録してください。</span>
                        <?php $err_cnt = $err_cnt + 1; ?>
                    <?php } ?>
                    <input name="Text19" type="hidden" value="<?= $R_TEL ?>"/>
                </td>
            </tr>
            <tr>
                <td> 宛先（お名前）:
                    <?= htmlspecialchars($R_NAME) ?>
                    <input name="Text20" type="hidden" value="<?= $R_NAME ?>"/>
                </td>
            </tr>
            <input type="hidden" name="TextArea1" value=""/>

        <?php } ?>
        <!-- ============================================================= -->
    </table>
    <?php if ($err_cnt == 0) { ?>
        <p><input id="Button2" type="button" value="登録する"/></p>
        <p><input id="Button3" type="button" value="修正する"/></p>
    <?php } else { ?>
        <p><input id="Button3" type="button" value="修正する"/></p>
    <?php } ?>
    <input type="hidden" name="mnt_flg" value="<?= $mnt_flg ?>"/>
    <input type="hidden" name="kubun" value="<?= $KUBUN ?>"/>
    <input type="hidden" name="f_path" value="<?= htmlspecialchars($f_path) ?>"/>
    <input type="hidden" name="f_name" value="<?= htmlspecialchars($f_nm) ?>"/>
    <input type="hidden" name="f_type" value="<?= htmlspecialchars($f_type) ?>"/>
    <input type="hidden" name="rowid" value="<?= $ROWID ?>"/>
    <!-- ============================================================= -->
</form>
<iframe name="MNTframe" width="0" height="0" frameborder="0" sandbox="allow-forms allow-scripts allow-top-navigation">
    お使いのブラウザはインライン フレームをサポートしていないか、またはインライン フレームを表示しないように設定されています。
</iframe>

<script src="./js/jquery-2.2.0.min.js"></script>
<script type="text/javascript" src="./lightbox281/js/lightbox.js"></script>

<script type="text/javascript">
    $(function () {
        $("#Button2").bind("click", function () {
            if (document.form1.TextArea1) {
                document.form1.TextArea1.disabled = false;
            }
            if (document.form1.TextArea2) {
                document.form1.TextArea2.disabled = false;
            }
            document.form1.action = "./mnt1.php";
            document.form1.target = "MNTframe";
            document.form1.submit();
        });

        $("#Button3").bind("click", function () {
            alert("画像ファイルは、再登録してください。");
            if (document.form1.TextArea1) {
                document.form1.TextArea1.disabled = false;
            }
            if (document.form1.TextArea2) {
                document.form1.TextArea2.disabled = false;
            }
            document.form1.action = "./entry1.php";
            document.form1.target = "_self";
            document.form1.submit();
        });

    });
</script>
<!--Lightbox2オプションのカスタマイズ（必要時） -->
<script>
    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true
    })
</script>

</body>
</html>

