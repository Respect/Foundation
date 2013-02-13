/**
 * This JavaScript is used for make target phantomjs-snapshot
 *
 * @type phantomjs
 * @author nickl
 */
var page = require('webpage').create(),
    system = require('system'),
    address, image;

if (system.args.length === 1) {
    console.log('Usage: '+system.args[0]+' <some URL>');
    phantom.exit();
}

address = system.args[1].match(/^http|^about/) && system.args[1] || 'http://'+system.args[1];
image = address.replace(/https?:\/\//,'').replace(/\/|\./g,'-')+'.png'
page.open(address, function (status) {
    page.evaluate(function() {
        document.body.bgColor = 'white';
    });
    page.render(image);
    console.log(image);
    phantom.exit();
});
