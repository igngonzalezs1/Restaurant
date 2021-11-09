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
            <h5 class="recipe-description">-</h5>
            <br>
            <h5 class="recipe-mod-preparation">-</h5>
            <br>
            <h5 class="recipe-time-preparation">-</h5>
          </div>
          <div  class="col-md-6">
            <center>
              <h4 class="recipe-price-modal" style="color:red"></h4>
              <h6 class="recipe-iva" style="color:red"></h6>
            </center>
          </div>
          <div class="col-md-6">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center allProducts">
                    <tbody>
                        <tr class="recipe-products">
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Unidad</th>
                        </tr>
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>  
    </div>
  </div>
</div>
<script type="text/javascript">
    var $modalRecipe = $('#modal-recipe');
    var $src = $modalRecipe.find('.card-img-top').attr('src');
    $(document).ready(function(){
        $('.btn-recipe-detail').click(function(e){
            e.preventDefault();
            var recipeId = $(this).data('recipe-id');
            
            getRecipeDetail(recipeId, function(data){
                var recipe = data.recipe;
                var recipeProducts = data.recipeProducts;
                clearModal();
                initModalRecipeDetail($modalRecipe, recipe, recipeProducts);
            });
        });
    });
    
    function getRecipeDetail(recipeId, successCallback) {
        $.ajax({
            type: 'get',
            url: '/admin/recipes/ajaxGetById',
            data: {
                id: recipeId
            },
            success: successCallback,
            error: function(e) { console.log(e);}
        });
    }

    function initModalRecipeDetail($modal, recipe, recipeProducts){
        // clearModalRecipeDetail($modal);
        fillModalRecipeDetail($modal, recipe, recipeProducts);
        $modal.modal('show');
    }
    function fillModalRecipeDetail($modal, recipe, recipeProducts){
      var formatter = new Intl.NumberFormat('es-CL', {
        style: 'currency',
        currency: 'CLP',
      });
      $modal.find('.recipe-name').text(recipe.NAME);
      $modal.find('.recipe-description').text("Descripción: "+recipe.DESCRIPTION);
      $modal.find('.recipe-mod-preparation').text("Preparación: "+recipe.MOD_PREPARATION);
      $modal.find('.recipe-time-preparation').text("Tiempo de Preparación: "+recipe.PREPARATION_TIME+" Minutos");
      $modal.find('.recipe-price-modal').text(formatter.format(Number(recipe.PRICE)));
      $modal.find('#recipe-id').val(recipe.ID);
      $modal.find('#recipe-price').val(recipe.PRICE);
      $modal.find('.card-img-top').attr('src', $src + recipe.IMAGE);
      if(recipe.IVA){
        $modal.find('.recipe-iva').text("Iva Incluido");
      } else {
        $modal.find('.recipe-iva').text("Sin Iva");
      }
      $.each(recipeProducts, function(index, recipeProduct){
        $(".recipe-products").after(`
            <tr>
                <td>${recipeProduct.PRODUCT}</td>
                <td>${recipeProduct.QUANTITE}</td>
                <td>${recipeProduct.UNITS}</td>
            </tr>
        `);
      });
    }
    function clearModal(){
        var records = $modalRecipe.find('.allProducts');
        records.find('tr:not(.recipe-products)').remove();
    }
</script>