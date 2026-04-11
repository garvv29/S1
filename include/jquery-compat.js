// jQuery Compatibility Layer - Add missing .on() and .off() methods for jQuery 1.3+
// This shim allows older jQuery to work with modern event binding syntax

(function($) {
    // If .on() doesn't exist, add it using .bind()
    if (!$.fn.on) {
        $.fn.on = function(events, selector, data, handler) {
            // Normalize arguments
            if (typeof selector === 'function') {
                handler = selector;
                selector = undefined;
                data = undefined;
            } else if (typeof data === 'function') {
                handler = data;
                data = undefined;
            }
            
            // Handle event delegation (with selector)
            if (selector && typeof selector === 'string') {
                // Delegate events using live() for older jQuery
                if ($.fn.live && $.fn.delegate) {
                    return this.delegate(selector, events, handler);
                }
                // Fallback: use live for simple cases
                return this.live(events, handler);
            }
            
            // Handle direct events (no selector)  
            if ($.fn.bind) {
                return this.bind(events, data, handler);
            }
            
            return this;
        };
    }
    
    // If .off() doesn't exist, add it using .unbind()
    if (!$.fn.off) {
        $.fn.off = function(events, selector, handler) {
            // Normalize arguments
            if (typeof selector === 'function') {
                handler = selector;
                selector = undefined;
            }
            
            if (selector && typeof selector === 'string') {
                // Undelegate
                if ($.fn.undelegate) {
                    return this.undelegate(selector, events, handler);
                }
            }
            
            // Unbind
            if ($.fn.unbind) {
                return this.unbind(events, handler);
            }
            
            return this;
        };
    }
    
    // If .trigger() doesn't support the modern syntax, enhance it
    if ($.fn.triggerHandler && !$.fn.triggerHandler.modern) {
        var origTrigger = $.fn.trigger;
        $.fn.trigger = function(event, data) {
            if (typeof event === 'string') {
                event = $.Event(event);
            }
            return origTrigger.call(this, event, data);
        };
        $.fn.trigger.modern = true;
    }
    
})(jQuery);
