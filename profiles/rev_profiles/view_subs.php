<?php 
$dept = substr($user['dept'],0,2);
$sql = $conn->query("SELECT * FROM `subject_teacher_info` WHERE `subject_code` LIKE '$dept%'");
if(mysqli_num_rows($sql) == 0):
    echo "<b><br><br>No subjects to show!!!</b>";
else:
?>
<table class="striped highlight" id="myTable">
  <thead>
   <tr>
     <th>Subject Code</th>
     <th>Subject Name</th>
     <th>Type</th>
     <th>Instructor Name</th>
     <th>Branches/Sections taught</th>
     <th>Sem</th>
     <th>Degree</th>
   </tr>
  </thead>
  <tbody>
     <?php
     $i = 1;
     while ($row = $sql->fetch_assoc())
     {
      ?>
     <tr>
        <td><div id="<?php echo strval($i)."a";?>"><span><?php echo $row['subject_code'];?></span><a class="waves-effect waves-teal btn-flat" onclick="toggleEditor('<?php echo strval($i).'a';?>','<?php echo strval($i).'aedit';?>')"><i class="tiny material-icons">edit</i></a></div>
        <div id="<?php echo strval($i)."aedit";?>" style="display:none;">
          <div class="row">
            <div class="input-field col s6">
              <input id="<?php echo strval($i)."a1";?>" name="subject_code" size="5" type="text" value="<?php echo $row['subject_code'];?>" class="validate">
            </div>
             <div class="input-field col s6">
               <a class="btn-floating waves-effect waves-light green" onclick="doEdit('<?php echo strval($i).'a1';?>','<?php echo strval($i).'aedit';?>','<?php echo strval($i).'a';?>')"><i class="tiny material-icons">done</i></a>
             </div>
           </div>
           <p style="color:red;display:none;">Subject Code cannot be empty</p>
        </div>
        </td>
        <td><div id="<?php echo strval($i)."b";?>"><span><?php echo $row['subject_name'];?></span><a class="waves-effect waves-teal btn-flat" onclick="toggleEditor('<?php echo strval($i).'b';?>','<?php echo strval($i).'bedit';?>')"><i class="tiny material-icons">edit</i></a></div>
        <div id="<?php echo strval($i)."bedit";?>" style="display:none;">
           <div class="row">
             <div class="input-field col s6">
                <input id="<?php echo strval($i)."b1";?>" name="subject_name" size="5" type="text" value="<?php echo $row['subject_name'];?>" class="validate">
             </div>
             <div class="input-field col s6">
               <a class="btn-floating waves-effect waves-light green" onclick="doEdit('<?php echo strval($i).'b1';?>','<?php echo strval($i).'bedit';?>','<?php echo strval($i).'b';?>')"><i class="tiny material-icons">done</i></a>
             </div>
           </div>
           <p style="color:red;display:none;">Subject Name cannot be empty</p>
        </div>
        </td>
        <td><div id="<?php echo strval($i)."c";?>"><span><?php echo $row['type'];?></span><a class="waves-effect waves-teal btn-flat" onclick="toggleEditor('<?php echo strval($i).'c';?>','<?php echo strval($i).'cedit';?>')"><i class="tiny material-icons">edit</i></a></div>
        <div id="<?php echo strval($i)."cedit";?>" style="display:none;">
           <div class="row">
             <div class="input-field col s6">
                <select id="<?php echo strval($i)."c1";?>" name="type">
                <option value="" disabled selected>Select Type</option>
                <option value="Theory">Theory</option>
                <option value="Lab">Laboratory</option>
                </select>
             </div>
             <div class="input-field col s6">
               <a class="btn-floating waves-effect waves-light green" onclick="doEdit('<?php echo strval($i).'c1';?>','<?php echo strval($i).'cedit';?>','<?php echo strval($i).'c';?>')"><i class="tiny material-icons">done</i></a>
             </div>
           </div>
           <p style="color:red;display:none;">Please select an item</p>
        </div>
        </td>
        <td><div id="<?php echo strval($i)."d";?>"><span><?php echo $row['instructor'];?></span><a class="waves-effect waves-teal btn-flat" onclick="toggleEditor('<?php echo strval($i).'d';?>','<?php echo strval($i).'dedit';?>')"><i class="tiny material-icons">edit</i></a></div>
        <div id="<?php echo strval($i)."dedit";?>" style="display:none;">
           <div class="row">
             <div class="input-field col s6">
                <input id="<?php echo strval($i)."d1";?>" name="instructor" size="5" type="text" value="<?php echo $row['instructor'];?>" class="validate">
             </div>
             <div class="input-field col s6">
               <a class="btn-floating waves-effect waves-light green" onclick="doEdit('<?php echo strval($i).'d1';?>','<?php echo strval($i).'dedit';?>','<?php echo strval($i).'d';?>')"><i class="tiny material-icons">done</i></a>
             </div>
           </div>
           <p style="color:red;display:none;">Name cannot be empty</p>
        </div>
        </td>
        <td><div id="<?php echo strval($i)."e";?>"><span><?php echo $row['branches_taught'];?></span><a class="waves-effect waves-teal btn-flat" onclick="toggleEditor('<?php echo strval($i).'e';?>','<?php echo strval($i).'eedit';?>')"><i class="tiny material-icons">edit</i></a></div>
        <div id="<?php echo strval($i)."eedit";?>" style="display:none;">
           <div class="row">
             <div class="input-field col s6">
             <select multiple id="<?php echo strval($i)."e1";?>" name="branches_taught">
                <option value="" disabled>Branches/Sections taught</option>
                <option value="CSE">CSE</option>
                <option value="ECE">ECE</option>
                <option value="EEE">EEE</option>
                <option value="CE">CE</option>
                <option value="ME">ME</option>
                <option value="A">Section A</option>
                <option value="B">Section B</option>
                <option value="C">Section C</option>
                <option value="Chemistry">Chemistry</option>
                </select>
             </div>
             <div class="input-field col s6">
               <a class="btn-floating waves-effect waves-light green" onclick="doEdit('<?php echo strval($i).'e1';?>','<?php echo strval($i).'eedit';?>','<?php echo strval($i).'e';?>')"><i class="tiny material-icons">done</i></a>
             </div>
           </div>
           <p style="color:red;display:none;">Please select atleast one item</p>
        </div>
        </td>
        <td><div id="<?php echo strval($i)."f";?>"><span><?php echo $row['sem'];?></span><a class="waves-effect waves-teal btn-flat" onclick="toggleEditor('<?php echo strval($i).'f';?>','<?php echo strval($i).'fedit';?>')"><i class="tiny material-icons">edit</i></a></div>
        <div id="<?php echo strval($i)."fedit";?>" style="display:none;">
           <div class="row">
             <div class="input-field col s6">
                <input id="<?php echo strval($i)."f1";?>" name="sem" size="5" type="number" min="1" max="8" step="1" value="<?php echo $row['sem'];?>" class="validate">
             </div>
             <div class="input-field col s6">
               <a class="btn-floating waves-effect waves-light green" onclick="doEdit('<?php echo strval($i).'f1';?>','<?php echo strval($i).'fedit';?>','<?php echo strval($i).'f';?>')"><i class="tiny material-icons">done</i></a>
             </div>
          </div>
          <p style="color:red;display:none;">Sem cannot be empty</p>
        </div>
        </td>
        <td><div id="<?php echo strval($i)."g";?>"><span><?php echo $row['deg'];?></span><a class="waves-effect waves-teal btn-flat" onclick="toggleEditor('<?php echo strval($i).'g';?>','<?php echo strval($i).'gedit';?>')"><i class="tiny material-icons">edit</i></a></div>
        <div id="<?php echo strval($i)."gedit";?>" style="display:none;">
           <div class="row">
             <div class="input-field col s6">
             <select id="<?php echo strval($i)."g1";?>" name="deg">
                <option value="B.Tech" selected>B.Tech</option>
                <option value="M.Tech">M.Tech</option>
                <option value="MSc">MSc</option>
                </select>
             </div>
             <div class="input-field col s6">
               <a class="btn-floating waves-effect waves-light green" onclick="doEdit('<?php echo strval($i).'g1';?>','<?php echo strval($i).'gedit';?>','<?php echo strval($i).'g';?>')"><i class="tiny material-icons">done</i></a>
             </div>
          </div>
          <p style="color:red;display:none;">Please select an item</p>
        </div>
        </td>
        <td><a id="<?php echo strval($i)."del";?>" class="waves-effect waves-light btn" style="background-color:#DC143C;" onclick="delete_func('<?php echo $row['subject_code'];?>','<?php echo $row['instructor'];?>','<?php echo strval($i).'del';?>')">DELETE</a></td>
    </tr>
     <?php
      $i++;
     }
     ?>
  </tbody>
</table>
<?php endif;?>