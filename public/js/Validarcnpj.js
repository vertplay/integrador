window.onload = function() {
// Função para validar CNPJ
function validarCNPJ(cnpj) {
   // Remover caracteres não numéricos
   cnpj = cnpj.replace(/\D/g, '');

   // Verificar se o CNPJ tem 14 dígitos
   if (cnpj.length !== 14) {
       return false;
   }

   // Verificar se todos os dígitos são iguais (caso contrário, é considerado inválido)
   if (/^(\d)\1+$/.test(cnpj)) {
       return false;
   }

   // Calcular os dígitos verificadores
   const tamanho = cnpj.length - 2;
   const numeros = cnpj.substring(0, tamanho);
   const digitos = cnpj.substring(tamanho);
   let soma = 0;
   let pos = tamanho - 7;

   for (let i = tamanho; i >= 1; i--) {
       soma += parseInt(numeros.charAt(tamanho - i), 10) * pos--;
       if (pos < 2) {
           pos = 9;
       }
   }

   const resultado = soma % 11 < 2 ? 0 : 11 - (soma % 11);

   // Verificar primeiro dígito verificador
   if (resultado !== parseInt(digitos.charAt(0), 10)) {
       return false;
   }

   tamanho++;
   soma = 0;
   pos = tamanho - 7;

   for (let i = tamanho; i >= 1; i--) {
       soma += parseInt(numeros.charAt(tamanho - i), 10) * pos--;
       if (pos < 2) {
           pos = 9;
       }
   }

   const segundoDigito = soma % 11 < 2 ? 0 : 11 - (soma % 11);

   // Verificar segundo dígito verificador
   return segundoDigito === parseInt(digitos.charAt(1), 10);
}

// Função para mostrar mensagem de erro para o CNPJ
function mostrarErroCNPJ(message) {
    const alertacnpj = document.getElementById('alerta_cnpj');
    alertacnpj.innerHTML = message ;
    alertacnpj.style.color = 'red';   

}
    
    var userform = document.getElementById("userform");
    userform.onsubmit = function() {
        const cnpjInput = document.getElementById('cnpj');

        if (!validarCNPJ(cnpjInput.value)) {  
            mostrarErroCNPJ('CNPJ inválido'); 
            scrollTo(0,0);
            event.preventDefault();
        } else {
            mostrarErroCNPJ('');
        }
    } 
  }