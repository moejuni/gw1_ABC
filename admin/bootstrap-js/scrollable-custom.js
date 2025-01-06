<<<<<<< HEAD
'use strict';
var scrollable_custom = {
    init: function() {
        $(".vertical-scroll").perfectScrollbar({
            suppressScrollX: !0,
            wheelPropagation: !0
        }), $(".horizontal-scroll").perfectScrollbar({
            suppressScrollY: !0,
            wheelPropagation: !0
        }), $(".both-side-scroll").perfectScrollbar({
            wheelPropagation: !0
        }), $(".visible-scroll").perfectScrollbar({
            wheelPropagation: !0
        }), $(".scrollbar-margins").perfectScrollbar({
            wheelPropagation: !0
        }), $(".click-drag-handler").perfectScrollbar({
            handlers: ["click-rail", "drag-scrollbar"],
            wheelPropagation: !0
        })
    }
};
(function($) {
    "use strict";
    scrollable_custom.init();
=======
'use strict';
var scrollable_custom = {
    init: function() {
        $(".vertical-scroll").perfectScrollbar({
            suppressScrollX: !0,
            wheelPropagation: !0
        }), $(".horizontal-scroll").perfectScrollbar({
            suppressScrollY: !0,
            wheelPropagation: !0
        }), $(".both-side-scroll").perfectScrollbar({
            wheelPropagation: !0
        }), $(".visible-scroll").perfectScrollbar({
            wheelPropagation: !0
        }), $(".scrollbar-margins").perfectScrollbar({
            wheelPropagation: !0
        }), $(".click-drag-handler").perfectScrollbar({
            handlers: ["click-rail", "drag-scrollbar"],
            wheelPropagation: !0
        })
    }
};
(function($) {
    "use strict";
    scrollable_custom.init();
>>>>>>> ee14d3a65546e3ef6e9bfdd344d5a59c285018e1
})(jQuery);