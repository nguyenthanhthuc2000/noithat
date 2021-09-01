	<section class="small-banner section">
		<div class="container container-tc">
			<div class="slick-tieu-chi">
				@foreach($tieuchis as $key => $tieuchi)
				<div class="banner-tieu-chi">
					<img src="{{URL::to(IMGPHOTOS.$tieuchi->photo)}}" alt="{{$tieuchi->tenvi}}">
				</div>
				@endforeach
			</div>
		</div>
	</section>