'use strict';

const $ = require('jquery');
const Helper = require('./RepLogHelper');

(function(window, Routing) {
console.log("dans class repllogapp")
    let HelperInstances = new WeakMap();

    class RepLogApp {
        constructor($wrapper) {
            console.log("dans constructor")
            this.$wrapper = $wrapper;
            this.repLogs = [];

            HelperInstances.set(this, new Helper(this.repLogs));

            this.$wrapper.on(
                'click',
                'tbody tr',
                null
            );
            this.$wrapper.on(
                'submit',
                RepLogApp._selectors.newRepForm,
                null
            );
        }

        /**
         * Call like this.selectors
         */
        static get _selectors() {
            return {
                newRepForm: '.js-new-rep-log-form'
            }
        }

    }

    const rowTemplate = (repLog) => `
<tr data-weight="${repLog.totalWeightLifted}">
    <td>${repLog.itemLabel}</td>
    <td>${repLog.reps}</td>
    <td>${repLog.totalWeightLifted}</td>
    <td>
        <a href="#"
           class="js-delete-rep-log"
           data-url="${repLog.links._self}"
        >
            <span class="fa fa-trash"></span>
        </a>
    </td>
</tr>
`;

    // window.RepLogApp = RepLogApp;
    window.$ = $;
})(window, Routing);
