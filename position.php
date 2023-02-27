<?php if($_GET['choose'] == "Provincial"){?>
    <option>-- Choose --</option>
    <option value="Batangas">Batangas</option>
    <option value="Cavite">Cavite</option>
    <option value="Laguna">Laguna</option>
    <option value="Quezon">Quezon</option>
    <option value="Rizal">Rizal</option>
<?php } elseif($_GET['choose'] == "Municipal") {?>
    <option>-- Choose --</option>
    <?php $batangas = array('Agoncillo','Alitagtag','Balayan','Balete','Batangas City','Bauan',
		'Calaca','Calatagan','Cuenca','Ibaan','Laurel','Lemery',
		'Lian','Lipa','Lobo','Mabini', 'Malvar','Mataas na kahoy',
		'Nasugbu','Padre Garcia','Rosario','San Jose','San Juan','San Luis',
		'San Nicolas','San Pascual','Santa Teresita','Santo Tomas','Taal',
		'Talisay','Tanauan','Taysan','Tingloy','Tuy')?>
    <?php $cavite = array('Alfonso','Amadeo','Bacoor','Carmona','Cavite City','Dasmariñas',
		'General Emilio Aguinaldo','General Mariano Alvarez','General Trias','Imus','Indang','Kawit',
		'Magallanes','Maragondon','Mendez','Naic','Noveleta','Rosario',
		'Silang','Tagaytay','Tanza','Ternate','Trece Martires')?>
    <?php $laguna = array('Alaminos','Bay','Biñan','Cabuyao','Calamba','Calauan',
		'Cavinti','Famy','Kalayaan','Liliw','Los Baños','Luisiana',
		'Lumban','Mabitac','Magdalena','Majayjay','Nagcarlan','Paete',
		'Pagsanjan','Pakil','Pangil','Pila','Rizal','San Pablo','San Pedro',
		'Santa Cruz','Santa Maria','Santa Rosa','Siniloan','Victoria')?>
    <?php $quezon = array('Agdangan','Alabat','Atimonan','Buenavista','Burdeos','Calauag',
		'Candelaria','Catanauan','Dolores','General Luna','General Nakar','Guinayangan',
		'Gumaca','Infanta','Jomalig','Lopez','Lucban','Lucena',		
		'Macalelon','Mauban','Mulanay','Padre Burgos','Pagbilao','Panukulan',
		'Patnanungan','Perez','Pitogo','Plaridel','Polillo','Quezon',
		'Real','Sampaloc','San Andres','San Antonio','San Francisco','San Narciso',	
		'Sariaya','Tagkawayan','Tayabas','Tiaong','Unisan')?>
    <?php $rizal = array('Angono','Antipolo','Baras','Binangonan','Cainta','Cardona',
		'Jalajala','Morong','Pililla','Rodriguez','San Mateo','Tanay',
		'Taytay','Teresa')?>
    <?php foreach($batangas as $shbatangas){?>
        <option value="<?php echo $shbatangas?>"><?php echo $shbatangas?></option>
    <?php }?>
    <?php foreach($cavite as $shcavite){?>
        <option value="<?php echo $shcavite?>"><?php echo $shcavite?></option>
    <?php }?>
    <?php foreach($laguna as $shlaguna){?>
        <option value="<?php echo $shlaguna?>"><?php echo $shlaguna?></option>
    <?php }?>
    <?php foreach($quezon as $shquezon){?>
        <option value="<?php echo $shquezon?>"><?php echo $shquezon?></option>
    <?php }?>
    <?php foreach($rizal as $shrizal){?>
        <option value="<?php echo $shrizal?>"><?php echo $shrizal?></option>
    <?php }?>
<?php }?>