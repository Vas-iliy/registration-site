create table admil
(
    id       int auto_increment
        primary key,
    login    varchar(100) not null,
    password varchar(100) not null
);

INSERT INTO site.admil (id, login, password) VALUES (1, 'Admin', '123');