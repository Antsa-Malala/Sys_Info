function GetFrom( element ){
	let link = element.getAttribute("href");
	let xhr = createXhr();
	xhr.onreadystatechange = function(){
		if( xhr.readyState == 4 ){
			if( xhr.status == 200 ){
				let e = JSON.parse(xhr.responseText);
				console.log(e);
			}else{
				alert(xhr.responseText);
			}
		}
	}
	xhr.open("GET" , '/TestGet/1' , true);
	xhr.send(null);
}

function makePagination( currentPage , pages , showBy = 5 , url , container){
	let starting = Math.max(currentPage - showBy , currentPage);
	let ending = Math.min(currentPage + showBy , pages);
	container = document.querySelector(container);
	let li1 = document.createElement("li");
	let li2 = document.createElement("li");
	let a1 = document.createElement("a");
	let a2 = document.createElement("a");
	// Okey inona no atao anatiny
	li1.classList.add("page-item");
	li2.classList.add("page-item");
	a1.classList.add("page-link");
	a2.classList.add("page-link");
	a1.setAttribute("href", url + "/" + parseInt(parseInt(currentPage) - 1));
	a2.setAttribute("href", url + "/" + parseInt(parseInt(currentPage) + 1));
	a1.innerHTML = "Prev";
	a2.innerHTML = "Next";
	if( currentPage == 1 ){
		li1.classList.add("disabled");
	}
	if( currentPage == pages ){
		li2.classList.add("disabled");
	}
	li1.appendChild(a1);
	container.appendChild(li1);
	// Tokony hoe Atao ... ny afaran'ilay page rehetra sy izay any aoriana
	for( let i = starting ; i <= ending ; i++ ){
		let li = document.createElement("li");
		li.classList.add("page-item");
		if( i == currentPage ){
			li.classList.add("active");
			li.setAttribute("aria-current" , "page");
		}
		let a = document.createElement("a");
		a.classList.add("page-link");
		a.setAttribute("href" , url + "/" +i);
		let Text = document.createTextNode(i);
		a.appendChild(Text);
		li.appendChild(a);
		container.appendChild(li);
	}
	li2.appendChild(a2);
	container.appendChild(li2);
	
}

function validate( element ){
	let e = element.value;
	let n = element.nextSibling;
	while (n.nodeType !== 1) { // Skip non-element nodes
    	n = n.nextSibling;
  	}
	if( e[0] == '6' ){
		n.classList.remove("d-none");
		let b = n.querySelector(".row__btn");
		let url = b.getAttribute('href');
		let lastIndex = url.lastIndexOf("/");
		url = url.substring( 0 , lastIndex + 1 );
		b.setAttribute( 'href' , url + e );
	}else{
		n.classList.add('d-none');
	}
} 