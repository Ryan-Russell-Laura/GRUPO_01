/*
 * File: app/store/storeCarrera.js
 *
 * This file was generated by Sencha Architect version 4.3.4.
 * http://www.sencha.com/products/architect/
 *
 * This file requires use of the Ext JS 7.7.x Classic library, under independent license.
 * License of Sencha Architect does not include license for Ext JS 7.7.x Classic. For more
 * details see http://www.sencha.com/license or contact license@sencha.com.
 *
 * This file will be auto-generated each and everytime you save your project.
 *
 * Do NOT hand edit this file.
 */

Ext.define('MyApp.store.storeCarrera', {
    extend: 'Ext.data.Store',

    requires: [
        'MyApp.model.carrera',
        'Ext.data.proxy.Ajax',
        'Ext.data.reader.Json'
    ],

    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'storeCarrera',
            autoLoad: true,
            model: 'MyApp.model.carrera',
            proxy: {
                type: 'ajax',
                url: 'src/carrera.php',
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                }
            }
        }, cfg)]);
    }
});