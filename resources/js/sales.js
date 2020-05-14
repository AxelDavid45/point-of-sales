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


/*
* Verify the fields in the form
* fields contains
* index 0 --- products list
* index 1 --- rfc field
* index 2 --- total amount
*
* returns and array
* */
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

/*
* Store the sale and send a AJAX request to store the data
* */
function storeSale(e) {
    e.preventDefault();
    const route = '/sales';

    // Get all the fields and values
    let products = document.querySelectorAll('.product');
    let clientRfc = document.querySelector('#rfc').value;
    let productsArray = [];
    let token = document.getElementsByName('_token')[0].value;
    let cartTotal = document.querySelector('#cartTotal').innerText;

    //Fill the product array with every product data
    products.forEach((product, index) => {
        let productId = product.children[0].innerText;
        let productName = product.children[1].innerText;
        let productAmount = product.children[2].children[0].children[1].innerText;
        productsArray.push({
            'id': productId,
            'name': productName,
            'amount': productAmount
        });
    });

    //Create a fields variable to passes the data to verifyFields method
    let fields = [productArray, clientRfc, cartTotal];
    //Save the array with all the errors found
    let verification = verifyFields(fields);

    if (verification.length === 0) {
        // //Create the form data
        const formData = new FormData();
        //Fill the formdata
        formData.append('rfc', clientRfc);
        formData.append('products', JSON.stringify(productsArray));
        formData.append('total', cartTotal);
        formData.append('_token', token);
        formData.append('id', userid);

        //Create the AJAX request
        const xhr = new XMLHttpRequest();
        xhr.open('POST', route, true);
        //Header with the CSRF protection
        xhr.setRequestHeader('X-CSRF-TOKEN', token);
        //Header specifying AJAX request
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

        xhr.onload = function () {
            //Created
            if (this.status === 201) {
                showRequestsMessages('Venta creada exitosamente', 'success');
                resetCart();
                createSaleForm.reset();
                location.reload();
            }
            //Backend verification errors
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
            //Server errors
            if (this.status === 500) {
                showRequestsMessages('Venta parcialmente creada, anota los productos que el' +
                    ' cliente compro y comunicate con el equipo de sistemas', 'warning');
            }
        };
        //Send the information
        xhr.send(formData);
    } else {
        //Map the errors in the client
        verification.forEach((error) => {
            showRequestsMessages(error, 'danger');
        } )
    }
}

/*
* Map all the messages in the client
* Message needed
* Level ---- bootstrap alert class color
* */
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

/*
* Deletes all the elements in the cart table
* */
function resetCart() {
    while(cartTable.childNodes.length > 0) {
        cartTable.childNodes.forEach((e) => {
            e.remove();
        });
    }

    document.querySelector('#cartTotal').innerText = '0';

}

/*
* Subtract one by one the amount of product or
* add one by one the amount of product
* */
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
        'amount': amountOfProductNumeric,
        'name': e.target.dataset.name,
        'price': productPrice
    };

    //The default value for every product added to the cart
    let finalAmount = 1;

    //Verify which modifier is and update the total using the product information
    if (modifier === '+') {
        finalAmount = amountOfProductNumeric + 1;
        //Update the total
        updateTotal(productObject, '+');
    }

    if (modifier === '-') {
        finalAmount = amountOfProductNumeric - 1;
        //Update the total
        updateTotal(productObject, '-');
    }

    //If the amount is 0 remove the item and add it to the products table again
    if (finalAmount === 0) {
        //Remove the element in the cart table
        e.target.parentElement.parentElement.parentElement.remove();
        //Add the element to products table
        fillTableProducts(productObject);
    } else {
        //Update the amount in the html
        amountOfProductElement.innerText = finalAmount;
        //Update the amount of product in the object
        productObject.amount = finalAmount;
    }

}


/*
* Add the product selected in table products to the cart, update the total and
* delete it from products table
* */
function addToCartOneProduct(e) {
    e.preventDefault();

    let btnAdd = e.target;

    if (btnAdd.classList[0] === 'btn') {
        //Create an object to handle the creation later
        let product = {
            'id': btnAdd.dataset.id,
            'amount': 1,
            'name': btnAdd.dataset.name,
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
                         data-amount="${product.amount}"
                         data-id="${product.id}"
                         data-price="${product.price}"
                class="sum btn btn-sm btn-primary">+</button>
                <span class="productAmount text-bold">1</span>
                <button
                         data-name="${product.name}"
                         data-amount="${product.amount}"
                         data-id="${product.id}"
                         data-price="${product.price}"
                class="subs btn btn-sm btn-warning">-</button>
                </p>
            </td>
            <td>
                 <button class="btn btn-danger">
                    <i class="fas fa-trash-alt delete"
                         data-name="${product.name}"
                         data-amount="${product.amount}"
                         data-id="${product.id}"
                         data-price="${product.price}"
                    ></i>
                 </button>
             </td>
        </tr>
        `;

        //Add the product to local Storage
        addProductToLocalStorage(product);

        //Remove the product selected in the table products
        productRow.remove();
    }
}

function addProductToLocalStorage(product) {
    let productsJson = [];
    //Verify if exists products in localStorage
    if (localStorage.getItem('products') === null) {
        productsJson.push(product);
        localStorage.setItem('products', JSON.stringify(productsJson));
        console.log('localstorage vacio, creando uno nuevo...');
        console.log(productsJson);
    } else {
        //Get all the products in the localStorage
        let productsStorage = JSON.parse(localStorage.getItem('products'));
        let productExists = false;
        //Verify if the product already exists and updated
        productsStorage.forEach((content, index) => {
            //If exists update the amount
            if (productsStorage[index].id == product.id) {
               productsStorage[index].amount = product.amount;
               productExists = true;
            }
        });

        //If the product does not exists in the local storage
        if (!productExists) {
            //Add the new product to the JSON of products
            productsStorage.push(product);
            console.log('producto agregado al json');
            console.log(productsStorage);
            //Update the products value in local storage
            localStorage.setItem('products', JSON.stringify(productsStorage));
        }

        console.log('localstorage products');
        console.log(productsStorage);

    }
}

/*
* Update the cart total depends on the modifier
* */
function updateTotal(product, modifier) {
    //Get the total element
    let total = document.querySelector('#cartTotal');
    //Default value for total
    let totalUpdated = 0;
    //Verify which modifier is and update the total
    if (modifier === '-') {
        totalUpdated = parseFloat(product.price) - parseFloat(total.innerText);
    }
    if (modifier === '+') {
        totalUpdated = parseFloat(product.price) + parseFloat(total.innerText);
    }

    //Make amounts positive
    if (totalUpdated < 0) {
        totalUpdated *= -1;
    }

    //Update total amount in the html
    total.innerText = totalUpdated;

}

/*
* Removes the product of cart table and added again to products table
* */
function deleteProductCart(e) {
    e.preventDefault();
    let btnDelete = e.target;
    //Create the product object
    let product = {
        'id': btnDelete.dataset.id,
        'name': btnDelete.dataset.name,
        'price': btnDelete.dataset.price
    };

    updateTotal(product, '-');

    //Get the whole row of a product
    let productRow = btnDelete.parentElement.parentElement.parentElement;
    //Add the product again to the table products
    fillTableProducts(product);
    productRow.remove();
}

/*
* Handles the creation of a new row in the products table
* Receives the product
* */
function fillTableProducts(product) {
    //Create the row
    let row = `
        <tr>
            <td>${product.id}</td>
            <td>${product.name}</td>
            <td>
               <button class="btn btn-success btn-sm"
                       data-name="${product.name}"
                       data-amount="1"
                       data-price="${product.price}"
                       data-id="${product.id}"
               >
                  <i class="fas fa-plus"></i>
                  Agregar
               </button>
            </td>
        </tr>`;

    productsTable.innerHTML += row;
}

/*
* Handles the events, subtraction, addition, delete
* */
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
