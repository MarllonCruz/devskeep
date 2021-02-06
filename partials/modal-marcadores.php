<!--Modal Marcodes -->
<div class="modal-box-mark">
    <form method="POST">
        <input type="text" name="new-mark" placeholder="Criar marcador..." />
        <i id="btn-add-mark" class="fa fa-plus-square" aria-hidden="true"></i>
    </form>
    <div class="container-marks">
        <?php if(!empty($marks)): ?>
            <?php foreach($marks as $item): ?>
                <div class="mark" data-id="<?=$item->id;?>">
                    <p><?=$item->title;?></p>
                    <i id='btn-del-mark' class="fa fa-trash" aria-hidden="true"></i>
                </div>
            <?php endforeach; ?>    
        <?php endif; ?>
    </div>  
    <div class="modal-btn-close">
        <a>Fechar</a>
    </div>   
</div>