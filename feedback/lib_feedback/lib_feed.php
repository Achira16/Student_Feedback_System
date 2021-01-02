<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel = "stylesheet" href = "https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel = "stylesheet" href = "http://localhost/stud_feed_sys/css/materialize.min.css">
    <style type="text/css">
        body{
          background:#F5FFFA;
        }
        .wrapper {
            padding-left:18%;
            padding-right:2%;
        }
        ul.dropdown-content.select-dropdown li:not(.disabled) span {color:#4169E1; }
    </style>
</head>
<?php
session_start();
require '/opt/lampp/htdocs/stud_feed_sys/db_connect.php';

if(!isset($_SESSION['google_id'])){
    echo 'not active';
    header('location:http://localhost/stud_feed_sys/index.php');
}

$id = $_SESSION['google_id'];

$get_user = $conn->query("SELECT * FROM `students` WHERE `google_id`='$id'");

if(mysqli_num_rows($get_user) > 0){
    $user = $get_user->fetch_assoc();
}
else{
    header('location:http://localhost/stud_feed_sys/logout.php');
    exit;
}
?>
<body>
<?php include('/opt/lampp/htdocs/stud_feed_sys/profiles/stud_profiles/stud_sidenav.php');?>
<?php  
    include('lib_feed_form.php');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src = "http://localhost/stud_feed_sys/js/materialize.min.js"></script>
    <script src = "http://localhost/stud_feed_sys/js/stud_js.js"></script>
    <script>
   $(document).ready(function(){
        $('#feed_form').submit(function(e){
            $.ajax({
            type:"POST",
            url:"feed_insert.php",
            data:$('#feed_form').serialize(),
            success:function(data){
               
                 alert("Feedback submitted successfully!!");
                 var url = 'http://localhost/stud_feed_sys/feedback/lib_feedback/lib_feed.php';
                 $(location).prop('href', url);
               
            }
            });   
            e.preventDefault();
        });
  });
   
</script>
<body>
</html>