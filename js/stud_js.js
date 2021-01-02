$(document).ready(function(){
    $('.sidenav').sidenav();
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
            url:"http://localhost/stud_feed_sys/profiles/stud_profiles/stud_update.php",
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