<style>
.report-address{
    display:none;
}
</style>
<style>
    .report-address {
        display: none;
    }
    #progress-container {
        display: none;
        margin-top: 20px;
    } 
</style>

<?php 
    $admin_sess = $this->session->userdata('admin_session');
    $admin_id = $admin_sess['admin_id'];
    $department = $admin_sess['department'];
   
?>
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
              <li class="breadcrumb-item active">Add New Report</li>
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">New Report</h3>
              </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <label>Company Name :</label>
                                <div class="select2-danger">
                                    <select id="company_name" class="select2 form-control-sm" data-placeholder="Company Name." data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    <option value="">----Select Company----</option>
                                    <?php foreach($companies as $row){?>
                                    <option value="<?php echo $row->nameUrl?>"><?php echo $row->name?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                                <span class="text-danger font-weight-bold" id="company_name-err"></span>
                            </div>
                            
                            <div class="form-group">
                                <label>Contact Person :</label>
                                <div class="select2-danger">
                                    <select id="client" class="select2 form-control-sm" data-placeholder="Client Name." data-dropdown-css-class="select2-danger" style="width: 100%;">
                                      
                                    </select>
                                </div>
                                <span class="text-danger font-weight-bold" id="client-err"></span>
                            </div> 
                            <div class="form-group">
                                <label for="exampleInputEmail1">Report Date:</label>
                                <input type="date" class="form-control form-control-sm" id="report_date">
                                <span class="text-danger font-weight-bold" id="report_date-err"></span>
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputEmail1">Report Title :</label>
                                <input type="text" class="form-control form-control-sm" id="report_title">
                                <span class="text-danger font-weight-bold" id="report_title-err"></span>
                            </div>
                            <div class="form-group">
                                <label>Governorate  :</label>
                                <div class="select2-danger">
                                    <select id="governorate" class="select2 form-control-sm" data-placeholder="Select Governorate." data-dropdown-css-class="select2-danger" style="width: 100%;">
                                      <option value="">----Select Governorate----</option>
                                      <?php foreach($governorates as $row){?>
                                      <option value="<?php echo $row->nameUrl?>"><?php echo $row->name?></option>
                                      <?php } ?>
                                    </select>
                                </div>
                                <span class="text-danger font-weight-bold" id="governorate-err"></span>
                            </div> 
                            <div class="form-group">
                                <label>City :</label>
                                <select id="cities" class="select2 form-control-sm" data-id="1" data-placeholder="City." data-dropdown-css-class="select2-danger" style="width: 100%;">
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Country :</label>
                                <div class="select2-danger">
                                    <select id="country" class="select2 form-control-sm" data-placeholder="Company Name." data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    <option value="">----Select Country----</option>
                                    <?php foreach($country as $row){?>
                                    <option value="<?php echo $row->id?>"><?php echo $row->name?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                                <span class="text-danger font-weight-bold" id="country-err"></span>
                            </div>
                            
                            <div class="form-group report-address Address1">
                                <label for="exampleInputEmail1">Address-1 :</label>
                                <textarea class="form-control form-control-sm" id="address1"></textarea>
                                <span class="text-danger font-weight-bold" id="address1-err"></span>
                            </div>
                            <div class="form-group report-address Address1">
                                <label for="exampleInputEmail1">Address-2 :</label>
                                <textarea class="form-control form-control-sm" id="address2"></textarea>
                                <span class="text-danger font-weight-bold" id="address2-err"></span>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Client Email:</label>
                                <input type="text" class="form-control form-control-sm" id="client_email" value="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Client Ref No :</label>
                                <input type="text" class="form-control form-control-sm" id="client_ref_no">
                                <span class="text-danger font-weight-bold" id="client_ref_no-err"></span>
                            </div>
                            
                            <div class="form-group">
                                <label>Department :</label>
                                <div class="select2-danger">
                                    <select id="department" <?php echo(($admin_id != 2)?'disabled':'') ?> class="select2 form-control-sm" data-placeholder="Select Department." data-dropdown-css-class="select2-danger" style="width: 100%;">
                                      <option value="">----Select Department----</option>
                                      <?php foreach($departments as $row){?>
                                      <option value="<?php echo $row->id?>" <?php echo (($department == $row->id)?'selected':"") ?>><?php echo $row->name?></option>
                                      <?php } ?>
                                    </select>
                                </div>
                                <span class="text-danger font-weight-bold" id="department-err"></span>
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputFile">Report File : <span style="color:red">(Accept only PDF File)</span></label>
                                <div class="white-box">
                                    <input type="file" id="file" name="file" class="dropify" accept=".pdf" data-default-file="<?php echo base_url(); ?>uploads/<?php echo 'default-image.pdf'; ?>" /> 
                                </div>
                                <span class="text-danger font-weight-bold" id="file-err"></span>
                            </div>
                            
                        </div>
                        
                </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputFile">Access Permission : <span style="color:red"></span></label>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input checkbox" name="pdf_access" type="radio" value="1" id="pdf_access" checked />
                                        <label class="form-check-label" for="module2">Credential</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input checkbox" name="pdf_access" type="radio" value="2" id="pdf_access" />
                                        <label class="form-check-label" for="module2">Downloadable</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input checkbox" name="pdf_access" type="radio" value="3" id="pdf_access" />
                                        <label class="form-check-label" for="module2">Printable</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputFile">Client Feedback : <span style="color:red"></span></label>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input checkbox" name="client_feedback" type="radio" value="1" id="client_feedback" checked />
                                        <label class="form-check-label" for="module2">Allow Feedback</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input checkbox" name="client_feedback" type="radio" value="0" id="client_feedback" />
                                        <label class="form-check-label" for="module2">Not Allow Feedback</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>  
                </div>
                <div id="progress-container">
                    <div class="progress">
                        <div id="progress-bar" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
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
    $(function(){
        var dtToday = new Date();
        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();
        
        var maxDate = year + '-' + month + '-' + day;
        $('#report_date').attr('min', maxDate);
    });
  </script>
<script>
$(document).ready(function(){
    $(document).on('change','#cities',function(){
        var inputValue = $("#cities").attr("data-id");
        //var inputValue = $("#cities").val();
        console.log(inputValue)
        if(inputValue == 1){
            var targetBox = $(".Address"+inputValue);
            $(".report-address").not(targetBox).hide();
            $(targetBox).show();
        }
        else{
            $(".report-address").hide();
        }
        
    });
});

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
</script>  
  
<script>
  $(function () {
    $('.select2').select2()
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    $('#sortDescription').summernote({
      height: 100,
    });
    
    $('#arsortDescription').summernote({
      height: 100,
    });
    
    
  })
</script>


<script>
$(document).on('click', '#save-btn-custom', function() {
        var company_name = $('#company_name').val();
        var report_date = $('#report_date').val();
        var client = $('#client').val();
        var report_title = $('#report_title').val();
        var governorate = $('#governorate').val();
        var cities = $('#cities').val();
        var address1 = $('#address1').val();
        var address2 = $('#address2').val();
        //var giico_job_ref = $('#giico_job_ref').val();
        var pdf_access = $('input[name="pdf_access"]:checked').val();
        var client_feedback = $('input[name="client_feedback"]:checked').val();

        if (company_name == "" || client == "" || report_title == "" || governorate == "") {
            if (company_name == "") {
                $('#company_name').addClass('is-invalid');
                $('#company_name-err').text('Enter company name.*');
            } else {
                $('#company_name').removeClass('is-invalid');
                $('#company_name-err').text('');
            }
            if (client == "") {
                $('#client').addClass('is-invalid');
                $('#client-err').text('Enter Contact Person Name.*');
            } else {
                $('#client').removeClass('is-invalid');
                $('#client-err').text('');
            }
            if (report_title == "") {
                $('#report_title-ar').addClass('is-invalid');
                $('#report_title-err').text('Enter Report Title.*');
            } else {
                $('#report_title-ar').removeClass('is-invalid');
                $('#report_title-err').text('');
            }
            if (governorate == "") {
                $('#governorate-ar').addClass('is-invalid');
                $('#governorate-err').text('Select governorate.*');
            } else {
                $('#governorate-ar').removeClass('is-invalid');
                $('#governorate-err').text('');
            }
            return;
        }

        var baseUrl = '<?php echo base_url(); ?>';
        var fd = new FormData();
        var files = $('#file')[0].files[0];
        fd.append('file', files);
        fd.append('company_name', company_name);
        fd.append('report_date', report_date);
        fd.append('report_title', report_title);
        fd.append('client', client);
        fd.append('governorate', governorate);
        fd.append('cities', cities);
        fd.append('address1', address1);
        fd.append('address2', address2);
        //fd.append('giico_job_ref', giico_job_ref);
        fd.append('client_ref_no', $('#client_ref_no').val());
        fd.append('client_email', $('#client_email').val());
        fd.append('department', $('#department').val());
        fd.append('country', $('#country').val());
        fd.append('is_report_check_mark', pdf_access);
        fd.append('is_allow_feedback', client_feedback);

        $("#progress-container").show();
        $("#save-btn-conatiner").html('<div class="spinner-border text-danger text-right"></div>');

        $.ajax({
            url: baseUrl + "create-new-reports",
            type: "POST",
            data: fd,
            contentType: false,
            processData: false,
            dataType: "JSON",
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        $("#progress-bar").width(percentComplete + '%');
                        $("#progress-bar").html(percentComplete + '%');
                        $("#progress-bar").attr('aria-valuenow', percentComplete);
                    }
                }, false);
                return xhr;
            },
            success: function(jsonStr) {
                var res_data = JSON.stringify(jsonStr);
                var response = JSON.parse(res_data);
                var res_msg = response['responseData'];

                if (res_msg == 'new record inserted successfully') {
                    sessionStorage.setItem('saved', true);
                    window.location.href = baseUrl + 'reports';
                } else if (res_msg == 'already exist') {
                    $('#report_title').addClass('is-invalid');
                    $('#report_title-err').text('Report Name already Exist.*');
                } else if (res_msg == 'report type') {
                    $('#file').addClass('is-invalid');
                    $('#file-err').text('Report File Should be Pdf or CSV File*');
                } else if (res_msg == 'No file uploaded') {
                    $('#file').addClass('is-invalid');
                    $('#file-err').text('No file uploaded*');
                }
            },
            complete: function(data) {
                $("#progress-bar").width('100%');
                $("#progress-bar").html('100%');
                $("#progress-bar").attr('aria-valuenow', '100');
                $("#save-btn-conatiner").html('<button type="button" class="btn btn-danger" id="save-btn-custom">Save</button>');
            }
        });
    });

    $(document).on('click','#save-btn-custom11',function(){
        var company_name = $('#company_name').val();
        var report_date = $('#report_date').val();
        var client = $('#client').val();
        var report_title = $('#report_title').val();
        var governorate = $('#governorate').val();
        var cities = $('#cities').val();
        var address1 = $('#address1').val();
        var address2 = $('#address2').val();
        var giico_job_ref = $('#giico_job_ref').val();
        var pdf_access = $('input[name="pdf_access"]:checked').val();
        var client_feedback = $('input[name="client_feedback"]:checked').val();
        
        if(company_name=="")
        {
            $('#company_name').addClass('is-invalid');
            $('#company_name-err').text('Enter company name.*');
        }else{
            $('#company_name').removeClass('is-invalid');
            $('#company_name-err').text('');
        }
        if(client=="")
        {
            $('#client').addClass('is-invalid');
            $('#client-err').text('Enter Client Name.*');
        }else{
            $('#client').removeClass('is-invalid');
            $('#client-err').text('');
        }
        
        if(report_title=="")
        {
            $('#report_title-ar').addClass('is-invalid');
            $('#report_title-err').text('Enter Report Title.*');
        }else{
            $('#report_title-ar').removeClass('is-invalid');
            $('#report_title-err').text('');
        }
        if(governorate=="")
        {
            $('#governorate-ar').addClass('is-invalid');
            $('#governorate-err').text('Select governorate.*');
        }else{
            $('#governorate-ar').removeClass('is-invalid');
            $('#governorate-err').text('');
        }

        
        if(company_name!=""&&client!=""&&report_title!="" &&governorate!="")
        {
            var baseUrl = '<?php echo base_url(); ?>';
            var fd = new FormData();
            var files = $('#file')[0].files[0];
                
            fd.append('file',files);
            fd.append('company_name',company_name);
            fd.append('report_date',report_date);
            fd.append('report_title',report_title);
            fd.append('client',client);
            fd.append('governorate',governorate);
            fd.append('cities',cities);
            fd.append('address1',address1);
            fd.append('address2',address2);
            fd.append('giico_job_ref',giico_job_ref);
            
            fd.append('client_ref_no',$('#client_ref_no').val());
            fd.append('client_email',$('#client_email').val());
            fd.append('department',$('#department').val());
            fd.append('country',$('#country').val());
            fd.append('is_report_check_mark',pdf_access);
            fd.append('is_allow_feedback',client_feedback);

            $.ajax({
                url: baseUrl + "create-new-reports",
                type: "POST",
                data: fd,
                contentType: false,
                processData: false,
                dataType: "JSON",
                beforeSend: function(){
                $('#report_title').removeClass('is-invalid');
                $('#report_title-err').text('');
                
                $("#save-btn-conatiner").html('<div class="spinner-border text-danger text-right"></div>');
               },
                success: function(jsonStr) {
                  var res_data = JSON.stringify(jsonStr);
                  var response = JSON.parse(res_data);
                  var res_msg = response['responseData'];
                  
                  if ((res_msg != null) && (res_msg == 'new record inserted successfully')) 
                  {
                    sessionStorage.setItem('saved',true);
                    window.location.href = baseUrl+'reports';
                  } else if((res_msg != null) && (res_msg == 'already exist')) {
                    $('#report_title').addClass('is-invalid');
                    $('#report_title-err').text('Report Name already Exist.*');
                  }
                  else if((res_msg != null) && (res_msg == 'report type')) {
                    $('#file').addClass('is-invalid');
                    $('#file-err').text('Report File Should be Pdf or CSV File*');
                  }
                  else if((res_msg != null) && (res_msg == 'No file uploaded')) {
                    $('#file').addClass('is-invalid');
                    $('#file-err').text('No file uploaded*');
                  }
                },complete:function(data){
                 $("#save-btn-conatiner").html('<button type="button" class="btn btn-danger" id="save-btn-custom">Save</button>');
               }
            });
        }
        
    });
</script>

<script>
    $(document).on('change','#company_name',function(){
      get_contact_person();
    });

    $(document).ready(function(){
        $('#client').trigger('change');
    });
    $(document).on('change','#governorate',function(){
      get_cities();
      //get_brands();
    });
    $(document).on('change','#categories,#sub-categories',function(){
      get_child_categories();
    });
    $(document).on('change','#client',function(){
      get_email();
    });
    function get_email()
    {
      var client_id = $('#client').val();
      var fd = new FormData();
      fd.append('client_id',client_id);
      fd.append('id','');
      $.ajax({
          url:"<?php echo base_url()?>admin/admin/get_clients_email",
          type: "POST",
          data: fd,
          contentType: false,
          processData: false,
          dataType: "JSON",
          beforeSend: function(){},
          error: function (err) {},
          success: function(jsonStr,status) {      
            var res_data = JSON.stringify(jsonStr);
            var response = JSON.parse(res_data);
            var res = response['response'];
            $('#client_email').val(res);
          },complete:function(data){}
      });    
    }
    function get_cities()
    {
      var governorate = $('#governorate').val();
      var fd = new FormData();
      fd.append('governorate',governorate);
      fd.append('id','');
      $.ajax({
          url:"<?php echo base_url()?>admin/admin/get_cities",
          type: "POST",
          data: fd,
          contentType: false,
          processData: false,
          dataType: "JSON",
          beforeSend: function(){},
          error: function (err) {},
          success: function(jsonStr,status) {      
            var res_data = JSON.stringify(jsonStr);
            var response = JSON.parse(res_data);
            var res = response['response'];
            $('#cities').html(res);
            $('#cities').trigger('change');
          },complete:function(data){}
      });    
    }
    function get_contact_person()
    {
      var company_name = $('#company_name').val();
      var fd = new FormData();
      fd.append('company_name',company_name);
      fd.append('id','');
      $.ajax({
          url:"<?php echo base_url()?>admin/admin/get_contact_person",
          type: "POST",
          data: fd,
          contentType: false,
          processData: false,
          dataType: "JSON",
          beforeSend: function(){},
          error: function (err) {},
          success: function(jsonStr,status) {      
            var res_data = JSON.stringify(jsonStr);
            var response = JSON.parse(res_data);
            var res = response['response'];
           
            $('#client').html(res);
            $('#client').trigger('change');
          },complete:function(data){}
      });    
    }
    function get_child_categories()
    {
      var category = $('#categories').val();
      var subcategory = $('#sub-categories').val();
      var childcategory = $('#child-category').val();
      var fd = new FormData();
      fd.append('category',category);
      fd.append('sub_categories',subcategory);
      fd.append('child_category',childcategory);
      $.ajax({
          url:"<?php echo base_url()?>admin/admin/get_child_category",
          type: "POST",
          data: fd,
          contentType: false,
          processData: false,
          dataType: "JSON",
          beforeSend: function(){},
          error: function (err) {},
          success: function(jsonStr,status) {      
            var res_data = JSON.stringify(jsonStr);
            var response = JSON.parse(res_data);
            var res = response['response'];
            $('#child-category').html(res);
          },complete:function(data){}
      });    
    }
</script>
  
  
  