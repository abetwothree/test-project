<body>

<h1>Order Details</h1>

<input type="text" id="product" placeholder="Search by product name">
<input type="text" id="category" placeholder="Search by category">
<input type="text" id="username" placeholder="Search by username">
<input type="text" id="quantity" placeholder="Search by quantity">
<input type="text" id="total" placeholder="Search by total">
<input type="text" id="state" placeholder="Search by state">
<br>
<br>
    <thead>
        <tr>
            <th>Order Date</th>
            <th>Product Name</th>
            <th>Product Category</th>
            <th>Discounted</th>
            <th>Username</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>State of Purchase</th>
        </tr>
    </thead>

    <script src="{{ asset('js/order_detail_filter.js') }}"></script>
</body>
