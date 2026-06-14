@extends('public.layout')

@section('title', 'Privacy Policy - Maasai Shop')

@section('content')
<section class="py-5">
    <div class="container-fluid px-3 px-lg-4" style="max-width: 980px;">
        <div class="panel p-4 p-lg-5">
            <div class="eyebrow mb-3">Privacy policy</div>
            <h1 class="h2 mb-4">Maasai Shop Privacy Policy</h1>
            <p class="text-muted">Last updated: {{ now()->format('F j, Y') }}</p>

            <p>
                Maasai Shop (traderspulse.site) is a retail inventory application used to manage products,
                purchases, sales, suppliers, stock movements, and reports.
            </p>
            <p>
                We only collect the information needed to operate the application, authenticate users, and
                maintain business records entered by the shop operator.
            </p>

            <h2 class="h5 mt-4">Google AdSense</h2>
            <p>
                This site uses Google AdSense to display advertisements. Google and its partners may use
                cookies or similar technologies to serve ads, measure ad performance, and personalize ad
                content based on your visits to this and other websites.
            </p>
            <p>
                You can learn how Google uses data from partner sites at
                <a href="https://policies.google.com/technologies/partner-sites" rel="noopener noreferrer" target="_blank">Google’s partner sites policy</a>.
                You may opt out of personalized advertising by visiting
                <a href="https://www.google.com/settings/ads" rel="noopener noreferrer" target="_blank">Google Ads Settings</a>.
            </p>

            <p>
                We do not sell personal information. Any shop data stored in the system is managed for internal
                business use only.
            </p>
            <p class="mb-0">
                For questions about this site, contact the Maasai Shop site owner.
            </p>
        </div>
    </div>
</section>
@endsection
