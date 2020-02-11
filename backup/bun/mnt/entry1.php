<?php
/*************************************************************************
 * 総合文化展
 *
 *    作品エントリー画面
 *
 *************************************************************************/

//外部スクリプト読み込み
require_once "env.php";

//	echo __FILE__ . '<br />';
//	echo dirname(__FILE__) . '<br />';
$err_cnt = 0;
$err_msg = "";

/*
    Check admin or not
*/
session_start();

$timeout = 600; // Number of seconds until it times out.

// Check if the timeout field exists.
if (isset($_SESSION['timeout'])) {
    // See if the number of seconds since the last
    // visit is larger than the timeout period.
    $duration = time() - (int)$_SESSION['timeout'];
    if ($duration > $timeout) {
        // Destroy the session and restart it.
        session_destroy();
        session_start();
    }
}

// Update the timout field with the current time.
$_SESSION['timeout'] = time();

if (isset($_SESSION[DF_SSN_ADMIN])) {
    $str_adm = RTrim($_SESSION[DF_SSN_ADMIN]);
} else {
    $str_adm = "";
}

if ($str_adm != "1") {
    header('Location: ' . '/');
}

// chọn loại
// 区分
if (isset($_POST['kubun'])) {
    $KUBUN = $_POST['kubun'];
} else {
    $KUBUN = "RA";
}
//	echo $SIBU."<br />";

// $mnt_flg 0:新規作成
if (isset($_POST['mnt_flg']) && is_numeric($_POST['mnt_flg'])) {
    $mnt_flg = $_POST['mnt_flg'] + 0;
} else {
    $mnt_flg = 0;
}
// echo "mnt_flg:".$mnt_flg."<br />";

// 作品番号
if (isset($_POST['rowid'])) {
    $ROWID = $_POST['rowid'];
} else {
    $ROWID = "";
}
//	echo $ROWID."<br />";
//Timecode for thumbnail
if (isset($_POST['TextArea21'])) {
    $Timecode = $_POST['TextArea21'];
} else {
    $Timecode = 0;
}
// 作

// $mnt_flg = 8 => edit,  = 0 => add
if ($mnt_flg == 8 AND $ROWID != "") {

    // create a connection
    $link = mysqli_connect($envDbServer, $envDbUser, $envDbUserPass);
    if (!$link) {
        //		die('接続失敗です。'.mysqli_error());
        $err_msg = '接続失敗です。' . mysqli_connect_error();
        $err_cnt = $err_cnt + 1;
    }

    //	print('<p>接続に成功しました。</p>');

    $db_selected = mysqli_select_db($link, $envDbName);
    if (!$db_selected) {
        //	die('データベース選択失敗です。'.mysqli_error());
        $err_msg = 'データベース選択失敗です。' . mysqli_error();
        $err_cnt = $err_cnt + 1;
    }

    //	print('<p>'.$envDbName.'データベースを選択しました。</p>');

    // MySQLに対する処理

    mysqli_set_charset('utf8');

    $sql = "select * from t_entryinfo where E_ROWID='$ROWID' ORDER BY E_ROWID desc; ";

    $result = mysqli_query($link, $sql);

    if (!$result) {
        //	die('SELECTクエリーが失敗しました。'.mysqli_error());
        $err_msg = 'SELECTクエリーが失敗しました。' . mysqli_error();
        $err_cnt = $err_cnt + 1;
    }

    while ($row = mysqli_fetch_assoc($result)) {

        // 作品文字
        $sakuhin = $row['E_TANKA_INFO'];
        // 作品コメント
        $comment = $row['E_COMMENT'];
        // 部門
        $BUMON = $row['E_BM_CODE'];
        // 支部名
        $SIBU = $row['E_DIV_NAME'];
        // 名前
        $SIMEI = $row['E_USR_NAME'];
        // 作品タイトル
        $S_TTL = $row['E_TITLE'];
        // 作品サイズ縦
        $S_TATE = $row['E_SIZE_L'];
        // 作品サイズ幅
        $S_YOKO = $row['E_SIZE_B'];
        // 作品サイズ幅
        $S_HABA = $row['E_SIZE_W'];
        // 返送先　郵便番号
        $R_ZIPCODE = $row['E_R_ZIPCODE'];
        // 返送先　住所
        $R_ADDR = $row['E_R_Addr'];
        // 返送先　電話番号
        $R_TEL = $row['E_R_TEL'];
        // 返送先　宛先
        $R_NAME = $row['E_R_NAME'];

        // ファイル名
        $file_nm = $row['E_FILE_NAME'];
        // ファイルパス
        $path = $envSakuhinFol . $KUBUN . "_" . $BUMON . "/" . $row['E_FILE_NAME'];
    }


    $close_flag = mysqli_close($link);

    if ($close_flag) {
        //	 print('<p>切断に成功しました。</p>');
    }


} else {

    // 作品文字
    if (isset($_POST['TextArea1'])) {
        $sakuhin = $_POST['TextArea1'];
    } else {
        $sakuhin = "";
    }
    //	echo $sakuhin."<br />";

    // 作品コメント
    if (isset($_POST['TextArea2'])) {
        $comment = $_POST['TextArea2'];
    } else {
        $comment = "";
    }
    //	echo $comment."<br />";

    // 部門
    if (isset($_POST['Select1'])) {
        $BUMON = $_POST['Select1'];
    } else {
        $BUMON = "";
    }
    //	echo $BUMON."<br />";

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
    //	echo $SIMEI."<br />";

    // 作品タイトル
    if (isset($_POST['Text13'])) {
        $S_TTL = $_POST['Text13'];
    } else {
        $S_TTL = "";
    }
    //	echo $S_TTL."<br />";

    // 作品サイズ縦
    if (isset($_POST['Text14'])) {
        $S_TATE = $_POST['Text14'];
    } else {
        $S_TATE = "";
    }
    //	echo $S_TATE."<br />";

    // 作品サイズ横
    if (isset($_POST['Text15'])) {
        $S_YOKO = $_POST['Text15'];
    } else {
        $S_YOKO = "";
    }
    //	echo $S_YOKO."<br />";

    // 作品サイズ幅
    if (isset($_POST['Text16'])) {
        $S_HABA = $_POST['Text16'];
    } else {
        $S_HABA = "";
    }
    //	echo $S_HABA."<br />";

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
    //	echo $R_ADDR."<br />";

    // 返送先　電話番号
    if (isset($_POST['Text19'])) {
        $R_TEL = $_POST['Text19'];
    } else {
        $R_TEL = "";
    }
    //	echo $R_TEL."<br />";

    // 返送先　宛先
    if (isset($_POST['Text20'])) {
        $R_NAME = $_POST['Text20'];
    } else {
        $R_NAME = "";
    }
    //	echo $R_NAME."<br />";

    //Timecode for thumbnail
   /* if (isset($_POST['TextArea21'])) {
        $Timecode = $_POST['TextArea21'];
    } else {
        $Timecode = 0;
    }*/
    // 作
}


?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>総合文化展 作品登録</title>
    <!--CSSファイルのみ -->
    <link rel="stylesheet" href="./lightbox281/css/lightbox.css" type="text/css" media="screen"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
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
        <h2>作品登録　『 らくらくエントリーの部 』</h2>
        <div class="btn-group" role="group" aria-label="Basic example">
            <input id="Button2" type="button" value="力作じまんの部→">
            <input id="Button3" type="button" value="登録済み一覧→">

        </div>
    <?php } else { ?>
        <h2>作品登録　『力作じまんの部 』</h2>
        <div class="btn-group" role="group" aria-label="Basic example">
            <input id="Button2" type="button" value="らくらくエントリーの部→">
            <input id="Button3" type="button" value="登録済み一覧→">

        </div>
    <?php } ?>
    <!-- ============================================================= -->
    <hr/>

    <table class="table " border="2" style="
    margin-left: 5px;"
    >
        <!-- ============================================================= -->
        <?php if ($KUBUN == "RA") { ?>
            <tr>
                <th>部門：</th>
                <td>
                    <select id="select1" name="Select1">
                        <option value="B01">写真</option>
                        <option value="B02" <?php if ($BUMON == "B02") {
                            echo "selected";
                        } ?>>イラスト
                        </option>
                        <option value="B03" <?php if ($BUMON == "B03") {
                            echo "selected";
                        } ?>>川柳
                        </option>
                        <option value="B04" <?php if ($BUMON == "B04") {
                            echo "selected";
                        } ?>>俳句
                        </option>
                        <option value="B05" <?php if ($BUMON == "B05") {
                            echo "selected";
                        } ?>>短歌
                        </option>
                        <option value="B06" <?php if ($BUMON == "B06") {
                            echo "selected";
                        } ?>>Video
                        </option>
                        <option value="B07" <?php if ($BUMON == "B07") {
                            echo "selected";
                        } ?>>Audio
                        </option>
                    </select>
                </td>
            </tr>

            <tr>
                <th>作品：</th>
                <td>
                    <?php if ($mnt_flg == 8 AND $ROWID != "" AND RTrim($file_nm) != "") { ?>
                        <a href="<?= $path ?>" rel="lightbox" title="my caption">
                            <img id="imgTEMP" src="<?= $path ?>" width="150" height="112" alt="" border=0></a>
                        <br/>
                        <div id="file-label">
                            <legend>画像ファイルを変更(GIF, JPEG, PNGのみ対応)</legend>
                            <input name="File1" type="file" accept="image/*" onchange="Filevalidation()" size=55/>
                        </div>
                    <?php } else { ?>
                        <div id="file-label">
                            <legend>画像ファイルを選択(GIF, JPEG, PNGのみ対応)</legend>
                            <input name="File1" type="file" accept="image/*" onchange="Filevalidation()" size=55/>
                        </div>
                    <?php } ?>
                    <br/>
                    <hr/>
                    <legend>川柳・俳句・短歌作品</legend>
                    <textarea name="TextArea1" cols="50" rows="5"><?= $sakuhin ?></textarea><br>
                </td>
            </tr>
            <tr>
                <th>作品コメント：</th>
                <td>
                    <textarea name="TextArea2" cols="50" rows="5"><?= $comment ?></textarea><br>
                </td>
            </tr>
            <tr>
                <th>支部名：</th>
                <td><select name="Text11">
                        <option value="">
                            <?php
                            foreach ($envShibu as $val) {
                                if ($SIBU == $val) {
                                    echo "<option value=\"$val\" selected>$val";
                                } else {
                                    echo "<option value=\"$val\">$val";
                                }
                            }
                            ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>名前：</th>
                <td>
                    <input name="Text12" type="text" value="<?= $SIMEI ?>"/><br/>
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
                <th>部門：</th>
                <td>
                    <select id="select1" name="Select1">
                        <option value="P01">絵画</option>
                        <option value="P02" <?php if ($BUMON == "P02") {
                            echo "selected";
                        } ?>>書道
                        </option>
                        <option value="P03" <?php if ($BUMON == "P03") {
                            echo "selected";
                        } ?>>写真
                        </option>
                        <option value="P04" <?php if ($BUMON == "P04") {
                            echo "selected";
                        } ?>>手芸・工芸
                        </option>
                        <option value="C01" <?php if ($BUMON == "C01") {
                            echo "selected";
                        } ?>>絵画（子供の部）
                        </option>
                        <option value="C02" <?php if ($BUMON == "C02") {
                            echo "selected";
                        } ?>>書道（子供の部）
                        </option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>作品：</th>
                <td>
                    <?php if ($mnt_flg == 8 AND $ROWID != "" AND RTrim($file_nm) != "") { ?>
                        <a href="<?= $path ?>" rel="lightbox" title="my caption">
                            <img id="imgTEMP" src="<?= $path ?>" width="150" height="112" alt="" border=0></a>
                        <br/>
                        <legend>画像ファイルを変更(GIF, JPEG, PNGのみ対応)</legend>
                        <input name="File1" type="file" size=55/>
                    <?php } else { ?>
                        <legend>画像ファイルを選択(GIF, JPEG, PNGのみ対応)</legend>
                        <input name="File1" type="file" size=55/>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <th>作品タイトル：</th>
                <td>
                    <input name="Text13" type="text" value="<?= htmlspecialchars($S_TTL) ?>"/><br/>
                </td>
            </tr>
            <tr>
                <th>作品コメント：</th>
                <td>
                    <textarea name="TextArea2" cols="50" rows="5"><?= htmlspecialchars($comment) ?></textarea><br>
                </td>
            </tr>
            <tr>
                <th>支部名：</th>
                <td><select name="Text11">
                        <option value="">
                            <?php
                            foreach ($envShibu as $val) {
                                if ($SIBU == $val) {
                                    echo "<option value=\"$val\" selected>$val";
                                } else {
                                    echo "<option value=\"$val\">$val";
                                }
                            }
                            ?>
                    </select>
                </td>
                </td>
            </tr>
            <tr>
                <th>名前：</th>
                <td>
                    <input name="Text12" type="text" value="<?= $SIMEI ?>"/><br/>
                </td>
            </tr>
            <tr>
                <th>作品サイズ：</th>
                <td>
                    縦：<input name="Text14" type="text" size="5" maxlength="5" value="<?= $S_TATE ?>"/>　cm<br/>
                    横：<input name="Text15" type="text" size="5" maxlength="5" value="<?= $S_YOKO ?>"/>　cm<br/>
                    幅・奥行き：<input name="Text16" type="text" size="5" maxlength="5" value="<?= $S_HABA ?>"/>　cm<br/>
                </td>
            </tr>
            <tr>
                <th rowspan="4">返送先：</th>
                <td>郵便番号:<input name="Text17" type="text" size="8" maxlength="8" value="<?= $R_ZIPCODE ?>"/></td>
            </tr>
            <tr>
                <td>住所:<input name="Text18" type="text" size="50" value="<?= $R_ADDR ?>"/></td>
            </tr>
            <tr>
                <td>電話番号:<input name="Text19" type="text" size="20" value="<?= $R_TEL ?>"/></td>
            </tr>
            <tr>
                <td> 宛先（お名前）:<input name="Text20" type="text" size="30" value="<?= $R_NAME ?>"/></td>
            </tr>
            <input type="hidden" name="TextArea1" value=""/>
        <?php } ?>
        <!-- ============================================================= -->
    </table>
    <?php if ($mnt_flg == 8 AND $ROWID != "") { ?>
        <p><input id="Button11" type="button" value="内容を変更する"/></p>
        <p><input id="Button12" type="button" value="削除する"/></p>
        <p><input id="Button13" type="button" value="キャンセル"/></p>
    <?php } else { ?>
        <p><input id="Button1" type="button" value="内容を確認する"/></p>
    <?php } ?>
    <input type="hidden" name="kubun" value="<?= $KUBUN ?>"/>
    <input type="hidden" name="mnt_flg" value="<?= $mnt_flg ?>"/>
    <input type="hidden" name="rowid" value="<?= $ROWID ?>"/>
    <input type="hidden" name="svBumon" value="<?= $BUMON ?>"/>
    <input type="hidden" name="svFile" value="<?= $path ?>"/>
    <!-- ============================================================= -->
</form>
<iframe name="MNTframe" width="0" height="0" frameborder="0" sandbox="allow-forms allow-scripts allow-top-navigation">
    お使いのブラウザはインライン フレームをサポートしていないか、またはインライン フレームを表示しないように設定されています。
</iframe>

<script src="./js/jquery-2.2.0.min.js"></script>
<script type="text/javascript" src="./lightbox281/js/lightbox.js"></script>

<script type="text/javascript">
    $(document).ready(function () {

        $("#Button1").bind("click", function () {
            document.form1.action = "./chk1.php";
            document.form1.target = "_self";
            document.form1.submit();
        });

        $("#Button2").bind("click", function () {
            document.form1.mnt_flg.value = "0";
            if (document.form1.kubun.value == "RA") {
                document.form1.kubun.value = "RI";
            } else {
                document.form1.kubun.value = "RA";
            }

            document.form1.action = "./entry1.php";
            document.form1.target = "_self";
            document.form1.submit();
        });

        $("#Button3").bind("click", function () {
            document.form1.mnt_flg.value = "0";
            document.form1.action = "./lst1.php";
            document.form1.target = "_self";
            document.form1.submit();
        });


        $("#Button11").bind("click", function () {
            if (confirm("変更します。\nよろしいですか？")) {
                document.form1.action = "./upt1.php";
                document.form1.target = "MNTframe";
//document.form1.target = "_self";
                document.form1.submit();
            }
        });

        $("#Button12").bind("click", function () {
            if (confirm("削除します。\nよろしいですか？")) {
                document.form1.action = "./del1.php";
                document.form1.target = "MNTframe";
//document.form1.target = "_self";
                document.form1.submit();
            }
        });

        $("#Button13").bind("click", function () {
            document.form1.mnt_flg.value = "0";
            document.form1.TextArea1.value = "";
            document.form1.TextArea2.value = "";
            document.form1.Select1.value = "";
            document.form1.Text11.value = "";
            document.form1.Text12.value = "";
            document.form1.Text13.value = "";
            document.form1.Text14.value = "";
            document.form1.Text15.value = "";
            document.form1.Text16.value = "";
            document.form1.Text17.value = "";
            document.form1.Text18.value = "";
            document.form1.Text19.value = "";
            document.form1.Text20.value = "";
            document.form1.action = "./entry1.php";
            document.form1.target = "_self";
            document.form1.submit();
        });
        $("#select1").change(function () {
            var str = "";
            $("#select1 option:selected").each(function () {
                str += $(this).val() + " ";
                console.log(str);
            });

            if (str.includes("B06")) {
                $("#file-label").empty();
                $("#file-label").append("<legend>Change Video File(MP4, WEBM)</legend> <input name=\"File1\" accept=\"video/*\" onchange=\"Filevalidation()\" id=\"video-file\" type=\"file\" size=55 />");
            } else if (str.includes("B07")) {
                $("#file-label").empty();
                $("#file-label").append("<legend>Choose Audio File(MP3, OGG, FLAC)</legend> <input name=\"File1\" accept=\"audio/*\" onchange=\"Filevalidation()\" id=\"audio-file\" type=\"file\" size=55 />");
            }


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
<script>
    //[Validate]
    //Validate size of file if file EMPTY or >100MB
    Filevalidation = () => {
        var fi = document.getElementById('video-file');
        var i;
        // Check if any file is selected. 
        if (fi.files.length > 0) {
            for (i = 0; i <= fi.files.length - 1; i++) {

                const fsize = fi.files.item(i).size;
                const file = Math.round((fsize / 1024));
                // The size of the file. 
                if (file >= 102400) {
                    alert(
                        "File too Big, please select a file less than 100mb");
                    fi.value = '';
                } else if (file < 1) {
                    alert(
                        "File too small, please select a file greater than 1kb");
                    fi.value = '';
                }
            }
        }
    }
</script>
</body>
</html>

