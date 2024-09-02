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

// Preview

const imgInp = document.getElementsByClassName('imgInp');
const imgPreview = document.getElementsByClassName('imgPriev');

displayImage = () =>{
    for(let i=0; i<imgInp.length; i++){
        imgInp[i].onchange = evt => {
            const [file] = imgInp[i].files
            if (file) {
                imgPreview[i].src = URL.createObjectURL(file)
                deleteImage[i].classList.add('visible-del');
                deleteImage[i].addEventListener('click' , () =>{
                    imgPreview[i].src = '';
                    deleteImage[i].classList.remove('visible-del');
                    document.getElementsByClassName('imgInp')[i].value = '';
                })
            }
        }
    }
}
displayImage();