<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Compras') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('fonts/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('fonts/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
  <!-- Modals style -->
  <link rel="stylesheet" href="{{asset('css/modals.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
  <!-- Select2 -->
  <link href="{{asset('dist/css/select2.min.css')}}" rel="stylesheet" />
  <!-- DataTables -->
  <link href="{{asset('dist/css/DataTables/dataTables.bootstrap.min.css')}}" rel="stylesheet" />
  <link href="{{asset('dist/css/DataTables/responsive.dataTables.min.css')}}" rel="stylesheet" />
  <!-- Checkbox -->
  <link href="{{asset('dist/css/checkbox.css')}}" rel="stylesheet" />
  <!-- DatePicker -->
  <link href="{{asset('dist/css/datepicker.css')}}" rel="stylesheet" />
  <!-- Toastr -->
  <link href="{{asset('dist/css/alerts/toastr.css')}}" rel="stylesheet" />
  <style>
    .loader {
      position: fixed;
      left: 0px;
      top: 0px;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background: url({{ asset('dist/img/pageLoader.gif') }}) 50% 50% no-repeat rgb(249,249,249);
      opacity: .8;
    }
    .drag-input {
      margin-bottom:20px;
    }
    .drag-input input {
      width: 0.1px;
      height: 0.1px;
      opacity: 0;
      overflow: hidden;
      position: absolute;
      z-index: -1;
    }
  </style>

  @yield('stylesheet')

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="{{ route('home') }}" class="navbar-brand"><b>Compras</b> Tecnocent</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="{{ route('home') }}">Órdenes de compra <span class="sr-only">(current)</span></a></li>
            <li class="active dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reportes <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{route('reportes.productos_pedidos')}}">Productos pedidos</a></li>
                <li><a href="{{route('reportes.costos')}}">Costos</a></li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Pagos <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item"  href="{{route('reportes.pago-ordenes')}}">Reporte de pagos</a></li>
                    <li><a class="dropdown-item" href="#">Resumen de pagos</a></li>
                  </ul>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="{{asset('dist/img/avatar.png')}}" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">{{Auth()->user()->name}}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="{{asset('dist/img/avatar.png')}}" class="img-circle" alt="User Image">

                  <p>
                    {{Auth()->user()->name}}
                  </p>
                </li>
                <!-- Menu Body -->
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">Perfil</a>
                  </div>
                  <div class="pull-right">
                    <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                      {{ __('Salir') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                    </form>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <div class="loader"></div>
      @yield('content')
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
      </div>
      <strong>Tecnocent</strong>
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->
<!-- jQuery 3.3.1 -->
<script src="{{asset('dist/js/jquery3.3.1.js')}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/app.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<!-- cargando pagina -->
<script type="text/javascript">
    $(window).on('load', function() {
        setTimeout(function () {
            $(".loader").css({visibility:"hidden",opacity:"0"})
        }, 1000);
    });
</script>
<!-- Select2 -->
<script src="{{asset('dist/js/select2.min.js')}}"></script>
<!-- Datatables -->
<script src="{{asset('dist/js/Datatables/dataTables.min.js')}}"></script>
<script src="{{asset('dist/js/Datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('dist/js/Datatables/dataTables.responsive.min.js')}}"></script>
<!-- DatePicker -->
<script src="{{asset('dist/js/datepicker.js')}}"></script>
<script>
    $.fn.datepicker.dates['es'] = {
        days: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        daysShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        daysMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthsShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        today: "Hoy",
        clear: "Limpiar",
        format: "yyyy-mm-dd",
        weekStart: 0
    };
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        language: 'es'
    });
</script>
<!-- Toastr -->
<script src="{{asset('dist/js/alerts/toastr.min.js')}}"></script>
<script type="text/javascript">
    toastr.options = {"closeButton":true,"closeClass":"toast-close-button","closeDuration":300,"closeEasing":"swing","closeHtml":"<button><i class=\"icon-off\"><\/i><\/button>","closeMethod":"fadeOut","closeOnHover":true,"containerId":"toast-container","debug":false,"escapeHtml":false,"extendedTimeOut":10000,"hideDuration":1000,"hideEasing":"linear","hideMethod":"fadeOut","iconClass":"toast-info","iconClasses":{"error":"toast-error","info":"toast-info","success":"toast-success","warning":"toast-warning"},"messageClass":"toast-message","newestOnTop":false,"onHidden":null,"onShown":null,"positionClass":"toast-top-right","preventDuplicates":true,"progressBar":true,"progressClass":"toast-progress","rtl":false,"showDuration":300,"showEasing":"swing","showMethod":"fadeIn","tapToDismiss":true,"target":"body","timeOut":5000,"titleClass":"toast-title","toastClass":"toast"};
</script>
<script>
          @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;

        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
  @endif
</script>
<!-- Validate JQuery -->
<script src="{{asset('dist/js/jquery.form.min.js')}}"></script>
<script src="{{asset('dist/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('dist/js/bootstrap-filestyle.js')}}"></script>
<script src="{{asset('dist/js/filestyle.js')}}"></script>
<!-- Zoom Image -->
<script src="{{asset('dist/js/popImg.js')}}"></script>
<script>$(function(){ $(".imgZoom").popImg(); })</script>
<!-- Drag input -->
<script>
    $('.drag-input').each(function() {
        var self = this;
        var original_val = $(self).find('label').html();
        $(self).children('input').on('change',function(e) {
            var file_name = '';
            if( this.files && this.files.length > 1 ) {
                file_name = this.files.length + " Dateien ausgewählt";
            }
            else if( e.target.value ) {
                file_name = e.target.value.split( '\\' ).pop();
            }
            if( file_name ) {
                $(self).children('label').html( file_name );
            }
            else {
                $(self).children('label').html( original_val );
            }
        });
    });

</script>
<!-- dropdown-menu -->
<script>
  $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
    if (!$(this).next().hasClass('show')) {
    $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
    }
    var $subMenu = $(this).next(".dropdown-menu");
    $subMenu.toggleClass('show');


    $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
    $('.dropdown-submenu .show').removeClass("show");
    });
    return false;
  });
</script>
@yield('javascript')
</body>
</html>
