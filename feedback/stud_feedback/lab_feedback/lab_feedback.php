<?php
$sub_code = $_POST['sub'];
$inst_name = $_POST['inst_name'];
$sql1 = "SELECT COLUMN_COMMENT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'trial' AND TABLE_NAME = 'lab_feedback' AND COLUMN_COMMENT!=''";
$sql2 = "SELECT COLUMN_NAME
FROM INFORMATION_SCHEMA.COLUMNS
WHERE TABLE_NAME = 'lab_feedback' AND COLUMN_NAME LIKE 'attr%'";
$res1 = $conn->query($sql1);
$res2 = $conn->query($sql2);
?>
<div class="wrapper">
<div class="container">
<div clas="row">
<div class="card-panel">
<span>
<form id="feed_form">
      <div class="row">
        <div class="input-field col s6">
          <input disabled name="sub" value="<?php echo $sub_code;?>" id="disabled" type="text"  class="validate">
          <label for="disabled">Subject Code</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input disabled value="<?php echo $inst_name;?>" id="disabled" type="text" name="inst_name" class="validate">
          <label for="disabled">Instructor</label>
        </div>
      </div>
        <?php
          while($row1 = $res1->fetch_row())
          {
            $row2 = $res2->fetch_row();
            ?>
            <div class="row">
            <p><?php echo $row1[0];?></p>
            </div>
            <div class="row">
            <div class="col s1">
              <label>
                <input class="with-gap" name="<?php echo $row2[0];?>" value="1" type="radio" checked required=""/>
                <span>1</span>
              </label>
            </div>
            <div class="col s1">
              <label>
                <input class="with-gap" name="<?php echo $row2[0];?>" value="2" type="radio"/>
                <span>2</span>
              </label>
          </div>
          <div class="col s1">
              <label>
                <input class="with-gap" name="<?php echo $row2[0];?>" value="3" type="radio"/>
                <span>3</span>
              </label>
              </div>
              <div class="col s1">
              <label>
                <input class="with-gap" name="<?php echo $row2[0];?>" value="4" type="radio" />
                <span>4</span>
              </label>
              </div>
              <div class="col s1">
              <label>
                <input class="with-gap" name="<?php echo $row2[0];?>" value="5" type="radio" />
                <span>5</span>
              </label>
              </div>
            </div>
          <?php } ?>
         <div class="row">
                <div class="col s6">
                <button class="btn waves-effect waves-light" type="submit" name="action" style="background:#4169E1;">SUBMIT
                  <i class="material-icons right">send</i>
                </button>
                </div>
                </div>
    </form>
    </span>
</div>
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