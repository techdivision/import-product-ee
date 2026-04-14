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

## Häufige Use Cases

### EE-Staging-Szenarien
1. **Scheduled Price Changes**: Products mit zukünftigen Preisen via Staging
2. **Campaign Launch Staging**: Neue Products in Staging für Kampagnen-Start
3. **Multi-Store Staging**: Unterschiedliche Versions pro Store mit Staging
4. **Promotion Scheduling**: Bulk-Importe mit zeitgesteuerten Aktivierungen

### CSV-Beispiel
```csv
sku,name,staging_version_id,scheduled_date
PROD-EE-1,EE Product 1,v1,2026-03-01 00:00:00
PROD-EE-2,EE Product 2,v2,2026-04-01 12:00:00
```

## Performance-Überlegungen

- **Staging-Overhead**: ~20-25% mehr Zeit als Standard-Import
- **Sequence-Actions**: Sequence-Updates für jeden Product ~3-5ms
- **Bundle/Grouped/Variant**: Mit EE-Extensions wird es nochmal +30-50% langsamer
- **Batch-Tuning**: Optimal 500-1000 Products pro Batch für EE
- **Memory-Profile**: EE Staging verdoppelt Memory-Usage (~200-300KB pro Product)

## Verwandte Module

- **import-product**: Basis für alle Product-Importer
- **import-product-bundle-ee**: Nutzt für Bundle-Staging
- **import-product-grouped-ee**: Nutzt für Grouped-Staging
- **import-product-link-ee**: Nutzt für Link-Staging
- **import-product-media-ee**: Nutzt für Media-Staging
- **import-product-variant-ee**: Nutzt für Variant-Staging
- **import-product-ee** ← **diese Datei**

## Troubleshooting & FAQ

**Q: "Staging version not found" Fehler**
- A: Staging-Version muss in DB existieren. Prüfe: `SELECT * FROM catalog_product_entity_staging WHERE entity_id = ? AND created_in = ?`

**Q: Bundle-Produkte im Staging funktionieren nicht**
- A: Nutze `import-product-bundle-ee` statt `import-product-ee` für Bundles!

**Q: Staging-Daten sind nach Import nicht sichtbar**
- A: Staging-URL in Admin aktivieren oder Staging-Preview nutzen. Import ist korrekt, nur Sichtbarkeit.

## Bekannte Einschränkungen

- **EE-Only**: Nur für Magento EE Deployments
- **Staging-Abhängig**: Erfordert EE Staging-Funktionalität

## Zusammenfassung

`import-product-ee` ist ein **Tier 6 Modul**, das EE-spezifische Product Import-Funktionalität bietet. Es erweitert den Product Importer mit EE-Features und ist Basis für spezialisierte EE Product-Importer.

**Für Agenten:** Verstehe dieses Modul als **EE Product Importer** mit Staging Support und 5 Dependents.
