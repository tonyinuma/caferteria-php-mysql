$(function () {

    let edit = false;

    getProducts();
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
}); 