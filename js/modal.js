let modals = document.getElementsByClassName('modal');
let buttons = document.getElementsByClassName('modal-open');
const closeButtons = document.getElementsByClassName('modal-close');
const modalBgs = document.getElementsByClassName('modal-background');

for(let i =0; i<modals.length; i++){
    const modal = modals[i];
    const button = buttons[i];
    const closeButton = closeButtons[i];
    const background = modalBgs[i];
    button.addEventListener('click', function (){
        modal.style.display = 'block';
    })
    background.addEventListener('click', function (){
        modal.style.display = 'none';
    })
    closeButton.addEventListener('click', function (){
        modal.style.display = 'none';
    })
}