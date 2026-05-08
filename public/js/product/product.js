function showToast(type, message) {
    if (type === 'success') {
        toastr.success(message, 'Success');
    } else {
        toastr.error(message, 'Error');
    }
}

// ✅ ADD PRODUCT
$('#addForm').on('submit', function (e) {
    e.preventDefault();

    $.ajax({
        url: baseUrl + 'product/save',
        method: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function (response) {
            if (response.status === 'success') {
                $('#AddModal').modal('hide');
                $('#addForm')[0].reset();
                showToast('success', 'Product added successfully!');
                setTimeout(() => location.reload(), 800);
            } else {
                showToast('error', response.message || 'Failed to add product.');
            }
        },
        error: function () {
            showToast('error', 'An error occurred.');
        }
    });
});

// ✅ EDIT BUTTON
$(document).on('click', '.edit-btn', function () {
    const id = $(this).data('id');

    $.get(baseUrl + 'product/edit/' + id, function (response) {
        if (response.data) {
            $('#EditModal #id').val(response.data.id);
            $('#EditModal #name').val(response.data.name);
            $('#EditModal #price').val(response.data.price);
            $('#EditModal #quantity').val(response.data.quantity);
            $('#EditModal').modal('show');

            actions =
`
<button class="btn btn-warning btn-sm editBtn">
    <i class="fa fa-edit"></i>
</button>

<button class="btn btn-danger btn-sm deleteBtn">
    <i class="fa fa-trash"></i>
</button>
`;
        }
    }, 'json');
});

// ✅ UPDATE PRODUCT
$('#editForm').on('submit', function (e) {
    e.preventDefault();

    $.post(baseUrl + 'product/update', $(this).serialize(), function (response) {
        if (response.success) {
            $('#EditModal').modal('hide');
            showToast('success', 'Product updated!');
            setTimeout(() => location.reload(), 800);
        } else {
            showToast('error', response.message || 'Update failed');
        }
    }, 'json');
});

// ✅ DELETE PRODUCT
$(document).on('click', '.deleteBtn', function () {
    const id = $(this).data('id');

    if (confirm('Delete this product?')) {
        $.post(baseUrl + 'product/delete/' + id, { _method: 'DELETE' }, function (res) {
            if (res.success) {
                showToast('success', 'Deleted successfully!');
                setTimeout(() => location.reload(), 800);
            } else {
                showToast('error', res.message);
            }
        }, 'json');
    }
});

// ✅ STOCK IN
$(document).on('click', '.stock-in', function () {
    const id = $(this).data('id');
    const qty = prompt("Enter quantity to ADD:");

    if (qty && qty > 0) {
        $.post(baseUrl + 'product/stock-in', {
            product_id: id,
            quantity: qty
        }, function (res) {
            if (res.status === 'success') {
                showToast('success', 'Stock added!');
                setTimeout(() => location.reload(), 800);
            } else {
                showToast('error', res.message);
            }
        }, 'json');
    }
});

// ✅ STOCK OUT
$(document).on('click', '.stock-out', function () {
    const id = $(this).data('id');
    const qty = prompt("Enter quantity to REMOVE:");

    if (qty && qty > 0) {
        $.post(baseUrl + 'product/stock-out', {
            product_id: id,
            quantity: qty
        }, function (res) {
            if (res.status === 'success') {
                showToast('success', 'Stock removed!');
                setTimeout(() => location.reload(), 800);
            } else {
                showToast('error', res.message);
            }
        }, 'json');
    }
});

// ✅ DATATABLE
$(document).ready(function () {

    $('#example1').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: baseUrl + 'product/fetchRecords',
            type: 'POST'
        },
        columns: [
            { data: 'row_number' },
            { data: 'id', visible: false },
            { data: 'name' },
            { 
                data: 'price',
                render: function(data){
                    return '₱' + parseFloat(data).toFixed(2);
                }
            },
            { data: 'quantity' },
            {
                data: null,
                orderable: false,
                searchable: false,
                render: function (data, type, row) {
                    return `
                        <button class="btn btn-sm btn-success stock-in" data-id="${row.id}">IN</button>
                        <button class="btn btn-sm btn-danger stock-out" data-id="${row.id}">OUT</button>

                        <button class="btn btn-sm btn-warning edit-btn" data-id="${row.id}">
                            <i class="far fa-edit"></i>
                        </button>

                        <button class="btn btn-sm btn-danger deleteBtn" data-id="${row.id}">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    `;
                }
            }
        ],
        responsive: true,
        autoWidth: false
    });

});