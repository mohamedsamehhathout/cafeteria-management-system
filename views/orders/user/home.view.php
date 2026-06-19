<?php

require base_path('views/partials/head.php');
require base_path('views/partials/sidebar.php');

?>

<div class="main">

    <?php require base_path('views/partials/navbar.php'); ?>

    <main class="page-body">

        <div class="manual-order-layout">

            <div class="products-panel">

                <div class="panel-header">

                    <h2>Products</h2>

                </div>
                <div class="products-toolbar">

    <input
        type="text"
        id="product-search"
        class="form-control"
        placeholder="🔍 Search products...">

</div>
                <div class="products-grid">

                    <?php foreach ($products as $product) : ?>

                        <div class="product-card" data-search="<?= strtolower($product['name'] . ' ' . $product['category_name']) ?>">

                            <img
                                src="<?= $product['image'] ?>"
                                class="product-image">

                            <h4>

                                <?= $product['name'] ?>

                            </h4>

                            <p>

                                <?= $product['price'] ?>
                                EGP

                            </p>

                            <button
                                class="act-btn act-edit add-product"
                                data-id="<?= $product['id'] ?>"
                                data-name="<?= $product['name'] ?>"
                                data-price="<?= $product['price'] ?>">

                                +

                            </button>

                        </div>

                    <?php endforeach; ?>

                </div>

            </div>

            <div class="cart-panel">
                <?php if (! empty($errors)) : ?>

                    <div class="alert-error">

                        <?php foreach ($errors as $error) : ?>

                            <div>

                                <?= $error ?>

                            </div>

                        <?php endforeach; ?>

                    </div>

                <?php endif; ?>
                <form
                    action="/home"
                    method="POST"
                    id="order-form">

                    <h3>

                        Order Your Food and Drinks

                    </h3>

                    

                    <div
                        id="cart-items">

                    </div>

                    <textarea
                        name="notes"
                        class="form-control"
                        placeholder="Order notes"></textarea>

                    <input
                        type="hidden"
                        name="cart_json"
                        id="cart_json">

                    <div
                        id="cart-total">

                        Total: 0 EGP

                    </div>

                    <button
                        class="place-order-btn">

                        Confirm Order

                    </button>
                    <button
                            type="button"
                            id="clear-cart"
                            class="clear-cart-btn">

                            🗑️ Clear Cart

                        </button>

                </form>

            </div>

        </div>

    </main>

</div>
<script>

let cart = [];

const cartContainer =
    document.getElementById('cart-items');

const totalContainer =
    document.getElementById('cart-total');

document
    .querySelectorAll('.add-product')
    .forEach(button => {

        button.addEventListener('click', () => {

            const id =
                button.dataset.id;

            const name =
                button.dataset.name;

            const price =
                parseFloat(
                    button.dataset.price
                );

            const existing =
                cart.find(
                    item => item.id == id
                );

            if (existing) {

                existing.quantity++;

            } else {

                cart.push({

                    id,

                    name,

                    price,

                    quantity: 1

                });
            }

            renderCart();
        });
    });

function renderCart() {

    let html = '';

    let total = 0;

    cart.forEach((item, index) => {

        total +=
            item.price *
            item.quantity;

        html += `
                <div class="cart-item">

                    <div>

                        <strong>${item.name}</strong>

                        <br>

                        ${item.price} EGP

                    </div>

                    <div class="qty-controls">

                        <button
                            type="button"
                            class="qty-btn"
                            onclick="decreaseQty(${index})">

                            -

                        </button>

                        <span class="qty-value">

                            ${item.quantity}

                        </span>

                        <button
                            type="button"
                            class="qty-btn"
                            onclick="increaseQty(${index})">

                            +

                        </button>

                        <button
                            type="button"
                            onclick="removeItem(${index})">

                            ❌

                        </button>

                    </div>

                </div>
            `;
    });

    cartContainer.innerHTML =
        html;

    totalContainer.innerHTML =
        'Total: ' +
        total +
        ' EGP';

    document
        .getElementById('cart_json')
        .value =
        JSON.stringify(cart);
}

function removeItem(index) {

    cart.splice(index, 1);

    renderCart();
}
function increaseQty(index) {

    cart[index].quantity++;

    renderCart();
}

function decreaseQty(index) {

    if (cart[index].quantity > 1) {

        cart[index].quantity--;

    } else {

        removeItem(index);
    }

    renderCart();
}
document
    .getElementById('clear-cart')
    .addEventListener('click', () => {

        cart = [];

        renderCart();
    });
    const searchInput =
    document.getElementById(
        'product-search'
    );

searchInput.addEventListener(
    'keyup',
    function () {

        const value =
            this.value.toLowerCase();

        document
            .querySelectorAll('.product-card')
            .forEach(card => {

                const text = card.dataset.search;

                card.style.display =
                    text.includes(value)
                        ? ''
                        : 'none';
            });
    }
);
</script>