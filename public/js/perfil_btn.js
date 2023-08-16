document.addEventListener("DOMContentLoaded", function() {
    var alterarDadosBtn = document.getElementById("editperf_btn");
    var formulario = document.getElementById("update-form");
    var cancelaBtn = document.getElementById("cancelarUpdate_btn");
    var perfil = document.getElementById("perfil-pag");
    var delete_form = document.getElementById('delete-form');
    var cancelaDeleteBtn = document.getElementById('cancelardelete_btn');
    var deleteperf_btn = document.getElementById('deleteperf_btn');
    var formulario_altera_senha = document.getElementById('form-alterasenha');
    

    alterarDadosBtn.addEventListener("click", function() {
        perfil.style.display = "none";
        delete_form.style.display = "none";
        formulario.style.display="block";
    });
    cancelaBtn.addEventListener("click", function() {
        formulario.style.display = "none";
        delete_form.style.display = "none";
        perfil.style.display="block";
        scrollTo(0,0);
    });
    cancelaDeleteBtn.addEventListener("click", function() {
        formulario.style.display = "none";
        delete_form.style.display = "none";
        perfil.style.display="block";
        scrollTo(0,0);
    });
    deleteperf_btn.addEventListener("click", function() {
        formulario.style.display = "none";
        perfil.style.display="none";
        delete_form.style.display = "block";
    });

    formulario_altera_senha.onsubmit = function(){
        return confirm('Você receberá um e-mail contendo o link para alteração da senha.');
    }
    /*formulario_altera_senha.addEventListener("submit", function() {
        return confirm('Você receberá um e-mail contendo o link para alteração da senha.');
    });*/
});