INDOTRACK WEBSITE — LOCAL DEVELOPMENT DEMO
===========================================

Project name: indotrack_website

LOCAL DEMO (NO XAMPP)
---------------------
Open index.html directly in a modern browser. No Apache, PHP or MySQL is required.

The demo uses browser localStorage. Data is saved locally on the computer/browser and
survives refresh and reopening the page. This is intentionally separate from MySQL.

Functional in demo mode:
- All existing top-level menus and submenu navigation open functional screens.
- Master Product / Master Code creation and editing.
- Multiple Part Numbers per Master.
- Part Number normalization and duplicate detection.
- Part Number / Master / Brand / Engine / Unit search with exact/match/related results.
- Setup lists for Unit, Group, Area, Sales, Bank, Customer and Supplier.
- Local transaction entry for purchase, sales, returns, adjustment and stock opname.
- Stock updates are linked to Part Numbers and appear in inventory/report views.
- Reports read the same local data.
- Simple local charts read the same transaction/inventory data.
- Backup creates indotrack_demo_backup.json.
- Restore imports a previous JSON backup.
- Window menu actions and About/System dialogs are functional.

RESETTING DEMO DATA
-------------------
Open browser DevTools and remove localStorage key:
indotrack_website_demo_v1
or use browser site storage controls.

XAMPP / MYSQL LATER
-------------------
The original PHP API, config and SQL schema remain in:
api/
config/
sql/

For MySQL testing later:
1. Start Apache + MySQL in XAMPP.
2. Import sql/schema.sql into MySQL/phpMyAdmin.
3. Use the PHP entry point index.php.
4. The PHP API remains the database-backed implementation.

IMPORTANT
---------
index.html is the development/demo entry point.
index.php is retained as the XAMPP/MySQL entry point.
The demo intentionally does not call PHP APIs, so it can be tested using file://.
