<?php
session_start();
require '/opt/lampp/htdocs/stud_feed_sys/db_connect.php';

if(!isset($_SESSION['google_id'])){
    echo 'not active';
    header('location:http://localhost/stud_feed_sys/index.php');
}
$id = $_SESSION['google_id'];

$get_user = $conn->query("SELECT * FROM `reviewers` WHERE `google_id`='$id'");

if(mysqli_num_rows($get_user) > 0){
    $user = $get_user->fetch_assoc();
    if($user['dept'] == 'none')
    {
      header('location:http://localhost/stud_feed_sys/profiles/rev_profiles/rev_first_time.php');
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
    <link rel = "stylesheet"
         href = "http://localhost/stud_feed_sys/css/materialize.min.css">
      
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
    <li id="li1"></li>
    <li id="li2"></li>
    <li id="li3"></li>
    <li id="li4"></li>
    <li id="li5"></li>
    <li id="li6"></li>
    <li><a class="modal-trigger" href="#modal1" style="font-size:large;"><i class="material-icons">update</i>Update Profile</a></li>
    <li><a href="http://localhost/stud_feed_sys/logout.php" style="font-size:large;"><i class="material-icons">eject</i><b>Logout</b></a></li>
    </ul>
    <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
     <!-- Modal Trigger -->
 

<!-- Modal Structure -->
<div id="modal1" class="modal modal-fixed-footer">
  <div class="modal-content">
  <form id="r_upd" method="post" action="rev_update.php">
      <div class="row">
      <div class="input-field col s4">
       <select name="pos_del[]" id="pos_del" multiple>
       <option value="" disabled>Delete positions</option>
       </select>
       <label>Positions to delete</label>
      </div>
      <div class="input-field col s4">
      <select name="pos_add[]" id="pos_add" multiple>
      <option value="" disabled>Add positions</option>
      <option value="HOD">HOD</option>
      <option value="Faculty">Faculty</option>
      <option value="Mess In-Charge">Mess In-Charge</option>
      <option value="Library In-Charge">Library In-Charge</option>
        </select>
        <label>Positions to add</label>
      </div>
      <div class="input-field col s4">
      <select name="dept" id="dept" disabled>
                    <option value="" disabled selected>Choose your Department</option>
                    <option value="CSE">CSE</option>
                    <option value="ECE">ECE</option>
                    <option value="EEE">EEE</option>
                    <option value="CE">CE</option>
                    <option value="ME">ME</option>
                    <option value="Mathematics">Mathematics</option>
                    <option value="Physics">Physics</option>
                    <option value="Chemistry">Chemistry</option>
                    <option value="Chemistry">HSS</option>
                </select>
      <label>Department</label>
      </div>
      </div>
      <div class="row">
      <div class="col s6">
                <button class="btn waves-effect waves-light" type="submit" name="action" style="background:#4169E1">UPDATE
                  <i class="material-icons right">send</i>
                </button>
    </div>
    </div>
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
            <img src="" alt="" class="circle responsive-img" id="p_img" >
            </div>
            <div class="row">
            <h2 id="name"></h2>
            <h4 id="email" style="color:#191970;"></h4>
            </div>
            </div>
        </div>
    </div>
    <ul class="collapsible">
    <li>
      <div class="collapsible-header"><i class="material-icons">perm_identity</i><b>Additional Profile Info</b></div>
      <div class="collapsible-body" style="background:white;"><span><div class="row">
            <div class="col s6">
            <b id="1"></b>
            </div>
            <div class="col s6">
            <b id="2"></b>
            </div>
            </div></span></div>
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
    <script src = "http://localhost/stud_feed_sys/js/materialize.min.js"> </script> 
    <script src = "http://localhost/stud_feed_sys/js/rev_js.js"></script>
        

</body>
</html>