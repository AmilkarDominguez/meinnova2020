<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Distribuidora Miranda</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">


    <!-- Styles  tadatable -->
    <!--<link rhref="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" el="stylesheet" >-->


    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontello.css') }}">

    <!-- Iconos para tempusdominus -->
    <!-- Tempusdominus DateTime Picker-->
    <link rel="stylesheet" href="{{ asset('css/tempusdominus-bootstrap-4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    Miranda
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                @can('shop')
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownTienda" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-tags"></i>Tienda
                                </a>
                                

                                <div class="dropdown-menu" aria-labelledby="navbarDropdownTienda">
                                    <a class="dropdown-item" href="{{ route('shop') }}">Registrar venta</a>
                                    <!--<a class="dropdown-item" href="#">Registrar cotización</a>-->
                                </div>
                                @endcan
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownAdmVentas" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-list-alt"></i>Administrar ventas
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownAdmVentas">
                                    @can('client')
                                    <a class="dropdown-item" href="{{ route('client') }}">Clientes</a>
                                    @endcan
                                    @can('sale')
                                    <a class="dropdown-item" href="{{ route('sale') }}">Ventas</a>
                                    @endcan
                                    @can('seller')
                                    <a class="dropdown-item" href="{{ route('seller') }}">Vendedores</a>
                                    @endcan
                                    <div class="dropdown-divider"></div>
                                    @can('salecompleted')
                                    <a class="dropdown-item" href="{{ route('salecompleted') }}">Finalizar ventas</a>
                                    @endcan
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownAdmInventario" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-box"></i>Administrar inventario
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownAdmInventario">
                                    @can('product')
                                    <a class="dropdown-item" href="{{ route('product') }}">Productos</a>
                                    @endcan
                                    @can('batch')
                                    <a class="dropdown-item" href="{{ route('batch') }}">Lotes (Compras)</a>
                                    @endcan
                                    @can('provider')
                                    <a class="dropdown-item" href="{{ route('provider') }}">Proveedores</a>
                                    @endcan       
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownReportes" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-money"></i>Cobranzas
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownReportes">
                                    @can('payment')
                                    <a class="dropdown-item" href="{{ route('payment') }}">Registro de cobranzas</a>
                                    @endcan
                                    @can('collector')
                                    <a class="dropdown-item" href="{{ route('collector') }}">Cobradores</a>
                                    @endcan
                                    @can('charge')
                                    <a class="dropdown-item" href="{{ route('charge') }}">Cobros</a>
                                    @endcan
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownReportes" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-docs"></i>Reportes
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownReportes">
                                    <a class="dropdown-item" href="{{ route('sellerreport') }}">Ventas por vendedor</a>    
                                    <a class="dropdown-item" href="{{ route('reportline') }}">Productos por linea</a>
                                    <a class="dropdown-item" href="{{ route('reportcollector') }}">Cobranzas por cobrador</a>
                                    <a class="dropdown-item" href="{{ route('reportaccount') }}">Cuentas por cobrar</a>
                                    <a class="dropdown-item" href="{{ route('reportzone') }}">Cuentas por cobrar por zona</a>
                                </div>
                            </li>
                           
                            <li class="nav-item dropdown">                               
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownAdministracion" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-sliders"></i>Configuración
                                </a>                            
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownAdministracion">
                                    @can('company')
                                    <a class="dropdown-item" href="#">Empresa</a>
                                    @endcan
                                    @can('user')
                                    <a class="dropdown-item" href="{{ route('user') }}">Usuarios</a>
                                    @endcan
                                    <div class="dropdown-divider"></div>
                                    @can('industry')
                                    <a class="dropdown-item" href="{{ route('industry') }}">Industrias</a>
                                    @endcan

                                    @can('deposit')
                                    <a class="dropdown-item" href="{{ route('deposit') }}">Almacenes</a>
                                    @endcan

                                    @can('zone')
                                    <a class="dropdown-item" href="{{ route('zone') }}">Zonas</a>
                                   @endcan
                                    @can('line')       
                                    <a class="dropdown-item" href="{{ route('line') }}">Lineas</a>
                                   @endcan
                                </div>
                               
                            </li>
                           
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <!--<a class="dropdown-item" href="!#">Cambiar contraseña</a>-->
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Salir') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="p-2">
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/assets/jquery-3.3.1.js') }}"></script>
    <script src="{{ asset('js/assets/popper.min.js') }}"></script>
    <script src="{{ asset('js/assets/bootstrap.min.js') }}"></script>
    <!--Alert-->
    <script src="{{ asset('js/assets/toastr.js') }}"></script>
    <!--Date Tables-->
    <script src="{{ asset('js/assets/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/assets/dataTables.bootstrap4.min.js') }}"></script>
    <!--Export Print DateTables-->
    <script src="{{ asset('js/assets/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/assets/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/assets/jszip.min.js') }}"></script>
    <script src="{{ asset('js/assets/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/assets/vfs_fonts.js') }}"></script>
    <script src="{{ asset('js/assets/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/assets/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/assets/buttons.colVis.min.js') }}"></script>
    <!--Tempusdominus DateTime Picker-->
    <script src="{{ asset('js/assets/moment.js') }}"></script>
    <script src="{{ asset('js/assets/es.js') }}"></script>
    <script src="{{ asset('js/assets/tempusdominus-bootstrap-4.js') }}"></script>

    @yield('scripts')
</body>
</html>
