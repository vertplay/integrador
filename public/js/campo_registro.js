window.onload = function() {
    document.getElementById("userform").addEventListener("submit", function(event) {
        var camposObrigatorios = document.querySelectorAll("[required]");

        for (var i = 0; i < camposObrigatorios.length; i++) {
            var campo = camposObrigatorios[i];
            if (campo.value === "") {
                event.preventDefault();
                var mensagemErro = document.createElement("div");
                mensagemErro.textContent = "Campo obrigatório";
                mensagemErro.classList.add("error-message");
                mensagemErro.style.color = "red";
                campo.parentNode.appendChild(mensagemErro);
            }
        }
    });

    // Limpar mensagens de erro ao clicar no botão de enviar
    var botaoEnviar = document.querySelector("button[type='submit']");
    botaoEnviar.addEventListener("click", function() {
        var mensagensErro = document.querySelectorAll(".error-message");
        
        for (var i = 0; i < mensagensErro.length; i++) {
            mensagensErro[i].textContent = "";
        }
    });
};