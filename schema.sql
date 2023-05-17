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
	idcode int not null,
	foreign key( idExercice ) references exercice(idExercice),
	foreign key( idcode ) references journaux(idcode)
);

create table operation (
	idOperation serial primary key,
	idEcriture int not null,
	-- dateOperation date not null,
	NumPiece varchar(20) not null,
	compte varchar(5) not null,
	tiers varchar(100) null,
	libelle varchar(35) not null,
	debit decimal default 0,
	credit decimal default 0,
	foreign key(compte) references plan(compte),
	foreign key(tiers) references tiers(Numero),
	foreign key(idEcriture) references ecriture(idEcriture)
);

create table reference(

	idReference serial primary key,
	code varchar(10) unique,
	libelle varchar(45)
);


--create or replace view devises
	--as
	--select * 
	--from exchange_rate as e
	--join devise as d on e.idone = d.iddevise
	--join devise as r on e.idtwo = r.iddevise ;


create or replace view balance
	as 
	select                
		operation.compte,
		plan.libelle as intitule,
		COALESCE(sum(operation.debit),0) as debit,
		COALESCE(sum(operation.credit),0) as credit,
		COALESCE(SUM(operation.debit), 0) - COALESCE(SUM(operation.credit), 0) as solde
	from operation
	join plan on plan.compte=operation.compte
	group by operation.compte,plan.libelle;


-- Insérer des données de test dans la table "ecriture"
INSERT INTO ecriture (dateEcriture, libelle, idExercice, idcode) VALUES
  ('2022-01-01 10:00:00', 'Achat de matériel', 1, 1),
  ('2022-01-02 14:30:00', 'Vente de marchandises', 1, 2),
  ('2022-01-03 09:15:00', 'Paiement d''une facture', 1, 3),
  ('2022-01-04 16:45:00', 'Encaissement d''un chèque', 1, 4),
  ('2022-01-05 11:20:00', 'Règlement d''un fournisseur', 1, 5),
  ('2022-01-06 13:00:00', 'Remboursement d''un prêt', 1, 6),
  ('2022-01-07 15:45:00', 'Versement de salaires', 1, 7),
  ('2022-01-08 10:30:00', 'Dépôt de fonds en banque', 1, 8);


INSERT INTO operation (idEcriture, NumPiece, compte, tiers, libelle, debit, credit) VALUES
    (41, 'AC00001', '60100', 'MENDRIKA', 'Achat rofia', 100000, 0),
    (41, 'AC00001', '44560', 'MENDRIKA', 'TVA DEDUCTIBLE', 20000, 0),
    (41, 'AC00001', '40310', 'MENDRIKA', 'Fournisseurs', 0, 120000),
	(41, 'AC00001', '53100', 'MENDRIKA', 'Retrait caisse', 120000,0),
    (41, 'AC00001', '40310', 'MENDRIKA', 'Fournisseurs',120000,0),
	(42, 'VE00015', '70110', 'NORO', 'Vente panier', 0,30000),
    (42, 'VE00015', '44570', 'NORO', 'TVA A VERSE',0, 6000),
    (42, 'VE00015', '41110', 'NORO', 'Client',36000,0),
	(42, 'VE00015', '51201', 'NORO', 'Retrait banque BOA',0,36000),
    (42, 'VE00015', '41110', 'NORO', 'Client',36000,0),
    (44, 'AN00009', '10100', 'RABE', 'Report à nouveau', 0,500000),
	(44, 'AN00009', '53100', 'RABE', 'Capital', 500000,0),
    (45, 'BN00012', '21300', 'JIRAMA', 'Achat de materiels', 10000, 0),
    (45, 'BN00012', '51202', 'JIRAMA', 'Retrait bancaire', 0,10000),
    (46, 'OD00015', '51201', 'RANDRIA', 'Retrait achat de mais', 0,20000),
    (46, 'OD00015', '35500', 'RANDRIA', 'Ajout stocks',20000, 0);


--CAPITAUX PROPRES
CREATE OR REPLACE VIEW CAPITAUX_PROPRES as 
select plan.compte,plan.libelle,sum(solde) as solde
		from balance
		join plan on balance.compte=plan.compte
		where balance.compte like '10%' 
		or balance.compte like '11%' 
		or balance.compte like '12%' 
		group by plan.libelle,plan.compte; 

--PASSIF courants
CREATE OR REPLACE VIEW PASSIFS_COURANTS as 
select plan.compte,plan.libelle,sum(solde) as solde
		from balance
		join plan on balance.compte=plan.compte
		where balance.compte like '40%' 
		or balance.compte like '42%' 
		or balance.compte like '44%' 
		group by plan.libelle,plan.compte;

--PASSIFS NON courants
CREATE OR REPLACE VIEW PASSIFS_NON_COURANTS as 
select plan.compte,plan.libelle,sum(balance.solde) as solde
		from balance
	left join 
	CAPITAUX_PROPRES 
	on CAPITAUX_PROPRES.compte=balance.compte 
	join plan on balance.compte=plan.compte
	where balance.compte like '1%' 
	and CAPITAUX_PROPRES.compte is null
	 group by plan.libelle,plan.compte;

--ACTIFS COURANTS 
CREATE OR REPLACE VIEW ACTIFS_COURANTS as 
select plan.compte,plan.libelle,sum(solde) as solde 
		from balance
		join plan on balance.compte=plan.compte
		where balance.compte like '3%' 
		or balance.compte like '5%'
		group by plan.libelle,plan.compte
UNION 
	select plan.compte,plan.libelle,sum(balance.solde) as solde
		from balance
	left join 
	PASSIFS_COURANTS
	on PASSIFS_COURANTS.compte=balance.compte 
	join plan on balance.compte=plan.compte
	where balance.compte like '4%' 
	and PASSIFS_COURANTS.compte is null
	group by plan.libelle,plan.compte;


--ACTIFS NON-COURANTS
CREATE OR REPLACE VIEW ACTIFS_NON_COURANTS as 
select plan.compte,plan.libelle,sum(solde) as solde
		from balance
		join plan on balance.compte=plan.compte
		where balance.compte like '2%' 
		group by plan.libelle,plan.compte;

--Solde passifs
CREATE OR REPLACE VIEW solde_passifs as 
SELECT (
  SELECT COALESCE(SUM(solde), 0) FROM capitaux_propres
) + (
  SELECT COALESCE(SUM(solde), 0) FROM passifs_courants
) + (
  SELECT COALESCE(SUM(solde), 0) FROM passifs_non_courants
) AS solde;

--Solde actifs
CREATE OR REPLACE VIEW solde_actifs as 
SELECT(
  SELECT COALESCE(SUM(solde), 0) FROM actifs_courants
) + (
  SELECT COALESCE(SUM(solde), 0) FROM actifs_non_courants
) AS solde;

--charges
CREATE OR REPLACE VIEW CHARGES as 
select plan.compte,plan.libelle,sum(solde) as solde
		from balance
		join plan on balance.compte=plan.compte
		where balance.compte like '6%' 
		group by plan.libelle,plan.compte;

--PRODUITS
CREATE OR REPLACE VIEW PRODUITS as 
select plan.compte,plan.libelle,sum(solde) as solde
		from balance
		join plan on balance.compte=plan.compte
		where balance.compte like '7%' 
		group by plan.libelle,plan.compte;

--compte de resultats
CREATE OR REPLACE VIEW resultats as
SELECT(
  SELECT COALESCE(SUM(solde), 0) FROM CHARGES
) + (
  SELECT COALESCE(SUM(solde), 0) FROM PRODUITS
) AS resultats;




create or replace view journauxs 
	as
	Select j.* ,
				e.idEcriture,e.libelle as ecriture, e.dateecriture, e.idexercice,
				op.idoperation, op.numpiece, op.compte, op.tiers, op.debit, op.credit
	from journaux as j
	join ecriture as e
	on j.idCode = e.idCode
	join operation as op
	on e.idEcriture = op.idEcriture;

create or replace view jourC
	as
	select j.*,
		p.idplan , p.libelle as comptes
	from journauxs as j
	join plan as p
	on j.compte = p.compte;

