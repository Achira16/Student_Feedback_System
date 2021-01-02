<?php
    session_start();
    require '/opt/lampp/htdocs/stud_feed_sys/db_connect.php';
    $sub_code = $_POST['sub_code'];
    $inst_name = $_POST['inst_name'];
    $sql = $conn->query("DELETE FROM `subject_teacher_info` WHERE `subject_code` = '$sub_code' AND `instructor` = '$inst_name'");
    if($sql)
        echo $conn->success;
?>