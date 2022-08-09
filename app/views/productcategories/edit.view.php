





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
                <input type="text" class="form-control" id="exampleInputEmail1" name="Name" placeholder="" value="<?= $this->showValue('Name',$category) ?>">
            </div>
            <div class="col-xs-4">
               <div class="form-group">                               
                  <label class="floated"><?= $text_label_Image ?></label>
                <input type="file" name="image" accept="image/*">

                </div>
            </div>
            <?php if ($category->Image !== ''): ?>
                <div class="col-xs-4">
                    <div class="form-group"> 
                        <img src="/uploads/images/<?= $category->Image ?>" width="30%">
                    </div>
                </div>
            
            <?php endif; ?>
            
         </div>
                 <!-- /.box-body -->

        <div class="box-footer">
            <!--<button type="submit" class="btn btn-primary">Submit</button>-->
            <input type="submit" name="submit" class="btn btn-primary" value="<?= $text_label_save ?>" />
            <!--<input type="submit" name="submit" class="btn btn-danger" value="cancel" />-->
            <a href="/productcategories" class="btn btn-danger" >Cancel</a>

         </div>
    </form>
  </div>
</div>
