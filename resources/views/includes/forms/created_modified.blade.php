{{-- Created and modified dates for edit pages --}}
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Kirjattu:</label>
    <div class="col-sm-10">
        {{$created_at}}
    </div>
</div>
@if($created_at != $updated_at)
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Muokattu:</label>
        <div class="col-sm-10">
            {{$updated_at}}
        </div>
    </div>
@endif