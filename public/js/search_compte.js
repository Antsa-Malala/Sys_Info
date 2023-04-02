const searchForm = document.querySelector('#formulaire_recherche');
const searchResults = document.querySelector('#resultats');

function fetchData( element ){
    let r = element;
    let value = r.value;
    value = value.trim();
    const tbody = document.querySelector('tbody#resultats');
    let mainResults = document.querySelector('.main-result');
    if( value.length == 0 ){
        mainResults.style = 'block';
        tbody.style.display='none';
    }else{
        fetch(`/search_journal?recherche=${value}`,{
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response=>response.json())
        .then(data=>{
            if (data.length > 0) {
                mainResults.style.display = 'none';
                data.forEach(journaux => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${journaux.code}</td>
                        <td>${journaux.libelle}</td>
                    `;
                    tbody.appendChild(row);
                });

                // searchResults.appendChild(table);
            }else {
                const noResults = document.createElement('div');
                noResults.textContent = 'Aucun resultat.';
                // searchResults.appendChild(noResults);
            } 
        });

    }
}

// searchForm.addEventListener('submit', (e) => {
//     e.preventDefault();
    
//     const query = searchForm.querySelector('input[name="recherche"]').value;
    
//     fetch(`/search_compte?recherche=${query}`, {
//         headers: {
//             'X-Requested-With': 'XMLHttpRequest'
//         }
//     })
//     .then(response => response.json())
//     .then(data => {
//         searchResults.innerHTML = '';

//         if (data.length > 0) {
//             const table = document.createElement('table');
//             table.classList.add('table');
//             table.innerHTML = `
//                 <thead>
//                     <tr>
//                         <th>Compte</th>
//                         <th>Libelle</th>
//                     </tr>
//                 </thead>
//                 <tbody></tbody>
//             `;
//             const tbody = table.querySelector('tbody');

//             data.forEach(plans => {
//                 const row = document.createElement('tr');
//                 row.innerHTML = `
//                     <td>${plans.compte}</td>
//                     <td>${plans.libelle}</td>
//                 `;
//                 tbody.appendChild(row);
//             });

//             searchResults.appendChild(table);
//         }else {
//             const noResults = document.createElement('div');
//             noResults.textContent = 'Aucun resultat.';
//             searchResults.appendChild(noResults);
//         }
//     });
// });

