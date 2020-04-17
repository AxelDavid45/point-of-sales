const productsTable = document.querySelector('#products-table');
const cartTable = document.querySelector('#cartTable');
const cartTotal = document.querySelector("#cartTotal");
if (productsTable) {
    productsTable.addEventListener('click', addProduct);
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
            <td>${ productId }</td>
            <td>${ productName }</td>
            <td>
                <p>
                <button class="btn btn-sm btn-primary">+</button>
                <span class="text-bold rowItems"> 1 </span>
                <button class="btn btn-sm btn-warning">-</button>
                </p>
            </td>
            <td>
                 <button class="btn btn-danger"
                         data-name="${productName}"
                         data-id="${productId}"
                         data-price="${productPrice}"
                         data-left="${productLeft}"
                 >
                    <i class="fas fa-trash-alt"></i>
                 </button>
             </td>
        </tr>
        `;
        //Remove the product selected in the table products
        productRow.remove();

        //Sum the amount

    }
}
