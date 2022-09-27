-- TODO: Commented lines have not been implemented yet (mostly foreign keys), 
-- uncommenting after deciding the creation order of the tables

--  Persons, both customers and staff, true boolean value signifies staff members
-- Separate table for user accounts because we may wish to keep old customer/staff data for a period 



-- addresses, both customers and staff
CREATE TABLE osoite (
    osoite_id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    osoite VARCHAR(50) NOT NULL,
    postinumero VARCHAR(5) NOT NULL,
    postitoimipaikka VARCHAR(30) NOT NULL,
    maakunta VARCHAR(40) NOT NULL,
    osavaltio VARCHAR(30),
    maa VARCHAR(30) NOT NULL,
    PRIMARY KEY(osoite_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- persons
CREATE TABLE henkilo (
  henkilo_id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  etunimi VARCHAR(45) NOT NULL,
  sukunimi VARCHAR(45) NOT NULL,
  sahkoposti VARCHAR(50) NOT NULL,
  onhenkilokunta BOOLEAN NOT NULL DEFAULT TRUE,
  aktiivinen BOOLEAN NOT NULL DEFAULT TRUE,
  luontiaika DATETIME DEFAULT CURRENT_TIMESTAMP,
  viimeisin_muutos TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY  (henkilo_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- product categories
CREATE TABLE tuotekategoria (
  nimi VARCHAR(50) NOT NULL,
  luontiaika DATETIME NOT NULL,
  viimeisin_muutos TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (nimi)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- products
CREATE TABLE tuote (
  tuote_id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  nimi VARCHAR(50) NOT NULL,
  hinta DECIMAL(5,2) NOT NULL,
  kuvaus VARCHAR(2000) NOT NULL,
  luontiaika DATETIME NOT NULL,
  viimeisin_muutos TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  tuotekategoria VARCHAR(50),
  PRIMARY KEY (tuote_id),
  FOREIGN KEY (tuotekategoria) REFERENCES tuotekategoria (nimi)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- person addresses
-- both customers and staff can each have several addresses and vice versa
CREATE TABLE henkiloidenosoitteet (
  henkiloidenosoitteet_id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  osoite_id SMALLINT UNSIGNED NOT NULL,
  henkilo_id SMALLINT UNSIGNED NOT NULL,
  PRIMARY KEY (henkiloidenosoitteet_id),
  FOREIGN KEY (henkilo_id) REFERENCES henkilo(henkilo_id) ON UPDATE CASCADE, 
  FOREIGN KEY (osoite_id) REFERENCES osoite(osoite_id) ON UPDATE CASCADE

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



--  user profiles, both customers and staff
-- final profile rights are determined by staff membership status in the persons (henkilo) table
CREATE TABLE kayttajatili (
  kayttajanimi VARCHAR(45) NOT NULL,
  salasana VARCHAR(45) NOT NULL,
  luontiaika DATETIME NOT NULL,
  viimeisin_muutos TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  henkilo_id SMALLINT UNSIGNED NOT NULL,
  PRIMARY KEY  (kayttajanimi),
  FOREIGN KEY (henkilo_id) REFERENCES henkilo (henkilo_id) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


  