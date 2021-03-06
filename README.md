# simple-cms

En blogg om webbutveckling med inriktning på front end där man kan posta tips och tricks, intressanta artiklar, etc.

## Grundfunktioner
* Lägga till nya _posts_, en _post_ kan vara ett blogginlägg, artikel eller liknande.
* Ni har en sida där man kan se alla _posts_ samt kunna se när innehållet är skapat och av vem innehållet är skapat.
* Ta bort samt redigera existerande _posts_.
* Logga in och logga ut med olika användare som har olika roller.
    - Det ska finnas minst två roller: __admin__ och vanlig användare.
    - Man ska __inte__ kunna regga sig med samma användarnamn eller email flera gånger.
* Bara den användaren som har skapat en viss _post_ kan redigera eller ta bort den. Alternativt så kan man ta bort den om man har admin-rättigheter.
* En användare ska kunna _gilla_ eller på något sätt rösta på varje _post_.
    - En användare ska __inte__ kunna rösta på samma _post_ flera gånger.
    - En användare ska kunna ta bort sin röst från en _post_.
    
## Extra funktioner
* Automatisk utloggning efter 30 minuters inaktivitet
* Lägga till taggar på posts
* Stängd access via url
* Se en specifik användares poster
* Se poster baserat på taggar
* Bildlänk för användarprofil
* Användare kan ta bort sitt konto
* Admin kan se alla poster som inte är skapade av en annan admin och ta bort dem
* Admin kan se alla användare som inte är admin och ta bort deras konto
* Redigering av användarprofil
* Information om när varje post är senast uppdaterad
* Lösenordshashing
* Escapefunktioner

## Klasser

* `User` --> Modifiera _en_ användare. Skapa användare, redigera sin profil...
  * `Admin extends User`
* `Users.php` - Hanterar hämtar/användare. get_full_user() etc...

* `Post` --> Skapa/editera poster. `new Post()`
* `Posts` --> Hantera/hämtar en eller flera poster. get_all_posts(), get_full_post() etc... 

* `Likes` --> Hanterar likes.

## Mapp och filstruktur
* `app` - Huvudinnehåll
  - `classes` - Klasser
    - `post.php` - Hanterar _en_ enskild post: Skapar ny m konstruktor + metoder för att lägga till samt uppdatera i databas
    - `posts.php` - Hanterar urval av poster: metoder för att hämta alla, hämta en etc.
    - `user.php` - Hanterar _en_ användare: skapar + lagrar i db.
    - `users.php`
    - `likes.php`
  - `views` - Allt visuellt
    - `page`
      - `show.php` - Visningssida för varje post
    - `public` - Det som alla ser
      - `login.php` - Loginformulär för existerande användare
      - `register.php` - Formulär för att skapa en ny användare
      - `templates` - Mallar som används på många sidor
        - `footer.php` - Footer
        - `header.php` - Header
        - `sidebar.php` - Sidebar
    - `user` - Det som bara inloggad användare ser
      - `add.php` - Lägga till en post
      - `edit.php` - Ändra en post
      - `list.php` - Översikt över sina individuella posts
      - `templates` - Mallar som används på många sidor
        - `footer.php` - Footer
        - `header.php` - Header
        - `sidenav.php`
    - `home.php` - Visning av appens landingssida
  - `libs`
    - `htmlpurifier-4.9.2-standalone`
    - `HTMLPurifier.standalone.php`
  - `ajax.php` - jQuery ajax request för navigation mellan posts
  - `functions.php` - Hjälpfunktioner som exempelvis lösenordshashing
  - `password.php` - Lösenord för anslutning till databasen. **OBS!** Ska endast ligga lokalt!
  - `start.php` - Länkar ihop allt i `app`: Rootmappar för projektet. Visar error `ini_set(display_errors)`.`PDO`-objektet, Uppkoppling till databasen.
* `assets` - Icke-php innehåll
  - `css`
    - `clean-blog.min.css`
    - `dashboard.css`
    - `main.css`
  - `js`
    - `editor.js` - JS för att köra WYSIWYG-editor
    - `ajax.js`
    - `ajax-like.js`
    - `clean-blog.min.js`
    - `delete-alerts.js`
  - `img`
  - `sql`
    - `backup-db.sql` - lokal databas
* `public` - Funktionalitet för sidor som alla ser (Se `public` under `views` för mer info)
  - `login.php` - Hanterar o validerar loginförsök
  - `register.php` - Postar en användare till databasen baserad på klassen `User`
  - `about.php`
  - `contact.php`
  - `logout.php`
  - `tag.php`
  - `user.php`
* `user` - Funktionalitet för sidor som bara användare ser (Se `user` under `views` för mer info)
  - `add.php` - Postar ett inlägg till databasen baserad på klassen `Post`
  - `delete.php` - Tar bort ett inlägg
  - `edit.php` - Uppdaterar ett inlägg till databasen baserat på klassen `Post`
  - `list.php` - Hanterar en användares posts
  - `admin_posts_list.php`
  - `admin_users_list.php`
  - `delete_user.php`
  - `edit_user.php`
  - `like.php`
* `index.php` - Funktionalitet för appens landningssida
* `page.php` - Funktionalitet för varje post

## Databasstruktur

### users

* _user\_id_ -- `INT, PRIMARY, A_I`
* _username_ -- `VARCHAR, LENGTH 30, UNIQUE`
* _password_ -- `VARCHAR, LENGTH 260`
* _firstname_ -- `VARCHAR, LENGTH 30`
* _lastname_ -- `VARCHAR, LENGTH 30`
* _email_ -- `VARCHAR, UNIQUE, LENGTH 50`
* _description_ -- `TEXT ("om mig", typ)`
* _profession_ -- `VARCHAR, LENGTH 50`
* _picture_ -- `VARCHAR, LENGTH 260`
* _created_ -- `TIMIESTAMP, CURRENT_TIMESTAMP`
* _is\_admin_ -- `BOOLEAN`

### posts

* _post\_id_ -- `INT, PRIMARY, A_I`
* _user\_id_ -- `INT`, foreign key --> users (`ON DELETE CASCADE, ON UPDATE NOTHING`)
* _title_ -- `VARCHAR, LENGTH 26` (rubrik)
* _body_ -- `TEXT` (brödtext)
* _tags_ -- `VARCHAR, LENGTH 260` (taggar, separerade av komma)
* _created_ -- `TIMESTAMP, CURRENT_TIMESTAMP`
* _updated_ -- `TIMESTAMP, DEFAULT NULL`

### likes

* _like\_id_ -- `INT, PRIMARY, A_I`
* _post\_id_ -- `INT`, foreign key --> posts (`ON DELETE CASCADE , ON UPDATE NOTHING`)
* _user\_id_ -- `INT`, foreign key --> users (`ON DELETE CASCADE, ON UPDATE NOTHING`)


## Bibliotek

* [Bootstrap 4](https://v4-alpha.getbootstrap.com/)
* [TinyMCE](https://www.tinymce.com/docs/)
* [HTML Purifier](http://htmlpurifier.org)
* [Sweet Alert](https://limonte.github.io/sweetalert2/)

## Andra resurser

* [Projektplan](https://trello.com/b/tEPopVij/php-gruppuppgift)
* [Molnserver](https://www.heliohost.org)


## Wireframe/Mockups

* [Wireframe](https://drive.google.com/file/d/0B-YWuZQGy3G2VXpyRkZTQmRhbzg/view?usp=sharing)
* [Mockup - Blogg](https://drive.google.com/file/d/0B-YWuZQGy3G2ZTgzMENmdWNpQ0E/view)
* [Mockup - Log in edit page](https://drive.google.com/open?id=0B-YWuZQGy3G2c0VvUXdMRFBXSFk)

