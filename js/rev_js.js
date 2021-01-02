$(document).ready(function(){
    $('.sidenav').sidenav();
    $('select').formSelect();
    $.ajax({
        type:"POST",
        url:"new.php",
        data:"",
        success:function(data){
          if(data != "null")
          {
              var obj = JSON.parse(data);
              $('#p_img').attr('src',obj.profile_image);
              $('#p_img').attr('alt',obj.name);
              $('#name').html('Welcome, ' + obj.name);
              $('#email').html('<i class="material-icons">email</i> '+ obj.email);
              $('#1').html('Position: '+obj.position);
              $('#2').html('Department: '+obj.dept);
              if(obj.position.indexOf('HOD')!=-1){
                  $('#li1').html('<a id="feed1" href="http://localhost/stud_feed_sys/feedback/review/sub_review/hod_sub_review.php" style="color:white;font-size:large;"><b>Theory Subject Feedbacks</b></a>');
                  $('#li2').html('<a id="feed2" href="http://localhost/stud_feed_sys/feedback/review/lab_review/hod_lab_review.php" style="color:white;font-size:large;"><b>Lab Feedbacks</b></a>');
                  $('#li6').html('<a id="feed6" href="add_sub_info.php" style="color:white;font-size:large;"><b>Add Subjects</b></a>');
              }
              else if(obj.position.indexOf('Faculty')!=-1)
              {
                  $('#li1').html('<a id="feed1" href="http://localhost/stud_feed_sys/feedback/review/sub_review/sub_review.php" style="color:white;font-size:large;"><b>Theory Subject Feedbacks</b></a>');
                  $('#li2').html('<a id="feed2" href="http://localhost/stud_feed_sys/feedback/review/lab_review/lab_review.php" style="color:white;font-size:large;"><b>Lab Feedbacks</b></a>');
              }
              if(obj.position.indexOf('Mess In-Charge')!=-1){
                $('#li3').html('<a id="feed3" href="http://localhost/stud_feed_sys/feedback/review/mess_review/g_mess_rev.php" style="color:white;font-size:large;"><b>Girls Mess Feedbacks</b></a>');
                $('#li4').html('<a id="feed4" href="http://localhost/stud_feed_sys/feedback/review/mess_review/b_mess_rev.php" style="color:white;font-size:large;"><b>Boys Mess Feedbacks</b></a>');
              }
              if(obj.position.indexOf('Library In-Charge')!=-1){
                $('#li5').html('<a id="feed5" href="http://localhost/stud_feed_sys/feedback/review/lib_review/lib_rev.php" style="color:white;font-size:large;"><b>Library Feedbacks</b></a>');
              }
              var pos = obj.position.split(",");
              var i;
              for(i=0;i<pos.length;i++)
              {
                var $newOpt = $("<option>").attr("value",pos[i]).text(pos[i])
                $('#pos_del').append($newOpt);
              }
              $('#pos_del').formSelect();
              
          }
          else
          {
             window.location.replace('http://localhost/stud_feed_sys/logout.php');
          }
        }
      })
      $("select[required]").css({
        display: "inline",
        height: 0,
        padding: 0,
        width: 0
      });
    $('.collapsible').collapsible();
    $('.modal').modal();
    $('#dept').on('contentChanged', function() {
    $(this).formSelect();
    });
    // update function for demo purposes
    $("#pos_add").change(function () {
        var val = $(this).val();
        if (val == "HOD" || val=="Faculty") {
        $("#dept").removeAttr('disabled');
        $("#dept").trigger('contentChanged');
    } 
    else{
        $("#dept").attr('disabled','');
        $("#dept").trigger('contentChanged');
    }
    });
    $("#r_upd").submit(function(e){
        $.ajax({
           type:"POST",
           url:"rev_update.php",
           data:$('#r_upd').serialize(),
           success:function(data){
               if(data)
               {
                   var obj = JSON.parse(data);
                   if(obj.position.indexOf('HOD')!=-1)
                   {
                       $('#feed1').attr('href','http://localhost/stud_feed_sys/feedback/review/sub_review/hod_sub_review.php');
                       $('#feed2').attr('href','http://localhost/stud_feed_sys/feedback/review/lab_review/hod_lab_review.php');
                       $('#li6').html('<a id="feed6" href="add_sub_info.php" style="color:white;font-size:large;"><b>Add Subjects</b></a>');
                   }
                   else if(obj.position.indexOf('Faculty')!=-1)
                   {
                       $('#feed1').attr('href','http://localhost/stud_feed_sys/feedback/review/sub_review/sub_review.php');
                       $('#feed2').attr('href','http://localhost/stud_feed_sys/feedback/review/lab_review/lab_review.php');
                       $('#li6').html('');
                   }
                   if(obj.position.indexOf('Mess In-Charge')!=-1 && $('#li3').html()=="")
                   {
                     $('#li3').html('<a id="feed3" href="http://localhost/stud_feed_sys/feedback/review/mess_review/g_mess_rev.php" style="color:white;font-size:large;"><b>Girls Mess Feedbacks</b></a>');
                     $('#li4').html('<a id="feed4" href="http://localhost/stud_feed_sys/feedback/review/mess_review/b_mess_rev.php" style="color:white;font-size:large;"><b>Boys Mess Feedbacks</b></a>');
                   }
                   else if(obj.position.indexOf('Mess In-Charge')==-1 && $('#li3').html()!=""){
                     $('#li3').html("");
                     $('#li4').html("");
                   }
                   if(obj.position.indexOf('Library In-Charge')!=-1 && $('#li5').html()=="")
                   {
                     $('#li5').html('<a id="feed5" href="http://localhost/stud_feed_sys/feedback/review/lib_review/lib_rev.php" style="color:white;font-size:large;"><b>Library Feedbacks</b></a>');
                   }
                   else if(obj.position.indexOf('Library In-Charge')==-1 && $('#li5').html()!=""){
                     $('#li5').html("");
                   }
                   $('#1').html('Position: '+ obj.position);
                   $('#2').html('Department: '+ obj.dept);
                   var pos = obj.position.split(",");
                   var i;
                   $('#pos_del').empty();
                   $("#pos_del").append("<option value='' disabled>Delete positions</option>");
                   for(i=0;i<pos.length;i++)
                   {
                     var $newOpt = $("<option>").attr("value",pos[i]).text(pos[i])
                     $('#pos_del').append($newOpt);
                   }
                   $('#pos_del').formSelect();
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