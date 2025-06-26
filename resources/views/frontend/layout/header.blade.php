
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{url('/public/b2c/assets/images/Icon.png')}}">

    <!-- All Plugins -->
    <link href="{{url('/public/b2c/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('/public/b2c/assets/css/animation.css')}}" rel="stylesheet">
    <link href="{{url('/public/b2c/assets/css/dropzone.min.css')}}" rel="stylesheet">
    <link href="{{url('/public/b2c/assets/css/flatpickr.min.css')}}" rel="stylesheet">
    <link href="{{url('/public/b2c/assets/css/flickity.min.css')}}" rel="stylesheet">
    <link href="{{url('/public/b2c/assets/css/lightbox.min.css')}}" rel="stylesheet">
    <link href="{{url('/public/b2c/assets/css/magnifypopup.css')}}" rel="stylesheet">
    <link href="{{url('/public/b2c/assets/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{url('/public/b2c/assets/css/rangeSlider.min.css')}}" rel="stylesheet">
    <link href="{{url('/public/b2c/assets/css/prism.css')}}" rel="stylesheet">

    <!-- Fontawesome & Bootstrap Icons CSS -->
    <link href="{{url('/public/b2c/assets/css/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{url('/public/b2c/assets/css/fontawesome.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{url('/public/b2c/assets/css/style.css')}}" rel="stylesheet">
    <style>
        #suggest-list {
            float: left;
            list-style: none;
            margin-top: -3px;
            padding: 0;
            width: 96%;
            position: absolute;
            z-index: 900;
            max-height: 200px;
            overflow-y: auto;

        }

        #suggest-list li {
            border-radius: 2px;
            padding: 10px;
            background: #f0f0f0;
            border-bottom: #04107C 1px solid;
        }

        #suggest-list li:hover {
            background: #ece3d2;
            cursor: pointer;
        }
        #suggest-list1 {
            float: left;
            list-style: none;
            margin-top: -3px;
            padding: 0;
            width: 23%;
            position: absolute;
            z-index: 900;
            max-height: 200px;
            overflow-y: auto;
        }
        @media only screen and (max-width: 600px) {
            #suggest-list1 {
                float: left;
                list-style: none;
                margin-top: -3px;
                padding: 0;
                width: 88%;
                position: absolute;
                z-index: 900;
                max-height: 200px;
                overflow-y: auto;
            }
        }
        #suggest-list1 li {
            border-radius: 2px;
            padding: 10px;
            background: #f0f0f0;
            border-bottom: #04107C 1px solid;
        }

        #suggest-list1 li:hover {
            background: #ece3d2;
            cursor: pointer;
        }
        /* width */
        ::-webkit-scrollbar {
            width: 5px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #888;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #04107C;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        .loading{
            position: fixed;
            width: 300px;
            height: 160px;
            z-index: 9999;
            background: 50% 50% no-repeat rgb(249,249,249);
            top: 50%;
            left: 50%;
            border-radius: 10px;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }
        .error {
            color:red;
        }
        @media (max-width: 767.98px) {
            .header {
                position: sticky;
                top: 0;
                z-index: 1030;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            }
        }
    </style>
</head>
