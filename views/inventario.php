<? include('layouts/header.php'); ?>

<div class="container">
  <div class="row">
    <div class="col-md-4 m-4">
      <form id="productForm">
        <fieldset>
          <legend>Formulario Producto</legend>
          <input type="hidden" id="productId">
          <div class="form-group">
            <label for="name">Nombre del Producto</label>
            <input type="text" class="form-control" required id="name" placeholder="Ingresar nombre del Producto">
          </div>
          <div class="form-group">
            <label for="reference">Referencia</label>
            <input type="text" class="form-control" required id="reference" placeholder="Ingresar Referencia">
          </div>
          <div class="form-group">
            <label for="price">Precio (S/.)</label>
            <input type="number" step=".01" class="form-control" required id="price" placeholder="Ingresar Precio">
          </div>
          <div class="form-group">
            <label for="weight">Peso (kg.)</label>
            <input type="number" step=".01" class="form-control" required id="weight" placeholder="Ingresar Peso">
          </div>
          <div class="form-group">
            <label for="category_id">Categoria</label>
            <select id="category_id" class="form-control" required>
              <option value="">-- Select --</option>
              <option value="1">Gaseosas<option>
              <option value="2">Piqueos<option>
            </select>
            <small class="form-text text-muted">Seleccionar Categoria</small>
          </div>
          <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number"
              onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
              class="form-control required" id="stock" placeholder="Ingresar nombre del Producto">
          </div>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </fieldset>
      </form>
    </div>
    <div class="col-md-7 p-4">
      <p class="text-danger">* Hacer Click en nombre del libro para editar</p>
      <div class="row" id="product-list" style="overflow: auto; max-height: 600px; width: 930px"></div>
    </div>
  </div>
</div>

<? include('layouts/footer.php'); ?>