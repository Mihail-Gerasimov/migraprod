<x-mail::message>

{{--# На сайт пришла новая заявка!--}}

Тема: {{ $order->title }}

Имя: {{$order->name}}

Телефон: {{$order->phone}}

Дата: {{$order->created_at->format('m.d.Y, H:i:s')}}

</x-mail::message>
