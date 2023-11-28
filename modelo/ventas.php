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
        <h1>Ventas</h1>

        <!-- Formulario para agregar ventas con Bootstrap -->
        <form class="form">
            <div class="form-group">
                <label for="productName">Producto:</label>
                <select class="form-control" id="productName" required>
                    <?php
                    include "../controlador/conexion.php";
                    $sql = $conexion->query("SELECT nombre, precio FROM productos");
                    while ($datos = $sql->fetch_object()) {
                        echo "<option value='{$datos->nombre}' data-precio='{$datos->precio}'>{$datos->nombre}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="quantity">Cantidad:</label>
                <input type="number" class="form-control" id="quantity" placeholder="Cantidad" required>
            </div>
            <div class="form-group">
                <label for="price">Precio Unitario:</label>
                <input type="number" class="form-control" id="price" placeholder="Precio Unitario" required readonly>
            </div>
            <button type="submit" class="btn btn-primary">Registrar Venta</button>
        </form>

        <!-- Lista de ventas registradas -->
        <h2>Listado de Ventas</h2>
        
<ul id="clientList">
     <!-- Aquí se mostrarán los clientes registrados -->
     <div class="col-8 p-4">
         <table id="clientTable" class="table">
           <thead class="thead-dark">
             <tr>

               <th scope="col">#</th>
               <th scope="col">Producto</th>
               <th scope="col">Cantidad</th>
               <th scope="col">Precio Unitario</th>
               <th scope="col">Precio Unitario</th>
               <th scope="col">Precio Total</th>
               <th scope="col">    </th>

             </tr>
           </thead>
           <tbody>
             <?php
            include "../controlador/conexion.php";
             $sql=$conexion->query(" select * from ventas");
             while($datos=$sql->fetch_object()){ ?>
                 <tr>
                 <th scope="row">1</th>
                 <td><?=$datos->producto?></td>
                 <td><?=$datos->cantidad?></td>
                 <td><?=$datos->precio_unitario?></td>
                 <td><?=$datos->precio_total?></td>


                 
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

    <!-- Agrega tu script personalizado para manejar la lógica del formulario y la lista de ventas -->
    <script>
    document.addEventListener("DOMContentLoaded", function () {
    // Obtener la referencia del select y el campo de "Precio Unitario"
    const selectProduct = document.getElementById('productName');
    const priceInput = document.getElementById('price');

    // Agregar evento de cambio al select
    selectProduct.addEventListener('change', function () {
        // Obtener el precio del producto seleccionado desde la base de datos
        const selectedOption = selectProduct.options[selectProduct.selectedIndex];
        const selectedProductName = selectedOption.value;

        // Hacer una solicitud AJAX para obtener el precio del producto
        const xhr = new XMLHttpRequest();
        xhr.open('GET', `../controlador/get_price.php?nombre=${selectedProductName}`, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                const precioProducto = xhr.responseText;

                // Actualizar el campo de "Precio Unitario"
                priceInput.value = precioProducto;
            }
        };
        xhr.send();
    });

        // Agregar evento al formulario utilizando delegación de eventos
        document.body.addEventListener('submit', function (event) {
            // Verificar si el formulario enviado es el formulario con la clase 'form'
            if (event.target.classList.contains('form')) {
                event.preventDefault();

                const productName = selectProduct.value;
                const quantity = document.getElementById('quantity').value;
                const price = priceInput.value;

                // Calcula el precio total
                const totalPrice = quantity * price;

                // Agrega la nueva venta a la lista
                const salesList = document.getElementById('salesList');
                const listItem = document.createElement('li');
                listItem.textContent = `Producto: ${productName}, Cantidad: ${quantity}, Precio Unitario: $${price}, Precio Total: $${totalPrice}`;
                salesList.appendChild(listItem);

                // Limpia los campos del formulario
                document.getElementById('quantity').value = '';
                priceInput.value = ''; // Restablecer el campo de "Precio Unitario"
            }
        });
    });
    </script>

</body>
</html>
