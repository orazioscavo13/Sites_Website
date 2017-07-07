<?php
//controlla se i dati forniti per il login corrispondono ad una corretta coppia username-password
function check_login($username,$password,$db){
  $query="SELECT * from Utente where username = '".$username."' and password = '".$password."';";
  $result=mysqli_num_rows(mysqli_query($db,$query));
  return $result;
}

//inserisce un nuovo utente
function registra($username,$password,$sviluppatore,$db){
	  $query="INSERT INTO `Utente`(`username`, `password`, `sviluppatore`) VALUES ('".$username."','".$password."',".$sviluppatore.");";
    mysqli_query($db,$query);
}

//controlla l'esistenza di un username
function esiste($username,$db){
  $query="SELECT * from Utente where username = '".$username."';";
  $result=mysqli_num_rows(mysqli_query($db,$query));
  return $result;
}

//inserisce un nuovo sviluppatore e crea la relazione con l'utente del sito ad esso corrispondente
function registra_sviluppatore($vettore,$db,$id){
  $query= "INSERT INTO Sviluppatore (p_iva,cognome,nome,telefono,id_utente) VALUES ('".$vettore['iva']."','".$vettore['cognome']."','".$vettore['nome']."','".$vettore['telefono']."',".$id.");";
  mysqli_query($db,$query);
}

//inserisce un nuovo sviluppatore e crea la relazione con l'utente del sito ad esso corrispondente
function registra_cliente($vettore,$db,$id,$azienda){
  if($azienda) $sede="'".$_POST['sede']."'";
  else $sede="NULL";
  $query= "INSERT INTO Cliente (cf,azienda,sede,citta,indirizzo,telefono,id_utente) VALUES ('".$vettore['cf']."',".$azienda.",".$sede.",'".$vettore['citta']."','".$vettore['indirizzo']."','".$vettore['phone']."',".$id.");";
  mysqli_query($db,$query);
  echo $query;
}

//restituisce l'username di un utente dato l'id
function username($id,$db){
  $query="SELECT username from Utente where id = '".$id."';";
  $result=mysqli_fetch_assoc(mysqli_query($db,$query));
  return $result['username'];
}

//restituisce l categoria di un utente dato l'id
function categoria($id,$db){
  $query="SELECT amministratore, sviluppatore from Utente where id = '".$id."';";
  $result=mysqli_fetch_assoc(mysqli_query($db,$query));
  if($result['amministratore'] == 1)return "Amministratore";
  else if($result['sviluppatore']==1) return "Sviluppatore";
  else return "Cliente";
}

//restituisce la data di registrazione di un utente dato l'id
function data_registrazione($id,$db){
  $query="SELECT year(data_registrazione) as anno, month(data_registrazione) as mese, day(data_registrazione) as giorno from Utente where id = '".$id."';";
  $result=mysqli_fetch_assoc(mysqli_query($db,$query));

  return $result['giorno']."-".$result['mese']."-".$result['anno'];
}

//restituisce il nome dell'immagine del profilo di un utente dato l'id
function user_image($id,$db){
  $query="SELECT immagine from Utente where id = '".$id."';";
  $result=mysqli_fetch_assoc(mysqli_query($db,$query));
  return $result['immagine'];
}


//restituisce l'id dello sviluppatore associato ad un utente dato l'id
function id_sviluppatore($user,$db){
  if(strcmp(categoria($user,$db),"Sviluppatore")!=0){
    return 0;
  }
  $query = "select id from Sviluppatore where id_utente = '".$user."';";
   return mysqli_fetch_assoc(mysqli_query($db,$query))['id'];
}

//restituisce il numero di layout sviluppati da  uno sviluppatore dato l'id dell'utente associato ad esso
function n_layout_sviluppati($user,$db){
  if(strcmp(categoria($user,$db),"Sviluppatore")!=0){
    return 0;
  }
   $sviluppatore = id_sviluppatore($user,$db);
   $query = "Select * from Layout where sviluppatore='".$sviluppatore."';";
   $result = mysqli_num_rows(mysqli_query($db,$query));
   return $result;
}

//restituisce l'id del cliente associato ad un utente dato il suo id
function id_cliente($user,$db){
    if(strcmp(categoria($user,$db),"Cliente")!=0){
    return 0;
  }
  $query = "select id from Cliente where id_utente = '".$user."';";
   return mysqli_fetch_assoc(mysqli_query($db,$query))['id'];
}

//restituisce il numero di siti commissionati da un cliente dato l'id dell'utente ad esso associato
function siti_commissionati($user,$db){
  $cliente=id_cliente($user,$db);
  $query="select count(*) as siti from
  (Cliente c join Sito s on c.id=s.cliente) join Layout l on l.id= s.layout
  where c.id = '".$cliente."';";
  return mysqli_fetch_assoc(mysqli_query($db,$query))['siti'];
}

//restituisce il costo totale dei siti commissionati da un cliente dati l'id dell'utente ad esso associato
function costo_siti_commissionati($user,$db){
  if (siti_commissionati($user,$db)==0) return 0;
  $cliente=id_cliente($user,$db);
  $query="select sum(l.costo_tot) as costo from
  (Cliente c join Sito s on c.id=s.cliente) join Layout l on l.id= s.layout
  where c.id = '".$cliente."';";;
  $res=mysqli_query($db,$query);
  return mysqli_fetch_assoc($res)['costo'];
}

?>
