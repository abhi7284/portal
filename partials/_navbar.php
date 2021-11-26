<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <a class="navbar-brand brand-logo" href="./dashboard.php"><img src="assets/images/logo.png" alt="logo" /></a>
    <a class="navbar-brand brand-logo-mini" href="./dashboard.php"><img src="assets/images/logo-mini.png"
        alt="logo" /></a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-stretch">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="mdi mdi-menu" style="color:#000;"></span>
    </button>
    <!--     <div class="search-field d-none d-md-block">
      <form class="d-flex align-items-center h-100" action="#">
        <div class="input-group">
          <div class="input-group-prepend bg-transparent">
            <i class="input-group-text border-0 mdi mdi-magnify"></i>
          </div>
          <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">
        </div>
      </form>
    </div> -->
    <ul class="navbar-nav navbar-nav-right">

      <li class="nav-item d-none d-lg-block full-screen-link">
        <a class="nav-link">
          <i class="mdi mdi-fullscreen" id="fullscreen-button" style="color:#000;"></i>
        </a>
      </li>
      <!-- <li class="nav-item dropdown">
        <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
          <i class="mdi mdi-email-outline"></i>
          <span class="count-symbol bg-warning"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
          <h6 class="p-3 mb-0">Messages</h6>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <img src="assets/images/faces/face4.jpg" alt="image" class="profile-pic">
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
              <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a message</h6>
              <p class="text-gray mb-0"> 1 Minutes ago </p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <img src="assets/images/faces/face2.jpg" alt="image" class="profile-pic">
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
              <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Cregh send you a message</h6>
              <p class="text-gray mb-0"> 15 Minutes ago </p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <img src="assets/images/faces/face3.jpg" alt="image" class="profile-pic">
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
              <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Profile picture updated</h6>
              <p class="text-gray mb-0"> 18 Minutes ago </p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <h6 class="p-3 mb-0 text-center">4 new messages</h6>
        </div>
      </li> -->


      <li class="nav-item dropdown" id="notification_id" style="color:#000;">
        <?php
      // session_start();
      $role = $_SESSION['role'];
      if($role == "Admin"){
        include 'Connection.php';
        $notification_query = "SELECT a.id, a.seen, a.employee_id, a.date, a.time,t.description FROM admin_notification a INNER JOIN notification_type t ON (a.notification_id = t.id) AND ((a.notification_id = 1) || (a.notification_id = 3) || (a.notification_id = 5))";
        $notification_result = mysqli_query($conn,$notification_query);
        $notification_count=0;

        //Count Setup Approval Count
        $query_setup_approval_pending = "SELECT cl.id FROM `csp_locations` cl WHERE cl.current_status=0 AND cl.is_temp_terminal=2 AND cl.setup=1";
        $result_setup_approval_object = mysqli_query($conn,$query_setup_approval_pending);
        $setup_count = mysqli_num_rows($result_setup_approval_object);

        while($row=mysqli_fetch_assoc($notification_result)){
          if($row['seen']==0){
            $notification_count=$notification_count+1;
          }
        }
        $notification_count = $notification_count + $setup_count;//Add All Pending approval + Setup Pending value
        ?>
        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown"
          aria-expanded="true">
          <i class="mdi mdi-bell-outline <?php if($notification_count >0){echo('text-danger');} ?>"></i>
          <span
            class="count-symbol <?php echo('text-danger'); ?> "><b><?php if($notification_count>0){echo($notification_count);} ?></b></span>
        </a>
        <?php
      }
      if($role == "Employee"){
        $emp_id = $_SESSION['username'];
        include 'Connection.php';
        $notification_query = "SELECT a.id, a.seen, a.notification_id, a.date, a.time,t.description FROM employee_notification a INNER JOIN notification_type t ON (a.notification_id = t.id) WHERE a.emp_id='{$emp_id}' AND ((notification_id = 2) || (notification_id = 4) || (notification_id = 6) AND emp_id='{$emp_id}' )";
        $notification_result = mysqli_query($conn,$notification_query);
        $notification_count=0;
        //Query For Count Setup Completed
        $query_for_setup_completed = "SELECT cl.id FROM csp_locations cl WHERE cl.current_status = 0 AND cl.is_temp_terminal=2 AND cl.setup=2";
        $result_object_setup_completed = mysqli_query($conn,$query_for_setup_completed);
        $count_setup_completed = mysqli_num_rows($result_object_setup_completed);

        while($row=mysqli_fetch_assoc($notification_result)){
          if($row['seen']==0){
            $notification_count=$notification_count+1;
          }
        }
        $notification_count = $notification_count + $count_setup_completed;
        ?>
        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown"
          aria-expanded="true">
          <i class="mdi mdi-bell-outline <?php if($notification_count >0){echo('text-danger');} ?>"></i>
          <span
            class="count-symbol <?php echo('text-danger'); ?> "><b><?php if($notification_count>0){echo($notification_count);} ?></b></span>
        </a>
        <?php
      }
        ?>

        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list "
          aria-labelledby="notificationDropdown">
          <h6 class="p-3 mb-0">Notifications</h6>
          <div class="dropdown-divider"></div>
          <?php if($role == "Admin"){
            //Query for Personal Info
            $query_for_personal_info="SELECT * FROM `admin_notification` WHERE notification_id=1 AND seen=0";
            $result_for_personal_info = mysqli_query($conn,$query_for_personal_info);
            $count_personal_info_approval = mysqli_num_rows($result_for_personal_info);

            //Query for Account Mapping
            $query_for_account_mapping="SELECT * FROM `admin_notification` WHERE notification_id=3 AND seen=0";
            $result_for_account_mapping = mysqli_query($conn,$query_for_account_mapping);
            $count_account_mapping_approval = mysqli_num_rows($result_for_account_mapping);
            
            //Query for Terminal Mapping
            $query_for_terminal_mapping="SELECT * FROM `admin_notification` WHERE notification_id=5 AND seen=0";
            $result_for_terminal_mapping = mysqli_query($conn,$query_for_terminal_mapping);
            $count_terminal_mapping_approval = mysqli_num_rows($result_for_terminal_mapping);
            ?>
          <a class="dropdown-item preview-item" href="./personal_info_notification_admin.php">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-success">
                <b><?php echo($count_personal_info_approval); ?></b>
              </div>
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
              <h6 class="normal mb-1 ellipsis text-dark"> Personal Info Approval</h6>
            </div>
          </a>

          <div class="dropdown-divider"></div>

          <a class="dropdown-item preview-item" href="./account_mapping_notification_admin.php">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-warning ">
                <b><?php echo($count_account_mapping_approval); ?></b>
              </div>
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
              <h6 class="normal mb-1 ellipsis text-dark">Account Mapping Approval</h6>
            </div>
          </a>

          <div class="dropdown-divider"></div>

          <a class="dropdown-item preview-item" href="./terminal_mapping_notification_admin.php">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-info">
                <b><?php echo($count_terminal_mapping_approval); ?></b>
              </div>
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
              <h6 class="normal mb-1 ellipsis text-dark">Terminal Mapping Approval</h6>
            </div>
          </a>

          <a class="dropdown-item preview-item" href="./pending_setup_approval.php">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-info">
                <b><?php echo($setup_count); ?></b>
              </div>
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
              <h6 class="normal mb-1 ellipsis text-dark">Setup Approval</h6>
            </div>
          </a>








          <?php }
          if($role == "Employee"){
            //Query for Personal Info Approved
            $query_for_personal_info_approved = "SELECT * FROM employee_notification WHERE notification_id=2 AND seen=0 AND emp_id='{$emp_id}'";
            $result_for_personal_info_approved = mysqli_query($conn,$query_for_personal_info_approved);
            $count_personal_info_approval_approved = mysqli_num_rows($result_for_personal_info_approved);

            //Query for Account Mapping
            $query_for_account_mapping_approved="SELECT * FROM employee_notification WHERE notification_id=4 AND seen=0 AND emp_id='{$emp_id}'";
            $result_for_account_mapping_approved = mysqli_query($conn,$query_for_account_mapping_approved);
            $count_account_mapping_approval_approved = mysqli_num_rows($result_for_account_mapping_approved);
            
            //Query for Terminal Mapping
            $query_for_terminal_mapping_approved="SELECT * FROM employee_notification WHERE notification_id=6 AND seen=0 AND emp_id='{$emp_id}'";
            $result_for_terminal_mapping_approved = mysqli_query($conn,$query_for_terminal_mapping_approved);
            $count_terminal_mapping_approval_approved = mysqli_num_rows($result_for_terminal_mapping_approved);
          ?>
          <a class="dropdown-item preview-item" href="./listof_approved_personal_info.php">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-success">
                <b><?php echo($count_personal_info_approval_approved); ?></b>
              </div>
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
              <h6 class="normal mb-1 ellipsis text-dark">Personal Info Approved</h6>
            </div>
          </a>
          <div class="dropdown-divider"></div>

          <a class="dropdown-item preview-item" href="./listof_approved_account_mapping.php">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-warning ">
                <b><?php echo($count_account_mapping_approval_approved); ?></b>
              </div>
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
              <h6 class="normal mb-1 ellipsis text-dark">Account Mapping Approved</h6>
            </div>
          </a>
          <div class="dropdown-divider"></div>

          <a class="dropdown-item preview-item" href="./listof_approved_terminal_mapping.php">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-info">
                <?php echo($count_terminal_mapping_approval_approved); ?>
              </div>
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
              <h6 class="normal mb-1 ellipsis text-dark">Terminal Mapping Approved</h6>
            </div>
          </a>

          <a class="dropdown-item preview-item" href="./listof_approved_setup.php">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-info">
                <b><?php echo($count_setup_completed); ?></b>
              </div>
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
              <h6 class="normal mb-1 ellipsis text-dark">Setup Approval</h6>
            </div>
          </a>


          <?php } ?>
        </div>
      </li>

      <!--<li class="nav-item nav-logout d-none d-lg-block">
        <a class="nav-link" href="#">
          <i class="mdi mdi-power"></i>
        </a>
      </li>
      <li class="nav-item nav-settings d-none d-lg-block">
        <a class="nav-link" href="#">
          <i class="mdi mdi-format-line-spacing"></i>
        </a>
      </li> -->
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
          <div class="nav-profile-img">
            <img src="assets/images/faces/face1.jpg" alt="image">
            <span class="availability-status online"></span>
          </div>
          <div class="nav-profile-text">
            <p class="mb-1 text-black"><?php echo($_SESSION['name']); ?></p>
          </div>
        </a>

        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
          <a class="dropdown-item text-dark" href="./view_profile.php">
            <i class="mdi mdi-account mr-2 "></i> Profile </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item text-dark" href="./logout.php">
            <i class="mdi mdi-logout mr-2 "></i> Signout </a>
        </div>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
      data-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>