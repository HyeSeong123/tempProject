SDE.Layer.EditingAttrProductBase = SDE.Layer.EditingAttrPreferenceBase.extend({
    TEMPLATE : '<h3>'+ __('SETTINGS.BY.DISPLAY.ITEM', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT') +'</h3>' +
    /*rev.b2.20130830.2@sinseki #SDE-16 리스트모듈의 경우, 속성에 출력갯수 입력 추가*/
    '<input type="hidden" class="attr-count" value="asd"\/>' +
    '<div class="attrArea">' +
        '<div class="list" data-view="list"></div>' +
        '<div class="section" data-view="section">' +
        '</div>' +
    '</div>',

    SECTION_TEMPLATE : '<div class="mBoard">' +
                            '<table border="1" summary="">' +
                                '<caption>'+ __('CLASSIFICATION.BY.PRODUCT', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT') +'</caption>' +
                                '<colgroup>' +
                                    '<col style="width:25%;">' +
                                    '<col style="width:auto;">' +
                                '</colgroup>' +
                                '<tbody>' +
                                    '<tr>' +
                                        '<th scope="row">'+ __('DISPLAY.ITEMS', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT') +'</th>' +
                                        '<td><span data-type="name"></span></td>' +
                                    '</tr>' +

                                    '<tr>' +
                                        '<th scope="row">'+ __('DISPLAY.NAME', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT') +'</th>' +
                                        '<td><input data-type="option_name"/></td>' +
                                    '</tr>' +

                                    '<tr>' +
                                        '<th scope="row">'+ __('SIZE', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT') +'</th>' +
                                        '<td>' +
                                            '<select data-type="font_size">' +
                                            '</select>' +
                                        '</td>' +
                                    '</tr>' +

                                    '<tr>' +
                                        '<th scope="row">'+ __('BOLD', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT') +'</th>' +
                                        '<td><a href="#none" data-type="font_type" data-font-type="bold" class="icoBold"><span>'+ __('BOLD', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT') +'</span></a></td>' +
                                    '</tr>' +

                                    '<tr>' +
                                        '<th scope="row">'+ __('ITALIC', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT') +'</th>' +
                                        '<td><a href="#none" data-type="font_type" data-font-type="italic" class="icoItalic"><span>'+ __('ITALIC', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT') +'</span></a></td>' +
                                    '</tr>' +

                                    '<tr>' +
                                        '<th scope="row">'+ __('COLOR', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT') +'</th>' +
                                        '<td>' +
                                            '<div class="mColorPicker eColorPicker"><input type="text" data-type="font_color" maxlength="7" readonly="readonly" value="" class="fText" style="width:50px"></div>' +
                                        '</td>' +
                                    '</tr>' +
                                 '</tbody>' +
                             '</table>' +
                         '</div>',

    KEYS : {
        'color_picker' : ['font_color']
    },

    PRIVILEGES : {
        'product_name' : __('PRODUCT.NAME', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT'),
        'manu_name' : __('MANUFACTURER', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT'),
        'made_in' : __('ORIGIN', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT'),
        'product_custom' : __('CONSUMERS', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT'),
        'product_price' : __('PRICE', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT'),
        'c_dc_price' : __('COUPON.DISCOUNT', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT'),
        'allotment_product' : __('NO.INTEREST.INSTALLMENT', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT'),
        'mileage_value' : __('RESERVES', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT'),
        'product_code' : __('PRODUCT.CODE', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT'),
        'quantity' : __('QUANTITY', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT'),
        'prd_price_org' : __('COMMODITY.PRICE', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT'),
        'prd_price_tax' : __('TAX.AMOUNT', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT'),
        'product_buy' : __('SUPPLY.COST', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT'),
        'prd_brand' : __('BRAND', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT'),
        'prd_model' : __('MODEL', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT'),
        'supplier_id' : __('SUPPLIER', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT'),
        'simple_desc' : __('PRODUCT.BRIEF.DESCRIPTION', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT'),
        'eng_product_name' : __('ENGLISH.PRODUCT.NAME', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT'),
        'ma_product_code' : __('OWN.PRODUCT.CODE', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT'),
        'summary_desc' : __('PRODUCT.SUMMARY', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT'),
        'review_cnt' : __('REVIEWS', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT'),
        'qna_cnt' : __('CONTACT.US', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT'),
        'relation_cnt' : __('RELATED.PRODUCT', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT'),
        'qrcode' : __('QR.CODE', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT'),
        'about_price' : __('ABOUT', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT'),
        'print_date' : __('DATE.OF.MANUFACTURE', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT'),
        delivery_title: __('OVERSEAS.SHIPPING', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT'),
        delivery: __('SHIPPING.METHOD', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT'),
        delivery_price: __('SHIPPING.FEE', 'EDITOR.LAYER.EDITING.ATTR.PRODUCT')
    },

    REQUIRED_VARIABLES : ['item_title', 'item_content'],

    set : function(type, key) {
        var i;

        this.moduleKey = key;
        this.preferences = SDE.Util.Preference.get(this._getPreferenceName());
    },

    render : function() {
        this._super();

        this._renderCategoryList();

        /*rev.b12.20130829.12@sinseki #SDE-16 리스트모듈의 경우, 속성에 출력갯수 입력 추가*/
        this.attrcount = SDE.editor.getSelection().match(/\$count\s*=\s*(\d+)/i) || [];
        this.$element.filter('.attr-count').val(this.attrcount[1]);

        return this.$element;
    },

    /*rev.b3.20130829.3@sinseki #SDE-16 리스트모듈의 경우, 속성에 출력갯수 입력 추가*/
    save : function() {
        var content = SDE.editor.getSelection();
        var precontent = content;
        if (this.attrcount.length) {
            content = content.replace(this.attrcount[0], "$count = "+(this.$element.filter('.attr-count').val() || 12));
        }
        (precontent != content) && SDE.editor.replaceSelection(content);
        return this._super();
    },

    _getPreferenceName : function(key) {
        // Implement
    },

    _onClickList : function(evt, key) {
        this.currentKey = key;

        this._showSection(this.preferences[key]);
    },

    _processData : function(data) {
        if (this.data[this.currentKey]) {
            data = $.extend({}, data, this.data[this.currentKey]);
        }

        return data;
    },

    _render : function() {
        this._super();

        this.List = new SDE.Component.List(this.$list);

        $(this.List).bind({
            'list-click' : $.proxy(this._onClickList, this)
        });
    },

    _renderCategoryList : function() {
        var data = [], i, key, pref;

        for (i in this.preferences) {
            pref = this.preferences[i],
            key = pref['option_code'];

            if (!key || this._getPreferenceName() != 'product_detaildesign' && key == 'product_name') continue;

            data.push({
                'key' : key,
                'name' : pref['original_title']
            });
        }

        this.List.setData(data);
        this.List.render(true);
    },

    _renderText : function() {
        var name = 'option_name';

        this.$optionName = this.$section.find('[data-type=option_name]')
                            .blur($.proxy(this._onBlurText, this));

        this.$name = this.$section.find('[data-type=name]');
    },

    _renderSelect : function() {
        var i = 8,
            html = '';

        for (; i <= 20; i++) {
            html += '<option value="'+ i +'">'+ i +'px</option>';
        }

        this.$fontSize = this.$section.find('[data-type=font_size]')
                            .html(html)
                            .change($.proxy(this._onChangeFontSize, this));
    },

    _renderButton : function() {
        this.$fontType = this.$section.find('[data-type=font_type]')
                            .click($.proxy(this._onClickFontType, this));
    },

    _renderSection : function() {
        this._super();

        this._renderColorPicker();

        this._renderText();

        this._renderSelect();

        this._renderButton();
    },

    _setSection : function(data) {
        var name, $fontType = $();

        this._super(data);

        this.$optionName.val(data['option_name']);

        this.$fontSize.val(data['font_size']);

        // set font type
        switch (data['font_type']) {
            case 'B':
                $fontType = this.$fontType.filter('[data-font-type=bold]');
                break;

            case 'C':
                $fontType = this.$fontType.filter('[data-font-type=italic]');
                break;

            case 'D':
                $fontType = this.$fontType;
                break;
        }

        $fontType.addClass('selected');
        this.currentFontType = data['font_type'];

        this.$name.html(data['original_title']);
    },

    _onBlurText : function(evt) {
        this._setData('option_name', this.$optionName.val());
    },

    _onChangeFontSize : function(evt) {
        this._setData('font_size', this.$fontSize.val());
    },

    _onClickFontType : function(evt) {
        var $target = $(evt.target),
            fontType = $target.data('font-type'),
            selected = !$target.hasClass('selected'),
            currentValue = this.currentFontType,
            value = 'A';

        $target.toggleClass('selected');

        if (selected) {
            if (currentValue == 'A') {
                value = (fontType == 'bold') ? 'B' : 'C';
            } else {
                value = 'D';
            }
        } else if (currentValue == 'D') {
            value = (fontType == 'bold') ? 'C' : 'B';
        }

        this._setData('font_type', value);
        this.currentFontType = value;
    },

    _setCurrentPref : function(data) {
        this.currentPref = this.currentKey;
    }
});

SDE.Layer.EditingAttrProductDetail = SDE.Layer.EditingAttrProductBase.extend({
    HELP_LINK_KEY : 'product_detail',

    _getPreferenceName : function() {
        return 'product_detaildesign';
    }
});

SDE.Layer.EditingAttrProductList = SDE.Layer.EditingAttrProductBase.extend({
    HELP_LINK_KEY : 'product_normalpackage',

    _getPreferenceName : function(key) {
        return this.moduleKey;
    }
});

SDE.Layer.EditingAttrCategoryBase = SDE.Layer.EditingAttrPreferenceBase.extend({
    TEMPLATE : '<h3>' + __('BY.PRODUCT.CATEGORY', 'EDITOR.JS.LAYER.EDITION.ATTR.CATEGORYBASE') + '</h3>' +
    '<div class="attrArea">' +
        '<div class="list" data-view="list"></div>' +
        '<div class="section" data-view="section">' +
        '</div>' +
    '</div>',

    set : function(type, key) {
        var key, i, names = ['category_image', 'category_image_over', 'banner_image', 'top_image', 'top_image2', 'top_image3'];

        this.moduleKey = key;
        this.preferences = SDE.Util.Preference.get(this._getPreferenceName());

        // 이미지 위치 예외 처리. db에는 파일명만 저장 되어있음
        for (key in this.preferences) {
            for (i in names) {
                var url = this.preferences[key][names[i]];

                if (!url) continue;

                this.preferences[key][names[i]] = this.preferences.sObjectStorageUrl + '/web/upload/' + url;
            }
        }
    },

    render : function() {
        this._super();

        this.List.render();

        return this.$element;
    },

    _getPreferenceName : function(key) {
        return 'product_category';
    },

    _onClickList : function(evt, key) {
        this.currentKey = key;

        this._showSection(this.preferences[key]);
    },

    _onRadioChanged : function(evt, val) {
        this._super(evt, val);

        this._setRadioDisplay(evt.target.name, val);
    },

    _processData : function(data) {
        if (this.data[this.currentKey]) {
            data = $.extend({}, data, this.data[this.currentKey]);
        }

        return data;
    },

    _render : function() {
        this._super();

        this.List = new SDE.Component.CategoryList(this.$list);

        $(this.List).bind({
            'list-click' : $.proxy(this._onClickList, this)
        });
    },

    _renderSection : function() {
        this._super();

        this._renderImages();

        this._renderRadio();
    },

    _setSection : function(data, name) {
        var radioKeys = this.KEYS['radio'],
            i, key;

        this._super(data);

        // radio button에 따른 display 설정
        for (i in radioKeys) {
            key = radioKeys[i];

            this._setRadioDisplay(key, data[key]);
        }

        var topImage = this.preferences[this.currentPref]['top_image'];
        var topImage2 = this.preferences[this.currentPref]['top_image2'];
        var topImage3 = this.preferences[this.currentPref]['top_image3'];
        if (topImage === null)  topImage = '';
        if (topImage2 === null)  topImage2 = '';
        if (topImage3 === null)  topImage3 = '';
        this._setData('top_image',  topImage);
        this._setData('top_image2', topImage2);
        this._setData('top_image3', topImage3);
    },

    _setCurrentPref : function(data) {
        this.currentPref = this.currentKey;
    }
});

SDE.Layer.EditingAttrCategoryList = SDE.Layer.EditingAttrCategoryBase.extend({
    SECTION_TEMPLATE : '<div class="mBoard">' +
                            '<table border="1" summary="">' +
                                '<caption>'+ __('CLASSIFICATION.BY.PRODUCT', 'EDITOR.LAYER.EDITING.ATTR.CATEGORYLIST') +'</caption>' +
                                '<colgroup>' +
                                    '<col style="width:25%;">' +
                                    '<col style="width:auto;">' +
                                '</colgroup>' +

                                '<tbody>' +
                                    '<tr>' +
                                        '<th scope="row">'+ __('MENU.IMAGE', 'EDITOR.LAYER.EDITING.ATTR.CATEGORYLIST') +'</th>' +
                                        '<td>' +
                                            '<label class="fChk"><input type="radio" data-type="use_image" name="use_image" value="T"> '+ __('USED', 'EDITOR.LAYER.EDITING.ATTR.CATEGORYLIST') +'</label>' +
                                            '<label class="fChk"><input type="radio" data-type="use_image" name="use_image" value="F"> '+ __('NOT.USED', 'EDITOR.LAYER.EDITING.ATTR.CATEGORYLIST') +'</label>' +
                                            '<div data-radio="use_image" data-radio-value="T">' +
                                                '<div class="gFrame">' +
                                                    '<span class="gWidth type1">'+ __('BASIC', 'EDITOR.LAYER.EDITING.ATTR.CATEGORYLIST') +'</span>' +
                                                    '<div class="frameSelect" data-type="category_image">' +

                                                    '</div>' +
                                                '</div>' +

                                                '<div class="gFrame">' +
                                                    '<span class="gWidth type1">'+ __('ROLLOVER', 'EDITOR.LAYER.EDITING.ATTR.CATEGORYLIST') +'</span>' +
                                                    '<div class="frameSelect" data-type="category_image_over">' +

                                                    '</div>' +
                                                '</div>' +
                                            '</div>' +
                                        '</td>' +
                                    '</tr>' +

                                '</tbody>' +
                            '</table>' +
                        '</div>',

    KEYS : {
        'image' : ['category_image', 'category_image_over'],
        'radio' : ['use_image']
    },

    REQUIRED_VARIABLES : ['name_or_img_tag'],

    HELP_LINK_KEY : 'layout_category',
});

SDE.Layer.EditingAttrCategoryHead = SDE.Layer.EditingAttrCategoryBase.extend({
    SECTION_TEMPLATE : '<div class="mBoard">' +
                            '<table border="1" summary="">' +
                                '<caption>'+ __('CLASSIFICATION.BY.PRODUCT', 'EDITOR.LAYER.EDITING.ATTR.CATEGORYHEAD') +'</caption>' +
                                '<colgroup>' +
                                    '<col style="width:25%;">' +
                                    '<col style="width:auto;">' +
                                '</colgroup>' +

                                '<tbody>' +
                                    '<tr>' +
                                        '<th scope="row">'+ __('TOP.IMAGE', 'EDITOR.LAYER.EDITING.ATTR.CATEGORYHEAD') +'</th>' +
                                        '<td>' +
                                            '<label class="fChk"><input type="radio" data-type="use_top_image" name="use_top_image" value="T"> '+ __('USED', 'EDITOR.LAYER.EDITING.ATTR.CATEGORYHEAD') +'</label>' +
                                            '<label class="fChk"><input type="radio" data-type="use_top_image" name="use_top_image" value="F"> '+ __('NOT.USED', 'EDITOR.LAYER.EDITING.ATTR.CATEGORYHEAD') +'</label>' +
                                            '<ul class="gSelectList">' +
                                            '<li>' +
                                                '<div class="gSingle" data-radio="use_top_image" data-radio-value="T">' +
                                                    //'<span class="gWidth type1">기본</span>' +
                                                    '<div class="frameSelect" data-type="top_image">' +
                                                    '</div>' +
                                                '</div>' +
                                            '</li>' +
                                            '<li>' +
                                                '<div class="gSingle" data-radio="use_top_image" data-radio-value="T">' +
                                                    //'<span class="gWidth type1">기본</span>' +
                                                    '<div class="frameSelect" data-type="top_image2">' +
                                                    '</div>' +
                                                '</div>' +
                                            '</li>' +
                                            '<li>' +
                                                '<div class="gSingle" data-radio="use_top_image" data-radio-value="T">' +
                                                    //'<span class="gWidth type1">기본</span>' +
                                                    '<div class="frameSelect" data-type="top_image3">' +
                                                    '</div>' +
                                                '</div>' +
                                            '</li>' +
                                            '</ul>' +
                                            '<ul class="gFormInfo">' +
                                                '<li>'+ __('IMAGE.CAN.ADDED', 'EDITOR.LAYER.EDITING.ATTR.CATEGORYHEAD') +'</li>' +
                                                '<li>'+ __('SET.ITEM.MANAGEMENT.CLASSIFICATION.CLASSIFICATION', 'EDITOR.LAYER.EDITING.ATTR.CATEGORYHEAD') +'</li>' +
                                            '</ul>' +
                                        '</td>' +
                                    '</tr>' +

                                    '<tr>' +
                                        '<th scope="row">'+ __('TITLE.IMAGE', 'EDITOR.LAYER.EDITING.ATTR.CATEGORYHEAD') +'</th>' +
                                        '<td>' +
                                            '<label class="fChk"><input type="radio" data-type="use_b_image" name="use_b_image" value="T"> '+ __('USED', 'EDITOR.LAYER.EDITING.ATTR.CATEGORYHEAD') +'</label>' +
                                            '<label class="fChk"><input type="radio" data-type="use_b_image" name="use_b_image" value="F"> '+ __('NOT.USED', 'EDITOR.LAYER.EDITING.ATTR.CATEGORYHEAD') +'</label>' +

                                            '<div class="gFrame" data-radio="use_b_image" data-radio-value="T">' +
                                                '<span class="gWidth type1">'+ __('BASIC', 'EDITOR.LAYER.EDITING.ATTR.CATEGORYHEAD') +'</span>' +
                                                '<div class="frameSelect" data-type="banner_image">' +
                                                '</div>' +
                                            '</div>' +
                                        '</td>' +
                                    '</tr>' +

                                '</tbody>' +
                            '</table>' +
                        '</div>',

    KEYS : {
        'image' : ['banner_image', 'top_image', 'top_image2', 'top_image3'],
        'radio' : ['use_b_image', 'use_top_image']
    },

    REQUIRED_VARIABLES : ['top_image_tag', 'title_text_or_image'],

    HELP_LINK_KEY : 'product_menupackage',

    getParams : function() {
        return {
            'cate_no': this.currentPref
        };

        //var result = {}, key;
        //
        //for (key in this.data) {
        //    result['cate_no'] = key;
        //
        //  break;
        //}

        //return result;
    },
    renderAfter : function() {
        //var self = this;

        //$('.gSelectList li .frame').dblclick(function() {
        //   var dataType = $(this).parent().parent().attr('data-type');
        //   self._setData(dataType, '');
        //   $(this).find('img').attr('src', '//img.echosting.cafe24.com/smartAdmin/img/editor/@img_product.jpg');
        //});

        //$('.gSelectList').sortable({
        //    stop: function(ev, ui) {
        //        $(ui.item).parent().find('li').each(function(i) {
        //            var key = i + 1;
        //            var name = 'top_image';
        //            if (key > 1)
        //                name += key;

        //            var src = self.data[self.currentPref][name];
        //            self._setData(name, src);

        //            $(this).find('.frameSelect').attr('data-type', name);
        //        });
        //    }
        //});
    }
});

SDE.Layer.EditingAttrMobileLogo = SDE.Layer.EditingAttrPreferenceBase.extend({
    SECTION_TEMPLATE :
        '<h3>'+ __('TITLE.REGISTRATION', 'EDITOR.LAYER.EDITING.ATTR.M.LOGO') +'</h3>'+
        '<form id="frm_editor_mobile_logotop">'+
        '<div class="section titleResistration">'+
            '<ul class="mForm">'+
                '<li>'+
                    '<label class="gLabel"><input type="radio" name="is_title" value="T"> '+ __('TEXT', 'EDITOR.LAYER.EDITING.ATTR.M.LOGO') +'</label>'+
                    '<div class="addForm show"> <!-- radio버튼 활성화 시 show클래스 추가 -->'+
                        '<input type="text" name="title_text" value="" style="width:250px;" maxlength="14" />'+
                        '<span class="txtByte" title="'+ __('CHARACTERS.MAXIMUM.NUMBER', 'EDITOR.LAYER.EDITING.ATTR.M.LOGO') +'">[ <strong>0</strong> / 14 ]</span>'+
                    '</div>'+
                '</li>'+
                '<li>'+
                    '<label class="gLabel"><input type="radio" name="is_title" value="I" checked="checked"> '+ __('IMAGE', 'EDITOR.LAYER.EDITING.ATTR.M.LOGO') +'</label>'+
                    '<div class="addForm show"> <!-- radio버튼 활성화 시 show클래스 추가 -->'+
                        '<input type="file" accept="image/*" name="title_img" size="22" style="width:250px;" />'+
                        '<p class="txtInfo">'+ __('LESS.GIF.PNG.JPGJPEG', 'EDITOR.LAYER.EDITING.ATTR.M.LOGO') +'</p>'+
                        // 관리자>모바일쇼핑몰>환경 설정에 이미지 미리보기 없음
                        //'<span class="frame gSingle"><img src="//img.echosting.cafe24.com/smartAdmin/img/editor/@img_product1.gif" alt="" /></span>'+
                    '</div>'+
                '</li>'+
            '</ul>'+
            '<p class="typeInfo"><span class="ico"></span>'+ __('MOBILE.SHOPPING.PREFERENCES.SCREEN.SETTINGS', 'EDITOR.LAYER.EDITING.ATTR.M.LOGO') +'</p>'+
        '</div>'+
        '</form>',

    // submit 진행중 여부
    bIsSubmitRunning: false,
    // proxy submit 성공여부
    bIsComplete: false,

    // UI 표시
    render: function(){
        this.bIsSubmitRunning = false;
        this.bIsComplete = false;

        var $element = $(this.SECTION_TEMPLATE);
        $.ajax({
            async: false,
            data: {get_data: 'T'},
            dataType: 'json',
            url: getMultiShopUrl('/exec/admin/manage/mobilelogotop/'),
            success: function(aResult){
                if (!aResult) return false;

                if (aResult.is_title === 'T') {
                    $element.find('input:radio[value="T"]').attr('checked', 'checked');
                } else {
                    $element.find('input:radio[value="I"]').attr('checked', 'checked');
                }

                $element.find('input:text[name="title_text"]').val(aResult.title_text);
            }
        });

        // input:text maxlength
        var fKeyup = function(inputText){
            var sStr = new String(inputText.val());
            var iMaxCount = parseInt(inputText.attr('maxlength'), 10);
            var iByte = 0;
            var iRealLen = 0;
            for (var i = 0; i < sStr.length; i++) {
                var cChar = sStr.charAt(i);
                if (escape(cChar).length > 4) {
                    iByte += 2;
                } else {
                    iByte++;
                }

                if (iByte <= iMaxCount) iRealLen = i + 1;
            }

            if (iByte > iMaxCount) {
                iByte = iMaxCount;
                sStr = sStr.substr(0, iRealLen);
                inputText.val(sStr);
                alert(__('MESSAGE.SHOULD.BE.BYTES', 'EDITOR.LAYER.EDITING.ATTR.M.LOGO'));
                return false;
            }

            inputText.parent().find('span.txtByte strong').text(iByte);
        };
        var inputTextTitleText = $element.find('input:text[name="title_text"]');
        fKeyup(inputTextTitleText);
        inputTextTitleText.keyup(function(){
            fKeyup($(this));
        });

        return $element;
    },

    // 적용 버튼 클릭
    save: function(){
        // complete 상태라면 완료
        if (this.bIsComplete === true) {
            return true;
        }

        // 이미 submit 진행중이면 중지
        if (this.bIsSubmitRunning === true) {
            return false;
        }

        // 유효성 체크
        if (this._validate() === false) {
            return false;
        }

        this.bIsSubmitRunning = true;

        // form.submit
        var self = this;
        var $frm = $('#frm_editor_mobile_logotop');
        var sAction = getMultiShopUrl('/exec/admin/manage/mobilelogotop');

        ProxySubmit.submit($frm, sAction, function(sResult){
            self.bIsSubmitRunning = false;

            if (!sResult) {
                alert(__('TITLE.REGISTRATION.FAILED', 'EDITOR.LAYER.EDITING.ATTR.M.LOGO'));
                return false;
            }

            var aResult = $.parseJSON(sResult);
            // 성공 - 무조건 통과시키게 세팅해놓고 '적용'버튼을 한 번 더 누름
            if (('result' in aResult) && aResult.result === true) {
                self.bIsComplete = true;
                $('#layEditor .layButton .btnSubmit').click();
            // 실패
            } else {
                self.bIsComplete = false;
                alert(__('TITLE.REGISTRATION.FAILED', 'EDITOR.LAYER.EDITING.ATTR.M.LOGO'));
            }
        });

        return false;
    },

    // 유효성 체크
    _validate: function(){
        var $frm = $('#frm_editor_mobile_logotop');

        var $isTitleT = $frm.find('input:radio[value="T"]');
        if ($isTitleT.attr('checked')) {
            var $titleText = $frm.find('input:text[name="title_text"]');
            if ($.trim($titleText.val()).length < 1) {
                alert(__('PLEASE.ENTER.TITLE.TEXT', 'EDITOR.LAYER.EDITING.ATTR.M.LOGO'));
                $titleText.focus();
                return false;
            }
        }

        return true;
    }
});

SDE.Layer.EditingAttrMobileMainBanner = SDE.Layer.EditingAttrPreferenceBase.extend({
    SECTION_TEMPLATE :
        '<h3>'+ __('REGISTER.MAIN.BANNER', 'EDITOR.LAYER.EDITING.ATTR.M.MAINBANNER') +'</h3>'+
        '<form id="frm_editor_mobile_mainbanner">'+
        '<div class="section">'+
            '<div class="mBoard">'+
                '<table border="1" summary="">'+
                '<caption>'+ __('REGISTER.MAIN.BANNER', 'EDITOR.LAYER.EDITING.ATTR.M.MAINBANNER') +'</caption>'+
                '<colgroup>'+
                    '<col style="width:60px;" />'+
                    '<col style="width:80px;" />'+
                    '<col style="width:25%;" />'+
                    '<col style="width:25%;" />'+
                    '<col style="width:80px;" />'+
                '</colgroup>'+
                '<thead>'+
                    '<tr>'+
                        '<th scope="col">'+ __('ORDER', 'EDITOR.LAYER.EDITING.ATTR.M.MAINBANNER') +'</th>'+
                        '<th scope="col">'+ __('EDIT', 'EDITOR.LAYER.EDITING.ATTR.M.MAINBANNER') +'</th>'+
                        '<th scope="col">'+ __('IMAGE.REGISTRATION', 'EDITOR.LAYER.EDITING.ATTR.M.MAINBANNER') +'</th>'+
                        '<th scope="col">'+ __('LINK.URL', 'EDITOR.LAYER.EDITING.ATTR.M.MAINBANNER') +'</th>'+
                        '<th scope="col">'+ __('DELETE.ADD', 'EDITOR.LAYER.EDITING.ATTR.M.MAINBANNER') +'</th>'+
                    '</tr>'+
                '</thead>'+
                '<tbody class="mobile_mainbanner_tbody">'+
                /*
                '<tr>'+
                    '<input type="hidden" name="image_no[0]" value="0" />'+
                    '<td name="seq">1</td>'+
                    '<td class="center">'+
                        '<button type="button" class="btnMove icoPrev">선택한 항목 한줄 아래로 이동</button> '+
                        '<button type="button" class="btnMove icoNext">선택한 항목 한줄 위로 이동</button>'+
                    '</td>'+
                    '<td>'+
                        '<input type="file" name="banner_image[0]" size="22" class="fFile" />'+
                        '<span class="frame gSingle"><img src="//img.echosting.cafe24.com/smartAdmin/img/editor/@img_product2.gif" style="width:200px; max-width:200px;" alt="" /></span>'+
                    '</td>'+
                    '<td><input type="text" class="fText" name="link_url[0]" style="width:98%;" /></td>'+
                    '<td class="center">'+
                        '<button type="button" class="btnOption del">배너 삭제</button> '+
                        '<button type="button" class="btnOption add">배너 추가</button>'+
                    '</td>'+
                '</tr>'+
                */
                '</tbody>'+
                '</table>'+
                '<ul class="txtInfo">'+
                    '<li>'+ __('EXTENSION.GIF.JPG.PNG', 'EDITOR.LAYER.EDITING.ATTR.M.MAINBANNER') +'</li>'+
                    '<li>'+ __('YOU.REGISTERED.BANNER', 'EDITOR.LAYER.EDITING.ATTR.M.MAINBANNER') +'</li>'+
                    '<li>'+ __('UP.TO.CAN.BE.REGISTERED', 'EDITOR.LAYER.EDITING.ATTR.M.MAINBANNER') +'</li>'+
                '</ul>'+
            '</div>'+
            '<p class="typeInfo"><span class="ico"></span>'+ __('MODIFIED.MOBILE.SHOPPING.PREFERENCES.SCREEN.SETTINGS', 'EDITOR.LAYER.EDITING.ATTR.M.MAINBANNER') +'</p>'+
        '</div>'+
        '</form>',

    // submit 진행중 여부
    bIsSubmitRunning: false,
    // proxy submit 성공여부
    bIsComplete: false,
    // 배너 최대수
    iMaxBanner: 5,

    // UI 표시
    render: function(){
        this.bIsSubmitRunning = false;
        this.bIsComplete = false;

        var self = this;
        var $element = $(this.SECTION_TEMPLATE);
        $.ajax({
            async: false,
            data: {get_data: 'T'},
            dataType: 'json',
            url: getMultiShopUrl('/exec/admin/manage/mobilemainbanner/'),
            success: function(aResult){
                // 이미 등록된 배너 데이터가 없을 경우
                if (!aResult || aResult.length < 1) {
                    self._add({container: $element});
                // 등록된 배너 데이터 있음
                } else {
                    for (var i=0; i<aResult.length; i++) {
                        var iImageNo = aResult[i].image_no;
                        var sLinkUrl = aResult[i].link_url;
                        var sImgSrc = '//'+location.hostname+'/web/mobile/'+aResult[i].image_filename;

                        self._add({
                            container: $element,
                            iImageNo:  iImageNo,
                            sLinkUrl:  sLinkUrl,
                            sImgSrc:   sImgSrc
                        });
                    }
                }
            }
        });

        return $element;
    },

    // tr 추가
    _add: function(aParam){
        // 옵션 기본값
        var aDefaultParam = {
            container: $('#frm_editor_mobile_mainbanner'),
            iImageNo:  0,
            sLinkUrl:  '',
            sImgSrc:   '//img.echosting.cafe24.com/smartAdmin/img/editor/@img_product2.gif',
            $trBefore: null
        };
        $.extend(aDefaultParam, aParam);

        var self = this;

        // 추가할 tr template
        var $tr = $('<tr>'+
            '<input type="hidden" name="image_no[]" value="'+aDefaultParam.iImageNo+'" />'+
            '<td name="seq" class="center"></td>'+
            '<td class="center">'+
                '<button type="button" class="btnMove icoPrev">'+ __('MOVE.SELECTED.ITEM', 'EDITOR.LAYER.EDITING.ATTR.M.MAINBANNER') +'</button> '+
                '<button type="button" class="btnMove icoNext">'+ __('MOVE.SELECTED.ITEM.001', 'EDITOR.LAYER.EDITING.ATTR.M.MAINBANNER') +'</button>'+
            '</td>'+
            '<td>'+
                '<input type="file" accept="image/*" name="banner_image[]" size="22" class="fFile" />'+
                '<span class="frame gSingle"><img class="img_preview" src="'+aDefaultParam.sImgSrc+'" style="width:200px; max-width:200px;" alt="" /></span>'+
            '</td>'+
            '<td><input type="text" class="fText" name="link_url[]" value="'+aDefaultParam.sLinkUrl+'" style="width:98%;" /></td>'+
            '<td class="center">'+
                '<button type="button" class="btnOption del">'+ __('DELETE.BANNER', 'EDITOR.LAYER.EDITING.ATTR.M.MAINBANNER') +'</button> '+
                '<button type="button" class="btnOption add">'+ __('ADD.BANNER', 'EDITOR.LAYER.EDITING.ATTR.M.MAINBANNER') +'</button>'+
            '</td>'+
        '</tr>');

        $tbody = aDefaultParam.container.find('tbody.mobile_mainbanner_tbody');

        // 마지막에 append
        if (aDefaultParam.$trBefore === null) {
            $tbody.append($tr);
        // 중간에 append
        } else {
            aDefaultParam.$trBefore.after($tr);
        }

        // seq 적용
        this._setSeq($tbody);

        // input:file - 이미지 미리보기
        $tr.find('input:file').change(function(){
            $inputFile = $(this);
            $img       = $(this).parent().find('img.img_preview');

            if (window.navigator.userAgent.indexOf("MSIE") > -1) {
                var sImgPath = "";

                if ($inputFile.val().indexOf("\\fakepath\\") < 0) {
                    sImgPath = $inputFile.val();
                } else {
                    $inputFile.get(0).select();

                    try {
                       var selectionRange = document.selection.createRange();
                       sImgPath = selectionRange.text.toString();
                       $inputFile.blur();
                    } catch(e) {}
                }

                $img.css('filter', 'progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=image)');
                $img.get(0).filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = sImgPath;
                $img.css('width', '200px');
            } else {
                try {
                    var reader = new FileReader();
                    reader.onload = function(e){
                        $img.attr('src', e.target.result).css({'max-width':'200px', width:200});
                    };

                    reader.readAsDataURL($inputFile.attr('files')[0]);
                } catch(e) {
                }
            }
        });

        // 위로
        $tr.find('button.icoPrev').click(function(){
            // 최상위라면 skip
            if ($tr.index() === 0) return false;

            $tr.prev().before($tr);
            self._setSeq($tbody);
        });
        // 아래로
        $tr.find('button.icoNext').click(function(){
            // 최하위라면 skip
            if ($tr.index() >= ($tbody.find('tr').size()-1)) return false;

            $tr.next().after($tr);
            self._setSeq($tbody);
        });
        // 추가
        $tr.find('button.add').click(function(){
            // 5개 제한
            if ($tbody.find('tr').size() >= self.iMaxBanner) return false;

            self._add({$trBefore: $tr});
            self._setSeq($tbody);
        });
        // 삭제
        $tr.find('button.del').click(function(){
            $tr.remove();
            // 전부 삭제했다면 빈 tr 하나 추가
            if ($tbody.find('tr').size() < 1) self._add();

            self._setSeq($tbody);
        });
    },

    // tr sequence 재적용
    _setSeq: function($tbody){
        var iMaxBanner = this.iMaxBanner;
        var iSeq = 0;
        $tbody.find('tr').each(function(){
            $(this).find('input[name^="image_no["]').attr('name', 'image_no['+iSeq+']');
            $(this).find('td[name="seq"]').text(iSeq + 1);
            $(this).find('input[name^="banner_image["]').attr('name', 'banner_image['+iSeq+']');
            $(this).find('input[name^="link_url["]').attr('name', 'link_url['+iSeq+']');

            // 추가,삭제 버튼 visibility
            $(this).find('button.btnOption').css('visibility', 'visible');
            if (iSeq >= iMaxBanner-1) {
                $(this).find('button.btnOption.add').css('visibility', 'hidden');
            }

            ++iSeq;
        });
    },

    // 적용 버튼 클릭
    save: function(){
        // complete 상태라면 완료
        if (this.bIsComplete === true) {
            return true;
        }

        // 이미 submit 진행중이면 중지
        if (this.bIsSubmitRunning === true) {
            return false;
        }

        // 유효성 체크
        if (this._validate() === false) {
            return false;
        }

        this.bIsSubmitRunning = true;

        // form.submit
        var self = this;
        var $frm = $('#frm_editor_mobile_mainbanner');
        var sAction = getMultiShopUrl('/exec/admin/manage/mobilemainbanner');

        ProxySubmit.submit($frm, sAction, function(sResult){
            self.bIsSubmitRunning = false;

            if (!sResult) {
                alert(__('REGISTRATION.FAILED', 'EDITOR.LAYER.EDITING.ATTR.M.MAINBANNER'));
                return false;
            }

            var aResult = $.parseJSON(sResult);
            // 성공 - 무조건 통과시키게 세팅해놓고 '적용'버튼을 한 번 더 누름
            if (('result' in aResult) && aResult.result === true) {
                self.bIsComplete = true;
                $('#layEditor .layButton .btnSubmit').click();
            // 실패
            } else {
                self.bIsComplete = false;
                alert(__('REGISTRATION.FAILED', 'EDITOR.LAYER.EDITING.ATTR.M.MAINBANNER'));
            }
        });

        return false;
    },

    // 유효성 체크
    _validate: function(){
        // 할 게 없는 듯
        return true;
    }
});

SDE.Layer.EditingAttrMobileMaincategory = SDE.Layer.EditingAttrPreferenceBase.extend({
    SECTION_TEMPLATE :
        '<h3>'+ __('DISPLAY.SETTINGS.BY.ITEM', 'EDITOR.LAYER.EDITING.ATTR.M.MAINCATEGORY') +'</h3>'+
        '<form id="frm_editor_mobile_maincategory">'+
        '<input type="hidden" name="main_category_display_group" value="" />'+
        '<div class="section">'+
            '<div class="attrArea itemDisplay">'+
                '<div class="list">'+
                    '<ul class="main_category_list">'+
                        /*
                        '<li class="selected"><a href="#none">추천상품</a></li>'+
                        '<li><a href="#none">신상품</a></li>'+
                        '<li><a href="#none">추가카테고리1</a></li>'+
                        '<li><a href="#none">추가카테고리2</a></li>'+
                        */
                    '</ul>'+
                '</div>'+
                '<div class="setting main_category_attr">'+
                    '<div class="mBoard">'+
                        '<table border="1" summary="">'+
                        '<caption>'+ __('DISPLAY.SETTINGS.BY.ITEM', 'EDITOR.LAYER.EDITING.ATTR.M.MAINCATEGORY') +'</caption>'+
                        '<colgroup>'+
                            '<col style="width:25%;" />'+
                            '<col style="width:auto;" />'+
                        '</colgroup>'+
                        '<tbody>'+
                        '<tr>'+
                            '<th scope="row">'+ __('MODULE.CODE', 'EDITOR.LAYER.EDITING.ATTR.M.MAINCATEGORY') +'</th>'+
                            '<td class="main_category_module_name">Mobile_Categoryname_1</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<th scope="row">'+ __('DISPLAY.NAME', 'EDITOR.LAYER.EDITING.ATTR.M.MAINCATEGORY') +'</th>'+
                            '<td><input type="text" class="fText main_category_name" name="main_category_name" value="'+ __('RECOMMENDED.PRODUCTS', 'EDITOR.LAYER.EDITING.ATTR.M.MAINCATEGORY') +'" /></td>'+
                        '</tr>'+
                        '<tr>'+
                            '<th scope="row">'+ __('VISIBILITY', 'EDITOR.LAYER.EDITING.ATTR.M.MAINCATEGORY') +'</th>'+
                            '<td>'+
                                '<label class="fChk"><input type="radio" name="main_category_display" value="T" /> '+ __('SHOWN', 'EDITOR.LAYER.EDITING.ATTR.M.MAINCATEGORY') +'</label>'+
                                '<label class="fChk"><input type="radio" name="main_category_display" value="F" /> '+ __('DO.NOT.SHOW', 'EDITOR.LAYER.EDITING.ATTR.M.MAINCATEGORY') +'</label>'+
                            '</td>'+
                        '</tr>'+
                        '</tbody>'+
                        '</table>'+
                    '</div>'+
                '</div>'+
            '</div>'+
            '<p class="typeInfo"><span class="ico"></span>'+ __('AUTOMATICALLY.CALLS.CATEGORY.NAME', 'EDITOR.LAYER.EDITING.ATTR.M.MAINCATEGORY') +'</p>'+
        '</div>'+
        '</form>',

    // submit 진행중 여부
    bIsSubmitRunning: false,
    // proxy submit 성공여부
    bIsComplete: false,
    // 최초 데이터
    aInitData: [],
    // 변경 데이터
    aChangedData: [],
    // 직전 선택 idx
    iBeforeIdx: null,

    // UI 표시
    render: function(){
        this.iBeforeIdx = null;
        this.bIsSubmitRunning = false;
        this.bIsComplete = false;

        var self = this;
        var $element = $(this.SECTION_TEMPLATE);
        $.ajax({
            async: false,
            data: {get_data: 'T'},
            dataType: 'json',
            url: getMultiShopUrl('/exec/admin/manage/mobilemaincategory/'),
            success: function(aResult){
                if (!aResult) return false;

                // 적용시 변경사항만 submit 할 수 있도록 최초,변경 데이터 할당
                self.aInitData = aResult;
                self.aChangedData = [];

                var aList = [];
                for (var i=0; i<aResult.length; i++) {
                    var iDisplayGroup = parseInt(aResult[i].display_group, 10);
                    var sName         = aResult[i].name;
                    var bDisplay      = aResult[i].display;
                    var iDisplaySeq   = parseInt(aResult[i].display_seq, 10);

                    // 변경사항을 저장할 배열 할당
                    // 바로 복사하면 레퍼런스 참조가 되어 값이 동시에 변하기 때문에 부득이 값을 일일이 할당
                    self.aChangedData[i] = {
                        display_group: iDisplayGroup,
                        name:          aResult[i].name,
                        display:       aResult[i].display,
                        display_seq:   iDisplaySeq
                    };

                    aList.push('<li><a href="#none" data-idx="'+i+'">'+sName+'</a></li>');
                }

                $mainCategoryList = $element.find('.main_category_list');
                $mainCategoryList.html(aList.join(''));

                $mainCategoryList.find('li a').click(function(){
                    self._setAttr($element, $(this));
                });

                // init
                $mainCategoryList.find('li:eq(0) a').click();
            }
        });

        return $element;
    },

    // 표시설정 세팅
    _setAttr: function(container, el){
        // element
        var $mainCategoryAttr = container.find('.main_category_attr');

        var iIdx = parseInt(el.attr('data-idx'), 10);

        // 변경사항 저장
        this._setChanged(iIdx);

        var aData = this.aChangedData[iIdx];

        // 모듈코드
        $mainCategoryAttr.find('.main_category_module_name').html('Main_Categoryname_'+aData.display_seq);
        // 표시명
        $mainCategoryAttr.find('input:text[name="main_category_name"]').val(aData.name);
        // 표시여부
        var sRadioVal = (aData.display === 'T') ? 'T' : 'F';
        $mainCategoryAttr.find('[name="main_category_display"][value="'+sRadioVal+'"]').attr('checked', 'checked');
        // display_group
        container.find('input:hidden[name="main_category_display_group"]').val(aData.display_group);

        // 현재 선택된 idx를 이전 idx로 저장
        this.iBeforeIdx = iIdx;

        // selected
        el.parent().parent().find('li').removeClass('selected');
        el.parent().addClass('selected');
    },

    // 변경사항 저장
    _setChanged: function(iIdx, bForce){
        if ((this.iBeforeIdx !== null && this.iBeforeIdx != iIdx) || bForce === true) {
            var $frm = $('#frm_editor_mobile_maincategory');

            this.aChangedData[this.iBeforeIdx].display = $frm.find('input:radio[name="main_category_display"]:checked').val();
            this.aChangedData[this.iBeforeIdx].name    = $frm.find('input:text[name="main_category_name"]').val();
        }
    },

    // 적용 버튼 클릭
    save: function(){
        // complete 상태라면 완료
        if (this.bIsComplete === true) {
            return true;
        }

        // 이미 submit 진행중이면 중지
        if (this.bIsSubmitRunning === true) {
            return false;
        }

        // 유효성 체크
        if (this._validate() === false) {
            return false;
        }

        this.bIsSubmitRunning = true;

        // aInitData와 aChangedData를 비교하여 변경된 사항들만 추려냄
        var aUpdate = this._getChangedData();

        // 추려낸 데이터 중 변경사항이 없다면 아무것도 안하고 그냥 return true
        if (aUpdate.length < 1) {
            this.bIsSubmitRunning = false;
            this.bIsComplete = true;
            $('#layEditor .layButton .btnSubmit').click();
            return false;
        }

        // 변경사항이 있다면 폼 하나 만들어서 input:hidden으로 assign 한 후 ProxySubmit 태우자
        var $frm = $('<form></form>');
        for (var i=0; i<aUpdate.length; i++) {
            $frm.append('<input type="hidden" name="display_group['+i+']" value="'+aUpdate[i].display_group+'" />');
            $frm.append('<input type="hidden" name="name['+i+']" value="'+aUpdate[i].name+'" />');
            $frm.append('<input type="hidden" name="display['+i+']" value="'+aUpdate[i].display+'" />');
            $frm.append('<input type="hidden" name="display_seq['+i+']" value="'+aUpdate[i].display_seq+'" />');
        }

        // form.submit
        var self = this;
        var sAction = getMultiShopUrl('/exec/admin/manage/mobilemaincategory');

        ProxySubmit.submit($frm, sAction, function(sResult){
            self.bIsSubmitRunning = false;

            $frm.remove();

            if (!sResult) {
                alert(__('DISPLAY.BY.ITEM.FAILED', 'EDITOR.LAYER.EDITING.ATTR.M.MAINCATEGORY'));
                return false;
            }

            var aResult = $.parseJSON(sResult);

            // 성공 - 무조건 통과시키게 세팅해놓고 '적용'버튼을 한 번 더 누름
            if (('result' in aResult) && aResult.result === true) {
                self.bIsComplete = true;
                $('#layEditor .layButton .btnSubmit').click();
            // 실패
            } else {
                self.bIsComplete = false;
                alert(__('DISPLAY.BY.ITEM.FAILED', 'EDITOR.LAYER.EDITING.ATTR.M.MAINCATEGORY'));
            }
        });

        return false;
    },

    // 변경된 데이터 리스트 가져오기
    _getChangedData: function(){
        // 최종 input에 세팅된 값을 this.aChangedData 에 적용
        var iIdx = parseInt($('#frm_editor_mobile_maincategory .main_category_list li.selected a').attr('data-idx'), 10);
        this._setChanged(iIdx, true);

        // aInitData와 aChangedData를 비교하여 변경된 사항들만 추려냄
        var aUpdate = [];
        for (var i=0; i<this.aChangedData.length; i++) {
            var bChanged = false;
            for (var k in this.aInitData[i]) {
                if (!(k in this.aChangedData[i]) || (this.aChangedData[i][k]!=this.aInitData[i][k])) {
                    bChanged = true;
                    break;
                }
            }

            if (bChanged === true) {
                aUpdate.push(this.aChangedData[i]);
            }
        }

        return aUpdate;
    },

    // 유효성 체크
    _validate: function(){
        // 할 게 없는 듯. PC버전에서 표시명을 빈 칸으로 해도 들어감.

        return true;
    }
});

SDE.Layer.EditingAttrMobileCategory = SDE.Layer.EditingAttrPreferenceBase.extend({
    SECTION_TEMPLATE :
        '<h3>'+ __('BY.PRODUCT.CATEGORY', 'EDITOR.LAYER.EDITING.ATTR.M.CATEGORY') +'</h3>'+
        '<form id="frm_editor_mobilecategory">'+
        '<div class="attrArea">'+
            '<div class="list">'+
                '<ul class="category_list">'+
                    /*
                    '<li><span class="gTitle"><span class="title">대분류1</span></span></li>'+
                    '<li><span class="gTitle"><span class="title">대분류2</span></span></li>'+
                    '<li><span class="gTitle"><span class="title">대분류3</span></span></li>'+
                    '<li><span class="gTitle"><span class="title">대분류4</span></span></li>'+
                    '<li><span class="gTitle"><span class="title">대분류5</span></span></li>'+
                    */
                '</ul>'+
            '</div>'+
            '<div class="section">'+
                '<div class="mBoard">'+
                    '<table border="1" summary="">'+
                    '<caption>'+ __('CLASSIFICATION.BY.PRODUCT', 'EDITOR.LAYER.EDITING.ATTR.M.CATEGORY') +'</caption>'+
                    '<colgroup>'+
                        '<col style="width:25%;" />'+
                        '<col style="width:auto;" />'+
                    '</colgroup>'+
                    '<tbody>'+
                    '<tr>'+
                        '<th scope="row">'+ __('MENU.IMAGE', 'EDITOR.LAYER.EDITING.ATTR.M.CATEGORY') +'</th>'+
                        '<td>'+
                            '<label class="fChk"><input type="radio" name="use_category_image_mobile" value="T" /> '+ __('USED', 'EDITOR.LAYER.EDITING.ATTR.M.CATEGORY') +'</label>'+
                            '<label class="fChk"><input type="radio" name="use_category_image_mobile" value="F" /> '+ __('NOT.USED', 'EDITOR.LAYER.EDITING.ATTR.M.CATEGORY') +'</label>'+
                            '<div class="gFrame">'+
                                '<input type="file" accept="image/*" name="category_image_mobile[]" class="fFile" size="16" style="width:208px;" />'+
                                '<span class="frame"><img src="//img.echosting.cafe24.com/smartAdmin/img/editor/@img_product1.gif" class="img_preview" alt="" style="max-width:240px;" /></span>'+
                            '</div>'+
                        '</td>'+
                    '</tr>'+
                    '</tbody>'+
                    '</table>'+
                '</div>'+
            '</div>'+
        '</div>'+
        '</form>',

    // submit 진행중 여부
    bIsSubmitRunning: false,
    // proxy submit 성공여부
    bIsComplete: false,
    // 최초 데이터
    aInitData: [],
    // 변경 데이터
    aChangedData: [],
    // input:file 리스트
    aInputFile: {},
    // 미리보기 이미지
    aImg: {},
    // 직전 선택 category_no
    iBeforeCategoryNo: null,

    // UI 표시
    render: function(){
        this.iBeforeCategoryNo = null;
        this.bIsSubmitRunning = false;
        this.bIsComplete = false;
        this.aInputFile = {};
        this.aImg = {};

        var self = this;
        var $element = $(this.SECTION_TEMPLATE);
        $.ajax({
            async: false,
            data: {
                moduleName: 'product_category',
                is_mobile:  'T'
            },
            dataType: 'json',
            url: getMultiShopUrl('/exec/admin/editor/preferenceRead'),
            success: function(aResult){
                if (!aResult || !('bSuccess' in aResult) || !aResult.bSuccess) return false;

                aResult = aResult.data;

                // 적용시 변경사항만 submit 할 수 있도록 최초,변경 데이터 할당
                self.aInitData    = {};
                self.aChangedData = {};

                var aList = [];
                for (var iCategoryNo in aResult) {
                    // 메인 카테고리만
                    if (aResult[iCategoryNo].is_main !== 'T') {
                        continue;
                    }

                    // 원본 데이터
                    self.aInitData[iCategoryNo] = {
                        use_category_image_mobile: aResult[iCategoryNo].use_category_image_mobile,
                        category_image_mobile:     aResult[iCategoryNo].category_image_mobile
                    };

                    // 변경사항을 저장할 배열 할당
                    // 바로 복사하면 레퍼런스 참조가 되어 값이 동시에 변하기 때문에 부득이 값을 일일이 할당
                    self.aChangedData[iCategoryNo] = {
                        use_category_image_mobile: aResult[iCategoryNo].use_category_image_mobile,
                        category_image_mobile:     aResult[iCategoryNo].category_image_mobile
                    };

                    // input:file
                    self.aInputFile[iCategoryNo] = $('<input type="file" accept="image/*" name="category_image_mobile['+iCategoryNo+']" class="fFile" size="16" style="width:208px;" />');
                    // img
                    var sImgSrc = '//img.echosting.cafe24.com/smartAdmin/img/editor/@img_product1.gif';
                    if ($.trim(aResult[iCategoryNo].category_image_mobile).length > 0) {
                        sImgSrc = '//'+location.hostname+'/web/upload/category/mobile/'+aResult[iCategoryNo].category_image_mobile;
                    }
                    self.aImg[iCategoryNo] = sImgSrc;

                    aList.push('<li><a href="#none" data-category-no="'+iCategoryNo+'">'+aResult[iCategoryNo].category_name+'</a></li>');
                }

                $mainCategoryList = $element.find('ul.category_list');
                $mainCategoryList.html(aList.join(''));

                $mainCategoryList.find('li a').click(function(){
                    self._setAttr($element, $(this));
                });

                // 사용함, 사용안함 toggle
                $element.find('input:radio').click(function(){
                    if ($(this).val() === 'T') {
                        $element.find('div.gFrame').css('visibility', 'visible');
                    } else {
                        $element.find('div.gFrame').css('visibility', 'hidden');
                    }
                });

                // init
                $mainCategoryList.find('li:eq(0) a').click();
            }
        });

        return $element;
    },

    // 표시설정 세팅
    _setAttr: function(container, el){
        var iCategoryNo = el.attr('data-category-no');

        // 이전과 같은 category_no 라면 skip
        if (iCategoryNo === this.iBeforeCategoryNo) {
            return false;
        }

        // 변경사항 저장
        this._setChanged(iCategoryNo);

        var aData = this.aChangedData[iCategoryNo];

        // 사용함, 사용안함
        container.find('input:radio[name="use_category_image_mobile"][value="'+aData.use_category_image_mobile+'"]').attr('checked', 'checked');

        // 이미지 파일
        var currentInputFile = container.find('input:file[name^="category_image_mobile"]');
        if (this.aInputFile[iCategoryNo].attr('name') != currentInputFile.attr('name')) {
            container.find('input:file[name^="category_image_mobile"]').replaceWith(this.aInputFile[iCategoryNo]);
        }
        // 이미지 미리보기
        container.find('img.img_preview').attr('src', this.aImg[iCategoryNo]);

        // 이미지 미리보기 이벤트 핸들러
        var self = this;
        container.find('input:file[name^="category_image_mobile"]').change(function(){
            $inputFile = $(this);
            $img       = $(this).parent().find('img.img_preview');

            self._imgPreview($inputFile, $img);
        });

        // 현재 선택된 category_no를 이전 category_no로 저장
        this.iBeforeCategoryNo = iCategoryNo;

        // selected
        el.parent().parent().find('li').removeClass('selected');
        el.parent().addClass('selected');

        // display
        if (aData.use_category_image_mobile === 'T') {
            container.find('div.gFrame').css('visibility', 'visible');
        } else {
            container.find('div.gFrame').css('visibility', 'hidden');
        }
    },

    // 이미지 미리보기
    _imgPreview: function($inputFile, $img){
        if (window.navigator.userAgent.indexOf("MSIE") > -1) {
            var sImgPath = "";

            if ($inputFile.val().indexOf("\\fakepath\\") < 0) {
                sImgPath = $inputFile.val();
            } else {
                $inputFile.get(0).select();

                try {
                   var selectionRange = document.selection.createRange();
                   sImgPath = selectionRange.text.toString();
                   $inputFile.blur();
                } catch(e) {}
            }

            $img.css('filter', 'progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=image)');
            $img.get(0).filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = sImgPath;
        } else {
            try {
                var reader = new FileReader();
                reader.onload = function(e){
                    $img.attr('src', e.target.result).css({'max-width':'240px'});
                };

                reader.readAsDataURL($inputFile.attr('files')[0]);
            } catch(e) {
            }
        }

        var iCategoryNo = $('#frm_editor_mobilecategory li.selected a').attr('data-category-no');
        this.aImg[iCategoryNo] = $img.attr('src');
    },

    // 변경사항 저장
    _setChanged: function(iCategoryNo, bForce){
        if ((this.iBeforeCategoryNo !== null && this.iBeforeCategoryNo != iCategoryNo) || bForce === true) {
            var $frm = $('#frm_editor_mobilecategory');

            var iCategoryNo = this.iBeforeCategoryNo;

            // 사용함, 사용안함
            this.aChangedData[iCategoryNo].use_category_image_mobile = $frm.find('input:radio[name="use_category_image_mobile"]:checked').val();
            // 이미지 파일
            this.aInputFile[iCategoryNo] = $frm.find('input:file[name^="category_image_mobile["]');
            // img src
            this.aImg[iCategoryNo] = $frm.find('img.img_preview').attr('src');

            return true;
        }

        return false;
    },

    // 적용 버튼 클릭
    save: function(){
        // complete 상태라면 완료
        if (this.bIsComplete === true) {
            return true;
        }

        // 이미 submit 진행중이면 중지
        if (this.bIsSubmitRunning === true) {
            return false;
        }

        // 유효성 체크
        if (this._validate() === false) {
            return false;
        }

        this.bIsSubmitRunning = true;

        // aInitData와 aChangedData를 비교하여 변경된 사항들만 추려냄
        var aUpdate = this._getChangedData();

        // 추려낸 데이터 중 변경사항이 없다면 아무것도 안하고 그냥 return true
        if (Object.keys(aUpdate).length < 1) {
            this.bIsSubmitRunning = false;
            this.bIsComplete = true;
            $('#layEditor .layButton .btnSubmit').click();
            return false;
        }

        // 변경사항이 있다면 폼 하나 만들어서 input:hidden으로 assign 한 후 ProxySubmit 태우자
        var $frm = $('<form></form>');
        $frm.append('<input type="hidden" name="moduleName" value="product_category" />');
        $frm.append('<input type="hidden" name="is_mobile" value="T" />');
        for (var iCategoryNo in aUpdate) {
            for (var sFieldName in aUpdate[iCategoryNo]) {
                var sName = 'config['+iCategoryNo+']['+sFieldName+']';
                $frm.append('<input type="hidden" name="'+sName+'" value="'+aUpdate[iCategoryNo][sFieldName]+'" />');

                // 이미지 파일
                if (sFieldName==='use_category_image_mobile' && aUpdate[iCategoryNo][sFieldName]==='T') {
                    $frm.append(this.aInputFile[iCategoryNo]);
                }
            }
        }

        if ($('#frm_editor_mobilecategory').find('input:file[name^="category_image_mobile"]').size() < 1) {
            // 빈 input:file 위치 채우기
            $('<input type="file" accept="image/*" name="category_image_mobile[]" class="fFile" size="16" style="width:208px;" />').insertBefore($('#frm_editor_mobilecategory').find('div.gFrame span.frame'));
        }

        // form.submit
        var self = this;
        var sAction = getMultiShopUrl('/exec/admin/editor/PreferenceWrite');

        ProxySubmit.submit($frm, sAction, function(sResult){
            self.bIsSubmitRunning = false;

            $frm.remove();
            // input:file 복원
            $('#frm_editor_mobilecategory input:file[name^="category_image_mobile"]').replaceWith(self.aInputFile[self.iBeforeCategoryNo]);

            if (!sResult) {
                alert(__('DESIGN.PRODUCT.CATEGORY', 'EDITOR.LAYER.EDITING.ATTR.M.CATEGORY'));
                return false;
            }

            var aResult = $.parseJSON(sResult);

            // 성공 - 무조건 통과시키게 세팅해놓고 '적용'버튼을 한 번 더 누름
            if (('bSuccess' in aResult) && aResult.bSuccess === true) {
                self.bIsComplete = true;
                $('#layEditor .layButton .btnSubmit').click();
            // 실패
            } else {
                self.bIsComplete = false;
                alert(__('DESIGN.PRODUCT.CATEGORY', 'EDITOR.LAYER.EDITING.ATTR.M.CATEGORY'));
            }
        });

        return false;
    },

    // 변경된 데이터 리스트 가져오기
    _getChangedData: function(){
        // 최종 세팅된 값을 this.aChangedData 에 적용
        var iCategoryNo = $('#frm_editor_mobilecategory .category_list li.selected a').attr('data-category-no');
        this._setChanged(iCategoryNo, true);
        this.iBeforeCategoryNo = iCategoryNo;

        // aInitData와 aChangedData를 비교하여 변경된 사항들만 추려냄
        var aUpdate = {};
        for (var iCategoryNo in this.aChangedData) {
            // 사용함 && 파일업로드 있을 경우 이미지 업로드를 해야함
            if (this.aChangedData[iCategoryNo]['use_category_image_mobile'] === 'T') {
                if (this.aInputFile[iCategoryNo].val() != '') {
                    if (!(iCategoryNo in aUpdate)) {
                        aUpdate[iCategoryNo] = {};
                    }
                    aUpdate[iCategoryNo]['use_category_image_mobile'] = 'T';
                    continue;
                }
            }

            // 변경된 필드 체크
            for (var k in this.aInitData[iCategoryNo]) {
                if (this.aChangedData[iCategoryNo][k]==this.aInitData[iCategoryNo][k]) {
                    continue;
                }
                if (!(iCategoryNo in aUpdate)) {
                    aUpdate[iCategoryNo] = {};
                }
                aUpdate[iCategoryNo][k] = this.aChangedData[iCategoryNo][k];
            }
        }

        return aUpdate;
    },

    // 유효성 체크
    _validate: function(){
        // 할 게 없는 듯.

        return true;
    }
});

SDE.Layer.EditingAttrMobileCategoryHead = SDE.Layer.EditingAttrPreferenceBase.extend({
    SECTION_TEMPLATE :
        '<h3>'+ __('BY.PRODUCT.CATEGORY', 'EDITOR.LAYER.EDITING.ATTR.M.CATEGORYHEAD') +'</h3>'+
        '<form id="frm_editor_mobilecategoryhead">'+
        '<div class="attrArea">'+
            '<div class="list">'+
                '<ul class="category_list">'+
                    /*
                    '<li><span class="gTitle"><span class="title">대분류1</span></span></li>'+
                    '<li><span class="gTitle"><span class="title">대분류2</span></span></li>'+
                    '<li><span class="gTitle"><span class="title">대분류3</span></span></li>'+
                    '<li><span class="gTitle"><span class="title">대분류4</span></span></li>'+
                    '<li><span class="gTitle"><span class="title">대분류5</span></span></li>'+
                    */
                '</ul>'+
            '</div>'+
            '<div class="section">'+
                '<div class="mBoard">'+
                    '<table border="1" summary="">'+
                    '<caption>'+ __('CLASSIFICATION.BY.PRODUCT', 'EDITOR.LAYER.EDITING.ATTR.M.CATEGORYHEAD') +'</caption>'+
                    '<colgroup>'+
                        '<col style="width:25%;" />'+
                        '<col style="width:auto;" />'+
                    '</colgroup>'+
                    '<tbody>'+
                    '<tr>'+
                        '<th scope="row">'+ __('TITLE.IMAGE', 'EDITOR.LAYER.EDITING.ATTR.M.CATEGORYHEAD') +'</th>'+
                        '<td>'+
                            '<label class="fChk"><input type="radio" name="use_banner_image_mobile" value="T" /> '+ __('USED', 'EDITOR.LAYER.EDITING.ATTR.M.CATEGORYHEAD') +'</label>'+
                            '<label class="fChk"><input type="radio" name="use_banner_image_mobile" value="F" /> '+ __('NOT.USED', 'EDITOR.LAYER.EDITING.ATTR.M.CATEGORYHEAD') +'</label>'+
                            '<div class="gFrameBannerImage">'+
                                '<div class="gSingle"><input type="file" accept="image/*" name="banner_image_mobile[]" class="fFile" size="22" style="width:208px;" /></div>'+
                                '<div class="gSingle"><span class="frame"><img src="//img.echosting.cafe24.com/smartAdmin/img/editor/@img_product1.gif" class="preview_banner_image_mobile" alt="" style="max-width:290px;" /></span></div>'+
                            '</div>'+
                        '</td>'+
                    '</tr>'+
                    '<tr>'+
                        '<th scope="row">'+ __('TOP.IMAGE', 'EDITOR.LAYER.EDITING.ATTR.M.CATEGORYHEAD') +'</th>'+
                        '<td>'+
                            '<label class="fChk"><input type="radio" name="use_top_image_mobile" value="T" /> '+ __('USED', 'EDITOR.LAYER.EDITING.ATTR.M.CATEGORYHEAD') +'</label>'+
                            '<label class="fChk"><input type="radio" name="use_top_image_mobile" value="F" /> '+ __('NOT.USED', 'EDITOR.LAYER.EDITING.ATTR.M.CATEGORYHEAD') +'</label>'+
                            '<ul class="gSelectList">'+
                                '<li>'+
                                    '<div class="gSingle"><input type="file" accept="image/*" name="top_image1_mobile[]" class="fFile" size="22" style="width:208px;" /></div>'+
                                    '<div class="gSingle"><span class="frame"><img src="//img.echosting.cafe24.com/smartAdmin/img/editor/@img_product1.gif" class="preview_top_image1_mobile" alt="" style="max-width:290px;" /></span></div>'+
                                '</li>'+
                                '<li>'+
                                    '<div class="gSingle"><input type="file" accept="image/*" name="top_image2_mobile[]" class="fFile" size="22" style="width:208px;" /></div>'+
                                    '<div class="gSingle"><span class="frame"><img src="//img.echosting.cafe24.com/smartAdmin/img/editor/@img_product1.gif" class="preview_top_image2_mobile" alt="" style="max-width:290px;" /></span></div>'+
                                '</li>'+
                                '<li>'+
                                    '<div class="gSingle"><input type="file" accept="image/*" name="top_image3_mobile[]" class="fFile" size="22" style="width:208px;" /></div>'+
                                    '<div class="gSingle"><span class="frame"><img src="//img.echosting.cafe24.com/smartAdmin/img/editor/@img_product1.gif" class="preview_top_image3_mobile" alt="" style="max-width:290px;" /></span></div>'+
                                '</li>'+
                            '</ul>'+
                            '<ul class="gFormInfo">'+
                                '<li>'+ __('IMAGE.CAN.ADDED', 'EDITOR.LAYER.EDITING.ATTR.M.CATEGORYHEAD') +'</li>'+
                                '<li>'+ __('SET.ITEM.MANAGEMENT.CLASSIFICATION.CLASSIFICATION', 'EDITOR.LAYER.EDITING.ATTR.M.CATEGORYHEAD') +'</li>'+
                            '</ul>'+
                        '</td>'+
                    '</tr>'+
                    '</tbody>'+
                    '</table>'+
                '</div>'+
            '</div>'+
        '</div>'+
        '</form>',

    // submit 진행중 여부
    bIsSubmitRunning: false,
    // proxy submit 성공여부
    bIsComplete: false,
    // 최초 데이터
    aInitData: [],
    // 변경 데이터
    aChangedData: [],
    // input:file 리스트
    aInputFile: {},
    // 미리보기 이미지
    aImg: {},
    // 직전 선택 category_no
    iBeforeCategoryNo: null,
    // 상단 이미지 원래 존재여부 저장
    aTopImageExists: {},

    // UI 표시
    render: function(){
        this.iBeforeCategoryNo = null;
        this.bIsSubmitRunning = false;
        this.bIsComplete = false;
        this.aInputFile = {};
        this.aImg = {};
        this.aTopImageExists = {};

        var self = this;
        var $element = $(this.SECTION_TEMPLATE);
        $.ajax({
            async: false,
            data: {
                moduleName: 'product_headcategory',
                is_mobile:  'T'
            },
            dataType: 'json',
            url: getMultiShopUrl('/exec/admin/editor/preferenceRead'),
            success: function(aResult){
                if (!aResult || !('bSuccess' in aResult) || !aResult.bSuccess) return false;

                aResult = aResult.data;

                // 적용시 변경사항만 submit 할 수 있도록 최초,변경 데이터 할당
                self.aInitData    = {};
                self.aChangedData = {};

                var aList = [];
                for (var iCategoryNo in aResult) {
                    // 대분류 카테고리만
                    if (aResult[iCategoryNo].depth != 1) {
                        continue;
                    }

                    // 원본 데이터
                    self.aInitData[iCategoryNo] = {
                        use_banner_image_mobile: aResult[iCategoryNo].use_banner_image_mobile,
                        banner_image_mobile:     aResult[iCategoryNo].banner_image_mobile,
                        use_top_image_mobile:    aResult[iCategoryNo].use_top_image_mobile,
                        top_image1_mobile:       aResult[iCategoryNo].top_image1_mobile,
                        top_image2_mobile:       aResult[iCategoryNo].top_image2_mobile,
                        top_image3_mobile:       aResult[iCategoryNo].top_image3_mobile
                    };

                    // 변경사항을 저장할 배열 할당
                    // 바로 복사하면 레퍼런스 참조가 되어 값이 동시에 변하기 때문에 부득이 값을 일일이 할당
                    self.aChangedData[iCategoryNo] = {
                        use_banner_image_mobile: aResult[iCategoryNo].use_banner_image_mobile,
                        banner_image_mobile:     aResult[iCategoryNo].banner_image_mobile,
                        use_top_image_mobile:    aResult[iCategoryNo].use_top_image_mobile,
                        top_image1_mobile:       aResult[iCategoryNo].top_image1_mobile,
                        top_image2_mobile:       aResult[iCategoryNo].top_image2_mobile,
                        top_image3_mobile:       aResult[iCategoryNo].top_image3_mobile
                    };

                    // 순서를 맞추기 위해 상단 이미지가 원래 존재했는지 여부 저장
                    self.aTopImageExists[iCategoryNo] = [];
                    for (var i=1; i<=3; i++) {
                        var sName   = 'top_image'+i+'_mobile';
                        var sExists = ($.trim(aResult[iCategoryNo][sName]).length > 0) ? 'T' : 'F';
                        self.aTopImageExists[iCategoryNo].push(sExists);
                    }

                    // input:file
                    self.aInputFile[iCategoryNo] = {
                        banner_image_mobile: $('<input type="file" accept="image/*" name="banner_image_mobile['+iCategoryNo+']" class="fFile" size="16" style="width:208px;" />'),
                        top_image1_mobile:   $('<input type="file" accept="image/*" name="top_image1_mobile['+iCategoryNo+']" class="fFile" size="16" style="width:208px;" />'),
                        top_image2_mobile:   $('<input type="file" accept="image/*" name="top_image2_mobile['+iCategoryNo+']" class="fFile" size="16" style="width:208px;" />'),
                        top_image3_mobile:   $('<input type="file" accept="image/*" name="top_image3_mobile['+iCategoryNo+']" class="fFile" size="16" style="width:208px;" />')
                    }
                    // img
                    self.aImg[iCategoryNo] = self._getImgSrc(aResult[iCategoryNo]);

                    aList.push('<li><a href="#none" data-category-no="'+iCategoryNo+'">'+aResult[iCategoryNo].category_name+'</a></li>');
                }

                $mainCategoryList = $element.find('ul.category_list');
                $mainCategoryList.html(aList.join(''));

                $mainCategoryList.find('li a').click(function(){
                    self._setAttr($element, $(this));
                });

                // 사용함, 사용안함 toggle
                $element.find('input:radio').click(function(){
                    // 타이틀 이미지
                    if ($(this).attr('name') === 'use_banner_image_mobile') {
                        if ($(this).val() === 'T') {
                            $element.find('div.gFrameBannerImage').css('display', '');
                        } else {
                            $element.find('div.gFrameBannerImage').css('display', 'none');
                        }
                    // 상단 이미지
                    } else {
                        if ($(this).val() === 'T') {
                            $element.find('ul.gSelectList').css('display', '');
                        } else {
                            $element.find('ul.gSelectList').css('display', 'none');
                        }
                    }
                });

                // init
                $mainCategoryList.find('li:eq(0) a').click();
            }
        });

        return $element;
    },

    // 이미지 경로 가져오기
    _getImgSrc: function(aData){
        var aImg = ['banner_image_mobile', 'top_image1_mobile', 'top_image2_mobile', 'top_image3_mobile'];
        var aReturn = {};

        for (var i=0; i<aImg.length; i++) {
            var sType = aImg[i];

            if ((sType in aData) && ($.trim(aData[sType]).length > 0)) {
                aReturn[sType] = '//'+location.hostname+'/web/upload/category/mobile/'+aData[sType];
            } else {
                aReturn[sType] = '//img.echosting.cafe24.com/smartAdmin/img/editor/@img_product1.gif';
            }
        }

        return aReturn;
    },

    // 표시설정 세팅
    _setAttr: function(container, el){
        var iCategoryNo = el.attr('data-category-no');

        // 이전과 같은 category_no 라면 skip
        if (iCategoryNo === this.iBeforeCategoryNo) {
            return false;
        }

        // 변경사항 저장
        this._setChanged(iCategoryNo);

        var aData = this.aChangedData[iCategoryNo];

        // 타이틀 이미지
        // ____________________________________________________________________
        // 사용함, 사용안함
        container.find('input:radio[name="use_banner_image_mobile"][value="'+aData['use_banner_image_mobile']+'"]').click();

        // 이미지 파일
        var currentInputFile = container.find('input:file[name^="banner_image_mobile"]');
        if (this.aInputFile[iCategoryNo]['banner_image_mobile'].attr('name') != currentInputFile.attr('name')) {
            container.find('input:file[name^="banner_image_mobile"]').replaceWith(this.aInputFile[iCategoryNo]['banner_image_mobile']);
        }
        // 이미지 미리보기
        container.find('img.preview_banner_image_mobile').attr('src', this.aImg[iCategoryNo]['banner_image_mobile']);

        // 상단 이미지
        // ____________________________________________________________________
        // 사용함, 사용안함
        container.find('input:radio[name="use_top_image_mobile"][value="'+aData['use_top_image_mobile']+'"]').click();

        // 이미지 파일
        for (var i=1; i<=3; i++) {
            var sName = 'top_image'+i+'_mobile';

            var currentInputFile = container.find('input:file[name^="'+sName+'"]');

            if (this.aInputFile[iCategoryNo][sName].attr('name') != currentInputFile.attr('name')) {
                container.find('input:file[name^="'+sName+'"]').replaceWith(this.aInputFile[iCategoryNo][sName]);
            }
            // 이미지 미리보기
            container.find('img.preview_'+sName).attr('src', this.aImg[iCategoryNo][sName]);
        }

        // 이미지 미리보기 이벤트 핸들러
        var self = this;
        container.find('input:file').change(function(){
            var $inputFile = $(this);
            var sName      = $(this).attr('name').replace(/\[.*?\]/, '');
            var $img       = $(this).parent().parent().find('img.preview_'+sName);

            self._imgPreview($inputFile, $img);
        });

        // 현재 선택된 category_no를 이전 category_no로 저장
        this.iBeforeCategoryNo = iCategoryNo;

        // selected
        el.parent().parent().find('li').removeClass('selected');
        el.parent().addClass('selected');
    },

    // 이미지 미리보기
    _imgPreview: function($inputFile, $img){
        if (window.navigator.userAgent.indexOf("MSIE") > -1) {
            var sImgPath = "";

            if ($inputFile.val().indexOf("\\fakepath\\") < 0) {
                sImgPath = $inputFile.val();
            } else {
                $inputFile.get(0).select();

                try {
                   var selectionRange = document.selection.createRange();
                   sImgPath = selectionRange.text.toString();
                   $inputFile.blur();
                } catch(e) {}
            }

            $img.css('filter', 'progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=image)');
            $img.get(0).filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = sImgPath;
        } else {
            try {
                var reader = new FileReader();
                reader.onload = function(e){
                    $img.attr('src', e.target.result).css({'max-width':'290px'});
                };

                reader.readAsDataURL($inputFile.attr('files')[0]);
            } catch(e) {
            }
        }

        var iCategoryNo = $('#frm_editor_mobilecategoryhead li.selected a').attr('data-category-no');
        var sType       = $img.attr('class').replace(/^preview_/, '');
        this.aImg[iCategoryNo][sType] = $img.attr('src');
    },

    // 변경사항 저장
    _setChanged: function(iCategoryNo, bForce){
        if ((this.iBeforeCategoryNo !== null && this.iBeforeCategoryNo != iCategoryNo) || bForce === true) {
            var $frm = $('#frm_editor_mobilecategoryhead');

            var iCategoryNo = this.iBeforeCategoryNo;

            // 타이틀 이미지
            // ____________________________________________________________________
            // 사용함, 사용안함
            this.aChangedData[iCategoryNo].use_banner_image_mobile = $frm.find('input:radio[name="use_banner_image_mobile"]:checked').val();
            // 이미지 파일
            this.aInputFile[iCategoryNo].banner_image_mobile = $frm.find('input:file[name^="banner_image_mobile["]');
            // img src
            this.aImg[iCategoryNo].banner_image_mobile = $frm.find('img.preview_banner_image_mobile').attr('src');

            // 상단 이미지
            // ____________________________________________________________________
            // 사용함, 사용안함
            this.aChangedData[iCategoryNo].use_top_image_mobile = $frm.find('input:radio[name="use_top_image_mobile"]:checked').val();

            for (var i=1; i<=3; i++) {
                var sName = 'top_image'+i+'_mobile';

                // 이미지 파일
                this.aInputFile[iCategoryNo][sName] = $frm.find('input:file[name^="'+sName+'["]');
                // img src
                this.aImg[iCategoryNo][sName] = $frm.find('img.preview_'+sName).attr('src');
            }

            return true;
        }

        return false;
    },

    // 적용 버튼 클릭
    save: function(){
        // complete 상태라면 완료
        if (this.bIsComplete === true) {
            return true;
        }

        // 이미 submit 진행중이면 중지
        if (this.bIsSubmitRunning === true) {
            return false;
        }

        // 유효성 체크
        if (this._validate() === false) {
            return false;
        }

        this.bIsSubmitRunning = true;

        // aInitData와 aChangedData를 비교하여 변경된 사항들만 추려냄
        var aUpdate = this._getChangedData();

        // 추려낸 데이터 중 변경사항이 없다면 아무것도 안하고 그냥 return true
        if (Object.keys(aUpdate).length < 1) {
            this.bIsSubmitRunning = false;
            this.bIsComplete = true;
            $('#layEditor .layButton .btnSubmit').click();
            return false;
        }

        // 변경사항이 있다면 폼 하나 만들어서 input:hidden으로 assign 한 후 ProxySubmit 태우자
        var $frm = $('<form></form>');
        $frm.append('<input type="hidden" name="moduleName" value="product_category" />');
        $frm.append('<input type="hidden" name="is_mobile" value="T" />');
        for (var iCategoryNo in aUpdate) {
            for (var sFieldName in aUpdate[iCategoryNo]) {
                var sName = 'config['+iCategoryNo+']['+sFieldName+']';
                $frm.append('<input type="hidden" name="'+sName+'" value="'+aUpdate[iCategoryNo][sFieldName]+'" />');

                // 이미지 파일
                if (aUpdate[iCategoryNo][sFieldName] === 'T') {
                    // 타이틀 이미지
                    if (sFieldName === 'use_banner_image_mobile') {
                        $frm.append(this.aInputFile[iCategoryNo]['banner_image_mobile']);
                    // 상단 이미지
                    } else if (sFieldName === 'use_top_image_mobile') {
                        // input:file
                        for (var i=1; i<=3; i++) {
                            $frm.append(this.aInputFile[iCategoryNo]['top_image'+i+'_mobile']);
                        }
                        // 배너 이미지 존재여부
                        $frm.append('<input type="hidden" name="top_image_exists['+iCategoryNo+']" value="'+this.aTopImageExists[iCategoryNo].join('|')+'" />');
                    }
                }
            }
        }

        // 빈 input:file 위치 채우기
        if ($('#frm_editor_mobilecategoryhead').find('input:file[name^="banner_image_mobile"]').size() < 1) {
            $('#frm_editor_mobilecategoryhead').find('div.gFrameBannerImage div.gSingle:eq(0)').append('<input type="file" accept="image/*" name="banner_image_mobile[]" class="fFile" size="22" style="width:208px;" />');
        }
        $('ul.gSelectList li').each(function(i){
            if ($(this).find('input:file').size() < 1) {
                var iIdx = $(this).index()+1;
                $(this).find('div.gSingle:eq(0)').append('<input type="file" accept="image/*" name="top_image'+iIdx+'_mobile[]" class="fFile" size="22" style="width:208px;" />');
            }
        });

        // form.submit
        var self = this;
        var sAction = getMultiShopUrl('/exec/admin/editor/PreferenceWrite');

        ProxySubmit.submit($frm, sAction, function(sResult){
            self.bIsSubmitRunning = false;

            // input:file 복원
            $('#frm_editor_mobilecategoryhead input:file[name^="banner_image_mobile"]').replaceWith(self.aInputFile[self.iBeforeCategoryNo]['banner_image_mobile']);
            $('#frm_editor_mobilecategoryhead input:file[name^="top_image1_mobile"]').replaceWith(self.aInputFile[self.iBeforeCategoryNo]['top_image1_mobile']);
            $('#frm_editor_mobilecategoryhead input:file[name^="top_image2_mobile"]').replaceWith(self.aInputFile[self.iBeforeCategoryNo]['top_image2_mobile']);
            $('#frm_editor_mobilecategoryhead input:file[name^="top_image3_mobile"]').replaceWith(self.aInputFile[self.iBeforeCategoryNo]['top_image3_mobile']);
            $frm.remove();

            if (!sResult) {
                alert(__('DESIGN.PRODUCT.CATEGORY', 'EDITOR.LAYER.EDITING.ATTR.M.CATEGORYHEAD'));
                return false;
            }

            var aResult = $.parseJSON(sResult);

            // 성공 - 무조건 통과시키게 세팅해놓고 '적용'버튼을 한 번 더 누름
            if (('bSuccess' in aResult) && aResult.bSuccess === true) {
                self.bIsComplete = true;
                $('#layEditor .layButton .btnSubmit').click();
            // 실패
            } else {
                self.bIsComplete = false;
                alert(__('DESIGN.PRODUCT.CATEGORY', 'EDITOR.LAYER.EDITING.ATTR.M.CATEGORYHEAD'));
            }
        });

        return false;
    },

    // 변경된 데이터 리스트 가져오기
    _getChangedData: function(){
        // 최종 세팅된 값을 this.aChangedData 에 적용
        var iCategoryNo = $('#frm_editor_mobilecategoryhead .category_list li.selected a').attr('data-category-no');
        this._setChanged(iCategoryNo, true);
        this.iBeforeCategoryNo = iCategoryNo;

        // aInitData와 aChangedData를 비교하여 변경된 사항들만 추려냄
        var aUpdate = {};
        for (var iCategoryNo in this.aChangedData) {
            // 사용함 && 파일업로드 있을 경우 이미지 업로드를 해야함
            // 타이틀 이미지
            if (this.aChangedData[iCategoryNo]['use_banner_image_mobile'] === 'T') {
                if (this.aInputFile[iCategoryNo]['banner_image_mobile'].val() != '') {
                    if (!(iCategoryNo in aUpdate)) {
                        aUpdate[iCategoryNo] = {};
                    }
                    aUpdate[iCategoryNo]['use_banner_image_mobile'] = 'T';
                }
            }
            // 상단 이미지
            if (this.aChangedData[iCategoryNo]['use_top_image_mobile'] === 'T') {
                var bIsUploadExists = false;
                for (var i=1; i<=3; i++) {
                    var sName = 'top_image'+i+'_mobile';
                    if (this.aInputFile[iCategoryNo][sName].val() != '') {
                        if (!(iCategoryNo in aUpdate)) {
                            aUpdate[iCategoryNo] = {};
                        }
                        aUpdate[iCategoryNo]['use_top_image_mobile'] = 'T';
                    }
                }
            }

            // 변경된 필드 체크
            for (var k in this.aInitData[iCategoryNo]) {
                if (this.aChangedData[iCategoryNo][k]==this.aInitData[iCategoryNo][k]) {
                    continue;
                }
                if (!(iCategoryNo in aUpdate)) {
                    aUpdate[iCategoryNo] = {};
                }
                aUpdate[iCategoryNo][k] = this.aChangedData[iCategoryNo][k];
            }
        }

        return aUpdate;
    },

    // 유효성 체크
    _validate: function(){
        // 할 게 없는 듯.

        return true;
    }
});

SDE.Layer.EditingAttrMobileProductDetail = SDE.Layer.EditingAttrPreferenceBase.extend({
    SECTION_TEMPLATE :
        '<h3>'+ __('ITEM.DESIGN.SETTINGS', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL') +'</h3>'+
        '<form id="frm_editor_mobile_productdetail">'+
        '<div class="attrArea">'+
            '<div class="list">'+
                '<ul class="option_list">'+
                    /*
                    '<li class="selected"><a href="#none">상품명</a></li>'+
                    '<li><a href="#none">제조사</a></li>'+
                    '<li><a href="#none">원산지</a></li>'+
                    '<li><a href="#none">소비자가</a></li>'+
                    '<li><a href="#none">판매가</a></li>'+
                    '<li><a href="#none">무이자할부</a></li>'+
                    '<li><a href="#none">적립금</a></li>'+
                    '<li><a href="#none">상품코드</a></li>'+
                    '<li><a href="#none">수량</a></li>'+
                    '<li><a href="#none">어바웃할인가</a></li>'+
                    '<li><a href="#none">할인적용가</a></li>'+
                    */
                '</ul>'+
            '</div>'+
            '<div class="section">'+
                '<div class="mBoard">'+
                    '<table border="1" summary="">'+
                    '<caption>'+ __('BY.DISPLAY.ITEM', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL') +'</caption>'+
                    '<colgroup>'+
                        '<col style="width:25%;" />'+
                        '<col style="width:auto;" />'+
                    '</colgroup>'+
                    '<tbody>'+
                    '<tr>'+
                        '<th scope="row">'+ __('DISPLAY.ITEMS', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL') +'</th>'+
                        '<td class="option_original_name">'+ __('PRODUCT.NAME', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL') +'</td>'+
                    '</tr>'+
                    '<tr>'+
                        '<th scope="row">'+ __('DISPLAY.NAME', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL') +'</th>'+
                        '<td><input type="text" name="option_name" class="fText" /></td>'+
                    '</tr>'+
                    '<tr>'+
                        '<th scope="row">'+ __('SIZE', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL') +'</th>'+
                        '<td>'+
                            '<select name="font_size" class="fSelect">'+
                                '<option value="8">8px</option>'+
                                '<option value="9">9px</option>'+
                                '<option value="10">10px</option>'+
                                '<option value="11">11px</option>'+
                                '<option value="12">12px</option>'+
                                '<option value="13">13px</option>'+
                                '<option value="14">14px</option>'+
                                '<option value="15">15px</option>'+
                                '<option value="16">16px</option>'+
                                '<option value="17">17px</option>'+
                                '<option value="18">18px</option>'+
                                '<option value="19">19px</option>'+
                                '<option value="20">20px</option>'+
                            '</select>'+
                        '</td>'+
                    '</tr>'+
                    '<tr>'+
                        '<th scope="row">'+ __('BOLD', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL') +'</th>'+
                        '<td><a href="#none" name="font_type_bold" class="icoBold"><span>'+ __('BOLD', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL') +'</span></a></td>'+
                    '</tr>'+
                    '<tr>'+
                        '<th scope="row">'+ __('ITALIC', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL') +'</th>'+
                        '<td><a href="#none" name="font_type_italic" class="icoItalic"><span>'+ __('ITALIC', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL') +'</span></a></td>'+
                    '</tr>'+
                    '<tr>'+
                        '<th scope="row">'+ __('COLOR', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL') +'</th>'+
                        '<td>'+
                            '<div class="mColorPicker eColorPicker">'+
                                '<input type="text" name="font_color" maxlength="7" readonly="readonly" value="#ff0000" class="fText" style="width:50px" />'+
                            '</div>'+
                        '</td>'+
                    '</tr>'+
                    '</tbody>'+
                    '</table>'+
                '</div>'+
            '</div>'+
        '</div>'+
        '</form>',

    // submit 진행중 여부
    bIsSubmitRunning: false,
    // proxy submit 성공여부
    bIsComplete: false,
    // 최초 데이터
    aInitData: [],
    // 변경 데이터
    aChangedData: [],
    // 직전 선택 option_code
    sBeforeOptionCode: null,
    // 모듈명
    sModuleName: null,
    // 표시항목 리스트
    aOptionList: {
        'product_name': __('PRODUCT.NAME', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL'),
        'manu_name': __('MANUFACTURER', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL'),
        'made_in': __('ORIGIN', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL'),
        'product_custom': __('CONSUMERS', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL'),
        'product_price': __('PRICE', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL'),
        'c_dc_price': __('COUPON.DISCOUNT', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL'),
        'allotment_product': __('NO.INTEREST.INSTALLMENT', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL'),
        'mileage_value': __('RESERVES', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL'),
        'product_code': __('PRODUCT.CODE', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL'),
        'quantity': __('QUANTITY', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL'),
        'prd_price_org': __('COMMODITY.PRICE', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL'),
        'prd_price_tax': __('TAX.AMOUNT', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL'),
        'product_buy': __('SUPPLY.COST', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL'),
        'prd_brand': __('BRAND', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL'),
        'prd_model': __('MODEL', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL'),
        'supplier_id': __('SUPPLIER', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL'),
        'simple_desc': __('PRODUCT.BRIEF.DESCRIPTION', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL'),
        'eng_product_name': __('ENGLISH.PRODUCT.NAME', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL'),
        'ma_product_code': __('OWN.PRODUCT.CODE', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL'),
        'summary_desc': __('PRODUCT.SUMMARY', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL'),
        'review_cnt': __('REVIEWS', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL'),
        'qna_cnt': __('CONTACT.US', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL'),
        'relation_cnt':  __('RELATED.PRODUCT', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL'),
        'qrcode': __('QR.CODE', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL'),
        'about_price': __('ABOUT', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL'),
        'print_date': __('DATE.OF.MANUFACTURE', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL'),
        delivery_title: __('OVERSEAS.SHIPPING', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL'),
        delivery: __('SHIPPING.METHOD', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL'),
        delivery_price: __('SHIPPING.FEE', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL')
    },

    // 초기 데이터 세팅
    set: function(type, key){
        this.sModuleName = key;
        // @todo 임의 세팅
        this.sModuleName = 'product_detaildesign';
    },

    // UI 표시
    render: function(){
        this.sBeforeOptionCode = null;
        this.bIsSubmitRunning = false;
        this.bIsComplete = false;

        var self = this;
        var $element = $(this.SECTION_TEMPLATE);
        $.ajax({
            async: false,
            data: {moduleName: this.sModuleName},
            dataType: 'json',
            url: getMultiShopUrl('/exec/admin/editor/preferenceRead'),
            success: function(aResult){
                if (!aResult || !('bSuccess' in aResult) || !aResult.bSuccess) return false;

                aResult = aResult.data;

                // 적용시 변경사항만 submit 할 수 있도록 최초,변경 데이터 할당
                self.aInitData    = {};
                self.aChangedData = {};

                var aList = [];
                for (var sOptionCode in aResult) {
                    // 원본 데이터
                    self.aInitData[sOptionCode] = aResult[sOptionCode];
                    // 변경사항을 저장할 배열 할당
                    // 바로 복사하면 레퍼런스 참조가 되어 값이 동시에 변하기 때문에 부득이 값을 일일이 할당
                    self.aChangedData[sOptionCode] = {};
                    for (var sField in self.aInitData[sOptionCode]) {
                        self.aChangedData[sOptionCode][sField] = self.aInitData[sOptionCode][sField];
                    }

                    var sOrgOptionName = self._getOriginalOptionName(sOptionCode, aResult[sOptionCode].option_name);
                    aList.push('<li><a href="#none" data-option-code="'+sOptionCode+'">'+sOrgOptionName+'</a></li>');
                }

                $mainOptionList = $element.find('ul.option_list');
                $mainOptionList.html(aList.join(''));

                $mainOptionList.find('li a').click(function(){
                    self._setAttr($element, $(this));
                });

                // init
                $mainOptionList.find('li:eq(0) a').click();

                $element.find('a[name^="font_type"]').click(function(){
                    if ($(this).attr('class').indexOf('selected') > -1) {
                        $(this).removeClass('selected');
                    } else {
                        $(this).addClass('selected');
                    }
                });
            }
        });

        return $element;
    },

    // 표시설정 세팅
    _setAttr: function(container, el){
        var sOptionCode = el.attr('data-option-code');

        // 변경사항 저장
        this._setChanged(sOptionCode);

        var aData = this.aChangedData[sOptionCode];

        // 표시항목
        var sOriginalOptionName = this._getOriginalOptionName(sOptionCode, aData.option_name);
        container.find('td.option_original_name').text(sOriginalOptionName);
        // 표시명
        container.find('input:text[name="option_name"]').val(aData.option_name);
        // 크기
        container.find('select[name="font_size"]').val(aData.font_size);
        // 굵게
        if (aData.font_type==='B' || aData.font_type==='D') {
            container.find('a[name="font_type_bold"]').addClass('selected');
        } else {
            container.find('a[name="font_type_bold"]').removeClass('selected');
        }
        // 이탤릭체
        if (aData.font_type==='C' || aData.font_type==='D') {
            container.find('a[name="font_type_italic"]').addClass('selected');
        } else {
            container.find('a[name="font_type_italic"]').removeClass('selected');
        }
        // 색상
        container.find('span.color_picker').remove();
        container.find('input:text[name="font_color"]').val(aData.font_color);
        container.find('input:text[name="font_color"]').colorPicker();

        // 현재 선택된 idx를 이전 idx로 저장
        this.sBeforeOptionCode = sOptionCode;

        // selected
        el.parent().parent().find('li').removeClass('selected');
        el.parent().addClass('selected');
    },

    // 표시항목값 반환
    _getOriginalOptionName: function(sOptionCode, sOptionName){
        return (sOptionCode in this.aOptionList) ? this.aOptionList[sOptionCode] : sOptionName;
    },

    // 변경사항 저장
    _setChanged: function(sOptionCode, bForce){
        if ((this.sBeforeOptionCode !== null && this.sBeforeOptionCode != sOptionCode) || bForce === true) {
            var $frm = $('#frm_editor_mobile_productdetail');

            var sCode = this.sBeforeOptionCode;

            // 표시명
            this.aChangedData[sCode].option_name = $frm.find('input:text[name="option_name"]').val();
            // 크기
            this.aChangedData[sCode].font_size = $frm.find('select[name="font_size"]').val();
            // 굵게, 이탤릭체
            var sFontType = 'A';
            var bIsBold   = $frm.find('a[name="font_type_bold"]').attr('class').indexOf('selected') > -1;
            var bIsItalic = $frm.find('a[name="font_type_italic"]').attr('class').indexOf('selected') > -1;
            if (bIsBold===true && bIsItalic===true) {
                sFontType = 'D';
            } else if (bIsBold===true) {
                sFontType = 'B';
            } else if (bIsItalic===true) {
                sFontType = 'C';
            }
            this.aChangedData[sCode].font_type = sFontType;
            // 색상
            this.aChangedData[sCode].font_color = $frm.find('input:text[name="font_color"]').val();
        }
    },

    // 적용 버튼 클릭
    save: function(){
        // complete 상태라면 완료
        if (this.bIsComplete === true) {
            return true;
        }

        // 이미 submit 진행중이면 중지
        if (this.bIsSubmitRunning === true) {
            return false;
        }

        // 유효성 체크
        if (this._validate() === false) {
            return false;
        }

        this.bIsSubmitRunning = true;

        // aInitData와 aChangedData를 비교하여 변경된 사항들만 추려냄
        var aUpdate = this._getChangedData();

        // 추려낸 데이터 중 변경사항이 없다면 아무것도 안하고 그냥 return true
        if (Object.keys(aUpdate).length < 1) {
            this.bIsSubmitRunning = false;
            this.bIsComplete = true;
            $('#layEditor .layButton .btnSubmit').click();
            return false;
        }

        // 변경사항이 있다면 폼 하나 만들어서 input:hidden으로 assign 한 후 ProxySubmit 태우자
        var $frm = $('<form></form>');
        $frm.append('<input type="hidden" name="moduleName" value="'+this.sModuleName+'" />');
        for (var sOptionCode in aUpdate) {
            for (var sFieldName in aUpdate[sOptionCode]) {
                var sName = 'config['+sOptionCode+']['+sFieldName+']';
                $frm.append('<input type="hidden" name="'+sName+'" value="'+aUpdate[sOptionCode][sFieldName]+'" />');
            }
        }

        // form.submit
        var self = this;
        var sAction = getMultiShopUrl('/exec/admin/editor/PreferenceWrite');

        ProxySubmit.submit($frm, sAction, function(sResult){
            self.bIsSubmitRunning = false;

            $frm.remove();

            if (!sResult) {
                alert(__('SETUP.DISPLAY.FAILED', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL'));
                return false;
            }

            var aResult = $.parseJSON(sResult);

            // 성공 - 무조건 통과시키게 세팅해놓고 '적용'버튼을 한 번 더 누름
            if (('bSuccess' in aResult) && aResult.bSuccess === true) {
                self.bIsComplete = true;
                $('#layEditor .layButton .btnSubmit').click();
            // 실패
            } else {
                self.bIsComplete = false;
                alert(__('SETUP.DISPLAY.FAILED', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTDETAIL'));
            }
        });

        return false;
    },

    // 변경된 데이터 리스트 가져오기
    _getChangedData: function(){
        // 최종 세팅된 값을 this.aChangedData 에 적용
        var sOptionCode = $('#frm_editor_mobile_productdetail .option_list li.selected a').attr('data-option-code');
        this._setChanged(sOptionCode, true);

        // aInitData와 aChangedData를 비교하여 변경된 사항들만 추려냄
        var aUpdate = {};
        for (var sOptionCode in this.aChangedData) {
            for (var k in this.aInitData[sOptionCode]) {
                if (this.aChangedData[sOptionCode][k]==this.aInitData[sOptionCode][k]) {
                    continue;
                }
                if (!(sOptionCode in aUpdate)) {
                    aUpdate[sOptionCode] = {};
                }
                aUpdate[sOptionCode][k] = this.aChangedData[sOptionCode][k];
            }
        }

        return aUpdate;
    },

    // 유효성 체크
    _validate: function(){
        // 할 게 없는 듯.

        return true;
    }
});

SDE.Layer.EditingAttrMobileProductList = SDE.Layer.EditingAttrPreferenceBase.extend({
    SECTION_TEMPLATE :
        '<h3>'+ __('SETTINGS.BY.DISPLAY.ITEM', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTLIST') +'</h3>'+
        '<form id="frm_editor_mobile_listmain">'+
        '<div class="attrArea">'+
            '<div class="list">'+
                '<ul class="option_list">'+
                    /*
                    '<li class="selected"><a href="#none">상품명</a></li>'+
                    '<li><a href="#none">제조사</a></li>'+
                    '<li><a href="#none">원산지</a></li>'+
                    '<li><a href="#none">소비자가</a></li>'+
                    '<li><a href="#none">판매가</a></li>'+
                    '<li><a href="#none">무이자할부</a></li>'+
                    '<li><a href="#none">적립금</a></li>'+
                    '<li><a href="#none">상품코드</a></li>'+
                    '<li><a href="#none">수량</a></li>'+
                    '<li><a href="#none">어바웃할인가</a></li>'+
                    '<li><a href="#none">할인적용가</a></li>'+
                    */
                '</ul>'+
            '</div>'+
            '<div class="section">'+
                '<div class="mBoard">'+
                    '<table border="1" summary="">'+
                    '<caption>'+ __('BY.DISPLAY.ITEM', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTLIST') +'</caption>'+
                    '<colgroup>'+
                        '<col style="width:25%;" />'+
                        '<col style="width:auto;" />'+
                    '</colgroup>'+
                    '<tbody>'+
                    '<tr>'+
                        '<th scope="row">'+ __('DISPLAY.ITEMS', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTLIST') +'</th>'+
                        '<td class="option_original_name">'+ __('PRODUCT.NAME', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTLIST') +'</td>'+
                    '</tr>'+
                    '<tr>'+
                        '<th scope="row">'+ __('VISIBILITY', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTLIST') +'</th>'+
                        '<td>'+
                            '<label class="fChk"><input type="radio" name="option_display" value="T" /> '+ __('SHOWN', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTLIST')  +'</label>'+
                            '<label class="fChk"><input type="radio" name="option_display" value="F" /> '+ __('DO.NOT.SHOW', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTLIST') +'</label>'+
                        '</td>'+
                    '</tr>'+
                    '<tr>'+
                        '<th scope="row">'+ __('DISPLAY.NAME', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTLIST') +'</th>'+
                        '<td><input type="text" name="option_name" class="fText" /></td>'+
                    '</tr>'+
                    '<tr>'+
                        '<th scope="row">'+ __('SIZE', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTLIST') +'</th>'+
                        '<td>'+
                            '<select name="font_size" class="fSelect">'+
                                '<option value="8">8px</option>'+
                                '<option value="9">9px</option>'+
                                '<option value="10">10px</option>'+
                                '<option value="11">11px</option>'+
                                '<option value="12">12px</option>'+
                                '<option value="13">13px</option>'+
                                '<option value="14">14px</option>'+
                                '<option value="15">15px</option>'+
                                '<option value="16">16px</option>'+
                                '<option value="17">17px</option>'+
                                '<option value="18">18px</option>'+
                                '<option value="19">19px</option>'+
                                '<option value="20">20px</option>'+
                            '</select>'+
                        '</td>'+
                    '</tr>'+
                    '<tr>'+
                        '<th scope="row">'+ __('BOLD', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTLIST') +'</th>'+
                        '<td><a href="#none" name="font_type_bold" class="icoBold"><span>'+ __('BOLD', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTLIST') +'</span></a></td>'+
                    '</tr>'+
                    '<tr>'+
                        '<th scope="row">'+ __('ITALIC', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTLIST') +'</th>'+
                        '<td><a href="#none" name="font_type_italic" class="icoItalic"><span>'+ __('ITALIC', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTLIST') +'</span></a></td>'+
                    '</tr>'+
                    '<tr>'+
                        '<th scope="row">'+ __('COLOR', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTLIST') +'</th>'+
                        '<td>'+
                            '<div class="mColorPicker eColorPicker">'+
                                '<input type="text" name="font_color" maxlength="7" readonly="readonly" value="#ff0000" class="fText" style="width:50px" />'+
                            '</div>'+
                        '</td>'+
                    '</tr>'+
                    '</tbody>'+
                    '</table>'+
                '</div>'+
            '</div>'+
        '</div>'+
        '</form>',

    // submit 진행중 여부
    bIsSubmitRunning: false,
    // proxy submit 성공여부
    bIsComplete: false,
    // 최초 데이터
    aInitData: [],
    // 변경 데이터
    aChangedData: [],
    // 직전 선택 option_code
    sBeforeOptionCode: null,
    // 모듈명
    sModuleName: null,
    // 표시항목 리스트
    aOptionList: {
        'product_name': __('PRODUCT.NAME', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTLIST'),
        'product_price': __('PRICE', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTLIST'),
        'prd_price_sale': __('DISCOUNT.SALE.PRICE', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTLIST')
        /*
        'product_name':      '상품명',
        'manu_name':         '제조사',
        'made_in':           '원산지',
        'product_custom':    '소비자가',
        'product_price':     '판매가',
        'c_dc_price':        '쿠폰할인',
        'allotment_product': '무이자할부',
        'mileage_value':     '적립금',
        'product_code':      '상품코드',
        'quantity':          '수량',
        'prd_price_org':     '상품가',
        'prd_price_tax':     '세액',
        'product_buy':       '공급원가',
        'prd_brand':         '브랜드',
        'prd_model':         '모델',
        'supplier_id':       '공급사',
        'simple_desc':       '상품간략설명',
        'eng_product_name':  '영문상품명',
        'ma_product_code':   '자체상품코드',
        'summary_desc':      '상품요약정보',
        'review_cnt':        '사용후기',
        'qna_cnt':           '상품문의',
        'relation_cnt':      '관련상품수',
        'qrcode':            'QR코드',
        'about_price':       '어바웃할인가',
        'print_date':        '제조일자'
        */
    },

    // 초기 데이터 세팅
    set: function(type, key){
        this.sModuleName = key;
    },

    // UI 표시
    render: function(){
        this.sBeforeOptionCode = null;
        this.bIsSubmitRunning = false;
        this.bIsComplete = false;

        var self = this;
        var $element = $(this.SECTION_TEMPLATE);
        $.ajax({
            async: false,
            data: {moduleName: this.sModuleName, is_mobile: 'T'},
            dataType: 'json',
            url: getMultiShopUrl('/exec/admin/editor/preferenceRead'),
            success: function(aResult){
                if (!aResult || !('bSuccess' in aResult) || !aResult.bSuccess) return false;

                aResult = aResult.data;

                // 적용시 변경사항만 submit 할 수 있도록 최초,변경 데이터 할당
                self.aInitData    = {};
                self.aChangedData = {};

                var aList = [];
                for (var sOptionCode in aResult) {
                    if (!(sOptionCode in self.aOptionList)) continue;

                    // 원본 데이터
                    self.aInitData[sOptionCode] = aResult[sOptionCode];
                    // 변경사항을 저장할 배열 할당
                    // 바로 복사하면 레퍼런스 참조가 되어 값이 동시에 변하기 때문에 부득이 값을 일일이 할당
                    self.aChangedData[sOptionCode] = {};
                    for (var sField in self.aInitData[sOptionCode]) {
                        self.aChangedData[sOptionCode][sField] = self.aInitData[sOptionCode][sField];
                    }

                    var sOrgOptionName = self._getOriginalOptionName(sOptionCode, aResult[sOptionCode].option_name);
                    aList.push('<li><a href="#none" data-option-code="'+sOptionCode+'">'+sOrgOptionName+'</a></li>');
                }

                $mainOptionList = $element.find('ul.option_list');
                $mainOptionList.html(aList.join(''));

                $mainOptionList.find('li a').click(function(){
                    self._setAttr($element, $(this));
                });

                // init
                $mainOptionList.find('li:eq(0) a').click();

                $element.find('a[name^="font_type"]').click(function(){
                    if ($(this).attr('class').indexOf('selected') > -1) {
                        $(this).removeClass('selected');
                    } else {
                        $(this).addClass('selected');
                    }
                });
            }
        });

        return $element;
    },

    // 표시설정 세팅
    _setAttr: function(container, el){
        var sOptionCode = el.attr('data-option-code');

        // 변경사항 저장
        this._setChanged(sOptionCode);

        var aData = this.aChangedData[sOptionCode];

        // 표시항목
        var sOriginalOptionName = this._getOriginalOptionName(sOptionCode, aData.option_name);
        container.find('td.option_original_name').text(sOriginalOptionName);
        // 표시명
        container.find('input:text[name="option_name"]').val(aData.option_name);
        // 표시여부
        container.find('input:radio[name="option_display"][value="'+aData.option_display+'"]').attr('checked', 'checked');
        // 크기
        container.find('select[name="font_size"]').val(aData.font_size);
        // 굵게
        if (aData.font_type==='B' || aData.font_type==='D') {
            container.find('a[name="font_type_bold"]').addClass('selected');
        } else {
            container.find('a[name="font_type_bold"]').removeClass('selected');
        }
        // 이탤릭체
        if (aData.font_type==='C' || aData.font_type==='D') {
            container.find('a[name="font_type_italic"]').addClass('selected');
        } else {
            container.find('a[name="font_type_italic"]').removeClass('selected');
        }
        // 색상
        container.find('span.color_picker').remove();
        container.find('input:text[name="font_color"]').val(aData.font_color);
        container.find('input:text[name="font_color"]').colorPicker();

        // 현재 선택된 idx를 이전 idx로 저장
        this.sBeforeOptionCode = sOptionCode;

        // selected
        el.parent().parent().find('li').removeClass('selected');
        el.parent().addClass('selected');
    },

    // 표시항목값 반환
    _getOriginalOptionName: function(sOptionCode, sOptionName){
        return (sOptionCode in this.aOptionList) ? this.aOptionList[sOptionCode] : sOptionName;
    },

    // 변경사항 저장
    _setChanged: function(sOptionCode, bForce){
        if ((this.sBeforeOptionCode !== null && this.sBeforeOptionCode != sOptionCode) || bForce === true) {
            var $frm = $('#frm_editor_mobile_listmain');

            var sCode = this.sBeforeOptionCode;

            // 표시명
            this.aChangedData[sCode].option_name    = $frm.find('input:text[name="option_name"]').val();
            // 표시여부
            this.aChangedData[sCode].option_display = $frm.find('input:radio[name="option_display"]:checked').val();
            // 크기
            this.aChangedData[sCode].font_size      = $frm.find('select[name="font_size"]').val();
            // 굵게, 이탤릭체
            var sFontType = 'A';
            var bIsBold   = $frm.find('a[name="font_type_bold"]').attr('class').indexOf('selected') > -1;
            var bIsItalic = $frm.find('a[name="font_type_italic"]').attr('class').indexOf('selected') > -1;
            if (bIsBold===true && bIsItalic===true) {
                sFontType = 'D';
            } else if (bIsBold===true) {
                sFontType = 'B';
            } else if (bIsItalic===true) {
                sFontType = 'C';
            }
            this.aChangedData[sCode].font_type = sFontType;
            // 색상
            this.aChangedData[sCode].font_color = $frm.find('input:text[name="font_color"]').val();
        }
    },

    // 적용 버튼 클릭
    save: function(){
        // complete 상태라면 완료
        if (this.bIsComplete === true) {
            return true;
        }

        // 이미 submit 진행중이면 중지
        if (this.bIsSubmitRunning === true) {
            return false;
        }

        // 유효성 체크
        if (this._validate() === false) {
            return false;
        }

        this.bIsSubmitRunning = true;

        // aInitData와 aChangedData를 비교하여 변경된 사항들만 추려냄
        var aUpdate = this._getChangedData();

        // 추려낸 데이터 중 변경사항이 없다면 아무것도 안하고 그냥 return true
        if (Object.keys(aUpdate).length < 1) {
            this.bIsSubmitRunning = false;
            this.bIsComplete = true;
            $('#layEditor .layButton .btnSubmit').click();
            return false;
        }

        // 변경사항이 있다면 폼 하나 만들어서 input:hidden으로 assign 한 후 ProxySubmit 태우자
        var $frm = $('<form></form>');
        $frm.append('<input type="hidden" name="moduleName" value="'+this.sModuleName+'" />');
        for (var sOptionCode in aUpdate) {
            for (var sFieldName in aUpdate[sOptionCode]) {
                var sName = 'config['+sOptionCode+']['+sFieldName+']';
                $frm.append('<input type="hidden" name="'+sName+'" value="'+aUpdate[sOptionCode][sFieldName]+'" />');
            }
        }

        // form.submit
        var self = this;
        var sAction = getMultiShopUrl('/exec/admin/editor/PreferenceWrite');

        ProxySubmit.submit($frm, sAction, function(sResult){
            self.bIsSubmitRunning = false;

            $frm.remove();

            if (!sResult) {
                alert(__('SETUP.DISPLAY.FAILED', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTLIST'));
                return false;
            }

            var aResult = $.parseJSON(sResult);

            // 성공 - 무조건 통과시키게 세팅해놓고 '적용'버튼을 한 번 더 누름
            if (('bSuccess' in aResult) && aResult.bSuccess === true) {
                self.bIsComplete = true;
                $('#layEditor .layButton .btnSubmit').click();
            // 실패
            } else {
                self.bIsComplete = false;
                alert(__('SETUP.DISPLAY.FAILED', 'EDITOR.LAYER.EDITING.ATTR.M.PRDUCTLIST'));
            }
        });

        return false;
    },

    // 변경된 데이터 리스트 가져오기
    _getChangedData: function(){
        // 최종 세팅된 값을 this.aChangedData 에 적용
        var sOptionCode = $('#frm_editor_mobile_listmain .option_list li.selected a').attr('data-option-code');
        this._setChanged(sOptionCode, true);

        // aInitData와 aChangedData를 비교하여 변경된 사항들만 추려냄
        var aUpdate = {};
        for (var sOptionCode in this.aChangedData) {
            for (var k in this.aInitData[sOptionCode]) {
                if (this.aChangedData[sOptionCode][k]==this.aInitData[sOptionCode][k]) {
                    continue;
                }
                if (!(sOptionCode in aUpdate)) {
                    aUpdate[sOptionCode] = {};
                }
                aUpdate[sOptionCode][k] = this.aChangedData[sOptionCode][k];
            }
        }

        return aUpdate;
    },

    // 유효성 체크
    _validate: function(){
        // 할 게 없는 듯.

        return true;
    }
});

/**
 * CodeMirror Instance Wrapper
 *
 * Editor Prototype에 있는 함수들을 instance로 복사
 */

SDE.Editor.Wrapper = function(sEditorId, oConfig) {
    var oEditor = this.init(sEditorId, oConfig);

    for (var sKey in this) {
        if (sKey == 'init') continue;

        oEditor[sKey] = this[sKey];
    }

    return oEditor;
};


SDE.Editor.Wrapper.prototype = {
    ERROR : {
        NO_MODULE : 'EDITOR_NO_MODULE',
        WRONG_HTML : 'EDITOR_WRONG_HTML'
    },

    oPrivRange : {},
    sError : null,


    /**
     * 초기화 함수 (이 함수는 복사되지 않음)
     *
     * @param string sEditorId editor의 dom id
     * @param object oConfing CodeMirror.fromTextArea 설정 값
     *
     * @return object CodeMirror instace
     */
    init : function(sEditorId, oConfig) {
        var oEditor = CodeMirror.fromTextArea(document.getElementById(sEditorId), oConfig);

        oEditor._setSelection = oEditor.setSelection;

        oEditor.isInit = true;

        return oEditor;
    },

    clearSelection : function() {
        var oRange = { line : 0, ch :0 };

        this._setSelection(oRange, oRange);

        this.oPrivRange = {};
    },

    /**
     * 선택된 영역을 삭제
     */
    deleteSelection : function() {

        if (this.getSelection() == '') return;

        if (this.oPrivRange.from == null || this.oPrivRange.to == null) return;

        this.replaceRange('', this.oPrivRange.from, this.oPrivRange.to);
    },

    getError : function() {
        return this.sError;
    },

    hasModule : function(sModule) {
        return (this.getModuleRange(sModule) == null) ? false : true;
    },

    hasImageModule : function(sSrc) {
        return (this.getImageModuleRange(sSrc) == null) ? false : true;
    },

    getImageModuleRange : function(sSrc, iIndex) {
        var aContent    = this.getValue().split('\n');
        var iStart      = 0;
        var bImage      = false;
        var iCount      = 0;
        var targetLineText = '';
        var bSearch     = false;
        var sSearchType = 'origin';

        iIndex = iIndex || 0;

        for (var i = 0; i < aContent.length; i++) {
            targetLineText = aContent[i];

            if (targetLineText.search(sSrc) !== -1) {
                bSearch = true;
            } else if (targetLineText.search(decodeURIComponent(sSrc)) !== -1) {
                bSearch = true;
                sSearchType = 'decode';
            }
            if (bSearch) {
                if (iCount == iIndex) {
                    iStart = i;
                    bImage = true;
                    break;
                }

                iCount++;
            }
        }

        if (bImage === false) return;

        if (sSearchType == 'decode') {
            sSrc = decodeURIComponent(sSrc);
        }

        /*rev.b4.20130830.1@sinseki #SDE-10 모듈선택시 img이고 parentNode 가 a 태그인 경우 parentNode를 포함하여 처리*/
        var regexp = new RegExp('(?:<a[^>]+>\\s*)?<img[^<>]*?[\\s]+[data\\-src|src]+[\\s]*=[\\s]*("|\')?'+ sSrc +'(\\1)[^<>]*?>(?:\\s*<\/a>)*', 'i');
        var aMatch = targetLineText.match(regexp);

        // 태그가 잘못 닫혀있는 경우
        if (!aMatch) return;

        var iStartCh = targetLineText.search(regexp);
        var iEndCh = iStartCh + aMatch[0].length;

        return {
            from: {
                line : iStart,
                ch : iStartCh
            },

            to:{
                line : iStart,
                ch : iEndCh
            }
        };
    },

    /**
     * 모듈 이름으로 Selection 할 범위 가져오기
     *
     * @param string  sModule 모듈 이름
     * @param integer iModuleIndex 모듈 index
     * @return object selection range
     */
    getModuleRange : function(sModule, iModuleIndex, iModuleCount) {
        var sModule   = sModule.toLowerCase();
        var aContent  = this.getValue().split('\n');
        var rSearch   = new RegExp('<([a-z]+[^>]*\\s+)module\\s*=\\s*("'+ sModule + '"|\''+ sModule + '\'|'+ sModule + '\\s)', 'i');
        var aFrom     = [];

        iModuleIndex = parseInt(iModuleIndex) || 0;

        // get start selection range
        var oFrom = function() {
            var iSearch;
            var iFindCount = 0;

            for (var i = 0; i < aContent.length; i++) {

                iSearch = aContent[i].search(rSearch);

                if (iSearch == -1) continue;

                aFrom.push({ line : i, ch : iSearch });

                if (iModuleIndex == 0) return aFrom[aFrom.length - 1];

                //if (iFindCount++ != iModuleIndex) continue;
            }

            return aFrom[aFrom.length - 1];
        }();


        // Layout 파일에 동일한 모듈이 있는 경우, 해당 모듈을 정확히 찾기 위해 값 보정
        // TODO : 추후 성능에 문제가 생길 경우, 로직 변경 요망
        if (typeof iModuleCount != 'undefined' && iModuleIndex != 0 && iModuleCount != aFrom.length) {
            oFrom = aFrom[iModuleIndex - (iModuleCount - aFrom.length)];
        }

        if (oFrom == null) {
            this.sError = this.ERROR.NO_MODULE;
            return;
        }


        // get end selection range
        var oTo = function() {
            var aMatch;
            var sTag, sContent;
            var rStart, rEnd;
            var iLastIndex = 100;
            var iTagCount = 0;
            var iStart = oFrom.line;

            for (var i = iStart; i < aContent.length; i++) {
                sContent = aContent[i];

                if (i == iStart) {
                    sTag = sContent.match(rSearch)[1].split(' ')[0];

                    rStart = new RegExp('<\\s*' + sTag , 'ig');
                    rEnd =  new RegExp('<\/\\s*' + sTag , 'ig');

                    sContent = sContent.slice(sContent.search(rSearch) + sTag.length);

                    iTagCount++;
                }

                if ((aMatch = sContent.match(rStart)) != null) iTagCount += aMatch.length;

                if ((aMatch = sContent.match(rEnd)) != null) iTagCount -= aMatch.length;

                if (iTagCount <= 0) {

                    while (rEnd.test(aContent[i]) == true)  { iLastIndex = rEnd.lastIndex; if (iTagCount < 0) break; }

                    return { line : i , ch : iLastIndex + 1 };
                }
            }
        }();

        if (oTo == null) {
            this.sError = this.ERROR.WRONG_HTML;
            return;
        }

        this.sError = null;

        return {
            from : oFrom,
            to : oTo
        };
    },


    /**
     * 모듈 이름으로 Editor Selection
     *
     * @param string sModule 모듈 이름
     * @param integer iModuleIndex 모듈 index (Editor에 같은 모듈이 있을 경우 사용) default : 0
     * @return bool selection 성공 시 true, 실패 시 false
     */
    setModuleSelection : function(sModule, iModuleIndex) {
        var oRange;

        if ((oRange = this.getModuleRange(sModule, iModuleIndex)) == null) return false;

        this.setSelection(oRange.from, oRange.to);

        return true;
    },


    /**
     * 기존 CodeMirror Instance의 setSelection 함수 decorate
     * @param from
     * @param to
     */
    setSelection : function(from, to) {
        this._setSelection(from, to);

        this.oPrivRange.from = from;
        this.oPrivRange.to = to;
    },


    /**
     * 직전의 setSelection을 다시 실행
     */
    setSelectionAgain : function() {
        if (this.oPrivRange.from == null || this.oPrivRange.to == null) return;

        this._setSelection(this.oPrivRange.from, this.oPrivRange.to);
    },

    /**
     * 코드미러 2.x 버전에서 사용하던 onKeyEvent에 대응. 키 이벤트 추가
     * @param fnCallback keyEvent 콜백함수
     * @private
     */
    _setKeyEvent : function(fnCallback) {
        this._removeKeyEvent(fnCallback);
        this.on('keydown', fnCallback);
        this.on('keypress', fnCallback);
    },

    /**
     * 코드미러 2.x 버전에서 사용하던 onKeyEvent에 대응. 키 이벤트 제거
     * @param fnCallback keyEvent 콜백함수
     * @private
     */
    _removeKeyEvent : function(fnCallback) {
        this.off('keydown', fnCallback);
        this.off('keypress', fnCallback);
    }
};
/**
 * CodeMirror Editor Pool
 *
 * 열린 파일 마다 각각 CodeMirror Instance를 생성하고, 이를 EditorPool에서 관리
 */
SDE.Editor.Pool = function(){
    var pools = {},
        count = 0,
        currentPool,
        currentUrl,
        isInitializing = false,
        isReplacing = false,
        $container;

    /**
     * 초기화
     */
    var init = function(container_selector) {
        $container = $(container_selector);

        setEventHandler();
    };


    /**
     * pool 객체 생성
     */
    var create = function(filename, readonly) {
        var editor,
            id = 'editor_' + (count++),
            $box = $('<div style="display:none; height:100%;"><textarea id="'+ id +'" name="'+ id +'"></textarea></div>').appendTo($container),

            editor = createEditor(id),
            readonly = readonly || false;

        editor.setOption("AutoCompletions", SDEAutoCompletions);
        editor._setKeyEvent(AutoComplete.keyEvent);
        editor.on("change", onEditorTextChange);
        editor.on("update", onEditorUpdate);
        editor.setOption("extraKeys", { 'Ctrl-S': onEditorShortCutSave });

        return (pools[filename] = { 'editor' : editor, 'box' : $box, 'readonly' : readonly });
    };

    var createEditor = function(id) {
        return new SDE.Editor.Wrapper(id, {
            lineNumbers: true,
            indentUnit: 4,
            indentWithTabs: false,
            firstLineNumber: 1,
            mode: "text/html",
            theme: 'default',
            value: '',
            electricChars: false
        });
    };

    /**
     * pool 객체 설정
     */
    var set = function(filename, data) {
        var isNew = false,
            pool = pools[filename],
            readonly = data.readonly || false;

        isInitializing = true;

        if (currentPool) currentPool.box.hide();

        if (pool == null) {
            pool = create(filename, readonly);
            isNew = true;
        }

        currentPool = pool;



        if (isNew) {
            pool.editor.setValue(data.content);
            pool.editor.setCursor(data.cursor);
            pool.editor.setOption('mode', SDE.Util.File.getMimeType(filename));
            pool.editor.setOption('readOnly', readonly);
            pool.editor.clearHistory();

            setExternalFileOpen();
        }

        pool.box.show();

        pool.editor.refresh();

        SDE.editor = pool.editor;

        SDE.BroadCastManager.send('window-resize');

        isInitializing = false;
    };


    /**
     * Pool에서 삭제
     */
    var remove = function(filename) {
        if (pools[filename] == null) return;

        if (currentPool == pools[filename]) currentPool = null;

        pools[filename].box.remove();

        delete pools[filename];
    };

    var removeAll =function() {
        for (var filename in pools) {
            remove(filename);
        }
    };


    /**
     * Event Handler 설정
     */
    var setEventHandler = function() {

        SDE.BroadCastManager.listen({
            'file-open' : onFileOpened,
            'file-close' : onFileClose,
            'file-close-all' : onFileCloseAll
        });
    };


    var setExternalFileOpen = function() {
        var pattern  = /<\!--@((layout)|(css)|(js)|(import))\((.*?)\)-->/;

        var $oLine = currentPool.box.find('.cm-comment').closest('.CodeMirror-line');

        $oLine.unbind('.external_link').bind({
            'mouseenter.external_link' : function() {
                var $this = $(this),
                    match = $this.text().match(pattern);

                if (!match) return;

                var $oCommentWrapper = $this.find('.cm-comment').parent();
                $('<span class="go-external" data-url="'+ match[6] +'">'+ __('OPEN.FILE', 'EDITOR.RESOURCE.JS.POOL') +'</span>')
                    .appendTo($oCommentWrapper)
                    .click(function() {
                        var url = $(this).data('url');

                        SDE.File.Manager.open(url);
                    });
            },
            'mouseleave.external_link' : function() {
                $oExternalLink = $(this).find('.go-external');
                if ($oExternalLink.length > 0) {
                    $oExternalLink.remove();
                }
            }
        });
    };


    /**
     * Editor 글자 변경 시
     */
    var onEditorTextChange = function() {
        if (isInitializing || isReplacing) return;

        SDE.BroadCastManager.send('file-content-change', currentUrl, currentPool.editor.getValue());
    };


    /**
     * Editor Dom Display 업데이트 시
     */
    var onEditorUpdate = function() {
        setExternalFileOpen();
    };


    /**
     * Editor 내에서 Ctrl + S 입력 시
     */
    var onEditorShortCutSave = function(instance) {
        SDE.File.Manager.save(currentUrl);
    };



    /**
     * 파일 Open 시
     */
    var onFileOpened = function(evt, url, data) {

        /*rev.b3.20130828.2@sinseki #SDE-6: 소스에디터 탭간 이동시 기존 커서 포커스를 잃음*/
        /*rev.b1.20131015.1@sinseki #SDE-29 화면보기 상태에서 모듈 편집 버튼을 누르는 경우, 응답 없음 오류*/
        var $visible = $('.CodeMirror-scroll:visible').length;
        if ($visible && currentPool) {
            currentPool.cursor = currentPool.editor.getCursor();
            /*rev.b1.20131015.1@sinseki #SDE-30 #SDE-6 포커스 된 라인이 항상 화면 하단으로 위치 수정되는 오류*/
            currentPool.cursor.top = $('.CodeMirror-scroll:visible').scrollTop();
        }

        set(url, data);

        currentPool.editor.clearSelection();

        /*rev.b2.20130812.2@sinseki #SDE-6: 소스에디터 탭간 이동시 기존 커서 포커스를 잃음*/
        if ($visible) {
            currentPool.editor.focus();
            currentPool.editor.setCursor(currentPool.cursor || {line:0, ch:0});
            $('.CodeMirror-scroll:visible').scrollTop(currentPool.cursor? currentPool.cursor.top: 0);
        }

        currentUrl = url;
    };


    var onFileCloseAll = function() {
        removeAll();
    };


    /**
     * 파일 Close 시
     */
    var onFileClose = function(evt, url) {
        remove(url);

        currentUrl = null;
    };

    /**
     * Editor의 사이즈가 바뀔 때 호출 해줘야 함. Window Resize는 Editor 내에서 자체적으로 Listen
     */
    var refresh = function() {
        if (!currentPool) return;

        currentPool.editor.refresh();

        currentPool.editor.clearSelection();
    };

    var isReadonly = function(sUrl) {
        if (sUrl === undefined) {
            return false;
        }

        if (pools.hasOwnProperty(sUrl) === false) {
             return false;
        }

        return pools[sUrl].readonly || false;
    };

    return {
        init : function(container_selector) {
            init(container_selector);
        },

        create : function(id) {
            return createEditor(id);
        },

        get : function() {
            return currentPool.editor;
        },

        getPools : function () {
            return pools;
        },

        getCurrentUrl : function () {
            return currentUrl;
        },

        refresh : function() {
            refresh();
        },

        setReplacingMode : function (bFlag) {
            isReplacing = bFlag;
        },

        isReadonly : function(sUrl) {
            return isReadonly(sUrl);
        }
    };
}();
/*
 * SDE에서 발생하는 Global Event 관리
 * 
 * jquery의 custom event를 이 객체를 통해 trigger & bind. 
 * 
 * 이를 통해 다른 객체들끼리의 종속성을 줄일 수 있다.
 * 
 * ex) file open, file remove, file close, resize, window close 등
 */
SDE.BroadCastManager = function(){
    var init = function() {
        $(window).bind('resize', onResize);
    };
    
    var onResize = function() {
        SDE.BroadCastManager.send('window-resize');
    };
    
    init();
    
    return {
        send : function(eventName) {
            $(this).triggerHandler(eventName, Array.prototype.slice.call(arguments, 1));
        },
        
        /**
         * before unload의 경우 alert 창은 마지막에 bind된 함수의 것으로 결정됨
         */
        listen : function(eventName, callback) {
            if (typeof eventName == 'object') { 
                for (var key in eventName) arguments.callee(key, eventName[key]);
                
                return;
            }
            
            if (!callback) return;
            
            var $handler = $((eventName == 'beforeunload') ? window : SDE.BroadCastManager);
            
            $handler.bind(eventName, callback);
        }
    };
}();
/**
 * Content 영역 Loading 표시
 */
SDE.LoadingIndicator = function() {
    var $loading,
        isInit = false;
    
    var init = function() {
        $loading = $('<div class="loadingIndicator" style="position:absolute; z-index:101; top:45px; left:'+(SDE.mo()?883:775)+'px">' +
                         '<img src="/ec-img/loading_indicator.gif"/>' +
                     '</div>').appendTo(document.body),
                     
        isInit = true;
    };

    return {
        show : function() {
            var $window = $(window);
            
            if (!isInit) init();
            
            $loading.show();
        },
        
        hide : function() {
            if (!isInit) return;
            
            $loading.hide();
        }
    };
}();

/**
 * 자주쓰는 화면 Controller
 * 
 * 화면 리스트의 추가, 수정, 삭제를 관리
 */

SDE.List.Favorite = {};

SDE.List.Favorite.Controller = function() {
    var CONTAINER_SELECTOR = '#snbFavorite ul';
    
    var API = {
        GET : getMultiShopUrl('/exec/admin/editor/favoritelist'),
        REMOVE : getMultiShopUrl('/exec/admin/editor/favoriteremove'),
        SET : getMultiShopUrl('/exec/admin/editor/favoritemodify')
    };
    
    var $container, layer, modifiedUrl;
    
    var isInitialized = false;
    
    /**
     * 즐겨찾기 데이터 가져오기
     */
    var get = function() {
        $.ajax({
            url : API.GET,
            dataType : 'json',
            data : { skin_no : SDE.SKIN_NO },
            success : $.proxy(render, this)
         });
    };
    
    /**
     * Favorite.Node 가져오기
     */
    var getNode = function(url) {
        return $container.find('[data-url=' + url + ']').data('node');
    };

    
    /**
     * 즐겨찾기 리스트 전체 추가
     */
    var render = function(data) {
        for (url in data.results) {
            renderOne(url, data.results[url]);
        }
    };
  
    
    /**
     * 즐겨찾기 리스트 1개 추가
     */
    var renderOne = function(url, name) {
        var $el,
        $main = $container.find('[data-type=main] ul'),
        $layout = $container.find('[data-type=layout] ul');    
        
        $el = (url.indexOf('/layout') == 0) ? $layout : $main;
                
        $el.append(makeNode(url, name));
    };    
    
    
    /**
     * 즐겨찾기 Node 객체 생성
     */
    var makeNode = function(url, name) {
        var node = new SDE.List.Favorite.Node({ 'name' : name, 'url' : url });
        
        $(node).bind({
            'remove' : $.proxy(onRemoveNode, this),
            'modify' : $.proxy(onModifyNode, this)
        });
        
        return node.getElement();
    };
    
    var makeModifyLayer = function() {
        layer = new SDE.Layer.Favorite();
        
        layer.listen('save', $.proxy(onModifySubmit, this));
    };

    
    /**
     * 리스트 추가 or 수정
     */
    var set = function(url, name, bIsModify) {
        name = $.trim(name.replace(/<.*/ig, ''));
        var bIsModify = bIsModify === true ? 'T' : 'F';
        var data = $.parseJSON($.ajax({
            url : API.SET,
            data : { url : url, name : name, skin_no : SDE.SKIN_NO, is_modify : bIsModify },
            async : false
        }).responseText);
        
        if (data == null || data.success == false) {
            alert(__('WAS.PROBLEM.PLEASE.TRY', 'EDITOR.FAVORITE.CONTROLLER'));
            return;
        }
        
        node = getNode(url);
        
        if (node) {
            node.modify(name); 
        } else {
            renderOne(url, name);
        }
        
        return true;
    };
    
    
    /**
     * 리스트 삭제
     */
    var remove = function(url) {
        var node = getNode(url),
            data;

        if (!node) return;

        data = $.parseJSON($.ajax({
            url : API.REMOVE,
            data : { url : url, skin_no : SDE.SKIN_NO },
            async : false
        }).responseText);
         
         if (data == null || data.success == false) {
             alert(__('WAS.PROBLEM.PLEASE.TRY', 'EDITOR.FAVORITE.CONTROLLER'));
             return false;
         }

         node.remove();
         
         return true;
    };
    
    /**
     * 수정 레이어에서 확인 버튼 클릭 시 
     */
    var onModifySubmit = function(evt, name) {
        set(modifiedUrl, name, true);
        
        layer.hide();
    };
    
    
    /**
     * 삭제 버튼 클릭 시 
     */
    var onRemoveNode = function(evt, url) {
        return remove(url);
    };
    
    /**
     * 수정 버튼 클릭 시 
     */
    var onModifyNode = function(evt, url) {
        if (!layer) makeModifyLayer();
        
        node = getNode(url);
        
        layer.show(node.name, node.url);
        
        modifiedUrl = url;
    };

    var onFileRemove = function(evt, url) {
        remove(url);
    };
    
    return {
        init : function() {
            if (isInitialized) return; 
            
            isInitialized = true;
            
            $container = $(CONTAINER_SELECTOR);

            SDE.BroadCastManager.listen({
                'file-remove' : $.proxy(onFileRemove, this) 
            });
            
            get();     
        },
        
        add : function(url, name) {
            if (!isInitialized) return;
            
            if ($container.find('ul li').length >= 20) {
                alert(__('YOU.CAN.SAVE.FAVORITES', 'EDITOR.FAVORITE.CONTROLLER'));
                return false;
            }
            
            return set(url, name, false);
        },
        
        remove : function(url) {
            if (!isInitialized) return;
            
            return remove(url);
        } 
    };
}();

SDE.List.Favorite.Node = Class.extend({
    PROP_KEY : ['url', 'name'],
    
    init : function(data) {
        data = data || {};
        
        for (i in this.PROP_KEY) {
            var key = this.PROP_KEY[i];
            
            if (typeof(data[key]) == 'undefined') throw('Not Valid Parameter');
            
            this[key] = data[key];
        }
        
        this._render();
        
        this._setEventListener();
        
        this.element.data('node', this);
    },
    
    remove : function() {
        this.element.slideUp(500, function() {
            $(this).remove(); 
        });

        this.element = null;
        
        SDE.BroadCastManager.send('favorite-remove', [this.url]);
    },
    
    modify : function(name) {
        this.name = name;
        
        this.element.find('a[data-type=open]').html(name);
    },
    
    getElement : function() {
        return this.element;
    },
    
    _getTemplate : function() {
        return '<li data-url="' + this.url + '" class="'+ SDE.Util.File.getSuffix(this.url) +'">' +
                    '<span>' +
                        '<a href="' + this.url + '" data-type="open">' + this.name + '</a>' +
                        '<span class="btn">' +
                        '<button type="button" class="modify" data-type="modify">'+ __('MODIFIED', 'EDITOR.FAVORITE.NODE') +'</button>' +
                        '<button type="button" class="delete" data-type="remove">'+ __('DELETE.ADD', 'EDITOR.FAVORITE.NODE') +'</button>' +
                        '</span>' +
                    '</span>' +
               '</li>';
    },
    
    _render : function() {
        this.element = $(this._getTemplate());
    },
    
    _setEventListener : function() {
        this.element.find('a[data-type=open]').click($.proxy(this._onClickOpen, this));
        
        this.element.find('button[data-type=modify]').click($.proxy(this._onClickModify, this));
        
        this.element.find('button[data-type=remove]').click($.proxy(this._onClickRemove, this));
    },
    
    _onClickOpen : function(evt) {
        evt.preventDefault();
        
        SDE.File.Manager.open(this.url);
    },
    
    _onClickModify : function(evt) {
        $(this).triggerHandler('modify', [this.url]);
    },
    
    _onClickRemove : function(evt) {
        evt.preventDefault();
        
        if (!confirm(__('ARE.SURE', 'EDITOR.FAVORITE.NODE'))) {
            return;
        }
        
        $(this).triggerHandler('remove', [this.url]);
    }
});

SDE.List.Tab.Controller = function() {
    var CONTAINER_SELECTOR = '.subHeader .tab',
        TAB_WIDTH = 200;
    
    var $container;
    
    var tabs = [], // 각 배열은 { key : '파일 url', tab : SDE.List.Tab.Node 객체 }로 구성. 탭의 순서 정보가 필요하기 때문에 array + Key 이용
        showingIndex = 0, // 제일 첫번 째로 보여지는 Tab의 Index
        currentKey;
    
    /**
     * store 에서 데이터 삭제
     */
    var close = function(key) {
        tabs.splice(getIndex(key), 1);
        

        if ($.browser.msie) {
            resetDisplay();
        } else {
            // 삭제 effect 효과 끝난 뒤 처리를 위해
            setTimeout(resetDisplay, 150);
        }
        
        if (getCount() == 0 || key != currentKey) return;
        
        // 남아있는 탭이 있고 현재 열린 탭을 닫았을 경우, 마지막 탭을 찾아서 Open
        SDE.File.Manager.open(tabs[tabs.length - 1].key);
    };
    
    var closeAll = function() {
        tabs = [];
        
        showingIndex = 0;
        
        currentKey = null;
    };
    
    /**
     * Tab 가져오기. 없으면 새로 생성해서 반환
     */
    var getTab = function(key, desc) {
        var index = getIndex(key);
        
        if (tabs[index]) return tabs[index].tab;
        
        return setTab(key, desc);
    };
    
    /**
     * Tab 갯수 가져오기
     */
    var getCount = function() {
        return tabs.length;
    };
    
    /**
     * Tab 인덱스 가져오기
     */
    var getIndex = function(key) {
        for (var index in tabs) {
            if (tabs[index].key == key) return parseInt(index);
        }
        
        return null;
    };
    
     /**
     * 화면에 표현 가능한 갯수 가져오기
     */
    var getAvailableCount = function() {
        return parseInt($container.width() / TAB_WIDTH);
    };
    
    /**
     * Tab Node 생성
     */
    var make = function(url, desc) {
        var tab = new SDE.List.Tab.Node({'url' : url, 'desc' : desc });
        
        tab.$node.appendTo($container);
        
        tab.animate();
        
        return tab;
    };
    
    
    /**
     * 오른쪽으로 탭 한칸 이동
     */
    var moveNext = function() {
        var tabCount = getCount(),
        count = getAvailableCount();
        
        if (tabCount <= showingIndex + count) return;
        
        showingIndex++;
        
        setDisplay();
    };
    
    
    /**
     * 왼쪽으로 탭 한칸 이동 
     */
    var movePrev = function() {
        if (showingIndex == 0) return;
        
        showingIndex--;
        
        setDisplay();
    };
    
    /**
     * 해당 Index로 이동 
     */
    var moveTo = function(index) {
        var avaliableCount = getAvailableCount(),
            maxIndex = getCount() - avaliableCount;
    
        if (maxIndex < 0) {
            maxIndex = 0;
        }
        
        if (showingIndex <= index && index < showingIndex + avaliableCount) return;
        
        showingIndex = (maxIndex < index) ? maxIndex : index;
        
        setDisplay();    
    };
    
    var setTab = function(key, desc) {
        var tab = make(key, desc);
        
        tabs.push({key : key, tab : tab});
        
        return tab;
    };
    
    /**
     * Tab 선택 처리
     */
    var select = function(url) {
        var tab = getTab(url), 
            key;
        
        for (var index in tabs) {
            if (tabs[index].key == url) continue;
            
            tabs[index].tab.unselect();
        }
        
        currentKey = url;
    };
    
    /**
     * Tab Display 여부 설정
     */
    var setDisplay = function() {
        var count = getAvailableCount();
    
        for (var index in tabs) {
            if (showingIndex <= index && index < showingIndex + count) tabs[index].tab.show();
            else tabs[index].tab.hide();
        };
        
        $container.find('li').removeClass('first');
        $container.find('li:visible:first').addClass('first');
    };
    
    /**
     * 새로운 파일이 열렸을 경우
     */
    var onFileOpen = function(evt, url, data) {
        var tab = getTab(url, data.desc);
        
        select(url);
        
        tab.select();
                
        moveTo(getIndex(url));
    };
    
    var onFileClose = function(evt, url) {
        getTab(url).remove();
        
        close(url);
    };
    
    var onFileCloseAll = function(evt) {
        for (var index in tabs) {
            tabs[index].tab.remove();
        } 
        
        closeAll();
    };
    
    /**
     * Window Resize 시
     */
    var onWindowResize = function(evt) {        
        resetDisplay();
    };

    var onFileRemove = function(evt, url) {
        getTab(url).remove();

        close(url);
    };
    
    /**
     * 파일 내용 변경 시
     */
    var onFileContentChange = function(evt, url) {
        getTab(url).setEditing(true);
    };
    
    var onFileSave = function(evt, url) {
        getTab(url).setEditing(false);
    };
    
    var onFileSaveAll = function(evt) {
        for (var index in tabs) {
            tabs[index].tab.setEditing(false);
        }
    };
    
    /**
     * 현재 Tab Container 크기에 맞게 Display 조정
     */
    var resetDisplay = function() {
        var count = getCount(),
        avaliableCount = getAvailableCount();
    
        if (showingIndex + avaliableCount > count && count >= avaliableCount) {
            showingIndex = count - avaliableCount;
        }
        
        setDisplay();
    };
    
    return {
        /**
         * 초기화
         */
        init : function() {
            $container = $(CONTAINER_SELECTOR);
            
            SDE.BroadCastManager.listen({
                'file-open' : $.proxy(onFileOpen, this),
                'file-save' : $.proxy(onFileSave, this),
                'file-save-all' : $.proxy(onFileSaveAll, this),
                'file-close' : $.proxy(onFileClose, this),
                'file-close-all' : $.proxy(onFileCloseAll, this),
                'file-content-change' : $.proxy(onFileContentChange, this),
                'file-remove' : $.proxy(onFileRemove, this),
                'window-resize' : $.proxy(onWindowResize, this)
            });
        },
        
        movePrev : function() {
            movePrev();
        },
        
        moveNext : function() {
            moveNext();
        }
    };
}();

SDE.List.Tab.Node = Class.extend({
    data : null,
    isEditing : false,

    init : function(data) {
        this.data = data || {};

        this._render();

        this._setEventListener();

        this.$node.data('node', this);
    },

    select : function() {
        this.$node.addClass('selected');
    },

    unselect : function() {
        this.$node.removeClass('selected');
    },

    setEditing : function(is) {
        if (this.isEditing == is) return;

        this.$node[(is ? 'add' : 'remove') + 'Class']('modify');

        this.isEditing = is;
    },

    show : function() {
        this.$node.css('display', 'list-item');
    },

    hide : function() {
        this.$node.css('display', 'none');
    },

    animate : function() {
        this.$node.find('a').animate({ 'width' : 135 }, 100);
    },

    remove : function() {
        $(this).unbind();

        this.$node.animate({ 'width' : 0 }, 100, function() { $(this).remove(); });
    },

    _render : function() {
        var url = SDE.Util.File.getFileName(this.data.url);
        var name = this.data.desc ? this.data.desc + '(' + url + ')' : url;

        /*rev$@sinseki #SDE-11 파일탭의 이름이 긴경우 title 표시*/
        var sCloseText = __('CLOSE', 'EDITOR.TAB.NODE');
        this.$node = $('<li><span><a style="width:0;" href="'+ this.data.url +'" title="' + name + '">' + name + '</a><button type="button" title="'+ sCloseText +'">'+ sCloseText +'</button></span></li>');
    },

    _setEventListener : function() {
        this.$node.click($.proxy(this._onClick, this));

        this.$node.find('button').click($.proxy(this._onClickClose, this));
    },

    _onClick : function(evt) {
        evt.preventDefault();

        SDE.File.Manager.open(this.data.url);
    },


    _onClickClose : function(evt) {
        evt.preventDefault();

        evt.stopPropagation();

        SDE.File.Manager.close(this.data.url);
    }
});

SDE.List.TabList.Controller = function() {
    var CONTAINER_SELECTOR = '.subHeader .file',
        BTN_SELECTOR = '.subHeader .fileList button.list';
    
    var getList = function(url) {
        return $container.find('li[data-url="'+ url +'"]');
    };
    
    var hide = function() {
        $container.hide();
    };

    var close = function(url) {
        getList(url).remove();
        
        hide();
        
        if ($container.find('li').length == 0) $btn.addClass('disabled');
    };
    
    var onClickButton = function(evt) {
        evt.stopPropagation();
        
        if ($container.find('li').length == 0) return;
        
        $container.toggle();
    };
    
    var onClickList = function(evt) {
        var url = $(evt.currentTarget).data('url');
        
        SDE.File.Manager.open(url);
        
        hide();
        
        evt.preventDefault();
    };
    
    var onClickBody = function(evt) {
        var $target = $(evt.target);
        
        if ($container.is(':hidden')) return;

        if ($target.parents(CONTAINER_SELECTOR).length != 0) return;
        
        hide();
    };
    
    var onFileOpen = function(evt, url, data) {
        var list = getList(url),
            name, className, html;
        
        if (list.length != 0) return;
        
        name = data.desc ? data.desc + ' (' + url + ')' : url,
        className = SDE.Util.File.getSuffix(url),
        html = '<li class="'+ className +'" data-url="' + url + '"><a href="'+ url +'">' + name + '</a></li>';
        
        $(html).appendTo($container.find('ul')).click($.proxy(onClickList, this));
        
        $btn.removeClass('disabled');
    };
    
    var onFileClose = function(evt, url) {
        close(url);
    };

    var onFileRemove = function(evt, url) {
        close(url);
    };
    
    var onFileCloseAll = function() {
        $container.find('ul').html('');
        
        $btn.addClass('disabled');
    };
    
    return {
        init : function() {
            $(document.body).click($.proxy(onClickBody, this));
            
            $container = $(CONTAINER_SELECTOR);
            $btn = $(BTN_SELECTOR).click($.proxy(onClickButton, this));
            
            SDE.BroadCastManager.listen({
                'file-open' : $.proxy(onFileOpen, this),
                'file-close' : $.proxy(onFileClose, this),
                'file-close-all' : $.proxy(onFileCloseAll, this),
                'file-remove' : $.proxy(onFileRemove, this)
            });
        }
    };
}();

/**
 * TreeList Controller
 *
 * 기존의 dir.js를 Refactoring. 객체간의 Dependency를 줄이기 위해 Event Driven 방식으로 변경
 *
 * dependencies [3rdparty/class.js, List/Tree/*.js]
 */

SDE.List.Tree.Controller = Class.extend({
    /**
     * Variables
     */

    oConfig : {
        bShowFiles : true,          // 파일 목록 리스트를 보여줄지에 대한 여부
        sMode : 'mixed'              // 폴더 View Mode. 'title' or 'desc' or 'mixed'
    },


    /**
     * 초기화
     */
    init : function(sContainerSelector, oConfig) {
        this.oConfig = $.extend({}, this.oConfig, oConfig);

        this.oConfig.sMode =  this.oConfig.sMode || Tree.ModeChanger.getMode();

        this.oContainerEl = $(sContainerSelector);

        this.aNodes = {};

        this._makeRoot();

        this._setEventListener();

        this._renderNodes();

        // 현재화면 꾸미기로 에디터 접근 시 해당 파일이 속해있는 디렉토리 모두 Rendering
        if (typeof window.editorFile == 'undefined') {
            this._renderAllNodes(window.editorFile);
        }
    },

    /**
     * Tree.Node 객체 가져오기
     */
    _getNode : function(sKey) {
        return this.aNodes[sKey];
    },


    /**
     * Node를 삽입할 Root 검색하여 가져오기
     */
    _getRootElement : function(oParams) {
        var oChildEl;

        var oEl = oParams.oNode != null ? oParams.oNode.getElement() :
                  oParams.sDir ? this.oRootEl.find('li.folder a[href='+ oParams.sDir +']').parent() :
                  this.oRootEl;

        if ((oChildEl = oEl.children('ul')).length != 0) return oChildEl;

        return $('<ul ' + (oParams.bDisplayNone == true ? 'style="display:none"' : '') + '/>').appendTo(oEl);
    },



    /**
     * 초기화 시에 Root 생성
     */
    _makeRoot : function() {
        var aNodeData = {
            'file_type' : 'dir',
            'file_name' : SDE.SKIN_CODE,
            'path' : '',
            'is_root' : true
        };

        var oRootEl = $('<ul class="root"/>').appendTo(this.oContainerEl);

        var oNode = this._setNode(aNodeData, oRootEl);

        this.oRootEl = oNode.getElement();

    },

    /**
     * Node 생성
     */
    _makeNodes : function(aNodes, oRootEl) {
        for (i in aNodes) {
            var aNodeData = aNodes[i];

            this._setNode(aNodeData, oRootEl);
        }
    },


    /**
     * API에서 Node 데이터를 가져와서 Tree에 append
     */
    _renderNodes : function(sDir, oNode) {
        aNodes = this._processNodeData(SDE.List.Tree.Store.get(sDir));

        oRootEl = this._getRootElement({ oNode : oNode });

        this._makeNodes(aNodes, oRootEl);
    },


    /**
     * sPath가 속해있는 모든 Node를 Render
     */
    _renderAllNodes : function(sPath) {
        if (typeof sPath != 'string') return;

        var aUrls = SDE.Util.File.getFileDir(sPath).split('/');
        var oNode;
        var sDir = '';

        for (var key in aUrls) {
            // Root는 제외
            if (!aUrls[key]) continue;

            sDir += '/' + aUrls[key];

            if ((oNode = this._getNode(sDir)) == null) break;

            this._renderNodes(sDir, oNode);

            if (oNode.getType() == 'dir') {
                oNode.setLoaded();
            }
        }
    },

    _removeNode : function(sKey) {
        delete this.aNodes[sKey];
    },


    /**
     * 외부 다른 객체의 Event Listener 설정
     */
    _setEventListener : function() {
        SDE.BroadCastManager.listen({
            'favorite-remove' : $.proxy(this._onFavoriteRemoved, this),
            /*rev$@sinseki #SDE-5 쇼핑몰 화면 추가 영역을 2등분 하여, 앞에 디렉토리 추가버튼과 기능 구현*/
            'dir-add': $.proxy(this._onDirAdded, this),
            'file-add': $.proxy(this._onFileAdded, this),
            'file-save' : $.proxy(this._onFileSaved, this),
            'file-remove' : $.proxy(this._onFileRemoved, this)
        });
    },

    /**
     * Node 객체 생성
     */
    _setNode : function(aNodeData, oRootEl) {
        aNodeData = aNodeData || {};
        aNodeData.sMode = this.oConfig.sMode;

        var oNode;
        var sKey = aNodeData.path + '/' + aNodeData.file_name;

        // 모드 변경할 경우, 새 Node를 생성하지 않고 기존의 Node 객체 그대로 사용
        if ((oNode = this._getNode(sKey)) == null) {
            oNode = (aNodeData.file_type == 'dir') ? new SDE.List.Tree.Dir(aNodeData, this) : new SDE.List.Tree.File(aNodeData, this);

            this._setNodeEventListener(oNode);
        } else {
            oNode.reset(aNodeData);
        }

        this._appendNode(oRootEl, oNode);

        this.aNodes[sKey] = oNode;

        return oNode;
    },

    _appendNode : function(oTarget, oNode) {
        var oEl = oNode.getElement(),
            oFolderLast, oFileFirst;

        if (oNode.getType() == 'dir' && oTarget.children().length != 0) {

            if ((oFolderLast = oTarget.find('.folder:last')).length != 0) {
                oFolderLast.after(oEl);
            } else if ((oFileFirst = oTarget.find('.file:first')).length != 0) {
                oFileFirst.before(oEl);
            }

            return;
        }

        oTarget.append(oEl);
    },


    /**
     * Node가 파일이고, 해당 파일의 위치가 parent인 경우 me로 변경
     */
    _changeNodeToMe : function(sPath) {
        var oNode;

        if ((oNode = this._getNode(sPath)) == null || oNode.getType() == 'dir') return;

        oNode.setToMe();
    },


    /**
     * Node Event Listener 설정
     */
    _setNodeEventListener : function(oNode) {
        $(oNode).bind({
            'dir-open' : $.proxy(this._onDirOpened, this),
            'dir-click' : $.proxy(this._onDirClicked, this),
            'file-click' : $.proxy(this._onFileClicked, this),
            'favorite-add' : $.proxy(this._onFavoriteChanged, this),
            'favorite-remove' : $.proxy(this._onFavoriteChanged, this)
        });
    },


    /**
     * Node 데이터 가공
     */
    _processNodeData : function(aNodes) {
        var aKeys = ['file', 'dir'];

        for (var i in aKeys) {
            var key = aKeys[i];

            if (aNodes[key] == null) aNodes[key] = [];
        }

        aNodes = (this.oConfig['bShowFiles'] == false) ? aNodes['dir'] : aNodes['dir'].concat(aNodes['file']);

        return aNodes;
    },


    /**
     * Tree에서 파일 선택 시
     */
    _onFileClicked : function(e, sPath) {
        oNode = this._getNode(sPath);

        SDE.File.Manager.open(sPath);
    },


    /**
     * 신규 파일 추가 시
     */
    _onFileAdded : function(e, sPath) {
        if (!this.oConfig.bShowFiles) return;

        var sDir = SDE.Util.File.getFileDir(sPath);
        var sFileName = SDE.Util.File.getFileName(sPath);


        // 상속 받은 Parent 파일이 있는 경우
        if (this._getNode(sPath) != null) {
            this._changeNodeToMe(sPath);
            return;
        }

        var oRootEl = this._getRootElement({ sDir : sDir, bDisplayNone : true });

        var aNodeData = {
            'file_type' : 'file',
            'file_name' : sFileName,
            'path' : sDir
        };

        this._setNode(aNodeData, oRootEl);
    },



    /*rev$@sinseki #SDE-5 쇼핑몰 화면 추가 영역을 2등분 하여, 앞에 디렉토리 추가버튼과 기능 구현*/
    /**
     * 신규 폴더 추가 시
     */
    _onDirAdded : function(e, sPath) {
        if (!this.oConfig.bShowFiles) return;

        var sDir = SDE.Util.File.getFileDir(sPath);
        var sFileName = SDE.Util.File.getFileName(sPath);

        var oRootEl = this._getRootElement({ sDir : sDir, bDisplayNone : true });

        var aNodeData = {
            'file_type' : 'dir',
            'file_name' : sFileName,
            'path' : sDir
        };

        this._setNode(aNodeData, oRootEl);

        // ECHOSTING-158389 폴더추가 시 트리정보 삭제처리
        SDE.List.Tree.Store.remove(sDir);
        SDE.List.Tree.Store.remove();

        // 좌측영역 트리 업데이트
        $('#snbAll.scroll').html('');
        new SDE.List.Tree.Controller('#snbAll');
    },


    /**
     * 파일 저장 시
     */
    _onFileSaved : function(e, sPath) {
        this._changeNodeToMe(sPath);
    },


    /**
     * 파일 삭제 시
     */
    _onFileRemoved : function(e, sPath) {
        var oNode = this._getNode(sPath);

        if (!oNode) return;

        oNode.remove();

        this._removeNode(sPath);
    },


    /**
     * 디렉토리 선택 시
     */
    _onDirClicked : function(e, sPath) {
        $(this).trigger('dir-click', [sPath]);
    },


    /**
     * 디렉토리 열릴 때
     */
    _onDirOpened : function(e, sPath) {
        var oDir = e.target;

        if (oDir.isLoaded() == true) return;

        this._renderNodes(sPath, oDir);
    },


    /**
     * File Node에서 즐겨찾기 버튼 클릭 시
     */
    _onFavoriteChanged : function(e, sUrl, sName) {
        return SDE.BroadCastManager.send(e.type, { 'url' : sUrl, 'name' : sName });
    },

    /**
     * 즐겨찾기 목록에서 리스트 삭제 시 (별표 싱크를 위해)
     */
    _onFavoriteRemoved : function(e, sUrl) {
        var oNode;

        if ((oNode = this._getNode(sUrl)) == null) return;

        if ((oNode.getType() != 'file')) return;

        oNode.unselectFav();
    }
});

/**
 * Tree.Node
 * 
 * dependencies [extends/class.js]
 */

SDE.List.Tree.Node = Class.extend({   
    sType : null,
    sPath : null,
    sFileName : null,
    sDesc : null,
    sPos : null,
    sMode : 'title',
    element : null,
    
    
    init : function(aData) {
        // TODO : aData 변수 세팅하는 부분 개선할 것
        this.sFileName = aData.file_name;
        
        this.sPath = aData.path + '/' + aData.file_name;
        
        this.sDesc = aData.file_desc;
        
        this.sMode = aData.sMode || this.sMode;
        
        this.sPos = aData.file_pos;
        
        this.element = $(this._getTemplate());
        
        this._setEventListener();  
    },
    
    
    reset : function(aData) {
        this.sMode = aData.sMode || this.sMode;
        
        this.element = $(this._getTemplate());
        
        this._setEventListener();
    },
    
    

    getKey : function() {
        return this.sPath;
    },
    
    /**
     * Node Type 반환 'dir' or 'file
     * @returns string Node Type
     */
    getType : function() {
        return this.sType;
    },
    
    /**
     * Node의 Jquery Element 반환
     * @returns object Node의 Jquery Element  
     */
    getElement : function() {        
        return this.element;
    },
    
    
    remove : function() {
        this.element.remove();
    },
    
    
    _getNodeName : function() {
        if (this.sMode == 'desc') {
            return this.sDesc;
        } 
        
        if (this.sMode == 'mixed' && this.sDesc && this.sDesc != this.sFileName) {
            return this.sDesc + ' <span>('+ this.sFileName + ')</span>';
        } 
        
        return this.sFileName;
    },
    
    
    _getTemplate : function() {
        return '';
    },
    
    
    _setMode : function(sMode) {
        this.sMode = (sMode == 'desc') ? 'desc' : 'title'; 
    },
    
    _setEventListener : function() {
        this.element.find('a').click($.proxy(this._onClick, this));
    },
    
    
    _onClick : function(e) {
        e.preventDefault();
        
        //e.stopPropagation();
    },
    
    
    /**
     * Mode 변경
     * @param sMode 'desc' or 'name'
     */
    _OnModeChange : function(e, sMode) {
        if (this.sMode == sMode) return;
        
        this._setMode(sMode);
        
        this.element.find('a').html(this._getNodeName());
    }    
});

/**
 * Tree.File
 *  
 * dependencies [tree/Node.js]
 */

SDE.List.Tree.File = SDE.List.Tree.Node.extend({
    SELECTED_CLASS : 'selected',
    sType : 'file',
    bIsSelected : false,
    bIsFavorite : false,
    
    init : function(aData) {
        this.bIsFavorite = aData.is_favorite;
        
        this._super(aData);
        
        this._setClass();
    },
    
    
    reset : function(aData) {
        this.init(aData);
    },
    
    /**
     * 상속된 파일 형식일 경우, 자신의 파일 형식으로 변경
     */
    setToMe : function() {
        if (this.sPos == 'me') return; 
        
        this.sPos = 'me';
        
        this.element.removeClass("parent").addClass("me");
    },
    
    
    _setEventListener : function() {
        this._super();
        
        this.element.find('.fav').click($.proxy(this._onClickFavBtn, this));

    },
    
    unselectFav : function() {
        if (this.bIsFavorite == false) return;
        
        this.element.find('.fav').removeClass('selected');
        
        this.bIsFavorite = false;
    },

    _getFavButton : function() {
        return '<button type="button" title="' + this._getFavTitle() +'" class="fav' + (this.bIsFavorite ? ' selected' : '') + '">★</button>';
    },
    
    _getTemplate : function() {
        return '<li class="file">' + this._getFavButton() + '<a href="' + this.sPath + '">'+ this._getNodeName() +'</a></li>';
    },

    _getFavTitle : function() {
        var sFavoriteBtnText = this.bIsFavorite ? __('DELETE', 'EDITOR.TREE.FILE') : __('ENROLLMENT', 'EDITOR.TREE.FILE');
        return sprintf(__('SELECTION.SCREEN.FAVORITE', 'EDITOR.TREE.FILE'), sFavoriteBtnText);
    },
    
    _setClass : function() {
        this.element.addClass(SDE.Util.File.getSuffix(this.sPath));
        
        // 상속 확인 class 추가
        this.element.addClass(this.sPos);
    },

    /**
     * 파일 클릭 시 (파일을 직접 선택)
     */
    _onClick : function(e) {
        this._super(e);
        
        $(this).trigger('file-click', [this.sPath]);
    },
    
    _onClickFavBtn : function(e) {
        var el = $(e.target);

        var isSelected = el.hasClass('selected');

        var handlerName = (isSelected ? 'remove' : 'add');
        
        if(SDE.List.Favorite.Controller[handlerName](this.sPath, this._getNodeName()) == false) return;

        el[handlerName + 'Class']('selected');
        
        this.bIsFavorite = !isSelected;

        el.attr('title', this._getFavTitle());
    }
});

/**
 * Tree.Dir
 *  
 * dependencies [tree/Node.js]
 */

SDE.List.Tree.Dir = SDE.List.Tree.Node.extend({
    OPENED_CLASS : 'selected',
    
    sType : 'dir',
    bLoaded : false,
    bOpened : false,
    
    init : function(aData) {
        this.bIsRoot = aData.is_root;
                
        this._super(aData);
        
        // 최상위 Node 일 경우 예외 처리
        if (this.bIsRoot == true) {
            this.sPath = '/';
            this.bLoaded = true;
        }
    },
    
    reset : function(aData) {
        this.bOpened = this.isOpened();
        
        this.bLoaded = false;
        
        this._super(aData);
        
        if (this.isOpened() == true) {
            this._show();
        }
    },
    
    _getTemplate : function() {
        return '<li class="folder '+ (this.bIsRoot == true ? this.OPENED_CLASS : '') +'"><a href="' + this.sPath + '">'+ this._getNodeName() +'</a></li>';
    },
    
    isLoaded : function() {
        return this.bLoaded;
    },
    
    isOpened : function() {
        // FILE에서 해당 DIR을 직접 show를 하는 경우가 있어 class가 있으면 opened 상태로 처리
        return this.bOpened == true || this.element.hasClass(this.OPENED_CLASS);
    },

    setLoaded : function() {
        this.bLoaded = true;
    },
    
    _hide : function() {
        this.element.removeClass(this.OPENED_CLASS);
        
        this.element.children('ul').hide();
        
        this.bOpened = false;
    },
    
    _show : function() {
        
        this.element.addClass(this.OPENED_CLASS);
        
        this.element.children('ul').show();
        
        $(this).trigger('dir-open', [this.sPath]);
        
        this.bLoaded = true;
        
        this.bOpened = true;
    },
    
    _onClick : function(e) {
        this._super(e);
        
        (this.element.hasClass(this.OPENED_CLASS)) ? this._hide() : this._show();
        
        $(this).trigger('dir-click', [this.sPath]);
    }
});

/**
 * Tree Store
 * 
 * 디렉토리 & 파일 리스트 Json Get & Cache
 * 
 * Singleton
 */

if (typeof SDE == "undefined") SDE = {};
if (typeof SDE.List == "undefined") SDE.List = {};
if (typeof SDE.List.Tree == "undefined") SDE.List.Tree = {};
if (typeof SDE.SKIN_NO == "undefined") {
    if (typeof SDW != "undefined") {
        SDE.SKIN_NO = SDW.Env.param.skin_no;
    }
}

SDE.List.Tree.Store = function() {
    /**
     * private
     */
    var GET_DIR_URL = getMultiShopUrl('/exec/admin/editor/dir');
    
    var aCacheData = {};
    
    var _find = function(sKey) {
        return aCacheData[sKey];
    };
    
    var _set = function(aValue, sKey) {
        if (aValue.file) {
            var $aReordered = [[], []];
            var $item;
            while ($item = aValue.file.shift()) {
                $aReordered[$item.file_desc === null? 0: 1].push($item);
            }
            $aReordered[0].sort(function (a, b) {return a.file_name > b.file_name? 1: a.file_name < b.file_name? -1: 0;});
            $aReordered[1].sort(function (a, b) {return a.file_desc > b.file_desc? 1: a.file_desc < b.file_desc? -1: 0;});
            aValue.file = $aReordered[0].concat($aReordered[1]);
        }
        aCacheData[sKey] = aValue;
    };

    var _clear = function(sKey) {
        delete aCacheData[sKey];
    };
    
    var _check = function(aValue) {
        if (typeof aValue.Err != 'undefined' && aValue.Err == true) {
            alert(aValue.ErrMsg);
            
            window.close();
            
            return false;
        }
        
        return true;
    };
    
    /**
     * public
     */
    return {
        remove : function(sDir) {
            _clear(sDir || '');
        },

        get : function(sDir) {
            var aResult, sKey;
            
            sDir = sDir || '';
            
            if ((aResult = _find(sDir)) != null) return aResult;
            
            var sResponseText = $.ajax({ 
                url     : GET_DIR_URL, 
                async   : false,
                data    : { 
                            skin_no : SDE.SKIN_NO, 
                            dir : sDir
                          }
            }).responseText;
            
            aResult = $.parseJSON(sResponseText);
            
            if (_check(aResult) == false) return;
            
            _set(aResult, sDir);
            
            return aResult;
        }
    };
}();

SDE.List.History = {};

SDE.List.History.Controller = function() {
    var LIST_SELECTOR = '#historyList';
    
    var GET_URL = getMultiShopUrl('/exec/admin/editor/fileHistoryList');
    var REMOVE_URL = getMultiShopUrl('/exec/admin/editor/fileHistoryRemove');
    
    var isShowing = false;
    
    var isRemoving = false;
    
    var $list;
    
    var willRemovedIndex;
    
    var currentLists;
    
    var currentUrl;
    
    var bodyClickProxy;
    

    /**
     * 에러 메세지
     */
    var alertError = function() {
        alert(__('WAS.PROBLEM.PLEASE.TRY', 'EDITOR.HISTORY.CONTROLLER'));
    };
    
    
    /**
     * 히스토리 목록 가져온 뒤 Rendering
     */
    var cbGet = function(data) {
        if(data.complete == false) {
            alertError();
            return;
        }
        
        render(data.result);
    };
    
    /**
     * 히스토리 목록 삭제 후 리스트 Reload
     */
    var cbRemove = function(data) {
        if(data.complete == false) {
            alertError();
            return;
        }
        
        currentLists.splice(willRemovedIndex, 1);
        
        isRemoving = false;
        willRemovedIndex = null;
        
        get();
    };
    
    
    /**
     * 히스토리 목록 삭제
     */
    var remove = function(index) {
        if (isRemoving) {
            alert(__('CURRENTLY.DELETING.WAIT', 'EDITOR.HISTORY.CONTROLLER'));
            return;
        }
        
        isRemoving = true;
        
        willRemovedIndex = index;

        $.getJSON(REMOVE_URL, { seq : currentLists[index].seq_no }, $.proxy(cbRemove, this));
    };

    /**
     * 히스토리 목록 가져오기
     */
    var get = function() {
        $.getJSON(GET_URL, { file_name : currentUrl }, $.proxy(cbGet, this));
    };
    
    
    /**
     * 히스토리 창 닫기
     */
    var hide = function() {
        isShowing = false;
        
        $list.hide();
                
        $(document.body).unbind('click.proxy', bodyClickProxy);
    };
    
    
    /**
     * 히스토리 목록 rendering
     */
    var render = function(lists) {
       var html = '';
       
       for (key in lists) {
           var list = lists[key];
           var sTimeText = list.ins_timestamp ? list.ins_timestamp.replace(/\..*/, '') : __('TIME.CAN.NOT.DISPLAYED', 'EDITOR.HISTORY.CONTROLLER');
           var sDeleteText = __('DELETE', 'EDITOR.HISTORY.CONTROLLER');
           html += '<li data-index="' + key + '">' +
                       '<a href="#" data-type="replace">' + sTimeText + '</a> ' +
                       '<button type="button" title="'+ sDeleteText +'" data-type="remove">'+ sDeleteText +'</button>' +
                   '</li>';
       }
       
       if (lists.length === 0) {
           html += '<li class="empty">'+ __('NO.HISTORY.HISTORY', 'EDITOR.HISTORY.CONTROLLER') +'</li>';
       }
       
       var el = $(html);
       
       $list.find('ul').html(el);
       
       el.find('[data-type="replace"]').click($.proxy(onClickList, this));
       el.find('[data-type="remove"]').click($.proxy(onClickRemove, this));
       
       currentLists = lists;
    };
    
    
    /**
     * 변수 초기화
     */
    var reset = function() {
        currentLists = null;
        
        $list.find('ul').html('<li class="empty"><img src="/ec-img/loading_indicator.gif"/></li>');
    };
    
    
    /**
     * 히스토리 목록 클릭 후 소스 교체. 그리고 미리보기 적용
     */
    var replaceSource = function(index) {
        SDE.editor.setValue(currentLists[index].content);
        
        SDE.File.Manager.saveTemp(SDE.File.Manager.getCurrentUrl());

        hide();
    };
    
    
    /**
     * 히스토리 창 Show
     */
    var show = function() {
        if (currentUrl == null) return;
        
        isShowing = true;
        
        get();
        
        $list.show();
        
        $(document.body).bind('click.proxy', bodyClickProxy);
    };
    
    
    /**
     * 히스토리 창 토글
     */
    var toggle = function() {
        isShowing ? hide() : show();
    };
   
    
    /**
     * 히스토리 창 외에 다른 곳 클릭 시 hide 처리
     */
    var onClickBody = function(evt) {
        var $target = $(evt.target);
        
        if ($target.data('type') == 'history') return;
        
        if ($target.parents(LIST_SELECTOR).length != 0) return;
        
        if (isShowing) hide();
    };
    
    /**
     * 히스토리 리스트 클릭 시
     */
    var onClickList = function(evt) {
        evt.preventDefault();
        
        var el = $(evt.target);
        
        $list.find('.select').removeClass('select');
        
        var index = el.parent('li')
            .addClass('select')
            .data('index');
        
        replaceSource(index);
    };
    
    /**
     * 히스토리 삭제 버튼 클릭 시
     */
    var onClickRemove = function(evt) {
        evt.preventDefault();
        
        if (!confirm('삭제하시겠습니까?')) return;
        
        var index = $(evt.currentTarget).parent('li').data('index');

        remove(index);
    };
    
    var onFileOpen = function(evt, url) {
        reset();
        
        hide();
        
        currentUrl = url;
        
        // 히스토리 창이 열려 있을 때 iFrame 안에 클릭 시, 창이 닫히지 않아 예외 처리
        $('.previewArea').load(function() {
            $(this).contents().find('body').click($.proxy(onClickBody, SDE.List.History.Controller));
        });
    };
    
    var onFileClose = function(evt, url, remainCount) {
        if (remainCount != 0) return;
        
        currentUrl = null;
    };
        
    return {
        init : function() {
            $list = $(LIST_SELECTOR);
            
            bodyClickProxy = $.proxy(onClickBody, this);
            
            SDE.BroadCastManager.listen({
                'file-open' : $.proxy(onFileOpen, this),
                'file-close' : $.proxy(onFileClose, this)
            });
            
            /*
             * TODO : File Save 시에 처리
            $(FILE).bind('savecomplete', fileChangedProxy);
            */
        },
        
        toggle : function() {
            toggle();
        }
    };
}();
SDE.File.Store = function() {
    var data = {};

    var _set = function(url, _data) {
        data[url] = _data;
    };

    return {
        /**
         * 열린 파일 닫기
         */
        clear : function(url) {
            if (url) {
                delete data[url];
            } else {
                data = {};
            }
        },

        /**
         * 현재 수정 중인 파일이 있는지 확인
         */
        hasEditingFile : function() {
            for (var key in data) if (data[key].isEditing) return true;

            return false;
        },

        /**
         * 현재 열린 파일 갯수
         */
        getCount : function() {
            var length = 0;

            for (var dummy in data) length++;

            return length;
        },

        /**
         * 파일 추가
         */
        /*rev.b13.20130830.2@sinseki #SDE-5 쇼핑몰 화면 추가 영역을 2등분 하여, 앞에 디렉토리 추가버튼과 기능 구현*/
        add : function(url, isdir, role) {
            var dir = SDE.Util.File.getFileDir(url),
                name = SDE.Util.File.getFileName(url),
                dname = isdir ? __('FOLDER', 'EDITOR.FILE.STORE') : __('FILE', 'EDITOR.FILE.STORE');

            var response = $.parseJSON($.ajax({
                url : '/exec/admin/editor/fileNew?skin_no=' + SDE.SKIN_NO + '&type=' + (isdir? "dir": "file") + '&role=' + role,
                dataType : 'json',
                data : { new_dir : dir, new_name : name },
                type : 'POST',
                async : false
            }).responseText);

            if (response.bComplete == false) {
                alert(response.ErrMsg || sprintf(__('EXIST.ENTER.ANOTHER.NAME', 'EDITOR.FILE.STORE'), dname, dname));
                return false;
            }

            return true;
        },

        /**
         * 현재 파일 데이터를 가지고 있는지 여부
         */
        check : function(url) {
            return data[url] ? true : false;
        },

        /**
         * 파일 데이터 가져오기
         */
        get : function(url) {
            if (data[url]) return data[url];

            var response = $.parseJSON($.ajax({
                url: '/exec/admin/editor/fileOpen?skin_no='+ SDE.SKIN_NO +'&file='+ url,
                dataType: 'json',
                type : 'POST',
                async : false
            }).responseText);

            if (response.bComplete == false) {
                alert(response.ErrMsg || __('COULD.NOT.OPEN.FILE', 'EDITOR.FILE.STORE'));
                return false;
            };

            // ECHOSTING-85881 특정 문자가 깨지는 현상과 관련하여 ajax로 데이터를 받을때 request 페이지에서 PHP 함수인 rawurlencode를 디코딩
            //                 하기 위하여 아래의 함수로 처리 - 2014.06.13
            try {
                response.content = decodeURIComponent(response.content);
            } catch (err) {

            }

            _set(url, response);

            return response;
        },

        /**
         * 파일 Copy
         */
        copy : function(oldUrl, url, role) {
            var _data = data[oldUrl];

            _data.new_dir = SDE.Util.File.getFileDir(url),
            _data.new_name = SDE.Util.File.getFileName(url);

            var response = $.parseJSON($.ajax({
                url : getMultiShopUrl('/exec/admin/editor/fileSaveas?skin_no=') + SDE.SKIN_NO + '&role=' + role,
                dataType : 'json',
                data : _data,
                type : 'POST',
                async : false
            }).responseText);

            if (response.bComplete == false) {
                alert(response.ErrMsg || __('ENTER.DIFFERENT.FILE.NAME', 'EDITOR.FILE.STORE'));
                return false;
            }

            data[response.new_dir] = data[response.old_dir];
            data[response.new_dir].file = response.new_dir;
            data[response.new_dir].where = 'me';
            data[response.new_dir].desc = null;

            SDE.File.Store.clear(response.old_dir);

            return true;
        },

        /**
         * 파일 저장
         */
        set : function(url, _data, toServer) {
             toServer = toServer || false;

             if (_data && _data.isEditing == true) return true;

             _data = _data || data[url];

             if (_data == null) return false;

             // 읽기전용 파일 체크
             if (_data.readonly === true) return false;

             if (toServer) {
                 var response = $.parseJSON($.ajax({
                     url : getMultiShopUrl('/exec/admin/editor/fileSave?skin_no=') + SDE.SKIN_NO,
                     data : _data,
                     dataType : 'json',
                     type : 'POST',
                     async : false
                 }).responseText);

                 if (response.bComplete == false) {
                     alert(response.ErrMsg || __('CONTACT.CUSTOMER.SERVICE', 'EDITOR.FILE.STORE'));
                     return false;
                 }
                 _data.original = _data.content;
                 _data.isEditing = false;
             }

             _set(url, _data);

             return true;
        },

        remove : function(url) {
            if (!url) return;

            var response = $.parseJSON($.ajax({
                url : getMultiShopUrl('/exec/admin/editor/fileRemove?skin_no=') + SDE.SKIN_NO,
                data : {
                    file : url
                },
                dataType : 'json',
                type : 'POST',
                async : false
            }).responseText);

            if (response.bComplete == false) {
                alert(response.ErrMsg || __('CONTACT.CUSTOMER.SERVICE.001', 'EDITOR.FILE.STORE'));
                return false;
            }

            SDE.File.Store.clear(response.old_dir);

            return true;
        },

        setAll : function() {
            for (var url in data) {
                // 읽기전용 파일은 continue
                if (data[url].readonly === true) {
                    continue;
                }
                if (!SDE.File.Store.set(url, null, true)) return false;
            }

            return true;
        },

        /**
         * 파일 임시 저장 (미리보기 or 새로고침 용)
         */
        setTemp : function(url, _data) {
            _data = _data || data[url];

            if (_data == null) return;

            var response = $.parseJSON($.ajax({
                url : getMultiShopUrl('/exec/admin/editor/fileSavetemp?skin_no=') + SDE.SKIN_NO,
                data : _data,
                dataType : 'json',
                type : 'POST',
                async : false
            }).responseText);

            if (response.bComplete == false) {
                alert(response.ErrMsg || __('CONTACT.CUSTOMER.SERVICE', 'EDITOR.FILE.STORE'));
                return false;
            }

            _data.previewUrl = response.url;

            _set(url, _data);

            return true;
        },

        /**
         * 역할정보에 기본으로 설정 된 경로인지 체크하기
         * @param string url 경로
         * @returns object 기본여부/역할타이틀
         */
        getIsDefaultPath : function(url) {
            if (!url) return;

            $oData = {};
            $.ajax({
                url : getMultiShopUrl('/exec/admin/manage/routepathrole?mode=get_isdefpath&path=' + url + '&skin_no=' + SDE.SKIN_NO),
                dataType: 'json',
                async: false,
                success: function(data) {
                    $oData = data;
                }
            });

            return $oData;
        }
    };
}();
/**
 * dependancy : SDE.File.Store
 */
SDE.File.Manager = function() {
    var store = SDE.File.Store,
        currentUrl;

    /**
     * 파일이 수정되었는지 체크
     */
    var isEditing = function(original, content) {
        var ao = original.split('\n');
        var ac = content.split('\n');

        if (ao.length !== ac.length) {
            return true;
        }

        for (var i=0; i<ao.length; i++) {
            if ($.trim(ao[i]) != $.trim(ac[i])) return true;
        }

        return false;
    };


    var onWindowClose = function(evt) {
        if (store.hasEditingFile()) {
            return __('UNSAVED.FILES.THE.EDITOR', 'EDITOR.FILE.MANAGER');
        }
    };

    var onContentChange = function(evt, url, content) {
        var is, data;

        if (!(data = store.get(url))) return;

        //if (!(is = isEditing(data.original, content))) return;

        data.content = content;
        data.isEditing = true;

        store.set(url, data);
    };


    return {
        /*rev.b11.20130816.3@sinseki #SDE-5 쇼핑몰 화면 추가 영역을 2등분 하여, 앞에 디렉토리 추가버튼과 기능 구현*/
        add : function(url,isdir,role) {
            if (!store.add(url,isdir,role)) return false;

            if (!isdir) {
                SDE.BroadCastManager.send('file-add', url);

                SDE.File.Manager.open(url);
            } else {
                SDE.BroadCastManager.send('dir-add', url);
            }

            return true;
        },

        close : function(url) {
            var data;

            if (!(data = store.get(url))) return;

            if (data.isEditing && !confirm(__('YOU.HAVE.UNSAVED.DO', 'EDITOR.FILE.MANAGER'))) {
                return;
            }

            store.clear(url);

            SDE.BroadCastManager.send('file-close', url, store.getCount());
        },

        closeAll : function() {
            if (SDE.File.Manager.getOpenedCount() == 0) return;

            var sCloseAllConfirmText = store.hasEditingFile() ? (__('THERE.ARE.UNSAVED.FILES', 'EDITOR.FILE.MANAGER') + ' ') : '';
            sCloseAllConfirmText += __('ARE.SURE.ALL.FILES', 'EDITOR.FILE.MANAGER');

            if (!confirm(sCloseAllConfirmText)) {
                return;
            }

            store.clear();

            SDE.BroadCastManager.send('file-close-all');
        },

        getOpenedCount : function() {
            return store.getCount();
        },

        getCurrentUrl : function() {
            return currentUrl;
        },

        /**
         * 최신소스 존재하는지 여부
         */
        hasRecent : function(url) {
            var response = $.parseJSON($.ajax({
                type: 'POST',
                url: getMultiShopUrl('/exec/admin/editor/fileShowcode?path=')+ url,
                dataType: 'json',
                async : false
            }).responseText);

            return response.bComplete;
        },

        isOpened : function(url) {
            return store.check(url);
        },

        init : function() {
            SDE.BroadCastManager.listen({
                'beforeunload' : $.proxy(onWindowClose, this),
                'file-content-change' : $.proxy(onContentChange, this)
            });
        },

        open : function(url, params) {
            var data;

            if (!url) return;

            if (typeof(url) == 'object') {
                for (var key in url) {
                    arguments.callee(url[key]);
                }

                return;
            }

            if (!(data = store.get(url))) return;

            /*rev.b6.20130829.6@sinseki #SDE-8 레이아웃 아닌 모듈/CSS/JS 파일 오픈시 프리뷰를 소스가 아닌 레이아웃을 띄우기*/
            if (!data.originurl && !/html$/.test(url) && /html$/.test(currentUrl)) {
                data.originurl = currentUrl;
            }

            SDE.BroadCastManager.send('file-open', url, data, params);

            currentUrl = url;
        },

        remove : function(url) {
            var name, data;
            var oData = {};

            if (store.check(url) === false) return;

            data = store.get(url);

            if (data.desc) {
                alert(__('DELETE.BUILTIN.SCREENS', 'EDITOR.FILE.MANAGER'));
                return;
            }

            oData = store.getIsDefaultPath(url);
            if (oData.is_default == 'T') {
                alert(sprintf(__('YOU.CAN.NOT.DELETE.PATH', 'EDITOR.FILE.MANAGER'), oData.title));
                return;
            }

            if (!confirm(sprintf(__('ARE.SURE', 'EDITOR.FILE.MANAGER'), url))) {
                return;
            }

            if(!store.remove(url)) return;

            SDE.BroadCastManager.send('file-remove', url, store.getCount());
        },

        save : function(url) {
            if (store.check(url) === false) return;

            if (!store.set(url, null, true)) return;

            SDE.BroadCastManager.send('file-save', url);
        },

        saveAll : function() {
            if (!store.hasEditingFile()) return;

            if (!confirm(__('YOU.WANT.ALL.FILES', 'EDITOR.FILE.MANAGER'))) {
                return;
            }

            if(!store.setAll()) return;

            SDE.BroadCastManager.send('file-save-all', currentUrl);
        },

        saveAs : function(oldUrl, url, role) {
            if (!store.copy(oldUrl, url, role)) return false;

            SDE.File.Manager.open(url);

            SDE.BroadCastManager.send('file-add', url);

            return true;
        },

        saveTemp : function(url, params) {
            if (!store.setTemp(url)) return;

            data = store.get(url);

            SDE.BroadCastManager.send('file-save-temp', url, data, params);
        }
    };
}();
