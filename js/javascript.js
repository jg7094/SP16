function start(){
	var myElement = document.registerElement('my-element');
	document.body.appendChild(new myElement());
}

function odpriMeni() {
	var getMenuItems = document.querySelector(".resp");
	
	if (getMenuItems.className === "resp") {
		getMenuItems.className = "resp drpdwn";
	}
	else if(getMenuItems.className != "resp") {
		getMenuItems.className = "resp";
	}
}

function kupi(){
	document.getElementById("gmb").style.display = 'none';
	document.getElementById("kupljeno").style.display = 'inline';
}

function racunaj(){
	var k = document.getElementById("quantity").value;
	document.getElementById("cena").innerHTML = 85 * k;
}

function getLocation(){

	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition, showError);
	} else {
		x.innerHTML = "Geolocation is not supported by this browser.";
	}
}

function showPosition(position) {
	var latlon = position.coords.latitude + "," + position.coords.longitude;
	var map_url = "https://www.google.si/maps/dir/"+latlon+"/Storžiška+ulica+6,+4000+Kranj";
	var win = window.open(map_url, '_blank');
	win.focus();
}

function showError(error) {
	switch(error.code) {
		case error.PERMISSION_DENIED:
			x.innerHTML = "User denied the request for Geolocation."
			break;
		case error.POSITION_UNAVAILABLE:
			x.innerHTML = "Location information is unavailable."
			break;
		case error.TIMEOUT:
			x.innerHTML = "The request to get user location timed out."
			break;
		case error.UNKNOWN_ERROR:
			x.innerHTML = "An unknown error occurred."
			break;
	}
}


function pokaziKomentar(){
	
	var c = document.getElementById("komentar").childNodes[3];
	//getfirstchildbyid???

	console.log(c);
	
	if (c.className === "skrit") {
		c.className = "skrit popup";
	}
	else if(c.className != "skrit") {
		c.className = "skrit";
	} 
}


var e = document.getElementById('komentar');
e.onmouseover = function() {
  document.getElementById('popup').style.display = 'block';
  document.getElementById('popup').className = 'popup';

}
e.onmouseout = function() {
  document.getElementById('popup').style.display = 'none';
}

