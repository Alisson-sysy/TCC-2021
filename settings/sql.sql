drop database profie;
create database profie;


create table usuario(
	ID_usuario int auto_increment not null primary key,
    Nome varchar(30) not null,
    Sobrenome varchar(30) not null,
    Data_nascimento date not null,
    Tipo_usuario enum('P','D') not null,
    Login varchar(80),
    logado enum('S','N'),
    password varchar(30)
);

create table turma(
	id_turma int auto_increment not null primary key,
	nome_turma varchar(20) not null,
    periodo enum('M', 'T') not null
);

create table usuario_turma(
	ID_usuario int,
    id_turma int,
    foreign key(ID_usuario) references usuario(ID_usuario),
    foreign key(id_turma) references turma(id_turma)
);

create table aluno(
	id_aluno int auto_increment not null primary key,
    id_turma int not null,
    nome varchar(30),
    sonbrenome varchar(30),
    foto blob,
    data_nascimento date,
    nome_pai Varchar(20),
    nome_mãe varchar(20),
	foreign key(id_turma) references turma(id_turma)
);

create table contato_professor(
	ID_usuario int,
    tipo_contato varchar(30),
    contato varchar(30),
    foreign key(ID_usuario) references usuario(ID_usuario)
);

create table contato_aluno (
	id_aluno int,
    tipo_contato varchar(30),
    contato varchar(30),
    foreign key(id_aluno) references aluno(id_aluno)
);

create table atividade(
	id_atividade int auto_increment not null primary key,
    nome_atividade varchar(30) not null,
    dia_entrega date not null,
    hora_entrega time not null,
    id_turma  int not null,
    ID_usuario int not null,
    desc_atv varchar(40),
    foreign key(id_turma) references turma(id_turma),
    foreign key(ID_usuario) references usuario(ID_usuario)
);

create table entrega(
	id_entrega int auto_increment not null primary key,
    id_atividade int,
    id_aluno int,
    foto blob,
    confirmacao enum('E', 'N'), 
    dia_entrega date,
    hora_entrega date,
    foreign key(id_atividade) references atividade(id_atividade),
    foreign key(id_aluno) references aluno(id_aluno)
);

insert into usuario (nome, Sobrenome, Tipo_usuario) values ("Alisson", "garica", "P");

select turma.* from turma, usuario, usuario_turma where usuario_turma.Id_turma = turma.id_turma; 

DELETE FROM usuario WHERE ID_usuario = 20;

SELECT turma.*, usuario.nome FROM turma, usuario, usuario_turma where usuario.ID_usuario = usuario_turma.ID_usuario;

SELECT turma.* FROM turma;

SELECT turma.nome_turma FROM turma, usuario, usuario_turma WHERE usuario_turma.Id_turma = turma.id_turma && usuario_turma.ID_usuario = usuario.ID_usuario;

SELECT turma.nome_turma FROM turma, usuario_turma WHERE usuario_turma.ID_usuario = 39 && usuario_turma.id_turma = turma.id_turma;

SELECT ID_usuario FROM usuario_turma;

DELETE FROM usuario_turma WHERE id_turma = 11;
DELETE FROM turma WHERE id_turma = 11;

select usuario.*, turma.nome_turma from usuario, turma, usuario_turma where usuario_turma.Id_turma = turma.id_turma && usuario_turma.ID_usuario = usuario.ID_usuario order by usuario.nome;

select usuario.* 
from usuario, usuario_turma where usuario.ID_usuario != usuario_turma.ID_usuario;

select turma.nome_turma from turma, usuario, usuario_turma 
where usuario_turma.id_turma = turma.id_turma && usuario_turma.ID_usuario = usuario.ID_usuario && usuario_turma.ID_usuario = 47;
	
UPDATE turma SET
                            nome_turma = '$nomeTurma',
                            periodo = '$periodo'
                        where
                            id_turma = 10;
    
SELECT usuario.nome, usuario.Sobrenome, usuario.Tipo_usuario, turma.nome_turma FROM turma, usuario, usuario_turma 
WHERE usuario_turma.Id_turma = turma.id_turma && usuario_turma.ID_usuario = 50;

update aluno SET aluno.data_nascimento = "2019-03-14" where aluno.id_aluno = "8";

select turma.nome_turma from turma, aluno where aluno.id_turma = turma.id_turma && aluno.id_turma = 18;

SELECT nome_turma from turma where id_turma = 18;

SELECT turma.nome_turma from turma, aluno where aluno.id_turma = turma.id_turma && aluno.id_turma = 20;
