<?php
	$data = file_get_contents("php://input","r");
	if($data != ""){
		$dataArray = array();
		$dataArray = json_decode($data,true);
		if(isset($dataArray["UID"]) && $dataArray["UID"] !=""){
			$uid = $dataArray["UID"];

			require_once("20270705-dbtools.php");
			$link = create_conn();
			$sql = "SELECT  ID , Username, Email, Bday, UID  FROM member WHERE UID = '$uid'";
			$result = exe_sql($link,"id16952171_webtest",$sql);

				if(mysqli_num_rows($result) == 1){
					$memberData = array();
					while($row = mysqli_fetch_assoc($result)){
						$memberData[]=$row;
					} 
					 echo '{"state": true,"data" :'.json_encode($memberData).' ,"message": "已登入"}';  
					
				}else{
					echo '{"state": false, "message": "未登入"}';
				}
				mysqli_close($link);

		}else{
			echo '{"state": false, "message": "不允許未定義的欄位或無參數"}';
		}
	}else{
		echo '{"state": false, "message": "欄位不得空白"}';
	}
?>