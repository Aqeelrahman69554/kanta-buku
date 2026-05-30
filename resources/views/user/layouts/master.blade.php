<!doctype html>
<html lang="id">

@include('user.partials._head')

<body>
    @include('user.components._navbar')

    <main>
        @yield('content')
    </main>

    @include('user.components._footer')
    @include('user.partials.script')
</body>

</html>
