document.querySelector(".user-wrapper ul li").addEventListener("click", function(){
    this.classList.toggle("active");
  });

var modalBtn = document.querySelector('.logout');
var modal = document.querySelector('.modal');
var modalClose = document.querySelector('.close');
var modalCloseBtn = document.querySelector('.btn-cancel');

modalBtn.addEventListener('click',function(){
  modal.classList.add('modal-active');
});
modalClose.addEventListener('click',function(){
  modal.classList.remove('modal-active');
});
modalCloseBtn.addEventListener('click',function(){
  modal.classList.remove('modal-active');
});