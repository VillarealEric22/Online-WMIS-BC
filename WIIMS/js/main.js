// Dropdown for user 
document.querySelector(".user-wrapper ul li").addEventListener("click", function(){
    this.classList.toggle("active");
});

// Get the button that opens the modal
var btn = document.getElementsByClassName("modalBtn");
// All page modals
var modals = document.querySelectorAll('.modal');
// Get the element that closes the modal
var span = document.getElementsByClassName("close");
var cancel = document.getElementsByClassName("btn-cancel");

// When the user clicks the button, open the modal 
for (var i = 0; i < btn.length; i++) {
    btn[i].onclick = function(e) {
       e.preventDefault();
       modal = document.querySelector(e.target.getAttribute("href"));
       modal.style.display = "block";
    }
}
// When the user clicks on x, close the modal
for (var i = 0; i < span.length; i++) {
    span[i].onclick = function() {
       for (var index in modals) {
        if (typeof modals[index].style !== 'undefined') modals[index].style.display = "none";    
       }
    }
}
// When the user clicks on cancel, close the modal
for (var i = 0; i < cancel.length; i++) {
    cancel[i].onclick = function() {
       for (var index in modals) {
        if (typeof modals[index].style !== 'undefined') modals[index].style.display = "none";    
       }
    }
}
if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
  }