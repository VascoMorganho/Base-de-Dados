/*     1     */

SELECT numProcessoSocorro
		FROM ((SELECT numProcessoSocorro, count(numMeio) AS nMeios
				FROM Acciona
				GROUP BY numProcessoSocorro) as t1 
		CROSS JOIN
				(SELECT max(t1.nMeios) AS mMeios
				FROM (SELECT numProcessoSocorro, count(numMeio) AS nMeios
						FROM Acciona
							GROUP BY numProcessoSocorro) as t1
				) as t)
					as t2
WHERE t2.nMeios = t2.mMeios;

/*     2     */

SELECT nomeEntidade
		FROM ((SELECT instanteChamada, count(numProcessoSocorro) AS nPross, nomeEntidade
					FROM Acciona NATURAL JOIN EventoEmergencia
					WHERE instanteChamada >= '2018-06-21 00:00:00' AND instanteChamada <= '2018-09-23 23:59:59'
					GROUP BY instanteChamada, nomeEntidade) as t1 
		CROSS JOIN
				(SELECT max(t1.nPross) AS maxEnt
				FROM (SELECT instanteChamada, count(numProcessoSocorro) AS nPross, nomeEntidade
						FROM Acciona NATURAL JOIN EventoEmergencia
						WHERE instanteChamada >= '2018-06-21 00:00:00' AND instanteChamada <= '2018-09-23 23:59:59'
						GROUP BY instanteChamada, nomeEntidade) as t1 
				) as t)
					as t2
WHERE t2.nPross = t2.maxEnt;



/*     3     */

SELECT numProcessoSocorro
	FROM EventoEmergencia NATURAL JOIN Acciona
	WHERE instanteChamada >= '2018-01-01 00:00:00' AND instanteChamada <= '2018-12-31 23:59:59' AND moradaLocal = 'Oliveira do Hospital'
	EXCEPT
SELECT numProcessoSocorro
	FROM Audita;

/*     4     */

SELECT count(numSegmento) as numSegmentos
FROM SegmentoVideo NATURAL JOIN Vigia
WHERE dataHoraInicio <='2018-08-31 23:59:59' AND dataHoraInicio >='2018-08-01 00:00:00' AND moradaLocal = 'Monchique' AND duracao > '00:01:00';



/*     5     */

SELECT numMeio, nomeEntidade
	FROM MeioCombate
	EXCEPT
SELECT numMeio, nomeEntidade
	FROM MeioApoio;

/*     6     */

SELECT DISTINCT T.nomeEntidade
FROM Acciona as T
WHERE NOT EXISTS(
	(SELECT numProcessoSocorro
		FROM ProcessoSocorro)
	EXCEPT
	(SELECT Acciona.numProcessoSocorro
		FROM MeioCombate, Acciona
		WHERE Acciona.numMeio = MeioCombate.numMeio AND
		T.nomeEntidade = Acciona.nomeEntidade));







