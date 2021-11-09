
<div>
    <div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel" >
        <ol class="carousel-indicators" style="">
            <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-1z" data-slide-to="1"></li>
            <li data-target="#carousel-example-1z" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <?= $this->Html->image('fondo1.1.jpg',['alt'=>'Primera slide', 'class' => 'd-block w-100 img-min']);?>
            </div>
            <div class="carousel-item">
                <?= $this->Html->image('fondo2.2.jpeg',['alt'=>'Segunda imagen', 'class' => 'd-block w-100 img-min']);?>
            </div>
            <div class="carousel-item">
                <?= $this->Html->image('fondo3.3.jpg',['alt'=>'Tercera imagen', 'class' => 'd-block w-100 img-min']);?>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
        </a>
        <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
        </a>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <br>
            <h1>¿Quiénes somos?</h1>
            <p style="margin-left:1em;">"El Restaurante" se inicia en el año 1997, antes de esa fecha nuestra familia ya tenía un negocio similar en menor escala, la “Fuente Italiana”, del cual tomamos el concepto de pastas de la más alta calidad y un excelente servicio, agregando más variedad de platos como las carnes a la parrilla y exótica gastronomía del mar. Nuestra empresa es 100% familiar con recetas que nuestra madre Piccola Italia nos entregó, ofreciendo preparaciones de calidad garantizada, con combinaciones únicas de ingredientes. En nuestros restaurantes, siempre encontrarás excelentes  productos, en un ambiente familiar, con la mejor atención y a precios convenientes. Nuestros locales están minuciosamente preparados para reuniones familiares y celebraciones. Ese sabor tradicional e inolvidables momentos es lo que queremos transmitir al resto de los chilenos.</p>
        </div>
        <div class="col-md-6 col-xs-8">
            <br>
            <center><?= $this->Html->image('quienes_somos.jpg',['alt'=>'Imagen no Disponible', "class" => "img-fluid"]);?></center>
            <br>
        </div>
    </div>
</div>