const productsTable = document.querySelector('#products-table');
const cartTable = document.querySelector('#cartTable');
const createSaleForm = document.querySelector('#createSaleForm');
const errorSectionForm = document.querySelector('#js-requests-messages');
const userid = document.querySelector('#user-id').value;

if (productsTable) {
    productsTable.addEventListener('click', addToCartOneProduct);
    cartTable.addEventListener('click', cartEvents);
    createSaleForm.addEventListener('submit', storeSale);
}


function verifyFields(fields) {
    let verificationErrors = [];
    if (fields[0].length === 0) {
        verificationErrors.push('Carrito Vacio');
    }
    if (fields[1] === '') {
        verificationErrors.push('Escoge un RFC');
    }
    if (fields[2] == 0) {
        verificationErrors.push('Agrega al menos un producto para poder realizar la venta');
    }
    return verificationErrors;
}

function storeSale(e) {
    e.preventDefault();
    const route = '/sales';
    // Select all the products in the cart
    let products = document.querySelectorAll('.product');
    let clientRfc = document.querySelector('#rfc').value;
    let productArray = [];
    let token = document.getElementsByName('_token')[0].value;
    let cartTotal = document.querySelector('#cartTotal').innerText;

    //Fill the product array with every product data
    products.forEach((product, index) => {
        let productId = product.children[0].innerText;
        let productAmount = product.children[2].children[0].children[1].innerText;
        productArray.push({
            'id': productId,
            'amount': productAmount
        });
    });

    let fields = [productArray, clientRfc, cartTotal];

    let verification = verifyFields(fields);

    if (verification.length === 0) {
        // //Create the form data
        const formData = new FormData();
        // //Fill the formdata
        formData.append('rfc', clientRfc);
        formData.append('products', JSON.stringify(productArray));
        formData.append('total', cartTotal);
        formData.append('_token', token);
        formData.append('id', userid);

        const xhr = new XMLHttpRequest();
        xhr.open('POST', route, true);
        xhr.setRequestHeader('X-CSRF-TOKEN', token);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onload = function () {
            if (this.status === 201) {
                showRequestsMessages('Venta creada exitosamente', 'success');
                resetCart();
                createSaleForm.reset();

            }
            if (this.status === 422) {
                let response = JSON.parse(this.response);
                let errors = response.errors;

                if (errors.rfc) {
                    showRequestsMessages('Escoge un RFC para continuar', 'danger');
                }
                if (errors.total) {
                    showRequestsMessages('El total debe ser mayor a 0, debe contener al menos un' +
                        ' producto', 'danger');
                }
            }
            if (this.status === 500) {
                showRequestsMessages('Venta parcialmente creada, anota los productos que el' +
                    ' cliente compro y comunicate con el equipo de sistemas', 'warning');
            }
        };
        xhr.send(formData);
    } else {
        verification.forEach((error) => {
            showRequestsMessages(error, 'danger');
        } )
    }
}

function showRequestsMessages(message, level) {
    let html = `
    <div class="alert alert-${level}">
        ${message}
    </div>
    `;
    errorSectionForm.innerHTML += html;
    setTimeout(() => {
        errorSectionForm.innerHTML = '';
    }, 3500)
}

function resetCart() {
    while(cartTable.childNodes.length > 0) {
        cartTable.childNodes.forEach((e) => {
            e.remove();
        });
    }

    document.querySelector('#cartTotal').innerText = '0';

}
function cartEvents(e) {
    e.preventDefault();
    if (e.target.classList[2] === 'delete') {
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
    e.preventDefault();
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
    e.preventDefault();
    let btnAdd = e.target;

    if (btnAdd.classList[0] === 'btn') {
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
        <tr class="product">
            <td class="productId">${product.id}</td>
            <td>${product.name}</td>
            <td class="productControls">
                <p>
                <button
                         data-name="${product.name}"
                         data-id="${product.id}"
                         data-price="${product.price}"
                         data-left="${product.left}"
                class="sum btn btn-sm btn-primary">+</button>
                <span class="productAmount text-bold">1</span>
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