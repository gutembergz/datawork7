function initialize() {

	var mapOptions, map, marker, searchBox, city,
		infoWindow = '',
		addressEl = document.querySelector('#pesqEndereco'),
		endereco = document.querySelector('#endereco');
		bairro = document.querySelector('#bairro');
		cidade = document.querySelector('#cidade');
		cep = document.querySelector('#cep');
		uf = document.querySelector('#uf');
		latitude = document.querySelector('#latitude'),
		longitude = document.querySelector('#longitude'),
		element = document.getElementById('map-canvas');

		mapOptions = {
			// How far the maps zooms in.
			zoom: 8,
			// Current Lat and Long position of the pin/
			center: new google.maps.LatLng( -22.908333, -43.196388 ),
			disableDefaultUI: false, // Disables the controls like zoom control on the map if set to true
			scrollWheel: true, // If set to false disables the scrolling on the map.
			draggable: true, // If set to false , you cannot move the map around.
			// mapTypeId: google.maps.MapTypeId.HYBRID, // If set to HYBRID its between sat and ROADMAP, Can be set to SATELLITE as well.
			// maxZoom: 11, // Wont allow you to zoom more than this
			// minZoom: 9  // Wont allow you to go more up.

	};

	/**
	 * Creates the map using google function google.maps.Map() by passing the id of canvas and
	 * mapOptions object that we just created above as its parameters.
	 *
	 */
	// Create an object map with the constructor function Map()
	map = new google.maps.Map(element, mapOptions); // Till this like of code it loads up the map.

	/**
	 * Creates the marker on the map
	 *
	 */
	marker = new google.maps.Marker({
		position: mapOptions.center,
		map: map,
		draggable: true
	});

	/**
	 * Creates a search box
	 */
	searchBox = new google.maps.places.SearchBox(addressEl);

	/**
	 * When the place is changed on search box, it takes the marker to the searched location.
	 */
	google.maps.event.addListener( searchBox, 'places_changed', function () {
		var places = searchBox.getPlaces(),
			bounds = new google.maps.LatLngBounds(),
			i, place, lat, long, resultArray,
			addresss = places[0].formatted_address;

		for (i = 0; place = places[i]; i++) {
			bounds.extend( place.geometry.location );
			marker.setPosition( place.geometry.location );  // Set marker position new.
		}

		map.fitBounds(bounds);  // Fit to the bound
		map.setZoom(15); // This function sets the zoom to 15, meaning zooms to level 15.
		// console.log( map.getZoom() );

		lat = marker.getPosition().lat();
		long = marker.getPosition().lng();
		latitude.value = lat;
		longitude.value = long;

		resultArray =  places[0].address_components;

		// Get the city and set the city input value to the one selected
		for (var i = 0; i < resultArray.length; i++ ) {
			if ( resultArray[ i ].types[0] && 'administrative_area_level_2' === resultArray[ i ].types[0] ) {
				city = resultArray[ i ].long_name;
				cidade.value = city;
				//console.log(city);
			}
		}

		// Get the CEP and set the CEP input value to the one selected
		for (var i = 0; i < resultArray.length; i++ ) {
			if ( resultArray[ i ].types[0] && 'postal_code' === resultArray[ i ].types[0] ) {
				zip = resultArray[ i ].long_name;
				cep.value = zip;
				//
				//console.log(zip);
			}
		}

		// Get the BAIRRO and set the BAIRRO input value to the one selected
		// ao arrastar, o tipo de endereço muda para political
		for (var i = 0; i < resultArray.length; i++ ) {
			if ( resultArray[ i ].types[0] && 'sublocality_level_1' === resultArray[ i ].types[0] ) {
				hood = resultArray[ i ].long_name;
				bairro.value = hood;
				//
				console.log(hood);
			}
		}

		// Get the RUA and set the RUA input value to the one selected
		for (var i = 0; i < resultArray.length; i++ ) {
			if ( resultArray[ i ].types[0] && 'route' === resultArray[ i ].types[0] ) {
				route = resultArray[ i ].long_name;
				endereco.value = route;
				//
				//console.log(route);
			}
		}

		// Get the UF and set the UF input value to the one selected
		for (var i = 0; i < resultArray.length; i++ ) {
			if ( resultArray[ i ].types[0] && 'administrative_area_level_1' === resultArray[ i ].types[0] ) {
				state = resultArray[ i ].short_name;
				uf.value = state;
				//
				//console.log(state);
			}
		}

		// Closes the previous info window if it already exists
		if (infoWindow) {
			infoWindow.close();
		}
		/**
		 * Creates the info Window at the top of the marker
		 */
		infoWindow = new google.maps.InfoWindow({
			content: addresss
		});

		infoWindow.open(map, marker);
		$("#numero").focus(); // foca no campo de número para facilitar o preenchimento
	} );


	/**
	 * Finds the new position of the marker when the marker is dragged.
	 */
	google.maps.event.addListener(marker, "dragend", function ( event ) {
		var lat, long, address, resultArray, city, zip, hood, route, state;

		console.log('arrastando...');
		lat = marker.getPosition().lat();
		long = marker.getPosition().lng();

		var geocoder = new google.maps.Geocoder();
		geocoder.geocode( { latLng: marker.getPosition() }, function ( result, status ) {
			if ('OK' === status) {  // This line can also be written like if ( status == google.maps.GeocoderStatus.OK ) {
				address = result[0].formatted_address;
				resultArray =  result[0].address_components;
				//console.log (resultArray); // exibe o array dos resultados no console

				// Get the city and set the city input value to the one selected
				for( var i = 0; i < resultArray.length; i++ ) {
					if ( resultArray[ i ].types[0] && 'administrative_area_level_2' === resultArray[ i ].types[0] ) {
						city = resultArray[ i ].long_name;
						cidade.value = city;
						//
						//console.log(city);
					}
				}

				// Get the CEP and set the CEP input value to the one selected
				for( var i = 0; i < resultArray.length; i++ ) {
					if ( resultArray[ i ].types[0] && 'postal_code' === resultArray[ i ].types[0] ) {
						zip = resultArray[ i ].long_name;
						cep.value = zip;
						//
						//console.log(zip);
					}
				}

				// Get the BAIRRO and set the BAIRRO input value to the one selected
				// ao arrastar, o tipo de endereço muda para political
				for( var i = 0; i < resultArray.length; i++ ) {
					if ( resultArray[ i ].types[0] && 'political' === resultArray[ i ].types[0] ) {
						hood = resultArray[ i ].short_name;
						bairro.value = hood;
						//
						console.log(hood);
					}
				}

				// Get the RUA and set the RUA input value to the one selected
				for( var i = 0; i < resultArray.length; i++ ) {
					if ( resultArray[ i ].types[0] && 'route' === resultArray[ i ].types[0] ) {
						route = resultArray[ i ].long_name;
						endereco.value = route;
						//
						//console.log(route);
					}
				}

				// Get the UF and set the UF input value to the one selected
				for( var i = 0; i < resultArray.length; i++ ) {
					if ( resultArray[ i ].types[0] && 'administrative_area_level_1' === resultArray[ i ].types[0] ) {
						state = resultArray[ i ].short_name;
						uf.value = state;
						//
						//console.log(state);
					}
				}
				addressEl.value = address;
				latitude.value = lat;
				longitude.value = long;

				} else {
					console.log( 'Geocode was not successful for the following reason: ' + status );
				}

			// Closes the previous info window if it already exists
			if (infoWindow) {
				infoWindow.close();
			}

			/**
			 * Creates the info Window at the top of the marker
			 */
			infoWindow = new google.maps.InfoWindow({
				content: address
			});

			infoWindow.open( map, marker );
		} );
	});
}