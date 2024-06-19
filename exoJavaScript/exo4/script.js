const carres = document.querySelectorAll('.carre');


carres.forEach((carre) => {
    carre.addEventListener("click",() => {
        if (getComputedStyle(carre.querySelector('.titre')).visibility !== 'visible'){
            addStyle(carre);
        }
        else{
            deleteStyle(carre);
        }
     });
  });

  function addStyle(carre){
    const styleCarre = getComputedStyle(carre);
    document.querySelector('#wrapper').style.backgroundColor = styleCarre.backgroundColor;
    carre.style.borderRadius = "20%";
    const styleTexte = carre.querySelector('.titre');
    styleTexte.style.visibility = "visible";
    carre.style.boxShadow = "6px 0 6px 0px black inset";
  }

  function deleteStyle(carre){
    document.querySelector('#wrapper').style.backgroundColor = "gray";
    carre.style.borderRadius = "0";
    const styleTexte = carre.querySelector('.titre');
    styleTexte.style.visibility = "hidden";
    carre.style.boxShadow = "0 0 0 0";
  }