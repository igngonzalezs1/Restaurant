<?= $this->Form->create($providerProduct) ?>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <?=
            $this->Form->control('PRODUCT_ID', [
                'label' => 'Producto (*)',
                'class' => 'form-control', 
                'required' => true,
                'options' => $products,
                'empty' => 'Seleccione'
            ]);
            ?>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <?=
            $this->Form->control('QUANTITE', [
                'label' => 'Cantidad (*)',
                'class' => 'form-control', 
                'required' => true
            ]);
            ?>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <?=
            $this->Form->control('UNIT_ID', [
                'label' => 'Unidad (*)',
                'class' => 'form-control', 
                'required' => true,
                'options' => $unitsOfWeights,
                'empty' => 'Seleccione'
            ]);
            ?>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <?=
            $this->Form->control('PROVIDER_ID', [
                'label' => 'Proveedor (*)',
                'class' => 'form-control', 
                'required' => true,
                'options' => $providers,
                'empty' => 'Seleccione'
            ]);
            ?>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <?=
            $this->Form->control('PRICE', [
                'label' => 'Precio (*)',
                'class' => 'form-control', 
                'required' => true,
            ]);
            ?>
        </div>
    </div>
</div>
<?= $this->Form->button(__('Guardar'),['class' => 'btn btn-danger']) ?>

<?= $this->Form->end() ?>