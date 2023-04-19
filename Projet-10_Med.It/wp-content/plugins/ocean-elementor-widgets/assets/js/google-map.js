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

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

var OEW_GoogleMap = /*#__PURE__*/function (_elementorModules$fro) {
  _inherits(OEW_GoogleMap, _elementorModules$fro);

  var _super = _createSuper(OEW_GoogleMap);

  function OEW_GoogleMap() {
    var _this;

    _classCallCheck(this, OEW_GoogleMap);

    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    _this = _super.call.apply(_super, [this].concat(args));

    _defineProperty(_assertThisInitialized(_this), "googleMap", void 0);

    _defineProperty(_assertThisInitialized(_this), "infoWindow", void 0);

    return _this;
  }

  _createClass(OEW_GoogleMap, [{
    key: "getDefaultSettings",
    value: function getDefaultSettings() {
      return {
        selectors: {
          googleMap: ".oew-google-map"
        },
        addresses: [],
        zoom: 4,
        mapType: "roadmap",
        markerAnimation: null,
        streetViewControl: false,
        mapTypeControl: false,
        zoomControl: false,
        fullscreenControl: false,
        scrollToZoom: "none",
        styles: []
      };
    }
  }, {
    key: "getDefaultElements",
    value: function getDefaultElements() {
      var element = this.$element.get(0);
      var selectors = this.getSettings("selectors");
      return {
        googleMap: element.querySelector(selectors.googleMap)
      };
    }
  }, {
    key: "onInit",
    value: function onInit() {
      var _get2;

      for (var _len2 = arguments.length, args = new Array(_len2), _key2 = 0; _key2 < _len2; _key2++) {
        args[_key2] = arguments[_key2];
      }

      (_get2 = _get(_getPrototypeOf(OEW_GoogleMap.prototype), "onInit", this)).call.apply(_get2, [this].concat(args));

      this.setUserSettings();
      this.initGoogleMap();
    }
  }, {
    key: "initGoogleMap",
    value: function initGoogleMap() {
      var googleMapOptions = this.getGoogleMapOptions();
      this.googleMap = new google.maps.Map(this.elements.googleMap, googleMapOptions);
      this.setAddresses();
    }
  }, {
    key: "getGoogleMapOptions",
    value: function getGoogleMapOptions() {
      var settings = this.getSettings();
      var latitude = settings.addresses[0][0];
      var longitude = settings.addresses[0][1];
      return {
        center: new google.maps.LatLng(latitude, longitude),
        zoom: settings.zoom,
        mapTypeId: settings.mapType,
        streetViewControl: settings.streetViewControl,
        mapTypeControl: settings.mapTypeControl,
        zoomControl: settings.zoomControl,
        fullscreenControl: settings.fullscreenControl,
        gestureHandling: settings.scrollToZoom,
        styles: settings.styles
      };
    }
  }, {
    key: "setAddresses",
    value: function setAddresses() {
      var _this2 = this;

      var settings = this.getSettings();
      settings.addresses.forEach(function (address) {
        var addressLatitude = address[0];
        var addressLongitude = address[1];
        var addressTitle = address[3];

        if (!!addressLatitude && !!addressLongitude) {
          var markerIconType = address[5];
          var markerIconURL = address[6];
          var markerIconSize = address[7]; // Set address marker

          var marker = _this2.createMarker(addressLatitude, addressLongitude, addressTitle, markerIconType, markerIconURL, markerIconSize);

          var enableInfoWindow = address[2];
          var enableInfoWindowOnDocumentLoad = address[8];
          var infoWindowDescription = address[4];

          if (!!enableInfoWindow && addressTitle) {
            var infoWindow = _this2.createInfoWindow(marker, addressTitle, infoWindowDescription);

            if (!!enableInfoWindowOnDocumentLoad) {
              infoWindow.open(_this2.googleMap, marker);
            }

            google.maps.event.addListener(marker, "click", function () {
              infoWindow.open(_this2.googleMap, marker);
            });
            google.maps.event.addListener(_this2.googleMap, "click", function () {
              infoWindow.close();
            });
          }
        }
      });
    }
  }, {
    key: "createMarker",
    value: function createMarker(addressLatitude, addressLongitude, addressTitle, markerIconType, markerIconURL, markerIconSize) {
      var markerAnimation = this.getSettings("markerAnimation");
      var animation = null;

      switch (markerAnimation) {
        case "drop":
          animation = google.maps.Animation.DROP;
          break;

        case "bounce":
          animation = google.maps.Animation.BOUNCE;
          break;
      }

      return new google.maps.Marker({
        position: new google.maps.LatLng(addressLatitude, addressLongitude),
        map: this.googleMap,
        title: addressTitle,
        animation: animation,
        icon: markerIconType === "custom" ? {
          url: markerIconURL,
          scaledSize: new google.maps.Size(markerIconSize, markerIconSize),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(markerIconSize / 2, markerIconSize)
        } : ""
      });
    }
  }, {
    key: "createInfoWindow",
    value: function createInfoWindow(marker, addressTitle, infoWindowDescription) {
      var infoWindowOptinos = {};
      var datasetMaxWidth = this.elements.googleMap.dataset.iwMaxWidth;
      infoWindowOptinos.content = "\n        <div class=\"oew-infowindow-content\">\n            <div class=\"oew-infowindow-title\">".concat(addressTitle, "</div>\n            ").concat(!!infoWindowDescription ? "<div class=\"oew-infowindow-description\">".concat(infoWindowDescription, "</div>") : "", "\n        </div>");

      if (!!datasetMaxWidth) {
        infoWindowOptinos.maxWidth = datasetMaxWidth;
      }

      return new google.maps.InfoWindow(infoWindowOptinos);
    }
  }, {
    key: "setUserSettings",
    value: function setUserSettings() {
      var settings = this.getSettings();
      var datasetSettings = this.elements.googleMap.dataset;
      var elementSettings = this.getElementSettings();
      var addresses = !!datasetSettings.locations ? JSON.parse(datasetSettings.locations) : settings.addresses;
      var zoom = !Number.isNaN(Number(datasetSettings.zoom)) ? Number(datasetSettings.zoom) : settings.zoom;
      var mapType = !!elementSettings.map_type ? elementSettings.map_type : settings.mapType;
      var zoomControl = !!elementSettings.zoom_control ? elementSettings.zoom_control : settings.zoomControl;
      var styles = !!datasetSettings.customStyle ? JSON.parse(datasetSettings.customStyle) : settings.styles;
      var markerAnimation = !!elementSettings.marker_animation ? elementSettings.marker_animation : settings.markerAnimation;
      var streetViewControl = !!elementSettings.map_option_streetview ? elementSettings.map_option_streetview : settings.streetViewControl;
      var mapTypeControl = !!elementSettings.map_type_control ? elementSettings.map_type_control : settings.mapTypeControl;
      var fullscreenControl = !!elementSettings.fullscreen_control ? elementSettings.fullscreen_control : settings.fullscreenControl;
      var scrollToZoom = !!elementSettings.map_scroll_zoom ? elementSettings.map_scroll_zoom : settings.scrollToZoom;
      this.setSettings({
        addresses: addresses,
        zoom: zoom,
        mapType: mapType,
        markerAnimation: markerAnimation,
        streetViewControl: streetViewControl,
        mapTypeControl: mapTypeControl,
        zoomControl: zoomControl,
        fullscreenControl: fullscreenControl,
        scrollToZoom: scrollToZoom,
        styles: styles
      });
    }
  }]);

  return OEW_GoogleMap;
}(elementorModules.frontend.handlers.Base);

(0, _utils.registerWidget)(OEW_GoogleMap, "oew-google-map");

},{"../lib/utils":1}]},{},[2])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJhc3NldHMvc3JjL2pzL2xpYi91dGlscy5qcyIsImFzc2V0cy9zcmMvanMvd2lkZ2V0cy9nb29nbGUtbWFwLmpzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBOzs7Ozs7Ozs7O0FDQU8sSUFBTSxTQUFTLEdBQUcsU0FBWixTQUFZLENBQUMsT0FBRCxFQUE2QjtBQUFBLE1BQW5CLFFBQW1CLHVFQUFSLEdBQVE7QUFDbEQsTUFBSSxPQUFPLEdBQUcsTUFBTSxDQUFDLGdCQUFQLENBQXdCLE9BQXhCLEVBQWlDLE9BQS9DOztBQUVBLE1BQUksT0FBTyxLQUFLLE1BQWhCLEVBQXdCO0FBQ3BCLElBQUEsT0FBTyxHQUFHLE9BQVY7QUFDSDs7QUFFRCxFQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsa0JBQWQsR0FBbUMsUUFBbkM7QUFDQSxFQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsa0JBQWQsYUFBc0MsUUFBdEM7QUFFQSxFQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsT0FBZCxHQUF3QixDQUF4QjtBQUNBLEVBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxPQUFkLEdBQXdCLE9BQXhCO0FBQ0EsTUFBSSxNQUFNLEdBQUcsT0FBTyxDQUFDLFlBQXJCO0FBRUEsRUFBQSxPQUFPLENBQUMsS0FBUixDQUFjLE1BQWQsR0FBdUIsQ0FBdkI7QUFDQSxFQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMsT0FBZCxHQUF3QixDQUF4QjtBQUNBLEVBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxRQUFkLEdBQXlCLFFBQXpCO0FBRUEsRUFBQSxVQUFVLENBQUMsWUFBTTtBQUNiLElBQUEsT0FBTyxDQUFDLEtBQVIsQ0FBYyxNQUFkLGFBQTBCLE1BQTFCO0FBQ0gsR0FGUyxFQUVQLENBRk8sQ0FBVjtBQUlBLEVBQUEsTUFBTSxDQUFDLFVBQVAsQ0FBa0IsWUFBTTtBQUNwQixJQUFBLE9BQU8sQ0FBQyxLQUFSLENBQWMs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QyxlQUFwRCxHQUFzRSxRQUFRLENBQUMsWUFBcEc7QUFFQSxXQUFLLFdBQUwsQ0FBaUI7QUFDYixRQUFBLFNBQVMsRUFBRSxTQURFO0FBRWIsUUFBQSxJQUFJLEVBQUUsSUFGTztBQUdiLFFBQUEsT0FBTyxFQUFFLE9BSEk7QUFJYixRQUFBLGVBQWUsRUFBRSxlQUpKO0FBS2IsUUFBQSxpQkFBaUIsRUFBRSxpQkFMTjtBQU1iLFFBQUEsY0FBYyxFQUFFLGNBTkg7QUFPYixRQUFBLFdBQVcsRUFBRSxXQVBBO0FBUWIsUUFBQSxpQkFBaUIsRUFBRSxpQkFSTjtBQVNiLFFBQUEsWUFBWSxFQUFFLFlBVEQ7QUFVYixRQUFBLE1BQU0sRUFBRTtBQVZLLE9BQWpCO0FBWUg7Ozs7RUF0TXVCLGdCQUFnQixDQUFDLFFBQWpCLENBQTBCLFFBQTFCLENBQW1DLEk7O0FBeU0vRCwyQkFBZSxhQUFmLEVBQThCLGdCQUE5QiIsImZpbGUiOiJnZW5lcmF0ZWQuanMiLCJzb3VyY2VSb290IjoiIiwic291cmNlc0NvbnRlbnQiOlsiKGZ1bmN0aW9uKCl7ZnVuY3Rpb24gcihlLG4sdCl7ZnVuY3Rpb24gbyhpLGYpe2lmKCFuW2ldKXtpZighZVtpXSl7dmFyIGM9XCJmdW5jdGlvblwiPT10eXBlb2YgcmVxdWlyZSYmcmVxdWlyZTtpZighZiYmYylyZXR1cm4gYyhpLCEwKTtpZih1KXJldHVybiB1KGksITApO3ZhciBhPW5ldyBFcnJvcihcIkNhbm5vdCBmaW5kIG1vZHVsZSAnXCIraStcIidcIik7dGhyb3cgYS5jb2RlPVwiTU9EVUxFX05PVF9GT1VORFwiLGF9dmFyIHA9bltpXT17ZXhwb3J0czp7fX07ZVtpXVswXS5jYWxsKHAuZXhwb3J0cyxmdW5jdGlvbihyKXt2YXIgbj1lW2ldWzFdW3JdO3JldHVybiBvKG58fHIpfSxwLHAuZXhwb3J0cyxyLGUsbix0KX1yZXR1cm4gbltpXS5leHBvcnRzfWZvcih2YXIgdT1cImZ1bmN0aW9uXCI9PXR5cGVvZiByZXF1aXJlJiZyZXF1aXJlLGk9MDtpPHQubGVuZ3RoO2krKylvKHRbaV0pO3JldHVybiBvfXJldHVybiByfSkoKSIsImV4cG9ydCBjb25zdCBzbGlkZURvd24gPSAoZWxlbWVudCwgZHVyYXRpb24gPSAzMDApID0+IHtcclxuICAgIGxldCBkaXNwbGF5ID0gd2luZG93LmdldENvbXB1dGVkU3R5bGUoZWxlbWVudCkuZGlzcGxheTtcclxuXHJcbiAgICBpZiAoZGlzcGxheSA9PT0gXCJub25lXCIpIHtcclxuICAgICAgICBkaXNwbGF5ID0gXCJibG9ja1wiO1xyXG4gICAgfVxyXG5cclxuICAgIGVsZW1lbnQuc3R5bGUudHJhbnNpdGlvblByb3BlcnR5ID0gXCJoZWlnaHRcIjtcclxuICAgIGVsZW1lbnQuc3R5bGUudHJhbnNpdGlvbkR1cmF0aW9uID0gYCR7ZHVyYXRpb259bXNgO1xyXG5cclxuICAgIGVsZW1lbnQuc3R5bGUub3BhY2l0eSA9IDA7XHJcbiAgICBlbGVtZW50LnN0eWxlLmRpc3BsYXkgPSBkaXNwbGF5O1xyXG4gICAgbGV0IGhlaWdodCA9IGVsZW1lbnQub2Zmc2V0SGVpZ2h0O1xyXG5cclxuICAgIGVsZW1lbnQuc3R5bGUuaGVpZ2h0ID0gMDtcclxuICAgIGVsZW1lbnQuc3R5bGUub3BhY2l0eSA9IDE7XHJcbiAgICBlbGVtZW50LnN0eWxlLm92ZXJmbG93ID0gXCJoaWRkZW5cIjtcclxuXHJcbiAgICBzZXRUaW1lb3V0KCgpID0+IHtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLmhlaWdodCA9IGAke2hlaWdodH1weGA7XHJcbiAgICB9LCA1KTtcclxuXHJcbiAgICB3aW5kb3cuc2V0VGltZW91dCgoKSA9PiB7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcImhlaWdodFwiKTtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLnJlbW92ZVByb3BlcnR5KFwib3ZlcmZsb3dcIik7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcInRyYW5zaXRpb24tZHVyYXRpb25cIik7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcInRyYW5zaXRpb24tcHJvcGVydHlcIik7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcIm9wYWNpdHlcIik7XHJcbiAgICB9LCBkdXJhdGlvbiArIDUwKTtcclxufTtcclxuXHJcbmV4cG9ydCBjb25zdCBzbGlkZVVwID0gKGVsZW1lbnQsIGR1cmF0aW9uID0gMzAwKSA9PiB7XHJcbiAgICBlbGVtZW50LnN0eWxlLmJveFNpemluZyA9IFwiYm9yZGVyLWJveFwiO1xyXG4gICAgZWxlbWVudC5zdHlsZS50cmFuc2l0aW9uUHJvcGVydHkgPSBcImhlaWdodCwgbWFyZ2luXCI7XHJcbiAgICBlbGVtZW50LnN0eWxlLnRyYW5zaXRpb25EdXJhdGlvbiA9IGAke2R1cmF0aW9ufW1zYDtcclxuICAgIGVsZW1lbnQuc3R5bGUuaGVpZ2h0ID0gYCR7ZWxlbWVudC5vZmZzZXRIZWlnaHR9cHhgO1xyXG4gICAgZWxlbWVudC5zdHlsZS5tYXJnaW5Ub3AgPSAwO1xyXG4gICAgZWxlbWVudC5zdHlsZS5tYXJnaW5Cb3R0b20gPSAwO1xyXG4gICAgZWxlbWVudC5zdHlsZS5vdmVyZmxvdyA9IFwiaGlkZGVuXCI7XHJcblxyXG4gICAgc2V0VGltZW91dCgoKSA9PiB7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5oZWlnaHQgPSAwO1xyXG4gICAgfSwgNSk7XHJcblxyXG4gICAgd2luZG93LnNldFRpbWVvdXQoKCkgPT4ge1xyXG4gICAgICAgIGVsZW1lbnQuc3R5bGUuZGlzcGxheSA9IFwibm9uZVwiO1xyXG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJoZWlnaHRcIik7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcIm1hcmdpbi10b3BcIik7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcIm1hcmdpbi1ib3R0b21cIik7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcIm92ZXJmbG93XCIpO1xyXG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJ0cmFuc2l0aW9uLWR1cmF0aW9uXCIpO1xyXG4gICAgICAgIGVsZW1lbnQuc3R5bGUucmVtb3ZlUHJvcGVydHkoXCJ0cmFuc2l0aW9uLXByb3BlcnR5XCIpO1xyXG4gICAgfSwgZHVyYXRpb24gKyA1MCk7XHJcbn07XHJcblxyXG5leHBvcnQgY29uc3Qgc2xpZGVUb2dnbGUgPSAoZWxlbWVudCwgZHVyYXRpb24pID0+IHtcclxuICAgIHdpbmRvdy5nZXRDb21wdXRlZFN0eWxlKGVsZW1lbnQpLmRpc3BsYXkgPT09IFwibm9uZVwiID8gc2xpZGVEb3duKGVsZW1lbnQsIGR1cmF0aW9uKSA6IHNsaWRlVXAoZWxlbWVudCwgZHVyYXRpb24pO1xyXG59O1xyXG5cclxuZXhwb3J0IGNvbnN0IGZhZGVJbiA9IChlbGVtZW50LCBfb3B0aW9ucyA9IHt9KSA9PiB7XHJcbiAgICBjb25zdCBvcHRpb25zID0ge1xyXG4gICAgICAgIGR1cmF0aW9uOiAzMDAsXHJcbiAgICAgICAgZGlzcGxheTogbnVsbCxcclxuICAgICAgICBvcGFjaXR5OiAxLFxyXG4gICAgICAgIGNhbGxiYWNrOiBudWxsLFxyXG4gICAgfTtcclxuXHJcbiAgICBPYmplY3QuYXNzaWduKG9wdGlvbnMsIF9vcHRpb25zKTtcclxuXHJcbiAgICBlbGVtZW50LnN0eWxlLm9wYWNpdHkgPSAwO1xyXG4gICAgZWxlbWVudC5zdHlsZS5kaXNwbGF5ID0gb3B0aW9ucy5kaXNwbGF5IHx8IFwiYmxvY2tcIjtcclxuXHJcbiAgICBzZXRUaW1lb3V0KCgpID0+IHtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLnRyYW5zaXRpb24gPSBgJHtvcHRpb25zLmR1cmF0aW9ufW1zIG9wYWNpdHkgZWFzZWA7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5vcGFjaXR5ID0gb3B0aW9ucy5vcGFjaXR5O1xyXG4gICAgfSwgNSk7XHJcblxyXG4gICAgc2V0VGltZW91dCgoKSA9PiB7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcInRyYW5zaXRpb25cIik7XHJcbiAgICAgICAgISFvcHRpb25zLmNhbGxiYWNrICYmIG9wdGlvbnMuY2FsbGJhY2soKTtcclxuICAgIH0sIG9wdGlvbnMuZHVyYXRpb24gKyA1MCk7XHJcbn07XHJcblxyXG5leHBvcnQgY29uc3QgZmFkZU91dCA9IChlbGVtZW50LCBfb3B0aW9ucyA9IHt9KSA9PiB7XHJcbiAgICBjb25zdCBvcHRpb25zID0ge1xyXG4gICAgICAgIGR1cmF0aW9uOiAzMDAsXHJcbiAgICAgICAgZGlzcGxheTogbnVsbCxcclxuICAgICAgICBvcGFjaXR5OiAwLFxyXG4gICAgICAgIGNhbGxiYWNrOiBudWxsLFxyXG4gICAgfTtcclxuXHJcbiAgICBPYmplY3QuYXNzaWduKG9wdGlvbnMsIF9vcHRpb25zKTtcclxuXHJcbiAgICBlbGVtZW50LnN0eWxlLm9wYWNpdHkgPSAxO1xyXG4gICAgZWxlbWVudC5zdHlsZS5kaXNwbGF5ID0gb3B0aW9ucy5kaXNwbGF5IHx8IFwiYmxvY2tcIjtcclxuXHJcbiAgICBzZXRUaW1lb3V0KCgpID0+IHtcclxuICAgICAgICBlbGVtZW50LnN0eWxlLnRyYW5zaXRpb24gPSBgJHtvcHRpb25zLmR1cmF0aW9ufW1zIG9wYWNpdHkgZWFzZWA7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5vcGFjaXR5ID0gb3B0aW9ucy5vcGFjaXR5O1xyXG4gICAgfSwgNSk7XHJcblxyXG4gICAgc2V0VGltZW91dCgoKSA9PiB7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5kaXNwbGF5ID0gXCJub25lXCI7XHJcbiAgICAgICAgZWxlbWVudC5zdHlsZS5yZW1vdmVQcm9wZXJ0eShcInRyYW5zaXRpb25cIik7XHJcbiAgICAgICAgISFvcHRpb25zLmNhbGxiYWNrICYmIG9wdGlvbnMuY2FsbGJhY2soKTtcclxuICAgIH0sIG9wdGlvbnMuZHVyYXRpb24gKyA1MCk7XHJcbn07XHJcblxyXG5leHBvcnQgY29uc3QgZmFkZVRvZ2dsZSA9IChlbGVtZW50LCBvcHRpb25zKSA9PiB7XHJcbiAgICB3aW5kb3cuZ2V0Q29tcHV0ZWRTdHlsZShlbGVtZW50KS5kaXNwbGF5ID09PSBcIm5vbmVcIiA/IGZhZGVJbihlbGVtZW50LCBvcHRpb25zKSA6IGZhZGVPdXQoZWxlbWVudCwgb3B0aW9ucyk7XHJcbn07XHJcblxyXG5leHBvcnQgY29uc3Qgb2Zmc2V0ID0gKGVsZW1lbnQpID0+IHtcclxuICAgIGlmICghZWxlbWVudC5nZXRDbGllbnRSZWN0cygpLmxlbmd0aCkge1xyXG4gICAgICAgIHJldHVybiB7IHRvcDogMCwgbGVmdDogMCB9O1xyXG4gICAgfVxyXG5cclxuICAgIC8vIEdldCBkb2N1bWVudC1yZWxhdGl2ZSBwb3NpdGlvbiBieSBhZGRpbmcgdmlld3BvcnQgc2Nyb2xsIHRvIHZpZXdwb3J0LXJlbGF0aXZlIGdCQ1JcclxuICAgIGNvbnN0IHJlY3QgPSBlbGVtZW50LmdldEJvdW5kaW5nQ2xpZW50UmVjdCgpO1xyXG4gICAgY29uc3Qgd2luID0gZWxlbWVudC5vd25lckRvY3VtZW50LmRlZmF1bHRWaWV3O1xyXG4gICAgcmV0dXJuIHtcclxuICAgICAgICB0b3A6IHJlY3QudG9wICsgd2luLnBhZ2VZT2Zmc2V0LFxyXG4gICAgICAgIGxlZnQ6IHJlY3QubGVmdCArIHdpbi5wYWdlWE9mZnNldCxcclxuICAgIH07XHJcbn07XHJcblxyXG5leHBvcnQgY29uc3QgdmlzaWJsZSA9IChlbGVtZW50KSA9PiB7XHJcbiAgICBpZiAoIWVsZW1lbnQpIHtcclxuICAgICAgICByZXR1cm4gZmFsc2U7XHJcbiAgICB9XHJcblxyXG4gICAgcmV0dXJuICEhKGVsZW1lbnQub2Zmc2V0V2lkdGggfHwgZWxlbWVudC5vZmZzZXRIZWlnaHQgfHwgZWxlbWVudC5nZXRDbGllbnRSZWN0cygpLmxlbmd0aCk7XHJcbn07XHJcblxyXG5leHBvcnQgY29uc3QgZ2V0U2libGluZ3MgPSAoZSkgPT4ge1xyXG4gICAgLy8gZm9yIGNvbGxlY3Rpbmcgc2libGluZ3NcclxuICAgIGNvbnN0IHNpYmxpbmdzID0gW107XHJcblxyXG4gICAgLy8gaWYgbm8gcGFyZW50LCByZXR1cm4gbm8gc2libGluZ1xyXG4gICAgaWYgKCFlLnBhcmVudE5vZGUpIHtcclxuICAgICAgICByZXR1cm4gc2libGluZ3M7XHJcbiAgICB9XHJcblxyXG4gICAgLy8gZmlyc3QgY2hpbGQgb2YgdGhlIHBhcmVudCBub2RlXHJcbiAgICBsZXQgc2libGluZyA9IGUucGFyZW50Tm9kZS5maXJzdENoaWxkO1xyXG5cclxuICAgIC8vIGNvbGxlY3Rpbmcgc2libGluZ3NcclxuICAgIHdoaWxlIChzaWJsaW5nKSB7XHJcbiAgICAgICAgaWYgKHNpYmxpbmcubm9kZVR5cGUgPT09IDEgJiYgc2libGluZyAhPT0gZSkge1xyXG4gICAgICAgICAgICBzaWJsaW5ncy5wdXNoKHNpYmxpbmcpO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgc2libGluZyA9IHNpYmxpbmcubmV4dFNpYmxpbmc7XHJcbiAgICB9XHJcblxyXG4gICAgcmV0dXJuIHNpYmxpbmdzO1xyXG59O1xyXG5cclxuLy8gUmV0dXJucyB0cnVlIGlmIGl0IGlzIGEgRE9NIGVsZW1lbnRcclxuZXhwb3J0IGNvbnN0IGlzRWxlbWVudCA9IChvKSA9PiB7XHJcbiAgICByZXR1cm4gdHlwZW9mIEhUTUxFbGVtZW50ID09PSBcIm9iamVjdFwiXHJcbiAgICAgICAgPyBvIGluc3RhbmNlb2YgSFRNTEVsZW1lbnQgLy8gRE9NMlxyXG4gICAgICAgIDogbyAmJiB0eXBlb2YgbyA9PT0gXCJvYmplY3RcIiAmJiBvICE9PSBudWxsICYmIG8ubm9kZVR5cGUgPT09IDEgJiYgdHlwZW9mIG8ubm9kZU5hbWUgPT09IFwic3RyaW5nXCI7XHJcbn07XHJcblxyXG5leHBvcnQgY29uc3QgcmVnaXN0ZXJXaWRnZXQgPSAoY2xhc3NOYW1lLCB3aWRnZXROYW1lLCBza2luID0gXCJkZWZhdWx0XCIpID0+IHtcclxuICAgIGlmICghKGNsYXNzTmFtZSB8fCB3aWRnZXROYW1lKSkge1xyXG4gICAgICAgIHJldHVybjtcclxuICAgIH1cclxuXHJcbiAgICAvKipcclxuICAgICAqIEJlY2F1c2UgRWxlbWVudG9yIHBsdWdpbiB1c2VzIGpRdWVyeSBjdXN0b20gZXZlbnQsXHJcbiAgICAgKiBXZSBhbHNvIGhhdmUgdG8gdXNlIGpRdWVyeSB0byB1c2UgdGhpcyBldmVudFxyXG4gICAgICovXHJcbiAgICBqUXVlcnkod2luZG93KS5vbihcImVsZW1lbnRvci9mcm9udGVuZC9pbml0XCIsICgpID0+IHtcclxuICAgICAgICBjb25zdCBhZGRIYW5kbGVyID0gKCRlbGVtZW50KSA9PiB7XHJcbiAgICAgICAgICAgIGVsZW1lbnRvckZyb250ZW5kLmVsZW1lbnRzSGFuZGxlci5hZGRIYW5kbGVyKGNsYXNzTmFtZSwge1xyXG4gICAgICAgICAgICAgICAgJGVsZW1lbnQsXHJcbiAgICAgICAgICAgIH0pO1xyXG4gICAgICAgIH07XHJcblxyXG4gICAgICAgIGVsZW1lbnRvckZyb250ZW5kLmhvb2tzLmFkZEFjdGlvbihgZnJvbnRlbmQvZWxlbWVudF9yZWFkeS8ke3dpZGdldE5hbWV9LiR7c2tpbn1gLCBhZGRIYW5kbGVyKTtcclxuICAgIH0pO1xyXG59O1xyXG4iLCJpbXBvcnQgeyByZWdpc3RlcldpZGdldCB9IGZyb20gXCIuLi9saWIvdXRpbHNcIjtcclxuXHJcbmNsYXNzIE9FV19Hb29nbGVNYXAgZXh0ZW5kcyBlbGVtZW50b3JNb2R1bGVzLmZyb250ZW5kLmhhbmRsZXJzLkJhc2Uge1xyXG4gICAgZ29vZ2xlTWFwO1xyXG4gICAgaW5mb1dpbmRvdztcclxuXHJcbiAgICBnZXREZWZhdWx0U2V0dGluZ3MoKSB7XHJcbiAgICAgICAgcmV0dXJuIHtcclxuICAgICAgICAgICAgc2VsZWN0b3JzOiB7XHJcbiAgICAgICAgICAgICAgICBnb29nbGVNYXA6IFwiLm9ldy1nb29nbGUtbWFwXCIsXHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIGFkZHJlc3NlczogW10sXHJcbiAgICAgICAgICAgIHpvb206IDQsXHJcbiAgICAgICAgICAgIG1hcFR5cGU6IFwicm9hZG1hcFwiLFxyXG4gICAgICAgICAgICBtYXJrZXJBbmltYXRpb246IG51bGwsXHJcbiAgICAgICAgICAgIHN0cmVldFZpZXdDb250cm9sOiBmYWxzZSxcclxuICAgICAgICAgICAgbWFwVHlwZUNvbnRyb2w6IGZhbHNlLFxyXG4gICAgICAgICAgICB6b29tQ29udHJvbDogZmFsc2UsXHJcbiAgICAgICAgICAgIGZ1bGxzY3JlZW5Db250cm9sOiBmYWxzZSxcclxuICAgICAgICAgICAgc2Nyb2xsVG9ab29tOiBcIm5vbmVcIixcclxuICAgICAgICAgICAgc3R5bGVzOiBbXSxcclxuICAgICAgICB9O1xyXG4gICAgfVxyXG5cclxuICAgIGdldERlZmF1bHRFbGVtZW50cygpIHtcclxuICAgICAgICBjb25zdCBlbGVtZW50ID0gdGhpcy4kZWxlbWVudC5nZXQoMCk7XHJcbiAgICAgICAgY29uc3Qgc2VsZWN0b3JzID0gdGhpcy5nZXRTZXR0aW5ncyhcInNlbGVjdG9yc1wiKTtcclxuXHJcbiAgICAgICAgcmV0dXJuIHtcclxuICAgICAgICAgICAgZ29vZ2xlTWFwOiBlbGVtZW50LnF1ZXJ5U2VsZWN0b3Ioc2VsZWN0b3JzLmdvb2dsZU1hcCksXHJcbiAgICAgICAgfTtcclxuICAgIH1cclxuXHJcbiAgICBvbkluaXQoLi4uYXJncykge1xyXG4gICAgICAgIHN1cGVyLm9uSW5pdCguLi5hcmdzKTtcclxuXHJcbiAgICAgICAgdGhpcy5zZXRVc2VyU2V0dGluZ3MoKTtcclxuICAgICAgICB0aGlzLmluaXRHb29nbGVNYXAoKTtcclxuICAgIH1cclxuXHJcbiAgICBpbml0R29vZ2xlTWFwKCkge1xyXG4gICAgICAgIGNvbnN0IGdvb2dsZU1hcE9wdGlvbnMgPSB0aGlzLmdldEdvb2dsZU1hcE9wdGlvbnMoKTtcclxuICAgICAgICB0aGlzLmdvb2dsZU1hcCA9IG5ldyBnb29nbGUubWFwcy5NYXAodGhpcy5lbGVtZW50cy5nb29nbGVNYXAsIGdvb2dsZU1hcE9wdGlvbnMpO1xyXG5cclxuICAgICAgICB0aGlzLnNldEFkZHJlc3NlcygpO1xyXG4gICAgfVxyXG5cclxuICAgIGdldEdvb2dsZU1hcE9wdGlvbnMoKSB7XHJcbiAgICAgICAgY29uc3Qgc2V0dGluZ3MgPSB0aGlzLmdldFNldHRpbmdzKCk7XHJcbiAgICAgICAgY29uc3QgbGF0aXR1ZGUgPSBzZXR0aW5ncy5hZGRyZXNzZXNbMF1bMF07XHJcbiAgICAgICAgY29uc3QgbG9uZ2l0dWRlID0gc2V0dGluZ3MuYWRkcmVzc2VzWzBdWzFdO1xyXG5cclxuICAgICAgICByZXR1cm4ge1xyXG4gICAgICAgICAgICBjZW50ZXI6IG5ldyBnb29nbGUubWFwcy5MYXRMbmcobGF0aXR1ZGUsIGxvbmdpdHVkZSksXHJcbiAgICAgICAgICAgIHpvb206IHNldHRpbmdzLnpvb20sXHJcbiAgICAgICAgICAgIG1hcFR5cGVJZDogc2V0dGluZ3MubWFwVHlwZSxcclxuICAgICAgICAgICAgc3RyZWV0Vmlld0NvbnRyb2w6IHNldHRpbmdzLnN0cmVldFZpZXdDb250cm9sLFxyXG4gICAgICAgICAgICBtYXBUeXBlQ29udHJvbDogc2V0dGluZ3MubWFwVHlwZUNvbnRyb2wsXHJcbiAgICAgICAgICAgIHpvb21Db250cm9sOiBzZXR0aW5ncy56b29tQ29udHJvbCxcclxuICAgICAgICAgICAgZnVsbHNjcmVlbkNvbnRyb2w6IHNldHRpbmdzLmZ1bGxzY3JlZW5Db250cm9sLFxyXG4gICAgICAgICAgICBnZXN0dXJlSGFuZGxpbmc6IHNldHRpbmdzLnNjcm9sbFRvWm9vbSxcclxuICAgICAgICAgICAgc3R5bGVzOiBzZXR0aW5ncy5zdHlsZXMsXHJcbiAgICAgICAgfTtcclxuICAgIH1cclxuXHJcbiAgICBzZXRBZGRyZXNzZXMoKSB7XHJcbiAgICAgICAgY29uc3Qgc2V0dGluZ3MgPSB0aGlzLmdldFNldHRpbmdzKCk7XHJcblxyXG4gICAgICAgIHNldHRpbmdzLmFkZHJlc3Nlcy5mb3JFYWNoKChhZGRyZXNzKSA9PiB7XHJcbiAgICAgICAgICAgIGNvbnN0IGFkZHJlc3NMYXRpdHVkZSA9IGFkZHJlc3NbMF07XHJcbiAgICAgICAgICAgIGNvbnN0IGFkZHJlc3NMb25naXR1ZGUgPSBhZGRyZXNzWzFdO1xyXG4gICAgICAgICAgICBjb25zdCBhZGRyZXNzVGl0bGUgPSBhZGRyZXNzWzNdO1xyXG5cclxuICAgICAgICAgICAgaWYgKCEhYWRkcmVzc0xhdGl0dWRlICYmICEhYWRkcmVzc0xvbmdpdHVkZSkge1xyXG4gICAgICAgICAgICAgICAgY29uc3QgbWFya2VySWNvblR5cGUgPSBhZGRyZXNzWzVdO1xyXG4gICAgICAgICAgICAgICAgY29uc3QgbWFya2VySWNvblVSTCA9IGFkZHJlc3NbNl07XHJcbiAgICAgICAgICAgICAgICBjb25zdCBtYXJrZXJJY29uU2l6ZSA9IGFkZHJlc3NbN107XHJcblxyXG4gICAgICAgICAgICAgICAgLy8gU2V0IGFkZHJlc3MgbWFya2VyXHJcbiAgICAgICAgICAgICAgICBjb25zdCBtYXJrZXIgPSB0aGlzLmNyZWF0ZU1hcmtlcihcclxuICAgICAgICAgICAgICAgICAgICBhZGRyZXNzTGF0aXR1ZGUsXHJcbiAgICAgICAgICAgICAgICAgICAgYWRkcmVzc0xvbmdpdHVkZSxcclxuICAgICAgICAgICAgICAgICAgICBhZGRyZXNzVGl0bGUsXHJcbiAgICAgICAgICAgICAgICAgICAgbWFya2VySWNvblR5cGUsXHJcbiAgICAgICAgICAgICAgICAgICAgbWFya2VySWNvblVSTCxcclxuICAgICAgICAgICAgICAgICAgICBtYXJrZXJJY29uU2l6ZVxyXG4gICAgICAgICAgICAgICAgKTtcclxuXHJcbiAgICAgICAgICAgICAgICBjb25zdCBlbmFibGVJbmZvV2luZG93ID0gYWRkcmVzc1syXTtcclxuICAgICAgICAgICAgICAgIGNvbnN0IGVuYWJsZUluZm9XaW5kb3dPbkRvY3VtZW50TG9hZCA9IGFkZHJlc3NbOF07XHJcbiAgICAgICAgICAgICAgICBjb25zdCBpbmZvV2luZG93RGVzY3JpcHRpb24gPSBhZGRyZXNzWzRdO1xyXG5cclxuICAgICAgICAgICAgICAgIGlmICghIWVuYWJsZUluZm9XaW5kb3cgJiYgYWRkcmVzc1RpdGxlKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgY29uc3QgaW5mb1dpbmRvdyA9IHRoaXMuY3JlYXRlSW5mb1dpbmRvdyhtYXJrZXIsIGFkZHJlc3NUaXRsZSwgaW5mb1dpbmRvd0Rlc2NyaXB0aW9uKTtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgaWYgKCEhZW5hYmxlSW5mb1dpbmRvd09uRG9jdW1lbnRMb2FkKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGluZm9XaW5kb3cub3Blbih0aGlzLmdvb2dsZU1hcCwgbWFya2VyKTtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICAgICAgICAgIGdvb2dsZS5tYXBzLmV2ZW50LmFkZExpc3RlbmVyKG1hcmtlciwgXCJjbGlja1wiLCAoKSA9PiB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGluZm9XaW5kb3cub3Blbih0aGlzLmdvb2dsZU1hcCwgbWFya2VyKTtcclxuICAgICAgICAgICAgICAgICAgICB9KTtcclxuXHJcbiAgICAgICAgICAgICAgICAgICAgZ29vZ2xlLm1hcHMuZXZlbnQuYWRkTGlzdGVuZXIodGhpcy5nb29nbGVNYXAsIFwiY2xpY2tcIiwgKCkgPT4ge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBpbmZvV2luZG93LmNsb3NlKCk7XHJcbiAgICAgICAgICAgICAgICAgICAgfSk7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9KTtcclxuICAgIH1cclxuXHJcbiAgICBjcmVhdGVNYXJrZXIoYWRkcmVzc0xhdGl0dWRlLCBhZGRyZXNzTG9uZ2l0dWRlLCBhZGRyZXNzVGl0bGUsIG1hcmtlckljb25UeXBlLCBtYXJrZXJJY29uVVJMLCBtYXJrZXJJY29uU2l6ZSkge1xyXG4gICAgICAgIGNvbnN0IG1hcmtlckFuaW1hdGlvbiA9IHRoaXMuZ2V0U2V0dGluZ3MoXCJtYXJrZXJBbmltYXRpb25cIik7XHJcbiAgICAgICAgbGV0IGFuaW1hdGlvbiA9IG51bGw7XHJcblxyXG4gICAgICAgIHN3aXRjaCAobWFya2VyQW5pbWF0aW9uKSB7XHJcbiAgICAgICAgICAgIGNhc2UgXCJkcm9wXCI6XHJcbiAgICAgICAgICAgICAgICBhbmltYXRpb24gPSBnb29nbGUubWFwcy5BbmltYXRpb24uRFJPUDtcclxuICAgICAgICAgICAgICAgIGJyZWFrO1xyXG5cclxuICAgICAgICAgICAgY2FzZSBcImJvdW5jZVwiOlxyXG4gICAgICAgICAgICAgICAgYW5pbWF0aW9uID0gZ29vZ2xlLm1hcHMuQW5pbWF0aW9uLkJPVU5DRTtcclxuICAgICAgICAgICAgICAgIGJyZWFrO1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgcmV0dXJuIG5ldyBnb29nbGUubWFwcy5NYXJrZXIoe1xyXG4gICAgICAgICAgICBwb3NpdGlvbjogbmV3IGdvb2dsZS5tYXBzLkxhdExuZyhhZGRyZXNzTGF0aXR1ZGUsIGFkZHJlc3NMb25naXR1ZGUpLFxyXG4gICAgICAgICAgICBtYXA6IHRoaXMuZ29vZ2xlTWFwLFxyXG4gICAgICAgICAgICB0aXRsZTogYWRkcmVzc1RpdGxlLFxyXG4gICAgICAgICAgICBhbmltYXRpb246IGFuaW1hdGlvbixcclxuICAgICAgICAgICAgaWNvbjpcclxuICAgICAgICAgICAgICAgIG1hcmtlckljb25UeXBlID09PSBcImN1c3RvbVwiXHJcbiAgICAgICAgICAgICAgICAgICAgPyB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgdXJsOiBtYXJrZXJJY29uVVJMLFxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgIHNjYWxlZFNpemU6IG5ldyBnb29nbGUubWFwcy5TaXplKG1hcmtlckljb25TaXplLCBtYXJrZXJJY29uU2l6ZSksXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgb3JpZ2luOiBuZXcgZ29vZ2xlLm1hcHMuUG9pbnQoMCwgMCksXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgYW5jaG9yOiBuZXcgZ29vZ2xlLm1hcHMuUG9pbnQobWFya2VySWNvblNpemUgLyAyLCBtYXJrZXJJY29uU2l6ZSksXHJcbiAgICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAgICAgOiBcIlwiLFxyXG4gICAgICAgIH0pO1xyXG4gICAgfVxyXG5cclxuICAgIGNyZWF0ZUluZm9XaW5kb3cobWFya2VyLCBhZGRyZXNzVGl0bGUsIGluZm9XaW5kb3dEZXNjcmlwdGlvbikge1xyXG4gICAgICAgIGNvbnN0IGluZm9XaW5kb3dPcHRpbm9zID0ge307XHJcbiAgICAgICAgY29uc3QgZGF0YXNldE1heFdpZHRoID0gdGhpcy5lbGVtZW50cy5nb29nbGVNYXAuZGF0YXNldC5pd01heFdpZHRoO1xyXG5cclxuICAgICAgICBpbmZvV2luZG93T3B0aW5vcy5jb250ZW50ID0gYFxyXG4gICAgICAgIDxkaXYgY2xhc3M9XCJvZXctaW5mb3dpbmRvdy1jb250ZW50XCI+XHJcbiAgICAgICAgICAgIDxkaXYgY2xhc3M9XCJvZXctaW5mb3dpbmRvdy10aXRsZVwiPiR7YWRkcmVzc1RpdGxlfTwvZGl2PlxyXG4gICAgICAgICAgICAkeyEhaW5mb1dpbmRvd0Rlc2NyaXB0aW9uID8gYDxkaXYgY2xhc3M9XCJvZXctaW5mb3dpbmRvdy1kZXNjcmlwdGlvblwiPiR7aW5mb1dpbmRvd0Rlc2NyaXB0aW9ufTwvZGl2PmAgOiBgYH1cclxuICAgICAgICA8L2Rpdj5gO1xyXG5cclxuICAgICAgICBpZiAoISFkYXRhc2V0TWF4V2lkdGgpIHtcclxuICAgICAgICAgICAgaW5mb1dpbmRvd09wdGlub3MubWF4V2lkdGggPSBkYXRhc2V0TWF4V2lkdGg7XHJcbiAgICAgICAgfVxyXG5cclxuICAgICAgICByZXR1cm4gbmV3IGdvb2dsZS5tYXBzLkluZm9XaW5kb3coaW5mb1dpbmRvd09wdGlub3MpO1xyXG4gICAgfVxyXG5cclxuICAgIHNldFVzZXJTZXR0aW5ncygpIHtcclxuICAgICAgICBjb25zdCBzZXR0aW5ncyA9IHRoaXMuZ2V0U2V0dGluZ3MoKTtcclxuICAgICAgICBjb25zdCBkYXRhc2V0U2V0dGluZ3MgPSB0aGlzLmVsZW1lbnRzLmdvb2dsZU1hcC5kYXRhc2V0O1xyXG4gICAgICAgIGNvbnN0IGVsZW1lbnRTZXR0aW5ncyA9IHRoaXMuZ2V0RWxlbWVudFNldHRpbmdzKCk7XHJcblxyXG4gICAgICAgIGNvbnN0IGFkZHJlc3NlcyA9ICEhZGF0YXNldFNldHRpbmdzLmxvY2F0aW9ucyA/IEpTT04ucGFyc2UoZGF0YXNldFNldHRpbmdzLmxvY2F0aW9ucykgOiBzZXR0aW5ncy5hZGRyZXNzZXM7XHJcbiAgICAgICAgY29uc3Qgem9vbSA9ICFOdW1iZXIuaXNOYU4oTnVtYmVyKGRhdGFzZXRTZXR0aW5ncy56b29tKSkgPyBOdW1iZXIoZGF0YXNldFNldHRpbmdzLnpvb20pIDogc2V0dGluZ3Muem9vbTtcclxuICAgICAgICBjb25zdCBtYXBUeXBlID0gISFlbGVtZW50U2V0dGluZ3MubWFwX3R5cGUgPyBlbGVtZW50U2V0dGluZ3MubWFwX3R5cGUgOiBzZXR0aW5ncy5tYXBUeXBlO1xyXG4gICAgICAgIGNvbnN0IHpvb21Db250cm9sID0gISFlbGVtZW50U2V0dGluZ3Muem9vbV9jb250cm9sID8gZWxlbWVudFNldHRpbmdzLnpvb21fY29udHJvbCA6IHNldHRpbmdzLnpvb21Db250cm9sO1xyXG4gICAgICAgIGNvbnN0IHN0eWxlcyA9ICEhZGF0YXNldFNldHRpbmdzLmN1c3RvbVN0eWxlID8gSlNPTi5wYXJzZShkYXRhc2V0U2V0dGluZ3MuY3VzdG9tU3R5bGUpIDogc2V0dGluZ3Muc3R5bGVzO1xyXG5cclxuICAgICAgICBjb25zdCBtYXJrZXJBbmltYXRpb24gPSAhIWVsZW1lbnRTZXR0aW5ncy5tYXJrZXJfYW5pbWF0aW9uXHJcbiAgICAgICAgICAgID8gZWxlbWVudFNldHRpbmdzLm1hcmtlcl9hbmltYXRpb25cclxuICAgICAgICAgICAgOiBzZXR0aW5ncy5tYXJrZXJBbmltYXRpb247XHJcblxyXG4gICAgICAgIGNvbnN0IHN0cmVldFZpZXdDb250cm9sID0gISFlbGVtZW50U2V0dGluZ3MubWFwX29wdGlvbl9zdHJlZXR2aWV3XHJcbiAgICAgICAgICAgID8gZWxlbWVudFNldHRpbmdzLm1hcF9vcHRpb25fc3RyZWV0dmlld1xyXG4gICAgICAgICAgICA6IHNldHRpbmdzLnN0cmVldFZpZXdDb250cm9sO1xyXG5cclxuICAgICAgICBjb25zdCBtYXBUeXBlQ29udHJvbCA9ICEhZWxlbWVudFNldHRpbmdzLm1hcF90eXBlX2NvbnRyb2xcclxuICAgICAgICAgICAgPyBlbGVtZW50U2V0dGluZ3MubWFwX3R5cGVfY29udHJvbFxyXG4gICAgICAgICAgICA6IHNldHRpbmdzLm1hcFR5cGVDb250cm9sO1xyXG5cclxuICAgICAgICBjb25zdCBmdWxsc2NyZWVuQ29udHJvbCA9ICEhZWxlbWVudFNldHRpbmdzLmZ1bGxzY3JlZW5fY29udHJvbFxyXG4gICAgICAgICAgICA/IGVsZW1lbnRTZXR0aW5ncy5mdWxsc2NyZWVuX2NvbnRyb2xcclxuICAgICAgICAgICAgOiBzZXR0aW5ncy5mdWxsc2NyZWVuQ29udHJvbDtcclxuXHJcbiAgICAgICAgY29uc3Qgc2Nyb2xsVG9ab29tID0gISFlbGVtZW50U2V0dGluZ3MubWFwX3Njcm9sbF96b29tID8gZWxlbWVudFNldHRpbmdzLm1hcF9zY3JvbGxfem9vbSA6IHNldHRpbmdzLnNjcm9sbFRvWm9vbTtcclxuXHJcbiAgICAgICAgdGhpcy5zZXRTZXR0aW5ncyh7XHJcbiAgICAgICAgICAgIGFkZHJlc3NlczogYWRkcmVzc2VzLFxyXG4gICAgICAgICAgICB6b29tOiB6b29tLFxyXG4gICAgICAgICAgICBtYXBUeXBlOiBtYXBUeXBlLFxyXG4gICAgICAgICAgICBtYXJrZXJBbmltYXRpb246IG1hcmtlckFuaW1hdGlvbixcclxuICAgICAgICAgICAgc3RyZWV0Vmlld0NvbnRyb2w6IHN0cmVldFZpZXdDb250cm9sLFxyXG4gICAgICAgICAgICBtYXBUeXBlQ29udHJvbDogbWFwVHlwZUNvbnRyb2wsXHJcbiAgICAgICAgICAgIHpvb21Db250cm9sOiB6b29tQ29udHJvbCxcclxuICAgICAgICAgICAgZnVsbHNjcmVlbkNvbnRyb2w6IGZ1bGxzY3JlZW5Db250cm9sLFxyXG4gICAgICAgICAgICBzY3JvbGxUb1pvb206IHNjcm9sbFRvWm9vbSxcclxuICAgICAgICAgICAgc3R5bGVzOiBzdHlsZXMsXHJcbiAgICAgICAgfSk7XHJcbiAgICB9XHJcbn1cclxuXHJcbnJlZ2lzdGVyV2lkZ2V0KE9FV19Hb29nbGVNYXAsIFwib2V3LWdvb2dsZS1tYXBcIik7XHJcbiJdfQ==
