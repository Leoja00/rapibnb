// validacion.js

document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
  
    form.addEventListener('submit', function (event) {
      event.preventDefault();

      const correo = document.querySelector('[name="correo"]').value;
      const contrasenia = document.querySelector('[name="contrasenia"]').value;

      const correoRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  
      if (!correoRegex.test(correo)) {
        mostrarAlerta('error', 'Formato de correo incorrecto', 'Por favor, ingresa un correo electrónico válido.');
        return;
      }

      form.submit();
    });
  
    function mostrarAlerta(icon, title, text) {
      Swal.fire({
        icon: icon,
        title: title,
        text: text,
      });
    }
  });
  