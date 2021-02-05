<?php
require_once 'config.php';
require_once 'dao/NoteDaoMysql.php';
require_once 'dao/MarkDaoMysql.php';

$noteDao = new NoteDaoMysql($pdo);
$markDao = new MarkDaoMysql($pdo);

$total = $noteDao->getCountNotesByMark($_GET['mark']);
$paginas = ceil($total/$limit);
$paginaAtual = 1;
if(!empty($_GET['p']) && is_numeric($_GET['p'])) {
    $paginaAtual = intval($_GET['p']);
}
$offset = ($paginaAtual*$limit) - $limit;

$notes = $noteDao->getNoteAll($offset, $limit);

if(isset($_GET['mark']) && !empty($_GET['mark'])) {
    if($markDao->existsMark($_GET['mark'])) {
        $notes = $noteDao->getNoteAllByMark($_GET['mark']);
        $action = $_GET['mark'];
    } else {
        header('Location: '.$base);
    }
}  else {
    header('Location: '.$base);
}

$marks = $markDao->getMarkAll();


require_once 'partials/header.php';
require_once 'partials/menu-aside.php';
?>

<div class="keep--area">
    <section class="section-mark">
        <?php if(!empty($notes)): ?>
            <?php foreach($notes as $item): ?>
                <div class="box-note" data-id="<?=$item->id;?>" data-id-mark="<?=(!empty($item->id_mark))?$item->id_mark:'default';?>">
                    <h3><?=$item->title;?></h3>
                    <p class="box-note-txt"><?=$item->txt;?></p>
                    <div class="marcadores">
                        <?php if(!empty($item->title_mark)):?>
                            <div class="marcador">
                                <?=$item->title_mark;?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach;?>
        <?php endif; ?>   
    </section>

    <div class="links-pages">
        <?php for($q=1;$q<=$paginas;$q++): ?>
            <?php if($paginaAtual == $q): ?>
                <a class='button-pages-hover' href="<?=$base;?>/marcador.php?mark=<?=$_GET['mark'];?>&p=<?=$q;?>"><?=$q;?></a>
            <?php else: ?>
                <a class='button-pages' href="<?=$base;?>/marcador.php?mark=<?=$_GET['mark'];?>&p=<?=$q;?>"><?=$q;?></a>
            <?php endif; ?>
        <?php endfor; ?>
    </div>
</div>
</div>

<!--Modal Nota -->
<div class="modal-container-opacity"></div>
<div class="modal-box-note">
    <form>
        <input placeholder="Titulo..." type="text" name="modal-title" />
        <textarea placeholder="Texto da nota..."></textarea>
        <div class="select-marks">
            <i class="fa fa-thumb-tack" aria-hidden="true"></i>
            <select>
                <option value="default">Nenhum</option>
                <?php if(!empty($marks)): ?>
                    <?php foreach($marks as $item): ?>
                        <option value="<?=$item->id;?>"><?=$item->title;?>
                    <?php endforeach; ?>
                <?php endif; ?>    
            </select>
        </div>
        
        <div class="modal-menus">
            <a id="update-note" href="">Salvar</a>
            <a id="close-note" href="">Cancelar</a>
            <a id="thash-note" href="">Lixeira</a>
        </div>
    </form>
</div>
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

<?php
require_once "partials/footer.php";
require_once "script-action.php";