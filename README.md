# LabInventory

LabInventory je web aplikacija za upravljanje laboratorijskim inventarom, razvijena u okviru predmeta **Objektno orijentirane baze podataka** na Tehničkom fakultetu Univerziteta u Bihaću.

---

## 📌 Opis projekta

LabInventory predstavlja sistem za digitalno upravljanje laboratorijskom opremom i materijalima. Cilj aplikacije je omogućiti centralizovanu, sigurnu i preglednu evidenciju inventara u laboratorijskom okruženju.

Sistem omogućava:

- Kreiranje, pregled, ažuriranje i brisanje laboratorijskih stavki
- Praćenje količina i minimalnih zaliha
- Upravljanje korisnicima i njihovim ulogama
- Evidenciju aktivnosti putem log zapisa
- REST API pristup podacima

---

## 👥 Korisničke uloge

Sistem podržava tri tipa korisnika:

### Administrator

- Upravljanje korisnicima
- Upravljanje kategorijama, lokacijama i mjernim jedinicama
- Potpuna kontrola nad inventarom

### Laborant

- Kreiranje i uređivanje stavki
- Upravljanje inventarskim zapisima

### Read-only korisnik

- Pregled podataka bez mogućnosti izmjena

---

## 🛠 Tehnologije

Projekt je razvijen korištenjem sljedećih tehnologija:

- PHP
- Laravel Framework
- MySQL
- MVC arhitektura
- Eloquent ORM
- Blade templating engine
- REST API
- JSON komunikacija

---

## 🗄 Baza podataka

Sistem koristi relacijsku bazu podataka sa sljedećim glavnim tabelama:

- users
- items
- inventories
- categories
- locations
- manufacturers
- units
- logs

Relacije između entiteta su uglavnom tipa 1:N, čime je osigurana konzistentnost i integritet podataka.

---

## 🔐 Sigurnost

Aplikacija implementira:

- Autentifikaciju korisnika
- Autorizaciju na osnovu korisničkih uloga
- Validaciju unosa podataka
- Zaštitu REST API ruta
- Evidenciju aktivnosti korisnika

---

## 🌐 REST API rute (primjer)

    GET     /api/items
    POST    /api/items
    GET     /api/items/{id}
    PUT     /api/items/{id}
    DELETE  /api/items/{id}

Odgovori API-ja vraćaju podatke u JSON formatu.

---

## 📊 Funkcionalnosti

- Dashboard sa statistikom inventara
- Pregled i filtriranje stavki
- Upravljanje korisnicima
- Upravljanje inventarskim zapisima
- Log sistem za praćenje aktivnosti
- Validacija i kontrola pristupa

---

## 🎯 Cilj projekta

Razviti funkcionalnu, sigurnu i skalabilnu web aplikaciju koja omogućava efikasno upravljanje laboratorijskom opremom, uz primjenu principa objektno orijentisanog programiranja, MVC arhitekture i modernih web tehnologija.

---

## 👨‍💻 Autor

**Suad Kucalović**  
Elektrotehnika – Računarstvo i informatika  
Univerzitet u Bihaću Tehnički fakultet
2026
