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
                        <li class="breadcrumb-item active">Edit User</li>
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
                                <input type="text" class="form-control" id="name" placeholder="Enter Name.*" value="<?php echo $record->name ?>">
                                <span class="text-danger font-weight-bold" id="name-err"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email :</label>
                                <input type="text" class="form-control" id="email" placeholder="Enter Email.*" value="<?php echo $record->email ?>">
                                <span class="text-danger font-weight-bold" id="email-err"></span>
                            </div>
                            <div class="form-group">
                                <label>Department :</label>
                                <div class="select2-danger">
                                    <select id="department" class="select2 form-control-sm" data-placeholder="Select Department." data-dropdown-css-class="select2-danger" style="width: 100%;">
                                      <option value="">----Select Department----</option>
                                      <?php foreach($departments as $row){?>
                                      <option value="<?php echo $row->id?>" <?php echo (($row->id==$record->department)?'selected':'');?>><?php echo $row->name?></option>
                                      <?php } ?>
                                    </select>
                                </div>
                                <span class="text-danger font-weight-bold" id="department-err"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone :</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone.*" value="<?php echo $record->phone ?>">
                                <span class="text-danger font-weight-bold" id="phone-err"></span>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Permissions</h4>
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <?php
                                $modules = [
                                    1 => 'Users',
                                    2 => 'Clients',
                                    3 => 'Governorates',
                                    4 => 'City',
                                    5 => 'Departments',
                                    6 => 'Reports',
                                    7 => 'Company'
                                ];
                                foreach ($modules as $module_id => $module_name) {
                                    $is_checked = isset($permissions[$module_id]) ? 'checked' : '';
                                    $read_checked = isset($permissions[$module_id]['read']) && $permissions[$module_id]['read'] ? 'checked' : '';
                                    $write_checked = isset($permissions[$module_id]['write']) && $permissions[$module_id]['write'] ? 'checked' : '';
                                    $delete_checked = isset($permissions[$module_id]['delete']) && $permissions[$module_id]['delete'] ? 'checked' : '';
                                    $permit_id = isset($permissions[$module_id]['permit_id']) ? $permissions[$module_id]['permit_id'] : '';
                                    ?>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input checkbox" name="modules[]" type="checkbox" value="<?php echo $module_id ?>" id="module<?php echo $module_id ?>" autocomplete="off" <?php echo $is_checked ?> />
                                            <label class="form-check-label" for="module<?php echo $module_id ?>"><?php echo $module_name ?></label>
                                        </div>
                                        <div id="permissions<?php echo $module_id ?>" class="permissions" style="display:<?php echo $is_checked ? 'block' : 'none'; ?>;">
                                            <label><input type="checkbox" name="permissions[<?php echo $module_id ?>][read]" value="1" <?php echo $read_checked ?>> Read</label>
                                            <label><input type="checkbox" name="permissions[<?php echo $module_id ?>][write]" value="1" <?php echo $write_checked ?>> Write</label>
                                            <label><input type="checkbox" name="permissions[<?php echo $module_id ?>][delete]" value="1" <?php echo $delete_checked ?>> Delete</label>
                                            <input style="display:none;" type="checkbox" class="permit_id" name="permissions[<?php echo $module_id ?>][permit_id]" <?php echo (($permit_id)?'checked':'') ?> value="<?php echo $permit_id ?>"   disabled>
                                        </div>
                                    </div><br>
                                <?php } ?>
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
            }else{
                $('#phone').removeClass('is-invalid');
                $('#phone-err').text('');
            }
            if(department=="")
            {
                $('#department').addClass('is-invalid');
                $('#department-err').text('Select department.*').fadeIn(1000).delay(3000).fadeOut("slow");;
            }else{
                $('#department').removeClass('is-invalid');
                $('#department-err').text('');
            }
            
            if(name!="" && department!="" && email!="" &&reg_email.test(email) && phone!="")
            {
           
            var baseUrl = '<?php echo base_url(); ?>';
            var fd = new FormData();
            
            fd.append('name',name);
            fd.append('email',email);
            fd.append('phone',phone);
            fd.append('id',"<?php echo $record->id ?>");
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
                // Append permit_id
                var permit_id = $("#permissions" + moduleId + " .permit_id").val();
                fd.append('permissions[' + moduleId + '][permit_id]', permit_id);
                
            });
            
            $.ajax({
                url: baseUrl + "update-user",
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
                        window.location.href = baseUrl+'user-list';
                     }else if((responseData != null) && (responseData == 'email already exist')) {
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
  
  
  