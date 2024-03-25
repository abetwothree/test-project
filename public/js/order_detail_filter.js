function createTableRow(order) {
    /*
    This fn creates a table row for each order and returns it
    */
    const tr = document.createElement('tr');

    // Add 'highlight' class if discount greater than 0 and discount is active
    if (order.items[0].product.discount.active && order.items[0].product.discount.discount_percent > 0) {
        tr.classList.add('highlight');
    }

    tr.innerHTML = `
        <td>${order.created_at}</td>
        <td>${order.items[0].product.name}</td>
        <td>${order.items[0].product.category.name}</td>
        <td>${order.items[0].product.discount.active &&
            order.items[0].product.discount.discount_percent > 0 ?
            'true' : 'false'}</td>
        <td>${order.user.username}</td>
        <td>${order.items[0].quantity}</td>
        <td>${order.total}</td>
        <td>${order.address.state}</td>
        <td>${typeof(order.items[0].product.discount.active &&  order.items[0].product.discount.discount_percent > 0 )}</td>
    `;

    return tr;
}

async function fetchOrderDetails(url) {
    /*
    This fn fetches the order details from the server
    */
    const response = await fetch(url);
    if (!response.ok) {
        throw new Error('Network response was not ok');
    }
    const data = await response.json();
    return data;
}


async function loadOrderDetails() {
    /* 
    This fn fetches the order details from the server
    it creates a table row for each order
    */
    const data = await fetchOrderDetails('/order-details');
    data.forEach(order => {
        const tr = createTableRow(order);
        document.getElementById('orderDetails').appendChild(tr);
    });
}

// Load the order details when the page loads
loadOrderDetails();

// Grab the filters
const productName = document.getElementById('product');
const categoryName = document.getElementById('category');
// const discount = document.getElementById('discount');
const username = document.getElementById('username');
const quantity = document.getElementById('quantity');
const total = document.getElementById('total');
const state = document.getElementById('state');

productName.addEventListener('input', filterOrderDetails);
categoryName.addEventListener('input', filterOrderDetails);
// discount.addEventListener('change', filterOrderDetails);
username.addEventListener('input', filterOrderDetails);
quantity.addEventListener('input', filterOrderDetails);
total.addEventListener('input', filterOrderDetails);
state.addEventListener('input', filterOrderDetails);

async function filterOrderDetails() {
    // Clear the current table rows
    document.getElementById('orderDetails').innerHTML = '';

    // Fetch the data with the given filters
    const data = await fetchOrderDetails(`
    /order-details?product=${productName.value}
    &category=${categoryName.value}
    &username=${username.value}
    &quantity=${quantity.value}
    &total=${total.value}
    &state=${state.value}
    `);    
    
    // Clear the table again in case the function was called multiple times
    document.getElementById('orderDetails').innerHTML = '';

    // Create new table rows for each object in the data
    data.forEach(order => {
        const tr = createTableRow(order);
        document.getElementById('orderDetails').appendChild(tr);
    });
}
