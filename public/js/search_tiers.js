const searchForm = document.querySelector('#formulaire_recherche');
const searchResults = document.querySelector('#resultats');

searchForm.addEventListener('submit', (e) => {
    e.preventDefault();
    
    const query = searchForm.querySelector('input[name="recherche"]').value;
    
    fetch(`/search_tiers?recherche=${query}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        searchResults.innerHTML = '';

        if (data.length > 0) {
            const table = document.createElement('table');
            table.innerHTML = `
                <thead>
                    <tr>
                        <th>Numero</th>
                        <th>Libelle</th>
                    </tr>
                </thead>
                <tbody></tbody>
            `;
            const tbody = table.querySelector('tbody');

            data.forEach(tiers=> {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${tiers.numero}</td>
                    <td>${tiers.libelle}</td>
                `;
                tbody.appendChild(row);
            });

            searchResults.appendChild(table);
        }else {
            const noResults = document.createElement('div');
            noResults.textContent = 'Aucun resultat.';
            searchResults.appendChild(noResults);
        }
    });
});
