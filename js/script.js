const elem = document.getElementsByClassName('element');
const nextButton = document.getElementsByClassName('next-element');
const answer = document.getElementsByClassName('answer');
const summary = document.getElementsByClassName('summary')[0];
const answerInput = document.getElementsByClassName('answer-input');
const err = document.getElementsByClassName('err');

// Hover collection 

const collections = document.getElementsByClassName('collection-item');
for(let i=0; i<collections.length; i++){
    collections[i].addEventListener('mouseover', () =>{
        collections[i].querySelector('span').style.backgroundColor = "#a8b1ff"
    })
    collections[i].addEventListener('mouseout', () =>{
        collections[i].querySelector('span').style.backgroundColor = "inherit"
    })
}



for(let i = 0; i<answer.length; i++){
    answer[i].addEventListener('click', answerAction=>{
        for(let i = 0; i<answer.length; i++){
            answer[i].style.backgroundColor = 'inherit';
        }
        answer[i].style.backgroundColor = "rgb(159, 253, 115)";
    })
}
var elemCounter = 0;
for(let i =0; i<elem.length; i++){
    elem[i].style.display = "none"
}
elem[0].style.display = 'block';

for(let i = 0; i<nextButton.length; i++){
    nextButton[i].addEventListener('click', showElement=>{
        if(answerInput[i].value==''){
            console.log('Wypełnij pole!!!')
            err[i].style.display = "block";
        }
        else{
            if(elemCounter==elem.length-1){
                elem[elemCounter].style.display = 'none';
                console.log('wszystko')
                summary.style.display = 'flex';
            }
            else{
                elem[elemCounter].style.display = 'none';
                elemCounter++
                elem[elemCounter].style.display = 'block';
            }
        }
    })
}

