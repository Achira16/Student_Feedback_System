<?php
  session_start();
 require 'db_connect.php';
 include('config.php');
?>
<?php
if(isset($_SESSION['google_id']))
{
   $id = $_SESSION['google_id'];
  $result = $conn->query("SELECT `google_id` FROM `students` WHERE `google_id`='$id'");
   if(!$result){
    $result = $conn->query("SELECT `google_id` FROM `reviewers` WHERE `google_id`='$id'");
     header('location:profiles/rev_profiles/rev_profile.php');
   }
    header('location:profiles/stud_profiles/stud_profile.php');
}
if(isset($_GET['code'])):
  $token = $google_client->fetchAccessTokenWithAuthCode($_GET['code']);
  if(!isset($token["error"])){

      $google_client->setAccessToken($token['access_token']);

      // getting profile information
      $google_oauth = new Google_Service_Oauth2($google_client);
      $google_account_info = $google_oauth->userinfo->get();
  
      // Storing data into database
      $id = mysqli_real_escape_string($conn, $google_account_info->id);
      $full_name = mysqli_real_escape_string($conn, trim($google_account_info->name));
      $email = mysqli_real_escape_string($conn, $google_account_info->email);
      $profile_pic = mysqli_real_escape_string($conn, $google_account_info->picture);
/*      if(!strpos($email,'@nitsikkim.ac.in'))
      {
          echo '<script type="text/javascript"> 
          alert("Please enter your institute email ID"); 
          window.location.href = "index.php";
      </script>';
         exit;
      }*/
      $table = '';
      if(($email[0]=='b'||$email[0]=='m'||$email[0]=='ms')&&(is_numeric(substr($email,1,6))||is_numeric($email,2,7))&&($email[6]=='@'||$email[7]=='@'))
      {
          $table = 'students';
      }
      else
        $table = 'reviewers';
      // checking user already exists or not
      $get_user = $conn->query("SELECT `google_id` FROM `$table` WHERE `google_id`='$id'");
        if(mysqli_num_rows($get_user) > 0){

            $_SESSION['google_id'] = $id; 
            if($table=='students')
              header('location:profiles/stud_profiles/stud_profile.php');
            else
              header('location:profiles/rev_profiles/rev_profile.php');
            exit;

        }
        else{

            // if user not exists we will insert the user
            $insert = $conn->query("INSERT INTO `$table`(`google_id`,`name`,`email`,`profile_image`) VALUES('$id','$full_name','$email','$profile_pic')");
            if($insert){
                $_SESSION['google_id'] = $id; 
                if($table=='students')
                  header('location:profiles/stud_profiles/stud_first_time.php');
                  else
                  header('location:profiles/rev_profiles/rev_first_time.php');
                exit;
            }
            else{
                echo "Sign up failed!(Something went wrong).";
            }

        }
        $conn->close();
    }
    else{
        header('Location: index.php');
        exit;
    }
  
else:
?>
<html>
    <head>
    <meta name = "viewport" content = "width = device-width, initial-scale = 1">      
      <link rel = "stylesheet"
         href = "https://fonts.googleapis.com/icon?family=Material+Icons">
      <link rel = "stylesheet" 
         href = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
      
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

        .g-sign-in-button {
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            width: 240px;
            height: 50px;
            background-color: #4285f4;
            color: #fff;
            border-radius: 1px;
            box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.25);
            transition: background-color .218s, border-color .218s, box-shadow .218s;
        }

        .g-sign-in-button:hover {
            cursor: pointer;
            -webkit-box-shadow: 0 0 3px 3px rgba(66, 133, 244, 0.3);
            box-shadow: 0 0 3px 3px rgba(66, 133, 244, 0.3);
        }

        .g-sign-in-button:active {
            background-color: #3367D6;
            transition: background-color 0.2s;
        }

        .g-sign-in-button .content-wrapper {
            height: 100%;
            width: 100%;
            border: 1px solid transparent;
        }

        .g-sign-in-button img {
            width: 18px;
            height: 18px;
        }

        .g-sign-in-button .logo-wrapper {
            padding: 15px;
            background: #fff;
            width: 48px;
            height: 100%;
            border-radius: 1px;
            display: inline-block;
        }

        .g-sign-in-button .text-container {
            font-family: Roboto,arial,sans-serif;
            font-weight: 500;
            letter-spacing: .21px;
            font-size: 16px;
            line-height: 48px;
            vertical-align: top;
            border: none;
            display: inline-block;
            text-align: center;
            width: 180px;
        }
        .tabs .indicator {
            background-color:#191970;
        } 
          </style>
    </head>

    <body>
      <div class="container">
        <div class="header">
        <h1>Student Feedback System</h1>
        </div>
        <div class = "col s12 m12">
            <div class="card medium" >
              <div class="card-tabs" >
                <ul class="tabs tabs-fixed-width">
                  <li class="tab" style="background:#AFEEEE;"><a class="active" href="#test4" style="color:#191970;"><b>Student Login</b></a></li>
                  <li class="tab" style="background:#AFEEEE;"><a href="#test5" style="color:#191970;"><b>Feedback Reviewer Login</b></a></li>
                </ul>
              </div>
              <div class="card-content">
                <div id="test4">
                <a style="display:block" href="<?php echo $google_client->createAuthUrl(); ?>">
                  <div class='g-sign-in-button' >
                    <div class=content-wrapper>
                        <div class='logo-wrapper'>
                            <img src='https://developers.google.com/identity/images/g-logo.png'>
                        </div>
                        <span class='text-container'>
                      <span>Sign in with Google</span>
                       </span>
                    </div>
                 </div>
                </a>
               </div>
                <div id="test5">
                <a style="display:block" href="<?php echo $google_client->createAuthUrl(); ?>">
                  <div class='g-sign-in-button' >
                    <div class=content-wrapper>
                        <div class='logo-wrapper'>
                            <img src='https://developers.google.com/identity/images/g-logo.png'>
                        </div>
                        <span class='text-container'>
                      <span>Sign in with Google</span>
                       </span>
                    </div>
                 </div>
                </a>
                </div>
              </div>
        </div>
        </div> 
        <footer class="page-footer" style = "background:#191970;">
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
      <script type = "text/javascript"
         src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>           
      <script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js">
      </script> 
    </body>
  </html>

      <?php endif;?>