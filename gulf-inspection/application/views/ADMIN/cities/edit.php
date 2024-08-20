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
              <li class="breadcrumb-item active">Edit City</li>
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
                <h3 class="card-title">Edit City</h3>
              </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name :</label>
                    <input type="text" class="form-control" id="name-en" placeholder="City Name.*" value="<?php echo $record->name?>">
                    <span class="text-danger font-weight-bold" id="name-err"></span>
                  </div>
                  
                  
                   <div class="form-group">
                      <label for="exampleInputPassword1">Governorate :</label>
                      <select class="form-control" id="governorate">
                          <option value="">select governorate</option>
                        <?php
                        foreach($governorates as $row):
                        ?>  
                        <option value="<?php echo $row->nameUrl;?>" <?php echo (($row->nameUrl==$record->governorateSlug)?'selected':'')?>><?php echo $row->name;?></option>  
                        <?php endforeach?>  
                      </select>
                      <span class="text-danger font-weight-bold" id="governorate-err"></span>
                    </div>
                    
                </div>
                <div class="card-footer" id="save-btn-conatiner">
                  <button type="button" class="btn btn-danger" id="save-btn-custom">Update</button>
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
    $(document).ready(function() 
    {
        $('.dropify').dropify();
    });
</script>

<script>
    $(document).on('click','#save-btn-custom',function(){
        var name = $('#name-en').val();
        var governorate = $('#governorate').val();
        
        if(governorate=="")
        {
            $('#governorate').addClass('is-invalid');
            $('#governorate-err').text('Select Governorate.*');
        }else{
            $('#governorate').removeClass('is-invalid');
            $('#governorate-err').text('');
        }
        
        if(name=="")
        {
            $('#name-en').addClass('is-invalid');
            $('#name-err').text('Enter City Name.*');
        }else{
            $('#name-en').removeClass('is-invalid');
            $('#name-err').text('');
        }
        
        if(name!=""&&governorate!="")
        {
            var baseUrl = '<?php echo base_url(); ?>';
            var fd = new FormData();
            fd.append('name',name);
            fd.append('governorate',governorate);
            fd.append('id',"<?php echo $record->id?>");
            $.ajax({
                url: baseUrl + "update-city",
                type: "POST",
                data: fd,
                contentType: false,
                processData: false,
                dataType: "JSON",
                beforeSend: function(){
                $('#name-en').removeClass('is-invalid');
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
                    window.location.href = baseUrl+'city-list';
                  } else if((responseData != null) && (responseData == 'already exist')) {
                    $('#name-en').addClass('is-invalid');
                    $('#name-err').text('Name already Exist.*');
                  }
                },complete:function(data){
                 $("#save-btn-conatiner").html('<button type="button" class="btn btn-danger" id="save-btn-custom">Update</button>');
               }
            });
        }
        
    });
</script>
  
  
  