//============ ============  ============  ============ 
// File bootstrap of js
// @auth: vihoangson
// @since: 20160707162122
//============ ============  ============  ============ 

(function(){
    // ============ ============  ============  ============ 
    // Override function alert default of browser
    // 
    if (window.swal) {
        /**
         * @param {String|*} message
         * @param {String} [text=undefined]
         * @param {String} [type=undefined]
         */
        window.alert = function(message, text, type) {
            swal(String(message), text, type);
        };

        /**
         * @param {String} message
         * @param {Object} [options=undefined]
         * @param {Function} [handler=undefined]
         * @param {Object} [context=undefined]
         */
        window.confirm = function(message, options, handler, context) {
            return swal(
                $.extend({
                    title: "Are you sure?",
                    text: "Your will not be able to recover this imaginary file!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                },options),
            function(isConfirm){
                swal("Deleted!", "Your imaginary file has been deleted.", "success");
            });
        };
    }


    //============ ============  ============  ============ 
    //  Function notify
    // Hiển thị flash popup ra màn hình
    // 
    // @param message: string
    // @param options: 
    //     options_default = 
    //     {
    //         title: '',
    //         text: '',
    //         icon: '',
    //         timeout: 5000,
    //         action: function(){},
    //         dismissable: true
    //     };
    //
    //  Sample:
    //     $(window).load(function(){
    //         notify("Xin chào !");
    //     })
    //     
    if (!window.notify) {
        /**
         * @param {String|*} message
         * @param {Object} [options=undefined]
         */
        window.notify = function(message, options) {
            if (window.Snarl) {
                Snarl.addNotification($.extend({
                    text: message,
                    icon: '<i class="fa fa-info-circle"></i>'
                }, options));
            }
            else {
                //alert.apply(null, arguments);
            }
        }
    }
})();

// ============ ============  ============  ============ 
// Hàm extend OOP của javascript
// @since: 20160707162122
// 
    if ("function" !== typeof inherit) {
        /**
         * @param {Object} [proto]
         * @returns {Object}
         */
        function inherit(proto) {
            function F() {}
            F.prototype = proto;
            return new F();
        }
    }

    if ("function" !== typeof extend) {
        /**
         * @param {Object} [Child]
         * @param {Object} [Parent]
         */
        function extend(Child, Parent) {
            Parent.prototype.constructor = Parent; // @link http://goo.gl/PxO37U
            Child.prototype = inherit(Parent.prototype);
            Child.prototype.constructor = Child;
            Child.parent = Parent.prototype;
        }
    }
//
//============ ============  ============  ============ 