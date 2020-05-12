create table comments
(
    id         int auto_increment
        primary key,
    login      varchar(100)            not null,
    comment    varchar(1000)           not null,
    date       varchar(100)            not null,
    moderation varchar(30) default '0' not null
);

INSERT INTO site.comments (id, login, comment, date, moderation) VALUES (7, 'kkolyasev@gmail.com', 'gdf', '2020:05:10 17:01:55', 'ok');
INSERT INTO site.comments (id, login, comment, date, moderation) VALUES (8, 'tgfd', 'grfd', '2020:05:10 17:03:06', 'no');
INSERT INTO site.comments (id, login, comment, date, moderation) VALUES (9, 'hkyguh', 'hyr', '2020:05:10 17:11:06', 'ok');
INSERT INTO site.comments (id, login, comment, date, moderation) VALUES (10, 'vjhbk', 'vhbjk', '2020:05:10 17:13:27', 'ok');
INSERT INTO site.comments (id, login, comment, date, moderation) VALUES (11, 'hgf', 'hfgdf', '2020:05:10 17:14:40', 'no');
INSERT INTO site.comments (id, login, comment, date, moderation) VALUES (12, '4525', 'ddd', '2020:05:10 17:16:31', 'ok');
INSERT INTO site.comments (id, login, comment, date, moderation) VALUES (30, 'kkolyasev@gmail.com', 'jkl', '2020:05:10 22:17:12', 'no');
INSERT INTO site.comments (id, login, comment, date, moderation) VALUES (31, 'm', 'jii', '2020:05:10 22:19:40', 'no');
INSERT INTO site.comments (id, login, comment, date, moderation) VALUES (32, 'Vasiliy', 'eee', '2020:05:12 21:17:54', 'ok');