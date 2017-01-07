define(function(){
    require.config({
        //catchError: true, // prod only
        enforceDefine: true, // important for IE
        urlArgs: 'v=0.0', // cache buster! release # goes here
        waitSeconds: 5,
        paths: {
            // 3rd parties
            'bootstrap': [ // @todo: only compile the components we need
                '//netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min',
                'lib/bootstrap.3.3.6.min'
            ],
            'jquery': [
                '//ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min', // jQuery 2.x doesn't support IE < 9
                'lib/jquery-1.12.2.min' // local fallback if CDN fails
            ],
        },
        shim: {
            'bootstrap': {
                deps: ['jquery'],
                exports: '$.fn.modal'
            },
        }
    });
});
