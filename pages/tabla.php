    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
          <!-- Col -->
          <section class="col-12 connectedSortable">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                        <th>Nombre</th>
                        <th>Apellido paterno</th>
                        <th>Apellido materno</th>
                        <th>Correo electrónico</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                        <td>Luis</td>
                        <td>García</td>
                        <td>Hernández</td>
                        <td>luis.garcía@gmail.com</td>
                        <td>Administrador</td>
                        <td>
                            <button class="btn btn-outline-primary btn-sm ml-1" data-toggle="tooltip" data-placement="top" title="Visualizar"><i class="far fa-eye"></i></button>
                            <button class="btn btn-outline-warning btn-sm ml-1" data-toggle="tooltip" data-placement="top" title="Editar"><i class="far fa-edit"></i></button>
                            <button class="btn btn-outline-danger btn-sm ml-1" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="far fa-trash-alt"></i></button>
                        </td>
                        </tr>
                        <tr>
                        <td>Lucía</td>
                        <td>Torres</td>
                        <td>Vargas</td>
                        <td>lucia.torres@gmail.com</td>
                        <td>Supervisor</td>
                        <td>
                            <button class="btn btn-outline-primary btn-sm ml-1" data-toggle="tooltip" data-placement="top" title="Visualizar"><i class="far fa-eye"></i></button>
                            <button class="btn btn-outline-warning btn-sm ml-1" data-toggle="tooltip" data-placement="top" title="Editar"><i class="far fa-edit"></i></button>
                            <button class="btn btn-outline-danger btn-sm ml-1" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="far fa-trash-alt"></i></button>
                        </td>
                        </tr>
                        <tr>
                        <td>Carlos</td>
                        <td>Pérez</td>
                        <td>Jiménez</td>
                        <td>carlos.perez@gmail.com</td>
                        <td>Supervisor</td>
                        <td>
                            <button class="btn btn-outline-primary btn-sm ml-1" data-toggle="tooltip" data-placement="top" title="Visualizar"><i class="far fa-eye"></i></button>
                            <button class="btn btn-outline-warning btn-sm ml-1" data-toggle="tooltip" data-placement="top" title="Editar"><i class="far fa-edit"></i></button>
                            <button class="btn btn-outline-danger btn-sm ml-1" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="far fa-trash-alt"></i></button>
                        </td>
                        </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
          </section>
          <!-- /.Col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <!-- Page specific script -->
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
      })
    });
</script>