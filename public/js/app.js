// Edit User
    const roomSelect = document.querySelector('[name="room_id"]');

    const newRoomWrapper =
        document.getElementById('new-room-wrapper');

    roomSelect.addEventListener('change', function () {

        if (this.value === 'new') {

            newRoomWrapper.style.display = 'block';

        } else {

            newRoomWrapper.style.display = 'none';
        }

    });


// Sidebar
const toggleBtn = document.getElementById("sidebar-toggle");

const sidebar = document.querySelector(".sidebar");

const main = document.querySelector(".main");


toggleBtn.addEventListener("click", () => {
    sidebar.classList.toggle("collapsed");

    main.classList.toggle("expanded");

    localStorage.setItem(
        "sidebarCollapsed",
        sidebar.classList.contains("collapsed"),
    );
});

if (localStorage.getItem("sidebarCollapsed") === "true") {
    sidebar.classList.add("collapsed");

    main.classList.add("expanded");
}

//Add Order

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

