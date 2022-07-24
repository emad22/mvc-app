<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar direction">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu ">
            <li class="<?= $this->matchurl('/') ? 'selected' : '' ?>">
                <a href="/">
                      <i class="fa fa-th"></i> <span><?= $text_general_stat ?></span>
                      <!--<small class="label pull-right bg-green">جدید</small>-->
                </a>
            </li>
            
            <li class="treeview active">
                <a href="#">
                  <i class="fa fa-users"></i>    <span><?= $text_users ?></span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu menu-open" style="display: block;">
                  <li class="<?= $this->matchurl('/users/') ? 'selected' : '' ?>"><a href="/users/"><i class="fa fa-shopping-basket"></i> <?= $text_users_list ?></a></li>
                  <li class="<?= $this->matchurl('/usersgroups') ? 'selected' : '' ?>"><a href="/usersgroups"><i class="fa fa-user-secret"></i>  <?= $text_usersgroup ?></a></li>
                  <li class="<?= $this->matchurl('/privileges') ? 'selected' : '' ?>"><a href="/privileges"><i class="fa fa-user-times"></i>  <?= $text_privilege ?></a></li>
                </ul>
            </li>
            
            <li class="treeview active">
                <a href="#">
                  <i class="fa fa-shopping-bag"></i>    <span><?= $text_store ?></span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu menu-open" style="display: block;">
                  <li class="<?= $this->matchurl('/category') ? 'selected' : '' ?>"><a href="/category"><i class="fa fa-shopping-basket"></i> <?= $text_categories?></a></li>
                  <li class="<?= $this->matchurl('/product') ? 'selected' : '' ?>"><a href="/product"><i class="fa fa-product-hunt"></i>  <?= $text_products ?></a></li>
                </ul>
            </li>
            
            <li class="<?= $this->matchurl('/clients') ? 'selected' : '' ?>">
                <a href="/clients">
                      <i class="fa fa-user"></i> <span><?= $text_clients ?></span>
                      <!--<small class="label pull-right bg-green">جدید</small>-->
                </a>
            </li>
            
            <li class="<?= $this->matchurl('/suppliers') ? 'selected' : '' ?>">
                <a href="/suppliers">
                      <i class="fa fa-user-plus"></i> <span><?= $text_suppliers ?></span>
                      <!--<small class="label pull-right bg-green">جدید</small>-->
                </a>
            </li>
            
            
            <li class="treeview active">
                <a href="#">
                  <i class="fa fa-gratipay"></i> <span><?= $text_expenses ?></span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu menu-open" style="display: block;">
                  <li class="<?= $this->matchurl('/expensescategory') ? 'selected' : '' ?>"><a href="/expensescategory"><i class="fa fa-paypal"></i> <?= $text_expenses_category?></a></li>
                  <li class="<?= $this->matchurl('/expensesdaily') ? 'selected' : '' ?>"><a href="/expensesdaily"><i class="fa fa-cc-paypal"></i>  <?= $text_expenses_daily ?></a></li>
                </ul>
            </li>
            
            
            
            <li class="treeview active">
                <a href="#">
                  <i class="fa fa-dashboard"></i> <span><?= $text_transactions ?></span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu menu-open" style="display: block;">
                  <li class="<?= $this->matchurl('/purchases') ? 'selected' : '' ?>"><a href="/purchases"><i class="fa fa-feed"></i> <?= $text_purchases?></a></li>
                  <li class="<?= $this->matchurl('/sales') ? 'selected' : '' ?>"><a href="/sales"><i class="fa fa-trophy"></i>  <?= $text_sales ?></a></li>
                </ul>
            </li>
            
            
            <li>
                <a href="/auth/logout">
                      <i class="fa fa-bell-o"></i> <span><?= $text_notifications ?></span>
                      <!--<small class="label pull-right bg-yellow">12</small>-->
                </a>
            </li>
            
            
<!--            <li>
                <a href="/language">
                      <i class="fa fa-language"></i> <span></span>
                      <small class="label pull-right bg-red">3</small>
                </a>
            </li>-->
            <li>
                <a href="/auth/logout">
                      <i class="fa fa-circle-o text-aqua"></i> <span><?= $text_logout ?></span>
                      <!--<small class="label pull-right bg-yellow">12</small>-->
                </a>
            </li>
        </ul>
      </section>
      <!-- /.sidebar -->
</aside>
<!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
                    <br>
		  <ol class="breadcrumb">
			<li><a href="/"><i class="fa fa-dashboard"></i> <?= $text_dashboard ?></a></li>
			<li class="active">
                            <?php if (isset($text_title)): ?>
                                <?= ' > ' . $text_title ?>
                            <?php endif; ?>
                        </li>
                                         
                        
		  </ol>
		</section>
		<!-- Main content -->
		<section class="content">
		  <!-- Small boxes (Stat box) -->
		  <div class="row">
<?php
$m = $this->messenger->getMessage();

if(!empty($m)):
    foreach ($m as $msg):
?>
             
                      <p class="alert alert-<?=$msg[1]?>"><?php echo $msg[0] ?></p>
<?php    
endforeach;
endif;

?>
