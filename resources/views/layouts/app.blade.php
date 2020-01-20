<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Booker Earth') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- Font Awesome Cdm --}}
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    {{-- Select 2 cdn --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>
    <div id="app">
        @include('include.navbar')
        
        <div style="height: 80px"></div>
        <div class="container">
            @include('include.messages')
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- select2 script --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
</body>
@yield('script')

{{-- for Image Uploading --}}
<script>
    var uploadField = document.getElementById("image");

    uploadField.onchange = function() {
        if(this.files[0].size > 1900000){
        alert("Image Greater than 2 mb!");
        this.value = "";
        };
    };
</script>

<script type="text/javascript">

    $(document).ready(function () {

        $('#select-receiver').select2({
            placeholder: 'Choose your contact',
            allowClear: true,
            minimumInputLength: 1,
            ajax: {
                url: '{{ route("getUsers") }}',
                dataType: 'json',
                data: function(param) {
                    console.log(param);
                    return {
                        q: param.term
                    }
                },
                processResults: function(data) {
                    console.log(data);
                    return {
                        results: data
                    }
                },
            },            
            delay: 200,
            cache: true,
        });     

})
    
        
</script>

</html>