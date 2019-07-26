<div class="form-group row">
    <div class="col-sm-2"></div>
    <div class="col-sm-10">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" {{isset($checked) ? 'checked' : ''}} id="for_issue" name="for_issue">
            <label class="form-check-label" for="for_issue">Materiaali menee lähetykseen</label>
        </div>
        <small class="form-text text-muted">
            Valitse, jos materiaali menee suoraan lähetykseen, eikä sitä lajitella.<br>
            Jos valittuna, tämä lähetys ei näy kirjatessa lajitteluita.
        </small>
    </div>
</div>