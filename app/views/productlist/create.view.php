
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
                <label for="<?= $this->labelFloat('CategoryId') ?>"><?= $text_label_Name ?></label>   
                <select required name="CategoryId" class="form-control">
                    <option value=""><?= $text_label_CategoryId ?></option>
                    <?php if (false !== $categories): foreach ($categories as $category): ?>
                        <option value="<?= $category->CategoryId ?>" <?= $this->selectedIf('CategoryId', $category->CategoryId) ?>><?= $category->Name ?></option>
                    <?php endforeach;endif; ?>
                </select>
            </div>
            <div class="col-xs-4">
                <label<?= $this->labelFloat('Quantity') ?>><?= $text_label_Quantity ?></label>              
                <input type="text" class="form-control" id="exampleInputEmail1" name="Quantity" placeholder="" value="<?= $this->showValue('Quantity') ?>">
            </div>
            <div class="col-xs-4">
                <label<?= $this->labelFloat('BuyPrice') ?>><?= $text_label_BuyPrice ?></label>              
                <input type="text" class="form-control" id="exampleInputEmail1" name="BuyPrice" placeholder="" value="<?= $this->showValue('BuyPrice') ?>">
            </div>
            <div class="col-xs-4">
                <label<?= $this->labelFloat('SellPrice') ?>><?= $text_label_SellPrice ?></label>              
                <input type="text" class="form-control" id="exampleInputEmail1" name="SellPrice" placeholder="" value="<?= $this->showValue('SellPrice') ?>">             
            </div>
            
            <div class="col-xs-4">
                <label> <?= $text_label_Unit ?> </label> 
                <select required name="Unit" class="form-control">
                    <option value=""><?= $text_label_Unit ?></option>
                    <option value="1" <?= $this->selectedIf('Unit', 1) ?>><?= $text_unit_1 ?></option>
                    <option value="2" <?= $this->selectedIf('Unit', 2) ?>><?= $text_unit_2 ?></option>
                    <option value="3" <?= $this->selectedIf('Unit', 3) ?>><?= $text_unit_3 ?></option>
                    <option value="4" <?= $this->selectedIf('Unit', 4) ?>><?= $text_unit_4 ?></option>
                </select>             
            </div>
            
            <div class="col-xs-4">
               <div class="form-group">
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
