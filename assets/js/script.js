const c = (el)=> document.querySelector(el);
const cs = (el)=> document.querySelectorAll(el);


c('.input-search input[name=search]').addEventListener('keyup', (e)=>{
    let txt = c('.input-search input[name=search]').value;
    if(txt != "") {
        c('.input-search .search-limpar').style.display = 'flex';
    } else {
        c('.input-search .search-limpar').style.display = 'none';
    }
});
c('.input-search input[name=search]').addEventListener('focus', ()=>{
    c('.input-search').classList.add('active');
});
c('.input-search input[name=search]').addEventListener('blur', ()=>{
    c('.input-search').classList.remove('active');
});

c('.input-search .search-limpar').addEventListener('click', (e)=> {
    e.preventDefault();
    c('.input-search input[name=search]').value = "";
    c('.input-search .search-limpar').style.display = 'none';
});
if(c('.menu-close')) {
    c('.menu-close').addEventListener('click', ()=>{
        c('.keep--newAreaNote').classList.remove('active');
        c('.keep--newAreaNote').classList.remove('flash');
        c('.keep--form textarea').style.maxHeight = '70px';
        c('.keep--form textarea').style.minHeight = '70px';
        c('.keep--newAreaNote .keep--flash').style.display = 'none';
        c('.keep--form input[name=new-title]').placeholder = 'Criar nova nota...';
        c('.keep--form input[name=new-title]').value = '';
        c('.keep--form textarea').value = '';
    });
}

if(c('.keep--form input')) {
    c('.keep--form input').addEventListener('click', ()=>{
        c('.keep--newAreaNote').classList.add('active');
        c('.keep--form input[name=new-title]').placeholder = 'Titulo';
    });
}


c('#edit-mark').addEventListener('click', (e)=>{
    e.preventDefault();

    c('.modal-container-opacity').classList.add('active');
    c('.modal-box-mark').classList.add('active');
});

if(c('.modal-btn-close a')) {
    c('.modal-btn-close a').addEventListener('click', (e)=>{
        e.preventDefault();
    
        c('.modal-container-opacity').classList.remove('active');
        c('.modal-box-mark').classList.remove('active');
        setInterval(() => {
            location.href = location.href;
        }, 400);
    });
}





