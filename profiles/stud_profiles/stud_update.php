<?php
     session_start();
     require '/opt/lampp/htdocs/stud_feed_sys/db_connect.php';
     $id = $_SESSION['google_id'];
     if(isset($_POST['branch']))
        $branch = $_POST['branch'];
     else   
        $branch = "";
     $sem = $_POST['sem'];
     if($branch!="" && $sem!=""){
        $conn->query("UPDATE `students` SET `sem`='$sem',`branch`='$branch' WHERE `google_id`='$id'");
     }
     elseif($sem!=""){
        $conn->query("UPDATE `students` SET `sem`='$sem' WHERE `google_id`='$id'");
     }
     $result = $conn->query("SELECT * FROM `students` WHERE `google_id`='$id'");
     $arr = $result->fetch_assoc();
     echo json_encode($arr);
?>