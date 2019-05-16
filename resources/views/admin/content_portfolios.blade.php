<div style="display: flex; flex-flow: row nowrap;justify-content: center; padding: 5px ">
    {!! Html::linkRoute('portfolioAdd',__('New portfolio'),[],['class'=>'btn btn-primary']) !!}
</div>
@if(isset($portfolios) && is_object($portfolios))
    <div class="portfolio-top"></div>
    <!-- Portfolio Wrapper -->
    <div class="" style="display: flex; flex-flow: row wrap; height: 480px;"
         id="portfolio_wrapper">
    @foreach($portfolios as $portfolio)
        <!-- Portfolio Item -->
            <div style="width: 25%"
                 class="portfolio-item">
                <div class="portfolio_img">
                    {!! Html::image('assets/img/'.$portfolio->images,'Portfolio 1') !!}
                </div>
                <div class="item_overlay">
                    <div class="item_info">
                        <h4 class="project_name">
                            {!! Html::linkRoute('portfoliosEdit',$portfolio->name,$portfolio->id,['class'=>'btn btn-primary']) !!}
                        </h4>
                        {!! Form::open(['url'=>route('portfoliosEdit',['portfolio'=>$portfolio->id]),'method'=>'post']) !!}
                        {{method_field('DELETE')}}
                        {!! Form::submit(__('Delete'), ['class' => 'form-control btn btn-alert']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <!--/Portfolio Item -->
        @endforeach
    </div>
    <!--/Portfolio Wrapper -->
@else
    <h2>{{__('No portfolios')}}</h2>
@endif