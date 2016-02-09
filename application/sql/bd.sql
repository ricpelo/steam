
drop table if exists usuarios cascade;

create table usuarios(
    id bigserial constraint pk_usuarios primary key,
    nick varchar(100) not null constraint uq_usuarios_nick unique,
    password char(60) not null constraint ck_password_valida
                               check (length(password) = 60),
    email varchar(100) not null
);

drop table if exists ci_sessions cascade;

create table "ci_sessions" (
    "id" varchar(40) not null primary key,
    "ip_address" varchar(45) not null,
    "timestamp" bigint default 0 not null,
    "data" text default '' not null
);

create index "ci_sessions_timestamp" on "ci_sessions" ("timestamp");

drop table if exists juegos cascade;

create table juegos (
    id          bigserial constraint pk_juegos primary key,
    descripcion varchar(50) not null,
    precio      numeric(6,2) not null
);


insert into juegos (descripcion, precio)
        values  ('XCOM 2',49.99),
                ('Rise of the Tomb Raider',45),
                ('Rainbow Six Siege',60),
                ('Grand Theft Auto V',50),
                ('Call of Duty: Black Ops III',50),
                ('Wild HuntThe Witcher 3: Wild Hunt',50);

insert into usuarios(nick, password, email)
values('admin', crypt('admin', gen_salt('bf')), 'guillermo.lopez@iesdonana.org'),
      ('pepe', crypt('pepe', gen_salt('bf')), 'guillermo.lopez@iesdonana.org'),
      ('juan', crypt('juan', gen_salt('bf')), 'guillermo.lopez@iesdonana.org'),
      ('guillermo', crypt('guillermo', gen_salt('bf')), 'guillermo.lopez@iesdonana.org');

create table valoraciones (
    id_juego    bigint    constraint fk_juegos_valoraciones references juegos(id),
    id_usuario  bigint    constraint fk_usuarios_valoraciones references usuarios(id),
    valoracion  numeric(1) constraint ck_valoraciones_max
                                        check (valoracion > 0 AND valoracion < 6),
    constraint pk_valoraciones primary key (id_juego, id_usuario)
);

insert into valoraciones (id_usuario, id_juego, valoracion)
        values (2, 1, 3),
               (3, 5, 1),
               (4, 3, 2),
               (2, 2, 3),
               (3, 2, 4),
               (4, 4, 5);
