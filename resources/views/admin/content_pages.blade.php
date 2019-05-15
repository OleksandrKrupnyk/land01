<div style="margin:0 50px 0 50px;">

    @if($pages)

        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>№ п/п</th>
                <th>{{__('Name')}}</th>
                <th>{{__("Alias")}}</th>
                <th>{{__("Text")}}</th>
                <th>{{__("Date create")}}</th>

                <th>{{__('Delete')}}</th>
            </tr>
            </thead>
            <tbody>

            @foreach($pages as $k => $page)

                <tr>

                    <td>{{ $page->id }}</td>
                    <td>{!! Html::linkRoute('pagesEdit',$page->name,['page'=>$page->id],['alt'=>$page->name]) !!}</td>
                    <td>{{ $page->alias }}</td>
                    <td>{!! $page->short_text !!}</td>
                    <td>{{ $page->created_at }}</td>

                    <td>
                        {!! Form::open(['url'=>route('pagesEdit',['page'=>$page->id]), 'class'=>'form-horizontal','method' => 'POST']) !!}

                        {{ method_field('DELETE') }}
                        {!! Form::button(__('Delete'),['class'=>' btn btn-danger','type'=>'submit']) !!}

                        {!! Form::close() !!}
                    </td>
                </tr>

            @endforeach


            </tbody>
        </table>
    @else
        <h1>{{__('No Pages found')}}</h1>
    @endif

    {!! Html::linkRoute('pagesAdd',__('New Page'),null,['class'=>'btn btn-primary']) !!}
</div>