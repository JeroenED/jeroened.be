$(document).ready(function() {
    // Full list of configuration options available here:
    // https://github.com/hakimel/reveal.js#configuration
    Reveal.initialize({
        controls: false,
        progress: false,
        history: true,
        center: true,
        transition: 'linear', // default/cube/page/concave/zoom/linear/fade/none
        // Optional libraries used to extend on reveal.js
        dependencies: [{
                src: '/bundles/portfolio/reveal.js/lib/js/classList.js',
                condition: function() {
                    return !document.body.classList;
                }
            }, {
                src: '/bundles/portfolio/reveal.js/plugin/zoom-js/zoom.js',
                async: true,
                condition: function() {
                    return !!document.body.classList;
                }
            }, {
                src: '/bundles/portfolio/reveal.js/plugin/notes/notes.js',
                async: true,
                condition: function() {
                    return !!document.body.classList;
                }
            },
            //          { src: 'reveal.js/plugin/search/search.js', async: true, condition: function() { return !!document.body.classList; }, }
            //          { src: 'reveal.js/plugin/remotes/remotes.js', async: true, condition: function() { return !!document.body.classList; } }
        ]
    });
});