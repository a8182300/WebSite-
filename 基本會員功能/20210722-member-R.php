<?php

			require_once("20270705-dbtools.php");
			$link = create_conn();
			$sql = "SELECT ID,Username,Email,Bday,Language,Height,Sex,Hobby,Blood,Creat_at FROM member ORDER BY ID DESC";
			//ORDER BY ID DESC
			//DESC 遞減排序 5 4 3 2 1
			//ASC  遞增排序 1 2 3 4 5

			$result = exe_sql($link,"id16952171_webtest",$sql);

			if(mysqli_num_rows($result) > 0){
				$dataArray = array();
				while($row = mysqli_fetch_assoc($result)){
				$dataArray[] = $row;
			}
				echo '{"state": true, "data": '.json_encode($dataArray).'}';
			}else{
				echo '{"state": false, "data": "no data!"}';
			}		
			

			mysqli_close($link);
	

						
?>