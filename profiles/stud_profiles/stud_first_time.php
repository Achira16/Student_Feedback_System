    <?php session_start();
    require '/opt/lampp/htdocs/stud_feed_sys/db_connect.php';
     if(!isset($_SESSION['google_id']))
          header('location:http://localhost/stud_feed_sys/index.php');
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
    <!DOCTYPE html>
    <html>
    <head>
    <meta name = "viewport" content = "width = device-width, initial-scale = 1">      
      <link rel = "stylesheet"
         href = "https://fonts.googleapis.com/icon?family=Material+Icons">
         <link rel = "stylesheet" href = "http://localhost/stud_feed_sys/css/materialize.min.css">
      

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
        <div class="chip" style="background: #e8eaf6;border:2px solid #1a237e;color:blue;font-size:20px;">
        Signed in as: <?php echo $user['email'];?>
        <i class="close material-icons">close</i>
      </div>
      </div>
              <form method="post" action="form_post.php">
                <h4>Fill in the details to continue setting up your profile</h4>
                <div class="row">
                <div class="input-field col s4">
                <select name="degree" id="deg" class="validate" required="" aria-required="true">
                    <option value="" disabled selected>Choose your degree</option>
                    <option value="B.Tech">B.Tech</option>
                    <option value="M.Tech">M.Tech</option>
                    <option value="MSc">MSc</option>
                </select>
                <label>Degree</label>
                </div>
                <div class="input-field col s4">
                <select name="sem" id="sem" class="validate" required="" aria-required="true">
                  <option value="" disabled selected>Choose semester</option>
                </select>
                <label>Semester</label>
                </div>
                 <div class="input-field col s4">
                <select name="branch" id="branch" class="validate" required="" aria-required="true">
                  <option value="" disabled selected>Choose your branch</option>
                </select>
                <label>Branch</label>
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
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
      <script src = "http://localhost/stud_feed_sys/js/materialize.min.js"></script>
      <script>
      $(document).ready(function(){
            // initialize
  $('select').formSelect();
  $('chips').chips();
// setup listener for custom event to re-initialize on change
$('#branch').on('contentChanged', function() {
  $(this).formSelect();
});
$('#sem').on('contentChanged', function() {
  $(this).formSelect();
});
// update function for demo purposes
$("#sem").change(function () {
        var val = $(this).val();
        var deg = $('#deg').val();
        console.log(val);
        if ((val == "1"||val=="2") && deg=="B.Tech") {
          $("#branch").empty();
          $("#branch").append("<option value='' disabled selected>Choose your section</option>");
          var newValue = ["A","B","C"];
          var $newOpt = $("<option>").attr("value",newValue[0]).text(newValue[0])
         $("#branch").append($newOpt);
         $newOpt = $("<option>").attr("value",newValue[1]).text(newValue[1])
         $("#branch").append($newOpt);
         $newOpt = $("<option>").attr("value",newValue[2]).text(newValue[2])
         $("#branch").append($newOpt);
          $("#branch").trigger('contentChanged');
        }
        else if(deg=='B.Tech'||deg=='M.Tech'){
          $('#branch').empty();
          $("#branch").append("<option value='' disabled selected>Choose your branch</option>");
          var newValue = ["CSE","ECE","EEE","CE","ME"]
          var $newOpt = $("<option>").attr("value",newValue[0]).text(newValue[0])
          $("#branch").append($newOpt);
          var $newOpt = $("<option>").attr("value",newValue[1]).text(newValue[1])
          $("#branch").append($newOpt);
          var $newOpt = $("<option>").attr("value",newValue[2]).text(newValue[2])
          $("#branch").append($newOpt);
          var $newOpt = $("<option>").attr("value",newValue[3]).text(newValue[3])
          $("#branch").append($newOpt);
          var $newOpt = $("<option>").attr("value",newValue[4]).text(newValue[4])
          $("#branch").append($newOpt);
          $("#branch").trigger('contentChanged');
        }
        else{
          $('#branch').empty();
          $("#branch").append("<option value='' disabled selected>Choose your branch</option>");
          var newValue = "Chemistry";
          var $newOpt = $("<option>").attr("value",newValue).text(newValue);
          $('#branch').append($newOpt);
          $("#branch").trigger('contentChanged');
        }
    });
  $("#deg").change(function () {
      var val = $(this).val();
      console.log(val);
      if (val == "B.Tech") {
            $("#sem").empty();
            $("#sem").append("<option value='' disabled selected>Choose your semester</option>");
            var newValue = ["1","2","3","4","5","6","7","8"];
            var $newOpt = $("<option>").attr("value",newValue[0]).text(newValue[0])
          $("#sem").append($newOpt);
          $newOpt = $("<option>").attr("value",newValue[1]).text(newValue[1])
          $("#sem").append($newOpt);
          $newOpt = $("<option>").attr("value",newValue[2]).text(newValue[2])
          $("#sem").append($newOpt);
          $newOpt = $("<option>").attr("value",newValue[3]).text(newValue[3])
          $("#sem").append($newOpt);
          $newOpt = $("<option>").attr("value",newValue[4]).text(newValue[4])
          $("#sem").append($newOpt);
          $newOpt = $("<option>").attr("value",newValue[4]).text(newValue[5])
          $("#sem").append($newOpt);
          $newOpt = $("<option>").attr("value",newValue[4]).text(newValue[6])
          $("#sem").append($newOpt);
          $newOpt = $("<option>").attr("value",newValue[4]).text(newValue[7])
          $("#sem").append($newOpt);
      // fire custom event anytime you've updated select
            $("#sem").trigger('contentChanged');
          }
          else if(val == "MSc"||val == "M.Tech"){
            $('#sem').empty();
            $("#sem").append("<option value='' disabled selected>Choose your semester</option>");
            var newValue = ["1","2","3","4"];
            var $newOpt = $("<option>").attr("value",newValue[0]).text(newValue[0])
            $("#sem").append($newOpt);
            var $newOpt = $("<option>").attr("value",newValue[1]).text(newValue[1])
            $("#sem").append($newOpt);
            var $newOpt = $("<option>").attr("value",newValue[2]).text(newValue[2])
            $("#sem").append($newOpt);
            var $newOpt = $("<option>").attr("value",newValue[3]).text(newValue[3])
            $("#sem").append($newOpt);
            $("#sem").trigger('contentChanged');
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
