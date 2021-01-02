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
    $inst_name = $_POST['inst_name'];
    if(isset($_POST['subject_code']))
    {
        $edit = $_POST['subject_code'];
        $to_edit = 'subject_code';
    }
    elseif(isset($_POST['subject_name']))
    {
        $edit = $_POST['subject_name'];
        $to_edit = 'subject_name';
    }
    elseif(isset($_POST['type']))
    {
        $edit = $_POST['type'];
        $to_edit = 'type';
    }
    elseif(isset($_POST['instructor']))
    {
        $edit = $_POST['instructor'];
        $to_edit = 'instructor';
    }
    elseif(isset($_POST['branches_taught']))
    {
        $edit = $_POST['branches_taught'];
        $to_edit = 'branches_taught';
        $edit = implode(",",$edit);
    }
    elseif(isset($_POST['sem']))
    {
        $edit = $_POST['sem'];
        $to_edit = 'sem';
    }
    else
    {
        $edit = $_POST['deg'];
        $to_edit = 'deg';
    }
    $sql = $conn->query("UPDATE `subject_teacher_info` SET `$to_edit` = '$edit' WHERE `subject_code` = '$sub_code' AND `instructor` = '$inst_name'");
    if(!$sql)
        echo $conn->error;
    else
        echo $edit;
?>