<?php
	$data = file_get_contents("php://input","r"); 
	//將接收到的json樣式的字串轉陣列，當轉換成陣列

	if($data != ""){  //不是空白
		$dataArray = array();
		$dataArray = json_decode($data,true);
		if(isset($dataArray["username"]) && $dataArray["username"] !="" &&  //1
			isset($dataArray["password"]) && $dataArray["password"] !="" &&  //2
			isset($dataArray["email"]) && $dataArray["email"] !="" &&         //3
			isset($dataArray["bday"]) && $dataArray["bday"] !="" &&           //4
			isset($dataArray["language"]) && $dataArray["language"] !="" &&    //5
			isset($dataArray["height"]) && $dataArray["height"] !="" &&         //6
			isset($dataArray["sex"]) && $dataArray["sex"] !="" &&               //7
			isset($dataArray["hobby"]) && $dataArray["hobby"] !="" &&           //8
			isset($dataArray["blood"]) && $dataArray["blood"] !="" ){            //9

			$username = $dataArray["username"];  //1
			$password = substr(md5($dataArray["password"]),6,12);  //2
			//substr是擷取指令，substr(string,start,length)
			//md5是加密指令，並擷取6到12個字元當成密碼(共7個字元)
			$email = $dataArray["email"];        //3  
			$bday = $dataArray["bday"];          //4
			$language = $dataArray["language"];  //5
			$height = $dataArray["height"];      //6
			$sex = $dataArray["sex"];            //7
			$hobby = $dataArray["hobby"];        //8
			$blood = $dataArray["blood"];        //9

			require_once("20270705-dbtools.php");
			$link = create_conn();
			$sql = "INSERT INTO member(Username,Password,Email,Bday,Language,Height,Sex,Hobby,Blood,UID) VALUES ('$username','$password','$email','$bday','$language','$height','$sex','$hobby','$blood','')"; 
			

			if(exe_sql($link,"id16952171_webtest",$sql)){
				echo '{"state": true, "message" :"會員註冊成功!"}';
			}else{
				echo'{"state": false, "message" :"會員註冊失敗!"}';
			}

			mysqli_close($link);

			// echo $dataArray["username"].
			// 	 $dataArray["password"].
			// 	 $dataArray["email"].
			// 	 $dataArray["bday"].
			// 	 $dataArray["language"].
			// 	 $dataArray["height"].
			// 	 $dataArray["sex"].
			// 	 $dataArray["hobby"].
			// 	 $dataArray["blood"];
		}else{
			echo '{"state": false,"message":"欄位格式錯誤!"}';
		}

	}else{
		echo '{"state": false,"message":"欄位不得空白!"}';
	}



	// var_dump(json_decode($data));  //確認此資料陣列

?>