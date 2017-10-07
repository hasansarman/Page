@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('page::pages.title.create page') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ URL::route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ URL::route('admin.page.page.index') }}">{{ trans('page::pages.title.pages') }}</a></li>
        <li class="active">{{ trans('page::pages.title.create page') }}</li>
    </ol>
@stop

@push('css-stack')
    <style>
        .checkbox label {
            padding-left: 0;
        }
    </style>
@endpush

@section('content')
    {!! Form::open(['route' => ['admin.page.page.store'], 'method' => 'post']) !!}
    <div class="row">
        <div class="col-md-10">
            <div class="nav-tabs-custom">

                <div class="tab-content">

                        @include('page::admin.partials.create-fields', ['lang' => ''])


                    <?php if (config('asgard.page.config.partials.normal.create') !== []): ?>
                        <?php foreach (config('asgard.page.config.partials.normal.create') as $partial): ?>
                            @include($partial)
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.create') }}</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ URL::route('admin.page.page.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                    </div>
                </div>
            </div> {{-- end nav-tabs-custom --}}
        </div>
        <div class="col-md-2">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="checkbox{{ $errors->has('IS_HOME') ? ' has-error' : '' }}">
                        <input type="hidden" name="IS_HOME" value="0">
                        <label for="IS_HOME">
                            <input id="IS_HOME"
                                   name="IS_HOME"
                                   type="checkbox"
                                   class="flat-blue"
                                   value="1" />
                            {{ trans('page::pages.form.is homepage') }}
                            {!! $errors->first('IS_HOME', '<span class="help-block">:message</span>') !!}
                        </label>
                    </div>
                    <hr/>
                    <div class='form-group{{ $errors->has("TEMPLATE") ? ' has-error' : '' }}'>
                        {!! Form::label("TEMPLATE", trans('page::pages.form.template')) !!}
                        {!! Form::select("TEMPLATE", $all_templates, old("template", 'default'), ['class' => "form-control", 'placeholder' => trans('page::pages.form.template')]) !!}
                        {!! $errors->first("TEMPLATE", '<span class="help-block">:message</span>') !!}
                    </div>
                    <hr>
                <?php //    @tags('asgardcms/page')
                ?>
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('page::pages.navigation.back to index') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script>
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.page.page.index') ?>" }
                ]
            });
            $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });
        });
    </script>
@endpush
