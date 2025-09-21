<?php
/* ======================================================
   1. KONEKSI DATABASE
====================================================== */
$koneksi = mysqli_connect("localhost", "root", "", "ujikom");

/* ======================================================
   2. FUNGSI UMUM
====================================================== */
function query($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

/* ======================================================
   3. AUTENTIKASI (USER: LOGIN & REGISTRASI)
====================================================== */

// Registrasi user
function regis($data)
{
    global $koneksi;

    $username  = $data['username'];
    $password  = $data['password'];
    $password2 = $data['password2'];

    // cek username
    $result = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "Username sudah ada!";
        return false;
    }

    // cek konfirmasi password
    if ($password !== $password2) {
        echo "Konfirmasi password salah!";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // insert user
    $query = "INSERT INTO user (username, password) VALUES('$username', '$password')";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

// Login user
function login($data)
{
    global $koneksi;

    $username = $data['username'];
    $password = $data['password'];

    $result = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");
    if (mysqli_num_rows($result) === 1) {
        $rows = mysqli_fetch_assoc($result);
        if (password_verify($password, $rows["password"])) {
            header("Location: dashboard.php");
            exit();
        }
    }
}

/* ======================================================
   4. CUSTOMER
====================================================== */

// Ubah data customer
function ubahCustomer($data)
{
    global $koneksi;

    $id     = $data['id'];
    $nama   = $data['nama'];
    $alamat = $data['alamat'];
    $telpon = $data['telpon'];
    $email  = $data['email'];

    $query = "UPDATE customer SET 
                nama   = '$nama',
                alamat = '$alamat',
                telpon = '$telpon',
                email  = '$email'
              WHERE id = $id";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

// Hapus data customer (hapus juga sales terkait)
function hapusCustomer($id)
{
    global $koneksi;

    mysqli_query($koneksi, "DELETE FROM sales WHERE id_customer = $id");
    mysqli_query($koneksi, "DELETE FROM customer WHERE id = $id");

    return mysqli_affected_rows($koneksi);
}

/* ======================================================
   5. SALES
====================================================== */

// Tambah sales
function tambahSales($data)
{
    global $koneksi;

    $id_customer = $data['id_customer'];
    $do_number   = $data['do_number'];
    $status      = $data['status'];

    $query = "INSERT INTO sales (id_customer, do_number, status) 
              VALUES ('$id_customer', '$do_number', '$status')";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

// Ubah sales
function ubahSales($data)
{
    global $koneksi;

    $id_sales    = $data['id_sales'];
    $id_customer = $data['id_customer'];
    $do_number   = $data['do_number'];
    $status      = $data['status'];

    $query = "UPDATE sales SET 
                id_customer = '$id_customer', 
                do_number   = '$do_number', 
                status      = '$status'
              WHERE id_sales = $id_sales";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

// Hapus sales
function hapusSales($id_sales)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM sales WHERE id_sales = $id_sales");
    return mysqli_affected_rows($koneksi);
}

/* ======================================================
   6. ITEM
====================================================== */

// Tambah item baru
function tambahItem($data)
{
    global $koneksi;

    $nama_item  = $data['nama_item'];
    $harga_beli = $data['harga_beli'];
    $harga_jual = $data['harga_jual'];
    $stok       = $data['stok'];

    $query = "INSERT INTO item (nama_item, harga_beli, harga_jual, stok) 
              VALUES ('$nama_item', '$harga_beli', '$harga_jual', '$stok')";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

// Ubah item
function ubahItem($data)
{
    global $koneksi;

    $id_item    = $data['id_item'];
    $nama_item  = $data['nama_item'];
    $harga_beli = $data['harga_beli'];
    $harga_jual = $data['harga_jual'];

    $query = "UPDATE item SET 
                nama_item  = '$nama_item',
                harga_beli = '$harga_beli',
                harga_jual = '$harga_jual'
              WHERE id_item = $id_item";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

// Tambah stok item
function tambahStok($id_item, $jumlah)
{
    global $koneksi;

    $query = "UPDATE item SET stok = stok + $jumlah WHERE id_item = $id_item";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

// Hapus item
function hapusItem($id_item)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM item WHERE id_item = $id_item");
    return mysqli_affected_rows($koneksi);
}

/* ======================================================
   7. TRANSAKSI
====================================================== */

// Tambah ke keranjang sementara
function tambahTemp($data)
{
    global $koneksi;

    $id_sales = $data['id_sales'];
    $id_item  = $data['id_item'];
    $quantity = $data['quantity'];

    // ambil harga jual
    $item  = query("SELECT harga_jual FROM item WHERE id_item = $id_item")[0];
    $price = $item['harga_jual'];
    $amount = $price * $quantity;

    $query = "INSERT INTO transaction_temp (id_sales, id_item, quantity, price, amount) 
              VALUES ('$id_sales', '$id_item', '$quantity', '$price', '$amount')";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

// Simpan transaksi final
function simpanTransaction($id_sales)
{
    global $koneksi;

    $tempData = query("SELECT * FROM transaction_temp WHERE id_sales = $id_sales");

    foreach ($tempData as $row) {
        $id_item  = $row['id_item'];
        $quantity = $row['quantity'];
        $price    = $row['price'];
        $amount   = $row['amount'];

        mysqli_query($koneksi, "INSERT INTO transaction (id_sales, id_item, quantity, price, amount)
                                VALUES ('$id_sales', '$id_item', '$quantity', '$price', '$amount')");

        mysqli_query($koneksi, "UPDATE item SET stok = stok - $quantity WHERE id_item = $id_item");
    }

    mysqli_query($koneksi, "DELETE FROM transaction_temp WHERE id_sales = $id_sales");
    return mysqli_affected_rows($koneksi);
}

// Hapus transaksi final
function hapusTransaction($id_transaction)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM transaction WHERE id_transaction = $id_transaction");
    return mysqli_affected_rows($koneksi);
}

/* ======================================================
   8. PETUGAS
====================================================== */

// Tambah petugas
function tambahPetugas($data)
{
    global $koneksi;

    $nama_user = $data['nama_user'];
    $username  = $data['username'];
    $password  = password_hash($data['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO petugas (nama_user, username, password) 
              VALUES ('$nama_user', '$username', '$password')";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

// Ubah petugas
function ubahPetugas($data)
{
    global $koneksi;

    $id_user   = $data['id_user'];
    $nama_user = $data['nama_user'];
    $username  = $data['username'];

    if (!empty($data['password'])) {
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $query = "UPDATE petugas SET 
                    nama_user = '$nama_user',
                    username  = '$username',
                    password  = '$password'
                  WHERE id_user = $id_user";
    } else {
        $query = "UPDATE petugas SET 
                    nama_user = '$nama_user',
                    username  = '$username'
                  WHERE id_user = $id_user";
    }

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

// Hapus petugas
function hapusPetugas($id_user)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM petugas WHERE id_user = $id_user");
    return mysqli_affected_rows($koneksi);
}
