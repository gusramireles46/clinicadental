<section>
    <div class="container py-5">
        <div class="row">
            <h2>Productos</h2>

            <?php foreach ($datos as $producto) : ?>
                <div class="col-lg-3 col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div style="text-align: center;">
                                <img src="assets/images/productos/<?php echo $producto->imagen; ?>"
                                     class="card-img-top card-image" alt="Servicios">
                            </div>
                            <h5 class="card-title"><?php echo $producto->producto; ?></h5>
                            <div class="text-center">
                                <a href="#"
                                   class="btn btn-primary add-to-cart"
                                   data-id="<?php echo $producto->id_producto; ?>">Agregar al carrito</a>
                                <a href="#" class="btn btn-success"><?php echo $producto->precio == 0 ? 'GRATIS' : '$ '. $producto->precio; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#cartModal">Ver carrito</button>
            </div>
        </div>
    </div>
</section>

<!-- Cart Modal -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cartModalLabel">Carrito de Compras</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Producto</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio Unitario</th>
                        <th scope="col">Precio Total</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody id="cartContents">
                    <!-- Content will be populated by JavaScript -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <!--<button type="button" class="btn btn-primary" >Finalizar compra</button>-->
                <a href="checkout.php" class="btn btn-primary">Finalizar compra</a>
            </div>
        </div>
    </div>
</div>

<!-- Toast notification -->
<div class="toast position-fixed bottom-0 end-0 p-3" style="z-index: 11" id="cartToast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
        <strong class="me-auto">Carrito</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        Producto agregado al carrito.
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('.add-to-cart').click(function(e) {
            e.preventDefault();
            var id_producto = $(this).data('id');
            $.ajax({
                url: 'cart-add.php',
                method: 'GET',
                data: { id_producto: id_producto },
                success: function(response) {
                    var toast = new bootstrap.Toast(document.getElementById('cartToast'));
                    toast.show();
                }
            });
        });

        function updateCart(id_producto, action) {
            $.ajax({
                url: 'cart-update.php',
                method: 'POST',
                data: { id_producto: id_producto, action: action },
                success: function(response) {
                    loadCartContents();
                }
            });
        }

        // Load cart contents
        function loadCartContents() {
            $.ajax({
                url: 'cart-contents.php',
                method: 'GET',
                success: function(response) {
                    var cartContents = JSON.parse(response);
                    var cartTable = $('#cartContents');
                    var total = 0;
                    cartTable.empty();
                    cartContents.forEach(function(item) {
                        var totalPrice = item.precio * item.cantidad;
                        total += totalPrice;
                        cartTable.append('<tr><td>' + item.producto + '</td><td>' + item.cantidad + '</td><td>$' + item.precio + '</td><td>$' + totalPrice + '</td><td><button class="btn btn-sm btn-secondary decrease-qty" data-id="' + item.id_producto + '">-</button> <button class="btn btn-sm btn-secondary increase-qty" data-id="' + item.id_producto + '">+</button> <button class="btn btn-sm btn-danger remove-from-cart" data-id="' + item.id_producto + '">Eliminar del carrito</button></td></tr>');
                    });

                    $('.decrease-qty').click(function() {
                        var id_producto = $(this).data('id');
                        updateCart(id_producto, 'decrease');
                    });

                    $('.increase-qty').click(function() {
                        var id_producto = $(this).data('id');
                        updateCart(id_producto, 'increase');
                    });

                    $('.remove-from-cart').click(function() {
                        var id_producto = $(this).data('id');
                        updateCart(id_producto, 'remove');
                    });

                    cartTable.append('<tr><td colspan="3">Total</td><td>$' + total + '</td></tr>');
                }
            });
        }

        $('#cartModal').on('show.bs.modal', function () {
            loadCartContents();
        });
    });
</script>
