<div class="col-xs-12">
<!-- general form elements -->
  <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?= $text_add_user ?></h3>
	</div>
    <form autocomplete="off"  method="post" enctype="application/x-www-form-urlencoded">
        <div class="box-body">
            
            <div class="col-xs-4">
                <label for="phone"><?= $text_label_PhoneNumber ?></label>
                <input type="number" class="form-control" id="address" name="PhoneNumber" placeholder="" value="<?= $this->showValue('PhoneNumber', $users) ?>">
            </div>
            <div class="col-xs-4">
                <label><?= $text_label_GroupId?></label>
                <select class="form-control" name="GroupId" required >
                    <option value=""><?= $text_user_GroupId ?></option>
                        <?php if (false !== $groups): 
                            foreach ($groups as $group): 
                            ?>
                            
                            <option value="<?= $group->GroupId ?>" <?= $this->selectedIf('GroupId' , $group->GroupId ,$users) ?> ><?= $group->GroupName ?> </option>
                        <?php endforeach;endif; ?>
<!--                    <option value="0">1</option>
                    <option value="1">2</option>-->
                </select>
            </div>
            
           
         </div>
                 <!-- /.box-body -->

        <div class="box-footer">
            <!--<button type="submit" class="btn btn-primary">Submit</button>-->
            <input type="submit" name="submit" class="btn btn-default" value="<?= $text_val ?>" />

         </div>
    </form>
  </div>
</div>
