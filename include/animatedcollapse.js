// Animated Collapse - Simple collapsible sections with animation
// Fallback implementation for compatibility

(function() {
    'use strict';
    
    // Simple collapse/expand animation handler
    window.animatedcollapse = {
        // Array to store registered items
        registered: [],
        
        // Initialize an element for collapse/expand
        addDiv: function(id, targetid) {
            this.registered.push({
                id: id,
                targetid: targetid || id
            });
        },
        
        // Toggle collapse state
        toggle: function(id) {
            var elem = document.getElementById(id);
            if (elem) {
                if (elem.style.display === 'none') {
                    this.show(id);
                } else {
                    this.hide(id);
                }
            }
        },
        
        // Show element with animation
        show: function(id) {
            var elem = document.getElementById(id);
            if (elem) {
                elem.style.display = 'block';
                this.animate(elem, 'show');
            }
        },
        
        // Hide element with animation
        hide: function(id) {
            var elem = document.getElementById(id);
            if (elem) {
                this.animate(elem, 'hide', function() {
                    elem.style.display = 'none';
                });
            }
        },
        
        // Simple animation helper
        animate: function(elem, action, callback) {
            if (action === 'show') {
                elem.style.opacity = '0';
                elem.style.maxHeight = '0';
                elem.style.overflow = 'hidden';
                elem.style.transition = 'opacity 0.3s, max-height 0.3s';
                
                setTimeout(function() {
                    elem.style.opacity = '1';
                    elem.style.maxHeight = '1000px';
                }, 10);
            } else if (action === 'hide') {
                elem.style.opacity = '1';
                elem.style.maxHeight = '1000px';
                elem.style.overflow = 'hidden';
                elem.style.transition = 'opacity 0.3s, max-height 0.3s';
                
                setTimeout(function() {
                    elem.style.opacity = '0';
                    elem.style.maxHeight = '0';
                    
                    if (callback) {
                        setTimeout(callback, 300);
                    }
                }, 10);
            }
        },
        
        // Collapse all
        collapseall: function(controlid) {
            this.registered.forEach(function(item) {
                this.hide(item.targetid);
            }.bind(this));
        },
        
        // Expand all
        expandall: function(controlid) {
            this.registered.forEach(function(item) {
                this.show(item.targetid);
            }.bind(this));
        }
    };
})();
