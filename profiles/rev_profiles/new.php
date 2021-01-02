<?php
session_start();
require '/opt/lampp/htdocs/stud_feed_sys/db_connect.php';
if(isset($_SESSION['google_id']))
    $id = $_SESSION['google_id'];
else
    $id="";
$get_user = $conn->query("SELECT * FROM `reviewers` WHERE `google_id`='$id'");
$result = $get_user->fetch_assoc();
echo json_encode($result);
?>