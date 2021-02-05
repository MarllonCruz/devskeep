<?php
require_once 'config.php';
require_once 'dao/NoteDaoMysql.php';
require_once 'dao/MarkDaoMysql.php';

$noteDao = new NoteDaoMysql($pdo);
$markDao = new MarkDaoMysql($pdo);

$action = 'trash';

$notes = $noteDao->getNoteAllModoTrash();
$marks = $markDao->getMarkAll();

require_once 'partials/header.php';
require_once 'partials/menu-aside.php';
?>

<div class="keep--area">
    
    <section class='section-trash'>
        <?php if(!empty($notes)): ?>
            <?php foreach($notes as $item): ?>
                <div class="box-note trash" data-id="<?=$item->id;?>" data-id-mark="<?=(!empty($item->id_mark))?$item->id_mark:'default';?>">
                    <h3><?=$item->title;?></h3>
                    <p class="box-note-txt"><?=$item->txt;?></p>
                    <div class="marcadores">
                        <?php if(!empty($item->title_mark)):?>
                            <div class="marcador">
                                <?=$item->title_mark;?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="menus-trash">
                        <i id="trash-up" title="recuperar" class="fa fa-trash" aria-hidden="true"></i>
                        <i id="trash-del" title="excluir" class="fa fa-trash" aria-hidden="true"></i>
                    </div>
                </div>
            <?php endforeach;?>
        <?php endif; ?>   
    </section>
</div>
</div>

<!--Modal Marcodes -->
<div class="modal-container-opacity"></div>
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


<?php
require_once "partials/footer.php";
require_once "script-action.php";
?>
<script> 

// modo recuperar a nota na lixeira
document.querySelectorAll('#trash-up').forEach((item)=>{
    item.addEventListener('click', async ()=>{
        let id = item.closest('.box-note').getAttribute('data-id');

        if(id != '') {
            let data = new FormData();
            let modo = 'off';
            data.append('id', id);
            data.append('modo', modo);

            let req = await fetch('ajax-trash-note.php', {
                method:'POST',
                body: data
            });

            setInterval(() => {
                location.href = '<?=$base.'/trash.php';?>';
            }, 400);
        }
    });
});

// modo excluir a nota na lixeira
document.querySelectorAll('#trash-del').forEach((item)=>{
    item.addEventListener('click', async ()=>{
        let id = item.closest('.box-note').getAttribute('data-id');

        if(id != '') {
            let data = new FormData();
            let modo = 'del';
            data.append('id', id);
            data.append('modo', modo)

            let req = await fetch('ajax-trash-note.php', {
                method:'POST',
                body: data
            });

            setInterval(() => {
                location.href = '<?=$base.'/trash.php';?>';
            }, 400);
        }
    });
});

</script>