<div class="form-group">
    <label for="poll_title" class="col-sm-2 control-label">Poll title <span class="required">*</span></label>
    <div class="col-sm-8">
        <textarea class="form-control" name="poll_title" id="poll_title" rows="2" placeholder="Poll Title">{{ isset($poll) ? $poll->poll_title : null }}</textarea>
        @if($errors->has('poll_title'))
            <span class="text-danger">{{ $errors->first('poll_title') }}</span>
        @endif
    </div>
</div>
<div class="form-group">
    <label for="photo" class="col-sm-2 control-label">Poll Photo <span class="required">*</span></label>
    <div class="col-sm-8">
        @isset($poll)
            <img src="{{ asset(config('appconfig.pollImagePath').$poll->image_path) }}" style="width: 30%">
        @endisset
        <div class="text-danger" style="margin-bottom: 5px;">Dimension: 750 X 390 pixel &amp; Max size: 100kb</div>
        <input type="file" name="photo" id="photo" class="form-control" style="height: auto">
        @if($errors->has('photo'))
            <span class="text-danger">{{ $errors->first('photo') }}</span>
        @endif
    </div>
</div>
<hr>
<div class="form-group">
    <label class="col-sm-2 control-label">Status</label>
    <div class="col-sm-8">
        <label class="radio-inline">
            <input type="radio" name="status" value="1" {{ isset($poll) ? $poll->status == 1 ? 'checked' : null : null }} checked>Active
        </label>
        <label class="radio-inline">
            <input type="radio" name="status" value="2" {{ isset($poll) ? $poll->status == 2 ? 'checked' : null : null }}>Inactive
        </label>
    </div>
</div>
