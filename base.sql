create table Produit(
idProduit SERIAL primary key,
nomProduit VARCHAR not null,
volume int not null default 0,
prix double precision not null default 0
);

create table centre(
idCentre SERIAL primary key,
nomCentre VARCHAR not null
);

create table Nature(
idNature SERIAL primary key,
nomNature VARCHAR not null
);

create table cout(
id SERIAL primary key,
idProduit INT,
idNature int,
idCentre int,
idCharge int,
montant double precision not null default 0,
foreign key(idProduit) references produit(idProduit),
foreign key(idNature) references Nature(idNature),
foreign key(idCentre) references Centre(idCentre),
foreign key(idCharge) references plan(idplan)
);

create table pourcentage_produit{
    id serial primary key,
    idproduit int,
    idcharge int,
    pourcentage double precision not null default 0,
    foreign key(idproduit) references produit(idproduit),
    foreign key(idCharge) references plan(compte)
}

create table pourcentage_centre{
    id serial primary key,
    idproduit int,
    idcharge int,
    idCentre int,
    pourcentage double precision not null default 0,
    foreign key(idproduit) references produit(idproduit),
    foreign key idCharge references plan(idplan),
    foreign key idCentre references Centre(idCentre)
}
