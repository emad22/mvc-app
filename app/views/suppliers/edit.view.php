


<div class="col-xs-12">
<!-- general form elements -->
  <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?= $text_header ?></h3>
	</div>
    <form autocomplete="off"  method="post" enctype="application/x-www-form-urlencoded">
    <div class="box-body">
        <legend><?= $text_legend ?></legend>
        <div class="form-group col-xs-6">
            <label<?= $this->labelFloat('Name', $supplier) ?>><?= $text_label_Name ?></label>
            <input class="form-control" required type="text" name="Name" maxlength="40" value="<?= $this->showValue('Name', $supplier) ?>"">
        </div>
        <div class="form-group col-xs-6">
            <label<?= $this->labelFloat('Email', $supplier) ?>><?= $text_label_Email ?></label>
            <input class="form-control" required type="email" name="Email" maxlength="40" value="<?= $this->showValue('Email', $supplier) ?>">
        </div>
        <div class="form-group col-xs-6">
            <label<?= $this->labelFloat('PhoneNumber') ?>><?= $text_label_PhoneNumber ?></label>
            <input class="form-control" required type="text" name="PhoneNumber" maxlength="15" value="<?= $this->showValue('PhoneNumber', $supplier) ?>">
        </div>
        <div class="form-group col-xs-6">
            <label<?= $this->labelFloat('Address', $supplier) ?>><?= $text_label_Address ?></label>
            <input class="form-control" required type="text" name="Address" value="<?= $this->showValue('Address', $supplier) ?>">
        </div>
    </div>
                 <!-- /.box-body -->

        <div class="box-footer">
            <!--<button type="submit" class="btn btn-primary">Submit</button>-->
            <input type="submit" name="submit" class="btn btn-default" value="<?= $text_label_save ?>" />

         </div>
    
</form>
  </div>
</div>
