create table Produit(
idProduit SERIAL primary key,
nomProduit VARCHAR not null,
volume int not null default 0,
prix double precision not null default 0
);

create table centre(
idCentre SERIAL primary key,
nomCentre VARCHAR not null,
id_type_centre int,
FOREIGN KEY(id_type_centre) references type_centre(id)
);


create table cout(
    id SERIAL primary key,
    idProduit INT,
    fixe double precision not null default 0,
    variable double precision not null default 0,
    idCentre int,
    idCharge varchar(5),
    date_operation date,
    montant double precision not null default 0,
    foreign key(idProduit) references produit(idProduit),
    foreign key(idCentre) references Centre(idCentre),
    foreign key(idCharge) references plan(compte)
);

create table pourcentage_produit(
    id serial primary key,
    idproduit int,
    idcharge varchar(5),
    pourcentage double precision not null default 0,
    foreign key(idproduit) references produit(idproduit),
    foreign key(idCharge) references plan(compte)
);

create table pourcentage_centre(
    id serial primary key,
    idproduit int,
    idcharge varchar(5),
    idCentre int,
    pourcentage double precision not null default 0,
    foreign key(idproduit) references produit(idproduit),
    foreign key(idCharge) references plan(compte),
    foreign key(idCentre) references Centre(idCentre)
);

create view produit_centre as 
    select 
    pourcentage_centre.idproduit,
    produit.nomProduit,
    produit.prix,
    produit.volume,
    pourcentage_centre.idcentre,
    centre.nomCentre,
    pourcentage_centre.idcharge,
    pourcentage_produit.pourcentage as pourcentage_produit,
    pourcentage_centre.pourcentage as pourcentage_centre
    from pourcentage_centre 
    join pourcentage_produit 
    on pourcentage_centre.idproduit=pourcentage_produit.idproduit and pourcentage_centre.idcharge=pourcentage_produit.idcharge 
    join centre on centre.idcentre=pourcentage_centre.idcentre
    join produit on produit.idproduit=pourcentage_centre.idproduit;

create view produit_present as 
select idcharge,produit.*
    from pourcentage_centre
    join produit
    on produit.idproduit=pourcentage_centre.idproduit 
    group by produit.idproduit,produit.nomproduit,produit.volume,produit.prix,idcharge;

create table type_centre
(
id serial primary key,
nom varchar(50)
);
