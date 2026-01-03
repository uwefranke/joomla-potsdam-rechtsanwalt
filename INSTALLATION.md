# Potsdam Rechtsanwalt Template - Installation & Konfiguration

## Installation in Joomla

### 1. Template-ZIP erstellen
Erstellen Sie ein ZIP-Archiv des gesamten Template-Ordners:
```
potsdam-rechtsanwalt.zip
├── css/
├── fonts/
├── images/
├── js/
├── language/
├── error.php
├── index.php
├── templateDetails.xml
└── README.md
```

### 2. In Joomla installieren
1. Im Joomla-Backend: **System → Templates → Site Templates**
2. Klicken Sie auf **Install Template**
3. Wählen Sie die ZIP-Datei aus
4. Klicken Sie auf **Upload & Install**

### 3. Template aktivieren
1. Nach erfolgreicher Installation: **System → Site Templates**
2. Suchen Sie "Potsdam Rechtsanwalt" in der Liste
3. Klicken Sie auf den Template-Namen
4. Klicken Sie auf **Default** (Stern-Symbol), um es als Standard festzulegen

## Template-Konfiguration

### Grundeinstellungen
1. **System → Site Templates**
2. Klicken Sie auf **Potsdam Rechtsanwalt**
3. Tab: **Advanced**

#### Logo hochladen
- Klicken Sie auf **Logo** → **Select**
- Laden Sie Ihr Kanzlei-Logo hoch (empfohlen: PNG mit transparentem Hintergrund, max. 200px Höhe)

### Farbeinstellungen
- **Primärfarbe**: Standard `#003d6b` (Dunkles Blau)
- **Sekundärfarbe**: Standard `#b8860b` (Gold)

### Kontaktinformationen
Füllen Sie aus:
- **Telefonnummer**: z.B. `0331 1234567`
- **E-Mail**: z.B. `kontakt@ihre-kanzlei.de`
- **Anschrift**: 
  ```
  Kanzleiname
  Straße 123
  14482 Potsdam
  ```
- **Öffnungszeiten**:
  ```
  Mo-Do: 9:00 - 17:00 Uhr
  Fr: 9:00 - 14:00 Uhr
  ```

### Erweiterte Einstellungen
- **Breadcrumbs anzeigen**: Ja (empfohlen)
- **Fixierter Header**: Ja (Header bleibt beim Scrollen sichtbar)
- **Smooth Scrolling**: Ja (sanftes Scrollen bei Links)

## Module einrichten

### Navigation erstellen
1. **Menus → Main Menu** (oder neues Menü erstellen)
2. Erstellen Sie Menüpunkte:
   - Startseite
   - Rechtsgebiete
   - Über uns
   - Kontakt

3. **Extensions → Modules → New**
4. Typ: **Menu**
5. Titel: `Hauptnavigation`
6. Position: **navigation**
7. Menü auswählen: **Main Menu**
8. Status: **Published**

### Sidebar-Module (optional)
Erstellen Sie Module für die Sidebars:

#### Beispiel: Kontakt-Widget
1. **Extensions → Modules → New**
2. Typ: **Custom**
3. Titel: `Kontakt`
4. Position: **sidebar-right**
5. Inhalt:
```html
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Kontaktieren Sie uns</h5>
        <p><i class="bi bi-telephone"></i> 0331 1234567</p>
        <p><i class="bi bi-envelope"></i> info@beispiel.de</p>
        <a href="/kontakt" class="btn btn-primary w-100">
            Termin vereinbaren
        </a>
    </div>
</div>
```

#### Beispiel: Rechtsgebiete
1. **Extensions → Modules → New**
2. Typ: **Articles - Categories**
3. Titel: `Rechtsgebiete`
4. Position: **sidebar-left**
5. Wählen Sie die Kategorie "Rechtsgebiete"

## SEO-Optimierung

### Meta-Tags konfigurieren
1. **System → Global Configuration**
2. Tab: **Site**
3. Füllen Sie aus:
   - **Site Name**: z.B. "Rechtsanwalt [Name] - Potsdam"
   - **Site Description**: Kurze Beschreibung Ihrer Kanzlei
   - **Site Metakeywords**: Relevante Keywords

### Artikel-Meta-Daten
Bei jedem Artikel:
1. **Content → Articles → [Artikel bearbeiten]**
2. Tab: **Publishing**
3. Füllen Sie **Meta Description** aus

### Friendly URLs aktivieren
1. **System → Global Configuration**
2. Tab: **Site**
3. **Search Engine Friendly URLs**: Yes
4. **Use URL Rewriting**: Yes
5. Benennen Sie `htaccess.txt` in `.htaccess` um

## Performance-Optimierung

### CSS/JS Kompression
1. **System → Global Configuration**
2. Tab: **System**
3. **Gzip Page Compression**: Yes

### Caching aktivieren
1. **System → Global Configuration**
2. Tab: **System**
3. **Cache**: ON - Conservative caching

## Fehlersuche

### Template wird nicht angezeigt
- Prüfen Sie, ob das Template als **Default** markiert ist
- Cache leeren: **System → Clear Cache**

### Module werden nicht angezeigt
- Prüfen Sie die **Position** des Moduls
- Status muss auf **Published** stehen
- Prüfen Sie **Menu Assignment** (auf welchen Seiten soll es erscheinen?)

### Farben ändern sich nicht
- Cache leeren
- Im Template: Prüfen Sie die Farbwerte
- Browser-Cache leeren (Strg+F5)

## Support & Anpassungen

### Template-Dateien bearbeiten
**WICHTIG**: Verwenden Sie Template-Overrides, nicht die Core-Dateien!

1. **System → Site Templates**
2. Klicken Sie auf **Potsdam Rechtsanwalt**
3. Tab: **Editor**
4. Bearbeiten Sie CSS oder JS nach Bedarf

### CSS anpassen
Eigene CSS-Regeln können Sie in `css/template.css` hinzufügen oder ein eigenes `custom.css` erstellen.

### Backup erstellen
Vor größeren Änderungen:
1. **System → Manage → Templates**
2. Wählen Sie das Template
3. Klicken Sie auf **Export**

## Checkliste nach Installation

- [ ] Template als Standard festgelegt
- [ ] Logo hochgeladen
- [ ] Farben angepasst (optional)
- [ ] Kontaktdaten eingegeben
- [ ] Navigation eingerichtet
- [ ] Module platziert
- [ ] SEO-Einstellungen konfiguriert
- [ ] URLs optimiert (Friendly URLs)
- [ ] Caching aktiviert
- [ ] Mobile Ansicht getestet
- [ ] Alle Seiten geprüft

## Weitere Ressourcen

- Joomla-Dokumentation: https://docs.joomla.org/
- Bootstrap 5 Docs: https://getbootstrap.com/docs/5.3/
- Bootstrap Icons: https://icons.getbootstrap.com/

## Lizenz

GNU General Public License version 2 or later
