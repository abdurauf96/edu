<div class="form-group{{ $errors->has('stet') ? 'has-error' : ''}}">
    <label for="stet" class="control-label">{{ 'Stet' }}</label>
    <input class="form-control" name="stet" type="text" id="stet" value="{{ $login->stet or ''}}" >
    {!! $errors->first('stet', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
