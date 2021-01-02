<?php
    session_start();
    require '/opt/lampp/htdocs/stud_feed_sys/db_connect.php';
    $id = $_SESSION['google_id'];
    $get_user = $conn->query("SELECT * FROM `students` WHERE `google_id`='$id'");
    if(mysqli_num_rows($get_user) > 0){
        $user = $get_user->fetch_assoc();
    }
    else{
        header('location:http://localhost/stud_feed_sys/logout.php');
        exit;
    }
    $sql = $conn->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'mess_feedback' AND COLUMN_NAME LIKE 'attr%'");
    $sql1 = $conn->query("SELECT COUNT(COLUMN_COMMENT) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'trial' AND TABLE_NAME = 'mess_feedback' AND COLUMN_COMMENT!=''");
    $attr = array($id);
    $row1 = $sql1->fetch_row();
    for($i = 1;$i<=$row1[0];$i++)
    {
        $row = $sql->fetch_row();
        if(isset($_POST[$row[0]]))
        {
            array_push($attr,$_POST[$row[0]]);
        }
        else
            array_push($attr,"");
    }
    array_push($attr,$_POST['gender']);
    $values  = implode("', '", array_values($attr));
    $sql2 = $conn->query("SELECT `google_id` FROM `mess_feedback` WHERE `google_id`='$id'");
    if(mysqli_num_rows($sql2)<=0)
        $sql3 = $conn->query("INSERT INTO `mess_feedback` VALUES('$values')");
    else
    {
        $res = $conn->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'mess_feedback' AND COLUMN_NAME LIKE 'attr%'");
        $cols = array();
        while($row = $res->fetch_row())
        {
            array_push($cols,$row[0]);
        }
     
        $sql4 = $conn->query("UPDATE `mess_feedback` SET `$cols[0]`=$attr[1],`$cols[1]`=$attr[2],`$cols[2]`=$attr[3],`$cols[3]`=$attr[4],`$cols[4]`=$attr[5],`$cols[5]`=$attr[6],`$cols[6]`='$attr[7]' WHERE `google_id`='$id'");
       
   
    }
?>

