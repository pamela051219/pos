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
      
      Caja Chica
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar caja chica</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCaja">
          
          Agregar caja chica

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Fecha</th>
           <th>Responsable</th>
           <th>N. Comprobante</th>
           <th>Detalle</th>
           <th>Valor</th>
           <th>Foto Recibo</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;

        $cajachica = ControladorCajaChica::ctrMostrarCajaChica($item, $valor);

       foreach ($cajachica as $key => $value){
         
          echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["fecha"].'</td>';
                  
                  $itemUsuario = "id";
          
                  $valorUsuario = $value["usuario"];

                  $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                  echo '<td>'.$respuestaUsuario["nombre"].'</td>

                  <td>'.$value["comprobante"].'</td>
                  <td>'.$value["detalle"].'</td>
                  <td>'.$value["valor"].'</td>';

                  if($value["foto"] != ""){

                    echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="40px"></td>';

                  }else{

                    echo '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>';

                  }

                          
                  echo '<td>

                    <div class="btn-group">
                        
                      <button class="btn btn-warning btnEditarCajaChica" idCajaChica="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarCajaChica"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnEliminarCajaChica" idCajaChica="'.$value["id"].'" fotoCaja="'.$value["foto"].'" usuario="'.$value["usuario"].'" ><i class="fa fa-times"></i></button>

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

          <h4 class="modal-title">Caja Chica</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

           <!-- ENTRADA PARA LA FECHA -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="date" class="form-control input-lg" name="nuevaFecha" placeholder="Ingresar fecha" required>

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


             <!-- ENTRADA PARA EL NUMERO DE COMPROBANTE -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-file-text"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoComprobante" placeholder="Ingresar N° Comprobante" id="nuevoComprobante" required>

              </div>

            </div>


            <!-- ENTRADA PARA EL DETALLE -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-commenting"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoDetalle" placeholder="Ingresar detalle" id="nuevoDetalle" required>

              </div>

            </div>


             <!-- ENTRADA PARA EL VALOR  -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-usd"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoValor" placeholder="Ingresar Valor" id="nuevoComprobante" value="0" required>

              </div>

            </div>


            <!-- ENTRADA PARA SUBIR RECIBO -->

             <div class="form-group">
              
              <div class="panel">SUBIR RECIBO</div>

              <input type="file" class="nuevaFoto" name="nuevaFoto">

              <p class="help-block">Peso máximo de la foto 2MB</p>

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

          $crearCajaChica = new ControladorCajaChica();
          $crearCajaChica -> ctrCrearCajaChica();

        ?>

    </div>

  </div>

</div>



<!--=====================================
MODAL EDITAR USUARIO
======================================-->

<div id="modalEditarCajaChica" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Caja Chica</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

             <!-- ENTRADA PARA LA FECHA -->
            
             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="date" class="form-control input-lg" name="editarFecha" id="editarFecha" required>

              </div>

             </div>

            <!-- ENTRADA PARA EL USUARIO -->

            <div class="form-group">  
              <div class="input-group">
              
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" id="nuevoResponsable" name="nuevoResponsable" 
                            value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                            <input type="hidden" name="nuevoResponsable" value="<?php echo $_SESSION["id"]; ?>">

              </div>

            </div>


             <!-- ENTRADA PARA EL NUMERO DE COMPROBANTE -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-file-text"></i></span> 

                <input type="text" class="form-control input-lg" name="editarComprobante" id="editarComprobante" placeholder="Ingresar N° Comprobante" id="nuevoComprobante" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DETALLE -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-commenting"></i></span> 

                <input type="text" class="form-control input-lg" name="editarDetalle" id="editarDetalle"  required>

              </div>

            </div>

             <!-- ENTRADA PARA EL VALOR  -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-usd"></i></span> 

                <input type="text" class="form-control input-lg" name="editarValor" id="editarValor"  required>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

            <div class="form-group">
              
              <div class="panel">SUBIR FOTO</div>

              <input type="file" class="nuevaFoto" name="editarFoto">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img src="vistas/img/recibos/default/anonymous.png" class="img-thumbnail previsualizarEditar" width="100px">

              <input type="hidden" name="fotoActual" id="fotoActual">

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

          $editarCajaChica = new ControladorCajaChica();
          $editarCajaChica -> ctrEditarCajaChica();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrarCajaChica = new ControladorCajaChica();
  $borrarCajaChica -> ctrBorrarCajaChica();

?> 


