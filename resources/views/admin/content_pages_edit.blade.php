<div class="wrapper container-fluid">
{!! Form::open(['url' => route('pagesEdit',['page'=>$data['slug']]),'class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data']) !!}
    <div class="form-group">
    	{!! Form::hidden('slug', $data['slug']) !!}
    	{!! Form::hidden('id', $data['id']) !!}
	     {!! Form::label('name', __('Name').':',['class'=>'col-xs-2 control-label']) !!}
	     <div class="col-xs-8">
		 	{!! Form::text('name', $data['name'], ['class' => 'form-control','placeholder'=>'Введите название страницы']) !!}
		 </div>
    </div>

    <div class="form-group">
	     {!! Form::label('alias', __("Alias").':',['class'=>'col-xs-2 control-label']) !!}
	     <div class="col-xs-8">
		 	{!! Form::text('alias', $data['alias'], ['class' => 'form-control','placeholder'=>'Введите псевдоним страницы']) !!}
		 </div>
    </div>

    <div class="form-group">
	     {!! Form::label('text', __("Text").':',['class'=>'col-xs-2 control-label']) !!}
	     <div class="col-xs-8">
		 	{!! Form::textarea('text', $data['text'], ['id'=>'editor','class' => 'form-control','placeholder'=>'Введите текст страницы']) !!}
		 </div>
    </div>

    <div class="form-group">
		@if(isset($data['images']) && !empty($data['images']) )
		{!! Form::label('old_images', __('Image').':',['class'=>'col-xs-2 control-label']) !!}
    	<div class="col-xs-offset-2 col-xs-10">
			{!! Html::image('assets/img/'.$data['images'],'',['class'=>'img-circle img-responsive','width'=>'150px']) !!}
    	</div>
		@endif
			{!! Form::hidden('old_images', $data['images']) !!}
	</div>

    <div class="form-group">
	     {!! Form::label('images', __('Image').':',['class'=>'col-xs-2 control-label']) !!}
	     <div class="col-xs-8">
		 	{!! Form::file('images', ['class' => 'filestyle','data-buttonText'=>'Выберите изображение','data-buttonName'=>"btn-primary",'data-placeholder'=>"Файла нет"]) !!}
		 </div>
    </div>



      <div class="form-group">
	    <div class="col-xs-offset-2 col-xs-10">
	      {!! Form::button(__('Save'), ['class' => 'btn btn-primary','type'=>'submit']) !!}
	    </div>
	  </div>

{!! Form::close() !!}
	<script>
		ClassicEditor.create( document.querySelector('#editor'),{

		});
	</script>
</div>