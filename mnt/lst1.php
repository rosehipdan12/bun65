<?php
/*************************************************************************
 * 総合文化展
 *
 *    登録済み作品一覧画面
 *
 *************************************************************************/

//外部スクリプト読み込み
require_once "env.php";

$err_cnt = 0;
$err_msg = "";

// 区分
if (isset($_POST['kubun'])) {
    $KUBUN = $_POST['kubun'];
} else {
    $KUBUN = "";
}

// Tìm kiếm theo department

//* 部門で絞り込み
$selB01 = "";
$selB02 = "";
$selB03 = "";
$selB04 = "";
$selB05 = "";
$selB06 = "";
$selB07 = "";
$selP01 = "";
$selP02 = "";
$selP03 = "";
$selP04 = "";
$selC01 = "";
$selC02 = "";
$selBumon = "";
if (isset($_POST['selBumon'])) {
    $selBumon = $_POST['selBumon'];
    switch ($selBumon) {
        case    "B01":
            $selB01 = " selected";
            break;
        case    "B02":
            $selB02 = " selected";
            break;
        case    "B03":
            $selB03 = " selected";
            break;
        case    "B04":
            $selB04 = " selected";
            break;
        case    "B05":
            $selB05 = " selected";
            break;
        case    "B06":
            $selB06 = " selected";
            break;
        case    "B07":
            $selB07 = " selected";
            break;
        case    "P01":
            $selP01 = " selected";
            break;
        case    "P02":
            $selP02 = " selected";
            break;
        case    "P03":
            $selP03 = " selected";
            break;
        case    "P04":
            $selP04 = " selected";
            break;
        case    "C01":
            $selC01 = " selected";
            break;
        case    "C02":
            $selC02 = " selected";
            break;
    }
}

// tìm kiếm theo nhãn
//* 支部で絞り込み
if (isset($_POST['selSibu'])) {
    $selSibu = $_POST['selSibu'];
} else {
    $selSibu = "";
}

// tìm kiếm theo tên
//* 名前で絞り込み
if (isset($_POST['inName'])) {
    $inName = $_POST['inName'];
} else {
    $inName = "";
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>総合文化展 登録済み作品一覧</title>
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

        .cmt_sel {
            max-width: 400px;
            word-break: break-all;
            word-wrap: break-word;
        }
    </style>
</head>

<body>
<form method="post" enctype="multipart/form-data" name="form1">
    <?php if ($KUBUN == "RA") { ?>
        <h2>登録済み作品一覧　『 らくらくエントリーの部 』</h2>
    <?php } else { ?>
        <h2>登録済み作品一覧　『 力作じまんの部 』</h2>
    <?php } ?>

    <input id="Button1" type="button" value="作品登録 →">
    <input id="Button2" type="button" value="ユーザーID →">
    　　
    <select name="selBumon" onchange="Shiborikomi()">
        <option value="">-- 部門で絞り込み --
            <?php if ($KUBUN == "RA") { ?>
        <option value='B01' <?= $selB01 ?>>写真
        <option value='B02' <?= $selB02 ?>>イラスト
        <option value='B03' <?= $selB03 ?>>川柳
        <option value='B04' <?= $selB04 ?>>俳句
        <option value='B05' <?= $selB05 ?>>短歌
        <option value='B06' <?= $selB06 ?>>Video
        <option value='B07' <?= $selB06 ?>>Audio
            <?php } else { ?>
        <option value='P01' <?= $selP01 ?>>絵画
        <option value='P02' <?= $selP02 ?>>書道
        <option value='P03' <?= $selP03 ?>>写真
        <option value='P04' <?= $selP04 ?>>手芸・工芸
        <option value='C01' <?= $selC01 ?>>絵画（子供の部）
        <option value='C02' <?= $selC02 ?>>書道（子供の部）
            <?php } ?>
    </select>

    　
    <select name="selSibu" onchange="Shiborikomi()">
        <option value="">-- 支部で絞り込み --
            <?php
            foreach ($envShibu as $val) {
                if ($selSibu == $val) {
                    echo "<option value=\"$val\" selected>$val";
                } else {
                    echo "<option value=\"$val\">$val";
                }
            }
            ?>
    </select>

    　
    <input type=text name="inName" placeholder="絞り込む名前（部分一致）" value="<?= $inName ?>">
    <input type=button value="←名前で絞り込み" onclick="Shiborikomi()">
    <!-- ============================================================= -->


    <hr/>
    <table border="2">
        <tr>
            <?php if ($KUBUN == "RA") { ?>
                <th></th>
                <th>部門</th>
                <th>作品</th>
                <th class="cmt_sel">作品コメント</th>
                <th>支部名</th>
                <th>名前</th>
            <?php } else { ?>
                <th></th>
                <th>部門</th>
                <th>作品</th>
                <th>作品タイトル</th>
                <th class="cmt_sel">作品コメント</th>
                <th>支部名</th>
                <th>名前</th>
                <th>作品サイズ</th>
                <th>返送先</th>
            <?php } ?>
        </tr>
        <?php

        $link = mysqli_connect($envDbServer, $envDbUser, $envDbUserPass);
        if (!$link) {
//		die('接続失敗です。'.mysql_error());
            $err_msg = '接続失敗です。' . mysqli_connect_error();
            $err_cnt = $err_cnt + 1;
        }

        //	print('<p>接続に成功しました。</p>');

        $db_selected = mysqli_select_db($link, $envDbName);
        if (!$db_selected) {
            //	die('データベース選択失敗です。'.mysql_error());
            $err_msg = 'データベース選択失敗です。' . mysqli_connect_error();
            $err_cnt = $err_cnt + 1;
        }

        //	print('<p>'.$envDbName.'データベースを選択しました。</p>');

        // MySQLに対する処理

        mysqli_set_charset('utf8', $link);

        $sql = "select *,"
            . "(case E_BM_CODE when  'B01' then '写真'"
            . " when 'B02' then 'イラスト'"
            . " when 'B03' then '川柳'"
            . " when 'B04' then '俳句'"
            . " when 'B05' then '短歌'"
            . " when 'B06' then 'Video'"
            . " when 'B07' then 'Audio'"
            . " when 'P01' then '絵画'"
            . " when 'P02' then '書道'"
            . " when 'P03' then '写真'"
            . " when 'P04' then '手芸・工芸'"
            . " when 'C01' then '絵画<br>（子供の部）'"
            . " when 'C02' then '書道<br>（子供の部）'"
            . " else '' end ) as BUMON"
            . " from t_entryinfo"
            . " where E_KBN_CODE='$KUBUN'"
            . " and E_INV_FLG=0";

        if ($selBumon != "") {            //* 部門で絞り込み
            $sql = $sql . " and E_BM_CODE='$selBumon'";
        }
        if ($selSibu != "") {            //* 支部で絞り込み
            $sql = $sql . " and E_DIV_NAME='$selSibu'";
        }
        if ($inName != "") {                //* 名前で絞り込み
            $sql = $sql . " and E_USR_NAME like '%" . mysqli_real_escape_string($link, $inName) . "%'";
        }

        $sql = $sql . " ORDER BY E_ROWID desc; ";
        $video_extention = array("mp4", "avi", "3gp", "mov", "mpeg");
        $audio_extention = array("mp3", "ogg", "flac");

        //		echo $sql . "<br />";

        $result = mysqli_query($link, $sql);
        if (!$result) {
            //	die('SELECTクエリーが失敗しました。'.mysql_error());
            $err_msg = 'SELECTクエリーが失敗しました。' . mysqli_connect_error();
            $err_cnt = $err_cnt + 1;
        }

        while ($row = mysqli_fetch_assoc($result)) {
            $r_no = $row['E_ROWID'];
            $r_no = "00000" . $r_no;
            $r_no = mb_substr($r_no, -5, 5, "UTF-8");
            $KUBUN = $row['E_KBN_CODE'];
            $BUMON = $row['E_BM_CODE'];
            ?>
            <tr>
                <td><input class="Button2" id="<?= $r_no ?>" type="button" value="修正"/></td>
                <td style="white-space: nowrap;"><?= $row['BUMON'] ?></td>
                <td>
                    <?php
                    if (RTrim($row['E_FILE_NAME']) != "") {
                        $path1 = $envSakuhinFol . $KUBUN . "_" . $BUMON . "/" . $row['E_FILE_NAME'];
                        $path2 = $envSakuhinFol . $KUBUN . "_" . $BUMON . "/thumbnails/min-" . $row['E_FILE_NAME'];
                        $type = strtolower(pathinfo($row['E_FILE_NAME'], PATHINFO_EXTENSION));
                        ?>

                        <?php
                        if (in_array($type, $video_extention, true)) {
                            ?>
                            <legend>ビデオファイル</legend>
                            <a href="<?= $path1 ?>" target="_blank" title="<?= $r_no ?>">
                                <img src="https://image.flaticon.com/icons/svg/1073/1073777.svg" height="90" width="100%" alt="">
                            </a>
                            <?php
                        } elseif (in_array($type, $audio_extention, true)) {
                            ?>
                            <legend>音楽</legend>
                            <a href="<?= $path1 ?>" target="_blank" title="<?= $r_no ?>">
                                <img src="https://image.flaticon.com/icons/svg/37/37420.svg" height="90" width="100%" alt="">
                            </a>
                            <?php
                        } else {
                            ?>
                            <img id="imgTEMP" src="<?= $path2 ?>" width="150" height="112" alt="" border=0></a>
                        <?php } ?>
                        <br/>
                        <br/>
                        <?php
                    }

                    if (RTrim($row['E_TANKA_INFO']) != "") {
                        ?>
                        <legend>川柳・俳句・短歌作品</legend>
                        <textarea name="TextArea1" cols="50" rows="5" disabled><?= $row['E_TANKA_INFO'] ?></textarea>
                        <br>
                        <?php
                    }
                    ?>
                </td>
                <?php if ($KUBUN == "RA") { ?>
                    <td class="cmt_sel"><?= nl2br(htmlspecialchars($row['E_COMMENT'])) ?></td>
                    <td><?= htmlspecialchars($row['E_DIV_NAME']) ?></td>
                    <td><?= htmlspecialchars($row['E_USR_NAME']) ?></td>
                <?php } else { ?>
                    <td><?= htmlspecialchars($row['E_TITLE']) ?></td>
                    <td class="cmt_sel"><?= nl2br(htmlspecialchars($row['E_COMMENT'])) ?></td>
                    <td><?= htmlspecialchars($row['E_DIV_NAME']) ?></td>
                    <td><?= htmlspecialchars($row['E_USR_NAME']) ?></td>
                    <td>
                        縦：　<?= htmlspecialchars($row['E_SIZE_L']) ?>　cm<br/>
                        横：　<?= htmlspecialchars($row['E_SIZE_B']) ?>　cm<br/>
                        幅：　<?= htmlspecialchars($row['E_SIZE_W']) ?>　cm<br/>
                    </td>
                    <td>
                        郵便番号：　<?= htmlspecialchars($row['E_R_ZIPCODE']) ?><br/>
                        　住所　：　<?= htmlspecialchars($row['E_R_Addr']) ?><br/>
                        　名前　：　<?= htmlspecialchars($row['E_R_NAME']) ?><br/>
                    </td>
                <?php } ?>
            </tr>
            <?php
        }


        $close_flag = mysqli_close($link);

        if ($close_flag) {
            //	 print('<p>切断に成功しました。</p>');
        }


        ?>
    </table>
    <input type="hidden" name="kubun" value="<?= $KUBUN ?>"/>
    <input type="hidden" name="rowid" value=""/>
    <input type="hidden" name="mnt_flg" value=""/>
</form>
<script src="./js/jquery-2.2.0.min.js"></script>
<script type="text/javascript" src="./lightbox281/js/lightbox.js"></script>

<script type="text/javascript">
    $(function () {

        $("#Button1").bind("click", function () {
            document.form1.mnt_flg.value = "0";
            document.form1.action = "./entry1.php";
            document.form1.target = "_self";
            document.form1.submit();
        });

        $(".Button2").bind("click", function () {
            document.form1.rowid.value = this.id;
            document.form1.mnt_flg.value = "8";
            document.form1.action = "./entry1.php";
            document.form1.target = "_self";
            document.form1.submit();
        });

    });

    function Shiborikomi() {
        document.form1.action = "";
        document.form1.target = "_self";
        document.form1.submit();
    }
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
