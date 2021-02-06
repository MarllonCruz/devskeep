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

<?php
// Modal Nota 
require_once "partials/modal-nota.php";
// Modal Marcadores
require_once "partials/modal-marcadores.php";

require_once "partials/footer.php";
require_once "script-action.php";