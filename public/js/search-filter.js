function submitSearch() {
    const startDate = document.getElementById('start').value;
        const endDate = document.getElementById('end').value;

        const tableRows = document.querySelectorAll('tbody tr'); 

        if (tableRows.length === 0) {
            console.error('No table rows found.');
            return;
        }

        tableRows.forEach(row => {
            const rowDateElement = row.querySelector('#date-column'); 

            if (!rowDateElement) {
                console.error('Date column not found in the row:', row);
                return;
            }

            const rowDate = rowDateElement.textContent; 
            const currentDate = new Date(rowDate);

            if (currentDate >= new Date(startDate) && currentDate <= new Date(endDate)) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });
    }
