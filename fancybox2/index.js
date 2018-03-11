$(document).ready(function() {


			$('.fancybox').fancybox();

$('.fancybox-media')
				.attr('rel', 'media-gallery')
				.fancybox({
					openEffect : 'none',
					closeEffect : 'none',
					prevEffect : 'none',
					nextEffect : 'none',

					arrows : false,
					helpers : {
						media : {},
						buttons : {}
					}
				});


					$(".fancybox-effects-a").fancybox({
				helpers: {
					title : {
						type : 'outside'
					},
					overlay : {
						speedOut : 0
					}
				}
			});

		
		$("#various").fancybox({
		maxWidth	: 1000,
		maxHeight	: 700,
		fitToView	: false,
		width		: '90%',
		height		: '200%',
		autoSize	: false,
		closeClick	: false,
		openEffect : 'elastic',
		closeEffect	: 'elastic'
	});
		
		
		/*for(var ss=1;ss<=1000;ss++){
			$("#various5"+ss).fancybox({
				maxWidth	: 1000,
		maxHeight	: 700,
		fitToView	: false,
		width		: '90%',
		height		: '200%',
		autoSize	: false,
		closeClick	: false,
		openEffect : 'elastic',
		closeEffect	: 'elastic'
			});
			}*/
			
			$("#various5s").fancybox({
				maxWidth	: 1000,
		maxHeight	: 600,
		fitToView	: false,
		width		: '90%',
		height		: '200%',
		autoSize	: false,
		closeClick	: false,
		openEffect : 'elastic',
		closeEffect	: 'elastic'
			});
			
					$("#various5ss").fancybox({
		fitToView	: false,
		width		: '90%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
		openEffect : 'elastic',
		closeEffect	: 'elastic'
			});
					
			$("#various5new").fancybox({
		fitToView	: false,
		width		: '90%',
		height		: '90%',
		autoSize	: false,
		closeClick	: false,
		openEffect : 'elastic',
		closeEffect	: 'elastic',
		type		: 'iframe',
		onClosed	:	function() { parent.location.reload(true); }
			});
		
		$("#various3").fancybox({
				'width'				: '50%',
				'height'			: '90%',
				'autoScale'			: false,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic',
				'type'				: 'iframe',
				'afterClose'	: function() { parent.location.reload(true);}
			});
		


		});