<style>
    .fa-cc-visa {
        color: #1a1f71;
    }
    .fa-cc-mastercard {
        color: #ff5f00;
    }
    .fa-cc-amex {
        color: #2e77bb;
    }
</style>
<div class="container mt-5">
    <h1 class="mb-4">Forma de pago</h1>
    <form id="paymentForm" action="invoice.php" method="post">
        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input autocapitalize="words" autocomplete="off" name="nombre_tarjeta" type="text" class="form-control" id="nombre" placeholder="Nombre">
                    <label for="nombre">Nombre que aparece en la tarjeta</label>
                    <div id="nombreFeedback" class="invalid-feedback"></div>
                </div>
                <div class="form-floating mb-3 position-relative">
                    <input autocomplete="off" name="tarjeta" type="text" class="form-control" id="cardNumber" placeholder="No. de tarjeta">
                    <label for="cardNumber">No. de tarjeta</label>
                    <div id="cardFeedback" class="invalid-feedback"></div>
                    <i id="cardIcon" class="fa position-absolute top-50 end-0 translate-middle-y pe-3" style="font-size: 1.5em;"></i>
                </div>
                <div class="form-floating mb-3">
                    <input autocomplete="off" name="fecha_expiracion" type="text" class="form-control" id="fechaExpiracion" placeholder="MM/AA" maxlength="5">
                    <label for="fechaExpiracion">Fecha de expiración (MM/AA)</label>
                    <div id="fechaFeedback" class="invalid-feedback"></div>
                </div>
                <div class="form-floating mb-3">
                    <input autocomplete="off" name="cvv" type="password" class="form-control" id="cvv" placeholder="CVV" maxlength="4">
                    <label for="cvv">CVV</label>
                    <div id="cvvFeedback" class="invalid-feedback"></div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col d-flex justify-content-end align-items-center">
                <a href="productos.php" class="btn btn-warning me-2">Seguir comprando</a>
                <button name="invoice" type="submit" class="btn btn-success" value="Confirmar pago">Confirmar Pago</button>
            </div>
        </div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.24.0/axios.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('paymentForm');
        const nombreInput = document.getElementById('nombre');
        const cardNumberInput = document.getElementById('cardNumber');
        const fechaExpiracionInput = document.getElementById('fechaExpiracion');
        const cvvInput = document.getElementById('cvv');

        const nombreFeedback = document.getElementById('nombreFeedback');
        const cardFeedback = document.getElementById('cardFeedback');
        const fechaFeedback = document.getElementById('fechaFeedback');
        const cvvFeedback = document.getElementById('cvvFeedback');
        const cardIcon = document.getElementById('cardIcon');

        nombreInput.addEventListener('input', validateNombre);
        cardNumberInput.addEventListener('input', validateCardNumber);
        fechaExpiracionInput.addEventListener('input', validateFechaExpiracion);
        fechaExpiracionInput.addEventListener('keydown', formatFechaExpiracion);
        cvvInput.addEventListener('input', validateCVV);

        form.addEventListener('submit', function (event) {
            if (!validateNombre() || !validateCardNumber() || !validateFechaExpiracion() || !validateCVV()) {
                event.preventDefault();
                event.stopPropagation();
            }
        });

        function validateNombre() {
            const nombre = nombreInput.value.trim();
            if (nombre.length > 0) {
                nombreInput.classList.remove('is-invalid');
                nombreInput.classList.add('is-valid');
                nombreFeedback.textContent = '';
                return true;
            } else {
                nombreInput.classList.remove('is-valid');
                nombreInput.classList.add('is-invalid');
                nombreFeedback.textContent = 'El nombre es requerido';
                return false;
            }
        }

        async function validateCardNumber() {
            const cardNumber = cardNumberInput.value.replace(/\s+/g, '');
            if (cardNumber.length > 0) {
                const isValid = await validateCardNumberAPI(cardNumber);
                updateCardIcon(cardNumber);
                if (isValid) {
                    cardNumberInput.classList.remove('is-invalid');
                    cardNumberInput.classList.add('is-valid');
                    cardFeedback.textContent = '';
                    return true;
                } else {
                    cardNumberInput.classList.remove('is-valid');
                    cardNumberInput.classList.add('is-invalid');
                    cardFeedback.textContent = 'Número de tarjeta inválido';
                    return false;
                }
            } else {
                cardNumberInput.classList.remove('is-valid', 'is-invalid');
                cardFeedback.textContent = 'El número de tarjeta es requerido';
                updateCardIcon('');
                return false;
            }
        }

        async function validateCardNumberAPI(cardNumber) {
            try {
                const response = await axios.post('validate-card.php', { cardNumber });
                return response.data.valid;
            } catch (error) {
                console.error('Error validando el número de tarjeta:', error);
                return false;
            }
        }

        function validateFechaExpiracion() {
            const fecha = fechaExpiracionInput.value.trim();
            const regex = /^(0[1-9]|1[0-2])\/?([0-9]{2})$/;
            if (regex.test(fecha)) {
                fechaExpiracionInput.classList.remove('is-invalid');
                fechaExpiracionInput.classList.add('is-valid');
                fechaFeedback.textContent = '';
                return true;
            } else {
                fechaExpiracionInput.classList.remove('is-valid');
                fechaExpiracionInput.classList.add('is-invalid');
                fechaFeedback.textContent = 'Formato de fecha inválido. Use MM/AA';
                return false;
            }
        }

        function formatFechaExpiracion(event) {
            const input = fechaExpiracionInput.value;
            if (event.key >= '0' && event.key <= '9') {
                if (input.length === 2) {
                    fechaExpiracionInput.value = input + '/';
                }
            }
        }

        function validateCVV() {
            const cvv = cvvInput.value.trim();
            const regex = /^[0-9]{3,4}$/;
            if (regex.test(cvv)) {
                cvvInput.classList.remove('is-invalid');
                cvvInput.classList.add('is-valid');
                cvvFeedback.textContent = '';
                return true;
            } else {
                cvvInput.classList.remove('is-valid');
                cvvInput.classList.add('is-invalid');
                cvvFeedback.textContent = 'CVV inválido. Use 3 o 4 dígitos';
                return false;
            }
        }

        function updateCardIcon(cardNumber) {
            if (/^4/.test(cardNumber)) {
                cardIcon.className = 'fa-brands fa-cc-visa';
            } else if (/^5[1-5]/.test(cardNumber)) {
                cardIcon.className = 'fa-brands fa-cc-mastercard';
            } else if (/^3[47]/.test(cardNumber)) {
                cardIcon.className = 'fa-brands fa-cc-amex';
            } else {
                cardIcon.className = '';
            }
        }
    });
</script>
