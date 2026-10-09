WEBSITE RECREATED — MASTER CODE + PART NUMBER SEARCH ENGINE
============================================================

This build keeps the existing classic Windows/MDI UI design and adds the
Master Product / Master Code database logic and Part Number search engine.

RUN WITH XAMPP
--------------
1. Extract this folder to:
   C:\xampp\htdocs\website_recreated\
2. Start Apache and MySQL.
3. Open phpMyAdmin.
4. Import:
   sql/schema.sql
5. Open:
   http://localhost/website_recreated/

DATABASE LOGIC
--------------
products = one Master Product.
product_part_numbers = unlimited Part Numbers belonging to one Master.

Example:
MP-001
  |- 0432191557
  |- DLLA150P764
  `- 0 432 191 557

Master Code is NOT a Part Number.
Master Code is generated automatically on a new master:
MP-001, MP-002, MP-003, ...

EDITING
-------
Opening an existing Master Code updates that master. It never generates a
new Master Code during edit.

PART NUMBER NORMALIZATION
-------------------------
Search and duplicate checking normalize:
- lowercase
- spaces removed
- '-' removed
- '_' removed
- '.' removed
- '/' removed

Therefore 0432191557, 0432-191-557 and 0 432 191 557 are equivalent for
search and duplicate detection.

DUPLICATE PART NUMBER
---------------------
The backend checks normalized_part_number and returns HTTP 409 when a
possible duplicate exists.

The UI shows:
1. Batal
2. Hapus Kode Ini — removes only the duplicate PN from the current input
3. Simpan Duplikat — intentionally saves it in the current master

normalized_part_number is indexed but NOT globally UNIQUE, because the same
PN may intentionally exist under more than one Master Product.

SEARCH ENGINE
-------------
Search supports:
- exact Part Number
- partial Part Number
- Master Code
- Master Name
- Brand
- Engine
- Tipe Unit
- Unit Tags
- Engine filter
- Tipe Unit filter
- Brand filter

Ranking:
Exact   = 10000
Prefix  = 7000
Contains= 5000
Text    = 2000

Search results display exact count and similar count.

STOCK
-----
Stock belongs to each Part Number, not the Master Product.
A Master total is calculated from its PN rows.

Stock changes create records in stock_movements:
opening, purchase, sale, adjustment, return_in, return_out.

API
---
GET  api/state.php
     Loads current MySQL state.

GET  api/products.php?id=...
GET  api/products.php?code=...
GET  api/products.php?q=...

POST api/products.php
     action=save
     action=deleteVariant
     action=deleteMaster

GET  api/search.php?q=...
     Optional: engine, unit, brand

UI
--
The original navigation/menu styling is retained. The Barang master screen
now has a Master Code field and a multi-row Part Number panel. Browse/search
now shows Master Code + Part Number separately.

IMPORTANT
---------
MySQL is the source of truth. JavaScript state is only the current UI cache.
Do not replace the database with localStorage.

VALIDATION
----------
PHP files were syntax-checked and the main JavaScript file was checked with
Node.js syntax validation before packaging.
