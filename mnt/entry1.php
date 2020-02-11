    <?php
    /*************************************************************************
     * 総合文化展
     *
     *    作品エントリー画面
     *
     *************************************************************************/

    //外部スクリプト読み込み
    require_once "env.php";
    require_once "../const.php";
    //	echo __FILE__ . '<br />';
    //	echo dirname(__FILE__) . '<br />';
    $err_cnt = 0;
    $err_msg = "";
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
    if ($mnt_flg == 8 and $ROWID != "") {

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
            $err_msg = 'データベース選択失敗です。' . mysqli_error($link);
            $err_cnt = $err_cnt + 1;
        }

        //	print('<p>'.$envDbName.'データベースを選択しました。</p>');

        // MySQLに対する処理

        mysqli_set_charset($link, 'utf8');

        $sql = "select * from t_entryinfo where E_ROWID='$ROWID' ORDER BY E_ROWID desc; ";

        $result = mysqli_query($link, $sql);

        if (!$result) {
            //	die('SELECTクエリーが失敗しました。'.mysqli_error());
            $err_msg = 'SELECTクエリーが失敗しました。' . mysqli_error($link);
            $err_cnt = $err_cnt + 1;
        }

        while ($row = mysqli_fetch_assoc($result)) {
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
            $COMMENT = $_POST['COMMENT'];
        } else {
            $COMMENT = "";
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
        // 作
    }


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
            <?php if ($KUBUN == "RA") { ?>
                <h2><b>「総合文化展２０２０」申込書</b></h2>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <input id="Button3" type="button" value="登録済み一覧→">
                    <input id="reg_btn" type="button" value="ユーザーID管理→">
                </div>
            <?php } else { ?>
                <h2>ユーザーID管理</h2>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <input id="Button2" type="button" value="作品登録→">
                    <input id="Button3" type="button" value="登録済み一覧→">
                </div>
            <?php } ?>
        </section>

        <form method="post" enctype="multipart/form-data" name="form1">


            <!-- ============================================================= -->
            <hr style="width: 80%; float: left" />
            <table class="table" border="2" style="width:80%;">
                <!-- ============================================================= -->
                <?php if ($KUBUN == "RA") { ?>
                    <tr>
                        <th>申込日:</th>
                        <td>
                            <select id="year" onchange="dateChange()" name="INS_DATE[year]">
                                <option value="2020">2020</option>
                                <option value="2019">2019</option>
                            </select>
                            年
                            <select id="month" onchange="dateChange()" name="INS_DATE[month]">
                                <?php for ($month = 1; $month <= 12; $month++) {
                                    echo '<option value="' . $month . '">' . $month . '</option>';
                                } ?>
                            </select>
                            月
                            <select id="day" name="INS_DATE[day]">
                                <?php for ($day = 1; $day <= 31; $day++) {
                                    echo '<option value="' . $day . '">' . $day . '</option>';
                                } ?>
                            </select>
                            日
                        </td>
                    </tr>

                    <tr>
                        <th>組合：</th>
                        <td>
                            <select name="DIV_NAME" id="DIV_NAME" value="<?= $DIV_NAME ?>">
                                <option value="">組合名を選択ください。</option>
                                <?php foreach (E_DIV_NAME as $code => $value) {
                                    echo '<option value="' . $code . '">' . $value . '</option>';
                                } ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <th>(A) 申込者（作者）氏名:</th>
                        <td>
                            <input type="text" name="USR_NAME" value="<?= $USR_NAME ?>">
                        </td>
                    </tr>

                    <tr>
                        <th>申込者（作者）氏名（ふりがな）:</th>
                        <td>
                            <input type="text" name="USR_NAME_F" value="<?= $USR_NAME_F ?>">
                        </td>
                    </tr>

                    <tr>
                        <th>組合員氏名:</th>
                        <td>
                            <input type="text" name="USR_MEMBER_NAME" value="<?= $USR_MEMBER_NAME ?>">
                        </td>
                    </tr>

                    <tr>
                        <th>参加区分　※応募時：</th>
                        <td>
                            <select name="PAR_KBN">
                                <option value="">申込者（作者）の参加区分を選択ください。</option>
                                <?php foreach (E_PAR_KBN as $code => $value) {
                                    echo '<option value="' . $code . '">' . $value . '</option>';
                                } ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <th>年齢区分　※応募時：</th>
                        <td>
                            <select name="AGE_KBN">
                                <option value="">申込者（作者）の年齢区分を選択ください。</option>
                                <?php foreach (E_AGE_KBN as $code => $value) {
                                    echo '<option value="' . $code . '">' . $value . '</option>';
                                } ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <th>(B) 部門：</th>
                        <td>
                            <select id="BM_CODE" onchange="bumonChange()" name="BM_CODE">
                                <option value="">応募部門を選択ください。</option>
                                <?php foreach (E_BM_CODE as $code => $value) {
                                    echo '<option value="' . $code . '">' . $value . '</option>';
                                } ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <th>(C) カテゴリー：</th>
                        <td>
                            <select id="KBN_CODE" name="KBN_CODE">
                                <?php foreach (E_KBN_CODE as $code => $value) {
                                    echo '<option value="' . $code . '">' . $value . '</option>';
                                } ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <th>作品：</th>
                        <td>
                            <?php if ($mnt_flg == 8 and $ROWID != "" and RTrim($file_nm) != "") { ?>
                                <a href="<?= $path ?>" rel="lightbox" title="my caption">
                                    <img id="imgTEMP" src="<?= $path ?>" width="150" height="112" alt="" border=0></a>
                                <br />
                                <legend>
                                    画像またはビデオファイルを選択します<br>（GIF、JPG、PNG、MP4、WEBMのみ）
                                </legend>
                                <input name="FILE_PATH" type="file" size=55 />
                            <?php } else { ?>
                                <legend>
                                    画像またはビデオファイルを選択します<br>（GIF、JPG、PNG、MP4、WEBMのみ）
                                </legend>
                                <input name="FILE_PATH" type="file" size=55 />
                            <?php } ?>
                        </td>
                    </tr>

                    <tr>
                        <th>作品タイトル：</th>
                        <td>
                            <input type="text" name="TITLE" value="<?= $TITLE ?>">
                        </td>
                    </tr>

                    <tr>
                        <th>作品コメント(100文字まで)：</th>
                        <td>
                            <textarea rows="5" name="COMMENT"><?= $COMMENT ?></textarea><br>
                        </td>
                    </tr>

                    <tr>
                        <th colspan="2">額、表装を含めた作品サイズ　
                            <br> ※（B)がエキスパート部門、キッズ部門（書道）の場合のみ以下を入力
                        </th>
                    </tr>

                    <tr>
                        <th>縦（㎝）:</th>
                        <td>
                            <input type="text" name="SIZE_L" value="<?= $SIZE_L ?>">
                        </td>
                    </tr>

                    <tr>
                        <th>横（㎝）:</th>
                        <td>
                            <input type="text" name="SIZE_B" value="<?= $SIZE_B ?>">
                        </td>
                    </tr>

                    <tr>
                        <th>高さ（㎝）<br>※（C）が手芸・工芸の場合のみ入力:</th>
                        <td>
                            <input type="text" name="SIZE_W" value="<?= $SIZE_W ?>">
                        </td>
                    </tr>

                    <tr>
                        <th>重量（㎏）<br>※（C）が手芸・工芸の場合のみ入力:</th>
                        <td>
                            <input type="text" name="WEIGHT" value="<?= $WEIGHT ?>">
                        </td>
                    </tr>


                    <input name="Text13" type="hidden" value="" />
                    <input name="Text14" type="hidden" value="" />
                    <input name="Text15" type="hidden" value="" />
                    <input name="Text16" type="hidden" value="" />
                    <input name="Text17" type="hidden" value="" />
                    <input name="Text18" type="hidden" value="" />
                    <input name="Text19" type="hidden" value="" />
                    <input name="Text20" type="hidden" value="" />
                    <!-- ============================================================= -->
                <?php } else { ?>
                    <tr>
                        <th>
                            CSV ファイル
                        </th>
                        <td>
                            <input type="file" accept=".csv">
                        </td>
                    </tr>
                <?php } ?>

                <!-- ============================================================= -->
            </table>
            <div id="footer">
                <?php if ($mnt_flg == 8 and $ROWID != "") { ?>
                    <input id="Button11" type="button" value="内容を変更する" /><br>
                    <input id="Button12" type="button" value="削除する" /><br>
                    <input id="Button13" type="button" value="キャンセル" /><br>
                <?php } elseif ($KUBUN == "REG") { ?>
                    <input id="BTN_REGISTER" type="button" value="登録" />
                <?php } else { ?>
                    <input id="Button1" type="button" value="内容を確認する" />
                <?php } ?>
                <input type="hidden" name="kubun" value="<?= $KUBUN ?>" />
                <input type="hidden" name="mnt_flg" value="<?= $mnt_flg ?>" />
                <input type="hidden" name="rowid" value="<?= $ROWID ?>" />
                <input type="hidden" name="svBumon" value="<?= $BUMON ?>" />
                <input type="hidden" name="svFile" value="<?= $path ?>" />
                <!-- ============================================================= -->
            </div>

        </form>
        <iframe name="MNTframe" width="0" height="0" frameborder="0" sandbox="allow-forms allow-scripts allow-top-navigation">
            お使いのブラウザはインライン フレームをサポートしていないか、またはインライン フレームを表示しないように設定されています。
        </iframe>

        <script src="./js/jquery-2.2.0.min.js"></script>
        <script type="text/javascript" src="./lightbox281/js/lightbox.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                bumonChange()
                dateChange()
            })

            const category = {
                'EE01': ['FF01', 'FF02', 'FF03', 'FF04'],
                'EE02': ['FF05', 'FF06', 'FF07', 'FF08'],
                'EE03': ['FF09', 'FF10'],
            };

            function bumonChange() {
                let bumons = ['EE01', 'EE02', 'EE03'];
                let bumon = $('#BM_CODE').val();
                $('#KBN_CODE option').hide();
                if (bumons.indexOf(bumon) != -1) {
                    category[bumon].forEach(function(cat) {
                        $("#KBN_CODE option[value='" + cat + "']").show();
                    })
                    $('#KBN_CODE').val(category[bumon][0]);
                } else {
                    $('#KBN_CODE').val("");
                }

            }

            function dateChange() {
                let year = $('#year').val()
                let month = $('#month').val()

                let even = ['4', '6', '9', '11']

                if (month == '2') {
                    $('#day option[value=31]').hide()
                    $('#day option[value=30]').hide()
                    if (year == '2019') {
                        $('#day option[value=29]').hide()
                    } else {
                        $('#day option[value=29]').show()
                    }
                } else if (even.indexOf(month) != -1) {
                    $('#day option[value=29]').show()
                    $('#day option[value=31]').hide()
                    $('#day option[value=30]').show()
                } else {
                    $('#day option[value=29]').show()
                    $('#day option[value=31]').show()
                    $('#day option[value=30]').show()
                }
            }
        </script>

        <script type="text/javascript">
            $(function() {

                $("#Button1").bind("click", function() {
                    document.form1.action = "./chk1.php";
                    document.form1.target = "_self";
                    document.form1.submit();
                });

                $("#Button2").bind("click", function() {
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

                $("#Button3").bind("click", function() {
                    document.form1.mnt_flg.value = "0";
                    document.form1.action = "./lst1.php";
                    document.form1.target = "_self";
                    document.form1.submit();
                });

                $("#Button4").bind("click", function() {
                    document.form1.mnt_flg.value = "0";
                    document.form1.action = "./video.php";
                    document.form1.target = "_self";
                    document.form1.submit();
                });

                $("#Button11").bind("click", function() {
                    if (confirm("変更します。\nよろしいですか？")) {
                        document.form1.action = "./upt1.php";
                        document.form1.target = "MNTframe";
                        //document.form1.target = "_self";
                        document.form1.submit();
                    }
                });

                $("#Button12").bind("click", function() {
                    if (confirm("削除します。\nよろしいですか？")) {
                        document.form1.action = "./del1.php";
                        document.form1.target = "MNTframe";
                        //document.form1.target = "_self";
                        document.form1.submit();
                    }
                });

                $("#reg_btn").bind("click", function() {
                    document.form1.mnt_flg.value = "0";
                    document.form1.kubun.value = "REG";
                    document.form1.action = "./entry1.php";
                    document.form1.target = "_self";
                    document.form1.submit();
                });

                $("#Button13").bind("click", function() {
                    document.form1.mnt_flg.value = "0";
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