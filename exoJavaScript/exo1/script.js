const carre = document.querySelector('.carre');
carre.addEventListener('click', function(){
    afficheStyle();
});

function afficheStyle(){
    const styles = window.getComputedStyle(carre);
    const backbroundColor = styles.getPropertyValue('background-color');
    const color = styles.getPropertyValue('color');
    const height = styles.getPropertyValue('height');
    const width = styles.getPropertyValue('width');
    const display = styles.getPropertyValue('display');
    const police = styles.getPropertyValue('font-family');
    const taille = styles.getPropertyValue('font-size');

    alert(`class : ${carre.className}
        - Background color : ${backbroundColor}
        - Color : ${color}
        - Height : ${height}
        - Width : ${width}
        - Display : ${display}
        - Display : ${police} (${taille})`);
}