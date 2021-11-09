<?= $this->Form->create($salesBox) ?>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <?=
            $this->Form->control('CREATED', [
                'label' => 'Fecha (*)',
                'class' => 'form-control datepicker', 
                'required' => true,
                'type' => 'text',
                'value' => date('Y-m-d', strtotime($salesBox->CREATED))
            ]);
            ?>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <?=
            $this->Form->control('TOTAL_PRICE', [
                'label' => 'Precio (*)',
                'type' => 'number',
                'class' => 'form-control', 
                'required' => true,
            ]);
            ?>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <?=
            $this->Form->control('COMMENTARY', [
                'label' => 'Descripción (*)',
                'class' => 'form-control', 
                'required' => true,
                'rows' => 3,
                'style' => 'height: auto !important;',
            ]);
            ?>
        </div>
    </div>
</div>
<?= $this->Form->button(__('Guardar'),['class' => 'btn btn-danger']) ?>

<?= $this->Form->end() ?>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script>
  $( function() {
    $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' }).val();
  } );
</script>