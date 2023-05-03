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
				alert(error.error);
			}
		}
	};
	xhr.open('post' , '/testAdd' , true);
	xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
	xhr.send(formdata);
}