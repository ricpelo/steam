
drop table if exists usuarios;

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
    codigo      numeric(13) not null constraint uq_juegos_codigo unique,
    descripcion varchar(50) not null,
    precio      numeric (6,2) not null,
    existencias int
);

insert into articulos (codigo, descripcion, precio, existencias)
        values  (1123456789012,'XCOM 2',50.00,10),
                (1133456789012,'Rise of the Tomb Raider',45.00,20),
                (1143456789012,'Rainbow Six Siege',60.00,15),
                (1153456789012,'Grand Theft Auto V',50.00,23),
                (1163456789012,'Call of Duty: Black Ops IIICall of Duty: Black Ops III',50.00,12),
                (1173456789012,'The Witcher 3: Wild HuntThe Witcher 3: Wild Hunt',50.00,12);


