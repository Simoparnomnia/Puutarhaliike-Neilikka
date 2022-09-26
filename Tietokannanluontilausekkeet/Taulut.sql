

---  user profile for customers
CREATE TABLE asiakaskayttaja (
  kayttajanimi VARCHAR(45) NOT NULL,
  salasana VARCHAR(45) NOT NULL,
  luontiaika DATETIME NOT NULL,
  viimeisin_muutos TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY  (kayttajanimi),
  FOREIGN KEY (asiakas_id) REFERENCES asiakas (asiakas_id) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;