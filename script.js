
function toggleMenu(){document.querySelector('nav').classList.toggle('open')}
document.addEventListener('click',e=>{
  if(e.target.matches('nav a')) document.querySelector('nav').classList.remove('open');
});
