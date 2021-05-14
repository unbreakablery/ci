drop database if exists joki20;
create database joki20;

use joki20;

--
-- Books table
-- 
DROP TABLE IF EXISTS books;
CREATE TABLE IF NOT EXISTS books
(
    id integer not null auto_increment primary key, 
    title char(40) not null,
    isbn char(40) not null,
    author char(40) not null,
    image char(80) not null
);
-- empty table
DELETE FROM books;

INSERT INTO books (title, isbn, author, image) VALUES ('Databasteknik', 'Thomas Padron-McCarthy', '9789144044491', 'https://www.studentapan.se/static/img/books/9789144044491-databasteknik.jpg');
INSERT INTO books (title, isbn, author, image) VALUES ('Farbror Joakims Liv', 'Tage', '9789176212851', 'https://s2.adlibris.com/images/29844488/farbror-joakims-liv.jpg');
INSERT INTO books (title, isbn, author, image) VALUES ('HC Andersens bästa sagor', 'H.C. Andersen', '9789172991224', 'https://s1.adlibris.com/images/386543/h-c-andersens-basta-sagor.jpg');

-- ----------------------------------------

--
-- Highscores table
-- 
DROP TABLE IF EXISTS highscores;
CREATE TABLE IF NOT EXISTS highscores 
(
    id integer not null auto_increment primary key, 
    score int not null
);
-- empty table
DELETE FROM highscores;