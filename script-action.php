<script>
window.addEventListener('load', ()=>{

    // Actions Notas
    if(document.querySelector('.keep--menus .menu-save')) {
        document.querySelector('.keep--menus .menu-save').addEventListener('click', async ()=>{
        
            let title = document.querySelector('.keep--form input[name=new-title]').value;
            let txt   = document.querySelector('.keep--form textarea[name=new-body]').value;
            if(title != '' && txt != '') {
                addNote(title, txt);
            } else {
                document.querySelector('.keep--form textarea').style.maxHeight = '48px';
                document.querySelector('.keep--form textarea').style.minHeight = '48px';
                document.querySelector('.keep--newAreaNote').classList.add('flash');
                document.querySelector('.keep--newAreaNote .keep--flash').style.display = 'block';
            }
            
        });
    }
    

    async function addNote(title, txt) {
        let data = new FormData();
        data.append('title', title);
        data.append('txt', txt);

        let req = await fetch('ajax-add-note.php', {
            method:'POST',
            body: data
        });
        location.href = location.href;
    }

    // abrir modal note
    document.querySelectorAll('.box-note').forEach((item)=>{
        item.addEventListener('click', ()=>{
            
            let id      = item.getAttribute('data-id');
            let title   = item.querySelector('h3').innerHTML;
            let txt     = item.querySelector('p').innerHTML;
            let id_mark = item.getAttribute('data-id-mark');
            

            c('.modal-box-note form input[name=modal-title]').value = title;
            c('.modal-box-note form textarea').value                = txt;
            c('.modal-box-note').setAttribute('data-id', id);
            if(id_mark != 'default') {
                c('.select-marks select').value = id_mark;
            }

            c('.modal-box-note').classList.add('active');
            c('.modal-container-opacity').classList.add('active');
            c('.modal-box-note').style.transition = '0.5s';
        });
    });

    // botao de fechar modal note
    if(document.querySelector('#close-note')) {
        document.querySelector('#close-note').addEventListener('click', (e)=>{
            e.preventDefault();
            let f5 = 'off';
            closeModalNote(f5);
        });
    }
    
    // atualizar informações note 
    if(document.querySelector('#update-note')) {
        document.querySelector('#update-note').addEventListener('click', async (e)=>{
            e.preventDefault();
            let id       = c('.modal-box-note').getAttribute('data-id');
            let title    = c('.modal-box-note form input[name=modal-title]').value;
            let txt      = c('.modal-box-note form textarea').value;
            let id_mark  = c('.select-marks select').value;

            if(id != '' && title != '' && txt != '') {
                let data = new FormData();
                data.append('id', id);
                data.append('title', title);
                data.append('txt', txt);
                data.append('id_mark', id_mark);

                let req = await fetch('ajax-update-note.php', {
                    method:'POST',
                    body: data
                });
                let f5 = 'on';
                closeModalNote(f5);
            }   
        });
    }

    // modo lixeirda note {
    if(document.querySelector('#thash-note')) {
        document.querySelector('#thash-note').addEventListener('click', async (e)=> {
            e.preventDefault();

            let id       = c('.modal-box-note').getAttribute('data-id');

            if(id != '') {
                let data = new FormData();
                let modo = 'on';
                data.append('id', id);
                data.append('modo', modo)

                let req = await fetch('ajax-trash-note.php', {
                    method:'POST',
                    body: data
                });
                let f5 = 'on';
                closeModalNote(f5);
            }
        });        
    }
    
    
    function closeModalNote(f5) {
        c('.modal-box-note form input[name=modal-title]').value = '';
        c('.modal-box-note form textarea').value                = '';
        c('.select-marks select').value                         = 'default';

        c('.modal-box-note').classList.remove('active');
        c('.modal-container-opacity').classList.remove('active');
        if(f5 == 'on') {
            setInterval(() => {
                location.href = location.href;
            }, 400);
        } 
    }

    // Actions Marcadores
    document.querySelector('#btn-add-mark').addEventListener('click', async ()=>{

        let title = document.querySelector('form input[name=new-mark]').value;
        
        if(title != '') {
            document.querySelector('form input[name=new-mark]').value = '';
            let data = new FormData();
            data.append('title', title);

            let req = await fetch('ajax-add-mark.php', {
                method:'POST',
                body: data
            });
            let json = await req.json();

            if(json != '') {
                updateModalMark(json);
            }
        }

    });

    async function updateModalMark(json) {

        let div = document.querySelector('.container-marks');
        div.innerHTML = '';

        json.map((item)=>{
            //Atualizando informações marcadores.
            let html = `<div class="mark" data-id="${item.id}">`;
            html    += `<p>${item.title}</p>`;
            html    += `<i id='btn-del-mark' class="fa fa-trash" aria-hidden="true"></i>`;
            html    += `</div>`;

            div.innerHTML += html;
        });
        delOrUpdateMarks();
        
    }

    delOrUpdateMarks();

    function delOrUpdateMarks() {
        document.querySelectorAll('#btn-del-mark').forEach((item)=>{
            item.addEventListener('click', async ()=>{
                let id = item.closest('.mark').getAttribute('data-id');
                let data = new FormData();
                data.append('id', id);

                let req = await fetch('ajax-del-mark.php', {
                    method:'POST',
                    body: data
                });
                let json = await req.json();

                if(json != '') {
                    updateModalMark(json);
                }
            });
            
        });
    }

});
</script>