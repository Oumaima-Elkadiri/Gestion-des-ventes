function annimation() {
      const button = document.querySelector(".animatebutton");
      const element = $(button);
      element.addClass('animated shake');
      setTimeout(function() {
          element.removeClass('shake');
      }, 1000);
      window.location.href = "ajouter.php";
}

function getPrix(){
  const add = document.getElementById('add');
  const input = document.getElementById('prix');
  const value = input.value.trim();
  const isValid = /^\d*\.?\d*$/.test(value)  && (input.value.split('.').length - 1) <= 1;
    
  input.style.border = isValid ? "" : "2px solid rgb(207, 0, 0)";
  add.disabled = !isValid;
}

function deconnexion(){
  window.location.href = "disconnect.php";
}
                      
function deleteBtn(ref, image){
  
   window.location.href = "supprimer.php?ref="+ref+"&image="+image;
}  

