<?
$url_array = explode('/', $_SERVER['SCRIPT_NAME']);
$view = end($url_array);
$display = $view == 'inventario.php' ? '' : 'd-none';
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand d-flex" href="/">
    <h3><b>K</b></h3><s style="text-decoration-line:underline">afeteria</s>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
    aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse ml-4" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/index.php">Ventas</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="/views/inventario.php">Inventario</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0 <?= $display ?> ">
      <input id="search_id" class="form-control mr-sm-2" type="search" placeholder="Buscar">
      <button class="btn btn-secondary my-2 my-sm-0" type="submit">Buscar</button>
    </form>
  </div>
</nav>