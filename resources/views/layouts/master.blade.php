<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@include('layouts.head')

<body>
    @include('layouts.navbar')



    @yield('content')

    @include('layouts.models')
    @include('layouts.footer')
</body>

</html>
