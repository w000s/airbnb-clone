HANDIG:
Alle endpoints uitschrijven met zijn of haar functie en die vervolgens gaan proberen te bouwen.

Anyone can view the listings
Guest can get Accommodation

On creating accommodation, the user is a tenant.

Endpoints:
User Post / put / delete Accomodation

User Post Booking

Dingen:

-   Availability in de calendar zetten
-   De rest unavailable maken om te boeken.
-   Een book functie maken (authenticated)
-   bij book functie stripe payment toevoegen
-   Wanneer een user een huisje boekt, email confirmation
-   gebruik maken van pagination bij de listings
-   availability heeft meerdere start en einddatums, zodat de verhuurder zelf gedetailleerd kan aangeven wanneer zijn huisje beschikbaar is. Wanneer de gebruiker een accomodation vanaf een bepaalde datum als available zet, verandert de status op die datum naar available. De guest, kan dan op alle datums waarop de status op available staat een boeking doen. Wanneer de guest een boeking heeft gedaan verandert de status naar booked. D.m.v. het availability_booking table kan je zien welke guest welk huisje op welk slot heeft geboekt.
-   foto's bij accommodations
-   icons bij alle eigenschappen van een room
-   nieuwe date picker uitzoeken
    omzetten naar tennant, alleen ingelogde user kan boeken

check bij chirper hoe al die layouts en navs werken.
https://tailwindcomponents.com/component/airbnb-navbar

Search for locations
Host kan accommodation hosten.

Register

na het succesvol aanmaken van accommodation een automatische mail sturen en naar een completed succesfully pagina
na het succesvol aanmaken van een boeking een mail sturen, en naar een completed succesfully pagina

availability bij createn van accommodation

accommodation
