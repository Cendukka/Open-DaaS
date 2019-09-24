{{-- Date and time for creating and editing events --}}
<div class="form-group row">
    <label class="col-sm-2 col-form-label" for="datetime">Aika:</label>
    <div class="col-sm-10" style="position: relative">
        <input type="text" style="width: 215px;" class="form-control timepicker" name="datetime" value="{{isset($time) ? $time : ''}}"/>
    </div>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
    $('.timepicker').datepicker({
        format: 'dd-mm-yyyy'
    });
</script>