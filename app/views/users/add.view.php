<div class="col-xs-12">
<!-- general form elements -->
  <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?= $text_add_user ?></h3>
	</div>
    <form autocomplete="off"  method="post" enctype="application/x-www-form-urlencoded">
        <div class="box-body">
            <div class="col-xs-4">
                <label for="name"><?= $text_label_FirstName?></label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="FirstName" placeholder="" value="<?= $this->showValue('FirstName') ?>">
            </div>
            <div class="col-xs-4">
                <label for="name"><?= $text_label_LastName?></label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="LastName" placeholder="" value="<?= $this->showValue('LastName') ?>">
            </div>
            <div class="col-xs-4">
                <label for="name"><?= $text_label_Username?></label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="Username" placeholder="" value="<?= $this->showValue('Username') ?>">
            </div>
            <div class="col-xs-4">
                <label for="password"><?= $text_label_Password?></label>
                <input type="password" class="form-control" id="" name="Password" placeholder="" value="<?= $this->showValue('Password') ?>">
            </div>
            <div class="col-xs-4">
                <label for="password"><?= $text_label_CPassword?></label>
                <input type="password" class="form-control" id="" name="CPassword" placeholder="" value="<?= $this->showValue('CPassword') ?>">
            </div>
            <div class="col-xs-4">
                <label for="email"><?= $text_label_Email ?></label>
                <input type="email" class="form-control" id="address" name="Email" placeholder=""value="<?= $this->showValue('Email') ?>">
            </div>
            <div class="col-xs-4">
                <label for="email"><?= $text_label_CEmail?></label>
                <input type="email" class="form-control" id="address" name="CEmail" placeholder="" value="<?= $this->showValue('CEmail') ?>">
            </div>
            <div class="col-xs-4">
                <label for="phone"><?= $text_label_PhoneNumber ?></label>
                <input type="number" class="form-control" id="address" name="PhoneNumber" placeholder="" value="<?= $this->showValue('PhoneNumber') ?>">
            </div>
            <div class="col-xs-4">
                <label><?= $text_label_GroupId?></label>
                <select class="form-control" name="GroupId" required >
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
