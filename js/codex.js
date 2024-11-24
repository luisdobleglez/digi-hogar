const boton =   document.getElementById('boton-menu')
 const menu =   document.querySelector('header nav')
 let cerrado = true;
function abreCierrraMenu(){
 if(cerrado === true){
    menu.style.right = '0';
    menu.style.backgroundColor = '#11111180';
    setTimeout(()=>{this.style.transform = 'rotate(180deg)'}, 300);    
    cerrado = false;
 }else{
    menu.style.right = 'calc(-100vw + 72px)';
    menu.style.backgroundColor = 'transparent';
    setTimeout(()=>{this.style.transform = 'rotate(0deg)'}, 300);    
    cerrado = true;
 }
}
boton.addEventListener('click', abreCierrraMenu)
if(document.getElementById('imagen-perfil')){
document.getElementById('imagen-perfil').addEventListener('click', function() {
        document.getElementById('imagen_perfil').click();
    });
   }
    if(document.querySelector('h1').innerText === 'Login' ||  document.querySelector('h1').innerText === 'Signup'){
      document.querySelector('header nav').remove();
    }

let labels = document.getElementsByClassName('detexto')

for(let label of labels){
 let m = label.previousElementSibling.innerHTML.length;
 label.style.paddingLeft = m * 8 + 'px' 
}




function quitaPonMensaje(mensaje,duracion,rueda){
let caja = document.createElement('div')
caja.setAttribute('id', 'mensaje');
caja.style.opacity = 1;
caja.innerHTML = '<p>' + mensaje + '</p>';
if(rueda === true){
   caja.innerHTML += '<img src="img/rueda.svg" id="rueda">'
}
document.body.appendChild(caja);
setTimeout(() => {
   caja.style.opacity = 0;

   setTimeout(() => {
      caja.remove()
   },500)

            }, duracion);

}

if(document.getElementById('mensaje')){
    document.getElementById('mensaje').addEventListener('click' ,function(){
        document.getElementById('mensaje').remove()
    })
}