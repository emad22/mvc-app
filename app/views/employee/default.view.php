<div class="box">
    <div class="box-header">
        
        <a href="/employee/add" class="btn btn-primary pull-left"><?= $text_add_employee ?> <a>
    </div>
<!-- /.box-header -->
    <div class="box-body">
        <table id="table_id" class="table direction table-bordered table-striped">
            <thead>
                <tr>
                    <th><?= $text_name_employee ?></th>
                    <th><?= $text_address_employee ?></th>
                    <th><?= $text_type_employee ?></th>
                    <th><?= $text_age_employee ?></th>
                    <th><?= $text_salary_employee ?></th>
                    <th><?= $text_tax_employee ?></th>
                    <th><?= $text_control_employee ?></th>
                </tr>
            </thead>
            <?php
            if(false !== $employees) {
        foreach ($employees as $employee) {
            ?>
            <tbody>
                <tr>
                    <td> <?=$employee->name ?></td>
                    <td><?=$employee->address ?></td>
                    <td>
                        <?php
                            if($employee->type ==0){
                                echo 'ذكر';
                            }else{
                                echo 'انثي';
                            }
                        ?>
                    </td>
                    <td><?=$employee->age ?></td>
                    <td><?=$employee->salary ?></td>
                    <td><?=$employee->tax ?></td>
                    <td>
                        <a href="/employee/edit/<?= $employee->id ?>"><i class="fa fa-edit"></i></a>
                        <a href="/employee/delete/<?= $employee->id ?>" onclick="if(!confirm('<?= $text_delete_message ?>')) return false;"><i class="fa fa-trash"></i></a>
                    </td>
            </tbody>
            <?php
                  
                }
            } else {?>
            <h3>No Data <h3/>
            <?php    }
            ?>
        </table>
    </div>
<!-- /.box-body -->
</div>
 <!-- /.row -->
