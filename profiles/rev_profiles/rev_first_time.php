<?php 
  session_start();
  require '/opt/lampp/htdocs/stud_feed_sys/db_connect.php';
   if(!isset($_SESSION['google_id']))
        header('location:http://localhost/stud_feed_sys/index.php');
        $id = $_SESSION['google_id'];

        $get_user = $conn->query("SELECT * FROM `reviewers` WHERE `google_id`='$id'");
        
        if(mysqli_num_rows($get_user) > 0){
            $user = $get_user->fetch_assoc();
        }
        else{
            header('location:http://localhost/stud_feed_sys/logout.php');
            exit;
        }
?>
    <!DOCTYPE html>
    <html>
    <head>
    <meta name = "viewport" content = "width = device-width, initial-scale = 1">      
      <link rel = "stylesheet"
         href = "https://fonts.googleapis.com/icon?family=Material+Icons">
         <link rel = "stylesheet"
         href = "http://localhost/stud_feed_sys/css/materialize.min.css">
      

         <style>
          * {
            box-sizing: border-box;
          }

          body {
            font-family: Arial;
            padding: 10px;
            background: #F5FFFA;
          }

          /* Header/Blog Title */
          .header {
            padding: 30px;
            text-align: center;
            background: #191970;
            color:white;
          }
          *, *:before, *:after {
            box-sizing: border-box;
        }
        ul.dropdown-content.select-dropdown li:not(.disabled) span {color:#4169E1; }
          </style>
    </head>

    <body>
      <div class="container">
        <div class="header">
        <h1>Student Feedback System</h1>
        </div>
        <div class="card-panel">
        <div style="text-align:center;">
        <div class="chip" style="background: #e8eaf6;border:2px solid #1a237e;color:#1a237e;font-size:20px;">
        Signed in as: <?php echo $user['email'];?>
        <i class="close material-icons">close</i>
      </div>
      </div>
              <form method="post" action="form_post2.php">
                <h4>Fill in the details to continue setting up your profile</h4>
                <div class="row">
                <div class="input-field col s4">
                <select multiple name="pos[]" id="pos" class="validate" required="" aria-required="true">
                    <option value="" disabled>Choose your position</option>
                    <option value="HOD">HOD</option>
                    <option value="Faculty">Faculty</option>
                    <option value="Mess In-Charge">Mess In-Charge</option>
                    <option value="Library In-Charge">Library In-Charge</option>
                </select>
                <label>Position</label>
                </div>
                <div class="input-field col s4">
                <select name="dept" id="dept" class="validate" required="" disabled>
                    <option value="" disabled selected>Choose your Department</option>
                    <option value="CSE">CSE</option>
                    <option value="ECE">ECE</option>
                    <option value="EEE">EEE</option>
                    <option value="CE">CE</option>
                    <option value="ME">ME</option>
                    <option value="Mathematics">Mathematics</option>
                    <option value="Physics">Physics</option>
                    <option value="Chemistry">Chemistry</option>
                    <option value="HSS">HSS</option>
                </select>
                <label>Department for HOD/Faculty only</label>
                </div>
               </div>
                <div class="row">
                <div class="col s6">
                <button class="btn waves-effect waves-light" type="submit" name="action" style="background:#4169E1;">SUBMIT
                  <i class="material-icons right">send</i>
                </button>
                </div>
                </div>
                </form>
                </div>
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
      <!--JavaScript at end of body for optimized loading-->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
         <script src = "http://localhost/stud_feed_sys/js/materialize.min.js">
      </script> 
      <script>
      $(document).ready(function(){
            // initialize
  $('select').formSelect();
$('chips').chips();
// setup listener for custom event to re-initialize on change
 $('#dept').on('contentChanged', function() {
  $(this).formSelect();
});
// update function for demo purposes
$("#pos").change(function () {
    var val = $(this).val();
    if(val.indexOf('HOD')!=-1 || val.indexOf('Faculty')!=-1)
    {
      $('#dept').removeAttr('disabled');
      $("#dept").trigger('contentChanged');
    }
    else{
      $('#dept').attr('disabled','');
      $("#dept").trigger('contentChanged');
    }
    });
    $("select[required]").css({
      display: "inline",
      height: 0,
      padding: 0,
      width: 0
    });
});
     </script>
    </body>
  </html>
