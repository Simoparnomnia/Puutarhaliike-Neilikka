## SISÄLLYSLUETTELO
### Taustatietoa
### Toimintaperiaate
### Hakemistot
### Asennusohjeet
### TODO
### Ongelmat

## Taustatietoa

ENGLISH: Experimental website for the fictional company Neilikka. Part of Omnia's web programming (Web-ohjelmointi) course (autumn 2022).

Kokeellinen kotisivu kuvitteelliselle Neilikka-puutarhaliikkeelle. Osa Omnian Web-ohjelmointi kurssia (syksy 2022). Palvelinalustana [XAMPP](https://www.apachefriends.org/). Käyttää PHPMailer-kirjastoa ja [Mailtrap](https://mailtrap.io)-palvelua (SMTP) yhteydenottopyyntöjen sähköpostitukseen. Tietokantana MySQL/MariaDB.

## Toimintaperiaate
Useammalla käyttäjällä voi olla sama osoite.
## Hakemistot

### index.php
Grafiikkakompnenttien ja varoitusviestien generointi
### Composer
[PHP-riippuvuuksienhallintaan](https://getcomposer.org/)
### Omat moduulit
Itsetehdyt moduulit, grafiikkakomponentit, tapahtumankäsittelijät (tietokantayhteys/rekisteröinti/kirjautuminen/sähköpostin lähetys), tietokannanluontilauseet (tietokannan esimerkkimateriaali)
### Vendor
Valmiskirjastot
#### Sähköposti
    (PHPMailer.php/SMTP.php/Exception.php
    sendgrid-php
#### Testaus
    phpunit
#### Lokitus
    monolog
### Tietokannanluontilauseet
Esimerkkimateriaali tietokannan luontia varten
### Tyylit
CSS-tyylitiedostot



## Asennusohjeet
Varmista että [XAMPP](https://www.apachefriends.org/) on asennettu ja repositorio on kloonattu XAMPP:N htdocs-kansioon.

Luo repositorion kloonauksen jälkeen seuraavat tiedostot kansioon Omat moduulit: Tietokantayhteys.php ja Sähköpostiyhteys.php

### Poisjääneet tiedostot
Luo credentials.php projektin juuren ulkopuolelle seuraavalla sisällöllä.

    $hostdomain='emailserverdomaintähän';
    $hostusername='emailserverkäyttäjätähän';
    $hostpassword='emailserversalasanatähän';
    $databaseusername='tietokantakäyttäjänimitähän';
    $databasepassword='tietokantasalasanannimitähän';

### Sähköpostipalvelun asetus

#### Gmail API

#### SMTP, sähköpostiviestit ilman 2-vaiheista tunnistautumista
[Sähköpostin asetusohjeet SMTP:llä 1](https://netcorecloud.com/tutorials/send-an-email-via-gmail-smtp-server-using-php/)
[Sähköpostin asetusohjeet SMTP:llä 2](https://phppot.com/php/send-email-in-php-using-gmail-smtp/)

HUOM: Muista asettaa 2 vaiheinen tunnistautuminen ja less secure apps
takaisin päälle jos ratkaisu löytyy Gmail API:lle.

#### Sendgrid (SMTP)

Luo [SendGrid-tili](https://app.sendgrid.com) ja luo tarvittavat tunnukset: Integrate->SMTP Relay

#### Sendgrid (Email API)

Luo [SendGrid-tili](https://app.sendgrid.com) ja luo tarvittavat tunnukset: Integrate->Email API

[Varmista että sendgrid-php:n zip-versio on purettu Kirjastot-kansioon](https://github.com/sendgridsendgrid-php#alternative-install-package-from-zip)
[SendGrid-kirjaston käyttöohjeet](https://github.com/sendgrid/sendgrid-php#hello-email)

#### Mailtrap (SMTP)

Sandbox->Inboxes->SMTP settings


### Tietokantayhteys.php
Käytä credentials.php:n tunnuksia

### Lähetäsähköposti.php
Käytä credentials.php:n tunnuksia

### Käyttöönotto Azuressa
[Kirjaudu Azureen](https://portal.azure.com/) 
#### Repositorion asetus
Dashboard -> App Service -> Deployment Center -> Source: Github -> Authorize
#### PHP-version konfiguraatio
App Service -> Settings -> Configuration -> PHP 7.4
#### Unitilan ehkäisy
Configuration -> Always on
#### Tietokannan tuonti
Avaa Paikallisen projektin PHPMyAdmin -> Vie/Export
App Service -> MySQL In App -> Manage-komento avaa pilviversion PHPMyAdmin:n selaimeen -> Tuo/Import
#### Tietokannan konfiguraatio
mysql\data\MYSQLCONNSTR_localdb.ini:
    Database=localdb; Data Source=127.0.0.1:portinnumero; User id=azure; Password=password
#### Tiedostojen muokkaus Azuren App Servicessa
App Service Editor
#### Komentorivi Azuressa
Advanced tools tai Development tools->console
#### MYSQL-tietokannan konfiguraatio
Configuration ->

Luo testikäyttäjiä lisäämällä ne tiedostoon data.sql seuraavassa muodossa:
    INSERT INTO kayttajatili VALUES('kayttajatahan','salasanahashtahan','etunimi','sukunimi','puhelinnumero','sähköposti',osoitteenid,onkotiliaktiivinenboolean,onkokayttajahenkilokuntaaboolean,'2022-01-01 12:00:00',NULL)

#### Azure-version PHP-tiedot näkyviin
https://kayttajanimi.azurewebsites.net



## TODO
### navigointi ja navigointipalkin modularisointi 
    -header ja footer omiin tiedostoihinsa->TEHTY
    -jokaisella sivulla tieto siitä missä päin verkkosivustoa ollaan (breadcrumbs?) (ks. $SERVER['SCRIPT_FILENAME'])

### Käyttäjänhallinta
    -Käyttäjän rekisteröinti -> TEHTY
    -Kirjaudu sisään ja ulos -> TEHTY
    -Salasanat tallennettu hash-muodossa -> TEHTY
    -Unohtunut salasana -> TEHTY
    -Muista minut (autentikointi-token/eväste että säilyy kirjautuneena vaikaa selainikkuna suljetaan)
### TEHTÄVÄNANTO 22.09.2022: 
    sähköpostin lähetys ylläpitäjälle yhteydenottolomakkeelta (ks. kurssi2102 repo -> PHPmailer.php, SMTP.php sekä sähköpostipalvelu (gmail (SMTP tai OAuth)/SendGrid API/Mailtrap.io) sähköpostien välitykseen)
        Mailtrap->TESTATTAVA UUDELLEEN
### TEHTÄVÄNANTO 23.09.2022: 
    Kokeile sähköpostin lähetystä myös SendGridilla.-> EI TEHTY

### TEHTÄVÄNANTO 26.09.2022:
    Yhdistä Github:n main-haara Azureen, vie tietokanta Azureen ja hae omassa tiedostossa $_SERVER-supermuuttujalla tunnukset pilvessä


    


## Ongelmat
Gmail API: 
Google Cloud->APIs and Services->Credentials->Create Oauth Client Id-> Ei huoli localhostia: Invalid Redirect: must contain a domain. 

Gmail SMTP: 
    Less Secure Apps-vaihtoehto poistettu käytöstä? https://myaccount.google.com/lesssecureapp https://support.google.com/accounts/answer/6010255

Sendgrid SMTP Relay:
Seuraava virhe PHPMailer-kirjastolla, [SendGrid-kirjasto](https://docs.sendgrid.com/for-developers/sending-email/quickstart-php) pakollinen? Täysien oikeuksien kytkeminen päälle ei auttanut:

    SMTP connect() failed. https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting
    2022-09-23 21:59:14 SMTP ERROR: Failed to connect to server: Yhteyden muodostamisyritys epäonnistui, koska vastapuoli ei vastannut oikein määritetyn ajan kuluessa, tai aiemmin muodostettu yhteys epäonnistui, koska palvelin, johon yritettiin muodostaa yhteys, ei vastannut (10060)

Seuraava virhe [SendGrid](https://github.com/sendgrid/sendgrid-php)-kirjastolla kun käytetään SMTP Relayn tunnuksia:

    403 Array ( [0] => HTTP/1.1 403 Forbidden [1] => Server: nginx [2] => Date: Fri, 23 Sep 2022 23:32:45 GMT [3] => Content-Type: application/json [4] => Content-Length: 281 [5] => Connection: keep-alive [6] => Access-Control-Allow-Origin: https://sendgrid.api-docs.io [7] => Access-Control-Allow-Methods: POST [8] => Access-Control-Allow-Headers: Authorization, Content-Type, On-behalf-of, x-sg-elas-acl [9] => Access-Control-Max-Age: 600 [10] => X-No-CORS-Reason: https://sendgrid.com/docs/Classroom/Basics/API/cors.html [11] => Strict-Transport-Security: max-age=600; includeSubDomains [12] => [13] => ) {"errors":[{"message":"The from address does not match a verified Sender Identity. Mail cannot be sent until this error is resolved. Visit https://sendgrid.com/docs/for-developers/sending-email/sender-identity/ to see the Sender Identity requirements","field":"from","help":null}]}

Sendgrid API:

    Sendgrid:n Email API vaatii PHP-version 5.6 tai 7.0 (24.09.2022)?

    