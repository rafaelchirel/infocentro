<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF-->
        <meta name="csrf_token" content="{{ csrf_token() }}">
        <!-- Icono navegacion -->
        <link rel="shortcat icon" href="{{ asset('img/ico_infocentro.png') }}">

        <title>@yield('title', 'InfoCentro') </title>

        <!-- Bootstrap -->
        <link href="{{ asset('template/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="{{ asset('template/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <!-- NProgress -->
        <link href="{{ asset('template/nprogress/nprogress.css') }}" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="{{ asset('template/build/css/custom.min.css') }}" rel="stylesheet">
        <!-- Aqui inserto mis asset css -->
        @yield('complemento')
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="index.html" class="site_title"><i class="fa fa-cogs"></i> <span>InfoCentro</span></a>
                        </div>

                        <div class="clearfix"></div>

                        <!-- menu profile quick info -->
                        <div class="profile clearfix">
                            <div class="profile_pic">
                                <img src="{{ asset('img/avatar/' . Auth::user()->avatar) }}" alt="users" class="img-circle profile_img">
                            </div>
                            <div class="profile_info">
                                <span>Bienvenido,</span>
                                <h2>{{ Auth::user()->name }}</h2>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <!-- /menu profile quick info -->

                        <br />

                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <h3>General</h3>
                                <ul class="nav side-menu">
                                    <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> Home </a></li>
                                    <li id="componentes-li-usu"><a><i class="fa fa-user"></i> Usuarios <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" id="componentes-ul-usu">
                                            <li><a href="{{ url('usuario/create') }}">Registrar</a></li>
                                            <li><a href="{{ url('usuario') }}">Listar</a></li>
                                        </ul>
                                    </li>
                                    <li id="componentes-li-per"><a><i class="fa fa-users"></i> Personal <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" id="componentes-ul-per">
                                            <li><a href="{{ url('personal/create') }}">Registrar</a></li>
                                            <li><a href="{{ url('personal') }}">Listar</a></li>
                                        </ul>
                                    </li>
                                    <li id="componentes-li-equ"><a><i class="fa fa-sitemap"></i> Equipos <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" id="componentes-ul-equ">
                                            <li><a href="{{ url('equipo/create') }}">Registrar</a></li>
                                            <li id="componentes-li-2-equ"><a href="{{ url('equipo') }}">Listar</a></li>
                                            <li><a href="{{ url('equipo-control') }}">Control</a></li>
                                        </ul>
                                    </li>
                                    <li id="componentes-li"><a><i class="fa fa-toggle-on"></i> Componentes <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" id="componentes-ul">
                                            <li><a href="{{ url('componente/create') }}">Registrar</a></li>
                                            <li id="componentes-li-2"><a href="{{ url('componente') }}">Estatus</a></li>
                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-list-ul"></i> Actividades <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="{{ url('actividad/create') }}">Registrar</a></li>
                                            <li><a href="{{ url('actividad') }}">Proximas a realizar</a></li>
                                            <li><a href="{{ url('actividades-realizadas') }}">Realizadas</a></li>
                                        </ul>
                                    </li>
                                    <!--
                                    <li><a><i class="fa fa-table"></i> Usuarios <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="tables.html">Tables</a></li>
                                            <li><a href="tables_dynamic.html">Table Dynamic</a></li>
                                        </ul>
                                    </li>
                                    -->
                                    <li><a><i class="fa fa-file-text"></i> Reportes <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <!-- Escalon 1 -->
                                            <li><a href="{{ url('reporte-usuario-personal') }}" title="Reporte de Usuario y de Personal">Usuarios | Personal</a></li>
                                            <li><a href="{{ url('reporte-equipo') }}">Equipos</a></li>
                                            <li><a href="{{ url('reporte-componente') }}">Componentes</a></li>
                                            <li><a href="{{ url('reporte-usuarios-sistema') }}" target="_blank" title="Listado de Usuarios">Usuarios | Sistema</a></li>
                                            <li><a href="{{ url('red-social-pdf') }}" target="_blank" title="Listado de Red Social">Red Social</a></li>
                                            <li><a href="{{ url('periferico-pdf') }}" target="_blank" title="Listado de Perifericos">Periferico</a></li>
                                            <li><a href="{{ url('cintillo-pdf') }}" target="_blank" title="Muestra Cintillo">Cintillo</a></li>
                                            <!-- Escalon 3 
                                            <li><a>Equipos<span class="fa fa-chevron-down"></span></a>
                                                <ul class="nav child_menu">
                                                    <li class="sub_menu"><a href="#">Reporte 1</a>
                                                    </li>
                                                    <li><a href="#">Reporte 2</a>
                                                    </li>
                                                    <li><a href="#">Reporte 3</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            -->
                                        </ul>
                                    </li>

                                    @if (!Auth::user()->admin())
                                        <li><a href="{{ url('perfil') }}" onclick="event.preventDefault();document.getElementById('perfil').submit();"><i class="fa fa-male"></i> Mi Perfil </a></li>
                                    @endif

                                    <li><a href="javascript:void(0)"><i class="fa fa-warning"></i> Ayuda <span class="label label-success pull-right">PDF</span></a></li>
                                    <!--
                                    <li><a><i class="fa fa-warning"></i> Ayuda <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="fixed_sidebar.html">Fixed Sidebar</a></li>
                                            <li><a href="fixed_footer.html">Fixed Footer</a></li>
                                        </ul>
                                    </li>
                                    -->
                                </ul>
                            </div>
                            
                        {{-- formulario perfil csrf - Moderador - Admin --}}
                        <form id="perfil" action="{{ url('perfil') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>

                         @if (Auth::user()->admin())
                            <div class="menu_section">
                                <h3>Control</h3>
                                <ul class="nav side-menu">
                                    <li id="componentes-li-users"><a><i class="fa fa-male"></i> Acceso | Sistema <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" id="componentes-ul-users">
                                            <li id="componentes-li-2-users"><a href="{{ url('perfil') }}" onclick="event.preventDefault();document.getElementById('perfil').submit();">Mi Perfil</a></li>
                                            <li><a href="{{ url('user') }}">Usuarios</a></li>
                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-cog"></i> Control <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <!-- <li><a href="#">Cargos</a></li> -->
                                            <li><a href="{{ url('red-social') }}">Red Social</a></li>
                                            <li><a href="{{ url('perifericos') }}">Perifericos</a></li>
                                            <li><a href="{{ url('institucion') }}">Cintillo | PDF</a></li>
                                            <!-- <li><a href="#">Exportar BDD</a></li> -->
                                        </ul>
                                    </li>
                                    <!--
                                    <li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="#level1_1">Level One</a>
                                            <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                                                <ul class="nav child_menu">
                                                    <li class="sub_menu"><a href="level2.html">Level Two</a>
                                                    </li>
                                                    <li><a href="#level2_1">Level Two</a>
                                                    </li>
                                                    <li><a href="#level2_2">Level Two</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a href="#level1_2">Level One</a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>
                                    -->
                                </ul>
                            </div>
                        @endif

                        </div>
                        <!-- /sidebar menu -->

                        <!-- /menu footer buttons 
                        <div class="sidebar-footer hidden-small">
                            <a data-toggle="tooltip" data-placement="top" title="Favorito">
                                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" data-placement="top" title="Widescreen">
                                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" data-placement="top" title="Salir" href="#">
                                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                            </a>
                        </div>
                        -->
                        <!-- /menu footer buttons -->
                    </div>
                </div>

                <!-- top navigation -->
                <div class="top_nav">
                    <div class="nav_menu">
                        <nav>
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                            </div>

                            <ul class="nav navbar-nav navbar-right">
                                <li class="">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <img src="{{ asset('img/avatar/' . Auth::user()->avatar) }}" alt="">{{ Auth::user()->name }}
                                        <span class=" fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                                        <!--
                                        <li><a href="javascript:;"> Profile</a></li>
                                        <li>
                                            <a href="javascript:;">
                                                <span class="badge bg-red pull-right">50%</span>
                                                <span>Settings</span>
                                            </a>
                                        </li>
                                        <li><a href="javascript:;">Help</a></li>
                                        -->

                                        {{-- Logout --}}
                                        <li><a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out pull-right"></i>Salir</a>
                                        </li>
                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>

                                    </ul>
                                </li>
                                <!-- alerta de mensaje
                                                                <li role="presentation" class="dropdown">
                                                                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                                                        <i class="fa fa-envelope-o"></i>
                                                                        <span class="badge bg-green">6</span>
                                                                    </a>
                                                                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                                                        <li>
                                                                            <a>
                                                                                <span class="image"><img src="{{ asset('img/img.jpg') }}" alt="Profile Image" /></span>
                                                                                <span>
                                                                                    <span>John Smith</span>
                                                                                    <span class="time">3 mins ago</span>
                                                                                </span>
                                                                                <span class="message">
                                                                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a>
                                                                                <span class="image"><img src="{{ asset('img/img.jpg') }}" alt="Profile Image" /></span>
                                                                                <span>
                                                                                    <span>John Smith</span>
                                                                                    <span class="time">3 mins ago</span>
                                                                                </span>
                                                                                <span class="message">
                                                                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a>
                                                                                <span class="image"><img src="{{ asset('img/img.jpg') }}" alt="Profile Image" /></span>
                                                                                <span>
                                                                                    <span>John Smith</span>
                                                                                    <span class="time">3 mins ago</span>
                                                                                </span>
                                                                                <span class="message">
                                                                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a>
                                                                                <span class="image"><img src="{{ asset('img/img.jpg') }}" alt="Profile Image" /></span>
                                                                                <span>
                                                                                    <span>John Smith</span>
                                                                                    <span class="time">3 mins ago</span>
                                                                                </span>
                                                                                <span class="message">
                                                                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <div class="text-center">
                                                                                <a>
                                                                                    <strong>See All Alerts</strong>
                                                                                    <i class="fa fa-angle-right"></i>
                                                                                </a>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </li>
                                -->
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- /top navigation -->

                <!-- page content -->
                <div class="right_col" role="main">
                    <div class="">
                        <div class="page-title">
                            <div class="title_left">
                                <h3>@yield('header','header')</h3><br>
                            </div>
                            @yield('buscador')
                            <!--
                                                        <div class="title_right">
                                                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" placeholder="Cedula">
                                                                    <span class="input-group-btn">
                                                                        <button class="btn btn-default" type="button">Buscar</button>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                            -->
                        </div>

                        <div class="clearfix"></div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">

                                        <h2>@yield('titulo','titulo')</h2>

                                        <!-- Botones que van del lado derecho del titulo cajetin-->
                                        @yield('botones')
                                        <!--
                                                                                <ul class="nav navbar-right panel_toolbox">
                                                                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                                                    </li>
                                                                                    <li class="dropdown">
                                                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                                                                        <ul class="dropdown-menu" role="menu">
                                                                                            <li><a href="#">Settings 1</a>
                                                                                            </li>
                                                                                            <li><a href="#">Settings 2</a>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </li>
                                                                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                                                    </li>
                                                                                </ul>
                                        -->
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">

                                        <!-- Aqui es donde insertare el formulario -->
                                        @yield('content')

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /page content -->


                <!-- footer content -->
                <footer>
                    <div class="pull-right">
                        Sitio Oficial del <a href="http://www.infocentro.gob.ve/" target="_blank">InfoCentro</a>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
        </div>

        <!-- jQuery -->
        <script src="{{ asset('template/jquery/dist/jquery.min.js') }}"></script>
        <!-- Bootstrap -->
        <script src="{{ asset('template/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <!-- FastClick -->
        <script src="{{ asset('template/fastclick/lib/fastclick.js') }}"></script>
        <!-- NProgress -->
        <script src="{{ asset('template/nprogress/nprogress.js') }}"></script>
        <!-- Custom Theme Scripts -->
        <script src="{{ asset('template/build/js/custom.min.js') }} "></script>
        <!-- aqui inserto mis asset javascript -->
        @yield('complemento-2')
        <script language=javascript>
            //console.clear();
        </script>
    </body>
</html>
