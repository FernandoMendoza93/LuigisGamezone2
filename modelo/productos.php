<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página con Barra Superior</title>
    <!-- Agrega el enlace al archivo de estilo de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/9cd01b9d5e.js" crossorigin="anonymous"></script>
    <style>
        /* Agrega tu estilo personalizado aquí si es necesario */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        header img {
            width: 50px; /* Ajusta el tamaño del logo según sea necesario */
            vertical-align: middle;
        }

        nav {
            background-color: #333;
            overflow: hidden;
            text-align: right;
        }

        nav a {
            display: inline-block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        nav a:hover {
            background-color: #45a049;
            color: white;
        }

        section {
            padding: 20px;
        }
    </style>
</head>
<body>

    <header>
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/75/Luigi_emblem.svg/2048px-Luigi_emblem.svg.png" alt="Logo" width="200" height="50">
        <h1>Luigi's Gamezone</h1>
    </header>

    <nav>
        <a href="Principal.php">Inicio</a>
        <a href="rentas.php">Rentas</a>
        <a href="ventas.php">Ventas</a>
        <a href="clientes.php">Clientes</a>
        <a href="productos.php">Inventario</a>
    </nav>

    <section>
        <h1>Registro de Productos</h1>
        
        <!-- Formulario para agregar productos con Bootstrap -->
        <h2>Agregar Producto</h2>
        
        <form class="form" action="../controlador/registro_productos.php" method="post">
            <div class="form-group">
                <label for="productName">Nombre del Producto:</label>
                <input type="text" class="form-control" id="productName" name="productName" placeholder="Nombre del Producto" required>
            </div>
            <div class="form-group">
                <label for="productPrice">Precio del Producto:</label>
                <input type="number" class="form-control" id="productPrice" name="productPrice" placeholder="Precio del Producto" required>
            </div>
            <button type="submit" class="btn btn-primary" name="btnregistrar" value="ok">Agregar Producto</button>
        </form>

        <div id="messageContainer"></div>

<!-- Lista de productos registrados -->
<h2>Listado de Productos</h2>
<ul id="clientList">
     <!-- Aquí se mostrarán los clientes registrados -->
     <div class="col-8 p-4">
         <table id="clientTable" class="table">
           <thead class="thead-dark">
             <tr>
               <th scope="col">#</th>
               <th scope="col">Producto</th>
               <th scope="col">Precio</th>
                <th scope="col">    </th>

             </tr>
           </thead>
           <tbody>
             <?php
            include "../controlador/conexion.php";
             $sql=$conexion->query(" select * from productos");
             while($datos=$sql->fetch_object()){ ?>
                 <tr>
                 <th scope="row">1</th>
                 <td><?=$datos->Nombre?></td>
                 <td><?=$datos->Precio?></td>
                 
                 <td>
                     <a href="" class="btn btn small btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                     <a href="" class="btn btn small btn-danger"><i class="fa-solid fa-trash"></i></a>
                 </td>
                 </tr> 
             <?php }
             ?>
            
             
           </tbody>
         </table>

</ul>
   </section>

    <!-- Agrega el enlace al archivo de script de Bootstrap y jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Agrega tu script personalizado para manejar la lógica del formulario y la lista de productos -->
    <script>
    // Agrega tu lógica de manejo de formularios y productos aquí
document.querySelector('.form').addEventListener('submit', function (event) {
    event.preventDefault();

    const productName = document.getElementById('productName').value;
    const productPrice = document.getElementById('productPrice').value;

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../controlador/registro_productos.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Parsea la respuesta JSON
            const response = JSON.parse(xhr.responseText);

            // Muestra el mensaje en el contenedor
            if (response.status === "success") {
                // Crear un nuevo elemento de div para el mensaje
                const successMessage = document.createElement('div');
                successMessage.className = 'alert alert-success';
                successMessage.textContent = response.message;

                // Agregar el mensaje al contenedor de mensajes
                document.getElementById('messageContainer').appendChild(successMessage);

                // Limpia los campos del formulario
                document.getElementById('productName').value = '';
                document.getElementById('productPrice').value = '';
            } else {
                alert(response.message);
            }
        }
    };
    xhr.send(`btnregistrar=ok&productName=${productName}&productPrice=${productPrice}`);
});
</script>


</body>
</html>
