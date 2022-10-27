## SISÄLLYSLUETTELO
### Taustatietoa
### Toimintaperiaate
### Hakemistot
### Asennusohjeet
### TODO
### Ongelmat

## Taustatietoa

ENGLISH: Experimental website for the fictional company Neilikka. Part of Omnia's web programming (Web-ohjelmointi) course (autumn 2022).

Kokeellinen kotisivu kuvitteelliselle Neilikka-puutarhaliikkeelle. Osa Omnian Web-ohjelmointi kurssia (syksy 2022). Palvelinalustana [XAMPP](https://www.apachefriends.org/). Käyttää PHPMailer-kirjastoa ja [Twilio Sendgrid-](https:https://mailtrap.docs.apiary.io/#) tai [Mailtrap](https://mailtrap.io)-palvelua (SMTP, vanhentunut?) yhteydenottopyyntöjen sähköpostitukseen. Tietokantana MySQL/MariaDB.

## Toimintaperiaate
### Kredentiaalit
Tietokantakirjautumista ja sähköpostien lähettämistä varten täytyy luoda .env-tiedosto projektin juureen,
katso tiedoston rakenteen kuvaus asennusohjeista. 
### Navigointi
Sivulla ei ikinä poistuta index.php-tiedostosta, näytettävä grafiikka luodaan require-lauseilla ja linkin kyselymuuttujien perusteella.
Sivun navigointipalkki näyttää nykyisen sivun värittämällä kyseisen linkin eriväriseksi.
### Käyttäjänhallinta
Sivulla vierailija voi luoda uuden käyttäjätilin. Käyttäjätilien käyttäjänimien täytyy olla ainutlaatuisia. Sovellus ei myöskään salli
käyttäjän luontia jos annettu sähköposti on jo tietokannassa. Käyttäjillä saa olla sama osoite (perheenjäsenet yms.). Salasanat on tallennettu tietokantaan hash-muodossa.
#### Unohtuneen salasanan palautus
Viesti unohtuneesta salasanasta välitetään Mailgrid-palveluun. Salasanan uudelleenasetuslomaketta ei saada avattua ilman
sähköpostiviestissä lähetetyn linkin sähköposti- ja käyttäjänimihasheja ja silloinkin on tiedettävä vanha salasana kun
päästään salasanan uudelleenasetuslomakkeelle.
#### Muista minut
Jos muista minut-toiminto on käytössä, sivu luo autentikaatio-tokenin evästeen joka myös tallennetaan joka tallennetaan tietokantaan.
Umpeutuneet tokenit poistetaan tietokannasta jos sivu avataan kirjautumattomana ja avaajan koneella ei ole voimassaolevaa evästettä.
### Virheviestit
-Virheviesti jos yritetään avata kirjautumislomaketta ja käyttäjä on jo kirjautunut sisään
-Virheviesti jos yritetään avata salasanan vaihtolomaketta sisäänkirjautuneena
-Virheviesti jos yritetään avata salasanan vaihtolomaketta ilman oikeaa sähköpostiin lähetettyä linkkiä
### Tietokannan rakenne
Useammalla käyttäjällä voi olla sama osoite.
## Hakemistot

### index.php
Sivun grafiikkakomponentit generoidaan ja tietyt tapahtumakäsittelijät kutsutaan täältä käsin.
### Composer
[PHP-riippuvuuksienhallintaan](https://getcomposer.org/)

### Grafiikkakomponentit
index.php:ssä renderöitävät komponentit ja varoitusviestit
### Tapahtumankäsittelijät
Tapahtumankäsittelijät (tietokantayhteys/rekisteröinti/kirjautuminen/sähköpostin lähetys), 
### Tietokannanluontilauseet 
Tietokannan esimerkkimateriaali, käyttäjät täytyy luoda itse omilla INSERT-lauseilla.
### Vendor
Ladatut valmiskirjastot
#### Ympäristömuuttujat
    vlucas/dotenv
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
Luo .env-tiedosto projektin juuren ulkopuolelle seuraavalla sisällöllä.

    MAILSERVICE=käytettäsähköpostipalvelutähän
    MAILTRAPHOSTDOMAIN=mailtrappalvelundomaintähän
    MAILTRAPHOSTUSERNAME=mailtrapkäyttäjätähän
    MAILTRAPHOSTPASSWORD=mailtrapsalasanatähän
    SENDGRIDHOSTDOMAIN=sendgridpalvelundomaintähän
    SENDGRIDHOSTUSERNAME=sendgridkäyttäjätähän
    SENDGRIDHOSTPASSWORD=sendgridsalasanatähän
    DATABASEUSERNAME=tietokannankäyttäjätähän
    DATABASEPASSWORD=tietokannansalasanatähän

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
Käytä .env tunnuksia

### Lähetäsähköposti.php
Käytä .env tunnuksia

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




#### Tietokannan konfiguraatio Azuressa
mysql\data\MYSQLCONNSTR_localdb.ini:
    Database=localdb; Data Source=127.0.0.1:portinnumero; User id=azure; Password=password
#### Tiedostojen muokkaus Azuren App Servicessa
App Service Editor
#### Komentorivi Azuressa
Advanced tools tai Development tools->console

#### Azure-version PHP-tiedot näkyviin
https://kayttajanimi.azurewebsites.net

#### MYSQL-tietokannan konfiguraatio
Configuration ->

Avaa PHPMyAdmin ja suorita seuraava SQL-komento: SET PASSWORD FOR 'root'@'localhost' = PASSWORD ('haluttusalasana')
Salasana tämän jälkeen tiedostoon -> XAMPP Control Panel -> config.inc.php

Luo testikäyttäjiä lisäämällä ne tiedostoon data.sql seuraavassa muodossa:
    INSERT INTO kayttajatili VALUES('kayttajatahan','salasanahashtahan','etunimi','sukunimi','puhelinnumero','sähköposti',osoitteenid,onkotiliaktiivinenboolean,onkokayttajahenkilokuntaaboolean,'2022-01-01 12:00:00',NULL)



## TODO
### navigointi ja navigointipalkin modularisointi 
    -Saadaanko kaikki virheviestit pois index.php:stä hajottamatta sivun toimintalogiikkaa?

### Käyttäjänhallinta
    -Muista minut (autentikointi-token/eväste että säilyy kirjautuneena vaikka selainikkuna suljetaan) ->
        -vielä ei saada näytettyä automaattisen kirjautumisen epäonnistumisen tapauksessa virheviestiä
        -Jos selaineväste on voimassa, kirjaudutaan sisään automaattisesti heti ulokirjautumisen jälkeen
        - Jos tokenia ei löydy tietokannasta, uloskirjautuminen ohjaa XAMPP:n dashboardiin hypätään 
        

### Virheviestit
    -Virheviesti jos yritetään avata kirjautumislomaketta ja käyttäjä on jo kirjautunut sisään -> EI NÄYTÄ VIRHEVIESTIÄ JOS ON KIRJAUDUTTU JA AUTENTIKAATIOTOKEN-EVÄSTE ON VIELÄ VOIMASSA
    
### Sähköpostin lähetys
    [Mailtrap V1.0 on poistunut käytöstä joskus 13.10.2022 jälkeen, vaihda V2.0:n tai muuta Sendgridiin](https://mailtrap.docs.apiary.io/#)
### Tietokanta
    -SQL-injektioiden ehkäisy (Prepared statements) -> TEHTY
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

    