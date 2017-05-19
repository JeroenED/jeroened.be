# Changelog JeroenED.be

## Changelog 2017-05
Update mei 2017. 2 belangrijke off-code wijzigingen: php-7.0 en het eindelijk eruit zwieren van GitLab. Waarom ik Gitlab er heb uitgesmeten: Memory-Leaks. Meer en meer issues met memory leaks waardoor verschillende andere services zonder geheugen kwamen te zitten en uiteindelijk crashten.

Om de issues uit GitLab te aan te duiden worden deze vooraf gegaan door "GL". Hetzelfde gebeurt voor Github (GH) en Gogs heeft de prefix "GS" meegekregen.

Daarnaast zijn alle externe dependencies verwijderd uit de repository waardoor de updates hiervan gemakkelijker te overschaduwen zijn.

Andere wijzigingen deze maand zijn de upgrade naar jQuery 3.x en een andere methode om e-mailadressen te valideren.

### Bugs
* (none)

### Nieuwe functies
* (none)

### Verbeteringen
* GS-1: Update jQuery to 3.x
* GS-2: Make check e-mail more performant
* GS-3: remove all dependencies to external repositories
* GS-4: Update system.sh script

### Off-code wijzigingen
* Upgrade naar php-7.0
* Gitlab vervangen door Gogs

## Changelog 2017-04
Deze maand een kleine broodnodige functie geïmplementeerd. De detail weergave van portfolio items is aangepast naar een veel leesbaardere weergave.

### Bugs
* (none)

### Nieuwe functies
* (none)

### Verbeteringen
* GL-53: Improve design of portfolio item details page 

## Changelog 2017-03
OK, ik geef het toe. Ontwikkeling ligt een beetje stil. Maar dit belet mij niet om bugs op te lossen.
Naast de obligatoire updates van de Javascript en Composer libraries heb ik deze maand een fout opgelost ervoor zorgde dat het contact formulier niet meer verzonden werd na een update van de website. Bij deze is  bug nummer 52 opgelost.

### Bugs
* GL-52: Forms cannot be send after deploy 

### Nieuwe functies
* (none)

### Verbeteringen
* (none)

## Changelog 2017-02

Deze maand zijn wat voorbereidingen gestart om de website over te zetten naar een herinstalleerde server. Dit geeft dan ook een mogelijkheid tot het verwijderen van onnozele zaken zoals de Gopher server die ooit geïnstalleerd was.

Daarnaast is de broncode van de website nu ook te vinden op Github. Dit voornamelijk omdat de community van Github veel groter is waardoor de barriere om iets aan te passen veel kleiner is.

### Bugs
* (none)

### Nieuwe functies
* (none)

### Verbeteringen
* (none)

### Off-code wijzigingen
* Infrastructure as code (Voorbereiding)
* Github Mirror

## Changelog 2017-01

Versie 1.0.1701: Een gelukkig nieuwjaar gewenst. Deze maand heb ik, tussen alle bokspartijen en braspartijen door, toch wat tijd gevonden om een paar zaken te verbeteren. Zo is het herordenen van archief items terug geactiveerd en is een CVE opgelost.
Daarnaast zal de website in geval van downloads sneller het download icoon tonen.

### Bugs
* GL-48: Reordering archive items doesn't work
* GL-50: Fix CVE-2016-10074

### Nieuwe functies
* (none)

### Verbeteringen
* GL-49: Faster check for downloads

### Off-code wijzigingen
* GL-51: Create gitlab template for library issues

## Changelog 2016-12

De December 2016 had een specialleke in petto. Misschien zul je in de goeie ouwe tijd een contactformulier gezien hebben op de website. Dit contactformulier was echter nooit actief. Dit formulier is vanaf deze maand volledig actief.
In het contactformulier heb ik overigens een probeersel aangebracht. Iemand die ik ken(de) had op zijn blog een experimentele [spam-filter](http://www.blacksnipe.be/blog/simple-spam-filter-theory) uit de doeken gedaan. Ik heb deze theorie in praktijk gebracht op het contactformulier.

Naast deze uitbreiding een paar kleine bugs gefixt. Zo vraagt het admin panel niet om de haverklap naar het afzetten van de piwik-tracking en is het commando voor een user aan te maken via ssh terug actief.

### Bugs
* GL-44: Admin panel keeps asking for disabling tracking 
* GL-45: Command to create user does not work
* GL-47: Disable reveal.js help text

### Nieuwe functies
* GL-46: Create contact form

### Verbeteringen
* (none)

## Changelog 2016-11

Weer de 20ste, weer een update. Deze maand heb ik een belangrijke verbetering toevoegd, namelijk een opt-out van de analytics.

Deze opt-out kan gebeurt via een url-parameter (no_analytics=true), of door in te loggen op het administratiepaneel waarna de optie voor opt-out word aangeboden.

Daarnaast is de trusted computer module voor 2-factor authenticatie ook geactiveerd waardoor je uw code niet iedere keer opnieuw moet ingeven.

### Bugs
* GL-39: Scrollbar on pages always appears 

### Nieuwe functies
* (none)

### Verbeteringen
* GL-35: 2FA code overload
* GL-36: Don't track internal users
* GL-38: Upgrade jsqueeze to latest version
* GL-40: Redesign lists in control panel
* GL-41: Update symfony to version 3.1
* GL-42: Improve design of viewing pages
* GL-43: Improve error-pages

## Changelog 2016-10

Deze maand geen extreme wijzigingen in de website buiten 1 bug die rindelijk gefixt is.

Daarnaast is er omwille van EOL status van PHP 5.5, PHP geüpgrade naar 5.6.

De belangrijkste wijzigingen zijn off-code, namelijk de komst van issue-templates en de ingebruikname van "The Beast", mijn nieuwe computer.

### Bugs
* GL-33: Scrollbar fails to load

### Nieuwe functies
* (none)

### Verbeteringen
* GL-34: Upgrade to php-5.6

### Off-code wijzigingen
* GL-32: Create issue templates
* Ingebruikname "The Beast"

## Changelog 2016-09

Deze maand stond in het teken van één feature die geïmplementeerd werd. Een feature request die hoog op het verlanglijstje stond: 2-factor authenticatie. Bij deze is dit geïmplementeerd :)

### Bugs
* (none)

### Nieuwe functies
* GL-15: Two-Factor authentication (project)
* GL-31: Deactivate accounts (project) 

### Verbeteringen
* (none)

### Off-code wijzigingen
* (none)

## Changelog 2016-08 (Bugs Bunny)

Omwille van de vele bugs die de voorbije dagen zijn ontdekt heb ik beslist om een tussentijdse release te doen met als naam "Bugs Bunny".

Dus, een kat is geen mus en werden bugs geplet. Er zijn niet minder dan 7 bugs geplet, 1 verbetering aangebracht, en dan zijn er nog 2 projecten afgewerkt

### Bugs
* GL-21: Download field should not be required
* GL-23: Height of vertical navigation does not equal the document height 
* GL-24: Design bug when moving a portfolio item 
* GL-25: style not applied anymore when changing background of portfolioitem
* GL-26: ElFinder not closable
* GL-27: Add a page link when page is open does not clear current page
* GL-28: Jquery-UI Broken

### Nieuwe functies
* GL-30: Extend deploy.sh script with more options 

### Verbeteringen
* GL-22: Add browse button to fields pointing to files (project)
* GL-29: Updating order of menu is not intuitive

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
* GL-17: Add link to page to download relevant extra's 

### Verbeteringen
* GL-16: Confirming a portfolio edit while a page is open should give a warning
* GL-18: Button for updating a portfoliopage should be modified according to situation
* GL-19: Drop html5shiv from base code 
* GL-20: Replacing KcFinder 

### Off-code wijzigingen
* Gitlab meer betrokken bij ontwikkelingsproces

## Changelog 2016-07
Een kleine update deze maand. Het belangrijkste deze maand is dat gitlab-ci is geïntegreerd en volledig actief. Deze release is dan ook via CI gedeployed.

### Issues
* GL-??: Could not update order of portfolio.

### Nieuwe functies
* CI

### Belangrijke wijzigingen
* Deployment gebeurt nu via CI.

## Changelog 2016-06
Deze maand is de laatste commit gedaan voor het afwerken van het archief. Meer bepaald het toevoegen van het archief aan het administratiepaneel. Dan is er ook een aanpassing op de mainpage waarbij de paginatitel van een pagina op de titelbalk verschijnt bij het openen. Daarnaast is er ook een probleem opgelost waarbij pagina's heropent werden na het sliden door de presentatie.

### Issues
* GL-14: Page is loaded over and over again when sliding through presentation

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
* GL-13 Add slug to duplicate page-names

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
* GL-11: Media query for touch-devices is not reliable for tablets (Thanks to Marie-Jeanne Thys)

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
* GL-8: Encrypt email-addresses to prevent e-mail harvesting
* GL-9: Connect CKEditor to KCFinder
* GL-10: Fugly border around embedded images

### Nieuwe functies
(geen)

### Vooruitzicht naar volgende sprint
Op dit moment is er slechts 1 bug gemeld. Daarnaast zal er worden gewerkt aan stylesheet voor afdrukken van pagina's


