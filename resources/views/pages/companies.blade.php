@extends('layouts.default')
@section ('title', 'Toimipisteet')
@section('content')
   <div class="row">
      <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    @foreach (DB::table('company')->get() as $company)
                        <div class="panel-heading">
                            <a href="{{url('/companies/'.$company->company_id)}}">{{title_case($company->company_name)}}</a>
                        </div>
                    @endforeach
                        <br>
                        <!--<a href="{{url(action('company_controller@create'))}}" style="color:blue;">+ Add company</a>-->
				</div>

       </div>
    </div>
@endsection
