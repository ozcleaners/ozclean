@extends('admin.layouts.master')

@section('title', 'Global Settings')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            {{--            @component('components.dropzone')--}}
            {{--            @endcomponent--}}

            <?php
            //            echo view('components.dropzone')->with(['mediaArr' => [
            //                "scriptLoad" => true,
            //                'paginate' => false,
            //            ]]);
            //echo $this->showMedia();
            ?>

            <div style="border: 1px solid #eee; padding: 15px;" class="my-2">
                @component('components.media_manager_template', [ 'media_array' => [
                        'button_id' => 'logo',
                        'label' => 'Logo',
                        'input_name' => 'logo',
                        'row_information' => $setting ?? NULL,
                        'script_load' => TRUE
                        ]])
                @endcomponent
            </div>


            <div style="border: 1px solid #eee; padding: 15px;" class="my-2">
                @component('components.media_manager_template', [ 'media_array' => [
                        'button_id' => 'favicon',
                        'label' => 'Favicon',
                        'input_name' => 'favicon',
                        'row_information' => $setting ?? NULL,
                        'script_load' => FALSE
                        ]])
                @endcomponent


            </div>

        </div>
    </div>
@endsection
@section('cusjs')
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endsection
