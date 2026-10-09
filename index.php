<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>IndoTrack Website — Development Demo</title>
<link rel="stylesheet" href="assets/css/app.css">
</head>
<body>
<div id="app">
  <div class="titlebar"><span class="app-icon">▣</span><span>IndoTrack Website - Development Demo</span><div class="window-buttons"><button>—</button><button>□</button><button>×</button></div></div>
  <div class="menubar">
    <div class="menu" data-menu="system">System</div>
    <div class="menu" data-menu="setup">Setup</div>
    <div class="menu" data-menu="transaksi">Transaksi</div>
    <div class="menu" data-menu="laporan">Laporan</div>
    <div class="menu" data-menu="grafik">Grafik</div>
    <div class="menu" data-menu="window">Window</div>
    <div class="menu" data-menu="utility">Utility</div>
    <div class="menu" data-menu="help">Help</div>
  </div>
  <div id="menuLayer"></div>
  <div class="toolbar">
    <button data-action="refresh">↻ Refresh Local Data</button><span class="sep"></span>
    <button data-action="changePassword">🔑 Change Password</button>
    <button data-action="logoff">↪ Log off</button>
    <button data-action="exit">✕ Exit</button>
  </div>

// Barang Window //
  <main class="workspace">
    <section class="child-window" id="barangWindow">
      <div class="child-title">Barang</div>
      <div class="tabs"><button class="tab active" data-tab="umum">Informasi Umum</button><button class="tab" data-tab="substitusi">Substitusi Barang</button></div>
      <div class="form-area" id="barangForm">
        <div class="grid-form">
          <label>Master Code <input id="masterCode" placeholder="Akan dibuat otomatis" readonly></label>
          <label>Nama Barang <input id="namaBarang"></label>
          <label>Merk
            <select id="merk">
              <option>IMPORT</option>
              <option>Komatsu</option>
              <option>Caterpillar</option>
              <option>Hitachi</option>
              <option>Volvo</option>
              <option>Sany</option>
              <option>Kobelco</option>
              <option>Other</option>
            </select>
          </label>
          <label>Tipe Unit <input id="tipeUnit" placeholder="PC200-8 / ZX200 / dll"></label>
          <label>Tipe Engine <input id="tipeEngine" placeholder="6D102 / 6D114 / dll"></label>
          <label>Keterangan <textarea id="keterangan"></textarea></label>
          <label>Harga Jual <input id="hargaJual" type="number" min="0" step="0.01"></label>
          <label>Qty Onhand <input id="qtyOnhand" type="number" step="1"></label>
          <label>Qty Minimum <input id="qtyMinimum" type="number" step="1" value="1"></label>
          <label>Tipe
            <select id="tipe">
              <option>Barang</option>
              <option>Jasa</option>
              <option>Assembly</option>
            </select>
          </label>
          <label>Group
            <input id="groupBarang">
          </label>
          <label>Tipe Unit Tags
            <input id="unitTags" placeholder="PC200-8, ZX200, Excavator">
          </label>
          <label>Lokasi
            <input id="lokasi">
          </label>
        </div>
        <div class="sub-panel" id="pnPanel">
          <div class="section-caption">Kode Part / Part Numbers</div>
          <div class="pn-toolbar"><button type="button" id="btnAddPN">+ Tambah Kode Part</button><button type="button" id="btnSearchPN">🔎 Search Part Number</button><span id="pnSummary">0 kode part</span></div>
          <div class="table-wrap pn-table-wrap"><table><thead><tr><th>Part Number</th><th>Brand</th><th>Tipe</th><th>Supplier</th><th>Stock</th><th>Min</th><th>Harga Jual</th><th>Aksi</th></tr></thead><tbody id="pnRows"></tbody></table></div>
        </div>
        <div class="sub-panel" id="subPanel" hidden>
          <div class="section-caption">Spesifikasi Substitusi</div>
          <textarea id="substitusi" placeholder="Masukkan kode substitusi, satu per baris"></textarea>
        </div>
        <div class="buttons"><button id="btnLoad">Load</button><button id="btnSave">Save</button><button id="btnClear">Clear</button><button id="btnBrowse">Browse</button></div>
      </div>
      <div class="statusbar"><span id="statusText">Ready</span><span>Record: <b id="recordCount">0</b></span></div>
    </section>
    <section class="table-window" id="browseWindow" hidden>
      <div class="child-title">Daftar Barang</div>
      <div class="search-row"><input id="searchProduct" placeholder="Cari Master Code / PN / nama / brand / engine / unit"><button id="searchBtn">Search</button><button id="btnOpenSearch">Search Engine</button></div>
      <div class="table-wrap"><table><thead><tr><th>Master Code</th><th>Part Number</th><th>Nama Barang</th><th>Merk</th><th>Tipe Unit</th><th>Tipe Engine</th><th>Qty</th><th>Harga Jual</th></tr></thead><tbody id="productRows"></tbody></table></div>
    </section>
  </main>
</div>
<div id="modalRoot"></div>
<template id="pnRowTemplate"><tr class="pn-row">
<td><input class="pn-code" placeholder="Part Number"></td>
<td><input class="pn-brand" placeholder="Brand"></td>
<td><select class="pn-type"><option>Original</option><option>OEM</option><option>Equivalent</option><option>Reference</option></select></td>
<td><input class="pn-supplier" placeholder="Supplier"></td>
<td><input class="pn-stock" type="number" min="0" value="0"></td>
<td><input class="pn-min" type="number" min="0" value="0"></td>
<td><input class="pn-sale" type="number" min="0" step="0.01" value="0"></td>
<td><button type="button" class="pn-remove">Hapus</button></td>
</tr></template>
<script src="assets/js/app.js"></script>
</body></html>
