CREATE TABLE IF NOT EXISTS team  (
	id INT,
	first_name VARCHAR(64),
	last_name VARCHAR(64),
	role VARCHAR(32),
	photo VARCHAR(255),
	description VARCHAR(255),
	created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT  CURRENT_TIMESTAMP
);


CREATE SEQUENCE public.team_id_seq
    INCREMENT 1
    START 1
    MINVALUE 1
    MAXVALUE 9223372036854775807
    CACHE 1;

ALTER SEQUENCE public.team_id_seq OWNER TO dominik;


insert into team (id, first_name, last_name, role, photo, description) values (1, 'Angelo', 'Abear', 'CEO', 'angelo-abear-XUMb1TaojwY.jpg', 'Partial loss of teeth, unspecified cause, unspecified class');
insert into team (id, first_name, last_name, role, photo, description) values (2, 'Barna', 'Bartis', 'Managing Director', 'barna-bartis-2x3vfVxwR7o.jpg', 'Animal-rider injured in other transport accident, sequela');
insert into team (id, first_name, last_name, role, photo, description) values (3, 'Carlos', 'Magno', 'Founder', 'carlos-magno-sTORW_4vrwg.jpg', 'Other diseases of lip and oral mucosa');
insert into team (id, first_name, last_name, role, photo, description) values (4, 'Christian', 'Buehner', 'Web Developer II', 'christian-buehner-DItYlc26zVI.jpg', 'Insect bite (nonvenomous) of left front wall of thorax');
insert into team (id, first_name, last_name, role, photo, description) values (5, 'Xaen', 'Ascllo', 'Web Developer II', 'disruptivo-Xaen-acsLLo.jpg', 'War op w explosn of sea-based artlry shell, civ, sequela');
insert into team (id, first_name, last_name, role, photo, description) values (6, 'Dimtry', 'Vechorko', 'Editor', 'dmitry-vechorko-uQP6mJ5x9Oo.jpg', 'Toxic effect of oth inorganic substances, assault, init');
insert into team (id, first_name, last_name, role, photo, description) values (7, 'Yion', 'Lee', 'Editor', 'mister-lee-_KL3FFG4eBA.jpg', 'Other superficial bite of left upper arm');
insert into team (id, first_name, last_name, role, photo, description) values (8, 'Ryan', 'Mill', 'Media Designer', 'rayan-mill-AGlO2jlVE4c.jpg', 'Herpesviral gingivostomatitis and pharyngotonsillitis');
insert into team (id, first_name, last_name, role, photo, description) values (9, 'Yousaf', 'Usman', 'Media Designer', 'usman-yousaf-isA_U8EDIZc.jpg', 'Mtrcy driver injured in nonclsn trnsp accident nontraf, subs');
insert into team (id, first_name, last_name, role, photo, description) values (10, 'Vladyslav', 'Tyzun', 'CEO', 'vladyslav-tyzun-B_gJt-6xK30.jpg', 'Unsp injury of posterior tibial artery, right leg, subs');