function cloneProduct(){
	let _NAME = "produit[]";
	let _POURCENTAGE = "pourcentage[]";
	let c = document.querySelector('#original');
	let tr = document.createElement('tr');
	let td1 = document.createElement('td');
	let td2 = document.createElement('td');
	let data1 = document.createElement('input');
	let data2 = document.createElement('input');
	let i = document.querySelector('#products');
	let j = document.querySelector('#pourcent');
	let select = i.value;
	let pourcentage = j.value;
	if( pourcentage == '' ){
		return;
	}
	data1.value = i.options[i.selectedIndex].text;
	data2.value = pourcentage;
	data1.setAttribute( 'name' , _NAME );
	data2.setAttribute( 'name' , _POURCENTAGE );
	data1.setAttribute('readonly' , 'true' );
	data2.setAttribute('readonly' , 'true');
	data1.classList.add("form-control");
	data2.classList.add("form-control");
	td1.appendChild(data1);
	td2.appendChild(data2);
	tr.appendChild(td1);
	tr.appendChild(td2);
	c.appendChild( tr );
}

function submitForm(  ){
	let form = document.querySelector("#form");
	let formdata = new FormData(form);
	let xhr = createXhr();
	xhr.onreadystatechange = function(){
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
	xhr.open('post' , '/produit-modif' , true);
	xhr.send(formdata);
}
