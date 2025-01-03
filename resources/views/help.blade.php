<!doctype html>
<!--[if IE 6 ]><html lang="en-us" class="ie6"> <![endif]-->
<!--[if IE 7 ]><html lang="en-us" class="ie7"> <![endif]-->
<!--[if IE 8 ]><html lang="en-us" class="ie8"> <![endif]-->
<!--[if (gt IE 7)|!(IE)]><!-->
<html lang="en-us">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <title>Point of Sale by Hanways</title>
    <meta name="deskripsi" content="">
    <meta name="generator" content="Documenter v2.0 http://rxa.li/documenter">
    <link rel="icon" type="image/png" href="" />
    <!-- Google fonts - Poppins -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,700">
    <link rel="stylesheet" href="{{ asset('help/css/documenter_style.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('help/css/jquery.mCustomScrollbar.css') }}" media="all">

    <script src="{{ asset('help/js/jquery.js') }}"></script>
    <script src="{{ asset('help/js/jquery.scrollTo.js') }}"></script>
    <script src="{{ asset('help/js/jquery.easing.js') }}"></script>
    <script src="{{ asset('help/js/jquery.mCustomScrollbar.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.createElement('section');
        var duration = '500',
            easing = 'swing';
    </script>
    <script src="{{ asset('help/js/script.js') }}"></script>
</head>

<body>
    <div id="documenter_sidebar">
        <p style="border: none;margin: 20px 20px 0;width: 180px; font-size: 30px"><b>Bantuan</b></p>
        <ul id="documenter_nav">
            <li><a class="current" href="#documenter_cover">Mulai</a></li>
            <li><a href="#pos-printer" title="POS Printer Configuration">Pengaturan Printer POS</a></li>
            <li><a href="#dashboard" title="DASHBOARD">Dasbor</a></li>
            <li><a href="#product" title="PRODUCT">Produk</a></li>
            <li><a href="#print-barcode" title="Print Barcode">Print Barcode</a></li>
            <li><a href="#adding-stock" title="Adding Stock">Menambahkan Stok</a></li>
            <li><a href="#purchase" title="PURCHASE">Pembelian</a></li>
            <li><a href="#sale" title="SALE">Penjualan</a></li>
            <li><a href="#expense" title="EXPENSE">Pengeluaran</a></li>
            <li><a href="#quotation" title="QUOTATION">Penawaran</a></li>
            <li><a href="#adjustment" title="QUANTITY ADJUSTMENT">Penyesuaian Stok</a></li>
            <li><a href="#stock-count" title="STOCK COUNT">Hitung Stok</a></li>
            <li><a href="#transfer" title="TRANSFER">Transfer</a></li>
            <li><a href="#return" title="RETURN">Retur</a></li>
            <li><a href="#accounting" title="ACCOUNTING">Akuntansi</a></li>
            <li><a href="#hrm" title="HRM">HRM</a></li>
            <li><a href="#people" title="PEOPLE">Stakeholder</a></li>
            <li><a href="#reports" title="REPORTS">Laporan</a></li>
            <li><a href="#setting" title="SETTINGS">Pengaturan</a></li>
        </ul>
    </div>
    <div id="documenter_content">
        <section id="documenter_cover">
            <h1>Manajemen Stok Barang dengan POS, HRM, Akuntansi</h1>
            <div id="documenter_buttons">
            </div>
            <hr>
            <p>Software yang akan membantu Anda mengelola inventaris, akuntansi, dan waktu Anda. Kami percaya bahwa
                software ini cocok untuk model bisnis grosir dan eceran dan merupakan produk yang ideal untuk Toko Super
                mana pun. Software yang ramah pengguna ini sepenuhnya responsif dan memiliki banyak fitur. Semoga
                software ini berguna untuk mengelola inventaris bisnis Anda. Kontak 0821 4409 2552
            </p>
        </section>
        <section id="pos-printer">
            <div class="page-header">
                <h3>Konfigurasi Printer POS</h3>
                <hr class="notop">
            </div>
            <p>
                Pertama, Anda harus menginstal driver printer Anda. Lalu pergi ke pengaturan dan pilih Perangkat.
            </p>
            <p>
                <img alt="" src="{{ asset('help/images/pos_printer1.png') }}">
            </p>
            <p>
                Lalu pergi ke Perangkat dan printer.
            </p>
            <p>
                <img alt="" src="{{ asset('help/images/pos_printer2.png') }}">
            </p>
            <p>
                Atur printer POS Anda sebagai printer default.
            </p>
            <p>
                <img alt="" src="{{ asset('help/images/pos_printer3.png') }}">
            </p>
            <p>
                Lalu pergi ke Preferensi pencetakan.
            </p>
            <p>
                <img alt="" src="{{ asset('help/images/pos_printer4.png') }}">
            </p>
            <p>
                Lalu pergi ke Advanced.
            </p>
            <p>
                <img alt="" src="{{ asset('help/images/pos_printer5.png') }}">
            </p>
            <p>
                Pilih opsi ukuran kertas ke-3 dan klik Ok.
            </p>
            <p>
                <img alt="" src="{{ asset('help/images/pos_printer6.png') }}">
            </p>
            <p>
                Setelah itu masuk ke properti printer.
            </p>
            <p>
                <img alt="" src="{{ asset('help/images/pos_printer7.png') }}">
            </p>
            <p>
                Pergi ke pengaturan perangkat dan pilih opsi ke-3 otomatis.
            </p>
            <p>
                <img alt="" src="{{ asset('help/images/pos_printer8.png') }}">
            </p>
            <p>
                Pastikan Anda memilih ukuran kertas yang benar (opsi ke-3) saat Anda ingin mencetak faktur.
            </p>
            <p>
                <img alt="" src="{{ asset('help/images/pos_printer9.png') }}">
            </p>
        </section>
        <section id="dashboard">
            <div class="page-header">
                <h3>Dasbor</h3>
                <hr class="notop">
            </div>
            <p>
                Dasbor dengan tampilan yang bagus untuk mendapatkan informasi Pendapatan, Retur Penjualan, Retur
                Pembelian, dan Laba hari ini / 7 hari terakhir / bulan saat ini / tahun berjalan dengan sekali klik.
            </p>
            <p>
                <img alt="" src="{{ asset('help/images/dashboard1.png') }}">
            </p>
            <p>Anda akan mendapatkan informasi arus kas Anda yang berarti berapa banyak uang yang Anda hasilkan dan
                berapa banyak uang yang Anda belanjakan dari grafik garis ini.</p>
            <p>
                <img alt="" src="{{ asset('help/images/dashboard4.png') }}">
            </p>
            <p>Anda juga mengetahui bulan Anda saat ini <strong>pembelian</strong>, <strong>pendapatan</strong>
                <strong>pengeluaran</strong> dari bagan ini.</p>
            <p>
                <img alt="" src="{{ asset('help/images/dashboard5.png') }}">
            </p>
            <p>Bagan batang menunjukkan laporan tahunan pembelian dan penjualan tahun berjalan.</p>
            <p><img alt="" src="{{ asset('help/images/dashboard2.png') }}"></p>
            <p>Dari <strong>Dasbor</strong> Anda juga akan mendapatkan transaksi terkini (jual, beli, kuotasi,
                pembayaran) dan 5 produk terlaris terbaik bulan ini dan tahun berjalan.
            </p>
            <p><img alt="" src="{{ asset('help/images/dashboard3.png') }}"></p>
        </section>
        <section id="product">
            <div class="page-header">
                <h3>Produk</h3>
                <hr class="notop">
            </div>
            <h2><strong>Kategori</strong></h2>
            <p>Anda dapat menambah, mengedit dan menghapus kategori produk. Anda juga dapat mengimpor kategori dari file
                CSV dan mengekspor data tabel ke PDF dan CSV. Anda juga dapat mencetak data dari tabel.</p>
            <p>
                <img alt="" src="{{ asset('help/images/category1.png') }}">&nbsp;&nbsp;
                <img alt="" src="{{ asset('help/images/category2.png') }}">
            </p>
            <p>
                <img alt="" src="{{ asset('help/images/category3.png') }}">&nbsp;&nbsp;
                <img alt="" src="{{ asset('help/images/category4.png') }}">
            </p>
            <p>
                Jika Anda tidak ingin mengekspor kolom apa pun, Anda dapat melakukannya dengan mengklik tombol
                Visibilitas Kolom. Dari sini Anda dapat memilih kolom untuk dihapus dari tabel.
            </p>
            <p>
                <img alt="" src="{{ asset('help/images/category5.png') }}">&nbsp;&nbsp;
                <img alt="" src="{{ asset('help/images/category6.png') }}">
            </p>
            <p>Untuk mengekspor data dari baris tertentu, Anda hanya perlu mencentang kotak pada baris terkait</p>
            <p>
                <img alt="" src="{{ asset('help/images/category9.png') }}">
            </p>
            <p>Jika Anda ingin menghapus semua baris dari tabel, Anda dapat melakukannya dengan sangat mudah seperti
                yang ditunjukkan di bawah ini. Anda juga dapat menghapus baris tertentu dari tabel.</p>
            <p>
                <img alt="" src="{{ asset('help/images/category10.png') }}">
            </p>
            <p>
                Jika Anda ingin mencari apa pun dari tabel, Anda cukup mengetikkan kata di kotak pencarian.
            </p>
            <p>
                <img alt="" src="{{ asset('help/images/category7.png') }}">
            </p>
            <p>
                Anda juga dapat mengontrol paginasi dari <strong>Menampilkan</strong> dropdown.
            </p>
            <p>
                <img alt="" src="{{ asset('help/images/category8.png') }}">
            </p>
            <h2><strong>Produk</strong></h2>
            <p>Di bagian produk Anda hanya akan menambahkan informasi umum dari suatu produk. <strong>Untuk menambah
                    stok Anda harus membeli produk tersebut.</strong> Anda dapat membuat tiga jenis produk di Back
                Office System.</p>
            <ul>
                <li>Standar</li>
                <li>Digital</li>
                <li>Combo (Kombinasi produk standar. Seperti jus mangga adalah produk kombo karena terdiri dari mangga
                    dan gula).</li>
            </ul>
            <p>Anda dapat menambah, mengedit, dan menghapus produk. Anda dapat mengimpor produk dari CSV. <strong>Anda
                    harus mengikuti petunjuk untuk mengimpor data dari CSV</strong>. Untuk lebih memahami Anda dapat
                mengunduh file sampel.</p>
            <p>
                <img alt="" src="{{ asset('help/images/product1.png') }}">&nbsp;&nbsp;
                <img alt="" src="{{ asset('help/images/product2.png') }}">
            </p>
            <p>Anda dapat mengurutkan data tabel menurut kolom</p>
            <p><img alt="" src="{{ asset('help/images/product3.png') }}"></p>
            <p>Dan Anda dapat mencari, mengekspor, dan mencetak data dari tabel yang telah kita bahas sebelumnya dengan
                lebih detail.</p>
        </section>
        <section id="print-barcode">
            <div class="page-header">
                <h3>Print Barcode</h3>
                <hr class="notop">
            </div>
            <P>Anda dapat mencetak kode batang dengan Back Office System. Untuk mencetak barcode kami sangat menyarankan
                untuk menggunakan<strong> Brother Label Printer.</strong></P>
        </section>
        <section id="adding-stock">
            <div class="page-header">
                <h3>Menambahkan Stok</h3>
                <hr class="notop">
            </div>
            <P>Dibagian <strong>Produk</strong> Anda baru saja menambahkan informasi umum produk. Jadi darimana stok itu
                berasal? Untuk menambah stok, Anda harus membeli produk tersebut untuk gudang / toko tertentu. Software
                BOS ini cukup cerdas sehingga secara otomatis akan memperbarui jumlah stok dan Anda tidak perlu
                khawatir.</P>
        </section>
        <section id="purchase">
            <div class="page-header">
                <h3>Pembelian</h3>
                <hr class="notop">
            </div>
            <h2><strong>Tambahkan Pembelian</strong></h2>
            <p>Anda dapat membuat pembelian dalam modul Pembelian.<strong>Dengan menciptakan pembelian, jumlah stok
                    produk akan meningkat.</strong> Ada tiga status pembelian: Diterima, Sebagian, Tertunda, Pesanan.
                Anda dapat menambahkan produk ke pemesanan dengan mengetik atau memindai barcode produk.</p>
            <p>
                <img alt="" src="{{ asset('help/images/purchase1.png') }}">&nbsp;&nbsp;
                <img alt="" src="{{ asset('help/images/purchase2.png') }}">
            </p>
            <p>Anda juga dapat mengedit info produk dari tabel pesanan.</p>
            <p><img alt="" src="{{ asset('help/images/purchase3.png') }}"></p>
            <p>Setelah melakukan pembelian, Anda akan diarahkan ke halaman indeks pembelian. Anda akan mendapatkan
                ringkasan pembelian dari tabel. Untuk mendapatkan detailnya, Anda hanya perlu mengklik di baris tabel.
            </p>
            <p><img alt="" src="{{ asset('help/images/purchase4.png') }}"></p>
            <h2><strong>Import Pembelian</strong></h2>
            <p>You can import sale from CSV.<strong>Anda harus mengikuti petunjuk untuk mengimpor data dari
                    CSV</strong>. Untuk mendapatkan pemahaman yang lebih baik, Anda dapat mengunduh file sampel.</p>
            <p><img alt="" src="{{ asset('help/images/purchase7.png') }}"></p>
            <h2><strong>Pembayaran</strong></h2>
            <p>Anda dapat melakukan pembayaran dari tabel Pembelian. Anda dapat melakukan pembayaran dengan Uang Tunai,
                Kartu Hadiah, Cek, Kartu Kredit dan Deposit.</p>
            <p><img alt="" src="{{ asset('help/images/purchase5.png') }}">&nbsp;&nbsp;
                <img alt="" src="{{ asset('help/images/purchase6.png') }}">
            </p>
            <p>Dan Anda dapat mencari, mengekspor, dan mencetak data dari tabel yang telah kita bahas di bagian<a
                    href="#product">Produk</a>.</p>
        </section>
        <section id="sale">
            <div class="page-header">
                <h3>Penjualan</h3>
                <hr class="notop">
            </div>
            <h2><strong>POS (Point of Sale)</strong></h2>
            <p>Anda dapat membuat obral dari POS. Pelanggan, Gudang dan Penagih (perwakilan perusahaan Anda) akan secara
                otomatis dipilih sesuai dengan Pengaturan POS di modul <a href="#setting">Pengaturan</a>. Keybord layar
                sentuh diaktifkan dalam modul POS. Anda dapat menambahkan produk ke meja pemesanan dengan mengetik atau
                memindai barcode produk. Produk Unggulan akan ditampilkan di sisi kanan. Anda juga dapat menambahkan
                produk dengan mengklik gambar produk. Anda dapat mengedit info produk dari tabel pesanan.</p>
            <p>
                <img alt="" src="{{ asset('help/images/sale1.png') }}">
                <img alt="" src="{{ asset('help/images/sale2.png') }}">&nbsp;&nbsp;
                <img alt="" src="{{ asset('help/images/sale3.png') }}">
            </p>
            <p>Untuk menambahkan diskon pesanan, pajak pesanan dan biaya pengiriman Anda hanya perlu mengklik tombol
                yang ditunjukkan di bawah ini. Untuk menyelesaikan penjualan, Anda harus mengklik
                tombol<strong>Pembayaran</strong>.</p>
            <p><img alt="" src="{{ asset('help/images/sale4.png') }}"></p>
            <p>Setelah membuat penjualan, Anda akan diarahkan ke halaman indeks penjualan. Sebuah surat konfirmasi akan
                dikirim secara otomatis ke email pelanggan dengan detail penjualan. Anda akan mendapatkan ringkasan
                penjualan dari tabel. Untuk mendapatkan detailnya, Anda hanya perlu mengklik di baris tabel.</p>
            <p>You can also generate <strong>Invoice</strong> automatically which is beutifully designed</p>
            <p><img alt="" src="{{ asset('help/images/sale6.png') }}"></p>
            <p>You can also create sale by clicking Add Sale button. Also you can import sale from CSV.<strong>You must
                    follow the instruction to import data from CSV</strong>. To get better understanding you can
                download the sample file. </p>
            <p><img alt="" src="{{ asset('help/images/sale5.png') }}"></p>
            <h2><strong>Payment</strong></h2>
            <p>You can make payment from Sale table. You can make payment with Cash, Cheque, Credit Card, Gift Card,
                Deposit and Paypal. A confirmation mail will be sent automatically to customer's email with payment
                details.</p>
            <p><img alt="" src="{{ asset('help/images/purchase5.png') }}">&nbsp;&nbsp;
                <img alt="" src="{{ asset('help/images/purchase6.png') }}">
            </p>
            <p>And you can search, export and print data from table that we discussed in <a href="#product">Product</a>
                section.</p>
            <h2><strong>Delivery</strong></h2>
            <p>You can add delivery for your sold products. A confirmation mail will be sent automatically to customer's
                email with delivery details.</p>
            <p><img alt="" src="{{ asset('help/images/delivery1.png') }}"></p>
            <p>And you can search, export and print data from table that we discussed in <a href="#product">Product</a>
                section.</p>
            <h2><strong>Gift Card</strong></h2>
            <p>You can sell GiftCard to customer. By using gift card customer can purchase product. Again GiftCard can
                be recharged. Customer will be notified by mail when assigning or recharging a GiftCard.</p>
            <p>
                <img alt="" src="{{ asset('help/images/gift_card1.png') }}">&nbsp;&nbsp;
                <img alt="" src="{{ asset('help/images/gift_card2.png') }}">
            </p>
        </section>
        <section id="expense">
            <div class="page-header">
                <h3>EXPENSE</h3>
                <hr class="notop">
            </div>
            <h2><strong>Expense Category</strong></h2>
            <p>You can create, edit and delete expense category in Expense module.</p>
            <p>
                <img alt="" src="{{ asset('help/images/expense1.png') }}">
            </p>
            <h2><strong>Expense</strong></h2>
            <p>You can create, edit and delete expense in Expense module.</p>
            <p>
                <img alt="" src="{{ asset('help/images/expense2.png') }}">
            </p>
            <p>And you can search, export and print data from table that we discussed in <a href="#product">Product</a>
                section.</p>
        </section>
        <section id="quotation">
            <div class="page-header">
                <h3>QUOTATION</h3>
                <hr class="notop">
            </div>
            <h2><strong>Add Quotation</strong></h2>
            <p>You can create quotation in Quotation module. There are two quotation status: Pending and Sent</p>
            <p>
                <img alt="" src="{{ asset('help/images/quotation1.png') }}">
            </p>
            <p>If quotation status is <strong>Sent</strong> a confirmation mail will be sent automatically to customer's
                email with quotation details.</p>
            <h2><strong>Create Sale</strong></h2>
            <p>You can create sale from Quotation.</p>
            <p><img alt="" src="{{ asset('help/images/quotation2.png') }}">
            </p>
            <h2><strong>Create Purchase</strong></h2>
            <p>You can create purchase from Quotation.</p>
            <p><img alt="" src="{{ asset('help/images/quotation3.png') }}">
            </p>
            <p>And you can search, export and print data from table that we discussed in <a href="#product">Product</a>
                section.</p>
        </section>
        <section id="adjustment">
            <div class="page-header">
                <h3>QUANTITY ADJUSTMENT</h3>
                <hr class="notop">
            </div>
            <h2><strong>Add Adjustment</strong></h2>
            <p>You can adjust product quantity in Quantity Adjustment module. There will be two operation: Subtraction
                and Addition</p>
            <p>
                <img alt="" src="{{ asset('help/images/adjustment1.png') }}">
                <img alt="" src="{{ asset('help/images/adjustment2.png') }}">
            </p>
            <p>And you can search, export and print data from table that we discussed in <a href="#product">Product</a>
                section.</p>
        </section>
        <section id="stock-count">
            <div class="page-header">
                <h3>STOCK COUNT</h3>
                <hr class="notop">
            </div>
            <p>You can count your stock from this module. Two types are available: <strong>Full</strong> and
                <strong>Partial</strong>. In Partial type user have to specify brand and category and the software will
                automatically count the stock for that brand or category. Then this information will be written in CSV
                file which you have to download to finalize the stock count. Please follow the instruction properly.
                After finalizing the stock count you can automatically adjust the quantity of products if it is
                necessary.</p>
        </section>
        <section id="transfer">
            <div class="page-header">
                <h3>TRANSFER</h3>
                <hr class="notop">
            </div>
            <h2><strong>Add Transfer</strong></h2>
            <p>You can transfer your product from one warehouse to another in Transfer module. You can also transfer
                product with CSV file. <strong>You must follow the instruction to import data from CSV.</strong> To get
                better understanding you can download the sample file. You will get details of transfer by clicking in
                the table row.</p>
            <p>
                <img alt="" src="{{ asset('help/images/transfer1.png') }}">
            </p>
            <p>And you can search, export and print data from table that we discussed in <a href="#product">Product</a>
                section.</p>
        </section>
        <section id="return">
            <div class="page-header">
                <h3>RETURN</h3>
                <hr class="notop">
            </div>
            <h2><strong>Add Return</strong></h2>
            <p>You can return your product with Return module. You can track return of both purchase and sale with this
                module. A confirmation mail will be sent automatically to customer's email with return details if
                customer refund products. Again if you return product to supplier a confirmation mail will be sent
                automatically to supplier's email with return details. You will get details of return by clicking in the
                table row.</p>
            <p>
                <img alt="" src="{{ asset('help/images/return1.png') }}">
            </p>
            <p>And you can search, export and print data from table that we discussed in <a href="#product">Product</a>
                section.</p>
        </section>
        <section id="accounting">
            <div class="page-header">
                <h3>Accounting</h3>
                <hr class="notop">
            </div>
            <h2><strong>Account</strong></h2>
            <p>You can create,edit and delete account to link all your transactions. You can also set default account
                for sale. All the payments must be done under an account.</p>
            <p>
                <img alt="" src="{{ asset('help/images/accounting_1.png') }}">
            </p>
            <p>You can generate <strong>Balance Sheet</strong> of your accounts. You can also make <strong>Account
                    Statement</strong> of an specific account to see all the transactions which has done with this
                account.</p>
        </section>
        <section id="hrm">
            <div class="page-header">
                <h3>HRM</h3>
                <hr class="notop">
            </div>
            <h2><strong>Department</strong></h2>
            <p>You can create,edit and delete department of your company.</p>
            <h2><strong>Employee</strong></h2>
            <p>You can create,edit and delete employee of your company. You can also give user access to employee.</p>
            <h2><strong>Attendance</strong></h2>
            <p>You can take employee attendance with this software. You can set CheckIn and CheckOut time in HRM Setting
                option under Setting Module.</p>
            <h2><strong>Payroll</strong></h2>
            <p>You can make payroll of your employee with this software. All payroll must be done from an specipic
                account.</p>
        </section>
        <section id="people">
            <div class="page-header">
                <h3>PEOPLE</h3>
                <hr class="notop">
            </div>
            <h2><strong>Add User</strong></h2>
            <p>You can create, edit and delete user account. By creating user account password will be sent to the
                user's email that is given. Again you can active or inactive a user.</p>
            <p>There is also be a register option to create user account. But his/her ID will not be activated untill
                admin will approve it.</p>
            <p>
                <img alt="" src="{{ asset('help/images/user1.png') }}">
            </p>
            <h2><strong>Add Customer</strong></h2>
            <p>You can create, edit and delete customer. After creating customer a confirmation email will automatically
                send to customer. You can add money to customer's database just like a bank account. You can also import
                customer with CSV file. <strong>You must follow the instruction to import data from CSV.</strong></p>
            <p>
                <img alt="" src="{{ asset('help/images/customer1.png') }}">
            </p>
            <p>
                <img alt="" src="{{ asset('help/images/customer2.png') }}">
            </p>
            <h2><strong>Add Biller</strong></h2>
            <p>Biller is the representative of your company. You may have multiple company and you want to manage all
                your inventory from a single platform. So this is a solution for enterprise. You can create, edit and
                delete biller. After creating biller a confirmation email will automatically send to biller. You can
                also import biller with CSV file. <strong>You must follow the instruction to import data from
                    CSV.</strong></p>
            <p>
                <img alt="" src="{{ asset('help/images/biller1.png') }}">
            </p>
            <h2><strong>Add Supplier</strong></h2>
            <p>Supplier is the people from whom you purchase products. You can create, edit and delete supplier. After
                creating supplier a confirmation email will automatically send to supplier. You can also import supplier
                with CSV file. <strong>You must follow the instruction to import data from CSV.</strong></p>
            <p>
                <img alt="" src="{{ asset('help/images/supplier1.png') }}">
            </p>
            <p>And you can search, export and print data from table that we discussed in <a href="#product">Product</a>
                section.</p>
        </section>
        <section id="reports">
            <div class="page-header">
                <h3>Reports</h3>
                <hr class="notop">
            </div>
            <p>You can create generate various reports automatically by using BOS.</p>
            <ul>
                <li><strong>Profit / Loss Report</strong></li>
                <li><strong>Best Seller Report</strong></li>
                <li><strong>Product Report</strong></li>
                <li><strong>Daily Sale Report</strong></li>
                <li><strong>Monthly Sale Report</strong></li>
                <li><strong>Daily Purchase Report</strong></li>
                <li><strong>Monthly Purchase Report</strong></li>
                <li><strong>Sale Report</strong></li>
                <li><strong>Payment Report</strong></li>
                <li><strong>Purchase Report</strong></li>
                <li><strong>Warehouse Stock Chart Report</strong></li>
                <li><strong>Product Quantity Alert Report</strong></li>
                <li><strong>User Report</strong></li>
                <li><strong>Customer Report</strong></li>
                <li><strong>Supplier Report</strong></li>
                <li><strong>Due Report</strong></li>
            </ul>
        </section>
        <section id="setting">
            <div class="page-header">
                <h3>SETTINGS</h3>
                <hr class="notop">
            </div>
            <h2><strong>Add Role</strong></h2>
            <p>You can create, edit and delete user roles. You can controll user access by changing the role permission.
                So, under a certain role users have specific access over this software</p>
            <p>
                <img alt="" src="{{ asset('help/images/role1.png') }}">
            </p>
            <h2><strong>Add Warehouse</strong></h2>
            <p>You can create, edit and delete warehouse. You can also import warehouse with CSV file. <strong>You must
                    follow the instruction to import data from CSV.</strong></p>
            <p>
                <img alt="" src="{{ asset('help/images/warehouse1.png') }}">
            </p>
            <h2><strong>Add Customer Group</strong></h2>
            <p>
                You can create, edit and delete customer group. Different customer group has different price over the
                product. You can modify this by changing price percentage in Customer Group module.
            </p>
            <p>
                You can also import customer group with CSV file. <strong>You must follow the instruction to import data
                    from CSV.</strong>
            </p>
            <p>
                <img alt="" src="{{ asset('help/images/customer_group1.png') }}">
            </p>
            <h2><strong>Add Brand</strong></h2>
            <p>You can create, edit and delete product brand. You can also import brand with CSV file. <strong>You must
                    follow the instruction to import data from CSV.</strong></p>
            <p>
                <img alt="" src="{{ asset('help/images/brand1.png') }}">
            </p>
            <h2><strong>Add Unit</strong></h2>
            <p>You can create, edit and delete product unit. You can also import brand with CSV file. <strong>You must
                    follow the instruction to import data from CSV.</strong></p>
            <p>
                <img alt="" src="{{ asset('help/images/unit1.png') }}">
            </p>
            <h2><strong>Add Tax</strong></h2>
            <p>You can create, edit and delete different product tax. You can also import tax with CSV file. <strong>You
                    must follow the instruction to import data from CSV.</strong></p>
            <p>
                <img alt="" src="{{ asset('help/images/tax1.png') }}">
            </p>
            <p>And you can search, export and print data from table that we discussed in <a href="#product">Product</a>
                section.</p>
            <h2><strong>General Settings</strong></h2>
            <p>You can change Site Title, Site Logo, Currency, Time Zone, Staff Access, Date Format and Theme Color from
                general settings</p>
            <h2><strong>User Profile</strong></h2>
            <p>You can update user profile info from this module</p>
            <h2><strong>POS Settings</strong></h2>
            <p>You can set your own POS settings from this module. You can set default customer, biller, warehouse and
                how many Featured products will be displayed in the POS module. You have to set your
                <strong>Stripe</strong> and private key for Credit Card Payment. To implement payment with
                <strong>Paypal</strong> you have to buy live api from Paypal. You will also need to fillup the following
                information.
            </p>
            <p>
                <img alt="" src="{{ asset('help/images/pos1.png') }}">
            </p>
            <h2><strong>HRM Setting</strong></h2>
            <p>You can set default CheckIn and CheckOut time in HRM Setting.</p>
            <h2><strong>SMS Setting</strong></h2>
            <p>You can use Bulk SMS service via <strong>Twilio</strong> and <strong>Clickatell</strong>. You just have
                to fill the information correctly to activate this service. <strong>Please provide country code to send
                    sms.</strong></p>
        </section>
    </div>
    <script type="text/javascript">
        $("#documenter_sidebar").mCustomScrollbar({
            theme: "light",
            scrollInertia: 200
        });
    </script>



    <!-- Skrip untuk menangani scroll ke elemen dengan ID tertentu -->
    <script>
        $(document).ready(function() {
            // Menanggapi perubahan hash dalam URL
            $(window).on('hashchange', function() {
                scroll_to_target();
            });

            // Pemrosesan awal jika ada hash pada URL
            if (window.location.hash) {
                scroll_to_target();
            }

            // Fungsi untuk melakukan scroll ke elemen target
            function scroll_to_target() {
                var target = $(window.location.hash);
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                }
            }
        });
    </script>

</body>

</html>
