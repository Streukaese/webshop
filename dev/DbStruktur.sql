Create database webshop;

use/using database webshop; (nachschlagen == falsch)

create table produkt(
    id int not null AUTO_INCREMENT primary key,
	bezeichnung VARCHAR(30) not null,
    beschreibung VARCHAR(100) not null,
    preis float not null
);