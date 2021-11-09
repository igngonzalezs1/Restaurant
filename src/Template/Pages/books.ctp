
<?= $this->Html->css('front/books') ?>

<div class="container">

    <div class="row">
        <? foreach($books as $key => $book): ?>
        <div class="col-md-3">
            <img alt="<?= $book->name ?>" src="/<?=$book->book_dir?>">
            <div class="descLib">
                <p> 
                    <h4> <?= $book->name ?> </h4>
                    <? 
                        $full_text = $book->sypnosis; 
                        $show_text = substr($book->sypnosis, 0,27);
                        if (strlen($full_text) > 27) {
                            $show_text.="...";
                        }
                    ?>

                    <h5 title="<?= $full_text ?>"> <?= $show_text ?></h5>
                </p>
            </div>
        </div>
        <? endforeach ?>
    </div>
</div>