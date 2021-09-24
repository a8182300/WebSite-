<?php 
//避免 1.空白字串 2.格式錯誤
    $data = file_get_contents("php://input",'r');
    //從網址取資料

    if($data != ""){
        $dataArray = array();
        $dataArray = json_decode($data,true);
        if(isset($dataArray["username"]) && $dataArray["username"] !="" &&  //1
     isset($dataArray["password"]) && $dataArray["password"] !="" &&  //2
     isset($dataArray["re_password"]) && $dataArray["re_password"] !="" &&         //3
     isset($dataArray["sex"]) && $dataArray["sex"] !="" &&           //4
     isset($dataArray["mydate"]) && $dataArray["mydate"] !="" &&    //5
     isset($dataArray["email"]) && $dataArray["email"] !="" &&         //6
     isset($dataArray["tel"]) && $dataArray["tel"] !="" &&               //7
     isset($dataArray["height"]) && $dataArray["height"] !="" &&           //8
     isset($dataArray["weight"]) && $dataArray["weight"] !="" &&
     isset($dataArray["edu"]) && $dataArray["edu"] !="" && 
        isset($dataArray["transportation"]) && $dataArray["transportation"] !="" && 
           isset($dataArray["blood"]) && $dataArray["blood"] !=""  ){


         $username = $dataArray["username"];
         $password = $dataArray["password"];
         $re_password = $dataArray["re_password"];
         $sex = $dataArray["sex"];
         $mydate = $dataArray["mydate"];
         $email = $dataArray["email"];
         $tel = $dataArray["tel"];
         $height = $dataArray["height"];
         $weight = $dataArray["weight"];
         $edu = $dataArray["edu"];
         $transportation = $dataArray["transportation"];
         $blood = $dataArray["blood"];

         require_once("dbtools.inc.php");
         $link=create_connection(); 
         $sql="INSERT INTO member(M_name,M_password,M_re_password,M_sex,M_mydate,M_email,M_phone,M_height,M_weight,M_edu,M_transportation,M_blood) VALUES ('$username','$password','$re_password','$sex','$mydate','$email','$tel','$height','$weight','$edu','$transportation','$blood')";
         if(execute_sql($link,"id16952173_goku",$sql)){
          echo '{"state": true , "message" : "註冊成功"}';
         }else{
          echo '{"state": false , "message" : "註冊失敗"}';
         }
         mysqli_close($link);
            // echo $dataArray["username"].
            //      $dataArray["password"].
            //      $dataArray["re_password"].
            //      $dataArray["sex"].
            //      $dataArray["mydate"].
            //      $dataArray["email"].
            //      $dataArray["tel"].
            //      $dataArray["height"].
            //      $dataArray["weight"].
            //      $dataArray["edu"].
            //      $dataArray["transportation"].
            //      $dataArray["blood"]; 
        }else{
        echo '{"state": false , "message" : "欄位格式錯誤"}';
        }
    }else{
        echo '{"state": false , "message" : "不允許空白參數"}';
    }
    
?>