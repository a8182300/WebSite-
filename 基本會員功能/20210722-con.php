<?php
	$data = file_get_contents("php://input","r");
	if($data != ""){
		$dataArray = array();
		$dataArray = json_decode($data,true);
		if(isset($dataArray["username"]) && $dataArray["username"] !=""){
			$username = $dataArray["username"];

			require_once("20270705-dbtools.php");
			$link = create_conn();
			$sql = "SELECT Username FROM member WHERE Username = '$username'";
			$result = exe_sql($link,"id16952171_webtest",$sql);

				if(mysqli_num_rows($result) == 1){
					 echo '{"state": false, "message": "帳號已存在，不可以使用"}';
				}else{
					echo '{"state": true, "message": "帳號不存在，可以使用"}';
				}
				mysqli_close($link);

		}else{
			echo '{"state": false, "message": "不允許未定義的欄位或無參數"}';
		}
	}else{
		echo '{"state": false, "message": "欄位不得空白"}';
	}
?>