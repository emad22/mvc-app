<div class="col-xs-12">
<!-- general form elements -->
  <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?= $text_add_user ?></h3>
	</div>
    <form autocomplete="off"  method="post" enctype="application/x-www-form-urlencoded">
        <div class="box-body">
            <div class="col-xs-4">
                <label for="name"><?= $text_username?></label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="username" placeholder="">
            </div>
            <div class="col-xs-4">
                <label for="password"><?= $text_password?></label>
                <input type="password" class="form-control" id="" name="password" placeholder="">
            </div>
            <div class="col-xs-4">
                <label for="email"><?= $text_useremail ?></label>
                <input type="email" class="form-control" id="address" name="email" placeholder="">
            </div>
            <div class="col-xs-4">
                <label for="phone"><?= $text_phone ?></label>
                <input type="number" class="form-control" id="address" name="phone" placeholder="">
            </div>
            <div class="col-xs-4">
                <label><?= $text_usergroup?></label>
                <select class="form-control" name="usergroup">
                    <option value=""><?= $text_user_GroupId ?></option>
                        <?php if (false !== $groups): 
                            foreach ($groups as $group): 
                            ?>
                            <option value="<?= $group->GroupId ?>"><?= $group->GroupName ?></option>
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
