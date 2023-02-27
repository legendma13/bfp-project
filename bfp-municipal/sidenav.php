<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="index.php">
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
    <li class="nav-item">
      <a class="nav-link" href="barangay.php">
        <i class="mdi mdi-sitemap menu-icon"></i>
        <span class="menu-title">Add Barangay</span>
      </a>
    </li>
    <li class="nav-item nav-category">Forms</li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="ui-basic1">
        <i class="menu-icon mdi mdi-file"></i>
        <span class="menu-title">New Building</span>
        <i class="menu-arrow"></i> 
      </a>
      <div class="collapse" id="ui-basic1">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item" data-bs-toggle="modal" data-bs-target="#f1modal"> <a class="nav-link" href="#">Report</a></li>
          <li class="nav-item"> <a class="nav-link" href="form1-table.php">Status</a></li>
          <li class="nav-item"> <a class="nav-link" href="form1.php">Form</a></li>
        </ul>
      </div>
    </li>   
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic2">
        <i class="menu-icon mdi mdi-file"></i>
        <span class="menu-title">Business Establishment</span>
        <i class="menu-arrow"></i> 
      </a>
      <div class="collapse" id="ui-basic2">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item" data-bs-toggle="modal" data-bs-target="#f2modal"> <a class="nav-link" href="#">Report</a></li>
          <li class="nav-item"> <a class="nav-link" href="form2-table.php">Status</a></li>
          <li class="nav-item"> <a class="nav-link" href="form2.php">Form</a></li>
        </ul>
      </div>
    </li>       
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic5" aria-expanded="false" aria-controls="ui-basic5">
        <i class="menu-icon mdi mdi-file"></i>
        <span class="menu-title">Government Building</span>
        <i class="menu-arrow"></i> 
      </a>
      <div class="collapse" id="ui-basic5">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item" data-bs-toggle="modal" data-bs-target="#f3modal"> <a class="nav-link" href="#">Report</a></li>
          <li class="nav-item"> <a class="nav-link" href="form3-table.php">Status</a></li>
          <li class="nav-item"> <a class="nav-link" href="form3.php">Form</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic6" aria-expanded="false" aria-controls="ui-basic6">
        <i class="menu-icon mdi mdi-file"></i>
        <span class="menu-title">Fire Code Fees Collection</span>
        <i class="menu-arrow"></i> 
      </a>
      <div class="collapse" id="ui-basic6">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item" data-bs-toggle="modal" data-bs-target="#f4modal"> <a class="nav-link" href="#">Report</a></li>
          <li class="nav-item"> <a class="nav-link" href="form4-table.php">Status</a></li>
          <li class="nav-item"> <a class="nav-link" href="form4.php">Form</a></li>
        </ul>
      </div>
    </li>
  </ul>
</nav>



<!-- Modal -->
<div class="modal fade" id="f1modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="php/showreport.php" class="modal-content" method="POST">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">What Report you want to See?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body row">
        <div class="col-lg-6">
          <?php $montharray = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec")?>
          <div class="form-group m-0">
            <div class="input-group">
              <?php  
                $nowyear = date('Y');
                $minus15year = $nowyear - 15;
              ?>
              <select name="year" class="form-select text-black" required>
                <option value="">--Choose Year--</option>
                <?php for($increase = $nowyear;$increase>=$minus15year;$increase--){?>
                  <option value="<?php echo $increase?>"><?php echo $increase?></option>
                <?php }?>
              </select>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group m-0">
            <div class="input-group">
              <select name="month" class="form-select text-black" required>
                <?php $incremonth = 1?>
                  <option value="">--Choose Month--</option>
                <?php foreach($montharray as $hsmonth){?>
                  <option value="<?php echo $incremonth?>"><?php echo $hsmonth?></option>
                <?php echo $incremonth++?>
                <?php }?>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="showform1" id="search1" class="btn btn-primary">Show Report</button>
      </div>
    </form>
  </div>
</div>

<div class="modal fade" id="f2modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="php/showreport.php" class="modal-content" method="POST">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">What Report you want to See?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body row">
        <div class="col-lg-6">
          <?php $montharray = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec")?>
          <div class="form-group m-0">
            <div class="input-group">
              <?php  
                $nowyear = date('Y');
                $minus15year = $nowyear - 15;
              ?>
              <select name="year" class="form-select text-black" required>
                <option value="">--Choose Year--</option>
                <?php for($increase = $nowyear;$increase>=$minus15year;$increase--){?>
                  <option value="<?php echo $increase?>"><?php echo $increase?></option>
                <?php }?>
              </select>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group m-0">
            <div class="input-group">
              <select name="month" class="form-select text-black" required>
                <?php $incremonth = 1?>
                  <option value="">--Choose Month--</option>
                <?php foreach($montharray as $hsmonth){?>
                  <option value="<?php echo $incremonth?>"><?php echo $hsmonth?></option>
                <?php echo $incremonth++?>
                <?php }?>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="showform2" id="search2" class="btn btn-primary">Show Report</button>
      </div>
    </form>
  </div>
</div>


<div class="modal fade" id="f3modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="php/showreport.php" class="modal-content" method="POST">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">What Report you want to See?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body row">
        <div class="col-lg-6">
          <?php $montharray = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec")?>
          <div class="form-group m-0">
            <div class="input-group">
              <?php  
                $nowyear = date('Y');
                $minus15year = $nowyear - 15;
              ?>
              <select name="year" class="form-select text-black" required>
                <option value="">--Choose Year--</option>
                <?php for($increase = $nowyear;$increase>=$minus15year;$increase--){?>
                  <option value="<?php echo $increase?>"><?php echo $increase?></option>
                <?php }?>
              </select>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group m-0">
            <div class="input-group">
              <select name="month" class="form-select text-black" required>
                <?php $incremonth = 1?>
                  <option value="">--Choose Month--</option>
                <?php foreach($montharray as $hsmonth){?>
                  <option value="<?php echo $incremonth?>"><?php echo $hsmonth?></option>
                <?php echo $incremonth++?>
                <?php }?>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="showform3" id="search3" class="btn btn-primary">Show Report</button>
      </div>
    </form>
  </div>
</div>


<div class="modal fade" id="f4modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="php/showreport.php" class="modal-content" method="POST">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">What Report you want to See?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body row">
        <div class="col-lg-6">
          <?php $montharray = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec")?>
          <div class="form-group m-0">
            <div class="input-group">
              <?php  
                $nowyear = date('Y');
                $minus15year = $nowyear - 15;
              ?>
              <select name="year" class="form-select text-black" required>
                <option value="">--Choose Year--</option>
                <?php for($increase = $nowyear;$increase>=$minus15year;$increase--){?>
                  <option value="<?php echo $increase?>"><?php echo $increase?></option>
                <?php }?>
              </select>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group m-0">
            <div class="input-group">
              <select name="month" class="form-select text-black" required>
                <?php $incremonth = 1?>
                  <option value="">--Choose Month--</option>
                <?php foreach($montharray as $hsmonth){?>
                  <option value="<?php echo $incremonth?>"><?php echo $hsmonth?></option>
                <?php echo $incremonth++?>
                <?php }?>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="showform4" id="search4" class="btn btn-primary">Show Report</button>
      </div>
    </form>
  </div>
</div>