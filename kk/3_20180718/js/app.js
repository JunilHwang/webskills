const App = function() {

	let app;

	let db;

	let elCanvas;

	let shape = null;

	let text = null;

	let modify = null;

	let doc = $(document);

	let start = $("#start");

	let popup = $("#popup");

	let back = $("#back");

	let openList = $("#openList");

	let saveList = $("#saveList");

	let closeList = $("#closeList");

	let makeWebBtn = $("#makeWebBtn");

	let makeView = $("#makeView");

	let makeContent = $("<div></div>");

	let leftMenu = $("#leftMenu");

	let btnBlock = $(".btnBlock");

	let order = $("#order");

	let sort = $("#sort");

	let listBox = $(".listBox");

	let elOption = $("#elementOption");

	let elView = elOption.find('#colorSelectView');

	let elColor = elOption.find('.color');

	let elAlpha = elOption.find('.alpha');

	let elBox = elOption.find('.box');

	let elShapeBox = elOption.find('.shape-box');

	let elTextBox = elOption.find('.text-box');

	let elBorder = elOption.find('#borderSize');

	let elFont = elOption.find('#fontSize');

	let elCreateLink = elOption.find('.createLink');

	let elUnLink = elOption.find('.unlink');

	/**
	 * 	IndexedDB
	 */
	const __DB = function() {
		let index = window.indexedDB || window.webkitIndexedDB || window.mozIndexedDB;

		let dbName = '20180708db';

		let version = 2;

		let table = '20180708table';

		let req;

		let db;

		this.init = function() {
			req = index.open( dbName, version );

			req.onupgradeneeded = function( rs ) {
				rs = rs.target.result;

				if ( rs.objectStoreNames.contains( table ) ) {
					rs.deleteObjectStore( table );
				}

				rs.createObjectStore( table, {keyPath: 'idx', autoIncrement: true});
			};

			req.onsuccess = function( rs ) {
				rs = rs.target.result;

				db = rs;

				app.setItemList();
			};
		};

		this.prepare = function() {
			return db.transaction( table, 'readwrite' ).objectStore( table );
		};

		this.add = function( data ) {
			let req = this.prepare();
			req.add( data );
		};

		this.put = function( data ) {
			let req = this.prepare();
			req.put( data );
		};

		this.delete = function( key ) {
			let req = this.prepare();
			req.delete( key );
		};

		this.get = function( key ) {
			let req = this.prepare();
			let data = req.get( key );

			return new Promise(function( resolve, reject ){
				data.onsuccess = function() {
					resolve( data.result );
				};
			});
		};

		this.getAll = function() {
			let req = this.prepare();
			let data = req.getAll();

			return new Promise(function( resolve, reject ){
				data.onsuccess = function() {
					resolve( data.result );
				};
			});
		};
	}

	/**
	 * 	Canvas
	 */
	const __Canvas = function( op ) {

		this.initialize = function( op ) {
			this.c = document.getElementById( op.canvas );
			this.ctx = this.c.getContext('2d');
		};

		return this.initialize( op );
	};

	__Canvas.prototype = {

		getGradient( width, height, color1, color2 ) {
			let gradient = this.ctx.createLinearGradient( 0, 0, width, height );

			gradient.addColorStop( 0, color1 );
			gradient.addColorStop( 1, color2 );

			return gradient;
		},

		setGradient( color ) {
			let hsla = `hsla(${color}, 100%, 50%, 1)`;
			let grW = this.getGradient( this.c.width, 0, '#fff', hsla );
			let grH = this.getGradient( 0, this.c.height, 'rgba(0,0,0,0)', '#000' );

			this.fill( grW );
			this.fill( grH );
		},

		fill( fillStyle ) {
			this.ctx.fillStyle = fillStyle;
			this.ctx.fillRect( 0, 0, this.c.width, this.c.height );
		},

		getColorData( x, y ) {
			return this.ctx.getImageData( x, y, 1, 1 ).data;
		}, 

		getRgba( color, alpha ) {
			return `rgba(${color[0]}, ${color[1]}, ${color[2]}, ${alpha/100})`;
		}
	};

	/**
	 * 	Element
	 */
	const __Element = function( op ) {
		this.initialize = function( op ) {
			this.elem = $( op.html ? op.html : "<div></div>" );
			this.elem.css('position', 'absolute');

			if ( op.type ) {
				this.elem.attr({'area-draggable': false, 'area-selectable': false, 'data-type': op.type});
			}

			if ( op.type == 'text' ) {
				this.elem.attr('contenteditable', true);
			}

			if ( op.type == 'shape' ) {
				this.elem.css({backgroundColor: '#fff', border: '1px solid black', overflow: 'auto', resize: 'none'});
			}

			return this.initTrigger();
		};

		this.initTrigger = function() {
			this.elem.on('mousedown', this.onMouseDown);

			doc.on('mousemove', this.onDocMouseMove);

			doc.on('mouseup', this.onDocMouseUp);

			this.elem.on('contextmenu', this.onContextmenu);
		};

		this.onMouseDown = (ev) => {
			let type = this.elem.attr('data-type');

			if ( makeContent.attr('area-draggable') == 'true' ) {
				this.elem.attr('area-draggable', true);
				this.posX = ev.pageX;
				this.posY = ev.pageY;
			}

			if ( type == 'text' ) {
				ev.stopPropagation();
			} 

			if ( type == 'image' ) {
				ev.preventDefault();
			}
		};

		this.onDocMouseMove = (ev) => {
			if ( makeContent.attr('area-crop') == 'true' ) {
				ev.stopPropagation();
			}

			if ( this.elem.attr('area-draggable') == 'true' ) {
				let left = parseInt(this.elem.css('left')) - (this.posX - ev.pageX);
				let top = parseInt(this.elem.css('top')) - (this.posY - ev.pageY);

				this.elem.css({left: left, top: top});

				this.posX = ev.pageX;
				this.posY = ev.pageY;
			}
		};

		this.onDocMouseUp = (ev) => {
			this.elem.attr('area-draggable', false);
		};

		this.onContextmenu =  (ev) => {
			let type = this.elem.attr('data-type');
			let open = false;

			app.clearElOption();
			app.offElOption();

			if ( type == 'text' ) {
				if ( makeContent.attr('create-text') == 'true' ) {
					elShapeBox.hide();
					elTextBox.show();
					open = true;
				}
			}

			if ( type == 'shape' ) {
				if ( makeContent.attr('create-shape') == 'true' ) {
					elShapeBox.show();
					elTextBox.hide();
					open = true;
				}
			}

			if ( open ) {
				elColor.val(359);
				elAlpha.val(100);
				elBorder.val(1);
				elFont.val(1);
				elBox.find('.currentColor').css('backgroundColor', 'white');

				makeContent.find('div').attr('area-selectable', false)
				this.elem.attr('area-selectable', true);

				elCanvas.setGradient( elColor.val() );
				elOption.css({left: ev.pageX, top: ev.pageY});
				elOption.show();

				return false;
			}
		};

		return this.initialize( op );
	};

	/**
	 * 	Application
	 */
	const __App = function() {

		/* ############################################################################################### */
		/* initialize app
		/* ############################################################################################### */
		this.init = function() {
			return this
			.initVariable()
			.initElement()
			.initTrigger();
		};

		this.initVariable = function() {
			db = new __DB();
			db.init();

			elCanvas = new __Canvas({canvas: 'colorSelectView'});

			return this;
		};

		this.initElement = function() {
			leftMenu.css({zIndex: 1001, backgroundColor: 'white'});

			popup.css({zIndex: 2002});

			btnBlock.css({transition: '0s'});

			makeContent.css({position: 'relative', width: '100%', height: '1000px', overflow: 'hidden', borderBottom:'1px solid #000'});

			saveList.css({width: '500px', right: -500 });

			makeView.append( makeContent );

			this.offContentEvent();

			return this;
		};

		this.initTrigger = function() {
			makeWebBtn.on('click', this.startWeb);

			openList.on('click', this.showSaveList);

			closeList.on('click', this.hideSaveList);

			doc.on('keydown', this.onDocKeyDown);

			btnBlock.on('click', this.menuRoute);

			makeContent.on('mousedown', this.onContentDown);

			makeContent.on('mousemove', this.onContentMove);

			doc.on('mouseup', this.onDocMouseUp);

			makeContent.on('dragover', this.onContentDragOver);

			makeContent.on('drop', this.onContentDrop);

			elView.on('click', this.setGradient);

			elColor.on('input', this.changeColor);

			elAlpha.on('input', this.changeAlpha);

			elBorder.on('change', this.changeBorder);

			elFont.on('change', this.changeFont);

			elBox.on('click', this.setElBox);

			sort.on('change', this.setItemList);

			order.on('change', this.setItemList);

			popup.find('.btn').on('click', this.savePopup);

			back.on('click', this.hidePopup);

			elCreateLink.on('click', this.createLink);

			elUnLink.on("click", this.unlink);
		};

		/* ############################################################################################### */
		/* off Event
		/* ############################################################################################### */
		this.offContentEvent = function() {
			makeContent.attr({'area-draggable': false, 'create-text': false, 'create-shape': false, 'area-crop': false});
			makeContent.find('div[data-type="shape"]').css('resize', 'none');
			makeContent.find('div[data-type="text"]').attr('contenteditable', false);
		},

		this.offElOption = function() {
			elOption.attr({'change-bg': false, 'change-color': false, 'change-border': false});
		};

		/* ############################################################################################### */
		/* get & set method
		/* ############################################################################################### */
		this.getDate = function() {
			let d = new Date();

			return d.getFullYear() + '-' + (d.getMonth()+1) + '-' + d.getDate() + ' ' + d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();
		};

		this.getImage = function( html, height ) {
			html = html.replace(/(<img[^>]+)/g, "$1 /");
			html = html.replace(/<br>/g, "<br/>");
			html = html.replace(/&nbsp;/g, " ");

			let width = window.innerWidth;
			let data = `
				<svg xmlns="http://www.w3.org/2000/svg" width="${width}" height="${height}">
					<foreignObject width="100%" height="100%">
						<div xmlns="http://www.w3.org/1999/xhtml">
							${html}
						</div>
					</foreignObject>
				</svg>
			`;

			data = encodeURIComponent( data );

			return 'data:image/svg+xml,' + data;
		};

		this.getItemHTML = function( idx, img, name, info, created_at ) {
			return `
				<div class="list" data-idx=${idx}>
					<div class="content">
						<div class="imgBox">
							<a href="#"><img src="${img}" alt="${name}"></a>
						</div>
						<div class="info">
							<div class="title">
								<a href="#">${name}</a>
							</div>
							<div class="des">
								${info}
							</div>
							<div class="createDate">
								<i class="fa fa-calendar" aria-hidden="true"></i>
								${created_at}
							</div>
						</div>
					</div>
					<div class="menuBox">
						<div class="editBtn left">
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
						</div>
						<div class="options left">
							<div class="btn btn-sm btn-danger delete">삭제 <i class="fa fa-trash"></i></div>
							<div class="btn btn-sm btn-primary htmlDownload">html 다운로드 <i class="fa fa-download"></i></div>
							<div class="btn btn-sm btn-primary thumbDownload">썸네일 다운로드 <i class="fa fa-download"></i></div>
						</div>
					</div>
				</div>
			`;
		};

		this.sortItemList = function( itemList ) {
			itemList.sort(( a, b ) => {
				if ( sort.val() == 'created_at' ) {
					a = a.saveTime;
					b = b.saveTime;
				}

				if ( sort.val() == 'name' ) {
					a = a.name;
					b = b.name;
				}

				if ( order.val() == 'desc' ) {
					return a < b ? 1 : -1;
				} else {
					return a < b ? -1 : 1;
				}
			});

			return itemList;
		};

		this.downloadHTML = ( href, name ) => {
			let link = document.createElement('a');

			link.setAttribute('href', href);
			link.setAttribute('download', name);

			document.body.appendChild( link );

			link.click();
			link.remove();
		};

		this.setItemList = () => {
			listBox.empty();

			db.getAll().then(( itemList ) => {
				console.log(itemList);
				itemList = this.sortItemList( itemList );

				for ( let i = 0; i < itemList.length; i++ ) {
					let item = itemList[ i ];
					let img = this.getImage( item.html, item.height );
					let html = this.getItemHTML( item.idx, img, item.name, item.info, item.created_at );

					listBox.append( html );
				}

				let list = listBox.find('.list');

				list.find('.editBtn').on('click', (ev) => {
					let idx = parseInt($(ev.target).parents('.list').attr("data-idx"));

					db.get( idx ).then(( item ) => {
						modify = item;

						back.append( item.html );

						let div = back.find('*[data-type]');

						for ( let j = 0; j < div.length; j++ ) {
							let type = div.eq( j ).attr('data-type');
							let elem = new __Element({html: div[ j ], type: type});

							makeContent.append( elem.elem );
						}

						this.showWeb();
						back.empty();
					});
				});

				list.find('.delete').on('click', (ev) => {
					let idx = parseInt($(ev.target).parents('.list').attr("data-idx"));

					db.delete( idx );

					this.setItemList();
				});

				list.find('.htmlDownload').on('click', (ev) => {
					let idx = parseInt($(ev.target).parents('.list').attr("data-idx"));

					db.get( idx ).then(( item ) => {
						console.log( item );
						let href = 'data:text/html;charset=utf-8,' + encodeURIComponent( item.html );
						let name = item.name;

						this.downloadHTML( href, name );
					});
				});

				list.find('.thumbDownload').on('click', (ev) => {
					let img = $(ev.target).parents('.list').find('img')[ 0 ];

					let canvas = document.createElement('canvas');
					canvas.width = 400;
					canvas.height = 225;
					let ctx = canvas.getContext('2d');

					ctx.drawImage( img, 0, 0, 400, 225 );

					this.downloadHTML( canvas.toDataURL(), 'thumbnail' );
				});
			});
		};

		/* ############################################################################################### */
		/* event method
		/* ############################################################################################### */
		this.startWeb = () => {
			let height = parseInt(prompt('height을 입력해주세요'));

			if ( height > 0 ) {
				makeContent.css({height: height});
				this.showWeb();
			} 
		};

		this.showWeb = () => {
			start.hide();
			makeView.show();
		};

		this.hideWeb = () => {
			start.show();
			makeView.hide();

			this.clearWeb();
		};

		this.clearWeb = () => {
			makeContent.empty();
		};

		this.showSaveList = () => {
			saveList.css({right: 0});
		};

		this.hideSaveList = () => {
			saveList.css({right: -500});
		};

		this.showPopup = () => {
			popup.show();
			back.show();
		};

		this.hidePopup = () => {
			popup.hide();
			back.hide();

			this.clearPopup();
		};

		this.clearPopup = () => {
			popup.find('input').val('');
		};

		this.savePopup = () => {
			let name = popup.find('input').eq(0).val();
			let html = makeContent.html();
			let info = popup.find('input').eq(1).val();
			let height = parseInt(makeContent.css('height'));
			let date = this.getDate();

			db.add({
				name: name,
				info: info,
				html: html,
				height: height,
				created_at: date,
				saveTime: Date.now(),
			});

			app.setItemList();

			this.hidePopup();
		};

		this.onDocKeyDown = ( ev ) => {
			if ( ev.key == 'Tab' || ev.keyCode == 9 ) {
				this.toggleLeftMenu();
				return false;
			}

			if ( ev.key == 'Escape' || ev.keyCode == 27 ) {
				elOption.hide();
			}
		};

		this.toggleLeftMenu = () => {
			let left = parseInt(leftMenu.css("left"));

			leftMenu.css({left: left < 0 ? 0 : -100});
		};

		this.menuRoute = ( ev ) => {
			elOption.hide();

			let elem = $(ev.target).hasClass('btnBlock') ? $(ev.target) : $(ev.target).parent();
			let index = elem.index();

			this.offContentEvent();

			btnBlock.removeAttr('style');

			if ( index > 0 && index < 5 ) {
				elem.css('opacity', 0.5);
			}

			switch ( index ) {
				// 홈
				case 0:
					modify = null;
					this.hideWeb();
					break;

				// 이동
				case 1:
					makeContent.attr('area-draggable', true);
					break;

				// 텍스트
				case 2:
					makeContent.find('div[data-type="text"]').attr('contenteditable', true);
					makeContent.attr('create-text', true);
					break;

				// 도형
				case 3:
					makeContent.attr("create-shape", true);
					break;

				// 편집
				case 4:
					makeContent.attr('area-crop', true);
					makeContent.find('div[data-type="shape"]').css('resize', 'auto');
					break;

				// 저장
				case 5:
					if ( modify ) {
						html = makeContent.html();

						db.put({
							idx: modify.idx,
							name: modify.name,
							info: modify.info,
							html: html,
							height: modify.height,
							created_at: modify.created_at,
							saveTime: modify.saveTime,
						});

						this.setItemList();
					} else {
						this.showPopup();
					}
					break;

				// 삭제
				case 6:
					this.clearWeb();
					break;
			}
		}

		this.onContentDown = ( ev ) => {
			if ( ev.originalEvent.which == 1 ) {
				if ( makeContent.attr('create-shape') == 'true' ) {
					shape = new __Element({type: 'shape'});
					shape.posX = ev.pageX;
					shape.posY = ev.pageY;

					makeContent.append( shape.elem );
				}

				if ( makeContent.attr('create-text') == 'true' ) {
					ev.preventDefault();
					ev.stopPropagation(); 

					text = new __Element({type: 'text'});

					text.elem.css({left: ev.pageX, top: ev.pageY});

					makeContent.append( text.elem );

					text.elem.focus();
				}
			}
		};

		this.onContentMove = ( ev ) => {
			if ( shape ) {
				let width, height, left, top;

				if ( shape.posX < ev.pageX ) {
					width = ev.pageX - shape.posX;
					left = shape.posX;
				} else {
					width = shape.posX - ev.pageX;
					left = ev.pageX;
				}

				if ( shape.posY < ev.pageY ) {
					height = ev.pageY - shape.posY;
					top = shape.posY;
				} else {
					height = shape.posY - ev.pageY;
					top = ev.pageY;
				}

				shape.elem.css({left: left, top: top, width: width, height: height});
			}
		};

		this.onDocMouseUp = ( ev ) => {
			shape = null;
			text = null;
		};

		this.onContentDragOver = ( ev ) => {
			ev.preventDefault();
		};

		this.onContentDrop = ( ev ) => {
			ev.preventDefault();

			let files = ev.originalEvent.dataTransfer.files;

			if ( files.length > 0 ) {
				let file = files[ 0 ];
				let reader = new FileReader();

				reader.readAsDataURL( file );

				reader.onload = function( rs ) {
					let img = new Image();
					img.src = rs.target.result;

					img.onload = function() {
						let imgElem = new __Element({html: `<img src=${rs.target.result}>`, type: 'image'});

						imgElem.elem.css({left: ev.pageX, top: ev.pageY});

						makeContent.append( imgElem.elem );
					};

					img.onerror = function() {
						alert('이미지가 아닙니다. 이미지를 드랍해주세요.');
					};
				};
			} else {
				alert('이미지가 아닙니다. 이미지를 드랍해주세요.');
			}
		}

		this.getColorData = ( color ) => {
			return color.split( ',' ).map(( a ) => {
				return a.replace(/[^0-9.]/g, '');
			});
		};

		this.clearElOption = () => {
			elShapeBox.css('backgroundColor', 'white');
			elTextBox.css('backgroundColor', 'white');
		};

		this.setGradient = ( ev ) => {
			let elem = makeContent.find('div[area-selectable="true"]');
			let type = elem.attr('data-type');
			let colorData = elCanvas.getColorData( ev.offsetX, ev.offsetY );
			let alpha = elAlpha.val();
			let color = elCanvas.getRgba( colorData, alpha );

			if ( type == 'text' ) {
				if ( elOption.attr("change-color") == 'true' ) {
					document.execCommand('styleWithCSS', false, true);
					document.execCommand('foreColor', false, color);
					elTextBox.eq( 0 ).find('.currentColor').css('backgroundColor', color);
				}
			}

			if ( type == 'shape' ) {
				if ( elOption.attr('change-bg') == 'true' ) {
					elem.css('backgroundColor', color);
					elShapeBox.eq( 0 ).find('.currentColor').css('backgroundColor', color);
				}

				if ( elOption.attr('change-border') == 'true' ) {
					elem.css('borderColor', color);
					elShapeBox.eq( 1 ).find('.currentColor').css('backgroundColor', color);
				}
			}
		};

		this.setElBox = ( ev ) => {
			let elem = $(ev.target).hasClass('box') ? $(ev.target) : $(ev.target).parent();
			let index = elem.index();

			this.offElOption();
			this.clearElOption();

			if ( index == 0 || index == 1 || index == 3 ) {
				elem.css('backgroundColor', '#ddd');
			} 

			switch ( index ) {
				case 0:
					elOption.attr('change-bg', true);
					break;
				case 1:
					elOption.attr('change-border', true);
					break;

				case 3:
					elOption.attr('change-color', true);
					break;
			}
		};

		this.changeColor = ( ev ) => {
			let color = elColor.val();

			elCanvas.setGradient( color );
		};

		this.changeAlpha = ( ev ) => {
			let elem = makeContent.find('div[area-selectable="true"]');
			let alpha = elAlpha.val();

			if ( elOption.attr('change-bg') == 'true' ) {
				let bgColor = elem.css('backgroundColor');
				let colorData = this.getColorData( bgColor );
				let color = elCanvas.getRgba( colorData, alpha );

				elem.css('backgroundColor', color);
				elShapeBox.eq( 0 ).find('.currentColor').css('backgroundColor', color);
			}

			if ( elOption.attr('change-border') == 'true' ) {
				let bgColor = elem.css('borderColor');
				let colorData = this.getColorData( bgColor );
				let color = elCanvas.getRgba( colorData, alpha );

				elem.css('borderColor', color);
				elShapeBox.eq( 1 ).find('.currentColor').css('backgroundColor', color);
			}

			if ( elOption.attr('change-color') == 'true' ) {
				let bgColor = elTextBox.eq( 0 ).find('.currentColor').css('backgroundColor');
				let colorData = this.getColorData( bgColor );
				let color = elCanvas.getRgba( colorData, alpha );

				document.execCommand('styleWithCSS', false, true);
				document.execCommand('foreColor', false, color);
				elTextBox.eq( 0 ).find('.currentColor').css('backgroundColor', color);
			}
		};

		this.changeBorder = ( ev ) => {
			let elem = makeContent.find('div[area-selectable="true"]');
			let borderWidth = elBorder.val();

			console.log(borderWidth);

			if ( elem ) {
				elem.css('borderWidth', borderWidth);
			}
		};

		this.changeFont = ( ev ) => {
			let fontSize = parseInt(elFont.val());

			document.execCommand( 'fontSize', false, fontSize);
		};

		this.createLink = ( ev ) => {
			let link = prompt('링크를 입력해주세요.');

			if ( link != null ) {
				document.execCommand( 'createLink', false, link );
				makeContent.find('a').attr('target', '_blank');
			}
		};

		this.unlink = ( ev ) => {
			document.execCommand( 'unlink' );
		};
	};

	/* ############################################################################################### */
	/* return app 																					   
	/* ############################################################################################### */
	app = new __App();

	return app;
};

/**
 * 	window load
 */
window.onload = function() {
	let app = new App();
	app.init();
};