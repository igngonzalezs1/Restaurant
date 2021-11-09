<style>
    div.polaroid {
        width: 80%;
        background-color: white;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        margin-bottom: 25px;
    }
    .titleCard{
        text-align: center;
        text-transform: capitalize;
        font-family: 'Akzidenz Grotesk BoldEx';
        line-height: 28px;
        max-width: 400px;
        margin: 5px auto 0;
        font-size: 24.1px;
    }

    .textCard{
        text-align: center;
        color: red;
    }
</style>
<div class="col-md-3  special-box">
    <div class="row">
    <?= $this->Form->create() ?>
        <div class="col-md-12">
            <div class="form-group">
                <?= $this->Form->control('NAME', [
                    'label' => 'Nombre',
                    'class' => 'form-control',
                ]); ?>
            </div>
        </div>
        <div class="col-md-12">
            <div class="btn-toolbar">
                <?= 
                    $this->Form->button('Filtrar', [
                        'class' => 'btn btn-danger',
                        'type'=> 'submit'
                    ]);
                ?>
                <?= 
                $this->Html->link('Limpiar', 
                    ['action' => 'home'],
                    ['class' => 'btn btn-default pull-right',
                    ]);
                ?>
            </div>
        </div>
    <?= $this->Form->end() ?>    
    </div>
</div>
<div class="col-md-9">
    <div class="row">
        <? foreach($recipes as $recipe): ?>
            <div class="col-md-4 col-xs-4 btn-recipe" data-recipe-id="<?= $recipe->ID?>" style="cursor: pointer;" >
                <div class="">
                    <h3 class="card-title titleCard"><?= $recipe->NAME?></h3>
                    <img class="card-img-top d-block w-100" src="<?= DS.'img'.DS.'recipes'.DS.$recipe->IMAGE?>" alt="Card image cap">
                </div>
            </div>
        <? endforeach; ?>
    </div>
</div>
<?php echo $this->element('SaleRequests/modal_show_recipe') ?>