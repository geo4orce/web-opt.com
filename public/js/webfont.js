// noinspection JSUnresolvedVariable
WebFont.load({
  google: {
    families: ["Open Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic","Montserrat:400,700"]
  }
});

/**
 * Capitalize the first letter of hash and update doc title
 * @param {string} hash
 */
function updateDocTitle(hash) {
    var pipe = '|';
    var t = document.title.split(pipe);
    t[0] = hash.charAt(0).toUpperCase() + hash.substr(1) + ' ';
    document.title = t.join(pipe);
}
updateDocTitle(window.location.hash.substr(1) || 'home');
