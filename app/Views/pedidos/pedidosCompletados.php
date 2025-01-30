<?php $session = session();
          $nombre= $session->get('nombre');
          $perfil=$session->get('perfil_id');
          $id=$session->get('id');?>
<section class="Fondo">

<?php if (session()->getFlashdata('msg')): ?>
    <div id="flash-message" class="success" style="width: 30%;">
        <?= session()->getFlashdata('msg') ?>
    </div>
    <script>
        setTimeout(function() {
            document.getElementById('flash-message').style.display = 'none';
        }, 2000); // 2000 milisegundos = 2 segundos
    </script>
<?php endif; ?>
  <?php if(session("msgEr")):?>
   <div id="flash-message2" class="danger" style="width: 30%;">
      <?php echo session("msgEr"); ?>
      </div>
      <script>
        setTimeout(function() {
            document.getElementById('flash-message2').style.display = 'none';
        }, 2000); // 2000 milisegundos = 2 segundos
    </script>
  <?php endif?>

<div class="" style="width: 100%;">
    <br>
<h2 class="textoColor" align="center">Listado de Pedidos Realizados/Entregados</h2>
        <section class="contenedor-titulo">

        <div class="estiloTurno">
    <form action="<?php echo base_url('filtrarPedidos'); ?>" method="POST">
        <label for="start-date" class="label-inline">Fecha desde:</label>
        <input type="date" id="fecha_desde" name="fecha_desde" required>
        
        <label for="end-date" class="label-inline">Fecha hasta:</label>
        <input type="date" id="fecha_hasta" name="fecha_hasta" required>
        
        <label for="barber-id" class="label-inline">Empleado:</label>
        <select id="barber-id" name="id_usuario">
            <option value="">Todos</option>
            <?php foreach ($usuarios as $us): ?>
                <option value="<?= $us['id']; ?>"><?= $us['nombre']; ?></option>
            <?php endforeach; ?>
        </select>
        
        <button type="submit" class="btn">Filtrar</button>
        </form>
        <a class="button" href="<?php echo base_url('pedidosCompletados');?>">
               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
        </svg> Todos</a>
        </div>
        
  <div style="text-align: end;">
  
  <br>

   <a class="button" href="<?php echo base_url('pedidos');?>">
               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
    </svg> Volver a Pedidos</a>

  <br><br>
  <?php $Recaudacion = 0; ?>
  <table class="table table-responsive table-hover" id="users-list">
       <thead>
          <tr class="colorTexto2">
             <th>Nro Pedido</th>
             <th>Cliente</th>
             <th>Teléfono</th>
             <th>Vendedor</th>
             <th>Total</th>
             <th>Fecha Registro</th>
             <th>Fecha Entrega</th>                          
             <th>Estado</th>
             <th>Detalle</th>
          </tr>
       </thead>
       <tbody>
          <?php if($pedidos): ?>
            <?php foreach($pedidos as $p): ?>
    <tr>
        <td><?php echo $p['id']; ?></td>
        <td><?php echo $p['nombre_cliente']; ?></td>
        <td><?php echo $p['telefono']; ?></td>
        <td><?php echo $p['nombre_usuario'];?></td>
        <td>$<?php echo $p['total_bonificado'];?></td>
        <td><?php echo $p['fecha'];?></td>
        <td><?php echo $p['fecha_pedido'];?></td>
        <td><?php echo $p['estado'];?></td>
        <td>
                <a class="btn btn-outline-primary" href="<?php echo base_url('DetalleVta/'.$p['id']);?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                </svg> Ver Detalle</a>
        </td>
         </tr>
         <?php endforeach; ?>

         <?php endif; ?>
       
     </table>
     
     
  </div>
</div>

</section>

          <script src="<?php echo base_url('./assets/js/jquery-3.5.1.slim.min.js');?>"></script>
          <link rel="stylesheet" type="text/css" href="<?php echo base_url('./assets/css/jquery.dataTables.min.css');?>">
          <script type="text/javascript" src="<?php echo base_url('./assets/js/jquery.dataTables.min.js');?>"></script>
<script>
    
    $(document).ready( function () {
      $('#users-list').DataTable( {
        "ordering": false, // Desactiva el ordenamiento en toda la tabla
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página.",
            "zeroRecords": "Lo sentimos! No hay resultados.",
            "info": "Mostrando la página e _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles.",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search": "Buscar: ",
            "paginate": {
              "next": "Siguiente",
              "previous": "Anterior"
            }
        }
    } );
    });


    // Crear un objeto Date en UTC
  const today = new Date();

// Ajustar la hora a la zona horaria de Argentina (UTC-3)
const options = { timeZone: 'America/Argentina/Buenos_Aires', hour12: false };
const formatter = new Intl.DateTimeFormat('es-AR', {
    ...options,
    year: 'numeric', month: '2-digit', day: '2-digit'
});

const formattedDate = formatter.format(today).split('/').reverse().join('-'); // Formato YYYY-MM-DD

// Establecer la fecha y hora actuales en los campos correspondientes
document.getElementById('fecha_desde').value = formattedDate;
document.getElementById('fecha_hasta').value = formattedDate;

</script>


<br><br>