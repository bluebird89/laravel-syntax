@component('mail::message')
    # Order Shipped

    Your order has been shipped!

    @component('mail::button', ['url' => $url])
        View Order
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent

@component('mail::button', ['url' => $url, 'color' => 'success'])
    View Order
@endcomponent

@component('mail::panel')
    This is the panel content.
@endcomponent

@component('mail::table')
    | Laravel       | Table         | Example  |
    | ------------- |:-------------:| --------:|
    | Col 2 is      | Centered      | $10      |
    | Col 3 is      | Right-Aligned | $20      |
@endcomponent
