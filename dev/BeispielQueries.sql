"SELECT id,bezeichnung,preis from produkt ORDER by bezeichnung"

"SELECT * FROM `produkt` WHERE id=2;"

"UPDATE `produkt` SET `bezeichnung` = ?, `beschreibung` = ?, `preis` = ?
WHERE `produkt`.`id` = ?"

"SELECT * FROM `produkt` WHERE bezeichnung LIKE '%bürste%' AND beschreibung LIKE '%bürste%'"