/* --- button pre/next --- */
$(document).ready(function() {
	$(".prevImg, .nextImg").css("opacity", "0.3");

	$(".prevImg, .nextImg").hover(function() {
		$(this).css("opacity", "1");
	}, function() {
		$(this).css("opacity", "0.3");
	});
});

/* --- slide show image --- */
var slideIndex = 1;
showSlides(slideIndex);

function nextSlide(n) {
	slideIndex += n;
  	showSlides(slideIndex);
}

function currentSlide(n) {
	slideIndex = n;
  	showSlides(slideIndex);
}

function showSlides(n) {
	// array
	var slides = document.getElementsByClassName("image");
	var dots = document.getElementsByClassName("imageStep");
	var describes = document.getElementsByClassName("describe");
	if (n > slides.length)
		slideIndex = 1;
	if (n < 1)
		slideIndex = slides.length;
	for (var i = 0; i < slides.length; i++) {
		slides[i].style.display = "none";
		describes[i].style.display = "none";
	  	dots[i].style.backgroundColor = "#bbb";
	}
	slides[slideIndex-1].style.display = "block"; 
	describes[slideIndex-1].style.display = "block";
	dots[slideIndex-1].style.backgroundColor = "#555";
}