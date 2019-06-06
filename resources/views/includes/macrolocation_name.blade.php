<div class="navbar">
    <div class="navbar-inner">
{{--        <a id="logo" href="/companies/{{$company->company_id}}">TOIMIPISTE: {{$company->company_name}}</a>--}}
        @php
            $no_navbar = isset($no_navbar) ? $no_navbar : false;
        @endphp
        @includeWhen(!$no_navbar, 'includes.macrolocation_name_navbar')
    </div>
</div>