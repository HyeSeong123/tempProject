SDE.View.ButtonManager = function() {
    var SELECTOR = {
        LOGIN : '#container .login button',
        CONTROL : '#container .control button',
        BTN : '#container .btn button',
        ALL : '#container .menu button',
        DEVICES : '#container .deviceList a',
        btnHttpReplace: '#container .util button.httpReplace'
    };
    
    var currentUrl, 
        currentMode,
        currentUrlData = {},
        listTreeLayer, 
        recentSourceLayer,
        moduleAddLayer,
        httpReplaceLayer,
        isPreviewClicked = false,
        previewUrl,
        mobilePreviewResolution = [320,480],
        loginData = {};
    
    /**
     * Private Method
     */

    var afterLogin = function() {
        setLoginSelected('after');
        
        SDE.View.Manager.setLoginMode('after');
    };
    
    var beforeLogin = function() {
        setLoginSelected('before');
        
        SDE.View.Manager.setLoginMode('before');
    };
    
    var close = function() {
        SDE.File.Manager.close(currentUrl);
    };
    
    var closeAll = function() {
        SDE.File.Manager.closeAll();
    };

    var remove = function() {
        SDE.File.Manager.remove(currentUrl);
    };
    
    var history = function() {
        SDE.List.History.Controller.toggle();
    };
    
    var moduleAdd = function() {
        if (!moduleAddLayer) moduleAddLayer = new SDE.Layer.Editing();
        
        moduleAddLayer.show(null, null, 'module');
    };

    // 에디터 우상단 https 변경 버튼
    var httpReplace = function () {
        if (!httpReplaceLayer) {
            httpReplaceLayer = new SDE.Layer.HttpReplace();
        }

        httpReplaceLayer.show();
    };

    var preview = function() {
        //if (SDE.EDITOR_TYPE == 'mobile' && $.browser.msie) {
        //    alert('미리보기는 Internet Explorer에서 지원되지 않습니다.\n크롬이나 사파리, 오페라 브라우저를 이용해주세요');
        //    return;
        //}

        //isPreviewClicked = true;

        SDE.File.Manager.saveTemp(currentUrl);
    };

    var devicePreviewList = function(evt) {
        if (SDE.mo() && document.documentMode && document.documentMode < 10) {
            alert(__('SUPPORTED.THIS.BROWSER.ACCESS', 'EDITOR.VIEW.BUTTON.MANAGER'));
            return;
        }
        if ($('#container .deviceList').filter(":visible").length) {
            $('#container .deviceList').hide();
            $(document.body).unbind('click', devicePreviewList);
        } else {
            $('#container .deviceList').show();
            $(document.body).bind('click', devicePreviewList);
        }
        evt.stopPropagation();
        return false;
    };

    var onClickDevice = function(evt) {
        mobilePreviewResolution = $(evt.target).closest("li").attr("data-resolution").split(",");
        isPreviewClicked = true;

        if (mobilePreviewResolution[0] <= 320) mobilePreviewResolution[0] = 340;
        window.open('//' + location.host + $(".mobile .content .previewArea").attr("src"), "mobile_preview","toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,width="+mobilePreviewResolution[0]+",height="+mobilePreviewResolution[1]+"");

        return false;
    };
    
    var recentSource = function() {
        if (!recentSourceLayer) recentSourceLayer = new SDE.Layer.RecentSource();
        
        recentSourceLayer.show(currentUrl);
    };
    
    var reset = function() {
        if (!confirm(__('WANT.ORIGINAL.FILE.STATE', 'EDITOR.VIEW.BUTTON.MANAGER'))) {
            return;
        }
        
        SDE.File.Manager.reset(currentUrl);
    };

    var replaceAll = function() {
        SDE.View.Manager.replaceAll(currentMode);
    };

    var save = function() {
        SDE.File.Manager.save(currentUrl);
    };
    
    var saveAll = function() {
        SDE.File.Manager.saveAll();
    };
    
    var saveAs = function() {
        if (!listTreeLayer) listTreeLayer = new SDE.Layer.ListTree();
        
        listTreeLayer.saveAs();
    };
    
    var setLoginSelected = function(mode) {
        var $login = $(SELECTOR.LOGIN);
        
        mode = mode || null;
        
        $login.removeClass('selected');
        
        $login[currentUrl.indexOf('.html') != -1 ? 'show' : 'hide']();
        
        if (!mode) return;
        
        $login.closest('.' + mode).addClass('selected');
        
        loginData[currentUrl] = mode;
    };
    
    var _setDisabled = function(type, isSet) {
        if (typeof type == 'object') {
            for (var i in type) {
                arguments.callee(type[i], isSet);
            }
            
            return;
        }

        $(SELECTOR.ALL + '.' + type)[isSet ? 'addClass' : 'removeClass']('disabled');
    };
    
    var setDisabled = function() {
        if (!currentUrl) return;
        
        var isHtmlFile = (currentUrl.indexOf('.html') != -1);

        _setDisabled('save', currentUrlData.readonly);
        _setDisabled('preview', (SDE.EDITOR_TYPE != 'mobile' && currentMode == 'source') || !isHtmlFile);
        _setDisabled('module', currentMode == 'preview' || !isHtmlFile || currentUrlData.readonly === true);
        _setDisabled('recent', (!SDE.HAS_RECENT_FILE || currentUrlData.readonly === true || currentUrlData.recent === false));
        _setDisabled('delete', (currentUrlData.desc || currentUrlData.readonly === true) ? true : false);
        _setDisabled('httpReplace', currentUrlData.readonly);
    };
    
    //var openMobilePreview = function(url) {
    //};
    /**
     * Event Listener
     */
    
    var onClickButton = function(evt) {
        $target = $(evt.currentTarget);

        try {
            var fn = eval($target.data('type'));
        } catch (e) { return; }

        if ($target.hasClass('disabled') || !currentUrl || typeof fn != 'function') return;

        fn.call(null, evt);
    };
    
    var onFileOpen = function(evt, url, data) {
        currentUrl = url;
        currentUrlData = data;
        
        // 로그인 선택 처리
        setLoginSelected(loginData[currentUrl] || 'before');
        
        // 미리보기, 모듈 추가 사용 여부 처리
        setDisabled();
    };
    
    var onFileClose = function(evt, url, remainCount) {
        if (url == currentUrl) setLoginSelected();
        
         loginData[currentUrl] = currentUrl = null;
         currentUrlData = {};
        
        if (remainCount != 0) return;
    };
    
    var onFileCloseAll = function() {
        currentUrl = null;
        loginData = {};
        currentUrlData = {};
    };

    var onFileSaveTemp = function(evt, url, data) {

        if (url != currentUrl || SDE.EDITOR_TYPE != 'mobile' || !isPreviewClicked) return;

        // 모바일 미리보기 팝업 열기
        //window.open('http://' + location.host + data.previewUrl + '?PREVIEW_SDE=1', "mobile_preview","toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,width=320,height=480");
        isPreviewClicked = false;
    };

    var onViewModeChange = function(evt, mode) {
        currentMode = mode;
        setDisabled();

        if (currentMode === 'preview') {
            $(SELECTOR.BTN + '.replace').addClass('disabled');
            $(SELECTOR.BTN + '.replace').removeClass('selected');
        } else {
            $(SELECTOR.BTN + '.replace').removeClass('disabled');
        }
    };
    
    /**
     * Public Method
     */
    return {
        init : function() {
            var aOnClickButtons = [
                SELECTOR.LOGIN,
                SELECTOR.CONTROL,
                SELECTOR.BTN,
                SELECTOR.btnHttpReplace
            ];

            $(aOnClickButtons.join(',')).click($.proxy(onClickButton, this));
            $(SELECTOR.DEVICES).click($.proxy(onClickDevice, this));

            SDE.BroadCastManager.listen({
                'file-open' : $.proxy(onFileOpen, this),
                'file-close' : $.proxy(onFileClose, this),
                'file-close-all' : $.proxy(onFileCloseAll, this),
                'file-save-temp' : $.proxy(onFileSaveTemp, this),
                'view-mode-change' : $.proxy(onViewModeChange, this)
            });
        }
    };
}();


/**
 * 화면, 분할, 소스 보기 관리
 *
 * dependency : SDE.View.Screen, SDE.View.Source
 */

SDE.View.Manager = function() {
    var BUTTON_SELECTOR = '#viewModeChange button',
        BUTTON_ZOOM_CTRLSECTION_SELECTOR = '.codeArea',
        BUTTON_ZOOM_SELECTOR = '.codeArea .ctrlSection .control>li',
        MODE_COOKIE_NAME = '_sde_view_mode',
        SIZE_COOKIE_NAME = '_sde_view_size';

    var isInitialized = false, isFileNotOpened = false,
        currentMode,
        preview, source, bar, replacer;

    var change = function(mode, $btn) {
        if (isFileNotOpened) return;

        var $btn = $btn || $(BUTTON_SELECTOR +'[data-mode='+ mode +']');

        $(BUTTON_SELECTOR).removeClass('selected');

        $btn.addClass('selected');

        var $buttonAssist = $(BUTTON_ZOOM_SELECTOR).show();
        if (mode == "preview") {
            $buttonAssist.filter(".reduction").hide();
            $(BUTTON_ZOOM_CTRLSECTION_SELECTOR).addClass("deselected");
        } else {
            $(BUTTON_ZOOM_CTRLSECTION_SELECTOR).removeClass("deselected");
        }
        if (mode == "source") {
            $buttonAssist.filter(".expand").hide();
        }

        currentMode = mode;

        $.cookie(SDE.EDITOR_TYPE + MODE_COOKIE_NAME, currentMode, { expires : 365 });

        var fn = {
            'preview' : changeToPreview,
            'half' : changeToHalf,
            'source' : changeToSource
        };

        fn[mode].call();

        SDE.BroadCastManager.send('view-mode-change', mode);
    };

    var changeToPreview = function() {
        if (SDE.mo()) {
            preview.setMode('half');
            source.setMode('hidden');
            bar.setMode('half');
            replacer.setMode('hidden');
        } else {
            preview.setMode('full');
            source.setMode('hidden');
            bar.setMode('hidden');
            replacer.setMode('hidden');
        }
    };

    var changeToHalf = function() {
        preview.setMode('half');
        source.setMode('half');
        bar.setMode('half');

        if (replacer.isVisible() === true) {
            replacer.setMode('show')
        } else {
            replacer.setMode('hidden');
            replacer.clear();
        }
    };

    var changeToSource = function() {
        preview.setMode('hidden');
        source.setMode('full');
        bar.setMode('hidden');

        if (replacer.isVisible() === true) {
            replacer.setMode('show')
        } else {
            replacer.setMode('hidden');
            replacer.clear();
        }
    };

    var init = function(mode) {
        isInitialized = true;

        preview = new SDE.View.Preview();
        bar = new SDE.View.Bar();
        source = new SDE.View.Source();
        replacer = new SDE.View.Replacer();

        $(BUTTON_ZOOM_SELECTOR).click($.proxy(onModeChangeByAssist, this));
        $(BUTTON_SELECTOR).click($.proxy(onModeChange, this));
        $(bar).bind('drag', $.proxy(onDragBar, this));

        SDE.BroadCastManager.listen({
            'file-open' : onFileOpen,
            'file-close' : onFileClose,
            'file-close-all' : onFileCloseAll,
            'file-remove' : onFileRemove
        });

        /*rev.b10.20130828.4@sinseki #SDE-1: 편집창 초기 80%:20%*/
        var $usermode = $.cookie(SDE.EDITOR_TYPE + MODE_COOKIE_NAME);
        mode = mode || $usermode || 'half';

        if (SDE.mo() && document.documentMode && document.documentMode < 10) {
            mode = 'source';
        }

        change(mode);

        ("half" == mode) && onDragBar(null, ($usermode? $.cookie(SDE.EDITOR_TYPE + SIZE_COOKIE_NAME): 0) || SDE.mo() ? 340 : "80%");
    };

    var onModeChangeByAssist = function(evt) {
        if (SDE.mo() && document.documentMode && document.documentMode < 10) {
            alert(__('SUPPORTED.THIS.BROWSER', 'EDITOR.VIEW.MANAGER'));
            return;
        }

        var displaylist = ["preview","half","source"];
        var index = 0;
        $.each(displaylist,function(i,item){if (currentMode == item) index = i;});
        var newindex = Math.max(Math.min(index + ($(evt.currentTarget).data("cmd") == "expand"? 1: -1),displaylist.length-1),0);
        change(displaylist[newindex]);
    };

    var onModeChange = function(evt) {
        if (SDE.mo() && document.documentMode && document.documentMode < 10) {
            alert(__('SUPPORTED.THIS.BROWSER', 'EDITOR.VIEW.MANAGER'));
            return;
        }
        var $btn = $(evt.currentTarget),
            mode = $btn.data('mode');

        change(mode, $btn);
    };

    var onDragBar = function(evt, base) {
        /*rev.b7.20130828.1@sinseki #SDE-1: 편집창 초기 80%:20%*/
        $.cookie(SDE.EDITOR_TYPE + SIZE_COOKIE_NAME, base, { expires : 365 });
        preview.setSize(base);
        source.setSize(base);
    };

    var onFileOpen = function(evt) {
        if (!isFileNotOpened) return;

        isFileNotOpened = false;
        change(currentMode);
    };

    var onFileClose = function(evt, url, remainCount) {
        if (remainCount != 0) return;

        isFileNotOpened = true;
        changeToPreview();
    };

    var onFileCloseAll = function(evt) {
        isFileNotOpened = true;
        changeToPreview();
    };

    var onFileRemove = function(evt, url, remainCount) {
        if (remainCount != 0) return;

        isFileNotOpened = true;
        changeToPreview();
    };

    return {
        init : function(mode) {
            if (isInitialized === true) return;

            init(mode);
        },

        change : function(mode) {
            if (isInitialized === false) return;

            if (currentMode == mode) return;

            change(mode);
        },

        setLoginMode : function(mode) {
            preview.setLoginMode(mode);
        },

        getPreviewWindow : function() {
            /*rev$@sinseki #SDE-9 프리뷰로딩시 완료 전까지 화면 클릭못하게 최상단 패널 추가*/
            return preview.$view.find("iframe").attr('contentWindow');
        },

        replaceAll: function(mode) {
            if (mode == 'preview') return;
            replacer.display();
        }
    };
}();
SDE.View.Screen = Class.extend({
    TEMPLATE : '', // have to override
    CONTAINER_SELECTOR : '#container > .content',
    HEADER_SELECTOR : '#container > .subHeader',
    FOOTER_SELECTOR : '#container > .subFooter',

    $view : null,

    currentUrl : null,

    mode : null,

    lastBase : null,

    hide : function() {
        this.$view.hide();
    },

    init : function() {
        this.render();

        SDE.BroadCastManager.listen({
            'file-open' : $.proxy(this.onFileOpen, this),
            'file-close' : $.proxy(this.onFileClose, this),
            'file-close-all' : $.proxy(this.onFileCloseAll, this),
            'file-save' : $.proxy(this.onFileSave, this),
            'file-save-all' : $.proxy(this.onFileSaveAll, this),
            'file-remove' : $.proxy(this.onFileRemove, this),
            'window-resize' : $.proxy(this.onWindowResize, this)
        });
    },

    render : function() {
        if (this.$view) this.remove();

        this.$view = $(this.TEMPLATE).appendTo($(this.CONTAINER_SELECTOR));
    },

    remove : function() {
        this.$view.remove();
    },

    show : function() {
        this.$view.show();
    },

    //hide : function() {
    //    this.$view.css('display', 'none');
    //},

    setSize : function(base) {
        if (SDE.mo()) {
            if (this.POSITION == 'bottom') {
                if (this.mode == 'hidden') {
                    this.$view.css('margin-left', "100%");
                }
                if (this.mode == 'full') {
                    this.$view.css('margin-left', "");
                }
            }
        } else {
            if (this.POSITION == 'bottom') {
                this.$view.css('margin-top', 0);
            }
            if (this.mode == 'hidden') return;
        }

        var windowHeight = $(window).height(),
            headerHeight = $(this.HEADER_SELECTOR).outerHeight(true),
            footerHeight = $(this.FOOTER_SELECTOR).outerHeight(true),
            height = windowHeight - headerHeight - footerHeight,
            base = base || this.lastBase;

        if (this.mode == 'half') {
            if (base) {
                /*rev.b4.20130812.1@sinseki #SDE-1: 편집창 초기 80%:20%*/
                if (/%$/.test(base)) {
                    base = height * parseInt(base) / 100;
                }
                if (!SDE.mo()) {
                    if (base > height- 30) base = height- 30;
                }
                height = (this.POSITION == 'top' ? base : height - base - (SDE.mo()? 15: 14));
            } else {
                if (!SDE.mo()) height-= 14;

                height /= 2;
            }
        }

        if (SDE.mo()) {
            $(".mobile .content .previewArea").css("overflow","hidden");
            if (this.POSITION == 'top') {
                this.$view.css('float', "left");
            }

            if (this.mode == 'half' && this.POSITION == 'top') {
                this.$view.css('width', base||340);
            }
            if (this.POSITION == 'bottom') {
                if (this.mode == 'half') {
                    this.$view.css('margin-left', (base || 340) + 15);
                }
            }

            this.$view.css('height', windowHeight - headerHeight - footerHeight);
        } else {
            if (this.POSITION == 'top') {
                this.$view.css('margin-top', 0);
                this.$view.css('height', height + (this.mode == 'full'? -30: 0));
            } else {
                if (this.mode == 'half') {
                    this.$view.css('margin-top', 14);
                    this.$view.css('height', height);
                } else {
                    this.$view.css('height', height);
                }
            }
        }

        // replacer 템플릿의 경우에는 36px로 높이 재변경
        if (this.$view.hasClass('replaceArea')) {
            this.$view.css('height', 36);
        }

        this.lastBase = base;
        this.lastWindowHeight = windowHeight;
    },

    setMode : function(mode) {
        this.mode = mode;

        this.setSize();

        (mode == 'hidden') ? this.hide() : this.show();
    },

    onWindowResize : function() {
        this.setSize();
    }
});
/**
 * TODO : 뭔가 구리다
 */
SDE.View.Preview = SDE.View.Screen.extend({
    //TEMPLATE : '<iframe class="previewArea" style="display:none" frameborder="0" scrolling="auto" width="100%"></iframe>',
    /*rev$@sinseki #SDE-9 프리뷰로딩시 완료 전까지 화면 클릭못하게 최상단 패널 추가*/
    TEMPLATE : '<div style="display:none;position:relative;"><iframe class="previewArea" frameborder="0" scrolling="auto" width="100%" height="100%"></iframe><div class="coverpanel" style="position:absolute;left:0;top:0;width:100%;height:100%;"></div></div>',

    EMPTY_TEMPLATE : '<div style="display:none; position:relative; overflow:hidden;"><div class="pageInfo type2"><p><img src="//img.echosting.cafe24.com/smartAdmin/img/editor/'+ EC_GLOBAL_INFO.getAdminLanguageCode() +'/txt-info2.gif" alt="'+ __('THERE.ARE.NO.OPEN.FILES', 'EDITOR.VIEW.PREVIEW') +'"></p><p>'+ __('NAVIGATOR.SELECT.FILE', 'EDITOR.VIEW.PREVIEW') +'</p></div></div>',

    NO_PROVIDE_TEMPLATE : '<div style="display:none; position:relative;  overflow:hidden;"><div class="pageInfo type1"><p><img src="//img.echosting.cafe24.com/smartAdmin/img/editor/'+ EC_GLOBAL_INFO.getAdminLanguageCode() +'/txt-info1.gif" alt="'+ __('PROVIDE.PREVIEW.SCREEN', 'EDITOR.VIEW.PREVIEW') +'"></p></div></div>',

    NO_PROVIDE_FILES : [
        '/board/smartreview/read.html',
        '/board/smartreview/modify.html',
        '/board/smartreview/write.html',
        '/board/smartreview/review_popup.html',
        '/board/smartreview/notice.html',
        '/board/smartreview/zoom.html',
        '/board/smartreview/list/list_read.html'
    ],

    NO_PROVIDE_DIR : [
        '/board/smartreview/provider/'
    ],

    POSITION : 'top',

    URL_PARAMS : {
        'PREVIEW_SDE' : '1'
    },

    currentUrl : null,

    data : {},

    close : function(url, remain_count) {
        delete this.data[url];

        // 닫힌 탭이 현재 열린 View와 무관하면 무시
        if (this.currentUrl != url) return;

        SDE.LoadingIndicator.hide();

        // 남은 탭이 없을 때 Empty Template 출력
        if (remain_count == 0) {
            this.render('empty');
            this.show();
            return;
        }

        this.hide();
    },

    init : function() {
        this._super();

        SDE.BroadCastManager.listen('file-save-temp', $.proxy(this.onFileSaveTemp, this));
    },

    isMobileEditor : function() {
        //return SDE.EDITOR_TYPE == 'mobile';
        return false;
    },

    getTemplate : function(type) {
        type = (type == null) ? '' :  type + '_';

        return this[type.toUpperCase() + 'TEMPLATE'];
    },

    getCurrentUrl : function() {
        return this.data[this.currentUrl].previewUrl || this.currentUrl;
    },

    render : function(type) {
        if (this.$view) this.remove();

        this.$view = $(this.getTemplate(type));

        $(this.CONTAINER_SELECTOR).prepend(this.$view);

        this.setSize();
    },

    refresh : function() {
        /*rev.b4.20130902.4@sinseki #SDE-8 레이아웃 아닌 모듈/CSS/JS 파일 오픈시 프리뷰를 소스가 아닌 레이아웃을 띄우기*/
        this.open(this.data[this.currentUrl].originurl || this.getCurrentUrl(), this.data[this.currentUrl].params);
    },

    getType : function(url) {
        if (url.indexOf('.html') == -1) {
            return 'no_provide';
        }

        var aNoProvideDir = this.NO_PROVIDE_DIR;
        var iLen = aNoProvideDir.length;
        for (var i = 0; i < iLen; i++) {
            if (url.indexOf(aNoProvideDir[i]) == 0) {
                return 'no_provide';
            }
        }

        var aNoProvideFiles = this.NO_PROVIDE_FILES;

        // IE8이하 Array.indexOf 지원되지 않아 $.inArray로 대체
        if ($.inArray(url, aNoProvideFiles) > -1) {
            return 'no_provide';
        }

        return null;
    },

    open : function(url, params) {
        var type = this.getType(url);

        this.render(type);

        // html 파일이 아닌 경우, 안내 메세지 출력
        if (type) {
            SDE.LoadingIndicator.hide();

            (this.mode == 'hidden') ? this.hide() : this.show();

            return;
        }

        /*rev$@sinseki #SDE-9 프리뷰로딩시 완료 전까지 화면 클릭못하게 최상단 패널 추가*/
        this.$view.find("iframe").attr('src', this.setParams(url, params));

        this.$view.find("iframe").one('load', $.proxy(this.onPageLoad, this));

        if (this.mode != 'hidden') {
            SDE.LoadingIndicator.show();

            this.show();
        }
    },

    onFileOpen : function(evt, url, data, params) {
        this.currentUrl = url;

        if (!this.data[url]) this.data[url] = {};

        if (this.isMobileEditor()) return;

        var fileParams = (typeof params == 'object' && 'editorFile' in params) ? this._getQueryParams(params.editorFile) : {};
        params = $.extend({}, this.data[url].params, params, fileParams);

        /*rev.b6.20130902.1@sinseki #SDE-8 레이아웃 아닌 모듈/CSS/JS 파일 오픈시 프리뷰를 소스가 아닌 레이아웃을 띄우기*/
        this.data[url].originurl = data.originurl;
        this.data[url].readonly = data.readonly;
        this.open(data.originurl || this.getCurrentUrl(), params);
    },

    /**
     * 파일 모두 닫혔을 때 안내 메세지 표시
     */
    onFileCloseAll : function() {
        SDE.LoadingIndicator.hide();

        this.render('empty');
        this.show();

        this.data = {};
        this.currentUrl = null;
    },

    onFileClose : function(evt, url, remain_count) {
        this.close(url, remain_count);
    },

    onFileRemove : function(evt, url, remain_count) {
        this.close(url, remain_count);
    },

    onFileSave : function(evt, url) {
        if (this.currentUrl != url || this.isMobileEditor()) return;

        delete this.data[url].previewUrl;

        this.refresh();
    },

    onFileSaveAll : function(evt) {
        if (this.isMobileEditor()) return;

        delete this.data[this.currentUrl].previewUrl;

        this.refresh();
    },

    onFileSaveTemp : function(evt, url, data, params) {
        if (url.indexOf('.html') == -1) return;

        this.data[url].previewUrl = data.previewUrl;

        $.extend(this.data[url].params, params);

        this.refresh();
    },

    onPageLoad : function(evt) {
        SDE.LoadingIndicator.hide();
        /*rev$@sinseki #SDE-9 프리뷰로딩시 완료 전까지 화면 클릭못하게 최상단 패널 추가*/
        /*rev.b1.20130912.1@sinseki #SDE-29 모듈/CSS/JS 파일 오픈시 프리뷰 화면 클릭 오류*/
        if (!this.data[this.currentUrl].originurl && this.data[this.currentUrl].readonly === false) {
            this.$view.find(".coverpanel").hide();
        }
        // IE에서 iframe 페이지에서 resize가 있는 경우 height가 변경될 수 있으므로 다시 한번 설정
        if ($.browser.msie) this.setSize();
    },

    show : function() {
        this._super();
    },

    setLoginMode : function(mode) {
        var params;

        mode = (mode == 'after') ? 'On' : 'Off';

        params = $.extend({}, this.data[this.currentUrl].params, { 'LOGIN_SDE' : mode });

        this.open(this.getCurrentUrl(), params);
    },

    setParams : function(url, params) {
        var querys = [],
            params = $.extend({}, this.URL_PARAMS, params || {});

        for (var key in params) {
            querys.push(key + '=' + encodeURIComponent(params[key]));
        };

        // refresh를 위해 params 저장. 단 모듈 편집창 Open에 사용되는 파라미터는 제거
        delete params['key'];
        delete params['action'];
        this.data[this.currentUrl].params = params;

        return url + '?' + querys.join('&');
    },

    _getQueryParams : function(url) {
        var
        match,
        params = {},
        pl     = /\+/g,  // Regex for replacing addition symbol with a space
        search = /([^&=]+)=?([^&]*)/g,
        decode = function (s) { return unescape(s.replace(pl, " ")); };

        var key = url.indexOf('?');
        if (key > -1) {
            url = url.substr(url.indexOf('?'));
            var query = url.substring(1);

            while (match = search.exec(query))
                params[decode(match[1])] = decode(match[2]);
        }

        return params;
    }
});
SDE.View.Source = SDE.View.Screen.extend({
    TEMPLATE : '<div class="codeArea" style="">'+
                   '<div class="ctrlSection">'+
                       '<strong class="html">HTML</strong>\n'+
                       '<li class="readonly"></li>'+
                       '<ul class="control">'+
                           '<li class="reduction" data-cmd="reduction"><a href="#none"><span>'+ __('COLLAPSE', 'EDITOR.VIEW.SOURCE') +'</span></a></li>'+
                           '<li class="expand" data-cmd="expand"><a href="#none"><span>'+ __('CLICK.TO.ENLARGE', 'EDITOR.VIEW.SOURCE') +'</span></a></li>'+
                       '</ul>'+
                   '</div>'+
                   '<h2 class="objHidden">'+ __('HTML.SOURCE', 'EDITOR.VIEW.SOURCE') +'</h2>'+
                   '<div></div>'+
               '</div>',
    POSITION : 'bottom',

    init : function(data) {
        this._super(data);

        SDE.Editor.Pool.init(this.$view);
    },

    show : function() {
        this.$view.css('width', "");
        this._super();
        SDE.Editor.Pool.refresh();
    },

    hide : function() {

        if (SDE.mo()) {
            this.$view.css('width', "0");
        } else {
            this.$view.css('width', "100%");
            if (this.mode == 'hidden') {
                this.$view.css('height', 30);
            }
        }
        //this.$view.hide();
    },

    onFileOpen : function(evt, url, data, params) {
        var extension = (/[^\.]+$/.exec(url)||["html"])[0];
        this.$view.find(".ctrlSection > strong").removeClass("html css js").addClass(extension);
        this.$view.find(".ctrlSection > .readonly").text((data.readonly === true ? '['+ __('READ.ONLY', 'EDITOR.VIEW.SOURCE') +']' : ''));
    }
});
SDE.View.Bar = SDE.View.Screen.extend({
    //TEMPLATE : '<div class="divisionBar" style="display: block; "><strong><img src="//img.echosting.cafe24.com/smartAdmin/img/editor/txt-divisionBar.gif" alt="HTML 소스"></strong><p></p></div>',
    TEMPLATE : '<div class="divisionArea"><span>'+ __('HEIGHT.ADJUSTMENT', 'EDITOR.VIEW.BAR') +'</span></div>',

    init : function() {
        this._super();

        this.$view.draggable({
            containment : 'parent',
            iframeFix : true,
            cursor : (SDE.mo()) ? 'e-resize' : 's-resize',
            drag : $.proxy(this.onDrag, this)
        });
        if (SDE.mo()) {
            this.$view.css({cursor : 'e-resize'});
            this.$view.css('left', "340px");
        } else {
            this.$view.css({cursor : 's-resize'});
            this.$view.css('margin-bottom', 30);
        }
    },

    setSize : function() {
        this.$view.css('position', 'absolute');
        if (SDE.mo()) {
            this.$view.css('top', 0);
        } else {
            this.$view.css('top', this.$view.prev().height());
        }
    },

    getTop : function() {
        return parseInt(this.$view.css('top').replace('px', ''), 10);
    },

    getLeft : function() {
        return parseInt(this.$view.css('left').replace('px', ''), 10);
    },

    onDrag : function(evt) {
        if (SDE.mo()) {
            $(this).trigger('drag', [this.getLeft()]);
        } else {
            $(this).trigger('drag', [this.getTop()]);
        }
        this.$view.css('top', 0);
        
        // Editor 사이즈 변경시 편집창 리프레쉬
        SDE.Editor.Pool.refresh();
    }
});
SDE.View.Replacer = SDE.View.Screen.extend({
    /**
     * 치환 영역 템플릿 정의
     */
    TEMPLATE : '<div class="replaceArea" style="display: none;">'+
                    '<ul class="editor">'+
                        '<div class="inputBox">'+
                            '<textarea rows="1" cols="10" placeholder="'+ __('WHAT.TO.LOOK.FOR', 'EDITOR.VIEW.REPLACER') +'" name="find_text"></textarea>'+
                        '</div>'+
                        '<div class="inputBox">'+
                            '<textarea rows="1" cols="10" placeholder="'+ __('WHAT.TO.CHANGE', 'EDITOR.VIEW.REPLACER') +'" name="replace_text"></textarea>'+
                        '</div>'+
                        '<a href="#none" class="button all" id="replaceAll">'+ __('MAKE.BULK.CHANGES', 'EDITOR.VIEW.REPLACER') +'</a>'+
                    '</ul>'+
                    '<dl class="setting">'+
                        '<dt>'+ __('RANGE', 'EDITOR.VIEW.REPLACER') +'</dt>'+
                        '<dd>'+
                            '<label><input type="radio" name="replace_scope" value="C" /> '+ __('CURRENT.FILE', 'EDITOR.VIEW.REPLACER') +'</label>'+
                            '<label><input type="radio" name="replace_scope" value="A" /> '+ __('ALL.OPEN.FILES', 'EDITOR.VIEW.REPLACER') +'</label>'+
                        '</dd>'+
                        '<dt>'+ __('OPTION', 'EDITOR.VIEW.REPLACER') +'</dt>'+
                        '<dd>'+
                            '<label><input type="checkbox" name="match_case" /> '+ __('CASE.SENSITIVITY', 'EDITOR.VIEW.REPLACER') +'</label>'+
                        '</dd>'+
                    '</dl>'+
                    '<div class="cTip" code="DE.DI.DX.110"></div>'+
                    '<button type="button" class="btnClose">'+ __('CLOSE', 'EDITOR.VIEW.REPLACER') +'</button>'+
                '</div>',

    REPLACE_BUTTON_SELECTOR : '#container .btn button.replace',

    /**
     * 이벤트 핸들러 컬렉션 객체
     */
    oEventHandler : {
        /**
         * 도움말 버튼을 클릭 했을때의 이벤트 핸들러 (suio.js 참고)
         * @param e
         */
        setTooltipToggleClick : function (e) {
            var findSection = $(this).parents('.section:first'),
                findTarget = $($(this).siblings('.tooltip')),
                findTooltip = $('.tooltip'),
                findHover = $(this).hasClass('eTipHover'),
                findShow = $(this).parents('.mTooltip:first').hasClass('show');

            if (findShow && !findHover) {
                $('.mTooltip').removeClass('show');
                findTarget.hide();
                findSection.css({
                    'zIndex': 0,
                    'position': 'static'
                });
            } else {
                $('.mTooltip').removeClass('show');
                $(this).parents('.mTooltip:first').addClass('show');
                findSection.css({
                    'zIndex': 0,
                    'position': 'static'
                });
                findSection.css({
                    'zIndex': 100,
                    'position': 'relative'
                });

                // 툴팁의 넓이 + offset좌표 의 값이 body태그의 width보다 클때 좌표값 왼쪽으로 이동
                var bodyWidth = $('body').width(),
                    targetWidth = findTarget.outerWidth(),
                    offsetLeft = $(this).offset().left,
                    posWidth = targetWidth + offsetLeft;

                if (bodyWidth < posWidth) {
                    findTarget.addClass('posRight').css({
                        'marginLeft': '-' + targetWidth + 'px'
                    });
                } else {
                    findTarget.removeClass('posRight').css({
                        'marginLeft': 0
                    });
                }
                findTooltip.hide();
                findTarget.show();

                if ($('#tooltipSCrollView').length > 0) {
                    $('#tooltipSCrollView').remove();
                }
            }
            e.preventDefault();
        },

        /**
         * 도움말의 X 버튼을 클릭 했을때의 이벤트 핸들러 (suio.js 참고)
         * @param e
         */
        setTooltipCloseClick : function (e) {
            // 동적
            if ($(this).parents('.mTooltip:first').attr('virtual')) {
                $('#tooltipSCrollView').remove();
            } else {
                var findSection = $(this).parents('.section:first');
                var findTarget = $(this).parents('.tooltip:first');
                findTarget.hide();
                findSection.css({
                    'zIndex': 0,
                    'position': 'static'
                });
            }
            $('.mTooltip').removeClass('show');
            e.preventDefault();
        },

        /**
         * 치환 영역 템플릿의 X 버튼을 클릭 했을때의 이벤트 핸들러
         */
        setReplacerCloseClick : function () {
            $('p.btn > .replace').trigger('click');
        },
        
        /**
         * 모두 바꾸기 버튼 클릭 했을때의 이벤트 핸들러
         */
        setReplaceAllClick : function (event) {
            event.preventDefault();

            if (this.checkValidation() === false) return;

            var sRegExp = this.getRegExp();
            var oEditorPools = SDE.Editor.Pool.getPools();
            var sReplaceScope = $(':radio[name="replace_scope"]:checked').val();
            var sCurrentUrl = SDE.Editor.Pool.getCurrentUrl();
            
            // 범위가 현재파일 일때, 현재파일이 읽기전용인지 확인
            if (sReplaceScope == 'C') {
                if (SDE.Editor.Pool.isReadonly(sCurrentUrl) === true) {
                    alert(__('FILE.READONLY.FILE', 'EDITOR.VIEW.REPLACER'));
                    return;
                }
            }

            var iMatchedCount = this.getMatchedCount(oEditorPools, sRegExp, sReplaceScope);
            if (iMatchedCount < 1) {
                alert(__('IS.NOTHING.LOOK', 'EDITOR.VIEW.REPLACER'));
                return;
            }

            if (confirm(__('YOU.MAKE.BULK.CHANGES', 'EDITOR.VIEW.REPLACER'))) {
                this.getReplacedContents(oEditorPools, sRegExp, sReplaceScope);
                alert(sprintf(__('COMPLETED.SUCCESSFULLY', 'EDITOR.VIEW.REPLACER'), iMatchedCount));
                return;
            }
        }
    },

    /**
     * 초기화
     */
    init : function() {
        this._super();

        this.$view = $(this.CONTAINER_SELECTOR).find('.replaceArea');
        this.$view.find(':input').filter('[name="replace_scope"]:first').attr('checked', true);
        this.$view.find(':input').filter(':checkbox').attr('checked', false);

        // [ECHOSTING-278598]
        // serviceGuide.setToolTip은 document.cTip을 전체 탐색하고,
        // 스디모듈들이 로드된 후의 이벤트 리스너가 없기에 this.$view > .cTip 을 가져와 도움말을 직접 호출합니다.
        SDE.Util.HelpCode.print(this.$view);

        $(document.body)
            .delegate('.replaceArea .btnClose', 'click', this.oEventHandler.setReplacerCloseClick)
            .delegate('.mTooltip .eTip', 'click', this.oEventHandler.setTooltipToggleClick)
            .delegate('.mTooltip .eClose', 'click', this.oEventHandler.setTooltipCloseClick)
            .delegate('.replaceArea .editor > .all', 'click', $.proxy(this.oEventHandler.setReplaceAllClick, this));
    },

    /**
     * 폼 클리어
     */
    clear : function () {
        if (this.isVisible() === false) {
            $('.mTooltip .eClose').trigger('click');

            this.$view.find(':input').filter('textarea').val('');
            this.$view.find(':input').filter('[name="replace_scope"]:first').attr('checked', true);
            this.$view.find(':input').filter(':checkbox').attr('checked', false);
        }
    },

    /**
     * 치환 영역 템플릿 뷰의 활성화 여부 반환
     * @returns bool
     */
    isVisible: function () {
        return this.$view.is(':visible');
    },

    /**
     * 치환 영역 템플릿 뷰의 출력을 처리
     */
    display : function() {
        this.clear();
        this.$view.toggle();
        $(this.REPLACE_BUTTON_SELECTOR).toggleClass('selected');
    },

    /**
     * 폼 유효성 체크
     * @returns {boolean}
     */
    checkValidation : function () {
        var $oElement = $(':input[name="find_text"]');
        if ($oElement.val() === '') {
            alert(__('PLEASE.ENTER.YOUR.SEARCH', 'EDITOR.VIEW.REPLACER'));
            $oElement.focus();
            return false;
        }
        return true;
    },

    /**
     * 정규식 객체 반환
     * @returns {RegExp}
     */
    getRegExp : function () {
        var sFindText = $(':input[name="find_text"]').val();
        var bIsMatchCase = $(':checkbox[name="match_case"]').attr('checked');

        var sRegExpFlag = 'gi';
        var sRegExpPattern = this.addSlashes(sFindText);

        if (bIsMatchCase === true) sRegExpFlag = sRegExpFlag.charAt(0);

        return new RegExp(sRegExpPattern, sRegExpFlag);
    },

    /**
     * 정규식 내 사용되는 특수 문자는 슬래시 추가
     * @param sText
     */
    addSlashes : function (sText) {
        return sText.replace(/(\\|\^|\$|\*|\+|\?|\.|\||\(|\))/g, '\\$1');
    },

    /**
     * 소스코드 내 치환 대상 갯수 반환
     * @param oEditorPools
     * @param oRegExp
     * @param sReplaceScope
     * @returns int
     */
    getMatchedCount : function (oEditorPools, oRegExp, sReplaceScope) {
        var sActiveTabUrl = SDE.Editor.Pool.getCurrentUrl();
        var iMatchedCount = 0;

        var $oThis = this;

        $.each(oEditorPools, function (sUrl) {
            // 읽기전용 파일은 continue
            if (oEditorPools[sUrl].readonly === true) {
                return true;
            }
            var oEditor = oEditorPools[sUrl].editor;

            if (sReplaceScope == 'C') {
                if (sUrl == sActiveTabUrl) {
                    iMatchedCount += $oThis.getMatchedTextToArray(oRegExp, oEditor.getValue()).length;
                }
            } else {
                iMatchedCount += $oThis.getMatchedTextToArray(oRegExp, oEditor.getValue()).length;
            }
        });

        return iMatchedCount;
    },

    /**
     * 소스코드 내용을 치환처리
     * @param oEditorPools
     * @param oRegExp
     * @param sReplaceScope
     */
    getReplacedContents : function (oEditorPools, oRegExp, sReplaceScope) {
        var sActiveTabUrl = SDE.Editor.Pool.getCurrentUrl();
        var $oThis = this;

        $.each(oEditorPools, function (sUrl) {
            SDE.Editor.Pool.setReplacingMode(true);

            // 읽기전용 파일은 continue
            if (oEditorPools[sUrl].readonly === true) {
                return true;
            }
            var oEditor = oEditorPools[sUrl].editor;
            var sReplaceText = $(':input[name="replace_text"]').val();

            if ($oThis.getMatchedTextToArray(oRegExp, oEditor.getValue()).length > 0) {
                if (sReplaceScope == 'C') {
                    if (sUrl == sActiveTabUrl) {
                        $oThis.setReplaceContents(oEditor, sUrl, oRegExp, sReplaceText);
                    }
                } else {
                    $oThis.setReplaceContents(oEditor, sUrl, oRegExp, sReplaceText);
                }
            }

            SDE.Editor.Pool.setReplacingMode(false);
        });
    },

    /**
     * 패턴에 일치하는 텍스트를 배열로 반환
     * @param aRegExp
     * @param sContents
     * @returns {Array}
     */
    getMatchedTextToArray : function (aRegExp, sContents) {
        var aMatchedTexts = sContents.match(aRegExp);

        if ($.isArray(aMatchedTexts) === true && aMatchedTexts.length > 0) {
            return aMatchedTexts;
        }

        return [];
    },

    /**
     * 소스코드를 치환 후 변경 사항을 브로드캐스팅
     * @param oEditor
     * @param sUrl
     * @param oRegExp
     * @param sReplaceText
     */
    setReplaceContents : function (oEditor, sUrl, oRegExp, sReplaceText) {
        var sReplacedContents = oEditor.getValue().replace(oRegExp, sReplaceText);
        oEditor.setValue(sReplacedContents);
        SDE.BroadCastManager.send('file-content-change', sUrl, oEditor.getValue());
    }
});
/**
 * Editor에 필요한 JS 초기화
 *
 * author : Jae-Kwang Lee <jklee02@simplexi.com>
 */

$(function() {
    var url = '/index.html', params = {};

    // 상단 버튼 관리
    SDE.View.ButtonManager.init();

    // 화면, 소스 보기 영역
    SDE.View.Manager.init();

    // 파일 관리
    SDE.File.Manager.init();

    // 자주쓰는 화면
    SDE.List.Favorite.Controller.init();

    // 파일 탭
    SDE.List.Tab.Controller.init();

    // 파일 탭 리스트
    SDE.List.TabList.Controller.init();

    // 파일 히스토리
    SDE.List.History.Controller.init();

    // 전체 화면 보기 Tree.
    // 여러 곳에서 사용하기 때문에 Singleton 패턴을 사용하지 않고 객체로 생성
    new SDE.List.Tree.Controller('#snbAll');

    // index.html or 변수로 넘어오는 위치 열기
    if (SDE.EDITOR_FILE) {
        url = (SDE.EDITOR_FILE == '/') ? '/index.html' : SDE.EDITOR_FILE;
        params = getQueryParams();
    }

    SDE.File.Manager.open(url, params);
});
/**
 * 간단한 display 관련 로직 처리
 */

$(function(){
    /**
     * Common Variables
     */
    var $body = $(document.body);
    var searchLayer, listTreeLayer, dirlistTreeLayer;


    /*
     * 자주쓰는 화면, 전체화면 보기 Swipe
     */
    var $tab = $('#aside .tab > li'),
        $favorite = $('#aside .snbFavorite'),
        $all = $('#aside .snbAll'),
        $currentExplorer = $favorite;


    $tab.click(function(evt) {
        var $this = $(this),
            $explorer = $($this.data('selector'));

        $currentExplorer.hide();
        $explorer.show();

        $tab.removeClass('selected');
        $this.addClass('selected');


        $currentExplorer = $explorer;
    });


    /**
     * 왼쪽 메뉴 펼침
     */
    /*rev.b23.20130829.1@sinseki #SDE-4 레이아웃 가로 스크롤 (left: 200px-400px) 기능 구현*/
    $(".controlBar button").click(function(evt) {
        var className = 'eHidden';

        $body.toggleClass(className);

        $(".controlBar button").html(__('MENU', 'EDITOR.RESOURCE.JS.UI') + ' ' + ($body.hasClass(className) ? __('SPREAD', 'EDITOR.RESOURCE.JS.UI') : __('HIDING', 'EDITOR.RESOURCE.JS.UI')));

        $("#aside").css({width:""});
        $(".controlBar").css({left:""});
        $("#container").css({marginLeft:""});

    });
    $(".controlBar").prepend(
        $("<div>").addClass("dummy").css({position:"absolute",left:0,top:0,width:"200%",height:"100%"})
    );
    $(".controlBar .dummy").draggable({
        containment : 'body',
        iframeFix : true,
        cursor : 'e-resize',
        drag : function (event,ui) {
            var $l = ui.offset.left;
            $l = Math.min(Math.max($l,214),414);
            $("#aside").css({width:$l+"px"});
            $(".controlBar").css({left:$l+"px"});
            $("#container").css({marginLeft:($l+6)+"px"});
            $(".controlBar .dummy").css({left:0});
        },
        stop : function (event,ui) {
            $(".controlBar .dummy").css({left:0});
        }
    });

    /**
     * Input PlaceHolder
     */
    $(".ePlaceholder").click(function() {
        var $this = $(this);

        $this.find('span').hide();

        $this.find('input').focus();
    }).find('input').blur(function(){
        var $this = $(this);

        $this.siblings('span')[($.trim($this.val()) === '') ? 'show' : 'hide']();
    });


    /**
     * 파일명 검색
     */
    $('#fileSearch').submit(function() {
        if (!searchLayer) searchLayer = new SDE.Layer.Search();

        searchLayer.search($(this).find('input').val());
    });


    /**
     * 쇼핑몰 화면 추가
     */
    $('#fileAdd').click(function() {
        if (!listTreeLayer) {
            listTreeLayer = new SDE.Layer.ListTree();
        } else {
            listTreeLayer.updateTree();
        }

        listTreeLayer.add();
    });

    /*rev.b12.20130830.1@sinseki #SDE-5 쇼핑몰 화면 추가 영역을 2등분 하여, 앞에 디렉토리 추가버튼과 기능 구현*/
    /**
     * 쇼핑몰 디렉토리 추가
     */
    $('#dirAdd').click(function() {
        if (!dirlistTreeLayer) {
            dirlistTreeLayer = new SDE.Layer.DirListTree();
        } else {
            dirlistTreeLayer.updateTree();
        }

        dirlistTreeLayer.add();
    });


    /**
     * 구형 브라우저 안내 팝업 Close
     */
    $('.ie8 .close').click(function() {
        $(this).parent().remove();
    });
});
$(function() {
    if (!$.browser.webkit) return;

    SDE.EasterEgg = {

        TEMPLATE : '<div style="font-family:\'Gabriela\',serif;color:#FFF;font-size:25px;position:absolute;right:30px;bottom:30px;z-index:110; text-shadow: 0 0 20px #fefcc9, 10px -10px 30px #feec85, -20px -20px 40px #ffae34, 20px -40px 50px #ec760c, -20px -60px 60px #cd4606, 0 -80px 70px #973716, 10px -90px 80px #451b0e;">' +
                        '<link href="http://fonts.googleapis.com/css?family=Gabriela" rel="stylesheet" type="text/css">' +

                        '<script src="https://raw.github.com/paullewis/Fireworks/master/js/requestanimframe.js"></script>' +
                        '<script src="https://raw.github.com/paullewis/Fireworks/master/js/fireworks.js"></script>' +

                        '<p style="font-size:20px;">' +
                            '2013.03.18' +
                        '</p>' +

                        '<p style="line-height:1.6;">' +
                            'Planner : In-A Jung<br/>' +
                            'Publisher : Zina Kim, Young-Ae So<br/>' +
                            'Developer : Jae-Kwang Lee<br/>' +
                            'Manager : Sang-Doo Jung' +
                        '</p>' +

                        '<aside id="library" style="display:none">' +
                            '<img src="https://raw.github.com/paullewis/Fireworks/master/images/nightsky.png" id="nightsky" />' +
                            '<img src="https://raw.github.com/paullewis/Fireworks/master/images/big-glow.png" id="big-glow" />' +
                            '<img src="https://raw.github.com/paullewis/Fireworks/master/images/small-glow.png" id="small-glow" />' +
                        '</aside>' +
                        
                   '</div>',
        

        _init : function() {
            var _this = this;

            this.$element = $(this.TEMPLATE).appendTo(document.body);

            this.intervalId = setInterval(function() {
                if (typeof Fireworks == 'undefined') return;

                _this._setCanvas();
            }, 100);
        },

        _setCanvas : function() {
            Fireworks.initialize();

             $('canvas').css({
               'position' : 'absolute',
               'left' : '0',
               'top' : '0',
               'opacity' : '0.6',
               'z-index' : '100',
               'background' : '#000'
            });

            setInterval(function() {
                Fireworks.createParticle();
            }, 700);

            clearInterval(this.intervalId);
        },

        show : function() {
            this._init();
        }
    };

    // http://en.wikipedia.org/wiki/Konami_code
    $(window).konami({  
        cheat: function() {
            SDE.EasterEgg.show();
        }
    });
});

/* 도움말 */
if (typeof jQuery !== 'undefined') {
    window.sendRequest = function(callback,data,method,url,async,sload,user,password) {
        return jQuery.ajax({
            url: url,
            async: async,
            type: method,
            data: data,
            success: function(data, textStatus, jqXHR) {
                callback(jqXHR);
            },
            cache: sload ? false : true,
            username: user,
            password: password
        });
    };
}

var HelpCode = {
    getPosition: function (e) {
        var mouseX = e.pageX ? e.pageX : document.documentElement.scrollLeft + event.clientX;
        var mouseY = e.pageX ? e.pageX : document.documentElement.scrollLeft + event.clientY;
        return {x: mouseX, y: mouseY};
    },

    getCookie: function (name) {
        var nameOfCookie = name + '=';
        var x = 0;

        while (x <= document.cookie.length) {
            var y = x + nameOfCookie.length;
            if (document.cookie.substring(x, y) == nameOfCookie) {
                if ((endOfCookie=document.cookie.indexOf(";", y)) == -1) {
                    endOfCookie = document.cookie.length;
                }
                return unescape(document.cookie.substring(y, endOfCookie));
            }
            x = document.cookie.indexOf(" ", x) + 1;

            if (x == 0) break;
        }
        return "";
    },

    setCookie: function (cookieName, cookieValue, expireDate) {
        var today = new Date();
        today.setDate( today.getDate() + parseInt( expireDate ) );
        document.cookie = cookieName + "=" + escape( cookieValue ) + "; path=/; expires=" + today.toGMTString() + ";";
    },

    HELP_openPopup: function (url, width, height) {
        var winname = 'adminHelp';
        var option = 'toolbar=no, location=no, scrollbars=yes, status=yes, resizable=no, width='+width+', height='+height+', top=100, left=100';
        window.open(url, winname, option);
    },

    //도움말 라이브러리에 코드를 요청
    getHelpCode: function (helpCode, helpType) {
        var sParam;

        sParam = '&helpCode=' + helpCode;

        if (helpType) {
            sParam += '&helpType=' + helpType;
        }

        if ( document.getElementById(helpCode) == null ) {
            document.write("<span id='"+helpCode+"'></span>");
        }

        sendRequest(HelpCode.settingHelpCode, sParam, 'GET', '/common/settingHelpCode.php', true, false);
    },

    //ajax로 가져온 값을 해당 영역에 출력시킴
    settingHelpCode: function (oj) {
        if ( !oj || !oj.responseXML ) return;

        var xmlDoc = oj.responseXML;
        var areaId = xmlDoc.getElementsByTagName('helpcode')[0].firstChild.nodeValue;

        try {
            document.getElementById(areaId).innerHTML =  xmlDoc.getElementsByTagName('content')[0].firstChild.nodeValue;
        } catch (e) {}
    },

    checkInnerHelp:function (code) {
        if (HelpCode.getCookie(code) == 'close') {
            document.getElementById(code+'open').style.display='none';
            document.getElementById(code+'close').style.display='block';
        }
    },

    toggleInnerHelp:function (code, mode) {
        var value1, value2;

        if (mode == 'close') {
            value1 = 'none';
            value2 = 'block';
        } else {
            value1 = 'block';
            value2 = 'none';
        }

        document.getElementById(code+'open').style.display = value1;
        document.getElementById(code+'close').style.display = value2;

        HelpCode.setCookie(code, mode, 30);
    },

    HELP_openIframe: function (url, width, height) {

        var Obj = document.getElementById('helpIframe_Layer');
        var XY = getPosition(event);

        if (Obj) {

            var oLayer = Obj;
            var oIframe = document.getElementById('helpIframe');

        } else {
            var create_iframe = true;

            //레이어 생성
            var oLayer = document.createElement('div');
            oLayer.setAttribute('id', 'helpIframe_Layer');
            oLayer.style.position = 'absolute';
            oLayer.style.zindex = '3000';
            oLayer.style.width = width+'px';
            oLayer.style.border = '1px solid #ccc';
            oLayer.style.padding = '3px';
            oLayer.style.backgroundColor = '#fff';
            oLayer.style.textAlign = 'right';

            var oLayerClosebtn = document.createElement('img');
            oLayerClosebtn.setAttribute('src', '//img.cafe24.com/images/ec_admin/addservice/info/btn_x_001.gif');
            oLayerClosebtn.setAttribute('alt', __('CLOSE', 'ADMIN.JS.HELPCODE'));
            oLayerClosebtn.onclick = function() { document.getElementById('helpIframe_Layer').style.display = 'none'; };
            oLayerClosebtn.style.cursor = "pointer";

            //iframe 생성
            var oIframe = document.createElement('iframe');
            oIframe.setAttribute('id', 'helpIframe');
            oIframe.setAttribute('frameBorder', '0');
            oIframe.setAttribute('border', '0');
            oIframe.setAttribute('scrolling', 'auto');
            oIframe.style.width = width+'px';
        }

        oLayer.style.height = height+'px';
        oIframe.style.height = height+'px';
        oIframe.src = url;

        oLayer.style.left = document.body.scrollLeft + XY.x;
        oLayer.style.top = document.body.scrollTop + XY.y;
        oLayer.style.display = 'block';

        if (create_iframe == true) {
            document.getElementsByTagName('body')[0].appendChild(oLayer);
            oLayer.appendChild(oLayerClosebtn);
            oLayer.appendChild(oIframe);
        }
    }
};

// 도움말
var serviceGuide = {
    init: function () {
        serviceGuide.setManual();
        serviceGuide.setToolTip();
    },
    // 툴팁 확인
    setToolTip: function () {
        if (SHOP.isMobileAdmin() === true) {
            var oToolTip = $('div.cTip').filter('.ecmobile');
        } else if (SHOP.isMode() === true) {
            var oToolTip = $('div.cTip.eSmartMode');
        } else {
            var oToolTip = $('div.cTip').not('.eSmartMode');
        }

        if (oToolTip.length === 0) return false;
        if (!oToolTip.hasOwnProperty(0)) return false;

        // tpl 에 정의된 툴팁 코드들을 가져옵니다.
        var getToolTipCodeOnTemplate = function () {
            var aToolTipCode = [];
            for (var i = 0; i < oToolTip.length; i++) {
                if (typeof oToolTip[i] !== 'object') continue;

                var sTipCode = oToolTip[i].getAttribute('code').replace(/\.+[0-9]+/, '');
                if (sTipCode !== '' && aToolTipCode.indexOf(sTipCode) === -1) {
                    aToolTipCode.push(sTipCode);
                }
            }
            return aToolTipCode;
        };

        var aToolTipCode = getToolTipCodeOnTemplate();
        var sLangCode = oToolTip[0].getAttribute('lang') || EC_GLOBAL_INFO.getLanguageCode();

        if (aToolTipCode.length < 1) return false;

        for (var i = 0; i < aToolTipCode.length; i++) {
            var sTipCode = aToolTipCode[i];
            var sParam = '&sTipCode=' + sTipCode + '&sLangCode=' + sLangCode;
            sendRequest(serviceGuide.setToolTipIcons, sParam, 'GET', '/exec/admin/guide/HelptipIcons', true, false);
        }
    },
    // 툴팁 아이콘 생성
    setToolTipIcons: function (th) {
        var sResponse = th.responseText || th.response;
        var aJson = JSON.parse(sResponse);

        if (aJson['code'] !== 200) return false;
        if (aJson['data']['icons'] === '') return false;

        var sTipCode = aJson['data']['tip_code'];
        var oJsonIcons = JSON.parse(aJson['data']['icons']);
        var oPrintToolTip = document.querySelectorAll('div.cTip[code^="' + sTipCode + '"]');
        [].forEach.call(oPrintToolTip, function (cTip) {
            var sTipCode = cTip.getAttribute('code');
            var sIconsHtml = oJsonIcons[sTipCode];
            if (sIconsHtml) {
                cTip.innerHTML = sIconsHtml;
                cTip.querySelector('button').onclick = function () {
                    serviceGuide.getToolTipContents(cTip, sTipCode);
                };
                if (cTip.getAttribute('gtm_type')) cTip.querySelector('button').setAttribute('gtm_type',cTip.getAttribute('gtm_type'));

                // 앞엘리먼트에 glabel 클래스가 있는경우 호출div에 glabel을 추가해준다
                if (cTip.previousElementSibling !== null
                    && cTip.previousElementSibling.className.split('gLabel').length === 2
                ) {
                    cTip.firstChild.className = cTip.firstChild.className + ' gLabel';
                }
            }
        });
    },
    // 툴팁 컨텐츠 가져오기
    getToolTipContents: function (oTip, sTipCode) {
        var sLangCode = oTip.getAttribute('lang') || EC_GLOBAL_INFO.getLanguageCode();
        var sParam = '&sTipCode=' + sTipCode + '&sLangCode=' + sLangCode;
        var oTipContents = oTip.querySelector('.content');

        if (oTipContents.innerHTML !== '') return;

        // 툴팁 컨텐츠 넣기
        var setToolTipContents = function (th) {
            var sResponse = th.responseText || th.response;
            var aJson = JSON.parse(sResponse);

            if (aJson['code'] !== 200) return false;
            if (aJson['data'] === '') return false;

            oTipContents.innerHTML = aJson['data'];
            oTipContents.innerHTML = oTipContents.innerHTML.split('_blank').join('blankWindow');
        };

        return sendRequest(setToolTipContents, sParam, 'GET', '/exec/admin/guide/HelptipContents', true, false);
    },
    // 매뉴얼 출력
    setManual: function () {
        if (SHOP.isMode() === true) {
            var oManual = document.querySelectorAll('span.cManual.eSmartMode');
        } else {
            var oManual = document.querySelectorAll('span.cManual:not(.eSmartMode)');
        }
        if (oManual.length === 0) return false;

        for(var sKey in oManual) {
            if (typeof oManual[sKey] !== 'object') continue;
            if (!oManual.hasOwnProperty(sKey)) continue;

            var sManualCode = oManual[sKey].getAttribute('code');
            var sLangCode = oManual[sKey].getAttribute('lang') || EC_GLOBAL_INFO.getLanguageCode();
            var sDataSupply = oManual[sKey].getAttribute('data-supply');
            var sGtmTypeHtml = '';
            if (oManual[sKey].getAttribute('gtm_type')) sGtmTypeHtml = 'gtm_type="'+oManual[sKey].getAttribute('gtm_type')+'"';

            var sManualUrl = '';
            if (SHOP.isMode() === true) {
                sManualUrl = '//serviceguide.cafe24.com/IN/' + sLangCode + '/' + sManualCode + '.html';
            }
            else {
                if (sDataSupply !== null && sDataSupply !== '') {
                    sManualUrl = '//serviceguide.cafe24.com/supply/'+ sLangCode +'/'+ sDataSupply +'.html';
                }

                if (sManualCode !== null && sManualCode !== '') {
                    if (sLangCode === 'ko_KR') {
                        sManualUrl = '//serviceguide.cafe24.com/ko_KR/'+ sManualCode +'.html';
                    }
                    else {
                        sManualUrl = '//serviceguide.cafe24shop.com/'+ sLangCode +'/'+ sManualCode +'.html';
                    }
                }
            }

            if (sManualUrl !== '') {
                var sLink = '<a href="'+sManualUrl+'" target="_blank" class="btnManual" title="'+__('NEW.WINDOW.OPENED', 'ADMIN.JS.HELPCODE')+'" '+sGtmTypeHtml+'>'+__('MANUAL', 'ADMIN.JS.HELPCODE')+'</a>';
                oManual[sKey].innerHTML = sLink;
            }
        }
    }
};

if (typeof jQuery !== 'undefined') {
    $(document).ready(function () {
        serviceGuide.init();
    });
} else {
    if (window.addEventListener) {
        window.addEventListener('load', serviceGuide.init, false);
    } else if (window.attachEvent) {
        window.attachEvent('onload', serviceGuide.init);
    } else if (document.getElementById) {
        window.onload = serviceGuide.init;
    }
}

if (!Function.prototype.bind) {
    Function.prototype.bind = function () {
        var _m = this, _a = [].slice.apply(arguments), _o = _a.shift();
        return function () {
            return _m.apply(_o, _a.concat([].slice.apply(arguments)));
        }
    };
}
SFUpload = {
    $prop: {
        ready: null,
        dialogopen: null,
        queue: null,
        queueerror: null,
        dialogclose: null,
        uploadstart: null,
        uploadprogress: null,
        uploaderror: null,
        uploadend: null,
        uploaded: null
    },
    init: function ($phProp) {
        if (!$phProp || !$phProp.node || !$phProp.swf || !$phProp.url) {
            return false;
        }
        //if (!$phProp.buttonsize && !$phProp.css) {
        //    var $e = document.getElementById($phProp.node);
        //    $phProp.buttonsize = [$e.clientWidth||$e.parentNode.clientWidth,$e.clientHeight||$e.parentNode.clientHeight].join(",");
        //}
        this.$engine = new SWFUpload({
            flash_url: $phProp.swf,
            file_post_name : "file",
            file_types : "*.jpg;*.gif;*.png",
            file_types_description: "Images",
            file_size_limit : "20 MB",
            file_upload_limit : 0,
            file_queue_limit : 0,
            button_placeholder_id: $phProp.node,
            //button_image_url: "http://seki.kr/sin6/root.test/imocon/%E3%85%8D.%E3%85%8D.png",
            //button_width : "1",
            //button_height : "1",
            button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
            file_dialog_start_handler: this._ondialogopen.bind(this),
            file_queued_handler: this._onqueue.bind(this),
            file_queue_error_handler: this._onqueueerror.bind(this),
            file_dialog_complete_handler: this._ondialogclose.bind(this),
            upload_start_handler: this._onuploadstart.bind(this),
            upload_progress_handler: this._onuploadprogress.bind(this),
            upload_error_handler: this._onuploaderror.bind(this),
            upload_success_handler: this._onuploadend.bind(this),
            upload_complete_handler: this._onuploaded.bind(this),
            swfupload_loaded_handler: this._oninit.bind(this)
        });
        this.$userProp = $phProp;
        return this;
    },
    prop: function ($phProp) {
        $phProp = $phProp || {};
        for (var $k in $phProp) {
            this.$prop[$k] = $phProp[$k];
        }
        $phProp.url && this.$engine.setUploadURL($phProp.url);
        $phProp.filepostname && this.$engine.setFilePostName($phProp.filepostname);
        for (var $k in $phProp.params||{}) {
            this.$engine.addPostParam($k, encodeURIComponent($phProp.params[$k]));
        }
        $phProp.maxupload && this.$engine.setFileUploadLimit($phProp.maxupload);
        $phProp.maxqueue && this.$engine.setFileUploadLimit($phProp.maxqueue);
        $phProp.filefilter && this.$engine.setFileTypes.apply(this.$engine, $phProp.filefilter.replace(/\s*,\s*/,",").split(","));
        $phProp.maxfilesize && this.$engine.setFileSizeLimit($phProp.maxfilesize);
        $phProp.buttonsize && this.$engine.setButtonDimensions.apply(this.$engine, $phProp.buttonsize.split(","));
        $phProp.buttonurl && this.$engine.setButtonImageURL($phProp.buttonurl);
        for (var $k in $phProp.css||{}) {
            this.$engine.movieElement.style[$k] = $phProp.css[$k];
        }
    },
    upload: function ($phProp) {
        this.prop($phProp);
        this.$engine.getStats().files_queued > 0 && this.$engine.startUpload();
    },
    cancel: function ($psId) {
        this.$engine.cancelUpload($psId);
    },
    stop: function () {
        this.$engine.stopUpload();
    },
    stats: function () {
        return this.$engine.getStats();
    },
    _oninit: function () {
        this.prop(this.$userProp);
        this.$prop.ready && this.$prop.ready.apply(this, arguments);
    },
    _ondialogopen: function ()
    {
        this.$prop.dialogopen && this.$prop.dialogopen.apply(this, arguments);
    },
    _onqueue: function($poFile)
    {
        this.$prop.queue && this.$prop.queue.apply(this, arguments);
    },
    _onqueueerror: function($poFile, $psErrorCode, $psMessage)
    {
        this.$prop.queueerror && this.$prop.queueerror.apply(this, arguments);
    },
    _ondialogclose: function($piFilesSelected, $piFilesQueued, $piFilesInQueue)
    {
        this.$prop.dialogclose && this.$prop.dialogclose.apply(this, arguments);
    },
    _onuploadstart: function($poFile)
    {
        this.$prop.uploadstart && this.$prop.uploadstart.apply(this, arguments);
    },
    _onuploadprogress: function($poFile, $piBytesLoaded, $piBytesTotal)
    {
        this.$prop.uploadprogress && this.$prop.uploadprogress.apply(this, arguments);
    },
    _onuploaderror: function($poFile, $psErrorCode, $psMessage)
    {
        this.$prop.uploaderror && this.$prop.uploaderror.apply(this, arguments);
    },
    _onuploadend: function($poFile, $psResponseText, $pbResponseReceived)
    {
        this.$prop.uploadend && this.$prop.uploadend.apply(this, arguments);
    },
    _onuploaded: function($poFile)
    {
        this.$prop.uploaded && this.$prop.uploaded.apply(this, arguments);
    }
};

/**
 * SWFUpload: http://www.swfupload.org, http://swfupload.googlecode.com
 *
 * mmSWFUpload 1.0: Flash upload dialog - http://profandesign.se/swfupload/,  http://www.vinterwebb.se/
 *
 * SWFUpload is (c) 2006-2007 Lars Huring, Olov Nilz? and Mammon Media and is released under the MIT License:
 * http://www.opensource.org/licenses/mit-license.php
 *
 * SWFUpload 2 is (c) 2007-2008 Jake Roberts and is released under the MIT License:
 * http://www.opensource.org/licenses/mit-license.php
 *
 */


/* ******************* */
/* Constructor & Init  */
/* ******************* */
var SWFUpload;

if (SWFUpload == undefined) {
    SWFUpload = function (settings) {
        this.initSWFUpload(settings);
    };
}

SWFUpload.prototype.initSWFUpload = function (settings) {
    try {
        this.customSettings = {};    // A container where developers can place their own settings associated with this instance.
        this.settings = settings;
        this.eventQueue = [];
        this.movieName = "SWFUpload_" + SWFUpload.movieCount++;
        this.movieElement = null;


        // Setup global control tracking
        SWFUpload.instances[this.movieName] = this;

        // Load the settings.  Load the Flash movie.
        this.initSettings();
        this.loadFlash();
        this.displayDebugInfo();
    } catch (ex) {
        delete SWFUpload.instances[this.movieName];
        throw ex;
    }
};

/* *************** */
/* Static Members  */
/* *************** */
SWFUpload.instances = {};
SWFUpload.movieCount = 0;
SWFUpload.version = "2.2.0 2009-03-25";
SWFUpload.QUEUE_ERROR = {
    QUEUE_LIMIT_EXCEEDED              : -100,
    FILE_EXCEEDS_SIZE_LIMIT          : -110,
    ZERO_BYTE_FILE                      : -120,
    INVALID_FILETYPE                  : -130
};
SWFUpload.UPLOAD_ERROR = {
    HTTP_ERROR                          : -200,
    MISSING_UPLOAD_URL                  : -210,
    IO_ERROR                          : -220,
    SECURITY_ERROR                      : -230,
    UPLOAD_LIMIT_EXCEEDED              : -240,
    UPLOAD_FAILED                      : -250,
    SPECIFIED_FILE_ID_NOT_FOUND        : -260,
    FILE_VALIDATION_FAILED              : -270,
    FILE_CANCELLED                      : -280,
    UPLOAD_STOPPED                    : -290
};
SWFUpload.FILE_STATUS = {
    QUEUED         : -1,
    IN_PROGRESS     : -2,
    ERROR         : -3,
    COMPLETE     : -4,
    CANCELLED     : -5
};
SWFUpload.BUTTON_ACTION = {
    SELECT_FILE  : -100,
    SELECT_FILES : -110,
    START_UPLOAD : -120
};
SWFUpload.CURSOR = {
    ARROW : -1,
    HAND : -2
};
SWFUpload.WINDOW_MODE = {
    WINDOW : "window",
    TRANSPARENT : "transparent",
    OPAQUE : "opaque"
};

// Private: takes a URL, determines if it is relative and converts to an absolute URL
// using the current site. Only processes the URL if it can, otherwise returns the URL untouched
SWFUpload.completeURL = function(url) {
    if (typeof(url) !== "string" || url.match(/^https?:\/\//i) || url.match(/^\//)) {
        return url;
    }

    var currentURL = window.location.protocol + "//" + window.location.hostname + (window.location.port ? ":" + window.location.port : "");

    var indexSlash = window.location.pathname.lastIndexOf("/");
    if (indexSlash <= 0) {
        path = "/";
    } else {
        path = window.location.pathname.substr(0, indexSlash) + "/";
    }

    return /*currentURL +*/ path + url;

};


/* ******************** */
/* Instance Members  */
/* ******************** */

// Private: initSettings ensures that all the
// settings are set, getting a default value if one was not assigned.
SWFUpload.prototype.initSettings = function () {
    this.ensureDefault = function (settingName, defaultValue) {
        this.settings[settingName] = (this.settings[settingName] == undefined) ? defaultValue : this.settings[settingName];
    };

    // Upload backend settings
    this.ensureDefault("upload_url", "");
    this.ensureDefault("preserve_relative_urls", false);
    this.ensureDefault("file_post_name", "Filedata");
    this.ensureDefault("post_params", {});
    this.ensureDefault("use_query_string", false);
    this.ensureDefault("requeue_on_error", false);
    this.ensureDefault("http_success", []);
    this.ensureDefault("assume_success_timeout", 0);

    // File Settings
    this.ensureDefault("file_types", "*.*");
    this.ensureDefault("file_types_description", "All Files");
    this.ensureDefault("file_size_limit", 0);    // Default zero means "unlimited"
    this.ensureDefault("file_upload_limit", 0);
    this.ensureDefault("file_queue_limit", 0);

    // Flash Settings
    this.ensureDefault("flash_url", "swfupload.swf");
    this.ensureDefault("prevent_swf_caching", true);

    // Button Settings
    this.ensureDefault("button_image_url", "");
    this.ensureDefault("button_width", 1);
    this.ensureDefault("button_height", 1);
    this.ensureDefault("button_text", "");
    this.ensureDefault("button_text_style", "color: #000000; font-size: 16pt;");
    this.ensureDefault("button_text_top_padding", 0);
    this.ensureDefault("button_text_left_padding", 0);
    this.ensureDefault("button_action", SWFUpload.BUTTON_ACTION.SELECT_FILES);
    this.ensureDefault("button_disabled", false);
    this.ensureDefault("button_placeholder_id", "");
    this.ensureDefault("button_placeholder", null);
    this.ensureDefault("button_cursor", SWFUpload.CURSOR.ARROW);
    this.ensureDefault("button_window_mode", SWFUpload.WINDOW_MODE.WINDOW);

    // Debug Settings
    this.ensureDefault("debug", false);
    this.settings.debug_enabled = this.settings.debug;    // Here to maintain v2 API

    // Event Handlers
    this.settings.return_upload_start_handler = this.returnUploadStart;
    this.ensureDefault("swfupload_loaded_handler", null);
    this.ensureDefault("file_dialog_start_handler", null);
    this.ensureDefault("file_queued_handler", null);
    this.ensureDefault("file_queue_error_handler", null);
    this.ensureDefault("file_dialog_complete_handler", null);

    this.ensureDefault("upload_start_handler", null);
    this.ensureDefault("upload_progress_handler", null);
    this.ensureDefault("upload_error_handler", null);
    this.ensureDefault("upload_success_handler", null);
    this.ensureDefault("upload_complete_handler", null);

    this.ensureDefault("debug_handler", this.debugMessage);

    this.ensureDefault("custom_settings", {});

    // Other settings
    this.customSettings = this.settings.custom_settings;

    // Update the flash url if needed
    if (!!this.settings.prevent_swf_caching) {
        this.settings.flash_url = this.settings.flash_url + (this.settings.flash_url.indexOf("?") < 0 ? "?" : "&") + "preventswfcaching=" + new Date().getTime();
    }

    if (!this.settings.preserve_relative_urls) {
        //this.settings.flash_url = SWFUpload.completeURL(this.settings.flash_url);    // Don't need to do this one since flash doesn't look at it
        this.settings.upload_url = SWFUpload.completeURL(this.settings.upload_url);
        this.settings.button_image_url = SWFUpload.completeURL(this.settings.button_image_url);
    }

    delete this.ensureDefault;
};

// Private: loadFlash replaces the button_placeholder element with the flash movie.
SWFUpload.prototype.loadFlash = function () {
    var targetElement, tempParent;

    // Make sure an element with the ID we are going to use doesn't already exist
    if (document.getElementById(this.movieName) !== null) {
        throw "ID " + this.movieName + " is already in use. The Flash Object could not be added";
    }

    // Get the element where we will be placing the flash movie
    targetElement = document.getElementById(this.settings.button_placeholder_id) || this.settings.button_placeholder;

    if (targetElement == undefined) {
        throw "Could not find the placeholder element: " + this.settings.button_placeholder_id;
    }

    // Append the container and load the flash
    tempParent = document.createElement("div");
    tempParent.innerHTML = this.getFlashHTML();    // Using innerHTML is non-standard but the only sensible way to dynamically add Flash in IE (and maybe other browsers)
    targetElement.parentNode.replaceChild(tempParent.firstChild, targetElement);

    // Fix IE Flash/Form bug
    if (window[this.movieName] == undefined) {
        window[this.movieName] = this.getMovieElement();
    }

};

// Private: getFlashHTML generates the object tag needed to embed the flash in to the document
SWFUpload.prototype.getFlashHTML = function () {
    // Flash Satay object syntax: http://www.alistapart.com/articles/flashsatay
    return ['<object id="', this.movieName, '" type="application/x-shockwave-flash" data="', this.settings.flash_url, '" width="', this.settings.button_width, '" height="', this.settings.button_height, '" class="swfupload">',
                '<param name="wmode" value="', this.settings.button_window_mode, '" />',
                '<param name="movie" value="', this.settings.flash_url, '" />',
                '<param name="quality" value="high" />',
                '<param name="menu" value="false" />',
                '<param name="allowScriptAccess" value="always" />',
                '<param name="flashvars" value="' + this.getFlashVars() + '" />',
                '</object>'].join("");
};

// Private: getFlashVars builds the parameter string that will be passed
// to flash in the flashvars param.
SWFUpload.prototype.getFlashVars = function () {
    // Build a string from the post param object
    var paramString = this.buildParamString();
    var httpSuccessString = this.settings.http_success.join(",");

    // Build the parameter string
    return ["movieName=", encodeURIComponent(this.movieName),
            "&amp;uploadURL=", encodeURIComponent(this.settings.upload_url),
            "&amp;useQueryString=", encodeURIComponent(this.settings.use_query_string),
            "&amp;requeueOnError=", encodeURIComponent(this.settings.requeue_on_error),
            "&amp;httpSuccess=", encodeURIComponent(httpSuccessString),
            "&amp;assumeSuccessTimeout=", encodeURIComponent(this.settings.assume_success_timeout),
            "&amp;params=", encodeURIComponent(paramString),
            "&amp;filePostName=", encodeURIComponent(this.settings.file_post_name),
            "&amp;fileTypes=", encodeURIComponent(this.settings.file_types),
            "&amp;fileTypesDescription=", encodeURIComponent(this.settings.file_types_description),
            "&amp;fileSizeLimit=", encodeURIComponent(this.settings.file_size_limit),
            "&amp;fileUploadLimit=", encodeURIComponent(this.settings.file_upload_limit),
            "&amp;fileQueueLimit=", encodeURIComponent(this.settings.file_queue_limit),
            "&amp;debugEnabled=", encodeURIComponent(this.settings.debug_enabled),
            "&amp;buttonImageURL=", encodeURIComponent(this.settings.button_image_url),
            "&amp;buttonWidth=", encodeURIComponent(this.settings.button_width),
            "&amp;buttonHeight=", encodeURIComponent(this.settings.button_height),
            "&amp;buttonText=", encodeURIComponent(this.settings.button_text),
            "&amp;buttonTextTopPadding=", encodeURIComponent(this.settings.button_text_top_padding),
            "&amp;buttonTextLeftPadding=", encodeURIComponent(this.settings.button_text_left_padding),
            "&amp;buttonTextStyle=", encodeURIComponent(this.settings.button_text_style),
            "&amp;buttonAction=", encodeURIComponent(this.settings.button_action),
            "&amp;buttonDisabled=", encodeURIComponent(this.settings.button_disabled),
            "&amp;buttonCursor=", encodeURIComponent(this.settings.button_cursor)
        ].join("");
};

// Public: getMovieElement retrieves the DOM reference to the Flash element added by SWFUpload
// The element is cached after the first lookup
SWFUpload.prototype.getMovieElement = function () {
    if (this.movieElement == undefined) {
        this.movieElement = document.getElementById(this.movieName);
    }

    if (this.movieElement === null) {
        throw "Could not find Flash element";
    }

    return this.movieElement;
};

// Private: buildParamString takes the name/value pairs in the post_params setting object
// and joins them up in to a string formatted "name=value&amp;name=value"
SWFUpload.prototype.buildParamString = function () {
    var postParams = this.settings.post_params;
    var paramStringPairs = [];

    if (typeof(postParams) === "object") {
        for (var name in postParams) {
            if (postParams.hasOwnProperty(name)) {
                paramStringPairs.push(encodeURIComponent(name.toString()) + "=" + encodeURIComponent(postParams[name].toString()));
            }
        }
    }

    return paramStringPairs.join("&amp;");
};

// Public: Used to remove a SWFUpload instance from the page. This method strives to remove
// all references to the SWF, and other objects so memory is properly freed.
// Returns true if everything was destroyed. Returns a false if a failure occurs leaving SWFUpload in an inconsistant state.
// Credits: Major improvements provided by steffen
SWFUpload.prototype.destroy = function () {
    try {
        // Make sure Flash is done before we try to remove it
        this.cancelUpload(null, false);


        // Remove the SWFUpload DOM nodes
        var movieElement = null;
        movieElement = this.getMovieElement();

        if (movieElement && typeof(movieElement.CallFunction) === "unknown") { // We only want to do this in IE
            // Loop through all the movie's properties and remove all function references (DOM/JS IE 6/7 memory leak workaround)
            for (var i in movieElement) {
                try {
                    if (typeof(movieElement[i]) === "function") {
                        movieElement[i] = null;
                    }
                } catch (ex1) {}
            }

            // Remove the Movie Element from the page
            try {
                movieElement.parentNode.removeChild(movieElement);
            } catch (ex) {}
        }

        // Remove IE form fix reference
        window[this.movieName] = null;

        // Destroy other references
        SWFUpload.instances[this.movieName] = null;
        delete SWFUpload.instances[this.movieName];

        this.movieElement = null;
        this.settings = null;
        this.customSettings = null;
        this.eventQueue = null;
        this.movieName = null;


        return true;
    } catch (ex2) {
        return false;
    }
};


// Public: displayDebugInfo prints out settings and configuration
// information about this SWFUpload instance.
// This function (and any references to it) can be deleted when placing
// SWFUpload in production.
SWFUpload.prototype.displayDebugInfo = function () {
    this.debug(
        [
            "---SWFUpload Instance Info---\n",
            "Version: ", SWFUpload.version, "\n",
            "Movie Name: ", this.movieName, "\n",
            "Settings:\n",
            "\t", "upload_url:               ", this.settings.upload_url, "\n",
            "\t", "flash_url:                ", this.settings.flash_url, "\n",
            "\t", "use_query_string:         ", this.settings.use_query_string.toString(), "\n",
            "\t", "requeue_on_error:         ", this.settings.requeue_on_error.toString(), "\n",
            "\t", "http_success:             ", this.settings.http_success.join(", "), "\n",
            "\t", "assume_success_timeout:   ", this.settings.assume_success_timeout, "\n",
            "\t", "file_post_name:           ", this.settings.file_post_name, "\n",
            "\t", "post_params:              ", this.settings.post_params.toString(), "\n",
            "\t", "file_types:               ", this.settings.file_types, "\n",
            "\t", "file_types_description:   ", this.settings.file_types_description, "\n",
            "\t", "file_size_limit:          ", this.settings.file_size_limit, "\n",
            "\t", "file_upload_limit:        ", this.settings.file_upload_limit, "\n",
            "\t", "file_queue_limit:         ", this.settings.file_queue_limit, "\n",
            "\t", "debug:                    ", this.settings.debug.toString(), "\n",

            "\t", "prevent_swf_caching:      ", this.settings.prevent_swf_caching.toString(), "\n",

            "\t", "button_placeholder_id:    ", this.settings.button_placeholder_id.toString(), "\n",
            "\t", "button_placeholder:       ", (this.settings.button_placeholder ? "Set" : "Not Set"), "\n",
            "\t", "button_image_url:         ", this.settings.button_image_url.toString(), "\n",
            "\t", "button_width:             ", this.settings.button_width.toString(), "\n",
            "\t", "button_height:            ", this.settings.button_height.toString(), "\n",
            "\t", "button_text:              ", this.settings.button_text.toString(), "\n",
            "\t", "button_text_style:        ", this.settings.button_text_style.toString(), "\n",
            "\t", "button_text_top_padding:  ", this.settings.button_text_top_padding.toString(), "\n",
            "\t", "button_text_left_padding: ", this.settings.button_text_left_padding.toString(), "\n",
            "\t", "button_action:            ", this.settings.button_action.toString(), "\n",
            "\t", "button_disabled:          ", this.settings.button_disabled.toString(), "\n",

            "\t", "custom_settings:          ", this.settings.custom_settings.toString(), "\n",
            "Event Handlers:\n",
            "\t", "swfupload_loaded_handler assigned:  ", (typeof this.settings.swfupload_loaded_handler === "function").toString(), "\n",
            "\t", "file_dialog_start_handler assigned: ", (typeof this.settings.file_dialog_start_handler === "function").toString(), "\n",
            "\t", "file_queued_handler assigned:       ", (typeof this.settings.file_queued_handler === "function").toString(), "\n",
            "\t", "file_queue_error_handler assigned:  ", (typeof this.settings.file_queue_error_handler === "function").toString(), "\n",
            "\t", "upload_start_handler assigned:      ", (typeof this.settings.upload_start_handler === "function").toString(), "\n",
            "\t", "upload_progress_handler assigned:   ", (typeof this.settings.upload_progress_handler === "function").toString(), "\n",
            "\t", "upload_error_handler assigned:      ", (typeof this.settings.upload_error_handler === "function").toString(), "\n",
            "\t", "upload_success_handler assigned:    ", (typeof this.settings.upload_success_handler === "function").toString(), "\n",
            "\t", "upload_complete_handler assigned:   ", (typeof this.settings.upload_complete_handler === "function").toString(), "\n",
            "\t", "debug_handler assigned:             ", (typeof this.settings.debug_handler === "function").toString(), "\n"
        ].join("")
    );
};

/* Note: addSetting and getSetting are no longer used by SWFUpload but are included
    the maintain v2 API compatibility
*/
// Public: (Deprecated) addSetting adds a setting value. If the value given is undefined or null then the default_value is used.
SWFUpload.prototype.addSetting = function (name, value, default_value) {
    if (value == undefined) {
        return (this.settings[name] = default_value);
    } else {
        return (this.settings[name] = value);
    }
};

// Public: (Deprecated) getSetting gets a setting. Returns an empty string if the setting was not found.
SWFUpload.prototype.getSetting = function (name) {
    if (this.settings[name] != undefined) {
        return this.settings[name];
    }

    return "";
};



// Private: callFlash handles function calls made to the Flash element.
// Calls are made with a setTimeout for some functions to work around
// bugs in the ExternalInterface library.
SWFUpload.prototype.callFlash = function (functionName, argumentArray) {
    argumentArray = argumentArray || [];

    var movieElement = this.getMovieElement();
    var returnValue, returnString;

    // Flash's method if calling ExternalInterface methods (code adapted from MooTools).
    try {
        returnString = movieElement.CallFunction('<invoke name="' + functionName + '" returntype="javascript">' + __flash__argumentsToXML(argumentArray, 0) + '</invoke>');
        returnValue = eval(returnString);
    } catch (ex) {
        throw "Call to " + functionName + " failed";
    }

    // Unescape file post param values
    if (returnValue != undefined && typeof returnValue.post === "object") {
        returnValue = this.unescapeFilePostParams(returnValue);
    }

    return returnValue;
};

/* *****************************
    -- Flash control methods --
    Your UI should use these
    to operate SWFUpload
   ***************************** */

// WARNING: this function does not work in Flash Player 10
// Public: selectFile causes a File Selection Dialog window to appear.  This
// dialog only allows 1 file to be selected.
SWFUpload.prototype.selectFile = function () {
    this.callFlash("SelectFile");
};

// WARNING: this function does not work in Flash Player 10
// Public: selectFiles causes a File Selection Dialog window to appear/ This
// dialog allows the user to select any number of files
// Flash Bug Warning: Flash limits the number of selectable files based on the combined length of the file names.
// If the selection name length is too long the dialog will fail in an unpredictable manner.  There is no work-around
// for this bug.
SWFUpload.prototype.selectFiles = function () {
    this.callFlash("SelectFiles");
};


// Public: startUpload starts uploading the first file in the queue unless
// the optional parameter 'fileID' specifies the ID
SWFUpload.prototype.startUpload = function (fileID) {
    this.callFlash("StartUpload", [fileID]);
};

// Public: cancelUpload cancels any queued file.  The fileID parameter may be the file ID or index.
// If you do not specify a fileID the current uploading file or first file in the queue is cancelled.
// If you do not want the uploadError event to trigger you can specify false for the triggerErrorEvent parameter.
SWFUpload.prototype.cancelUpload = function (fileID, triggerErrorEvent) {
    if (triggerErrorEvent !== false) {
        triggerErrorEvent = true;
    }
    this.callFlash("CancelUpload", [fileID, triggerErrorEvent]);
};

// Public: stopUpload stops the current upload and requeues the file at the beginning of the queue.
// If nothing is currently uploading then nothing happens.
SWFUpload.prototype.stopUpload = function () {
    this.callFlash("StopUpload");
};

/* ************************
 * Settings methods
 *   These methods change the SWFUpload settings.
 *   SWFUpload settings should not be changed directly on the settings object
 *   since many of the settings need to be passed to Flash in order to take
 *   effect.
 * *********************** */

// Public: getStats gets the file statistics object.
SWFUpload.prototype.getStats = function () {
    return this.callFlash("GetStats");
};

// Public: setStats changes the SWFUpload statistics.  You shouldn't need to
// change the statistics but you can.  Changing the statistics does not
// affect SWFUpload accept for the successful_uploads count which is used
// by the upload_limit setting to determine how many files the user may upload.
SWFUpload.prototype.setStats = function (statsObject) {
    this.callFlash("SetStats", [statsObject]);
};

// Public: getFile retrieves a File object by ID or Index.  If the file is
// not found then 'null' is returned.
SWFUpload.prototype.getFile = function (fileID) {
    if (typeof(fileID) === "number") {
        return this.callFlash("GetFileByIndex", [fileID]);
    } else {
        return this.callFlash("GetFile", [fileID]);
    }
};

// Public: addFileParam sets a name/value pair that will be posted with the
// file specified by the Files ID.  If the name already exists then the
// exiting value will be overwritten.
SWFUpload.prototype.addFileParam = function (fileID, name, value) {
    return this.callFlash("AddFileParam", [fileID, name, value]);
};

// Public: removeFileParam removes a previously set (by addFileParam) name/value
// pair from the specified file.
SWFUpload.prototype.removeFileParam = function (fileID, name) {
    this.callFlash("RemoveFileParam", [fileID, name]);
};

// Public: setUploadUrl changes the upload_url setting.
SWFUpload.prototype.setUploadURL = function (url) {
    this.settings.upload_url = url.toString();
    this.callFlash("SetUploadURL", [url]);
};

// Public: setPostParams changes the post_params setting
SWFUpload.prototype.setPostParams = function (paramsObject) {
    this.settings.post_params = paramsObject;
    this.callFlash("SetPostParams", [paramsObject]);
};

// Public: addPostParam adds post name/value pair.  Each name can have only one value.
SWFUpload.prototype.addPostParam = function (name, value) {
    this.settings.post_params[name] = value;
    this.callFlash("SetPostParams", [this.settings.post_params]);
};

// Public: removePostParam deletes post name/value pair.
SWFUpload.prototype.removePostParam = function (name) {
    delete this.settings.post_params[name];
    this.callFlash("SetPostParams", [this.settings.post_params]);
};

// Public: setFileTypes changes the file_types setting and the file_types_description setting
SWFUpload.prototype.setFileTypes = function (types, description) {
    this.settings.file_types = types;
    this.settings.file_types_description = description;
    this.callFlash("SetFileTypes", [types, description]);
};

// Public: setFileSizeLimit changes the file_size_limit setting
SWFUpload.prototype.setFileSizeLimit = function (fileSizeLimit) {
    this.settings.file_size_limit = fileSizeLimit;
    this.callFlash("SetFileSizeLimit", [fileSizeLimit]);
};

// Public: setFileUploadLimit changes the file_upload_limit setting
SWFUpload.prototype.setFileUploadLimit = function (fileUploadLimit) {
    this.settings.file_upload_limit = fileUploadLimit;
    this.callFlash("SetFileUploadLimit", [fileUploadLimit]);
};

// Public: setFileQueueLimit changes the file_queue_limit setting
SWFUpload.prototype.setFileQueueLimit = function (fileQueueLimit) {
    this.settings.file_queue_limit = fileQueueLimit;
    this.callFlash("SetFileQueueLimit", [fileQueueLimit]);
};

// Public: setFilePostName changes the file_post_name setting
SWFUpload.prototype.setFilePostName = function (filePostName) {
    this.settings.file_post_name = filePostName;
    this.callFlash("SetFilePostName", [filePostName]);
};

// Public: setUseQueryString changes the use_query_string setting
SWFUpload.prototype.setUseQueryString = function (useQueryString) {
    this.settings.use_query_string = useQueryString;
    this.callFlash("SetUseQueryString", [useQueryString]);
};

// Public: setRequeueOnError changes the requeue_on_error setting
SWFUpload.prototype.setRequeueOnError = function (requeueOnError) {
    this.settings.requeue_on_error = requeueOnError;
    this.callFlash("SetRequeueOnError", [requeueOnError]);
};

// Public: setHTTPSuccess changes the http_success setting
SWFUpload.prototype.setHTTPSuccess = function (http_status_codes) {
    if (typeof http_status_codes === "string") {
        http_status_codes = http_status_codes.replace(" ", "").split(",");
    }

    this.settings.http_success = http_status_codes;
    this.callFlash("SetHTTPSuccess", [http_status_codes]);
};

// Public: setHTTPSuccess changes the http_success setting
SWFUpload.prototype.setAssumeSuccessTimeout = function (timeout_seconds) {
    this.settings.assume_success_timeout = timeout_seconds;
    this.callFlash("SetAssumeSuccessTimeout", [timeout_seconds]);
};

// Public: setDebugEnabled changes the debug_enabled setting
SWFUpload.prototype.setDebugEnabled = function (debugEnabled) {
    this.settings.debug_enabled = debugEnabled;
    this.callFlash("SetDebugEnabled", [debugEnabled]);
};

// Public: setButtonImageURL loads a button image sprite
SWFUpload.prototype.setButtonImageURL = function (buttonImageURL) {
    if (buttonImageURL == undefined) {
        buttonImageURL = "";
    }

    this.settings.button_image_url = buttonImageURL;
    this.callFlash("SetButtonImageURL", [buttonImageURL]);
};

// Public: setButtonDimensions resizes the Flash Movie and button
SWFUpload.prototype.setButtonDimensions = function (width, height) {
    this.settings.button_width = width;
    this.settings.button_height = height;

    var movie = this.getMovieElement();
    if (movie != undefined) {
        movie.style.width = width + "px";
        movie.style.height = height + "px";
    }

    this.callFlash("SetButtonDimensions", [width, height]);
};
// Public: setButtonText Changes the text overlaid on the button
SWFUpload.prototype.setButtonText = function (html) {
    this.settings.button_text = html;
    this.callFlash("SetButtonText", [html]);
};
// Public: setButtonTextPadding changes the top and left padding of the text overlay
SWFUpload.prototype.setButtonTextPadding = function (left, top) {
    this.settings.button_text_top_padding = top;
    this.settings.button_text_left_padding = left;
    this.callFlash("SetButtonTextPadding", [left, top]);
};

// Public: setButtonTextStyle changes the CSS used to style the HTML/Text overlaid on the button
SWFUpload.prototype.setButtonTextStyle = function (css) {
    this.settings.button_text_style = css;
    this.callFlash("SetButtonTextStyle", [css]);
};
// Public: setButtonDisabled disables/enables the button
SWFUpload.prototype.setButtonDisabled = function (isDisabled) {
    this.settings.button_disabled = isDisabled;
    this.callFlash("SetButtonDisabled", [isDisabled]);
};
// Public: setButtonAction sets the action that occurs when the button is clicked
SWFUpload.prototype.setButtonAction = function (buttonAction) {
    this.settings.button_action = buttonAction;
    this.callFlash("SetButtonAction", [buttonAction]);
};

// Public: setButtonCursor changes the mouse cursor displayed when hovering over the button
SWFUpload.prototype.setButtonCursor = function (cursor) {
    this.settings.button_cursor = cursor;
    this.callFlash("SetButtonCursor", [cursor]);
};

/* *******************************
    Flash Event Interfaces
    These functions are used by Flash to trigger the various
    events.

    All these functions a Private.

    Because the ExternalInterface library is buggy the event calls
    are added to a queue and the queue then executed by a setTimeout.
    This ensures that events are executed in a determinate order and that
    the ExternalInterface bugs are avoided.
******************************* */

SWFUpload.prototype.queueEvent = function (handlerName, argumentArray) {
    // Warning: Don't call this.debug inside here or you'll create an infinite loop

    if (argumentArray == undefined) {
        argumentArray = [];
    } else if (!(argumentArray instanceof Array)) {
        argumentArray = [argumentArray];
    }

    var self = this;
    if (typeof this.settings[handlerName] === "function") {
        // Queue the event
        this.eventQueue.push(function () {
            this.settings[handlerName].apply(this, argumentArray);
        });

        // Execute the next queued event
        setTimeout(function () {
            self.executeNextEvent();
        }, 0);

    } else if (this.settings[handlerName] !== null) {
        throw "Event handler " + handlerName + " is unknown or is not a function";
    }
};

// Private: Causes the next event in the queue to be executed.  Since events are queued using a setTimeout
// we must queue them in order to garentee that they are executed in order.
SWFUpload.prototype.executeNextEvent = function () {
    // Warning: Don't call this.debug inside here or you'll create an infinite loop

    var  f = this.eventQueue ? this.eventQueue.shift() : null;
    if (typeof(f) === "function") {
        f.apply(this);
    }
};

// Private: unescapeFileParams is part of a workaround for a flash bug where objects passed through ExternalInterface cannot have
// properties that contain characters that are not valid for JavaScript identifiers. To work around this
// the Flash Component escapes the parameter names and we must unescape again before passing them along.
SWFUpload.prototype.unescapeFilePostParams = function (file) {
    var reg = /[$]([0-9a-f]{4})/i;
    var unescapedPost = {};
    var uk;

    if (file != undefined) {
        for (var k in file.post) {
            if (file.post.hasOwnProperty(k)) {
                uk = k;
                var match;
                while ((match = reg.exec(uk)) !== null) {
                    uk = uk.replace(match[0], String.fromCharCode(parseInt("0x" + match[1], 16)));
                }
                unescapedPost[uk] = file.post[k];
            }
        }

        file.post = unescapedPost;
    }

    return file;
};

// Private: Called by Flash to see if JS can call in to Flash (test if External Interface is working)
SWFUpload.prototype.testExternalInterface = function () {
    try {
        return this.callFlash("TestExternalInterface");
    } catch (ex) {
        return false;
    }
};

// Private: This event is called by Flash when it has finished loading. Don't modify this.
// Use the swfupload_loaded_handler event setting to execute custom code when SWFUpload has loaded.
SWFUpload.prototype.flashReady = function () {
    // Check that the movie element is loaded correctly with its ExternalInterface methods defined
    var movieElement = this.getMovieElement();

    if (!movieElement) {
        this.debug("Flash called back ready but the flash movie can't be found.");
        return;
    }

    this.cleanUp(movieElement);

    this.queueEvent("swfupload_loaded_handler");
};

// Private: removes Flash added fuctions to the DOM node to prevent memory leaks in IE.
// This function is called by Flash each time the ExternalInterface functions are created.
SWFUpload.prototype.cleanUp = function (movieElement) {
    // Pro-actively unhook all the Flash functions
    try {
        if (this.movieElement && typeof(movieElement.CallFunction) === "unknown") { // We only want to do this in IE
            this.debug("Removing Flash functions hooks (this should only run in IE and should prevent memory leaks)");
            for (var key in movieElement) {
                try {
                    if (typeof(movieElement[key]) === "function") {
                        movieElement[key] = null;
                    }
                } catch (ex) {
                }
            }
        }
    } catch (ex1) {

    }

    // Fix Flashes own cleanup code so if the SWFMovie was removed from the page
    // it doesn't display errors.
    window["__flash__removeCallback"] = function (instance, name) {
        try {
            if (instance) {
                instance[name] = null;
            }
        } catch (flashEx) {

        }
    };

};


/* This is a chance to do something before the browse window opens */
SWFUpload.prototype.fileDialogStart = function () {
    this.queueEvent("file_dialog_start_handler");
};


/* Called when a file is successfully added to the queue. */
SWFUpload.prototype.fileQueued = function (file) {
    file = this.unescapeFilePostParams(file);
    this.queueEvent("file_queued_handler", file);
};


/* Handle errors that occur when an attempt to queue a file fails. */
SWFUpload.prototype.fileQueueError = function (file, errorCode, message) {
    file = this.unescapeFilePostParams(file);
    this.queueEvent("file_queue_error_handler", [file, errorCode, message]);
};

/* Called after the file dialog has closed and the selected files have been queued.
    You could call startUpload here if you want the queued files to begin uploading immediately. */
SWFUpload.prototype.fileDialogComplete = function (numFilesSelected, numFilesQueued, numFilesInQueue) {
    this.queueEvent("file_dialog_complete_handler", [numFilesSelected, numFilesQueued, numFilesInQueue]);
};

SWFUpload.prototype.uploadStart = function (file) {
    file = this.unescapeFilePostParams(file);
    this.queueEvent("return_upload_start_handler", file);
};

SWFUpload.prototype.returnUploadStart = function (file) {
    var returnValue;
    if (typeof this.settings.upload_start_handler === "function") {
        file = this.unescapeFilePostParams(file);
        returnValue = this.settings.upload_start_handler.call(this, file);
    } else if (this.settings.upload_start_handler != undefined) {
        throw "upload_start_handler must be a function";
    }

    // Convert undefined to true so if nothing is returned from the upload_start_handler it is
    // interpretted as 'true'.
    if (returnValue === undefined) {
        returnValue = true;
    }

    returnValue = !!returnValue;

    this.callFlash("ReturnUploadStart", [returnValue]);
};



SWFUpload.prototype.uploadProgress = function (file, bytesComplete, bytesTotal) {
    file = this.unescapeFilePostParams(file);
    this.queueEvent("upload_progress_handler", [file, bytesComplete, bytesTotal]);
};

SWFUpload.prototype.uploadError = function (file, errorCode, message) {
    file = this.unescapeFilePostParams(file);
    this.queueEvent("upload_error_handler", [file, errorCode, message]);
};

SWFUpload.prototype.uploadSuccess = function (file, serverData, responseReceived) {
    file = this.unescapeFilePostParams(file);
    this.queueEvent("upload_success_handler", [file, serverData, responseReceived]);
};

SWFUpload.prototype.uploadComplete = function (file) {
    file = this.unescapeFilePostParams(file);
    this.queueEvent("upload_complete_handler", file);
};

/* Called by SWFUpload JavaScript and Flash functions when debug is enabled. By default it writes messages to the
   internal debug console.  You can override this event and have messages written where you want. */
SWFUpload.prototype.debug = function (message) {
    this.queueEvent("debug_handler", message);
};


/* **********************************
    Debug Console
    The debug console is a self contained, in page location
    for debug message to be sent.  The Debug Console adds
    itself to the body if necessary.

    The console is automatically scrolled as messages appear.

    If you are using your own debug handler or when you deploy to production and
    have debug disabled you can remove these functions to reduce the file size
    and complexity.
********************************** */

// Private: debugMessage is the default debug_handler.  If you want to print debug messages
// call the debug() function.  When overriding the function your own function should
// check to see if the debug setting is true before outputting debug information.
SWFUpload.prototype.debugMessage = function (message) {
    if (this.settings.debug) {
        var exceptionMessage, exceptionValues = [];

        // Check for an exception object and print it nicely
        if (typeof message === "object" && typeof message.name === "string" && typeof message.message === "string") {
            for (var key in message) {
                if (message.hasOwnProperty(key)) {
                    exceptionValues.push(key + ": " + message[key]);
                }
            }
            exceptionMessage = exceptionValues.join("\n") || "";
            exceptionValues = exceptionMessage.split("\n");
            exceptionMessage = "EXCEPTION: " + exceptionValues.join("\nEXCEPTION: ");
            SWFUpload.Console.writeLine(exceptionMessage);
        } else {
            SWFUpload.Console.writeLine(message);
        }
    }
};

SWFUpload.Console = {};
SWFUpload.Console.writeLine = function (message) {
    var console, documentForm;

    try {
        console = document.getElementById("SWFUpload_Console");

        if (!console) {
            documentForm = document.createElement("form");
            document.getElementsByTagName("body")[0].appendChild(documentForm);

            console = document.createElement("textarea");
            console.id = "SWFUpload_Console";
            console.style.fontFamily = "monospace";
            console.setAttribute("wrap", "off");
            console.wrap = "off";
            console.style.overflow = "auto";
            console.style.width = "700px";
            console.style.height = "350px";
            console.style.margin = "5px";
            documentForm.appendChild(console);
        }

        console.value += message + "\n";

        console.scrollTop = console.scrollHeight - console.clientHeight;
    } catch (ex) {
        alert("Exception: " + ex.name + " Message: " + ex.message);
    }
};
