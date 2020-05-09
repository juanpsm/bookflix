function validarRegistro(){
    var Nombre,Apellido,Email,Foto,Clave,ConfirmarClave,Expresion;
           Nombre = document.getElementById('Nombre').value; //obtengo los valores de: nombre,apellido,email,clave
           Apellido = document.getElementById('Apellido').value;
           Email = document.getElementById('Email').value;
           Clave = document.getElementById('Clave').value; //preguntar
           ConfirmarClave = document.getElementById('ConfirmarClave').value;
           Expresion = "/^\w+@\w+\.[a-z]+$/";   //que el correo empiece por letras despues por arroba,despues mas letras un punto y mas letras
           Mayusculas="/[A-Z]/"; //tiene mayusculas
           Minusculas="/[a-z]/"; // tiene minusculas
           Simbolos="/[0-9\$@\!#]/"; //  numeros y simbolos
             
   
          if((Nombre==="" || Apellido==="" || Email==="" || Clave==="" || ConfirmarClave=="")){ //todos los campos tienen que ser distinto de vacio(espacios)
              alert("ERROR: Todos los campos son obligatorios");      
                 return false;
            }
           if ((Nombre.test(Simbolos)) || (Apellido.test(Simbolos))) { //si el nombre o el apellido tiene simbolos o numeros retorna falso
               alert("ERROR: El nombre y apellido solo pueden tener carcteres alfabeticos");
                      return false;
              }
          if(Nombre.length>60){  //si la cantidad de caracteres de la variable es mayor a n mostrar en pantalla :error
              alert("ERROR: El nombre es demasiado largo"); 
                 return false;
                }
          if(Apellido.length>80){
                 alert("ERROR: El apellido es demasiado largo"); 
                 return false;
                }
          if(!Expresion.test(email)){ //si el correo es distinto de letras@letras.letras :mostrar error
                 alert("ERROR: El correo no es valido ");
                 return false;
                }
          if(Clave.length<6){
                 alert("ERROR: La clave debe tener como minimo 6 caracteres"); 
                 return false;
               }
           if(!(Clave.test(Mayusculas))&&!(Clave.test(Minusculas))&&!(Clave.test(Simbolos))) {
                      alert("ERROR: La clave no es valida");
                      return false;
               }
           if(Clave!=ConfirmarClave){
             alert("ERROR: Ambas claves deben ser iguales");
             return false;
           }      
         if(!(Nombre.test(Mayusculas))&&!(Nombre.test(Minusculas)){
                alert("ERROR: El nombre no es valida,solo puede contener letras");
                return false;
           }     
        if(!(Apellido.test(Mayusculas))&&!(Apellido.test(Minusculas)){
                alert("ERROR: El Apellido no es valida,solo puede contener letras");
           }     return false;
   
      }