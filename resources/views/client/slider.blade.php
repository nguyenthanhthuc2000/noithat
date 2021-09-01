	<div id="demo" class="carousel slide" data-ride="carousel">

	  <!-- Indicators -->
	  <ul class="carousel-indicators">
	  	<?php $j = 0; ?>
	  	@foreach($sliders as $key => $sl)
	   	 	<li data-target="#demo" data-slide-to="{{$j}}" class=" @if($j==0) active @endif "></li>
	    	<?php $j++; ?>
	    @endforeach
	  </ul>

	  <!-- The slideshow -->
	  <div class="carousel-inner">
	  	<?php $i = 0; ?>
	  	@foreach($sliders as $key => $slider)
	    <div class="carousel-item @if($i==0) active @endif">
	      <img src="{{URL::to(IMGPHOTOS.$slider->photo)}}" alt="{{$slider->tenvi}}">
	    </div>
	  	<?php $i++; ?>
	    @endforeach
	  </div>

	  <!-- Left and right controls -->
	  <a class="carousel-control-prev" href="#demo" data-slide="prev">
	    <span class="carousel-control-prev-icon"></span>
	  </a>
	  <a class="carousel-control-next" href="#demo" data-slide="next">
	    <span class="carousel-control-next-icon"></span>
	  </a>

	</div>