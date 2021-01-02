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
            padding-left:13%;
            padding-right:0%;
        }
        ul.dropdown-content.select-dropdown li:not(.disabled) span {color:#4169E1; }
        .tabs .indicator {
            background-color:black;
        } 

    </style>
</head>
<body>
   <?php include('rev_sidenav.php'); ?>
       
    <div class="wrapper">
    <div class="container">
    <div class="card-panel">
    <span>
    <div class="row">
    <div class="col s12">
      <ul class="tabs">
        <li class="tab col s6" style="background-color:#66CDAA;"><a href="#test1" style="color:white;"><b>ADD SUBJECTS</b></a></li>
        <li class="tab col s6" style="background-color:#DC143C;"><a class="active" href="#test2" style="color:white;"><b>VIEW SUBJECTS</b></a></li>
      </ul>
    </div>
    <div id="test1" class="col s12"><?php include('add_subs.php');?></div>
    <div id="test2" class="col s12"><br>
    <a class="btn-floating btn-large waves-effect waves-light red" href="add_sub_info.php"><i class="material-icons">refresh</i></a>
    <?php include('view_subs.php');?></div>
  </div>
    </span>
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
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src = "http://localhost/stud_feed_sys/js/materialize.min.js"> </script> 
    <script src = "http://localhost/stud_feed_sys/js/rev_js.js"></script>
    <script>
    //var delete_func,sub_code,inst_name,change_to_edit,update;
    $(document).ready(function(){
    $('.tabs').tabs();
    $('#branches').on('contentChanged', function() {
    $(this).formSelect();
    });
   $('#degree').change(function(){
        var val = $(this).val();
        if (val == "B.Tech"||val=="M.Tech") {
          $("#branches").empty();
          $("#branches").append("<option value='' disabled>Branches taught</option>");
          var newValue = ["CSE","ECE","EEE","CE","ME"];
          var $newOpt = $("<option>").attr("value",newValue[0]).text(newValue[0])
         $("#branches").append($newOpt);
         $newOpt = $("<option>").attr("value",newValue[1]).text(newValue[1])
         $("#branches").append($newOpt);
         $newOpt = $("<option>").attr("value",newValue[2]).text(newValue[2])
         $("#branches").append($newOpt);
         $newOpt = $("<option>").attr("value",newValue[3]).text(newValue[3])
         $("#branches").append($newOpt);
         $newOpt = $("<option>").attr("value",newValue[4]).text(newValue[4])
         $("#branches").append($newOpt);
    // fire custom event anytime you've updated select
          $("#branches").trigger('contentChanged');
        }
        else if(val == "MSc"){
          $('#branches').empty();
          $("#branches").append("<option value='' disabled>Branches taught</option>");
          var newValue = "Chemistry";
          var $newOpt = $("<option>").attr("value",newValue).text(newValue)
          $("#branches").append($newOpt);
          $("#branches").trigger('contentChanged');
        }
   });
   $('#subjects').submit(function(e){
        $.ajax({
            type: "POST",
            url: "sub_info.php",
            data:$('#subjects').serialize(),
            success: function(data){
              if(data)
              {
                var x = data;
                if(x == 'Successfully added')
                { 
                    alert(x);
                }
                else
                  alert(x);
              }
                
            }
        });
        e.preventDefault();
   });
    delete_func = function(x,y,i){
      var table = $('#myTable')[0];
      var curr = '#'+i;
      var row = $(curr).parent().parent().parent().children().index($(curr).parent().parent());
       $.ajax({
        type: "POST",
        url:"subs_delete.php",
        data:{sub_code:x,inst_name:y},
        success: function(data){
          if(data)
          {
            $('tr').eq(row+1).remove();
          }
        }
      })
    }
  /* change_to_edit = function(curr_cell){
    curr_cell = '#'+curr_cell;
    var table = $('#myTable')[0];
    var col = $(curr_cell).parent().parent().children().index($(curr_cell).parent());
    var row = $(curr_cell).parent().parent().parent().children().index($(curr_cell).parent().parent());
    var cell = table.rows[row+1].cells[col];
    var cell_value = $(cell).text().slice(0,-4);
    var key1 =  table.rows[row+1].cells[0];
    var key2 = table.rows[row+1].cells[2];
    var key3 = table.rows[row+1].cells[5];
    var degree = $(key3).text().slice(0,-4);
    sub_code = $(key1).text().slice(0,-4);
    inst_name = $(key2).text().slice(0,-4);
    var id = "10a11";
    if(col == 0 || col == 1 || col == 2){
      $(cell).html('<div class="row"><div class="input-field col s6"><input id="curr" name="editing" size="5" type="text" value="'+cell_value+'" class="validate"></div><div class="input-field col s6"><a class="btn-floating waves-effect waves-light green" onclick="update(id)"><i class="tiny material-icons">done</i></a></div></div>');
      $('input').attr('id',id);
      console.log($('input').id);
    }
    else if(col == 3){
        $(cell).html('<form id="edit"><div class="row"><div class="col s6"><select name="editing" multiple><option value="Branches taught" disabled>Branches taught</option><option value="CSE">CSE</option><option value="ECE">ECE</option><option value="EEE">EEE</option><option value="CE">CE</option><option value="ME">ME</option><option value="Chemistry">Chemistry</option><option value="Physics">Physics</option></select></div><div class="col s6"><a class="btn-floating waves-effect waves-light green"><i class="tiny material-icons">done</i></a></div></div></form>');
        $('select').formSelect();
    }
    else if(col == 4){
      $(cell).html('<form id="edit"><div class="row"><div class="input-field col s6"><input name="editing" size="5" type="number" min="1" max="8" step="1" value="'+cell_value+'" class="validate"></div><div class="input-field col s6"><a class="btn-floating waves-effect waves-light green"><i class="tiny material-icons">done</i></a></div></div></form>');
    }
    else if(col == 5){
      $(cell).html('<form id="edit"><div class="row"><div class="col s6"><select name="editing"><option value="Degree" disabled>Degree</option><option value="B.Tech">B.Tech</option><option value="M.Tech">M.Tech</option><option value="MSc">MSc</option></select></div><div class="col s6"><a class="btn-floating waves-effect waves-light green"><i class="tiny material-icons">done</i></a></div></div></form>')
      $('select').formSelect();
    }
  }*/
 /* update = function(id){
      id = '#'+id;
      console.log($(id).val());
     $.ajax({
        type: "POST",
        url:"update_sub_info.php",
        data:$('#edit').serialize(),
        success: function(data){
          if(data)
          {
            var d = JSON.parse(data);
            console.log(d);
          }
        }
      })
      e.preventDefault();
  }*/
  });
  function toggleEditor(id1,id2) {
   var theText = document.getElementById(id1);
   var theEditor = document.getElementById(id2);
   theText.style.display = 'none';
   theEditor.style.display = 'inline';
   var table = $('#myTable')[0];
   //var col = $(curr_cell).parent().parent().children().index($(curr_cell).parent());
}
function doEdit(id1,id2,id3) {
   var theText = document.getElementById(id3);
   var theEditor = document.getElementById(id2);
   var inputField = document.getElementById(id1);
   var upd_data = $(inputField).val();
   var key = $(inputField).attr('name');
   var data = {}
   data[key] = upd_data;
   var table = $('#myTable')[0];
   curr_cell = '#'+id3;
   var row = $(curr_cell).parent().parent().parent().children().index($(curr_cell).parent().parent());
   var key1 = table.rows[row+1].cells[0];
   var key2 = table.rows[row+1].cells[3];
   key1 = $(key1).children()[0];
   key1 = $(key1).children()[0];
   data['sub_code'] = $(key1).text();
   key2 = $(key2).children()[0];
   key2 = $(key2).children()[0];
   data['inst_name'] = $(key2).text();
   console.log(inst_name);
   if(upd_data == "" || upd_data == null)
  {
     $('#'+id2+' p').css({display:'inline'});
  }
  else{
    $('#'+id2+' p').css({display:'none'});
   $.ajax({
     type: "POST",
     url:"update_sub_info.php",
     data:data,
     success: function(data){
       if(data){
         console.log(data);
           $('#'+id3+' span').text(data);
            theText.style.display = 'inline';
            theEditor.style.display = 'none';
       }
     }
   })
  }
   //this is where you would call your AJAX update script
   //e.g., doXMLRequest(data);
   //you probably want to make your DB update BEFORE converting for display
 
   //set text to be value in editor
   //correct line breaks, prevent HTML injection
  /* var subject = theEditor.value;
   subject = subject.replace(new RegExp("<", "g"), '<');
   subject = subject.replace(new RegExp(">", "g"), '>');
   subject = subject.replace(new RegExp("n", "g"), '<br />');
   theText.innerHTML = subject;
 
   //hide editor, show text
   theText.style.display = 'inline';
   editorArea.style.display = 'none';*/
}
     </script>
        

</body>
</html>