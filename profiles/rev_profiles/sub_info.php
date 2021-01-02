<?php
    session_start();
    require '/opt/lampp/htdocs/stud_feed_sys/db_connect.php';
    $id = $_SESSION['google_id'];
    $get_user = $conn->query("SELECT * FROM `reviewers` WHERE `google_id`='$id'");
    if(mysqli_num_rows($get_user) > 0){
        $user = $get_user->fetch_assoc();
    }
    else{
        header('location:http://localhost/stud_feed_sys/logout.php');
        exit;
    }
    $sub_code = $_POST['sub_code'];
    $sub_name = $_POST['sub_name'];
    $inst_name = $_POST['inst_name'];
    $degree = $_POST['degree'];
    $branches = $_POST['branches'];
    $sem = (int)($_POST['sem']);
    $type = $_POST['type'];
    $branches = implode(",",$branches);
    $sql = "INSERT INTO `subject_teacher_info`(`subject_code`, `subject_name`, `instructor`, `branches_taught`, `sem`, `deg`,`type`) VALUES('$sub_code','$sub_name','$inst_name','$branches','$sem','$degree','$type')";
    $res = $conn->query($sql);
    if (!$res)
        echo $conn->error;
    else
        echo 'Successfully added';
?>
