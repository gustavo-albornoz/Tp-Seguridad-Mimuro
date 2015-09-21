function limita(obj,elEvento, maximo)
{
  var elem = obj;

  var evento = elEvento || window.event; // se obtiene objeto event
  var cod = evento.charCode || evento.keyCode; // propiedades diferentes de todos los eventos del teclado: onkeydown( evento que corresponde al hecho de pulsar una tecla y no soltarla)
                                                                                                          //onkeyup(evento que hace referencia al hecho de soltar una tecla que estaba pulsada)

    // cod 37 izquierda
	// cod 38 arriba
	// cod 39 derecha
	// cod 40 abajo
	// cod 8  backspace
	// cod 46 suprimir

  if(cod == 37 || cod == 38 || cod == 39
  || cod == 40 || cod == 8 || cod == 46)
  {
	return true;
  }

  if(elem.value.length < maximo )
  {
    return true;
  }

  return false;
}

function cuenta(obj,evento,maximo,conta)
{
	var elem = obj.value;
	var info = document.getElementById(conta);

	info.innerHTML = maximo-elem.length;
}