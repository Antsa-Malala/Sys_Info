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
	numeroCompte varchar(10) not null primary key,
	libelle varchar(100)
);

create table tiers(
	idTiers serial primary key, 
	idCompte varchar(10) not null,
	Numero varchar(100) not null ,
	libelle varchar(200) not null,
	foreign key( idCompte ) references plan(numeroCompte)
);

create table journaux(
	code varchar(10) not null primary key,
	libelle varchar(150),
);
