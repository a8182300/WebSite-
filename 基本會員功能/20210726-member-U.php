<?php
	$data = file_get_contents("php://input","r");
	if($data != ""){
		$dataArray = array();
		$dataArray = json_decode($data,true);
		if(isset($dataArray["ID"]) && $dataArray["ID"] !=""  && //1
			isset($dataArray["email"]) && $dataArray["email"] !="" &&         //3
			isset($dataArray["bday"]) && $dataArray["bday"] !="" &&           //4
			isset($dataArray["language"]) && $dataArray["language"] !="" &&    //5
			isset($dataArray["height"]) && $dataArray["height"] !="" &&         //6
			isset($dataArray["sex"]) && $dataArray["sex"] !="" &&               //7
			isset($dataArray["hobby"]) && $dataArray["hobby"] !="" &&           //8
			isset($dataArray["blood"]) && $dataArray["blood"] !=""){

			$ID = $dataArray["ID"]; 
			$email = $dataArray["email"];        //3  
			$bday = $dataArray["bday"];          //4
			$language = $dataArray["language"];  //5
			$height = $dataArray["height"];      //6
			$sex = $dataArray["sex"];            //7
			$hobby = $dataArray["hobby"];        //8
			$blood = $dataArray["blood"];        //9

			require_once("20270705-dbtools.php");
			$link = create_conn();
			$sql = "UPDATE member SET Email = '$email',Bday = '$bday',Language = '$language',Height = '$height' , Sex = '$sex', Hobby = '$hobby',Blood = '$blood' WHERE ID = '$ID'";
			
			if(exe_sql($link,"id16952171_webtest",$sql)){
			// mysqli_affected_rows 確認是否有被執行
			// 可以計算有幾筆被影響到
				echo '{"state": false, "message": "更新成功!"}';
			}else{
				echo '{"state": true, "message": "更新失敗!"}';
			};

			mysqli_close($link);

		}else{
			echo '{"state": false, "message": "不允許未定義的欄位或無參數"}';
		}
	}else{
		echo '{"state": false, "message": "欄位不得空白"}';
	}
?>