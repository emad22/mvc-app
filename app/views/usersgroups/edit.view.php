<div class="col-xs-12">
<!-- general form elements -->
  <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?= $text_add_groupname ?></h3>
	</div>
    <form autocomplete="off"  method="post" enctype="application/x-www-form-urlencoded">
        <div class="box-body">
            <div class="form-group">
                <label for="groupName"><?= $text_groupname?></label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="groupName" placeholder="" value="<?= $groups->GroupName?> ">
            </div>
            
            <div class="form-group">
                <label for="groupName"><?= $text_privileges?></label>
                <?php 
                if($privileges !== false):
                    foreach ($privileges as $privilege):
                ?>
                <div class="checkbox">
                    <label>
                        <input type="checkbox"  name="privileges[]" value="<?= $privilege->PrivilegeId?>" <?= in_array($privilege->PrivilegeId, $groupPrivileges) ? 'checked' : '' ?>>
                        <span class="span"><?= $privilege->PrivilegeTitle ?></span>
                    </label>
                  </div>
                <?php    
                    endforeach;
                endif;
                
                ?>
                
                  
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
