<div class="login-box">
  <div class="login-logo">
      <a href=""><b class="info-box-text"><?= $login_header ?></b></a>
    <?php
        $m = $this->messenger->getMessage();
        if(!empty($m)):
            foreach ($m as $msg):
    ?>
        <p class="info-box-text alert alert-<?=$msg[1]?>"><?php echo $msg[0] ?></p>
    <?php    
        endforeach;
        endif;
    ?>

      
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg"></p>
    <form action="" method="post">
      <div class="form-group has-feedback">
          <input type="text" name="username" class="form-control" placeholder="username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false" style="position: relative;">
                  <input type="checkbox" >                    
              </div> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
            <button type="submit" name="login" class="btn btn-primary btn-block btn-flat"><?= $login_button ?></button>
          <!--<input type="submit" value="<?= $login_button ?>"-->
        </div>
        <!-- /.col -->
      </div>
    </form>
<!--
    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>
     /.social-auth-links -->
<!--
    <a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a>-->

  </div>
  <!-- /.login-box-body -->
</div>
