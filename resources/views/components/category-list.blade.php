
@if (count($list_category)>0)
<div class="left-sidebar">
	<h2>DANH MỤC SẢN PHẨM</h2>
	<div class="panel-group category-products" id="accordian"><!--category-productsr-->
        @foreach ($list_category as $category)
			<div class="panel panel-default">
				<div class="panel-heading">
                    <h4 class="panel-title">
                        <a href="{{route('frontend.slug',['slug'=>$category->slug])}}">
                            {{$category->name}}
                        </a>
                    </h4>
                </div>
            </div>
            @endforeach
	</div>
</div><!--/category-products-->
@endif

                    


