window.onload = function() {

  var userform = document.getElementById("userform");
  registrar.onclick = function() {
    // Verificar os critérios da senha
    var senha = document.getElementById("senha_clinica").value;

    const temNumero = /[0-9]/.test(senha);
    const temLetraMaiuscula = /[A-Z]/.test(senha);
    const temLetraMinuscula = /[a-z]/.test(senha);
    const temCaractereEspecial = /[!@#$%^&*()_+{}\[\]:;<>,.?~]/.test(senha);
  
    // Verificar se a senha atende a todos os critérios
    const senhaValida =
      temNumero &&
      temLetraMaiuscula &&
      temLetraMinuscula &&
      temCaractereEspecial &&
      senha.length >= 8; // A senha precisa ter pelo menos 8 caracteres
  
    if (!senhaValida) { 
      var alertaSenha = document.getElementById("alerta_senha");
      alertaSenha.innerHTML = "A senha não atende aos critérios:<br>" +
                              "- Deve conter pelo menos um número<br>" +
                              "- Deve conter pelo menos uma letra maiúscula<br>" +
                              "- Deve conter pelo menos uma letra minúscula<br>" +
                              "- Deve conter pelo menos um caractere especial<br>" +
                              "- Deve ter no mínimo 8 caracteres";                        
      return false; 
    }

    if(senhaValida){
      var alertaSenha = document.getElementById("alerta_senha");
      alertaSenha.innerHTML = " ";
      return true; 
    }
  } 
}