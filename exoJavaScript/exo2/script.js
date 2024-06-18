
const carres = document.querySelectorAll('.carre');
const copy = document.getElementById('copy');

carres.forEach((carre) => {
  carre.addEventListener("click",() => {
    const newColor = getComputedStyle(carre).backgroundColor;
    copy.style.backgroundColor = newColor;
    copy.innerHTML = newColor;
   });
});

//version avec une fonction
/*
carres.forEach((carre) =>{
  carre.addEvenListener("click", () => {
    setStyle(carre);
  });
});

function setStyle(carre){
  const newColor = getComputedStyle(carre).backgroundColor;
  copy.style.backgroundColor = newColor;
  copy.innerHTML = newColor;
}
*/