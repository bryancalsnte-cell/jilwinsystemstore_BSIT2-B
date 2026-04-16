<?= $this->extend('theme/template') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Products</h1>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Product List</h3>
          <div class="float-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#AddModal">
              <i class="fa fa-plus"></i> Add Product
            </button>
          </div>
        </div>

        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped table-sm">
            <thead>
              <tr>
                <th>No.</th>
                <th style="display:none;">id</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- ADD MODAL -->
    <div class="modal fade" id="AddModal">
      <div class="modal-dialog">
        <form id="addForm">
          <?= csrf_field() ?>
          <div class="modal-content">
            <div class="modal-header">
              <h5>Add Product</h5>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
              <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
              </div>

              <div class="form-group">
                <label>Price</label>
                <input type="number" name="price" class="form-control" required>
              </div>

              <div class="form-group">
                <label>Quantity</label>
                <input type="number" name="quantity" class="form-control" required>
              </div>
            </div>

            <div class="modal-footer">
              <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- EDIT MODAL -->
    <div class="modal fade" id="EditModal">
      <div class="modal-dialog">
        <form id="editForm">
          <?= csrf_field() ?>
          <div class="modal-content">
            <div class="modal-header">
              <h5>Edit Product</h5>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
              <input type="hidden" name="id" id="id">

              <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" id="name" class="form-control">
              </div>

              <div class="form-group">
                <label>Price</label>
                <input type="number" name="price" id="price" class="form-control">
              </div>

              <div class="form-group">
                <label>Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control">
              </div>
            </div>

            <div class="modal-footer">
              <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </div>
        </form>
      </div>
    </div>

  </section>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script> const baseUrl = "<?= base_url() ?>"; </script>
<script src="<?= base_url('js/product/product.js') ?>"></script>
<?= $this->endSection() ?>