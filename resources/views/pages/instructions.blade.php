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
                            <dd>-> Täytä lomake</dd>
                            <dd>-> Tarkasta</dd>
                            <dd>-> Paina Lisää-nappulaa</dd>

                        <dt>Miten täyttää?</dt>
                        <br>
                            <dd><b>Aika:</b>#Automaattinen# Voit muokata, jos on tarpeellista</dd>
                            <dd><b>Käyttäjä:</b>#Kirjautunut käyttäjä# Managerina mahdollisuus vaihtaa käyttäjää</dd>
                            <dd><b>Lähde:</b> Sisäinen-> Oman organisaation toimipisteestä,</dd>
                                <dd>Ulkoinen->Toisesta organisaatiosta,</dd>
                                <dd>Toimittaja->Yksityiseltä henkilöltä tai järjestelmään kuulumattomalta yritykseltä</dd>
                            <dd><b>*Toimipisteestä:</b> Tekstiilin tarkempi lähde sisäisen lähetyksen vastaanotossa</dd>
                            <dd><b>*Organisaatiosta ja Kunnasta:</b> Tekstiilin tarkempi lähde ulkoisen lähetyksen vastaanotossa</dd>
                            <dd><b>*Toimittajalta:</b> Tekstiilin tarkempi lähde järjestelmän ulkopuoliselta toimittajalta</dd>
                            <dd><b>Toimipisteeseen:</b> Vastaanoton sijainti</dd>
                            <dd><b>Materiaali:</b> Vastaanotettava tekstiili</dd>
                            <dd><b>Paino (Kg):</b> Vastaanotetun tekstiilin määrä</dd>
                            <dd><b>Matka (Km):</b> Tekstiilin kulkema matka kuljetuksessa</dd>
                            <dd><b>EWC-Koodi:</b> Tekstiilin EWC-Koodi</dd>
                            <br>
                            <dd><i>**-Riippuu "Lähde:"-kohdan valinnasta </i></dd>
                    </dl>
                </div>
            </div>
            <div class="col-lg-3">
                <h6>Lähetyksen kirjaaminen</h6>
                <div class="border border-info rounded text-left p-3">
                    <dl>
                        <dt>Mistä löytyy?</dt>
                        <dd>-> Materiaalikirjaukset</dd>
                        <dd>-> Lisää lähetys</dd>
                        <dd>-> Täytä lomake</dd>
                        <dd>-> Lisää tai Poista materiaali tarvittaessa</dd>
                        <dd>-> Tarkasta</dd>
                        <dd>-> Paina Lisää-nappulaa</dd>

                        <dt>Miten täyttää?</dt>
                        <br>
                        <dd><b>Aika:</b>#Automaattinen# Voit muokata, jos on tarpeellista</dd>
                        <dd><b>Käyttäjä:</b>#Kirjautunut käyttäjä# Managerina mahdollisuus vaihtaa käyttäjää</dd>
                        <dd><b>Lähetyksen tyyppi:</b> Mihin tarkoitukseen lähetetään materiaalia</dd>
                        <dd><b>Toimipisteestä:</b> Tekstiilin lähde toimipiste</dd>
                        <dd><b>*Mihin toimipisteeseen:</b> Tekstiilin tarkempi kohde sisäisessä siirrossa</dd>
                        <dd><b>*Mihin organisaatioon:</b> Tekstiilin tarkempi kohde ulkoisessa siirrossa</dd>
                        <dd><b>Tekstiili</b> Lähetettävä tekstiili</dd>
                        <dd><b>Paino (Kg):</b> Lähetettävän tekstiilin määrä</dd>
                        <dd><b>EWC-Koodi:</b> Tekstiilin EWC-Koodi</dd>
                        <br>
                        <dd><i>**-Riippuu "Lähetyksen tyyppi:"-kohdan valinnasta </i></dd>
                    </dl>
                </div>
            </div>
            <div class="col-lg-3">
                <h6>Esilajittelukirjauksen kirjaaminen</h6>
                <div class="border border-info rounded text-left p-3">
                    <dl>
                        <dt>Mistä löytyy?</dt>
                        <dd>-> Materiaalikirjaukset</dd>
                        <dd>-> Lisää esilajittelu</dd>
                        <dd>-> Täytä lomake</dd>
                        <dd>-> Tarkasta</dd>
                        <dd>-> Paina Lisää-nappulaa</dd>

                        <dt>Miten täyttää?</dt>
                        <br>
                        <dd><b>Aika:</b>#Automaattinen# Voit muokata, jos on tarpeellista</dd>
                        <dd><b>Käyttäjä:</b>#Kirjautunut käyttäjä# Managerina mahdollisuus vaihtaa käyttäjää</dd>
                        <dd><b>Materiaali:</b> Esilajittelussa syntyvä tekstiililuokka, joka mm. hienolajitellaan</dd>
                        <dd><b>Toimipiste:</b> Toimipiste missä esilajittelu tapahtuu</dd>
                        <dd><b>Saapunut kirjaus:</b> Valitaan saapuneista kirjauksista haluttu kirjaus, jota esilajitellaan</dd>
                        <dd><b>Paino (Kg):</b> Lähetettävän tekstiilin määrä</dd>
                        <dd><b>EWC-Koodi:</b> Tekstiilin EWC-Koodi</dd>
                        <br>
                    </dl>
                </div>
            </div>
            <div class="col-lg-3">
                <h6>Hienolajittelukirjauksen kirjaaminen</h6>
                <div class="border border-info rounded text-left p-3">
                    <dl>
                        <dt>Mistä löytyy?</dt>
                        <dd>-> Materiaalikirjaukset</dd>
                        <dd>-> Lisää hienolajittelu</dd>
                        <dd>-> Täytä lomake</dd>
                        <dd>-> Tarkasta</dd>
                        <dd>-> Paina Lisää-nappulaa</dd>

                        <dt>Miten täyttää?</dt>
                        <br>
                        <dd><b>Aika:</b>#Automaattinen# Voit muokata, jos on tarpeellista</dd>
                        <dd><b>Käyttäjä:</b>#Kirjautunut käyttäjä# Managerina mahdollisuus vaihtaa käyttäjää</dd>
                        <dd><b>Toimipiste:</b> Toimipiste missä hienolajittelu tapahtuu</dd>
                        <dd><b>Tekstiilin alkuperä:</b> Valitaan, että hienolajitellaanko saapunutta kirjausta vai esilajittelukirjausta</dd>
                        <dd><b>**Saapuneiden materiaalien kirjaus:</b> Valitaan saapunut-kirjaus</dd>
                        <dd><b>**Esilajittelun kirjaus: Valitaan esilajittelu-kirjaus</b></dd>
                        <dd><b>Tekstiili</b> Valitaan tekstiili, joka syntyy hienolajittelussa</dd>
                        <dd><b>Paino (Kg):</b> Hienolajitellun tekstiilin paino</dd>
                        <dd><b>Lisätietoja:</b> Voidaan kirjata hienolajittelutapahtuman lisätietoja mm. lajittelussa olleet henkilöt</dd>
                        <br>
                        <dd><i>**-Riippuu "Tekstiilin alkuperä:"-kohdan valinnasta </i></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

@endsection
