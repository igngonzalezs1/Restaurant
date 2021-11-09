<div id="modal-recipe" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <img class="card-img-top" src="<?= DS.'img'.DS.'recipes'.DS?>" alt="Card image cap">
          </div>
          <div class="col-md-6">
            <center><h1 class="recipe-name">-</h1></center>
            <br>
            <h4 class="recipe-description">-</h4>
          </div>
          <div  class="col-md-6">
            <center>
              <h4 class="recipe-price-modal" style="color:red"></h4>
              <h6 class="recipe-iva" style="color:red"></h6>
            </center>
          </div>
        </div>
      </div>
      <?= $this->Form->create('',['action' => 'addSaleRequest']) ?>
        <div class="modal-footer">
          <?= $this->Form->hidden('RECIPE_ID',['id' => 'recipe-id'])?>
          <?= $this->Form->hidden('RECIPE_PRICE',['id' => 'recipe-price'])?>
            <div class="col-md-4 col-xs-3">
              <?= $this->Form->control('QUANTITY', [
                'class' => 'form-control',
                'label' => 'Cantidad',
                'required' => true,
                'type' => 'number',
                'min' => 1
              ])?>
            </div>
            <div class="col-md-4 col-xs-3">
              <?= $this->Form->control('OBSERVATIONS', [
                'class' => 'form-control',
                'label' => "Petición Especial",
                'required' => true
              ])?>
            </div>
            <div class="col-md-4 col-xs-3">
              <?= 
                  $this->Form->button('Ordenar!', [
                      'class' => 'btn btn-success',
                      'type'=> 'submit'
                  ]);
              ?>
            </div>
        </div>
      <?= $this->Form->end() ?>    
    </div>
  </div>
</div>
<script type="text/javascript">
    var $modalRecipe = $('#modal-recipe');
    var $src = $modalRecipe.find('.card-img-top').attr('src');
    $(document).ready(function(){

        $('.btn-recipe').click(function(e){
            e.preventDefault();
            var recipeId = $(this).data('recipe-id');
            
            getRecipeDetail(recipeId, function(data){
                var recipe = data.recipe;
                console.log(recipe)
                initModalRecipeDetail($modalRecipe, recipe);
            });
        });
    });
    
    function getRecipeDetail(recipeId, successCallback) {
        $.ajax({
            type: 'get',
            url: '/admin/saleRequests/ajaxGetById',
            data: {
                id: recipeId
            },
            success: successCallback,
            error: function(e) { console.log(e);}
        });
    }

    function initModalRecipeDetail($modal, recipe){
        // clearModalRecipeDetail($modal);
        fillModalRecipeDetail($modal, recipe);
        $modal.modal('show');
    }
    function fillModalRecipeDetail($modal, recipe){
      var formatter = new Intl.NumberFormat('es-CL', {
        style: 'currency',
        currency: 'CLP',
      });
      $modal.find('.recipe-name').text(recipe.NAME);
      $modal.find('.recipe-description').text(recipe.DESCRIPTION);
      $modal.find('.recipe-price-modal').text(formatter.format(Number(recipe.PRICE)));
      $modal.find('#recipe-id').val(recipe.ID);
      $modal.find('#recipe-price').val(recipe.PRICE);
      $modal.find('.card-img-top').attr('src', $src + recipe.IMAGE);
      if(recipe.IVA){
        $modal.find('.recipe-iva').text("Iva Incluido");
      } else {
        $modal.find('.recipe-iva').text("Sin Iva");
      }
    }

</script>