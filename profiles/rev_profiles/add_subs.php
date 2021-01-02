<form id="subjects" method="post" action="sub_info.php">
    <div class="row">
    <div class="input-field col s6">
          <input id="sub_code" name="sub_code" type="text" class="validate" required="">
          <label for="sub_code">Subject Code</label>
    </div>
    <div class="input-field col s6">
          <input id="sub_name" name="sub_name" type="text" class="validate" required="">
          <label for="sub_name">Subject Name</label>
    </div>
    </div>
    <div class="row">
    <div class="input-field col s6">
          <input id="inst_name" name="inst_name" type="text" class="validate" required="">
          <label for="inst_name">Instructor Name</label>
    </div>
    <div class="input-field col s6">
          <select name="degree" id="degree" class="validate" required="" aria-required="true">
            <option value="B.Tech" selected>B.Tech</option>
            <option value="M.Tech">M.Tech</option>
            <option value="MSc">MSc</option>
          </select>
          <label>Degree</label>
    </div>
    </div>
    <div class="row">
    <div class="input-field col s6">
        <select name="branches[]" id="branches" class="validate" required="" aria-required="true" multiple>
        <option value="" disabled>Branches/Sections taught</option>
        <option value="CSE">CSE</option>
        <option value="ECE">ECE</option>
        <option value="EEE">EEE</option>
        <option value="CE">CE</option>
        <option value="ME">ME</option>
        <option value="A">Section A</option>
        <option value="B">Section B</option>
        <option value="C">Section C</option>
        </select>
        <label>Branches for which the subject is offered</label>
    </div>
    <div class="input-field col s6">
          <input id="sem" name="sem" type="number" min="1" max="8" step="1" class="validate" required="">
          <label for="sem">Semester</label>
    </div>
    </div>
    <div class="row">
    <div class="col s6">
        <select id="type" name="type" class="validate" required="" aria-required="true">
         <option value="Theory">Theory</option>
         <option value="Lab">Laboratory</option>
        </select>
    </div>
    </div>
    <div class="row">
        <div class="col s6">
            <button class="btn waves-effect waves-light" type="submit" name="submit" style="background:#4169E1;">SUBMIT
                  <i class="material-icons right">send</i>
            </button>
        </div>
    </div>
</form>
