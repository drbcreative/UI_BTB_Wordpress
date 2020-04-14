

$(document).ready(function() {

  $(".instaslider").slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: false,
    infinite:true,
    dots: false,
    // appendDots:".sculpdots",
    nextArrow:
      '<span class="arrow next"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512.008 512.008" style="enable-background:new 0 0 512.008 512.008;" xml:space="preserve"><g><g><path d="M381.048,248.633L146.381,3.299c-3.021-3.146-7.646-4.167-11.688-2.521c-4.042,1.615-6.688,5.542-6.688,9.896v42.667    c0,2.729,1.042,5.354,2.917,7.333l185.063,195.333L130.923,451.341c-1.875,1.979-2.917,4.604-2.917,7.333v42.667    c0,4.354,2.646,8.281,6.688,9.896c1.292,0.521,2.646,0.771,3.979,0.771c2.854,0,5.646-1.146,7.708-3.292l234.667-245.333    C384.986,259.258,384.986,252.758,381.048,248.633z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg></span>',
    prevArrow:
      '<span class="arrow prev"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512.008 512.008" style="enable-background:new 0 0 512.008 512.008;" xml:space="preserve"><g><g><path d="M384.001,53.333V10.667c0-4.354-2.646-8.281-6.688-9.896C376.022,0.25,374.668,0,373.335,0    c-2.854,0-5.646,1.146-7.708,3.292L130.96,248.625c-3.937,4.125-3.937,10.625,0,14.75l234.667,245.333    c3.021,3.146,7.646,4.167,11.688,2.521c4.042-1.615,6.688-5.542,6.688-9.896v-42.667c0-2.729-1.042-5.354-2.917-7.333L196.022,256    L381.085,60.667C382.96,58.688,384.001,56.063,384.001,53.333z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg></span>'
  });

  $(".b-a-slider").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    infinite:true,
    dots: false,
    // appendDots:".sculpdots",
    nextArrow:
      '<span class="arrow next"><svg xmlns="http://www.w3.org/2000/svg" width="65.101" height="46.39" viewBox="0 0 65.101 46.39"><g id="Group_152" data-name="Group 152" transform="translate(1344.794 8804.39) rotate(180)"><g id="Path_65" data-name="Path 65" transform="translate(1298.404 8781.195) rotate(-45)" fill="none"><path d="M0,0H32.8V32.8H0Z" stroke="none"/><path d="M 0.9999980926513672 0.9999980926513672 L 0.9999980926513672 31.80273628234863 L 31.80273628234863 31.80273628234863 L 31.80273628234863 0.9999980926513672 L 23.18942642211914 0.9999980926513672 L 0.9999980926513672 0.9999980926513672 M -3.814697265625e-06 -3.814697265625e-06 L 23.18942642211914 -3.814697265625e-06 L 32.80273818969727 -3.814697265625e-06 L 32.80273818969727 32.80273818969727 L -3.814697265625e-06 32.80273818969727 L -3.814697265625e-06 -3.814697265625e-06 Z" stroke="none" fill="#fff"/></g><g id="Group_117" data-name="Group 117" transform="translate(688.062 9463.508) rotate(-90)"><g id="Group_8" data-name="Group 8" transform="translate(-37 108)"><path id="Path_42" data-name="Path 42" d="M353.354,454.825l-6.114-6.764v13.508Z" transform="translate(1174.568 178.523) rotate(90)" fill="#fff" stroke="#fff" stroke-width="1"/><path id="Path_43" data-name="Path 43" d="M722.728,508.246H686.639" transform="translate(1227.746 -203.008) rotate(90)" fill="none" stroke="#fff" stroke-width="1"/></g></g></g></svg></span>',
    prevArrow:
    '<span class="arrow prev"><svg xmlns="http://www.w3.org/2000/svg" width="65.101" height="46.39" viewBox="0 0 65.101 46.39"><g id="Group_152" data-name="Group 152" transform="translate(1344.794 8804.39) rotate(180)"><g id="Path_65" data-name="Path 65" transform="translate(1298.404 8781.195) rotate(-45)" fill="none"><path d="M0,0H32.8V32.8H0Z" stroke="none"/><path d="M 0.9999980926513672 0.9999980926513672 L 0.9999980926513672 31.80273628234863 L 31.80273628234863 31.80273628234863 L 31.80273628234863 0.9999980926513672 L 23.18942642211914 0.9999980926513672 L 0.9999980926513672 0.9999980926513672 M -3.814697265625e-06 -3.814697265625e-06 L 23.18942642211914 -3.814697265625e-06 L 32.80273818969727 -3.814697265625e-06 L 32.80273818969727 32.80273818969727 L -3.814697265625e-06 32.80273818969727 L -3.814697265625e-06 -3.814697265625e-06 Z" stroke="none" fill="#fff"/></g><g id="Group_117" data-name="Group 117" transform="translate(688.062 9463.508) rotate(-90)"><g id="Group_8" data-name="Group 8" transform="translate(-37 108)"><path id="Path_42" data-name="Path 42" d="M353.354,454.825l-6.114-6.764v13.508Z" transform="translate(1174.568 178.523) rotate(90)" fill="#fff" stroke="#fff" stroke-width="1"/><path id="Path_43" data-name="Path 43" d="M722.728,508.246H686.639" transform="translate(1227.746 -203.008) rotate(90)" fill="none" stroke="#fff" stroke-width="1"/></g></g></g></svg></span>',
  });

});




function aniMate(n) {
  var t = document.querySelectorAll(n);

  window.addEventListener("DOMContentLoaded", function() {
    t.forEach(function(n) {
      n.getBoundingClientRect().top < window.innerHeight / 1.3 &&
        n.classList.add("animate");
    });
  }),
    window.addEventListener("scroll", function() {
      t.forEach(function(n) {
        n.getBoundingClientRect().top < window.innerHeight / 1.3 &&
          n.classList.add("animate");
      });
    });
}

aniMate(
  ".rotateright , .rotateleft ,.fade-nun , .fade-up-stop , .fade-right-stop,.fade-left-stop"
),
aniMate(".fade-in"),
aniMate(".fade-in-left"),
aniMate(".fade-in-right"),
aniMate(".scale-down");

// Scroll to top
$(document).ready(function() {
  $(window).scroll(function() {
    if ($(this).scrollTop() > 100) {
      $("#scroll").fadeIn();
    } else {
      $("#scroll").fadeOut();
    }
  });
  $("#scroll").click(function() {
    $("html, body").animate({ scrollTop: 0 }, 600);
    return false;
  });
});


$(document).ready(function () {
  let menuopen = false;
  $(".bars").click(function(e){
    if(menuopen == false){
      $('.hasdropdown').removeClass('activeitem');

      $(this).addClass('activeitem');
      $(".navbaritems").addClass('activemenu');
      menuopen = true;
    } else {
      $('.hasdropdown').addClass('activeitem');

      $(this).removeClass('activeitem');
      $(".navbaritems").removeClass('activemenu');
      menuopen = false;
    }
  });



  if ($(window).width() < 992) {
    $("li.menu-item.hasdropdown > a").click(function(e){
      e.preventDefault();
    });
 }


});
