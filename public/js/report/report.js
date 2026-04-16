function loadSales() {
    let date = $('#reportDate').val();

    $.get(baseUrl + 'reports/daily-sales?date=' + date, function(data){
        let html = '';

        if (data.length === 0) {
            html = `<tr><td colspan="3" class="text-center">No sales data</td></tr>`;
        } else {
            data.forEach(row => {
                html += `
                    <tr>
                        <td>${row.name}</td>
                        <td>${row.total_qty}</td>
                        <td>₱${parseFloat(row.total_sales).toFixed(2)}</td>
                    </tr>
                `;
            });
        }

        $('#salesTable tbody').html(html);
    });
}

function loadInventory() {
    $.get(baseUrl + 'reports/inventory', function(data){
        let html = '';

        data.forEach(row => {
            html += `
                <tr>
                    <td>${row.name}</td>
                    <td>${row.quantity}</td>
                    <td>₱${parseFloat(row.price).toFixed(2)}</td>
                </tr>
            `;
        });

        $('#inventoryTable tbody').html(html);
    });
}

$(document).ready(function(){
    loadSales();
    loadInventory();

    $('#reportDate').on('change', function(){
        loadSales();
    });
});