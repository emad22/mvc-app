

<div class="col-xs-12">
<!-- general form elements -->
  <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?= $text_legend ?></h3>
	</div>
    <form autocomplete="off"  method="post" enctype="multipart/form-data">
        <div class="box-body">
            <div class="col-xs-4">
                <label for="<?= $this->labelFloat('Name') ?>"><?= $text_label_Name ?></label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="Name" placeholder="" value="<?= $this->showValue('Name') ?>">
            </div>
            <div class="col-xs-4">
               <div class="form-group">
                  <!--<label for="exampleInputFile"><?= $text_label_Image ?></label>-->
                  <!--<input type="file" name="image" accept="image/*">-->
                  
                  <label class="floated"><?= $text_label_Image ?></label>
                <input type="file" name="image" accept="image/*">

                </div>
            </div>
         </div>
                 <!-- /.box-body -->

        <div class="box-footer">
            <!--<button type="submit" class="btn btn-primary">Submit</button>-->
            <input type="submit" name="submit" class="btn btn-pinterest" value="<?= $text_label_save ?>" />

         </div>
    </form>
  </div>
</div>
