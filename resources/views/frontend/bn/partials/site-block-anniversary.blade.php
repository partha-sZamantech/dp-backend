<style>
    #siteblock.site-block {
        display: none;
        position: fixed;
        z-index: 10000;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        text-align: center;
        overflow: auto;
        background-color: rgba(0, 0, 0, .6)
    }

    #siteblock .siteblock-content {
        margin: auto;
        display: table;
        position: relative;
        -webkit-animation-name: zoom;
        -webkit-animation-duration: .6s;
        animation-name: zoom;
        animation-duration: .6s;
        max-width: 90%
    }

    #siteblock .siteblock-content img {
        position: relative
    }

    #siteblock .block-close {
        position: absolute;
        background: #f8f8f8;
        opacity: 1;
        right: -10px;
        top: -10px;
        width: 26px;
        height: 26px;
        line-height: 27px;
        border-radius: 50%;
        box-shadow: 0 0 0 5px #ccc;
        z-index: 1
    }

    #siteblock .block-close:focus, #siteblock .block-close:hover {
        color: #fff;
        background: #000;
        text-decoration: none;
        cursor: pointer
    }

    #adTimeCountdown {
        position: absolute;
        color: #fff;
        z-index: 1;
        top: -60px;
        font-weight: 700;
        left: 50%;
        transform: translateX(-50%)
    }

    /*Firework*/
    canvas{display:block}
    #firework {
        position: relative;
    }
    .anniversary-logo {
        position: absolute;
        top: 30%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #fff;
        font-family: "Source Sans Pro";
        font-size: 5em;
        font-weight: 900;
        -webkit-user-select: none;
        user-select: none;
    }

    @media (min-width: 900px) {
        .siteblock-content {
            max-width: 900px!important;
        }
    }
</style>

<div class="site-block-container">
    <div id="siteblock" class="site-block">
        <div class="siteblock-content" id="siteBlockContent">
            <span id="adTimeCountdown"></span>
            <span class="block-close">&times;</span>
            <div id="firework">
                <div class="anniversary-logo">
                    <img class="img-responsive" src="{{ asset('media/common/Anniversary.png') }}" style="width: 420px; height: auto">
                </div>
                <canvas id="birthday"></canvas>
            </div>
        </div>
    </div>
</div>
    <script>
        var siteblock = document.getElementById('siteblock');
        var span = document.getElementsByClassName("block-close")[0];
        span.onclick = function () {
            siteblock.style.display = "none";
        };
        window.onclick = function (event) {
            if (event.target == siteblock) {
                siteblock.style.display = "none";
            }
        };
        // set time for showing siteblock after 2 seconds of page loading
        setTimeout(function () {
            siteblock.style.display = "block";
        }, 100);
        // set time for stopping/closing siteblock for 5 seconds
        setTimeout(function () {
            siteblock.style.display = "none";
        }, 5000);
        // adTimeCountdown
        var timeleft = 8;
        var adTimeCountdown = setInterval(function () {
            document.getElementById("adTimeCountdown").innerHTML = timeleft;
            timeleft -= 1;
            if (timeleft < 0) {
                clearInterval(adTimeCountdown);
                document.getElementById("adTimeCountdown").innerHTML = "0"
            }
        }, 1000);

        // helper functions
        const PI2 = Math.PI * 2
        const random = (min, max) => Math.random() * (max - min + 1) + min | 0
        const timestamp = _ => new Date().getTime()

        // container
        class Birthday {
            constructor() {
                this.resize()

                // create a lovely place to store the firework
                this.fireworks = []
                this.counter = 0

            }

            resize() {
                this.width = canvas.width = window.innerWidth > 900 ? (window.innerWidth / 100) * 60 : window.innerWidth;
                let center = this.width / 2 | 0
                this.spawnA = center - center / 4 | 0
                this.spawnB = center + center / 4 | 0

                this.height = canvas.height = (window.innerHeight / 100) * 80;
                this.spawnC = this.height * .1
                this.spawnD = this.height * .5

            }

            onClick(evt) {
                let x = evt.clientX || evt.touches && evt.touches[0].pageX
                let y = evt.clientY || evt.touches && evt.touches[0].pageY

                let count = random(3,5)
                for(let i = 0; i < count; i++) this.fireworks.push(new Firework(
                    random(this.spawnA, this.spawnB),
                    this.height,
                    x,
                    y,
                    random(0, 260),
                    random(30, 110)))

                this.counter = -1

            }

            update(delta) {
                ctx.globalCompositeOperation = 'hard-light'
                ctx.fillStyle = `rgba(20,20,20,${ 7 * delta })`
                ctx.fillRect(0, 0, this.width, this.height)

                ctx.globalCompositeOperation = 'lighter'
                for (let firework of this.fireworks) firework.update(delta)

                // if enough time passed... create new new firework
                this.counter += delta * 8 // each second
                if (this.counter >= 1) {
                    this.fireworks.push(new Firework(
                        random(this.spawnA, this.spawnB),
                        this.height,
                        random(0, this.width),
                        random(this.spawnC, this.spawnD),
                        random(0, 360),
                        random(30, 110)))
                    this.counter = 0
                }

                // remove the dead fireworks
                if (this.fireworks.length > 1000) this.fireworks = this.fireworks.filter(firework => !firework.dead)

            }
        }

        class Firework {
            constructor(x, y, targetX, targetY, shade, offsprings) {
                this.dead = false
                this.offsprings = offsprings

                this.x = x
                this.y = y
                this.targetX = targetX
                this.targetY = targetY

                this.shade = shade
                this.history = []
            }
            update(delta) {
                if (this.dead) return

                let xDiff = this.targetX - this.x
                let yDiff = this.targetY - this.y
                if (Math.abs(xDiff) > 3 || Math.abs(yDiff) > 3) { // is still moving
                    this.x += xDiff * 2 * delta
                    this.y += yDiff * 2 * delta

                    this.history.push({
                        x: this.x,
                        y: this.y
                    })

                    if (this.history.length > 20) this.history.shift()

                } else {
                    if (this.offsprings && !this.madeChilds) {

                        let babies = this.offsprings / 2
                        for (let i = 0; i < babies; i++) {
                            let targetX = this.x + this.offsprings * Math.cos(PI2 * i / babies) | 0
                            let targetY = this.y + this.offsprings * Math.sin(PI2 * i / babies) | 0

                            birthday.fireworks.push(new Firework(this.x, this.y, targetX, targetY, this.shade, 0))

                        }

                    }
                    this.madeChilds = true
                    this.history.shift()
                }

                if (this.history.length === 0) this.dead = true
                else if (this.offsprings) {
                    for (let i = 0; this.history.length > i; i++) {
                        let point = this.history[i]
                        ctx.beginPath()
                        ctx.fillStyle = 'hsl(' + this.shade + ',100%,' + i + '%)'
                        ctx.arc(point.x, point.y, 1, 0, PI2, false)
                        ctx.fill()
                    }
                } else {
                    ctx.beginPath()
                    ctx.fillStyle = 'hsl(' + this.shade + ',100%,50%)'
                    ctx.arc(this.x, this.y, 1, 0, PI2, false)
                    ctx.fill()
                }

            }
        }

        let canvas = document.getElementById('birthday')
        let ctx = canvas.getContext('2d')

        let then = timestamp()

        let birthday = new Birthday
        window.onresize = () => birthday.resize()
        // document.onclick = evt => birthday.onClick(evt)
        // document.ontouchstart = evt => birthday.onClick(evt)

        var globalID;

        ;(function loop(){
            globalID = requestAnimationFrame(loop);

            let now = timestamp()
            let delta = now - then

            then = now
            birthday.update(delta / 1000)

        })()

        // setTimeout(function () {
        //     cancelAnimationFrame(globalID);
        //     document.getElementById('firework').style.display = "none";
        // }, 10000);

        function closeFirework () {
            cancelAnimationFrame(globalID);
            document.getElementById('firework').style.display = "none";
        }
    </script>

