select tipo, ano, mes, count(idMeio) as nMeios
		from factos natural join d_meio natural join d_tempo
		where factos.idEvento = 15
group by tipo, ano, mes
UNION
select tipo, ano, null, count(idMeio) as nMeios
		from factos natural join d_meio natural join d_tempo
		where factos.idEvento = 15
group by tipo, ano
UNION
select tipo, null, null, count(idMeio) as nMeios
		from factos natural join d_meio natural join d_tempo
		where factos.idEvento = 15
group by tipo
UNION
select null, null, null, count(idMeio) as nMeios
		from factos natural join d_meio natural join d_tempo
		where factos.idEvento = 15
order by tipo, ano, mes;
