function validarContraseña() {
    var contraseña = document.getElementById('contraseña').value;
    var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
    if (!regex.test(contraseña)) {
        alert("La contraseña debe tener al menos 8 caracteres, una letra mayúscula, una letra minúscula y un número.");
        return false;
    }
    return true;
}