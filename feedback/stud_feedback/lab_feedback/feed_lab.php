
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
    if(isset($_POST['submit'])):
      $sub = $_POST['sub'];
      $sql = $conn->query("SELECT * FROM `feedback_submissions` WHERE `google_id`='$id' AND `code` = '$sub'");
      if(mysqli_num_rows($sql)<=0)
        include('lab_feedback.php');
      else
        include('/opt/lampp/htdocs/stud_feed_sys/feedback/stud_feedback/submitted.php');
?>
<?php else:
    $branch = $user['branch'];
    $sem = $user['sem'];
    $res = $conn->query("SELECT `subject_code`,`subject_name` FROM `subject_teacher_info` WHERE `branches_taught` LIKE '%$branch%' AND `sem`='$sem' AND `deg`='".$user['degree']."' AND `type`='Lab'");
    include('common.php');
?>

<?php endif;?>


 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src = "http://localhost/stud_feed_sys/js/materialize.min.js"></script>
    <script src = "http://localhost/stud_feed_sys/js/stud_js.js"></script>
    <script> 
  $(document).ready(function(){
    $('#sub').change(function(){
                var val = $(this).val();
                $.ajax({
                    type:"POST",
                    url:"inst.php",
                    data:$('#abc').serialize(),
                    datatype:"JSON",
                    success:function(data){
                        var x = JSON.parse(data);
                        $('#inst_name').val(x);
                    }
                })
            });
        $('#feed_form').submit(function(e){
          $(':disabled').each(function(e) {
        $(this).removeAttr('disabled');
        });
            $.ajax({
            type:"POST",
            url:"lab_feed_insert.php",
            data:$('#feed_form').serialize(),
            success:function(data){
               
                 alert("Feedback submitted successfully!!");
                 var url = 'http://localhost/stud_feed_sys/feedback/stud_feedback/lab_feedback/feed_lab.php';
                 $(location).prop('href', url);
               
            }
            });   
            e.preventDefault();
        });
  });    
</script>
<body>
</html>