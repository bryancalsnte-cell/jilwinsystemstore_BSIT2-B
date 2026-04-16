<?= $this->extend('theme/template') ?>

<?= $this->section('content') ?>

<div class="content-wrapper">
<div class="container-fluid">

<h2>🛒 POS SYSTEM</h2>

<div class="row">

<!-- PRODUCTS -->
<div class="col-md-6">
    <div class="card">
        <div class="card-header bg-primary text-white">Products</div>
        <div class="card-body">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Stock</th>
                        <th>Price</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($products as $p): ?>
                    <tr>
                        <td><?= $p['name'] ?></td>
                        <td><?= $p['quantity'] ?></td>
                        <td>₱<?= $p['price'] ?></td>
                        <td>
                            <button class="btn btn-success addCart"
                                data-id="<?= $p['id'] ?>"
                                data-name="<?= $p['name'] ?>"
                                data-price="<?= $p['price'] ?>">
                                Add
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<!-- CART -->
<div class="col-md-6">
    <div class="card">
        <div class="card-header bg-success text-white">Cart</div>
        <div class="card-body">

            <table class="table table-bordered" id="cartTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

            <h4>Total: ₱<span id="grandTotal">0</span></h4>

            <button class="btn btn-primary btn-block" id="checkoutBtn">CHECKOUT</button>

        </div>
    </div>
</div>

</div>

</div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script> const baseUrl = "<?= base_url() ?>"; </script>
<script src="<?= base_url('js/pos/pos.js') ?>"></script>
<?= $this->endSection() ?>