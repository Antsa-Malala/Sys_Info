create table facture(
	idFacture serial primary key,
	idsociety int,
	dateFacture date not null,
	reference varchar(30),
	numeroFacture varchar(15),
	objet_facture varchar(50),
	foreign key(idsociety) references society(idsociety)
);
create table detailFacture(
	idFacture int,
	designation varchar(50),
	unite varchar(20),
	nombre double precision default 0,
	prix_unitaire double precision default 0,
	foreign key(idFacture) references facture(idFacture)
);

create table sommeFacture(
	idFacture int,
	tva double precision default 0,
	avance double precision default 0,
	foreign key(idFacture) references facture(idFacture)
);

create view vDetailsFacture as 
	select 
	detailFacture.*,nombre*prix_unitaire as montant
	from detailFacture;

create view vSommeFacture as 
	select 
	vDetailsFacture.idFacture,
	sum(vDetailsFacture.montant) as ht,
	sommeFacture.tva,
	sum(vDetailsFacture.montant)+(sum(vDetailsFacture.montant)*sommeFacture.tva/100) as ttc,
	sommeFacture.avance,
	sum(vDetailsFacture.montant)+(sum(vDetailsFacture.montant)*sommeFacture.tva/100) - sommeFacture.avance as net_a_payer,
	sum(vDetailsFacture.montant)+(sum(vDetailsFacture.montant)*sommeFacture.tva/100) as arrete
	from vDetailsFacture
	join sommeFacture on vDetailsFacture.idFacture=sommeFacture.idFacture 
	group by vDetailsFacture.idFacture,vDetailsFacture.montant,sommeFacture.tva,sommeFacture.avance;
