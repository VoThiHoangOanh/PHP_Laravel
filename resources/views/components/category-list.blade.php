@if (count($list_category)>0)
<div class="left-sidebar">
	<h2>DANH MỤC SẢN PHẨM</h2>
	<div class="panel-group category-products" id="accordian"><!--category-productsr-->
        @foreach ($list_category as $category)
			<div class="panel panel-default">
            @if ($category->CategorySub->count())
				<div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#{{$category->slug}}">
                        <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            {{$category->name}}
                        </a>
                    </h4>
                </div>
                <div id="{{$category->slug}}" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            @foreach ($category->CategorySub as $category_sub)
                                <li><a href="{{route('frontend.slug',['slug'=>$category_sub->slug])}}">{{$category_sub->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @else
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="{{route('frontend.slug',['slug'=>$category->slug])}}">{{$category->name}}</a></h4>
                </div>
            @endif
            </div>
            @endforeach
	</div>
</div><!--/category-products-->
@endif

                    


