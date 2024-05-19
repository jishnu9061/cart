<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Listing</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <button class="btn btn-primary add-to-cart" data-id="{{ $product->id }}">Add to
                                Cart</button>
                        </div>
                    </div>
                    <br>
                </div>
            @endforeach
        </div>
        <div class="mt-3">
            <button class="btn btn-success" id="sendToWhatsApp">Send Cart to WhatsApp</button>
        </div>
    </div>
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Product Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Product Name:</strong> <span id="modalProductName"></span></p>
                    <p><strong>Unique ID:</strong> <span id="modalProductID"></span></p>
                    <p><strong>Description:</strong></p>
                    <p id="modalProductDescription"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.add-to-cart').click(function() {
                var productId = $(this).data('id');

                $.ajax({
                    url: '{{ route('add-to-cart') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: productId
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Product added to cart!');
                        } else {
                            alert('Failed to add product to cart.');
                        }
                    },
                    error: function() {
                        alert('Failed to add product to cart.');
                    }
                });
            });

            $('#sendToWhatsApp').click(function() {
                $.ajax({
                    url: '{{ route('get-cart') }}',
                    method: 'GET',
                    success: function(response) {
                        var cart = response.cart;
                        var products = response.products;
                        var message = "Your Cart Items:\n\n";

                        products.forEach(function(product) {
                            var quantity = cart[product.id];
                            message += "Product Name: " + product.name + "\n";
                            message += "Unique ID: " + product.id + "\n";
                            message += "Quantity: " + quantity + "\n\n";
                        });

                        var encodedMessage = encodeURIComponent(message);
                        var whatsappUrl = "https://wa.me/?text=" + encodedMessage;
                        window.open(whatsappUrl, '_blank');
                    },
                    error: function() {
                        alert('Failed to retrieve cart items.');
                    }
                });
            });
        });

        function showProductDetails(name, id, description) {
            document.getElementById('modalProductName').innerText = name;
            document.getElementById('modalProductID').innerText = id;
            document.getElementById('modalProductDescription').innerText = description;
            $('#productModal').modal('show');
        }
    </script>
</body>
</html>
