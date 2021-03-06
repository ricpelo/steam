drop table if exists roles cascade;

create table roles (
    id bigserial constraint pk_roles primary key,
    descripcion varchar(15)
);

drop table if exists usuarios cascade;

create table usuarios(
    id                  bigserial             constraint pk_usuarios primary key,
    nick                varchar(100) not null constraint uq_usuarios_nick unique,
    password            char(60)     not null constraint ck_password_valida
                                              check (length(password) = 60),
    email               varchar(100) not null,
    registro_verificado bool         not null default false,
    rol_id              bigint       not null default 2 constraint fk_usuarios_roles
                                                        references roles(id)
                                                        on delete no action
                                                        on update cascade,
    activado            bool         not null default true
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

drop table if exists generos cascade;

create table generos(
    id bigserial constraint pk_generos primary key,
    nombre varchar(100) not null
);

drop table if exists juegos cascade;

create table juegos (
    id           bigserial constraint pk_juegos primary key,
    nombre       varchar(50) not null,
    precio       numeric(6,2) not null,
    fecha_salida date not null default current_date,
    resumen      text not null,
    descripcion  text not null,
    genero_id       bigint constraint fk_juegos_generos references generos (id)
);

drop table if exists valoraciones cascade;

create table valoraciones (
    id_juego    bigint    constraint fk_juegos_valoraciones references juegos(id)
                          on update cascade on delete cascade,
    id_usuario  bigint    constraint fk_usuarios_valoraciones references usuarios(id)
                          on update cascade on delete cascade,
    valoracion  numeric(1) constraint ck_valoraciones_max
                                        check (valoracion >= 1 AND valoracion <= 5),
    constraint pk_valoraciones primary key (id_juego, id_usuario)
);

drop table if exists comentarios cascade;

create table comentarios (
  id      bigserial       constraint pk_comentarios primary key,
  autor   bigint          not null constraint fk_usuarios references usuarios (id)
                          on update cascade on delete no action,
  contenido varchar(150)  not null,
  created_at   timestamp  not null default CURRENT_TIMESTAMP,
  padre_comentario   bigint  constraint fk_comentarios_padre
                          references comentarios (id) ,
  padre_juego        bigint not null constraint fk_comentarios_padre_juego
                          references juegos (id)
);

drop table if exists carrito_compra cascade;

create table carrito_compra(
    id_usuario bigint constraint fk_usuarios_carrito_compra references usuarios(id)
                      on update cascade on delete cascade,
    id_juego bigint   constraint fk_juegos_carrito_compra references juegos(id)
                      on update cascade on delete cascade,
    constraint pk_carrito_compra primary key (id_juego, id_usuario)
);

insert into generos(nombre)
    values('Acción'),
          ('Arcade'),
          ('Estrategia');

insert into juegos (nombre, precio, resumen, descripcion, fecha_salida, genero_id)
        values  ('XCOM 2',49.99,
                    'XCOM 2 es la secuela de XCOM: Enemy Unknown, el galardonado
                    juego de estrategia que fue nombrado Juego del Año en 2012.',
                    'La Tierra ha cambiado. Han pasado veinte años desde que los
líderes mundiales se rindieran incondicionalmente ante las fuerzas alienígenas.
XCOM, la última defensa del planeta, acabó destrozada y dispersa. Ahora, en XCOM
2, los alienígenas dominan la Tierra y construyen resplandecientes ciudades que
prometen un futuro brillante para la humanidad mientras esconden siniestros planes
y eliminan a todos los opositores a su nuevo orden.
                    Solo quienes viven en los límites de la sociedad tienen un
margen de libertad. Allí vuelve a reunirse una fuerza para luchar por la humanidad.
Siempre a la fuga y con todo en su contra, las fuerzas restantes de XCOM deben
encontrar el modo de avivar una resistencia global y eliminar la amenaza alienígena
de una vez por todas.', '2016-02-15'::date, 3),
                ('Rise of the Tomb Raider',45,
'Tomb Raider se reinventa en un juego que narra la primera aventura de Lara.',
'Tomb Raider se reinventa en un juego que narra la primera aventura de Lara.
No nos encontraremos con la Lara madura, segura de si misma y experimentada de
juegos anteriores, sino con una niña de apenas 20 años que ha sobrevivido a un
misterioso naufragio y tendrá que escapar de una isla llena de peligros.
Una aventura que reinventa Tomb Raider haciéndolo más intenso y cinemático,
en la que Lara tendrá que aprender las habilidades que la convertirán en la
gran aventurera que hemos conocido.', '2016-01-25'::date, 1),
            ('Rainbow Six Siege',60, 'Tom Clancys Rainbow Six Siege es la nueva
entrega del shooter más aclamado desarrollado por el estudio Ubisoft Montreal.',
'Inspirado en el realismo de las actividades de contención terrorista que se desarrollan
alrededor del planeta, Tom Clancys Rainbow Six Siege, invita al jugador a controlar el
arte de la destrucción: Intensos enfrentamientos en espacios cerrados, combates letales,
enfrentamientos tácticos, trabajo en equipo y una acción frenética, son los pilares de la
experiencia.
El modo multijugador de Tom Clancys Rainbow Six Siege, sube un peldaño más en el intenso y
frenético tiroteo táctico, consolidando los pilares tradicionales de la franquicia', '2016-01-01'::date, 3),
                ('Grand Theft Auto V',50,
'Grand Theft Auto V aprovechará al máximo la potencia del PC para ofrecer mejoras de
todo tipo, que incluyen resolución y detalle gráfico incrementados, tráfico más denso,
mayor distancia visual, IA mejorada, nueva fauna y avanzados efectos de clima y daño,
para crear la experiencia de mundo abierto definitiva.',
'Grand Theft Auto V aprovechará al máximo la potencia del PC para ofrecer
mejoras de todo tipo, que incluyen resolución y detalle gráfico incrementados,
tráfico más denso, mayor distancia visual, IA mejorada, nueva fauna y avanzados
efectos de clima y daño, para crear la experiencia de mundo abierto definitiva.

Los Santos, una extensa y soleada metrópolis llena de gurús de autoayuda,
aspirantes a estrellas y famosos en decadencia, en su día la envidia del mundo
occidental, lucha ahora por mantenerse a flote en una era de incertidumbre
económica y "realities" baratos. En medio de la confusión, tres criminales
muy diferentes lo arriesgarán todo en una serie de atrevidos y peligrosos
atracos que marcarán sus vidas.', '2015-11-02', 1),
                ('Call of Duty: Black Ops III',50,'Tom Clancys Rainbow Six Siege es la nueva
entrega del shooter más aclamado desarrollado por el estudio Ubisoft Montreal.',
'Inspirado en el realismo de las actividades de contención terrorista que se desarrollan
alrededor del planeta, Tom Clancys Rainbow Six Siege, invita al jugador a controlar el
arte de la destrucción: Intensos enfrentamientos en espacios cerrados, combates letales,
enfrentamientos tácticos, trabajo en equipo y una acción frenética, son los pilares de la
experiencia.
El modo multijugador de Tom Clancys Rainbow Six Siege, sube un peldaño más en el intenso y
frenético tiroteo táctico, consolidando los pilares tradicionales de la franquicia', '2016-01-01'::date, 3),
                ('Wild HuntThe Witcher 3: Wild Hunt',50,'Tom Clancys Rainbow Six Siege es la nueva
entrega del shooter más aclamado desarrollado por el estudio Ubisoft Montreal.',
'Inspirado en el realismo de las actividades de contención terrorista que se desarrollan
alrededor del planeta, Tom Clancys Rainbow Six Siege, invita al jugador a controlar el
arte de la destrucción: Intensos enfrentamientos en espacios cerrados, combates letales,
enfrentamientos tácticos, trabajo en equipo y una acción frenética, son los pilares de la
experiencia.
El modo multijugador de Tom Clancys Rainbow Six Siege, sube un peldaño más en el intenso y
frenético tiroteo táctico, consolidando los pilares tradicionales de la franquicia', '2015-12-12'::date, 1),
('FarCry Primal', 59.99, 'La aclamada serie Far Cry ha pasado por el trópico y el Himalaya y ahora entra
     en la era de la lucha por la supervivencia', 'La aclamada serie Far Cry ha pasado por el trópico y el Himalaya y ahora entra
     en la era de la lucha por la supervivencia de la raza humana con su innovador mundo abierto, bestias enormes,
      entornos impactantes y encuentros salvajes impredecibles.
Bienvenido a la Edad de Piedra, una época de peligros extremos y aventuras sin límite. Cuando los mamuts gigantes
y los tigres dientes de sable dominaban la Tierra y la humanidad estaba en la cola de la cadena alimentaria.', '2016-03-01'::date, 3),
('Bus Simulator 2016', 30, 'Gana la batalla diaria contra el reloj: conviértete en conductor de autobús. ',
'En Bus Simulator 16 encontrarás seis autobuses urbanos reproducidos con gran realismo, incluyendo dos autobuses
Lion’s City con licencia de MAN y un mundo gigantesco libremente accesible. Lleva a tus pasajeros a tiempo y sanos
y salvos hasta su destino a través de cinco auténticos distritos.', '2016-03-02'::date, 2),
('WWE 2K16', 49.99, '¡La autoridad en videojuegos de la WWE regresa con WWE 2K16!',
'¡La autoridad en videojuegos de la WWE regresa con WWE 2K16! Esta nueva entrega
 de la mejor franquicia de videojuegos de la WWE viene repleta de diversión,
 realismo, acción y contundencia, con el regreso de las funciones y modos de
 juego favoritos de los fans, diversas innovaciones y mucho más. Juega con las mejores
 Superstars, Divas y Legends de la WWE de todos los tiempos. ¡WWE 2K16 para PC incluye
 todos los contenidos descargables!', '2016-03-11'::date, 1);

insert into roles (descripcion)
values('administrador'),
      ('registrado');

insert into usuarios(nick, password, email, registro_verificado, rol_id, activado)
values('admin', crypt('admin', gen_salt('bf')), 'guillermo.lopez@iesdonana.org', true, 1, true),
      ('pepe', crypt('pepe', gen_salt('bf')), 'guillermo.lopez@iesdonana.org', true, 2, true),
      ('juan', crypt('juan', gen_salt('bf')), 'guillermo.lopez@iesdonana.org', true, 2, true),
      ('guillermo', crypt('guillermo', gen_salt('bf')), 'guillermo.lopez@iesdonana.org', true, 2, true);

insert into carrito_compra(id_usuario, id_juego)
          values(4, 1),
          (4, 2),
          (4, 3);

insert into valoraciones (id_usuario, id_juego, valoracion)
        values (2, 1, 3),
               (3, 5, 1),
               (4, 3, 2),
               (2, 2, 3),
               (3, 2, 4),
               (4, 4, 5);

drop view if exists v_juegos;

create view v_juegos as
    select j.*, coalesce(round(avg(valoracion), 1), 0) as valoracion
      from juegos j  left join valoraciones v on id = id_juego
  group by id
    having j.fecha_salida <= current_date;

drop view if exists v_proximos;

create view v_proximos as
    select id, nombre, precio, resumen, descripcion,
           to_char(fecha_salida, 'DD/MM/YYYY') as fecha_salida
      from juegos
     where fecha_salida > current_date;

insert into comentarios (autor, contenido, padre_juego)
            values  (2, 'Comentario num Padre 1 ', 1),
                    (2, 'Comentario num Padre 2 ', 1);

insert into comentarios (autor, contenido, padre_juego, padre_comentario)
            values  (2, 'Comentario num Hijo 1' , 1 , 1),
                    (2, 'Comentario num Hijo 2' , 1 , 1);

create view v_usuarios_roles as
    select usuarios.*, descripcion
    from
    usuarios join roles
    on
    usuarios.rol_id = roles.id;

create view v_usuarios_valido as
    select *
    from usuarios
    where registro_verificado = true;

create view v_usuarios_carrito_compra as
    select carrito_compra.id_usuario, juegos.*
    from carrito_compra join juegos on carrito_compra.id_juego = juegos.id
