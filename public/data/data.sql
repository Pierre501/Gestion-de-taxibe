insert into versements values(default, 'Versement minumum 22 places', 40000, '2022-09-07 05:02:48', '2022-09-07 05:02:48');
insert into versements values(default, 'Versement minumum 30 places', 60000, '2022-09-07 05:02:48', '2022-09-07 05:02:48');

insert into vehicules values(default, 1, '1234TBA', 'Mercedes', 'Sprinter', 0, 22, '2022-09-05 05:02:48', '2022-09-05 05:02:48');
insert into vehicules values(default, 1, '9908TDD', 'Mercedes', 'Sprinter', 0, 22, '2022-09-05 05:02:48', '2022-09-05 05:02:48');
insert into vehicules values(default, 2, '8823TDA', 'Mercedes', 'Sprinter', 0, 30, '2022-09-05 05:02:48', '2022-09-05 05:02:48');
insert into vehicules values(default, 2, '1145TAA', 'Mercedes', 'Sprinter', 0, 30, '2022-09-05 05:02:48', '2022-09-05 05:02:48');
insert into vehicules values(default, 2, '7849TBD', 'Mercedes', 'Sprinter', 0, 30, '2022-09-05 05:02:48', '2022-09-05 05:02:48');
insert into vehicules values(default, 1, '4555TBB', 'Mercedes', 'Sprinter', 0, 22, '2022-09-05 05:02:48', '2022-09-05 05:02:48');

insert into garages values(default, 1, 0, '2022-09-05 05:02:48', '2022-09-05 05:02:48');
insert into garages values(default, 2, 0, '2022-09-05 05:02:48', '2022-09-05 05:02:48');
insert into garages values(default, 3, 0, '2022-09-05 05:02:48', '2022-09-05 05:02:48');
insert into garages values(default, 4, 0, '2022-09-05 05:02:48', '2022-09-05 05:02:48');
insert into garages values(default, 5, 0, '2022-09-05 05:02:48', '2022-09-05 05:02:48');
insert into garages values(default, 6, 0, '2022-09-05 05:02:48', '2022-09-05 05:02:48');

insert into trajets values(default, 1, 6, '2022-09-07 05:02:48', '2022-09-07 05:02:48');
insert into trajets values(default, 1, 1, '2022-09-05 05:02:48', '2022-09-05 05:02:48');
insert into trajets values(default, 1, 1, '2022-09-04 05:02:48', '2022-09-04 05:02:48');
insert into trajets values(default, 1, 1, '2022-09-03 05:02:48', '2022-09-03 05:02:48');

insert into details_trajets values(default, 4, 90, 60000, 2500, '2022-09-07 05:02:48', '2022-09-07 05:02:48');
insert into details_trajets values(default, 5, 40, 40000, 1500, '2022-09-05 05:02:48', '2022-09-05 05:02:48');

insert into salaires values(default, 4, 12000, 'green', '2022-09-07 05:02:48', '2022-09-07 05:02:48');
insert into salaires values(default, 5, 4000, 'yellow', '2022-09-05 05:02:48', '2022-09-05 05:02:48');


insert into parametres values(default, 'Pourcentage minumum', 10, '2022-09-07 05:02:48', '2022-09-07 05:02:48');
insert into parametres values(default, 'Pourcentage moyenne', 20, '2022-09-07 05:02:48', '2022-09-07 05:02:48');


insert into calendriers values(default, '09', '2022', '2022-09-01', '2022-09-30');
insert into calendriers values(default, '10', '2022', '2022-10-01', '2022-10-31');
insert into calendriers values(default, '11', '2022', '2022-11-01', '2022-11-30');
insert into calendriers values(default, '12', '2022', '2022-12-01', '2022-12-31');

create view vehiculeEnTrajet as select
    users.name,
    users.tel,
    vehicules.matricule,
    vehicules.marque,
    vehicules.model,
    vehicules.etat,
    date(trajets.created_at) as created_at
from users join trajets on users.id = trajets.users_id
join vehicules on trajets.vehicules_id = vehicules.id;

create view verificationChauffeurEnTrajet as select * , date(created_at) as date_creation from trajets;

create view verificationDetailsTrajets as select 
    trajets.id,
    trajets.users_id,
    trajets.vehicules_id,
    details_trajets.kilometre_effectue,
    details_trajets.montant_recette,
    details_trajets.montant_carburant,
    date(details_trajets.created_at) as dateCreation
from trajets join details_trajets on trajets.id = details_trajets.trajets_id;

create view listeSalaire as select 
    vehicules.matricule,
    verificationDetailsTrajets.users_id,
    verificationDetailsTrajets.kilometre_effectue,
    verificationDetailsTrajets.montant_recette,
    verificationDetailsTrajets.montant_carburant,
    salaires.montant_salaire,
    date(salaires.created_at) dateSalaire
from vehicules join verificationDetailsTrajets on vehicules.id = verificationDetailsTrajets.vehicules_id 
join salaires on verificationDetailsTrajets.id = salaires.trajets_id;
