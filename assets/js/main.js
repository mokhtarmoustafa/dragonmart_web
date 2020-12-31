// (function($) {
//     $.fn.countTo = function(options) {
//         // merge the default plugin settings with the custom options
//         options = $.extend({}, $.fn.countTo.defaults, options || {});

//         // how many times to update the value, and how much to increment the value on each update
//         var loops = Math.ceil(options.speed / options.refreshInterval),
//             increment = (options.to - options.from) / loops;

//         return $(this).each(function() {
//             var _this = this,
//                 loopCount = 0,
//                 value = options.from,
//                 interval = setInterval(updateTimer, options.refreshInterval);

//             function updateTimer() {
//                 value += increment;
//                 loopCount++;
//                 $(_this).html(value.toFixed(options.decimals));

//                 if (typeof(options.onUpdate) == 'function') {
//                     options.onUpdate.call(_this, value);
//                 }

//                 if (loopCount >= loops) {
//                     clearInterval(interval);
//                     value = options.to;

//                     if (typeof(options.onComplete) == 'function') {
//                         options.onComplete.call(_this, value);
//                     }
//                 }
//             }
//         });
//     };

//     $.fn.countTo.defaults = {
//         from: 0,  // the number the element should start at
//         to: 100,  // the number the element should end at
//         speed: 1000,  // how long it should take to count between the target numbers
//         refreshInterval: 100,  // how often the element should be updated
//         decimals: 0,  // the number of decimal places to show
//         onUpdate: null,  // callback method for every time the element is updated,
//         onComplete: null,  // callback method for when the element finishes updating
//     };
// })(jQuery);

// jQuery(function($) {
//         $('.timer').countTo({
//             from: 50,
//             to: $("#count").data('count'),
//             speed: 5000,
//             refreshInterval: 50,
//             onComplete: function(value) {
//                 console.debug(this);
//             }
//         });
//     });









/**
 * 
 *  another code
 * 
 */
    function IncremtNumber(elm){
        var $el = $(elm);
        var value = $el.data('count');
    
        $({ percentage: 0 }).stop(true).animate({ percentage: value }, {
            
            duration: 5000,
            easing: "swing",
            step: function () {
                // percentage with 1 decimal;
                // var percentageVal = this.percentage;
                var percentageVal = Math.round(this.percentage * 1);
                $el.text(percentageVal);
            }
        }).promise().done(function () {
            // hard set the value after animation is done to be
            // sure the value is correct
            
            $el.text(value);
        });
    
    
        }