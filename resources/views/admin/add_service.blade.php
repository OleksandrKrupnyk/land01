<div class="wrapper container-fluid">
    {!! Form::open(['url'=>route('service.store'),'method'=>'post','class'=>'form-horizontal']) !!}
    <div class="form-group">
        {!! Form::label('name', __('Name').':',['class'=>'col-xs-2 control-label']) !!}
        <div class="col-xs-8">
            {!! Form::input('text','name',old('name'),['class' => 'form-control','placeholder'=>__('Enter title')]) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('text', __('Text').':',['class'=>'col-xs-2 control-label']) !!}
        <div class="col-xs-8">
            {!! Form::input('text','text',old('text'),['class' => 'form-control','placeholder'=>__('Enter text')]) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Html::tag('style',"select { font-family: 'FontAwesome', 'sans-serif'; }") !!}
        {!! Form::label('icon', __('Icon').':',['class'=>'col-xs-2 control-label']) !!}
        <div class="col-xs-8">
            {!! Form::select('icon',$icons,old('icon'),['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-offset-2 col-xs-10">
            {!! Form::button(__('Save'), ['class' => 'btn btn-primary','type'=>'submit']) !!}
        </div>
    </div>

    {!! Form::close() !!}
</div>