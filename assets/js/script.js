$(document).ready( function () {
	
	/* Gallery */
	$('#right-side').imagesLoaded( function(){
		var didScroll = false;
		$(window).on('scroll', function(){
			didScroll = true;
		});
		setInterval(function() {
			if ( didScroll ) {
					didScroll = false;
					galleryScroll();
			}
		}, 30);
		function galleryScroll() {
			if(! $("#right-side").hasClass('open')) {
				var wintop = $(window).scrollTop(), 
						docheight = $(document).height(), 
						winheight = $(window).height(),
						percentScrolled = wintop / (docheight-winheight),
						side = $("#right-side"),
						sideheight = side.height(),
						galleryheight = side.find(".gallery").height();
				$("#right-side").scrollTop(( galleryheight - sideheight ) * percentScrolled );
			}
		}
	});
	
	$('.gallery').click(function(e){
		$('#right-side').toggleClass('open');
		$('body').toggleClass('gallery-open');
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
	
	/* Liste des membres : Couleur
	----------------------------------------- */

	
	
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
						"circle-color": '#0000E6'
				}
		});
		
		markers.features.forEach(function(feature) {
			var symbol = feature.properties['marker-symbol'];
			var layerID = 'poi-' + symbol;
			var activites = feature.properties;
			addCheckbox('all');
			$.each(activites, function(key, value) {
					if(!key.indexOf('activite-')) {
						addCheckbox(key);
					}
			});
			
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
					label.innerHTML = '<span>' + id2title(id) + '</span>';
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

/*!
 * imagesLoaded PACKAGED v4.1.0
 * JavaScript is all like "You images are done yet or what?"
 * MIT License
 */

!function(t,e){"function"==typeof define&&define.amd?define("ev-emitter/ev-emitter",e):"object"==typeof module&&module.exports?module.exports=e():t.EvEmitter=e()}(this,function(){function t(){}var e=t.prototype;return e.on=function(t,e){if(t&&e){var i=this._events=this._events||{},n=i[t]=i[t]||[];return-1==n.indexOf(e)&&n.push(e),this}},e.once=function(t,e){if(t&&e){this.on(t,e);var i=this._onceEvents=this._onceEvents||{},n=i[t]=i[t]||[];return n[e]=!0,this}},e.off=function(t,e){var i=this._events&&this._events[t];if(i&&i.length){var n=i.indexOf(e);return-1!=n&&i.splice(n,1),this}},e.emitEvent=function(t,e){var i=this._events&&this._events[t];if(i&&i.length){var n=0,o=i[n];e=e||[];for(var r=this._onceEvents&&this._onceEvents[t];o;){var s=r&&r[o];s&&(this.off(t,o),delete r[o]),o.apply(this,e),n+=s?0:1,o=i[n]}return this}},t}),function(t,e){"use strict";"function"==typeof define&&define.amd?define(["ev-emitter/ev-emitter"],function(i){return e(t,i)}):"object"==typeof module&&module.exports?module.exports=e(t,require("ev-emitter")):t.imagesLoaded=e(t,t.EvEmitter)}(window,function(t,e){function i(t,e){for(var i in e)t[i]=e[i];return t}function n(t){var e=[];if(Array.isArray(t))e=t;else if("number"==typeof t.length)for(var i=0;i<t.length;i++)e.push(t[i]);else e.push(t);return e}function o(t,e,r){return this instanceof o?("string"==typeof t&&(t=document.querySelectorAll(t)),this.elements=n(t),this.options=i({},this.options),"function"==typeof e?r=e:i(this.options,e),r&&this.on("always",r),this.getImages(),h&&(this.jqDeferred=new h.Deferred),void setTimeout(function(){this.check()}.bind(this))):new o(t,e,r)}function r(t){this.img=t}function s(t,e){this.url=t,this.element=e,this.img=new Image}var h=t.jQuery,a=t.console;o.prototype=Object.create(e.prototype),o.prototype.options={},o.prototype.getImages=function(){this.images=[],this.elements.forEach(this.addElementImages,this)},o.prototype.addElementImages=function(t){"IMG"==t.nodeName&&this.addImage(t),this.options.background===!0&&this.addElementBackgroundImages(t);var e=t.nodeType;if(e&&d[e]){for(var i=t.querySelectorAll("img"),n=0;n<i.length;n++){var o=i[n];this.addImage(o)}if("string"==typeof this.options.background){var r=t.querySelectorAll(this.options.background);for(n=0;n<r.length;n++){var s=r[n];this.addElementBackgroundImages(s)}}}};var d={1:!0,9:!0,11:!0};return o.prototype.addElementBackgroundImages=function(t){var e=getComputedStyle(t);if(e)for(var i=/url\((['"])?(.*?)\1\)/gi,n=i.exec(e.backgroundImage);null!==n;){var o=n&&n[2];o&&this.addBackground(o,t),n=i.exec(e.backgroundImage)}},o.prototype.addImage=function(t){var e=new r(t);this.images.push(e)},o.prototype.addBackground=function(t,e){var i=new s(t,e);this.images.push(i)},o.prototype.check=function(){function t(t,i,n){setTimeout(function(){e.progress(t,i,n)})}var e=this;return this.progressedCount=0,this.hasAnyBroken=!1,this.images.length?void this.images.forEach(function(e){e.once("progress",t),e.check()}):void this.complete()},o.prototype.progress=function(t,e,i){this.progressedCount++,this.hasAnyBroken=this.hasAnyBroken||!t.isLoaded,this.emitEvent("progress",[this,t,e]),this.jqDeferred&&this.jqDeferred.notify&&this.jqDeferred.notify(this,t),this.progressedCount==this.images.length&&this.complete(),this.options.debug&&a&&a.log("progress: "+i,t,e)},o.prototype.complete=function(){var t=this.hasAnyBroken?"fail":"done";if(this.isComplete=!0,this.emitEvent(t,[this]),this.emitEvent("always",[this]),this.jqDeferred){var e=this.hasAnyBroken?"reject":"resolve";this.jqDeferred[e](this)}},r.prototype=Object.create(e.prototype),r.prototype.check=function(){var t=this.getIsImageComplete();return t?void this.confirm(0!==this.img.naturalWidth,"naturalWidth"):(this.proxyImage=new Image,this.proxyImage.addEventListener("load",this),this.proxyImage.addEventListener("error",this),this.img.addEventListener("load",this),this.img.addEventListener("error",this),void(this.proxyImage.src=this.img.src))},r.prototype.getIsImageComplete=function(){return this.img.complete&&void 0!==this.img.naturalWidth},r.prototype.confirm=function(t,e){this.isLoaded=t,this.emitEvent("progress",[this,this.img,e])},r.prototype.handleEvent=function(t){var e="on"+t.type;this[e]&&this[e](t)},r.prototype.onload=function(){this.confirm(!0,"onload"),this.unbindEvents()},r.prototype.onerror=function(){this.confirm(!1,"onerror"),this.unbindEvents()},r.prototype.unbindEvents=function(){this.proxyImage.removeEventListener("load",this),this.proxyImage.removeEventListener("error",this),this.img.removeEventListener("load",this),this.img.removeEventListener("error",this)},s.prototype=Object.create(r.prototype),s.prototype.check=function(){this.img.addEventListener("load",this),this.img.addEventListener("error",this),this.img.src=this.url;var t=this.getIsImageComplete();t&&(this.confirm(0!==this.img.naturalWidth,"naturalWidth"),this.unbindEvents())},s.prototype.unbindEvents=function(){this.img.removeEventListener("load",this),this.img.removeEventListener("error",this)},s.prototype.confirm=function(t,e){this.isLoaded=t,this.emitEvent("progress",[this,this.element,e])},o.makeJQueryPlugin=function(e){e=e||t.jQuery,e&&(h=e,h.fn.imagesLoaded=function(t,e){var i=new o(this,t,e);return i.jqDeferred.promise(h(this))})},o.makeJQueryPlugin(),o});

