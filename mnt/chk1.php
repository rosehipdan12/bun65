<?php
require_once "env.php";
require_once "../const.php";
$err_cnt = 0;

$f_path = "";
$f_nm = "";
$f_type = "";
/**********************************************************************/

/**************************************************************************/


if (isset($_POST['kubun'])) {
    $KUBUN = $_POST['kubun'];
} else {
    $KUBUN = "RA";
}
// $mnt_flg 0:新規作成
if (isset($_POST['mnt_flg']) && is_numeric($_POST['mnt_flg'])) {
    $mnt_flg = $_POST['mnt_flg'] + 0;
} else {
    $mnt_flg = 0;
}

// 作品番号
if (isset($_POST['rowid'])) {
    $ROWID = $_POST['rowid'];
} else {
    $ROWID = "";
}

//
if (isset($_POST['INS_DATE'])) {
    $INS_DATE = $_POST['INS_DATE'];
} else {
    $INS_DATE = "";
}

// 作品コメント
if (isset($_POST['COMMENT'])) {
    $comment = $_POST['COMMENT'];
} else {
    $comment = "";
}

// 部門
if (isset($_POST['BM_CODE'])) {
    $BM_CODE = $_POST['BM_CODE'];
} else {
    $BM_CODE = "";
}

// 区分
if (isset($_POST['KBN_CODE'])) {
    $KBN_CODE = $_POST['KBN_CODE'];
} else {
    $KBN_CODE = "";
}

// 支部名
if (isset($_POST['DIV_NAME'])) {
    $DIV_NAME = $_POST['DIV_NAME'];
} else {
    $DIV_NAME = "";
}
//	echo $DIV_NAME."<br />";

// 名前
if (isset($_POST['USR_NAME'])) {
    $USR_NAME = $_POST['USR_NAME'];
} else {
    $USR_NAME = "";
}

if (isset($_POST['USR_NAME_F'])) {
    $USR_NAME_F = $_POST['USR_NAME_F'];
} else {
    $USR_NAME_F = "";
}

if (isset($_POST['USR_MEMBER_NAME'])) {
    $USR_MEMBER_NAME = $_POST['USR_MEMBER_NAME'];
} else {
    $USR_MEMBER_NAME = "";
}

//echo $USR_NAME . "<br />";

// 作品タイトル
if (isset($_POST['TITLE'])) {
    $TITLE = $_POST['TITLE'];
} else {
    $TITLE = "";
}
//echo $TITLE . "<br />";

// 作品サイズ縦
if (isset($_POST['SIZE_L'])) {
    $SIZE_L = $_POST['SIZE_L'];
} else {
    $SIZE_L = "0";
}
//echo $SIZE_L . "<br />";

// 作品サイズ横
if (isset($_POST['SIZE_B'])) {
    $SIZE_B = $_POST['SIZE_B'];
} else {
    $SIZE_B = "0";
}
//echo $SIZE_B . "<br />";

// 作品サイズ幅
if (isset($_POST['SIZE_W'])) {
    $SIZE_W = $_POST['SIZE_W'];
} else {
    $SIZE_W = "0";
}

// 作品サイズ幅
if (isset($_POST['WEIGHT'])) {
    $WEIGHT = $_POST['WEIGHT'];
} else {
    $WEIGHT = "0";
}

// 返送先　宛先
if (isset($_POST['AGE_KBN'])) {
    $AGE_KBN = $_POST['AGE_KBN'];
} else {
    $AGE_KBN = "";
}

// 返送先　宛先
if (isset($_POST['PAR_KBN'])) {
    $PAR_KBN = $_POST['PAR_KBN'];
} else {
    $PAR_KBN = "";
}

//echo $R_NAME . "<br />";

//echo $file['name']."<br />";
// 画像

$file = $_FILES['FILE_PATH'];

//Log Create
function createLog($msg = "", $type = "DEBUG")
{
    // $file = "/var/www/html/public/log/import_video_" . date('Ymd', time()) . ".log";
    $file = "../log/import_video_" . date('Ymd', time()) . ".log";

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
$log_file = createLog('UPLOAD [' . $KBN_CODE . " - " . $file['name'] . ']', 'DEBUG');

if ($KBN_CODE == "FF08") {
    if (isset($file['error']) && is_int($file['error'])) {

        try {

            // $file['error'] の値を確認
            switch ($file['error']) {
                case UPLOAD_ERR_OK: // OK
                    $log_file = createLog('Upload ERROR [' . $file['error'] . ']', 'ERROR');
                    break;
                case UPLOAD_ERR_NO_FILE:   // ファイル未選択
                    $log_file = createLog('No File Input [' . $file['error'] . ']', 'ERROR');

                    //					throw new RuntimeException('ファイルが選択されていません');
                    $f_flg = 1;
                    break;
                case UPLOAD_ERR_INI_SIZE:  // php.ini定義の最大サイズ超過
                    $log_file = createLog('File Size Error [' . $file['error'] . ']', 'ERROR');
                case UPLOAD_ERR_FORM_SIZE: // フォーム定義の最大サイズ超過
                    $log_file = createLog('File Size Too Big [' . $file['error'] . ']', 'ERROR');
                    throw new RuntimeException('ファイルサイズが大きすぎます');

                default:
                    $log_file = createLog('Reason undefined [' . $file['error'] . ']', 'ERROR');
                    throw new RuntimeException('その他のエラーが発生しました');
            }

            $name = $file['name'];
            // $target_dir = "/var/www/html/public/mnt/uploads/";
            $target_dir = "../mnt/uploads/";
            $target_file = $target_dir . $file["name"];
            // $file['mime']の値はブラウザ側で偽装可能なので、MIMEタイプを自前でチェックする
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
            // echo $path . " ";
            // echo $f_nm;
            $f_type = $type;
            if (!move_uploaded_file($file['tmp_name'], $path)) {
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
/**
 *[UPLOAD]
 *Upload AUDIO file
 */
elseif ($KBN_CODE == "FF07") {

    if (isset($file['error']) && is_int($file['error'])) {
        try {

            // $file['error'] の値を確認
            switch ($file['error']) {
                case UPLOAD_ERR_OK: // OK
                    $log_file = createLog('Upload ERROR [' . $file['error'] . ']', 'ERROR');
                    break;
                case UPLOAD_ERR_NO_FILE:   // ファイル未選択
                    $log_file = createLog('No File Input [' . $file['error'] . ']', 'ERROR');

                    //					throw new RuntimeException('ファイルが選択されていません');
                    $f_flg = 1;
                    break;
                case UPLOAD_ERR_INI_SIZE:  // php.ini定義の最大サイズ超過
                    $log_file = createLog('File Size Error [' . $file['size'] . ']', 'ERROR');
                case UPLOAD_ERR_FORM_SIZE: // フォーム定義の最大サイズ超過
                    $log_file = createLog('File Size Too Big [' . $file['size'] . ']', 'ERROR');
                    throw new RuntimeException('ファイルサイズが大きすぎます');

                default:
                    $log_file = createLog('Reason undefined [' . $file['error'] . ']', 'ERROR');
                    throw new RuntimeException('その他のエラーが発生しました');
            }

            $name = $file['name'];

            // echo "name: " . $name . "<br />";
            // $target_dir = "/var/www/html/public/mnt/uploads/";
            $target_dir = "../mnt/uploads/";
            $target_file = $target_dir . $file["name"];
            // $file['mime']の値はブラウザ側で偽装可能なので、MIMEタイプを自前でチェックする
            $type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // echo "type " . $type;

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
            // echo $path . " ";
            // echo $f_nm;
            $f_type = $type;
            if (!move_uploaded_file($file['tmp_name'], $path)) {
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

    if (isset($file['error']) && is_int($file['error'])) {
        try {

            // $file['error'] の値を確認
            switch ($file['error']) {
                case UPLOAD_ERR_OK: // OK
                    $log_file = createLog('Upload ERROR [' . $file['error'] . ']', 'ERROR');
                    break;
                case UPLOAD_ERR_NO_FILE:   // ファイル未選択
                    $log_file = createLog('No File Input [' . $file['error'] . ']', 'ERROR');

                    //					throw new RuntimeException('ファイルが選択されていません');
                    $f_flg = 1;
                    break;
                case UPLOAD_ERR_INI_SIZE:  // php.ini定義の最大サイズ超過
                    $log_file = createLog('File Size Error [' . $file['size'] . ']', 'ERROR');
                case UPLOAD_ERR_FORM_SIZE: // フォーム定義の最大サイズ超過
                    $log_file = createLog('File Size Too Big [' . $file['size'] . ']', 'ERROR');
                    throw new RuntimeException('ファイルサイズが大きすぎます');

                default:
                    $log_file = createLog('Reason undefined [' . $file['error'] . ']', 'ERROR');
                    throw new RuntimeException('その他のエラーが発生しました');
            }

            $name = $file['name'];

            // echo "name: " . $name . "<br />";
            // $target_dir = "/var/www/html/public/mnt/uploads/";
            $target_dir = "../mnt/uploads/";
            $target_file = $target_dir . $file["name"];
            // $file['mime']の値はブラウザ側で偽装可能なので、MIMEタイプを自前でチェックする
            $type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // echo "type " . $type;

            // Valid file extensions
            $extensions_arr = array("jpg", "jpeg", "png",'gif');

            //if (!in_array($type, [IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG], true)) {
            if (!in_array($type, $extensions_arr, true)) {
                $log_file = createLog('Wrong File Type (' . $type . ')', 'ERROR');
                throw new RuntimeException('画像形式が未対応です');
            }

            // ファイルデータからSHA-1ハッシュを取ってファイル名を決定し、ファイルを保存する
            $f_nm = $name;
            $path = $target_file;
            // echo $path . " ";
            // echo $f_nm;
            $f_type = $type;
            if (!move_uploaded_file($file['tmp_name'], $path)) {
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

if (($file['error'] == UPLOAD_ERR_NO_FILE)) {
    // echo "作品が登録されていません。";
    $msg = "作品が登録されていません。";
}

// $f_path = dirname(__FILE__) . "/uploads/";
$f_path = "../mnt/uploads/";
$reviewPath = "../mnt/uploads/" . $f_nm;
// echo $reviewPath;

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>総合文化展 作品登録</title>
    <!--CSSファイルのみ -->
    <link rel="stylesheet" href="./lightbox281/css/lightbox.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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

        body {
            margin: 10px;
        }

        body #title {
            width: 80%;
            /*text-align: center;*/
        }

        #footer {
            width: 80%;
            /*text-align: center;*/
        }

        body input[type=button] {
            margin: 10px 5px 0px 5px;
        }

        body input[type=text],
        body textarea {
            width: 80%;
        }
    </style>
</head>

<body>
    <section id="title">
        <div style="text-align: left; margin-bottom: 20px">
            <b>
                全富士通労働組合連合会結成50周年記念行事
                <br>
                富士通労働組合単一組織結成70周年記念事業
            </b>
        </div>
    </section>
    <form method="post" enctype="multipart/form-data" name="form1">

        <table border="2">
            <!-- ============================================================= -->
            <?php if ($KUBUN == "RA") { ?>

                <tr>
                    <th>申込日:</th>
                    <td>
                        <?php echo ($INS_DATE['year'] . '年' . $INS_DATE['month'] . '月' . $INS_DATE['day'] . '日'); ?>
                    </td>
                </tr>

                <tr>
                    <th>組合：</th>
                    <td>
                        <?php if (trim($DIV_NAME) == "") { ?>
                            <span style="color:red;">必須項目です。入力ください</span>
                            <?php $err_cnt = $err_cnt + 1; ?>
                        <?php } else { ?>
                            <?= htmlspecialchars($DIV_NAME) ?>
                            <input name="DIV_NAME" type="hidden" value="<?= htmlspecialchars($DIV_NAME) ?>" />
                        <?php } ?>
                    </td>
                </tr>

                <tr>
                    <th>申込者（作者）氏名：</th>
                    <td>
                        <?php if (trim($USR_NAME) == "") { ?>
                            <span style="color:red;">必須項目です。入力ください</span>
                            <?php $err_cnt = $err_cnt + 1; ?>
                        <?php } else { ?>
                            <?= htmlspecialchars($USR_NAME) ?>
                            <input name="USR_NAME" type="hidden" value="<?= htmlspecialchars($USR_NAME) ?>" />
                        <?php } ?>
                    </td>
                </tr>

                <tr>
                    <th>申込者（作者）氏名（ふりがな）：</th>
                    <td>
                        <?php if (trim($USR_NAME_F) == "") { ?>
                            <span style="color:red;">必須項目です。入力ください</span>
                            <?php $err_cnt = $err_cnt + 1; ?>
                        <?php } else { ?>
                            <?= htmlspecialchars($USR_NAME_F) ?>
                            <input name="USR_NAME_F" type="hidden" value="<?= htmlspecialchars($USR_NAME_F) ?>" />
                        <?php } ?>
                    </td>
                </tr>

                <tr>
                    <th>組合員氏名:</th>
                    <td>
                        <?php if (trim($USR_MEMBER_NAME) == "" && trim($USR_NAME) != "") { ?>
                            <span style="color:red;">必須項目です。入力ください</span>
                            <?php $err_cnt = $err_cnt + 1; ?>
                        <?php } else { ?>
                            <?= htmlspecialchars($USR_MEMBER_NAME) ?>
                            <input name="USR_MEMBER_NAME" type="hidden" value="<?= htmlspecialchars($USR_MEMBER_NAME) ?>" />
                        <?php } ?>
                    </td>
                </tr>

                <tr>
                    <th>参加区分　※応募時：</th>
                    <td>
                        <?php if (trim($PAR_KBN) == "") { ?>
                            <span style="color:red;">必須項目です。入力ください</span>
                            <?php $err_cnt = $err_cnt + 1; ?>
                        <?php } else { ?>
                            <?= htmlspecialchars($PAR_KBN) ?>
                            <input name="PAR_KBN" type="hidden" value="<?= htmlspecialchars($PAR_KBN) ?>" />
                        <?php } ?>
                    </td>
                </tr>

                <tr>
                    <th>年齢区分　※応募時：</th>
                    <td>
                        <?php if (trim($AGE_KBN) == "") { ?>
                            <span style="color:red;">必須項目です。入力ください</span>
                            <?php $err_cnt = $err_cnt + 1; ?>
                        <?php } else { ?>
                            <?= htmlspecialchars($AGE_KBN) ?>
                            <input name="AGE_KBN" type="hidden" value="<?= htmlspecialchars($AGE_KBN) ?>" />
                        <?php } ?>
                    </td>
                </tr>

                <tr>
                    <th>部門：</th>
                    <td>
                        <?= E_BM_CODE[$BM_CODE] ?>
                        <input type="hidden" name="BM_CODE" value="<?= $BM_CODE ?>">
                    </td>
                </tr>

                <tr>
                    <th>カテゴリー：</th>
                    <td>
                        <?= E_KBN_CODE[$KBN_CODE] ?>
                        <input type="hidden" name="KBN_CODE" value="<?= $KBN_CODE ?>">
                    </td>
                </tr>

                <tr>
                    <th>作品：</th>
                    <td>
                        <?php if (isset($f_flg)) { ?>
                            <span style="color:red;">作品が登録されていません</span>
                            <?php $err_cnt = $err_cnt + 1; ?>
                        <?php } else { ?>
                            <?php if (!isset($f_flg)) { ?>
                                <legend>画像ファイル</legend>
                                <a href="<?= $reviewPath ?>" rel="lightbox" title="my caption">
                                    <?php if ($KBN_CODE == "FF08") { ?>
                                        <video id="videoPlayer" class="video-js vjs-default-skin vjs-big-play-centered w160 h160" controls preload="none" width="300" height="150" data-setup={}>
                                            <source src="<?= $reviewPath ?>" type="video/<?= $type ?>" />
                                        </video>
                                    <?php } else { ?>
                                        <img id="imgTEMP" src="<?= $reviewPath ?>" width="150" height="112" alt="" border=0>
                                    <?php } ?>
                                </a>
                                <br />
                                <br />
                            <?php } ?>
                        <?php } ?>
                    </td>
                </tr>


                <tr>
                    <th>作品タイトル：</th>
                    <td>
                        <?php if (trim($TITLE) == "") { ?>
                            <span style="color:red;">作品タイトルが登録されていません</span>
                            <?php $err_cnt = $err_cnt + 1; ?>
                        <?php } else { ?>
                            <?= htmlspecialchars($TITLE) ?>
                            <input name="TITLE" type="hidden" value="<?= htmlspecialchars($TITLE) ?>" />
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <th>作品コメント：</th>
                    <td>
                        <textarea name="COMMENT" cols="50" rows="5" disabled><?php if (trim($comment) != "") {
                                                                                    echo htmlspecialchars($comment);
                                                                                } ?></textarea><br>
                    </td>
                </tr>

                <!-- <tr>
                <th>名前：</th>
                <td>
                    <?php if (trim($USR_NAME) == "") { ?>
                        <span style="color:red;">名前が登録されていません</span>
                        <?php $err_cnt = $err_cnt + 1; ?>
                    <?php } else { ?>
                        <?= htmlspecialchars($USR_NAME) ?>
                    <?php } ?>
                    <input name="Text12" type="hidden" value="<?= htmlspecialchars($USR_NAME) ?>"/>
                </td>
            </tr> -->
                <tr>
                    <th>額、表装を含めた作品サイズ</th>
                    <td>
                        縦：
                        <?php if (preg_match('/^[0-9]*[.]*[0-9]*$/', $SIZE_L)) { ?>
                            <?= htmlspecialchars($SIZE_L) ?>　cm
                        <?php } else { ?>
                            <?= htmlspecialchars($SIZE_L) ?>　cm
                            <span style="color:red;">　　作品サイズは、整数で登録してください。</span>
                            <?php $err_cnt = $err_cnt + 1; ?>
                        <?php } ?>
                        <input name="SIZE_L" type="hidden" value="<?= $SIZE_L ?>" />
                        <br />
                        横：
                        <?php if (preg_match('/^[0-9]*[.]*[0-9]*$/', $SIZE_B)) { ?>
                            <?= htmlspecialchars($SIZE_B) ?>　cm
                        <?php } else { ?>
                            <?= htmlspecialchars($SIZE_B) ?>　cm
                            <span style="color:red;">　　作品サイズは、整数で登録してください。</span>
                            <?php $err_cnt = $err_cnt + 1; ?>
                        <?php } ?>
                        <input name="SIZE_B" type="hidden" value="<?= $SIZE_B ?>" />
                        <br />
                        幅・奥行き：
                        <?php if (preg_match('/^[0-9]*[.]*[0-9]*$/', $SIZE_W)) { ?>
                            <?= htmlspecialchars($SIZE_W) ?>　cm
                        <?php } else { ?>
                            <?= htmlspecialchars($SIZE_W) ?>　cm
                            <span style="color:red;">　　作品サイズは、整数で登録してください。</span>
                            <?php $err_cnt = $err_cnt + 1; ?>
                        <?php } ?>
                        <input name="SIZE_W" type="hidden" value="<?= $SIZE_W ?>" />
                        <br />
                        重量:
                        <?php if (preg_match('/^[0-9]*[.]*[0-9]*$/', $WEIGHT)) { ?>
                            <?= htmlspecialchars($WEIGHT) ?>　kg
                        <?php } else { ?>
                            <?= htmlspecialchars($WEIGHT) ?>　kg
                            <span style="color:red;">　　作品サイズは、整数で登録してください。</span>
                            <?php $err_cnt = $err_cnt + 1; ?>
                        <?php } ?>
                        <input name="WEIGHT" type="hidden" value="<?= $WEIGHT ?>" />
                        <br />
                    </td>
                </tr>

                <input type="hidden" name="TextArea1" value="" />
                <input name="Text13" type="hidden" value="" />
                <input name="Text14" type="hidden" value="" />
                <input name="Text15" type="hidden" value="" />
                <input name="Text16" type="hidden" value="" />
                <input name="Text17" type="hidden" value="" />
                <input name="Text18" type="hidden" value="" />
                <input name="Text19" type="hidden" value="" />
                <input name="Text20" type="hidden" value="" />


                <input name="INS_DATE" type="hidden" value="<?php echo (date("Y-m-d", strtotime($INS_DATE['year'] . "-" . $INS_DATE['month'] . "-" . $INS_DATE['day']))); ?>">

            <?php } ?>
            <!-- ============================================================= -->
        </table>

        <p><input id="Button3" type="button" value="修正する" /></p>

        <?php if ($err_cnt == 0) { ?>
            <p><input id="Button2" type="button" value="登録する" /></p>
            <!-- <p><input id="Button3" type="button" value="修正する"/></p> -->
        <?php } ?>
        <input type="hidden" name="mnt_flg" value="<?= $mnt_flg ?>" />
        <input type="hidden" name="kubun" value="<?= $KUBUN ?>" />
        <input type="hidden" name="f_path" value="<?= htmlspecialchars($f_path) ?>" />
        <input type="hidden" name="f_name" value="<?= htmlspecialchars($f_nm) ?>" />
        <input type="hidden" name="f_type" value="<?= htmlspecialchars($f_type) ?>" />
        <input type="hidden" name="rowid" value="<?= $ROWID ?>" />
        <!-- ============================================================= -->
    </form>
    <iframe name="MNTframe" width="0" height="0" frameborder="0" sandbox="allow-forms allow-scripts allow-top-navigation">
        お使いのブラウザはインライン フレームをサポートしていないか、またはインライン フレームを表示しないように設定されています。
    </iframe>

    <script src="./js/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="./lightbox281/js/lightbox.js"></script>

    <script type="text/javascript">
        $(function() {
            $("#Button2").bind("click", function() {
                if (document.form1.COMMENT) {
                    document.form1.COMMENT.disabled = false;
                }
                document.form1.action = "./mnt1.php";
                document.form1.target = "MNTframe";
                document.form1.submit();
            });

            $("#Button3").bind("click", function() {
                alert("画像ファイルは、再登録してください。");
                if (document.form1.COMMENT) {
                    document.form1.COMMENT.disabled = false;
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