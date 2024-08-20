<style>
    .color-view {
      border: none;
      color: white;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
    }
    th { font-size: 13px; }
    td { font-size: 13px; }
</style>
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
              <li class="breadcrumb-item active">Reports History</li>
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
                <h3 class="card-title">Reports History</h3>
                <div class="row">
                
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="custom-data-table" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SR No.</th>
                    <th>Report Title</th>
                    <th>Giico Job Ref</th>
                    <th>Report Date</th>
                    <th class="text-center">Action</th>
                  </tr>
                  </thead>
                  <?php
                  $sr=0;
                  foreach($records as $row):
                  ?>
                  <tr id="row<?php echo $row->id?>">
                        <td><?php echo $sr=$sr+1?></td>
                        <td title="<?php echo $row->report_title;?>"><?php echo text_limit($row->report_title,15)?></td>
                        <td><?php echo $row->giico_job_ref.'-'.$row->update_times;?></td>
                        <td><?php echo $row->create_date;?></td>
                        
                        <td class="text-center">
                            <a href="<?php echo base_url('uploads/reports/').$row->report_doc?>" target="_blank" class="btn btn-info btn-sm">
                                <i class="fas fa-download"></i>
                            </a>
                            
                        </td>
                  </tr>
                  <?php endforeach?>
                  <tbody>
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
      "responsive": true, "lengthChange": true, "autoWidth": false,
    //   "buttons": ["excel", "pdf", "print"],
      'columnDefs': [ {
        'targets': [1,2,3], /* column index */
        'orderable': false, /* true or false */
     }]
    }).buttons().container().appendTo('#custom-data-table_wrapper .col-md-6:eq(0)');
  });
</script> 

