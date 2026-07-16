# REST Client

Ein REST-Client (C#) zur Kommunikation mit einem selbst geschriebenen PHP-Server über HTTP GET/POST, inklusive JSON-Serialisierung und einer MySQL-Datenbank im Hintergrund.

## Funktionsweise

Die Anwendung besteht aus zwei Teilen:

1. **RESTClient (C#):** Eine Konsolenanwendung, die über HTTP mit dem Server kommuniziert
   - `GET`: Ruft alle gespeicherten Schüler vom Server ab und gibt sie in der Konsole aus
   - `POST`: Serialisiert ein neues `student`-Objekt zu JSON und sendet es an den Server, wo es in die Datenbank eingetragen wird
2. **simpleserver.php (PHP):** Ein einfacher REST-Endpunkt, der je nach HTTP-Methode (`GET`/`POST`) auf eine MySQL-Datenbank zugreift und Daten im JSON-Format zurückgibt bzw. entgegennimmt

## Technologien

- C# (.NET, Konsolenanwendung)
- `HttpWebRequest` für die HTTP-Kommunikation
- `Newtonsoft.Json` (Json.NET) für Serialisierung/Deserialisierung
- PHP (serverseitiger REST-Endpunkt)
- MySQL / MariaDB (lokal über XAMPP)

## Datenbank-Setup

1. [XAMPP](https://www.apachefriends.org/) installieren, Apache- und MySQL-Dienst starten
2. phpMyAdmin öffnen (`http://localhost/phpmyadmin`)
3. Neue Datenbank `rest` importieren (SQL-Datei im Repo enthalten)
4. Die Datenbank enthält eine Tabelle `schueler` mit den Spalten `Schueler_ID`, `Name`, `Klasse`

## Server-Setup (PHP)

1. Im XAMPP-Ordner unter `htdocs` einen Ordner `rest` anlegen
2. `simpleserver.php` dort hineinlegen, sodass sie über `http://localhost/rest/simpleserver.php` erreichbar ist
3. Apache muss laufen, damit der C#-Client den Endpunkt erreichen kann

## Ausführen

1. Datenbank und PHP-Server wie oben beschrieben einrichten
2. `RESTClient`-Projekt in Visual Studio öffnen
3. In `Program.cs` die Variable `control` auf `"send"` setzen, um einen neuen Schüler anzulegen, oder auf `"receive"`, um alle gespeicherten Schüler abzurufen
4. Projekt starten (F5)

## Was ich dabei gelernt habe

- Umsetzung eines vollständigen REST-Ablaufs (Client + Server) mit GET und POST
- JSON-Serialisierung/Deserialisierung von C#-Objekten mit Json.NET
- Kommunikation zwischen einer C#-Anwendung und einem PHP-Backend über HTTP
- Verbindung eines PHP-Skripts mit einer MySQL-Datenbank (`mysqli`)
- Absicherung von Datenbankabfragen gegen SQL-Injection mittels Prepared Statements (`mysqli_prepare` / `mysqli_stmt_bind_param`)

