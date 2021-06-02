// Dropdown for user 
document.querySelector(".user-wrapper ul li").addEventListener("click", function(){
    this.classList.toggle("active");
  });

// Get the modal
var modal = document.getElementsByClassName('modal');

// Get the button that opens the modal
var btn = document.getElementsByClassName("modalBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close");

var cancel = document.getElementsByClassName("btn-cancel");

// When the user clicks the button, open the modal 
btn[0].onclick = function() {
    modal[0].style.display = "block";
}

btn[1].onclick = function() {
  modal[1].style.display = "block";
}
// When the user clicks on <span> (x), close the modal
span[0].onclick = function() {
    modal[0].style.display = "none";
}

span[1].onclick = function() {
    modal[1].style.display = "none";
}

cancel[0].onclick = function() {
  modal[0].style.display = "none";
}

cancel[1].onclick = function() {
  modal[1].style.display = "none";
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}