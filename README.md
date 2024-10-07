# wiki-autorzy

## Opis
**wiki-autorzy** to aplikacja, która podaje listę autorów danego artykułu w Wikipedii. Możesz podać jeden z dwóch parametrów: `oldid` lub `page_name`. Narzędzie pozwala uzyskać autorów na podstawie identyfikatora wersji artykułu lub jego tytułu.

## Parametry
- `oldid` (opcjonalny) - identyfikator wersji artykułu w Wikipedii. Możesz uzyskać go z linku stałego (do danej rewizji artykułu).
- `page_name` (opcjonalny) - tytuł artykułu w Wikipedii.

Przynajmniej jeden z tych parametrów jest wymagany do działania aplikacji.

## Przykłady użycia
- Autorzy dla artykułu "Astronomia" wg stanu na dzień 28 lutego 2007:
  - [https://authors.toolforge.org/?oldid=6765334](authors.toolforge.org/?oldid=6765334)
  
- Autorzy dla strony z tytułem "Szablon:Szablon nawigacyjny" (aż do najnowszej wersji):
  - [https://authors.toolforge.org/?page_name=Szablon:Szablon_nawigacyjny](authors.toolforge.org/?page_name=Szablon:Szablon_nawigacyjny)

## Licencja
Patrz: `.info.php`
