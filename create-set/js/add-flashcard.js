const addFlashcardButton = document.getElementsByClassName('add-flashcard-button')[0];
const createFlashcard = document.getElementsByClassName('create-flashcard')[0];
const deleteFlashcard = document.getElementsByClassName('del-item');
const flashcard = document.getElementsByClassName('create-flashcard');
const uploadButton = document.getElementsByClassName('upload-file-wrapper');
addFlashcardButton.addEventListener('click', () =>{
    const clone = createFlashcard.cloneNode(true);
    for(let i=0; i<clone.querySelectorAll('input').length; i++){
        clone.querySelectorAll('input')[i].value='';
    }
    clone.getElementsByClassName('imgPriev')[0].src = "";
    for(let i = 0; i<clone.querySelectorAll('.del-item').length; i++){
        clone.getElementsByClassName('del-item-btn')[i].addEventListener('click', () => delItem(clone));
    }
    document.getElementsByClassName('create-set-flashcard-section')[0].appendChild( clone );
    if(clone.getElementsByClassName('del-img')[0].classList.contains('visible-del')){
        clone.getElementsByClassName('del-img')[0].classList.remove('visible-del')
    }
    displayImage();
})

//First flashcard delete 
document.getElementsByClassName('del-item-btn')[0].addEventListener('click', () => delItem(createFlashcard));


//Delete flashcard
delItem = (clone) =>{
    if(flashcard.length==1){
        console.log('Musisz mieć chociaż jedną fiszke!')
    }
    else{
        clone.remove();
    }
}


//Upload file

