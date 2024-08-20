<?php
    $permissions = $this->session->userdata('permissions');
?>
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin-dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active">Contact Person List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <?php if(!empty($success_msg)){ ?>
            <div class="col-xs-12">
                <div class="alert alert-success"><?php echo $success_msg; ?></div>
            </div>
            <?php }if(!empty($error_msg)){ ?>
            <div class="col-xs-12">
                <div class="alert alert-danger"><?php echo $error_msg; ?></div>
            </div>
            <?php } ?>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Contact Person List</h3>
                <div class="row">
                <!-- Import link -->
                <div class="col-md-12 head">
                    <div class="float-right">
                        <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');" <?php echo (isset($permissions[2]['write']) && !$permissions[2]['write'] ? 'disabled style="pointer-events: none; cursor: not-allowed;"' : '') ?>><i class="plus"></i> Import</a>
                        <span><a href="<?php echo base_url('csv_file/Gulf_Inspection_New.csv') ?>" download>Sample</a></span>
                    </div>
                    
                </div>
        		
                <!-- File upload form -->
                <div class="col-md-12" id="importFrm" style="display: none;">
                    <form action="<?php echo base_url('admin/admin/client_import'); ?>" method="post" enctype="multipart/form-data">
                        <input type="file" name="file" />
                        <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
                    </form>
                    
                </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="custom-data-table" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="w-20">SR No.</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Mobile Number</th>
                    <th>Email</th>
                    <th>Company Name</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>  
                  <?php
                  $sr=0;
                  foreach($customers as $row):
                  ?>
                    <tr id="row<?php echo $row->id?>">
                        <td><?php echo $sr=$sr+1?></td>
                        <td><img src="<?php echo base_url('uploads/clients/').(($row->image)?$row->image:"logo.jpg") ?>" height="45px"></img></td>
                        <td><?php echo $row->customer_name ?></td>
                        <td><?php echo $row->mobile_number?></td>
                        <td><?php echo $row->email?></td>
                        <td><?php echo $row->company_name?></td>
                        <td>
                            <select class="form-control form-control-sm status-change" id="<?php echo $row->id?>" <?php echo (isset($permissions[2]['write']) && !$permissions[2]['write'] ? 'disabled style="pointer-events: none; cursor: not-allowed;"' : '') ?>>
                                <option value="1" <?php echo (($row->status==1)?'selected':'')?> >Published</option>
                                <option value="0" <?php echo (($row->status==0)?'selected':'')?>>Draft</option>
                            </select>
                        </td>
                        <td>
                            <a href="<?php echo base_url('edit-contact-person/').$row->id?>" class="btn btn-info btn-sm" <?php echo (isset($permissions[2]['write']) && !$permissions[2]['write'] ? 'disabled style="pointer-events: none; cursor: not-allowed;"' : '') ?>><i class="fas fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm d-none" onclick="checkdelete(<?php echo $row->id?>)" <?php echo (isset($permissions[2]['delete']) && !$permissions[2]['delete'] ? 'disabled style="pointer-events: none; cursor: not-allowed;"' : '') ?>><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                  <?php endforeach?>
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<script>
    function formToggle(ID){
        var element = document.getElementById(ID);
        if(element.style.display === "none"){
            element.style.display = "block";
        }else{
            element.style.display = "none";
        }
    }
</script> 
<script>
  $(function () {
    $("#custom-data-table").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["excel", "pdf", "print"],
      'columnDefs': [ {
        'targets': [1,2,3,4,5,6], /* column index */
        'orderable': false, /* true or false */
     }]
    }).buttons().container().appendTo('#custom-data-table_wrapper .col-md-6:eq(0)');
  });
</script>
<script>
    $(document).ready(function(){
        var html='';
            html+='<div class="" id="action-btns" style="display: contents;">';
            html+='<button type="button" <?php echo (isset($permissions[2]['write']) && !$permissions[2]['write'] ? 'disabled style="pointer-events: none; cursor: not-allowed;"' : '') ?> title="add new user" class="ml-1 btn btn-outline-success btn-sm cust-btns" id="add-new-btn">New <i class="fas fa-plus-circle"></i></button>';
            html+='</div>';
        $("#custom-data-table_filter").append(html);
    });
    
    $(document).on('click','#add-new-btn',function(){
        const base_url = "<?php echo base_url()?>"; 
        window.location.replace(base_url+"add-new-contact-person");
    });
</script> 
 

<script>
    $(function(){
        
        if ( sessionStorage.getItem('statusupdated') ) {
           swal({
              title: "Status Updated.",
              text: "Status updated successfully.!",
              type: "success",
              confirmButtonClass: 'btn-primary btn-sm',
              confirmButtonText: 'OK'
            });
            sessionStorage.removeItem('statusupdated');
        }
        
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
        
        if ( sessionStorage.getItem('saved') ) {
           swal({
              title: "New Data Added",
              text: "Data added successfully.!",
              type: "success",
              confirmButtonClass: 'btn-primary btn-sm',
              confirmButtonText: 'OK'
            });
            sessionStorage.removeItem('saved');
        }
    });
</script>

<script>
    function checkdelete(id)
   {
       swal({
          title: "Are you sure.?",
          text: "You want to delete this record.",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: 'btn-danger btn-sm',
          cancelButtonClass: 'btn-dark btn-sm',
          confirmButtonText: 'Yes, delete it!',
          closeOnConfirm: false
        },
        function(){
              $.post("<?=base_url('delete-record-from')?>",
              {
                id:id,
                table:'customers'
              },
              function(data, status){
                 if(data=="deleted")
                 {
                     $("#row"+id).remove();
                     swal({
                      title: "Deleted.",
                      text: "Record has been deleted successfully.!",
                      type: "success",
                      confirmButtonClass: 'btn-primary btn-sm',
                      confirmButtonText: 'OK'
                    });
                 }
              });
        });
   }
</script>

<script>
    $(document).on('change','.status-change',function(){
        const id = $(this).attr('id');
        const status = $(this).val();
        $.post("<?=base_url('status-management')?>",
          {
            id:id,
            table:'customers',
            status:status
          },
          function(data, status){
            if(data=="updated")
            {   
                $(this).val(status);
                 swal({
                  title: "Status Updated.",
                  text: "Status Updated successfully.!",
                  type: "success",
                  confirmButtonClass: 'btn-primary btn-sm',
                  confirmButtonText: 'OK'
                });
            }
        });
    });
</script>