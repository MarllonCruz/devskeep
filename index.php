<?php
require_once 'config.php';
require_once 'dao/NoteDaoMysql.php';
require_once 'dao/MarkDaoMysql.php';

$noteDao = new NoteDaoMysql($pdo);
$markDao = new MarkDaoMysql($pdo);

$flash  = '';
$action = 'home';

if(isset($_GET['search']) && !empty($_GET['search'])) {
    $total = $noteDao->getCountNotesBySearch($_GET['search']);
    $paginas = ceil($total/$limit);
    $paginaAtual = 1;
    if(!empty($_GET['p']) && is_numeric($_GET['p'])) {
        $paginaAtual = intval($_GET['p']);
    }
    $offset = ($paginaAtual*$limit) - $limit;

    $notes = $noteDao->getNoteSearch($_GET['search'], $offset, $limit);
    if(!empty($notes)) {
        $flash = 'Resultado da busca :'.$_GET['search'];
    } else {
        $flash = 'Nenhum resultado da busca :'.$_GET['search'];
    }
} else {

    $total = $noteDao->getCountNotes();
    $paginas = ceil($total/$limit);
    $paginaAtual = 1;
    if(!empty($_GET['p']) && is_numeric($_GET['p'])) {
        $paginaAtual = intval($_GET['p']);
    }
    $offset = ($paginaAtual*$limit) - $limit;

    $notes = $noteDao->getNoteAll($offset, $limit);
}

$marks = $markDao->getMarkAll();


require_once 'partials/header.php';
require_once 'partials/menu-aside.php';
?>

<div class="keep--area">
    <div class="keep--newAreaNote">
        <form class="keep--form" method="GET">
            <div class="keep--flash">Preenche os campos!</div>
            <input type="text" name="new-title" placeholder="Criar nova nota..." autocomplete="off" />
            <textarea name="new-body" placeholder="Criar uma nota..."></textarea>
            <div class="keep--menus">
                <div class="btns menu-save">Salvar</div>
                <div class="btns menu-close">Fechar</div>
            </div>
        </form>
    </div>

    <!-- flash da busca -->
    <?php if(!empty($flash)): ?>
        <div class="flash-search">
            <?=$flash;?>
        </div>
    <?php endif; ?>

    <section>
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
                <a class='button-pages-hover' href="<?=$base;?>?p=<?=$q;?>"><?=$q;?></a>
            <?php else: ?>
                <a class='button-pages' href="<?=$base;?>?p=<?=$q;?>"><?=$q;?></a>
            <?php endif; ?>
        <?php endfor; ?>
    </div>
</div>
</div>

<!--opacity do modals -->
<div class="modal-container-opacity"></div>

<?php
// Modal Nota 
require_once "partials/modal-nota.php";
// Modal Marcadores
require_once "partials/modal-marcadores.php";

require_once "partials/footer.php";
require_once "script-action.php";