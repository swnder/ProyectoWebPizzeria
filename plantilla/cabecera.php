<nav class="mb-1 navbar navbar-expand-lg navbar-dark gris scl scrolling-navbar fixed-top">

<div class="container">
  <a class="navbar-brand" href="/ProyectoWebPizzeria/menuAdmin.php"><img src="/ProyectoWebPizzeria/img/pizza.png" height="30" class="d-inline-block align-top" alt="">Pizzeria</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
    aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link" href="/ProyectoWebPizzeria/forms/compra_cab_lista.php">Facturar</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="#">Compra</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Productos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/ProyectoWebPizzeria/forms/proveedor_lista.php">Proveedores</a>
      </li>
      <!-- clientes despelcagle -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">Clientes
        </a>
        <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
          <a class="dropdown-item" href="/ProyectoWebPizzeria/forms/clientes_am.php?accion=N"><i class="fa fa-plus-circle"> Agregar</i> </a>
          <a class="dropdown-item" href="/ProyectoWebPizzeria/forms/clientes_am.php?accion=M"><i class="fa fa-edit"> Modificar</i></a>
          <a class="dropdown-item" href="/ProyectoWebPizzeria/forms/clientes_lista.php"><i class="fa fa-list-ol"> Lista Clientes</i></a>
        </div>
      </li>
        <!-- caja despelgable -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">Caja
        </a>
        <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
          <a class="dropdown-item" href="/ProyectoWebPizzeria/forms/Caja_Apertura.php?accion=A"><i class="fa fa-plus-circle"> Apertura de Caja</i> </a>
          <a class="dropdown-item" href="/ProyectoWebPizzeria/forms/Caja_Apertura.php?accion=C"><i class="fa fa-times-circle"> Cierre de Caja</i></a>
          <a class="dropdown-item" href="/ProyectoWebPizzeria/forms/cajasAcciones_lista.php"><i class="fa fa-list-ol"> Lista Movimiento</i></a>
        </div>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto nav-flex-icons">
      <li class="nav-item">
        <a class="nav-link waves-effect waves-light">
          <i class="fa fa-twitter"> Contacto</i>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-cog"> Ajustes</i>
        </a>
        <!-- menu desplegable lado derecho -->
        <div class="dropdown-menu dropdown-menu-right dropdown-default"
          aria-labelledby="navbarDropdownMenuLink-333">
          <a class="dropdown-item" href="/ProyectoWebPizzeria/forms/ciudadlista.php"><i class="fa-city"> Ciudad</i></a>
          <a class="dropdown-item" href="/ProyectoWebPizzeria/forms/mesas_lista.php"> <i class="fa fa-table"> Mesas</i></a>
          <a class="dropdown-item" href="/ProyectoWebPizzeria/forms/categoria_lista.php"> <i class="fa fa-star"> Categoria</i></a>
          <a class="dropdown-item" href="/ProyectoWebPizzeria/forms/sabores_lista.php"> <i class="fa fa-star"> Sabores</i></a>
          <a class="dropdown-item" href="/ProyectoWebPizzeria/forms/empleados_lista.php"><i class="fa fa-people-carry"> Empleados</i></a>
          <a class="dropdown-item" href="/ProyectoWebPizzeria/forms/usuarios_lista.php"><i class="fa fa-user"> Usuarios</i></a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-user"> Cuenta</i>
        </a>
        <!-- menu desplegable lado derecho -->
        <div class="dropdown-menu dropdown-menu-right dropdown-default"
          aria-labelledby="navbarDropdownMenuLink-333">
          <?php session_start(); ?>
          <a><img src="/ProyectoWebPizzeria/img/perfil.png" class="img-thumbnail rounded-circle" alt="" width="50" height="50" /> <?php echo isset($_SESSION['nombreUsuario']) ? $_SESSION['nombreUsuario']:''; ?></a><hr>
          <a class="dropdown-item" href="#"><i class="fa fa-key"> Cambiar Contraseña</i> </a>
          <a class="dropdown-item" href="/ProyectoWebPizzeria/cerrarsesion.php"> <i class="fa fa-times-circle"> Cerrar Sesión</i></a>
                  </div>

      </li>
    </ul>
  </div>


   </div>

</nav>
<br><br><br>
