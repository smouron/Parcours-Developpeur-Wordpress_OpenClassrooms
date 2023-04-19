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

var _utils = require("../lib/utils");

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

var OEW_SearchIcon = /*#__PURE__*/function (_elementorModules$fro) {
  _inherits(OEW_SearchIcon, _elementorModules$fro);

  var _super = _createSuper(OEW_SearchIcon);

  function OEW_SearchIcon() {
    _classCallCheck(this, OEW_SearchIcon);

    return _super.apply(this, arguments);
  }

  _createClass(OEW_SearchIcon, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        selectors: {
          dropdownSearch: ".oew-search-dropdown",
          dropdownSearchIcon: ".oew-search-icon-dropdown",
          dropdownSearchIconLink: ".oew-dropdown-link",
          dropdownSearchInput: ".oew-search-dropdown input.field",
          overlaySearch: ".oew-search-overlay",
          overlaySearchForm: ".oew-search-overlay form",
          overlaySearchIcon: ".oew-search-icon-overlay",
          overlaySearchIconLink: "a.oew-overlay-link",
          overlaySearchInput: "input.oew-search-overlay-input",
          overlaySearchCloseBtn: "a.oew-search-overlay-close"
        }
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var element = this.$element.get(0);
      var selectors = this.getSettings("selectors");
      return {
        dropdownSearch: element.querySelector(selectors.dropdownSearch),
        dropdownSearchIcon: element.querySelector(selectors.dropdownSearchIcon),
        dropdownSearchIconLink: element.querySelector(selectors.dropdownSearchIconLink),
        dropdownSearchInput: element.querySelector(selectors.dropdownSearchInput),
        overlaySearch: element.querySelector(selectors.overlaySearch),
        overlaySearchForm: element.querySelector(selectors.overlaySearchForm),
        overlaySearchIcon: element.querySelector(selectors.overlaySearchIcon),
        overlaySearchIconLink: element.querySelector(selectors.overlaySearchIconLink),
        overlaySearchInput: element.querySelector(selectors.overlaySearchInput),
        overlaySearchCloseBtn: element.querySelector(selectors.overlaySearchCloseBtn)
      };
    }
  }, {
    key: "onInit",
    value: function onInit() {
      var _get2;

      for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
        args[_key] = arguments[_key];
      }

      (_get2 = _get(_getPrototypeOf(OEW_SearchIcon.prototype), "onInit", this)).call.apply(_get2, [this].concat(args));

      if (this.getSearchType() === "overlay") {
        this.initOverlaySearch();
      }

      this.setupEventListeners();
    }
  }, {
    key: "initOverlaySearch",
    value: function initOverlaySearch() {
      var _this = this;

      document.querySelectorAll("#oew-search-".concat(this.getID())).forEach(function (overlaySearch) {
        if (_this.elements.overlaySearch !== overlaySearch) {
          overlaySearch.remove();
        }
      });
      document.body.insertAdjacentElement("beforeend", this.elements.overlaySearch);

      if (this.elements.overlaySearchInput.value.length) {
        this.elements.overlaySearchForm.classList.add("search-filled");
      }
    }
  }, {
    key: "setupEventListeners",
    value: function setupEventListeners() {
      if (this.getSearchType() === "overlay") {
        this.elements.overlaySearchIconLink.addEventListener("click", this.openOverlaySearch.bind(this));
        this.elements.overlaySearchCloseBtn.addEventListener("click", this.closeOverlaySearch.bind(this));
        this.elements.overlaySearchInput.addEventListener("keyup", this.toggleInputPlaceholder.bind(this));
        this.elements.overlaySearchInput.addEventListener("blur", this.toggleInputPlaceholder.bind(this));
      } else {
        this.elements.dropdownSearchIconLink.addEventListener("click", this.toggleDropdownSearch.bind(this));
        document.addEventListener("click", this.onDocumentClick.bind(this));
      }
    }
  }, {
    key: "toggleDropdownSearch",
    value: function toggleDropdownSearch(event) {
      event.preventDefault();
      event.stopPropagation();
      (0, _utils.fadeToggle)(this.elements.dropdownSearch, {
        duration: 200
      });
      this.elements.dropdownSearchIcon.classList.toggle("active");
      this.elements.dropdownSearchInput.focus();
    }
  }, {
    key: "openOverlaySearch",
    value: function openOverlaySearch(event) {
      event.preventDefault();
      this.elements.overlaySearch.classList.add("active");
      (0, _utils.fadeIn)(this.elements.overlaySearch, {
        duration: 200
      });
      this.elements.overlaySearchInput.focus();
      setTimeout(function () {
        document.querySelector("html").style.overflow = "hidden";
      }, 400);
    }
  }, {
    key: "closeOverlaySearch",
    value: function closeOverlaySearch(event) {
      event.preventDefault();
      this.elements.overlaySearch.classList.remove("active");

      if (jQuery(this.elements.overlaySearch).is(':visible')) {
        (0, _utils.fadeOut)(this.elements.overlaySearch, {
          duration: 200
        });
      }

      setTimeout(function () {
        document.querySelector("html").style.overflow = "visible";
      }, 400);
    }
  }, {
    key: "toggleInputPlaceholder",
    value: function toggleInputPlaceholder(event) {
      if (this.elements.overlaySearchInput && this.elements.overlaySearchInput.value.length > 0) {
        this.elements.overlaySearchForm.classList.add("search-filled");
      } else {
        this.elements.overlaySearchForm.classList.remove("search-filled");
      }
    }
  }, {
    key: "onDocumentClick",
    value: function onDocumentClick(event) {
      // Close Dropdown Search
      if (!event.target.closest(this.getSettings("selectors.dropdownSearch"))) {
        this.elements.dropdownSearchIcon.classList.remove("show");

        if (jQuery(this.elements.dropdownSearch).is(':visible')) {
          (0, _utils.fadeOut)(this.elements.dropdownSearch, {
            duration: 200
          });
        }
      }
    }
  }, {
    key: "getSearchType",
    value: function getSearchType() {
      return !!this.elements.overlaySearchIcon ? "overlay" : "dropdown";
    }
  }]);

  return OEW_SearchIcon;
}(elementorModules.frontend.handlers.Base);

(0, _utils.registerWidget)(OEW_SearchIcon, "oew-search-icon");

},{"../lib/utils":1}]},{},[2])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJhc3NldHMvc3JjL2pzL2xpYi91dGlscy5qcyIsImFzc2V0cy9zcmMvanMvd2lkZ2V0cy9zZWFyY2gtaWNvbi5qcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTs7Ozs7Ozs7OztBQ0FPLElBQU0sU0FBUyxHQUFHLFNBQVosU0FBWSxDQUFDLE9BQUQsRUFBNkI7QUFBQSxNQUFuQixRQUFtQix1RUFBUixHQUFRO0FBQ2xELE1BQUksT0FBTyxHQUFHLE1BQU0sQ0FBQyxnQkFBUCxDQUF3QixPQUF4QixFQUFpQyxPQUEvQzs7QUFFQSxNQUFJLE9BQU8sS0FBSyxNQUFoQixFQUF3QjtBQUNwQixJQUFBLE9BQU8sR0FBRyxPQUFWO0FBQ0g7O0FBRUQsRUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLGtCQUFkLEdBQW1DLFFBQW5DO0FBQ0EsRUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLGtCQUFkLGFBQXNDLFFBQXRDO0FBRUEsRUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLE9BQWQsR0FBd0IsQ0FBeEI7QUFDQSxFQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsT0FBZCxHQUF3QixPQUF4QjtBQUNBLE1BQUksTUFBTSxHQUFHLE9BQU8sQ0FBQyxZQUFyQjtBQUVBLEVBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxNQUFkLEdBQXVCLENBQXZCO0FBQ0EsRUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLE9BQWQsR0FBd0IsQ0FBeEI7QUFDQSxFQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsUUFBZCxHQUF5QixRQUF6QjtBQUVBLEVBQUEsVUFBVSxDQUFDLFlBQU07QUFDYixJQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsTUFBZCxhQUEwQixNQUExQjtBQUNILEdBRlMsRUFFUCxDQUZPLENBQVY7QUFJQSxFQUFBLE1BQU0sQ0FBQyxVQUFQLENBQWtCLFlBQU07QUFDcEIsSUFBQSxPQUFPLENBQUMsS0FBUixDQUFj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UUFBMUIsQ0FBbUMsSTs7QUF3SWhFLDJCQUFlLGNBQWYsRUFBK0IsaUJBQS9CIiwiZmlsZSI6ImdlbmVyYXRlZC5qcyIsInNvdXJjZVJvb3QiOiIiLCJzb3VyY2VzQ29udGVudCI6WyIoZnVuY3Rpb24oKXtmdW5jdGlvbiByKGUsbix0KXtmdW5jdGlvbiBvKGksZil7aWYoIW5baV0pe2lmKCFlW2ldKXt2YXIgYz1cImZ1bmN0aW9uXCI9PXR5cGVvZiByZXF1aXJlJiZyZXF1aXJlO2lmKCFmJiZjKXJldHVybiBjKGksITApO2lmKHUpcmV0dXJuIHUoaSwhMCk7dmFyIGE9bmV3IEVycm9yKFwiQ2Fubm90IGZpbmQgbW9kdWxlICdcIitpK1wiJ1wiKTt0aHJvdyBhLmNvZGU9XCJNT0RVTEVfTk9UX0ZPVU5EXCIsYX12YXIgcD1uW2ldPXtleHBvcnRzOnt9fTtlW2ldWzBdLmNhbGwocC5leHBvcnRzLGZ1bmN0aW9uKHIpe3ZhciBuPWVbaV1bMV1bcl07cmV0dXJuIG8obnx8cil9LHAscC5leHBvcnRzLHIsZSxuLHQpfXJldHVybiBuW2ldLmV4cG9ydHN9Zm9yKHZhciB1PVwiZnVuY3Rpb25cIj09dHlwZW9mIHJlcXVpcmUmJnJlcXVpcmUsaT0wO2k8dC5sZW5ndGg7aSsrKW8odFtpXSk7cmV0dXJuIG99cmV0dXJuIHJ9KSgpIiwiZXhwb3J0IGNvbnN0IHNsaWRlRG93biA9IChlbGVtZW50LCBkdXJhdGlvbiA9IDMwMCkgPT4ge1xyXG4gICAgbGV0IGRpc3BsYXkgPSB3aW5kb3cuZ2V0Q29tcHV0ZWRTdHlsZShlbGVtZW50KS5kaXNwbGF5O1xyXG5cclxuICAgIGlmIChkaXNwbGF5ID09PSBcIm5vbmVcIikge1xyXG4gICAgICAgIGRpc3BsYXkgPSBcImJsb2NrXCI7XHJcbiAgICB9XHJcblxyXG4gICAgZWxlbWVudC5zdHlsZS50cmFuc2l0aW9uUHJvcGVydHkgPSBcImhlaWdodFwiO1xyXG4gICAgZWxlbWVudC5zdHlsZS50cmFuc2l0aW9uRHVyYXRpb24gPSBgJHtkdXJhdGlvbn1tc2A7XHJcblxyXG4gICAgZWxlbWVudC5zdHlsZS5vcGFjaXR5ID0gMDtcclxuICAgIGVsZW1lbnQuc3R5bGUuZGlzcGxheSA9IGRpc3BsYXk7XHJcbiAgICBsZXQgaGVpZ2h0ID0gZWxlbWVudC5vZmZzZXRIZWlnaHQ7XHJcblxyXG4gICAgZWxlbWVudC5zdHlsZS5oZWlnaHQgPSAwO1xyXG4gICAgZWxlbWVudC5zdHlsZS5vcGFjaXR5ID0gMTtcclxuICAgIGVsZW1lbnQuc3R5bGUub3ZlcmZsb3cgPSBcImhpZGRlblwiO1xyXG5cclxuICAgIHNldFRpbWVvdXQoKCkgPT4ge1xyXG4gICAgICAgIGVsZW1lbnQuc3R5bGUuaGVpZ2h0ID0gYCR7aGVpZ2h0fXB4YDtcclxuICAgIH0sIDUpO1xyXG5cclxuICAgIHdpbmRvdy5zZXRUaW1lb3V0KCgpID0+IHtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwiaGVpZ2h0XCIpO1xyXG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJvdmVyZmxvd1wiKTtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwidHJhbnNpdGlvbi1kdXJhdGlvblwiKTtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwidHJhbnNpdGlvbi1wcm9wZXJ0eVwiKTtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwib3BhY2l0eVwiKTtcclxuICAgIH0sIGR1cmF0aW9uICsgNTApO1xyXG59O1xyXG5cclxuZXhwb3J0IGNvbnN0IHNsaWRlVXAgPSAoZWxlbWVudCwgZHVyYXRpb24gPSAzMDApID0+IHtcclxuICAgIGVsZW1lbnQuc3R5bGUuYm94U2l6aW5nID0gXCJib3JkZXItYm94XCI7XHJcbiAgICBlbGVtZW50LnN0eWxlLnRyYW5zaXRpb25Qcm9wZXJ0eSA9IFwiaGVpZ2h0LCBtYXJnaW5cIjtcclxuICAgIGVsZW1lbnQuc3R5bGUudHJhbnNpdGlvbkR1cmF0aW9uID0gYCR7ZHVyYXRpb259bXNgO1xyXG4gICAgZWxlbWVudC5zdHlsZS5oZWlnaHQgPSBgJHtlbGVtZW50Lm9mZnNldEhlaWdodH1weGA7XHJcbiAgICBlbGVtZW50LnN0eWxlLm1hcmdpblRvcCA9IDA7XHJcbiAgICBlbGVtZW50LnN0eWxlLm1hcmdpbkJvdHRvbSA9IDA7XHJcbiAgICBlbGVtZW50LnN0eWxlLm92ZXJmbG93ID0gXCJoaWRkZW5cIjtcclxuXHJcbiAgICBzZXRUaW1lb3V0KCgpID0+IHtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLmhlaWdodCA9IDA7XHJcbiAgICB9LCA1KTtcclxuXHJcbiAgICB3aW5kb3cuc2V0VGltZW91dCgoKSA9PiB7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5kaXNwbGF5ID0gXCJub25lXCI7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcImhlaWdodFwiKTtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwibWFyZ2luLXRvcFwiKTtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwibWFyZ2luLWJvdHRvbVwiKTtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwib3ZlcmZsb3dcIik7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcInRyYW5zaXRpb24tZHVyYXRpb25cIik7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcInRyYW5zaXRpb24tcHJvcGVydHlcIik7XHJcbiAgICB9LCBkdXJhdGlvbiArIDUwKTtcclxufTtcclxuXHJcbmV4cG9ydCBjb25zdCBzbGlkZVRvZ2dsZSA9IChlbGVtZW50LCBkdXJhdGlvbikgPT4ge1xyXG4gICAgd2luZG93LmdldENvbXB1dGVkU3R5bGUoZWxlbWVudCkuZGlzcGxheSA9PT0gXCJub25lXCIgPyBzbGlkZURvd24oZWxlbWVudCwgZHVyYXRpb24pIDogc2xpZGVVcChlbGVtZW50LCBkdXJhdGlvbik7XHJcbn07XHJcblxyXG5leHBvcnQgY29uc3QgZmFkZUluID0gKGVsZW1lbnQsIF9vcHRpb25zID0ge30pID0+IHtcclxuICAgIGNvbnN0IG9wdGlvbnMgPSB7XHJcbiAgICAgICAgZHVyYXRpb246IDMwMCxcclxuICAgICAgICBkaXNwbGF5OiBudWxsLFxyXG4gICAgICAgIG9wYWNpdHk6IDEsXHJcbiAgICAgICAgY2FsbGJhY2s6IG51bGwsXHJcbiAgICB9O1xyXG5cclxuICAgIE9iamVjdC5hc3NpZ24ob3B0aW9ucywgX29wdGlvbnMpO1xyXG5cclxuICAgIGVsZW1lbnQuc3R5bGUub3BhY2l0eSA9IDA7XHJcbiAgICBlbGVtZW50LnN0eWxlLmRpc3BsYXkgPSBvcHRpb25zLmRpc3BsYXkgfHwgXCJibG9ja1wiO1xyXG5cclxuICAgIHNldFRpbWVvdXQoKCkgPT4ge1xyXG4gICAgICAgIGVsZW1lbnQuc3R5bGUudHJhbnNpdGlvbiA9IGAke29wdGlvbnMuZHVyYXRpb259bXMgb3BhY2l0eSBlYXNlYDtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLm9wYWNpdHkgPSBvcHRpb25zLm9wYWNpdHk7XHJcbiAgICB9LCA1KTtcclxuXHJcbiAgICBzZXRUaW1lb3V0KCgpID0+IHtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwidHJhbnNpdGlvblwiKTtcclxuICAgICAgICAhIW9wdGlvbnMuY2FsbGJhY2sgJiYgb3B0aW9ucy5jYWxsYmFjaygpO1xyXG4gICAgfSwgb3B0aW9ucy5kdXJhdGlvbiArIDUwKTtcclxufTtcclxuXHJcbmV4cG9ydCBjb25zdCBmYWRlT3V0ID0gKGVsZW1lbnQsIF9vcHRpb25zID0ge30pID0+IHtcclxuICAgIGNvbnN0IG9wdGlvbnMgPSB7XHJcbiAgICAgICAgZHVyYXRpb246IDMwMCxcclxuICAgICAgICBkaXNwbGF5OiBudWxsLFxyXG4gICAgICAgIG9wYWNpdHk6IDAsXHJcbiAgICAgICAgY2FsbGJhY2s6IG51bGwsXHJcbiAgICB9O1xyXG5cclxuICAgIE9iamVjdC5hc3NpZ24ob3B0aW9ucywgX29wdGlvbnMpO1xyXG5cclxuICAgIGVsZW1lbnQuc3R5bGUub3BhY2l0eSA9IDE7XHJcbiAgICBlbGVtZW50LnN0eWxlLmRpc3BsYXkgPSBvcHRpb25zLmRpc3BsYXkgfHwgXCJibG9ja1wiO1xyXG5cclxuICAgIHNldFRpbWVvdXQoKCkgPT4ge1xyXG4gICAgICAgIGVsZW1lbnQuc3R5bGUudHJhbnNpdGlvbiA9IGAke29wdGlvbnMuZHVyYXRpb259bXMgb3BhY2l0eSBlYXNlYDtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLm9wYWNpdHkgPSBvcHRpb25zLm9wYWNpdHk7XHJcbiAgICB9LCA1KTtcclxuXHJcbiAgICBzZXRUaW1lb3V0KCgpID0+IHtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLmRpc3BsYXkgPSBcIm5vbmVcIjtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwidHJhbnNpdGlvblwiKTtcclxuICAgICAgICAhIW9wdGlvbnMuY2FsbGJhY2sgJiYgb3B0aW9ucy5jYWxsYmFjaygpO1xyXG4gICAgfSwgb3B0aW9ucy5kdXJhdGlvbiArIDUwKTtcclxufTtcclxuXHJcbmV4cG9ydCBjb25zdCBmYWRlVG9nZ2xlID0gKGVsZW1lbnQsIG9wdGlvbnMpID0+IHtcclxuICAgIHdpbmRvdy5nZXRDb21wdXRlZFN0eWxlKGVsZW1lbnQpLmRpc3BsYXkgPT09IFwibm9uZVwiID8gZmFkZUluKGVsZW1lbnQsIG9wdGlvbnMpIDogZmFkZU91dChlbGVtZW50LCBvcHRpb25zKTtcclxufTtcclxuXHJcbmV4cG9ydCBjb25zdCBvZmZzZXQgPSAoZWxlbWVudCkgPT4ge1xyXG4gICAgaWYgKCFlbGVtZW50LmdldENsaWVudFJlY3RzKCkubGVuZ3RoKSB7XHJcbiAgICAgICAgcmV0dXJuIHsgdG9wOiAwLCBsZWZ0OiAwIH07XHJcbiAgICB9XHJcblxyXG4gICAgLy8gR2V0IGRvY3VtZW50LXJlbGF0aXZlIHBvc2l0aW9uIGJ5IGFkZGluZyB2aWV3cG9ydCBzY3JvbGwgdG8gdmlld3BvcnQtcmVsYXRpdmUgZ0JDUlxyXG4gICAgY29uc3QgcmVjdCA9IGVsZW1lbnQuZ2V0Qm91bmRpbmdDbGllbnRSZWN0KCk7XHJcbiAgICBjb25zdCB3aW4gPSBlbGVtZW50Lm93bmVyRG9jdW1lbnQuZGVmYXVsdFZpZXc7XHJcbiAgICByZXR1cm4ge1xyXG4gICAgICAgIHRvcDogcmVjdC50b3AgKyB3aW4ucGFnZVlPZmZzZXQsXHJcbiAgICAgICAgbGVmdDogcmVjdC5sZWZ0ICsgd2luLnBhZ2VYT2Zmc2V0LFxyXG4gICAgfTtcclxufTtcclxuXHJcbmV4cG9ydCBjb25zdCB2aXNpYmxlID0gKGVsZW1lbnQpID0+IHtcclxuICAgIGlmICghZWxlbWVudCkge1xyXG4gICAgICAgIHJldHVybiBmYWxzZTtcclxuICAgIH1cclxuXHJcbiAgICByZXR1cm4gISEoZWxlbWVudC5vZmZzZXRXaWR0aCB8fCBlbGVtZW50Lm9mZnNldEhlaWdodCB8fCBlbGVtZW50LmdldENsaWVudFJlY3RzKCkubGVuZ3RoKTtcclxufTtcclxuXHJcbmV4cG9ydCBjb25zdCBnZXRTaWJsaW5ncyA9IChlKSA9PiB7XHJcbiAgICAvLyBmb3IgY29sbGVjdGluZyBzaWJsaW5nc1xyXG4gICAgY29uc3Qgc2libGluZ3MgPSBbXTtcclxuXHJcbiAgICAvLyBpZiBubyBwYXJlbnQsIHJldHVybiBubyBzaWJsaW5nXHJcbiAgICBpZiAoIWUucGFyZW50Tm9kZSkge1xyXG4gICAgICAgIHJldHVybiBzaWJsaW5ncztcclxuICAgIH1cclxuXHJcbiAgICAvLyBmaXJzdCBjaGlsZCBvZiB0aGUgcGFyZW50IG5vZGVcclxuICAgIGxldCBzaWJsaW5nID0gZS5wYXJlbnROb2RlLmZpcnN0Q2hpbGQ7XHJcblxyXG4gICAgLy8gY29sbGVjdGluZyBzaWJsaW5nc1xyXG4gICAgd2hpbGUgKHNpYmxpbmcpIHtcclxuICAgICAgICBpZiAoc2libGluZy5ub2RlVHlwZSA9PT0gMSAmJiBzaWJsaW5nICE9PSBlKSB7XHJcbiAgICAgICAgICAgIHNpYmxpbmdzLnB1c2goc2libGluZyk7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICBzaWJsaW5nID0gc2libGluZy5uZXh0U2libGluZztcclxuICAgIH1cclxuXHJcbiAgICByZXR1cm4gc2libGluZ3M7XHJcbn07XHJcblxyXG4vLyBSZXR1cm5zIHRydWUgaWYgaXQgaXMgYSBET00gZWxlbWVudFxyXG5leHBvcnQgY29uc3QgaXNFbGVtZW50ID0gKG8pID0+IHtcclxuICAgIHJldHVybiB0eXBlb2YgSFRNTEVsZW1lbnQgPT09IFwib2JqZWN0XCJcclxuICAgICAgICA/IG8gaW5zdGFuY2VvZiBIVE1MRWxlbWVudCAvLyBET00yXHJcbiAgICAgICAgOiBvICYmIHR5cGVvZiBvID09PSBcIm9iamVjdFwiICYmIG8gIT09IG51bGwgJiYgby5ub2RlVHlwZSA9PT0gMSAmJiB0eXBlb2Ygby5ub2RlTmFtZSA9PT0gXCJzdHJpbmdcIjtcclxufTtcclxuXHJcbmV4cG9ydCBjb25zdCByZWdpc3RlcldpZGdldCA9IChjbGFzc05hbWUsIHdpZGdldE5hbWUsIHNraW4gPSBcImRlZmF1bHRcIikgPT4ge1xyXG4gICAgaWYgKCEoY2xhc3NOYW1lIHx8IHdpZGdldE5hbWUpKSB7XHJcbiAgICAgICAgcmV0dXJuO1xyXG4gICAgfVxyXG5cclxuICAgIC8qKlxyXG4gICAgICogQmVjYXVzZSBFbGVtZW50b3IgcGx1Z2luIHVzZXMgalF1ZXJ5IGN1c3RvbSBldmVudCxcclxuICAgICAqIFdlIGFsc28gaGF2ZSB0byB1c2UgalF1ZXJ5IHRvIHVzZSB0aGlzIGV2ZW50XHJcbiAgICAgKi9cclxuICAgIGpRdWVyeSh3aW5kb3cpLm9uKFwiZWxlbWVudG9yL2Zyb250ZW5kL2luaXRcIiwgKCkgPT4ge1xyXG4gICAgICAgIGNvbnN0IGFkZEhhbmRsZXIgPSAoJGVsZW1lbnQpID0+IHtcclxuICAgICAgICAgICAgZWxlbWVudG9yRnJvbnRlbmQuZWxlbWVudHNIYW5kbGVyLmFkZEhhbmRsZXIoY2xhc3NOYW1lLCB7XHJcbiAgICAgICAgICAgICAgICAkZWxlbWVudCxcclxuICAgICAgICAgICAgfSk7XHJcbiAgICAgICAgfTtcclxuXHJcbiAgICAgICAgZWxlbWVudG9yRnJvbnRlbmQuaG9va3MuYWRkQWN0aW9uKGBmcm9udGVuZC9lbGVtZW50X3JlYWR5LyR7d2lkZ2V0TmFtZX0uJHtza2lufWAsIGFkZEhhbmRsZXIpO1xyXG4gICAgfSk7XHJcbn07XHJcbiIsImltcG9ydCB7IGZhZGVJbiwgZmFkZU91dCwgZmFkZVRvZ2dsZSwgcmVnaXN0ZXJXaWRnZXQgfSBmcm9tIFwiLi4vbGliL3V0aWxzXCI7XG5cbmNsYXNzIE9FV19TZWFyY2hJY29uIGV4dGVuZHMgZWxlbWVudG9yTW9kdWxlcy5mcm9udGVuZC5oYW5kbGVycy5CYXNlIHtcbiAgICBnZXREZWZhdWx0U2V0dGluZ3MoKSB7XG4gICAgICAgIHJldHVybiB7XG4gICAgICAgICAgICBzZWxlY3RvcnM6IHtcbiAgICAgICAgICAgICAgICBkcm9wZG93blNlYXJjaDogXCIub2V3LXNlYXJjaC1kcm9wZG93blwiLFxuICAgICAgICAgICAgICAgIGRyb3Bkb3duU2VhcmNoSWNvbjogXCIub2V3LXNlYXJjaC1pY29uLWRyb3Bkb3duXCIsXG4gICAgICAgICAgICAgICAgZHJvcGRvd25TZWFyY2hJY29uTGluazogXCIub2V3LWRyb3Bkb3duLWxpbmtcIixcbiAgICAgICAgICAgICAgICBkcm9wZG93blNlYXJjaElucHV0OiBcIi5vZXctc2VhcmNoLWRyb3Bkb3duIGlucHV0LmZpZWxkXCIsXG4gICAgICAgICAgICAgICAgb3ZlcmxheVNlYXJjaDogXCIub2V3LXNlYXJjaC1vdmVybGF5XCIsXG4gICAgICAgICAgICAgICAgb3ZlcmxheVNlYXJjaEZvcm06IFwiLm9ldy1zZWFyY2gtb3ZlcmxheSBmb3JtXCIsXG4gICAgICAgICAgICAgICAgb3ZlcmxheVNlYXJjaEljb246IFwiLm9ldy1zZWFyY2gtaWNvbi1vdmVybGF5XCIsXG4gICAgICAgICAgICAgICAgb3ZlcmxheVNlYXJjaEljb25MaW5rOiBcImEub2V3LW92ZXJsYXktbGlua1wiLFxuICAgICAgICAgICAgICAgIG92ZXJsYXlTZWFyY2hJbnB1dDogXCJpbnB1dC5vZXctc2VhcmNoLW92ZXJsYXktaW5wdXRcIixcbiAgICAgICAgICAgICAgICBvdmVybGF5U2VhcmNoQ2xvc2VCdG46IFwiYS5vZXctc2VhcmNoLW92ZXJsYXktY2xvc2VcIixcbiAgICAgICAgICAgIH0sXG4gICAgICAgIH07XG4gICAgfVxuXG4gICAgZ2V0RGVmYXVsdEVsZW1lbnRzKCkge1xuICAgICAgICBjb25zdCBlbGVtZW50ID0gdGhpcy4kZWxlbWVudC5nZXQoMCk7XG4gICAgICAgIGNvbnN0IHNlbGVjdG9ycyA9IHRoaXMuZ2V0U2V0dGluZ3MoXCJzZWxlY3RvcnNcIik7XG5cbiAgICAgICAgcmV0dXJuIHtcbiAgICAgICAgICAgIGRyb3Bkb3duU2VhcmNoOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3Ioc2VsZWN0b3JzLmRyb3Bkb3duU2VhcmNoKSxcbiAgICAgICAgICAgIGRyb3Bkb3duU2VhcmNoSWNvbjogZWxlbWVudC5xdWVyeVNlbGVjdG9yKHNlbGVjdG9ycy5kcm9wZG93blNlYXJjaEljb24pLFxuICAgICAgICAgICAgZHJvcGRvd25TZWFyY2hJY29uTGluazogZWxlbWVudC5xdWVyeVNlbGVjdG9yKHNlbGVjdG9ycy5kcm9wZG93blNlYXJjaEljb25MaW5rKSxcbiAgICAgICAgICAgIGRyb3Bkb3duU2VhcmNoSW5wdXQ6IGVsZW1lbnQucXVlcnlTZWxlY3RvcihzZWxlY3RvcnMuZHJvcGRvd25TZWFyY2hJbnB1dCksXG4gICAgICAgICAgICBvdmVybGF5U2VhcmNoOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3Ioc2VsZWN0b3JzLm92ZXJsYXlTZWFyY2gpLFxuICAgICAgICAgICAgb3ZlcmxheVNlYXJjaEZvcm06IGVsZW1lbnQucXVlcnlTZWxlY3RvcihzZWxlY3RvcnMub3ZlcmxheVNlYXJjaEZvcm0pLFxuICAgICAgICAgICAgb3ZlcmxheVNlYXJjaEljb246IGVsZW1lbnQucXVlcnlTZWxlY3RvcihzZWxlY3RvcnMub3ZlcmxheVNlYXJjaEljb24pLFxuICAgICAgICAgICAgb3ZlcmxheVNlYXJjaEljb25MaW5rOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3Ioc2VsZWN0b3JzLm92ZXJsYXlTZWFyY2hJY29uTGluayksXG4gICAgICAgICAgICBvdmVybGF5U2VhcmNoSW5wdXQ6IGVsZW1lbnQucXVlcnlTZWxlY3RvcihzZWxlY3RvcnMub3ZlcmxheVNlYXJjaElucHV0KSxcbiAgICAgICAgICAgIG92ZXJsYXlTZWFyY2hDbG9zZUJ0bjogZWxlbWVudC5xdWVyeVNlbGVjdG9yKHNlbGVjdG9ycy5vdmVybGF5U2VhcmNoQ2xvc2VCdG4pLFxuICAgICAgICB9O1xuICAgIH1cblxuICAgIG9uSW5pdCguLi5hcmdzKSB7XG4gICAgICAgIHN1cGVyLm9uSW5pdCguLi5hcmdzKTtcblxuICAgICAgICBpZiAodGhpcy5nZXRTZWFyY2hUeXBlKCkgPT09IFwib3ZlcmxheVwiKSB7XG4gICAgICAgICAgICB0aGlzLmluaXRPdmVybGF5U2VhcmNoKCk7XG4gICAgICAgIH1cblxuICAgICAgICB0aGlzLnNldHVwRXZlbnRMaXN0ZW5lcnMoKTtcbiAgICB9XG5cbiAgICBpbml0T3ZlcmxheVNlYXJjaCgpIHtcbiAgICAgICAgZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbChgI29ldy1zZWFyY2gtJHt0aGlzLmdldElEKCl9YCkuZm9yRWFjaCgob3ZlcmxheVNlYXJjaCkgPT4ge1xuICAgICAgICAgICAgaWYgKHRoaXMuZWxlbWVudHMub3ZlcmxheVNlYXJjaCAhPT0gb3ZlcmxheVNlYXJjaCkge1xuICAgICAgICAgICAgICAgIG92ZXJsYXlTZWFyY2gucmVtb3ZlKCk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH0pO1xuXG4gICAgICAgIGRvY3VtZW50LmJvZHkuaW5zZXJ0QWRqYWNlbnRFbGVtZW50KFwiYmVmb3JlZW5kXCIsIHRoaXMuZWxlbWVudHMub3ZlcmxheVNlYXJjaCk7XG5cbiAgICAgICAgaWYgKHRoaXMuZWxlbWVudHMub3ZlcmxheVNlYXJjaElucHV0LnZhbHVlLmxlbmd0aCkge1xuICAgICAgICAgICAgdGhpcy5lbGVtZW50cy5vdmVybGF5U2VhcmNoRm9ybS5jbGFzc0xpc3QuYWRkKFwic2VhcmNoLWZpbGxlZFwiKTtcbiAgICAgICAgfVxuICAgIH1cblxuICAgIHNldHVwRXZlbnRMaXN0ZW5lcnMoKSB7XG4gICAgICAgIGlmICh0aGlzLmdldFNlYXJjaFR5cGUoKSA9PT0gXCJvdmVybGF5XCIpIHtcbiAgICAgICAgICAgIHRoaXMuZWxlbWVudHMub3ZlcmxheVNlYXJjaEljb25MaW5rLmFkZEV2ZW50TGlzdGVuZXIoXCJjbGlja1wiLCB0aGlzLm9wZW5PdmVybGF5U2VhcmNoLmJpbmQodGhpcykpO1xuICAgICAgICAgICAgdGhpcy5lbGVtZW50cy5vdmVybGF5U2VhcmNoQ2xvc2VCdG4uYWRkRXZlbnRMaXN0ZW5lcihcImNsaWNrXCIsIHRoaXMuY2xvc2VPdmVybGF5U2VhcmNoLmJpbmQodGhpcykpO1xuICAgICAgICAgICAgdGhpcy5lbGVtZW50cy5vdmVybGF5U2VhcmNoSW5wdXQuYWRkRXZlbnRMaXN0ZW5lcihcImtleXVwXCIsIHRoaXMudG9nZ2xlSW5wdXRQbGFjZWhvbGRlci5iaW5kKHRoaXMpKTtcbiAgICAgICAgICAgIHRoaXMuZWxlbWVudHMub3ZlcmxheVNlYXJjaElucHV0LmFkZEV2ZW50TGlzdGVuZXIoXCJibHVyXCIsIHRoaXMudG9nZ2xlSW5wdXRQbGFjZWhvbGRlci5iaW5kKHRoaXMpKTtcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgIHRoaXMuZWxlbWVudHMuZHJvcGRvd25TZWFyY2hJY29uTGluay5hZGRFdmVudExpc3RlbmVyKFwiY2xpY2tcIiwgdGhpcy50b2dnbGVEcm9wZG93blNlYXJjaC5iaW5kKHRoaXMpKTtcbiAgICAgICAgICAgIGRvY3VtZW50LmFkZEV2ZW50TGlzdGVuZXIoXCJjbGlja1wiLCB0aGlzLm9uRG9jdW1lbnRDbGljay5iaW5kKHRoaXMpKTtcbiAgICAgICAgfVxuICAgIH1cblxuICAgIHRvZ2dsZURyb3Bkb3duU2VhcmNoKGV2ZW50KSB7XG4gICAgICAgIGV2ZW50LnByZXZlbnREZWZhdWx0KCk7XG4gICAgICAgIGV2ZW50LnN0b3BQcm9wYWdhdGlvbigpO1xuXG4gICAgICAgIGZhZGVUb2dnbGUodGhpcy5lbGVtZW50cy5kcm9wZG93blNlYXJjaCwge1xuICAgICAgICAgICAgZHVyYXRpb246IDIwMCxcbiAgICAgICAgfSk7XG4gICAgICAgIHRoaXMuZWxlbWVudHMuZHJvcGRvd25TZWFyY2hJY29uLmNsYXNzTGlzdC50b2dnbGUoXCJhY3RpdmVcIik7XG4gICAgICAgIHRoaXMuZWxlbWVudHMuZHJvcGRvd25TZWFyY2hJbnB1dC5mb2N1cygpO1xuICAgIH1cblxuICAgIG9wZW5PdmVybGF5U2VhcmNoKGV2ZW50KSB7XG4gICAgICAgIGV2ZW50LnByZXZlbnREZWZhdWx0KCk7XG5cbiAgICAgICAgdGhpcy5lbGVtZW50cy5vdmVybGF5U2VhcmNoLmNsYXNzTGlzdC5hZGQoXCJhY3RpdmVcIik7XG4gICAgICAgIGZhZGVJbih0aGlzLmVsZW1lbnRzLm92ZXJsYXlTZWFyY2gsIHtcbiAgICAgICAgICAgIGR1cmF0aW9uOiAyMDAsXG4gICAgICAgIH0pO1xuICAgICAgICB0aGlzLmVsZW1lbnRzLm92ZXJsYXlTZWFyY2hJbnB1dC5mb2N1cygpO1xuXG4gICAgICAgIHNldFRpbWVvdXQoKCkgPT4ge1xuICAgICAgICAgICAgZG9jdW1lbnQucXVlcnlTZWxlY3RvcihcImh0bWxcIikuc3R5bGUub3ZlcmZsb3cgPSBcImhpZGRlblwiO1xuICAgICAgICB9LCA0MDApO1xuICAgIH1cblxuICAgIGNsb3NlT3ZlcmxheVNlYXJjaChldmVudCkge1xuICAgICAgICBldmVudC5wcmV2ZW50RGVmYXVsdCgpO1xuXG4gICAgICAgIHRoaXMuZWxlbWVudHMub3ZlcmxheVNlYXJjaC5jbGFzc0xpc3QucmVtb3ZlKFwiYWN0aXZlXCIpO1xuICAgICAgICBpZiggalF1ZXJ5KHRoaXMuZWxlbWVudHMub3ZlcmxheVNlYXJjaCkuaXMoJzp2aXNpYmxlJykgKSB7XG4gICAgICAgICAgICBmYWRlT3V0KHRoaXMuZWxlbWVudHMub3ZlcmxheVNlYXJjaCwge1xuICAgICAgICAgICAgICAgIGR1cmF0aW9uOiAyMDAsXG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfVxuICAgICAgICBzZXRUaW1lb3V0KCgpID0+IHtcbiAgICAgICAgICAgIGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoXCJodG1sXCIpLnN0eWxlLm92ZXJmbG93ID0gXCJ2aXNpYmxlXCI7XG4gICAgICAgIH0sIDQwMCk7XG4gICAgfVxuXG4gICAgdG9nZ2xlSW5wdXRQbGFjZWhvbGRlcihldmVudCkge1xuICAgICAgICBpZiAodGhpcy5lbGVtZW50cy5vdmVybGF5U2VhcmNoSW5wdXQgJiYgdGhpcy5lbGVtZW50cy5vdmVybGF5U2VhcmNoSW5wdXQudmFsdWUubGVuZ3RoID4gMCkge1xuICAgICAgICAgICAgdGhpcy5lbGVtZW50cy5vdmVybGF5U2VhcmNoRm9ybS5jbGFzc0xpc3QuYWRkKFwic2VhcmNoLWZpbGxlZFwiKTtcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgIHRoaXMuZWxlbWVudHMub3ZlcmxheVNlYXJjaEZvcm0uY2xhc3NMaXN0LnJlbW92ZShcInNlYXJjaC1maWxsZWRcIik7XG4gICAgICAgIH1cbiAgICB9XG5cbiAgICBvbkRvY3VtZW50Q2xpY2soZXZlbnQpIHtcbiAgICAgICAgLy8gQ2xvc2UgRHJvcGRvd24gU2VhcmNoXG4gICAgICAgIGlmICghZXZlbnQudGFyZ2V0LmNsb3Nlc3QodGhpcy5nZXRTZXR0aW5ncyhcInNlbGVjdG9ycy5kcm9wZG93blNlYXJjaFwiKSkpIHtcbiAgICAgICAgICAgIHRoaXMuZWxlbWVudHMuZHJvcGRvd25TZWFyY2hJY29uLmNsYXNzTGlzdC5yZW1vdmUoXCJzaG93XCIpO1xuICAgICAgICAgICAgaWYoIGpRdWVyeSh0aGlzLmVsZW1lbnRzLmRyb3Bkb3duU2VhcmNoKS5pcygnOnZpc2libGUnKSApIHtcbiAgICAgICAgICAgICAgICBmYWRlT3V0KHRoaXMuZWxlbWVudHMuZHJvcGRvd25TZWFyY2gsIHtcbiAgICAgICAgICAgICAgICAgICAgZHVyYXRpb246IDIwMCxcbiAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfVxuICAgIH1cblxuICAgIGdldFNlYXJjaFR5cGUoKSB7XG4gICAgICAgIHJldHVybiAhIXRoaXMuZWxlbWVudHMub3ZlcmxheVNlYXJjaEljb24gPyBcIm92ZXJsYXlcIiA6IFwiZHJvcGRvd25cIjtcbiAgICB9XG59XG5cbnJlZ2lzdGVyV2lkZ2V0KE9FV19TZWFyY2hJY29uLCBcIm9ldy1zZWFyY2gtaWNvblwiKTtcbiJdfQ==
