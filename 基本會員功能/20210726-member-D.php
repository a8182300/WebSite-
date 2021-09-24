<?php
	$data = file_get_contents("php://input","r");
	if($data != ""){
		$dataArray = array();
		$dataArray = json_decode($data,true);
		if(isset($dataArray["ID"]) && $dataArray["ID"] !=""){
			$ID = $dataArray["ID"];

			require_once("20270705-dbtools.php");
			$link = create_conn();
			$sql = "DELETE FROM member WHERE ID = '$ID'";
			
			if(exe_sql($link,"id16952171_webtest",$sql) && mysqli_affected_rows($link) == 1){
			// mysqli_affected_rows 確認是否有被執行
			// 可以計算有幾筆被影響到
				echo '{"state": false, "message": "刪除成功!"}';
			}else{
				echo '{"state": true, "message": "刪除失敗!"}';
			};

			mysqli_close($link);

		}else{
			echo '{"state": false, "message": "不允許未定義的欄位或無參數"}';
		}
	}else{
		echo '{"state": false, "message": "欄位不得空白"}';
	}
?>