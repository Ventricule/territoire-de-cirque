$(document).ready( function () {

	$("#main-menu").mmenu({
		 // options
		setSelected: true
	}, {
		 // configuration
			offCanvas: {
				pageSelector: "#page-wrapper"
		 }
	});
	var API = $("#main-menu").data( "mmenu" );

	$(".toggle-button").click(function() {
		 API.open();
	});

	/* Medium editor
	----------------------------------------- */
	var markDownEl = document.querySelector("#message");
	var editor = new MediumEditor('.editable', {
		toolbar: {
			buttons: ['bold', 'italic', 'anchor', 'quote']
		},
		extensions: {
			markdown: new MeMarkdown(function (md) {
					markDownEl.textContent = md;
			})
		},
		placeholder: {
			text: 'Exprimez vous',
			hideOnClick: true
    }
	});
	// File selector
	function popup(url) {
		var newwindow = window.open(url,'name','width=800,height=600,top=50,left=50,resizable=yes,menubar=no,scrollbars=no,status=no');
		if (window.focus) {newwindow.focus()}
		return false;
	}
	$('.docs ul > li > span').click(function(){
		$(this).parent('li').toggleClass('open');
	});

	$('.attachment .item').click(function(){
		var files = $('#website');
		var docs = $('.docs .selected-documents');
		// ajouter l'item au pièces jointes
		$(this).clone().appendTo(docs);
		files.val('');
		docs.find('.item').each(function(){
			var url = $(this).attr('data-url');
			if(!files.val()) {
				files.val( url );
			} else {
				files.val( files.val() + ',' + url );
			}
		});
		// afficher les p-j
		docs.slideDown();
	});
	$(document).on('click', '.docs .selected-documents .item', function(){
		// retirer l'url de la liste
		var url = $(this).attr('data-url');
		var files = $('#website');
		files.val( files.val().replace(url, '' ));
		// remove double comma
		files.val( files.val().replace(',,', ',' ));
		// remove leading comma
		if (files.val().charAt(0)==',') {
			files.val(files.val().substr(1));
		}
		if(files.val() == ",") { files.val('') }
		// retirer l'icone
		$(this).remove();
		// Masquer les p-j
		var docs = $('.docs .selected-documents');
		if( $(docs).children().length <= 1 ) {
			docs.slideUp();
		}
	});

	// lors d'une preview, copier les items dans la liste des pj.
	var items = $('article.preview .attachment .item');
	if(items) {
		$('article.preview .attachment .item a').contents().unwrap();
		items.each(function() { $(this).click() });
	}

	//confirmer suppression
	$('.delete').click(function(){ $(this).toggleClass('active'); })

	/* All Scroll Events
	------------------------------------------ */
	var didScroll = false;
	$(window).on('scroll', function(){
		didScroll = true;
	});
	setInterval(function() {
		if ( didScroll ) {
			didScroll = false;
			galleryScroll();
			adjustBaselineOpacity();
		}
	}, 20);


	/* Liens externes
	----------------------------------------- */
	$('a').each(function() {
		if(this.host !== window.location.host) {
			$(this).attr('target', '_blank');
		}
	});

	/* Copyright ©
	----------------------------------------- */
	$('figcaption').each(function(){
    this.innerHTML = this.innerHTML.replace(/©/g, '<span class="sans-serif">$&</span>')
	});



	/* Logo
	----------------------------------------- */
	$('.logo-anime').mouseenter(function(){
		src = $(this).attr('src');
		$(this).attr('src', src);
	});
	function adjustBaselineOpacity(){
		var winTop = $(window).scrollTop(),
				baseline = $('#tdc-accroche h4');
		if(winTop > 50) {
			baseline.addClass('hide');
		} else {
			baseline.removeClass('hide');
		}
	}


	/* Gallery
	----------------------------------------- */
	function galleryScroll() {
		if( $("#right-side").size() && ! $("#right-side").hasClass('open')) {
			var wintop = $(window).scrollTop(),
					docheight = $(document).height(),
					winheight = $(window).height(),
					percentScrolled = wintop / (docheight-winheight),
					side = $("#right-side"),
					sideheight = side.height(),
					galleryheight = side.find(".gallery").outerHeight();
			$("#right-side").scrollTop(( galleryheight - sideheight ) * percentScrolled );
		}
	}
	$('#right-side').imagesLoaded( function(){
		galleryScroll();
	});

	$('.gallery').click(function(e){
		$('#right-side').toggleClass('open').perfectScrollbar();
		$('body').toggleClass('gallery-open');
	});



	/* Menu Second
	----------------------------------------- */
	/* All Scroll Events
	------------------------------------------ */
	var timer = null;
	$('#menu-second').on('scroll', function(){
		if(timer !== null) {
      clearTimeout(timer);
			$('#menu-second .parent').addClass('hidden');
    }
    timer = setTimeout(function() {
      menuTitle();
    }, 200);
	});

	function menuTitle() {
		var scrolltop = $('#menu-second').scrollTop();
		$('#menu-second .parent').css('transform', 'translateY('+scrolltop+'px)');
		$('#menu-second .parent').removeClass('hidden');
	}

	/* Menu Plus
	----------------------------------------- */

	var timer;
	$('.btn-menu-plus').hover(function(e){
		e.preventDefault();
		var $this = $(this);
		timer = setTimeout(function() {
			$this.addClass('close-plus');
			$('#menu-plus').slideDown(200);
		}, 200);
	}, function() {
    clearTimeout(timer);
	});
	var timer2;
	$('#menu-plus').hover(function(){
		clearTimeout(timer2);
	}, function() {
		var $this = $(this);
		timer2 = setTimeout(function() {
			$('.btn-menu-plus').removeClass('close-plus');
			$this.slideUp(200);
		}, 500);
	})

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

	// Scroll sur l'élément selectionné
	if($('#menu-second li.active').length){
		var pos = $('#menu-second li.active').position().top,
				h = $('#menu-second').height();
		$("#menu-second").scrollTop(pos - h/2);

	}

	/* Menu
	----------------------------------------- */
	$("#menu-second").perfectScrollbar();



	/* Actu des membres
	----------------------------------------- */
	if($('.template-actualites').size()) {
		$('.template-actualites .filters .selector li > span').click(function() {
			var $this = $(this).closest('li'),
					filter = $this.attr('data-select'),
					filtersGroups = $('.filters-group'),
					filtersGroup = filtersGroups.filter('.' + filter );
			$this.siblings().removeClass('selected');
			filtersGroups.not(filtersGroup).hide();
			filtersGroup.toggle();
			$this.toggleClass('selected');
		});
		//$('.template-actualites .filters .selector li.selected').click();
		$(document).on('click', '.event-content .read-more', function(e) {
			e.preventDefault();
			$('.event').removeClass('open');
			$(e.target).closest('.event').addClass('open');
		});
		$(document).on('click', '.event-content .read-less', function(e) {
			e.preventDefault();
			$(e.target).closest('.event').removeClass('open');
		});
	}



	/* Carte des membres Mapbox GL
	----------------------------------------- */
	if($('#map-membres').size()) {

		$('#map-membres figure img').click(function(){
			map.flyTo({center: [55.4504000, -20.8823100], zoom: 6});
		})
		mapboxgl.accessToken = 'pk.eyJ1IjoicGllcnJlcGllcnJlcGllcnJlIiwiYSI6IkdXdE5CRFEifQ.3zLbKVYfHituW8BVU-bl5g';

		/* Init */
		var map = new mapboxgl.Map({
				container: 'map-membres', // container id
				style: 'mapbox://styles/pierrepierrepierre/cin1iomrj00bmc9maj1k8d1t1', //stylesheet location,
				sprite: "mapbox://sprites/mapbox/satellite-v8",
				center: [2.53, 46.8], // starting position
				zoom: 5, // starting zoom
				scrollZoom: false,
				attributionControl: false
		})
		.fitBounds( [[9.55932, 51.089062],[-5.1406, 41.33374]] )
		.addControl(new mapboxgl.Navigation({position: 'top-right'}));

		/* Rotate */
		map.once('moveend', function() {
			map.setBearing(90);
		});

		$('#map-membres .mapboxgl-ctrl-compass').click(function(){
			if(map.getBearing() == 0) {
				map.easeTo({ bearing : 90 });
			} else {
				map.easeTo({ bearing : 0 });
			}
		})

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
							"circle-radius": 8,
							"circle-color": '#001abb'
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
						$("#liste-membres li").removeClass('hide');
					} else {
						$("#liste-membres li").addClass('hide');
						$("#liste-membres li[data-activites~='"+id+"']").removeClass('hide');
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
							return 'Pôles nationaux';
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
	}



	/* Folder : Icon
	----------------------------------------- */
	window.onpageshow = function(event) {
    if (event.persisted) { $('#folder-content li').removeClass('open'); }
	};
	$('#folder-content li .icon').click(function() {
		$(this).parent().parent().toggleClass('open');
	})

	/* Folder : SearchBar
	----------------------------------------- */
	$('#searchbar .btn-more').click(function(){
		$('#searchbar').toggleClass('full');
		$('#searchbar').addClass('transition');
		setTimeout(function() {
			$('#searchbar').removeClass('transition');
		}, 300)

	});

	function search(form) {
		var $this = $(form); // L'objet jQuery du formulaire

		// Envoi de la requête HTTP en mode asynchrone
		$.ajax({
				url: $this.attr('action'), // Le nom du fichier indiqué dans le formulaire
				type: $this.attr('method'), // La méthode indiquée dans le formulaire (get ou post)
				data: $this.serialize(), // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
				success: function(html) { // Je récupère la réponse du fichier PHP
					console.log($(html).find('#folder-content'));
					$('#folder-header').html( $(html).find('#folder-header').children() );
					$('#folder-content').html( $(html).find('#folder-content').children() );
				}
		});
	}
	$('#searchbar form').on('submit change', function(e) {
		e.preventDefault(); // J'empêche le comportement par défaut du navigateur, c-à-d de soumettre le formulaire
		search(this);
	});
	$('#searchbar input').on('keyup', function() {
		if($(this).val().length > 2 || $(this).val().length == 0) {
			search( $(this).closest('form') );
		}
	});
	$(document).on('click', '#folder-header .close', function() {
		var form = $('#searchbar form')[0];
		form.reset();
		search( form );
		//location.reload();
	});


	/* Espace membre
	----------------------------------------- */
	function format(s) {
    if (s) {
			s = s.replace(/(\d{4})-(\d{1,2})-(\d{1,2})/, function(match,y,m,d) {
				return d + '/' + m + '/' + y;
			});
			return s;
		}
	}
	function translate(w){
		w = w.replace('folder', 'dossier');
		w = w.replace('file', 'article');
		w = w.replace('documents-partages', 'dossier');
		return w;
	}
	function subpages(uri, folder = true) {
		var apiUri = siteUrl + '/api/' + uri,
				data = { "action" : 'subpages' },
				iframe = $(".iframe-wrapper iframe"),
				subpagesContainer = $("#list-subpages").html('');

		// Get parent uri
		var parentUri = uri.split('/');
		var index = parentUri.length;
		if(index > 1) parentUri.pop();
		parentUri = parentUri.join('/');

		function appendPage(entry, on){
			if(entry['start_date']) {
				var infos = format(entry['start_date']);
			} else {
				//var infos = translate(entry['template']);
			}
			var div = $('<div>')
								.attr( { 'data-uid' : entry['uid'], 'data-uri' : entry['uri'] })
								.addClass('subpage ' + entry['template'] + ' ' + entry['parent'] )
								.addClass(entry['visibility'] )
								.append(
									$('<p>')
									.text(entry['title'])
								)
								.append(
									$('<div>')
									.addClass('subpage-date infos')
									.text(infos)
								)
								.on('click', on);
			if(entry['parent'] == 'parent') {
				subpagesContainer.prepend( div );
			} else {
				subpagesContainer.append( div );
			}
		}

		function loadPage(uri, update) {
			var src = siteUrl + '/panel/pages/' + uri + '/edit' ;
			iframe.attr('src', src);
			iframe.addClass('loading');
		}


		// Lister les fichiers
		$.ajax({
			type: "GET",
			dataType: "json",
			url: apiUri,
			data: data,
			success: function(data) {
				data['subpages'].forEach(function(entry){
					if( entry['template'] == 'folder' && folder == true && entry['parent'] == false ) {
						appendPage(entry, function(){
							loadPage($(this).attr('data-uri'), true);
							subpages($(this).attr('data-uri'));
							subpagesContainer.attr('data-uri', uri);
							$(this).addClass('active');
						})
					} else if( entry['parent'] == true ) {
						appendPage(entry, function(){
							loadPage($(this).attr('data-uri'));
							$("#list-subpages .subpage").removeClass('active');
							$(this).addClass('active');
						});
					} else {
						appendPage(entry, function(){
							loadPage($(this).attr('data-uri'));
							$("#list-subpages .subpage").removeClass('active');
							$(this).addClass('active');
						});
					}
				});
				// Créer la navbar
				// btn précédent ?
				if(index > 1 && navigate == true) {
					var prev = true ;
				} else {
					var prev = false;
				}
				createNavBar( prev, data['templates'] )
			},
		});

		function createNavBar(prevBtn, templates) {

			// Créer la barre de navigation
			var navbar = $('<div>').addClass('subpages-navbar cf');
			subpagesContainer.children('.parent').after( navbar );

			// Créer la liste des templates autorisés
			if (templates) {
				templates = templates.split(',');
			}

			// Si la page a des parents ajouter un bouton précédent
			if(prevBtn) {
				navbar.append(
					$('<p>')
					.addClass('button left previous')
					.text('<')
					.on('click', function(){
						var src = siteUrl + '/panel/pages/' + parentUri + '/edit' ;
						iframe.attr('src', src);
						iframe.addClass('loading');
						subpages(parentUri);
					})
				);
			}

			// Si on est autorisé à créer de nouvelles pages
			if(templates) {

				// Ajouter le bouton Nouveau
				navbar.append(
					$('<p>')
					.addClass('button right new')
					.text('+ Ajouter')
					.on('click', function(){
						$('#new-page').slideToggle();
					})
				);

				// Prépare type selector
				var type = $('<select>').attr('name', 'template');
				templates.forEach(function(template) {
					type.append($('<option>').attr('value', template).text(template));
				});
				if(templates.length < 2) {
					type.hide();
				}

				// Create formulaire new page
				subpagesContainer.children('.parent').after(
					$('<div>')
					.attr('id', 'new-page')
					.append(
						$('<form>')
						.append('<input name="title" placeholder="Titre">')
						.append(type)
						.append('<input type="submit" value="Créer">')
						.append('<input type="hidden" name="action" value="create">')
						.on('submit', function(e){
							e.preventDefault();
							var data = $(this).serialize();
							$.ajax({
								type: "GET",
								dataType: "json",
								url: apiUri,
								data: data,
								success: function(data) {
									if(data['error'] != null) {
										alert(data['error']);
									} else {
										subpages(uri, folder);
									}
								},
							});
						})
					)
				);
			}
		}
	}


	if( $('.template-espace-membre').size() ) {
		var container = $("#list-subpages"),
				folders = container.attr('data-folders'),
				navigate = container.attr('data-navigate'),
				iframe = $('main iframe');
		subpages(container.attr('data-uri'), folders);

		iframe.load(function(){
			$(this).removeClass('loading');
		});

	}

	/* Maintenance page
	----------------------------------------- */
	if( $('body.page-maintenance').size() ) {
		var windowW = $(window).width(),
		    windowH = $(window).height(),
				dotsNum = windowW * windowH / 100000;
		for(var i = 0 ; i < dotsNum  ; i++) {
			if (i==1) {
				$('#dots').append( $('<div>').css({ top: Math.random() * windowH , left: Math.random() * windowW, backgroundColor: 'rgb(33, 255, 99)' }).addClass('btn-login') ) ;
			} else {
				$('#dots').append( $('<div>').css({ top: Math.random() * windowH , left: Math.random() * windowW }) ) ;
			}
		}
		$(document).on('click', '#dots > div', function(){
			$('#maintenance-login').toggleClass('show');
		})
	}



});



































/*!
 * imagesLoaded PACKAGED v4.1.0
 * JavaScript is all like "You images are done yet or what?"
 * MIT License
 */

!function(t,e){"function"==typeof define&&define.amd?define("ev-emitter/ev-emitter",e):"object"==typeof module&&module.exports?module.exports=e():t.EvEmitter=e()}(this,function(){function t(){}var e=t.prototype;return e.on=function(t,e){if(t&&e){var i=this._events=this._events||{},n=i[t]=i[t]||[];return-1==n.indexOf(e)&&n.push(e),this}},e.once=function(t,e){if(t&&e){this.on(t,e);var i=this._onceEvents=this._onceEvents||{},n=i[t]=i[t]||[];return n[e]=!0,this}},e.off=function(t,e){var i=this._events&&this._events[t];if(i&&i.length){var n=i.indexOf(e);return-1!=n&&i.splice(n,1),this}},e.emitEvent=function(t,e){var i=this._events&&this._events[t];if(i&&i.length){var n=0,o=i[n];e=e||[];for(var r=this._onceEvents&&this._onceEvents[t];o;){var s=r&&r[o];s&&(this.off(t,o),delete r[o]),o.apply(this,e),n+=s?0:1,o=i[n]}return this}},t}),function(t,e){"use strict";"function"==typeof define&&define.amd?define(["ev-emitter/ev-emitter"],function(i){return e(t,i)}):"object"==typeof module&&module.exports?module.exports=e(t,require("ev-emitter")):t.imagesLoaded=e(t,t.EvEmitter)}(window,function(t,e){function i(t,e){for(var i in e)t[i]=e[i];return t}function n(t){var e=[];if(Array.isArray(t))e=t;else if("number"==typeof t.length)for(var i=0;i<t.length;i++)e.push(t[i]);else e.push(t);return e}function o(t,e,r){return this instanceof o?("string"==typeof t&&(t=document.querySelectorAll(t)),this.elements=n(t),this.options=i({},this.options),"function"==typeof e?r=e:i(this.options,e),r&&this.on("always",r),this.getImages(),h&&(this.jqDeferred=new h.Deferred),void setTimeout(function(){this.check()}.bind(this))):new o(t,e,r)}function r(t){this.img=t}function s(t,e){this.url=t,this.element=e,this.img=new Image}var h=t.jQuery,a=t.console;o.prototype=Object.create(e.prototype),o.prototype.options={},o.prototype.getImages=function(){this.images=[],this.elements.forEach(this.addElementImages,this)},o.prototype.addElementImages=function(t){"IMG"==t.nodeName&&this.addImage(t),this.options.background===!0&&this.addElementBackgroundImages(t);var e=t.nodeType;if(e&&d[e]){for(var i=t.querySelectorAll("img"),n=0;n<i.length;n++){var o=i[n];this.addImage(o)}if("string"==typeof this.options.background){var r=t.querySelectorAll(this.options.background);for(n=0;n<r.length;n++){var s=r[n];this.addElementBackgroundImages(s)}}}};var d={1:!0,9:!0,11:!0};return o.prototype.addElementBackgroundImages=function(t){var e=getComputedStyle(t);if(e)for(var i=/url\((['"])?(.*?)\1\)/gi,n=i.exec(e.backgroundImage);null!==n;){var o=n&&n[2];o&&this.addBackground(o,t),n=i.exec(e.backgroundImage)}},o.prototype.addImage=function(t){var e=new r(t);this.images.push(e)},o.prototype.addBackground=function(t,e){var i=new s(t,e);this.images.push(i)},o.prototype.check=function(){function t(t,i,n){setTimeout(function(){e.progress(t,i,n)})}var e=this;return this.progressedCount=0,this.hasAnyBroken=!1,this.images.length?void this.images.forEach(function(e){e.once("progress",t),e.check()}):void this.complete()},o.prototype.progress=function(t,e,i){this.progressedCount++,this.hasAnyBroken=this.hasAnyBroken||!t.isLoaded,this.emitEvent("progress",[this,t,e]),this.jqDeferred&&this.jqDeferred.notify&&this.jqDeferred.notify(this,t),this.progressedCount==this.images.length&&this.complete(),this.options.debug&&a&&a.log("progress: "+i,t,e)},o.prototype.complete=function(){var t=this.hasAnyBroken?"fail":"done";if(this.isComplete=!0,this.emitEvent(t,[this]),this.emitEvent("always",[this]),this.jqDeferred){var e=this.hasAnyBroken?"reject":"resolve";this.jqDeferred[e](this)}},r.prototype=Object.create(e.prototype),r.prototype.check=function(){var t=this.getIsImageComplete();return t?void this.confirm(0!==this.img.naturalWidth,"naturalWidth"):(this.proxyImage=new Image,this.proxyImage.addEventListener("load",this),this.proxyImage.addEventListener("error",this),this.img.addEventListener("load",this),this.img.addEventListener("error",this),void(this.proxyImage.src=this.img.src))},r.prototype.getIsImageComplete=function(){return this.img.complete&&void 0!==this.img.naturalWidth},r.prototype.confirm=function(t,e){this.isLoaded=t,this.emitEvent("progress",[this,this.img,e])},r.prototype.handleEvent=function(t){var e="on"+t.type;this[e]&&this[e](t)},r.prototype.onload=function(){this.confirm(!0,"onload"),this.unbindEvents()},r.prototype.onerror=function(){this.confirm(!1,"onerror"),this.unbindEvents()},r.prototype.unbindEvents=function(){this.proxyImage.removeEventListener("load",this),this.proxyImage.removeEventListener("error",this),this.img.removeEventListener("load",this),this.img.removeEventListener("error",this)},s.prototype=Object.create(r.prototype),s.prototype.check=function(){this.img.addEventListener("load",this),this.img.addEventListener("error",this),this.img.src=this.url;var t=this.getIsImageComplete();t&&(this.confirm(0!==this.img.naturalWidth,"naturalWidth"),this.unbindEvents())},s.prototype.unbindEvents=function(){this.img.removeEventListener("load",this),this.img.removeEventListener("error",this)},s.prototype.confirm=function(t,e){this.isLoaded=t,this.emitEvent("progress",[this,this.element,e])},o.makeJQueryPlugin=function(e){e=e||t.jQuery,e&&(h=e,h.fn.imagesLoaded=function(t,e){var i=new o(this,t,e);return i.jqDeferred.promise(h(this))})},o.makeJQueryPlugin(),o});
