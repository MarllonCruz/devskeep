<div class="container">
    <input type="checkbox" id="chec" />
    <label for="chec">
        <i id="btn-aside" class="fa fa-bars" aria-hidden="true"></i>
    </label>
    <aside>
        <label for="chec">
            <i id="btn-aside-close" class="fa fa-times" aria-hidden="true"></i>
        </label>
        <ul>
            <li class="<?=($action == 'home')?'action':''?>">
                <a href="<?=$base;?>">
                    <div class="icon">
                        <i class="fa fa-lightbulb-o" aria-hidden="true"></i>                            <i class="fa fa-lightbulb-o" aria-hidden="true"></i>
                    </div>
                    <div class="name"><span data-text="Notas">Notas</span></div>
                </a>
            </li>
            <?php if($marks): ?>
                <?php foreach($marks as $item): ?>
                    <li class="<?=($action == $item->id)?'action':''?>">
                        <a href="<?=$base;?>/marcador.php?mark=<?=$item->id;?>">
                            <div class="icon">
                                <i class="fa fa-thumb-tack" aria-hidden="true"></i>
                                <i class="fa fa-thumb-tack" aria-hidden="true"></i>
                            </div>
                            <div class="name"><span data-text="<?=$item->title;?>"><?=$item->title;?></span></div>
                        </a>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
            <li>
            <a href="" id="edit-mark">
                <div class="icon">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </div>
                <div class="name"><span data-text="Editar Marcadores">Editar Marcadores</span></div>
            </a>
        </li>
        <li class="<?=($action == 'trash')?'action':''?>">
            <a href="<?=$base;?>/trash.php">
                <div class="icon">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </div>
                <div class="name"><span data-text="Lixeira">Lixeira</span></div>
            </a>
        </li>
    </ul>
</aside>