<!--Modal Nota -->
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