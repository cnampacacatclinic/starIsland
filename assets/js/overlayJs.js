let figure = document.getElementsByTagName('figure');
let y = figure.classList.contains("overlay");
y.addEventListener("mouseover", mouseOver);
y.addEventListener("mouseout", mouseOut);

for (var i = 0; i < y.length; i++) {
    y[i].addEventListener('click', mouseOver);
    y[i].addEventListener('click', mouseOut); 
}


function mouseOver() {
  y.style.color = "red";
}

function mouseOut() {
  y.style.color = "black";
}