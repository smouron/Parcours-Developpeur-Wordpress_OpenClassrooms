(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({1:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.registerWidget = exports.isElement = exports.getSiblings = exports.visible = exports.offset = exports.fadeToggle = exports.fadeOut = exports.fadeIn = exports.slideToggle = exports.slideUp = exports.slideDown = void 0;

function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

var slideDown = function slideDown(element) {
  var duration = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 300;
  var display = window.getComputedStyle(element).display;

  if (display === "none") {
    display = "block";
  }

  element.style.transitionProperty = "height";
  element.style.transitionDuration = "".concat(duration, "ms");
  element.style.opacity = 0;
  element.style.display = display;
  var height = element.offsetHeight;
  element.style.height = 0;
  element.style.opacity = 1;
  element.style.overflow = "hidden";
  setTimeout(function () {
    element.style.height = "".concat(height, "px");
  }, 5);
  window.setTimeout(function () {
    element.style.removeProperty("height");
    element.style.removeProperty("overflow");
    element.style.removeProperty("transition-duration");
    element.style.removeProperty("transition-property");
    element.style.removeProperty("opacity");
  }, duration + 50);
};

exports.slideDown = slideDown;

var slideUp = function slideUp(element) {
  var duration = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 300;
  element.style.boxSizing = "border-box";
  element.style.transitionProperty = "height, margin";
  element.style.transitionDuration = "".concat(duration, "ms");
  element.style.height = "".concat(element.offsetHeight, "px");
  element.style.marginTop = 0;
  element.style.marginBottom = 0;
  element.style.overflow = "hidden";
  setTimeout(function () {
    element.style.height = 0;
  }, 5);
  window.setTimeout(function () {
    element.style.display = "none";
    element.style.removeProperty("height");
    element.style.removeProperty("margin-top");
    element.style.removeProperty("margin-bottom");
    element.style.removeProperty("overflow");
    element.style.removeProperty("transition-duration");
    element.style.removeProperty("transition-property");
  }, duration + 50);
};

exports.slideUp = slideUp;

var slideToggle = function slideToggle(element, duration) {
  window.getComputedStyle(element).display === "none" ? slideDown(element, duration) : slideUp(element, duration);
};

exports.slideToggle = slideToggle;

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

var fadeToggle = function fadeToggle(element, options) {
  window.getComputedStyle(element).display === "none" ? fadeIn(element, options) : fadeOut(element, options);
};

exports.fadeToggle = fadeToggle;

var offset = function offset(element) {
  if (!element.getClientRects().length) {
    return {
      top: 0,
      left: 0
    };
  } // Get document-relative position by adding viewport scroll to viewport-relative gBCR


  var rect = element.getBoundingClientRect();
  var win = element.ownerDocument.defaultView;
  return {
    top: rect.top + win.pageYOffset,
    left: rect.left + win.pageXOffset
  };
};

exports.offset = offset;

var visible = function visible(element) {
  if (!element) {
    return false;
  }

  return !!(element.offsetWidth || element.offsetHeight || element.getClientRects().length);
};

exports.visible = visible;

var getSiblings = function getSiblings(e) {
  // for collecting siblings
  var siblings = []; // if no parent, return no sibling

  if (!e.parentNode) {
    return siblings;
  } // first child of the parent node


  var sibling = e.parentNode.firstChild; // collecting siblings

  while (sibling) {
    if (sibling.nodeType === 1 && sibling !== e) {
      siblings.push(sibling);
    }

    sibling = sibling.nextSibling;
  }

  return siblings;
}; // Returns true if it is a DOM element


exports.getSiblings = getSiblings;

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

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _get(target, property, receiver) { if (typeof Reflect !== "undefined" && Reflect.get) { _get = Reflect.get; } else { _get = function _get(target, property, receiver) { var base = _superPropBase(target, property); if (!base) return; var desc = Object.getOwnPropertyDescriptor(base, property); if (desc.get) { return desc.get.call(receiver); } return desc.value; }; } return _get(target, property, receiver || target); }

function _superPropBase(object, property) { while (!Object.prototype.hasOwnProperty.call(object, property)) { object = _getPrototypeOf(object); if (object === null) break; } return object; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

var OEW_Carousel = /*#__PURE__*/function (_elementorModules$fro) {
  _inherits(OEW_Carousel, _elementorModules$fro);

  var _super = _createSuper(OEW_Carousel);

  function OEW_Carousel() {
    _classCallCheck(this, OEW_Carousel);

    return _super.apply(this, arguments);
  }

  _createClass(OEW_Carousel, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        selectors: {
          carousel: ".oew-carousel-container",
          carouselNextBtn: ".swiper-button-next-".concat(this.getID()),
          carouselPrevBtn: ".swiper-button-prev-".concat(this.getID()),
          carouselPagination: ".swiper-pagination-".concat(this.getID())
        },
        effect: "slide",
        loop: false,
        autoplay: 0,
        speed: 400,
        navigation: false,
        pagination: false,
        centeredSlides: false,
        pauseOnHover: false,
        slidesPerView: {
          desktop: 3,
          tablet: 2,
          mobile: 1
        },
        slidesPerGroup: {
          desktop: 3,
          tablet: 2,
          mobile: 1
        },
        spaceBetween: {
          desktop: 10,
          tablet: 10,
          mobile: 10
        },
        swiperInstance: null
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var element = this.$element.get(0);
      var selectors = this.getSettings("selectors");
      return {
        carousel: element.querySelector(selectors.carousel),
        carouselNextBtn: element.querySelectorAll(selectors.carouselNextBtn),
        carouselPrevBtn: element.querySelectorAll(selectors.carouselPrevBtn),
        carouselPagination: element.querySelectorAll(selectors.carouselPagination)
      };
    }
  }, {
    key: "onInit",
    value: function onInit() {
      var _get2;

      for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
        args[_key] = arguments[_key];
      }

      (_get2 = _get(_getPrototypeOf(OEW_Carousel.prototype), "onInit", this)).call.apply(_get2, [this].concat(args));

      this.setUserSettings();
      this.initSwiper();
      this.setupEventListeners();
    }
  }, {
    key: "setUserSettings",
    value: function setUserSettings() {
      var settings = this.getSettings();
      var userSettings = JSON.parse(this.elements.carousel.getAttribute("data-settings"));
      var currentSettings = {
        effect: !!userSettings.effect ? userSettings.effect : settings.effect,
        loop: !!userSettings.loop ? Boolean(Number(userSettings.loop)) : settings.loop,
        autoplay: !!userSettings.autoplay ? Number(userSettings.autoplay) : settings.autoplay,
        speed: !!userSettings.speed ? Number(userSettings.speed) : settings.speed,
        navigation: !!userSettings.arrows ? Boolean(Number(userSettings.arrows)) : settings.navigation,
        pagination: !!userSettings.dots ? Boolean(Number(userSettings.dots)) : settings.pagination,
        pauseOnHover: !!userSettings["pause-on-hover"] ? JSON.parse(userSettings["pause-on-hover"]) : settings.pauseOnHover,
        slidesPerView: {
          desktop: !!userSettings.items ? Number(userSettings.items) : settings.slidesPerView.desktop,
          tablet: !!userSettings["items-tablet"] ? Number(userSettings["items-tablet"]) : settings.slidesPerView.tablet,
          mobile: !!userSettings["items-mobile"] ? Number(userSettings["items-mobile"]) : settings.slidesPerView.mobile
        },
        slidesPerGroup: {
          desktop: !!userSettings.slides ? Number(userSettings.slides) : settings.slidesPerGroup.desktop,
          tablet: !!userSettings["slides-tablet"] ? Number(userSettings["slides-tablet"]) : settings.slidesPerGroup.tablet,
          mobile: !!userSettings["slides-mobile"] ? Number(userSettings["slides-mobile"]) : settings.slidesPerGroup.mobile
        },
        spaceBetween: {
          desktop: !!userSettings.margin ? Number(userSettings.margin) : settings.spaceBetween.desktop,
          tablet: !!userSettings["margin-tablet"] ? Number(userSettings["margin-tablet"]) : settings.spaceBetween.tablet,
          mobile: !!userSettings["margin-mobile"] ? Number(userSettings["margin-mobile"]) : settings.spaceBetween.mobile
        }
      };
      currentSettings.centeredSlides = currentSettings.effect === "coverflow" ? true : settings.centeredSlides;
      this.setSettings(currentSettings);
    }
  }, {
    key: "initSwiper",
    value: function initSwiper() {
      var swiper = new Swiper(this.elements.carousel, this.swiperOptions());
      this.setSettings({
        swiperInstance: swiper
      });
    }
  }, {
    key: "swiperOptions",
    value: function swiperOptions() {
      var settings = this.getSettings();
      var swiperOptions = {
        direction: "horizontal",
        effect: settings.effect,
        loop: settings.loop,
        speed: settings.speed,
        centeredSlides: settings.centeredSlides,
        autoHeight: true,
        autoplay: !settings.autoplay ? false : {
          delay: settings.autoplay
        },
        navigation: !settings.navigation ? false : {
          nextEl: settings.selectors.carouselNextBtn,
          prevEl: settings.selectors.carouselPrevBtn
        },
        pagination: !settings.pagination ? false : {
          el: settings.selectors.carouselPagination,
          clickable: true
        }
      };

      if (settings.effect === "fade") {
        swiperOptions.items = 1;
      } else {
        swiperOptions.breakpoints = {
          1024: {
            slidesPerView: settings.slidesPerView.desktop,
            slidesPerGroup: settings.slidesPerGroup.desktop,
            spaceBetween: settings.spaceBetween.desktop
          },
          768: {
            slidesPerView: settings.slidesPerView.tablet,
            slidesPerGroup: settings.slidesPerGroup.tablet,
            spaceBetween: settings.spaceBetween.tablet
          },
          320: {
            slidesPerView: settings.slidesPerView.mobile,
            slidesPerGroup: settings.slidesPerGroup.mobile,
            spaceBetween: settings.spaceBetween.mobile
          }
        };
      }

      return swiperOptions;
    }
  }, {
    key: "setupEventListeners",
    value: function setupEventListeners() {
      if (this.getSettings("pauseOnHover")) {
        this.elements.carousel.addEventListener("mouseenter", this.pauseSwiper.bind(this));
        this.elements.carousel.addEventListener("mouseleave", this.resumeSwiper.bind(this));
      }
    }
  }, {
    key: "pauseSwiper",
    value: function pauseSwiper(event) {
      this.getSettings("swiperInstance").autoplay.stop();
    }
  }, {
    key: "resumeSwiper",
    value: function resumeSwiper(event) {
      this.getSettings("swiperInstance").autoplay.start();
    }
  }]);

  return OEW_Carousel;
}(elementorModules.frontend.handlers.Base);

var _default = OEW_Carousel;
exports["default"] = _default;

},{}],3:[function(require,module,exports){
"use strict";

function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

var _utils = require("../lib/utils");

var _carousel = _interopRequireDefault(require("./base/carousel"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

var OEW_WooSlider = /*#__PURE__*/function (_OEW_Carousel) {
  _inherits(OEW_WooSlider, _OEW_Carousel);

  var _super = _createSuper(OEW_WooSlider);

  function OEW_WooSlider() {
    _classCallCheck(this, OEW_WooSlider);

    return _super.apply(this, arguments);
  }

  return OEW_WooSlider;
}(_carousel["default"]);

(0, _utils.registerWidget)(OEW_WooSlider, "oew-woo-slider");

},{"../lib/utils":1,"./base/carousel":2}]},{},[3])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJhc3NldHMvc3JjL2pzL2xpYi91dGlscy5qcyIsImFzc2V0cy9zcmMvanMvd2lkZ2V0cy9iYXNlL2Nhcm91c2VsLmpzIiwiYXNzZXRzL3NyYy9qcy93aWRnZXRzL3dvby1zbGlkZXIuanMiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7Ozs7Ozs7Ozs7QUNBTyxJQUFNLFNBQVMsR0FBRyxTQUFaLFNBQVksQ0FBQyxPQUFELEVBQTZCO0FBQUEsTUFBbkIsUUFBbUIsdUVBQVIsR0FBUTtBQUNsRCxNQUFJLE9BQU8sR0FBRyxNQUFNLENBQUMsZ0JBQVAsQ0FBd0IsT0FBeEIsRUFBaUMsT0FBL0M7O0FBRUEsTUFBSSxPQUFPLEtBQUssTUFBaEIsRUFBd0I7QUFDcEIsSUFBQSxPQUFPLEdBQUcsT0FBVjtBQUNIOztBQUVELEVBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxrQkFBZCxHQUFtQyxRQUFuQztBQUNBLEVBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxrQkFBZCxhQUFzQyxRQUF0QztBQUVBLEVBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxPQUFkLEdBQXdCLENBQXhCO0FBQ0EsRUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLE9BQWQsR0FBd0IsT0FBeEI7QUFDQSxNQUFJLE1BQU0sR0FBRyxPQUFPLENBQUMsWUFBckI7QUFFQSxFQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsTUFBZCxHQUF1QixDQUF2QjtBQUNBLEVBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxPQUFkLEdBQXdCLENBQXhCO0FBQ0EsRUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLFFBQWQsR0FBeUIsUUFBekI7QUFFQSxFQUFBLFVBQVUsQ0FBQyxZQUFNO0FBQ2IsSUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLE1BQWQsYUFBMEIsTUFBMUI7QUFDSCxHQUZTLEVBRVAsQ0FGTyxDQUFWO0FBSUEsRUFBQSxNQUFNLENBQUMsVUFBUCxD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Q0g7OztXQUVELCtCQUFzQjtBQUNsQixVQUFJLEtBQUssV0FBTCxDQUFpQixjQUFqQixDQUFKLEVBQXNDO0FBQ2xDLGFBQUssUUFBTCxDQUFjLFFBQWQsQ0FBdUIsZ0JBQXZCLENBQXdDLFlBQXhDLEVBQXNELEtBQUssV0FBTCxDQUFpQixJQUFqQixDQUFzQixJQUF0QixDQUF0RDtBQUNBLGFBQUssUUFBTCxDQUFjLFFBQWQsQ0FBdUIsZ0JBQXZCLENBQXdDLFlBQXhDLEVBQXNELEtBQUssWUFBTCxDQUFrQixJQUFsQixDQUF1QixJQUF2QixDQUF0RDtBQUNIO0FBQ0o7OztXQUVELHFCQUFZLEtBQVosRUFBbUI7QUFDZixXQUFLLFdBQUwsQ0FBaUIsZ0JBQWpCLEVBQW1DLFFBQW5DLENBQTRDLElBQTVDO0FBQ0g7OztXQUVELHNCQUFhLEtBQWIsRUFBb0I7QUFDaEIsV0FBSyxXQUFMLENBQWlCLGdCQUFqQixFQUFtQyxRQUFuQyxDQUE0QyxLQUE1QztBQUNIOzs7O0VBbkxzQixnQkFBZ0IsQ0FBQyxRQUFqQixDQUEwQixRQUExQixDQUFtQyxJOztlQXNML0MsWTs7Ozs7Ozs7QUN0TGY7O0FBQ0E7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7O0lBRU0sYTs7Ozs7Ozs7Ozs7O0VBQXNCLG9COztBQUU1QiwyQkFBZSxhQUFmLEVBQThCLGdCQUE5QiIsImZpbGUiOiJnZW5lcmF0ZWQuanMiLCJzb3VyY2VSb290IjoiIiwic291cmNlc0NvbnRlbnQiOlsiKGZ1bmN0aW9uKCl7ZnVuY3Rpb24gcihlLG4sdCl7ZnVuY3Rpb24gbyhpLGYpe2lmKCFuW2ldKXtpZighZVtpXSl7dmFyIGM9XCJmdW5jdGlvblwiPT10eXBlb2YgcmVxdWlyZSYmcmVxdWlyZTtpZighZiYmYylyZXR1cm4gYyhpLCEwKTtpZih1KXJldHVybiB1KGksITApO3ZhciBhPW5ldyBFcnJvcihcIkNhbm5vdCBmaW5kIG1vZHVsZSAnXCIraStcIidcIik7dGhyb3cgYS5jb2RlPVwiTU9EVUxFX05PVF9GT1VORFwiLGF9dmFyIHA9bltpXT17ZXhwb3J0czp7fX07ZVtpXVswXS5jYWxsKHAuZXhwb3J0cyxmdW5jdGlvbihyKXt2YXIgbj1lW2ldWzFdW3JdO3JldHVybiBvKG58fHIpfSxwLHAuZXhwb3J0cyxyLGUsbix0KX1yZXR1cm4gbltpXS5leHBvcnRzfWZvcih2YXIgdT1cImZ1bmN0aW9uXCI9PXR5cGVvZiByZXF1aXJlJiZyZXF1aXJlLGk9MDtpPHQubGVuZ3RoO2krKylvKHRbaV0pO3JldHVybiBvfXJldHVybiByfSkoKSIsImV4cG9ydCBjb25zdCBzbGlkZURvd24gPSAoZWxlbWVudCwgZHVyYXRpb24gPSAzMDApID0+IHtcclxuICAgIGxldCBkaXNwbGF5ID0gd2luZG93LmdldENvbXB1dGVkU3R5bGUoZWxlbWVudCkuZGlzcGxheTtcclxuXHJcbiAgICBpZiAoZGlzcGxheSA9PT0gXCJub25lXCIpIHtcclxuICAgICAgICBkaXNwbGF5ID0gXCJibG9ja1wiO1xyXG4gICAgfVxyXG5cclxuICAgIGVsZW1lbnQuc3R5bGUudHJhbnNpdGlvblByb3BlcnR5ID0gXCJoZWlnaHRcIjtcclxuICAgIGVsZW1lbnQuc3R5bGUudHJhbnNpdGlvbkR1cmF0aW9uID0gYCR7ZHVyYXRpb259bXNgO1xyXG5cclxuICAgIGVsZW1lbnQuc3R5bGUub3BhY2l0eSA9IDA7XHJcbiAgICBlbGVtZW50LnN0eWxlLmRpc3BsYXkgPSBkaXNwbGF5O1xyXG4gICAgbGV0IGhlaWdodCA9IGVsZW1lbnQub2Zmc2V0SGVpZ2h0O1xyXG5cclxuICAgIGVsZW1lbnQuc3R5bGUuaGVpZ2h0ID0gMDtcclxuICAgIGVsZW1lbnQuc3R5bGUub3BhY2l0eSA9IDE7XHJcbiAgICBlbGVtZW50LnN0eWxlLm92ZXJmbG93ID0gXCJoaWRkZW5cIjtcclxuXHJcbiAgICBzZXRUaW1lb3V0KCgpID0+IHtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLmhlaWdodCA9IGAke2hlaWdodH1weGA7XHJcbiAgICB9LCA1KTtcclxuXHJcbiAgICB3aW5kb3cuc2V0VGltZW91dCgoKSA9PiB7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcImhlaWdodFwiKTtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwib3ZlcmZsb3dcIik7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcInRyYW5zaXRpb24tZHVyYXRpb25cIik7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcInRyYW5zaXRpb24tcHJvcGVydHlcIik7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcIm9wYWNpdHlcIik7XHJcbiAgICB9LCBkdXJhdGlvbiArIDUwKTtcclxufTtcclxuXHJcbmV4cG9ydCBjb25zdCBzbGlkZVVwID0gKGVsZW1lbnQsIGR1cmF0aW9uID0gMzAwKSA9PiB7XHJcbiAgICBlbGVtZW50LnN0eWxlLmJveFNpemluZyA9IFwiYm9yZGVyLWJveFwiO1xyXG4gICAgZWxlbWVudC5zdHlsZS50cmFuc2l0aW9uUHJvcGVydHkgPSBcImhlaWdodCwgbWFyZ2luXCI7XHJcbiAgICBlbGVtZW50LnN0eWxlLnRyYW5zaXRpb25EdXJhdGlvbiA9IGAke2R1cmF0aW9ufW1zYDtcclxuICAgIGVsZW1lbnQuc3R5bGUuaGVpZ2h0ID0gYCR7ZWxlbWVudC5vZmZzZXRIZWlnaHR9cHhgO1xyXG4gICAgZWxlbWVudC5zdHlsZS5tYXJnaW5Ub3AgPSAwO1xyXG4gICAgZWxlbWVudC5zdHlsZS5tYXJnaW5Cb3R0b20gPSAwO1xyXG4gICAgZWxlbWVudC5zdHlsZS5vdmVyZmxvdyA9IFwiaGlkZGVuXCI7XHJcblxyXG4gICAgc2V0VGltZW91dCgoKSA9PiB7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5oZWlnaHQgPSAwO1xyXG4gICAgfSwgNSk7XHJcblxyXG4gICAgd2luZG93LnNldFRpbWVvdXQoKCkgPT4ge1xyXG4gICAgICAgIGVsZW1lbnQuc3R5bGUuZGlzcGxheSA9IFwibm9uZVwiO1xyXG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJoZWlnaHRcIik7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcIm1hcmdpbi10b3BcIik7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcIm1hcmdpbi1ib3R0b21cIik7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcIm92ZXJmbG93XCIpO1xyXG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJ0cmFuc2l0aW9uLWR1cmF0aW9uXCIpO1xyXG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJ0cmFuc2l0aW9uLXByb3BlcnR5XCIpO1xyXG4gICAgfSwgZHVyYXRpb24gKyA1MCk7XHJcbn07XHJcblxyXG5leHBvcnQgY29uc3Qgc2xpZGVUb2dnbGUgPSAoZWxlbWVudCwgZHVyYXRpb24pID0+IHtcclxuICAgIHdpbmRvdy5nZXRDb21wdXRlZFN0eWxlKGVsZW1lbnQpLmRpc3BsYXkgPT09IFwibm9uZVwiID8gc2xpZGVEb3duKGVsZW1lbnQsIGR1cmF0aW9uKSA6IHNsaWRlVXAoZWxlbWVudCwgZHVyYXRpb24pO1xyXG59O1xyXG5cclxuZXhwb3J0IGNvbnN0IGZhZGVJbiA9IChlbGVtZW50LCBfb3B0aW9ucyA9IHt9KSA9PiB7XHJcbiAgICBjb25zdCBvcHRpb25zID0ge1xyXG4gICAgICAgIGR1cmF0aW9uOiAzMDAsXHJcbiAgICAgICAgZGlzcGxheTogbnVsbCxcclxuICAgICAgICBvcGFjaXR5OiAxLFxyXG4gICAgICAgIGNhbGxiYWNrOiBudWxsLFxyXG4gICAgfTtcclxuXHJcbiAgICBPYmplY3QuYXNzaWduKG9wdGlvbnMsIF9vcHRpb25zKTtcclxuXHJcbiAgICBlbGVtZW50LnN0eWxlLm9wYWNpdHkgPSAwO1xyXG4gICAgZWxlbWVudC5zdHlsZS5kaXNwbGF5ID0gb3B0aW9ucy5kaXNwbGF5IHx8IFwiYmxvY2tcIjtcclxuXHJcbiAgICBzZXRUaW1lb3V0KCgpID0+IHtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLnRyYW5zaXRpb24gPSBgJHtvcHRpb25zLmR1cmF0aW9ufW1zIG9wYWNpdHkgZWFzZWA7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5vcGFjaXR5ID0gb3B0aW9ucy5vcGFjaXR5O1xyXG4gICAgfSwgNSk7XHJcblxyXG4gICAgc2V0VGltZW91dCgoKSA9PiB7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcInRyYW5zaXRpb25cIik7XHJcbiAgICAgICAgISFvcHRpb25zLmNhbGxiYWNrICYmIG9wdGlvbnMuY2FsbGJhY2soKTtcclxuICAgIH0sIG9wdGlvbnMuZHVyYXRpb24gKyA1MCk7XHJcbn07XHJcblxyXG5leHBvcnQgY29uc3QgZmFkZU91dCA9IChlbGVtZW50LCBfb3B0aW9ucyA9IHt9KSA9PiB7XHJcbiAgICBjb25zdCBvcHRpb25zID0ge1xyXG4gICAgICAgIGR1cmF0aW9uOiAzMDAsXHJcbiAgICAgICAgZGlzcGxheTogbnVsbCxcclxuICAgICAgICBvcGFjaXR5OiAwLFxyXG4gICAgICAgIGNhbGxiYWNrOiBudWxsLFxyXG4gICAgfTtcclxuXHJcbiAgICBPYmplY3QuYXNzaWduKG9wdGlvbnMsIF9vcHRpb25zKTtcclxuXHJcbiAgICBlbGVtZW50LnN0eWxlLm9wYWNpdHkgPSAxO1xyXG4gICAgZWxlbWVudC5zdHlsZS5kaXNwbGF5ID0gb3B0aW9ucy5kaXNwbGF5IHx8IFwiYmxvY2tcIjtcclxuXHJcbiAgICBzZXRUaW1lb3V0KCgpID0+IHtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLnRyYW5zaXRpb24gPSBgJHtvcHRpb25zLmR1cmF0aW9ufW1zIG9wYWNpdHkgZWFzZWA7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5vcGFjaXR5ID0gb3B0aW9ucy5vcGFjaXR5O1xyXG4gICAgfSwgNSk7XHJcblxyXG4gICAgc2V0VGltZW91dCgoKSA9PiB7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5kaXNwbGF5ID0gXCJub25lXCI7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcInRyYW5zaXRpb25cIik7XHJcbiAgICAgICAgISFvcHRpb25zLmNhbGxiYWNrICYmIG9wdGlvbnMuY2FsbGJhY2soKTtcclxuICAgIH0sIG9wdGlvbnMuZHVyYXRpb24gKyA1MCk7XHJcbn07XHJcblxyXG5leHBvcnQgY29uc3QgZmFkZVRvZ2dsZSA9IChlbGVtZW50LCBvcHRpb25zKSA9PiB7XHJcbiAgICB3aW5kb3cuZ2V0Q29tcHV0ZWRTdHlsZShlbGVtZW50KS5kaXNwbGF5ID09PSBcIm5vbmVcIiA/IGZhZGVJbihlbGVtZW50LCBvcHRpb25zKSA6IGZhZGVPdXQoZWxlbWVudCwgb3B0aW9ucyk7XHJcbn07XHJcblxyXG5leHBvcnQgY29uc3Qgb2Zmc2V0ID0gKGVsZW1lbnQpID0+IHtcclxuICAgIGlmICghZWxlbWVudC5nZXRDbGllbnRSZWN0cygpLmxlbmd0aCkge1xyXG4gICAgICAgIHJldHVybiB7IHRvcDogMCwgbGVmdDogMCB9O1xyXG4gICAgfVxyXG5cclxuICAgIC8vIEdldCBkb2N1bWVudC1yZWxhdGl2ZSBwb3NpdGlvbiBieSBhZGRpbmcgdmlld3BvcnQgc2Nyb2xsIHRvIHZpZXdwb3J0LXJlbGF0aXZlIGdCQ1JcclxuICAgIGNvbnN0IHJlY3QgPSBlbGVtZW50LmdldEJvdW5kaW5nQ2xpZW50UmVjdCgpO1xyXG4gICAgY29uc3Qgd2luID0gZWxlbWVudC5vd25lckRvY3VtZW50LmRlZmF1bHRWaWV3O1xyXG4gICAgcmV0dXJuIHtcclxuICAgICAgICB0b3A6IHJlY3QudG9wICsgd2luLnBhZ2VZT2Zmc2V0LFxyXG4gICAgICAgIGxlZnQ6IHJlY3QubGVmdCArIHdpbi5wYWdlWE9mZnNldCxcclxuICAgIH07XHJcbn07XHJcblxyXG5leHBvcnQgY29uc3QgdmlzaWJsZSA9IChlbGVtZW50KSA9PiB7XHJcbiAgICBpZiAoIWVsZW1lbnQpIHtcclxuICAgICAgICByZXR1cm4gZmFsc2U7XHJcbiAgICB9XHJcblxyXG4gICAgcmV0dXJuICEhKGVsZW1lbnQub2Zmc2V0V2lkdGggfHwgZWxlbWVudC5vZmZzZXRIZWlnaHQgfHwgZWxlbWVudC5nZXRDbGllbnRSZWN0cygpLmxlbmd0aCk7XHJcbn07XHJcblxyXG5leHBvcnQgY29uc3QgZ2V0U2libGluZ3MgPSAoZSkgPT4ge1xyXG4gICAgLy8gZm9yIGNvbGxlY3Rpbmcgc2libGluZ3NcclxuICAgIGNvbnN0IHNpYmxpbmdzID0gW107XHJcblxyXG4gICAgLy8gaWYgbm8gcGFyZW50LCByZXR1cm4gbm8gc2libGluZ1xyXG4gICAgaWYgKCFlLnBhcmVudE5vZGUpIHtcclxuICAgICAgICByZXR1cm4gc2libGluZ3M7XHJcbiAgICB9XHJcblxyXG4gICAgLy8gZmlyc3QgY2hpbGQgb2YgdGhlIHBhcmVudCBub2RlXHJcbiAgICBsZXQgc2libGluZyA9IGUucGFyZW50Tm9kZS5maXJzdENoaWxkO1xyXG5cclxuICAgIC8vIGNvbGxlY3Rpbmcgc2libGluZ3NcclxuICAgIHdoaWxlIChzaWJsaW5nKSB7XHJcbiAgICAgICAgaWYgKHNpYmxpbmcubm9kZVR5cGUgPT09IDEgJiYgc2libGluZyAhPT0gZSkge1xyXG4gICAgICAgICAgICBzaWJsaW5ncy5wdXNoKHNpYmxpbmcpO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgc2libGluZyA9IHNpYmxpbmcubmV4dFNpYmxpbmc7XHJcbiAgICB9XHJcblxyXG4gICAgcmV0dXJuIHNpYmxpbmdzO1xyXG59O1xyXG5cclxuLy8gUmV0dXJucyB0cnVlIGlmIGl0IGlzIGEgRE9NIGVsZW1lbnRcclxuZXhwb3J0IGNvbnN0IGlzRWxlbWVudCA9IChvKSA9PiB7XHJcbiAgICByZXR1cm4gdHlwZW9mIEhUTUxFbGVtZW50ID09PSBcIm9iamVjdFwiXHJcbiAgICAgICAgPyBvIGluc3RhbmNlb2YgSFRNTEVsZW1lbnQgLy8gRE9NMlxyXG4gICAgICAgIDogbyAmJiB0eXBlb2YgbyA9PT0gXCJvYmplY3RcIiAmJiBvICE9PSBudWxsICYmIG8ubm9kZVR5cGUgPT09IDEgJiYgdHlwZW9mIG8ubm9kZU5hbWUgPT09IFwic3RyaW5nXCI7XHJcbn07XHJcblxyXG5leHBvcnQgY29uc3QgcmVnaXN0ZXJXaWRnZXQgPSAoY2xhc3NOYW1lLCB3aWRnZXROYW1lLCBza2luID0gXCJkZWZhdWx0XCIpID0+IHtcclxuICAgIGlmICghKGNsYXNzTmFtZSB8fCB3aWRnZXROYW1lKSkge1xyXG4gICAgICAgIHJldHVybjtcclxuICAgIH1cclxuXHJcbiAgICAvKipcclxuICAgICAqIEJlY2F1c2UgRWxlbWVudG9yIHBsdWdpbiB1c2VzIGpRdWVyeSBjdXN0b20gZXZlbnQsXHJcbiAgICAgKiBXZSBhbHNvIGhhdmUgdG8gdXNlIGpRdWVyeSB0byB1c2UgdGhpcyBldmVudFxyXG4gICAgICovXHJcbiAgICBqUXVlcnkod2luZG93KS5vbihcImVsZW1lbnRvci9mcm9udGVuZC9pbml0XCIsICgpID0+IHtcclxuICAgICAgICBjb25zdCBhZGRIYW5kbGVyID0gKCRlbGVtZW50KSA9PiB7XHJcbiAgICAgICAgICAgIGVsZW1lbnRvckZyb250ZW5kLmVsZW1lbnRzSGFuZGxlci5hZGRIYW5kbGVyKGNsYXNzTmFtZSwge1xyXG4gICAgICAgICAgICAgICAgJGVsZW1lbnQsXHJcbiAgICAgICAgICAgIH0pO1xyXG4gICAgICAgIH07XHJcblxyXG4gICAgICAgIGVsZW1lbnRvckZyb250ZW5kLmhvb2tzLmFkZEFjdGlvbihgZnJvbnRlbmQvZWxlbWVudF9yZWFkeS8ke3dpZGdldE5hbWV9LiR7c2tpbn1gLCBhZGRIYW5kbGVyKTtcclxuICAgIH0pO1xyXG59O1xyXG4iLCJjbGFzcyBPRVdfQ2Fyb3VzZWwgZXh0ZW5kcyBlbGVtZW50b3JNb2R1bGVzLmZyb250ZW5kLmhhbmRsZXJzLkJhc2Uge1xyXG4gICAgZ2V0RGVmYXVsdFNldHRpbmdzKCkge1xyXG4gICAgICAgIHJldHVybiB7XHJcbiAgICAgICAgICAgIHNlbGVjdG9yczoge1xyXG4gICAgICAgICAgICAgICAgY2Fyb3VzZWw6IFwiLm9ldy1jYXJvdXNlbC1jb250YWluZXJcIixcclxuICAgICAgICAgICAgICAgIGNhcm91c2VsTmV4dEJ0bjogYC5zd2lwZXItYnV0dG9uLW5leHQtJHt0aGlzLmdldElEKCl9YCxcclxuICAgICAgICAgICAgICAgIGNhcm91c2VsUHJldkJ0bjogYC5zd2lwZXItYnV0dG9uLXByZXYtJHt0aGlzLmdldElEKCl9YCxcclxuICAgICAgICAgICAgICAgIGNhcm91c2VsUGFnaW5hdGlvbjogYC5zd2lwZXItcGFnaW5hdGlvbi0ke3RoaXMuZ2V0SUQoKX1gLFxyXG4gICAgICAgICAgICB9LFxyXG4gICAgICAgICAgICBlZmZlY3Q6IFwic2xpZGVcIixcclxuICAgICAgICAgICAgbG9vcDogZmFsc2UsXHJcbiAgICAgICAgICAgIGF1dG9wbGF5OiAwLFxyXG4gICAgICAgICAgICBzcGVlZDogNDAwLFxyXG4gICAgICAgICAgICBuYXZpZ2F0aW9uOiBmYWxzZSxcclxuICAgICAgICAgICAgcGFnaW5hdGlvbjogZmFsc2UsXHJcbiAgICAgICAgICAgIGNlbnRlcmVkU2xpZGVzOiBmYWxzZSxcclxuICAgICAgICAgICAgcGF1c2VPbkhvdmVyOiBmYWxzZSxcclxuICAgICAgICAgICAgc2xpZGVzUGVyVmlldzoge1xyXG4gICAgICAgICAgICAgICAgZGVza3RvcDogMyxcclxuICAgICAgICAgICAgICAgIHRhYmxldDogMixcclxuICAgICAgICAgICAgICAgIG1vYmlsZTogMSxcclxuICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAgc2xpZGVzUGVyR3JvdXA6IHtcclxuICAgICAgICAgICAgICAgIGRlc2t0b3A6IDMsXHJcbiAgICAgICAgICAgICAgICB0YWJsZXQ6IDIsXHJcbiAgICAgICAgICAgICAgICBtb2JpbGU6IDEsXHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIHNwYWNlQmV0d2Vlbjoge1xyXG4gICAgICAgICAgICAgICAgZGVza3RvcDogMTAsXHJcbiAgICAgICAgICAgICAgICB0YWJsZXQ6IDEwLFxyXG4gICAgICAgICAgICAgICAgbW9iaWxlOiAxMCxcclxuICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAgc3dpcGVySW5zdGFuY2U6IG51bGwsXHJcbiAgICAgICAgfTtcclxuICAgIH1cclxuXHJcbiAgICBnZXREZWZhdWx0RWxlbWVudHMoKSB7XHJcbiAgICAgICAgY29uc3QgZWxlbWVudCA9IHRoaXMuJGVsZW1lbnQuZ2V0KDApO1xyXG4gICAgICAgIGNvbnN0IHNlbGVjdG9ycyA9IHRoaXMuZ2V0U2V0dGluZ3MoXCJzZWxlY3RvcnNcIik7XHJcblxyXG4gICAgICAgIHJldHVybiB7XHJcbiAgICAgICAgICAgIGNhcm91c2VsOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3Ioc2VsZWN0b3JzLmNhcm91c2VsKSxcclxuICAgICAgICAgICAgY2Fyb3VzZWxOZXh0QnRuOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoc2VsZWN0b3JzLmNhcm91c2VsTmV4dEJ0biksXHJcbiAgICAgICAgICAgIGNhcm91c2VsUHJldkJ0bjogZWxlbWVudC5xdWVyeVNlbGVjdG9yQWxsKHNlbGVjdG9ycy5jYXJvdXNlbFByZXZCdG4pLFxyXG4gICAgICAgICAgICBjYXJvdXNlbFBhZ2luYXRpb246IGVsZW1lbnQucXVlcnlTZWxlY3RvckFsbChzZWxlY3RvcnMuY2Fyb3VzZWxQYWdpbmF0aW9uKSxcclxuICAgICAgICB9O1xyXG4gICAgfVxyXG5cclxuICAgIG9uSW5pdCguLi5hcmdzKSB7XHJcbiAgICAgICAgc3VwZXIub25Jbml0KC4uLmFyZ3MpO1xyXG5cclxuICAgICAgICB0aGlzLnNldFVzZXJTZXR0aW5ncygpO1xyXG4gICAgICAgIHRoaXMuaW5pdFN3aXBlcigpO1xyXG4gICAgICAgIHRoaXMuc2V0dXBFdmVudExpc3RlbmVycygpO1xyXG4gICAgfVxyXG5cclxuICAgIHNldFVzZXJTZXR0aW5ncygpIHtcclxuICAgICAgICBjb25zdCBzZXR0aW5ncyA9IHRoaXMuZ2V0U2V0dGluZ3MoKTtcclxuICAgICAgICBjb25zdCB1c2VyU2V0dGluZ3MgPSBKU09OLnBhcnNlKHRoaXMuZWxlbWVudHMuY2Fyb3VzZWwuZ2V0QXR0cmlidXRlKFwiZGF0YS1zZXR0aW5nc1wiKSk7XHJcblxyXG4gICAgICAgIGNvbnN0IGN1cnJlbnRTZXR0aW5ncyA9IHtcclxuICAgICAgICAgICAgZWZmZWN0OiAhIXVzZXJTZXR0aW5ncy5lZmZlY3QgPyB1c2VyU2V0dGluZ3MuZWZmZWN0IDogc2V0dGluZ3MuZWZmZWN0LFxyXG4gICAgICAgICAgICBsb29wOiAhIXVzZXJTZXR0aW5ncy5sb29wID8gQm9vbGVhbihOdW1iZXIodXNlclNldHRpbmdzLmxvb3ApKSA6IHNldHRpbmdzLmxvb3AsXHJcbiAgICAgICAgICAgIGF1dG9wbGF5OiAhIXVzZXJTZXR0aW5ncy5hdXRvcGxheSA/IE51bWJlcih1c2VyU2V0dGluZ3MuYXV0b3BsYXkpIDogc2V0dGluZ3MuYXV0b3BsYXksXHJcbiAgICAgICAgICAgIHNwZWVkOiAhIXVzZXJTZXR0aW5ncy5zcGVlZCA/IE51bWJlcih1c2VyU2V0dGluZ3Muc3BlZWQpIDogc2V0dGluZ3Muc3BlZWQsXHJcbiAgICAgICAgICAgIG5hdmlnYXRpb246ICEhdXNlclNldHRpbmdzLmFycm93cyA/IEJvb2xlYW4oTnVtYmVyKHVzZXJTZXR0aW5ncy5hcnJvd3MpKSA6IHNldHRpbmdzLm5hdmlnYXRpb24sXHJcbiAgICAgICAgICAgIHBhZ2luYXRpb246ICEhdXNlclNldHRpbmdzLmRvdHMgPyBCb29sZWFuKE51bWJlcih1c2VyU2V0dGluZ3MuZG90cykpIDogc2V0dGluZ3MucGFnaW5hdGlvbixcclxuICAgICAgICAgICAgcGF1c2VPbkhvdmVyOiAhIXVzZXJTZXR0aW5nc1tcInBhdXNlLW9uLWhvdmVyXCJdXHJcbiAgICAgICAgICAgICAgICA/IEpTT04ucGFyc2UodXNlclNldHRpbmdzW1wicGF1c2Utb24taG92ZXJcIl0pXHJcbiAgICAgICAgICAgICAgICA6IHNldHRpbmdzLnBhdXNlT25Ib3ZlcixcclxuICAgICAgICAgICAgc2xpZGVzUGVyVmlldzoge1xyXG4gICAgICAgICAgICAgICAgZGVza3RvcDogISF1c2VyU2V0dGluZ3MuaXRlbXMgPyBOdW1iZXIodXNlclNldHRpbmdzLml0ZW1zKSA6IHNldHRpbmdzLnNsaWRlc1BlclZpZXcuZGVza3RvcCxcclxuICAgICAgICAgICAgICAgIHRhYmxldDogISF1c2VyU2V0dGluZ3NbXCJpdGVtcy10YWJsZXRcIl1cclxuICAgICAgICAgICAgICAgICAgICA/IE51bWJlcih1c2VyU2V0dGluZ3NbXCJpdGVtcy10YWJsZXRcIl0pXHJcbiAgICAgICAgICAgICAgICAgICAgOiBzZXR0aW5ncy5zbGlkZXNQZXJWaWV3LnRhYmxldCxcclxuICAgICAgICAgICAgICAgIG1vYmlsZTogISF1c2VyU2V0dGluZ3NbXCJpdGVtcy1tb2JpbGVcIl1cclxuICAgICAgICAgICAgICAgICAgICA/IE51bWJlcih1c2VyU2V0dGluZ3NbXCJpdGVtcy1tb2JpbGVcIl0pXHJcbiAgICAgICAgICAgICAgICAgICAgOiBzZXR0aW5ncy5zbGlkZXNQZXJWaWV3Lm1vYmlsZSxcclxuICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAgc2xpZGVzUGVyR3JvdXA6IHtcclxuICAgICAgICAgICAgICAgIGRlc2t0b3A6ICEhdXNlclNldHRpbmdzLnNsaWRlcyA/IE51bWJlcih1c2VyU2V0dGluZ3Muc2xpZGVzKSA6IHNldHRpbmdzLnNsaWRlc1Blckdyb3VwLmRlc2t0b3AsXHJcbiAgICAgICAgICAgICAgICB0YWJsZXQ6ICEhdXNlclNldHRpbmdzW1wic2xpZGVzLXRhYmxldFwiXVxyXG4gICAgICAgICAgICAgICAgICAgID8gTnVtYmVyKHVzZXJTZXR0aW5nc1tcInNsaWRlcy10YWJsZXRcIl0pXHJcbiAgICAgICAgICAgICAgICAgICAgOiBzZXR0aW5ncy5zbGlkZXNQZXJHcm91cC50YWJsZXQsXHJcbiAgICAgICAgICAgICAgICBtb2JpbGU6ICEhdXNlclNldHRpbmdzW1wic2xpZGVzLW1vYmlsZVwiXVxyXG4gICAgICAgICAgICAgICAgICAgID8gTnVtYmVyKHVzZXJTZXR0aW5nc1tcInNsaWRlcy1tb2JpbGVcIl0pXHJcbiAgICAgICAgICAgICAgICAgICAgOiBzZXR0aW5ncy5zbGlkZXNQZXJHcm91cC5tb2JpbGUsXHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIHNwYWNlQmV0d2Vlbjoge1xyXG4gICAgICAgICAgICAgICAgZGVza3RvcDogISF1c2VyU2V0dGluZ3MubWFyZ2luID8gTnVtYmVyKHVzZXJTZXR0aW5ncy5tYXJnaW4pIDogc2V0dGluZ3Muc3BhY2VCZXR3ZWVuLmRlc2t0b3AsXHJcbiAgICAgICAgICAgICAgICB0YWJsZXQ6ICEhdXNlclNldHRpbmdzW1wibWFyZ2luLXRhYmxldFwiXVxyXG4gICAgICAgICAgICAgICAgICAgID8gTnVtYmVyKHVzZXJTZXR0aW5nc1tcIm1hcmdpbi10YWJsZXRcIl0pXHJcbiAgICAgICAgICAgICAgICAgICAgOiBzZXR0aW5ncy5zcGFjZUJldHdlZW4udGFibGV0LFxyXG4gICAgICAgICAgICAgICAgbW9iaWxlOiAhIXVzZXJTZXR0aW5nc1tcIm1hcmdpbi1tb2JpbGVcIl1cclxuICAgICAgICAgICAgICAgICAgICA/IE51bWJlcih1c2VyU2V0dGluZ3NbXCJtYXJnaW4tbW9iaWxlXCJdKVxyXG4gICAgICAgICAgICAgICAgICAgIDogc2V0dGluZ3Muc3BhY2VCZXR3ZWVuLm1vYmlsZSxcclxuICAgICAgICAgICAgfSxcclxuICAgICAgICB9O1xyXG5cclxuICAgICAgICBjdXJyZW50U2V0dGluZ3MuY2VudGVyZWRTbGlkZXMgPSBjdXJyZW50U2V0dGluZ3MuZWZmZWN0ID09PSBcImNvdmVyZmxvd1wiID8gdHJ1ZSA6IHNldHRpbmdzLmNlbnRlcmVkU2xpZGVzO1xyXG5cclxuICAgICAgICB0aGlzLnNldFNldHRpbmdzKGN1cnJlbnRTZXR0aW5ncyk7XHJcbiAgICB9XHJcblxyXG4gICAgaW5pdFN3aXBlcigpIHtcclxuICAgICAgICBjb25zdCBzd2lwZXIgPSBuZXcgU3dpcGVyKHRoaXMuZWxlbWVudHMuY2Fyb3VzZWwsIHRoaXMuc3dpcGVyT3B0aW9ucygpKTtcclxuXHJcbiAgICAgICAgdGhpcy5zZXRTZXR0aW5ncyh7XHJcbiAgICAgICAgICAgIHN3aXBlckluc3RhbmNlOiBzd2lwZXIsXHJcbiAgICAgICAgfSk7XHJcbiAgICB9XHJcblxyXG4gICAgc3dpcGVyT3B0aW9ucygpIHtcclxuICAgICAgICBjb25zdCBzZXR0aW5ncyA9IHRoaXMuZ2V0U2V0dGluZ3MoKTtcclxuXHJcbiAgICAgICAgY29uc3Qgc3dpcGVyT3B0aW9ucyA9IHtcclxuICAgICAgICAgICAgZGlyZWN0aW9uOiBcImhvcml6b250YWxcIixcclxuICAgICAgICAgICAgZWZmZWN0OiBzZXR0aW5ncy5lZmZlY3QsXHJcbiAgICAgICAgICAgIGxvb3A6IHNldHRpbmdzLmxvb3AsXHJcbiAgICAgICAgICAgIHNwZWVkOiBzZXR0aW5ncy5zcGVlZCxcclxuICAgICAgICAgICAgY2VudGVyZWRTbGlkZXM6IHNldHRpbmdzLmNlbnRlcmVkU2xpZGVzLFxyXG4gICAgICAgICAgICBhdXRvSGVpZ2h0OiB0cnVlLFxyXG4gICAgICAgICAgICBhdXRvcGxheTogIXNldHRpbmdzLmF1dG9wbGF5XHJcbiAgICAgICAgICAgICAgICA/IGZhbHNlXHJcbiAgICAgICAgICAgICAgICA6IHtcclxuICAgICAgICAgICAgICAgICAgICAgIGRlbGF5OiBzZXR0aW5ncy5hdXRvcGxheSxcclxuICAgICAgICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAgbmF2aWdhdGlvbjogIXNldHRpbmdzLm5hdmlnYXRpb25cclxuICAgICAgICAgICAgICAgID8gZmFsc2VcclxuICAgICAgICAgICAgICAgIDoge1xyXG4gICAgICAgICAgICAgICAgICAgICAgbmV4dEVsOiBzZXR0aW5ncy5zZWxlY3RvcnMuY2Fyb3VzZWxOZXh0QnRuLFxyXG4gICAgICAgICAgICAgICAgICAgICAgcHJldkVsOiBzZXR0aW5ncy5zZWxlY3RvcnMuY2Fyb3VzZWxQcmV2QnRuLFxyXG4gICAgICAgICAgICAgICAgICB9LFxyXG4gICAgICAgICAgICBwYWdpbmF0aW9uOiAhc2V0dGluZ3MucGFnaW5hdGlvblxyXG4gICAgICAgICAgICAgICAgPyBmYWxzZVxyXG4gICAgICAgICAgICAgICAgOiB7XHJcbiAgICAgICAgICAgICAgICAgICAgICBlbDogc2V0dGluZ3Muc2VsZWN0b3JzLmNhcm91c2VsUGFnaW5hdGlvbixcclxuICAgICAgICAgICAgICAgICAgICAgIGNsaWNrYWJsZTogdHJ1ZSxcclxuICAgICAgICAgICAgICAgICAgfSxcclxuICAgICAgICB9O1xyXG5cclxuICAgICAgICBpZiAoc2V0dGluZ3MuZWZmZWN0ID09PSBcImZhZGVcIikge1xyXG4gICAgICAgICAgICBzd2lwZXJPcHRpb25zLml0ZW1zID0gMTtcclxuICAgICAgICB9IGVsc2Uge1xyXG4gICAgICAgICAgICBzd2lwZXJPcHRpb25zLmJyZWFrcG9pbnRzID0ge1xyXG4gICAgICAgICAgICAgICAgMTAyNDoge1xyXG4gICAgICAgICAgICAgICAgICAgIHNsaWRlc1BlclZpZXc6IHNldHRpbmdzLnNsaWRlc1BlclZpZXcuZGVza3RvcCxcclxuICAgICAgICAgICAgICAgICAgICBzbGlkZXNQZXJHcm91cDogc2V0dGluZ3Muc2xpZGVzUGVyR3JvdXAuZGVza3RvcCxcclxuICAgICAgICAgICAgICAgICAgICBzcGFjZUJldHdlZW46IHNldHRpbmdzLnNwYWNlQmV0d2Vlbi5kZXNrdG9wLFxyXG4gICAgICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAgICAgIDc2ODoge1xyXG4gICAgICAgICAgICAgICAgICAgIHNsaWRlc1BlclZpZXc6IHNldHRpbmdzLnNsaWRlc1BlclZpZXcudGFibGV0LFxyXG4gICAgICAgICAgICAgICAgICAgIHNsaWRlc1Blckdyb3VwOiBzZXR0aW5ncy5zbGlkZXNQZXJHcm91cC50YWJsZXQsXHJcbiAgICAgICAgICAgICAgICAgICAgc3BhY2VCZXR3ZWVuOiBzZXR0aW5ncy5zcGFjZUJldHdlZW4udGFibGV0LFxyXG4gICAgICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAgICAgIDMyMDoge1xyXG4gICAgICAgICAgICAgICAgICAgIHNsaWRlc1BlclZpZXc6IHNldHRpbmdzLnNsaWRlc1BlclZpZXcubW9iaWxlLFxyXG4gICAgICAgICAgICAgICAgICAgIHNsaWRlc1Blckdyb3VwOiBzZXR0aW5ncy5zbGlkZXNQZXJHcm91cC5tb2JpbGUsXHJcbiAgICAgICAgICAgICAgICAgICAgc3BhY2VCZXR3ZWVuOiBzZXR0aW5ncy5zcGFjZUJldHdlZW4ubW9iaWxlLFxyXG4gICAgICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAgfTtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIHJldHVybiBzd2lwZXJPcHRpb25zO1xyXG4gICAgfVxyXG5cclxuICAgIHNldHVwRXZlbnRMaXN0ZW5lcnMoKSB7XHJcbiAgICAgICAgaWYgKHRoaXMuZ2V0U2V0dGluZ3MoXCJwYXVzZU9uSG92ZXJcIikpIHtcclxuICAgICAgICAgICAgdGhpcy5lbGVtZW50cy5jYXJvdXNlbC5hZGRFdmVudExpc3RlbmVyKFwibW91c2VlbnRlclwiLCB0aGlzLnBhdXNlU3dpcGVyLmJpbmQodGhpcykpO1xyXG4gICAgICAgICAgICB0aGlzLmVsZW1lbnRzLmNhcm91c2VsLmFkZEV2ZW50TGlzdGVuZXIoXCJtb3VzZWxlYXZlXCIsIHRoaXMucmVzdW1lU3dpcGVyLmJpbmQodGhpcykpO1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICBwYXVzZVN3aXBlcihldmVudCkge1xyXG4gICAgICAgIHRoaXMuZ2V0U2V0dGluZ3MoXCJzd2lwZXJJbnN0YW5jZVwiKS5hdXRvcGxheS5zdG9wKCk7XHJcbiAgICB9XHJcblxyXG4gICAgcmVzdW1lU3dpcGVyKGV2ZW50KSB7XHJcbiAgICAgICAgdGhpcy5nZXRTZXR0aW5ncyhcInN3aXBlckluc3RhbmNlXCIpLmF1dG9wbGF5LnN0YXJ0KCk7XHJcbiAgICB9XHJcbn1cclxuXHJcbmV4cG9ydCBkZWZhdWx0IE9FV19DYXJvdXNlbDtcclxuIiwiaW1wb3J0IHsgcmVnaXN0ZXJXaWRnZXQgfSBmcm9tIFwiLi4vbGliL3V0aWxzXCI7XHJcbmltcG9ydCBPRVdfQ2Fyb3VzZWwgZnJvbSBcIi4vYmFzZS9jYXJvdXNlbFwiO1xyXG5cclxuY2xhc3MgT0VXX1dvb1NsaWRlciBleHRlbmRzIE9FV19DYXJvdXNlbCB7fVxyXG5cclxucmVnaXN0ZXJXaWRnZXQoT0VXX1dvb1NsaWRlciwgXCJvZXctd29vLXNsaWRlclwiKTtcclxuIl19
