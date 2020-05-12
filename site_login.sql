create table login
(
    id         int auto_increment
        primary key,
    name       varchar(30)                          not null,
    surname    varchar(30)                          not null,
    year       int                                  not null,
    city       varchar(30)                          not null,
    email      varchar(30)                          not null,
    auth_key   varchar(100)                         null,
    validate   tinyint(1) default 0                 null,
    login      varchar(100)                         not null,
    password   varchar(30)                          not null,
    created_at timestamp  default CURRENT_TIMESTAMP null,
    updated_at timestamp  default CURRENT_TIMESTAMP null,
    constraint login_email_uindex
        unique (email),
    constraint login_login_uindex
        unique (login)
);

INSERT INTO site.login (id, name, surname, year, city, email, auth_key, validate, login, password, created_at, updated_at) VALUES (16, 'Василий', 'Колясев', 1999, 'Ижевск', 'vkolyasev1999@mail.ru', 'fMCQdZzSioahJkBadKaN', 1, 'Vasiliy', '123', '2020-05-10 16:28:49', '2020-05-10 16:35:47');