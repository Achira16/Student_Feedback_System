<?php
     session_start();
     require '/opt/lampp/htdocs/stud_feed_sys/db_connect.php';
     $id = $_SESSION['google_id'];
     if(isset($_POST['dept']))
        $dept = $_POST['dept'];
     else   
        $dept = "";
     if(isset($_POST['pos_add']))
        $pos_add = $_POST['pos_add'];
     else
        $pos_add = array();
     if(isset($_POST['pos_del']))
        $pos_del = $_POST['pos_del'];
     else
        $pos_del = array();
     $res = $conn->query("SELECT `position` FROM `reviewers` WHERE `google_id`='$id'");
     $cur_pos = $res->fetch_assoc();
     $cur_pos = explode(",",$cur_pos["position"]);
      foreach($cur_pos as $val)
      {
         $flag = 0;
         foreach($pos_del as $val_to_del)
         {
            if($val == $val_to_del){
               $flag = 1;
               break;
            }
         }
         if(!$flag){
            array_push($pos_add,$val);
         }
      }
     $position = implode(",",$pos_add);
     if($dept!="" && $position!=""){
        $result = $conn->query("UPDATE `reviewers` SET `position`='$position',`dept`='$dept' WHERE `google_id`='$id'");
         if($result)
            echo "successful";
         else
            echo $conn->error;
     }
     elseif($dept!=""){
        $conn->query("UPDATE `reviewers` SET `dept`='$dept' WHERE `google_id`='$id'");
     }
     elseif($position!=""){
        $conn->query("UPDATE `reviewers` SET `position`='$position' WHERE `google_id`='$id'");
     }
     $result = $conn->query("SELECT * FROM `reviewers` WHERE `google_id`='$id'");
     $arr = $result->fetch_assoc();
     echo json_encode($arr);
?>