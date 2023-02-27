<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="./">
        <i class="mdi mdi-gauge menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="reportstatus.php">
        <i class="mdi mdi-table menu-icon"></i>
        <span class="menu-title">My Report</span>
      </a>
    </li>
    <?php $admin = mysqli_fetch_assoc($link->query("SELECT uid FROM bfp_users WHERE position = 'Admin'"))?>
    <li class="nav-item">
      <a class="nav-link" href="chat.php?chatuid=<?php echo $admin['uid']?>">
        <i class="mdi mdi-message menu-icon"></i>
        <span class="menu-title">Chat</span>
      </a>
    </li>
    <li class="nav-item nav-category">Reports</li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class="menu-icon mdi mdi-chart-line"></i>
        <span class="menu-title">List of Reports</span>
        <i class="menu-arrow"></i> 
      </a>
      <div class="collapse show" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="municipal.php">Municipal</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#la" aria-expanded="false" aria-controls="la">
        <i class="menu-icon mdi mdi-table-large"></i>
        <span class="menu-title">List of Applications</span>
        <i class="menu-arrow"></i> 
      </a>
      <div class="collapse show" id="la">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="form1-table.php">New Building</a></li>
          <li class="nav-item"> <a class="nav-link" href="form2-table.php">Business Establishment</a></li>
          <li class="nav-item"> <a class="nav-link" href="form3-table.php">Government Building</a></li>
          <li class="nav-item"> <a class="nav-link" href="form4-table.php">Fire Code Fees Collection</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item nav-category">Accounts</li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#Account" aria-expanded="false" aria-controls="Account">
        <i class="menu-icon mdi mdi-account"></i>
        <span class="menu-title">Accounts</span>
        <i class="menu-arrow"></i> 
      </a>
      <div class="collapse show" id="Account">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="allusers.php">All users</a></li>
          <li class="nav-item"> <a class="nav-link" href="new-registration.php">New Registration</a></li>
        </ul>
      </div>
    </li>
  </ul>
</nav>