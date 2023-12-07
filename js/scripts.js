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
});

// Evento al hacer clic en "Iniciar Sesión"
loginBtn.addEventListener('click', function () {
  modal.style.display = 'block';
  loginForm.classList.remove('hidden');
  registroForm.classList.add('hidden');
});
