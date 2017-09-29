document.addEventListener('DOMContentLoaded', function() {

  var button = document.getElementById('icone'),
      menuContent = document.getElementById('barra'),
      linkFecha = document.getElementById('primeiro'),
      linkFecha2 = document.getElementById('segundo'),
      linkFecha3 = document.getElementById('terceiro'),
      linkFecha4 = document.getElementById('quarto'),
      isOpen = false;

  button.addEventListener('click', toggleMenu);
  linkFecha.addEventListener('click', toggleMenu);
  linkFecha2.addEventListener('click', toggleMenu);
  linkFecha3.addEventListener('click', toggleMenu);
  linkFecha4.addEventListener('click', toggleMenu);


  	function toggleMenu() {
    if (window.innerWidth < 768) {
    if(isOpen){
      menuContent.className = 'some';
      button.className = 'menu-anchor';
      linkFecha = 'menu-anchor';
      linkFecha2 = 'menu-anchor';
      linkFecha3 = 'menu-anchor';
      linkFecha4 = 'menu-anchor';
      isOpen = false;
    } else {
      menuContent.className = 'menu-active';
    //   button.className = 'icone-active';
      isOpen = true;
    }
  } else{}
  }
});
