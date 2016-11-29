function start(){
	var myElement = document.registerElement('my-element');
	document.body.appendChild(new myElement());
}
	  
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}

function odpriMeni() {
	 alert("Hello! I am an alert box!!");
}

function prikaziMenu() {
 var getMenuItems = document.querySelector(".resp");

 var menuItems = getMenuItems.children;
 var i;
 for (i = menuItems.length-1;i>0;--i) {
     getMenuItems.append(menuItems[i]);
 }

 if (getMenuItems.className === "header") {
     getMenuItems.className = "header small";
 }
 else if(getMenuItems.className != "header") {
     getMenuItems.className = "header";
 }
}


function getLocation() {
	x = document.getElementById("map");
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}
function showPosition(position) {
    var latlon = position.coords.latitude + "," + position.coords.longitude;

    var img_url = "https://maps.googleapis.com/maps/api/staticmap?center=
    "+latlon+"&zoom=14&size=400x300&sensor=false/Storžiška+ulica+6,+4000+Kranj";

    document.getElementById("mapholder").innerHTML = "<img src='"+img_url+"'>";
}