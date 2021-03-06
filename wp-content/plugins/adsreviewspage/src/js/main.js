jQuery(function ($) {

	Handlebars.registerHelper('svgStars', function (rating, opts) {

		if (!rating) {
			return null;
		}

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

	Handlebars.registerHelper('dateFormat', function (date, opts) {
		var formatDate = Handlebars.escapeExpression(this.formatDate);

		if (opts.hash.hasOwnProperty('formatDate')) {
			formatDate = Handlebars.escapeExpression(opts.hash.formatDate);
		}

		console.log(date, formatDate);

		date = window.luxon.DateTime().fromSQL(date);

		return date.toFormat(formatDate);
	});

	window.TR = {

		request: function (method, args = null, callback) {
			if (args instanceof jQuery) {
				args = args.serializeJSON();
			}

			this.screenLock();

			var params = {
				url: arpAjax.URL,
				data: { action: arpAjax.ACTION, method: method, args: args },
				type: 'POST',
				dataType: 'json',
				success: callback
			};

			$.ajaxQueue(params).always(this.screenUnLock);
		},

		render: function (tmpl, $target, res) {

			if (!res) {
				return
			}

			if (res.hasOwnProperty('success') && !res.success) {
				window.ADS.notify(res.data, 'danger');
				return;
			}

			if (res.hasOwnProperty('message')) {
				window.ADS.notify(res.message, 'success');
			}

			if (!res.data) {
				return;
			}

			if (res.data.hasOwnProperty('_redirect')) {
				window.location.href = res.data._redirect;
				return;
			}

			tmpl = $(tmpl).html();


			if (!($target instanceof jQuery)) {
				$target = $($target);
			}

			$target.html(window.ADS.objTotmpl(tmpl, res.data));
			window.ADS.switchery($target);
		},

		screenLock: function () {
			var l = $('#loader-all');
			if (l.length) {
				l.removeClass('d-none');
			}
		},

		screenUnLock: function () {
			setTimeout(function () {
				var l = $('#loader-all');
				if (l.length) {
					l.addClass('d-none');
				}
			}, 300);
		},

	};

	var TRPage = {

		render: function (res) {
			window.TR.render('#tmpl-page', this.$target, res);
		},

		onSubmit: function (event) {
			event.preventDefault();
			window.TR.request('Page.set', this.$target, this.render.bind(this));
		},

		onRemove: function (event) {
			event.preventDefault();
			var conf = confirm('Are you sure you want to delete this page?');
			if (!conf) {
				return;
			}
			window.TR.request('Page.remove', this.$target, this.render.bind(this));
		},

		toggleEdit: function (event) {
			event.preventDefault();
			$(event.target).attr('type', 'submit').text(arpAjax.I18N.Save);
			this.$target.find('input[name=name]')
				.removeAttr('readonly')
				.focus();
		},

		handler: function () {
			this.$target.on('submit', this.onSubmit.bind(this))
				.on('click', 'button[type=button].btn-green', this.toggleEdit.bind(this))
				.on('click', 'button[type=button].btn-danger', this.onRemove.bind(this));
		},

		init: function () {

			this.$target = $('#tr-page');

			if (!this.$target.length) {
				return;
			}

			window.TR.request('Page.get', null, this.render.bind(this));
			this.handler();
		}
	}

	TRPage.init();


	var TRSettings = {

		render: function (res) {
			window.TR.render('#tmpl-settings', this.$target, res);
			this.$target.find('input[name=generateNames], input[name^=genders]:eq(0)')
				.trigger('input');
		},

		onSubmit: function (e) {
			e.preventDefault();
			window.TR.request('Settings.set', this.$target, this.render.bind(this));
		},

		onSubmitRefresh: function (e) {
			console.log('Settings.onSubmitRefresh');

			e.preventDefault();
			window.TR.request('Settings.refresh', this.$target, this.render.bind(this));
		},

		handler: function () {

			this.$target
				.on('submit', this.onSubmit.bind(this))
				.on('click touch', 'button[name="refreshReviews"]', this.onSubmitRefresh.bind(this))
				.on('input change', 'input[name=generateNames]', function (event) {
					event.preventDefault();
					var $this = $(event.target);
					var $wrap = $this.closest('div');
					var $next = $wrap.next();

					if ($this.is(':checked')) {
						$next.show();
					} else {
						$next.hide();
					}
				})
				.on('input change', 'input[name^=genders]:eq(0)', function (event) {
					event.preventDefault();
					var $this = $(event.target);
					var $next = $this.closest('div').find('input[name^=genders]:eq(1)');
					var val = event.target.value;

					var min = $this.attr('min') || 0;
					var max = $this.attr('max') || 100;

					if (val < min) val = ~~min;
					if (val > max) val = ~~max;

					$this.val(val);
					$next.val(max - val);
				});
		},

		init: function () {

			this.$target = $('#arp-settings');

			if (!this.$target.length) {
				return;
			}

			window.TR.request('Settings.get', null, this.render.bind(this));
			this.handler();
		}
	}

	TRSettings.init();


	var TRPreview = {

		render: function (res) {
			this._reviews = res.data;
			this.update();
		},

		update: function (style) {
			// console.log('TRPreview.update', style);

			if (style) {
				this._style = style;
			}

			var args = $.extend({}, this._reviews, this._style, {
				i18n: arpAjax.I18N
			});

			window.TR.render('#tmpl-trustpage', this.$target, {
				success: true,
				data: args
			});

			this.list = document.querySelector('.trp-list');

			if (!this._style || this._style.styleLayout !== 'grids') {
				return;
			}

			this.handlerResize();
			this.$target.imagesLoaded(this.updateGrid.bind(this));
		},

		updateGrid: function () {

			this.grid = new Minigrid({
				container: '.trp-list-grids',
				item: '.trp-list-item'
			});

			this.handlerResize();
		},

		handlerResize: function () {

			if (this.list) {
				for (var i = 2; i < 6; i++) {
					var classes = 'trp-list-grids-' + i;
					this.list.classList.remove(classes);
					if (this.list.clientWidth >= 260 * i) {
						this.list.classList.add(classes);
					}
				}
			}

			if (!this.grid) {
				return;
			}

			this.grid.mount();
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
			this.$target.on('click', '.trp-list-item-reload', this.onReloadItem.bind(this));
		},

		onLoad: function (args) {
			this.$loader.removeClass('trp-loader-hidden');
			args = $.extend({}, args, {
				limit: 4,
				isAdmin: true
			});
			window.TR.request('Reviews.get', args, this.render.bind(this));
		},

		init: function () {

			this.$target = $('#tr-preview');

			if (!this.$target.length) {
				return;
			}

			this.$loader = this.$target.find('.trp-loader');

			this._style = null;
			this._reviews = null;

			this.onLoad();
			this.handler();

			return this;
		}
	}


	var TRCustomize = {

		render: function (res) {
			window.TR.render('#tmpl-customize', this.$target, res);
			this.preview.update(res.data);
			this.$target.find('input[name=showDate]').trigger('input');
			this.$target.find('input[name=showLike]').trigger('input');
		},

		onChange: function () {
			var args = this.$target.serializeJSON();
			this.preview.update(args);
		},

		onChangeShowLike: function (event) {
			event.preventDefault();
			var $this = $(event.target);

			var $target = this.$target.find('select[name=styleLike]')
				.closest('.form-group-flex');

			if ($this.is(':checked')) {
				$target.removeClass('form-group-flex-disabled');
				return;
			}

			$target.addClass('form-group-flex-disabled');
		},

		onSubmit: function (e) {
			e.preventDefault();
			window.TR.request('Customize.set', this.$target, this.render.bind(this));
		},

		onReload: function (e) {
			var args = this.$target.serializeJSON();
			this.preview.onLoad({ style: args });
		},

		handler: function () {
			this.$target.on('submit', this.onSubmit.bind(this))
				.on('input change', 'input, select, textarea', this.onChange.bind(this))
				.on('input change', 'select[name=formatDate]', this.onReload.bind(this))
				.on('input change', 'select[name=showName]', this.onReload.bind(this))
				.on('input change', 'input[name=showDate]', function (event) {
					event.preventDefault();
					var $this = $(event.target);
					var $wrap = $this.closest('div');
					var $next = $wrap.next();

					if ($this.is(':checked')) {
						$next.show();
					} else {
						$next.hide();
					}
				})
				.on('input change', 'input[name=showLike]', this.onChangeShowLike.bind(this));
		},

		init: function () {

			this.$target = $('#tr-customize');

			if (!this.$target.length) {
				return;
			}

			this.preview = TRPreview.init();

			window.TR.request('Customize.get', null, this.render.bind(this));
			this.handler();
		}
	}

	TRCustomize.init();


	var TRLicense = {

		render: function (res) {
			window.TR.render('#tmpl-license', this.$target, res);
		},

		onSubmit: function (e) {
			e.preventDefault();
			window.TR.request('license.set', this.$target, this.render.bind(this));
		},

		handler: function () {
			this.$target.on('submit', this.onSubmit.bind(this));
		},

		init: function () {

			this.$target = $('#tr-license');

			if (!this.$target.length) {
				return;
			}

			window.TR.request('License.get', null, this.render.bind(this));
			this.handler();
		}
	};

	TRLicense.init();

});
