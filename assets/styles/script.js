$(document).scroll(function(){
  var isScrolled = $(this).scrollTop() > $(".topBar").height();
  $(".topBar").toggleClass("scrolled",isScrolled);
} )

function volumeToggle(button) {
    var previewVideo = $(button).closest('.previewContainer').find('.previewVideo')[0];
    var muted = $(previewVideo).prop('muted');
    $(previewVideo).prop('muted', !muted);
  
    $(button).find('i').toggleClass('fa-volume-mute');
    $(button).find('i').toggleClass('fa-volume-up');
  }
  
  function previewEnded() {
    var previewVideo = $(this).closest('.previewContainer').find('.previewVideo')[0];
    var previewImage = $(this).closest('.previewContainer').find('.previewImage')[0];
  
    $(".previewVideo").toggle();
    $(".previewImage").toggle();
  }
  