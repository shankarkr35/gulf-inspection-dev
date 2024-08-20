<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Welcome To Client Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('client-dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        
        <div class="row">
          <div class="col-md-12">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Client Profile</h3>
              </div>
                <div class="card-body">
                    <div class='row'>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name :</label>
                                <input type="text" class="form-control" id="name" placeholder="Client Name.*" value="<?php echo $record->customer_name ?>">
                                <span class="text-danger font-weight-bold" id="name-err"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email :</label>
                                <input type="text" class="form-control" id="email" placeholder="Email.*" value="<?php echo $record->email ?>">
                                <span class="text-danger font-weight-bold" id="email-err"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Company Name :</label>
                                <input type="text" class="form-control" id="company_name" placeholder="Company Name.*" value="<?php echo $record->company_name ?>">
                                <span class="text-danger font-weight-bold" id="company_name-err"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone :</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone.*" value="<?php echo $record->mobile_number ?>">
                                <span class="text-danger font-weight-bold" id="phone-err"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputFile">Profile Image :</label>
                                <div class="white-box">
                                    <input type="file" id="file" name="file" class="dropify" data-default-file="<?php echo base_url(); ?>uploads/clients/<?php echo $record->image; ?>" /> 
                                </div>
                            </div>
                        </div>
                    </div>
                  
                </div>
                <div class="card-footer" id="save-btn-conatiner">
                  <button type="button" class="btn btn-danger" id="save-btn-custom">Update Profile</button>
                </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script>
    $(document).ready(function() 
    {
        $('.dropify').dropify();
    });
</script>

<script>
    $(document).on('click','#save-btn-custom',function(){
        const reg_email = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;
            var name = $('#name').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
           
            if(name=="")
            {
                $('#name').addClass('is-invalid');
                $('#name-err').text('Enter Customer Name.*').fadeIn(1000).delay(3000).fadeOut("slow");;
            }else{
                $('#name').removeClass('is-invalid');
                $('#name-err').text('');
            }
            if(email=="")
            {
                $('#email').addClass('is-invalid');
                $('#email-err').text('Enter Email.*').fadeIn(1000).delay(3000).fadeOut("slow");;
            }else if(!reg_email.test(email)){
                $('#email').addClass('is-invalid'); 
                $('#email-err').text('Enter valid email address.*').fadeIn(1000).delay(3000).fadeOut("slow");;
                 
            }else{
                $('#email').removeClass('is-invalid');
                $('#email-err').text('');
            }
            if(phone=="")
            {
                $('#phone').addClass('is-invalid');
                $('#phone-err').text('Enter Phone.*').fadeIn(1000).delay(3000).fadeOut("slow");
            }else{
                $('#phone').removeClass('is-invalid');
                $('#phone-err').text('');
            }
            
            if(name!="" && email!="" &&reg_email.test(email) && phone!="")
            {
            var baseUrl = '<?php echo base_url(); ?>';
            var fd = new FormData();
            var files = $('#file')[0].files[0];
                
            fd.append('file',files);
            fd.append('name',name);
            fd.append('email',email);
            fd.append('phone',phone);
            fd.append('company_name',$("#company_name").val());
            fd.append('id',"<?php echo $record->id ?>");
            fd.append('current_image',"<?php echo $record->image ?>");
            $.ajax({
                url: baseUrl + "update-client",
                type: "POST",
                data: fd,
                contentType: false,
                processData: false,
                dataType: "JSON",
                beforeSend: function(){
                $('#name').removeClass('is-invalid');
                $('#name-err').text('');
                
                $("#save-btn-conatiner").html('<div class="spinner-border text-danger text-right"></div>');
               },
                success: function(jsonStr) {
                  var res_data = JSON.stringify(jsonStr);
                  var response = JSON.parse(res_data);
                  var responseData = response['responseData'];
                  if ((responseData != null) && (responseData == 'record updated successfully')) 
                  {
                    sessionStorage.setItem('updated',true);
                    window.location.href = baseUrl+'client-dashboard';
                  } else if((responseData != null) && (responseData == 'email already exist')) {
                    $('#email').addClass('is-invalid');
                    $('#email-err').text('Email already Exist.*');
                  }
                },complete:function(data){
                 $("#save-btn-conatiner").html('<button type="button" class="btn btn-danger" id="save-btn-custom">Save</button>');
               }
            });
        }
        
    });
</script>
  

<script>
    $(function(){
        
        if ( sessionStorage.getItem('updated') ) {
           swal({
              title: "Data Updated.",
              text: "Data Details updated successfully.!",
              type: "success",
              confirmButtonClass: 'btn-primary btn-sm',
              confirmButtonText: 'OK'
            });
            sessionStorage.removeItem('updated');
        }
        
    });
</script>
 

  

  
