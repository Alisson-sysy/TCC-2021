const butAdd = document.getElementById('butAdd');

function toogleForm(){
    if(event.type === 'click') event.preventDefault();
    const menufomr = document.getElementById('fomradd');
    menufomr.classList.toggle('view');
}

// butAdd.addEventListener('click', toogleForm);
