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

var OEW_Newsletter = /*#__PURE__*/function (_elementorModules$fro) {
  _inherits(OEW_Newsletter, _elementorModules$fro);

  var _super = _createSuper(OEW_Newsletter);

  function OEW_Newsletter() {
    _classCallCheck(this, OEW_Newsletter);

    return _super.apply(this, arguments);
  }

  _createClass(OEW_Newsletter, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        selectors: {
          subscribeForm: "#mc-embedded-subscribe-form",
          submitBtn: "button",
          emailField: ".email",
          emailFieldError: ".email-err",
          GDPRField: ".gdpr",
          GDPRFieldError: ".gdpr-err",
          responseMessage: ".res-msg",
          errorMessage: ".err-msg",
          require: ".req",
          notValid: ".not-valid",
          success: ".success",
          failed: ".failed"
        }
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var element = this.$element.get(0);
      var selectors = this.getSettings("selectors");
      return {
        subscribeForm: element.querySelector(selectors.subscribeForm),
        submitBtn: element.querySelector(selectors.submitBtn),
        emailField: element.querySelector(selectors.emailField),
        GDPRField: element.querySelector(selectors.GDPRField),
        responseMessages: element.querySelectorAll(selectors.responseMessage),
        errorMessages: element.querySelectorAll(selectors.errorMessage)
      };
    }
  }, {
    key: "onInit",
    value: function onInit() {
      var _get2;

      for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
        args[_key] = arguments[_key];
      }

      (_get2 = _get(_getPrototypeOf(OEW_Newsletter.prototype), "onInit", this)).call.apply(_get2, [this].concat(args));

      this.setupEventListeners();
    }
  }, {
    key: "setupEventListeners",
    value: function setupEventListeners() {
      var _this$elements$subscr;

      (_this$elements$subscr = this.elements.subscribeForm) === null || _this$elements$subscr === void 0 ? void 0 : _this$elements$subscr.addEventListener("submit", this.onSubmitSubscribeForm.bind(this));
    }
  }, {
    key: "onSubmitSubscribeForm",
    value: function onSubmitSubscribeForm(event) {
      var _this = this;

      event.preventDefault();
      var isFormAllowedSubmitted = this.checkFormFields();

      if (isFormAllowedSubmitted) {
        var element = this.$element.get(0);
        var selectors = this.getSettings("selectors");
        var emailAdress = this.elements.emailField.value.trim();
        this.elements.submitBtn.disabled = true;
        var formData = new FormData();
        formData.append("action", "oew_newsletter_form");
        formData.append("nonce", newsletterData.nonce);
        formData.append("email", emailAdress);
        axios.post(newsletterData.ajax_url, formData).then(function (_ref) {
          var data = _ref.data;
          var message = data.status ? element.querySelector("".concat(selectors.responseMessage).concat(selectors.success)) : element.querySelector("".concat(selectors.responseMessage).concat(selectors.failed));
          (0, _utils.fadeIn)(message);
          _this.elements.submitBtn.disabled = false;
          setTimeout(function () {
            (0, _utils.fadeOut)(message);
          }, 5000);
        });
      }
    }
  }, {
    key: "checkFormFields",
    value: function checkFormFields() {
      var element = this.$element.get(0);
      var selectors = this.getSettings("selectors");
      var emailAdress = this.elements.emailField.value.trim();
      var isFormAllowedSubmitted = true;
      this.elements.errorMessages.forEach(function (errorMessage) {
        errorMessage.style.display = "none";
      });
      this.elements.responseMessages.forEach(function (responseMessage) {
        responseMessage.style.display = "none";
      });

      if (emailAdress === "") {
        element.querySelector("".concat(selectors.emailFieldError).concat(selectors.require)).style.display = "block";
        isFormAllowedSubmitted = false;
      } else if (!this.isEmailAddressValid(emailAdress)) {
        element.querySelector("".concat(selectors.emailFieldError).concat(selectors.notValid)).style.display = "block";
        isFormAllowedSubmitted = false;
      }

      if (!!this.elements.GDPRField && this.elements.GDPRField.checked === false) {
        element.querySelector("".concat(selectors.GDPRFieldError).concat(selectors.errorMessage)).style.display = "block";
        isFormAllowedSubmitted = false;
      }

      return isFormAllowedSubmitted;
    }
  }, {
    key: "isEmailAddressValid",
    value: function isEmailAddressValid(emailAddress) {
      var emailAddressPattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
      return emailAddressPattern.test(emailAddress);
    }
  }]);

  return OEW_Newsletter;
}(elementorModules.frontend.handlers.Base);

(0, _utils.registerWidget)(OEW_Newsletter, "oew-newsletter");

},{"../lib/utils":1}]},{},[2])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJhc3NldHMvc3JjL2pzL2xpYi91dGlscy5qcyIsImFzc2V0cy9zcmMvanMvd2lkZ2V0cy9uZXdzbGV0dGVyLmpzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBOzs7Ozs7Ozs7O0FDQU8sSUFBTSxTQUFTLEdBQUcsU0FBWixTQUFZLENBQUMsT0FBRCxFQUE2QjtBQUFBLE1BQW5CLFFBQW1CLHVFQUFSLEdBQVE7QUFDbEQsTUFBSSxPQUFPLEdBQUcsTUFBTSxDQUFDLGdCQUFQLENBQXdCLE9BQXhCLEVBQWlDLE9BQS9DOztBQUVBLE1BQUksT0FBTyxLQUFLLE1BQWhCLEVBQXdCO0FBQ3BCLElBQUEsT0FBTyxHQUFHLE9BQVY7QUFDSDs7QUFFRCxFQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsa0JBQWQsR0FBbUMsUUFBbkM7QUFDQSxFQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsa0JBQWQsYUFBc0MsUUFBdEM7QUFFQSxFQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsT0FBZCxHQUF3QixDQUF4QjtBQUNBLEVBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxPQUFkLEdBQXdCLE9BQXhCO0FBQ0EsTUFBSSxNQUFNLEdBQUcsT0FBTyxDQUFDLFlBQXJCO0FBRUEsRUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLE1BQWQsR0FBdUIsQ0FBdkI7QUFDQSxFQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsT0FBZCxHQUF3QixDQUF4QjtBQUNBLEVBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxRQUFkLEdBQXlCLFFBQXpCO0FBRUEsRUFBQSxVQUFVLENBQUMsWUFBTTtBQUNiLElBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxNQUFkLGFBQTBCLE1BQTFCO0FBQ0gsR0FGUyxFQUVQLENBRk8sQ0FBVjtBQUlBLEVBQUEsTUFBTSxDQUFDLFVBQVAsQ0FBa0IsWUFBTTtBQUNwQixJQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMs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LG1CQUFtQixHQUFHLElBQUksTUFBSixDQUN4QixnU0FEd0IsQ0FBNUI7QUFJQSxhQUFPLG1CQUFtQixDQUFDLElBQXBCLENBQXlCLFlBQXpCLENBQVA7QUFDSDs7OztFQWhId0IsZ0JBQWdCLENBQUMsUUFBakIsQ0FBMEIsUUFBMUIsQ0FBbUMsSTs7QUFtSGhFLDJCQUFlLGNBQWYsRUFBK0IsZ0JBQS9CIiwiZmlsZSI6ImdlbmVyYXRlZC5qcyIsInNvdXJjZVJvb3QiOiIiLCJzb3VyY2VzQ29udGVudCI6WyIoZnVuY3Rpb24oKXtmdW5jdGlvbiByKGUsbix0KXtmdW5jdGlvbiBvKGksZil7aWYoIW5baV0pe2lmKCFlW2ldKXt2YXIgYz1cImZ1bmN0aW9uXCI9PXR5cGVvZiByZXF1aXJlJiZyZXF1aXJlO2lmKCFmJiZjKXJldHVybiBjKGksITApO2lmKHUpcmV0dXJuIHUoaSwhMCk7dmFyIGE9bmV3IEVycm9yKFwiQ2Fubm90IGZpbmQgbW9kdWxlICdcIitpK1wiJ1wiKTt0aHJvdyBhLmNvZGU9XCJNT0RVTEVfTk9UX0ZPVU5EXCIsYX12YXIgcD1uW2ldPXtleHBvcnRzOnt9fTtlW2ldWzBdLmNhbGwocC5leHBvcnRzLGZ1bmN0aW9uKHIpe3ZhciBuPWVbaV1bMV1bcl07cmV0dXJuIG8obnx8cil9LHAscC5leHBvcnRzLHIsZSxuLHQpfXJldHVybiBuW2ldLmV4cG9ydHN9Zm9yKHZhciB1PVwiZnVuY3Rpb25cIj09dHlwZW9mIHJlcXVpcmUmJnJlcXVpcmUsaT0wO2k8dC5sZW5ndGg7aSsrKW8odFtpXSk7cmV0dXJuIG99cmV0dXJuIHJ9KSgpIiwiZXhwb3J0IGNvbnN0IHNsaWRlRG93biA9IChlbGVtZW50LCBkdXJhdGlvbiA9IDMwMCkgPT4ge1xyXG4gICAgbGV0IGRpc3BsYXkgPSB3aW5kb3cuZ2V0Q29tcHV0ZWRTdHlsZShlbGVtZW50KS5kaXNwbGF5O1xyXG5cclxuICAgIGlmIChkaXNwbGF5ID09PSBcIm5vbmVcIikge1xyXG4gICAgICAgIGRpc3BsYXkgPSBcImJsb2NrXCI7XHJcbiAgICB9XHJcblxyXG4gICAgZWxlbWVudC5zdHlsZS50cmFuc2l0aW9uUHJvcGVydHkgPSBcImhlaWdodFwiO1xyXG4gICAgZWxlbWVudC5zdHlsZS50cmFuc2l0aW9uRHVyYXRpb24gPSBgJHtkdXJhdGlvbn1tc2A7XHJcblxyXG4gICAgZWxlbWVudC5zdHlsZS5vcGFjaXR5ID0gMDtcclxuICAgIGVsZW1lbnQuc3R5bGUuZGlzcGxheSA9IGRpc3BsYXk7XHJcbiAgICBsZXQgaGVpZ2h0ID0gZWxlbWVudC5vZmZzZXRIZWlnaHQ7XHJcblxyXG4gICAgZWxlbWVudC5zdHlsZS5oZWlnaHQgPSAwO1xyXG4gICAgZWxlbWVudC5zdHlsZS5vcGFjaXR5ID0gMTtcclxuICAgIGVsZW1lbnQuc3R5bGUub3ZlcmZsb3cgPSBcImhpZGRlblwiO1xyXG5cclxuICAgIHNldFRpbWVvdXQoKCkgPT4ge1xyXG4gICAgICAgIGVsZW1lbnQuc3R5bGUuaGVpZ2h0ID0gYCR7aGVpZ2h0fXB4YDtcclxuICAgIH0sIDUpO1xyXG5cclxuICAgIHdpbmRvdy5zZXRUaW1lb3V0KCgpID0+IHtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwiaGVpZ2h0XCIpO1xyXG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJvdmVyZmxvd1wiKTtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwidHJhbnNpdGlvbi1kdXJhdGlvblwiKTtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwidHJhbnNpdGlvbi1wcm9wZXJ0eVwiKTtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwib3BhY2l0eVwiKTtcclxuICAgIH0sIGR1cmF0aW9uICsgNTApO1xyXG59O1xyXG5cclxuZXhwb3J0IGNvbnN0IHNsaWRlVXAgPSAoZWxlbWVudCwgZHVyYXRpb24gPSAzMDApID0+IHtcclxuICAgIGVsZW1lbnQuc3R5bGUuYm94U2l6aW5nID0gXCJib3JkZXItYm94XCI7XHJcbiAgICBlbGVtZW50LnN0eWxlLnRyYW5zaXRpb25Qcm9wZXJ0eSA9IFwiaGVpZ2h0LCBtYXJnaW5cIjtcclxuICAgIGVsZW1lbnQuc3R5bGUudHJhbnNpdGlvbkR1cmF0aW9uID0gYCR7ZHVyYXRpb259bXNgO1xyXG4gICAgZWxlbWVudC5zdHlsZS5oZWlnaHQgPSBgJHtlbGVtZW50Lm9mZnNldEhlaWdodH1weGA7XHJcbiAgICBlbGVtZW50LnN0eWxlLm1hcmdpblRvcCA9IDA7XHJcbiAgICBlbGVtZW50LnN0eWxlLm1hcmdpbkJvdHRvbSA9IDA7XHJcbiAgICBlbGVtZW50LnN0eWxlLm92ZXJmbG93ID0gXCJoaWRkZW5cIjtcclxuXHJcbiAgICBzZXRUaW1lb3V0KCgpID0+IHtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLmhlaWdodCA9IDA7XHJcbiAgICB9LCA1KTtcclxuXHJcbiAgICB3aW5kb3cuc2V0VGltZW91dCgoKSA9PiB7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5kaXNwbGF5ID0gXCJub25lXCI7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcImhlaWdodFwiKTtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwibWFyZ2luLXRvcFwiKTtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwibWFyZ2luLWJvdHRvbVwiKTtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwib3ZlcmZsb3dcIik7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcInRyYW5zaXRpb24tZHVyYXRpb25cIik7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcInRyYW5zaXRpb24tcHJvcGVydHlcIik7XHJcbiAgICB9LCBkdXJhdGlvbiArIDUwKTtcclxufTtcclxuXHJcbmV4cG9ydCBjb25zdCBzbGlkZVRvZ2dsZSA9IChlbGVtZW50LCBkdXJhdGlvbikgPT4ge1xyXG4gICAgd2luZG93LmdldENvbXB1dGVkU3R5bGUoZWxlbWVudCkuZGlzcGxheSA9PT0gXCJub25lXCIgPyBzbGlkZURvd24oZWxlbWVudCwgZHVyYXRpb24pIDogc2xpZGVVcChlbGVtZW50LCBkdXJhdGlvbik7XHJcbn07XHJcblxyXG5leHBvcnQgY29uc3QgZmFkZUluID0gKGVsZW1lbnQsIF9vcHRpb25zID0ge30pID0+IHtcclxuICAgIGNvbnN0IG9wdGlvbnMgPSB7XHJcbiAgICAgICAgZHVyYXRpb246IDMwMCxcclxuICAgICAgICBkaXNwbGF5OiBudWxsLFxyXG4gICAgICAgIG9wYWNpdHk6IDEsXHJcbiAgICAgICAgY2FsbGJhY2s6IG51bGwsXHJcbiAgICB9O1xyXG5cclxuICAgIE9iamVjdC5hc3NpZ24ob3B0aW9ucywgX29wdGlvbnMpO1xyXG5cclxuICAgIGVsZW1lbnQuc3R5bGUub3BhY2l0eSA9IDA7XHJcbiAgICBlbGVtZW50LnN0eWxlLmRpc3BsYXkgPSBvcHRpb25zLmRpc3BsYXkgfHwgXCJibG9ja1wiO1xyXG5cclxuICAgIHNldFRpbWVvdXQoKCkgPT4ge1xyXG4gICAgICAgIGVsZW1lbnQuc3R5bGUudHJhbnNpdGlvbiA9IGAke29wdGlvbnMuZHVyYXRpb259bXMgb3BhY2l0eSBlYXNlYDtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLm9wYWNpdHkgPSBvcHRpb25zLm9wYWNpdHk7XHJcbiAgICB9LCA1KTtcclxuXHJcbiAgICBzZXRUaW1lb3V0KCgpID0+IHtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwidHJhbnNpdGlvblwiKTtcclxuICAgICAgICAhIW9wdGlvbnMuY2FsbGJhY2sgJiYgb3B0aW9ucy5jYWxsYmFjaygpO1xyXG4gICAgfSwgb3B0aW9ucy5kdXJhdGlvbiArIDUwKTtcclxufTtcclxuXHJcbmV4cG9ydCBjb25zdCBmYWRlT3V0ID0gKGVsZW1lbnQsIF9vcHRpb25zID0ge30pID0+IHtcclxuICAgIGNvbnN0IG9wdGlvbnMgPSB7XHJcbiAgICAgICAgZHVyYXRpb246IDMwMCxcclxuICAgICAgICBkaXNwbGF5OiBudWxsLFxyXG4gICAgICAgIG9wYWNpdHk6IDAsXHJcbiAgICAgICAgY2FsbGJhY2s6IG51bGwsXHJcbiAgICB9O1xyXG5cclxuICAgIE9iamVjdC5hc3NpZ24ob3B0aW9ucywgX29wdGlvbnMpO1xyXG5cclxuICAgIGVsZW1lbnQuc3R5bGUub3BhY2l0eSA9IDE7XHJcbiAgICBlbGVtZW50LnN0eWxlLmRpc3BsYXkgPSBvcHRpb25zLmRpc3BsYXkgfHwgXCJibG9ja1wiO1xyXG5cclxuICAgIHNldFRpbWVvdXQoKCkgPT4ge1xyXG4gICAgICAgIGVsZW1lbnQuc3R5bGUudHJhbnNpdGlvbiA9IGAke29wdGlvbnMuZHVyYXRpb259bXMgb3BhY2l0eSBlYXNlYDtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLm9wYWNpdHkgPSBvcHRpb25zLm9wYWNpdHk7XHJcbiAgICB9LCA1KTtcclxuXHJcbiAgICBzZXRUaW1lb3V0KCgpID0+IHtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLmRpc3BsYXkgPSBcIm5vbmVcIjtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwidHJhbnNpdGlvblwiKTtcclxuICAgICAgICAhIW9wdGlvbnMuY2FsbGJhY2sgJiYgb3B0aW9ucy5jYWxsYmFjaygpO1xyXG4gICAgfSwgb3B0aW9ucy5kdXJhdGlvbiArIDUwKTtcclxufTtcclxuXHJcbmV4cG9ydCBjb25zdCBmYWRlVG9nZ2xlID0gKGVsZW1lbnQsIG9wdGlvbnMpID0+IHtcclxuICAgIHdpbmRvdy5nZXRDb21wdXRlZFN0eWxlKGVsZW1lbnQpLmRpc3BsYXkgPT09IFwibm9uZVwiID8gZmFkZUluKGVsZW1lbnQsIG9wdGlvbnMpIDogZmFkZU91dChlbGVtZW50LCBvcHRpb25zKTtcclxufTtcclxuXHJcbmV4cG9ydCBjb25zdCBvZmZzZXQgPSAoZWxlbWVudCkgPT4ge1xyXG4gICAgaWYgKCFlbGVtZW50LmdldENsaWVudFJlY3RzKCkubGVuZ3RoKSB7XHJcbiAgICAgICAgcmV0dXJuIHsgdG9wOiAwLCBsZWZ0OiAwIH07XHJcbiAgICB9XHJcblxyXG4gICAgLy8gR2V0IGRvY3VtZW50LXJlbGF0aXZlIHBvc2l0aW9uIGJ5IGFkZGluZyB2aWV3cG9ydCBzY3JvbGwgdG8gdmlld3BvcnQtcmVsYXRpdmUgZ0JDUlxyXG4gICAgY29uc3QgcmVjdCA9IGVsZW1lbnQuZ2V0Qm91bmRpbmdDbGllbnRSZWN0KCk7XHJcbiAgICBjb25zdCB3aW4gPSBlbGVtZW50Lm93bmVyRG9jdW1lbnQuZGVmYXVsdFZpZXc7XHJcbiAgICByZXR1cm4ge1xyXG4gICAgICAgIHRvcDogcmVjdC50b3AgKyB3aW4ucGFnZVlPZmZzZXQsXHJcbiAgICAgICAgbGVmdDogcmVjdC5sZWZ0ICsgd2luLnBhZ2VYT2Zmc2V0LFxyXG4gICAgfTtcclxufTtcclxuXHJcbmV4cG9ydCBjb25zdCB2aXNpYmxlID0gKGVsZW1lbnQpID0+IHtcclxuICAgIGlmICghZWxlbWVudCkge1xyXG4gICAgICAgIHJldHVybiBmYWxzZTtcclxuICAgIH1cclxuXHJcbiAgICByZXR1cm4gISEoZWxlbWVudC5vZmZzZXRXaWR0aCB8fCBlbGVtZW50Lm9mZnNldEhlaWdodCB8fCBlbGVtZW50LmdldENsaWVudFJlY3RzKCkubGVuZ3RoKTtcclxufTtcclxuXHJcbmV4cG9ydCBjb25zdCBnZXRTaWJsaW5ncyA9IChlKSA9PiB7XHJcbiAgICAvLyBmb3IgY29sbGVjdGluZyBzaWJsaW5nc1xyXG4gICAgY29uc3Qgc2libGluZ3MgPSBbXTtcclxuXHJcbiAgICAvLyBpZiBubyBwYXJlbnQsIHJldHVybiBubyBzaWJsaW5nXHJcbiAgICBpZiAoIWUucGFyZW50Tm9kZSkge1xyXG4gICAgICAgIHJldHVybiBzaWJsaW5ncztcclxuICAgIH1cclxuXHJcbiAgICAvLyBmaXJzdCBjaGlsZCBvZiB0aGUgcGFyZW50IG5vZGVcclxuICAgIGxldCBzaWJsaW5nID0gZS5wYXJlbnROb2RlLmZpcnN0Q2hpbGQ7XHJcblxyXG4gICAgLy8gY29sbGVjdGluZyBzaWJsaW5nc1xyXG4gICAgd2hpbGUgKHNpYmxpbmcpIHtcclxuICAgICAgICBpZiAoc2libGluZy5ub2RlVHlwZSA9PT0gMSAmJiBzaWJsaW5nICE9PSBlKSB7XHJcbiAgICAgICAgICAgIHNpYmxpbmdzLnB1c2goc2libGluZyk7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICBzaWJsaW5nID0gc2libGluZy5uZXh0U2libGluZztcclxuICAgIH1cclxuXHJcbiAgICByZXR1cm4gc2libGluZ3M7XHJcbn07XHJcblxyXG4vLyBSZXR1cm5zIHRydWUgaWYgaXQgaXMgYSBET00gZWxlbWVudFxyXG5leHBvcnQgY29uc3QgaXNFbGVtZW50ID0gKG8pID0+IHtcclxuICAgIHJldHVybiB0eXBlb2YgSFRNTEVsZW1lbnQgPT09IFwib2JqZWN0XCJcclxuICAgICAgICA/IG8gaW5zdGFuY2VvZiBIVE1MRWxlbWVudCAvLyBET00yXHJcbiAgICAgICAgOiBvICYmIHR5cGVvZiBvID09PSBcIm9iamVjdFwiICYmIG8gIT09IG51bGwgJiYgby5ub2RlVHlwZSA9PT0gMSAmJiB0eXBlb2Ygby5ub2RlTmFtZSA9PT0gXCJzdHJpbmdcIjtcclxufTtcclxuXHJcbmV4cG9ydCBjb25zdCByZWdpc3RlcldpZGdldCA9IChjbGFzc05hbWUsIHdpZGdldE5hbWUsIHNraW4gPSBcImRlZmF1bHRcIikgPT4ge1xyXG4gICAgaWYgKCEoY2xhc3NOYW1lIHx8IHdpZGdldE5hbWUpKSB7XHJcbiAgICAgICAgcmV0dXJuO1xyXG4gICAgfVxyXG5cclxuICAgIC8qKlxyXG4gICAgICogQmVjYXVzZSBFbGVtZW50b3IgcGx1Z2luIHVzZXMgalF1ZXJ5IGN1c3RvbSBldmVudCxcclxuICAgICAqIFdlIGFsc28gaGF2ZSB0byB1c2UgalF1ZXJ5IHRvIHVzZSB0aGlzIGV2ZW50XHJcbiAgICAgKi9cclxuICAgIGpRdWVyeSh3aW5kb3cpLm9uKFwiZWxlbWVudG9yL2Zyb250ZW5kL2luaXRcIiwgKCkgPT4ge1xyXG4gICAgICAgIGNvbnN0IGFkZEhhbmRsZXIgPSAoJGVsZW1lbnQpID0+IHtcclxuICAgICAgICAgICAgZWxlbWVudG9yRnJvbnRlbmQuZWxlbWVudHNIYW5kbGVyLmFkZEhhbmRsZXIoY2xhc3NOYW1lLCB7XHJcbiAgICAgICAgICAgICAgICAkZWxlbWVudCxcclxuICAgICAgICAgICAgfSk7XHJcbiAgICAgICAgfTtcclxuXHJcbiAgICAgICAgZWxlbWVudG9yRnJvbnRlbmQuaG9va3MuYWRkQWN0aW9uKGBmcm9udGVuZC9lbGVtZW50X3JlYWR5LyR7d2lkZ2V0TmFtZX0uJHtza2lufWAsIGFkZEhhbmRsZXIpO1xyXG4gICAgfSk7XHJcbn07XHJcbiIsImltcG9ydCB7IGZhZGVJbiwgZmFkZU91dCwgcmVnaXN0ZXJXaWRnZXQgfSBmcm9tIFwiLi4vbGliL3V0aWxzXCI7XHJcblxyXG5jbGFzcyBPRVdfTmV3c2xldHRlciBleHRlbmRzIGVsZW1lbnRvck1vZHVsZXMuZnJvbnRlbmQuaGFuZGxlcnMuQmFzZSB7XHJcbiAgICBnZXREZWZhdWx0U2V0dGluZ3MoKSB7XHJcbiAgICAgICAgcmV0dXJuIHtcclxuICAgICAgICAgICAgc2VsZWN0b3JzOiB7XHJcbiAgICAgICAgICAgICAgICBzdWJzY3JpYmVGb3JtOiBcIiNtYy1lbWJlZGRlZC1zdWJzY3JpYmUtZm9ybVwiLFxyXG4gICAgICAgICAgICAgICAgc3VibWl0QnRuOiBcImJ1dHRvblwiLFxyXG4gICAgICAgICAgICAgICAgZW1haWxGaWVsZDogXCIuZW1haWxcIixcclxuICAgICAgICAgICAgICAgIGVtYWlsRmllbGRFcnJvcjogXCIuZW1haWwtZXJyXCIsXHJcbiAgICAgICAgICAgICAgICBHRFBSRmllbGQ6IFwiLmdkcHJcIixcclxuICAgICAgICAgICAgICAgIEdEUFJGaWVsZEVycm9yOiBcIi5nZHByLWVyclwiLFxyXG4gICAgICAgICAgICAgICAgcmVzcG9uc2VNZXNzYWdlOiBcIi5yZXMtbXNnXCIsXHJcbiAgICAgICAgICAgICAgICBlcnJvck1lc3NhZ2U6IFwiLmVyci1tc2dcIixcclxuICAgICAgICAgICAgICAgIHJlcXVpcmU6IFwiLnJlcVwiLFxyXG4gICAgICAgICAgICAgICAgbm90VmFsaWQ6IFwiLm5vdC12YWxpZFwiLFxyXG4gICAgICAgICAgICAgICAgc3VjY2VzczogXCIuc3VjY2Vzc1wiLFxyXG4gICAgICAgICAgICAgICAgZmFpbGVkOiBcIi5mYWlsZWRcIixcclxuICAgICAgICAgICAgfSxcclxuICAgICAgICB9O1xyXG4gICAgfVxyXG5cclxuICAgIGdldERlZmF1bHRFbGVtZW50cygpIHtcclxuICAgICAgICBjb25zdCBlbGVtZW50ID0gdGhpcy4kZWxlbWVudC5nZXQoMCk7XHJcbiAgICAgICAgY29uc3Qgc2VsZWN0b3JzID0gdGhpcy5nZXRTZXR0aW5ncyhcInNlbGVjdG9yc1wiKTtcclxuXHJcbiAgICAgICAgcmV0dXJuIHtcclxuICAgICAgICAgICAgc3Vic2NyaWJlRm9ybTogZWxlbWVudC5xdWVyeVNlbGVjdG9yKHNlbGVjdG9ycy5zdWJzY3JpYmVGb3JtKSxcclxuICAgICAgICAgICAgc3VibWl0QnRuOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3Ioc2VsZWN0b3JzLnN1Ym1pdEJ0biksXHJcbiAgICAgICAgICAgIGVtYWlsRmllbGQ6IGVsZW1lbnQucXVlcnlTZWxlY3RvcihzZWxlY3RvcnMuZW1haWxGaWVsZCksXHJcbiAgICAgICAgICAgIEdEUFJGaWVsZDogZWxlbWVudC5xdWVyeVNlbGVjdG9yKHNlbGVjdG9ycy5HRFBSRmllbGQpLFxyXG4gICAgICAgICAgICByZXNwb25zZU1lc3NhZ2VzOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoc2VsZWN0b3JzLnJlc3BvbnNlTWVzc2FnZSksXHJcbiAgICAgICAgICAgIGVycm9yTWVzc2FnZXM6IGVsZW1lbnQucXVlcnlTZWxlY3RvckFsbChzZWxlY3RvcnMuZXJyb3JNZXNzYWdlKSxcclxuICAgICAgICB9O1xyXG4gICAgfVxyXG5cclxuICAgIG9uSW5pdCguLi5hcmdzKSB7XHJcbiAgICAgICAgc3VwZXIub25Jbml0KC4uLmFyZ3MpO1xyXG5cclxuICAgICAgICB0aGlzLnNldHVwRXZlbnRMaXN0ZW5lcnMoKTtcclxuICAgIH1cclxuXHJcbiAgICBzZXR1cEV2ZW50TGlzdGVuZXJzKCkge1xyXG4gICAgICAgIHRoaXMuZWxlbWVudHMuc3Vic2NyaWJlRm9ybT8uYWRkRXZlbnRMaXN0ZW5lcihcInN1Ym1pdFwiLCB0aGlzLm9uU3VibWl0U3Vic2NyaWJlRm9ybS5iaW5kKHRoaXMpKTtcclxuICAgIH1cclxuXHJcbiAgICBvblN1Ym1pdFN1YnNjcmliZUZvcm0oZXZlbnQpIHtcclxuICAgICAgICBldmVudC5wcmV2ZW50RGVmYXVsdCgpO1xyXG5cclxuICAgICAgICBjb25zdCBpc0Zvcm1BbGxvd2VkU3VibWl0dGVkID0gdGhpcy5jaGVja0Zvcm1GaWVsZHMoKTtcclxuXHJcbiAgICAgICAgaWYgKGlzRm9ybUFsbG93ZWRTdWJtaXR0ZWQpIHtcclxuICAgICAgICAgICAgY29uc3QgZWxlbWVudCA9IHRoaXMuJGVsZW1lbnQuZ2V0KDApO1xyXG4gICAgICAgICAgICBjb25zdCBzZWxlY3RvcnMgPSB0aGlzLmdldFNldHRpbmdzKFwic2VsZWN0b3JzXCIpO1xyXG4gICAgICAgICAgICBjb25zdCBlbWFpbEFkcmVzcyA9IHRoaXMuZWxlbWVudHMuZW1haWxGaWVsZC52YWx1ZS50cmltKCk7XHJcblxyXG4gICAgICAgICAgICB0aGlzLmVsZW1lbnRzLnN1Ym1pdEJ0bi5kaXNhYmxlZCA9IHRydWU7XHJcblxyXG4gICAgICAgICAgICBjb25zdCBmb3JtRGF0YSA9IG5ldyBGb3JtRGF0YSgpO1xyXG4gICAgICAgICAgICBmb3JtRGF0YS5hcHBlbmQoXCJhY3Rpb25cIiwgXCJvZXdfbmV3c2xldHRlcl9mb3JtXCIpO1xyXG4gICAgICAgICAgICBmb3JtRGF0YS5hcHBlbmQoXCJub25jZVwiLCBuZXdzbGV0dGVyRGF0YS5ub25jZSk7XHJcbiAgICAgICAgICAgIGZvcm1EYXRhLmFwcGVuZChcImVtYWlsXCIsIGVtYWlsQWRyZXNzKTtcclxuXHJcbiAgICAgICAgICAgIGF4aW9zLnBvc3QobmV3c2xldHRlckRhdGEuYWpheF91cmwsIGZvcm1EYXRhKS50aGVuKCh7IGRhdGEgfSkgPT4ge1xyXG4gICAgICAgICAgICAgICAgY29uc3QgbWVzc2FnZSA9IGRhdGEuc3RhdHVzXHJcbiAgICAgICAgICAgICAgICAgICAgPyBlbGVtZW50LnF1ZXJ5U2VsZWN0b3IoYCR7c2VsZWN0b3JzLnJlc3BvbnNlTWVzc2FnZX0ke3NlbGVjdG9ycy5zdWNjZXNzfWApXHJcbiAgICAgICAgICAgICAgICAgICAgOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3IoYCR7c2VsZWN0b3JzLnJlc3BvbnNlTWVzc2FnZX0ke3NlbGVjdG9ycy5mYWlsZWR9YCk7XHJcblxyXG4gICAgICAgICAgICAgICAgZmFkZUluKG1lc3NhZ2UpO1xyXG4gICAgICAgICAgICAgICAgdGhpcy5lbGVtZW50cy5zdWJtaXRCdG4uZGlzYWJsZWQgPSBmYWxzZTtcclxuXHJcbiAgICAgICAgICAgICAgICBzZXRUaW1lb3V0KCgpID0+IHtcclxuICAgICAgICAgICAgICAgICAgICBmYWRlT3V0KG1lc3NhZ2UpO1xyXG4gICAgICAgICAgICAgICAgfSwgNTAwMCk7XHJcbiAgICAgICAgICAgIH0pO1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuXHJcbiAgICBjaGVja0Zvcm1GaWVsZHMoKSB7XHJcbiAgICAgICAgY29uc3QgZWxlbWVudCA9IHRoaXMuJGVsZW1lbnQuZ2V0KDApO1xyXG4gICAgICAgIGNvbnN0IHNlbGVjdG9ycyA9IHRoaXMuZ2V0U2V0dGluZ3MoXCJzZWxlY3RvcnNcIik7XHJcbiAgICAgICAgY29uc3QgZW1haWxBZHJlc3MgPSB0aGlzLmVsZW1lbnRzLmVtYWlsRmllbGQudmFsdWUudHJpbSgpO1xyXG4gICAgICAgIGxldCBpc0Zvcm1BbGxvd2VkU3VibWl0dGVkID0gdHJ1ZTtcclxuXHJcbiAgICAgICAgdGhpcy5lbGVtZW50cy5lcnJvck1lc3NhZ2VzLmZvckVhY2goKGVycm9yTWVzc2FnZSkgPT4ge1xyXG4gICAgICAgICAgICBlcnJvck1lc3NhZ2Uuc3R5bGUuZGlzcGxheSA9IFwibm9uZVwiO1xyXG4gICAgICAgIH0pO1xyXG5cclxuICAgICAgICB0aGlzLmVsZW1lbnRzLnJlc3BvbnNlTWVzc2FnZXMuZm9yRWFjaCgocmVzcG9uc2VNZXNzYWdlKSA9PiB7XHJcbiAgICAgICAgICAgIHJlc3BvbnNlTWVzc2FnZS5zdHlsZS5kaXNwbGF5ID0gXCJub25lXCI7XHJcbiAgICAgICAgfSk7XHJcblxyXG4gICAgICAgIGlmIChlbWFpbEFkcmVzcyA9PT0gXCJcIikge1xyXG4gICAgICAgICAgICBlbGVtZW50LnF1ZXJ5U2VsZWN0b3IoYCR7c2VsZWN0b3JzLmVtYWlsRmllbGRFcnJvcn0ke3NlbGVjdG9ycy5yZXF1aXJlfWApLnN0eWxlLmRpc3BsYXkgPSBcImJsb2NrXCI7XHJcbiAgICAgICAgICAgIGlzRm9ybUFsbG93ZWRTdWJtaXR0ZWQgPSBmYWxzZTtcclxuICAgICAgICB9IGVsc2UgaWYgKCF0aGlzLmlzRW1haWxBZGRyZXNzVmFsaWQoZW1haWxBZHJlc3MpKSB7XHJcbiAgICAgICAgICAgIGVsZW1lbnQucXVlcnlTZWxlY3RvcihgJHtzZWxlY3RvcnMuZW1haWxGaWVsZEVycm9yfSR7c2VsZWN0b3JzLm5vdFZhbGlkfWApLnN0eWxlLmRpc3BsYXkgPSBcImJsb2NrXCI7XHJcbiAgICAgICAgICAgIGlzRm9ybUFsbG93ZWRTdWJtaXR0ZWQgPSBmYWxzZTtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIGlmICghIXRoaXMuZWxlbWVudHMuR0RQUkZpZWxkICYmIHRoaXMuZWxlbWVudHMuR0RQUkZpZWxkLmNoZWNrZWQgPT09IGZhbHNlKSB7XHJcbiAgICAgICAgICAgIGVsZW1lbnQucXVlcnlTZWxlY3RvcihgJHtzZWxlY3RvcnMuR0RQUkZpZWxkRXJyb3J9JHtzZWxlY3RvcnMuZXJyb3JNZXNzYWdlfWApLnN0eWxlLmRpc3BsYXkgPSBcImJsb2NrXCI7XHJcbiAgICAgICAgICAgIGlzRm9ybUFsbG93ZWRTdWJtaXR0ZWQgPSBmYWxzZTtcclxuICAgICAgICB9XHJcblxyXG4gICAgICAgIHJldHVybiBpc0Zvcm1BbGxvd2VkU3VibWl0dGVkO1xyXG4gICAgfVxyXG5cclxuICAgIGlzRW1haWxBZGRyZXNzVmFsaWQoZW1haWxBZGRyZXNzKSB7XHJcbiAgICAgICAgY29uc3QgZW1haWxBZGRyZXNzUGF0dGVybiA9IG5ldyBSZWdFeHAoXHJcbiAgICAgICAgICAgIC9eKChcIltcXHctK1xcc10rXCIpfChbXFx3LStdKyg/OlxcLltcXHctK10rKSopfChcIltcXHctK1xcc10rXCIpKFtcXHctK10rKD86XFwuW1xcdy0rXSspKikpKEAoKD86W1xcdy0rXStcXC4pKlxcd1tcXHctK117MCw2Nn0pXFwuKFthLXpdezIsNn0oPzpcXC5bYS16XXsyfSk/KSQpfChAXFxbPygoMjVbMC01XVxcLnwyWzAtNF1bXFxkXVxcLnwxW1xcZF17Mn1cXC58W1xcZF17MSwyfVxcLikpKCgyNVswLTVdfDJbMC00XVtcXGRdfDFbXFxkXXsyfXxbXFxkXXsxLDJ9KVxcLil7Mn0oMjVbMC01XXwyWzAtNF1bXFxkXXwxW1xcZF17Mn18W1xcZF17MSwyfSlcXF0/JCkvaVxyXG4gICAgICAgICk7XHJcblxyXG4gICAgICAgIHJldHVybiBlbWFpbEFkZHJlc3NQYXR0ZXJuLnRlc3QoZW1haWxBZGRyZXNzKTtcclxuICAgIH1cclxufVxyXG5cclxucmVnaXN0ZXJXaWRnZXQoT0VXX05ld3NsZXR0ZXIsIFwib2V3LW5ld3NsZXR0ZXJcIik7XHJcbiJdfQ==
