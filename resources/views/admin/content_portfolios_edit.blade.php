@if(isset($data))
    <div class="wrapper container-fluid">

        {!! Form::open(['url' => route('portfoliosEdit',['portfolio'=>$data['id']]),'class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data']) !!}


        <div class="form-group">

            {!! Form::label('name',__('Name').":",['class' => 'col-xs-2 control-label'])   !!}
            <div class="col-xs-8">
                {!! Form::text('name',$data['name'],['class' => 'form-control','placeholder'=>'Введите название портфолио'])!!}
            </div>

        </div>

        @if (isset($filters))

            <div class="form-group">
                {!! Form::label('filter', __("Category").':',['class'=>'col-xs-2 control-label']) !!}
                <div class="col-xs-8">
                    {!! Form::select('filter',$filters,$data['filter'],['class'=>'selectpicker','data-style'=>"btn-primary"]) !!}
                </div>
            </div>
        @endif

        <div class="form-group">
            @if(isset($data['images']) && !empty($data['images']) )
                {!! Form::label('old_images', __('Image').':',['class'=>'col-xs-2 control-label']) !!}
                <div class="col-xs-offset-2 col-xs-10">
                    {!! Html::image('assets/img/'.$data['images'],'',['class'=>'img-responsive','width'=>'150px']) !!}
                </div>
            @endif
            {!! Form::hidden('old_images', $data['images']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('images', __('Image').':',['class'=>'col-xs-2 control-label']) !!}
            <div class="col-xs-8">
                {!! Form::file('images', [
                'class' => 'filestyle','data-buttonText'=>__('Select image'),'data-buttonName'=>"btn-primary",'data-placeholder'=>__('No file')
                ]) !!}
            </div>
        </div>


        <div class="form-group">
            <div class="col-xs-offset-2 col-xs-10">
                {!! Form::button(__('Save'), ['class' => 'btn btn-primary','type'=>'submit']) !!}
            </div>
        </div>

        {!! Form::close() !!}
    </div>
@else
    {{abort('404')}}
@endif