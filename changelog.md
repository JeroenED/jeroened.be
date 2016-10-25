# Changelog JeroenED.be

## Changelog 2016-10

Deze maand geen extreme wijzigingen in de website buiten 1 bug die rindelijk gefixt is.

Daarnaast is er omwille van EOL status van PHP 5.5, PHP geüpgrade naar 5.6.

De belangrijkste wijzigingen zijn off-code, namelijk de komst van issue-templates en de ingebruikname van "The Beast", mijn nieuwe computer.

### Bugs
* Scrollbar fails to load(#33)

### Nieuwe functies
* (none)

### Verbeteringen
* #34: Upgrade to php-5.6

### Off-code wijzigingen
* #32: Create issue templates
* Ingebruikname "The Beast"

## Changelog 2016-09

Deze maand stond in het teken van één feature die geïmplementeerd werd. Een feature request die hoog op het verlanglijstje stond: 2-factor authenticatie. Bij deze is dit geïmplementeerd :)

### Bugs
* (none)

### Nieuwe functies
* #15: Two-Factor authentication (project)
* #31: Deactivate accounts (project) 

### Verbeteringen
* (none)

### Off-code wijzigingen
* (none)

## Changelog 2016-08 (Bugs Bunny)

Omwille van de vele bugs die de voorbije dagen zijn ontdekt heb ik beslist om een tussentijdse release te doen met als naam "Bugs Bunny".

Dus, een kat is geen mus en werden bugs geplet. Er zijn niet minder dan 7 bugs geplet, 1 verbetering aangebracht, en dan zijn er nog 2 projecten afgewerkt

### Bugs
* #21: Download field should not be required
* #23: Height of vertical navigation does not equal the document height 
* #24: Design bug when moving a portfolio item 
* #25: style not applied anymore when changing background of portfolioitem
* #26: ElFinder not closable
* #27: Add a page link when page is open does not clear current page
* #28: Jquery-UI Broken

### Nieuwe functies
* #30: Extend deploy.sh script with more options 

### Verbeteringen
* #22: Add browse button to fields pointing to files (project)
* #29: Updating order of menu is not intuitive

### Off-code wijzigingen
* (none)

## Changelog 2016-08

Nieuwe maand, nieuwe update.

Er zijn wat wijzigingen gebeurt buiten de code om. Zo zal nu elke wijziging als een issue worden vermeld in de Issue-tracker in Gitlab en zijn de nodige tags hiervoor gecreëerd. Ook ben ik terug beginnen gebruik te maken van milestones.

Op code-vlak is er een belangrijke wijziging gebeurt waarbij het nu mogelijk is om een relevante download mee te geven. Op een contact-pagina kan dit bijvoorbeeld een PGP-key zijn, of op de resume-pagina een PDF-versie van de resume.

Daarnaast is een opvallende wijziging dat kcfinder eruit geknikkerd is en vervangen is door het beheerbaardere ElFinder.

### Bugs
* (none)

### Nieuwe functies
* #17: Add link to page to download relevant extra's 

### Verbeteringen
* #16: Confirming a portfolio edit while a page is open should give a warning
* #18: Button for updating a portfoliopage should be modified according to situation
* #19: Drop html5shiv from base code 
* #20: Replacing KcFinder 

### Off-code wijzigingen
* Gitlab meer betrokken bij ontwikkelingsproces

## Changelog 2016-07
Een kleine update deze maand. Het belangrijkste deze maand is dat gitlab-ci is geïntegreerd en volledig actief. Deze release is dan ook via CI gedeployed.

### Issues
* #??: Could not update order of portfolio.

### Nieuwe functies
* CI

### Belangrijke wijzigingen
* Deployment gebeurt nu via CI.

## Changelog 2016-06
Deze maand is de laatste commit gedaan voor het afwerken van het archief. Meer bepaald het toevoegen van het archief aan het administratiepaneel. Dan is er ook een aanpassing op de mainpage waarbij de paginatitel van een pagina op de titelbalk verschijnt bij het openen. Daarnaast is er ook een probleem opgelost waarbij pagina's heropent werden na het sliden door de presentatie.

### Issues
* #14: Page is loaded over and over again when sliding through presentation

### Nieuwe functies
* Archief-weergave in administratiepaneel
* Pagina-titel in titelbalk.

### Belangrijke wijzigingen
* (none)

## Changelog 2016-05
Deze maand een belangrijke functie geïmplementeerd: de vorige- en volgende knop is volledig werkende. Daarnaast is de uri van de pagina's gewijzigd en staat de fugly "/page" er niet meer bij.

### Issues
* (none)

### Nieuwe functies
* Vorige- en Volgende-knoppen zijn werkende

### Belangrijke wijzigingen
* URI van pagina's gewijzigd naar /{{ slug }}

## Changelog 2016-04
Na de uitzonderlijke B-for-Brussels release van vorige maand weer een iets normalere release. Wijzigingen zijn vooral in het administratiepaneel te vinden. Ook is er een issue van het archief gefixet waarbij de closepage functie niet reageerde zoals zou moeten.

### Issues
* (none)

### Nieuwe functies
* SASS geactiveerd op administratie paneel

### Belangrijke wijzigingen
* De fugly overloop op de homepage is eindelijk verwijderd
* Css in CKeditor is toegepast

## Changelog 2016-03 (B-for-Brussels)
Omwille van de recente gebeurtenissen in Brussel heb ik beslist om een tussentijdse release te doen van de laatste wijzigingen. De wijzigigingen zijn zichtbaarder dan de vorige release en omvatten een archiveringsfunctie en de activatie van de leesweergave op de changelog. Daarnaast is de changelog verplaatst naar een iets logischere locatie en is syntax coloring eindelijk geactiveerd in de bron weergave van CKeditor.

### Issues
* (none)

### Nieuwe functies
* Lezersweergave geactiveerd op changelog.
* Archiveren 

### Belangrijke wijzigingen
* Nieuwe URL voor changelog (changelog in plaats van changelog.md)
* Syntax coloring in CKeditor

## Changelog 2016-03
Na lange periode eindelijk nog eens een update. Weliswaar een update achter de schermen namelijk een upgrade naar symfony 3. Daarnaast zijn de fout-pagina's onder handen genomen.

### Issues
* (none)

### Nieuwe functies
* (none)

### Belangrijke wijzigingen
* Update naar Symfony 3
* Nieuwe fout-paginas's

## Changelog 2015-11
Eindelijk een grafische update. Voor de eerste keer sinds het online komen van de website is er een grafische update. Het hoofdlettertype is gewijzigd. Een andere belangrijke wijziging: een Git-flow systeem. Met andere woorden: geen minuut stilgezeten.

### Issues
* (none)

### Nieuwe functies
* #13 Add slug to duplicate page-names

### Belangrijke wijzigingen
* Git flow system
* Nieuw lettertype
* Updated start-data (Git-issue)

## Changelog 2015-10
Geen zware wijziginging dit keer. De enige wijziging is een kleine JavaScript-edit op hoe de pagina's worden geopent.
De echte wijzigingen zijn de overstap naar Linux als main-OS en de overstap naar VMWare als Hypervisor voor de virtuële machine

### Issues
* (none)

### Nieuwe functies
* (none)

### Belangrijke wijzigingen
* (none)

## Changelog 2015-09
Deze sprint stond in het teken van best practices. Vele zaken die normaal anders zouden moeten, zijn nu gebeurd.

### Issues
* (none)

### Nieuwe functies
* (none)

### Belangrijke wijzigingen
* scss-files moeten op voorhand gedumpt worden in plaats van "on-the-fly"
* Niet bestaande pagina's zijn geven status-code 404 in plaats van 200 pagina met tekst "page not found"
* A lot of desktop/mobile optimizations

## Changelog 2015-08
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

## Changelog 2015-07
De eerste sprint is afgelopen. Alle bug reports die zijn gemeld zijn opgelost.

### Issues
* #8: Encrypt email-addresses to prevent e-mail harvesting
* #9: Connect CKEditor to KCFinder
* #10: Fugly border around embedded images

### Nieuwe functies
(geen)

### Vooruitzicht naar volgende sprint
Op dit moment is er slechts 1 bug gemeld. Daarnaast zal er worden gewerkt aan stylesheet voor afdrukken van pagina's

