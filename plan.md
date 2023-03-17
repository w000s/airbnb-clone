HANDIG:
Alle endpoints uitschrijven met zijn of haar functie en die vervolgens gaan proberen te bouwen.

Anyone can view the listings
Guest can get Accommodation

On creating accommodation, the user is a tenant.

Endpoints:
User Post / put / delete Accomodation

User Post Booking

Dingen:

-   Wanneer een user een huisje boekt, email confirmation
-   gebruik maken van pagination bij de listings
-   availability heeft meerdere start en einddatums, zodat de verhuurder zelf gedetailleerd kan aangeven wanneer zijn huisje beschikbaar is. Wanneer de gebruiker een accomodation vanaf een bepaalde datum als available zet, verandert de status op die datum naar available. De guest, kan dan op alle datums waarop de status op available staat een boeking doen. Wanneer de guest een boeking heeft gedaan verandert de status naar booked. D.m.v. het availability_booking table kan je zien welke guest welk huisje op welk slot heeft geboekt.
-   ter test heb ik de csrf token weggehaald, dit weer terugzetten
-   foto's bij accommodations
