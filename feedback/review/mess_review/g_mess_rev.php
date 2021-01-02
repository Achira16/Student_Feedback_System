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
            padding-left:18%;
            padding-right:2%;
        }
        ul.dropdown-content.select-dropdown li:not(.disabled) span {color:#4169E1; }
        tbody {
    display:block;
    height:120px;
    overflow:auto;
}
thead, tbody tr {
    display:table;
    width:100%;
    table-layout:fixed;
}
thead {
    width: calc( 100% - 1em )
}
table {
    width:100%;
}

    </style>
     
</head>
<body>
<?php include('/opt/lampp/htdocs/stud_feed_sys/profiles/rev_profiles/rev_sidenav.php');?>
       
    
    <?php
   
      $cols = $conn->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'mess_feedback' AND COLUMN_NAME LIKE 'attr%(rate)'");
      $pie = array();
      while($col_rows = $cols->fetch_row())
      {
        array_push($pie,$conn->query("SELECT `$col_rows[0]`,COUNT(*) FROM `mess_feedback` WHERE `gender`='Female' GROUP BY `$col_rows[0]`"));
      }
      $cols1 = $conn->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'mess_feedback' AND COLUMN_NAME LIKE 'attr%(rate)'");
      $col_comm = $conn->query("SELECT COLUMN_COMMENT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'trial' AND TABLE_NAME = 'mess_feedback' AND COLUMN_COMMENT!=''");
     ?>
       <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
       <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']}); 
           google.charts.setOnLoadCallback(drawChart1);
           google.charts.setOnLoadCallback(drawChart2); 
           google.charts.setOnLoadCallback(drawChart3);
           google.charts.setOnLoadCallback(drawChart4);
           google.charts.setOnLoadCallback(drawChart5);
           google.charts.setOnLoadCallback(drawChart6);
       <?php     $col_rows1 = $cols1->fetch_row();
                $cc1 = $col_comm->fetch_row();
       ?>
            
           function drawChart1()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['<?php echo $col_rows1[0];?>', 'Number'],  
                          <?php  
                          while($row =$pie[0]->fetch_assoc())  
                          {  
                               echo "['".$row[$col_rows1[0]]."', ".$row["COUNT(*)"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      title: '<?php echo $cc1[0];?>',  
                      is3D:true,  
                      //pieHole: 0.4  
                     };  
                var chart = new google.visualization.PieChart(document.getElementById("piechart1"));  
                chart.draw(data, options);  
           }
       <?php  $col_rows1 = $cols1->fetch_row();
               $cc1 = $col_comm->fetch_row();
       ?>
            
           function drawChart2()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['<?php echo $col_rows1[0];?>', 'Number'],  
                          <?php  
                          while($row =$pie[1]->fetch_assoc())  
                          {  
                               echo "['".$row[$col_rows1[0]]."', ".$row["COUNT(*)"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      title: '<?php echo $cc1[0];?>',
                      is3D:true,  
                      //pieHole: 0.4  
                     };  
                var chart = new google.visualization.PieChart(document.getElementById("piechart2"));  
                chart.draw(data, options);  
           }
           <?php  $col_rows1 = $cols1->fetch_row();
                   $cc1 = $col_comm->fetch_row();
           ?>
            
            function drawChart3()  
            {  
                 var data = google.visualization.arrayToDataTable([  
                           ['<?php echo $col_rows1[0];?>', 'Number'],  
                           <?php  
                           while($row =$pie[2]->fetch_assoc())  
                           {  
                                echo "['".$row[$col_rows1[0]]."', ".$row["COUNT(*)"]."],";  
                           }  
                           ?>  
                      ]);  
                 var options = {  
                       title: '<?php echo $cc1[0];?>',  
                       is3D:true,  
                       //pieHole: 0.4  
                      };  
                 var chart = new google.visualization.PieChart(document.getElementById("piechart3"));  
                 chart.draw(data, options);  
            }
            <?php  $col_rows1 = $cols1->fetch_row();
                   $cc1 = $col_comm->fetch_row();
            ?>
            
            function drawChart4()  
            {  
                 var data = google.visualization.arrayToDataTable([  
                           ['<?php echo $col_rows1[0];?>', 'Number'],  
                           <?php  
                           while($row =$pie[3]->fetch_assoc())  
                           {  
                                echo "['".$row[$col_rows1[0]]."', ".$row["COUNT(*)"]."],";  
                           }  
                           ?>  
                      ]);  
                 var options = {  
                       title: '<?php echo $cc1[0];?>',  
                       is3D:true,  
                       //pieHole: 0.4  
                      };  
                 var chart = new google.visualization.PieChart(document.getElementById("piechart4"));  
                 chart.draw(data, options);  
            }
            <?php  $col_rows1 = $cols1->fetch_row();
                   $cc1 = $col_comm->fetch_row();
            ?>
            
            function drawChart5()  
            {  
                 var data = google.visualization.arrayToDataTable([  
                           ['<?php echo $col_rows1[0];?>', 'Number'],  
                           <?php  
                           while($row =$pie[4]->fetch_assoc())  
                           {  
                                echo "['".$row[$col_rows1[0]]."', ".$row["COUNT(*)"]."],";  
                           }  
                           ?>  
                      ]);  
                 var options = {  
                       title: '<?php echo $cc1[0];?>',  
                       is3D:true,  
                       //pieHole: 0.4  
                      };  
                 var chart = new google.visualization.PieChart(document.getElementById("piechart5"));  
                 chart.draw(data, options);  
            }
            <?php  $col_rows1 = $cols1->fetch_row();
                   $cc1 = $col_comm->fetch_row();
            ?>
            
            function drawChart6()  
            {  
                 var data = google.visualization.arrayToDataTable([  
                           ['<?php echo $col_rows1[0];?>', 'Number'],  
                           <?php  
                           while($row =$pie[5]->fetch_assoc())  
                           {  
                                echo "['".$row[$col_rows1[0]]."', ".$row["COUNT(*)"]."],";  
                           }  
                           ?>  
                      ]);  
                 var options = {  
                       title: '<?php echo $cc1[0];?>',  
                       is3D:true,  
                       //pieHole: 0.4  
                      };  
                 var chart = new google.visualization.PieChart(document.getElementById("piechart6"));  
                 chart.draw(data, options);  
            }
            
       </script>  
       <?php
       $table = $conn->query("SELECT `attr7` FROM `mess_feedback` WHERE `gender` = 'Female'");
      include('pie.php');
    ?>  
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src = "http://localhost/stud_feed_sys/js/materialize.min.js"></script> 
    <script src = "http://localhost/stud_feed_sys/js/rev_js2.js"></script>
      

</body>
</html>