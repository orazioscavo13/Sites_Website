<?php
//funzione per la formattazione della tabella contenente i moduli
function fill_modules_table($db){
  $query="SELECT m.*, u.usi from Modulo m join usi_moduli u on m.nome=u.modulo;";
  $result = mysqli_query($db,$query);
  while($row=mysqli_fetch_assoc($result)){
    ?>
                <tr>
                  <td><b class="text-primary"><?php echo $row['nome']; ?></b></td>
                  <td><?php echo $row['funzionalita']; ?></td>
                  <td><?php echo $row['costo']; ?></td>
                  <td><?php echo $row['usi'];?> </td>
                </tr>
<?php
  }
}

//funzione per la formattazione della tabella contenente i layouts nella pagina di gestione dei layout
function fill_layout_table($db){
  $query="SELECT l.*, u.usi, ut.username, ut.immagine, s.id_utente from ((Layout l join usi_layout u on l.id=u.layout) join Sviluppatore s on s.id = l. sviluppatore) join Utente ut on ut.id = s.id_utente;";
  $result = mysqli_query($db,$query);
  while($row=mysqli_fetch_assoc($result)){
    $moduli=genera_parametro_moduli($row['id'],$db);
    ?>
                <tr>
                  <td><?php echo "Layout ".$row['id']; ?></td>
                  <td>
                    <span class="user-block ">
                      <img class="img-circle" src="images/profile_images/<?php echo $row['immagine']; ?>" alt="User Image">
                      <span class="username"><a href="profilo.php?id=<?php echo $row['id_utente']; ?>"><?php echo $row['username'];?></a></span>
                    </span>
                  </td>
                  <td><?php echo $row['costo_tot']; ?></td>
                  <td><?php echo numero_moduli($row['id'],$db)?><button onclick='show_modules_popup("<?php echo $row['id']; ?>")' style="margin-left: 4px;"type="button" class="btn btn-xs btn-success">VEDI</button></td>
                  <td><?php echo $row['usi'];?> </td>
                </tr>
<?php
  }
}

//funzione per la formattazione della tabella contenente i layouts nel profilo dello sviluppatore
function fill_developer_layout_table($db, $dev){

  $query="SELECT l.*, u.usi, ut.username, ut.immagine, s.id_utente from ((Layout l join usi_layout u on l.id=u.layout) join Sviluppatore s on s.id = l. sviluppatore) join Utente ut on ut.id = s.id_utente where l.sviluppatore = '".$dev."';";
  $result = mysqli_query($db,$query);
  while($row=mysqli_fetch_assoc($result)){
    ?>
                <tr>
                  <td><?php echo "Layout ".$row['id']; ?></td>
                  <td>
                    <span class="user-block ">
                      <img class="img-circle" src="images/profile_images/<?php echo $row['immagine']; ?>" alt="User Image">
                      <span class="username"><a href="profilo.php?id=<?php echo $row['id_utente']; ?>"><?php echo $row['username'];?></a></span>
                    </span>
                  </td>
                  <td><?php echo $row['costo_tot']; ?></td>
                  <td><?php echo numero_moduli($row['id'],$db);?><button onclick='show_slim_layout_popup("<?php echo $row['id'];?>")' style="margin-left: 4px;"type="button" class="btn btn-xs btn-success">VEDI</button></td>
                  <td><?php echo $row['usi'];?> </td>
                </tr>
<?php
  }
}

//funzione per la formattazione della tabella contenente i clienti
function fill_customer_table($db,$azienda){
  $query = "Select c.* ,sum(l.costo_tot) as somma, count(s.codice) as siti, u.username, u.immagine  from ((Cliente c left outer join Sito s on c.id=s.cliente) left outer join Layout l on l.id= s.layout)left outer join Utente u on u.id = c.id_utente where c.azienda = ".$azienda." group by c.id;";
  $result = mysqli_query($db,$query);
  while($row = mysqli_fetch_assoc($result)){
    if($row['azienda']) $classe="campo-azienda";
    else $classe = "campo-persona";
    if(is_null($row['somma'])){
      $somma = "0.00";
    }else $somma = $row['somma'];
    ?>
    <tr class="<?php echo $classe; ?>">
      	<td>
        	<span class="user-block ">
          		<img class="img-circle" src="images/profile_images/<?php echo $row['immagine']; ?>" alt="User Image">
          		<span class="username "><a class="text-warning" href="profilo.php?id=<?php echo $row['id_utente']; ?>"><?php echo $row['username'];?></a></span>
         	</span>
    	</td>
      	<td><?php echo $row['cf']; ?></td>
      	<?php if($azienda){ ?>
      		<td><?php echo $row['sede']; ?></td>
      	<?php } ?>
      	<td><?php echo $row['indirizzo'].", ".$row['citta']; ?></td>
      	<td><?php echo $row['telefono']; ?></td>
      	<td><?php echo $row['siti']; ?><button onclick='show_site_form("<?php echo $row['id']; ?>","<?php echo $row['username']; ?>","<?php echo $row['cf']; ?>","<?php echo $row['indirizzo']; ?>","<?php echo $row['citta']; ?>","<?php echo $row['telefono']; ?>")' style="margin-left:8px;" class="btn btn-xs btn-danger">CREA NUOVO</button></td>
      	<td><?php echo $somma; ?> €</td>
    </tr>
    <?php
  }
}

//funzione per la formattazione della tabella contenente i siti commissionati da un cliente nel suo profilo
function fill_sites_table($id,$db,$user){
  $query="SELECT * from Sito where cliente = ".id_cliente($id,$db).";";
  $result = mysqli_query($db,$query);
  while($row=mysqli_fetch_assoc($result)){
    ?>
    </script>
                <tr>
                  <td><button onclick='show_site("<?php echo $row['codice']; ?>")' style="margin-right: 8px;" class="btn btn-xs btn-info"><i class="ion ion-ios-information"></i></button><a href="#" id="<?php echo $row['codice']; ?>" class="anteprima"><?php echo $row['url']; ?></a></td>
                  <td><?php echo $row['data_pubblicazione']; ?></td>
                  <td >
                    <?php
                    if($row['pagato']){echo '<span class="label label-success">Pagato</span>'; }
                    else echo '<span class="label label-warning">Non pagato</span><a href="paga.php?cod='.$row['codice'].'" style="margin-left:10px;" type="button" class="btn btn-xs btn-primary pull-right">Segna come pagato</a>';
                    ?>
                  </td>
                </tr>

<?php
  }
}

//Funzione per la formattazione dei radio button per la scelta del layout nella form di creazione di un nuovo sito
function layout_options($db){
  $query = "SELECT l.*, s.id_utente, u.username, u.immagine FROM (Layout l join Sviluppatore s on s.id = l.sviluppatore) join Utente u on u.id = s.id_utente;";
  $result = mysqli_query($db,$query);
  $check ="checked";
  $margin=17;
  while($row=mysqli_fetch_assoc($result)){
    if($row['id']>9)$margin=10;
    else $margin= 17;
    $link="profilo.php?id=".$row['id_utente'];
    ?>
  	<div class="radio">
    	<label>
      		<input class="lay" type="radio" name="layout" value="<?php echo $row['id']; ?>"  data-costo="<?php echo $row['costo_tot']; ?>">
      		<?php echo "Layout ".$row['id'];?>
      		<button onclick='show_slim_layout_popup("<?php echo $row['id']; ?>")' style="margin-left: <?php echo $margin; ?>px;" type="button" class="btn btn-sm btn-info">VEDI</button>
    	</label>
  	</div>
  <?php
  $check = "";
  }
}

//funzione per il display del team di sviluppatori nella pagina "index"
function show_developers($db,$user){
  $query="SELECT id,username, immagine from Utente where sviluppatore=1;";
  $result=mysqli_query($db,$query);
  $cat=categoria($user,$db);
  $link="#";
  while($row=mysqli_fetch_assoc($result)){
    if(strcmp($cat,"Cliente")!=0){
      $link="profilo.php?id=".$row['id'];
    }
    echo '<li>
              <img width="80px" heigth="80px" src="images/profile_images/'.$row['immagine']. '" alt="User Image">
              <a class="users-list-name" href="'.$link.'">'.$row['username'].'</a>
          </li>';
  }
}

//funzione per il display dei moduli più usati nella pagina "index"
function display_moduli_top($db){
  $query="SELECT * from usi_moduli where 1 order by usi desc;";
  $result=mysqli_query($db,$query);
  for($i=0;$i<4;$i++){
    $row=mysqli_fetch_assoc($result);
    switch ($i) {
      case '0':
        $color="yellow";
        $icon="bag";
        break;
      case '1':
        $color="green";
        $icon="bag";
        break;
        case '2':
        $color="aqua";
        $icon="bag";
        break;
        case '3':
        $color="red";
        $icon="bag";
        break;
      default:
        $color="grey";
        $icon="bag";
        break;
    } ?>
        <div class="col-lg-3 col-xs-6">
          <div style="min-height:100px;" class="small-box bg-<?php echo $color; ?>">
            <div class="inner">
              <h4><b><?php echo $row["modulo"]; ?></b></h4><span><?php echo $row["usi"]; ?> Utilizzi</span>
              <div  class="icon">
                <i class="ion"><?php echo ($i+1); ?>&#176</i>
              </div>
            </div>
          </div>
        </div>
        <?php
  }
}

//funzione per la visualizzazione delle checkbox per i moduli nella form per la composizione del layout
function fill_layout_form($db){
  $query = "SELECT * from Modulo where 1;";
  $result = mysqli_query($db,$query);
  while($row = mysqli_fetch_assoc($result)){?>
    <div class="checkbox">
      <label>
        <input class="modchoose" type="checkbox" name="moduli[]" value="<?php echo $row['nome']; ?>">
        <b class="text-warning" ><?php echo $row['nome']; ?></b> (<?php echo $row['funzionalita']; ?>)
      </label>
      <span style="margin-right:10px;" class="pull-right text-red"><?php echo $row['costo']." €"; ?></span>
    </div>
    <hr>
            <?php
  }
}


?>
