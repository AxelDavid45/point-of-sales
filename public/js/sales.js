const productsTable = document.querySelector('#products-table');
const cartTable = document.querySelector('#cartTable');
const cartTotal = document.querySelector("#cartTotal");

if (productsTable) {
    productsTable.addEventListener('click', addToCartOneProduct);
    cartTable.addEventListener('click', cartEvents);
}

function cartEvents(e) {
    if (e.target.classList[2] == 'delete') {
        deleteProductCart(e);
    }

    if (e.target.classList[0] === 'sum') {
        modifyAmountOfProduct(e, '+');
    }

    if (e.target.classList[0] === 'subs') {
        modifyAmountOfProduct(e, '-');
    }

}

function modifyAmountOfProduct(e, modifier) {
    //Get the current amount of product
    let amountOfProductNumeric = parseFloat(e.target.parentElement.childNodes[3].innerText);
    //Get the element with the amount of product
    let amountOfProductElement = e.target.parentElement.childNodes[3];
    //Get the price of the product
    let productPrice = parseFloat(e.target.dataset.price);
    // Create a object for update the total
    let productObject = {
        'id': e.target.dataset.id,
        'name': e.target.dataset.name,
        'left': e.target.dataset.left,
        'price': productPrice
    };
    let finalAmount = 1;
    
    if (modifier === '+') {
        finalAmount = amountOfProductNumeric + 1;
        updateTotal(productObject, '+');
    }
    if (modifier === '-') {
        finalAmount = amountOfProductNumeric - 1;
        updateTotal(productObject, '-');
    }

    if (finalAmount === 0) {
        e.target.parentElement.parentElement.parentElement.remove();
        fillTableProducts(productObject);
    }
    amountOfProductElement.innerText = finalAmount;
}


function addToCartOneProduct(e) {
    let btnAdd = e.target;

    if (btnAdd.classList[0] == 'btn') {
        let product = {
            'id': btnAdd.dataset.id,
            'name': btnAdd.dataset.name,
            'left': btnAdd.dataset.left,
            'price': btnAdd.dataset.price
        };

        updateTotal(product, '+');

        //Get the whole row of a product
        let productRow = btnAdd.parentElement.parentElement;


        //Append the new product to the cart table
        cartTable.innerHTML += `
        <tr>
            <td>${product.id}</td>
            <td>${product.name}</td>
            <td class="productControls">
                <p>
                <button
                         data-name="${product.name}"
                         data-id="${product.id}"
                         data-price="${product.price}"
                         data-left="${product.left}"
                class="sum btn btn-sm btn-primary">+</button>
                <span class="text-bold">1</span>
                <button
                         data-name="${product.name}"
                         data-id="${product.id}"
                         data-price="${product.price}"
                         data-left="${product.left}"
                class="subs btn btn-sm btn-warning">-</button>
                </p>
            </td>
            <td>
                 <button class="btn btn-danger">
                    <i class="fas fa-trash-alt delete"
                         data-name="${product.name}"
                         data-id="${product.id}"
                         data-price="${product.price}"
                         data-left="${product.left}"
                    ></i>
                 </button>
             </td>
        </tr>
        `;
        //Remove the product selected in the table products
        productRow.remove();
    }
}

function updateTotal(product, type) {
    let total = document.querySelector('#cartTotal');
    let totalUpdated = 0;
    console.log(total.innerText);
    console.log(product.price);

    if (type === '-') {
        totalUpdated = parseFloat(product.price) - parseFloat(total.innerText);
    }
    if (type === '+') {
        totalUpdated = parseFloat(product.price) + parseFloat(total.innerText);
    }

    if (totalUpdated < 0) {
        totalUpdated *= -1;
    }
    total.innerText = totalUpdated;

}

function deleteProductCart(e) {
    e.preventDefault();
    let btnDelete = e.target;
    //Create the product object
    let product = {
        'id': btnDelete.dataset.id,
        'name': btnDelete.dataset.name,
        'left': btnDelete.dataset.left,
        'price': btnDelete.dataset.price
    };

    updateTotal(product, '-');

    //Get the whole row of a product
    let productRow = btnDelete.parentElement.parentElement.parentElement;
    //Add the product again to the table products
    fillTableProducts(product);
    productRow.remove();
}

function fillTableProducts(product) {
    //Create the row
    let row = `
        <tr>
            <td>${product.id}</td>
            <td>${product.name}</td>
            <td>${product.left}</td>
            <td>
               <button class="btn btn-success btn-sm"
                       data-name="${product.name}"
                       data-price="${product.price}"
                       data-id="${product.id}"
                       data-left="${product.left}"
               >
                  <i class="fas fa-plus"></i>
                  Agregar
               </button>
            </td>
        </tr>`;

    productsTable.innerHTML += row;
}
