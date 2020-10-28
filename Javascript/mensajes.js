$(document).ready(function(){
    
    
   
    mensaje = document.getElementById("mensaje");

    if(mensaje != null)
    {
        setTimeout(borrar, 2000);
        console.log(mensaje);
    }

    


    function borrar()
    {
        mensaje.parentNode.removeChild(mensaje);
    }
    
});