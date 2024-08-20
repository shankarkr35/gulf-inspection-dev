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
              <li class="breadcrumb-item active">Add New Page</li>
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
                <h3 class="card-title">New Page</h3>
              </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Page Title (English) :</label>
                    <input type="text" class="form-control" id="name-en" placeholder="Page Title (English).*">
                    <span class="text-danger font-weight-bold" id="name-err"></span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Page Title (Arabic) :</label>
                    <input type="text" class="form-control arabic-input" id="name-ar" placeholder="Page Title (Arabic).*">
                    <span class="text-danger font-weight-bold" id="ar_name-err"></span>
                  </div>
                   <div class="form-group">
                      <label for="postDescription">Description (en)</label>
                      <textarea id="postDescription" name="postDescription" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="postDescription">Description (ar)</label>
                      <textarea id="arpostDescription" name="arpostDescription" class="form-control arabic-input" rows="3"></textarea>
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
  $(function () {
    $('#postDescription').summernote({
      height: 350,
    });
    $('#arpostDescription').summernote({
      height: 350
    });
    $('#arpostDescription').summernote('justifyRight');
  })
</script>

<script>
    $(document).on('click','#save-btn-custom',function(){
        var name = $('#name-en').val();
        var ar_name = $('#name-ar').val();
        if(name=="")
        {
            $('#name-en').addClass('is-invalid');
            $('#name-err').text('Enter Page english Title.*');
        }else{
            $('#name-en').removeClass('is-invalid');
            $('#name-err').text('');
        }
        
        if(ar_name=="")
        {
            $('#name-ar').addClass('is-invalid');
            $('#ar_name-err').text('Enter Page Arabic Title.*');
        }else{
            $('#name-ar').removeClass('is-invalid');
            $('#ar_name-err').text('');
        }
        
        if(name!=""&&ar_name!="")
        {
            var baseUrl = '<?php echo base_url(); ?>';
            var fd = new FormData();
            fd.append('en_desc',$('#postDescription').val());
            fd.append('ar_desc',$('#arpostDescription').val());
            fd.append('name',name);
            fd.append('ar_name',ar_name);
            $.ajax({
                url: baseUrl + "create-new-page",
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
                  if ((responseData != null) && (responseData == 'new record inserted successfully')) 
                  {
                    sessionStorage.setItem('saved',true);
                    window.location.href = baseUrl+'pages-list';
                  } else if((responseData != null) && (responseData == 'page name already exist')) {
                    $('#name-en').addClass('is-invalid');
                    $('#name-err').text('Page Name already Exist.*');
                  }
                },complete:function(data){
                 $("#save-btn-conatiner").html('<button type="button" class="btn btn-danger" id="save-btn-custom">Save</button>');
               }
            });
        }
        
    });
</script>
  
  
  