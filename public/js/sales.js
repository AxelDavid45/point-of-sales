const productsTable = document.querySelector('#products-table');
const cartTable = document.querySelector('#cartTable');
const cartTotal = document.querySelector("#cartTotal");

if (productsTable) {
    productsTable.addEventListener('click', addProduct);
    cartTable.addEventListener('click', deleteProductCart);
}


function addProduct(e) {
    let btnAdd = e.target;

    if (btnAdd.classList[0] == 'btn') {
        // Get the product information
        let productId = btnAdd.dataset.id,
            productName = btnAdd.dataset.name,
            productLeft = btnAdd.dataset.left,
            productPrice = btnAdd.dataset.price,
            productRow = btnAdd.parentElement.parentElement;


        //Append the new product to the cart table
        cartTable.innerHTML += `
        <tr>
            <td>${productId}</td>
            <td>${productName}</td>
            <td>
                <p>
                <button class="btn btn-sm btn-primary">+</button>
                <span class="text-bold rowItems"> 1 </span>
                <button class="btn btn-sm btn-warning">-</button>
                </p>
            </td>
            <td>
                 <button class="btn btn-danger">
                    <i class="fas fa-trash-alt delete"
                        data-name="${productName}"
                         data-id="${productId}"
                         data-price="${productPrice}"
                         data-left="${productLeft}"
                    ></i>
                 </button>
             </td>
        </tr>
        `;
        //Remove the product selected in the table products
        productRow.remove();
    }
}

function deleteProductCart(e) {
    e.preventDefault();

    let btnDelete = e.target;
    if (btnDelete.classList[2] == 'delete') {
        //Create the product object
        let product = {
            'id': btnDelete.dataset.id,
            'name': btnDelete.dataset.name,
            'left': btnDelete.dataset.left,
            'price': btnDelete.dataset.price
        };
        //Get the whole row of a product
        let productRow = btnDelete.parentElement.parentElement.parentElement;
        //Add the product again to the table products
        fillTableProducts(product);
        productRow.remove();
    }
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
