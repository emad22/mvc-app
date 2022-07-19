<div class="box">
    <div class="box-header">
        
        <a href="/users/add" class="btn btn-primary pull-left"><?= $text_add_new?> <a>
    </div>
<!-- /.box-header -->

    <div class="box-body">
        <?php  if(false !== $users) : ?>
        <table id="table_id" class="table direction table-bordered table-striped">
            <thead>
                <tr>
                    <th><?= $text_username?></th>
                    <th><?= $text_email ?></th>
                    <th><?= $text_phone ?></th>
                    <th><?= $text_sub ?></th>
                    <th><?= $text_lastlogin?></th>
                    <th><?= $text_group ?></th>
                    <th><?= $text_control ?></th>
                </tr>
            </thead>
           
            <tbody>
                 <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?=$user->Username ?></td>
                    <td><?=$user->Email ?></td>
                    <td><?=$user->PhoneNumber ?></td>
                    <td><?=$user->SubscriptionDate ?></td>
                    <td><?=$user->LastLogin ?></td>
                    <td><?=$user->GroupName ?></td>
                    <td>
                        <a href="/users/edit/<?= $user->UserId ?>"><i class="fa fa-edit"></i></a>
                        <a href="/users/delete/<?= $user->UserId ?>" onclick="if(!confirm('<?= $text_delete_message ?>')) return false;"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach;  ?>
                <?php else:  ?>
                <section class="content">
                    <div class="box box-default">

                      <div class="box-body ">
                          <h3><?= $text_no_data ?></h3>
                      </div>
                      <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </section>
                <?php endif; ?>
            </tbody>          
        </table>
    </div>
<!-- /.box-body -->
</div>
 <!-- /.row -->
