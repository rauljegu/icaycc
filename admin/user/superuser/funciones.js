var i = 1;var ii = 1;var iii = 1;
var iv = 1;var v = 1; var j = 1; var k =1; var l=1; var m=1;
lic = document.getElementById("lic1").value;
mas = document.getElementById("mas1").value;
doc = document.getElementById("doc1").value;
esp = document.getElementById("esp1").value;
pos = document.getElementById("pos1").value;

/////////FUNCIONES PARA EL DOCUMENTO formulario.php//////////
function ni(a){
	var licInput = document.getElementById(a);
	var licInput1 = document.getElementById(a).parentNode;
	//console.log(licInput1);
	i++;
	//console.log(lic);
	const newInput = document.createElement("input");
	newInput.type = "text";
	a= newInput.id="lic"+i;
	newInput.setAttribute("onchange", "ni(this.id)");
	var newParagraph = document.createElement("p");
	newParagraph.innerHTML = " Añadir Licenciatura :"; 
	newParagraph.appendChild(newInput);
	var parentParagraph = licInput.parentNode;
	parentParagraph.parentNode.insertBefore(newParagraph, parentParagraph.nextSibling);
	lic = lic +licInput.value+ "."; 
	//console.log(lic);
	var inputpost = document.getElementById("lic");
	inputpost.value= lic; 
}
function nim(a){
	var masInput = document.getElementById(a);
	var masInput1 = document.getElementById(a).parentNode;
	//console.log(masInput1);
	ii++;
	//console.log(mas);
	const newInput = document.createElement("input");
	newInput.type = "text";
	a= newInput.id="mas"+ii;
	newInput.setAttribute("onchange", "nim(this.id)");
	var newParagraph = document.createElement("p");
	newParagraph.innerHTML = "Maestría " + ii+":"; 
	newParagraph.appendChild(newInput);
	var parentParagraph = masInput.parentNode;
	parentParagraph.parentNode.insertBefore(newParagraph, parentParagraph.nextSibling);
	mas = mas +masInput.value+ "."; 
	//console.log(mas);
	var inputpost = document.getElementById("mas");
	inputpost.value= mas; 
}

function nid(a){
	var docInput = document.getElementById(a);
	var docInput1 = document.getElementById(a).parentNode;
	//console.log(docInput1);
	iii++;
	//console.log(doc);
	const newInput = document.createElement("input");
	newInput.type = "text";
	a= newInput.id="doc"+iii;
	newInput.setAttribute("onchange", "nid(this.id)");
	var newParagraph = document.createElement("p");
	newParagraph.innerHTML = "Doctorado " + iii+":"; 
	newParagraph.appendChild(newInput);
	var parentParagraph = docInput.parentNode;
	parentParagraph.parentNode.insertBefore(newParagraph, parentParagraph.nextSibling);
	doc = doc +docInput.value+ "."; 
	//console.log(doc);
	var inputpost = document.getElementById("doc");
	inputpost.value= doc; 
}
function nie(a){
	var espInput = document.getElementById(a);
	var espInput1 = document.getElementById(a).parentNode;
	//console.log(espInput1);
	iv++;
	//console.log(esp);
	const newInput = document.createElement("input");
	newInput.type = "text";
	a= newInput.id="esp"+iv;
	newInput.setAttribute("onchange", "nie(this.id)");
	var newParagraph = document.createElement("p");
	newParagraph.innerHTML = "Especialidad " + iv+":"; 
	newParagraph.appendChild(newInput);
	var parentParagraph = espInput.parentNode;
	parentParagraph.parentNode.insertBefore(newParagraph, parentParagraph.nextSibling);
	esp = esp +espInput.value+ "."; 
	//console.log(esp);
	var inputpost = document.getElementById("esp");
	inputpost.value= esp; 
}
function nip(a){
	var posInput = document.getElementById(a);
	var posInput1 = document.getElementById(a).parentNode;
	//console.log(posInput1);
	v++;
	//console.log(pos);
	const newInput = document.createElement("input");
	newInput.type = "text";
	a= newInput.id="pos"+v;
	newInput.setAttribute("onchange", "nip(this.id)");
	var newParagraph = document.createElement("p");
	newParagraph.innerHTML = "Postdoctorado " + v+":"; 
	newParagraph.appendChild(newInput);
	var parentParagraph = posInput.parentNode;
	parentParagraph.parentNode.insertBefore(newParagraph, parentParagraph.nextSibling);
	pos = pos +posInput.value+ "."; 
	//console.log(pos);
	var inputpost = document.getElementById("pos");
	inputpost.value= pos; 
}
var nom = document.getElementById("nom1").value;
var anom = document.getElementById("anom1").value;
var valor = "";
var j=1;
function no(a){
	//CREACION DE LOS CAMPOS NUEVOS
	//guardamos al input del año de nombramiento que invoca la funcion
	var nomyearInput = document.getElementById(a);
	//Guardamos al input del nombramiento que corresponde 
	var nomb = document.getElementById("nom"+j);
	//Guardamos al input del año nombramiento que corresponde 
	var anomb = document.getElementById("anom"+j);
	//Obtenemos al alemento p que encierra al input año de nombramiento
	var nomYInput1 = document.getElementById(a).parentNode;
	//obtenemos al div que encierra al nombramiento y su año
	var abueloY = nomYInput1.parentNode;
	//aumentamos el valor de j para crear los inputs nombramiento  y año nombramiento siguientes
	j++;
		// creamos el input que corresponde al nuevo campo nombramiento
	const newInput = document.createElement("input");
		//le asignamos propiedades al input creado
	newInput.type = "text";
	newInput.id="nom"+j;
		//creamos el elemento  p que encierrará al input creado anteriormente
	var newParagraph = document.createElement("p");
		// le asignamos propiedades y texto al elemento p 
	newParagraph.innerHTML = "Nombramiento " + j+":"; 
		//añadimos el Input nombramiento dentro del elemento p
	newParagraph.appendChild(newInput);
		//insertamos el elemento p que tiene incrustado al input nombramiento en el div de los datos de nombramiento
		// despues del ultimo campo de año de nombramiento que se haya creado
	abueloY.insertBefore(newParagraph, anomb.nextSibling);
			// creamos el input que corresponde al nuevo campo año de nombramiento
	const newInput1 = document.createElement("input");
			//le asignamos propiedades al input creado
	newInput1.type = "text";
	newInput1.id="anom"+j;
			// asignamos la funcion que crea nuevos campos para continuar añadiendo informacion
	newInput1.setAttribute("onchange", "no(this.id)");
			//creamos el elemento  p que encierrará al input año de nombramiento
	var newParagraph1 = document.createElement("p");
			// le asignamos propiedades y texto al elemento p 
	newParagraph1.innerHTML = "Año del nombramiento " + j+":"; 
			//añadimos el Input año del nombramiento dentro del elemento p
	newParagraph1.appendChild(newInput1);
			//insertamos el elemento p que tiene incrustado al input año del nombramiento en el div de los datos de nombramiento
			// despues del ultimo  de nombramiento que se haya creado
	abueloY.insertBefore(newParagraph1, newInput1.nextSibling);
	
	///*/*/*/*/*/*/RECUPERANDO LOS VALORES DE LOS CAMPOS///////
	// la variable valor recupera los valores del nombramiento y el año de nombramiento y los separa con un -
	// al par se le agrega un punto para recuperar el dato y poder hacer un explode mas tarde
	valor = valor+nomb.value+"-"+anomb.value+".";
	//console.log(valor);
	//los valores se asignan al input que los enviara para su incersion a la bd
	// primero se recupera el imput que hara esta funcion
	var inputpost = document.getElementById("nom");
	// se asigna el valor al input
	inputpost.value= valor; 
	
	
}

//////*********Funciones para el editar_registro.php ///////////////
function valoreslic(){
	var inputs = document.querySelectorAll('input[id*="lic"]');
	//console.log(inputs);
	lar = inputs.length ;
	//console.log(lar);
	var ValLic = "";
	for (var r = 0; r < lar; r++) {
		if (r > 0){
		var b = "lic"+r;
		//console.log(b);
		var input1 = document.getElementById(b);
		//console.log(input1);
		if(input1.value != ""){
		var ValLic = ValLic + input1.value + ".";}
		}	else { ValLic = "";}
		};
//console.log(ValLic);
	var inputpost = document.getElementById("lic");
	inputpost.value= ValLic; 
  }

function ni2(a){
	var licInput = document.getElementById(a);
	contenido = licInput.id;
	contenido = parseInt(contenido.slice(3));
	if (contenido == 2){ i = 2; }
	contenido = contenido +1 ;
	var sigInput = document.getElementById("lic"+contenido);
	//console.log(sigInput);
	var licInput1 = document.getElementById(a).parentNode;
	//console.log(licInput1);
	if(sigInput==null){
	i++;
	//console.log(lic);
	const newInput = document.createElement("input");
	newInput.type = "text";
	/*if (i == 2) {
	i = i +1; }*/
	 newInput.id="lic"+i;
	//a= "Lic. "+i+" ";
	a= "Añadir Lic. ";
	newInput.setAttribute("onchange", "ni2(this.id)");
	var newParagraph = document.createElement("p");
	//newParagraph.innerHTML = " Añadir Licenciatura :"; 
	newParagraph.innerHTML = a; 
	newParagraph.appendChild(newInput);
	var parentParagraph = licInput.parentNode;
	parentParagraph.parentNode.insertBefore(newParagraph, parentParagraph.nextSibling);
	}
	valoreslic();
}

function valoreslicm(){
	var inputs = document.querySelectorAll('input[id*="mas"]');
	//console.log(inputs);
	lar = inputs.length ;
	//console.log(lar);
	var ValMas = "";
	for (var s = 0; s < lar; s++) {
		if (s > 0){
		var b = "mas"+s;
		//console.log(b);
		var input1 = document.getElementById(b);
		//console.log(input1);
		if(input1.value != ""){
		var ValMas = ValMas + input1.value + ".";}
		}	else { ValMas = "";}
		};
//console.log(ValLic);
	var inputpost = document.getElementById("mas");
	inputpost.value= ValMas; 
  }

function nim2(a){
	var licInput = document.getElementById(a);
	contenido = licInput.id;
	contenido = parseInt(contenido.slice(3));
	if (contenido == 2){ j = 2; }
	contenido = contenido +1 ;
	var sigInput = document.getElementById("mas"+contenido);
	//console.log(sigInput);
	var licInput1 = document.getElementById(a).parentNode;
	//console.log(licInput1);
	if(sigInput==null){
	j++;
	//console.log(lic);
	const newInput = document.createElement("input");
	newInput.type = "text";
	/*if (j == 2) {
	j = j +1; }*/
	 newInput.id="mas"+j;
	//a= "M.   "+j+" ";
	a= "Añadir Mtria. ";
	newInput.setAttribute("onchange", "nim2(this.id)");
	var newParagraph = document.createElement("p");
	//newParagraph.innerHTML = " Añadir Licenciatura :"; 
	newParagraph.innerHTML = a; 
	newParagraph.appendChild(newInput);
	var parentParagraph = licInput.parentNode;
	parentParagraph.parentNode.insertBefore(newParagraph, parentParagraph.nextSibling);
	}
	valoreslicm();
}

function valoreslicd(){
	var inputs = document.querySelectorAll('input[id*="doc"]');
	//console.log(inputs);
	lar = inputs.length ;
	//console.log(lar);
	var ValDoc = "";
	for (var t = 0; t < lar; t++) {
		if (t > 0){
		var b = "doc"+t;
		//console.log(b);
		var input1 = document.getElementById(b);
		//console.log(input1);
		if(input1.value != ""){
		var ValDoc = ValDoc + input1.value + ".";}
		}	else { ValDoc = "";}
		};
//console.log(ValDoc);
	var inputpost = document.getElementById("doc");
	inputpost.value= ValDoc; 
  }

function nid2(a){
	var licInput = document.getElementById(a);
	contenido = licInput.id;
	contenido = parseInt(contenido.slice(3));
	if (contenido == 2){ k = 2; }
	contenido = contenido +1 ;
	var sigInput = document.getElementById("doc"+contenido);
	//console.log(sigInput);
	var licInput1 = document.getElementById(a).parentNode;
	//console.log(licInput1);
	if(sigInput==null){
	k++;
	//console.log(lic);
	const newInput = document.createElement("input");
	newInput.type = "text";
	/*if (k == 2) {
	k = k +1; }*/
	 newInput.id="doc"+k;
	//a= "PhD.   "+k+" ";
	a= "Añadir PhD. ";
	newInput.setAttribute("onchange", "nid2(this.id)");
	var newParagraph = document.createElement("p");
	//newParagraph.innerHTML = " Añadir Licenciatura :"; 
	newParagraph.innerHTML = a; 
	newParagraph.appendChild(newInput);
	var parentParagraph = licInput.parentNode;
	parentParagraph.parentNode.insertBefore(newParagraph, parentParagraph.nextSibling);
	}
	valoreslicd();
}
function valoreslicp(){
	var inputs = document.querySelectorAll('input[id*="pos"]');
	//console.log(inputs);
	lar = inputs.length ;
//	console.log(lar);
	var ValPos = "";
	for (var u = 0; u < lar; u++) {
		if (u > 0){
		var b = "pos"+u;
		//console.log(b);
		var input1 = document.getElementById(b);
	//	console.log(input1);
		if(input1.value != ""){
		var ValPos = ValPos + input1.value + ".";}
		}	else { ValPos = "";}
		};
//console.log(ValPos);
	var inputpost = document.getElementById("pos");
	inputpost.value= ValPos; 
  }

function nip2(a){
	var licInput = document.getElementById(a);
	contenido = licInput.id;
	contenido = parseInt(contenido.slice(3));
	//console.log("ID original"+contenido);
	if (contenido == 2){ l = 2; }
	contenido = contenido +1 ;
	//console.log("ID "+contenido);
	var sigInput = document.getElementById("pos"+contenido);
	//console.log(sigInput);
	var licInput1 = document.getElementById(a).parentNode;
	//console.log(licInput1);
	if(sigInput==null){
	l++;
	//console.log(lic);
	const newInput = document.createElement("input");
	newInput.type = "text";
	/*if (l == 2) {
	l = l +1; }*/
	 newInput.id="pos"+l;
	//a= "P.D.   "+l+" ";
	a= "Añadir P.D. ";
	newInput.setAttribute("onchange", "nip2(this.id)");
	var newParagraph = document.createElement("p");
	//newParagraph.innerHTML = " Añadir Licenciatura :"; 
	newParagraph.innerHTML = a; 
	newParagraph.appendChild(newInput);
	var parentParagraph = licInput.parentNode;
	parentParagraph.parentNode.insertBefore(newParagraph, parentParagraph.nextSibling);
	}
	valoreslicp();
}

function valoreslice(){
	var inputs = document.querySelectorAll('input[id*="esp"]');
	console.log(inputs);
	lar = inputs.length ;
console.log(lar);
	var ValEsp = "";
	for (var v = 0; v < lar; v++) {
		if (v > 0){
		var b = "esp"+v;
		//console.log(b);
		var input1 = document.getElementById(b);
		console.log(input1);
		if(input1.value != ""){
		var ValEsp = ValEsp + input1.value + ".";}
		}	else { ValEsp = "";}
		};
console.log(ValEsp);
	var inputpost = document.getElementById("esp");
	inputpost.value= ValEsp; 
  }

function nie2(a){
	var licInput = document.getElementById(a);
	contenido = licInput.id;
	contenido = parseInt(contenido.slice(3));
	//console.log("ID original"+contenido);
	if (contenido == 2){ m = 2; }
	contenido = contenido +1 ;
	//console.log("ID "+contenido);
	var sigInput = document.getElementById("esp"+contenido);
	//console.log(sigInput);
	var licInput1 = document.getElementById(a).parentNode;
	//console.log(licInput1);
	if(sigInput==null){
	m++;
	//console.log(lic);
	const newInput = document.createElement("input");
	newInput.type = "text";
	/*if (l == 2) {
	l = l +1; }*/
	 newInput.id="esp"+m;
	//a= "P.D.   "+l+" ";
	a= "Añadir Especialidad ";
	newInput.setAttribute("onchange", "nie2(this.id)");
	var newParagraph = document.createElement("p");
	//newParagraph.innerHTML = " Añadir Licenciatura :"; 
	newParagraph.innerHTML = a; 
	newParagraph.appendChild(newInput);
	var parentParagraph = licInput.parentNode;
	parentParagraph.parentNode.insertBefore(newParagraph, parentParagraph.nextSibling);
	}
	valoreslice();
}


var nom = document.getElementById("nom1").value;
var anom = document.getElementById("anom1").value;
var valor = "";
var z=1;

function valoresnom(){
	var inputs = document.querySelectorAll('input[id*="nom"]');
	var inputs1 = document.querySelectorAll('input[id*="anom"]');
	console.log(inputs);
	lar = parseInt(inputs.length) ;
	lar = lar / 2;
	console.log(lar);
	var ValNom = "";
	var ValAmom = "";
	var valor = "";
	for (var x = 0; x < lar; x++) {
		if (x > 0){
		var b = "nom"+x;
		var c = "anom"+x;
		console.log(b);
		console.log(c);
		var input1 = document.getElementById(b);
		var input2 = document.getElementById(c);
		console.log(input1);
		console.log(input2);
		if((input1.value != "") && (input2.value != "")) {
			//var ValNom = ValNom + input1.value + ".";
			var valor = valor+input1.value+"-"+input2.value+".";
			}
		}	else { ValNom = ""; ValAmom = "";}
		};
console.log(valor);
	var inputpost = document.getElementById("nom");
	inputpost.value= valor; 
  }
function no1(a){
	//CREACION DE LOS CAMPOS NUEVOS
	//guardamos al input del año de nombramiento que invoca la funcion
	var nomyearInput = document.getElementById(a);
	//Guardamos al input del nombramiento que corresponde 
	var nomb = document.getElementById("nom"+z);
	//Guardamos al input del año nombramiento que corresponde 
//	var anomb = document.getElementById("anom"+z);
	//Obtenemos al alemento p que encierra al input año de nombramiento
	var nomYInput1 = document.getElementById(a).parentNode; //console.log("Padre:"+nomYInput1);
	//obtenemos al div que encierra al nombramiento y su año
	var abueloY = nomYInput1.parentNode; // console.log("AbueloY:"+abueloY);
	
	contenido = nomyearInput.id;
	contenido = parseInt(contenido.slice(4));
	var anomb = document.getElementById("anom"+contenido);
	//console.log("ID original"+contenido);
	if (contenido == 2){ z = 2; }
	contenido = contenido +1 ;
	//console.log("ID "+contenido);
	var sigInput = document.getElementById("anom"+contenido);
	//console.log(sigInput);
	z=contenido;
	if(sigInput==null){
	//aumentamos el valor de z para crear los inputs nombramiento  y año nombramiento siguientes
	//z++;
		// creamos el input que corresponde al nuevo campo nombramiento
	const newInput = document.createElement("input");
		//le asignamos propiedades al input creado
	newInput.type = "text";
	newInput.id="nom"+z;
		//creamos el elemento  p que encierrará al input creado anteriormente
	var newParagraph = document.createElement("p");
		// le asignamos propiedades y texto al elemento p 
	//newParagraph.innerHTML = "Nombramiento " + z+":"; 
	newParagraph.innerHTML = "Nombramiento :"; 
		//añadimos el Input nombramiento dentro del elemento p
	newParagraph.appendChild(newInput);
		//insertamos el elemento p que tiene incrustado al input nombramiento en el div de los datos de nombramiento
		// despues del ultimo campo de año de nombramiento que se haya creado
	abueloY.insertBefore(newParagraph, anomb.nextSibling);
			// creamos el input que corresponde al nuevo campo año de nombramiento
	const newInput1 = document.createElement("input");
			//le asignamos propiedades al input creado
	newInput1.type = "text";
	newInput1.id="anom"+z;
			// asignamos la funcion que crea nuevos campos para continuar añadiendo informacion
	newInput1.setAttribute("onchange", "no1(this.id)");
			//creamos el elemento  p que encierrará al input año de nombramiento
	var newParagraph1 = document.createElement("p");
			// le asignamos propiedades y texto al elemento p 
	//newParagraph1.innerHTML = "Año del nombramiento " + z+":"; 
	newParagraph1.innerHTML = "Año del nombramiento :"; 
			//añadimos el Input año del nombramiento dentro del elemento p
	newParagraph1.appendChild(newInput1);
			//insertamos el elemento p que tiene incrustado al input año del nombramiento en el div de los datos de nombramiento
			// despues del ultimo  de nombramiento que se haya creado
	abueloY.insertBefore(newParagraph1, newInput1.nextSibling);
	
	///*/*/*/*/*/*/RECUPERANDO LOS VALORES DE LOS CAMPOS///////
	// la variable valor recupera los valores del nombramiento y el año de nombramiento y los separa con un -
	// al par se le agrega un punto para recuperar el dato y poder hacer un explode mas tarde
	//valor = valor+nomb.value+"-"+anomb.value+".";
	//console.log(valor);
	//los valores se asignan al input que los enviara para su incersion a la bd
	// primero se recupera el imput que hara esta funcion
	//var inputpost = document.getElementById("nom");
	// se asigna el valor al input
	//inputpost.value= valor; 
	}
	valoresnom();
	
}