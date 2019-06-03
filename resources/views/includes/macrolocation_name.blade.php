<div class="navbar">
    <div class="navbar-inner">
        <a id="logo" href="/companies/{{$company->company_id}}">TOIMIPISTE: {{$company->company_name}}</a>
        <ul class="nav">
            <li><a href="/companies/{{$company->company_id}}/warehouse">Varasto</a></li>
            <li><a href="/companies/{{$company->company_id}}/sorting">Lajittelussa</a></li>
            <li><a href="/companies/{{$company->company_id}}/sorted">Lajittelu</a></li>
            <li><a href="/companies/{{$company->company_id}}/issues">ISSUES</a></li>
        </ul>
    </div>
</div>