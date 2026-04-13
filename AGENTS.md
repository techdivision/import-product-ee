# AGENTS.md - import-product-ee

## Zweck & Verantwortung

Das `import-product-ee` Modul bietet **EE-spezifische Product Import-Funktionalität**. Es ist ein **Tier 6 Modul** und erweitert `import-product`.

**Hauptverantwortung:**
- EE Product Staging Support
- EE Sequence Actions für Products
- Repository Pattern für EE Product-Daten
- Service Layer für EE Product-Verarbeitung
- Observer Pattern für EE Product-Hooks
- 5 Dependents (product-bundle-ee, product-grouped-ee, product-link-ee, product-media-ee, product-variant-ee)

## Architektur & Design Patterns

### Kern-Klassen
- **EeProductRepository**: EE Product Persistierung
- **StagingProductRepository**: Staging-Support
- **EeProductProcessor**: Service Layer
- **EeProductObserver**: Observer für EE-Hooks

### Verwendete Patterns
- **Observer Pattern**: Für EE-Hooks
- **Repository Pattern**: Für Daten-Persistierung
- **Service Layer**: Für Business Logic

## Abhängigkeiten

### Externe Pakete
- **Keine**

### TechDivision Dependencies
- **import-ee** ^17.0 - EE Functionality
- **import-product** ^26.2 - Product Importer

### Abhängig von diesem Modul (5 Reverse Dependencies)
1. **import-product-bundle-ee** - EE Bundle Extensions
2. **import-product-grouped-ee** - EE Grouped Extensions
3. **import-product-link-ee** - EE Link Extensions
4. **import-product-media-ee** - EE Media Extensions
5. **import-product-variant-ee** - EE Variant Extensions

## Wichtige Entry Points

### Repository Klassen
```php
// EE Product Repository
EeProductRepository::create($row): void

// Staging Product Repository
StagingProductRepository::create($row): void
```

## Events & Extension Points

**Keine Events** - Tier 6 EE-Modul

## Hints für KI-Agenten

### Wichtig zu verstehen
1. **Tier 6 Modul**: Erweitert Product Importer mit EE-Features
2. **EE-fokussiert**: Spezialisiert auf EE Staging
3. **Observer Pattern**: Für EE-Hooks
4. **Staging Support**: Für EE Staging-Tabellen
5. **5 Dependents**: Basis für spezialisierte EE Product-Importer

### Bei Änderungen
- **EE-Kompatibilität**: Beachte EE-Struktur
- **Staging-Kompatibilität**: Beachte Staging-Tabellen
- **5 Dependents**: Alle müssen kompatibel sein

## Bekannte Einschränkungen

- **EE-Only**: Nur für Magento EE Deployments
- **Staging-Abhängig**: Erfordert EE Staging-Funktionalität

## Zusammenfassung

`import-product-ee` ist ein **Tier 6 Modul**, das EE-spezifische Product Import-Funktionalität bietet. Es erweitert den Product Importer mit EE-Features und ist Basis für spezialisierte EE Product-Importer.

**Für Agenten:** Verstehe dieses Modul als **EE Product Importer** mit Staging Support und 5 Dependents.
