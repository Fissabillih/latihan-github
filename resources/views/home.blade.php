<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Poliklinik</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f7fb;
            color: #1f2937;
        }

        .navbar {
            background: #2563eb;
            color: white;
            padding: 18px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h1 {
            font-size: 24px;
        }

        .navbar span {
            font-size: 14px;
        }

        .container {
            max-width: 1100px;
            margin: 70px auto;
            padding: 0 25px;
        }

        .hero {
            background: white;
            border-radius: 15px;
            padding: 55px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .hero h2 {
            font-size: 36px;
            margin-bottom: 15px;
            color: #1d4ed8;
        }

        .hero p {
            font-size: 17px;
            line-height: 1.7;
            color: #6b7280;
            margin-bottom: 30px;
        }

        .button {
            display: inline-block;
            background: #2563eb;
            color: white;
            padding: 12px 22px;
            border-radius: 8px;
            text-decoration: none;
        }

        .button:hover {
            background: #1d4ed8;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 25px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
        }

        .card h3 {
            margin-bottom: 10px;
            color: #2563eb;
        }

        .card p {
            color: #6b7280;
            line-height: 1.6;
        }

        footer {
            text-align: center;
            margin-top: 50px;
            padding: 25px;
            color: #6b7280;
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 18px 25px;
            }

            .hero {
                padding: 35px 25px;
            }

            .hero h2 {
                font-size: 28px;
            }

            .cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <h1>Poliklinik</h1>
        <span>Sistem Informasi Poliklinik</span>
    </nav>

    <main class="container">

        <section class="hero">
            <h2>Selamat Datang</h2>

            <p>
                Selamat datang di Sistem Informasi Poliklinik.
                Aplikasi ini digunakan untuk membantu pengelolaan
                data dan pelayanan pada poliklinik.
            </p>

            <a href="/" class="button">
                Halaman Utama
            </a>
        </section>

        <section class="cards">

            <div class="card">
                <h3>Data Pasien</h3>
                <p>
                    Pengelolaan informasi dan data pasien
                    pada sistem poliklinik.
                </p>
            </div>

            <div class="card">
                <h3>Data Poli</h3>
                <p>
                    Informasi mengenai poli yang tersedia
                    pada poliklinik.
                </p>
            </div>

            <div class="card">
                <h3>Jadwal Pemeriksaan</h3>
                <p>
                    Pengelolaan jadwal pemeriksaan dan
                    pelayanan pasien.
                </p>
            </div>

        </section>

    </main>

    <footer>
        &copy; {{ date('Y') }} Sistem Informasi Poliklinik
    </footer>

</body>
</html>