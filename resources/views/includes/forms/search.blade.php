{{--The search fields that are found in report pages--}}
<div class="form-group row p-4">
    <div class="col-sm-4">
        <div class="form-group row">
            <label for="search" class="col-sm-2 col-form-label form-text-align-padd">Haku:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="search" name="search" placeholder="Hae...">
                <small class="form-text text-muted">Voit käyttää välilyöniä tarkentaaksesi hakua, ja pilkkua jos haluat hakea useita hakutuloksia</small>
            </div>

        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group row">
            <label for="from-date" class="col-sm-2 col-form-label form-text-align-padd">From:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control timepicker" id="from-date" name="from-date" value="{{date('d-m-Y', strtotime("-12 months", strtotime(date('d-m-Y'))))}}">
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group row">
            <label for="date-date" class="col-sm-2 col-form-label form-text-align-padd">To:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control timepicker" id="to-date" name="to-date" value="{{date('d-m-Y')}}">
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript">
        $('.timepicker').datepicker({
            format: 'dd-mm-yyyy'
        }).on('changeDate', function() {
            search();
        });
    </script>
</div>
