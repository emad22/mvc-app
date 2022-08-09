





<div class="box">
    <div class="box-header">
        
        <a href="/productcategories/create" class="btn btn-primary pull-left"><?= $text_new_item ?> <a>
    </div>
<!-- /.box-header -->

    <div class="box-body">
        <?php 
            if(false !== $categories) {
                ?>
        <table id="table_id" class="table direction table-bordered table-striped">
            <thead>
                <tr>
                    <th><?= $text_table_group_name?></th>
                    <th><?= $text_table_control?></th>
                </tr>
            </thead>
           
            <tbody>
                 <?php

                   
                    foreach ($categories as $category) {
                        ?>
                <tr>
                    <td><?=$category->Name ?></td>
                    <td>
                        <a href="/productcategories/edit/<?= $category->CategoryId ?>"><i class="fa fa-edit"></i></a>
                        <a href="/productcategories/delete/<?= $category->CategoryId ?>" onclick="if(!confirm('<?= $text_table_control_delete_confirm ?>')) return false;"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                <?php
                  
                }
            } else {?>
            </tbody>
            
           <section class="content">
            <div class="box box-default">
              
              <div class="box-body pull-right">
                  <h3><?= $text_no_data ?></h3>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </section>
            <?php    }
            ?>
        </table>
    </div>
<!-- /.box-body -->
</div>
 <!-- /.row -->
