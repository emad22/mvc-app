

<div class="box">
    <div class="box-header">
        
        <a href="/clients/add" class="btn btn-primary pull-left"><?= $text_new_item ?> <a>
    </div>
<!-- /.box-header -->
    <div class="box-body">
        <table id="table_id" class="table direction table-bordered table-striped">
            <thead>
                <tr>
                    <th><?= $text_table_name ?></th>
                    <th><?= $text_table_email ?></th>
                    <th><?= $text_table_phone_number ?></th>
                    <th><?= $text_table_control ?></th>
                </tr>
            </thead>
          
            <tbody>
                <?php if(false !== $clients): foreach ($clients as $client): ?>
                    <tr>
                        <td><?= $client->Name ?></td>
                        <td><?= $client->Email ?></td>
                        <td><?= $client->PhoneNumber ?></td>
                        <td>
                            <a href="/clients/edit/<?= $client->ClientId ?>"><i class="fa fa-edit"></i></a>
                            <a href="/clients/delete/<?= $client->ClientId ?>" onclick="if(!confirm('<?= $text_table_control_delete_confirm ?>')) return false;"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach; endif; ?>
            </tbody>

        </table>
    </div>
<!-- /.box-body -->
</div>
 <!-- /.row -->
