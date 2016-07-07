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
         * 20160707175310
         * @param {String|*} message
         * @param {String} [text=undefined]
         * @param {String} [type=undefined]
         */
        window.alert = function(message, text, type) {
            swal(String(message), text, type);
        };

        /**
         * 20160707175314
         * @param {String} message
         * @param {Object} [options=undefined]
         * @param {Function} [handler=undefined]
         * @param {Object} [context=undefined]
         */
        window.confirm_new = function(message, options, handler, context) {
            !!swal($.extend({
                title: message || "Are you sure?",
                text: "You won't be able to undo this action, and you may also lose any data entered",
                type: "warning",
                showCancelButton: true,
                showLoaderOnConfirm: true,
                confirmButtonText: "Yes, do it"
            }, options),
            function(isConfirm) {
                if (isConfirm && "function" === typeof handler) {
                    handler.call(context);
                    return true;
                }else{
                    return false;
                }
            });
        };
    }


    //============ ============  ============  ============ 
    //  Function notify
    // Hiển thị flash popup ra màn hình
    // 20160707175321
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
         * 20160707175328
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