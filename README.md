# Dokumentasi API
Specification : Laravel 8.83.27

## Tabel Konten

1. [Authentication]
2. [Endpoints]
   - [A. Create Category]
   - [B. Create Product]
   - [C. Search Products]
3. [Struktur Database]
   - [A. Tabel Categories]
   - [B. Tabel Products]
4. [Pengujian]

---

## 1. Authentication

- **API-KEY Authentication:** Diatur dalam .env -> API_KEY = rasyadapitmc2023

## 2. Endpoints

### A. Create Category

- **Endpoint:** `POST /api/categories`
- **Deskripsi:** Membuat kategori baru.
- **Request Body:**
  ```json
  {
    "name": "Category Name"
  }

### B. Create Products

- **Endpoint:** `POST /api/products`
- **Deskripsi:** Membuat produk baru.
- **Request Body:**
  ```json
  {
    "sku": "SKU",
    "name": "Product Name",
    "price": 1000000,
    "stock": 100,
    "category_id": "categoryId"
  }

### C. Search Product

- **Endpoint:** `POST /api/search`
- **Deskripsi:** Mencari produk berdasarkan filter (opsional).
- **Query Parameter:**
- *sku*: Filter berdasarkan SKU, mendukung beberapa parameter.
- *name*: Filter berdasarkan nama (LIKE), mendukung beberapa parameter.
- *price_start*: Filter berdasarkan harga mulai.
- *price_end*: Filter berdasarkan harga akhir.
- *stock_start*: Filter berdasarkan stok mulai.
- *stock_end*: Filter berdasarkan stok akhir.
- *category_id*: Filter berdasarkan ID kategori, mendukung beberapa parameter.
- *category_name*: Filter berdasarkan nama kategori, mendukung beberapa parameter.

## 3. Struktur Database

### A. Tabel 'categories'
- **id**: ID kategori (Integer, Auto-increment)
- **name**: Nama kategori (String)
- **createdAt**: Waktu pembuatan kategori (Timestamp)

### B. Tabel 'products'
- **id**: ID kategori (Integer, Auto-increment)
- **sku**: SKU produk (String, Unique, Index)
- **name**: Nama produk (String)
- **price**: Harga produk (Unsigned BigInt)
- **stock**: Stok produk (Unsigned Integer)
- **category_id**: ID kategori produk (Unsigned Integer, Foreign Key ke Tabel Categories)
- **createdAt**: Waktu pembuatan produk (Timestamp)

## 4. Testing (PHP Unit)

### A. Pengujian /products
Endpoint : /api/test/products

### B. Pengujian /categories
Endpoint : /api/test/categories

### C. Pengujian /search
Endpoint : /api/test/search
