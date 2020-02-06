<?php
header("Content-type: text/html; charset=utf-8");
header("Cache-Control: no-cache");
header("Pragma: no-cache");

/***********************************************************************
/*	<?????>	xml_Chk_UserInp.php
/*	
/*		?  ?:??:??????????
/*
/*		?  ?:??
/*
/*		Code By		2016/02/01	System Nicol Co.,Ltd	??
/*
/*		Copyright (c) 2016 System Nicol Co.,Ltd All rights reserved.
/*---------------------------------------------------------------------*
/*	????:VB?Option Explicit???????,??????????
/*	-------------------------------------------------------------------*
/*	??????:	$str_msg		:?????
/*					$str_stt		:?????
/*					$str_uid		:???????ID
/*					$str_unm		:????????
/*					$str_mod		:???????
/*					$str_flg		:?????????{login,logout}
/*					//--
/*					$sql_str		:SQL?
/*					$OBJ_Cnn		:Connection ??????
/*					$OBJ_Rec		:Recordset  ??????
/*					$OBJ_Row		:Array      ??????
/*					//--
/*					$NowDate		:??
/*					$NowTime		:??
/**********************************************************************/
	//???????·??
	session_start();
	//???????????

	require_once "../com/require_set_env.php";
	//+----------------------
	//+ ?????
	//+----------------------
	$str_msg = "";
	$str_csv = "";
	$str_stt = "";
	$sql_str = "";
	//--
	$sql_str = "";
	$OBJ_Cnn = null;
	$OBJ_Rec = null;
	$OBJ_Row = null;
	//--
	$tmp_len = 0;
	$exi_flg = -1;
	//--
	$NowDate = date("Y-m-d");
	$NowTime = date("H:i:s");
	//+----------------------
	//+ ????????
	//+----------------------
																		//* DB??

	Sub_DB_Cnn($OBJ_Cnn, $str_msg, $str_stt);
	//+----------------------
	if ($fileName = $_FILES["file"]["tmp_name"]) {
	    if ($_FILES["file"]["size"] > 0) {
			if ($_FILES["file"]["size"] > 104857600) {
				$str_msg = "File size exceeds 100MB";
				$log_file = createLog('File size limit exceeds','ERROR');
			} else {
				// parse CSV to array
				$csv_rows = array();
				$file = fopen($fileName, 'r');
				$key_row = array();
				$error = 0;
				$is_first = true;
				$str_error = "UserID: ";
				while (($result = fgetcsv($file, 10000, ",")) !== false)
				{
					if ($is_first) {
						if (checkHeaderFormat($result)){
							$key_row = $result;
						} else {
							$str_msg = "Wrong header format!" ;
							$error = -1;
							break;
						}
						$is_first = false;
					} else {
						$temp_arr = array();
						foreach($key_row as $key => $value) {
							$temp_arr[$value] = $result[$key]; 
						}
						
						// check each import row
						if (checkImport($temp_arr)) {
							$csv_rows[] = $temp_arr;
						} else {
							$error++;
							$str_error .= $temp_arr['UserID'].", ";
						}
					}
				}
				
				fclose($file);
				
				// drop header row to import
				if (str_msg == ""){
						$csv_rows = array_shift($csv_rows);
				}
				
				mysqli_begin_transaction($OBJ_Cnn);
				mysqli_autocommit($OBJ_Cnn, false);
				
				foreach($csv_rows as $row) {
						try {
							// create SQL string
							$sql_str = "INSERT INTO `" . DF_SQL_ConnDBNm . "`.`m_user` VALUES ("
								."'". mysqli_real_escape_string($OBJ_Cnn,$row['UserID']) ."',"
								."'". mysqli_real_escape_string($OBJ_Cnn,$row['UserName']) ."',"	
								."'". md5(mysqli_real_escape_string($OBJ_Cnn,$row['Password'])) ."',"
								."'". mysqli_real_escape_string($OBJ_Cnn,$row['UnionMember']) ."',"
								."'". mysqli_real_escape_string($OBJ_Cnn,$row['Admin']) ."',"	
								."Now())".						
								" ON DUPLICATE KEY UPDATE ".
								"UserName='".mysqli_real_escape_string($OBJ_Cnn,$row['UserName']).
								"',Password='".md5(mysqli_real_escape_string($OBJ_Cnn,$row['Password'])).
								"',UnionMember='".mysqli_real_escape_string($OBJ_Cnn,$row['UnionMember']).
								"',Admin='".mysqli_real_escape_string($OBJ_Cnn,$row['Admin']).
								"',LastUpdate=Now();";
								
								// query
								mysqli_query($OBJ_Cnn, $sql_str);
								
						}	catch (Exception $e) {
							// if there is an exception
							mysqli_rollback($OBJ_Cnn);
						}				
				}
				
				// update database
				mysqli_commit($OBJ_Cnn);
				
				// check error quantity to create log file and error message string
				switch ($error) {
					case -1:
						$log_file = createLog('Wrong header format','ERROR');
						break;
					case 0:
						$log_file = createLog('Import successful! ('.count($csv_rows).' users)','DEBUG');
						$str_msg = "Import Successful!\nSuccess: ".
							((count($csv_rows)-$error < 0) ? 0 : (count($csv_rows)-$error))." records\nError: ".$error." records\n".$str_msg;
						break;
					default:
						$str_msg = 'SUCCESS: '.((count($csv_rows)-$error < 0) ? 0 : (count($csv_rows)-$error)).' users; ERROR: '.$error.' users';
						$log_file = createLog('SUCCESS: '.((count($csv_rows)-$error < 0) ? 0 : (count($csv_rows)-$error)).
						' users; ERROR: '.$error.' users ('.substr($str_error,0,strlen($str_error)-2).')','ERROR');
				};
				
				// messagge for alert
				if ($log_file != "") {
					$str_msg .= "\nLogged at ".$log_file;
				} else {
					$str_msg .= "Not logged!!!";
				}
			}

				
	    }
	} else {
		$str_msg = "File not found";
	}	
	
	/* Check row validation */
	function checkImport($row) {
		$data_len = array(
			'UserID' => array(6,20),
			'UserName' => array(6,50),
			'Password' => array(6,20),
			'UnionMember' => array(0,1),
			'Admin' => array(0,1),
		);
		
		if (count($row) != count($data_len)) {
			return false;
		}
		
		
		foreach($row as $key => $data) {
			if (strlen($data) < $data_len[$key][0] || strlen($data) > $data_len[$key][1]) {
				return false;
			}
		}
		
		return true;
	}
	
	/* Check header format */
	function checkHeaderFormat ($header_row) {
		$headers = array('UserID','UserName','Password','UnionMember','Admin');
		
		if (count($header_row) != count($headers)) {
			return false;
		}
		
		foreach($header_row as $key => $header){
			if ($headers[$key] != $header) {
				return false;
			}
		}
		
		return true;
	}
	
	/* Log function */
	function createLog($msg = "", $type = "DEBUG") {
			$file = "/var/www/html/public/log/import_users_".date('Ymd', time()).".log";
			$msg = '['.date('Y-m-d h:m:s', time()).']['.$type.'] '.$msg."\r\n";
			$logged = error_log($msg ,3 , $file);
			if ($logged) {
				return $file;
			} else {
				return "";
			}
	}
	
																		//* DB??
	Sub_DB_Cut($OBJ_Cnn, $str_msg, $str_stt);
	//+----------------------
	//+ ????
	//+----------------------
?>
<xml_UserRegData>
	<reData status="<?php echo Func_SetEncDate($str_stt, "", "\n"); ?>" message="<?php echo Func_SetEncDate($str_msg, "", "\n"); ?>" date="<?php echo $NowDate ?>" time="<?php echo $NowTime ?>">
		<csv><?php echo Func_SetEncDate($str_csv, "", "\n"); ?></csv>
	</reData>
	<reHtml></reHtml>
</xml_UserRegData>
