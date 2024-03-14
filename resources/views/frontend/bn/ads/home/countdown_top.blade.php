<div class="marginTop15 text-center advertisement">
    <div class="header-ad" style="display: flex; justify-content: center;">
        <div class="ad-box inauguration">
            <a href="https://www.dhakaprokash24.com/topic/পদ্মা-সেতু" target="_blank" rel="nofollow">
                <img src="{{ asset('media/advertisement/2022June/countdown-padma-top.png') }}" alt="Middle Top Ad">
                <div id="countdown" class="img-responsive" style="display: none">
                    <span><i class="remaining">স্বপ্নপূরণের  আর মাত্র</i><br></span>
                    <span class="days time"><strong id="timerDay"></strong> <br><i class="padma-day">দিন</i></span>
                    <span class="hours time"><strong id="timerHour"></strong> <br><i class="padma-day">ঘণ্টা</i></span>
                    <span class="minutes time"><strong id="timerMinute"></strong> <br><i class="padma-day">মিনিট</i></span>
                    <span class="seconds time"><strong id="timerSecond"></strong> <br><i class="padma-day"> সেকেন্ড</i></span>
                </div>
            </a>
        </div>
    </div>
</div>

<style>
    .inauguration {
        position: relative;
    }

    #countdown {
        padding: 3px 5px;
        background-color: rgba(255, 255, 255, .5);
        position: absolute;
        right: 30px;
        color: red !important;
        font-size: 16px !important;
        top: 85px !important;
        line-height: 22px !important;
        padding-right: 10px;
        font-weight: 700;
        border-radius: 4px;
    }

    .inauguration span {
        text-align: center;
    }

    .inauguration span i {
        font-style: normal;
    }

    .remaining {
        font-weight: bold !important;
        /*color: #b0275f !important;*/
        color: #4753fb !important;
        font-size: 18px !important;
    }

    .padma-day {
        font-style: normal;
        color: #222 !important;
        font-size: 17px !important;
        font-weight: normal;
    }

    #countdown .time {
        display: inline-block;
        padding: 0 4px !important;
    }

    #timerDay, #timerHour, #timerMinute, #timerSecond {
        font-size: 20px;
    }
</style>
