const btnMobile =  document.getElementById('btn-mobile');

function toogleMenu(){
    if(event.type === 'touchstart') event.preventDefault();
    const nav =  document.getElementById('nav');
    const button = document.getElementById('btn-mobile');
    nav.classList.toggle('active');

    if(button.value == "╳"){
        button.value = "☰";
    }else{
        button.value = "╳";
        button.style.cssText  = '15px';
    }
}

btnMobile.addEventListener('click', toogleMenu);
btnMobile.addEventListener('touchstart', toogleMenu);