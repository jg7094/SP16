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

/*
var e = document.getElementById('komentar');
e.onmouseover = function() {
  document.getElementById('popup').style.display = 'block';

}
e.onmouseout = function() {
  document.getElementById('popup').style.display = 'none';
}
*/
function getCoordinates(){
	
}
