<!DOCTYPE html>
  <?php include_once "check.php"?>
  <html lang="en">
  <?php include_once "head.php"?>

  <body>
    <div class="container-scroller">
      
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
          <div class="me-3">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
              <span class="icon-menu"></span>
            </button>
          </div>
          <div>
            <a class="navbar-brand brand-logo" href="index.html">
              <img src="../assets/bfp-logo.png" alt="logo" />
            </a>
            <a class="navbar-brand brand-logo-mini" href="index.html">
              <img src="../assets/bfp-logo.png" alt="logo" />
            </a>
          </div>
        </div>
        <?php include_once "topnav.php"?>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_settings-panel.html -->
        <div class="theme-setting-wrapper">
          <div id="settings-trigger"><i class="ti-settings"></i></div>
          <div id="theme-settings" class="settings-panel">
            <i class="settings-close ti-close"></i>
            <p class="settings-heading">SIDEBAR SKINS</p>
            <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border me-3"></div>Light</div>
            <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border me-3"></div>Dark</div>
            <p class="settings-heading mt-2">HEADER SKINS</p>
            <div class="color-tiles mx-0 px-4">
              <div class="tiles success"></div>
              <div class="tiles warning"></div>
              <div class="tiles danger"></div>
              <div class="tiles info"></div>
              <div class="tiles dark"></div>
              <div class="tiles default"></div>
            </div>
          </div>
        </div>
        
        <!-- partial -->
        <?php include_once "topnav.php"?>
        <!-- partial:partials/_sidebar.html -->
        <?php include_once "sidenav.php"?>
        <!-- partial -->
        <div class="main-panel">

          <div class="content-wrapper">
            <div class="row">
              <div class="col-sm-12">
                <div class="home-tab">
                  <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link" id="home-tab" data-bs-toggle="tab" href="#Overview" role="tab" aria-controls="Overview" aria-selected="false">Overview</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active ps-0" id="newBldg-tab" data-bs-toggle="tab" href="#newBldg" role="tab" aria-controls="newBldg" aria-selected="true">New Building</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="bus-estab-tab" data-bs-toggle="tab" href="#bus-estab" role="tab" aria-selected="false">Business Establishment</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link border-0" id="more-tab" data-bs-toggle="tab" href="#more" role="tab" aria-selected="false">Government Building</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link border-0" id="more-tab" data-bs-toggle="tab" href="#more" role="tab" aria-selected="false">Fire Code Fees Collection</a>
                      </li>
                    </ul>
                    <div>
                      <div class="btn-wrapper">
                        <a href="#" class="btn btn-primary text-white me-0"><i class="icon-download"></i> Export</a>
                      </div>
                    </div>
                  </div>
                  <div class="tab-content tab-content-basic">
                    <div class="tab-pane fade" id="Overview" role="tabpanel" aria-labelledby="Overview">
                      <div class="row mb-3">
                        <div class="col-md-4 grid-margin stretch-card">
                          <div class="card" style="border-left: 5px solid orange">
                            <div class="card-body">
                              <h4 class="card-title">All Application Received</h4>
                              <div class="media">
                                <i class="ti-file icon-md text-info d-flex align-self-start me-3"></i>
                                <div class="media-body ms-auto">
                                  <div class="row">
                                    <div class="col-lg-12">
                                      <h3>100</h3>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4 grid-margin stretch-card">
                          <div class="card" style="border-left: 5px solid orange;border-right: 5px solid orange">
                            <div class="card-body">
                              <h4 class="card-title">Average Application Per Year</h4>
                              <div class="media">
                                <i class="ti-file icon-md text-info d-flex align-self-start me-3"></i>
                                <div class="media-body ms-auto">
                                  <div class="row">
                                    <div class="col-lg-12">
                                      <h3>100</h3>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4 grid-margin stretch-card">
                          <div class="card" style="border-right: 5px solid orange">
                            <div class="card-body">
                              <h4 class="card-title">Average Application Per Month</h4>
                              <div class="media">
                                <i class="ti-file icon-md text-info d-flex align-self-start me-3"></i>
                                <div class="media-body ms-auto">
                                  <div class="row">
                                    <div class="col-lg-12">
                                      <h3>100</h3>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div> 
                      <div class="row">
                        <div class="col-lg-8 mb-3">
                          <div class="card">
                            <div class="card-body">

                            <?php  
                              $now = date('Y');
                              $minus5year = $now - 5;
                            ?>

                            <div id="yearly" style="width:100%;"></div>
                            <script>
                              var xArray = [<?php
                                            for($i=$minus5year; $i<=$now;$i++){
                                                echo "'$i',";
                                            }
                                            ?>];
                              var yArray = [7,8,8,9,9,9];

                              // Define Data
                              var data = [{
                                x: xArray,
                                y: yArray,
                                mode:"lines"
                              }];

                              // Define Layout
                              var layout = {
                                title: "Yearly Total Number Application Received"
                              };

                              // Display using Plotly
                              Plotly.newPlot("yearly", data, layout);
                            </script>
                            </div>
                          </div>
                        </div>

                        <div class="col-lg-4">
                          <div class="card">
                            <div class="card-body">
                              <div id="lastyearvcurrent" style="width:100%;"></div>
                              <script>
                                var xArray = ["Current<br>Year Data", "Previous<br>Year Data"];
                                var yArray = [55, 49];

                                var layout = {title:"Current Data VS Previous Data"};

                                var data = [{labels:xArray, values:yArray, hole:.4, type:"pie"}];

                                Plotly.newPlot("lastyearvcurrent", data, layout);
                              </script>
                            </div>
                          </div>
                        </div>
                        
                        <div class="col-lg-8">
                          <div class="card">
                            <div class="card-body">

                            <?php  
                              $now = date('Y');
                              $minus5year = $now - 5;
                            ?>
                            <?php  
                                $nowthis = date('Y-m-d');
                                $nowmonth = date('n');
                                $minus5month = date('n', strtotime($nowthis. ' - 5 month'));
                                $minus5month12 = date('Y-m-d', strtotime($nowthis. ' - 5 month'));
                                $minus5m = date('Y-m-d', strtotime($nowthis. ' - 5 month'));
                            ?>
                            <div id="monthly" style="width:100%;"></div>
                            <script>
                              var xArray = [<?php for($i=$minus5month; $i<$nowmonth;$i++){
                                            $minus5month1 = date('Y-m-d', strtotime($minus5month12. ' + 1 month'));
                                            $monthofthis = date('M', strtotime($minus5month1));
                                            $minus5month12=$minus5month1;
                                    
                                            echo "'".$monthofthis."'".',';
                                            }?>];
                              var yArray = [<?php for($x=$minus5month; $x<$nowmonth;$x++){
                                            $minus5 = date('Y-m-d', strtotime($minus5m. ' + 1 month'));
                                            $monthofthis11 = date('n', strtotime($minus5));
                                            $minus5m=$minus5;

                                            $countallapp = mysqli_fetch_assoc(mysqli_query($link,"SELECT SUM(ThisMonthTotalApp) FROM form1 WHERE report_created BETWEEN '2022-$monthofthis11-1 00-00-01' AND '2022-$monthofthis11-31 23-59-59'"));
                                            echo "'".$countallapp['SUM(ThisMonthTotalApp)']."'".',';

                                            }?>];

                              // Define Data
                              var data = [{
                                x: xArray,
                                y: yArray,
                                mode:"lines"
                              }];

                              // Define Layout
                              var layout = {
                                title: "Montly Total Number Application Received"
                              };

                              // Display using Plotly
                              Plotly.newPlot("monthly", data, layout);
                            </script>
                            </div>
                          </div>
                        </div>
                        
                        <div class="col-lg-4">
                          <div class="card">
                            <div class="card-body text-center">
                              <h1 id="clock"></h1>
                              <script>
                                function currentTime() {
                                  let date = new Date(); 
                                  let hh = date.getHours();
                                  let mm = date.getMinutes();
                                  let ss = date.getSeconds();
                                  let session = "AM";

                                  if(hh === 0){
                                      hh = 12;
                                  }
                                  if(hh > 12){
                                      hh = hh - 12;
                                      session = "PM";
                                  }

                                  hh = (hh < 10) ? "0" + hh : hh;
                                  mm = (mm < 10) ? "0" + mm : mm;
                                  ss = (ss < 10) ? "0" + ss : ss;
                                    
                                  let time = hh + ":" + mm + ":" + ss + " " + session;

                                  document.getElementById("clock").innerText = time; 
                                  let t = setTimeout(function(){ currentTime() }, 1000);
                                }

                                currentTime();
                              </script>
                            </div>
                          </div>
                        </div>
                        
                      </div>
                      
                    </div>
                    <div class="tab-pane fade show active" id="newBldg" role="tabpanel" aria-labelledby="newBldg"> 
                      <div class="row">
                        <div class="col-lg-6">
                          <form action="" method="GET" id="seachresult">
                            <select id="typethis" name="typethis" class="form-select">
                              <option value="New Establishments/Buildings">New Establishments/Buildings</option>
                              <option value="New Government Buildings">New Government Buildings</option>
                              <option value="New PEZA Establishments/ Buildings">New PEZA Establishments/ Buildings</option>
                            </select>
                          </form>
                        </div>
                        <div class="col-lg-6 text-end">
                          <?php $montharray = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec")?>
                            <div class="form-group m-0">
                              <div class="input-group">
                              <?php  
                                $nowyear = date('Y');
                                $minus15year = $nowyear - 15;
                              ?>
                              <select name="year" form="seachresult" id="" class="form-control text-black">
                                <?php for($increase = $nowyear;$increase>=$minus15year;$increase--){?>
                                <option value="<?php echo $increase?>"><?php echo $increase?></option>
                                <?php }?>
                              </select>
                              <select name="month" form="seachresult" id="" class="form-control text-black">
                                <?php foreach($montharray as $hsmonth){?>
                                <option value="<?php echo $hsmonth?>"><?php echo $hsmonth?></option>
                                <?php }?>
                              </select>
                              <div class="input-group-append">
                                <button form="seachresult" class="btn btn-sm btn-primary text-white" id="search1" type="submit">Search</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div> 
                      <div class="row mb-3" id="newstabshow">
                        <?php if(isset($_GET['typethis'])){?>
                        <?php $query = mysqli_query($link,"SELECT * FROM form1 WHERE uid='$uid' AND Form1Type='".$_GET['typethis']."'")?>
                        <?php if(mysqli_num_rows($query)>0){?>
                        <?php $shnewestablish = mysqli_fetch_assoc($query)?>

                        <h4 class="card-title fs-3 mt-3 text-center"><b>New Establishments/Buildings</b></h4>
                        <div class="col-md-12 grid-margin grid-margin-md-0 stretch-card mb-3">
                          <div class="card">
                              <div class="card-body">
                                  <div class="row mb-3">
                                      <div class="col-lg-12">
                                          <h4><b>FSEC</b></h4> 
                                          <small>Total Number Application Received within the Month:</small>
                                          <b class="fs-5"><?php echo $shnewestablish['ThisMonthTotalApp']?></b>
                                          <h5 class="mt-3">Number of Issued FSEC</h5>
                                          <div class="row text-center">
                                          <div class="col-lg-4 border border-2 rounded p-2">
                                              <h5>For Current Month (Within the Month)</h5>
                                              <input type="text" value="<?php echo $shnewestablish['IssuedFSEC_Curmonth']?>" name="" id="" class="form-control text-end" readonly>
                                          </div>
                                          <div class="col-lg-4 border border-2 rounded p-2">
                                              <h5>From Previous Month(s)</h5>
                                              <input type="text" value="<?php echo $shnewestablish['IssuedFSEC_PreMonth']?>" name="" id="" class="form-control mt-auto text-end" readonly>
                                          </div>
                                          <div class="col-lg-4 border border-2 rounded p-2">
                                              <h5>Total Issued FSEC</h5>
                                              <input type="text" value="<?php echo $rtotal = $shnewestablish['IssuedFSEC_Curmonth'] + $shnewestablish['IssuedFSEC_PreMonth']?>" name="" id="" class="form-control mt-auto text-end" readonly>
                                          </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-lg-12">
                                          <h5>Number of Issued Notice of Disapproval (NOD)</h5>
                                          <div class="row text-center mt-3">
                                          <div class="col-lg-4 border border-2 rounded p-2">
                                              <h5>For Current Month (Within the Month)</h5>
                                              <input type="text" value="<?php echo $shnewestablish['IssuedFSEC_Curmonth']?>" name="" id="" class="form-control text-end" readonly>
                                          </div>
                                          <div class="col-lg-4 border border-2 rounded p-2">
                                              <h5>From Previous Month(s)</h5>
                                              <input type="text" value="<?php echo $shnewestablish['IssuedNOD_PreMonth']?>" name="" id="" class="form-control mt-auto text-end" readonly>
                                          </div>
                                          <div class="col-lg-4 border border-2 rounded p-2">
                                              <h5>Total Issued NOD</h5>
                                              <input type="text" value="<?php echo $rtotal1 = $shnewestablish['IssuedNOD_PreMonth'] + $shnewestablish['IssuedFSEC_Curmonth']?>" name="" id="" class="form-control mt-auto text-end" readonly>
                                          </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div id="INSPECTION" style="width:100%;"></div>
                                  <?php $struturearray = array("Assembly","Educational","Day Care","Health Care","Residential<br>Board & Care","Detention &<br>Correctional","Hotel","Dormitories","Apartment<br>Building","Lodging and<br>Rooming house","Single and Two<br>Family Dwelling Unit","Mercantile","Business","Industrial","Storage","Special Structures")?>
                                  <script>
                                      var xArray = [
                                          <?php foreach($struturearray as $shstruturearray1){?>
                                          <?php echo "'".$shstruturearray1."',"?>
                                          <?php }?>
                                      ];
                                      var yArray = [55, 49, 44, 24, 15];
                                      var aArray = [
                                          <?php foreach($struturearray as $shstruturearray2){?>
                                          <?php echo "'".$shstruturearray2."',"?>
                                          <?php }?>
                                      ];
                                      var bArray = [55, 49, 44, 24, 15,55, 49, 44, 24, 15];
                                      var data = [{
                                          x:xArray,
                                          y:yArray,
                                          name:"NC",
                                          type:"bar"
                                      },{
                                          x:aArray,
                                          y:bArray,
                                          name:"RN",
                                          type:"bar"
                                      }];
                                      // Define Layout
                                      var layout = {
                                          title: "1st INSPECTION FOR FSIC (OCCUPANCY PERMIT)"
                                      };

                                      Plotly.newPlot("INSPECTION", data, layout);
                                  </script>
                                  
                                  <div class="row">
                                      <div class="col-lg-6 border border-2 rounded">
                                          <div id="total" style="width:100%;"></div>
                                          <?php $structure_NC = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM structure_data WHERE report_id = '".$shnewestablish['form_id']."' AND structure_type = 'NC' LIMIT 1"))?>
                                          <?php $structure_RN = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM structure_data WHERE report_id = '".$shnewestablish['form_id']."' AND structure_type = 'RN' LIMIT 1"))?>
                                          
                                          <?php 
                                              $sumNC = $structure_NC['Assembly'] + $structure_NC['Educational'] + $structure_NC['DayCare'] + $structure_NC['HealthCare'] + $structure_NC['ResidentialBoardandCare'] +  
                                              $structure_NC['Hotel'] + $structure_NC['Dormitories'] + $structure_NC['ApartmentBuilding'] + $structure_NC['LodgingandRooming_house'] + $structure_NC['SingleandTwoFamilyDwellingUnit'] +
                                              $structure_NC['Mercantile'] + $structure_NC['Business'] + $structure_NC['Industrial'] + $structure_NC['Storage'] + $structure_NC['SpecialStructures'];
                                              
                                              $sumRN = $structure_RN['Assembly'] + $structure_RN['Educational'] + $structure_RN['DayCare'] + $structure_RN['HealthCare'] + $structure_RN['ResidentialBoardandCare'] +  
                                              $structure_RN['Hotel'] + $structure_RN['Dormitories'] + $structure_RN['ApartmentBuilding'] + $structure_RN['LodgingandRooming_house'] + $structure_RN['SingleandTwoFamilyDwellingUnit'] +
                                              $structure_RN['Mercantile'] + $structure_RN['Business'] + $structure_RN['Industrial'] + $structure_RN['Storage'] + $structure_RN['SpecialStructures'];
                                          ?>

                                          
                                          <script>
                                          var xArray = ["Total NC", "Total RN"];
                                          var yArray = [<?php echo $sumNC?>, <?php echo $sumRN?>];

                                          var layout = {title:"Total NC VS Total RN"};

                                          var data = [{labels:xArray, values:yArray, hole:.4, type:"pie"}];

                                          Plotly.newPlot("total", data, layout);
                                          </script>
                                      </div>
                                      <div class="col-lg-6 border border-2 rounded">
                                          <div id="overall" style="width:100%;"></div>
                                          <script>
                                          var xArray = ["Previous Month Overall", "Current Month Overall"];
                                          var yArray = [55, 49];

                                          var layout = {title:"Previous Month Overall VS Current Month Overall"};

                                          var data = [{labels:xArray, values:yArray, hole:.4, type:"pie"}];

                                          Plotly.newPlot("overall", data, layout);
                                          </script>
                                      </div>
                                  </div>
                                  
                                  <div class="row mt-3">
                                      <div class="col-lg-12">
                                          <h4><b>Inspection during Under Construction</b></h4>
                                      </div>
                                      <div class="col-lg-4 mb-3 border border-2 rounded p-2">
                                          <h5>NC: Newly Constructed Building</h5>
                                          <input type="text" name="" value="<?php echo $shnewestablish['InspectionUnderConstruction_NC']?>" id="" class="form-control text-end" readonly>
                                      </div>
                                      <div class="col-lg-4 mb-3 border border-2 rounded p-2">
                                          <h5>RN: Renovation, Repair, Modified</h5>
                                          <input type="text" name="" value="<?php echo $shnewestablish['InspectionUnderConstruction_RN']?>" id="" class="form-control text-end mt-auto" readonly>
                                      </div>
                                      <div class="col-lg-4 mb-3 border border-2 rounded p-2">
                                          <h5>TOTAL</h5>
                                          <input type="text" name="" value="<?php echo $inpectiontotal = $shnewestablish['InspectionUnderConstruction_NC'] + $shnewestablish['InspectionUnderConstruction_RN']?>" id="" class="form-control text-end mt-auto" readonly>
                                      </div>
                                  </div>
                                  <div class="row mt-3">
                                      <div class="col-lg-12">
                                          <div id="Issuances" style="width:100%"></div>

                                          <script>
                                          var xArray = ["Issued FSIC<br>for Occupancy", "Issued With NOD<br>for NOT OCCUPIED buildings/establishments", "Issued With NTC for<br>OCCUPIED buildings/establishments"];
                                          var yArray = [10, 8, 18];
                                          var aArray = ["Issued FSIC<br>for Occupancy", "Issued With NOD<br>for NOT OCCUPIED buildings/establishments", "Issued With NTC for<br>OCCUPIED buildings/establishments"];
                                          var bArray = [12, 8, 20];
                                          var cArray = ["Issued FSIC<br>for Occupancy", "Issued With NOD<br>for NOT OCCUPIED buildings/establishments", "Issued With NTC for<br>OCCUPIED buildings/establishments"];
                                          var dArray = [12, 32, 44];

                                          var data = [{
                                          x:xArray,
                                          y:yArray,
                                          name: "For Current Month (Within the Month)",
                                          type:"bar"
                                          },
                                          {
                                          x:aArray,
                                          y:bArray,
                                          name: "From Previous Month",
                                          type:"bar"
                                          },
                                          {
                                          x:cArray,
                                          y:dArray,
                                          name:"Total",
                                          type:"bar"
                                          }];

                                          var layout = {title:"Issuances"};

                                          Plotly.newPlot("Issuances", data, layout);
                                          </script>
                                      </div>
                                  </div>
                              </div>
                          </div>
                        </div>
                        <?php }?>
                        <?php }?>
                      </div>
                    </div>
                    <div class="tab-pane fade active" id="bus-estab" role="tabpanel" aria-labelledby="bus-estab">
                      <div class="row">
                        <div class="col-lg-6"></div>
                        <div class="col-lg-6 text-end">
                          <div class="form-group m-0">
                            <div class="input-group">
                            <select name="" id="" class="form-control text-black">
                              <?php for($increase1 = $nowyear;$increase1>=$minus15year;$increase1--){?>
                              <option value="<?php echo $increase1?>"><?php echo $increase1?></option>
                              <?php }?>
                            </select>
                            <select name="" id="" class="form-control text-black">
                              <?php foreach($montharray as $bussinesshsmonth){?>
                              <option value="<?php echo $bussinesshsmonth?>"><?php echo $bussinesshsmonth?></option>
                              <?php }?>
                            </select>
                            <div class="input-group-append">
                              <button class="btn btn-sm btn-primary text-white" type="button">Search</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">

                        <div class="col card-title text-center fs-3"><b>BUSINESS OPERATIONS</b></div>
                        <div class="col-lg-12">
                          <div class="card">
                            <div class="card-body">
                              <h4>Number of Applications Received for BUSINESS ESTABLISHMENTS (within a month)</h4>
                              <div class="row text-center">
                                <div class="col-lg-4 border border-2 rounded p-2">
                                  <h5>NEW</h5>
                                  <input type="text" name="" id="" class="form-control" readonly>
                                </div>
                                <div class="col-lg-4 border border-2 rounded p-2">
                                  <h5>RENEW</h5>
                                  <input type="text" name="" id="" class="form-control mt-auto" readonly>
                                </div>
                                <div class="col-lg-4 border border-2 rounded p-2">
                                  <h5>Total</h5>
                                  <input type="text" name="" id="" class="form-control mt-auto" readonly>
                                </div>
                              </div>
                              <div id="INSPECTION1" style="width:100%;"></div>
                              <script>
                                var xArray = [
                                  <?php foreach($struturearray as $shstruturearray1){?>
                                    <?php echo "'".$shstruturearray1."',"?>
                                  <?php }?>
                                ];
                                var yArray = [55, 49, 44, 24, 15,44, 24, 15,23,12,123,23,23];
                                var data = [{
                                  x:xArray,
                                  y:yArray,
                                  type:"bar"
                                }];
                                // Define Layout
                                var layout = {
                                  title: "1st INSPECTION"
                                };

                                Plotly.newPlot("INSPECTION1", data, layout);
                              </script>
                              <div class="col-lg-6 text-center ms-auto me-auto">
                                <h4>Total Number of Inspected from 1st Inspection</h4>
                              </div>
                              <div class="col-lg-6 ms-auto me-auto border border-2 rounded p-2">
                                <input type="text" name="" id="" class="form-control mt-auto" readonly>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <?php include_once "footer.php"?>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="../template/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="../template/vendors/chart.js/Chart.min.js"></script>
    <script src="../template/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="../template/vendors/progressbar.js/progressbar.min.js"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../template/js/off-canvas.js"></script>
    <script src="../template/js/hoverable-collapse.js"></script>
    <script src="../template/js/template.js"></script>
    <script src="../template/js/settings.js"></script>
    <script src="../template/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="../template/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="../template/js/dashboard.js"></script>

    <!-- End custom js for this page-->
  </body>

  </html>

