
<div class="box">
    <div class="box-header">
        
        <a href="/usersgroups/add" class="btn btn-primary pull-left"><?= $text_add_new?> <a>
    </div>
<!-- /.box-header -->

    <div class="box-body">
        <?php 
            if(false !== $groups) {
                ?>
        <table id="table_id" class="table direction table-bordered table-striped">
            <thead>
                <tr>
                    <th><?= $text_groupname?></th>
                </tr>
            </thead>
           
            <tbody>
                 <?php

                   
                    foreach ($groups as $group) {
                        ?>
                <tr>
                    <td><?=$group->groupName ?></td>
                    <td>
                        <a href="/usersgroups/edit/<?= $group->groupId ?>"><i class="fa fa-edit"></i></a>
                        <a href="/usersgroups/delete/<?= $group->groupId ?>" onclick="if(!confirm('<?= $text_delete_message ?>')) return false;"><i class="fa fa-trash"></i></a>
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
