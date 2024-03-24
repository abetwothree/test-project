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
            <td>${order.address.state}</td>
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
            document.getElementById('orderDetails').innerHTML = '';

            // Create new table rows for each object in the data
            data.forEach(order => {
                const tr = document.createElement('tr');

                // // Add 'highlight' class if the first item has an active discount with a discount percentage greater than 0
                // if (order.items[0].product.discount.active && order.items[0].product.discount.discount_percent > 0) {
                //     tr.classList.add('highlight');
                // }
                console.log(order.items[0].product.discount.active)
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
                    <td>${order.address.state}</td>
                `;
                document.getElementById('orderDetails').appendChild(tr);
                console.log(order);
            });
            
        })
        .catch(error => {
            console.error('There has been a problem with your fetch operation:', error);
        });
});