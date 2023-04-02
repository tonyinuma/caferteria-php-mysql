$(function () {

    let edit = false;

    getProducts();
    getOrders();
    getReport();

    $('#products-result').hide();

    // Buscar Producto
    $("#search_id").keyup(function (e) {
        if ($('#search_id').val()) {
            let searchValue = $("#search_id").val();
            getProducts(searchValue);
        }
    });

    // Añadir un Producto
    $('#productForm').submit(function (e) {

        e.preventDefault();
        const dataProduct = {
            id: $('#productId').val(),
            name: $('#name').val(),
            reference: $('#reference').val(),
            price: $('#price').val(),
            weight: $('#weight').val(),
            category_id: $('#category_id').val(),
            stock: $('#stock').val(),
        };

        const url = edit === false ? '/backend/product/add_product.php' : '/backend/product/edit_product.php';

        $.post(
            url,
            dataProduct,
            function (res) {
                getProducts();
                $('#productForm').trigger('reset');
            }
        );
    });

    // Eliminar un Producto
    $(document).on('click', '.delete-product', function () {
        if (confirm('Deseas Eliminar este Producto?')) {
            const element = $(this)[0].parentElement.parentElement;
            const product_id = $(element).attr('product_id');
            $.post('/backend/product/delete_product.php', { product_id }, (response) => {
                getProducts();
            });
        }
    });

    // Editar Producto
    $(document).on('click', '.product-edit', function () {
        const element = $(this)[0].parentElement.parentElement.parentElement;
        const product_id = $(element).attr('product_id');
        $.post('/backend/product/get_product.php', { product_id }, function (response) {
            const product = JSON.parse(response);
            $('#productId').val(product.id);
            $('#name').val(product.name);
            $('#reference').val(product.reference);
            $('#price').val(product.price);
            $('#weight').val(product.weight);
            $('#category_id').val(product.category_id);
            $('#stock').val(product.stock);
            edit = true;
        });
    });

    // Obtener Productos
    function getProducts(searchValue = 0) {
        $.post('/backend/product/list_product.php', { searchValue: searchValue }, function (response) {
            const products = JSON.parse(response);
            let template = '';
            products.forEach(product => {
                template += `<div class="card text-white bg-primary mb-3 mr-2" style="max-width: 18rem;" product_id="${product.id}">
                                <div class="card-header inline-block">
                                    <strong class="mr-auto">Stock: ${product.stock}</strong>
                                    -
                                    <span class="badge badge-success">Ref: ${product.reference}</span>
                                    <button type="button" class="ml-2 mb-1 close delete-product">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </button></div>
                                  <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="#" class="product-edit">${product.name}</a>
                                    </h4>
                                    <p class="card-text">S/. ${product.price}</p>
                                </div>
                            </div>`});

            $('#product-list').html(template);
        });
    }

    // Buscar Producto para venta
    $("#search_product").click(function (e) {
        let product_id = $("#product_id").val();
        if (product_id) {
            getProductToSell(product_id);
        } else {
            Swal.fire({
                title: 'Debe ingresar el código del producto que desea seleccionar',
                icon: 'warning',
                confirmButtonText: 'Aceptar'
            })
        }
    });

    function getProductToSell(product_id) {
        $.post('/backend/product/get_product.php', { product_id }, function (response) {
            const product = JSON.parse(response);
            if (product.id) {
                if (product.stock > 0) {

                    $('#product_id').val(product.id);
                    $('#product_name').val(product.name);

                } else {
                    Swal.fire({
                        title: 'Este producto no tiene stock disponible en este momento',
                        icon: 'warning',
                        confirmButtonText: 'Aceptar'
                    });
                    $('#product_id').val('');
                    $('#product_name').val('');
                }
            } else {
                Swal.fire({
                    title: 'No se encontó el código de este producto',
                    icon: 'warning',
                    confirmButtonText: 'Aceptar'
                })
                $('#product_id').val('');
                $('#product_name').val('');
            }
        });
    }

    // Añadir una Venta
    $('#orderForm').submit(function (e) {

        e.preventDefault();
        const order = {
            product_id: $('#product_id').val(),
            quantity: $('#quantity').val()
        };

        $.post(
            '/backend/order/add_order.php',
            order,
            function (response) {
                const data = JSON.parse(response);
                if (data.order_number) {
                    Swal.fire({
                        title: 'Se realizó la venta con exito',
                        text: `Número de Order: ${data.order_number}`,
                        icon: 'success',
                        confirmButtonText: 'Confirmar'
                    })
                    getOrders();
                    $('#orderForm').trigger('reset');
                } else {
                    Swal.fire({
                        title: 'Ups, lo siento! Ocurrio un error Inesperado.',
                        text: 'Contacta con el administrador',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    })
                }
            }
        );
    });

    // Obtener Ventas
    function getOrders() {
        $.post('/backend/order/list_order.php', function (response) {
            const orders = JSON.parse(response);
            let template = '';
            orders.forEach(order => {
                template += `<div class="card border-primary mb-3 mr-2" style="max-width: 18rem;" order_id="${order.id}">
                                <div class="card-header inline-block">
                                    <strong class="mr-auto">Cant. ${order.quantity}</strong>
                                    -
                                    <span class="badge badge-success"># ${order.order_number}</span>
                                  </button></div>
                                  <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="#">${order.name}</a>
                                    </h4>
                                    <p class="card-text">Total: S/. ${order.total}</p>
                                </div>
                            </div>`});

            $('#order-list').html(template);
        });
    }

    // Obtener Reporte
    function getReport() {
        $.post('/backend/report.php', function (response) {
            const { full, top } = JSON.parse(response);
            $('#product_full').html(`${full.name} con ${full.stock} productos en stock`);
            $('#product_top').html(`${top.name} con ${top.sells} productos vendidos`);
        });
    }
}); 