// Obtener elementos del DOM
const modal = document.getElementById('myModal');
const yesBtn = document.getElementById('yesbtn');
const noBtn = document.getElementById('nobtn');
const registroForm = document.getElementById('registro-form');
const loginForm = document.getElementById('login-form');
const loginBtn = document.getElementById('login-btn');

// Mostrar el modal al cargar la página
window.onload = function () {
  modal.style.display = 'block';
};

// Evento al hacer clic en "Sí, estoy registrado"
yesBtn.addEventListener('click', function () {
  modal.style.display = 'none';
  loginForm.classList.remove('hidden');
  registroForm.classList.add('hidden');
});

// Evento al hacer clic en "No, quiero registrarme"
noBtn.addEventListener('click', function () {
  modal.style.display = 'none';
  registroForm.classList.remove('hidden');
  loginForm.classList.add('hidden');
  registroForm.addEventListener("submit",enviar_formulario_ajax);
});

// Evento al hacer clic en "Iniciar Sesión"
loginBtn.addEventListener('click', function () {
  modal.style.display = 'block';
  loginForm.classList.remove('hidden');
  registroForm.classList.add('hidden');
});

function enviar_formulario_ajax(e){
  e.preventDefault();

  let enviar=confirm("Quieres enviar el formulario");

  if(enviar==true){

      let data= new FormData(this);
      let method=this.getAttribute("method");
      let action=this.getAttribute("action");

      let encabezados= new Headers();

      let config={
          method: method,
          headers: encabezados,
          mode: 'cors',
          cache: 'no-cache',
          body: data
      };

      fetch(action,config)
      .then(respuesta => respuesta.text())
      .then(respuesta =>{ 
          let contenedor=document.querySelector(".form-rest");
          contenedor.innerHTML = respuesta;
      });
  }

}
