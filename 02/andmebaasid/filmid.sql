-- Created by Vertabelo (http://vertabelo.com)
-- Last modification date: 2019-09-29 07:10:07.175

-- tables
-- Table: AMET
CREATE TABLE AMET (
    Amet_ID int NOT NULL AUTO_INCREMENT,
    Nimetus varchar(30) NOT NULL,
    CONSTRAINT AMET_pk PRIMARY KEY (Amet_ID)
);

-- Table: FILM
CREATE TABLE FILM (
    Film_ID int NOT NULL AUTO_INCREMENT,
    Pealkiri varchar(100) NOT NULL,
    Aasta int NOT NULL,
    Kestus int NOT NULL,
    Sisukokkuv6te varchar(3000) NULL,
    CONSTRAINT FILM_pk PRIMARY KEY (Film_ID)
);

-- Table: ISIK
CREATE TABLE ISIK (
    Isik_ID int NOT NULL AUTO_INCREMENT,
    Eesnimi varchar(50) NOT NULL,
    Perekonnanimi varchar(50) NOT NULL,
    Synniaeg date NULL,
    CONSTRAINT ISIK_pk PRIMARY KEY (Isik_ID)
);

-- Table: ISIK_FILMIS
CREATE TABLE ISIK_FILMIS (
    Isik_filmis_ID int NOT NULL AUTO_INCREMENT,
    ISIK_Isik_ID int NOT NULL,
    FILM_Film_ID int NOT NULL,
    AMET_Amet_ID int NOT NULL,
    Roll varchar(50) NULL,
    CONSTRAINT ISIK_FILMIS_pk PRIMARY KEY (Isik_filmis_ID)
);

-- foreign keys
-- Reference: ISIK_FILMIS_AMET (table: ISIK_FILMIS)
ALTER TABLE ISIK_FILMIS ADD CONSTRAINT ISIK_FILMIS_AMET FOREIGN KEY ISIK_FILMIS_AMET (AMET_Amet_ID)
    REFERENCES AMET (Amet_ID);

-- Reference: ISIK_FILMIS_FILM (table: ISIK_FILMIS)
ALTER TABLE ISIK_FILMIS ADD CONSTRAINT ISIK_FILMIS_FILM FOREIGN KEY ISIK_FILMIS_FILM (FILM_Film_ID)
    REFERENCES FILM (Film_ID);

-- Reference: ISIK_FILMIS_Isik_ID (table: ISIK_FILMIS)
ALTER TABLE ISIK_FILMIS ADD CONSTRAINT ISIK_FILMIS_Isik_ID FOREIGN KEY ISIK_FILMIS_Isik_ID (ISIK_Isik_ID)
    REFERENCES ISIK (Isik_ID);

-- End of file.
