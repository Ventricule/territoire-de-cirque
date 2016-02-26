$(document).ready( function () {
	
	/* Gallery */
	$('.gallery').click(function(){
		$('#right-side').toggleClass('open');
	});
	
	$('.btn-menu-plus').click(function(e){
		e.preventDefault();
		$(this).toggleClass('close-plus');
		$('#menu-plus').slideToggle(200);
	});
	
	$(document).mouseup(function (e) {
			var container = $('#menu-plus');
			var button = $('.btn-menu-plus');
			if (!container.is(e.target) && container.has(e.target).length === 0 
					&& !button.is(e.target) && button.has(e.target).length === 0  ) 
			{
				var btn = $('.btn-menu-plus');
				if(btn.hasClass('close-plus')) {
					btn.click();
				}	
			}
	});
	
	/* Menu
	----------------------------------------- */
	$("#menu-second").perfectScrollbar(); 
	
	/* Carte des membres Mapbox GL 
	----------------------------------------- */
	mapboxgl.accessToken = 'pk.eyJ1IjoicGllcnJlcGllcnJlcGllcnJlIiwiYSI6IkdXdE5CRFEifQ.3zLbKVYfHituW8BVU-bl5g';
	
	/* Init */
	var map = new mapboxgl.Map({
			container: 'map-membres', // container id
			style: 'mapbox://styles/pierrepierrepierre/ciku1r9cd00a3bdklgumavnex', //stylesheet location,
		  sprite: "mapbox://sprites/mapbox/satellite-v8",
			center: [2.53, 46.8], // starting position
			zoom: 5, // starting zoom
			minZoom: 4,
			scrollZoom: false,
			attributionControl: false
	})
	.fitBounds( [[9.55932, 51.089062],[-5.1406, 41.33374]] )
	.addControl(new mapboxgl.Navigation({position: 'top-right'}));;
	
	/* Rotate */
	map.once('moveend', function() {
		map.setBearing(90);
	});
	
	/* Filters */
	var filterGroup = document.getElementById('filter-group');
	
	map.on('load', function() {
    // Add marker data as a new GeoJSON source.
    map.addSource("markers", {
        "type": "geojson",
        "data": markers
    });
		
		map.addLayer({
				"id": 'markers',
				"type": "circle",
				"source": "markers",
				"interactive": true,
				"paint": {
						"circle-radius": 10,
						"circle-color": '#02c071'
				}
		});
		
		markers.features.forEach(function(feature) {
			var symbol = feature.properties['marker-symbol'];
			var layerID = 'poi-' + symbol;
			var activites = feature.properties;
			$.each(activites, function(key, value) {
					if(!key.indexOf('activite-')) {
						addCheckbox(key);
					}
			});
			addCheckbox('all');
			function addCheckbox(id) {
				if ( ! $(filterGroup).children('#'+id).length ) {

					// Add checkbox and label elements for the layer.
					var input = document.createElement('input');
					input.type = 'checkbox';
					input.id = id;
					input.checked = id == 'all' ? true : false;
					filterGroup.appendChild(input);

					var label = document.createElement('label');
					label.setAttribute('for', id);
					label.textContent = id2title(id);
					filterGroup.appendChild(label);

					// When the checkbox changes, update the visibility of the layer.
					input.addEventListener('change', function(e) {
						$(filterGroup).children('input').not(e.target).prop("checked", false);
						if(e.target.checked) {
							if (id == 'all') {
								map.setFilter("markers", ['any','all']);
								listSetFilter('all');
							} else {
								map.setFilter("markers", ['==', id, true]);
								listSetFilter(id);
							}
						} else {
							map.setFilter("markers", ['none','all']);
						}

					});
				}
			}
			function listSetFilter(id) {
				id = id.replace('activite-', ''); 
				if(id=='all') {
					$("#liste-membres li").show();
				} else {
					$("#liste-membres li").hide();
					$("#liste-membres li[data-activites~='"+id+"']").show();
					console.log(id);
				}
			}
			function id2title(id) {
				id = id.replace('activite-', ''); 
				switch (id) {
					case 'diffusion':
						return 'Lieux de diffusion';
						break;
					case 'residence':
						return 'Lieux de résidence';
						break;
					case 'chapiteau':
						return 'Espaces chapiteau';
						break;
					case 'polenationnal':
						return 'Pôles nationnaux';
						break;
					case 'festival':
						return 'Festivals';
						break;
					case 'formation':
						return 'Formations professionnelles';
						break;
					case 'all':
						return 'Tous les membres';
						break;
					default:
						return id;
						break;
				}
			}
			
    });
		
		var popup = new mapboxgl.Popup();
	
		// When a click event occurs near a marker icon, open a popup at the location of
		// the feature, with description HTML from its properties.
		map.on('click', function (e) {
			map.featuresAt(e.point, {
					radius: 10, // Half the marker size (15px).
					includeGeometry: true,
					layer: 'markers'
			}, function (err, features) {

					if (err || !features.length) {
							popup.remove();
							return;
					}   

					var feature = features[0];
				
				console.log(feature.properties);

					// Popuplate the popup and set its coordinates
					// based on the feature found.
					popup.setLngLat(feature.geometry.coordinates)
							.setHTML( $('#liste-membres ul li').filter('[data-uid='+feature.properties.uid+']').html() )
							.addTo(map);
			});
		});

		// Use the same approach as above to indicate that the symbols are clickable
		// by changing the cursor style to 'pointer'.
		map.on('mousemove', function (e) {
				map.featuresAt(e.point, {
						radius: 10, // Half the marker size (15px).
						layer: 'markers'
				}, function (err, features) {
						map.getCanvas().style.cursor = (!err && features.length) ? 'pointer' : '';
				});
		});
		
	});

	
});
