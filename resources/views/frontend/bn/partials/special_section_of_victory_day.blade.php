<style>

    .special-video-icon .fa {
        /*background-color: #1c4c75!important;*/
        font-size: 35px!important;
        color: red!important;
        /*text-shadow: 1px 1px 6px gray;*/
    }

    .special-section {
        position: relative;
        background-color: #C6E6D7;
        border-bottom: 2px solid #f42a41;
    }

    .special-section .container {
        margin-bottom: 15px !important;
    }

    .special-box hr {
        width: 100%;
        height: 4px;
        background: #942824;
        margin-top: 0px !important;
        margin-bottom: 5px !important;
    }

    .mobile-image {
        display: none;
    }

    .other-content-title {
        line-height: 1.2;
        font-size: 20px;
        margin-left: 7px;
        margin-right: 7px;
        padding-bottom: 12px;
        padding-top: 3px;
    }

    .other-content-title a {
        color: white !important;
    }

    .other-content-title a:hover {
        color: black !important;
    }

    .custom-border-bottom {
        position: relative;
    }

    .custom-border-bottom:after {
        position: absolute;
        content: '';
        border-bottom: 1px solid #979f9f;
        width: 100%;
        transform: translateX(-50%);
        bottom: -11px;
        left: 50%;
    }

    .one {
        position: relative;
    }

    .anniversary-media {
        background-color: #3375AF;
    }

    .anniversary-media-content {
        display: flex!important;
        align-items: center!important;
        padding: 4px 5px;
    }

    .anniversary-media-heading {
        margin-left: 15px;
        font-size: 19px!important;
    }

    .anniversary-media-heading a {
        color: white!important;
    }

    .anniversary-media:hover .special-video-icon .fa {
        /*background-color: #1c4c75!important;*/
        color: white!important;
        text-shadow: 0px 0px 0px gray;
    }

    .anniversary-media:hover .anniversary-media-heading a {
        color: black !important;
    }

    .anniversary-video-title {
        margin-top: -6px;
        background-color: #3375AF;
        border: 1px solid #3375AF;
        margin-bottom: 5px;
        color: white;
    }

    .anniversary-video-title > .fa-play {
        position: absolute;
        top: 40%;
        left: 50%;
        height: 50px;
        width: 50px;
        background: #3375AF;
        transform: translate(-50%,-50%);
        text-align: center;
        line-height: 38px;
        color: #fff;
        border-radius: 50%;
        padding-left: 4px;
        border: 5px solid #fff;
        -webkit-box-shadow: 0 0 30px 2px grey;
        -moz-box-shadow: 0 0 30px 2px gray;
        box-shadow: 0 0 30px 2px grey;
        opacity: .8;
        font-size: 20px;
    }

    .anniversary-video-title h4 {
        margin-bottom: 10px;
        line-height: 1.2;
        font-size: 25px;
        margin-left: 5px;
    }

    .other-content {
        margin-bottom: 25px!important;
        /*background-color: #1c4c75!important;*/
        background-color: #0D6C4E !important;
        height: 100%;
    }

    .special-top-video-section:hover .anniversary-video-title h4{
        color: yellow;
    }

    .logo-globe {
        position: absolute;
        left: -6%;
        top: 32%;
    }

    @media (max-width: 768px) {
        .special-event-section .row {
            display: flex;
            flex-direction: column;
        }

        .logo-globe {
            top: 78%;
        }

        .one:after {
            border: none!important;
        }

        .one:before {
            border: none!important;
        }

        .one {
            order: 1;
        }

        .two {
            order: 2;
        }

        .three {
            order: 3;
        }
    }

    @media (max-width: 500px) {
        .mobile-image {
            display: block;
        }

        .desktop-image {
            display: none;
        }
    }

</style>
<div class="special-section marginTop15" style="padding-top: 0; position: relative; overflow: hidden;">
    <div class="logo-globe">
        <svg xmlns="http://www.w3.org/2000/svg" width="595" height="582" opacity="0.2">
            <path style="fill:#5c6b96; stroke:none;" d="M265 50L265.427 61L258.966 73L269.752 93L285 133C301.278 124.566 319.773 103.025 324.39 85C328.64 68.4129 316.647 53.4626 300 52L300 51C309.058 51.025 318.334 52.815 327 55.4391C332.366 57.0638 337.668 59.7567 342 63.3287C375.962 91.3359 340.077 127.365 316 147.725C309.876 152.904 295.693 159.778 292.603 167.184C290.041 173.328 293 185.209 293 192C293 207.869 291.097 223.469 287.789 239C283.642 258.473 276.506 277.41 267.219 295C262.597 303.755 255.495 311.78 252 321C281.176 307.362 308.36 286.287 335 268.33C341.773 263.765 348.418 258.953 355 254.116C357.242 252.468 360.719 248.817 363.815 249.541C368.226 250.572 370.969 259.407 372.752 263C375.189 267.909 380.033 276.294 378.932 281.985C378.194 285.802 373.837 288.363 371 290.576C363.486 296.436 355.724 301.999 348 307.576C318.512 328.865 286.95 346.361 256 365.32C229.409 381.61 201.869 397.997 173 410C179.671 386.49 192.156 370.803 213 358L213 357L196 354.48L172 366.576L131 388L131 389L144 383C141.745 392.746 138.145 401.927 137.17 412C136.74 416.445 138.573 423.759 135.397 427.363C126.724 437.202 97.2508 440.403 96.1775 456.001C95.5478 465.151 110.072 477.062 116 483C124.376 491.389 137.11 506.077 149 509.207C154.611 510.684 162.611 506.675 168 505.14C185.609 500.128 202.483 492.929 219 485.111C272.378 459.847 318.502 416.648 349.947 367C361.79 348.301 371.249 328.542 379.399 308C382.904 299.166 384.348 288.174 389.089 280.004C394.129 271.318 405.046 267.089 411 259L372 242L372 240C379.96 236.452 396.282 224.334 399.397 215.996C403.703 204.467 401.31 186.98 400.17 175C397.476 146.697 394.395 119.212 385.333 92C381.426 80.2679 377.443 58.4687 368.185 49.8542C362.74 44.7877 349.056 44.6892 342 43.8449C315.453 40.6683 290.859 44.968 265 50z"/>
            <path style="fill:#214b7e; stroke:none;" d="M369 49C372.811 70.3806 385.731 91.5053 391.105 113C399.736 147.523 400.004 180.851 400 216C434.024 192.033 463.688 135.2 439.533 96C424.738 71.9891 394.903 57.4286 369 49z"/>

            <path style="fill:#214b7e; stroke:none;" d="M419 70C424.117 77.9781 436.652 82.439 444 88.4645C460.811 102.25 474.386 122.87 475.91 145C478.501 182.611 451.531 219.901 425.83 244.576C414.903 255.067 398.235 265.746 389.703 278.039C384.11 286.098 382.656 298.832 379 308C371.087 327.845 361.883 346.845 350.575 365C304.547 438.895 232.569 486.569 150 510L150 511L181 529C188.7 514.805 213.124 509.045 227 502.691C268.561 483.661 307.923 458.518 350 441C348.238 454.081 342.857 471.922 333.471 481.621C324.384 491.013 305.852 496.579 294 501.861C267.061 513.867 239.833 529.523 212 539L212 541C236.002 551.639 268.712 558.651 295 555.826C323.935 552.717 355.812 537.3 382 525.309C437.404 499.94 495.195 461.768 527.934 409C558.2 360.219 563.295 290.407 548 236L547 236C547.466 258.572 548.148 278.351 539.936 300C534.057 315.498 523.981 328.244 517 343C513.27 337.471 503.488 328.513 502.691 322C501.807 314.791 514.968 300.386 518.576 294C529.035 275.485 535.221 256.061 537.714 235C544.124 180.855 499.217 128.802 460 97.6011C448.052 88.0952 433.725 74.6614 419 70z"/>
            <path style="fill:#9398b7; stroke:none;" d="M257 71C228.816 91.8734 192.995 113.282 159 123C169.905 146.051 187.539 169.534 181 197C207.415 186.003 231.814 169.912 256 154.807C263.614 150.052 279.933 142.092 283.882 133.826C286.036 129.319 281.844 121.312 280.308 117C274.92 101.874 268.134 82.8529 257 71z"/>
            <path style="fill:#d2d3e2; stroke:none;" d="M40 270L41 270C47.1654 259.422 60.4412 254.033 71 248.753C95.3109 236.598 120.075 225.268 145 214.424C154.091 210.469 163.367 206.289 172 201.424C175.05 199.706 179.896 198.237 181.397 194.787C183.624 189.667 181.872 181.322 181.13 176C178.37 156.193 169.511 141.083 160 124C140.743 127.316 118.701 138.921 101 147.22C93.5627 150.707 84.4624 153.595 78.5285 159.529C71.7411 166.316 67.81 177.456 63.7446 186C51.577 211.572 42.2399 241.657 40 270z"/>
            <path style="fill:#9398b7; stroke:none;" d="M291 167C249.275 195.148 204.612 223.594 158 243L158 244L172 238C154.952 267.181 132.533 289.436 99 298.265C85.6796 301.773 72.6016 302.312 59 300.834C52.7447 300.154 46.1067 297.422 42.0895 304.044C38.0579 310.689 39.8161 321.679 40.7153 329C43.3067 350.1 48.6003 370.086 56.0502 390C59.4759 399.157 62.1586 413.572 74 412.907C95.0754 411.723 116.596 396.262 135 386.309C174.88 364.74 215.282 344.701 254 321L254 320L252 321L252 320C275.946 288.847 288.302 249.676 292.169 211C293.444 198.25 296.105 179.052 291 167z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M158 208L147.425 226L133 256L209 217.424L238 200L206 194L192 191L158 208z"/>
            <path style="fill:#9398b7; stroke:none;" d="M179 197L180 198L179 197M177 198L178 199L177 198M175.667 199.333L176.333 199.667L175.667 199.333M173.667 200.333L174.333 200.667L173.667 200.333M171.667 201.333L172.333 201.667L171.667 201.333M170 202L171 203L170 202M168 203L169 204L168 203M166 204L167 205L166 204M164 205L165 206L164 205M161 206L162 207L161 206M159 207L160 208L159 207M157 208L158 209L157 208z"/>
            <path style="fill:#214b7e; stroke:none;" d="M159 208L160 209L159 208z"/>
            <path style="fill:#9398b7; stroke:none;" d="M155 209L156 210L155 209z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M156 209L157 210L156 209z"/>
            <path style="fill:#214b7e; stroke:none;" d="M159 209C127.557 217.989 95.0298 236.275 66 251.258C58.9311 254.907 39.4327 262.8 41.3619 272.999C42.2447 277.667 47.1099 280.326 51 282.215C64.8933 288.962 71.7902 285.02 85 278.781C99.2737 272.039 121.066 266.27 132.582 255.363C137.355 250.841 139.264 241.804 142.258 236C147.089 226.636 154.763 218.522 159 209z"/>
            <path style="fill:#9398b7; stroke:none;" d="M153 210L154 211L153 210z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M154 210L155 211L154 210z"/>
            <path style="fill:#9398b7; stroke:none;" d="M151 211L152 212L151 211z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M152 211L153 212L152 211z"/>
            <path style="fill:#9398b7; stroke:none;" d="M149 212L150 213L149 212z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M147 213L148 214L147 213z"/>
            <path style="fill:#9398b7; stroke:none;" d="M144 214L145 215L144 214z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M145 214L146 215L145 214z"/>
            <path style="fill:#9398b7; stroke:none;" d="M142 215L143 216L142 215z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M143 215L144 216L143 215z"/>
            <path style="fill:#9398b7; stroke:none;" d="M140 216L141 217L140 216z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M141 216L142 217L141 216M138 217L139 218L138 217z"/>
            <path style="fill:#9398b7; stroke:none;" d="M135 218L136 219L135 218z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M136 218L137 219L136 218z"/>
            <path style="fill:#9398b7; stroke:none;" d="M133 219L134 220L133 219z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M134 219L135 220L134 219z"/>
            <path style="fill:#9398b7; stroke:none;" d="M131 220L132 221L131 220z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M132 220L133 221L132 220z"/>
            <path style="fill:#9398b7; stroke:none;" d="M129 221L130 222L129 221z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M127 222L128 223L127 222z"/>
            <path style="fill:#9398b7; stroke:none;" d="M124 223L125 224L124 223z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M125 223L126 224L125 223z"/>
            <path style="fill:#9398b7; stroke:none;" d="M122 224L123 225L122 224z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M123 224L124 225L123 224z"/>
            <path style="fill:#9398b7; stroke:none;" d="M120 225L121 226L120 225M118 226L119 227L118 226M115 227L116 228L115 227z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M116 227L117 228L116 227z"/>
            <path style="fill:#9398b7; stroke:none;" d="M113 228L114 229L113 228z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M114 228L115 229L114 228z"/>
            <path style="fill:#9398b7; stroke:none;" d="M111 229L112 230L111 229M109 230L110 231L109 230z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M107 231L108 232L107 231z"/>
            <path style="fill:#9398b7; stroke:none;" d="M104 232L105 233L104 232z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M105 232L106 233L105 232z"/>
            <path style="fill:#9398b7; stroke:none;" d="M102 233L103 234L102 233z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M103 233L104 234L103 233z"/>
            <path style="fill:#9398b7; stroke:none;" d="M100 234L101 235L100 234M98 235L99 236L98 235z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M96 236L97 237L96 236M94 237L95 238L94 237z"/>
            <path style="fill:#9398b7; stroke:none;" d="M91 238L92 239L91 238z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M92 238L93 239L92 238z"/>
            <path style="fill:#d2d3e2; stroke:none;" d="M48 299C96.5585 310.963 152.543 284.723 172 238C142.287 246.56 112.995 265.996 85 279.219C73.2648 284.762 56.4826 288.762 48 299z"/>
            <path style="fill:#9398b7; stroke:none;" d="M89 239L90 240L89 239z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M90 239L91 240L90 239z"/>
            <path style="fill:#9398b7; stroke:none;" d="M87 240L88 241L87 240M85 241L86 242L85 241M83 242L84 243L83 242M81 243L82 244L81 243M79 244L80 245L79 244M156 244L157 245L156 244z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M77 245L78 246L77 245z"/>
            <path style="fill:#9398b7; stroke:none;" d="M154 245L155 246L154 245z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M75 246L76 247L75 246z"/>
            <path style="fill:#9398b7; stroke:none;" d="M152 246L153 247L152 246z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M73 247L74 248L73 247z"/>
            <path style="fill:#9398b7; stroke:none;" d="M150 247L151 248L150 247z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M71 248L72 249L71 248z"/>
            <path style="fill:#9398b7; stroke:none;" d="M148 248L149 249L148 248M320 278L320 279C333.869 283.152 330.32 310.775 329 321C341.679 313.941 353.4 304.56 365 295.873C369.244 292.695 376.601 288.882 378.882 283.91C382.222 276.63 372.992 262.265 369.742 256C368.389 253.394 366.496 248.656 362.907 248.831C358.5 249.046 353.431 254.554 350 257C340.059 264.089 329.924 270.892 320 278z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M69 249L70 250L69 249z"/>
            <path style="fill:#9398b7; stroke:none;" d="M146 249L147 250L146 249M67 250L68 251L67 250M144 250L145 251L144 250M65 251L66 252L65 251M142 251L143 252L142 251M63 252L64 253L63 252M140 252L141 253L140 252M61 253L62 254L61 253M138 253L139 254L138 253M59 254L60 255L59 254z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M60 254L61 255L60 254z"/>
            <path style="fill:#9398b7; stroke:none;" d="M136 254L137 255L136 254z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M58 255L59 256L58 255z"/>
            <path style="fill:#9398b7; stroke:none;" d="M134 255L135 256L134 255M56 256L57 257L56 256z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M131 256L132 257L131 256z"/>
            <path style="fill:#9398b7; stroke:none;" d="M132 256L133 257L132 256M54 257L55 258L54 257z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M129 257L130 258L129 257z"/>
            <path style="fill:#9398b7; stroke:none;" d="M130 257L131 258L130 257z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M53 258L54 259L53 258M127 258L128 259L127 258z"/>
            <path style="fill:#9398b7; stroke:none;" d="M128 258L129 259L128 258M51 259L52 260L51 259z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M125 259L126 260L125 259z"/>
            <path style="fill:#9398b7; stroke:none;" d="M126 259L127 260L126 259M49 260L50 261L49 260z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M123 260L124 261L123 260z"/>
            <path style="fill:#9398b7; stroke:none;" d="M124 260L125 261L124 260M48 261L49 262L48 261z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M121 261L122 262L121 261z"/>
            <path style="fill:#9398b7; stroke:none;" d="M122 261L123 262L122 261z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M47 262L48 263L47 262M119 262L120 263L119 262z"/>
            <path style="fill:#9398b7; stroke:none;" d="M120 262L121 263L120 262M45 263L46 264L45 263z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M117 263L118 264L117 263z"/>
            <path style="fill:#9398b7; stroke:none;" d="M118 263L119 264L118 263M44 264L45 265L44 264M115 264L116 265L115 264M43 265L44 266L43 265M113 265L114 266L113 265M111 266L112 267L111 266M109 267L110 268L109 267M41 268L42 269L41 268z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M106 268L107 269L106 268z"/>
            <path style="fill:#9398b7; stroke:none;" d="M107 268L108 269L107 268z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M104 269L105 270L104 269z"/>
            <path style="fill:#9398b7; stroke:none;" d="M105 269L106 270L105 269z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M102 270L103 271L102 270z"/>
            <path style="fill:#9398b7; stroke:none;" d="M103 270L104 271L103 270z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M100 271L101 272L100 271z"/>
            <path style="fill:#9398b7; stroke:none;" d="M101 271L102 272L101 271z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M98 272L99 273L98 272z"/>
            <path style="fill:#9398b7; stroke:none;" d="M99 272L100 273L99 272z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M96 273L97 274L96 273z"/>
            <path style="fill:#9398b7; stroke:none;" d="M97 273L98 274L97 273z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M94 274L95 275L94 274z"/>
            <path style="fill:#9398b7; stroke:none;" d="M92 275L93 276L92 275M90 276L91 277L90 276z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M87 277L88 278L87 277z"/>
            <path style="fill:#9398b7; stroke:none;" d="M88 277L89 278L88 277z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M85 278L86 279L85 278z"/>
            <path style="fill:#9398b7; stroke:none;" d="M86 278L87 279L86 278z"/>
            <path style="fill:#d2d3e2; stroke:none;" d="M244 327C255.429 331.288 268.191 332.957 280 336.151C285.107 337.533 291.658 340.833 297 340.281C301.843 339.781 307.025 335.251 311 332.656C327.434 321.927 334.906 313.514 328.961 293C327.887 289.296 326.072 280.724 321.787 279.447C316.858 277.977 306.009 287.678 302 290.333C283.412 302.641 260.791 312.409 244 327z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M83 279L84 280L83 279z"/>
            <path style="fill:#9398b7; stroke:none;" d="M84 279L85 280L84 279M318 279L319 280L318 279z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M81 280L82 281L81 280z"/>
            <path style="fill:#9398b7; stroke:none;" d="M82 280L83 281L82 280M317 280L318 281L317 280z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M79 281L80 282L79 281z"/>
            <path style="fill:#9398b7; stroke:none;" d="M315 281L316 282L315 281M77 282L78 283L77 282M314 282L315 283L314 282M75 283L76 284L75 283M312 283L313 284L312 283z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M72 284L73 285L72 284z"/>
            <path style="fill:#9398b7; stroke:none;" d="M73 284L74 285L73 284M310.667 284.333L311.333 284.667L310.667 284.333z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M70 285L71 286L70 285z"/>
            <path style="fill:#9398b7; stroke:none;" d="M71 285L72 286L71 285M309 285L310 286L309 285z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M68 286L69 287L68 286z"/>
            <path style="fill:#9398b7; stroke:none;" d="M69 286L70 287L69 286M307 286L308 287L307 286z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M66 287L67 288L66 287z"/>
            <path style="fill:#9398b7; stroke:none;" d="M67 287L68 288L67 287M306 287L307 288L306 287M304 288L305 289L304 288M303 289L304 290L303 289M301 290L302 291L301 290M300 291L301 292L300 291M298 292L299 293L298 292M297 293L298 294L297 293M295 294L296 295L295 294M292 296L293 297L292 296M290 297L291 298L290 297M289 298L290 299L289 298M287 299L288 300L287 299M284 301L285 302L284 301M281 303L282 304L281 303M279 304L280 305L279 304M277 305L278 306L277 305M276 306L277 307L276 306M274 307L275 308L274 307M273 308L274 309L273 308M271 309L272 310L271 309M269 310L270 311L269 310M268 311L269 312L268 311M266 312L267 313L266 312M265 313L266 314L265 313M263 314L264 315L263 314M261 315L262 316L261 315M260 316L261 317L260 316M258 317L259 318L258 317M256 318L257 319L256 318M255 319L256 320L255 319M327 321L328 322L327 321M326 322L327 323L326 322M324 323L325 324L324 323M323 324L324 325L323 324M321 325L322 326L321 325M320 326L321 327L320 326z"/>

            <path style="fill:#9398b7; stroke:none;" d="M318 327L319 328L318 327M317 328L318 329L317 328M315 329L316 330L315 329M314 330L315 331L314 330M312 331L313 332L312 331M311 332L312 333L311 332M309 333L310 334L309 333M306 335L307 336L306 335M304 336L305 337L304 336M303 337L304 338L303 337M301 338L302 339L301 338M300 339L301 340L300 339M298 340L299 341L298 340M173 410C192.602 404.355 212.35 391.518 230 381.421C237.435 377.168 247.392 373.547 253 367C243.104 363.267 223.474 356.314 213 358.408C191.612 362.685 176.965 390.842 173 410z"/>
            <path style="fill:#214b7e; stroke:none;" d="M144 382L145 383L144 382M144 383C125.354 388.372 104.239 400.777 88 411.345C83.5184 414.261 73.0401 419.493 73.662 425.96C74.2142 431.701 83.4691 434.531 88 435.971C104.886 441.338 120.582 439.929 134.682 428.648C138.41 425.666 136.855 419.208 137.039 415C137.529 403.839 142.4 393.835 144 383z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M129 389L130 390L129 389M127 390L128 391L127 390M125 391L126 392L125 391M123 392L124 393L123 392M121 393L122 394L121 393M119 394L120 395L119 394M117 395L118 396L117 395M115 396L116 397L115 396M113 397L114 398L113 397z"/>

            <path style="fill:#5c6b96; stroke:none;" d="M111 398L112 399L111 398M109 399L110 400L109 399M107 400L108 401L107 400M105 401L106 402L105 401M103 402L104 403L103 402M101 403L102 404L101 403M99 404L100 405L99 404M97 405L98 406L97 405M95.6667 406.333L96.3333 406.667L95.6667 406.333M94 407L95 408L94 407M92 408L93 409L92 408M90 409L91 410L90 409M89 410L90 411L89 410M87 411L88 412L87 411M66 412L72 426L73 426L87 413L87 412L66 412z"/>
            <path style="fill:#214b7e; stroke:none;" d="M516 433C464.706 492.277 400.212 537.857 322 554L322 555C381.169 554.51 439.467 519.533 480 479C490.152 468.848 499.624 458.425 508.346 447C511.206 443.253 516.42 437.885 516 433z"/>
            <path style="fill:#5c6b96; stroke:none;" d="M286 473L286 474L300 468L293 477C300.281 480.243 315.151 489.208 323 488.149C340.243 485.823 348.828 455.344 350 441L286 473z"/>
            <path style="fill:#9398b7; stroke:none;" d="M300 467L301 468L300 467M286 474L286 475C292.933 476.752 296.907 474.628 300 468L286 474z"/>
        </svg>

    </div>
    <div class="container">
        <div class="special-box special-event-section">
            <a href="https://www.dhakaprokash24.com/topic/#" target="_blank" rel="nofollow">
                <div class="special-event-title marginTop20">
                    <div class="desktop-image">
                        <img src="{{ asset('media/common/Victory-Day-2022.jpg') }}" alt="বিজয় দিবস">
                    </div>
                    <div class="mobile-image">
                        <img src="{{ asset('media/common/Victory-Day-2022_Mobile.jpg') }}" alt="বিজয় দিবস">
                    </div>
                </div>
            </a>
            @if($specialArrangementContents)
                <div class="row marginTop20">
                    <div class="col-sm-6 one">
                        <div class="row" style="display: flex;">
                            @foreach($specialArrangementContents->splice(0, 4) as $content)
                                @php($sURL = fDesktopURL($content->content_id, $content->category->cat_slug, ($content->subcategory->subcat_slug ?? null), $content->content_type))
                                <div class="col-sm-6" style="display: flex; flex-direction: column;">
                                    <div class="other-content">
                                        <div class="imgbox">
                                            <a href="{{ $sURL }}" title="{{ $content->content_heading }}">
                                                <img
                                                    src="{{ $content->img_bg_path ? asset(config('appconfig.contentImagePath').$content->img_bg_path) : asset(config('appconfig.commonImagePath').'bg-default.jpg') }}"
                                                    class="img-responsive" alt="{{ $content->content_heading }}"
                                                    title="{{ $content->content_heading }}">
                                            </a>
                                        </div>
                                        <h4 class="other-content-title">
                                            <a href="{{ $sURL }}" title="{{ $content->content_heading }}">
                                                {{ $content->content_heading }}
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                                @if($loop->iteration === 2)
                        </div>
                        <div class="row" style="display: flex;">
                            @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-6 two">
                        <div class="special-top-video-section">
                            @if($bnSpecialEventVideos->count())
                                @php($spEventFirstVideo = $bnSpecialEventVideos->shift())
                                @if($spEventFirstVideo->is_live == 1)
                                    @if($spEventFirstVideo->type == 1)
                                        <iframe width="100%" height="351"
                                                src="https://www.youtube.com/embed/{{ $spEventFirstVideo->code }}?enablejsapi=1&autoplay=1&mute=1&rel=0&showinfo=1&controls=1&loop=1&playlist={{$spEventFirstVideo->code}}"
                                                frameborder="0" allowfullscreen></iframe>
                                    @elseif($spEventFirstVideo->type == 2)
                                        <div class="fb-video"
                                             data-href="https://www.facebook.com/watch/?v={{$spEventFirstVideo->code}}"
                                             data-width="auto" data-autoplay="true" data-show-captions="false"></div>
                                    @endif
                                    <div class="anniversary-video-title">
                                        <h4 style="margin-bottom: 10px; line-height: 1.2; font-size: 22px; margin-left: 5px; color: white">
                                            {{ $spEventFirstVideo->title }}
                                        </h4>
                                    </div>
                                @else
                                    @php($videoUrl = $spEventFirstVideo->target == 2 && $spEventFirstVideo->type == 1 ? ('https://www.youtube.com/watch?v='.$spEventFirstVideo->code) : ($spEventFirstVideo->target == 2 && $spEventFirstVideo->type == 2 ? ('https://www.facebook.com/dhakaprokash24/videos/'.$spEventFirstVideo->code) : fVideoURL($spEventFirstVideo->id, $spEventFirstVideo->category->slug)))
                                    <a style="margin-bottom: 20px; cursor: pointer" href="{{$videoUrl}}" target="_blank"
                                       rel="nofollow">
                                        <img
                                            src="{{ asset(config('appconfig.videoImagePath').$spEventFirstVideo->img_bg_path) }}"
                                            alt="{{ $spEventFirstVideo->title }}" style="width: 100%"/>
                                        <div class="anniversary-video-title">
                                            <i class="fa fa-play"></i>
                                            <h4>{{ $spEventFirstVideo->title }}</h4>
                                        </div>
                                    </a>
                                @endif
                            @endif
                        </div>

                        <div class="row">
                            @foreach($bnSpecialEventVideos->take(2) as $video)
                                @php($videoUrl = $video->target == 2 && $video->type == 1 ? ('https://www.youtube.com/watch?v='.$video->code) : ($video->target == 2 && $video->type == 2 ? ('https://www.facebook.com/dhakaprokash24/videos/'.$video->code) : fVideoURL($video->id, $video->category->slug)))
                                <div class="col-sm-12 {{ $loop->iteration == 2 ? 'marginTop5' : null }}" style="margin-bottom: {{ $loop->iteration == 2 ? '5' : null }}px">
                                    <div class="anniversary-media">
                                        <div class="anniversary-media-content">
                                            <div class="anniversary-media-left">
                                                <div class="special-video-icon">
                                                    <i class="fa fa-play-circle"></i>
                                                </div>
                                            </div>
                                            <div class="anniversary-media-body">
                                                <h4 class="anniversary-media-heading">
                                                    <a href="{{ $videoUrl }}" target="_blank" rel="nofollow">
                                                        {{ $video->title }}
                                                    </a>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    for(i=0; i<100; i++) {
        // Random rotation
        var randomRotation = Math.floor(Math.random() * 360);
        // Random Scale
        var randomScale = Math.random() * 1;
        // Random width & height between 0 and viewport
        var randomWidth = Math.floor(Math.random() * Math.max(document.documentElement.clientWidth, window.innerWidth || 0));
        var randomHeight =  Math.floor(Math.random() * Math.max(document.documentElement.clientHeight, window.innerHeight || 500));

        // Random animation-delay
        var randomAnimationDelay = Math.floor(Math.random() * 15);

        // Random colors
        var colors = ['#0CD977', '#FF1C1C', '#FF93DE', '#5767ED', '#FFC61C', '#8497B0']
        var randomColor = colors[Math.floor(Math.random() * colors.length)];

        // Create confetti piece
        var confetti = document.createElement('div');
        confetti.className = 'confetti';
        confetti.style.top=randomHeight + 'px';
        confetti.style.right=randomWidth + 'px';
        confetti.style.backgroundColor=randomColor;
        // confetti.style.transform='scale(' + randomScale + ')';
        confetti.style.obacity=randomScale;
        confetti.style.transform='skew(15deg) rotate(' + randomRotation + 'deg)';
        confetti.style.animationDelay=randomAnimationDelay + 's';
        document.getElementById("confetti-wrapper").appendChild(confetti);
    }
</script>

