//funcion letra uppercase / eliminar en los extremos los espacio - funcion con onchange(this.value)
function UpperTrim(id){
    $('#'+id).blur(function() {
        this.value = this.value.trim();
        this.value = this.value.toUpperCase();
    });
}

function soloLetras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "Ã¡Ã©Ã­Ã³ÃºabcdefghijklmnÃ±opqrstuvwxyz";
    especiales = [08, 7, 39, 46, 13, 32];
    tecla_especial = false
    for (var i in especiales) {
        if (key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }
    if (letras.indexOf(tecla) == -1 && !tecla_especial){
        return false;
    }
}

//Se utiliza para que el campo de texto solo acepte numeros
function SoloNumeros(evt){
     if(window.event){//asignamos el valor de la tecla a keynum
      keynum = evt.keyCode; //IE
     }
     else{
      keynum = evt.which; //FF
     } 
     //comprobamos si se encuentra en el rango numérico y que teclas no recibirá.
     if((keynum > 47 && keynum < 58) || keynum == 8 || keynum == 13 || keynum == 6){
      return true;
     }
     else{
      return false;
     }
}
