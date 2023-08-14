document.addEventListener("DOMContentLoaded", function() {
    var senhaInput = document.getElementById("formsenha");
    var mostrarSenhaButton = document.getElementById("mostrar_senha");
    var senhaVisivel = false;

    mostrarSenhaButton.addEventListener("click", function() {
        if (senhaVisivel) {
            senhaInput.type = "password";
            senhaVisivel = false;
        } else {
            senhaInput.type = "text";
            senhaVisivel = true;
        }
    });
});