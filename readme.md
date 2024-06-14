

Instalacja
composer create-project symfony/skeleton:"6.2.*" my_project_directory

cd my_project_directory

composer require webapp


Uruchomienie aplikacji: 
php -S localhost:8000 -t public/
npm run watch




Routing
Minimalna definicja routingu:

#[Route('/blog')]
    public function list(): Response
    {
        // ...
    }
   

Opcjonalne parametry:

#[Route('/blog/{slug}', name: 'blog_show', methods: ['GET', 'HEAD'])]
    public function show(string $slug = ''): Response
    {
        
    }
 

name - nazwa routa, przyda się przy generowaniu linku w widoku:

{{ path('blog_show', {slug: post.slug}) }}

methods - dopuszczalne metody (domyślnie wszystkie, POST do wysyłania formularzy)

{slug} - w nawiasach klamrowych dynamiczny parametr, jeśli argument funkcji show $slug = '', to parametr jest opcjonalny (jeśli nic nie przypisano do argumentu to jest obowiązkowy)

 

Polecenie konsoli do sprawdzenie jakie routy mamy zdefiniowane:

php bin/console debug:router





Twig
{{ ... }}, dwa podwójne nawiasy klamrowe służą do wyświetlania treści na stronie

{% ... %}, służy do obsłużenia logiki, na przykład wyrażenia if-endif, pętle for i inne

{# ... #}, służy do napisania komentarza w pliku widoku (nie będzie wyrenderowany jak zwykły komnentarz HTML)





Filtry Twig, np.

{{ 'welcome'|upper }}  rezultat: 'WELCOME'

pełna lista filtrów: https://twig.symfony.com/doc/3.x/filters/index.html





Kontrolery
Polecenie do stworzenia kontrolera:

php bin/console make:controller BrandNewController







Baza Danych


Problem N+1 w zapytaniach do bazy danych występuje gdy wyświetlamy dane w pętli - na przykład lista postów na stronie i dla każdego posta chcemy dołączyć nazwisko autora. Czyli jedno zapytanie główne pobierające posty oraz tyle zapytań o użytkowników ile postów czyli N+1 zapytań. Aby temu zapobiec i załatwić wszystko jednym zapytaniem możemy zastosować na przykład:

->leftJoin('p.user','u')  
->addSelect('u')
(nie wystarczy sam leftJoin)







Dependency Injection & Service Container


W Symfony nie musimy tworzyć ręcznie instancji serwisów. Wszystkie one są w specjalnym obiekcie Service Container (kontener z serwisami). Możemy je wydobyć z kontenera i użyć za pomocą Dependency Injection (wstrzykiwanie zależności). Przykład:



use Psr\Log\LoggerInterface;
public function list(LoggerInterface $logger) {
	 $logger->info('Look, I just used a service!'); // use service
}
Aby podejrzeć jakie serwisy możemy w powyższy sposób wstrzykiwać możemy uruchomić polecenie w konsoli:

php bin/console debug:autowiring