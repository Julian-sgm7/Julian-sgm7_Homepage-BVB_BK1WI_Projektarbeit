# KI-Assistent Setup

Der BVB KI-Assistent wurde mit Anthropic Claude API integriert. Hier's wie du es einrichtest:

## 1️⃣ Anthropic API-Key abrufen

1. Gehe zu https://console.anthropic.com/
2. Registriere dich oder melde dich an
3. Erstelle einen neuen API-Key unter "API Keys"
4. Kopiere deinen API-Key

## 2️⃣ Umgebungsvariable setzen

### Lokal (Development mit PHP Server)

**Linux/Mac - Terminal:**
```bash
export ANTHROPIC_API_KEY="your-api-key-here"
cd /workspaces/Julian-sgm7_Homepage-BVB_BK1WI_Projektarbeit/Projektarbeit/WebContent
php -S localhost:8000
```

**Windows - PowerShell:**
```powershell
$env:ANTHROPIC_API_KEY = "your-api-key-here"
cd C:\path\to\WebContent
php -S localhost:8000
```

### Production (Server/Hosting)

1. **In .env Datei** (wenn dein Hoster das unterstützt):
   ```
   ANTHROPIC_API_KEY=your-api-key-here
   ```

2. **Oder in php.ini:**
   ```ini
   auto_prepend_file = /path/to/env-loader.php
   ```

3. **Oder direkt in ai-chat.php** (WARNUNG: Sicherheitsrisiko!):
   ```php
   $apiKey = 'your-api-key-here'; // NICHT in GitHub pushen!
   ```

## 3️⃣ Testen

1. Starte deinen PHP Server
2. Öffne http://localhost:8000
3. Klick auf den 🤖 Button rechts unten
4. Schreib eine Nachricht und sende sie

## 📁 Dateien

- **ai-chat.php** - Backend API Handler
- **js/ai-chat.js** - Frontend Chat Widget
- **css/ai-chat.css** - Chat Styling (BVB Farben)

## 🔒 Sicherheit

⚠️ **WICHTIG:** 
- Speichere API-Keys NIEMALS in Dateien, die du in Git commitest
- Nutze Umgebungsvariablen oder .env Dateien
- .env Dateien sollten in .gitignore sein

## 💡 Features

✅ Live Chat mit Claude AI  
✅ BVB Design (Schwarz & Gelb)  
✅ Chat-Historie (localStorage)  
✅ Mobile responsive  
✅ Typing Indicator  
✅ Fehlerbehandlung  
✅ Auto-resize Textarea  

## 🐛 Debugging

Wenn der Chat nicht funktioniert:

1. **Öffne Browser Console** (F12)
2. **Prüfe auf Fehler**
3. **Überprüfe API-Key:**
   ```bash
   echo $ANTHROPIC_API_KEY
   ```
4. **Prüfe ai-chat.php Response:**
   ```bash
   curl -X POST http://localhost:8000/ai-chat.php \
     -H "Content-Type: application/json" \
     -d '{"message":"Hallo"}'
   ```

## 📝 Kosten

Anthropic Claude API ist kostenpflichtig. Preise findest du unter:
https://www.anthropic.com/pricing/claude

Die meisten Anfragen kosten nur Bruchteile eines Cents.

---

Viel Spaß mit deinem KI-Assistenten! 🚀
