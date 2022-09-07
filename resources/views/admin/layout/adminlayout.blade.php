<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <link rel="icon" type="image/png" href="uploads/favicon.png">
    <title>Admin Panel</title>
    @include('admin.layout.headerscripts')
</head>
<body>
<div id="app">
    <div class="main-wrapper">
        @include('admin.layout.nav')
        @include('admin.layout.sidebar')
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>@yield('title')</h1>
                </div>
                @yield('content')
            </section>
        </div>
    </div>
</div>
@include('admin.layout.footerscripts')
@if ($errors->any())
    @foreach($errors->all() as $er )
        <script>
                    iziToast.error({
                            title: '',
                            position:'center',
                            message: '{{ $er }}',
                    });
        </script>
     @endforeach
@endif
@if (session()->get('error'))
    <script>
                iziToast.error({
                        title: '',
                        position:'topRight',
                        message: '{{ session()->get('error') }}',
                });
    </script>
@endif
@if (session()->get('success'))
    <script>
                iziToast.success({
                        title: '',
                        position:'topRight',
                        message: '{{ session()->get('success') }}',
                });
    </script>
@endif
</body>
</html>