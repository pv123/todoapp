1. CRUD:
Został utworzony:
- kontroller Task zawierający akcje dla CRUD
- widoki zgodnie z kontrolerem
- routing dla akcji

2. Przeglądanie zadań:
- Zadania można przeglądać po dacie wykonania, statusie, priorytecie

3. Powiadomienia e-mail:
Został utworzony komponent mail dla wysyłania maili o terminie tasków.
Został utworzony wpis cron uruchamiający schedulera laravel

4. Walidacja:

5. Obsługa wielu użytkowników:
    Każdy użytkownik ma możliwość zalogowania się i zarządzania własnymi zadaniami.
    zostałą zaimplementowana biblioteka BREEZE
    
6. Udostępnianie zadań bez autoryzacji za pomocą linka z tokenem dostępowym:
    Użytkownik może wpisać mail i utworzyć dla niego link publiczny.
    Za pomocą linku publicznego adrresat może obejrzeć zadanie bez logowania
