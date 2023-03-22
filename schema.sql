drop database gestion;
create database gestion;
\c gestion;
create table society(
		idSociety serial primary key,
		nom varchar(250),
		creation date not null default now(),
		fondateur varchar(150) not null,
		-- gestionCommerce varchar(30) not null,
		nif varchar(10) not null,
		logo varchar(250) not null,
		date_exercice date not null,
		status varchar(250) not null,
		telecopie varchar(20) not null,
		telephone varchar(20) not null
	);

	create table location(
		idlocation serial primary key,
		idsociety int not null,
		localisation varchar(150) not null,
		primaire boolean default true,
		foreign key(idsociety) references society(idSociety)
	);

alter table society add column description text not null;
alter table society add column nifPath varchar(250) not null;

create table devise(
	idDevise serial primary key,
	nom varchar(10)
);

create table users(
	idUser serial primary key,
	idSociety int not null,
	username varchar(250) not null,
	password varchar(250) default 'individuel',
	foreign key(idSociety) references society(idSociety)
);

create table exchange_rate(
	idExchange serial primary key,
	idOne int not null,
	idTwo int not null,
	rate double precision,
	foreign key(idOne) references devise(idDevise),
	foreign key(idTwo) references devise(idDevise)
);

create table plan(
	idPlan serial primary key,
	compte varchar(5) unique,
	libelle varchar(45)
);

create table tiers(
	-- Ireto ny compte 41
	idTiers serial primary key,
	Numero varchar(25) not null unique,
	libelle varchar(45) not null
);

create table journaux(
	idCode serial primary key,
	code varchar(10) not null unique,
	libelle varchar(45)
);

create table exercice(
	idExercice serial primary key,
	years INTEGER
);

create table ecriture(
	idEcriture serial primary key,
	dateEcriture timestamp,
	libelle varchar(45),
	idExercice int not null,
	foreign key( idExercice ) references exercice(idExercice)
);

create table operation (
	idOperation serial primary key,
	idEcriture int not null,
	-- dateOperation date not null,
	NumPiece varchar(20) not null,
	compte varchar(5) not null,
	tiers varchar(100),
	libelle varchar(35) not null,
	debit decimal default 0,
	credit decimal default 0,
	foreign key(compte) references plan(compte),
	foreign key(tiers) references tiers(Numero),
	foreign key(idEcriture) references ecriture(idEcriture)
);


create or replace view devises
	as

	select * 
	from exchange_rate as e
	join devise as d on e.idone = d.iddevise
	join devise as r on e.idtwo = r.iddevise;