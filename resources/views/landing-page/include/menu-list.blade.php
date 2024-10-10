@push('style')
	<style>
		.bg-light-secondary {
			background-color: #F5EAEA;
		}
		.bg-light-success {
			background-color: #C8E2BE;
		}
		.l-menu-list {
			cursor: pointer;
			-webkit-filter: brightness(100%);
		}
		.l-menu-list:hover {
			-webkit-filter: brightness(90%);
			-webkit-transition: all 0.5s ease;
			-moz-transition: all 0.5s ease;
			-o-transition: all 0.5s ease;
			-ms-transition: all 0.5s ease;
			transition: all 0.5s ease;
		}
	</style>
@endpush

<div class="wrapper">
	<div class="title spacer p-top-xs pb-3">
		<h4>{{$curNav}}</h4>
	</div>
	<hr>
	<div class="pt-1">
		<div class="bg-light p-2">
			@php

				$filtered = $childMenu->filter(function ($value, $key) use($curNavParentId) {
					return $value->parent_id==$curNavParentId;
				});
			@endphp
			@foreach ($filtered as $item)
				@if($item->nama_menu==$curMenu)
					<div onclick="location.href='{{route(Str::camel(Str::lower($curNav)).'.'.Str::camel(Str::lower($item->nama_menu)))}}'" class="border-left bg-light-success m-1 p-2 position-relative l-menu-list" style="font-size: 10pt"><div style="width: 0.3rem; height: 100%;top:0;left:0;" class="bg-danger position-absolute"> </div>{{$item->nama_menu}}</div>
				@else
					<div onclick="location.href='{{route(Str::camel(Str::lower($curNav)).'.'.Str::camel(Str::lower($item->nama_menu)))}}'" class="border-left bg-light-secondary m-1 p-2 l-menu-list" style="font-size: 10pt">{{$item->nama_menu}}</div>
				@endif
			@endforeach
		</div>
	</div>
</div>
@push('script')
<script>
	function menuList(menu) {
		console.log(menu);

		if('{{$curNav}}' == 'Menu Utama') {
			var url = '{{ route('menuUtama', ':args') }}'
		}
		if('{{$curNav}}' == 'Profil') {
			var url = '{{ route('profil', ':args') }}'
		}
		if('{{$curNav}}' == 'Program') {
			var url = '{{ route('program', ':args') }}'
		}
		url = url.replace(':args',menu)
		window.location.href = url
	}
</script>
@endpush