document.addEventListener('DOMContentLoaded', function () {
    var form = document.querySelector('form[data-validate]');
    if (form) {
        form.addEventListener('submit', function (ev) {
            var email = form.querySelector('[name="email"]');
            if (email && email.value.indexOf('@') === -1) {
                ev.preventDefault();
                alert('Informe um e-mail válido.');
                email.focus();
            }
        });
    }

    document.querySelectorAll('[name="horario"], [data-mask="time"]').forEach(function (input) {
        if (input.type === 'text') {
            input.addEventListener('input', function () {
                var v = input.value.replace(/\D/g, '').slice(0, 4);
                if (v.length >= 3) {
                    input.value = v.slice(0, 2) + ':' + v.slice(2);
                } else {
                    input.value = v;
                }
            });
        }
    });

    
    document.querySelectorAll('[name="telefone"], [data-mask="phone"]').forEach(function (input) {
        input.addEventListener('input', function () {
            var v = input.value.replace(/\D/g, '').slice(0, 11);
            if (v.length > 10) {
                input.value = '(' + v.slice(0, 2) + ') ' + v.slice(2, 7) + '-' + v.slice(7);
            } else if (v.length > 6) {
                input.value = '(' + v.slice(0, 2) + ') ' + v.slice(2, 6) + '-' + v.slice(6);
            } else if (v.length > 2) {
                input.value = '(' + v.slice(0, 2) + ') ' + v.slice(2);
            } else {
                input.value = v;
            }
        });
    });
});
