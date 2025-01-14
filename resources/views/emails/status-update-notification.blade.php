<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemberitahuan Pembaruan Status</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f9fc;
            /* Artiknesia theme background color */
            color: #333;
            /* Default text color */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h2 {
            color: #4e5d78;
            /* Artiknesia theme primary color */
            margin-bottom: 20px;
        }

        p {
            margin: 10px 0;
            line-height: 1.6;
        }

        a {
            color: #007bff;
            /* Artiknesia theme link color */
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .notification {
            background: #ffffff;
            border: 1px solid #e0e4e8;
            /* Artiknesia theme border color */
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 500px;
            width: 100%;
            text-align: left;
        }

        .notification p {
            color: #555;
            /* Neutral text color */
        }

        .notification--confirmed {
            border-left: 5px solid #28a745;
            /* Green success color */
        }

        .notification--pending {
            border-left: 5px solid #ffc107;
            /* Yellow pending color */
        }

        .notification--gagal {
            border-left: 5px solid #dc3545;
            /* Red failure color */
        }

        .header {
            margin-bottom: 20px;
        }

        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            color: #888;
        }

        .salutation {
            margin-bottom: 20px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    @if ($status === 'confirmed')
        <div class="notification notification--confirmed">
            <div class="header">
                <h2>Selamat Datang di ARTIKNESIA!</h2>
                <p class="salutation">Halo Pengguna,</p>
            </div>
            <p>Kami sangat senang menyambut Anda di ARTIKNESIA, sebuah ruang kreatif di mana setiap karya seni Anda
                dihargai dan dapat dinikmati oleh pecinta seni di seluruh Indonesia. Dengan status akun Anda yang telah
                dikonfirmasi, Anda kini memiliki akses penuh ke semua fitur dan layanan kami.</p>
            <p>Sebagai bagian dari komunitas kami, Anda dapat membagikan cerita di balik karya Anda, terhubung dengan
                kolektor, serta menginspirasi orang lain dengan kreativitas Anda. Mari bersama-sama membangun ekosistem
                seni yang bermakna dan inklusif.</p>
            <p>Mulailah perjalanan Anda dengan mengunjungi <a
                    href="{{ URL::to('https://seniman.artiknesia.com/id/dashboard') }}">dashboard Anda</a>. Jika Anda
                memerlukan bantuan, tim kami siap membantu Anda.</p>
            <div class="footer">
                <p>Salam hangat,<br>Tim ARTIKNESIA</p>
            </div>
        </div>
    @elseif ($status === 'pending')
        <div class="notification notification--pending">
            <div class="header">
                <h2>Selamat Datang di ARTIKNESIA!</h2>
                <p class="salutation">Halo Pengguna,</p>
            </div>
            <p>Kami sangat senang Anda bergabung di ARTIKNESIA, platform yang didedikasikan untuk mendukung individu
                kreatif dan merayakan keindahan seni. Status akun Anda saat ini sedang dalam proses verifikasi, dan kami
                berusaha sebaik mungkin untuk menyelesaikan proses ini secepatnya.</p>
            <p>Kami menghargai kesabaran Anda selama menunggu. Setelah status akun Anda dikonfirmasi, Anda akan dapat
                menjelajahi dan menggunakan semua fitur yang tersedia bagi anggota komunitas kami.</p>
            <p>Jika Anda memiliki pertanyaan, jangan ragu untuk menghubungi tim dukungan kami. Terima kasih atas
                pengertian Anda.</p>
            <div class="footer">
                <p>Salam hangat,<br>Tim ARTIKNESIA</p>
            </div>
        </div>
    @elseif ($status === 'gagal')
        <div class="notification notification--gagal">
            <div class="header">
                <h2>Selamat Datang di ARTIKNESIA!</h2>
                <p class="salutation">Halo Pengguna,</p>
            </div>
            <p>Kami mohon maaf, terdapat masalah dalam memperbarui status akun Anda. Di ARTIKNESIA, kami berkomitmen
                memberikan pengalaman terbaik bagi setiap anggota, dan kami meminta maaf atas ketidaknyamanan yang
                mungkin terjadi.</p>
            <p>Untuk menyelesaikan masalah ini, silakan hubungi tim dukungan kami melalui <a
                    href="{{ URL::to('https://api.whatsapp.com/send?phone=6282146415024&text=Halo,%20saya%20belum%20menerima%20email%20verifikasi') }}">WhatsApp</a>.
                Tim kami siap membantu Anda agar status akun Anda dapat segera diperbarui.</p>
            <p>Kami berharap dapat segera menyambut Anda sepenuhnya ke dalam komunitas kami dan membantu Anda
                menampilkan kreativitas Anda ke khalayak yang lebih luas.</p>
            <div class="footer">
                <p>Salam hangat,<br>Tim ARTIKNESIA</p>
            </div>
        </div>
    @endif
</body>

</html>
