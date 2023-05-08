-- ilay karazana fonction/departement/centre
create table fonction(
idfonction int primary key,
nomFonction varchar(50)
);
-- ilay karazana produit vokarina
create table produit(
idproduit int primary key,
nomProduit varchar(50),
prix decimal(6,2)
);

-- ilay coefficient par produit ho an'ny compte iray  
create table coeffproduit(
idcoeffproduit serial primary key,
idCompte int,
idproduit int,
pourcentage double precision,	
Foreign KEY(idproduit) references produit(idproduit),
Foreign KEY(idcompte) references plan(idplan),
);

-- ilay coefficient par fonction ho an'ny compte iray 
create table coefffonction(
idcoefffonction serial primary key,
idproduit int,
idfonction int,
pourcentage double precision,
idcompte int,
Foreign KEY(idproduit) references produit(idproduit),
Foreign KEY(idcompte) references plan(idplan),
Foreign KEY(idfonction) references fonction(idfonction)
);

-- ilay coefficient par nature ho an'ny compte iray 
create table coeffnature(
idcoeffnature serial primary key,
idfonction int,
idcompte int,
nature varchar(1),
pourcentage double precision,
Foreign KEY(idcompte) references plan(idplan),
Foreign KEY(idfonction) references fonction(idfonction)
);

-- izay charges incorporables/suppletive calculées par produit ho an'ny ecriture iray 
Create table coutproduit (
idproduit int,
idoperation int,
somme double precision,
Foreign KEY(idproduit) references produit(idproduit),
foreign key(idoperation) references operation(idoperation)
);

-- izay charges incorporables/suppletive calculées par nature ho an'ny ecriture iray 
create table coutnature(
idproduit int,
idfonction int,
nature varchar(1),
somme double precision,
idoperation int,
Foreign KEY(idproduit) references produit(idproduit),
foreign key(idoperation) references operation(idoperation),
Foreign KEY(idfonction) references fonction(idfonction)
);
-- izay charges incorporables/suppletive calculées par fonction ho an'ny ecriture iray 
create table coutfonction(
idproduit int,
idfonction int,
somme double precision,
idoperation int,
Foreign KEY(idproduit) references produit(idproduit),
foreign key(idoperation) references operation(idoperation),
Foreign KEY(idfonction) references fonction(idfonction)
);

--Avy eo manao view mapitambatra ny operation sy ny cout ahitana ny compte apiasainy(ilaina @ilay coefficient) sy ny dateny(raha ilaina) dia afaka micalcule ny somme en fonction an'ilay coefficient
-- Iny avy eo no anaovana ny calcul mcv dia ny nb produit=mcv/prixunitaire
-- Dia ilay resaka CHARGES ANALYTIQUES = CHARGES DE LA COMPTABILITE GENERALE (balance) - CHARGES NON INCORPORABLES + CHARGES SUPPLETIVES
--Charges rehetra ao amin'ny balance + charges rehetra ao amin'ny cout par produit analana an'izay charges rehetra ao amin'ny balance nefa tsy ao amin'ny coutproduit
-- Ilay cout par nature/par produit/par centre efa ao amin'ilay table fotsiny sisa no manao select where