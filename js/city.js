/**
* Philippine Provinces & Cities/Municipalities on HTML Dropdown
*
* @ version 1.0.0
* @ author Marvic R. Macalintal
*/
 var cities = {
	'Batangas' : [
		'Agoncillo','Alitagtag','Balayan','Balete','Batangas City','Bauan',
		'Calaca','Calatagan','Cuenca','Ibaan','Laurel','Lemery',
		'Lian','Lipa','Lobo','Mabini', 'Malvar','Mataas na kahoy',
		'Nasugbu','Padre Garcia','Rosario','San Jose','San Juan','San Luis',
		'San Nicolas','San Pascual','Santa Teresita','Santo Tomas','Taal',
		'Talisay','Tanauan','Taysan','Tingloy','Tuy'
		],
	'Cavite' : [
		'Alfonso','Amadeo','Bacoor','Carmona','Cavite City','Dasmariñas',
		'General Emilio Aguinaldo','General Mariano Alvarez','General Trias','Imus','Indang','Kawit',
		'Magallanes','Maragondon','Mendez','Naic','Noveleta','Rosario',
		'Silang','Tagaytay','Tanza','Ternate','Trece Martires'
		],
	'Laguna' : [
		'Alaminos','Bay','Biñan','Cabuyao','Calamba','Calauan',
		'Cavinti','Famy','Kalayaan','Liliw','Los Baños','Luisiana',
		'Lumban','Mabitac','Magdalena','Majayjay','Nagcarlan','Paete',
		'Pagsanjan','Pakil','Pangil','Pila','Rizal','San Pablo','San Pedro',
		'Santa Cruz','Santa Maria','Santa Rosa','Siniloan','Victoria'
		],
	'Quezon' : [
		'Agdangan','Alabat','Atimonan','Buenavista','Burdeos','Calauag',
		'Candelaria','Catanauan','Dolores','General Luna','General Nakar','Guinayangan',
		'Gumaca','Infanta','Jomalig','Lopez','Lucban','Lucena',		
		'Macalelon','Mauban','Mulanay','Padre Burgos','Pagbilao','Panukulan',
		'Patnanungan','Perez','Pitogo','Plaridel','Polillo','Quezon',
		'Real','Sampaloc','San Andres','San Antonio','San Francisco','San Narciso',	
		'Sariaya','Tagkawayan','Tayabas','Tiaong','Unisan'
		],		
	'Rizal' : [
		'Angono','Antipolo','Baras','Binangonan','Cainta','Cardona',
		'Jalajala','Morong','Pililla','Rodriguez','San Mateo','Tanay',
		'Taytay','Teresa'		
		],
 }

 var City = function() {

	this.p = [],this.c = [],this.a = [],this.e = {};
	window.onerror = function() { return true; }
	
	this.getProvinces = function() {
		for(let province in cities) {
			this.p.push(province);
		}
		return this.p;
	}
	this.getCities = function(province) {
		if(province.length==0) {
			console.error('Please input province name');
			return;
		}
		for(let i=0;i<=cities[province].length-1;i++) {
			this.c.push(cities[province][i]);
		}
		return this.c;
	}
	this.getAllCities = function() {
		for(let i in cities) {
			for(let j=0;j<=cities[i].length-1;j++) {
				this.a.push(cities[i][j]);
			}
		}
		this.a.sort();
		return this.a;
	}
	this.showProvinces = function(element) {
		var str = '<option selected disabled>Select Province</option>';
		for(let i in this.getProvinces()) {
			str+='<option>'+this.p[i]+'</option>';
		}
		this.p = [];		
		document.querySelector(element).innerHTML = '';
		document.querySelector(element).innerHTML = str;
		this.e = element;
		return this;
	}
	this.showCities = function(province,element) {
		var str = '<option selected disabled>Select City / Municipality</option>';
		var elem = '';
		if((province.indexOf(".")!==-1 || province.indexOf("#")!==-1)) {
			elem = province;
		}
		else {
			for(let i in this.getCities(province)) {
				str+='<option>'+this.c[i]+'</option>';
			}
			elem = element;
		}
		this.c = [];
		document.querySelector(elem).innerHTML = '';
		document.querySelector(elem).innerHTML = str;
		document.querySelector(this.e).onchange = function() {		
			var Obj = new City();
			Obj.showCities(this.value,elem);
		}
		return this;
	}
}
