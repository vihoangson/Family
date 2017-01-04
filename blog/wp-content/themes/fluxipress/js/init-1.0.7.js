jQuery(document).ready(function($) {

	var flxp = {
	
		resortColumns: function(scope, postsOnly)
		{
			var numCols = 4, i;
			if(flxp.b.hasClass('lt-800')) numCols = 3;
			if(flxp.b.hasClass('lt-640')) numCols = 2;
			if(flxp.b.hasClass('lt-480')) numCols = 1;
	
			if(scope === undefined) scope = flxp.b;
	
			for(i = (flxp.cfg.currentPage - 1) * flxp.cfg.postsPerPage; i < flxp.cfg.currentPage * flxp.cfg.postsPerPage; i++)
			{
				$('#post-' + i, scope).appendTo($('#col' + ((i % numCols) + 1)));
			}
	
			if(postsOnly) return;
	
			if(flxp.b.hasClass('lt-800'))
			{
				for(i = 0; i < flxp.numSidebarWidgets; i++)
				{
					$(flxp.sidebarWidgets[i]).appendTo($('#scol' + ((i % numCols) + 1)));
				}
			}
			else
			{
				for(i = 0; i < flxp.numSidebarWidgets; i++)
				{
					$(flxp.sidebarWidgets[i]).appendTo($('#scol1'));
				}
			}
	
			for(i = 0; i < flxp.numFooterWidgets; i++)
			{
				$(flxp.footerWidgets[i]).appendTo($('#fcol' + ((i % numCols) + 1)));
			}
		},
	
		loadPosts: function()
		{
			if(!flxp.cfg.enableInfiniteScrolling) return;
			flxp.loading = true;
			flxp.cfg.currentPage++;
			$.ajax({
				type: 'GET',
				data: {
					fluxipress_load_posts: 1,
					fluxipress_load_posts_num: flxp.cfg.postsPerPage,
					fluxipress_load_posts_page: flxp.cfg.currentPage
				},
				dataType: 'html',
				url: flxp.cfg.homePath,
				beforeSend : function() {
					flxp.b.addClass('loading');
				},
				success: function(data) {
					var d = $('<div>');
					d.append(data);
	
					flxp.lastPage = $('.post', d).length < 1;
					if(!flxp.lastPage) flxp.resortColumns(d, true);
					
					flxp.b.removeClass('loading');
					flxp.loading = false;
				},
				error: function(jqXHR, textStatus, errorThrown) {
					flxp.b.removeClass('loading');
					if(typeof console !== "undefined" && typeof console.log !== "undefined") console.log(jqXHR, textStatus, errorThrown);
				}
			});
		},
		
		init: function()
		{
			flxp.w = $(window);
			flxp.b = $('body');
			flxp.p = $('#post');
			flxp.pl = $('#post-list');
			flxp.sidebarWidgets = $('.widget', '#sidebar-single');
			flxp.numSidebarWidgets = flxp.sidebarWidgets.length;
			flxp.footerWidgets = $('.widget', '#sidebar-footer');
			flxp.numFooterWidgets = flxp.footerWidgets.length;
			flxp.cfg = $.extend(
				{
					themePath: '../',
					currentPage: 1,
					lastPage: false,
					postsPerPage: 10,
					numPosts: $('.post', flxp.pl).length,
					enableInfiniteScrolling: false
				},
				(typeof fluxipressOptions === 'undefined' ? {} : fluxipressOptions)
			);
			flxp.cfg.currentPage = parseInt(flxp.cfg.currentPage);
			flxp.cfg.postsPerPage = parseInt(flxp.cfg.postsPerPage);
	
			$('.post', flxp.pl).each(
				function()
				{
					if($('.no-more', this).length > 0) return;
					$(this).click(
						function()
						{
							window.location.href = $('a', this).first().attr('href');
						}
					);
				}
			);
	
			$('.gallery img', flxp.p).hover(
				function()
				{
					var g = $('.gallery img', flxp.p);
					for(var i = 0; i < g.length; i++)
					{
						$(g[i]).stop(true).animate({ opacity: $(this).attr('src') == $(g[i]).attr('src') ? 1 : .5 }, 300);
					}
				},
				function()
				{
					$('.gallery img', flxp.p).stop(true).animate({ opacity: 1 }, 300);
				}
			);
	
			$('.gallery', flxp.p).each(
				function()
				{
					$(this).magnificPopup({
						delegate: 'a[href$=".jpg"],a[href$=".png"],a[href$=".webp"],a[href$=".gif"]',
						type: 'image',
						gallery: { enabled: true }
					});
				}
			);
	
			$('dd.gallery-caption', flxp.p).each(
				function()
				{
					$('a', $(this).prev()).attr('title', $(this).text());
				}
			);
	
			$('a[href$=".jpg"],a[href$=".png"],a[href$=".webp"],a[href$=".gif"]', flxp.p).each(
				function()
				{
					if(!$(this).parent().hasClass('gallery-icon'))
					{
						$(this)
							.addClass('zoomLink')
							.magnificPopup({ type: 'image' })
						;
					}
				}
			);
	
			flxp.w.resize(
				function(e)
				{
					flxp.bodyClasses = flxp.b.attr('class');
					var ww = flxp.w.width(),
						s = [480, 640, 800, 1280]
						;
					s.map(function(sw) { flxp.b.removeClass('lt-' + sw + ' gt-' + sw); });
					s.map(function(sw) { flxp.b.addClass((ww >= sw ? 'g' : 'l') + 't-' + sw); });
	
					if((flxp.cfg.numPosts > 0 || flxp.numSidebarWidgets > 0 || flxp.numFooterWidgets > 0) && flxp.bodyClasses != flxp.b.attr('class'))
					{
						flxp.resortColumns();
					}
				}
			);
			flxp.w.resize();
	
			$('#mobile-menu').click(
				function(event)
				{
					event.preventDefault();
					$('#page').toggleClass('open');
					return false;
				}
			);
	
			// init infinite scroll
			if(flxp.cfg.enableInfiniteScrolling === 'true')
			{
				flxp.w.scroll(function() {
					if(
						!flxp.loading &&
							!flxp.lastPage &&
							(flxp.w.scrollTop() + flxp.w.height()) > (flxp.pl.scrollTop() + flxp.pl.height() + flxp.pl.offset().top - 200)
						)
					{
						flxp.loadPosts();
					}
				});
			}
		}
		
	};
	
	flxp.init();

});