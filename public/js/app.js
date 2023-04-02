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

function clone(){
	let c = document.querySelector('#original');
	// azo izay ny original
	// Inona ny manaraka
	// console.log('AOUEEE');
	let clone = c.cloneNode(true);
	clone.removeAttribute('id');
	let inputs = clone.querySelectorAll('input');
	let selects = clone.querySelectorAll('select');
	inputs.forEach(input=>{
		console.log('ito=====>' + input.getAttribute('type'));
		if( !input.hasAttribute('readonly') ) input.value = '';
		if( input.getAttribute('type') === 'number') input.value = '0';
	});
	selects.forEach(select=> select.selectedIndex = 0 );
	document.querySelector('#operations').appendChild(clone);
}

function validate( component ){
	let inputs = component.querySelectorAll('input');
	let empty = false;
	inputs.forEach(input=>{
		if( !input.hasAttribute('readonly') ){
			if( input.value == '' ){
				empty = true;
			}
		}
	});

	if( !empty ){
		clone();
	}else{
		remove();
	}
}

function remove(){
	let all = document.querySelectorAll('.multiple-add');
	all[all.length-1].setAttribute('disabled', true);
	// document.re
}
