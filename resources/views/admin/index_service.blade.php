<div style="display: flex; flex-flow: row nowrap;justify-content: center; padding: 5px ; flex:0 0 100%">
    {!! Html::link(route('service.create'),__('Create service'),['class'=>'btn btn-info']) !!}
</div>
<div style="display:flex;flex-flow: row">
    @if(isset($services))
        <div class="service_wrapper">
            @foreach($services as $k=>$service)
                @if($k==0 || $k % 3 == 0)
                    <div class="row {{($k != 0)?"borderTop":''}}">
                        @endif
                        <div class="col-lg-4 {{($k % 3 >0)?"borderLeft":''}} {{($k>=3)?'mrgTop':''}}">
                            <div class="service_block">
                                <div class="service_icon"><span><i
                                                class="fa {{$service->icon}}"></i></span></div>
                                <h3>
                                {!! Html::linkRoute('service.edit',$service->name,$service->id) !!}
                                </h3>
                                <p class="">{{$service->text}}.</p>
                                {!! Form::open(['url'=>route('service.destroy',['service'=>$service->id]),'method'=>'post']) !!}
                                {{method_field("DELETE")}}
                                {!! Form::submit(__('Delete'),['class'=>'btn btn-primary']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                        @if(($k+1)%3 == 0)
                    </div>
                @endif
            @endforeach
        </div>
    @endif
</div>

