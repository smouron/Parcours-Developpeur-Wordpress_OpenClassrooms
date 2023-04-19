(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({1:[function(require,module,exports){
"use strict";

/**
 * Because Elementor plugin uses jQuery for controls,
 * We also have to use jQuery to create new one
 */
window.addEventListener('elementor/init', function () {
  var ControlQueryPostSearch = elementor.modules.controls.BaseData.extend({
    isPostSearchReady: false,
    getPostTitlesbyID: function getPostTitlesbyID() {
      var self = this;
      var postIDs = this.getControlValue();

      if (!postIDs) {
        return;
      }

      if (!_.isArray(postIDs)) {
        postIDs = [postIDs];
      }

      self.addControlSpinner();
      /**
       * Because Elementor plugin uses jQuery for controls,
       * We also have to use jQuery to create new one
       */

      jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        data: {
          action: "oew_get_posts_title_by_id",
          nonce: queryPostData.nonce,
          id: postIDs
        },
        success: function success(results) {
          self.isPostSearchReady = true;
          self.model.set("options", results);
          self.render();
        }
      });
    },
    addControlSpinner: function addControlSpinner() {
      this.ui.select.prop("disabled", true);
      this.$el.find(".elementor-control-title").after('<span class="elementor-control-spinner">&nbsp;<i class="fa fa-spinner fa-spin"></i>&nbsp;</span>');
    },
    onReady: function onReady() {
      var self = this;
      this.ui.select.select2({
        placeholder: "Search",
        allowClear: true,
        minimumInputLength: 2,
        ajax: {
          url: ajaxurl,
          dataType: "json",
          method: "post",
          delay: 250,
          data: function data(params) {
            return {
              action: "oew_get_posts_by_query",
              nonce: queryPostData.nonce,
              q: params.term,
              // search term
              post_type: self.model.get("post_type")
            };
          },
          processResults: function processResults(data) {
            return {
              results: data
            };
          },
          cache: true
        }
      });

      if (!this.isPostSearchReady) {
        this.getPostTitlesbyID();
      }
    },
    onBeforeDestroy: function onBeforeDestroy() {
      if (this.ui.select.data("select2")) {
        this.ui.select.select2("destroy");
      }

      this.$el.remove();
    }
  });
  elementor.addControlView("oew-query-posts", ControlQueryPostSearch);
});

},{}]},{},[1])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJhc3NldHMvc3JjL2pzL2NvbnRyb2xzL3F1ZXJ5LXBvc3QuanMiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7OztBQ0FBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EsTUFBTSxDQUFDLGdCQUFQLENBQXlCLGdCQUF6QixFQUEyQyxZQUFNO0FBQzdDLE1BQU0sc0JBQXNCLEdBQUcsU0FBUyxDQUFDLE9BQVYsQ0FBa0IsUUFBbEIsQ0FBMkIsUUFBM0IsQ0FBb0MsTUFBcEMsQ0FBMkM7QUFDdEUsSUFBQSxpQkFBaUIsRUFBRSxLQURtRDtBQUd0RSxJQUFBLGlCQUFpQixFQUFFLDZCQUFZO0FBQzNCLFVBQU0sSUFBSSxHQUFHLElBQWI7QUFDQSxVQUFJLE9BQU8sR0FBRyxLQUFLLGVBQUwsRUFBZDs7QUFFQSxVQUFJLENBQUMsT0FBTCxFQUFjO0FBQ1Y7QUFDSDs7QUFFRCxVQUFJLENBQUMsQ0FBQyxDQUFDLE9BQUYsQ0FBVSxPQUFWLENBQUwsRUFBeUI7QUFDckIsUUFBQSxPQUFPLEdBQUcsQ0FBQyxPQUFELENBQVY7QUFDSDs7QUFFRCxNQUFBLElBQUksQ0FBQyxpQkFBTDtBQUVBO0FBQ1o7QUFDQTtBQUNBOztBQUNZLE1BQUEsTUFBTSxDQUFDLElBQVAsQ0FBWTtBQUNSLFFBQUEsR0FBRyxFQUFFLE9BREc7QUFFUixRQUFBLElBQUksRUFBRSxNQUZFO0FBR1IsUUFBQSxJQUFJLEVBQUU7QUFDRixVQUFBLE1BQU0sRUFBRSwyQkFETjtBQUVGLFVBQUEsS0FBSyxFQUFFLGFBQWEsQ0FBQyxLQUZuQjtBQUdGLFVBQUEsRUFBRSxFQUFFO0FBSEYsU0FIRTtBQVFSLFFBQUEsT0FBTyxFQUFFLGlCQUFVLE9BQVYsRUFBbUI7QUFDeEIsVUFBQSxJQUFJLENBQUMsaUJBQUwsR0FBeUIsSUFBekI7QUFDQSxVQUFBLElBQUksQ0FBQyxLQUFMLENBQVcsR0FBWCxDQUFlLFNBQWYsRUFBMEIsT0FBMUI7QUFDQSxVQUFBLElBQUksQ0FBQyxNQUFMO0FBQ0g7QUFaTyxPQUFaO0FBY0gsS0FuQ3FFO0FBb0N0RSxJQUFBLGlCQUFpQixFQUFFLDZCQUFZO0FBQzNCLFdBQUssRUFBTCxDQUFRLE1BQVIsQ0FBZSxJQUFmLENBQW9CLFVBQXBCLEVBQWdDLElBQWhDO0FBQ0EsV0FBSyxHQUFMLENBQ0ssSUFETCxDQUNVLDBCQURWLEVBRUssS0FGTCxDQUdRLGtHQUhSO0FBS0gsS0EzQ3FFO0FBNEN0RSxJQUFBLE9BQU8sRUFBRSxtQkFBWTtBQUNqQixVQUFJLElBQUksR0FBRyxJQUFYO0FBRUEsV0FBSyxFQUFMLENBQVEsTUFBUixDQUFlLE9BQWYsQ0FBdUI7QUFDbkIsUUFBQSxXQUFXLEVBQUUsUUFETTtBQUVuQixRQUFBLFVBQVUsRUFBRSxJQUZPO0FBR25CLFFBQUEsa0JBQWtCLEVBQUUsQ0FIRDtBQUtuQixRQUFBLElBQUksRUFBRTtBQUNGLFVBQUEsR0FBRyxFQUFFLE9BREg7QUFFRixVQUFBLFFBQVEsRUFBRSxNQUZSO0FBR0YsVUFBQSxNQUFNLEVBQUUsTUFITjtBQUlGLFVBQUEsS0FBSyxFQUFFLEdBSkw7QUFLRixVQUFBLElBQUksRUFBRSxjQUFVLE1BQVYsRUFBa0I7QUFDcEIsbUJBQU87QUFDSCxjQUFBLE1BQU0sRUFBRSx3QkFETDtBQUVILGNBQUEsS0FBSyxFQUFFLGFBQWEsQ0FBQyxLQUZsQjtBQUdILGNBQUEsQ0FBQyxFQUFFLE1BQU0sQ0FBQyxJQUhQO0FBR2E7QUFDaEIsY0FBQSxTQUFTLEVBQUUsSUFBSSxDQUFDLEtBQUwsQ0FBVyxHQUFYLENBQWUsV0FBZjtBQUpSLGFBQVA7QUFNSCxXQVpDO0FBYUYsVUFBQSxjQUFjLEVBQUUsd0JBQVUsSUFBVixFQUFnQjtBQUM1QixtQkFBTztBQUNILGNBQUEsT0FBTyxFQUFFO0FBRE4sYUFBUDtBQUdILFdBakJDO0FBa0JGLFVBQUEsS0FBSyxFQUFFO0FBbEJMO0FBTGEsT0FBdkI7O0FBMkJBLFVBQUksQ0FBQyxLQUFLLGlCQUFWLEVBQTZCO0FBQ3pCLGFBQUssaUJBQUw7QUFDSDtBQUNKLEtBN0VxRTtBQThFdEUsSUFBQSxlQUFlLEVBQUUsMkJBQVk7QUFDekIsVUFBSSxLQUFLLEVBQUwsQ0FBUSxNQUFSLENBQWUsSUFBZixDQUFvQixTQUFwQixDQUFKLEVBQW9DO0FBQ2hDLGFBQUssRUFBTCxDQUFRLE1BQVIsQ0FBZSxPQUFmLENBQXVCLFNBQXZCO0FBQ0g7O0FBRUQsV0FBSyxHQUFMLENBQVMsTUFBVDtBQUNIO0FBcEZxRSxHQUEzQyxDQUEvQjtBQXVGQSxFQUFBLFNBQVMsQ0FBQyxjQUFWLENBQXlCLGlCQUF6QixFQUE0QyxzQkFBNUM7QUFDSCxDQXpGRCIsImZpbGUiOiJnZW5lcmF0ZWQuanMiLCJzb3VyY2VSb290IjoiIiwic291cmNlc0NvbnRlbnQiOlsiKGZ1bmN0aW9uKCl7ZnVuY3Rpb24gcihlLG4sdCl7ZnVuY3Rpb24gbyhpLGYpe2lmKCFuW2ldKXtpZighZVtpXSl7dmFyIGM9XCJmdW5jdGlvblwiPT10eXBlb2YgcmVxdWlyZSYmcmVxdWlyZTtpZighZiYmYylyZXR1cm4gYyhpLCEwKTtpZih1KXJldHVybiB1KGksITApO3ZhciBhPW5ldyBFcnJvcihcIkNhbm5vdCBmaW5kIG1vZHVsZSAnXCIraStcIidcIik7dGhyb3cgYS5jb2RlPVwiTU9EVUxFX05PVF9GT1VORFwiLGF9dmFyIHA9bltpXT17ZXhwb3J0czp7fX07ZVtpXVswXS5jYWxsKHAuZXhwb3J0cyxmdW5jdGlvbihyKXt2YXIgbj1lW2ldWzFdW3JdO3JldHVybiBvKG58fHIpfSxwLHAuZXhwb3J0cyxyLGUsbix0KX1yZXR1cm4gbltpXS5leHBvcnRzfWZvcih2YXIgdT1cImZ1bmN0aW9uXCI9PXR5cGVvZiByZXF1aXJlJiZyZXF1aXJlLGk9MDtpPHQubGVuZ3RoO2krKylvKHRbaV0pO3JldHVybiBvfXJldHVybiByfSkoKSIsIi8qKlxyXG4gKiBCZWNhdXNlIEVsZW1lbnRvciBwbHVnaW4gdXNlcyBqUXVlcnkgZm9yIGNvbnRyb2xzLFxyXG4gKiBXZSBhbHNvIGhhdmUgdG8gdXNlIGpRdWVyeSB0byBjcmVhdGUgbmV3IG9uZVxyXG4gKi9cclxud2luZG93LmFkZEV2ZW50TGlzdGVuZXIoICdlbGVtZW50b3IvaW5pdCcsICgpID0+IHtcclxuICAgIGNvbnN0IENvbnRyb2xRdWVyeVBvc3RTZWFyY2ggPSBlbGVtZW50b3IubW9kdWxlcy5jb250cm9scy5CYXNlRGF0YS5leHRlbmQoe1xyXG4gICAgICAgIGlzUG9zdFNlYXJjaFJlYWR5OiBmYWxzZSxcclxuXHJcbiAgICAgICAgZ2V0UG9zdFRpdGxlc2J5SUQ6IGZ1bmN0aW9uICgpIHtcclxuICAgICAgICAgICAgY29uc3Qgc2VsZiA9IHRoaXM7XHJcbiAgICAgICAgICAgIGxldCBwb3N0SURzID0gdGhpcy5nZXRDb250cm9sVmFsdWUoKTtcclxuXHJcbiAgICAgICAgICAgIGlmICghcG9zdElEcykge1xyXG4gICAgICAgICAgICAgICAgcmV0dXJuO1xyXG4gICAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgICBpZiAoIV8uaXNBcnJheShwb3N0SURzKSkge1xyXG4gICAgICAgICAgICAgICAgcG9zdElEcyA9IFtwb3N0SURzXTtcclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgc2VsZi5hZGRDb250cm9sU3Bpbm5lcigpO1xyXG5cclxuICAgICAgICAgICAgLyoqXHJcbiAgICAgICAgICAgICAqIEJlY2F1c2UgRWxlbWVudG9yIHBsdWdpbiB1c2VzIGpRdWVyeSBmb3IgY29udHJvbHMsXHJcbiAgICAgICAgICAgICAqIFdlIGFsc28gaGF2ZSB0byB1c2UgalF1ZXJ5IHRvIGNyZWF0ZSBuZXcgb25lXHJcbiAgICAgICAgICAgICAqL1xyXG4gICAgICAgICAgICBqUXVlcnkuYWpheCh7XHJcbiAgICAgICAgICAgICAgICB1cmw6IGFqYXh1cmwsXHJcbiAgICAgICAgICAgICAgICB0eXBlOiBcIlBPU1RcIixcclxuICAgICAgICAgICAgICAgIGRhdGE6IHtcclxuICAgICAgICAgICAgICAgICAgICBhY3Rpb246IFwib2V3X2dldF9wb3N0c190aXRsZV9ieV9pZFwiLFxyXG4gICAgICAgICAgICAgICAgICAgIG5vbmNlOiBxdWVyeVBvc3REYXRhLm5vbmNlLFxyXG4gICAgICAgICAgICAgICAgICAgIGlkOiBwb3N0SURzLFxyXG4gICAgICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAgICAgIHN1Y2Nlc3M6IGZ1bmN0aW9uIChyZXN1bHRzKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgc2VsZi5pc1Bvc3RTZWFyY2hSZWFkeSA9IHRydWU7XHJcbiAgICAgICAgICAgICAgICAgICAgc2VsZi5tb2RlbC5zZXQoXCJvcHRpb25zXCIsIHJlc3VsdHMpO1xyXG4gICAgICAgICAgICAgICAgICAgIHNlbGYucmVuZGVyKCk7XHJcbiAgICAgICAgICAgICAgICB9LFxyXG4gICAgICAgICAgICB9KTtcclxuICAgICAgICB9LFxyXG4gICAgICAgIGFkZENvbnRyb2xTcGlubmVyOiBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgICAgIHRoaXMudWkuc2VsZWN0LnByb3AoXCJkaXNhYmxlZFwiLCB0cnVlKTtcclxuICAgICAgICAgICAgdGhpcy4kZWxcclxuICAgICAgICAgICAgICAgIC5maW5kKFwiLmVsZW1lbnRvci1jb250cm9sLXRpdGxlXCIpXHJcbiAgICAgICAgICAgICAgICAuYWZ0ZXIoXHJcbiAgICAgICAgICAgICAgICAgICAgJzxzcGFuIGNsYXNzPVwiZWxlbWVudG9yLWNvbnRyb2wtc3Bpbm5lclwiPiZuYnNwOzxpIGNsYXNzPVwiZmEgZmEtc3Bpbm5lciBmYS1zcGluXCI+PC9pPiZuYnNwOzwvc3Bhbj4nXHJcbiAgICAgICAgICAgICAgICApO1xyXG4gICAgICAgIH0sXHJcbiAgICAgICAgb25SZWFkeTogZnVuY3Rpb24gKCkge1xyXG4gICAgICAgICAgICB2YXIgc2VsZiA9IHRoaXM7XHJcblxyXG4gICAgICAgICAgICB0aGlzLnVpLnNlbGVjdC5zZWxlY3QyKHtcclxuICAgICAgICAgICAgICAgIHBsYWNlaG9sZGVyOiBcIlNlYXJjaFwiLFxyXG4gICAgICAgICAgICAgICAgYWxsb3dDbGVhcjogdHJ1ZSxcclxuICAgICAgICAgICAgICAgIG1pbmltdW1JbnB1dExlbmd0aDogMixcclxuXHJcbiAgICAgICAgICAgICAgICBhamF4OiB7XHJcbiAgICAgICAgICAgICAgICAgICAgdXJsOiBhamF4dXJsLFxyXG4gICAgICAgICAgICAgICAgICAgIGRhdGFUeXBlOiBcImpzb25cIixcclxuICAgICAgICAgICAgICAgICAgICBtZXRob2Q6IFwicG9zdFwiLFxyXG4gICAgICAgICAgICAgICAgICAgIGRlbGF5OiAyNTAsXHJcbiAgICAgICAgICAgICAgICAgICAgZGF0YTogZnVuY3Rpb24gKHBhcmFtcykge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICByZXR1cm4ge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgYWN0aW9uOiBcIm9ld19nZXRfcG9zdHNfYnlfcXVlcnlcIixcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIG5vbmNlOiBxdWVyeVBvc3REYXRhLm5vbmNlLFxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgcTogcGFyYW1zLnRlcm0sIC8vIHNlYXJjaCB0ZXJtXHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBwb3N0X3R5cGU6IHNlbGYubW9kZWwuZ2V0KFwicG9zdF90eXBlXCIpLFxyXG4gICAgICAgICAgICAgICAgICAgICAgICB9O1xyXG4gICAgICAgICAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgICAgICAgICAgcHJvY2Vzc1Jlc3VsdHM6IGZ1bmN0aW9uIChkYXRhKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHJldHVybiB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICByZXN1bHRzOiBkYXRhLFxyXG4gICAgICAgICAgICAgICAgICAgICAgICB9O1xyXG4gICAgICAgICAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgICAgICAgICAgY2FjaGU6IHRydWUsXHJcbiAgICAgICAgICAgICAgICB9LFxyXG4gICAgICAgICAgICB9KTtcclxuXHJcbiAgICAgICAgICAgIGlmICghdGhpcy5pc1Bvc3RTZWFyY2hSZWFkeSkge1xyXG4gICAgICAgICAgICAgICAgdGhpcy5nZXRQb3N0VGl0bGVzYnlJRCgpO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfSxcclxuICAgICAgICBvbkJlZm9yZURlc3Ryb3k6IGZ1bmN0aW9uICgpIHtcclxuICAgICAgICAgICAgaWYgKHRoaXMudWkuc2VsZWN0LmRhdGEoXCJzZWxlY3QyXCIpKSB7XHJcbiAgICAgICAgICAgICAgICB0aGlzLnVpLnNlbGVjdC5zZWxlY3QyKFwiZGVzdHJveVwiKTtcclxuICAgICAgICAgICAgfVxyXG5cclxuICAgICAgICAgICAgdGhpcy4kZWwucmVtb3ZlKCk7XHJcbiAgICAgICAgfSxcclxuICAgIH0pO1xyXG5cclxuICAgIGVsZW1lbnRvci5hZGRDb250cm9sVmlldyhcIm9ldy1xdWVyeS1wb3N0c1wiLCBDb250cm9sUXVlcnlQb3N0U2VhcmNoKTtcclxufSk7XHJcbiJdfQ==
