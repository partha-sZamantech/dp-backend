<style>
    .actionNewAnimation{
        overflow: hidden;
        /*background: black;*/
        width: 100%;
        position: fixed;
        top: 0;
        left: 0;
    }
    .balloon{
        height: 60px;
        width: 55px;
        background-color: crimson;
        position: absolute;
        top: 40%;
        left: 10%;
        border-radius: 50%;
        animation: move 2s ease-in infinite;
    }
    .balloon:before{
        content: "";
        height: 60px;
        width: 6px;
        position: absolute;
        background-color: white;
        top: 93%;
        left: 40%;

    }
    @keyframes move{
        0%{
            top: 100%;
        }
        100%{
            top: 0%;
        }
    }
    .balloon:nth-child(2){
        left: 20%;
        top: 40%;
        background-color: yellow;
        animation-duration: 3s;
    }
    .balloon:nth-child(3){
        left: 30%;
        top: 40%;
        background-color: lightpink;
        animation-duration: 4s;
    }

    .balloon:nth-child(4){
        left: 40%;
        top: 40%;
        background-color: crimson;
        animation-duration: 5s;
    }

    .balloon:nth-child(5){
        left: 50%;
        top: 40%;
        background-color: gray;
        animation-duration: 6s;
    }

    .balloon:nth-child(6){
        left: 60%;
        top: 40%;
        background-color: orange;
        animation-duration: 2s;
    }
    .balloon:nth-child(7){
        left: 70%;
        top: 40%;
        background-color: yellow;
        animation-duration: 7s;
    }

    .balloon:nth-child(8){
        left: 80%;
        top: 40%;
        background-color: blue;
        animation-duration: 3s;
    }
    .balloon:nth-child(9){
        left: 90%;
        top: 40%;
        background-color: crimson;
        animation-duration: 4s;
    }


    .firework {
        position: relative;
        opacity: 0;
        animation: show_fireworks 1s ease-in-out 1s forwards;
    }

    @keyframes show_fireworks {
        0% {
            opacity: 0;
        }
        99% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }

    .cracker {
        position: absolute;
        width: 4px;
        height: 80px;
        transform-origin: 50% 100%;
        overflow: hidden;
    }

    .cracker::before {
        content: '';
        background-color: gold;
        /*background-color: gold;*/
        height: 40px;
        position: absolute;
        left: 0;
        right: 0;
        animation: fire 2s ease-in-out infinite;
    }

    @keyframes fire {
        0% {
            top: 100%;
        }
        25% {
            top: 50%;
        }
        50% {
            top: -25%;
        }
        75% {
            top: -50%;
        }
        100% {
            top: -50%;
        }
    }

    .cracker:nth-child(1) {
        transform: rotate(0deg) translateY(-15px);
    }
    .cracker:nth-child(2) {
        transform: rotate(30deg) translateY(-15px);
    }
    .cracker:nth-child(3) {
        transform: rotate(60deg) translateY(-15px);
    }
    .cracker:nth-child(4) {
        transform: rotate(90deg) translateY(-15px);
    }
    .cracker:nth-child(5) {
        transform: rotate(120deg) translateY(-15px);
    }
    .cracker:nth-child(6) {
        transform: rotate(150deg) translateY(-15px);
    }
    .cracker:nth-child(7) {
        transform: rotate(180deg) translateY(-15px);
    }
    .cracker:nth-child(8) {
        transform: rotate(210deg) translateY(-15px);
    }
    .cracker:nth-child(9) {
        transform: rotate(240deg) translateY(-15px);
    }
    .cracker:nth-child(10) {
        transform: rotate(270deg) translateY(-15px);
    }
    .cracker:nth-child(11) {
        transform: rotate(300deg) translateY(-15px);
    }
    .cracker:nth-child(12) {
        transform: rotate(330deg) translateY(-15px);
    }

    #firework1 {
        left: 34%;
        top: 219px;
        transform: scale(1);
    }

    #firework2 {
        left: 47%;
        top: 216px;
        transform: scale(.8);
    }

    #firework3 {
        left: 80%;
        top: 441px;
        transform: scale(1.5);
    }

    #firework4 {
        left: 34%;
        top: 482px;
        transform: scale(1);
    }
    /*h2{*/
    /*    font-size: 80px;*/
    /*    color: white;*/
    /*    background: #3375af;*/
    /*    padding: 20px 40px;*/
    /*    position: absolute;*/
    /*    top: 50%;*/
    /*    left: 40%;*/
    /*    font-family: cursive;*/
    /*    transform: translate(-30%,-50%);*/
    /*    border-radius: 3px;*/
    /*    box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.5), inset 0px -3px 6px -2px rgba(0, 0, 0, 0.3);*/
    /*}*/
    .img_banner {
        position: absolute;
        top: 50%;
        left: 40%;
        transform: translate(-30%,-50%);
        /*box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.5), inset 0px -3px 6px -2px rgba(0, 0, 0, 0.3);*/

    }
    .img_banner .img_container img {
        width: 600px;
        height: 100%;
        max-width: 100%;
        box-shadow: 0px 0px 9px 5px rgba(48,33,33,0.9);
        -webkit-box-shadow: 0px 0px 9px 5px rgba(48,33,33,0.9);
        -moz-box-shadow: 0px 0px 9px 5px rgba(48,33,33,0.9);
    }
    .img_banner .img_container {
        position: relative;
    }
    .img_banner .img_container .closeIcon {
        position: absolute;
        top: -15px;
        left: 50%;
        background: #00427a;
        color: #fff;
        padding: 2px 6px;
        cursor: pointer;
        z-index: 9999999;
    }

    @media all and (max-width: 415px){
        #firework1 {
            left: 0;
            top: 350px;
            transform: scale(.4)
        }

        #firework2 {
            right: 0;
            top: 350px;
            transform: scale(.4)
        }

        #firework3 {
            left: 0;
            top: 470px;
            transform: scale(.4)
        }

        #firework4 {
            right: -278px !important;
            top: 473px;
            transform: scale(.4);
            position: absolute;

        }
    }
</style>
<div class="actionNewAnimation" >
{{--    <h2>২য় বর্ষপূর্তির শুভেচ্ছা </h2>--}}
    <div class="img_banner">
        <div class="img_container">
             <span class="closeIcon" onclick="yearClose()">
                <i class="fa fa-close"></i>
            </span>
            <img src="{{ asset('images/web.jpg') }}" alt="">
        </div>
    </div>
    <div class="balloon" ></div>
    <div class="balloon"></div>
    <div class="balloon"></div>
    <div class="balloon"></div>
    <div class="balloon"></div>
    <div class="balloon"></div>
    <div class="balloon"></div>
    <div class="balloon"></div>
    <div class="balloon"></div>
    <div class="firework" id="firework1" >
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
    </div>
    <div class="firework" id="firework2">
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
    </div>
    <div class="firework" id="firework3">
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
    </div>
    <div class="firework" id="firework4">
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
        <div class="cracker"></div>
    </div>
</div>
<script>
    const height = window.innerHeight;
    const animationBody = document.getElementsByClassName("actionNewAnimation")[0];
    animationBody.style.height = height +'px'
    document.querySelector('body').style.overflow = 'hidden'
    setTimeout(function () {
        animationBody.style.display = "none";
        document.querySelector('body').style.overflow = ''
    },6000);

    function yearClose(){
        animationBody.style.display = "none";
        document.querySelector('body').style.overflow = ''
    }
</script>
