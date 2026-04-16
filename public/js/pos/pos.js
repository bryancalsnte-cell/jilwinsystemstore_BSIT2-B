let cart = [];

function renderCart() {
    let html = '';
    let total = 0;

    cart.forEach(item => {
        let subtotal = item.qty * item.price;
        total += subtotal;

        html += `
            <tr>
                <td>${item.name}</td>
                <td>${item.qty}</td>
                <td>${item.price}</td>
                <td>${subtotal}</td>
            </tr>
        `;
    });

    $('#cartTable tbody').html(html);
    $('#grandTotal').text(total.toFixed(2));
}

// ADD TO CART
$(document).on('click', '.addCart', function () {
    const id = $(this).data('id');
    const name = $(this).data('name');
    const price = $(this).data('price');

    let qty = prompt("Enter quantity:");

    if (!qty || qty <= 0) return;

    let existing = cart.find(item => item.id == id);

    if (existing) {
        existing.qty += parseInt(qty);
    } else {
        cart.push({ id, name, price, qty: parseInt(qty) });
    }

    renderCart();
});

// CHECKOUT
$('#checkoutBtn').on('click', function () {

    if (cart.length === 0) {
        alert('Cart is empty!');
        return;
    }

    $.ajax({
        url: baseUrl + 'pos/checkout',
        method: 'POST',
        data: { cart: cart },
        dataType: 'json',
        success: function (res) {
            if (res.status === 'success') {
                alert('Transaction successful!');
                cart = [];
                renderCart();
                location.reload();
            } else {
                alert(res.message);
            }
        }
    });

});