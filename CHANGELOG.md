# Changelog for `bramus/enumeration`

## 1.next – ????.??.??

## 1.3 - 2019.10.14

- Added: `::descriptions()`/`::summaries()` _(@bramus)_

## 1.2 – 2019.05.13

- Added: `::toSummary()`/`getSummary()` _(@bramus)_
- Added: `::toDescription()`/`getDescription()` _(@bramus)_

## 1.1 – 2019.04.10

- Fixed: Fix bug where getting of constant from Composed Enumerations went wrong _(@bramus)_
- Improved: Cache results in `Extractor` _(@bramus)_
- Added: Support for `__DEFAULT` _(@bramus)_
- Changed: Let `Generator` return the default (if given), with a fallback to a random one _(@bramus)_

## 1.0 – 2019.04.10

- First Release, containing `Enumeration` and `ComposedEnumeration`