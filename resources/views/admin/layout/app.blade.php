<!DOCTYPE html>
<html lang="en">

<head>

    @include('admin.shared.head')
       @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @include('admin.shared.header')
    @include('admin.shared.aside')


    <main id="main" class="main">
        @yield('content')
    </main>


    @include('admin.shared.script')
</body>

</html>
