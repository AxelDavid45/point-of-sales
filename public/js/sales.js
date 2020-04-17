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
    if (btnDelete.classList[2] == 'delete') {
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
