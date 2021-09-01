<!DOCTYPE html>
<html lang="zxx">
<head>

	<!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Title Tag  -->
    <title>{{$seo_title}}</title>
    <meta name="description" content="{{$seo_description}}">
	<meta name="keywords" content="{{$seo_keywords}}">
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="{{URL::to(IMGPHOTOS.$favicon->photo)}}">
	<!-- StyleSheet -->
	
	<!--========================== HEAD ==========================-->
	@include('client.head')
	@routes()
	<!--========================== END HEAD ==========================-->
</head>
<body class="js">
	
	<!-- Preloader -->
	<div class="preloader">
		<div class="preloader-inner">
			<div class="preloader-icon">
				<span></span>
				<span></span>
			</div>
		</div>
	</div>
	<!-- End Preloader -->
	
	
	<!-- Header -->
	<header class="header shop">
	@include('client.header_menu')
	</header>
	<!--/ End Header -->
	
	<!--========================== CONTENT ==========================-->
	@yield('content')
	<!--========================== END CONTENT ==========================-->

 	<!--========================== FOOTER ==========================-->
	@include('client.footer')
	<!--========================== END FOOTER ==========================-->

 	<!--========================== SCRIPT ==========================-->
	@include('client.script')
	<!--========================== END SCRIPT ==========================-->
 
</body>
</html>