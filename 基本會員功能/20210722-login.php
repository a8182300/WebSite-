<?php
	$data = file_get_contents("php://input","r");
	if($data != ""){
		$dataArray = array();
		$dataArray = json_decode($data,true);
		if(isset($dataArray["username"]) && $dataArray["username"] !="" &&
		   isset($dataArray["password"]) && $dataArray["password"] !=""){
			$username = $dataArray["username"];
			$password = substr(md5($dataArray["password"]),6,12);  
			//原本資料庫資料有加密 這裡也要加密才找的到

			require_once("20270705-dbtools.php");
			$link = create_conn();
			$sql = "SELECT * FROM member WHERE Username = '$username' AND Password = '$password'";
			$result = exe_sql($link,"id16952171_webtest",$sql);

				if(mysqli_num_rows($result) == 1){

					//產生一個獨一無二的UID,寫入資料庫並回傳欄位

					$today = date("m.d.y.h:i:s");
					$uid = substr(hash('sha256',$today),13,10);

					$sql = "UPDATE member SET UID = '$uid' WHERE Username = '$username'";
					//更新UID進此帳號裡
					if(exe_sql($link,"id16952171_webtest",$sql)){
						 echo '{"state": true, "message": "登入成功!!" , "UID":"'.$uid.'"}';
					}else{
						 echo '{"state": false, "message": "登入失敗!!"}';
						 //如果UID寫入失敗，不可以給線索
					}
				}else{
					echo '{"state": false, "message": "登入失敗!!"}';
				}
				mysqli_close($link);

		}else{
			echo '{"state": false, "message": "不允許未定義的欄位或無參數"}';
		}
	}else{
		echo '{"state": false, "message": "欄位不得空白"}';
	}
?>