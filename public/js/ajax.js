function createXhr(){
	let xhr ;
	try {
		xhr = new ActiveXObject('Msxml2.XMLHTTP');
	} catch(e) {
		try {
			xhr = new ActiveXObject('Microsoft.XMLHTTP');
		} catch(e) {
			try{
				xhr = new XMLHttpRequest();
			}catch(e){
				console.log("Failed to create xhr" + e);
			}
		}
	}
	return xhr;
}

function close(){
	document.getElementById('myModal').classList.remove('show');
	document.getElementById('myModal').style.display = 'none';
}

function submitForm(  ){
	let form = document.querySelector("#form");
	let formdata = new FormData(form);
	let xhr = createXhr();
	xhr.onreadystatechange = function(){
		// inona ny ato
		if( xhr.readyState == 4 ){
			let e = xhr.responseText;
			if( xhr.status == 200 ){
				let link = JSON.parse(xhr.responseText);
				window.location.href = link.link;
			}else{
				let error = JSON.parse(e);
				if( error.hasOwnProperty("errors") ){
					document.getElementById('myModal').classList.add('show');
					document.getElementById('myModal').style.display = 'block';
					callBack( JSON.parse(error.errors) );
				}
			}
		}
	};
	xhr.open('post' , '/testAdd' , true);
	xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
	xhr.send(formdata);
}

function callBack( objects ){
	let modals = document.querySelector("#myModal");
	let container = modals.querySelector("#card");
	for( i = 0 ; i < objects.length ; i++ ){
		// console.log(objects[i]);
		let r = createTemplate( objects[i].compte , objects[i].error);
		container.appendChild(r);
	}

}

function createTemplate( charges , error  ){
	let url = "add-percentage/";
	let e = document.createElement("div");
	let a = document.createElement("div");
	let o = document.createElement("div");
	let charge = document.createElement("div");
	let errors = document.createElement("div");
	let error_p = document.createElement("p");
	let link = document.createElement("a");
	e.classList.add("card");
	a.classList.add("card-body" , "d-flex" , "shadow" , "justify-content-between");
	o.classList.add("row");
	charge.classList.add("mt-1");
	errors.classList.add("mt-1");
	error_p.classList.add("text-danger");
	link.classList.add("btn","btn-primary");
	link.innerHTML = "Modifier";

	charge.innerHTML = charges;
	error_p.innerHTML = error;
	link.setAttribute("href", url + charges);
	link.setAttribute("target", "_blank");

	errors.appendChild(error_p);
	o.appendChild( charge );	
	o.appendChild( errors );
	o.appendChild(link);
	a.appendChild(o);
	e.appendChild(a);	

	return e;

}