# 🛠️ API POS Ticketing Wisata (Laravel 10)

Backend REST API untuk menunjang **Aplikasi POS Ticketing Wisata**.  
Dikembangkan menggunakan **Laravel 10**, **MySQL**, dan integrasi pembayaran **Midtrans (QRIS)**.

API ini digunakan oleh aplikasi frontend (Flutter) untuk mengelola transaksi tiket wisata baik **offline** maupun **online**.

---

## ✨ Fitur API

-   📋 **Menu & Order** — CRUD menu / tiket & order
-   🍽️ **Table Management** — Manajemen nomor meja
-   💾 **Save Order (Open Bill)** — Simpan order sebelum pembayaran
-   💳 **Payment** — Pembayaran **Tunai & QRIS (Midtrans)**
-   🏷️ **Diskon & Pajak** — Perhitungan otomatis diskon & pajak
-   🖨️ **Printer Thermal** — Data transaksi siap cetak untuk printer **58mm/80mm**
-   📊 **Laporan Harian** — Rekap penjualan per hari

---

## 🛠️ Tech Stack

-   **Framework:** Laravel 10
-   **Database:** MySQL
-   **Auth:** Laravel Sanctum / JWT
-   **Payment Gateway:** Midtrans (QRIS)
-   **Printer Integration:** ESC/POS response (58mm / 80mm)
