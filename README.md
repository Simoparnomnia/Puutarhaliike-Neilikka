
# TAUSTATIETOA

ENGLISH: Experimental website for the fictional company Neilikka. Part of Omnia's web programming (Web-ohjelmointi) course (autumn 2022).

Kokeellinen kotisivu kuvitteelliselle Neilikka-puutarhaliikkeelle. Osa Omnian Web-ohjelmointi kurssia (syksy 2022). Palvelinalustana [XAMPP](https://www.apachefriends.org/). Käyttää PHPMailer-kirjastoa ja [Mailtrap](https://mailtrap.io)-palvelua (SMTP) yhteydenottopyyntöjen sähköpostitukseen. Tietokantana MySQL/MariaDB.

# HAKEMISTOT
Omat moduulit:
Kirjastot: Valmiskirjastot (PHPMailer.php ja SMTP.php ja Exception.php)

# ASENNUSOHJEET
Varmista että [XAMPP](https://www.apachefriends.org/) on asennettu ja repositorio on kloonattu XAMPP:N htdocs-kansioon.

Luo repositorion kloonauksen jälkeen seuraavat tiedostot kansioon Omat moduulit: Tietokantayhteys.php ja Sähköpostiyhteys.php

## Sähköpostipalvelun asetus

### Gmail API



### SMTP, sähköpostiviestit ilman 2-vaiheista tunnistautumista
[Sähköpostin asetusohjeet SMTP:llä 1](https://netcorecloud.com/tutorials/send-an-email-via-gmail-smtp-server-using-php/)
[Sähköpostin asetusohjeet SMTP:llä 2](https://phppot.com/php/send-email-in-php-using-gmail-smtp/)

HUOM: Muista asettaa 2 vaiheinen tunnistautuminen ja less secure apps
takaisin päälle jos ratkaisu löytyy Gmail API:lle.

### Sendgrid

### Mailtrap (SMTP)

Sandbox->Inboxes->SMTP settings


## Tietokantayhteys.php

## Lähetäsähköposti.php


# TODO
-navigointipalkin modularisointi, indikointi jokaisella sivulla missä päin verkkosivustoa ollaan (breadcrumbs?) (ks. $SERVER['SCRIPT_FILENAME'])
-TEHTÄVÄNANTO 22.09.2022: sähköpostin lähetys ylläpitäjälle yhteydenottolomakkeelta (ks. kurssi2102 repo -> PHPmailer.php, SMTP.php sekä sähköpostipalvelu (gmail (SMTP tai OAuth)/SendGrid API/Mailtrap.io) sähköpostien välitykseen)



# ONGELMAT
Gmail API: Google Cloud->APIs and Services->Credentials->Create Oauth Client Id-> Ei huoli localhostia: Invalid Redirect: must contain a domain. 

Gmail SMTP: Less Secure Apps-vaihtoehto poistettu käytöstä? https://myaccount.google.com/lesssecureapp https://support.google.com/accounts/answer/6010255