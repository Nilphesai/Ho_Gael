const carres = document.querySelectorAll('.carre');
let rouge = false;

carres.forEach((carre) => {
    carre.addEventListener("click",() => {
        if (carre.querySelector('.titre').style.visibility == "hidden"){

            alert("ça marche");
            //carre.classList.toggle('active');
        }
        
      
     });
  });