@component('mail::message')
# {{ $data['title'] }}

{{ $data['subtitle'] }}

Detail: <br>
<table>
    <tr>
        <td>Nama</td>
        <td>:</td>
        <td>{{ $data['message']['nama'] }}</td>
    </tr>
    <tr>
        <td>No Telepon</td>
        <td>:</td>
        <td>{{ $data['message']['no_telepon'] }}</td>
    </tr>
    <tr>
        <td>Email</td>
        <td>:</td>
        <td>{{ $data['message']['email'] }}</td>
    </tr>
    <tr>
        <td>Pesan</td>
        <td>:</td>
        <td>{{ $data['message']['pesan'] }}</td>
    </tr>
    <tr>
        <td>Tanggal & Jam</td>
        <td>:</td>
        <td>{{ $data['message']['tgl_jam'] }}</td>
    </tr>
</table>

@component('mail::button', ['url' => $data['url']])
View Website
@endcomponent

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
