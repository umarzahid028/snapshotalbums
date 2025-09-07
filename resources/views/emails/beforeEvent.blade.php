@component('mail::message')
# Upcoming Event Reminder

Hello,

This is a reminder that your event "{{ $data->event_title }}" is scheduled to occur on {{ $data->date_of_event }}.

You can find the QR code and guest link on your [dashboard](https://snapshot-albums.com/dashboard), as well as additional event details.

You can also upload images for your event [here](https://snapshot-albums.com/upload/{{ $data->folder_id }}/{{ $data->user_id }}).

Thanks,<br>
Snapshot Albums
@endcomponent
