

DROP TABLE IF EXISTS d_evento CASCADE;

CREATE TABLE if not exists d_evento(
numTelefone varchar(255) not null,
instanteChamada timestamp not null,
idEvento Serial,
primary key(idEvento),
foreign key (numTelefone, instanteChamada) references EventoEmergencia(numTelefone, instanteChamada) ON DELETE CASCADE ON UPDATE CASCADE);

insert into d_evento 
SELECT numTelefone, instanteChamada
from EventoEmergencia;

----------------------------------------------------------------------------------------------
DROP TABLE IF EXISTS d_meio CASCADE;

CREATE TABLE if not exists d_meio(
numMeio integer not null,
nomeEntidade varchar(255) not null,
tipo varchar(255) not null,
idMeio Serial,
primary key(idMeio),
foreign key(numMeio, nomeEntidade) references Meio(numMeio, nomeEntidade) ON DELETE CASCADE ON UPDATE CASCADE);

insert into d_meio
	select numMeio, nomeEntidade, 'Apoio'
	from meioApoio NATURAL JOIN Meio UNION
	select numMeio, nomeEntidade, 'Socorro'
	from meioSocorro NATURAL JOIN Meio UNION
	select numMeio, nomeEntidade, 'Combate'
	from meioCombate NATURAL JOIN Meio UNION
	select numMeio, nomeEntidade, 'Nao expecificado'
	from (select numMeio, nomeEntidade
			from Meio except 
			(select numMeio, nomeEntidade
				from meioApoio NATURAL JOIN Meio UNION
			select numMeio, nomeEntidade
				from meioCombate NATURAL JOIN Meio UNION
			select numMeio, nomeEntidade
				from meioSocorro NATURAL JOIN Meio)) as t1;


DROP TABLE IF EXISTS d_tempo CASCADE;

CREATE TABLE if not exists d_tempo(
dia integer not null,
mes integer not null,
ano integer not null,
idTempo Serial,
primary key(idTempo));

insert into d_tempo
	select date_part('day', instanteChamada), date_part('month', instanteChamada), date_part('year', instanteChamada)
	from d_evento;



drop table if exists factos CASCADE;

CREATE TABLE if not exists factos(
idEvento integer,
idMeio integer,
idTempo integer,
idFactos Serial,
primary key(idFactos),
foreign key(idEvento) references d_evento(idEvento) ON DELETE CASCADE ON UPDATE CASCADE,
foreign key(idMeio) references d_meio(idMeio) ON DELETE CASCADE ON UPDATE CASCADE,
foreign key(idTempo) references d_tempo(idTempo) ON DELETE CASCADE ON UPDATE CASCADE);

insert into factos
	select idEvento, idMeio, idEvento
	from d_evento natural join d_meio natural join Acciona natural join EventoEmergencia UNION
	select idEvento, null, idEvento
	from d_evento except (select idEvento, null, idEvento
							from d_evento natural join d_meio natural join Acciona natural join EventoEmergencia) UNION
	select null, idMeio, null
	from d_meio except (select null, idMeio, null 
							from d_evento natural join d_meio natural join Acciona natural join EventoEmergencia)
	;

