# simple-cms

## Arbetsmetod
Alla ändringar av README.md görs direkt i `master` på GitHub och inte lokalt eller i andra brancher.

### Versionshantering
En annan person i gruppen måste alltid godkänna innan något pushas in i `master`. På det sättet håller vi `master` så buggfri som möjligt. Commits skrivs helst på engelska. Vi arbetar enligt följande mönster:
1. Skapa en ny `branch` varje gång du ska arbeta på en ändring i appen. Enklast är att namnge branchen så den indikerar vilken ändring du arbetar på. Ex, om du arbetar med footern döper du din nya branch till `footer`. Använd [A-Za-z] för namngivning av branches, alltså inga siffror, speciella tecken eller å,ä,ö.
2. Versionshantera lokalt på det sättet som passar dig bäst men det kan vara en säkerhetsåtgärd att göra commits med jämna mellanrum.
3. Innan du pushar upp din nya branch så måste du alltid göra en `git pull` på din `master` branch, så den alltid är uppdaterad.
4. Lös eventuella merge conflicts.
5. Pusha upp din nya branch till GitHub.
6. Gör en pull request från din nya branch intill `master`.

Mergea en pull request:
1. Meddela i Slack att du ska göra en review så det inte blir några kollisioner.
2. Öppna pull requesten och tryck på "Add your review". Läs igenom ändringarna.
3. Godkänn om det ser bra ut eller lämna kommentar om något behöver ändras.
4. Tryck på &#8964; på mergeknappen och välj "squash and merge" för att slå ihop alla commits till en.
5. Ta bort den gamla branchen

### Naming conventions & best practice
* Försök hålla liknande syntax som resten av dokumentet.
* Namnge funktioner med `snake_case` och variabler med `camelCase`. Klasser ska börja med stor bokstav, t.ex. `class User`.
* JavaScript ska hellst skrivas i ES6. Försök följa AirBnb:s [styleguide](https://github.com/airbnb/javascript).
* Försök använda Bootstraps färdiga CSS-klasser så mycket som möjligt. Namnge dina egna klasser likt Bootstrap gör. I övrigt försök följa AirBnb:s [styleguide](https://github.com/airbnb/css).

## Mapp och filstruktur
Grundstruktur. Kan komma att ändras under arbetets gång.
* `app` - Huvudinnehåll
  - `resources` - Stödfiler
    - `error.php` - Errorhantering i utvecklingssyfte
    - `pdo.php` - Uppkoppling till databasen
    - `password.php` - Lösenord för anslutning till databasen. OBS! Ska endast ligga lokalt
  - `validation` - Validation för användare
    - `new_user.php` - Postar en användare till databasen baserad på klassen `User`
    - `validate_login.php` - Validarar inloggningen av en användare
  - `views` - Allt visuellt
    - `page`
      - `show.php` - Visningssida för varje post
    - `public` - Det som alla ser
      - `login.php` - Loginformulär för existerande användare
      - `register.php` - Formulär för att skapa en ny användare
    - `templates` - Mallar som används på många sidor
      - `footer.php` - Footer
      - `header.php` - Header
    - `user` - Det som bara inloggad användare ser
      - `add.php` - Lägga till en post
      - `edit.php` - Ändra en post
      - `list.php` - Översikt över sina individuella posts
    - `home.php` - Visning av appens landingssida
  - `classes.php` - Klasser för att skapa posts och användare
  - `functions.php` - Hjälpfunktioner som exempelvis lösenordshashing
  - `start.php` - Länkar ihop allt i `app` och sätter rootmappar för projektet
* `assets` - Icke-php innehåll
  - `js`
  - `css`
* `public` - Funktionalitet för sidor som alla ser (Se `public` under `views` för mer info)
  - `login.php`
  - `register.php`
* `user` - Funktionalitet för sidor som bara användare ser (Se `user` under `views` för mer info)
  - `add.php`
  - `edit.php`
  - `list.php`
* `index.php` - Funktionalitet för appens landningssida
* `page.php` - Funktionalitet för varje post

## Upplägg & struktur

Anteckningar från 27/4

### idé

Slutprodukten är tänkt att bli en blogg om Front end / webbutveckling där vi i gruppen kan posta tips o tricks inom vårt område, intressanta artiklar vi läst etc. Ambitionen är att lägga upp sidan live så att den kan bli en del av våra portfolios.

### Sidor / flödesschema

* [Wireframe här](https://drive.google.com/file/d/0B-YWuZQGy3G2VXpyRkZTQmRhbzg/view?usp=sharing)
* [Mockup - Blogg](https://drive.google.com/file/d/0B-YWuZQGy3G2ZTgzMENmdWNpQ0E/view)
* [Mockup - Log in edit page](https://drive.google.com/open?id=0B-YWuZQGy3G2c0VvUXdMRFBXSFk)

### Databas

Setup för att köra localhost + db i molnet: [logga in](https://www.heliohost.org) och välj 'remote mySQL' i panelen. Lägg till din publika IP till listan. I panelen finns också phpMyAdmin mm.

host: [johnny.heliohost.org](johnny.heliohost.org)
db: phpgrupp_cms
user: phpgrupp
pass: se slack

```php
$pdo = new PDO(
    "mysql:host=johnny.heliohost.org;dbname=phpgrupp_cms;charset=utf8",
    "phpgrupp",
    "xxxxxxxx"
    );
```

#### tabeller

Ligger i databasen

##### users

* _user\_id_ -- `INT, PRIMARY, A_I`
* _username_ -- `VARCHAR, LENGTH 30, UNIQUE`
* _password_ -- `VARCHAR, LENGTH 260`
* _firstname_ -- `VARCHAR, LENGTH 30`
* _lastname_ -- `VARCHAR, LENGTH 30`
* _email_ -- `VARCHAR, UNIQUE, LENGTH 50`
* _description_ -- `TEXT ("om mig", typ)`
* _profession_ -- `VARCHAR, LENGTH 50` (ex "Front end student")
* _picture_ -- `VARCHAR, LENGTH 260` (länk/hash om vi får det att funka....)
* _created_ -- `TIMIESTAMP, CURRENT_TIMESTAMP`
* _is\_admin_ -- `BOOLEAN`

##### posts

* _post\_id_ -- `INT, PRIMARY, A_I`
* _user\_id_ -- `INT`, foreign key --> users (`ON DELETE RESTRICT RESTRICT, ON UPDATE CASCADE`) *
* _title_ -- `VARCHAR, LENGTH 26` (rubrik)
* _summary_ -- `TEXT` (ingress/pufftext)
* _body_ -- `TEXT` (brödtext)
* _tags_ -- `VARCHAR, LENGTH 260` (taggar, separerade av komma)
* _date_ -- `TIMESTAMP, CURRENT_TIMESTAMP`

##### likes

* _post\_id_ -- `INT`, foreign key --> posts (`ON DELETE RESTRICT , ON UPDATE CASCADE`) *
* _user\_id_ -- `INT`, foreign key --> users (`ON DELETE RESTRICT, ON UPDATE CASCADE`) *

\* bestämmer vad som händer om vi försöker ta bort/ändra id på en användare/post som är länkad i en annan tabell. Vi får kolla vilken option som är bäst, Kan ändras under 'relation view'.

### Klasser

* `User` --> `functions`: posta inlägg, like:a, redigera sin profil, ta bort sitt konto...
  * `Contributor extends User`
  * `Admin extends User`

* `Post` --> `new Post(header, summary, body etc...)`

## Bibliotek

* [Bootstrap 4 alpha](https://v4-alpha.getbootstrap.com/)
* [TinyMCE](https://www.tinymce.com/docs/)

## Länkar

* [Instruktioner](https://github.com/FEND16/cms-php-mysql/blob/master/group_assignment_simple_cms.md)
* [Trello](https://trello.com/b/tEPopVij/php-gruppuppgift)
* [PHP Dokumentation](http://php.net/docs.php)
* [molnserver](https://www.heliohost.org)
* mejl: phpgruppuppgift@gmail.com

## Bra-att-ha-resurser

* [CMS video tutorial](https://www.youtube.com/watch?v=UbsAdx58ch0&list=PLfdtiltiRHWF0O8kS5D_3-nTzsFiPMOfM)
* [PHP creating a blog](https://thenewboston.com/videos.php?cat=74&video=19652)
