var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
    showDivs(slideIndex += n);
}

function showDivs(n) {
    var i;
    var first = document.getElementsByClassName("testimonial");
    if (n > first.length) {slideIndex = 1}
    if (n < 1) {slideIndex = first.length} ;
    for (i = 0; i < first.length; i++) {
        first[i].style.display = "none";
    }
    first[slideIndex-1].style.display = "block";

}
