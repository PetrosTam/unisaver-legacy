<x-mail::message>
# Order placed successfully.

Thank you for your recent purchase!

Order Number: {{ $order->id }}

<x-mail::button :url="$url">
View Order
</x-mail::button>

Thanks,<br>
UniSaver Newcastle Team
</x-mail::message>
