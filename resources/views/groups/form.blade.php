    <form role="form" method="POST" action="/groups/{{ isset($oGroup) ? 'edit/' . $oGroup->id : 'save' }}">
        {!! csrf_field() !!}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <input type="text" class="form-control" name="name" value="{{ $oGroup->name ?? old('name') }}" placeholder="Name">

            @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            <textarea class="form-control" name="description" placeholder="Description">{{ $oGroup->description ?? old('description') }}</textarea>

            @if ($errors->has('description'))
            <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('tag') ? ' has-error' : '' }}">
            <select class="form-control" name="tag">
                <option value="">- Category -</option>
                @foreach (Ivy\Model\Group::listTags() as $oTag)
                <option value="{{ $oTag->id }}"{{ (isset($oGroup) ? $oGroup->tags->first()->id : old('tag')) == $oTag->id ? ' selected' : '' }}>
                    {{ $oTag->description }}
                </option>
                @endforeach
            </select>

            @if ($errors->has('tag'))
            <span class="help-block">
                <strong>{{ $errors->first('tag') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('public') ? ' has-error' : '' }}">
            <select class="form-control" name="public">
                <option value="">- Public? -</option>
                <option value="{{ Ivy\Model\Group::ACCESS_PUBLIC }}"{{ ($oGroup->public ?? old('public')) == (string)Ivy\Model\Group::ACCESS_PUBLIC ? ' selected' : '' }}>
                    Yes
                </option>
                <option value="{{ Ivy\Model\Group::ACCESS_PRIVATE }}"{{ ($oGroup->public ?? old('public')) == (string)Ivy\Model\Group::ACCESS_PRIVATE ? ' selected' : '' }}>
                    No
                </option>
            </select>

            @if ($errors->has('public'))
            <span class="help-block">
                <strong>{{ $errors->first('public') }}</strong>
            </span>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">
            {{ isset($oGroup) ? 'Save' : 'Create' }}
        </button>
    </form>
