{{-- Copyright (c) 2020 <YOUR NAME>

GNU GENERAL PUBLIC LICENSE
   Version 3, 29 June 2007

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>. --}}
<header class="header text-center">
    <h1 class="blog-name pt-lg-4 mb-0"><a href="/home">{{ config('app.name', 'Laravel') }} admin</a></h1>

    <nav class="navbar navbar-expand-lg navbar-dark">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="navigation" class="collapse navbar-collapse flex-column">
            <div class="profile-section pt-3 pt-lg-0">
                <img class="profile-image mb-3 img-thumbnail mx-auto" href='/home' src="{{secure_asset('img/logo2.png')}}" alt="image">

                <hr>
            </div>
            <!--//profile-section-->

            <ul class="navbar-nav flex-column text-left">
                <li class="nav-item {{ Request::is('/home') ? 'active' : ''}}">
                    <a class="nav-link" href="/home"><i class="fas fa-university fa-fw mr-2"></i>Resumen <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item {{ Request::is('mesas') && ! Request::is('mesas/show')? 'active' : ''}}">
                    <a class="nav-link" href="/mesas"><i class="fa fa-cubes fa-fw mr-2 mx-1"></i>Mesas</a>
                </li>
                <li class="nav-item {{ Request::is('productos') ? 'active' : ''}}">
                    <a class="nav-link" href="/productos"><i class="fa fa-cube fa-fw mr-2 mx-1"></i>Productos</a>
                </li>
                <li class="nav-item {{ Request::is('register') ? 'active' : ''}}">
                    <a class="nav-link" href="/register"><i class="fas fa-user-plus mx-1"></i>Nuevo usuario</a>
                </li>
                <div class="my-2 my-md-3">
                    <a class="btn btn-primary" href="/ventas">Ventas</a>
                </div>
                <li class="nav-item mt-3">
                    <a class="nav-link mt-5" href="/logout">Cerrar sesion<i class="fas fa-sign-out-alt mx-1"></i></a>
                </li>
            </ul>

        </div>
    </nav>
</header>
