jQuery(document).ready(function($) {	
	var spc = {		
		container: $('.spc-container'),
		navContainer: $('.spc-nav'),
		lists: $('ul.spc-list'),
		maxPages: $('span[data-maxpages]').data('maxpages'),
		cat: $('span[data-cat]').data('cat'),
		items: $('span[data-items]').data('items'),
		paged: 1,
		config: {
			effect: 'fadeToggle',
			speed: 400,
		},
		
		init: function( options ) {
			$.extend( this.config, options );

			var spcNav = this.navContainer.children('a');

			this.setupListWidth.call(this.lists);			
			
			spcNav.on( 'click', function(e) {
				$(this).data('dir') === 'next'? ++spc.paged : --spc.paged;
				if( spc.paged <= 0 ) spc.paged = 1;
				if( spc.paged >= spc.maxPages ) spc.paged = spc.maxPages;
				spc.loadPosts();
				e.preventDefault();
			});

		},

		loadPosts: function() {
			$.ajax({
				type: 'POST',
				url: spcwp.ajaxurl,
				data: {
					action: 'spc_load_posts',
					paged: this.paged,
					cat: this.cat,
					items: this.items,
				},
				beforeSend: function() {
					spc.navContainer.children('span').css('opacity', 1);
				},
				success: function( response ) {
					spc.lists[spc.config.effect]( spc.config.speed, function() {
						spc.navContainer
							.children('span')
							.css('opacity', 0);
						spc.lists[spc.config.effect]( spc.config.speed ).html( response );
						spc.setupListWidth.call(spc.lists);						
					});
				}
			});	
		},

		setupListWidth: function() {
			var $this = $(this),
				listItemWidth = 100 / spc.items;

			$this.children('li')
				.css('width', listItemWidth + '%');
		}
	}
	spc.init();	
});