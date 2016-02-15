
drop table if exists usuarios cascade;

create table roles (
    id bigserial constraint pk_roles primary key,
    descripcion varchar(15)
);

create table usuarios(
    id bigserial constraint pk_usuarios primary key,
    nick varchar(100) not null constraint uq_usuarios_nick unique,
    password char(60) not null constraint ck_password_valida
                               check (length(password) = 60),
    email varchar(100) not null,
    registro_verificado bool not null default false,
    rol_id bigint not null constraint fk_usuarios_roles
                  references roles(id) on delete no action
                  on update cascade
);

drop table if exists tokens cascade;

create table tokens (
    usuario_id bigint   constraint pk_tokens primary key
                        constraint fk_tokens_usuarios references usuarios (id),
    token      char(32) not null
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

insert into roles (descripcion)
values('administrador'),
      ('registrado');

insert into usuarios(nick, password, email, registro_verificado, rol_id)
values('admin', crypt('admin', gen_salt('bf')), 'guillermo.lopez@iesdonana.org', true, 1),
      ('pepe', crypt('pepe', gen_salt('bf')), 'guillermo.lopez@iesdonana.org', true, 2),
      ('juan', crypt('juan', gen_salt('bf')), 'guillermo.lopez@iesdonana.org', true, 2),
      ('guillermo', crypt('guillermo', gen_salt('bf')), 'guillermo.lopez@iesdonana.org', true, 2);

drop table if exists valoraciones;

create table valoraciones (
    id_juego    bigint    constraint fk_juegos_valoraciones references juegos(id)
                            on update cascade on delete cascade,
    id_usuario  bigint    constraint fk_usuarios_valoraciones references usuarios(id),
    valoracion  numeric(1) constraint ck_valoraciones_max
                                        check (valoracion >= 1 AND valoracion <= 5),
    constraint pk_valoraciones primary key (id_juego, id_usuario)
);

insert into valoraciones (id_usuario, id_juego, valoracion)
        values (2, 1, 3),
               (3, 5, 1),
               (4, 3, 2),
               (2, 2, 3),
               (3, 2, 4),
               (4, 4, 5);

drop view if exists v_juegos;

create view v_juegos as
    select j.*, round(avg(valoracion), 1) as valoracion
      from juegos j  left join valoraciones v on id = id_juego
  group by id;


drop table if exists comentarios cascade;

create table comentarios (
  id      bigserial       constraint pk_comentarios primary key,
  autor   bigint          not null constraint fk_usuarios references usuarios (id),
  comentario varchar(150) not null,
  fecha   date            not null default CURRENT_DATE,
  padre_comentario   bigint  constraint fk_comentarios_padre
                          references comentarios (id) ,
  padre_juego        bigint not null constraint fk_comentarios_padre_juego
                          references juegos (id)
);

create view v_usuarios_valido as
    select * from usuarios where registro_verificado = true;
