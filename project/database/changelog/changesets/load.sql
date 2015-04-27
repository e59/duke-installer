--liquibase formatted sql


--changeset eduardo:load


-- password is teste, watch out
INSERT INTO usuario (email, nome, senha, reset, validade, criado, ativo) VALUES ('atendimento@maisdata.com.br', 'Maisdata', '$2a$10$zz2NAA9Q93R1n./2hzD/WuQebYndRUsiC0A99lSinyD/AbKCxoVlu', NULL, now(), now(), '1');

INSERT INTO grupo (nome, criado) VALUES ('Administração', now());

INSERT INTO usuario_grupo (usuario_id, grupo_id, criado) VALUES (1, 1, now());


INSERT INTO preset (slug,titulo,descricao,metadados) VALUES ('___thumb___','Thumbnail admin','','{"width":50,"height":50}');
INSERT INTO preset (slug,titulo,descricao,metadados) VALUES ('default-file','Default','','{"width":50,"height":50}');


insert into permissao (grupo_id, permissao_id) values (1, 'conteudo');
insert into permissao (grupo_id, permissao_id) values (1, 'admin');


