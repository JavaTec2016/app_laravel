<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ALUMBOS</title>

    <!-- BUSTRAP-->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!--JQUERY-->
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script type="text/javascript">
      $(document).ready(function () {
        setTimeout(function () {
          $(".msj").fadeOut(1500);
        }, 3000);
      });
    </script>
  </head>

  <body>
    <header>
      <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
          <a class="navbar-brand" href="/">
            <img
              src="{{asset('images/estudiantes.png')}}"
              class="img-fluid"
          /></a>
          <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarsExample07"
            aria-controls="navbarsExample07"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarsExample07">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="#">INICIO</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Asignaturas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Docentes</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <div class="container mt-5 mb-5">
      <div class="row">
        <div class="col-md-12">
          <h1 style="font-size: 28px; margin-top: 50px" class="text-center">
            CERVICIOS ESCOLARES
          </h1>

          <div class="col-md-10">
            <!--navegacion-->
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page">Inicio</li>
                <li class="breadcrumb-item active" aria-current="page">
                  Alumnos
                </li>
              </ol>
            </nav>

            <div class="row">
              <div class="col-md-12">
                <div class="content-box-large">
                  <div class="panel-heading">
                    <div class="panel-title">
                      <h2>ALUMNOS</h2>
                    </div>
                  </div>
                  <div class="panel-body">

                    @if(Session::has('message'))
                    <div class='alert alert-success' role='alert' id='msj'>
                        {{Session::get('message')}}
                    </div>
                    @endif

                    <a href="/alumnos/create" class="btn btn-success mt-4 ml-3">
                      + agregar
                    </a>
                    <!--Cargar egistro dinamico-->
                    <section class="example mt-4">
                      <table class="table table-hover" id="tabla_alumnos">
                        <thead>
                          <tr>
                            <th>Numero de Control</th>
                            <th>Nombre</th>
                            <th>Primer Ap.</th>
                            <th>Segundo Ap.</th>
                            <th>ACCIONES</th>
                          </tr>
                        </thead>

                        <tbody>
                        @foreach($alumnos as $a)
                          <tr>
                            <td class="v-align-middle">{{$a->num_control}}</td>
                            <td class="v-align-middle">{{$a->nombre}}</td>
                            <td class="v-align-middle">{{$a->primer_ap}}</td>
                            <td class="v-align-middle">{{$a->segundo_ap}}</td>
                            <td class="v-align-middle">
                              <form
                                action={{route('alumnos.destroy', $a)}}
                                method="post"
                                onsubmit="return confirmarEliminacion()"
                                class="form-horizontal"
                                role="form"
                              >
                                @csrf
                                @method('DELETE')
                                <a
                                  href={{route('alumnos.show', $a->id)}}
                                  class="btn btn-primary btn-sm"
                                  >Detalles</a
                                >
                                <a
                                  href={{route('alumnos.edit', $a->id)}}
                                  class="btn btn-warning btn-sm"
                                  >Editar</a
                                >
                                <button
                                  type="submit"
                                  class="btn btn-danger btn-sm"
                                >
                                  Eliminar
                                </button>
                              </form>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                      {!! $alumnos->links() !!}
                    </section>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr />
    <footer class="text-muted mt-3 mb-3">
      <div align="center">FUTER</div>
    </footer>

    <script type="text/javascript">
      function confirmarEliminacion() {
        return confirm("Seguro que quieres ELIMINAR el alumbo?");
      }
    </script>
  </body>
</html>
