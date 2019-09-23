@extends(Auth::user()->user_type_id == 1 ? 'layouts.default' : 'layouts.macrolocation')
@section('title', 'Ohjeet')
@section('content')
    <div class="panel-default">
        <div class="panel-heading">
            <h4>Ohjeet</h4>
        </div>
{{--        including instruction forms--}}
        <div class="panel-body row p-4" style="margin-right: 0; margin-left: 0;">
            @include('includes.instructionForms.createCompany')
            @include('includes.instructionForms.createReceipt')
            @include('includes.instructionForms.createIssue')
            @include('includes.instructionForms.createPre')
            @include('includes.instructionForms.createRefined')
        </div>
    </div>

@endsection
