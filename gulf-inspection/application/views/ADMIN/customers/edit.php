<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin-dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active">Edit Contact Person</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">New Contact Person</h3>
              </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Contact Person Name :</label>
                    <input type="text" class="form-control" id="name" placeholder="Client Name.*" value="<?php echo $record->customer_name ?>">
                    <span class="text-danger font-weight-bold" id="name-err"></span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email :</label>
                    <input type="text" class="form-control" id="email" placeholder="Email.*" value="<?php echo $record->email ?>">
                    <span class="text-danger font-weight-bold" id="email-err"></span>
                  </div>
                  <div class="form-group">
                    <label>Company Name :</label>
                      <div class="select2-danger">
                          <select id="company_name" class="select2 form-control-sm" data-placeholder="Company Name." data-dropdown-css-class="select2-danger" style="width: 100%;">
                            <option value="">----Select Company----</option>
                            <?php foreach($companies as $row){?>
                            <option value="<?php echo $row->nameUrl?>" <?php echo (($row->nameUrl==$record->company)?'selected':'');?>><?php echo $row->name?></option>
                            <?php } ?>
                          </select>
                      </div>
                      <span class="text-danger font-weight-bold" id="company_name-err"></span>
                  </div> 
                  <div class="form-group">
                    <label for="exampleInputEmail1">Phone :</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone.*" value="<?php echo $record->mobile_number ?>">
                    <span class="text-danger font-weight-bold" id="phone-err"></span>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputFile">Profile Image :</label>
                    <div class="white-box">
                        <input type="file" id="file" name="file" class="dropify" data-default-file="<?php echo base_url(); ?>uploads/clients/<?php echo $record->image; ?>" /> 
                    </div>
                  </div>
                </div>
                <div class="card-footer" id="save-btn-conatiner">
                  <button type="button" class="btn btn-danger" id="save-btn-custom">Save</button>
                </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  
  
<script>
    document.querySelectorAll('input[type="number"]').forEach(input=>{
        input.oninput = () =>{
            if(input.value.length > input.maxLength) input.value = input.value.slice(0,input.maxLength);
        }
    })
</script>   
<script>
    $(document).ready(function() 
    {
        $('.dropify').dropify();
    });

    $(function () {
      $('.select2').select2()
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
        $('#description').summernote({
          height: 200,
        });
        
        $('#arpostDescription').summernote('justifyRight');
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
                $('#name-err').text('Enter Contact Person Name.*').fadeIn(1000).delay(3000).fadeOut("slow");;
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
            // }else if(phone.length!=10){
            //     $('#phone').addClass('is-invalid');
            //     $('#phone-err').text('Enter 10 Digit Phone.*').fadeIn(1000).delay(3000).fadeOut("slow");;
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
                url: baseUrl + "update-contact-person-record",
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
                    window.location.href = baseUrl+'contact-person';
                  } else if((responseData != null) && (responseData == 'email already exist')) {
                    $('#email').addClass('is-invalid');
                    $('#email-err').text('Contact Person Email already Exist.*');
                  }
                },complete:function(data){
                 $("#save-btn-conatiner").html('<button type="button" class="btn btn-danger" id="save-btn-custom">Save</button>');
               }
            });
        }
        
    });
</script>
  
  
  