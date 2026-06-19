<?php

require base_path('views/partials/head.php');
require base_path('views/partials/sidebar.php');

?>

<div class="main">

    <?php require base_path('views/partials/navbar.php'); ?>

    <main class="page-body">

        <div class="page-header">

            <h1 class="page-title">

                Edit Order #<?= $order['id'] ?>

            </h1>

        </div>
        <form
            action="/my-orders"
            method="POST">

            <input
                type="hidden"
                name="_method"
                value="PATCH">

            <input
                type="hidden"
                name="id"
                value="<?= $order['id'] ?>">
            <div class="order-details-card">

                <div class="order-info">

                    <div class="info-box">

                        <div class="info-label">
                            Order ID
                        </div>

                        <div class="info-value">
                            #<?= $order['id'] ?>
                        </div>

                    </div>

                    <div class="info-box">

                        <div class="info-label">
                            Current Status
                        </div>

                        <div class="info-value">

                            <span class="status-pill status-processing">

                                Processing

                            </span>

                        </div>

                    </div>

                </div>

                <h3 class="section-title">

                    Current Items

                </h3>

                <div class="items-list">

                    <?php foreach ($orderItems as $item) : ?>

                        <div class="item-card">

                            <div>

                                <div class="item-name">

                                    <?= $item['name'] ?>

                                </div>

                                <div class="item-price">

                                    <?= number_format($item['unit_price'], 2) ?>
                                    EGP

                                </div>

                            </div>

                            <div class="item-controls">

                                <input
                type="number"
                name="quantities[<?= $item['id'] ?>]"
                value="<?= $item['quantity'] ?>"
                min="1"
                class="qty-input">

                                <button
                                    type="submit"
                                    name="delete_items[]"
                                    value="<?= $item['id'] ?>"
                                    class="act-btn act-del">

                                    Delete

                                </button>

                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>

                <div class="add-product-card">

                    <h3 class="section-title">

                        Add Product

                    </h3>

                    <div class="add-product-row">

                        <select
                                name="new_product_id"
                                class="form-control">

                                <option value="">
                                    Select Product
                                </option>

                                <?php foreach ($products as $product) : ?>

                                    <option value="<?= $product['id'] ?>">

                                        <?= $product['name'] ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        <input
                                type="number"
                                name="new_quantity"
                                value="1"
                                min="1"
                                class="qty-input">

                        <button
                                type="button"
                                id="add-product-btn"
                                class="act-btn btn-submit" style="background-color: #6f4e37;">

                                Add Product

                            </button>

                    </div>
                    <div id="new-products-container"></div>

                </div>

                <div class="order-total">

                    Current Total:
                    <?= number_format($order['total_amount'], 2) ?>
                    EGP

                </div>

                <div class="order-actions">

                    <button
                        class="act-btn btn-submit" style="background-color: #6f4e37;">

                        Save Changes

                    </button>

                    <a
                        href="/orders/user/show?id=<?= $order['id'] ?>"
                        class="act-btn btn-cancel">

                        Cancel

                    </a>

                </div>

            </div>
        </form>
    </main>

</div>
<script>

let index = 0;

document
    .getElementById('add-product-btn')
    .addEventListener('click', function () {

        const productSelect =
            document.querySelector(
                '[name="new_product_id"]'
            );

        const quantityInput =
            document.querySelector(
                '[name="new_quantity"]'
            );

        const container =
            document.getElementById(
                'new-products-container'
            );

        const productId =
            productSelect.value;

        const productName =
            productSelect.options[
                productSelect.selectedIndex
            ].text;

        const quantity =
            quantityInput.value;

        if (! productId) {
            return;
        }

        container.insertAdjacentHTML(

            'beforeend',

            `
            <div class="item-card">

                <div>

                    <div class="item-name">

                        ${productName}

                    </div>

                </div>

                <div class="item-controls">

                    x${quantity}

                </div>

                <input
                    type="hidden"
                    name="added_products[${index}][product_id]"
                    value="${productId}">

                <input
                    type="hidden"
                    name="added_products[${index}][quantity]"
                    value="${quantity}">

            </div>
            `
        );

        index++;
    });

</script>