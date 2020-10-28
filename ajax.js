
function buscarIncidente() {
    console.log("test");
    $.post("consulta.php", {
        Lugar: $("#Nombre").val()}).done(function (data) {
        $("#Zombie").html(data);
    });
}
