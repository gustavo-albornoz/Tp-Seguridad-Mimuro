
//Validacion Login
function fvalidar(formulario)
	{
		var mail = document.getElementById('mail'); 
		var filtromail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/; //variable que indica valores permitidos para validar mail
        if (!filtromail.test(mail.value)) 
		{
            alert('Ingrese un Mail v\u00E1lido');
            document.formulario.mail.focus();
         	return false;
        }

        var pass = document.getElementById('pass');
        p1 = document.formulario.pass.value;
        if (p1.length < 6) {
  		alert("Contrase\u00F1a Incorrecta");
  		return false;
		}

	   document.formulario.submit();
	}

//Validacion Registro
function rvalidar(vregistro)
	{
		var nombre = document.getElementById('nombre');
		var filtro =/^([a-zA-Z])+[a-zA-Z]$/; 			// variable que indica los valores permitidos
		if(!filtro.test(nombre.value)) 
			{
				alert('Ingrese un Nombre v\u00E1lido');
				document.vregistro.nombre.focus();
			  return false;
			}

		var apellido = document.getElementById('apellido'); //valida que el apellido contenga solo letras
		if(!filtro.test(apellido.value))
			{
				alert('Ingrese un Apellido v\u00E1lido');
				document.vregistro.apellido.focus();
			  return false;	
			}
		
		var mail = document.getElementById('mail'); 
		var filtromail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/; //variable que indica valores permitidos para validar mail
        if (!filtromail.test(mail.value))
		{
            alert('Ingrese un Mail v\u00E1lido');
            document.vregistro.mail.focus();
         	return false;
        }

        var pass1 = document.getElementById('pass1');
        pa1 = document.vregistro.pass1.value;
        if (pa1.length < 6) 
        {
  			alert("La Contrase\u00F1a debe tener m\u00E1s de 6 caracteres");
  			return false;
		}

		var p1 = document.getElementById('pass1').value; //valida contraseñas iguales
		var p2 = document.getElementById('pass2').value;
        if(p1 != p2)
        { 
			alert("La Contrase\u00F1a debe coincidir");
  			return false;
		}

        alert("Muchas gracias por contactarnos"); 
	    document.vregistro.submit();
		
	}	
		


