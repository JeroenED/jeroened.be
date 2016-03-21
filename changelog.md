# Changelog JeroenED.be
## Scrumreport 2016-04
Nu de draad eindelijk terug opgenomen is heb ik weer wat zichtbaardere wijzigingen doorgevoerd. Zo is o.a. de behandeling van de changelog opgenomen in symfony waardoor deze op de normale plaats kan worden gezet en is eindelijk de source-view van CKeditor gevuld met syntax coloring.

### Issues
* (none)

### Nieuwe functies
* enabled reading view on Changelog

### Belangrijke wijzigingen
* New URI for changelog (`changelog` instead of `changelog.md`)
* Nieuwe fout-paginas's

## Scrumreport 2016-03
Na lange periode eindelijk nog eens een update. Weliswaar een update achter de schermen namelijk een upgrade naar symfony 3. Daarnaast zijn de fout-pagina's onder handen genomen.

### Issues
* (none)

### Nieuwe functies
* (none)

### Belangrijke wijzigingen
* Update naar Symfony 3
* Nieuwe fout-paginas's

## Scrumreport 2015-11
Eindelijk een grafische update. Voor de eerste keer sinds het online komen van de website is er een grafische update. Het hoofdlettertype is gewijzigd. Een andere belangrijke wijziging: een Git-flow systeem. Met andere woorden: geen minuut stilgezeten.

### Issues
* (none)

### Nieuwe functies
* #13 Add slug to duplicate page-names

### Belangrijke wijzigingen
* Git flow system
* Nieuw lettertype
* Updated start-data (Git-issue)

## Scrumreport 2015-10
Geen zware wijziginging dit keer. De enige wijziging is een kleine JavaScript-edit op hoe de pagina's worden geopent.
De echte wijzigingen zijn de overstap naar Linux als main-OS en de overstap naar VMWare als Hypervisor voor de virtuële machine

### Issues
* (none)

### Nieuwe functies
* (none)

### Belangrijke wijzigingen
* (none)

## Scrumreport 2015-09
Deze sprint stond in het teken van best practices. Vele zaken die normaal anders zouden moeten, zijn nu gebeurd.

### Issues
* (none)

### Nieuwe functies
* (none)

### Belangrijke wijzigingen
* scss-files moeten op voorhand gedumpt worden in plaats van "on-the-fly"
* Niet bestaande pagina's zijn geven status-code 404 in plaats van 200 pagina met tekst "page not found"
* A lot of desktop/mobile optimizations

## Scrumreport 2015-08
Voor de sprint van augustus had wat extra zaken in gedachten. Zo is er ondersteuning voor scss ingebouwd en word automatisch minified javascript gegenereerd.
Daarnaast is symfony geüpdate naar de laatste versie (2.7) en is ervoor gezorgd dat er geen wijzigingen in composer.json moeten worden doorgevoerd om de laatste versie te kunnen installeren.

### Issues
* #11: Media query for touch-devices is not reliable for tablets (Thanks to Marie-Jeanne Thys)

### Nieuwe functies
* Ondersteuning voor scss
* Automatisch minified Javascript
* Stylesheet voor media Print

### Belangrijke wijzigingen
* Upgrade naar Symfony 2.7
* Versienummer uitgebreid met monthstamp
* Venster vergrootten of verkleinen sluit niet meer de pagina

## Scrumreport 2015-07
De eerste sprint is afgelopen. Alle bug reports die zijn gemeld zijn opgelost.

### Issues
* #8: Encrypt email-addresses to prevent e-mail harvesting
* #9: Connect CKEditor to KCFinder
* #10: Fugly border around embedded images

### Nieuwe functies
(geen)

### Vooruitzicht naar volgende sprint
Op dit moment is er slechts 1 bug gemeld. Daarnaast zal er worden gewerkt aan stylesheet voor afdrukken van pagina's

