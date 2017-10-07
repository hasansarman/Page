<div class="box-body">
    <div class="box-body">
        <div class='form-group{{ $errors->has("TITLE") ? ' has-error' : '' }}'>
            {!! Form::label("TITLE", trans('page::pages.form.title')) !!}
            <?php $old = $page->TITLE; ?>
            {!! Form::text("TITLE", old("TITLE", $old), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => trans('page::pages.form.title')]) !!}
            {!! $errors->first("TITLE", '<span class="help-block">:message</span>') !!}
        </div>
        <div class='form-group{{ $errors->has("SLUG") ? ' has-error' : '' }}'>
            {!! Form::label("SLUG", trans('page::pages.form.slug')) !!}
            <?php $old = $page->SLUG; ?>
            {!! Form::text("SLUG", old("SLUG", $old), ['class' => 'form-control slug', 'data-slug' => 'target', 'placeholder' => trans('page::pages.form.slug')]) !!}
            {!! $errors->first("SLUG", '<span class="help-block">:message</span>') !!}
        </div>

        <script src="/assets/akrep_assets/js/vendor/ckeditor/ckeditor.js"></script>
       <h3 for="aciklama">Body</h3>
                              <textarea name="BODY" id="BODY" rows="50" cols="80">
  <?php $old = $page->BODY; ?>
{{old("BODY", $old)}}
                   </textarea>
                              <script>
                                  CKEDITOR.replace( 'BODY' );

                              </script>


        <?php if (config('asgard.page.config.partials.translatable.edit') !== []): ?>
            <?php foreach (config('asgard.page.config.partials.translatable.edit') as $partial): ?>
                @include($partial)
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div class="box-group" id="accordion">
        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
        <div class="panel box box-primary">
            <div class="box-header">
                <h4 class="box-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                        {{ trans('page::pages.form.meta_data') }}
                    </a>
                </h4>
            </div>
            <div style="height: 0px;" id="collapseTwo" class="panel-collapse collapse">
                <div class="box-body">
                    <div class='form-group{{ $errors->has("META_TITLE") ? ' has-error' : '' }}'>
                        {!! Form::label("META_TITLE", trans('page::pages.form.meta_title')) !!}
                        <?php $old =  $page->META_TITLE; ?>
                        {!! Form::text("META_TITLE", old("META_TITLE", $old), ['class' => "form-control", 'placeholder' => trans('page::pages.form.meta_title')]) !!}
                        {!! $errors->first("META_TITLE", '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class='form-group{{ $errors->has("META_DESCRIPTION") ? ' has-error' : '' }}'>
                        {!! Form::label("META_DESCRIPTION", trans('page::pages.form.meta_description')) !!}
                        <?php $old =$page->META_DESCRIPTION; ?>
                        <textarea class="form-control" name="META_DESCRIPTION" rows="10" cols="80">{{ old("META_DESCRIPTION", $old) }}</textarea>
                        {!! $errors->first("META_DESCRIPTION", '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="panel box box-primary">
            <div class="box-header">
                <h4 class="box-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFacebook">
                        {{ trans('page::pages.form.facebook_data') }}
                    </a>
                </h4>
            </div>
            <div style="height: 0px;" id="collapseFacebook" class="panel-collapse collapse">
                <div class="box-body">
                    <div class='form-group{{ $errors->has("OG_TITLE") ? ' has-error' : '' }}'>
                        {!! Form::label("OG_TITLE", trans('page::pages.form.og_title')) !!}
                        <?php $old =  $page->OG_TITLE;?>
                        {!! Form::text("OG_TITLE", old("OG_TITLE", $old), ['class' => "form-control", 'placeholder' => trans('page::pages.form.og_title')]) !!}
                        {!! $errors->first("OG_TITLE", '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class='form-group{{ $errors->has("OG_DESCRIPTION") ? ' has-error' : '' }}'>
                        {!! Form::label("OG_DESCRIPTION", trans('page::pages.form.og_description')) !!}
                        <?php $old = $page->OG_DESCRIPTION; ?>
                        <textarea class="form-control" name="OG_DESCRIPTION" rows="10" cols="80">{{ old("OG_DESCRIPTION", $old) }}</textarea>
                        {!! $errors->first("OG_DESCRIPTION", '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group{{ $errors->has("OG_TYPE") ? ' has-error' : '' }}">
                        <label>{{ trans('page::pages.form.og_type') }}</label>
                        <?php $oldType =$page->OG_TYPE; ?>
                        <?php $oldType = null !== old("OG_TYPE") ? old("OG_TYPE") : $oldType; ?>
                        <select class="form-control" name="OG_TYPE">
                            <option value="website" {{ $oldType == 'website' ? 'selected' : ''}}>
                                {{ trans('page::pages.facebook-types.website') }}
                            </option>
                            <option value="product" {{ $oldType == 'product' ? 'selected' : ''}}>
                                {{ trans('page::pages.facebook-types.product') }}
                            </option>
                            <option value="article" {{ $oldType == 'article' ? 'selected' : ''}}>
                                {{ trans('page::pages.facebook-types.article') }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<label>Oluşturulma Tarihi: <label id="idate">{{$page->IDATE}}</label></label>
<br/>
<label>Son Güncelleme: <label id="udate">{{$page->UDATE}}</label></label>
<br/>
