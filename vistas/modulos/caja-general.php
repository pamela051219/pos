<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}
?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Caja General
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar caja general</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCaja">
          
          Abrir Caja

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Codigo</th>
           <th>Fecha</th>
           <th>Valor Apertura</th>
           <th>Responsable</th>
           <th>Hora Cierre</th>
           <th>Monto Cierre</th>
           <th>Observaciones</th>
           <th>Acciones</th>

         </tr> 

        </thead>

      <tbody>

<?php

        $item = null;
        $valor = null;

        $cajageneral = ControladorCajaGeneral::ctrMostrarCajaGeneral($item, $valor);

       foreach ($cajageneral as $key => $value){
         
          echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["codigo"].'</td>
                  <td>'.$value["cierre"].'</td>
                  <td>'.$value["valor_a"].'</td>';
                  
                  $itemUsuario = "id";
          
                  $valorUsuario = $value["usuario"];

                  $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                  echo '<td>'.$respuestaUsuario["nombre"].'</td>

                  <td>'.$value["fecha"].'</td>
                  <td>'.$value["valor_c"].'</td>
                  <td>'.$value["observaciones"].'</td>';
                                        
                  echo '<td>

                    <div class="btn-group">
                        
                      <button class="btn btn-warning btnEditarCajaGeneral" idCajaGeneral="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarCajaGeneral"><i class="fa fa-pencil"></i></button>
                      <button class="btn btn-danger btnEliminarCajaGeneral" idCajaGeneral="'.$value["id"].'"  ><i class="fa fa-times"></i></button>

                    </div>  

                  </td>

                </tr>';
        }

      ?> 

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR USUARIO
======================================-->

<div id="modalAgregarCaja" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Caja</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

           <!-- ENTRADA PARA EL CODIGO -->

           <div class="form-group">                 
              <div class="input-group">
                    
                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                 <?php

                 $item = null;
                 $valor = null;

                 $ventas = ControladorCajaGeneral::ctrMostrarCajaGeneral($item, $valor);

                 if(!$ventas){

                 echo '<input type="text" class="form-control" id="nuevoCodigo" name="nuevoCodigo" value="0001" readonly>';
                  

                 }else{

                 foreach ($ventas as $key => $value) {
                                                                   
                 }

                 $codigo = $value["codigo"] + 1;

                 echo '<input type="text" class="form-control " id="nuevoCodigo" name="nuevoCodigo" value="'.$codigo.'" readonly>';

                 }

                 ?>
                                       
              </div>              
             </div>

           
            <!-- ENTRADA PARA VALOR DE APERTURA-->

            <div class="form-group">      
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-usd"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoValora" placeholder="Ingresar Valor" value="0" id="nuevoValora" required>

              </div>
             </div>


            <!-- ENTRADA PARA EL RESPONSABLE -->
            <div class="form-group">  
            <div class="input-group">
              
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" id="nuevoResponsable" name="nuevoResponsable" 
                    value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                    <input type="hidden" name="nuevoResponsable" value="<?php echo $_SESSION["id"]; ?>">

              </div>

            </div>


         



             <!-- ENTRADA PARA EL VALOR CIERRE -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-usd"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoValorc" placeholder="Ingresar Valor" id="nuevoComprobante" value="0" >

              </div>

            </div>

            <!-- ENTRADA PARA LA OBSERVACION -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-commenting"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoObservacion" placeholder="Ingresar detalle" id="nuevoObservacion" >

              </div>

            </div>

        </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Caja</button>

        </div>


      </form>

      <?php

          $crearCajaGeneral = new ControladorCajaGeneral();
          $crearCajaGeneral -> ctrCrearCajaGeneral();

        ?>

    </div>

  </div>

</div>



<!--=====================================
MODAL EDITAR USUARIO
======================================-->

<div id="modalEditarCajaGeneral" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Caja</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

                  <!-- ENTRADA PARA CODIGO-->

            <div class="form-group">      
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" name="editarCodigo"  id="editarCodigo" readonly>

              </div>
             </div>
             
      
            <!-- ENTRADA PARA VALOR DE APERTURA-->

            <div class="form-group">      
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-usd"></i></span> 

                <input type="text" class="form-control input-lg" name="editarValora" placeholder="Ingresar Valor" value="0" id="editarValora" readonly>

              </div>
             </div>

             

            <!-- ENTRADA PARA EL RESPONSABLE -->
            <div class="form-group">  
            <div class="input-group">
              
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" id="nuevoResponsable" name="nuevoResponsable" 
                    value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                    <input type="hidden" name="nuevoResponsable" value="<?php echo $_SESSION["id"]; ?>">

              </div>

            </div>


       

             <!-- ENTRADA PARA EL VALOR CIERRE -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-usd"></i></span> 

                <input type="text" class="form-control input-lg" name="editarValorc"  id="editarValorc" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA OBSERVACION -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-commenting"></i></span> 

                <input type="text" class="form-control input-lg" name="editarObservacion" placeholder="Ingresar detalle" id="editarObservacion" required>

              </div>

            </div>

        </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar Caja</button>

        </div>
        <?php

$editarCajaGeneral = new ControladorCajaGeneral();
$editarCajaGeneral -> ctrEditarCajaGeneral();

?>  
                 

      </form>


    </div>

  </div>

</div>

<?php

  $borrarCajaGeneral = new ControladorCajaGeneral();
  $borrarCajaGeneral -> ctrBorrarCajaGeneral();

?> 


