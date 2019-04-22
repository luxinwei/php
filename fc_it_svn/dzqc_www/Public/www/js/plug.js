
jQuery.extend({
	

    createUploadIframe: function(id, uri)
	{
			//create frame
            var frameId = 'jUploadFrame' + id;
            var iframeHtml = '<iframe id="' + frameId + '" name="' + frameId + '" style="position:absolute; top:-9999px; left:-9999px"';
			if(window.ActiveXObject)
			{
                if(typeof uri== 'boolean'){
					iframeHtml += ' src="' + 'javascript:false' + '"';

                }
                else if(typeof uri== 'string'){
					iframeHtml += ' src="' + uri + '"';

                }	
			}
			iframeHtml += ' />';
			jQuery(iframeHtml).appendTo(document.body);

            return jQuery('#' + frameId).get(0);			
    },
    createUploadForm: function(id, fileElementId, data)
	{
		//create form	
		var formId = 'jUploadForm' + id;
		var fileId = 'jUploadFile' + id;
		var form = jQuery('<form  action="" method="POST" name="' + formId + '" id="' + formId + '" enctype="multipart/form-data"></form>');	
		if(data)
		{
			for(var i in data)
			{
				jQuery('<input type="hidden" name="' + i + '" value="' + data[i] + '" />').appendTo(form);
			}			
		}		
		var oldElement = jQuery('#' + fileElementId);
		var newElement = jQuery(oldElement).clone();
		jQuery(oldElement).attr('id', fileId);
		jQuery(oldElement).before(newElement);
		jQuery(oldElement).appendTo(form);


		
		//set attributes
		jQuery(form).css('position', 'absolute');
		jQuery(form).css('top', '-1200px');
		jQuery(form).css('left', '-1200px');
		jQuery(form).appendTo('body');		
		return form;
    },

    ajaxFileUpload: function(s) {
        // TODO introduce global settings, allowing the client to modify them for all requests, not only timeout		
        s = jQuery.extend({}, jQuery.ajaxSettings, s);
        var id = new Date().getTime()        
		var form = jQuery.createUploadForm(id, s.fileElementId, (typeof(s.data)=='undefined'?false:s.data));
		var io = jQuery.createUploadIframe(id, s.secureuri);
		var frameId = 'jUploadFrame' + id;
		var formId = 'jUploadForm' + id;		
        // Watch for a new set of requests
        if ( s.global && ! jQuery.active++ )
		{
			jQuery.event.trigger( "ajaxStart" );
		}            
        var requestDone = false;
        // Create the request object
        var xml = {}   
        if ( s.global )
            jQuery.event.trigger("ajaxSend", [xml, s]);
        // Wait for a response to come back
        var uploadCallback = function(isTimeout)
		{			
			var io = document.getElementById(frameId);
            try 
			{				
				if(io.contentWindow)
				{
					 xml.responseText = io.contentWindow.document.body?io.contentWindow.document.body.innerHTML:null;
                	 xml.responseXML = io.contentWindow.document.XMLDocument?io.contentWindow.document.XMLDocument:io.contentWindow.document;
					 
				}else if(io.contentDocument)
				{
					 xml.responseText = io.contentDocument.document.body?io.contentDocument.document.body.innerHTML:null;
                	xml.responseXML = io.contentDocument.document.XMLDocument?io.contentDocument.document.XMLDocument:io.contentDocument.document;
				}						
            }catch(e)
			{
			}
            if ( xml || isTimeout == "timeout") 
			{				
                requestDone = true;
                var status;
                try {
                    status = isTimeout != "timeout" ? "success" : "error";
                    // Make sure that the request was successful or notmodified
                    if ( status != "error" )
					{
                        // process the data (runs the xml through httpData regardless of callback)
                        var data = jQuery.uploadHttpData( xml, s.dataType );    
                        // If a local callback was specified, fire it and pass it the data
                        if ( s.success )
                            s.success( data, status );
    
                        // Fire the global callback
                        if( s.global )
                            jQuery.event.trigger( "ajaxSuccess", [xml, s] );
                    } else{}
                } catch(e) 
				{
                    status = "error";
                }

                // The request was completed
                if( s.global )
                    jQuery.event.trigger( "ajaxComplete", [xml, s] );

                // Handle the global AJAX counter
                if ( s.global && ! --jQuery.active )
                    jQuery.event.trigger( "ajaxStop" );

                // Process result
                if ( s.complete )
                    s.complete(xml, status);

                jQuery(io).unbind()

                setTimeout(function()
									{	try 
										{
											jQuery(io).remove();
											jQuery(form).remove();	
											
										} catch(e) 
										{
										}									

									}, 100)

                xml = null

            }
        }
        // Timeout checker
        if ( s.timeout > 0 ) 
		{
            setTimeout(function(){
                // Check to see if the request is still happening
                if( !requestDone ) uploadCallback( "timeout" );
            }, s.timeout);
        }
        try 
		{

			var form = jQuery('#' + formId);
			jQuery(form).attr('action', s.url);
			jQuery(form).attr('method', 'POST');
			jQuery(form).attr('target', frameId);
            if(form.encoding)
			{
				jQuery(form).attr('encoding', 'multipart/form-data');      			
            }
            else
			{	
				jQuery(form).attr('enctype', 'multipart/form-data');			
            }			
            jQuery(form).submit();

        } catch(e) 
		{			
        	
        }
		
		jQuery('#' + frameId).load(uploadCallback	);
        return {abort: function () {}};	

    },

    uploadHttpData: function( r, type ) {
        var data = !type;
        data = type == "xml" || data ? r.responseXML : r.responseText;
        // If the type is "script", eval it in global context
        if ( type == "script" )
            jQuery.globalEval( data );
        // Get the JavaScript object, if JSON is used.
        if ( type == "json" )
            eval( "data = " + data );
        // evaluate scripts within html
        if ( type == "html" )
            jQuery("<div>").html(data).evalScripts();

        return data;
    }
})




/*
 * jQuery Tools 1.2.3 - The missing UI library for the Web
 * Download by http://sc.xueit.com
 * [jquery, toolbox.flashembed, toolbox.history, toolbox.expose, toolbox.mousewheel, tabs, tabs.slideshow, tooltip, tooltip.slide, tooltip.dynamic, scrollable, scrollable.autoscroll, scrollable.navigator, overlay, overlay.apple, dateinput, rangeinput, validator]
 * 
 * NO COPYRIGHTS OR LICENSES. DO WHAT YOU LIKE.
 * 
 * http://flowplayer.org/tools/
 * 
 * jQuery JavaScript Library v1.4.2
 * http://jquery.com/
 *
 * Copyright 2010, John Resig
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://docs.jquery.com/License
 *
 * Includes Sizzle.js
 * http://sizzlejs.com/
 * Copyright 2010, The Dojo Foundation
 * Released under the MIT, BSD, and GPL Licenses.
 * 
 * -----
 * 
 */

/* Smooth scrolling
   Changes links that link to other parts of this page to scroll
   smoothly to those links rather than jump to them directly, which
   can be a little disorienting.
   
   sil, http://www.kryogenix.org/
   
   v1.0 2003-11-11
   v1.1 2005-06-16 wrap it up in an object
*/

var ss = {
  fixAllLinks: function() {
    // Get a list of all links in the page
    var allLinks = document.getElementsByTagName('a');
    // Walk through the list
    for (var i=0;i<allLinks.length;i++) {
      var lnk = allLinks[i];
      if ((lnk.href && lnk.href.indexOf('#') != -1) && 
          ( (lnk.pathname == location.pathname) ||
	    ('/'+lnk.pathname == location.pathname) ) && 
          (lnk.search == location.search)) {
        // If the link is internal to the page (begins in #)
        // then attach the smoothScroll function as an onclick
        // event handler
        ss.addEvent(lnk,'click',ss.smoothScroll);
      }
    }
  },

  smoothScroll: function(e) {
    // This is an event handler; get the clicked on element,
    // in a cross-browser fashion
    if (window.event) {
      target = window.event.srcElement;
    } else if (e) {
      target = e.target;
    } else return;

    // Make sure that the target is an element, not a text node
    // within an element
    if (target.nodeName.toLowerCase() != 'a') {
      target = target.parentNode;
    }
  
    // Paranoia; check this is an A tag
    if (target.nodeName.toLowerCase() != 'a') return;
  
    // Find the <a name> tag corresponding to this href
    // First strip off the hash (first character)
    anchor = target.hash.substr(1);
    // Now loop all A tags until we find one with that name
    var allLinks = document.getElementsByTagName('a');
    var destinationLink = null;
    for (var i=0;i<allLinks.length;i++) {
      var lnk = allLinks[i];
      if (lnk.name && (lnk.name == anchor)) {
        destinationLink = lnk;
        break;
      }
    }
    if (!destinationLink) destinationLink = document.getElementById(anchor);

    // If we didn't find a destination, give up and let the browser do
    // its thing
    if (!destinationLink) return true;
  
    // Find the destination's position
    var destx = destinationLink.offsetLeft; 
    var desty = destinationLink.offsetTop;
    var thisNode = destinationLink;
    while (thisNode.offsetParent && 
          (thisNode.offsetParent != document.body)) {
      thisNode = thisNode.offsetParent;
      destx += thisNode.offsetLeft;
      desty += thisNode.offsetTop;
    }
  
    // Stop any current scrolling
    clearInterval(ss.INTERVAL);
  
    cypos = ss.getCurrentYPos();
  
    ss_stepsize = parseInt((desty-cypos)/ss.STEPS);
    ss.INTERVAL =
setInterval('ss.scrollWindow('+ss_stepsize+','+desty+',"'+anchor+'")',15);
  
    // And stop the actual click happening
    if (window.event) {
      window.event.cancelBubble = true;
      window.event.returnValue = false;
    }
    if (e && e.preventDefault && e.stopPropagation) {
      e.preventDefault();
      e.stopPropagation();
    }
  },

  scrollWindow: function(scramount,dest,anchor) {
    wascypos = ss.getCurrentYPos();
    isAbove = (wascypos < dest);
    window.scrollTo(0,wascypos + scramount);
    iscypos = ss.getCurrentYPos();
    isAboveNow = (iscypos < dest);
    if ((isAbove != isAboveNow) || (wascypos == iscypos)) {
      // if we've just scrolled past the destination, or
      // we haven't moved from the last scroll (i.e., we're at the
      // bottom of the page) then scroll exactly to the link
      window.scrollTo(0,dest);
      // cancel the repeating timer
      clearInterval(ss.INTERVAL);
      // and jump to the link directly so the URL's right
      location.hash = anchor;
    }
  },

  getCurrentYPos: function() {
    if (document.body && document.body.scrollTop)
      return document.body.scrollTop;
    if (document.documentElement && document.documentElement.scrollTop)
      return document.documentElement.scrollTop;
    if (window.pageYOffset)
      return window.pageYOffset;
    return 0;
  },

  addEvent: function(elm, evType, fn, useCapture) {
    // addEvent and removeEvent
    // cross-browser event handling for IE5+,  NS6 and Mozilla
    // By Scott Andrew
    if (elm.addEventListener){
      elm.addEventListener(evType, fn, useCapture);
      return true;
    } else if (elm.attachEvent){
      var r = elm.attachEvent("on"+evType, fn);
      return r;
    } else {
      alert("Handler could not be removed");
    }
  } 
}

ss.STEPS = 10;   // speed (lower the faster)

ss.addEvent(window,"load",ss.fixAllLinks);
/*!
 * AJAX Upload ( http://valums.com/ajax-upload/ )
 * Copyright (c) Andris Valums
 * Licensed under the MIT license ( http://valums.com/mit-license/ )
 * Thanks to Gary Haran, David Mark, Corey Burns and others for contributions
 */
(function(){
    function log() {
        if (typeof(console) != "undefined" && typeof(console.log) == "function") {
            Array.prototype.unshift.call(arguments, "[Ajax Upload]");
            console.log(Array.prototype.join.call(arguments, " "))
        }
    }
    function addEvent(el, type, fn) {
        if (el.addEventListener) {
            el.addEventListener(type, fn, false)
        } else {
            if (el.attachEvent) {
                el.attachEvent("on" + type,
                function() {
                    fn.call(el)
                })
            } else {
                throw new Error("not supported or DOM not loaded")
            }
        }
    }
    function addResizeEvent(fn) {
        var timeout;
        addEvent(window, "resize",
        function() {
            if (timeout) {
                clearTimeout(timeout)
            }
            timeout = setTimeout(fn, 100)
        })
    }
    if (document.documentElement.getBoundingClientRect) {
        var getOffset = function(el) {
            var box = el.getBoundingClientRect();
            var doc = el.ownerDocument;
            var body = doc.body;
            var docElem = doc.documentElement;
            var clientTop = docElem.clientTop || body.clientTop || 0;
            var clientLeft = docElem.clientLeft || body.clientLeft || 0;
            var zoom = 1;
            if (body.getBoundingClientRect) {
                var bound = body.getBoundingClientRect();
                zoom = (bound.right - bound.left) / body.clientWidth
            }
            if (zoom > 1) {
                clientTop = 0;
                clientLeft = 0
            }
            var top = box.top / zoom + (window.pageYOffset || docElem && docElem.scrollTop / zoom || body.scrollTop / zoom) - clientTop,
            left = box.left / zoom + (window.pageXOffset || docElem && docElem.scrollLeft / zoom || body.scrollLeft / zoom) - clientLeft;
            return {
                top: top,
                left: left
            }
        }
    } else {
        var getOffset = function(el) {
            var top = 0,
            left = 0;
            do {
                top += el.offsetTop || 0;
                left += el.offsetLeft || 0;
                el = el.offsetParent
            } while ( el );
            return {
                left: left,
                top: top
            }
        }
    }
    function getBox(el) {
        var left, right, top, bottom;
        var offset = getOffset(el);
        left = offset.left;
        top = offset.top;
        right = left + el.offsetWidth;
        bottom = top + el.offsetHeight;
        return {
            left: left,
            right: right,
            top: top,
            bottom: bottom
        }
    }
    function addStyles(el, styles) {
        for (var name in styles) {
            if (styles.hasOwnProperty(name)) {
                el.style[name] = styles[name]
            }
        }
    }
    function copyLayout(from, to) {
        var box = getBox(from);
        addStyles(to, {
            position: "absolute",
            left: box.left + "px",
            top: box.top + "px",
            width: from.offsetWidth + "px",
            height: from.offsetHeight + "px"
        })
    }
    var toElement = (function() {
        var div = document.createElement("div");
        return function(html) {
            div.innerHTML = html;
            var el = div.firstChild;
            return div.removeChild(el)
        }
    })();
    var getUID = (function() {
        var id = 0;
        return function() {
            return "ValumsAjaxUpload" + id++
        }
    })();
    function fileFromPath(file) {
        return file.replace(/.*(\/|\\)/, "")
    }
    function getExt(file) {
        return ( - 1 !== file.indexOf(".")) ? file.replace(/.*[.]/, "") : ""
    }
    function hasClass(el, name) {
        var re = new RegExp("\\b" + name + "\\b");
        return re.test(el.className)
    }
    function addClass(el, name) {
        if (!hasClass(el, name)) {
            el.className += " " + name
        }
    }
    function removeClass(el, name) {
        var re = new RegExp("\\b" + name + "\\b");
        el.className = el.className.replace(re, "")
    }
    function removeNode(el) {
        el.parentNode.removeChild(el)
    }
    window.AjaxUpload = function(button, options) {
        this._settings = {
            action: "upload.php",
            name: "userfile",
            data: {},
			multiple: false,
            autoSubmit: true,
            responseType: false,
            hoverClass: "hover",
            disabledClass: "disabled",
            onChange: function(file, extension) {},
            onSubmit: function(file, extension) {},
            onComplete: function(file, response) {}
        };
        for (var i in options) {
            if (options.hasOwnProperty(i)) {
                this._settings[i] = options[i]
            }
        }
        if (button.jquery) {
            button = button[0]
        } else {
            if (typeof button == "string") {
                if (/^#.*/.test(button)) {
                    button = button.slice(1)
                }
                button = document.getElementById(button)
            }
        }
        if (!button || button.nodeType !== 1) {
            throw new Error("Please make sure that you're passing a valid element")
        }
        if (button.nodeName.toUpperCase() == "A") {
            addEvent(button, "click",
            function(e) {
                if (e && e.preventDefault) {
                    e.preventDefault()
                } else {
                    if (window.event) {
                        window.event.returnValue = false
                    }
                }
            })
        }
        this._button = button;
        this._input = null;
        this._disabled = false;
        this.enable();
        this._rerouteClicks()
    };
    AjaxUpload.prototype = {
        setData: function(data) {
            this._settings.data = data
        },
        disable: function() {
            addClass(this._button, this._settings.disabledClass);
            this._disabled = true;
            var nodeName = this._button.nodeName.toUpperCase();
            if (nodeName == "INPUT" || nodeName == "BUTTON") {
                this._button.setAttribute("disabled", "disabled")
            }
            if (this._input) {
                this._input.parentNode.style.visibility = "hidden"
            }
        },
        enable: function() {
            removeClass(this._button, this._settings.disabledClass);
            this._button.removeAttribute("disabled");
            this._disabled = false
        },
        _createInput: function() {
            var self = this;
            var input = document.createElement("input");
            input.setAttribute("type", "file");
            input.setAttribute("name", this._settings.name);
			if(this._settings.multiple) input.setAttribute('multiple', 'multiple');
            addStyles(input, {
                position: "absolute",
                right: 0,
                margin: 0,
                padding: 0,
                fontSize: "480px",
                cursor: "pointer"
            });
            var div = document.createElement("div");
            addStyles(div, {
                display: "block",
                position: "absolute",
                overflow: "hidden",
                margin: 0,
                padding: 0,
                opacity: 0,
                direction: "ltr",
                zIndex: 2147483583
            });
            if (div.style.opacity !== "0") {
                if (typeof(div.filters) == "undefined") {
                    throw new Error("Opacity not supported by the browser")
                }
                div.style.filter = "alpha(opacity=0)"
            }
            addEvent(input, "change",
            function() {
                if (!input || input.value === "") {
                    return
                }
                var file = fileFromPath(input.value);
                if (false === self._settings.onChange.call(self, file, getExt(file))) {
                    self._clearInput();
                    return
                }
                if (self._settings.autoSubmit) {
                    self.submit()
                }
            });
            addEvent(input, "mouseover",
            function() {
                addClass(self._button, self._settings.hoverClass)
            });
            addEvent(input, "mouseout",
            function() {
                removeClass(self._button, self._settings.hoverClass);
                input.parentNode.style.visibility = "hidden"
            });
            div.appendChild(input);
            document.body.appendChild(div);
            this._input = input
        },
        _clearInput: function() {
            if (!this._input) {
                return
            }
            removeNode(this._input.parentNode);
            this._input = null;
            this._createInput();
            removeClass(this._button, this._settings.hoverClass)
        },
        _rerouteClicks: function() {
            var self = this;
            addEvent(self._button, "mouseover",
            function() {
                if (self._disabled) {
                    return
                }
                if (!self._input) {
                    self._createInput()
                }
                var div = self._input.parentNode;
                copyLayout(self._button, div);
                div.style.visibility = "visible"
            })
        },
        _createIframe: function() {
            var id = getUID();
            var iframe = toElement('<iframe src="javascript:false;" name="' + id + '" />');
            iframe.setAttribute("id", id);
            iframe.style.display = "none";
            document.body.appendChild(iframe);
            return iframe
        },
        _createForm: function(iframe) {
            var settings = this._settings;
            var form = toElement('<form method="post" enctype="multipart/form-data"></form>');
            form.setAttribute("action", settings.action);
            form.setAttribute("target", iframe.name);
            form.style.display = "none";
            document.body.appendChild(form);
            for (var prop in settings.data) {
                if (settings.data.hasOwnProperty(prop)) {
                    var el = document.createElement("input");
                    el.setAttribute("type", "hidden");
                    el.setAttribute("name", prop);
                    el.setAttribute("value", settings.data[prop]);
                    form.appendChild(el)
                }
            }
            return form
        },
        _getResponse: function(iframe, file) {
            var toDeleteFlag = false,
            self = this,
            settings = this._settings;
            addEvent(iframe, "load",
            function() {
                if (iframe.src == "javascript:'%3Chtml%3E%3C/html%3E';" || iframe.src == "javascript:'<html></html>';") {
                    if (toDeleteFlag) {
                        setTimeout(function() {
                            removeNode(iframe)
                        },
                        0)
                    }
                    return
                }
                var doc = iframe.contentDocument ? iframe.contentDocument: window.frames[iframe.id].document;
                if (doc.readyState && doc.readyState != "complete") {
                    return
                }
                if (doc.body && doc.body.innerHTML == "false") {
                    return
                }
                var response;
                if (doc.XMLDocument) {
                    response = doc.XMLDocument
                } else {
                    if (doc.body) {
                        response = doc.body.innerHTML;
                        if (settings.responseType && settings.responseType.toLowerCase() == "json") {
                            if (doc.body.firstChild && doc.body.firstChild.nodeName.toUpperCase() == "PRE") {
                                response = doc.body.firstChild.firstChild.nodeValue
                            }
                            if (response) {
                                response = eval("(" + response + ")")
                            } else {
                                response = {}
                            }
                        }
                    } else {
                        response = doc
                    }
                }
                settings.onComplete.call(self, file, response);
                toDeleteFlag = true;
                iframe.src = "javascript:'<html></html>';"
            })
        },
        submit: function() {
            var self = this,
            settings = this._settings;
            if (!this._input || this._input.value === "") {
                return
            }
            var file = fileFromPath(this._input.value);
            if (false === settings.onSubmit.call(this, file, getExt(file))) {
                this._clearInput();
                return
            }
            var iframe = this._createIframe();
            var form = this._createForm(iframe);
            removeNode(this._input.parentNode);
            removeClass(self._button, self._settings.hoverClass);
            form.appendChild(this._input);
            form.submit();
            removeNode(form);
            form = null;
            removeNode(this._input);
            this._input = null;
            this._getResponse(iframe, file);
            this._createInput()
        }
    }
})();


(function($){    
    var status = false;    
    $.fn.scrollQ = function(options){    
        var defaults = {    
            line:4,    
            scrollNum:2,    
            scrollTime:1000  
        }  
        var options=jQuery.extend(defaults,options);  
        var _self = this;  
        return this.each(function(){    
            $("li",this).each(function(){  
                $(this).css("display","none");  
            })  
            $("li:lt("+options.line+")",this).each(function(){  
                $(this).css("display","block");  
            })  
            function scroll() {  
                for(i=0;i<options.scrollNum;i++) {  
                    var start=$("li:first",_self);  
                    start.fadeOut(100);  
                    start.css("display","none");  
                    start.appendTo(_self);  
                    $("li:eq("+(options.line-1)+")",_self).each(function(){  
                        $(this).fadeIn(500);  
                        $(this).css("display","block");  
                    })  
                }  
            }  
            var timer;  
            timer = setInterval(scroll,options.scrollTime);  
            _self.bind("mouseover",function(){  
                clearInterval(timer);  
            });  
            _self.bind("mouseout",function(){  
                timer = setInterval(scroll,options.scrollTime);  
            });  
              
        });  
    }  
})(jQuery);   

(function($) {
    $.fn.Zoomer = function(b) {
        var c = $.extend({
            speedView: 200,
            speedRemove: 400,
            altAnim: false,
            speedTitle: 400,
            debug: false
        },
        b);
        var d = $.extend(c, b);
        function e(s) {
            if (typeof console != "undefined" && typeof console.debug != "undefined") {
                console.log(s)
            } else {
                alert(s)
            }
        }
        if (d.speedView == undefined || d.speedRemove == undefined || d.altAnim == undefined || d.speedTitle == undefined) {
            e('speedView: ' + d.speedView);
            e('speedRemove: ' + d.speedRemove);
            e('altAnim: ' + d.altAnim);
            e('speedTitle: ' + d.speedTitle);
            return false
        }
        if (d.debug == undefined) {
            e('speedView: ' + d.speedView);
            e('speedRemove: ' + d.speedRemove);
            e('altAnim: ' + d.altAnim);
            e('speedTitle: ' + d.speedTitle);
            return false
        }
        if (typeof d.speedView != "undefined" || typeof d.speedRemove != "undefined" || typeof d.altAnim != "undefined" || typeof d.speedTitle != "undefined") {
            if (d.debug == true) {
                e('speedView: ' + d.speedView);
                e('speedRemove: ' + d.speedRemove);
                e('altAnim: ' + d.altAnim);
                e('speedTitle: ' + d.speedTitle)
            }
            $(this).hover(function() {
            	 $(this).find('img').eq(0).attr('src',$(this).find('img').attr('bigsrc'));
            	$(this).css({
                    'z-index': '999'
                });
            	$(this).find('img').eq(0).css({
            		 'z-index': '999'
            	});
                $(this).find('img').eq(0).addClass("hover").stop().animate({
                    marginTop: '-110px',
                    marginLeft: '-110px',
                    top: '50%',
                    left: '50%',
                    width: '300px',
                    height: '300px',
                    padding: '20px'
                },
                d.speedView);
                if (d.altAnim == true) {
                    var a = $(this).find("img").eq(0).attr("alt");
                    if (a.length != 0) {
                        $(this).prepend('<span class="title">' + a + '</span>');
                        $('.title').animate({
                            marginLeft: '-42px',
                            marginTop: '90px'
                        },
                        d.speedTitle).css({
                            'z-index': '10',
                            'position': 'absolute',
                            'float': 'left'
                        })
                    }
                }
            },
            function() {
            	$(this).find('img').eq(0).attr('src',$(this).find('img').attr('smallsrc'));
                $(this).css({
                    'z-index': '0'
                });
                $(this).find('img').eq(0).removeClass("hover").stop().animate({
                    marginTop: '0',
                    marginLeft: '0',
                    top: '0',
                    left: '0',
                    width: '240px',
                    height: '240px',
                    padding: '5px'
                },
                d.speedRemove);
                $(this).find('.title').remove()
            })
        }
    }
})(jQuery);