window.onload = function() {
  var userform = document.getElementById("userform");
  userform.onsubmit = function() {
    
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
      alert("senha inválida");
      return false; 
    }

    return true; 
  } 
}