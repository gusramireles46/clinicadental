document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('productForm');

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    function validateField(input, condition) {
        if (condition) {
            input.classList.remove('is-invalid');
            input.classList.add('is-valid');
            input.setAttribute('data-bs-original-title', '');
            bootstrap.Tooltip.getInstance(input).hide();
        } else {
            input.classList.remove('is-valid');
            input.classList.add('is-invalid');
            bootstrap.Tooltip.getInstance(input).show();
        }
    }

    var productoInput = document.getElementById('producto');
    var precioInput = document.getElementById('precio');
    var imagenInput = document.getElementById('imagen');

    productoInput.addEventListener('input', function() {
        validateField(productoInput, productoInput.value.trim());
    });

    precioInput.addEventListener('input', function() {
        validateField(precioInput, precioInput.value && precioInput.value >= 0);
    });

    imagenInput.addEventListener('change', function() {
        validateField(imagenInput, imagenInput.files.length === 0 || /image\/(jpeg|png)/.test(imagenInput.files[0].type));
    });

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        event.stopPropagation();

        var isValid = true;

        validateField(productoInput, productoInput.value.trim());
        validateField(precioInput, precioInput.value && precioInput.value >= 0);
        validateField(imagenInput, imagenInput.files.length === 0 || /image\/(jpeg|png)/.test(imagenInput.files[0].type));

        isValid = !form.querySelectorAll('.is-invalid').length;

        if (isValid) {
            form.submit();
        }
    }, false);
});