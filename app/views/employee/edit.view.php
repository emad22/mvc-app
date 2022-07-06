<div class="box-header with-border">
    <h3 class="box-title">إضافة موظف جديد </h3>
</div>
<form autocomplete="off"  method="post" enctype="application/x-www-form-urlencoded">
    <div class="box-body">
	<div class="form-group">
            <label for="name">اسم الموظف</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="" value="<?= $employee->name; ?> ">
	</div>
	<div class="form-group">
            <label for="address">عنوان الموظف</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="" value="<?= $employee->address; ?> ">
        </div>
         <div class="col-xs-4">
                <label>النوع</label>
                <select class="form-control" name="type">
                    <?php
                        if($employee->type == 0){
                            echo '<option value="0">ذكر </option>'
                            . '<option value="1">انثي</option>';
                        }else {
                            echo '<option value="1">انثي</option>'
                            . '<option value="0">ذكر </option>';
                        }
                    ?>
                    
                    
                </select>
            </div>
        <div class="col-xs-4">
            <label for="age">عمر الموظف</label>
            <input type="number" id="age" name="age" placeholder="Your age.." min="22" max="99" class="form-control" required="required" value="<?= $employee->age; ?>">
        </div>
        <div class="col-xs-4">
            <label for="salary">مرتب الموظف</label>
            <input type="number" id="salary" name="salary" step="0.01" placeholder="Your salary.." required="required"  class="form-control" value="<?= $employee->salary; ?>">
            
        </div>
        <div class="col-xs-4">
            <label for="tax">الخصم على الموظف</label>
            <input type="number" id="tax" name="tax" placeholder="Your tax.." step="0.01" min="1" max="5" required="required" class="form-control" value="<?= $employee->tax; ?>">
        </div>  
     </div>
             <!-- /.box-body -->

    <div class="box-footer">
        <!--<button type="submit" class="btn btn-primary">Submit</button>-->
        <input type="submit" name="submit" class="btn btn-default" value="تعديل" >
            
     </div>
</form>
