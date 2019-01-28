jQuery(document).ready(function() {
	'use strict';
	//Google Map					
	jQuery('.map-wrapper[id^="delicious_map_"]').each( function() { 

		var $div = jQuery(this);
		var token = $div.data('token');
		var settingObj = window['dt_map_' + token];
		var id = settingObj.id;
		var zoomv = parseInt(settingObj.zoom);
		var istoggle = settingObj.use_toggle;

		var toggle_bg_hover = settingObj.toggle_bg_hover;
		var toggle_color_hover = settingObj.toggle_color_hover;
		var toggle_color = settingObj.toggle_color;
		var toggle_bg = settingObj.toggle_bg;


		jQuery("#delicious_map_"+settingObj.id+"").each(function() {
			
			var latlng = new google.maps.LatLng(settingObj.latitude,settingObj.longitude);
			var settings = {
				zoom: zoomv,
				center: new google.maps.LatLng(settingObj.latitude,settingObj.longitude), 
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				mapTypeControl: false,
				scrollwheel: false,
				draggable: true,
				navigationControl: false,
                styles: [{"featureType":"administrative","elementType":"all","stylers":[{"visibility":"on"},{"lightness":33}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f7f7f7"}]},{"featureType":"poi.business","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#deecdb"}]},{"featureType":"poi.park","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":"25"}]},{"featureType":"road","elementType":"all","stylers":[{"lightness":"25"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#ffffff"}]},{"featureType":"road.highway","elementType":"labels","stylers":[{"saturation":"-90"},{"lightness":"25"}]},{"featureType":"road.arterial","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"}]},{"featureType":"transit.line","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"transit.station","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"on"},{"color":"#e0f1f9"}]}]

				};

		if(istoggle != 'with-toggle') { 

			var map = new google.maps.Map(document.getElementById("google_map_"+settingObj.id+""), settings);
			google.maps.event.addDomListener(window, "resize", function() {
				var center = map.getCenter();
				google.maps.event.trigger(map, "resize");
				map.setCenter(center);
			});
			
			var contentString = '<div class="map-tooltip">'+
				'<h6>'+settingObj.pin_title+'</h6>'+
				'<p>'+settingObj.pin_desc+'</p>'+
				'</div>';
			var infowindow = new google.maps.InfoWindow({
				content: contentString
			});

			var pin = {
				path: 'M39.5,8.125c-12.643,0-22.929,10.286-22.929,22.929c0,12.221,20.87,38.4,21.758,39.51l1.17,1.459l1.17-1.459  c0.888-1.109,21.758-27.289,21.758-39.51C62.43,18.411,52.143,8.125,39.5,8.125z M39.5,42.667c-6.903,0-12.5-5.597-12.5-12.5  s5.597-12.5,12.5-12.5S52,23.264,52,30.167S46.403,42.667,39.5,42.667z',
				fillColor: ''+settingObj.pin_color+'',
				fillOpacity: 1,
				scale: 0.8,
				strokeColor: ''+settingObj.pin_color+'',
				strokeWeight: 1,
				anchor: new google.maps.Point(60, 75)
			};			
			
			var companyPos = new google.maps.LatLng(settingObj.latitude,settingObj.longitude);
			
			var companyMarker = new google.maps.Marker({
				position: companyPos,
				map: map,
				icon: pin, 
				zIndex: 3});	
			
			google.maps.event.addListener(companyMarker, 'click', function() {
				infowindow.open(map,companyMarker);
			});
		}
		else {

			jQuery("#delicious_map_"+settingObj.id+" .button-map").click(function() {

		        jQuery("#google_map_"+settingObj.id+"").slideToggle(300, function(){

					var map = new google.maps.Map(document.getElementById("google_map_"+settingObj.id+""), settings);
					google.maps.event.addDomListener(window, "resize", function() {
						var center = map.getCenter();
						google.maps.event.trigger(map, "resize");
						map.setCenter(center);
					});
					
					var contentString = '<div class="map-tooltip">'+
						'<h6>'+settingObj.pin_title+'</h6>'+
						'<p>'+settingObj.pin_desc+'</p>'+
						'</div>';
					var infowindow = new google.maps.InfoWindow({
						content: contentString
					});

					var pin = {
						path: 'M39.5,8.125c-12.643,0-22.929,10.286-22.929,22.929c0,12.221,20.87,38.4,21.758,39.51l1.17,1.459l1.17-1.459  c0.888-1.109,21.758-27.289,21.758-39.51C62.43,18.411,52.143,8.125,39.5,8.125z M39.5,42.667c-6.903,0-12.5-5.597-12.5-12.5  s5.597-12.5,12.5-12.5S52,23.264,52,30.167S46.403,42.667,39.5,42.667z',
						fillColor: ''+settingObj.pin_color+'',
						fillOpacity: 1,
						scale: 0.8,
						strokeColor: ''+settingObj.pin_color+'',
						strokeWeight: 1,
						anchor: new google.maps.Point(60, 75)
					};			
					
					var companyPos = new google.maps.LatLng(settingObj.latitude,settingObj.longitude);
					
					var companyMarker = new google.maps.Marker({
						position: companyPos,
						map: map,
						icon: pin, 
						zIndex: 3});	
					
					google.maps.event.addListener(companyMarker, 'click', function() {
						infowindow.open(map,companyMarker);
					});


						var center = map.getCenter();
						google.maps.event.trigger(map, "resize");
						map.setCenter(center);
		            }); 
		        jQuery(this).toggleClass('close-map show-map');

		    });

			jQuery("#delicious_map_"+settingObj.id+" .button-map").on({
			    mouseenter: function() {
			        jQuery(this).css({'background': toggle_bg_hover, 'color': toggle_color_hover});
			    },
			    mouseleave: function() {
			        jQuery(this).css({'background': toggle_bg, 'color': toggle_color});
			    }
			});			

		}

	    });

	});
});		