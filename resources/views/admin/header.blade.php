<div class="container portfolio_title">

    <!-- Title -->
    <div class="section-title">
        <h2>{{ $title }}</h2>
    </div>
    <!--/Title -->

</div>
<!-- Container -->

<div class="portfolio">

    <div id="filters" class="sixteen columns">
        <ul style="padding:0">
            <li><a href="{{route('pages')}}">
                    <h5>{{__('Pages')}}</h5>
                </a>
            </li>

            <li><a href="{{route('portfolio')}}">
                    <h5>{{__('Portfolio')}}</h5>
                </a>
            </li>

            <li><a href="{{route('services')}}">
                    <h5>{{__('Services')}}</h5>
                </a>
            </li>
        </ul>
    </div>

</div>
