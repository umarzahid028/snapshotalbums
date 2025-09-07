@component('mail::message')
# Event Follow-Up

Hello,

You can now view all the images uploaded from the event "{{ $data->event_title }}" that took place on {{ $data->date_of_event }}. Access the [Google Drive folder](https://drive.google.com/drive/folders/{{ $data->folder_id }}) to see the images.

Visit your <a href="https://snapshot-albums.com/dashboard">Dashboard</a> to access your guest link or QR code if you still need to gather guest photos and videos.

Have another event coming up? Create a new album on your <a href="https://snapshot-albums.com/dashboard">Dashboard</a> to share with your guests!


Snapshot Albums
@endcomponent
