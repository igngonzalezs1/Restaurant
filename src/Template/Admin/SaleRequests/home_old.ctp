<style>
 @media only screen and (min-width: 768px) {
    .sizeBtn
    {
        height: 386px;
        width: 400px;
    }
    .h
    {
        visibility: hidden;
    }
}
@media only screen and (max-width: 768px) {
    .sizeBtn
    {
        height: 386px;
        width: 400px;
    }
    .h
    {
        visibility: visible;
    }
}

.isolate {
  isolation: isolate;
}

.obj {
  width: 300px;
  height: 300px;
  position: absolute;
  border-radius: 50%;
  mix-blend-mode: normal;
}
</style>
<div class="row">
    <div class="col-md-4">
        <center>
            <a href="/Pages/home">
                <button class="btn sizeBtn">
                    <i class="fa fa-cutlery" style="font-size: 80px;"></i>
                    <h1>Ordenar / Carta</h1>
                </button>
            </a>
        </center>
        <br class= "h">
    </div>
    <div class="col-md-4">
        <center>
            <a href="/Pages/home">
                <button class="btn sizeBtn">
                    <i class="fa fa-bars" style="font-size: 80px;"></i>
                    <h1>Mis Pedidos</h1>
                </button>
            </a>
        </center>
        <br class= "h">
    </div>
    <div class="col-md-4">
        <center>
            <a href="/Pages/home">
                <button class="btn sizeBtn">
                    <i class="fa fa-file-text-o" style="font-size: 80px;"></i>
                    <h1>Mi Cuenta</h1>
                </button>
            </a>
        </center>
        <br class= "h">
    </div>
</div>