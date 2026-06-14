@if(config('adsense.enabled') && config('adsense.client'))
    <div class="adsense-wrap text-center my-4">
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="{{ config('adsense.client') }}"
             @if(config('adsense.slot')) data-ad-slot="{{ config('adsense.slot') }}" @endif
             data-ad-format="auto"
             data-full-width-responsive="true"></ins>
        <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
    </div>
@endif
