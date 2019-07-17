@extends ('pages.company.manage.users')

@section('csv_data')
    <table class="table table-bordered table-hover">
        <thead>
        <tr>

            <th>Microlokaatio</th>
            <th>Tyyppi</th>
            <th>Sukunimi</th>
            <th>Etunimi</th>
            <th>Sähköposti</th>
            <th>Käyttäjätunnus</th>

        </tr>
        </thead>
        {{--                    @php--}}
        {{--                        $users = DB::table('users')--}}
        {{--                                    ->where('user_company_id','=',$company->company_id)--}}
        {{--                                    ->join('user_types', 'users.user_type_id', '=','user_types.user_type_id')--}}
        {{--                                    ->leftJoin('microlocations', 'users.user_microlocation_id', '=','microlocations.microlocation_id')--}}
        {{--                                    ->orderBy('user_id')--}}
        {{--                                    ->orderBy('user_microlocation_id')--}}
        {{--                                    ->orderBy('users.user_type_id')--}}
        {{--                                    ->orderBy('user_microlocation_id')--}}
        {{--                                    ->orderBy('user_id')--}}
        {{--                                    ->get();--}}

        {{--                    @endphp--}}

        @foreach ($data as $user)
            <tr>
                <td>{{title_case($user->microlocation_name)}}</td>
                <td>{{title_case($user->user_typename)}}</td>
                <td>{{title_case($user->last_name)}}</td>
                <td>{{title_case($user->first_name)}}</td>
                <td>{{title_case($user->email)}}</td>
                <td>{{title_case($user->username)}}</td>
                <td><a href="{{url('/companies/'.$company->company_id.'/manage/users/'.$user->user_id.'/edit')}}"> <span class="glyphicon glyphicon-pencil"></span></a></td>
            </tr>
        @endforeach
    </table>

@endsection
