// Validación de formularios
document.addEventListener("DOMContentLoaded", function () {
  const forms = document.querySelectorAll("form");

  forms.forEach(form => {
    form.addEventListener("submit", function (event) {
      let valid = true;
      const emailField = form.querySelector("input[type='email']");
      const subjectField = form.querySelector("input[name='subject']");
      const messageField = form.querySelector("textarea");

      // Validar email
      if (emailField && !validateEmail(emailField.value)) {
        alert("Por favor ingrese un correo válido.");
        valid = false;
      }

      // Validar asunto
      if (subjectField && subjectField.value.trim() === "") {
        alert("El asunto es obligatorio.");
        valid = false;
      }

      // Validar mensaje
      if (messageField && messageField.value.trim() === "") {
        alert("El mensaje no puede estar vacío.");
        valid = false;
      }

      if (!valid) {
        event.preventDefault(); // Evita envío si hay errores
      }
    });
  });
});

// Función para validar correos
function validateEmail(email) {
  const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return re.test(email.toLowerCase());
}

// Carrusel automático
const carouselElement = document.querySelector('#carouselMarcas');
if (carouselElement) {
  const carousel = new bootstrap.Carousel(carouselElement, {
    interval: 3000, // cambia cada 3 segundos
    ride: 'carousel'
  });
}
