<div class="form-group{{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Darslik nomi' }}</label>
    <input class="form-control" name="title" type="text" id="title" value="{{ $document->title ?? ''}}" required>
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Dars uchun ssilka' }}</label>
    <input class="form-control" name="link" type="text" id="title" value="{{ $document->link ?? ''}}">
    {!! $errors->first('link', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('file') ? 'has-error' : ''}}">
    <label for="file" class="control-label">{{ 'File' }}</label>
    <input class="form-control" name="file" type="file" id="file" value="{{ $document->file ?? ''}}" >
    {!! $errors->first('file', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Yangilash' : 'Saqlash' }}">
</div>
