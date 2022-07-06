<div class="col-xs-12">
<!-- general form elements -->
  <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?= $text_add_employee ?></h3>
	</div>
    <form autocomplete="off"  method="post" enctype="application/x-www-form-urlencoded">
        <div class="box-body">
            <div class="form-group">
                <label for="name"><?= $text_name_employee ?></label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="">
            </div>
            <div class="form-group">
                <label for="address"><?= $text_address_employee ?></label>
                <input type="text" class="form-control" id="address" name="address" placeholder="">
            </div>
            <div class="col-xs-4">
                <label><?= $text_type_employee ?></label>
                <select class="form-control" name="type">
                    <option value="0"><?= $text_male ?> </option>
                    <option value="1"><?= $text_female ?></option>
                </select>
            </div>
            <div class="col-xs-4">
                <label for="age"><?= $text_age_employee ?></label>
                <input required type="number" class="form-control"  min="22" max="60" name="age" id="age">
            </div>
            <div class="col-xs-4">
                <label for="salary"><?= $text_salary_employee ?></label>
                <input required type="number" class="form-control"  id="salary" step="0.01" name="salary" min="1500" max="9000">
            </div>
            <div class="col-xs-4">
                <label for="tax"><?= $text_tax_employee ?></label>
                 <input required class="form-control"  type="number" id="tax" step="0.01" name="tax" min="1" max="5">
            </div>  
         </div>
                 <!-- /.box-body -->

        <div class="box-footer">
            <!--<button type="submit" class="btn btn-primary">Submit</button>-->
            <input type="submit" name="submit" class="btn btn-default" value="حفظ" />

         </div>
    </form>
  </div>
</div>
