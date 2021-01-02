<?php
$sql1 = $conn->query("SELECT COLUMN_COMMENT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'trial' AND TABLE_NAME = 'mess_feedback' AND COLUMN_COMMENT!=''");
$sql2 = $conn->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='mess_feedback' AND COLUMN_NAME LIKE 'attr%'");
?>
<div class="wrapper">
<div class="container">
<div clas="row">
<div class="card-panel">
<span>
<form action="feed_insert.php" method="POST" id="feed_form">
<?php
    while ($row1 =$sql1->fetch_row())
    {
        $row2 = $sql2->fetch_row();
        ?>
        <div class="row">
            <p><?php echo $row1[0];?></p>
        </div>
        <?php 
             if(strpos($row2[0],'(rate)')):
        ?>
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
        <?php
        else:
        ?>
        <div class="input-field col s12">
              <textarea id="add" name="<?php echo $row2[0];?>" class="materialize-textarea" class="validate" required=""></textarea>
              <label for="add"><?php echo $row1[0];?></label>
        </div>
        <?php endif;?>
      
        <?php
    }
?>
   <div class="row">
        <div class="col s6">
        <select name="gender" id="gender" class="validate" required="">
        <option value="">Choose your gender</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        </select>
        </div>
    </div>
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