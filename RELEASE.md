# GitHub Workflow - Automatische Release-Erstellung

## Übersicht

Der GitHub Actions Workflow erstellt automatisch ein Release mit ZIP-Datei, wenn Sie einen neuen Tag pushen.

## Verwendung

### 1. Neuen Tag erstellen und pushen

```bash
# Tag lokal erstellen
git tag -a v2.0.0 -m "Release Version 2.0.0"

# Tag zu GitHub pushen
git push origin v2.0.0
```

### 2. Automatischer Ablauf

Der Workflow wird automatisch ausgeführt und:
1. ✅ Erstellt ein neues Release auf GitHub
2. ✅ Packt alle Template-Dateien in eine ZIP-Datei
3. ✅ Fügt die ZIP-Datei zum Release hinzu
4. ✅ Generiert Release-Notes

### 3. ZIP-Datei herunterladen

Nach wenigen Minuten finden Sie das Release unter:
```
https://github.com/uwefranke/joomla-potsdam-rechtsanwalt/releases
```

## Tag-Format

Verwenden Sie das Format `v{MAJOR}.{MINOR}.{PATCH}`:

- `v2.0.0` - Erste stabile Version
- `v2.0.1` - Bugfix-Release
- `v2.1.0` - Neue Features
- `v3.0.0` - Breaking Changes

## Beispiel-Workflow

```bash
# Änderungen machen
git add .
git commit -m "Neue Features hinzugefügt"

# Tag erstellen
git tag -a v2.1.0 -m "Version 2.1.0 - Neue Sidebar-Module"

# Alles pushen
git push origin main
git push origin v2.1.0
```

## Was wird in die ZIP gepackt?

Folgende Dateien und Ordner:
- ✅ `css/`
- ✅ `fonts/`
- ✅ `js/`
- ✅ `language/`
- ✅ `images/`
- ✅ `index.php`
- ✅ `error.php`
- ✅ `templateDetails.xml`
- ✅ `README.md`
- ✅ `INSTALLATION.md`

**Nicht enthalten:**
- ❌ `.git/` (Git-Verzeichnis)
- ❌ `.github/` (Workflow-Dateien)
- ❌ `.gitignore`
- ❌ Andere Entwicklerdateien

## Bestehende Tags anzeigen

```bash
# Alle Tags lokal anzeigen
git tag

# Alle Tags mit Messages
git tag -n

# Tags auf GitHub anzeigen
git ls-remote --tags origin
```

## Tag löschen (falls nötig)

```bash
# Lokal löschen
git tag -d v2.0.0

# Auf GitHub löschen
git push origin :refs/tags/v2.0.0
```

## Release bearbeiten

Nach der automatischen Erstellung können Sie das Release auf GitHub manuell bearbeiten:
1. Gehen Sie zu **Releases**
2. Klicken Sie auf **Edit** beim entsprechenden Release
3. Passen Sie die Release-Notes an
4. Fügen Sie weitere Assets hinzu (z.B. Screenshots)

## Troubleshooting

### Workflow startet nicht
- Überprüfen Sie das Tag-Format (muss mit `v` beginnen)
- Workflow-Datei muss im `main` Branch sein

### ZIP fehlt
- Prüfen Sie die Actions-Logs: **Actions** → Workflow-Run
- Berechtigungen prüfen (sollten automatisch gesetzt sein)

### Release ist "Draft"
- Workflow erstellt publizierte Releases
- Falls Draft, manuell auf "Publish" klicken

## Semantic Versioning

Empfohlenes Versioning nach [semver.org](https://semver.org/lang/de/):

- **MAJOR** (v3.0.0): Breaking Changes (inkompatible API-Änderungen)
- **MINOR** (v2.1.0): Neue Features (abwärtskompatibel)
- **PATCH** (v2.0.1): Bugfixes (abwärtskompatibel)

## Nächste Schritte

Nach dem Erstellen eines Release:
1. ✅ ZIP-Datei in Joomla testen
2. ✅ Release-Notes überprüfen/ergänzen
3. ✅ Changelog in README.md aktualisieren
4. ✅ Benutzer über neue Version informieren
