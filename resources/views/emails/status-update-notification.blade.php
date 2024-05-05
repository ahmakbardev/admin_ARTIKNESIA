<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Update Notification</title>
</head>

<body>
    <h2>Status Update Notification</h2>
    @if ($status === 'confirmed')
        <p>Status Anda telah dikonfirmasi. Anda sekarang dapat mengakses situs web <a
                href="{{ URL::to('https://seniman.sideospary.com/id_id/dashboard') }}">di sini</a>.</p>
    @elseif ($status === 'pending')
        <p>Status Anda sedang menunggu. Mohon tunggu untuk pembaruan selanjutnya.</p>
    @elseif ($status === 'gagal')
        <p>Pembaruan status Anda gagal. Silakan hubungi dukungan untuk bantuan.<a
                href="{{ URL::to('https://api.whatsapp.com/send?phone=62895366979201&text=Halo,%20saya%20belum%20menerima%20email%20verifikasi') }}">di
                sini</a></p>
    @endif

    <p>Thank you,</p>
    <p>{{ config('app.name') }}</p>
</body>

</html>
