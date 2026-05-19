<?= $this->extend('theme/template') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">

  <!-- HEADER -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">

        <div class="col-sm-6">
          <h1 class="m-0">
            <i class="fa fa-box"></i> Products
          </h1>
        </div>

        <div class="col-sm-6 text-right">

          <!-- ADD BUTTON -->
          <button class="btn btn-primary"
                  data-toggle="modal"
                  data-target="#AddModal">
            <i class="fa fa-plus"></i> Add Product
          </button>

          <!-- REFRESH BUTTON -->
          <button class="btn btn-success" id="refreshBtn">
            <i class="fa fa-sync"></i> Refresh
          </button>

          <!-- PRINT BUTTON -->
          <button class="btn btn-dark" onclick="window.print()">
            <i class="fa fa-print"></i> Print
          </button>

        </div>

      </div>
    </div>
  </div>

  <!-- CONTENT -->
  <section class="content">
    <div class="container-fluid">

      <div class="card card-primary card-outline">

        <div class="card-header">
          <h3 class="card-title">
            <i class="fa fa-list"></i> Product List
          </h3>
        </div>

        <div class="card-body">

          <table id="example1"
                 class="table table-bordered table-striped table-hover table-sm">

            <thead class="bg-primary">
              <tr>
                <th width="5%">No.</th>
                <th style="display:none;">ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th width="20%">Actions</th>
              </tr>
            </thead>

            <tbody>
              <!-- DATA LOADED BY AJAX -->
            </tbody>

          </table>

        </div>
      </div>
    </div>

  </section>
</div>

<!-- ================= ADD MODAL ================= -->
<div class="modal fade" id="AddModal">
  <div class="modal-dialog">
    <form id="addForm">

      <?= csrf_field() ?>

      <div class="modal-content">

        <div class="modal-header bg-primary">
          <h5 class="modal-title">
            <i class="fa fa-plus"></i> Add Product
          </h5>

          <button type="button"
                  class="close text-white"
                  data-dismiss="modal">
            &times;
          </button>
        </div>

        <div class="modal-body">

          <div class="form-group">
            <label>Product Name</label>
            <input type="text"
                   name="name"
                   class="form-control"
                   placeholder="Enter product name"
                   required>
          </div>

          <div class="form-group">
            <label>Price</label>
            <input type="number"
                   name="price"
                   class="form-control"
                   placeholder="Enter price"
                   required>
          </div>

          <div class="form-group">
            <label>Quantity</label>
            <input type="number"
                   name="quantity"
                   class="form-control"
                   placeholder="Enter quantity"
                   required>
          </div>

        </div>

        <div class="modal-footer">

          <button type="button"
                  class="btn btn-secondary"
                  data-dismiss="modal">
            <i class="fa fa-times"></i> Cancel
          </button>

          <button type="submit"
                  class="btn btn-primary">
            <i class="fa fa-save"></i> Save
          </button>

        </div>

      </div>
    </form>
  </div>
</div>

<!-- ================= EDIT MODAL ================= -->
<div class="modal fade" id="EditModal">
  <div class="modal-dialog">

    <form id="editForm">

      <?= csrf_field() ?>

      <div class="modal-content">

        <div class="modal-header bg-warning">
          <h5 class="modal-title">
            <i class="fa fa-edit"></i> Edit Product
          </h5>

          <button type="button"
                  class="close"
                  data-dismiss="modal">
            &times;
          </button>
        </div>

        <div class="modal-body">

          <input type="hidden" name="id" id="id">

          <div class="form-group">
            <label>Product Name</label>
            <input type="text"
                   name="name"
                   id="name"
                   class="form-control">
          </div>

          <div class="form-group">
            <label>Price</label>
            <input type="number"
                   name="price"
                   id="price"
                   class="form-control">
          </div>

          <div class="form-group">
            <label>Quantity</label>
            <input type="number"
                   name="quantity"
                   id="quantity"
                   class="form-control">
          </div>

        </div>

        <div class="modal-footer">

          <button type="button"
                  class="btn btn-secondary"
                  data-dismiss="modal">
            <i class="fa fa-times"></i> Cancel
          </button>

          <button type="submit"
                  class="btn btn-warning">
            <i class="fa fa-save"></i> Update
          </button>

        </div>

      </div>
    </form>
  </div>
</div>

<?= $this->endSection() ?>

<!-- ================= SCRIPTS ================= -->
<?= $this->section('scripts') ?>

<script>
    const baseUrl = "<?= base_url() ?>";

    // Refresh Button
    $('#refreshBtn').click(function () {
        location.reload();
    });
</script>

<script src="<?= base_url('js/product/product.js') ?>"></script>

<?= $this->endSection() ?>