<style>
.report-address{
    display:none;
}
</style>
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
              <li class="breadcrumb-item active">Report</li>
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
                <h3 class="card-title">Report Details</h3>
              </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <img src="<?php echo base_url('images/').$record->qr_image; ?>" width="208px;" />
                            </div>
                            <div class="form-group">
                                <label>Company Name :</label>
                                <div class="select2-danger">
                                    <select disabled id="company_name" class="select2 form-control-sm" data-placeholder="Company Name." data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    <option value="">----Select Company----</option>
                                    <?php foreach($companies as $row){?>
                                    <option  value="<?php echo $row->nameUrl?>" <?php echo(($record->company == $row->nameUrl)?'selected':"") ?>><?php echo $row->name?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                                <span class="text-danger font-weight-bold" id="company_name-err"></span>
                            </div>
                            <div class="form-group">
                                <label>Contact Person :</label>
                                <div class="select2-danger">
                                    <select disabled id="client" class="select2 form-control-sm" data-placeholder="Client Name." data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    </select>
                                </div>
                                <span class="text-danger font-weight-bold" id="client-err"></span>
                            </div> 
                            <div class="form-group">
                                <label for="exampleInputEmail1">Report Date:</label>
                                <input type="date" class="form-control form-control-sm" id="report_date" value="<?php echo $record->report_date ?>" readonly>
                                <span class="text-danger font-weight-bold" id="report_date-err"></span>
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputEmail1">Report Title :</label>
                                <input type="text" class="form-control form-control-sm" id="report_title" value="<?php echo $record->report_title ?>" readonly>
                                <span class="text-danger font-weight-bold" id="report_title-err"></span>
                            </div>
                            <div class="form-group">
                                <label>Governorate  :</label>
                                <div class="select2-danger">
                                    <select id="governorate" class="select2 form-control-sm" data-placeholder="Select Governorate." data-dropdown-css-class="select2-danger" style="width: 100%;" disabled>
                                      <option value="">----Select Governorate----</option>
                                      <?php foreach($governorates as $row){?>
                                      <option value="<?php echo $row->nameUrl?>" <?php echo (($row->nameUrl==$record->governorateSlug)?'selected':'');?>><?php echo $row->name?></option>
                                      <?php } ?>
                                    </select>
                                </div>
                                <span class="text-danger font-weight-bold" id="governorate-err"></span>
                            </div> 
                            <div class="form-group report-address Address1">
                                <label for="exampleInputEmail1">Address-1 :</label>
                                <textarea class="form-control form-control-sm" id="address1" readonly><?php echo $record->address1 ?></textarea>
                                <span class="text-danger font-weight-bold" id="address1-err"></span>
                            </div>
                            <div class="form-group">
                                <label>Country :</label>
                                <div class="select2-danger">
                                    <select id="country" class="select2 form-control-sm" data-placeholder="Company Name." data-dropdown-css-class="select2-danger" style="width: 100%;" disabled>
                                    <option value="">----Select Country----</option>
                                    <?php foreach($country as $row){?>
                                    <option value="<?php echo $row->id?>" <?php echo (($row->id==$record->country)?'selected':'');?>><?php echo $row->name?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                                <span class="text-danger font-weight-bold" id="country-err"></span>
                            </div>
                            
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <label for="exampleInputFile">Report File : <span style="color:red">(Width:200px Height:150px)</span></label>
                                <div class="white-box">
                                    <input type="file" id="file" name="file" class="dropify" data-default-file="<?php echo base_url('uploads/').$record->report_doc; ?>" /> 
                                </div>
                                <span><a href="<?php echo base_url('uploads/reports/').$record->report_doc; ?>" target="_blank">Report View</a></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Giico Job Ref No :</label>
                                <input type="hidden" id="giico_job_ref" value="<?php echo $record->giico_job_ref ?>">
                                <input readonly type="text" class="form-control form-control-sm" value="<?php echo $record->giico_job_ref.(($record->update_times!=0)?'-':'').(($record->update_times!=0)?$record->update_times:'') ?>">
                                <span class="text-danger font-weight-bold" id="giico_job_ref-err"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Client Ref No :</label>
                                <input type="text" class="form-control form-control-sm" id="client_ref_no" value="<?php echo $record->client_ref_no ?>" readonly>
                                <span class="text-danger font-weight-bold" id="client_ref_no-err"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Client Email:</label>
                                <input type="text" class="form-control form-control-sm" id="client_email" value="<?php echo $record->client_email ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Department :</label>
                                <div class="select2-danger">
                                    <select id="department" class="select2 form-control-sm" data-placeholder="Select Department." data-dropdown-css-class="select2-danger" style="width: 100%;" disabled>
                                      <option value="">----Select Department----</option>
                                      <?php foreach($departments as $row){?>
                                      <option value="<?php echo $row->id?>" <?php echo (($row->id==$record->department_id)?'selected':'');?>><?php echo $row->name?></option>
                                      <?php } ?>
                                    </select>
                                </div>
                                <span class="text-danger font-weight-bold" id="department-err"></span>
                            </div>
                            <div class="form-group">
                                <label>City :</label>
                                <select id="cities" class="select2 form-control-sm" data-id="1" data-placeholder="City." data-dropdown-css-class="select2-danger" style="width: 100%;" disabled>
                                </select>
                            </div>
                            <div class="form-group report-address Address1">
                                <label for="exampleInputEmail1">Address-2 :</label>
                                <textarea class="form-control form-control-sm" id="address2" readonly><?php echo $record->address2 ?></textarea>
                                <span class="text-danger font-weight-bold" id="address2-err"></span>
                            </div>
                            
                            
                        </div>
                    </div>  
                    <div class="row d-none">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputFile">Access Permission : <span style="color:red"></span></label>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input checkbox" name="pdf_access" type="radio" value="1" id="pdf_access" <?php echo(($record->is_report_check_mark==1)?'checked':"") ?> />
                                        <label class="form-check-label" for="module2">Credential</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input checkbox" name="pdf_access" type="radio" value="2" id="pdf_access" <?php echo(($record->is_report_check_mark==2)?'checked':"") ?>/>
                                        <label class="form-check-label" for="module2">Downloadable</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input checkbox" name="pdf_access" type="radio" value="3" id="pdf_access" <?php echo(($record->is_report_check_mark==3)?'checked':"") ?> />
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
                                        <input class="form-check-input checkbox" name="client_feedback" type="radio" value="1" id="client_feedback" <?php echo(($record->is_allow_feedback == 1)?'checked':"") ?> />
                                        <label class="form-check-label" for="module2">Allow Feedback</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input checkbox" name="client_feedback" type="radio" value="0" id="client_feedback" <?php echo(($record->is_allow_feedback == 0)?'checked':"") ?> />
                                        <label class="form-check-label" for="module2">Not Allow Feedback</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if($record->is_allow_feedback==1){ ?>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Feedback Content:</label>
                        <textarea class="form-control" name="client_comment"  value="" id="client_comment"><?php echo $record->feedback ?></textarea>
                        <span class="text-danger font-weight-bold" id="client_comment-err"></span>
                    </div>
                    <?php } ?>
                </div>
                
                <?php if($record->is_allow_feedback==1){ ?>
                
                <div class="card-footer" id="save-btn-conatiner">
                    <button type="button" class="btn btn-danger" id="save-btn-custom">Send Request</button>
                </div>
                <?php } ?>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  
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
    $(document).on('click','#save-btn-custom',function(){
        var client_comment = $('#client_comment').val();
        
        if(client_comment=="")
        {
            $('#client_comment').addClass('is-invalid');
            $('#client_comment-err').text('Enter client comment to change.*');
        }else{
            $('#client_comment').removeClass('is-invalid');
            $('#client_comment-err').text('');
        }
        
        if(client_comment!="")
        {
            var baseUrl = '<?php echo base_url(); ?>';
            var fd = new FormData();
            
            fd.append('client_comment',client_comment);
            fd.append('id','<?php echo $record->id?>');

            $.ajax({
                url: baseUrl + "update-client-feedback",
                type: "POST",
                data: fd,
                contentType: false,
                processData: false,
                dataType: "JSON",
                beforeSend: function(){
                $('#client_comment').removeClass('is-invalid');
                $('#client_comment-err').text('');
                
                $("#save-btn-conatiner").html('<div class="spinner-border text-danger text-right"></div>');
               },
                success: function(jsonStr) {
                  var res_data = JSON.stringify(jsonStr);
                  var response = JSON.parse(res_data);
                  var res_msg = response['responseData'];
                  
                  if ((res_msg != null) && (res_msg == 'record updated successfully')) 
                  {
                    sessionStorage.setItem('updated',true);
                    window.location.href = baseUrl+'client-reports';
                  } else if((res_msg != null) && (res_msg == 'not done')) {
                    $('#client_comment').addClass('is-invalid');
                    $('#client_comment-err').text('Something Went Wrong.*');
                  }
                },complete:function(data){
                 $("#save-btn-conatiner").html('<button type="button" class="btn btn-danger" id="save-btn-custom">Save</button>');
               }
            });
        }
        
    });
</script>
<script>
    $(document).ready(function(){
        $('#governorate11').trigger('change'); 
    });
</script>
<script>
    $(document).ready(function(){
        $('#company_name').trigger('change');
    });
    $(document).ready(function(){
        $('#governorate').trigger('change');
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
    $(document).on('change','#company_name',function(){
      get_contact_person();
    });
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
    
</script>
  
  
  