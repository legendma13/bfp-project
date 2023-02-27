<?php include_once "check.php"?>

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