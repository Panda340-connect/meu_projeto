document.addEventListener('DOMContentLoaded', function () {
    // Controle de tamanho da fonte (A+ / A-)
    var rootEl = document.documentElement;
    var minFontSize = 14;
    var maxFontSize = 22;
    var stepFontSize = 2;

    var savedFontSize = parseInt(localStorage.getItem('bv_font_size'), 10);
    if (!isNaN(savedFontSize) && savedFontSize >= minFontSize && savedFontSize <= maxFontSize) {
        rootEl.style.fontSize = savedFontSize + 'px';
    }

    function getCurrentFontSize() {
        var computed = window.getComputedStyle(rootEl).fontSize;
        var parsed = parseFloat(computed);
        return isNaN(parsed) ? 16 : parsed;
    }

    var btnIncrease = document.getElementById('btn-fonte-mais');
    var btnDecrease = document.getElementById('btn-fonte-menos');

    if (btnIncrease) {
        btnIncrease.addEventListener('click', function () {
            var nextSize = Math.min(maxFontSize, getCurrentFontSize() + stepFontSize);
            rootEl.style.fontSize = nextSize + 'px';
            localStorage.setItem('bv_font_size', String(nextSize));
        });
    }

    if (btnDecrease) {
        btnDecrease.addEventListener('click', function () {
            var nextSize = Math.max(minFontSize, getCurrentFontSize() - stepFontSize);
            rootEl.style.fontSize = nextSize + 'px';
            localStorage.setItem('bv_font_size', String(nextSize));
        });
    }

    // Validação existente de formulário com data-validate
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

    // Máscara para horário (HH:MM) em inputs com name="horario" ou data-mask="time"
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

    // Máscara para telefone (se existir campo name="telefone" ou data-mask="phone")
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
