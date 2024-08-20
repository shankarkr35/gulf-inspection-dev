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
              <li class="breadcrumb-item active">Add New User</li>
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
                <h3 class="card-title">New User</h3>
              </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name :</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter Name.*">
                    <span class="text-danger font-weight-bold" id="name-err"></span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email :</label>
                    <input type="text" class="form-control" id="email" placeholder="Enter Email.*">
                    <span class="text-danger font-weight-bold" id="email-err"></span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Password :</label>
                    <input type="text" class="form-control" id="password" placeholder="Password.*">
                    <span class="text-danger font-weight-bold" id="password-err"></span>
                  </div>
                  <div class="form-group">
                    <label>Department :</label>
                        <div class="select2-danger">
                            <select id="department" class="select2 form-control-sm" data-placeholder="Select Department." data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option value="">----Select Department----</option>
                                <?php foreach($departments as $row){?>
                                <option value="<?php echo $row->id?>"><?php echo $row->name?></option>
                                      <?php } ?>
                            </select>
                        </div>
                    <span class="text-danger font-weight-bold" id="department-err"></span>
                </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Phone :</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone.*">
                    <span class="text-danger font-weight-bold" id="phone-err"></span>
                  </div>
                  
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Permissions</h4>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input checkbox" name="modules[]" type="checkbox" value="1" id="module1" autocomplete="off" />
                                <label class="form-check-label" for="module1">Users</label>
                            </div>
                            <div id="permissions1" class="permissions" style="display:none;">
                                <label><input type="checkbox" name="permissions[1][read]" value="1"> Read</label>
                                <label><input type="checkbox" name="permissions[1][write]" value="1"> Write</label>
                                <label><input type="checkbox" name="permissions[1][delete]" value="1"> Delete</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input checkbox" name="modules[]" type="checkbox" value="2" id="module2" autocomplete="off" />
                                <label class="form-check-label" for="module2">Clients</label>
                            </div>
                            <div id="permissions2" class="permissions" style="display:none;">
                                <label><input type="checkbox" name="permissions[2][read]" value="1"> Read</label>
                                <label><input type="checkbox" name="permissions[2][write]" value="1"> Write</label>
                                <label><input type="checkbox" name="permissions[2][delete]" value="1"> Delete</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input checkbox" name="modules[]" type="checkbox" value="3" id="module3" autocomplete="off" />
                                <label class="form-check-label" for="module3">Governorates</label>
                            </div>
                            <div id="permissions3" class="permissions" style="display:none;">
                                <label><input type="checkbox" name="permissions[3][read]" value="1"> Read</label>
                                <label><input type="checkbox" name="permissions[3][write]" value="1"> Write</label>
                                <label><input type="checkbox" name="permissions[3][delete]" value="1"> Delete</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input checkbox" name="modules[]" type="checkbox" value="4" id="module4" autocomplete="off" />
                                <label class="form-check-label" for="module4">City</label>
                            </div>
                            <div id="permissions4" class="permissions" style="display:none;">
                                <label><input type="checkbox" name="permissions[4][read]" value="1"> Read</label>
                                <label><input type="checkbox" name="permissions[4][write]" value="1"> Write</label>
                                <label><input type="checkbox" name="permissions[4][delete]" value="1"> Delete</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input checkbox" name="modules[]" type="checkbox" value="5" id="module5" autocomplete="off" />
                                <label class="form-check-label" for="module5">Departments</label>
                            </div>
                            <div id="permissions5" class="permissions" style="display:none;">
                                <label><input type="checkbox" name="permissions[5][read]" value="1"> Read</label>
                                <label><input type="checkbox" name="permissions[5][write]" value="1"> Write</label>
                                <label><input type="checkbox" name="permissions[5][delete]" value="1"> Delete</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input checkbox" name="modules[]" type="checkbox" value="6" id="module6" autocomplete="off" />
                                <label class="form-check-label" for="module6">Reports</label>
                            </div>
                            <div id="permissions6" class="permissions" style="display:none;">
                                <label><input type="checkbox" name="permissions[6][read]" value="1"> Read</label>
                                <label><input type="checkbox" name="permissions[6][write]" value="1"> Write</label>
                                <label><input type="checkbox" name="permissions[6][delete]" value="1"> Delete</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input checkbox" name="modules[]" type="checkbox" value="7" id="module7" autocomplete="off" />
                                <label class="form-check-label" for="module6">Company</label>
                            </div>
                            <div id="permissions7" class="permissions" style="display:none;">
                                <label><input type="checkbox" name="permissions[7][read]" value="1"> Read</label>
                                <label><input type="checkbox" name="permissions[7][write]" value="1"> Write</label>
                                <label><input type="checkbox" name="permissions[7][delete]" value="1"> Delete</label>
                            </div>
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
document.querySelectorAll('.form-check-input.checkbox').forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
        var moduleId = this.value;
        var permissionsDiv = document.getElementById('permissions' + moduleId);
        if (this.checked) {
            permissionsDiv.style.display = 'block';
        } else {
            permissionsDiv.style.display = 'none';
        }
    });
});
</script>
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
        $('.select2').select2()
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        });
        $('.dropify').dropify();
    });

    $(function () {
        $('#description').summernote({
          height: 200,
        });
        
        $('#arpostDescription').summernote('justifyRight');
    });
</script>

<script>
    $(document).ready(function(){
    $(document).on('click','#save-btn-custom',function(){
        const reg_email = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;
            var name = $('#name').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var password = $('#password').val();
            var department = $("#department").val();
            
            if(name=="")
            {
                $('#name').addClass('is-invalid');
                $('#name-err').text('Enter User Name.*').fadeIn(1000).delay(3000).fadeOut("slow");;
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
            if(password=="")
            {
                $('#password').addClass('is-invalid');
                $('#password-err').text('Enter Password.*').fadeIn(1000).delay(3000).fadeOut("slow");;
            }else if(password.length < 6){
                $('#password').addClass('is-invalid');
                $('#password-err').text("Pasword should be greater than 6 digit").css('font-style','italic').fadeIn(1000).delay(3000).fadeOut("slow");;     
            }else{
                $('#password').removeClass('is-invalid');
                $('#password-err').text('');
            }
            if(department=="")
            {
                $('#department').addClass('is-invalid');
                $('#department-err').text('Select department.*').fadeIn(1000).delay(3000).fadeOut("slow");;
            }else{
                $('#department').removeClass('is-invalid');
                $('#department-err').text('');
            }
            if(name!="" && department!="" && email!="" &&reg_email.test(email) && phone!="" && password!="" &&password.length>=6)
            {
            var baseUrl = '<?php echo base_url(); ?>';
            var fd = new FormData();
            
            fd.append('name',name);
            fd.append('email',email);
            fd.append('phone',phone);
            fd.append('password',password);
            fd.append('department',department);
            // Append module and permission data
            $("input[name='modules[]']:checked").each(function() {
                var moduleId = $(this).val();
                fd.append('modules[]', moduleId);
    
                $("input[name='permissions[" + moduleId + "][read]']:checked").each(function() {
                    fd.append('permissions[' + moduleId + '][read]', 1);
                });
    
                $("input[name='permissions[" + moduleId + "][write]']:checked").each(function() {
                    fd.append('permissions[' + moduleId + '][write]', 1);
                });
    
                $("input[name='permissions[" + moduleId + "][delete]']:checked").each(function() {
                    fd.append('permissions[' + moduleId + '][delete]', 1);
                });
            });
            
            $.ajax({
                url: baseUrl + "create-new-user",
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
                  if ((responseData != null) && (responseData == 'new record inserted successfully')) 
                  {
                    sessionStorage.setItem('saved',true);
                    window.location.href = baseUrl+'user-list';
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
});
</script>
  
  
  