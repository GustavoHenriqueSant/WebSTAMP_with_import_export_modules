// Mostrar, remover progresso de importa��o:
function import_loading() {
    document.getElementById("import_loading").style.display = 'block';
}


function iniciaAjax() {
    var req;

    try { req = new ActiveXObject("Microsoft.XMLHTTP"); }
    catch (e) {
        try { req = new ActiveXObject("Msxml2.XMLHTTP"); }
        catch (ex) {
            try { req = new XMLHttpRequest(); }
            catch (exc) {
                alert("Esse browser n�o tem recursos para uso do Ajax!");
                req = null;
            }
        }
    }
    return req;
}


// Realizar submit automático ao enviar arquivo de upload para a importação de análise:
var fileUpload = document.getElementById("import");
var enviar_button = document.getElementById("enviar_file_import");
fileUpload.addEventListener("change", function (event) {
    if(fileUpload.files.length == 0){
        alert("Nenhum Arquivo Selecionado");
        return;
    }

    enviar_button.click();
});

function exportar_project(value, id_project){
    var input_option = document.getElementById("option_export-" + id_project);
    var export_button = document.getElementById("export_button-" + id_project);
    
    input_option.value = value;
    export_button.click();
}

function set_div_timeout(Element){
    var div = document.getElementById(Element);
    setTimeout(function() {
        $('msg_validation_import').fadeOut('fast');
    }, 2000);
}

