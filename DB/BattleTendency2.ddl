-- *********************************************
-- * Standard SQL generation                   
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.1              
-- * Generator date: Dec  4 2018              
-- * Generation date: Sat Jan  4 09:43:04 2020 
-- * LUN file: C:\xampp\htdocs\progettotecweb\DB\BattleTendencyDifensiva.lun 
-- * Schema: BT/SQL4 
-- ********************************************* 


-- Database Section
-- ________________ 

create database BT;


-- DBSpace Section
-- _______________


-- Tables Section
-- _____________ 

create table BIGLIETTO (
     IdEvento char(1) not null,
     Numero char(32) not null,
     Tipo char(1) not null,
     Prezzo char(1) not null,
     CF char(32),
     constraint ID_BIGLIETTO_ID primary key (IdEvento, Numero));

create table COMBATTENTE (
     IdCombattente char(1) not null,
     Nome char(1) not null,
     NomeArte char(1) not null,
     MossaSpeciale char(1) not null,
     Descrizione char(1) not null,
     Immagine char(1) not null,
     constraint ID_COMBATTENTE_ID primary key (IdCombattente));

create table EVENTO (
     IdEvento char(1) not null,
     Nome char(1) not null,
     Data char(1) not null,
     Luogo char(1) not null,
     DescrizioneBreve char(1) not null,
     Descrizione char(1) not null,
     IdCombattente char(1) not null,
     PAR_IdCombattente char(1) not null,
     CF char(32) not null,
     constraint ID_EVENTO_ID primary key (IdEvento));

create table MESSAGGIO (
     IdMessaggio char(1) not null,
     Contenuto char(1) not null,
     DataInvio char(1) not null,
     Letto char(1) not null,
     CF char(32),
     Mit_CF char(32) not null,
     constraint ID_MESSAGGIO_ID primary key (IdMessaggio));

create table UTENTE (
     CF char(32) not null,
     Cognome char(32) not null,
     Nome char(32) not null,
     DataDiNascita char(32) not null,
     Email char(32) not null,
     Username char(32) not null,
     Password char(32) not null,
     DataRegistrazione char(32) not null,
     Tipo char(1) not null,
     constraint ID_UTENTE_ID primary key (CF));


-- Constraints Section
-- ___________________ 

alter table BIGLIETTO add constraint REF_BIGLI_EVENT
     foreign key (IdEvento)
     references EVENTO;

alter table BIGLIETTO add constraint REF_BIGLI_UTENT_FK
     foreign key (CF)
     references UTENTE;

alter table EVENTO add constraint REF_EVENT_COMBA_1_FK
     foreign key (IdCombattente)
     references COMBATTENTE;

alter table EVENTO add constraint REF_EVENT_COMBA_FK
     foreign key (PAR_IdCombattente)
     references COMBATTENTE;

alter table EVENTO add constraint REF_EVENT_UTENT_FK
     foreign key (CF)
     references UTENTE;

alter table MESSAGGIO add constraint REF_MESSA_UTENT_1_FK
     foreign key (CF)
     references UTENTE;

alter table MESSAGGIO add constraint REF_MESSA_UTENT_FK
     foreign key (Mit_CF)
     references UTENTE;


-- Index Section
-- _____________ 

create unique index ID_BIGLIETTO_IND
     on BIGLIETTO (IdEvento, Numero);

create index REF_BIGLI_UTENT_IND
     on BIGLIETTO (CF);

create unique index ID_COMBATTENTE_IND
     on COMBATTENTE (IdCombattente);

create unique index ID_EVENTO_IND
     on EVENTO (IdEvento);

create index REF_EVENT_COMBA_1_IND
     on EVENTO (IdCombattente);

create index REF_EVENT_COMBA_IND
     on EVENTO (PAR_IdCombattente);

create index REF_EVENT_UTENT_IND
     on EVENTO (CF);

create unique index ID_MESSAGGIO_IND
     on MESSAGGIO (IdMessaggio);

create index REF_MESSA_UTENT_1_IND
     on MESSAGGIO (CF);

create index REF_MESSA_UTENT_IND
     on MESSAGGIO (Mit_CF);

create unique index ID_UTENTE_IND
     on UTENTE (CF);

