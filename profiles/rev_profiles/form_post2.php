<?php
    session_start();
    require '/opt/lampp/htdocs/stud_feed_sys/db_connect.php';
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $pos = $_POST['pos'];
        $positions = implode(",",$pos);
        if(isset($_POST['dept']))
            $dept = $_POST['dept'];
        $id = $_SESSION['google_id'];
        echo array_search('Faculty',$pos);
        if(in_array('HOD',$pos)||in_array('Faculty',$pos)){
            $sql = "UPDATE `reviewers` SET `dept`='$dept',`position`='$positions' WHERE `google_id`='$id'";
            $update = $conn->query($sql);
            if($update)
                header('location:rev_profile.php');
            else
                echo $conn->error;
        }
      
        $sql = "UPDATE `reviewers` SET `position`='$positions' WHERE `google_id`='$id'";
        $update = $conn->query($sql);
        if($update)
            header('location:rev_profile.php');
        else
            echo $conn->error;
        $conn->close();
    }  
?>