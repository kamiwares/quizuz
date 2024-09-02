const input = document.getElementsByTagName('input');
const label = document.getElementsByTagName('label');
const inputWrapper = document.getElementsByClassName('create-set-input');
const deleteImage = document.getElementsByClassName('del-img');
for(let i = 0; i<input.length; i++){
    input[i].addEventListener('click', ()=>{
        label[i].style.display= "block";
        input[i].placeholder = "";
        inputWrapper[i].style.boxShadow = 'inset 0px -2px 0px 0px #a8b1ff';
    })
}
