<div class="wrapper container-fluid">
    @if(isset($data))
        {!! Form::open(['url'=>route('service.update',['service'=>$data['id']]),'method'=>'post','class'=>'form-horizontal']) !!}
        <div class="form-group">
            {!! Form::hidden('id', $data['id']) !!}
            {{method_field('PUT')}}
            {!! Form::label('name', __('Name').':',['class'=>'col-xs-2 control-label']) !!}
            <div class="col-xs-8">
                {!! Form::input('text','name',$data['name'],['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('text', __('Text').':',['class'=>'col-xs-2 control-label']) !!}
            <div class="col-xs-8">
                {!! Form::input('text','text',$data['text'],['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Html::tag('style',"select { font-family: 'FontAwesome', 'sans-serif'; }") !!}
            {!! Form::label('icon', __('Icon').':',['class'=>'col-xs-2 control-label']) !!}
            <div class="col-xs-8">
                {!! Form::select('icon',$icons,$data['icon'],['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-offset-2 col-xs-10">
                {!! Form::button(__('Save'), ['class' => 'btn btn-primary','type'=>'submit']) !!}
            </div>
        </div>

        {!! Form::close() !!}
    @endif
</div>