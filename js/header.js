window.addEventListener("scroll", function(){
    let header = document.querySelector('#header')
    header.classList.toggle('rolagem', window.scrollY > 200)
})

function actionToggle(){
    var action = document.querySelector('.action');
    action.classList.toggle('active')
}