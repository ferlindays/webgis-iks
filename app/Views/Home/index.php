<?= $this->extend('layouts/base'); ?>

<?= $this->section('title'); ?>IKS | Beranda<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<main class="d-flex flex-column justify-content-between">
    <div class="container pt-5">
        <h1 class="text-center ">SELAMAT DATANG DI WEBGIS<br>
            INDEKS KELUARGA SEHAT PUSKESMAS GODEAN II</h1>
        <div class="d-block text-center text-md-start d-md-flex gap-5 justify-content-center align-items-center mt-5 px-5">
            <img src="/iks.jpeg" alt="Responsive image" height="180">
            <div style="max-width: 680px" class="p-5 mb-4 bg-light rounded-3 mt-3">
                WebGIS Indeks Keluarga Sehat (IKS) merupakan WebGIS yang digunakan untuk menampilkan nilai IKS pada wilayah tingkat padukuhan dalam bentuk geografis. WebGIS IKS menampilkan nilai IKS dalam bentuk angka, diagram, maupun area kajian yang ditampilkan menggunakan visualisasi geografis.
            </div>
        </div>

        <div class="container mt-4" style="max-width: 720px;">
            <h3 class="text-center">12 INDIKATOR KELUARGA SEHAT</h3>
            <ol class="mt-4 ms-3 px-5" style="line-height: 1.75">
                <li>Keluarga mengikuti program Keluarga Berencana</li>
                <li>Ibu melakukan persalinan di fasilitas kesehatan</li>
                <li>Bayi mendapat imunisasi dasar lengkap</li>
                <li>Bayi mendapat air susu ibu (ASI) eksklusif</li>
                <li>Balita mendapatkan pemantauan pertumbuhan</li>
                <li>Penderita tuberculosis paru mendapatkan pengobatan sesuai standar</li>
                <li>Penderita hipertensi melakukan pengobatan secara teratur</li>
                <li>Penderita 1 gangguan jiwa mendapatkan pengobatan dan tidak ditelantarkan</li>
                <li>Anggota keluarga tidak ada yang merokok</li>
                <li>Keluarga sudah menjadi anggota Jaminan Kesehatan Nasional (JKN)</li>
                <li>Keluarga mempunyai akses sarana air bersih</li>
                <li>Keluarga mempunyai akses atau menggunakan jamban</li>
            </ol>
        </div>

        <div class="container mt-5">
            <h3 class="text-center">DAFTAR TAMPILAN INDEKS KELUARGA SEHAT</h3>
            <div class="d-flex justify-content-center align-items-center gap-5 mt-4">
                <a href="/data">
                    <button class="btn"
                        style="color: #36bc6a; transition: all 0.2s ease-in-out; border-color: #36bc6a; width: 144px; height: 64px;"
                        onmouseover="this.style.backgroundColor='#36bc6a'; this.style.color='white'"
                        onmouseout="this.style.backgroundColor='white'; this.style.color='#36bc6a'">
                        Data IKS
                    </button>
                </a>
                <a href="/webgis">
                    <button class="btn"
                        style="color: #36bc6a; transition: all 0.2s ease-in-out; border-color: #36bc6a; width: 144px; height: 64px;"
                        onmouseover="this.style.backgroundColor='#36bc6a'; this.style.color='white'"
                        onmouseout="this.style.backgroundColor='white'; this.style.color='#36bc6a'">
                        WebGIS IKS
                    </button>
                </a>
                <a href="/diagram">
                    <button class="btn"
                        style="color: #36bc6a; transition: all 0.2s ease-in-out; border-color: #36bc6a; width: 144px; height: 64px;"
                        onmouseover="this.style.backgroundColor='#36bc6a'; this.style.color='white'"
                        onmouseout="this.style.backgroundColor='white'; this.style.color='#36bc6a'">
                        Diagram IKS
                    </button>
                </a>
            </div>
        </div>


    </div>

    <footer class="mt-5 pt-5 mb-0" style="background-color: #D7FFE8; color: #36bc6a;">
        <div class="px-5">
            <div class="container d-block d-md-flex gap-lg-5 d-">
                <div class="col-lg-4 col-md-6">
                    <h3>Tentang Kami</h3>
                    <a style="color: #36bc6a; text-decoration: none;" target="_blank" href="https://sig.sv.ugm.ac.id/" onmouseover="this.style.color='#000';" onmouseout="this.style.color='#36bc6a';">
                        <p>Sistem Informasi Geografis, Departemen Teknologi Kebumian, Fakultas Sekolah Vokasi, Universitas Gadjah Mada</p>
                    </a>
                    <div class="d-flex justify-content-start gap-2">
                        <i class="bi bi-telephone-fill mt-1"></i>
                        <p>+6285747236719</p>
                    </div>
                    <div class="d-flex justify-content-start gap-2">
                        <i class="bi bi-envelope-fill "></i>
                        <p>ferlindasetyawati@gmail.com</p>
                    </div>
                </div>
                <div>
                    <div class="col-12">
                        <h6><strong>Alamat</strong></h6>
                        <p>
                            Sekolah Vokasi <br> D4 Sistem Informasi Geografis <br> Jalan C Simanjutak No .76A, Gondokusuman, Blimbing Sari, Caturtunggal, Kec. Depok, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55281<br><br>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-0 text-center mt-3 d-flex align-items-center justify-content-center" style="background-color: #36bc6a; color: white;">
            <p class="text-center mt-3">
                &copy; Copyright 2024<strong><span> Ferlinda Yuni Setyawati | D4 Sistem Informasi Geografis</span></strong>. All Rights Reserved
            </p>
        </div>
    </footer>

</main>



<?= $this->endSection(); ?>