function bloqueaNumeros(input) {
    const permitidos = 'abcdefghijklmnñopqrstuvwxyzáéíóúüÁÉÍÓÚABCDEFGHIJKLMNÑOPQRSTUVWXYZ ,';

    input.addEventListener('keypress', (event) => {
        const charCode = event.charCode;
        const key = String.fromCharCode(charCode);

        if (permitidos.indexOf(key) === -1) {
            event.preventDefault();
        }
    });
}
function bloqueaLetrascaracteres(input) {
    input.addEventListener('keypress', (event) => {
        const charCode = event.charCode;
        if (charCode >= 48 && charCode <= 57) {
            return;
        }

        const key = String.fromCharCode(charCode);
        if (key.match(/[a-zA-Z áéíóúñÑü]/)) {
            event.preventDefault();
        }
    });
}