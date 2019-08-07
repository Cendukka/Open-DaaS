<div class="form-group">
    <div class="col-sm-4">
        <div class="form-group row">
            <label for="search" class="col-sm-2 col-form-label form-text-align-padd">Haku:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="search" name="search" placeholder="Hae...">
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group row">
            <label for="from-date" class="col-sm-2 col-form-label form-text-align-padd">From:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control timepicker" id="from-date" name="from-date" value="{{date('Y-m-d', strtotime("-12 months", strtotime(date('Y-m-d'))))}}">
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group row">
            <label for="date-date" class="col-sm-2 col-form-label form-text-align-padd">To:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control timepicker" id="to-date" name="to-date" value="{{date('Y-m-d')}}">
            </div>
        </div>
    </div>
</div>