<?= $this->extend('theme/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
<div class="container-fluid">

<h2>📊 Reports</h2>

<!-- DATE FILTER -->
<div class="mb-3">
    <label>Select Date:</label>
    <input type="date" id="reportDate" class="form-control" value="<?= date('Y-m-d') ?>">
</div>

<!-- DAILY SALES -->
<div class="card">
    <div class="card-header bg-primary text-white">
        Daily Sales
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="salesTable">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty Sold</th>
                    <th>Total Sales</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<!-- INVENTORY -->
<div class="card mt-3">
    <div class="card-header bg-success text-white">
        Inventory Report
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="inventoryTable">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Stock</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

</div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>

function loadSales() {
    let date = $('#reportDate').val();

    $.get(baseUrl + 'reports/daily-sales?date=' + date, function(data){
        let html = '';
        data.forEach(row => {
            html += `
                <tr>
                    <td>${row.name}</td>
                    <td>${row.total_qty}</td>
                    <td>₱${parseFloat(row.total_sales).toFixed(2)}</td>
                </tr>
            `;
        });
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

<?= $this->section('scripts') ?>
<script> const baseUrl = "<?= base_url() ?>"; </script>
<script src="<?= base_url('js/report/report.js') ?>"></script>
<?= $this->endSection() ?>

</script>
<?= $this->endSection() ?>