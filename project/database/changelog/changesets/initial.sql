--liquibase formatted sql


--changeset duke:initial


create table grupo (
    id bigserial primary key,
    nome varchar(255),
    criado timestamp not null default now()
);

create table permissao (
    grupo_id bigint,
    permissao_id varchar(55),
    primary key (grupo_id, permissao_id),
    foreign key (grupo_id) references grupo(id) on delete cascade on update cascade
);

create table usuario (
    id bigserial primary key,
    email varchar(255) not null,
    nome varchar(255),
    senha char(60),
    last_password_change timestamp,
    reset char(60),
    validade timestamp,
    criado timestamp not null default now(),
    ativo boolean not null default true,
    unique(email)
);

create table preset (
    id bigserial primary key,
    slug varchar(55) unique,
    titulo varchar(55),
    descricao text,
    metadados text
);

create table usuario_grupo (
    usuario_id bigint,
    grupo_id bigint,
    criado timestamp not null default now(),
    primary key (usuario_id, grupo_id),
    foreign key (usuario_id) references usuario(id) on delete cascade on update cascade,
    foreign key (grupo_id) references grupo(id) on delete cascade on update cascade
);

create table arquivo (
    id bigserial primary key,
    nome varchar(255),
    nome_original varchar(255),
    mime varchar(255),
    usuario_id bigint,
    preset_id bigint,
    imagem boolean not null default false,
    metadados text,
    criado timestamp not null default now(),
    foreign key (usuario_id) references usuario(id) on delete set null on update cascade,
    foreign key (preset_id) references preset(id) on delete set null on update cascade
);

create table usuario_arquivo (
    usuario_id bigint,
    arquivo_id bigint,
    primary key (usuario_id, arquivo_id),
    foreign key (usuario_id) references usuario(id) on delete cascade on update cascade,
    foreign key (arquivo_id) references arquivo(id) on delete cascade on update cascade
);


create table configuracao (
    chave varchar(55) primary key,
    descricao text,
    valor text
);

create table pagina (
    id bigserial primary key,
    titulo varchar(255),
    slug varchar(255),
    texto text,
    criado timestamp not null default now(),
    ativo boolean not null default true
);

create table pagina_arquivo (
    pagina_id bigint,
    arquivo_id bigint,
    criado timestamp not null default now(),
    primary key (pagina_id, arquivo_id),
    foreign key (pagina_id) references pagina(id) on delete cascade on update cascade,
    foreign key (arquivo_id) references arquivo(id) on delete cascade on update cascade
);
