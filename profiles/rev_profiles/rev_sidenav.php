<ul id="slide-out" class="sidenav sidenav-fixed" style="background-color:#7B68EE;">
<li><div class="user-view">
      <div class="background">
        <img src="http://localhost/stud_feed_sys/office.jpg" style="width:100%;">
        </div>
      <a href="http://localhost/stud_feed_sys/profiles/rev_profiles/rev_profile.php"><img class="circle responsive-img" src="<?php echo $user['profile_image']; ?>" alt="<?php echo $user['name']; ?>" style="width:40%;height:40%;"></a>
      <span class="black-text name" style="font-size:large;"><b><?php echo $user['name']; ?></b></span>
      <span class="white-text email" style="font-size:large"><b><?php echo $user['email']; ?></b></span>
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
                    <option value="HSS">HSS</option>
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