<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gulf Inspection Admin Dashboard | Log in</title>

  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url('assets/admin/images/logo.jpg')?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('assets/admin/images/logo.jpg')?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('assets/admin/images/logo.jpg')?>">
  <link rel="manifest" href="<?php echo base_url('assets/favicons')?>/site.webmanifest">
  <link rel="mask-icon" href="<?php echo base_url('assets/favicons')?>/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/')?>plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/')?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/')?>dist/css/adminlte.min.css">
</head>
<style>
    .login-logo img {
    width: 100%;
    height: auto;
}
</style>
<style>
    .login-logo img {
    width: 100%;
    height: auto;
}
/* body {
    background-image: url(<?php echo base_url('assets/admin/images/login-bg.jpg')?>);
    background-repeat: no-repeat, repeat;
    background-size: cover;
    background-position: center;
} */
</style>
<body class="hold-transition login-page" style="height: 80vh;">
<div class="login-box">
  <div class="login-logo">
    <a href="javascript:void(0)">
        <img src="<?php echo base_url('assets/admin/images/logo.png')?>" style="width: 200px;">
    </a>
    <h3>Admin Login</h3>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg"></p>

      <form>
        <div class="input-group mb-3 " id="user-name-con">
          <input type="email" class="form-control" placeholder="Email" id="user-name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <span class="font-weight-bold" style="color:red;font" id="user-name-err"></span>
        <div class="input-group mb-3 " id="password-con">
          <input type="password" class="form-control" placeholder="Password" id="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <span class="font-weight-bold" style="color:red;font" id="password-err"></span>
        <div class="row">
          <div class="col-12 text-center" id="sign-btn-container">
            <button type="button" class="btn btn-danger btn-sm" id="sign-in-btn">Sign In</button>
          </div>
        </div>
      </form>

      <!-- /.social-auth-links -->

      <!--<p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>-->
      <!--<p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p>-->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo base_url('assets/admin/')?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/admin/')?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/admin/')?>dist/js/adminlte.min.js"></script>
</body>
</html>

<script>
    $(document).on('click','#sign-in-btn',function(){
        const user_name = $('#user-name').val();
        const password = $('#password').val();
        const reg_email = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;
        if(user_name=="")
        {
            $('#user-name-con').removeClass('mb-3');
            $('#user-name-err').text('Enter User Name.*');
            $('#user-name').addClass('is-invalid');    
        }else if(!reg_email.test(user_name)){
            $('#user-name-con').removeClass('mb-3');
            $('#user-name-err').text('Enter valid email address.*');
            $('#user-name').addClass('is-invalid');    
        }else{
            $('#user-name-con').addClass('mb-3');
            $('#user-name-err').text('');
            $('#user-name').removeClass('is-invalid');    
        }
        
        if(password=="")
        {
            $('#password-con').removeClass('mb-3');
            $('#password-err').text('Enter Password.*');
            $('#password').addClass('is-invalid');    
        }else{
            $('#password-con').addClass('mb-3');
            $('#password-err').text('');
            $('#password').removeClass('is-invalid');    
        }
        
        if(user_name!=""&&password!=""&&reg_email.test(user_name))
        {
            proccess_admin_login(user_name,password);
        }
        
    });
</script>

<script>
    function proccess_admin_login(user_name,password)
    {
        $.ajax({
           url: '<?=base_url('admin-login-auth')?>',
           type: 'post',
           data: {email:user_name,password:password},
           beforeSend: function(){
            $('#password-con').addClass('mb-3');
            $('#password-err').text('');
            $('#password').removeClass('is-invalid');
            
            $('#user-name-con').addClass('mb-3');
            $('#user-name-err').text('');
            $('#user-name').removeClass('is-invalid');
            
            $("#sign-btn-container").html('<div class="spinner-border text-danger text-right"></div>');
           },
           success: function(response){
            //console.log(response);  
            if(response=="account404")
            {
                $('#user-name-con').removeClass('mb-3');
                $('#user-name-err').text("Sorry,we couldn't find an account.");
                $('#user-name').addClass('is-invalid');
            }
            if(response=="ACC0")
            {
               $("#acc-deact-err").text("Account not active contact admin.!"); 
            }
            if(response=="WRONGPASS")
            {
                $('#password-con').removeClass('mb-3');
                $('#password-err').text('Password Wrong.*');
                $('#password').addClass('is-invalid');   
            }
            if(response=="logginSCS")
            {
               window.location.href = "<?=base_url('admin-dashboard')?>"; 
            }
           },
           complete:function(data){
             $("#sign-btn-container").html('<button type="button" class="btn btn-danger btn-sm" id="sign-in-btn">Sign In</button>');
           }
        });
    }
</script>
