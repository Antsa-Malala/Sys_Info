// Inona le atao
// Jerena hoe raha sendra ka on-click ilay izy de tsy apoitra ilay select iray
// Alaina ny next sibling rehetra
// Mila alaina aloha ilay izy
// Avy eo alaina ny id an'ilay izy

function hide( element ){
	// Ahoana no anaovana azy hide
	let parent = element.parentElement;
	var sibling = parent.nextElementSibling;
	element.addEventListener('keyup',(e)=>{
		console.log(element.value.length);
		if( element.value.length > 0  ){
			sibling.classList.add('d-none');
			console.log(sibling);
		}else{
			sibling.classList.remove('d-none');
		}
	});
}

function hideInput( element ){
	// Ito zao le input type file
	let parent = element.parentElement;
	let previous = parent.previousElementSibling;
	element.addEventListener('change',()=>{
		if( element.files.length > 0 ){
			previous.classList.add('d-none');
		}else{
			previous.classList.remove('d-none');
		}
	});
}