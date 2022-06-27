jQuery(function ($) {

	Handlebars.registerHelper('ifCond', function (v1, operator, v2, options) {
		switch (operator) {
			case '==':
				return (v1 == v2) ? options.fn(this) : options.inverse(this);
			case '===':
				return (v1 === v2) ? options.fn(this) : options.inverse(this);
			case '!=':
				return (v1 != v2) ? options.fn(this) : options.inverse(this);
			case '!==':
				return (v1 !== v2) ? options.fn(this) : options.inverse(this);
			case '<':
				return (v1 < v2) ? options.fn(this) : options.inverse(this);
			case '<=':
				return (v1 <= v2) ? options.fn(this) : options.inverse(this);
			case '>':
				return (v1 > v2) ? options.fn(this) : options.inverse(this);
			case '>=':
				return (v1 >= v2) ? options.fn(this) : options.inverse(this);
			case '&&':
				return (v1 && v2) ? options.fn(this) : options.inverse(this);
			case '||':
				return (v1 || v2) ? options.fn(this) : options.inverse(this);
			default:
				return options.inverse(this);
		}
	});

	Handlebars.registerHelper('svgStars', function (rating, opts) {
		var styleRating = Handlebars.escapeExpression(this.styleRating);

		if (opts.hash.hasOwnProperty('styleRating')) {
			styleRating = Handlebars.escapeExpression(opts.hash.styleRating);
		}

		var html = '';

		// rating = explode('.', rating, 2);
		rating = rating.toString().split('.', 2);

		for (var i = 0; i < 5; i++) {

			var className = '';

			if (rating[0] <= i) {

				className = '-o';

				if (rating[0] == i && rating[1] && rating[1] > 3) {
					className = '-h';
				}
			}

			html += "<svg viewBox=\"0 0 12 12\" class='tr-star-color" + className + "'><use xlink:href=\"#rating-" + styleRating + "\"></use></svg>";
		}

		return html;
	});

	window.TR = {

		request: function (method, args = null, callback) {
			if (args instanceof jQuery) {
				args = args.serializeJSON();
			}

			$.ajax({
				url: arpAjax.URL,
				data: { action: arpAjax.ACTION, method: method, args: args },
				type: 'POST',
				dataType: 'json',
				success: callback
			});
		},

		objTotmpl: function (tmpl, data) {
			if (typeof Handlebars === 'undefined') {
				console.log('Handlebars not registry');
				return false
			}
			var template = Handlebars.compile(tmpl);
			return template(data);
		},

		render: function (tmpl, $target, res) {

			if (!res) {
				return
			}

			if (res.hasOwnProperty('success') && !res.success) {
				// window.ADS.notify(res.data, 'danger');
				return;
			}

			if (res.hasOwnProperty('message')) {
				// window.ADS.notify(res.message, 'success');
			}

			if (!res.data) {
				return;
			}

			tmpl = $(tmpl).html();


			if (!($target instanceof jQuery)) {
				$target = $($target);
			}

			$target.html(this.objTotmpl(tmpl, res.data));
		}
	};


	var TRPreview = {

		loadedStyle: function (res) {
			if (document.body.classList.contains('michelangelo') || document.body.classList.contains('davinci') || document.body.classList.contains('andy')) {
				document.documentElement.style.fontSize = '13px';
			}
			if (document.body.classList.contains('theme-puca')) {
				document.documentElement.style.fontSize = '14px';
			}

			this._style = res.data;

			if (arpAjax.ATTS.readmore) {
				this._style.readMore = $('<textarea />').html(arpAjax.ATTS.readmore).text();
			}

			this.fetch();
		},

		render: function (res) {
			this.$target.find('.trp-loader')
				.addClass('trp-loader-hidden');

			this.offset = null;
			// this._style = res.data;
			// this.update();

			if (!res.data.list.length) {
				return;
			}
			
			if (this._revie) {
				this._revie = $.extend({}, this._revie, res.data, {
					list: this._revie.list.concat(res.data.list)
				});
			} else {
				this._revie = res.data;
			}

			var args = $.extend({}, this._style, this._revie, {
				i18n: arpAjax.I18N
			});

			window.TR.render('#tmpl-trustpage', this.$target, {
				success: true,
				data: args
			});

			this._fetching = false;
			this.list = document.querySelector('.trp-list');
			this.$body.trigger('jetpack-lazy-images-load');

			// this.$target.find('.jetpack-lazy-image')
			// 	.each((key, val) => {
			// 		var $this = $(val)
			// 		var src = $this.attr('src')
			// 		$this.attr('srcset', src)
			// 	})

			if (typeof window.Flatsome !== 'undefined') {
				this.$target.find('.lazy-load:not(.lazy-load-active)')
					.each(function () {
						var $element = $(this);
						var src = $element.data('src');
						var srcset = $element.data('srcset');

						if (src) $element.attr('src', src);
						if (srcset) $element.attr('srcset', srcset);

						$element.addClass('lazy-load-active')
							.removeClass('lazy-load');
						// $element.imagesLoaded(function () {
						// 	
						// });
					});
			}

			if (!this._style || this._style.styleLayout !== 'grids') {
				return;
			}

			this.updateGrid()
			this.$target.imagesLoaded(this.updateGrid.bind(this));
		},

		fetch: function () {
			this.paged++;
			
			var args = {
				paged: this.paged
			};

			if (arpAjax.ATTS.limit) {
				if (this.paged > 1) {
					return;
				}
				args.limit = arpAjax.ATTS.limit;
			}

			this._fetching = true;
			this.$target.find('.trp-loader')
				.removeClass('trp-loader-hidden');

			window.TR.request('Reviews.get', args, this.render.bind(this));
		},

		update: function () {
			// 
		},

		updateGrid: function () {

			this.grid = new Minigrid({
				container: '.trp-list-grids',
				item: '.trp-list-item',
				rtl: document.dir === 'rtl'
			});

			this.offset = window.pageYOffset || window.scrollY;
			this.handlerResize();
		},

		handlerResize: function () {

			if (!this.list) {
				return;
			}

			for (var i = 2; i < 6; i++) {
				var classes = 'trp-list-grids-' + i;
				this.list.classList.remove(classes);
				if (this.list.clientWidth >= 235 * i) {
					this.list.classList.add(classes);
				}
			}

			if (!this.grid) {
				return;
			}

			this.grid.mount();

			if (this.offset !== null && this.offset > (window.pageYOffset || window.scrollY)) {
				window.scrollTo(0, this.offset);
				this.offset = null
			}
		},

		handlerScroll: function (event) {
			if (!this.list || this._fetching) {
				return;
			}

			var rect = this.list.getBoundingClientRect();

			// если не долистали до конца блока - ничего не делаем
			if (rect.bottom - (window.innerHeight * 2.5) > 0) {
				return;
			}

			this.fetch();
		},

		onLike: function (event) {
			event.preventDefault();
			var $this = $(event.currentTarget);

			if ($this.hasClass('active')) {
				return;
			}

			var $wrap = $this.closest('span');

			window.TR.request('Reviews.like', { commentId: $wrap.attr('data-id') });

			$active = $wrap.find('.active');

			if ($active.length) {
				$active.removeClass('active');
				var $next = $active.next();
				$next.text(($next.text() * 1) - 1);
			}

			$this.addClass('active');
			var $next = $this.next();
			$next.text(($next.text() * 1) + 1);
		},

		onDislike: function (event) {
			event.preventDefault();
			var $this = $(event.currentTarget);

			if ($this.hasClass('active')) {
				return;
			}

			var $wrap = $this.closest('span');

			window.TR.request('Reviews.dislike', { commentId: $wrap.attr('data-id') });

			$active = $wrap.find('.active');

			if ($active.length) {
				$active.removeClass('active');
				var $next = $active.next();
				$next.text(($next.text() * 1) - 1);
			}

			$this.addClass('active');
			var $next = $this.next();
			$next.text(($next.text() * 1) + 1);
		},

		onReloadItem: function (event) {
			event.preventDefault();
			var $this = $(event.currentTarget);

			if ($this.hasClass('active')) {
				return;
			}

			$this.addClass('active');

			window.TR.request('Reviews.update', { commentId: $this.attr('data-id') }, this.onReloadItemUpd.bind(this));
		},

		onReloadItemUpd: function (res) {
			
			var $item = this.$target.find('#arp-review-' + res.data.comment_ID);

			$item.find('.trp-list-item-picture img').attr('src', res.data.photo);
			$item.find('.trp-list-item-usename-fullname').text(res.data.comment_author);

			$item.find('.trp-list-item-reload').removeClass('active');
		},

		handler: function () {
			window.addEventListener('resize', this.handlerResize.bind(this));
			window.addEventListener('scroll', this.handlerScroll.bind(this));

			this.$target.on('click', '.trp-list-item-link-like', this.onLike.bind(this));
			this.$target.on('click', '.trp-list-item-link-dislike', this.onDislike.bind(this));
			this.$target.on('click', '.trp-list-item-reload', this.onReloadItem.bind(this));

			if (!$.fn.magnificPopup) {
				return;
			}

			// this.lightBox = $('.trp-list-item-images a').simpleLightbox();
			
			this.$target.on('click', '.trp-list-item-images a', function (e) {
				e.preventDefault();
				var $this = $(e.target);
				var $items = $this.closest('div').find('a');
				// $items.simpleLightbox().open();

				var items = [];

				$items.each(function (k, el) {
					items[items.length] = {
						src: $(el).attr('href')
					}
				});

				$.magnificPopup.open({
					items: items,
					gallery: {
						enabled: true
					},
					type: 'image',
					mainClass: 'mfp-arp',
					// zoom: {
					// 	enabled: true, // By default it's false, so don't forget to enable it
					// 	// duration: 300, // duration of the effect, in milliseconds
					// 	easing: 'ease-in-out', // CSS transition easing function
					// }
				});
			});
		},

		init: function () {

			this.tmpl = document.body.querySelector('#tmpl-trustpage');

			if (this.tmpl === null) {
				return;
			}

			this.$target = $('<div />', {
				id: 'arp-trustpage',
				html: '<div class="trp-loader">' + arpAjax.I18N.Loading + '</div>'
			});

			this.$body = $('body');
			this.$loader = this.$target.find('.trp-loader');

			$(this.tmpl).before(this.$target);

			this._style = null;
			this._revie = null;
			this.lightBox = null;

			this.paged = 0;

			window.TR.request('Customize.get', null, this.loadedStyle.bind(this));

			this.handler();

			return this;
		}
	}

	$(document).ready(function () {
		TRPreview.init();
	});

});