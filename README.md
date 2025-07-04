INSTALACJA TODOAPP

1. Utworzyć bazę danych o nazwie 'todoapp'
2. Przejść do folderu 'c:\xampp\htdocs' 
3. Uruchomić git clone https://github.com/pv123/todoapp
4. Wyedytować plik .env sekcję dotyczącą bazę danych.
	
5. Uruchomić migrację baz danych: 'php artisan migrate'
6. Dodać wpis do tabeli CRON:
    
    * * * * * cd /path/to/your/project && php artisan schedule:run >> /dev/null 2>&1
    
    zmienić ścieżkę na folder główny aplikacji
    
7. Przejść pod adres: http://localhost/todoapp/public
