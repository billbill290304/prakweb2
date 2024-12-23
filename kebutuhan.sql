CREATE TABLE produk (
    id_produk INT AUTO_INCREMENT PRIMARY KEY, -- ID unik untuk produk
    gambar_produk VARCHAR(255),               -- Lokasi atau URL gambar produk
    nama_produk VARCHAR(100) NOT NULL,        -- Nama produk
    deskripsi_produk TEXT,                    -- Deskripsi produk
    kategori VARCHAR(50),                     -- Kategori produk
    harga DECIMAL(10, 2) NOT NULL             -- Harga produk
);