<? include('views/layouts/header.php'); ?>

<div class="container">
  <div class="row">
    <div class="col-md-4 m-4">
      <form id="orderForm">
        <fieldset>
          <legend>Vender</legend>
          <input type="hidden" id="order_id">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Ingresar Código del Producto"
              aria-describedby="product_id">
            <button class="btn btn-primary" type="button" id="search_product">Buscar</button>
          </div>
          <div class="form-group">
            <label for="product_name">Producto</label>
            <input type="text" disabled class="form-control required" id="product_name"
              placeholder="Nombre del Producto">
          </div>
          <div class="form-group">
            <label for="quantity">Cantidad</label>
            <input type="number" value="1" class="form-control required" id="quantity">
          </div>
          <button type="submit" class="btn btn-primary">Vender</button>
        </fieldset>
      </form>
    </div>
    <div class="col-md-7 p-4">
      <div class="card my-4" id="order-result">
        <div class="card-body">
          <h3>Ventas</h3>
          <ul id="container">
          </ul>
        </div>
        <p class="text-danger">* Hacer Click en nombre del libro para editar</p>
      </div>
      <div class="row" id="order-item"></div>
    </div>
  </div>
</div>

<? include('views/layouts/footer.php'); ?>