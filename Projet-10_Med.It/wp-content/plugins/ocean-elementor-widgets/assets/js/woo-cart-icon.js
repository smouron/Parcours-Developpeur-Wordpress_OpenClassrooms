(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({1:[function(require,module,exports){
    "use strict";
    
    Object.defineProperty(exports, "__esModule", {
      value: true
    });
    exports.registerWidget = exports.isElement = exports.getSiblings = exports.visible = exports.offset = exports.fadeToggle = exports.fadeOut = exports.fadeIn = exports.slideToggle = exports.slideUp = exports.slideDown = void 0;
    
    function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }


    
    var visible = function visible(element) {
        if (!element) {
          return false;
        }
      
        return !!(element.offsetWidth || element.offsetHeight || element.getClientRects().length);
      };
      
      exports.visible = visible;

var fadeIn = function fadeIn(element) {
    var _options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
  
    var options = {
      duration: 300,
      display: null,
      opacity: 1,
      callback: null
    };
    Object.assign(options, _options);
    element.style.opacity = 0;
    element.style.display = options.display || "block";
    setTimeout(function () {
      element.style.transition = "".concat(options.duration, "ms opacity ease");
      element.style.opacity = options.opacity;
    }, 5);
    setTimeout(function () {
      element.style.removeProperty("transition");
      !!options.callback && options.callback();
    }, options.duration + 50);
  };
  
  exports.fadeIn = fadeIn;
  
  var fadeOut = function fadeOut(element) {
    var _options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
  
    var options = {
      duration: 300,
      display: null,
      opacity: 0,
      callback: null
    };
    Object.assign(options, _options);
    element.style.opacity = 1;
    element.style.display = options.display || "block";
    setTimeout(function () {
      element.style.transition = "".concat(options.duration, "ms opacity ease");
      element.style.opacity = options.opacity;
    }, 5);
    setTimeout(function () {
      element.style.display = "none";
      element.style.removeProperty("transition");
      !!options.callback && options.callback();
    }, options.duration + 50);
  };
  
  exports.fadeOut = fadeOut;

    var isElement = function isElement(o) {
        return (typeof HTMLElement === "undefined" ? "undefined" : _typeof(HTMLElement)) === "object" ? o instanceof HTMLElement // DOM2
        : o && _typeof(o) === "object" && o !== null && o.nodeType === 1 && typeof o.nodeName === "string";
    };
    
    exports.isElement = isElement;
    
    var registerWidget = function registerWidget(className, widgetName) {
    var skin = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : "default";
    
    if (!(className || widgetName)) {
        return;
    }
    /**
     * Because Elementor plugin uses jQuery custom event,
     * We also have to use jQuery to use this event
     */
    
    
    jQuery(window).on("elementor/frontend/init", function () {
        var addHandler = function addHandler($element) {
        elementorFrontend.elementsHandler.addHandler(className, {
            $element: $element
        });
        };
    
        elementorFrontend.hooks.addAction("frontend/element_ready/".concat(widgetName, ".").concat(skin), addHandler);
    });
    };
    
    exports.registerWidget = registerWidget;

    },{}],2:[function(require,module,exports){
    "use strict";
    
    function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }
    
    var _utils = require("../lib/utils");
    
    function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
    
    function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }
    
    function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }
    
    function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }
    
    function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }
    
    function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }
    
    function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } return _assertThisInitialized(self); }
    
    function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }
    
    function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }
    
    function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }
    
    var OEW_WooCart = /*#__PURE__*/function (_elementorModules$fro) {
      _inherits(OEW_WooCart, _elementorModules$fro);
    
      var _super = _createSuper(OEW_WooCart);
    
      function OEW_WooCart() {
        _classCallCheck(this, OEW_WooCart);
    
        return _super.apply(this, arguments);
      }
    
      _createClass(OEW_WooCart, [{
        key: "getDefaultSettings",
        value: function getDefaultSettings() {
          return {
            selectors: {
              toggle: ".oew-toggle-cart",
              toggleCartDropdown: ".oew-cart-dropdown",
            }
          };
        }
      }, {
        key: "getDefaultElements",
        value: function getDefaultElements() {
          var element = this.$element.get(0);
          var selectors = this.getSettings("selectors");
          return {
            toggle: element.querySelector(selectors.toggle),
            toggleCartDropdown: element.querySelector(selectors.toggleCartDropdown),
            body: document.body,
          };
        }
      }, {
        key: "bindEvents",
        value: function bindEvents() {
          jQuery("body").on("added_to_cart", this.toggleCartDropdown.bind(this));
          this.getDefaultElements().body.addEventListener("click", this.closeOverlay.bind(this));
          window.addEventListener("resize", this.closeOverlay.bind(this));
        }
      }, {
        key: "toggleCartDropdown",
        value: function toggleCartDropdown(event, fragments) {
          if( fragments !== undefined && fragments.e_manually_triggered ) {
            return;
          }
          var _this = this;
          event.preventDefault();
            _this.elements.body.classList.add("oec-show-cart");          
        }
      }, {
        key: "closeOverlay",
        value: function closeOverlay(event) {
            var _this = this;
            if (!jQuery(event.target).closest('.oew-toggle-cart').length) {
              _this.elements.body.classList.remove("oec-show-cart");
            }
        }
      }]);
    
      return OEW_WooCart;
    }(elementorModules.frontend.handlers.Base);
    
    (0, _utils.registerWidget)(OEW_WooCart, "oew-woo-cart-icon");
    
    },{"../lib/utils":1}]},{},[2])