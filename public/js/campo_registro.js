window.onload = function() {
    document.getElementById("userform").addEventListener("submit", function(event) {
        var camposObrigatorios = document.querySelectorAll("[required]");

        for (var i = 0; i < camposObrigatorios.length; i++) {
            var campo = camposObrigatorios[i];
            if (campo.value.trim() === "") { // Verifica se o valor está vazio ou apenas espaços
                event.preventDefault();
                var mensagemErro = campo.parentNode.querySelector(".error-message");
                if (!mensagemErro) {
                    mensagemErro = document.createElement("div");
                    mensagemErro.classList.add("error-message");
                    campo.parentNode.appendChild(mensagemErro);
                }
                mensagemErro.innerHTML = "Campo obrigatório";
                mensagemErro.style.color = "red";
            }
        }
    });

    // Limpa as mensagens de erro ao clicar no botão
    var botaoEnviar = document.querySelector("button[type='submit']");
    botaoEnviar.addEventListener("click", function() {
        var mensagensErro = document.querySelectorAll(".error-message");
        for (var i = 0; i < mensagensErro.length; i++) {
            mensagensErro[i].innerHTML = "";
        }
    });
};