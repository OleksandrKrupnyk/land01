<div id="filters" class="sixteen columns">
    @if(isset($menu) && is_array($menu))
        <ul style="padding:0">
            @foreach($menu as $alias=>$item)
                <li>
                    @if($item['active'])
                        <a href="{{route($alias)}}">
                            <h5>{{__($item['name'])}}</h5>
                        </a>
                    @else
                        <a href="javascript:void(0)">
                            <h5>{{__($item['name'])}}</h5>
                        </a>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</div>