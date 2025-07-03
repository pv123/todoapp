INSTALACJA TODOAPP

1. Utworzyć bazę danych o nazwie 'todoapp'
2. Przejść do folderu 'c:\xampp\htdocs' 
3. Uruchomić git clone https://github.com/pv123/todoapp
4. Wyedytować plik .env sekcję dotyczącą bazę danych. Na przykłąd takie dane zadziałają:

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=pawela1221@gmail.com
MAIL_PASSWORD='uazs bibh yyxy yssk'
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=pawela1221@gmail.com
MAIL_FROM_NAME="TODOAPP"

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=todoapp
DB_USERNAME=root
DB_PASSWORD=hasło
	
5. Uruchomić migrację baz danych: 'php artisan migrate'
6. Dodać wpis do tabeli CRON:
    
    * * * * * cd /path/to/your/project && php artisan schedule:run >> /dev/null 2>&1
    
    zmienić ścieżkę na folder główny aplikacji
    
7. Przejść pod adres: http://localhost/todoapp/public
