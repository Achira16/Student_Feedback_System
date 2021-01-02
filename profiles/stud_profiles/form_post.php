<?php
    session_start();
    require '/opt/lampp/htdocs/stud_feed_sys/db_connect.php';
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $deg = $_POST['degree'];
        $branch = $_POST['branch'];
        $sem = $_POST['sem'];
        $id = $_SESSION['google_id'];
        $sql = "UPDATE `students` SET `degree`='$deg',`branch`='$branch',`sem`='$sem' WHERE `google_id`='$id'";
        $update = $conn->query($sql);
        if($update)
            header('location:stud_profile.php');
        else
            echo $conn->error;
        $conn->close();
    }
?>