<?php
$sql1 = $conn->query("SELECT COLUMN_COMMENT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'trial' AND TABLE_NAME = 'lib_feedback' AND COLUMN_COMMENT!=''");
$sql2 = $conn->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='lib_feedback' AND COLUMN_NAME LIKE 'attr%'");
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
            <div class="col s2">
              <label>
                <input class="with-gap" name="<?php echo $row2[0];?>" value="Poor" type="radio" checked required=""/>
                <span>Poor</span>
              </label>
            </div>
            <div class="col s2">
              <label>
                <input class="with-gap" name="<?php echo $row2[0];?>" value="Satisfactory" type="radio"/>
                <span>Satisfactory</span>
              </label>
           </div>
           <div class="col s2">
              <label>
                <input class="with-gap" name="<?php echo $row2[0];?>" value="Good" type="radio"/>
                <span>Good</span>
              </label>
              </div>
              <div class="col s2">
              <label>
                <input class="with-gap" name="<?php echo $row2[0];?>" value="Excellent" type="radio" />
                <span>Excellent</span>
              </label>
              </div>
        </div>
        <?php
        elseif(strpos($row2[0],'(y/n)')):
        ?>
        <div class="row">
            <div class="col s2">
              <label>
                <input class="with-gap" name="<?php echo $row2[0];?>" value="Yes" type="radio" checked required=""/>
                <span>Yes</span>
              </label>
            </div>
            <div class="col s2">
              <label>
                <input class="with-gap" name="<?php echo $row2[0];?>" value="No" type="radio" />
                <span>No</span>
              </label>
            </div>
        </div> 
        <?php else: ?>
            <div class="row">
                <div class="col s2">
                <label>
                <input class="with-gap" name="<?php echo $row2[0];?>" value="Yes" type="radio" checked required=""/>
                <span>Yes</span>
                </label>
                </div>
                <div class="col s2">
                <label>
                <input class="with-gap" name="<?php echo $row2[0];?>" value="No" type="radio" />
                <span>No</span>
                </label>
                </div>
                <div class="col s4">
                <label>
                <input class="with-gap" name="<?php echo $row2[0];?>" value="Not visited yet" type="radio" />
                <span>Not visited yet</span>
                </label>
                </div>
            </div>
        <?php endif;?>
      
        <?php
    }
?>
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