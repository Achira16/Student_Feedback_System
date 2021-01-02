
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
    $sub_code = $_POST['sub'];
    $res = $conn->query("SELECT `instructor` FROM `subject_teacher_info` WHERE `subject_code`='$sub_code'");
    $output = [];
    while($row = $res->fetch_assoc())
    {
        array_push($output,$row['instructor']);
    }
    echo json_encode($output);
?>