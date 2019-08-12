const slider = new Swiper('.swiper-container', {
    // Optional parameters
    loop: false,

    // If we need pagination
    pagination: {
      el: '.swiper-pagination',
    },

    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },

    // And if we need scrollbar
    scrollbar: {
      el: '.swiper-scrollbar',
    },  
}); 

jQuery(document).ready(function(){
  var scenes = [];
  var scenesSelector = document.querySelectorAll('.scene');
  for(i=0; i<scenesSelector.length; i++){
    scenes[i] = new Parallax(scenesSelector[i]);
  }
  if(slider.slides.length == 1) {
    $('.swiper-wrapper').addClass( "disabled" );
    $('.swiper-pagination').addClass( "disabled" );

    $(document).on('scroll', function(e){
      e.preventDefault()
    })
  } 

  $('.scene-text').click(function(){
    const el = $('.fullpage').first().offset();
    window.scroll({
      top: el.top, 
      left: 0, 
      behavior: 'smooth'
    });
  });

  function scenesDisable(){
      for(i=0; i<scenes.length; i++){
          scenes[i].disable();
      }
  }

  function scenesEnable(){
      for(i=0; i<scenes.length; i++){
          scenes[i].enable();
      }
  }
})