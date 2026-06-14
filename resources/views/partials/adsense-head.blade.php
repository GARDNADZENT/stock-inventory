@if(config('adsense.enabled') && config('adsense.client'))
    <meta name="google-adsense-account" content="{{ config('adsense.client') }}">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client={{ config('adsense.client') }}" crossorigin="anonymous"></script>
@endif
