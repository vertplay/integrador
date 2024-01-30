// Função para validar CNPJ
function validarCNPJ(cnpj) {
    // Implementação da validação de CNPJ aqui
    // ...

    // Retorne true se o CNPJ for válido, false caso contrário
    return true;
}

// Função para mostrar mensagem de erro para o CNPJ
function mostrarErroCNPJ(message) {
    const alertaCnpj = document.getElementById('alerta_cnpj');
    alertaCnpj.innerHTML = message;
    alertaCnpj.style.color = 'red';
}


// Restante do seu código JavaScript aqui...


window.onload = function() {
    var userform = document.getElementById("userform");
    userform.onsubmit = function() {
        const cnpjInput = document.getElementById('cnpj');

        if (!validarCNPJ(cnpjInput.value)) {
            mostrarErroCNPJ('CNPJ inválido');
            event.preventDefault();
        } else {
            mostrarErroCNPJ('');
        }
    } 
  }