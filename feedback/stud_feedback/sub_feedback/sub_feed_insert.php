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
    WHERE TABLE_NAME = 'sub_feedback' AND COLUMN_NAME LIKE 'attr%'");
    $sql1 = $conn->query("SELECT COUNT(COLUMN_COMMENT) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'trial' AND TABLE_NAME = 'sub_feedback' AND COLUMN_COMMENT!=''");
    $check = $conn->query("SELECT MAX(`S.No`) FROM `lab_feedback`");
    $result = $check->fetch_row();
    if($result[0] == NULL)
        $sno = 0;
    else
        $sno = $result[0]+1;
    $attr = array($sno,$_POST['sub_code'],$_POST['inst_name']);
    $row1 = $sql1->fetch_row();
    for($i = 1;$i<=$row1[0];$i++)
    {
        $row = $sql->fetch_row();
        if(isset($_POST[$row[0]]))
        {
            if($i == 1||$i == 2||$i == 6||$i == 10)
                array_push($attr,$_POST[$row[0]]);
            else
            {
                $item = (int)$_POST[$row[0]];
                array_push($attr,$item);
            }
        }
        else
            array_push($attr,"");
    }
    $values  = implode("', '", array_values($attr));

    $sql2 = $conn->query("INSERT INTO `sub_feedback`(`S.No`,`subject_code`, `instructor`, `attr1(y/n)`, `attr2(y/n)`, `attr3(rate)`, `attr4(rate)`, `attr5(rate)`, `attr6(pace)`, `attr7(rate)`, `attr8(rate)`, `attr9(rate)`, `attr10`) VALUES('$values')");
    if(!$sql2)
    {
        echo $conn->error;;
    }
    $sql3 = $conn->query("INSERT INTO `feedback_submissions` VALUES('$id','".$_POST['sub_code']."')");
    if(!$sql3)
    {
        echo $conn->error;
    }
?>