@section('css')
    <link rel="stylesheet" href="/admin/assets/bundles/summernote/summernote-bs4.css">
@endsection
<div class="form-group{{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Sarlavha' }}</label>
    <input class="form-control" name="title" type="text" id="title" value="{{ $contact->title ?? ''}}" required>
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('body') ? 'has-error' : ''}}">
    <label for="body" class="control-label">{{ 'Malumotlar' }}</label>
    <textarea class="form-control summernote" rows="5" name="body" type="textarea" id="body" required>{{ $contact->body ?? ''}}</textarea>
    {!! $errors->first('body', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Yangilash' : 'Saqlash' }}">
</div>

@section('js')
    <script src="/admin/assets/bundles/summernote/summernote-bs4.js"></script>
@endsection
