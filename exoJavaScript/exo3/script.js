const carres = document.querySelectorAll('.carre');
let rouge = false;

carres.forEach((carre) => {
    carre.addEventListener("click",() => {
        carre.classList.toggle('active');//add ou delete la class active qui est dans le CSS
      
     });
  });