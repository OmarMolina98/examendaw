
function buscarIncidente() {
    console.log("holas");
    //$.post manda la petición asíncrona por el método post. También existe $.get
    $.post("controladorConsulta.php", {
        Lugar: $("#Lugares").val()}).done(function (data) {
        $("#resultadoIncidentes").html(data);
    });
}


//Si nuestro elemento existe entonces deberíamos 
//Campo de texto #Programa
//buscarP funcion de ajax

