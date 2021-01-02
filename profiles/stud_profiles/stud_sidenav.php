<ul id="slide-out" class="sidenav sidenav-fixed" style="background-color:#7B68EE;">
    <li><div class="user-view">
      <div class="background">
        <img src="http://localhost/stud_feed_sys/office.jpg" style="width:100%;">
      </div>
      <a href="http://localhost/stud_feed_sys/profiles/stud_profiles/stud_profile.php"><img class="circle responsive-img" src="<?php echo $user['profile_image']; ?>" alt="<?php echo $user['name']; ?>" style="width:40%;height:40%;"></a>
      <span class="black-text name" style="font-size:large;"><b><?php echo $user['name']; ?></b></span>
      <span class="white-text email" style="font-size:large"><b><?php echo $user['email']; ?></b></span>
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
      <option value="" disabled selected>Update branch</option>
      <?php if($user['degree']=='M.Tech'||$user['degree']=='B.Tech'):
      ?>
      <option value="CSE">CSE</option>
      <option value="ECE">ECE</option>
      <option value="EEE">EEE</option>
      <option value="CE">CE</option>
      <option value="ME">ME</option>
      <option value="A">Section A</option>
      <option value="B">Section B</option>
      <option value="C">Section C</option>
      <?php else:
      ?>
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
                <button class="btn waves-effect waves-light" type="submit" name="action" style="background:#4169E1;">UPDATE
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