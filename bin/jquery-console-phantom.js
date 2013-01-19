/**
 * This JavaScript is used for make target phantomjs-inject
 *
 * @type phantomjs
 * @author nickl
 */
var page = require('webpage').create(),
    system = require('system'),
    address, t = Date.now(),
    verbose = (system.args[3] && true || false),
    jquery_uri = "http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js";

if (system.args.length === 1) {
    console.log('Usage: '+system.args[0]+' <some URL> <some jQuery in function () { }>');
    phantom.exit();
}
page.onConsoleMessage = function (msg) {
    console.log(msg);
};
page.onAlert = function (msg) {
    msg == jquery_uri && verbose && console.log(msg);
    msg != jquery_uri && console.log(msg);
};

address = system.args[1].match(/^http|^about/) && system.args[1] || 'http://'+system.args[1];
verbose && console.log("Retrieve:\nFetching target page from url:\n"+address);
page.open(address, function (status) {
    verbose && console.log("Target page opened with status: "+status);
    verbose && console.log("\nConfigure:\nInclude jQuery library from location:");
    page.includeJs(jquery_uri, function() {
        verbose && console.log("\nInject:\nThe following function will be injected into the page.\n");
        heading = '\n\nOutput:\nThe result from any in script calls to alert() or console.log().\n';
        footer = verbose && '\nReturn:\nIf anything was returned by the injected function.\n\n' || '';
        if (system.args[2].indexOf('function') == 0) {
            verbose && console.log(system.args[2]);
            verbose && console.log(heading);
            page.evaluate(system.args[2]);
        } else {
            verbose && console.log('function () {');
            verbose && console.log(system.args[2]);
            verbose && console.log('}'+heading);
            console.log(
                footer + (page.evaluate('function () { '+system.args[2]+'; }') || '')
            );
        }
        verbose && console.log("\nElapse: "+((Date.now() - t)/1000)+"s");
        phantom.exit()
    });
});
