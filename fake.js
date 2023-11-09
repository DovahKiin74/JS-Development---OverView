const myDiv = document.querySelectorAll('.box');
const initialLeft = -400;
function handleScroll() {
    const topOfDocument = window.scrollY;
    const topOfDiv = myDiv.getBoundingClientRect().top;

    if (topOfDocument >= topOfDiv) {
        myDiv.style.left = '20%';
    } 
}
window.addEventListener('scroll', handleScroll);
const line = document.getElementById('line');
const stopPoints = [50, 150, 300];
function updateLineHeight() {
    const scrollY = window.scrollY;
    let height = 0;
    for (const stopPoint of stopPoints) {
        if (scrollY >= stopPoint) {
            height = stopPoint;
        }
    }

    line.style.height = `${height}px`;
}
window.addEventListener('scroll', updateLineHeight);
updateLineHeight();


window.addEventListener('load', submitGameInfo);