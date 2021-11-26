<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">

    <li class="nav-item nav-profile" style="background: #f0f8ff8f">
      <a href="#" class="nav-link" >
        <div class="nav-profile-image">
          <img src="assets/images/faces/face1.jpg" alt="profile">
          <span class="login-status online"></span>
          <!--change to offline or busy as needed-->
        </div>
        <div class="nav-profile-text d-flex flex-column">
          <span class="font-weight-bold mb-2"><?php echo($_SESSION['name']); ?></span>
          <span class="text-secondary text-small"><?php echo($_SESSION['role']); ?></span>
        </div>
        <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="./dashboard.php">
        <span class="menu-title">Home</span>
        <i class="mdi mdi-home menu-icon"></i>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#bank_leads" aria-expanded="false" aria-controls="bank_leads">
        <span class="menu-title">Bank Allocated Leads</span>
        <i class="mdi mdi-table-large menu-icon"></i>
      </a>
      <div class="collapse" id="bank_leads">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item "> <a class="nav-link " href="./Lead-Entry.php">  Entry</a></li>
          <li class="nav-item "> <a class="nav-link " href="./view_leads.php">View Leads</a></li>
          <li class="nav-item "> <a class="nav-link " href="./rejected_lead_list.php">Reject Lead</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#vedant_Leads" aria-expanded="false"
        aria-controls="vedant_Leads">
        <span class="menu-title">Vedant Indetified Leads</span>
        <i class="mdi mdi-table-large menu-icon"></i>
      </a>
      <div class="collapse" id="vedant_Leads">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item "> <a class="nav-link " href="./New-Lead.php">Entry</a></li>
          <li class="nav-item "> <a class="nav-link " href="./view_new_leads.php">View Leads</a>
          </li>
          <li class="nav-item "> <a class="nav-link " href="./rejected_lead_list_new.php">Reject Lead</a>
          </li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#account" aria-expanded="false" aria-controls="account">
        <span class="menu-title">Back Office</span>
        <i class="mdi mdi-contacts menu-icon"></i>
      </a>
      <div class="collapse" id="account">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item "> <a class="nav-link " href="./personal_details.php">Personal Details</a></li>
          <li class="nav-item "> <a class="nav-link " href="./account_list.php">Account Mapping</a></li>
          <li class="nav-item "> <a class="nav-link " href="./terminal_mapping.php">Terminal Mapping</a></li>
          <li class="nav-item "> <a class="nav-link " href="./setup.php">Setup</a></li>
        </ul>
      </div>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#export" aria-expanded="false" aria-controls="export">
        <span class="menu-title">Export</span>
        <i class="mdi mdi-table-large menu-icon"></i>
      </a>
      <div class="collapse" id="export">
        <ul class="nav flex-column sub-menu">
        <li class="nav-item "> <a class="nav-link " href="./export_mapping.php">Export Mapping</a></li>
          <li class="nav-item "> <a class="nav-link " href="./export_master_sheet.php">Export Master Sheet</a></li>
          <li class="nav-item "> <a class="nav-link " href="./export_account_mapping.php">Export A/C Mapping</a>
          </li>
          <li class="nav-item "> <a class="nav-link " href="./export_tr_mapping.php">Export Terminal Mapping</a></li>
        </ul>
      </div>
    </li>






    <?php if($_SESSION['role'] == "Admin"){?>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#import" aria-expanded="false" aria-controls="import">
        <span class="menu-title">Import Excel</span>
        <i class="mdi mdi-file-import menu-icon"></i>
      </a>
      <div class="collapse" id="import">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item "> <a class="nav-link " href="./location_import.php">Location Import</a></li>
          <!-- <li class="nav-item "> <a class="nav-link " href="./import_master_sheet.php">Upload Master Sheet</a></li> -->
          <li class="nav-item "> <a class="nav-link " href="./commission_import.php">Commission Import</a></li>
        </ul>
      </div>
    </li>
    <?php } ?>
    <?php if($_SESSION['role'] =="Employee"){ ?>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#pendings" aria-expanded="false" aria-controls="pendings">
        <span class="menu-title">Pending Approvals</span>
        <i class="mdi mdi-account-check menu-icon"></i>
      </a>
      <div class="collapse" id="pendings">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item "> <a class="nav-link " href="./pending_personal_info.php">Personal Information</a></li>
          <li class="nav-item "> <a class="nav-link " href="./pending_account_mapping.php">Account Mapping</a></li>
          <li class="nav-item "> <a class="nav-link " href="./pending_terminal_mapping.php">Terminal Mapping</a></li>
          <li class="nav-item "> <a class="nav-link " href="./setup_approval_pending.php">Setup</a></li>
        </ul>
      </div>
    </li>
    <?php } ?>
    <?php if($_SESSION['role'] == "Admin"){?>
    <li class="nav-item">
      <a class="nav-link" href="./add_new_associate.php">
        <span class="menu-title">Add/Delete Associate</span>
        <i class="mdi mdi-account-multiple-plus px-2 menu-icon"></i>
      </a>
    </li>
    <?php } ?>
  </ul>
</nav>