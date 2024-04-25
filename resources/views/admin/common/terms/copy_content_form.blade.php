@extends('admin.layouts.master')
@section('title')
    Copy content one to another category
@endsection
@section('filter')
    @if(request()->id)
        <a class="btn btn-sm btn-warning py-0 me-2" href="{{ route('common_term_copy_content_form', request()->id) }}">
            Copy category content
        </a>
        <a href="{{ route('common_term_edit', request()->id) }}" class="btn btn-sm btn-success py-0">Back</a>
    @endif
@endsection
@section('content')
    @if(!empty(request()->id))
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-4 py-2 text-center">
                    <form action="{{ route('common_term_copy_content') }}" method="post">
                        @csrf
                        <input type="hidden" value="{!! request()->id ?? NULL !!}" name="from_id"/>
                        <div class="form-group">
                            <label for="copy_to">Copy To...</label>
                            <select name="copy_to" id="level_no_get" class="form-control">
                                <option value="">Select a parent</option>
                                {!! select_option_html($cats, $parent = 3, ' ', NULL, FALSE ) !!}
                            </select>
                        </div>

                        <div class="form-group">
                            <label style="width: 20%;">&nbsp;</label>
                            <div class="form-submit_btn">

                                <button type="submit" id="menu-generator-cat-submit"
                                        class="btn blue">
                                    Save Changes
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    @endif
@endsection
