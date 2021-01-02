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
    if($user['branch'] == 'none')
    {
      header('location:http://localhost/stud_feed_sys/profiles/stud_profiles/stud_first_time.php');
    }
}
else{
    header('location:http://localhost/stud_feed_sys/logout.php');
    exit;
}
?>

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
<body>
<ul id="slide-out" class="sidenav sidenav-fixed" style="background-color:#7B68EE;">
    <li><div class="user-view">
      <div class="background">
        <img src="http://localhost/stud_feed_sys/office.jpg" style="width:100%;">
      </div>
      <br><br><br><br>
    </div></li>
      <li><a href="http://localhost/stud_feed_sys/feedback/stud_feedback/sub_feedback/feed_sub.php" style="color:white;font-size:large;"><b>Subject-Teacher Feedback</b></a></li>
      <li><a href="http://localhost/stud_feed_sys/feedback/stud_feedback/lab_feedback/feed_lab.php" style="color:white;font-size:large;"><b>Lab Feedback</b></a></li>
      <li><a href="http://localhost/stud_feed_sys/feedback/lib_feedback/lib_feed.php" style="color:white;font-size:large;"><b>Library Feedback</b></a></li>
      <li><a href="http://localhost/stud_feed_sys/feedback/mess_feedback/mess_feed.php" style="color:white;font-size:large;"><b>Mess Feedback</b></a></li>
      <li><a class="modal-trigger" href="#modal1" style="font-size:large;"><i class="material-icons">update</i>Update Profile</a></li>
      <li><a href="http://localhost/stud_feed_sys/logout.php" style="font-size:large;"><i class="material-icons">eject</i><b>Logout</b></a></li>
    </ul>
    <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
  <div id="modal1" class="modal modal-fixed-footer">
  <div class="modal-content">
  <form id="r_upd" method="post" action="rev_update.php">
  <form method="post" action="stud_update.php">
      <div class="row">
      <div class="input-field col s4">
      <select name="branch">
      <option value="" disabled selected>Update branch/section</option>
      <?php if($user['degree']=='B.Tech' || $user['degree']=='M.Tech'):
      ?>
      <option value="CSE">CSE</option>
      <option value="ECE">ECE</option>
      <option value="EEE">EEE</option>
      <option value="CE">CE</option>
      <option value="ME">ME</option>
      <option value="A">Section A</option>
      <option value="B">Section B</option>
      <option value="C">Section C</option>
      <?php else: ?>
        <option value="Chemistry">Chemistry</option>
      <?php endif;?>
        </select>
        <label>Branch</label>
      </div>
      <div class="input-field col s4">
      <select name="sem" class="validate" required="" aria-required="true">
      <option value="" disabled selected>Update semester</option>
      <?php if($user['degree']=='B.Tech'):
      ?>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
      <?php else:
      ?>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <?php endif;?>
      </select>
      <label>Semester</label>
      </div>
      </div>
      <div class="row">
                <div class="col s6">
                <button class="btn waves-effect waves-light" type="submit" name="submit" style="background:#4169E1;">UPDATE
                  <i class="material-icons right">send</i>
                </button>
                </div>
                </div>
      </form>
</form>
  </div>
  <div class="modal-footer">
        <button class="modal-close waves-effect waves-green btn-flat" style="background:#AFEEEE;">Close</button>
  </div>
</div>
    <div class="wrapper">
    <div class="container">
    <div class="card medium">
        <div class = "card-content">
            <div style="text-align:center;">
            <div class="row">
            <img src="<?php echo $user['profile_image'];?>" alt="<?php echo $user['name'];?>" class="circle responsive-img">
            </div>
            <div class="row">
            <h2>Welcome, <?php echo $user['name'];?></h2>
            <h4 style="color:#191970;"><i class="material-icons">email</i> <?php echo $user['email'];?></h4>
            </div>
            </div>
        </div>
    </div>
    <ul class="collapsible">
    <li>
      <div class="collapsible-header"><i class="material-icons">perm_identity</i><b>Additional Profile Info</b></div>
      <div class="collapsible-body" style="background-color:white;"><span><div class="row">
            <div class="col s4">
            <b>Degree: <?php echo $user['degree'];?></b>
            </div>
            <div class="col s4">
            <b id="1">Branch: <?php echo $user['branch'];?></b>
            </div>
            <div class="col s4">
            <b id="2">Semester: <?php echo $user['sem'];?></b>
            </div>
            </div>
      </span></div>
    </li>
    <li>
      <div class="collapsible-header"><br></div>
    </li>

    </ul>
    <footer class="page-footer" style="background:#191970;">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text"></h5>
                <br><br><br>
              </div>
            </div>
          </div>
          <div class="footer-copyright" style="text-align:center;background:#4169E1;">
            <div class="container">
            Copyright © 2020 Achira Raychaudhuri
            </div>
          </div>
        </footer>
    </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src = "http://localhost/stud_feed_sys/js/materialize.min.js"></script>
    <script>
     $(document).ready(function(){
    $('.sidenav').sidenav();
  });
  $(document).ready(function(){
    $('.collapsible').collapsible();
  });
  $(document).ready(function(){
            // initialize
  $('.modal').modal();
  $('select').formSelect();
  $("select[required]").css({
      display: "inline",
      height: 0,
      padding: 0,
      width: 0
    });
    $("#r_upd").submit(function(e){
        $.ajax({
            type:"POST",
            url:"stud_update.php",
            data:$('#r_upd').serialize(),
            success:function(data){
                if(data)
                {
                    var obj = JSON.parse(data);
                    $('#1').html('Branch: '+ obj.branch);
                    $('#2').html('Semester: '+ obj.sem);
                    $( '#r_upd' ).each(function(){
                        this.reset();
                    });
                    alert('Updation successful');
                }
                else
                    alert('unsuccesful');
            }
        })
        e.preventDefault();
    });
  });
 
        
    </script>
</body>
</html>