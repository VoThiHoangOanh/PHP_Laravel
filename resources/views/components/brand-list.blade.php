
@if (count($list_brand)>0)
<div class="left-sidebar">
	<h2>THƯƠNG HIỆU</h2>
	<div class="panel-group category-products" id="accordian"><!--brand-productsr-->
        @foreach ($list_brand as $brand)
			<div class="panel panel-default">
				<div class="panel-heading">
                    <h4 class="panel-title">
                        <a href="{{route('frontend.slug',['slug'=>$brand->slug])}}">
                            {{$brand->name}}
                        </a>
                    </h4>
                </div>
            </div>
            @endforeach
	</div>
</div><!--/brand-products-->
@endif

