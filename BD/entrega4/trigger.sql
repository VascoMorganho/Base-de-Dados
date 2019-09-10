
drop trigger if exists verifica_coordenador_trigger on Solicita;
drop function if exists verifica_coordenador();

create or replace function verifica_coordenador() returns trigger as $$
	declare local1 varchar (255);
	declare local2 varchar (255);
	declare vid integer;
begin

	if new.idCoordenador not in (select idCoordenador from Coordenador) then
		raise exception 'O coordenador % nao existe.', new.idCoordenador;
	end if;

	if new.idCoordenador not in (select idCoordenador from Audita) then
		raise exception 'O coordenador % nunca auditou.', new.idCoordenador;
	end if;

	select numCamara into vid
	from Video
	where Video.numCamara = new.numCamara;

	if vid is null then raise exception 'Esta camara nao tem videos';
	end if;

	select moradaLocal into local1
	from EventoEmergencia inner join Audita on EventoEmergencia.numProcessoSocorro = Audita.numProcessoSocorro
	where Audita.idCoordenador = new.idCoordenador;

	if local1 is null then raise exception 'O coordenador nao auditou.';
	end if;

	select moradaLocal into local2
	from Vigia
	where Vigia.numCamara = new.numCamara;

	if local2 is null then raise exception 'Nao existe camara nesse local.';
	end if;

	if local1 <> local2 then raise exception 'O coordenador nao auditou nenhum accionamento cujo evento ocorreu
												 num local vigiado pela camara solicitada';
	end if;
	return new;

	drop table if exists local1;
	drop table if exists local2;
	drop table if exists vid;

End;
$$ Language plpgsql;

create trigger verifica_coordenador_trigger before insert on Solicita
for each row execute procedure verifica_coordenador();




------------------------------

drop trigger if exists verifica_meio_trigger on Alocado;
drop function if exists verifica_meio();

create or replace function verifica_meio() returns trigger as $$
	declare novoMeio integer;
	declare novoProcesso integer;
	declare mE integer;
begin
	if new.numMeio not in (select numMeio from Acciona) then
		raise exception 'O meio % nao foi accionado.', new.numMeio;
	end if;

	if new.numProcessoSocorro not in (select numProcessoSocorro from Acciona) then
		raise exception 'O processo de socorro % nao foi accionado.', new.numProcessoSocorro;
	end if;

	select numMeio into mE
	from Acciona
	where Acciona.numMeio = new.numMeio AND Acciona.nomeEntidade = new.nomeEntidade;

	if mE is null then raise exception 'numMeio e nomeEntidade inconsistentes.';
	end if;

	select numMeio, numProcessoSocorro into novoProcesso
	from Acciona 
	where Acciona.numMeio = new.numMeio and Acciona.numProcessoSocorro = new.numProcessoSocorro;

	if novoProcesso is null then raise exception 'Este processo nao accionou este meio.';
	end if;

	return new;

	drop table if exists novoMeio;
	drop table if exists novoProcesso;
	drop table if exists mE;

End;
$$ Language plpgsql;

create trigger verifica_meio_trigger before insert on Alocado
for each row execute procedure verifica_meio();
