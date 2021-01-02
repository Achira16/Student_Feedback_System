<div class="wrapper">
<div class="container">
<div class="row">
<div class="card-panel" >
<div id="piechart1" style="width:70%;height:300px;">
</div>
<div id="piechart2" style="width:70%;height:300px;">
</div>
<div id="piechart3" style="width:70%;height:300px;">
</div>
<div id="piechart4" style="width:70%;height:300px;">
</div>
<div id="piechart5" style="width:70%;height:300px;">
</div>
<div id="piechart6" style="width:70%;height:300px;">
</div>
<div class="responsive-table table-status-sheet">
    <table class="bordered">
      <thead>
        <tr>
          <th class="center">Comments</th>
        </tr>
      </thead>
      <tbody>
        <?php
       while($row = $table->fetch_row()): 
        ?>
        <tr>
            <td><?php echo $row[0];?></td>
        </tr>
        <?php endwhile;?>
      </tbody>
    </table>
  </div>

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