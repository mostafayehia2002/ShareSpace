// let comments=document.querySelector('.comments');
document.addEventListener('click',function(e){
if(e.target.classList.contains('comment-button')){

    let postContainer = e.target.closest('.reactions').parentElement;
        let commentsSection = postContainer.querySelector('.comments');
        commentsSection.classList.toggle('d-hidden')
        console.log(commentsSection)

}

if(e.target.classList.contains('reply-button')){
    let replies = e.target.nextElementSibling;
    replies.classList.toggle('d-hidden')
        console.log(replies)

}
});

