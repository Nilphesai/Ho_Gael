const carres = document.querySelectorAll('.carre');
let rouge = false;

carres.forEach((carre) => {
    carre.addEventListener("click",() => {
        if (rouge == false){
            carre.style.backgroundColor = "rgb(255, 0, 0)";
            carre.style.transitionDuration = "1s";
            carre.style.transform = "rotate(360deg)";
            carre.style.width = "180px";
	        carre.style.height = "180px";
            rouge = true;
        }else{
            carre.style.backgroundColor = "rgb(0, 128, 0)";
            carre.style.transitionDuration = "1s";
            carre.style.transform = "rotate(-360deg)";
            carre.style.width = "200px";
	        carre.style.height = "200px";
            rouge = false;
        }
      
     });
  });