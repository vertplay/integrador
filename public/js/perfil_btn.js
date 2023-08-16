document.addEventListener("DOMContentLoaded", function() {
    var alterarDadosBtn = document.getElementById("editperf_btn");
    var formulario = document.getElementById("update-form");
    var cancelaBtn = document.getElementById("cancelarUpdate_btn");
    var perfil = document.getElementById("perfil-pag");

    alterarDadosBtn.addEventListener("click", function() {
        perfil.style.display = "none";
        formulario.style.display="block";
    });
    cancelaBtn.addEventListener("click", function() {
        formulario.style.display = "none";
        perfil.style.display="block";
        scrollTo(0,0);
    });
});