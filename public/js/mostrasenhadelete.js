document.addEventListener("DOMContentLoaded", function() {
    var senhaDeleteInput = document.getElementById("formsenha2");
    var mostrarSenhaButton2 = document.getElementById("mostrar_senha2");
    var senhaDeleteVisivel = false;

    mostrarSenhaButton2.addEventListener("click", function() {
        if (senhaDeleteVisivel) {
            senhaDeleteInput.type = "password";
            senhaDeleteVisivel = false;
        } else {
            senhaDeleteInput.type = "text";
            senhaDeleteVisivel = true;
        }
    });
});