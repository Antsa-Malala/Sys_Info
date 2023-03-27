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

// Vita ny mamorona xhr
// Ny manaraka dia ny hoe mandefa an'ilay form mankany

function submitForm(  ){
	let form = document.querySelector("#ajax-form");
	let formdata = new FormData(form);
	let xhr = createXhr();
	console.log(xhr);
	xhr.onreadystatechange = function(){
		// inona ny ato
		if( xhr.readyState == 4 ){
			let e = xhr.responseText;
			if( xhr.status == 200 ){
				// Alefa makany amin'ny page hafa ila izy
				let link = JSON.parse(xhr.responseText);
				window.location.href = link.link;
			}else{
				let error = JSON.parse(e);
				alert(error.error);
			}
		}
	};
	xhr.open('post' , '/testAdd' , true);
	xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
	xhr.send(formdata);
}