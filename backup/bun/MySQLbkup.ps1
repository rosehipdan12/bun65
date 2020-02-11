#---------------------------------------------------------------
#* MySQL テーブルバックアップ
#*
#*  Update: 2016/05/20 新規  Y.N
#----------------------------------------------------------------
$mysqldump = "C:\xampp\mysql\bin\mysqldump.exe"
$mysqlUser = "root"
$mysqlPass = "FJ3kjc9tckjecth3"
$mysqlDB   = "bun"
$outPass   = "D:\InetPub\htdocs\bun65\backup"             #* バックアップ作成パス
$Tables    = @( "t_entryinfo", "t_vote" )              #* バックアップ対象テーブル
$日数      = 10                                        #* 削除ファイルの最終更新日（本日より○○日前）

#--------------------------------------
#--> １．テーブルバックアップ
#--------------------------------------
$passOpt = "-p" + $mysqlPass
$日時 = (Get-Date).Tostring("yyyyMMddHHmm")

[console]::OutputEncoding = [text.encoding]::UTF8      #* コンソール出力の文字コード(UTF16LE)をUTF8に設定
foreach( $Table in $Tables ) {
    $出力ファイル = $outPass + "\" + $日時 + "_" + $Table + ".sql"    #* yymmddhhmm_テーブル名.sql
    &"$mysqldump" -u $mysqlUser $passOpt --default-character-set=binary $mysqlDB $Table | Out-File $出力ファイル -Encoding utf8
}


#---------------------------------------
#--> ２．古いバックアップファイルを削除
#---------------------------------------
$削除日付 = (Get-Date).AddDays(-($日数))                #--> (指定日数 * 24時間)前のファイルを削除対象とする

#--> 対象ファイルのオブジェクトを最終更新日付でソートして取得する
$削除対象ファイル = Get-ChildItem -LiteralPath $outPass | Where-Object { (! $_.PSIsContainer ) -and ( $_.LastWriteTime -lt $削除日付 ) } | Sort-Object LastWriteTime
if ( $削除対象ファイル -ne $null ) {
    ForEach ( $ファイル in $削除対象ファイル ) {
        Remove-Item -LiteralPath $ファイル.FullName     # ファイル削除
    }
}

#おしまい