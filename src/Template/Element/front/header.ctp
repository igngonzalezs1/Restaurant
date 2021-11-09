
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand text-brand font-italic" href="/Pages/home">El <span class="color-b">Restaurante</span></a>
        <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/Pages/home">Inicio</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="/Pages/books">Libros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Pages/contactUs">Contactanos</a>
                </li> -->
            </ul>
        </div>
        <?php if(isset($current_user['ID'])): ?> 
            <a href="/admin/users/index" class="btn btn-b-n navbar-toggle-box-collapse d-none d-md-block"  aria-expanded="false" title="Administrador">
                <span class="fa fa-user" aria-hidden="true"></span>
            </a>
        <? else: ?> 
            <a href="/admin/users/login" class="btn btn-b-n navbar-toggle-box-collapse d-none d-md-block"  aria-expanded="false" title="Iniciar Sesion">
                <span class="fa fa-user" aria-hidden="true"></span>
            </a>
        <? endif; ?> 
    </div>
</nav>