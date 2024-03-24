fetch('/order-detail-filter')
.then(response => response.json())
.then(data => {
    data.forEach(order => {
        const tr = document.createElement('tr');
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
        `;
        document.getElementById('orderDetails').appendChild(tr);
    });
});

document.getElementById('search').addEventListener('input', function() {
    fetch('/order-detail-filter?name=' + this.value)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Clear the current table rows
            // console.log("Data just after fetching:", data);
            document.getElementById('orderDetails').innerHTML = '';

            // Create new table rows for each object in the data
            data.forEach(order => {
                const tr = document.createElement('tr');

                // Log for debugging
                console.log("Order Address ID:", order.address_id);
                console.log("Addresses Array:", order.user.addresses);

                const matchingAddress = order.user.addresses.find(address => {
                    // Log each comparison for debugging
                    console.log("Comparing:", address.user_id, order.address_id);
                    return address.id == order.address_id;
                });

                const addressString = matchingAddress ? `${matchingAddress.state}` : 'Address not found';

                tr.innerHTML = `
                    <td>${order.created_at}</td>
                    <td>${order.items[0].product.name}</td>
                    <td>${order.items[0].product.category.name}</td>
                    <td>${order.items[0].product.discount.active &&
                        order.items[0].product.discount.discount_percent > 0 ?
                        'true' : 'false'}</td>
                    <td>${order.user.username}</td>
                    <td>${order.items[0].quantity}</td>
                    <td>$${order.total}</td>
                    <td>${addressString}</td>
                    <td>${JSON.stringify(order.user.addresses[0].user_id)}</td>
                `;
                document.getElementById('orderDetails').appendChild(tr);
                console.log(order);
            });
            
        })
        .catch(error => {
            console.error('There has been a problem with your fetch operation:', error);
        });
});