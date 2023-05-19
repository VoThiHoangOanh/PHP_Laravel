<div>
<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-7">
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
                            @foreach ($list_menu as $row_menu)
							@if($row_menu->MainMenuSub->count())
							<li class="dropdown">
								<a href="{{route('frontend.slug',['slug'=>$row_menu->link])}}">
									{{$row_menu->name}}
									<i class="fa fa-angle-down"></i>
								</a>
								<ul role="menu" class="sub-menu">
									@foreach($row_menu-> MainMenuSub as $main_menu_sub)
										<li>
											<a href="{{route('frontend.slug',['slug'=>$main_menu_sub->link])}}">
											{{$main_menu_sub->name}}
											</a>
										</li>
									@endforeach
                                </ul>
							</li>
							@else
							<li>
								<a href="{{route('frontend.slug',['slug'=>$row_menu->link])}}">
									{{$row_menu->name}}
								</a>
							</li>
							@endif
                            @endforeach
						</ul>
						</div>
					</div>
					<div class="col-sm-5">
						<form action="{{route('frontend.timkiem')}}" method="GET" class="form-inline">
							{{csrf_field() }}
							<div class="search_box pull-right">
								<input name="keywords"  id="keys" class="form-control mr-sm-2" type="text" placeholder="Tìm kiếm">
								<button class="btn btn-success my-2 my-sm-0" name="search_items" id ="searchsubmit" type="submit">Tìm kiếm</button>
							</div>
						</form>	
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
</div>