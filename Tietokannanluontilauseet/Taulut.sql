-- No separate tables for persons and users in this branch

-- countries 
CREATE TABLE maa (
  nimi VARCHAR(45) NOT NULL,
  PRIMARY KEY (nimi)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- addresses, both customers and staff
CREATE TABLE osoite (
    osoite_id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    osoite VARCHAR(50) NOT NULL,
    postinumero VARCHAR(5) NOT NULL,
    postitoimipaikka VARCHAR(30) NOT NULL,
    maa VARCHAR(45) NOT NULL,
    maakunta VARCHAR(40) NOT NULL,
    osavaltio VARCHAR(30),
    PRIMARY KEY(osoite_id),
    FOREIGN KEY (maa) REFERENCES maa (nimi)
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



-- orders
CREATE TABLE tilaus (
  tilaus_id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  tilattumaaara VARCHAR(50) NOT NULL,
  tilauspaivamaara DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  luontiaika DATETIME NOT NULL,
  viimeisin_muutos TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  tuote_id SMALLINT UNSIGNED NOT NULL,
  PRIMARY KEY (tilaus_id),
  FOREIGN KEY (tuote_id) REFERENCES tuote (tuote_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;





--  user profiles, both customers and staff
-- final profile rights are determined by staff membership status in the onhenkilokunta boolean variable
-- true boolean value signifies staff members
CREATE TABLE kayttajatili (
  kayttajanimi VARCHAR(45) NOT NULL,
  salasanahash VARCHAR(100) NOT NULL,
  etunimi VARCHAR(45) NOT NULL,
  sukunimi VARCHAR(45) NOT NULL,
  puhelinnumero VARCHAR(45) NOT NULL,
  sahkoposti VARCHAR(45) NOT NULL,
  osoite_id SMALLINT UNSIGNED NOT NULL,
  aktiivinen BOOLEAN NOT NULL DEFAULT TRUE,
  onhenkilokunta BOOLEAN NOT NULL DEFAULT FALSE,
  luontiaika DATETIME NOT NULL,
  viimeisin_muutos TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY  (kayttajanimi),
  FOREIGN KEY (osoite_id) REFERENCES osoite(osoite_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE kayttajantoken (

  token_id INT AUTO_INCREMENT PRIMARY KEY,
  selektori VARCHAR(255) NOT NULL,
  validaattorihash VARCHAR(255) NOT NULL,
  kayttajanimi VARCHAR(45) NOT NULL,
  umpeutumisaika DATETIME NOT NULL,
  FOREIGN KEY (kayttajanimi) REFERENCES kayttajatili (kayttajanimi) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;





  