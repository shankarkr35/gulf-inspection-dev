<?php
    $url = $this->uri->segment(1);
    $permissions = $this->session->userdata('permissions');
    //echo"<pre>";print_r($permissions);die;
?>

<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url('admin-dashboard')?>" class="brand-link">
      <img src="<?php echo base_url('assets/admin/')?>images/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><b>Gulf-Inspection Dashboard</b></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url('assets/admin/')?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Gulf-Inspection</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="<?php echo base_url('admin-dashboard')?>" class="nav-link <?php echo (($url=="admin-dashboard")?'active':'')?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <?php if (isset($permissions[1]['read']) && $permissions[1]['read']): ?>
          <li class="nav-item">
            <a href="<?php echo base_url('user-list')?>" class="nav-link <?php echo (($url=="user-list"||$url=="edit-user"||$url=="add-new-user")?'active':'')?>">
              <i class="nav-icon fas fa-users"></i>
              <p>Users</p>
            </a>
          </li>
          <?php endif; ?>
          <?php if (isset($permissions[2]['read']) && $permissions[2]['read']): ?>
          <li class="nav-item">
            <a href="<?php echo base_url('contact-person')?>" class="nav-link <?php echo (($url=="contact-person"||$url=="edit-contact-person"||$url=="add-new-contact-person")?'active':'')?>">
              <i class="nav-icon fas fa-users"></i>
              <p>Contact Person</p>
            </a>
          </li>
          <?php endif; ?>
          <li class="nav-item ">
            <a href="" class="nav-link <?php echo (($url=="edit-sub-category"||$url=="add-new-sub-category"||$url=="sub-categories-list"||$url=="governorate-list"||$url=="add-new-governorate"||$url=="edit-governorate")?'active':'')?>">
              <i class="fas fa-code-branch nav-icon"></i>
              <p>
                Governorates/City
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if (isset($permissions[3]['read']) && $permissions[3]['read']): ?>
              <li class="nav-item">
                <a href="<?php echo base_url('governorate-list')?>" class="nav-link <?php echo (($url=="edit-governorate"||$url=="governorate-list"||$url=="add-new-governorate")?'active':'')?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Governorates</p>
                </a>
              </li>
              <?php endif; ?>
              <?php if (isset($permissions[4]['read']) && $permissions[4]['read']): ?>
              <li class="nav-item">
                <a href="<?php echo base_url('city-list')?>" class="nav-link <?php echo (($url=="edit-city"||$url=="add-new-city"||$url=="city-list")?'active':'')?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>City</p>
                </a>
              </li>
              <?php endif; ?>
            </ul> 
          </li>
          <?php if (isset($permissions[5]['read']) && $permissions[5]['read']): ?>
          <li class="nav-item" style="display:" >
            <a href="<?php echo base_url('departments')?>" class="nav-link <?php echo (($url=="departments"||$url=="add-new-departments"||$url=="edit-departments")?'active':'')?>">
              <i class="fas fa-globe-asia nav-icon"></i>
              <p>
                Departments
              </p>
            </a>
          </li>
          <?php endif; ?>
          <?php if (isset($permissions[6]['read']) && $permissions[6]['read']): ?>
          <li class="nav-item" style="display:" >
            <a href="<?php echo base_url('reports')?>" class="nav-link <?php echo (($url=="reports"||$url=="add-new-reports"||$url=="report-details" ||$url=="edit-reports" ||$url=="report-history")?'active':'')?>">
              <i class="fas fa-globe-asia nav-icon"></i>
              <p>
                Reports
              </p>
            </a>
          </li>
          <?php endif; ?>

          <?php if (isset($permissions[7]['read']) && $permissions[7]['read']): ?>
          <li class="nav-item" style="display:" >
            <a href="<?php echo base_url('companies')?>" class="nav-link <?php echo (($url=="companies"||$url=="add-new-company"||$url=="edit-company")?'active':'')?>">
              <i class="fas fa-building nav-icon"></i>
              <p>
                Companies
              </p>
            </a>
          </li>
          <?php endif; ?>
          
         
          <li class="nav-item" style="display:none" >
            <a href="" class="nav-link <?php echo (($url=="support-enquiries"||$url=="news-letter")?'active':'')?>">
              <i class="fas fa-id-card nav-icon"></i>
              <p>
                Support/Business
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?php echo base_url('support-enquiries')?>" class="nav-link <?php echo (($url=="support-enquiries")?'active':'')?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Support</p>
                    </a>
                </li>
                <li style="display:none" class="nav-item">
                    <a href="<?php echo base_url('contact-enquiries')?>" class="nav-link <?php echo (($url=="contact-enquiries")?'active':'')?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Contacts</p>
                    </a>
                </li>
                <li style="display:none" class="nav-item">
                    <a href="<?php echo base_url('feedbacks')?>" class="nav-link <?php echo (($url=="feedbacks")?'active':'')?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Feedbacks</p>
                    </a>
                </li>
                <li style="display:none" class="nav-item">
                    <a href="<?php echo base_url('get-business')?>" class="nav-link <?php echo (($url=="get-business")?'active':'')?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Request Business</p>
                    </a>
                </li>
            </ul>
          </li>
        
          <li class="nav-item" style="display:none" >
            <a href="<?php echo base_url('pages-list')?>" class="nav-link <?php echo (($url=="add-new-page"||$url=="edit-page"||$url=="pages-list")?'active':'')?>">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Pages
              </p>
            </a>
          </li>
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>