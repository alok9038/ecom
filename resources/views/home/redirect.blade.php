@php
    if(session()->has('redirect')){
        $url = session()->get('redirect');
        echo "<script>open('$url','_self')</script>";
            session()->forget('redirect');
    }
@endphp