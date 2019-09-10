drop table borrower cascade;
drop table loan cascade;
drop table depositor cascade;
drop table account cascade;
drop table customer cascade;
drop table branch cascade;drop table Camara cascade;
drop table Video cascade;
drop table SegmentoVideo cascade;
drop table Local cascade;
drop table Vigia cascade;
drop table EventoEmergencia cascade;
drop table ProcessoSocorro cascade;
drop table EntidadeMeio cascade;
drop table Meio cascade;
drop table MeioCombate cascade;
drop table MeioApoio cascade;
drop table MeioSocorro cascade;
drop table Transporta cascade;
drop table Alocado cascade;
drop table Acciona cascade;
drop table Coordenador cascade;
drop table Audita cascade;
drop table Solicita cascade;


create table Camara
  (numCamara integer not null,
    constraint pk_camara primary key(numCamara));

create table Video
  (dataHoraInicio timestamp not null,
    dataHoraFim timestamp not null,
    numCamara integer not null,
    check (dataHoraInicio < dataHoraFim),
    constraint pk_video primary key(dataHoraInicio, numCamara),
    constraint fk_video_camara foreign key(numCamara) references Camara(numCamara) ON DELETE CASCADE ON UPDATE CASCADE);

create table SegmentoVideo
  (numSegmento integer not null,
    duracao time not null,
    dataHoraInicio timestamp not null,
    numCamara integer not null,
    constraint pk_segmento primary key(numSegmento, dataHoraInicio, numCamara),
    constraint fk_segmento_video foreign key(dataHoraInicio, numCamara) references Video ON DELETE CASCADE ON UPDATE CASCADE);

create table Local
  (moradaLocal varchar(255) not null,
    constraint pk_local primary key(moradaLocal));

create table Vigia
  (moradaLocal varchar(255) not null,
    numCamara integer not null,
    constraint fk_vigia_local foreign key(moradaLocal) references Local(moradaLocal) ON DELETE CASCADE ON UPDATE CASCADE,
    constraint fk_vigia_camara foreign key(numCamara) references Camara(numCamara) ON DELETE CASCADE ON UPDATE CASCADE,
    constraint pk_vigia primary key(moradaLocal, numCamara));

create table ProcessoSocorro
  (numProcessoSocorro integer,
    constraint pk_processo primary key(numProcessoSocorro));

create table EventoEmergencia
  (moradaLocal varchar(255) not null,
    instanteChamada timestamp not null,
    nomePessoa varchar(255) not null unique,
    numTelefone varchar(255) not null unique,
    numProcessoSocorro integer,
    constraint fk_evento_local foreign key (moradaLocal) references Local(moradaLocal) ON DELETE CASCADE ON UPDATE CASCADE,
    constraint fk_evento_processo foreign key(numProcessoSocorro) references ProcessoSocorro(numProcessoSocorro) ON DELETE CASCADE ON UPDATE CASCADE,
    constraint pk_evento primary key(instanteChamada, numTelefone));

create table EntidadeMeio
  (nomeEntidade varchar(255) not null,
    constraint pk_entidade primary key(nomeEntidade));

create table Meio 
  (numMeio integer not null,
    nomeMeio varchar(255) not null,
    nomeEntidade varchar(255) not null,
    constraint fk_meio_entidade foreign key(nomeEntidade) references EntidadeMeio(nomeEntidade) ON DELETE CASCADE ON UPDATE CASCADE,
    constraint pk_meio primary key (numMeio, nomeEntidade));

create table MeioCombate
  (numMeio integer not null,
    nomeEntidade varchar(255) not null,
    constraint fk_meioCombate_meio foreign key(numMeio, nomeEntidade) references Meio(numMeio, nomeEntidade) ON DELETE CASCADE ON UPDATE CASCADE,
    constraint pk_meioCombate primary key(numMeio, nomeEntidade));

create table MeioApoio
  (numMeio integer not null,
    nomeEntidade varchar(255) not null,
    constraint fk_meioApoio_meio foreign key(numMeio, nomeEntidade) references Meio(numMeio, nomeEntidade) ON DELETE CASCADE ON UPDATE CASCADE,
    constraint pk_meioApoio primary key(numMeio, nomeEntidade));

create table MeioSocorro
  (numMeio integer not null,
    nomeEntidade varchar(255) not null,
    constraint fk_meioSocorro_meio foreign key(numMeio, nomeEntidade) references Meio(numMeio, nomeEntidade) ON DELETE CASCADE ON UPDATE CASCADE,
    constraint pk_meioSocorro primary key(numMeio, nomeEntidade));

create table Transporta
  (numMeio integer not null,
    nomeEntidade varchar(255) not null,
    numVitimas integer not null,
    numProcessoSocorro integer not null,
    constraint fk_transporta_meioSocorro foreign key(numMeio,nomeEntidade) references MeioSocorro ON DELETE CASCADE ON UPDATE CASCADE,
    constraint fk_transporta_processo foreign key(numProcessoSocorro) references ProcessoSocorro ON DELETE CASCADE ON UPDATE CASCADE,
    constraint pk_transporta primary key(numMeio, nomeEntidade, numProcessoSocorro));

create table Alocado
  (numMeio integer not null,
    nomeEntidade varchar(255) not null,
    numHoras integer not null,
    numProcessoSocorro integer not null,
    constraint fk_alocado_meioApoio foreign key(numMeio, nomeEntidade) references MeioApoio ON DELETE CASCADE ON UPDATE CASCADE,
    constraint pk_alocado primary key (numMeio, nomeEntidade, numProcessoSocorro));

create table Acciona
  (numMeio integer not null,
    nomeEntidade varchar(255) not null,
    numProcessoSocorro integer not null,
    constraint fk_acciona_meio foreign key(numMeio, nomeEntidade) references Meio(numMeio, nomeEntidade) ON DELETE CASCADE ON UPDATE CASCADE,
    constraint fk_acciona_processo foreign key(numProcessoSocorro) references ProcessoSocorro(numProcessoSocorro) ON DELETE CASCADE ON UPDATE CASCADE,
    constraint pk_acciona primary key(numMeio, nomeEntidade, numProcessoSocorro));

create table Coordenador
  (idCoordenador integer not null,
    constraint pk_coordenador primary key(idCoordenador));

create table Audita
  (idCoordenador integer not null,
    numMeio integer not null,
    nomeEntidade varchar(255) not null,
    numProcessoSocorro integer not null,
    dataHoraInicio timestamp not null,
    dataHoraFim timestamp not null,
    dataAuditoria timestamp not null,
    texto varchar(255) not null,
    check (dataHoraInicio < dataHoraFim AND dataAuditoria >= CURRENT_TIMESTAMP),
    constraint fk_audita_acciona foreign key(numMeio, nomeEntidade, numProcessoSocorro) references Acciona(numMeio, nomeEntidade, numProcessoSocorro) ON DELETE CASCADE ON UPDATE CASCADE,
    constraint fk_audita_coordenador foreign key(idCoordenador) references Coordenador(idCoordenador) ON DELETE CASCADE ON UPDATE CASCADE,
    constraint pk_audita primary key(idCoordenador, numMeio, nomeEntidade, numProcessoSocorro));

create table Solicita
  (idCoordenador integer not null,
    dataHoraInicioVideo timestamp not null,
    numCamara integer not null,
    dataHoraInicio timestamp not null,
    dataHoraFim timestamp not null,
    constraint fk_solicita_coordenador foreign key(idCoordenador) references Coordenador(idCoordenador) ON DELETE CASCADE ON UPDATE CASCADE,
    constraint fk_solicita_video foreign key(dataHoraInicioVideo, numCamara) references Video(dataHoraInicio, numCamara) ON DELETE CASCADE ON UPDATE CASCADE,
    constraint pk_solicita primary key(idCoordenador, dataHoraInicioVideo, numCamara));  




