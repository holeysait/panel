window.toggleMenu = function(){
  var m = document.getElementById('top-menu');
  if(!m) return;
  if(m.classList.contains('open')) m.classList.remove('open'); else m.classList.add('open');
};