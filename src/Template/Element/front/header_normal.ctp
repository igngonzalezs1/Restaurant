
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container col-md-12">
        <div class="col-md-10 col-xs-8">
            <a class="navbar-brand text-brand font-italic justify-content-center" href="/admin/saleRequests/home">El <span class="color-b">Restaurante</span></a>
        </div>
        <!-- ?php if($current_user['GROUP_ID'] === 2): ?-->
        <?php if(true): ?>
            <div class="col-md-2 col-xs-4">
                <a href="/admin/saleRequests/tracking" class="btn btn-b-n"  aria-expanded="false" title="Mis Pedidos" style="text-align:left">
                    <span class="fa fa-bars" aria-hidden="true"></span>
                </a>
                <a href="/admin/saleRequests/saleAccount" class="btn btn-b-n"  aria-expanded="false" title="Mi Cuenta"  style="text-align:right">
                    <span class="fa fa-file-o" aria-hidden="true"></span>
                </a>
            </div>
        <?php endif; ?> 
    </div>
</nav>
<br>
<br>
<br>
<br>