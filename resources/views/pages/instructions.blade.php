@extends(Auth::user()->user_type_id == 1 ? 'layouts.default' : 'layouts.macrolocation')
@section('title', 'Ohjeet')
@section('content')
    <div class="panel-default">
        <div class="panel-heading">
            <h4>Ohjeet</h4>
        </div>
        <div class="panel-body row p-4" style="margin-right: 0; margin-left: 0;">
            <div class="col-lg-3">
                <h6>Saapuneen lähetyksen kirjaaminen</h6>
                <div class="border border-info rounded text-left p-3 text-break">
                    <dl>
                        <dt>Mistä löytyy?</dt>
                        <dd>-> Materiaalikirjaukset</dd>
                        <dd>-> Lisää vastaanotto</dd>
                        <dt>Miten täyttää?</dt>
                        <dd>Aika:*Automaattinen* Voit muokata, jos on tarpeellista

                            Käyttäjä:

                            Lähde:

                            Toimipisteestä:

                            Toimipisteeseen:

                            Materiaali:

                            Paino (Kg):

                            Matka (Km):

                            EWC-Koodi:
                        </dd>
                    </dl>
                </div>
            </div>
            <div class="col-lg-3">
                <h6>Lähetyksen kirjaaminen</h6>
                <div class="border border-info rounded text-left p-3">
                    <dl>
                        <dt>Mistä löytyy?</dt>
                        <dd>- black hot drink</dd>
                        <dt>Milk</dt>
                        <dd>- white cold drink</dd>
                    </dl>
                </div>
            </div>
            <div class="col-lg-3">
                <h6>Esilajittelukirjauksen kirjaaminen</h6>
                <div class="border border-info rounded text-left p-3">
                    <dl>
                        <dt>Mistä löytyy?</dt>
                        <dd>- black hot drink</dd>
                        <dt>Milk</dt>
                        <dd>- white cold drink</dd>
                    </dl>
                </div>
            </div>
            <div class="col-lg-3">
                <h6>Hienolajittelukirjauksen kirjaaminen</h6>
                <div class="border border-info rounded text-left p-3">
                    <dl>
                        <dt>Mistä löytyy?</dt>
                        <dd>- black hot drink</dd>
                        <dt>Milk</dt>
                        <dd>- white cold drink</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

@endsection
