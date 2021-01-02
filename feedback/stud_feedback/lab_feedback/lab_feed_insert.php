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
    $sql = $conn->query("SELECT COLUMN_NAME
    FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_NAME = 'lab_feedback' AND COLUMN_NAME LIKE 'attr%'");
    $sql1 = $conn->query("SELECT COUNT(COLUMN_COMMENT) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'trial' AND TABLE_NAME = 'lab_feedback' AND COLUMN_COMMENT!=''");
    $check = $conn->query("SELECT MAX(`S.No`) FROM `lab_feedback`");
    $result = $check->fetch_row();
    if($result[0] == NULL)
        $sno = 0;
    else
        $sno = $result[0]+1;
    $attr = array($sno,$_POST['sub'],$_POST['inst_name']);
    $row1 = $sql1->fetch_row();
    for($i = 1;$i<=$row1[0];$i++)
    {
        $row = $sql->fetch_row();
        if(isset($_POST[$row[0]]))
        {
            array_push($attr,(int)$_POST[$row[0]]);
        }
    }
    
    $values  = implode("', '", array_values($attr));
    $sql2 = $conn->query("INSERT INTO `lab_feedback`(`S.No`,`code`, `inst_name`, `attr1(rate)`, `attr2(rate)`, `attr3(rate)`, `attr4(rate)`, `attr5(rate)`, `attr6(rate)`, `attr7(rate)`) VALUES('$values')");
    if(!$sql2)
    {
        echo $conn->error;;
    }
    $sql3 = $conn->query("INSERT INTO `feedback_submissions` VALUES('$id','".$_POST['sub']."')");
    if(!$sql3)
    {
        echo $conn->error;
    }
?>