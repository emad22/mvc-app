<div class="col-xs-12">
<!-- general form elements -->
  <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?= $text_add_groupname ?></h3>
	</div>
    <form autocomplete="off"  method="post" enctype="application/x-www-form-urlencoded">
        <div class="box-body">
            <div class="col-xs-4">
                <label for="groupName"><?= $text_groupname?></label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="groupName" placeholder="">
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
