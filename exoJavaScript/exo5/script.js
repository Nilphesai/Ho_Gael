
document.getElementById("euro").stepUp();
const euro = document.getElementById("#euro");

document.getElementById("#euro").value = 0;

euro.addEventListener("keydown",() => {
    console.log(euro.value);
    let francs = document.getElementById("#francs");
    francs.innerHTML = "résultat"+euro;
 });