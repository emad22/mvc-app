
<div class="box">
    <div class="box-header">
        
        <a href="/privileges/add/" class="btn btn-primary pull-left"><?= $text_add_new?> <a>
    </div>
<!-- /.box-header -->

    <div class="box-body">
        <?php
        if(false !== $privileges) {
            ?>
        <table id="table_id" class="table direction table-bordered table-striped">
            <thead>
                <tr>
                    <th><?= $text_privilegeName?></th>
                </tr>
            </thead>
           
            <tbody>
                 <?php

                    
                    foreach ($privileges as $privilege) {
                        ?>
                <tr>
                    <td><?=$privilege->Privilege ?></td>
                    <td>
                        <a href="/privileges/edit/<?= $privilege->PrivilegeId ?>"><i class="fa fa-edit"></i></a>
                        <a href="/privileges/delete/<?= $privilege->PrivilegeId ?>" onclick="if(!confirm('<?= $text_delete_message ?>')) return false;"><i class="fa fa-trash"></i></a>
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
