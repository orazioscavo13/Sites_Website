create table Utente(
 id integer primary key AUTO_INCREMENT,
 username varchar(20) not null,
 password varchar(50),
 sviluppatore boolean,
 amministratore boolean DEFAULT 0,
 data_registrazione timestamp not null DEFAULT CURRENT_TIMESTAMP,
 immagine varchar(32) not null DEFAULT "Default.png"
)engine=InnoDB;

create table Modulo(
 nome varchar(30) primary key,
 funzionalita varchar(50),
 costo float(10,2)
)engine=InnoDB;

create table Visitatore(
 id integer primary key AUTO_INCREMENT,
 ip integer(10),
 data date
)engine=InnoDB;

create table Sviluppatore(
 id integer primary key AUTO_INCREMENT,
 p_iva varchar(30),
 cognome varchar(30),
 nome varchar(30),
 telefono varchar(12),
 id_utente integer NOT NULL,
 index ix_user(id_utente),
 foreign key(id_utente) REFERENCES Utente(id)
)engine= InnoDB;


create table Cliente(
 id integer primary key AUTO_INCREMENT,
 cf varchar(25),
 azienda boolean,
 sede varchar(30),
 citta varchar(30),
 indirizzo varchar(30),
 telefono varchar(30),
 id_utente integer not null,
 index ix_uten(id_utente),
 foreign key(id_utente) REFERENCES Utente(id)
)engine=InnoDB;

create table Layout(
 id integer primary key AUTO_INCREMENT,
 costo_tot float(10,2) DEFAULT 0.0,
 sviluppatore integer,
 index ix_svil(sviluppatore),
 foreign key(sviluppatore) references Sviluppatore(id)
)engine=InnoDB;

create table Composizione(
 modulo varchar(30),
 layout integer,
 index ix_mod(modulo),
 index ix_lay(layout),
 foreign key(modulo) references Modulo(nome),
 foreign key(layout) references Layout(id),
 primary key(modulo,layout) 
)engine=InnoDB;

create table Sito(
	codice integer primary key AUTO_INCREMENT,
	data_pubblicazione date,
	url varchar(60),
	cliente integer,
	layout integer,
	pagato boolean,
	index ix_cliente(cliente),
	index ix_layout(layout),
	foreign key(cliente) references Cliente(id),
	foreign key(layout) references Layout(id)
) engine=InnoDB;


create table Visita(
 sito integer,
 visitatore integer,
 index ix_vis(visitatore),
 index ix_sito(sito),
 foreign key(visitatore) references Visitatore(id),
 foreign key(sito) references Sito(codice),
 primary key(sito,visitatore)
)engine=InnoDB;


delimiter // 
create trigger allinea
	after insert on Composizione
	for each row
	begin
	 Update Layout set costo_tot = costo_tot +(
	 	select costo from Modulo where nome=NEW.modulo
	 	) where id = NEW.layout;
	 end //
delimiter ;

delimiter //
create procedure inserisci_sito_e_vedi_cliente(IN data date,IN url varchar(60),IN cliente integer)
	begin
	insert into Sito (data_pubblicazione,url,cliente) VALUES (data, url,cliente);
	select c.*,sum(l.costo_tot), count(*) from
	(Cliente c join Sito s on c.id=s.cliente) join Layout l on l.id= s.layout
	group by c.id;
	end //
delimiter ;

delimiter //
create procedure visitatori(IN sito integer)
	begin
	select v.* from 
	Visitatore v join Visita vis on v.id = vis.visitatore where vis.sito= sito;
	end //
delimiter ;


delimiter //
create procedure layouts(IN lay integer, IN sito integer)
	begin
	Select * from Layout where sviluppatore=(
	select sviluppatore from Layout where id= lay);
	Update Sito set layout = lay where codice = sito;
	end //
delimiter ;

create view siti_annui as
	select count(*) as numero, year(data_pubblicazione)
	from Sito group by year(data_pubblicazione);

delimiter //
create procedure media_annua_siti(OUT media float)
	begin
	select avg(numero) into media from siti_annui;
	end //
delimiter ;

create view usi_layout as
	select l.id as layout, 
	case
	when (s.codice IS NOT NULL) then count(*)
	else 0
    end /*se s.* è null metti 0*/
	as usi from 
	Layout l left outer join Sito s on s.layout = l.id
	group by l.id;

create view usi_moduli as
select m.nome as modulo,
case
	when (c.layout IS NOT NULL) then sum(u.usi)
	else 0
	end
as usi from 
(Modulo m left outer join Composizione c on c.modulo=m.nome) 
left outer join usi_layout u on u.layout=c.layout
group by m.nome;

delimiter //
create procedure modulo_top()
	begin
	select m.*, u.usi as usi from usi_moduli u join Modulo m on m.nome=u.modulo
	where u.usi >=(
		select max(usi) from usi_moduli);
	end //
delimiter ;

INSERT INTO `Utente`  (`username`, `password`, `sviluppatore`, `amministratore`, `data_registrazione`, `immagine`) VALUES
( 'Admin', 'd5ed307108ed0c28323277015a980048', 0, 1, '2017-06-02 13:17:52', 'Default.png');




