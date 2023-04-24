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

var OEW_Accordion = /*#__PURE__*/function (_elementorModules$fro) {
  _inherits(OEW_Accordion, _elementorModules$fro);

  var _super = _createSuper(OEW_Accordion);

  function OEW_Accordion() {
    _classCallCheck(this, OEW_Accordion);

    return _super.apply(this, arguments);
  }

  _createClass(OEW_Accordion, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        selectors: {
          accordion: ".oew-accordion",
          accordionItem: ".oew-accordion-item",
          accordionTitle: ".oew-accordion-title",
          accordionContent: ".oew-accordion-content"
        },
        classes: {
          active: "oew-active"
        },
        activeItemIndex: null,
        multiExpand: false
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var element = this.$element.get(0);
      var selectors = this.getSettings("selectors");
      return {
        accordion: element.querySelector(selectors.accordion),
        accordionItems: element.querySelectorAll(selectors.accordionItem),
        accordionTitles: element.querySelectorAll(selectors.accordionTitle),
        accordionContents: element.querySelectorAll(selectors.accordionContent)
      };
    }
  }, {
    key: "onInit",
    value: function onInit() {
      var _get2;

      for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
        args[_key] = arguments[_key];
      }

      (_get2 = _get(_getPrototypeOf(OEW_Accordion.prototype), "onInit", this)).call.apply(_get2, [this].concat(args));

      this.setUserSettings();
      this.activateDefaultItem();
    }
  }, {
    key: "setUserSettings",
    value: function setUserSettings() {
      var settings = this.getSettings();
      var userSettings = JSON.parse(this.elements.accordion.getAttribute("data-settings"));
      this.setSettings({
        activeItemIndex: !!userSettings.active_item ? userSettings.active_item : settings.activeItemIndex,
        multiExpand: !!userSettings.multiple ? JSON.parse(userSettings.multiple) : settings.multiExpand
      });
    }
  }, {
    key: "activateDefaultItem",
    value: function activateDefaultItem() {
      var settings = this.getSettings();
      var selectors = settings.selectors;
      var activeItemIndex = settings.activeItemIndex;
      var activeClass = settings.classes.active;

      if (!activeItemIndex) {
        return;
      }

      var activeAccordionItem = this.elements.accordion.querySelector("".concat(selectors.accordionItem, ":nth-child(").concat(activeItemIndex, ")"));
      activeAccordionItem.classList.remove(activeClass);
      this.changeActiveItem(activeAccordionItem);
    }
  }, {
    key: "bindEvents",
    value: function bindEvents() {
      var _this = this;

      this.elements.accordionTitles.forEach(function (accordionTitle) {
        accordionTitle.addEventListener("click", _this.onTitleClick.bind(_this));
      });
    }
  }, {
    key: "onTitleClick",
    value: function onTitleClick(event) {
      var enableMultiExpand = this.getSettings("multiExpand");
      var accordionTitle = event.currentTarget;
      var accordionItem = accordionTitle.parentNode;

      if (!!enableMultiExpand) {
        this.toggleMultiExpandItem(accordionItem);
      } else {
        this.changeActiveItem(accordionItem);
      }
    }
  }, {
    key: "toggleMultiExpandItem",
    value: function toggleMultiExpandItem(accordionItem) {
      var activeClass = this.getSettings("classes.active");
      var accordionContent = this.getAccordionContent(accordionItem);
      accordionItem.classList.toggle(activeClass);
      (0, _utils.slideToggle)(accordionContent, 300);
    }
  }, {
    key: "changeActiveItem",
    value: function changeActiveItem(accordionItem) {
      var _this2 = this;

      if (this.isActiveItem(accordionItem)) {
        this.deactiveItem(accordionItem);
      } else {
        this.elements.accordionItems.forEach(function (_accordionItem) {
          if (_accordionItem !== accordionItem) {
            _this2.deactiveItem(_accordionItem);
          }
        });
        this.activateItem(accordionItem);
      }
    }
  }, {
    key: "activateItem",
    value: function activateItem(accordionItem) {
      var activeClass = this.getSettings("classes.active");
      var accordionContent = this.getAccordionContent(accordionItem);
      accordionItem.classList.add(activeClass);
      (0, _utils.slideDown)(accordionContent, 300);
    }
  }, {
    key: "deactiveItem",
    value: function deactiveItem(accordionItem) {
      var activeClass = this.getSettings("classes.active");
      var accordionContent = this.getAccordionContent(accordionItem);
      accordionItem.classList.remove(activeClass);
      (0, _utils.slideUp)(accordionContent, 300);
    }
  }, {
    key: "isActiveItem",
    value: function isActiveItem(accordionItem) {
      return accordionItem.classList.contains(this.getSettings("classes.active"));
    }
  }, {
    key: "getAccordionContent",
    value: function getAccordionContent(accordionItem) {
      return accordionItem.querySelector(this.getSettings("selectors.accordionContent"));
    }
  }]);

  return OEW_Accordion;
}(elementorModules.frontend.handlers.Base);

(0, _utils.registerWidget)(OEW_Accordion, "oew-accordion");

},{"../lib/utils":1}]},{},[2])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJhc3NldHMvc3JjL2pzL2xpYi91dGlscy5qcyIsImFzc2V0cy9zcmMvanMvd2lkZ2V0cy9hY2NvcmRpb24uanMiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7Ozs7Ozs7Ozs7QUNBTyxJQUFNLFNBQVMsR0FBRyxTQUFaLFNBQVksQ0FBQyxPQUFELEVBQTZCO0FBQUEsTUFBbkIsUUFBbUIsdUVBQVIsR0FBUTtBQUNsRCxNQUFJLE9BQU8sR0FBRyxNQUFNLENBQUMsZ0JBQVAsQ0FBd0IsT0FBeEIsRUFBaUMsT0FBL0M7O0FBRUEsTUFBSSxPQUFPLEtBQUssTUFBaEIsRUFBd0I7QUFDcEIsSUFBQSxPQUFPLEdBQUcsT0FBVjtBQUNIOztBQUVELEVBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxrQkFBZCxHQUFtQyxRQUFuQztBQUNBLEVBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxrQkFBZCxhQUFzQyxRQUF0QztBQUVBLEVBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxPQUFkLEdBQXdCLENBQXhCO0FBQ0EsRUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLE9BQWQsR0FBd0IsT0FBeEI7QUFDQSxNQUFJLE1BQU0sR0FBRyxPQUFPLENBQUMsWUFBckI7QUFFQSxFQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsTUFBZCxHQUF1QixDQUF2QjtBQUNBLEVBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxPQUFkLEdBQXdCLENBQXhCO0FBQ0EsRUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLFFBQWQsR0FBeUIsUUFBekI7QUFFQSxFQUFBLFVBQVUsQ0FBQyxZQUFNO0FBQ2IsSUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLE1BQWQsYUFBMEIsTUFBMUI7QUFDSCxHQUZTLEVBRVAsQ0FGTyxDQUFWO0FBSUEsRUFBQSxNQUFNLENBQUMsVUFBUCxDQUFrQixZQUFNO0FBQ3BCLElBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxj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aWxlIjoiZ2VuZXJhdGVkLmpzIiwic291cmNlUm9vdCI6IiIsInNvdXJjZXNDb250ZW50IjpbIihmdW5jdGlvbigpe2Z1bmN0aW9uIHIoZSxuLHQpe2Z1bmN0aW9uIG8oaSxmKXtpZighbltpXSl7aWYoIWVbaV0pe3ZhciBjPVwiZnVuY3Rpb25cIj09dHlwZW9mIHJlcXVpcmUmJnJlcXVpcmU7aWYoIWYmJmMpcmV0dXJuIGMoaSwhMCk7aWYodSlyZXR1cm4gdShpLCEwKTt2YXIgYT1uZXcgRXJyb3IoXCJDYW5ub3QgZmluZCBtb2R1bGUgJ1wiK2krXCInXCIpO3Rocm93IGEuY29kZT1cIk1PRFVMRV9OT1RfRk9VTkRcIixhfXZhciBwPW5baV09e2V4cG9ydHM6e319O2VbaV1bMF0uY2FsbChwLmV4cG9ydHMsZnVuY3Rpb24ocil7dmFyIG49ZVtpXVsxXVtyXTtyZXR1cm4gbyhufHxyKX0scCxwLmV4cG9ydHMscixlLG4sdCl9cmV0dXJuIG5baV0uZXhwb3J0c31mb3IodmFyIHU9XCJmdW5jdGlvblwiPT10eXBlb2YgcmVxdWlyZSYmcmVxdWlyZSxpPTA7aTx0Lmxlbmd0aDtpKyspbyh0W2ldKTtyZXR1cm4gb31yZXR1cm4gcn0pKCkiLCJleHBvcnQgY29uc3Qgc2xpZGVEb3duID0gKGVsZW1lbnQsIGR1cmF0aW9uID0gMzAwKSA9PiB7XHJcbiAgICBsZXQgZGlzcGxheSA9IHdpbmRvdy5nZXRDb21wdXRlZFN0eWxlKGVsZW1lbnQpLmRpc3BsYXk7XHJcblxyXG4gICAgaWYgKGRpc3BsYXkgPT09IFwibm9uZVwiKSB7XHJcbiAgICAgICAgZGlzcGxheSA9IFwiYmxvY2tcIjtcclxuICAgIH1cclxuXHJcbiAgICBlbGVtZW50LnN0eWxlLnRyYW5zaXRpb25Qcm9wZXJ0eSA9IFwiaGVpZ2h0XCI7XHJcbiAgICBlbGVtZW50LnN0eWxlLnRyYW5zaXRpb25EdXJhdGlvbiA9IGAke2R1cmF0aW9ufW1zYDtcclxuXHJcbiAgICBlbGVtZW50LnN0eWxlLm9wYWNpdHkgPSAwO1xyXG4gICAgZWxlbWVudC5zdHlsZS5kaXNwbGF5ID0gZGlzcGxheTtcclxuICAgIGxldCBoZWlnaHQgPSBlbGVtZW50Lm9mZnNldEhlaWdodDtcclxuXHJcbiAgICBlbGVtZW50LnN0eWxlLmhlaWdodCA9IDA7XHJcbiAgICBlbGVtZW50LnN0eWxlLm9wYWNpdHkgPSAxO1xyXG4gICAgZWxlbWVudC5zdHlsZS5vdmVyZmxvdyA9IFwiaGlkZGVuXCI7XHJcblxyXG4gICAgc2V0VGltZW91dCgoKSA9PiB7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5oZWlnaHQgPSBgJHtoZWlnaHR9cHhgO1xyXG4gICAgfSwgNSk7XHJcblxyXG4gICAgd2luZG93LnNldFRpbWVvdXQoKCkgPT4ge1xyXG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJoZWlnaHRcIik7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcIm92ZXJmbG93XCIpO1xyXG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJ0cmFuc2l0aW9uLWR1cmF0aW9uXCIpO1xyXG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJ0cmFuc2l0aW9uLXByb3BlcnR5XCIpO1xyXG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJvcGFjaXR5XCIpO1xyXG4gICAgfSwgZHVyYXRpb24gKyA1MCk7XHJcbn07XHJcblxyXG5leHBvcnQgY29uc3Qgc2xpZGVVcCA9IChlbGVtZW50LCBkdXJhdGlvbiA9IDMwMCkgPT4ge1xyXG4gICAgZWxlbWVudC5zdHlsZS5ib3hTaXppbmcgPSBcImJvcmRlci1ib3hcIjtcclxuICAgIGVsZW1lbnQuc3R5bGUudHJhbnNpdGlvblByb3BlcnR5ID0gXCJoZWlnaHQsIG1hcmdpblwiO1xyXG4gICAgZWxlbWVudC5zdHlsZS50cmFuc2l0aW9uRHVyYXRpb24gPSBgJHtkdXJhdGlvbn1tc2A7XHJcbiAgICBlbGVtZW50LnN0eWxlLmhlaWdodCA9IGAke2VsZW1lbnQub2Zmc2V0SGVpZ2h0fXB4YDtcclxuICAgIGVsZW1lbnQuc3R5bGUubWFyZ2luVG9wID0gMDtcclxuICAgIGVsZW1lbnQuc3R5bGUubWFyZ2luQm90dG9tID0gMDtcclxuICAgIGVsZW1lbnQuc3R5bGUub3ZlcmZsb3cgPSBcImhpZGRlblwiO1xyXG5cclxuICAgIHNldFRpbWVvdXQoKCkgPT4ge1xyXG4gICAgICAgIGVsZW1lbnQuc3R5bGUuaGVpZ2h0ID0gMDtcclxuICAgIH0sIDUpO1xyXG5cclxuICAgIHdpbmRvdy5zZXRUaW1lb3V0KCgpID0+IHtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLmRpc3BsYXkgPSBcIm5vbmVcIjtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwiaGVpZ2h0XCIpO1xyXG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJtYXJnaW4tdG9wXCIpO1xyXG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJtYXJnaW4tYm90dG9tXCIpO1xyXG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJvdmVyZmxvd1wiKTtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwidHJhbnNpdGlvbi1kdXJhdGlvblwiKTtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwidHJhbnNpdGlvbi1wcm9wZXJ0eVwiKTtcclxuICAgIH0sIGR1cmF0aW9uICsgNTApO1xyXG59O1xyXG5cclxuZXhwb3J0IGNvbnN0IHNsaWRlVG9nZ2xlID0gKGVsZW1lbnQsIGR1cmF0aW9uKSA9PiB7XHJcbiAgICB3aW5kb3cuZ2V0Q29tcHV0ZWRTdHlsZShlbGVtZW50KS5kaXNwbGF5ID09PSBcIm5vbmVcIiA/IHNsaWRlRG93bihlbGVtZW50LCBkdXJhdGlvbikgOiBzbGlkZVVwKGVsZW1lbnQsIGR1cmF0aW9uKTtcclxufTtcclxuXHJcbmV4cG9ydCBjb25zdCBmYWRlSW4gPSAoZWxlbWVudCwgX29wdGlvbnMgPSB7fSkgPT4ge1xyXG4gICAgY29uc3Qgb3B0aW9ucyA9IHtcclxuICAgICAgICBkdXJhdGlvbjogMzAwLFxyXG4gICAgICAgIGRpc3BsYXk6IG51bGwsXHJcbiAgICAgICAgb3BhY2l0eTogMSxcclxuICAgICAgICBjYWxsYmFjazogbnVsbCxcclxuICAgIH07XHJcblxyXG4gICAgT2JqZWN0LmFzc2lnbihvcHRpb25zLCBfb3B0aW9ucyk7XHJcblxyXG4gICAgZWxlbWVudC5zdHlsZS5vcGFjaXR5ID0gMDtcclxuICAgIGVsZW1lbnQuc3R5bGUuZGlzcGxheSA9IG9wdGlvbnMuZGlzcGxheSB8fCBcImJsb2NrXCI7XHJcblxyXG4gICAgc2V0VGltZW91dCgoKSA9PiB7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS50cmFuc2l0aW9uID0gYCR7b3B0aW9ucy5kdXJhdGlvbn1tcyBvcGFjaXR5IGVhc2VgO1xyXG4gICAgICAgIGVsZW1lbnQuc3R5bGUub3BhY2l0eSA9IG9wdGlvbnMub3BhY2l0eTtcclxuICAgIH0sIDUpO1xyXG5cclxuICAgIHNldFRpbWVvdXQoKCkgPT4ge1xyXG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJ0cmFuc2l0aW9uXCIpO1xyXG4gICAgICAgICEhb3B0aW9ucy5jYWxsYmFjayAmJiBvcHRpb25zLmNhbGxiYWNrKCk7XHJcbiAgICB9LCBvcHRpb25zLmR1cmF0aW9uICsgNTApO1xyXG59O1xyXG5cclxuZXhwb3J0IGNvbnN0IGZhZGVPdXQgPSAoZWxlbWVudCwgX29wdGlvbnMgPSB7fSkgPT4ge1xyXG4gICAgY29uc3Qgb3B0aW9ucyA9IHtcclxuICAgICAgICBkdXJhdGlvbjogMzAwLFxyXG4gICAgICAgIGRpc3BsYXk6IG51bGwsXHJcbiAgICAgICAgb3BhY2l0eTogMCxcclxuICAgICAgICBjYWxsYmFjazogbnVsbCxcclxuICAgIH07XHJcblxyXG4gICAgT2JqZWN0LmFzc2lnbihvcHRpb25zLCBfb3B0aW9ucyk7XHJcblxyXG4gICAgZWxlbWVudC5zdHlsZS5vcGFjaXR5ID0gMTtcclxuICAgIGVsZW1lbnQuc3R5bGUuZGlzcGxheSA9IG9wdGlvbnMuZGlzcGxheSB8fCBcImJsb2NrXCI7XHJcblxyXG4gICAgc2V0VGltZW91dCgoKSA9PiB7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS50cmFuc2l0aW9uID0gYCR7b3B0aW9ucy5kdXJhdGlvbn1tcyBvcGFjaXR5IGVhc2VgO1xyXG4gICAgICAgIGVsZW1lbnQuc3R5bGUub3BhY2l0eSA9IG9wdGlvbnMub3BhY2l0eTtcclxuICAgIH0sIDUpO1xyXG5cclxuICAgIHNldFRpbWVvdXQoKCkgPT4ge1xyXG4gICAgICAgIGVsZW1lbnQuc3R5bGUuZGlzcGxheSA9IFwibm9uZVwiO1xyXG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJ0cmFuc2l0aW9uXCIpO1xyXG4gICAgICAgICEhb3B0aW9ucy5jYWxsYmFjayAmJiBvcHRpb25zLmNhbGxiYWNrKCk7XHJcbiAgICB9LCBvcHRpb25zLmR1cmF0aW9uICsgNTApO1xyXG59O1xyXG5cclxuZXhwb3J0IGNvbnN0IGZhZGVUb2dnbGUgPSAoZWxlbWVudCwgb3B0aW9ucykgPT4ge1xyXG4gICAgd2luZG93LmdldENvbXB1dGVkU3R5bGUoZWxlbWVudCkuZGlzcGxheSA9PT0gXCJub25lXCIgPyBmYWRlSW4oZWxlbWVudCwgb3B0aW9ucykgOiBmYWRlT3V0KGVsZW1lbnQsIG9wdGlvbnMpO1xyXG59O1xyXG5cclxuZXhwb3J0IGNvbnN0IG9mZnNldCA9IChlbGVtZW50KSA9PiB7XHJcbiAgICBpZiAoIWVsZW1lbnQuZ2V0Q2xpZW50UmVjdHMoKS5sZW5ndGgpIHtcclxuICAgICAgICByZXR1cm4geyB0b3A6IDAsIGxlZnQ6IDAgfTtcclxuICAgIH1cclxuXHJcbiAgICAvLyBHZXQgZG9jdW1lbnQtcmVsYXRpdmUgcG9zaXRpb24gYnkgYWRkaW5nIHZpZXdwb3J0IHNjcm9sbCB0byB2aWV3cG9ydC1yZWxhdGl2ZSBnQkNSXHJcbiAgICBjb25zdCByZWN0ID0gZWxlbWVudC5nZXRCb3VuZGluZ0NsaWVudFJlY3QoKTtcclxuICAgIGNvbnN0IHdpbiA9IGVsZW1lbnQub3duZXJEb2N1bWVudC5kZWZhdWx0VmlldztcclxuICAgIHJldHVybiB7XHJcbiAgICAgICAgdG9wOiByZWN0LnRvcCArIHdpbi5wYWdlWU9mZnNldCxcclxuICAgICAgICBsZWZ0OiByZWN0LmxlZnQgKyB3aW4ucGFnZVhPZmZzZXQsXHJcbiAgICB9O1xyXG59O1xyXG5cclxuZXhwb3J0IGNvbnN0IHZpc2libGUgPSAoZWxlbWVudCkgPT4ge1xyXG4gICAgaWYgKCFlbGVtZW50KSB7XHJcbiAgICAgICAgcmV0dXJuIGZhbHNlO1xyXG4gICAgfVxyXG5cclxuICAgIHJldHVybiAhIShlbGVtZW50Lm9mZnNldFdpZHRoIHx8IGVsZW1lbnQub2Zmc2V0SGVpZ2h0IHx8IGVsZW1lbnQuZ2V0Q2xpZW50UmVjdHMoKS5sZW5ndGgpO1xyXG59O1xyXG5cclxuZXhwb3J0IGNvbnN0IGdldFNpYmxpbmdzID0gKGUpID0+IHtcclxuICAgIC8vIGZvciBjb2xsZWN0aW5nIHNpYmxpbmdzXHJcbiAgICBjb25zdCBzaWJsaW5ncyA9IFtdO1xyXG5cclxuICAgIC8vIGlmIG5vIHBhcmVudCwgcmV0dXJuIG5vIHNpYmxpbmdcclxuICAgIGlmICghZS5wYXJlbnROb2RlKSB7XHJcbiAgICAgICAgcmV0dXJuIHNpYmxpbmdzO1xyXG4gICAgfVxyXG5cclxuICAgIC8vIGZpcnN0IGNoaWxkIG9mIHRoZSBwYXJlbnQgbm9kZVxyXG4gICAgbGV0IHNpYmxpbmcgPSBlLnBhcmVudE5vZGUuZmlyc3RDaGlsZDtcclxuXHJcbiAgICAvLyBjb2xsZWN0aW5nIHNpYmxpbmdzXHJcbiAgICB3aGlsZSAoc2libGluZykge1xyXG4gICAgICAgIGlmIChzaWJsaW5nLm5vZGVUeXBlID09PSAxICYmIHNpYmxpbmcgIT09IGUpIHtcclxuICAgICAgICAgICAgc2libGluZ3MucHVzaChzaWJsaW5nKTtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIHNpYmxpbmcgPSBzaWJsaW5nLm5leHRTaWJsaW5nO1xyXG4gICAgfVxyXG5cclxuICAgIHJldHVybiBzaWJsaW5ncztcclxufTtcclxuXHJcbi8vIFJldHVybnMgdHJ1ZSBpZiBpdCBpcyBhIERPTSBlbGVtZW50XHJcbmV4cG9ydCBjb25zdCBpc0VsZW1lbnQgPSAobykgPT4ge1xyXG4gICAgcmV0dXJuIHR5cGVvZiBIVE1MRWxlbWVudCA9PT0gXCJvYmplY3RcIlxyXG4gICAgICAgID8gbyBpbnN0YW5jZW9mIEhUTUxFbGVtZW50IC8vIERPTTJcclxuICAgICAgICA6IG8gJiYgdHlwZW9mIG8gPT09IFwib2JqZWN0XCIgJiYgbyAhPT0gbnVsbCAmJiBvLm5vZGVUeXBlID09PSAxICYmIHR5cGVvZiBvLm5vZGVOYW1lID09PSBcInN0cmluZ1wiO1xyXG59O1xyXG5cclxuZXhwb3J0IGNvbnN0IHJlZ2lzdGVyV2lkZ2V0ID0gKGNsYXNzTmFtZSwgd2lkZ2V0TmFtZSwgc2tpbiA9IFwiZGVmYXVsdFwiKSA9PiB7XHJcbiAgICBpZiAoIShjbGFzc05hbWUgfHwgd2lkZ2V0TmFtZSkpIHtcclxuICAgICAgICByZXR1cm47XHJcbiAgICB9XHJcblxyXG4gICAgLyoqXHJcbiAgICAgKiBCZWNhdXNlIEVsZW1lbnRvciBwbHVnaW4gdXNlcyBqUXVlcnkgY3VzdG9tIGV2ZW50LFxyXG4gICAgICogV2UgYWxzbyBoYXZlIHRvIHVzZSBqUXVlcnkgdG8gdXNlIHRoaXMgZXZlbnRcclxuICAgICAqL1xyXG4gICAgalF1ZXJ5KHdpbmRvdykub24oXCJlbGVtZW50b3IvZnJvbnRlbmQvaW5pdFwiLCAoKSA9PiB7XHJcbiAgICAgICAgY29uc3QgYWRkSGFuZGxlciA9ICgkZWxlbWVudCkgPT4ge1xyXG4gICAgICAgICAgICBlbGVtZW50b3JGcm9udGVuZC5lbGVtZW50c0hhbmRsZXIuYWRkSGFuZGxlcihjbGFzc05hbWUsIHtcclxuICAgICAgICAgICAgICAgICRlbGVtZW50LFxyXG4gICAgICAgICAgICB9KTtcclxuICAgICAgICB9O1xyXG5cclxuICAgICAgICBlbGVtZW50b3JGcm9udGVuZC5ob29rcy5hZGRBY3Rpb24oYGZyb250ZW5kL2VsZW1lbnRfcmVhZHkvJHt3aWRnZXROYW1lfS4ke3NraW59YCwgYWRkSGFuZGxlcik7XHJcbiAgICB9KTtcclxufTtcclxuIiwiaW1wb3J0IHsgcmVnaXN0ZXJXaWRnZXQsIHNsaWRlVXAsIHNsaWRlRG93biwgc2xpZGVUb2dnbGUgfSBmcm9tIFwiLi4vbGliL3V0aWxzXCI7XHJcblxyXG5jbGFzcyBPRVdfQWNjb3JkaW9uIGV4dGVuZHMgZWxlbWVudG9yTW9kdWxlcy5mcm9udGVuZC5oYW5kbGVycy5CYXNlIHtcclxuICAgIGdldERlZmF1bHRTZXR0aW5ncygpIHtcclxuICAgICAgICByZXR1cm4ge1xyXG4gICAgICAgICAgICBzZWxlY3RvcnM6IHtcclxuICAgICAgICAgICAgICAgIGFjY29yZGlvbjogXCIub2V3LWFjY29yZGlvblwiLFxyXG4gICAgICAgICAgICAgICAgYWNjb3JkaW9uSXRlbTogXCIub2V3LWFjY29yZGlvbi1pdGVtXCIsXHJcbiAgICAgICAgICAgICAgICBhY2NvcmRpb25UaXRsZTogXCIub2V3LWFjY29yZGlvbi10aXRsZVwiLFxyXG4gICAgICAgICAgICAgICAgYWNjb3JkaW9uQ29udGVudDogXCIub2V3LWFjY29yZGlvbi1jb250ZW50XCIsXHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIGNsYXNzZXM6IHtcclxuICAgICAgICAgICAgICAgIGFjdGl2ZTogXCJvZXctYWN0aXZlXCIsXHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIGFjdGl2ZUl0ZW1JbmRleDogbnVsbCxcclxuICAgICAgICAgICAgbXVsdGlFeHBhbmQ6IGZhbHNlLFxyXG4gICAgICAgIH07XHJcbiAgICB9XHJcblxyXG4gICAgZ2V0RGVmYXVsdEVsZW1lbnRzKCkge1xyXG4gICAgICAgIGNvbnN0IGVsZW1lbnQgPSB0aGlzLiRlbGVtZW50LmdldCgwKTtcclxuICAgICAgICBjb25zdCBzZWxlY3RvcnMgPSB0aGlzLmdldFNldHRpbmdzKFwic2VsZWN0b3JzXCIpO1xyXG5cclxuICAgICAgICByZXR1cm4ge1xyXG4gICAgICAgICAgICBhY2NvcmRpb246IGVsZW1lbnQucXVlcnlTZWxlY3RvcihzZWxlY3RvcnMuYWNjb3JkaW9uKSxcclxuICAgICAgICAgICAgYWNjb3JkaW9uSXRlbXM6IGVsZW1lbnQucXVlcnlTZWxlY3RvckFsbChzZWxlY3RvcnMuYWNjb3JkaW9uSXRlbSksXHJcbiAgICAgICAgICAgIGFjY29yZGlvblRpdGxlczogZWxlbWVudC5xdWVyeVNlbGVjdG9yQWxsKHNlbGVjdG9ycy5hY2NvcmRpb25UaXRsZSksXHJcbiAgICAgICAgICAgIGFjY29yZGlvbkNvbnRlbnRzOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoc2VsZWN0b3JzLmFjY29yZGlvbkNvbnRlbnQpLFxyXG4gICAgICAgIH07XHJcbiAgICB9XHJcblxyXG4gICAgb25Jbml0KC4uLmFyZ3MpIHtcclxuICAgICAgICBzdXBlci5vbkluaXQoLi4uYXJncyk7XHJcblxyXG4gICAgICAgIHRoaXMuc2V0VXNlclNldHRpbmdzKCk7XHJcbiAgICAgICAgdGhpcy5hY3RpdmF0ZURlZmF1bHRJdGVtKCk7XHJcbiAgICB9XHJcblxyXG4gICAgc2V0VXNlclNldHRpbmdzKCkge1xyXG4gICAgICAgIGNvbnN0IHNldHRpbmdzID0gdGhpcy5nZXRTZXR0aW5ncygpO1xyXG4gICAgICAgIGNvbnN0IHVzZXJTZXR0aW5ncyA9IEpTT04ucGFyc2UodGhpcy5lbGVtZW50cy5hY2NvcmRpb24uZ2V0QXR0cmlidXRlKFwiZGF0YS1zZXR0aW5nc1wiKSk7XHJcblxyXG4gICAgICAgIHRoaXMuc2V0U2V0dGluZ3Moe1xyXG4gICAgICAgICAgICBhY3RpdmVJdGVtSW5kZXg6ICEhdXNlclNldHRpbmdzLmFjdGl2ZV9pdGVtID8gdXNlclNldHRpbmdzLmFjdGl2ZV9pdGVtIDogc2V0dGluZ3MuYWN0aXZlSXRlbUluZGV4LFxyXG4gICAgICAgICAgICBtdWx0aUV4cGFuZDogISF1c2VyU2V0dGluZ3MubXVsdGlwbGUgPyBKU09OLnBhcnNlKHVzZXJTZXR0aW5ncy5tdWx0aXBsZSkgOiBzZXR0aW5ncy5tdWx0aUV4cGFuZCxcclxuICAgICAgICB9KTtcclxuICAgIH1cclxuXHJcbiAgICBhY3RpdmF0ZURlZmF1bHRJdGVtKCkge1xyXG4gICAgICAgIGNvbnN0IHNldHRpbmdzID0gdGhpcy5nZXRTZXR0aW5ncygpO1xyXG4gICAgICAgIGNvbnN0IHNlbGVjdG9ycyA9IHNldHRpbmdzLnNlbGVjdG9ycztcclxuICAgICAgICBjb25zdCBhY3RpdmVJdGVtSW5kZXggPSBzZXR0aW5ncy5hY3RpdmVJdGVtSW5kZXg7XHJcbiAgICAgICAgY29uc3QgYWN0aXZlQ2xhc3MgPSBzZXR0aW5ncy5jbGFzc2VzLmFjdGl2ZTtcclxuXHJcbiAgICAgICAgaWYgKCFhY3RpdmVJdGVtSW5kZXgpIHtcclxuICAgICAgICAgICAgcmV0dXJuO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgY29uc3QgYWN0aXZlQWNjb3JkaW9uSXRlbSA9IHRoaXMuZWxlbWVudHMuYWNjb3JkaW9uLnF1ZXJ5U2VsZWN0b3IoXHJcbiAgICAgICAgICAgIGAke3NlbGVjdG9ycy5hY2NvcmRpb25JdGVtfTpudGgtY2hpbGQoJHthY3RpdmVJdGVtSW5kZXh9KWBcclxuICAgICAgICApO1xyXG5cclxuICAgICAgICBhY3RpdmVBY2NvcmRpb25JdGVtLmNsYXNzTGlzdC5yZW1vdmUoYWN0aXZlQ2xhc3MpO1xyXG5cclxuICAgICAgICB0aGlzLmNoYW5nZUFjdGl2ZUl0ZW0oYWN0aXZlQWNjb3JkaW9uSXRlbSk7XHJcbiAgICB9XHJcblxyXG4gICAgYmluZEV2ZW50cygpIHtcclxuICAgICAgICB0aGlzLmVsZW1lbnRzLmFjY29yZGlvblRpdGxlcy5mb3JFYWNoKChhY2NvcmRpb25UaXRsZSkgPT4ge1xyXG4gICAgICAgICAgICBhY2NvcmRpb25UaXRsZS5hZGRFdmVudExpc3RlbmVyKFwiY2xpY2tcIiwgdGhpcy5vblRpdGxlQ2xpY2suYmluZCh0aGlzKSk7XHJcbiAgICAgICAgfSk7XHJcbiAgICB9XHJcblxyXG4gICAgb25UaXRsZUNsaWNrKGV2ZW50KSB7XHJcbiAgICAgICAgY29uc3QgZW5hYmxlTXVsdGlFeHBhbmQgPSB0aGlzLmdldFNldHRpbmdzKFwibXVsdGlFeHBhbmRcIik7XHJcbiAgICAgICAgY29uc3QgYWNjb3JkaW9uVGl0bGUgPSBldmVudC5jdXJyZW50VGFyZ2V0O1xyXG4gICAgICAgIGNvbnN0IGFjY29yZGlvbkl0ZW0gPSBhY2NvcmRpb25UaXRsZS5wYXJlbnROb2RlO1xyXG5cclxuICAgICAgICBpZiAoISFlbmFibGVNdWx0aUV4cGFuZCkge1xyXG4gICAgICAgICAgICB0aGlzLnRvZ2dsZU11bHRpRXhwYW5kSXRlbShhY2NvcmRpb25JdGVtKTtcclxuICAgICAgICB9IGVsc2Uge1xyXG4gICAgICAgICAgICB0aGlzLmNoYW5nZUFjdGl2ZUl0ZW0oYWNjb3JkaW9uSXRlbSk7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIHRvZ2dsZU11bHRpRXhwYW5kSXRlbShhY2NvcmRpb25JdGVtKSB7XHJcbiAgICAgICAgY29uc3QgYWN0aXZlQ2xhc3MgPSB0aGlzLmdldFNldHRpbmdzKFwiY2xhc3Nlcy5hY3RpdmVcIik7XHJcbiAgICAgICAgY29uc3QgYWNjb3JkaW9uQ29udGVudCA9IHRoaXMuZ2V0QWNjb3JkaW9uQ29udGVudChhY2NvcmRpb25JdGVtKTtcclxuXHJcbiAgICAgICAgYWNjb3JkaW9uSXRlbS5jbGFzc0xpc3QudG9nZ2xlKGFjdGl2ZUNsYXNzKTtcclxuICAgICAgICBzbGlkZVRvZ2dsZShhY2NvcmRpb25Db250ZW50LCAzMDApO1xyXG4gICAgfVxyXG5cclxuICAgIGNoYW5nZUFjdGl2ZUl0ZW0oYWNjb3JkaW9uSXRlbSkge1xyXG4gICAgICAgIGlmICh0aGlzLmlzQWN0aXZlSXRlbShhY2NvcmRpb25JdGVtKSkge1xyXG4gICAgICAgICAgICB0aGlzLmRlYWN0aXZlSXRlbShhY2NvcmRpb25JdGVtKTtcclxuICAgICAgICB9IGVsc2Uge1xyXG4gICAgICAgICAgICB0aGlzLmVsZW1lbnRzLmFjY29yZGlvbkl0ZW1zLmZvckVhY2goKF9hY2NvcmRpb25JdGVtKSA9PiB7XHJcbiAgICAgICAgICAgICAgICBpZiAoX2FjY29yZGlvbkl0ZW0gIT09IGFjY29yZGlvbkl0ZW0pIHtcclxuICAgICAgICAgICAgICAgICAgICB0aGlzLmRlYWN0aXZlSXRlbShfYWNjb3JkaW9uSXRlbSk7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH0pO1xyXG5cclxuICAgICAgICAgICAgdGhpcy5hY3RpdmF0ZUl0ZW0oYWNjb3JkaW9uSXRlbSk7XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG5cclxuICAgIGFjdGl2YXRlSXRlbShhY2NvcmRpb25JdGVtKSB7XHJcbiAgICAgICAgY29uc3QgYWN0aXZlQ2xhc3MgPSB0aGlzLmdldFNldHRpbmdzKFwiY2xhc3Nlcy5hY3RpdmVcIik7XHJcbiAgICAgICAgY29uc3QgYWNjb3JkaW9uQ29udGVudCA9IHRoaXMuZ2V0QWNjb3JkaW9uQ29udGVudChhY2NvcmRpb25JdGVtKTtcclxuXHJcbiAgICAgICAgYWNjb3JkaW9uSXRlbS5jbGFzc0xpc3QuYWRkKGFjdGl2ZUNsYXNzKTtcclxuICAgICAgICBzbGlkZURvd24oYWNjb3JkaW9uQ29udGVudCwgMzAwKTtcclxuICAgIH1cclxuXHJcbiAgICBkZWFjdGl2ZUl0ZW0oYWNjb3JkaW9uSXRlbSkge1xyXG4gICAgICAgIGNvbnN0IGFjdGl2ZUNsYXNzID0gdGhpcy5nZXRTZXR0aW5ncyhcImNsYXNzZXMuYWN0aXZlXCIpO1xyXG4gICAgICAgIGNvbnN0IGFjY29yZGlvbkNvbnRlbnQgPSB0aGlzLmdldEFjY29yZGlvbkNvbnRlbnQoYWNjb3JkaW9uSXRlbSk7XHJcblxyXG4gICAgICAgIGFjY29yZGlvbkl0ZW0uY2xhc3NMaXN0LnJlbW92ZShhY3RpdmVDbGFzcyk7XHJcbiAgICAgICAgc2xpZGVVcChhY2NvcmRpb25Db250ZW50LCAzMDApO1xyXG4gICAgfVxyXG5cclxuICAgIGlzQWN0aXZlSXRlbShhY2NvcmRpb25JdGVtKSB7XHJcbiAgICAgICAgcmV0dXJuIGFjY29yZGlvbkl0ZW0uY2xhc3NMaXN0LmNvbnRhaW5zKHRoaXMuZ2V0U2V0dGluZ3MoXCJjbGFzc2VzLmFjdGl2ZVwiKSk7XHJcbiAgICB9XHJcblxyXG4gICAgZ2V0QWNjb3JkaW9uQ29udGVudChhY2NvcmRpb25JdGVtKSB7XHJcbiAgICAgICAgcmV0dXJuIGFjY29yZGlvbkl0ZW0ucXVlcnlTZWxlY3Rvcih0aGlzLmdldFNldHRpbmdzKFwic2VsZWN0b3JzLmFjY29yZGlvbkNvbnRlbnRcIikpO1xyXG4gICAgfVxyXG59XHJcblxyXG5yZWdpc3RlcldpZGdldChPRVdfQWNjb3JkaW9uLCBcIm9ldy1hY2NvcmRpb25cIik7XHJcbiJdfQ==
