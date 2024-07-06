//hide navbar on scroll down
var lastScrollTop;
navbar = document.getElementsByClassName('header');
window.addEventListener('scroll',function(){
  var scrollTop = window.pageYOffset;
  if(scrollTop < lastScrollTop){
    navbar[0].style.visibility = "visible";
    navbar[0].style.opacity = "100%";
  }
  else{
    navbar[0].style.visibility = "hidden";
    navbar[0].style.opacity = "1%";
  }
  lastScrollTop = scrollTop;
});
