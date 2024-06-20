const euro = document.getElementById("euro");

euro.addEventListener("keyup",() => {
    const valeur = euro.value;
    const change = valeur * 6.55957;
    francs = document.getElementById("francs");
    francs.innerHTML = change.toFixed(2)+ " francs";
 });