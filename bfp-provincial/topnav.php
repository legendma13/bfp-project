
<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
    <div class="me-3">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
        <span class="icon-menu"></span>
      </button>
    </div>
    <div>
      <a class="navbar-brand brand-logo" href="./">
        <img src="../assets/bfp-logo.png" alt="logo" />
      </a>
      <a class="navbar-brand brand-logo-mini" href="./">
        <img src="../assets/bfp-logo.png" alt="logo" />
      </a>
    </div>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-top"> 
    <ul class="navbar-nav">
      <li class="nav-item font-weight-semibold d-none d-lg-block ms-0 p-3">
        <img src="../assets/bfp-logo1.png" height="45" alt="">
      </li>
      <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
        <h3>REPUBLIC OF THE PHILIPPINES</h3>
        <p>Bureau of Fire Protection Region 4A</p>
      </li>
      <li class="nav-item font-weight-semibold d-none d-lg-block ms-0 p-3">
        <img src="../assets/bfp-logo.png" height="45" alt="">
      </li>
    </ul>
    <ul class="navbar-nav ms-auto">
      <li class="nav-item dropdown"> 
        <a class="nav-link count-indicator" id="countDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="icon-bell"></i>
          <?php $newnotificaation = mysqli_query($link,"SELECT * FROM notification WHERE uid='$uid' AND click='0'")?>
          <?php if($newnotificaation->num_rows > 0){?>
          <span id="reddot" class="count"></span>
          <?php }?>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0 overflow-auto" aria-labelledby="countDropdown" style="max-height: 400px;">
          <b>
            <a class="dropdown-item">
              <p class="mb-0 font-weight-medium float-left text-primary">NOTIFICATION</p>
            </a>
          </b>  
          <?php $notifquery = $link->query("SELECT * FROM notification WHERE uid = '$uid' ORDER BY date_created DESC")?>
          <?php if($notifquery->num_rows > 0){?>
          <?php while($shnotif = $notifquery->fetch_assoc()){?>
          <a class="dropdown-item preview-item" href="<?php if($shnotif['title'] == 'New registration'){ echo "new-registration.php?id=".$shnotif['id']."&&date=".$shnotif['date_created'];}?>" style="color:<?php if($shnotif['click'] == 0){ echo "black;";} else { echo "grey;";}?>">
            <div class="preview-item-content flex-grow py-2 p-3">
                <p class="preview-subject ellipsis font-weight-medium"><?php echo $shnotif['title']?></p>
                <p class="fw-light small-text mb-0"><?php echo $shnotif['content']?></p>
            </div>
          </a>
          <?php }}?>
        </div>
      </li>
      <li class="nav-item dropdown"> 
        <a class="nav-link count-indicator" id="countDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="icon-key"></i>
        </a>
        <form id="changeform" class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list p-3" aria-labelledby="countDropdown">
          <b>
            <div class="dropdown-item">
              <p class="mb-0 font-weight-medium float-left text-primary">Change Password</p>
            </div>
          </b>  
          <div class="row">
            <div class="col-lg-12 mb-3">
              <label for="newpass">New Password</label>
              <input type="password" name="newpassword" id="newpassword" class="form-control" required>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 mb-3">
              <label for="newpass">Confirm Password</label>
              <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" required>
            </div>
          </div>
          <button type="submit" class="btn btn-success w-100">Save Change</button>
        </form>
      </li>
      <li class="nav-item dropdown d-none d-lg-block user-dropdown">
        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
          <img class="img-xs rounded-circle" src="../assets/img/<?php echo $sh_user['profile_img']?>" alt="Profile image"> </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
          <div class="dropdown-header text-center">
            <img class="img-md rounded-circle" src="../assets/img/<?php echo $sh_user['profile_img']?>" width="40" height="40" alt="Profile image">
            <p class="mb-1 mt-3 font-weight-semibold"><?php echo $sh_user['position']?></p>
            <p class="fw-light text-muted mb-0"><?php echo $sh_user['location']?></p>
          </div>
          <a class="dropdown-item" href="../php/logout.php"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
        </div>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>
<script src="../js/changepass.js"></script>
