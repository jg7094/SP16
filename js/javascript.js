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

function getCoordinates(){
	
}
