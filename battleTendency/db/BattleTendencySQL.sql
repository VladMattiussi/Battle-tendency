-- *********************************************
-- * Standard SQL generation                   
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.1              
-- * Generator date: Dec  4 2018              
-- * Generation date: Wed Dec 18 13:02:13 2019 
-- * LUN file: C:\xampp\htdocs\progettotecweb\DB\BattleTendencyDifensiva.lun 
-- * Schema: BT/SQL1 
-- ********************************************* 


-- Database Section
-- ________________ 

create database IF NOT EXISTS `BT` DEFAULT CHARACTER SET utf8;
use `BT`;


-- DBSpace Section
-- _______________


-- Tables Section
-- _____________ 

create table BIGLIETTO (
     IdEvento int not null,
     Numero int not null,
     Tipo char(30) not null,
     Prezzo DECIMAL(5,2) not null,
     CF char(16),
     constraint ID_BIGLIETTO_ID primary key (IdEvento, Numero)
);

create table COMBATTENTE (
     IdCombattente int not null AUTO_INCREMENT,
     Nome char(30) not null,
     NomeArte char(30),
     MossaSpeciale char(30),
     Descrizione text,
     immagine char(30),
     constraint ID_COMBATTENTE_ID primary key (IdCombattente));

create table MESSAGGIO (
     IdMessaggio int not null AUTO_INCREMENT,
     Contenuto text not null,
     DataInvio date not null,
     Letto boolean default false,
     Dest_CF char(16) not null,
     Mit_CF char(16) not null,
     constraint ID_MESSAGGIO_ID primary key (IdMessaggio));

create table EVENTO (
     IdEvento int not null AUTO_INCREMENT,
     Nome char(30) not null,
     Data date not null,
     Luogo char(30) not null,
     DescrizioneBreve TINYTEXT not null,
     Descrizione text not null,
     IdCombattente int not null,
     PAR_IdCombattente int not null,
     immagine char(30),
     CF char(16) not null,
     UltimaModifica date not null,
     constraint ID_EVENTO_ID primary key (IdEvento));

create table UTENTE (
     CF char(16) not null,
     Cognome char(30) not null,
     Nome char(30) not null,
     DataDiNascita date not null,
     Email char(30) not null,
     Username char(30) not null,
     Password char(30) not null,
     DataRegistrazione date not null,
     Tipo char(30) not null,
	 Attivo boolean default true,
     constraint ID_UTENTE_ID primary key (CF));


-- Constraints Section
-- ___________________ 

alter table BIGLIETTO add constraint REF_BIGLI_EVENT
     foreign key (IdEvento)
     references EVENTO(IdEvento)
      ON DELETE cascade;

alter table BIGLIETTO add constraint REF_BIGLI_UTENT_FK
     foreign key (CF)
     references UTENTE(CF)
      ON DELETE cascade;

alter table MESSAGGIO add constraint REF_MESSA_UTENT_1_FK
     foreign key (Dest_CF)
     references UTENTE(CF)
      ON DELETE cascade;

alter table MESSAGGIO add constraint REF_MESSA_UTENT_FK
     foreign key (Mit_CF)
     references UTENTE(CF)
      ON DELETE cascade;

alter table EVENTO add constraint REF_EVENT_COMBA_1_FK
     foreign key (IdCombattente)
     references COMBATTENTE(IdCombattente)
      ON DELETE cascade;

alter table EVENTO add constraint REF_EVENT_COMBA_FK
     foreign key (PAR_IdCombattente)
     references COMBATTENTE(IdCombattente)
      ON DELETE cascade;

alter table EVENTO add constraint REF_EVENT_UTENT_FK
     foreign key (CF)
     references UTENTE(CF)
     ON DELETE cascade;


-- Index Section
-- _____________ 

create unique index ID_BIGLIETTO_IND
     on BIGLIETTO (IdEvento, Numero);

create index REF_BIGLI_UTENT_IND
     on BIGLIETTO (CF);

create unique index ID_COMBATTENTE_IND
     on COMBATTENTE (IdCombattente);

create unique index ID_MESSAGGIO_IND
     on MESSAGGIO (IdMessaggio);

create index REF_MESSA_UTENT_1_IND
     on MESSAGGIO (Dest_CF);

create index REF_MESSA_UTENT_IND
     on MESSAGGIO (Mit_CF);

create unique index ID_EVENTO_IND
     on EVENTO (IdEvento);

create index REF_EVENT_COMBA_1_IND
     on EVENTO (IdCombattente);

create index REF_EVENT_COMBA_IND
     on EVENTO (PAR_IdCombattente);

create index REF_EVENT_UTENT_IND
     on EVENTO (CF);

create unique index ID_UTENTE_IND
     on UTENTE (CF);

